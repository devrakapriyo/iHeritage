<?php

namespace App\Http\Controllers\BE;

use App\Helper\helpers;
use App\Model\content_collection_tbl;
use App\Model\content_detail_tbl;
use App\Model\content_tbl;
use App\Model\institutional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;
use Alert;

class CollectionController extends Controller
{
    public function collection_peges()
    {
        return view('BE.pages.collection.index');
    }

    public function collection_get()
    {
        if (auth('admin')->user()->is_admin_master == "Y") {
            $data = content_collection_tbl::where('is_active', "Y");
        } else {
            $data = content_collection_tbl::select(['content_collection.*', 'institutional_id'])
                ->join('content', 'content.id', '=', 'content_collection.content_id')
                ->where('institutional_id', auth('admin')->user()->institutional_id)
                ->where('content_collection.is_active', "Y");
        }
        return Datatables::of($data)
            ->editColumn('description_en', function ($data) {
                $substr = substr($data->description_en, 0, 100);
                return $substr . "<a href='" . route('collection-edit', ['id' => $data->id]) . "'>...readmore</a>";
            })
            ->editColumn('banner', function ($data) {
                $btn_gallery = '<a href="' . $data->banner . '" class="btn btn-xs btn-success" title="view banner?" target="_blank">banner</a>';
                return $btn_gallery;
            })
            ->editColumn('media', function ($data) {
                $btn_gallery = '<a href="' . $data->media . '" class="btn btn-xs btn-primary" title="view media?" target="_blank">' . $data->media_type . '</a>';
                return $btn_gallery;
            })
            ->addColumn('action', function ($data) {
                $institutional = content_tbl::fieldContent($data->content_id, 'institutional_id');
                $category = institutional::getData($institutional, 'category')->category;

                $btn_edit = '<a href="' . route('collection-edit', ['id' => $data->id]) . '" class="btn btn-xs btn-warning">Edit</a>';
                $btn_hapus = '<a onclick="return confirm(\'Are you sure you want to delete this data?\');" href="' . route('content-collection-delete', ['category' => $category, 'id' => $data->id]) . '" class="btn btn-xs btn-danger">Hapus</a>';
                return "<div class='btn-group'>" . $btn_edit . " " . $btn_hapus . "</div>";
            })
            ->rawColumns(['description_en', 'banner', 'media', 'action'])
            ->make(true);
    }

    public function collection_add()
    {
        if (auth('admin')->user()->is_admin_master == "Y") {
            $content = content_tbl::select('id', 'name')->where('is_active', "Y")->get();
        } else {
            $content = content_tbl::listContent(auth('admin')->user()->institutional_id);
        }
        return view('BE.pages.collection.add', compact('content'));
    }

    public function collection_post(Request $request)
    {
        dd($request->file("media"));
        if (($request->media_type != "video") && ($request->media_type != "url")) {
            if (!empty($request->file('media'))) {
                if ($request->media_type == "image") {
                    $size = 1000000;
                    $msg = "must format jpg, jpeg or png";
                } else if ($request->media_type == "audio") {
                    $size = 10000000;
                    $msg = "must format mp3";
                } else if ($request->media_type == "document") {
                    $size = 1000000;
                    $msg = "must format pdf";
                }

                $valid = helpers::validationMedia($request->file("media"), $request->media_type);
                if ($valid != true) {
                    Alert::error('upload unsuccessful, ' . $msg);
                    return redirect()->back();
                }

                $media = helpers::uploadMedia($request->file("media"), date("Ymd") . rand(100, 999), "img/BE/media", $size);
                if ($media != true) {
                    return redirect()->back();
                } else {
                    $media = url('/img/BE/media/' . $media);
                }
            } else {
                Alert::error('Media hasnt been uploaded yet');
            }
        } else {
            $media = $request->media;
        }

        $institutional = content_tbl::fieldContent($request->content_id, 'institutional_id');
        $category = institutional::getData($institutional, 'category')->category;

        if (!empty($request->file('banner'))) {
            $valid = helpers::validationImage($request->file("banner"));
            if ($valid != true) {
                return redirect()->back();
            }

            $banner = helpers::uploadImage($request->file("banner"), date("Ymd") . rand(100, 999), "img/BE/content/" . $category);
            if ($banner != true) {
                return redirect()->back();
            } else {
                $banner = url('/img/BE/content/' . $category . '/' . $banner);
            }
        } else {
            $banner = 'https://via.placeholder.com/300';
        }

        if($request->place_id)
        {
            $place_id = $request->place_id;
        }else{
            $place_id = content_detail_tbl::fieldContent($request->content_id, "place_id");
        }

        if($request->map_area_detail)
        {
            $map_area_detail = $request->map_area_detail;
            $latitude_detail = $request->latitude_detail;
            $longitude_detail = $request->longitude_detail;
        }else{
            $map_area_detail = content_detail_tbl::fieldContent($request->content_id, "map_area_detail");
            $latitude_detail = content_detail_tbl::fieldContent($request->content_id, "latitude_detail");
            $longitude_detail = content_detail_tbl::fieldContent($request->content_id, "longitude_detail");
        }

        $simpan = new content_collection_tbl;
        $simpan->content_id = $request->content_id;
        $simpan->name = $request->name;
        $simpan->name_en = $request->name_en;
        $simpan->banner = $banner;
        $simpan->media = $media;
        $simpan->media_type = $request->media_type;
        $simpan->creator = $request->creator;
        $simpan->created_year = $request->created_year;
        $simpan->lang = $request->lang;
        $simpan->topic = $request->topic;
        $simpan->physical_description = $request->physical_description;
        $simpan->description_ind = $request->description_ind;
        $simpan->description_en = $request->description_en;
        $simpan->publisher = $request->publisher;
        $simpan->institution_owner = $request->institution_owner;
        $simpan->link_url = $request->link_url;
        $simpan->place_id = $place_id;
        $simpan->map_area_detail = $map_area_detail;
        $simpan->latitude_detail = $latitude_detail;
        $simpan->longitude_detail = $longitude_detail;
        $simpan->is_active = "Y";
        $simpan->created_by = auth('admin')->user()->name;
        $simpan->save();

        Alert::success('Collection uploaded successfully');
        return redirect()->route('collection-pages');
    }

    public function collection_edit($id)
    {
        $detail = content_collection_tbl::find($id);
        return view('BE.pages.collection.edit', compact('id','detail'));
    }

    public function collection_update(Request $request, $id)
    {
        if (($request->media_type != "video") && ($request->media_type != "url")) {
            if (!empty($request->file('media'))) {
                if ($request->media_type == "image") {
                    $size = 1000000;
                    $msg = "must format jpg, jpeg or png";
                } else if ($request->media_type == "audio") {
                    $size = 10000000;
                    $msg = "must format mp3";
                } else if ($request->media_type == "document") {
                    $size = 1000000;
                    $msg = "must format pdf";
                }

                $valid = helpers::validationMedia($request->file("media"), $request->media_type);
                if ($valid != true) {
                    Alert::error('upload unsuccessful, ' . $msg);
                    return redirect()->back();
                }

                $media = helpers::uploadMedia($request->file("media"), date("Ymd") . rand(100, 999), "img/BE/media", $size);
                if ($media != true) {
                    return redirect()->back();
                } else {
                    $media = url('/img/BE/media/' . $media);
                }
            } else {
                $media = content_collection_tbl::fieldContent($id, "media");
            }
        } else {
            $media = $request->media;
        }

        $institutional = content_tbl::fieldContent(content_collection_tbl::fieldContent($id, "content_id"), 'institutional_id');
        $category = institutional::getData($institutional, 'category')->category;

        if (!empty($request->file('banner'))) {
            $valid = helpers::validationImage($request->file("banner"));
            if ($valid != true) {
                return redirect()->back();
            }

            $banner = helpers::uploadImage($request->file("banner"), date("Ymd") . rand(100, 999), "img/BE/content/" . $category);
            if ($banner != true) {
                return redirect()->back();
            } else {
                $banner = url('/img/BE/content/' . $category . '/' . $banner);
            }
        } else {
            $banner = content_collection_tbl::fieldContent($id, "banner");
        }

        if($request->place_id)
        {
            $place_id = $request->place_id;
        }else{
            $place_id = content_detail_tbl::fieldContent($request->content_id, "place_id");
        }

        if($request->map_area_detail)
        {
            $map_area_detail = $request->map_area_detail;
            $latitude_detail = $request->latitude_detail;
            $longitude_detail = $request->longitude_detail;
        }else{
            $map_area_detail = content_detail_tbl::fieldContent($request->content_id, "map_area_detail");
            $latitude_detail = content_detail_tbl::fieldContent($request->content_id, "latitude_detail");
            $longitude_detail = content_detail_tbl::fieldContent($request->content_id, "longitude_detail");
        }

        content_collection_tbl::where('id',$id)
            ->update([
                'name'=>$request->name,
                'name_en'=>$request->name_en,
                'banner'=>$banner,
                'media'=>$media,
                'creator'=>$request->creator,
                'created_year'=>$request->created_year,
                'lang'=>$request->lang,
                'topic'=>$request->topic,
                'physical_description'=>$request->physical_description,
                'description_ind'=>$request->description_ind,
                'description_en'=>$request->description_en,
                'publisher'=>$request->publisher,
                'institution_owner'=>$request->institution_owner,
                'link_url'=>$request->link_url,
                'place_id'=>$place_id,
                'map_area_detail'=>$map_area_detail,
                'latitude_detail'=>$latitude_detail,
                'longitude_detail'=>$longitude_detail
            ]);

        Alert::success('Collection updated successfully');
        return redirect()->route('collection-pages');
    }

}