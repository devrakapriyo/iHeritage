<?php

namespace App\Http\Controllers\BE;

use App\Helper\helpers;
use App\Model\content_collection_tbl;
use App\Model\content_detail_tbl;
use App\Model\content_gallery_tbl;
use App\Model\institutional;
use App\Model\visiting_order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Alert;

use Illuminate\Support\Facades\Mail;

use App\Model\content_tbl;
use App\Model\category_content_tbl;

class ContentController extends Controller
{
    public function content_pages($category)
    {
        return view('BE.pages.content.index', compact('category'));
    }

    public function content_get($category)
    {
        if(auth('admin')->user()->is_admin_master == "Y")
        {
            $data = content_tbl::select(['content.id', 'name', 'location', 'long_description_ind', 'long_description_en', 'content.is_active'])
                ->join('category_content', 'category_content.id', '=', 'content.category_ctn_id')
                ->where('category', $category);
        }else{
            $data = content_tbl::select(['content.id', 'name', 'location', 'long_description_ind', 'long_description_en', 'content.is_active'])
                ->join('category_content', 'category_content.id', '=', 'content.category_ctn_id')
                ->where('institutional_id', auth('admin')->user()->institutional_id)
                ->where('category', $category)
                ->where('content.is_active', "Y");
        }
        return Datatables::of($data)
            ->editColumn('long_description_en', function ($data) use ($category){
                $substr = substr($data->long_description_en, 0, 100);
                return $substr."<a href='".route('content-edit', ['category'=>$category, 'id'=>$data->id])."'>...readmore</a>";
            })
            ->editColumn('long_description_ind', function ($data) use ($category){
                $substr = substr($data->long_description_ind, 0, 100);
                return $substr."<a href='".route('content-edit', ['category'=>$category, 'id'=>$data->id])."'>...readmore</a>";
            })
            ->addColumn('gallery', function ($data) use ($category) {
                //$btn_gallery = '<a href="'.route('content-gallery', ['category'=>$category, 'id'=>$data->id]).'" class="btn btn-xs btn-success" title="add new photo?">'.content_gallery_tbl::countAlbum($data->id).' photo</a>';
                $btn_gallery = '<span class="badge badge-secondary">'.content_gallery_tbl::countAlbum($data->id).' photo</span>';
                return $btn_gallery;
            })
            ->addColumn('collection', function ($data) use ($category) {
                //$btn_collection = '<a href="'.route('content-collection', ['category'=>$category, 'id'=>$data->id]).'" class="btn btn-xs btn-success" title="add new collection?">'.content_collection_tbl::countCollectionType($data->id, "all").' collection</a>';
                $btn_collection = '<span class="badge badge-secondary">'.content_collection_tbl::countCollectionType($data->id, "all").' collection</span>';
                return $btn_collection;
            })
            ->addColumn('action', function ($data) use ($category) {
                $btn_edit = '<a href="'.route('content-edit', ['category'=>$category, 'id'=>$data->id]).'" class="btn btn-xs btn-warning">Edit</a>';
                $btn_hapus = '<a onclick="return confirm(\'Are you sure you want to delete this data?\');" href="'.route('content-delete', ['category'=>$category, 'id'=>$data->id]).'" class="btn btn-xs btn-danger">Hapus</a>';
                $btn_approve = '<a href="'.route('content-approve', ['category'=>$category, 'id'=>$data->id]).'" class="btn btn-xs btn-primary">Approve</a>';

                if(auth('admin')->user()->is_admin_master == "Y")
                {
                    if($data->is_active == "N")
                    {
                        $btn = "<div class='btn-group'>".$btn_approve." ".$btn_edit." ".$btn_hapus."</div>";
                    }else{
                        $btn = "<div class='btn-group'>".$btn_edit." ".$btn_hapus."</div>";
                    }
                }else{
                    $btn = "<div class='btn-group'>".$btn_edit." ".$btn_hapus."</div>";
                }
                return $btn;
            })
            ->rawColumns(['long_description_en','long_description_ind','gallery','collection','action'])
            ->make(true);
    }

    public function content_add($category)
    {
        return view('BE.pages.content.add', compact('category'));
    }

    public function content_post(Request $request, $category)
    {
        DB::begintransaction();
        try{
            if (!empty($request->file('photo')))
            {
                $valid = helpers::validationImage($request->file("photo"));
                if ($valid != true)
                {
                    Alert::info('format photo not valid');
                    return redirect()->back();
                }

                $photo = helpers::uploadImage($request->file("photo"),date("Ymd").rand(100,999),"img/BE/content/".$category);
                if ($photo != true)
                {
                    Alert::info('photo failed to upload');
                    return redirect()->back();
                }else{
                    $photo = url('/img/BE/content/'.$category.'/'.$photo);
                }
            }else{
                $photo = 'https://via.placeholder.com/300';
            }

            institutional::where('id', auth('admin')->user()->institutional_id)
                ->update([
                    'is_active' => "Y"
                ]);

            $content = new content_tbl;
            $content->photo = $photo;
            $content->name = $request->name;
            $content->name_en = $request->name_en;
            $content->seo = Str::slug($request->name);
            $content->category_ctn_id = category_content_tbl::getIDCategoryContent($category);
            $content->location = $request->location;
            //$content->short_description_en = $request->short_description_en;
            //$content->short_description_ind = $request->short_description_ind;
            $content->long_description_en = $request->long_description_en;
            $content->long_description_ind = $request->long_description_ind;
            $content->institutional_id = auth('admin')->user()->institutional_id;
            $content->created_by = auth('admin')->user()->id;
            $content->is_active = "Y";
            $content->save();

            $detail = new content_detail_tbl;
            $detail->content_id = $content->id;
            $detail->address = $request->address;
            $detail->place_id = $request->place_id;
            $detail->map_area_detail = $request->map_area_detail;
            $detail->latitude_detail = $request->latitude_detail;
            $detail->longitude_detail = $request->longitude_detail;
            //$detail->url_vr = auth('admin')->user()->is_admin_master == "Y" ? $request->url_vr : "";
            $detail->url_vr = $request->url_vr;
            $detail->url_website = $request->url_website;
            $detail->phone = $request->phone;
            $detail->email = $request->email;
            //$detail->opening_sunday = $request->opening_sunday;
            //$detail->opening_moday = $request->opening_moday;
            //$detail->opening_tuesday = $request->opening_tuesday;
            //$detail->opening_wednesday = $request->opening_wednesday;
            //$detail->opening_thursday = $request->opening_thursday;
            //$detail->opening_friday = $request->opening_friday;
            //$detail->opening_saturday = $request->opening_saturday;
            $detail->opening_day_ind = $request->opening_day_ind;
            $detail->opening_day_en = $request->opening_day_en;
            $detail->opening_hour = $request->opening_hour;
            $detail->close_en = $request->close_en;
            $detail->close_ind = $request->close_ind;
            $detail->save();
        }catch (\Exception $exception){
            DB::rollback();
            return $exception;
        }
        DB::commit();
        Alert::success('Content uploaded successfully');
        return redirect()->route('content-pages',['category'=>$category]);
    }

    public function content_edit($category,$id)
    {
        $content = content_tbl::where('id',$id)->first();
        $detail = content_detail_tbl::where('content_id',$content->id)->first();
        return view('BE.pages.content.edit', compact('category','id','content','detail'));
    }

    public function content_update(Request $request,$category,$id)
    {
        DB::begintransaction();
        try{
            if (!empty($request->file('photo')))
            {
                $valid = helpers::validationImage($request->file("photo"));
                if ($valid != true)
                {
                    Alert::info('format photo not valid');
                    return redirect()->back();
                }

                $photo = helpers::uploadImage($request->file("photo"),date("Ymd").rand(100,999),"img/BE/content/".$category);
                if ($photo != true)
                {
                    Alert::info('photo failed to upload');
                    return redirect()->back();
                }else{
                    // delete file storage
                    $path = content_tbl::select('photo')->where('id',$id)->first()->photo;
                    $file = substr($path, strrpos($path, '/') + 1);
                    if(file_exists(public_path('img/BE/content/'.$category.'/'.$file)))
                    {
                        unlink(public_path('img/BE/content/'.$category.'/'.$file));
                    }

                    $photo = url('/img/BE/content/'.$category.'/'.$photo);
                }
            }else{
                $photo = content_tbl::select('photo')->where('id',$id)->first()->photo;
            }

            content_tbl::where('id',$id)
                ->update([
                    'name'=>$request->name,
                    'name_en'=>$request->name_en,
                    'photo'=>$photo,
                    'category_ctn_id'=>category_content_tbl::getIDCategoryContent($category),
                    'location'=>$request->location,
                    //'short_description_en'=>$request->short_description_en,
                    //'short_description_ind'=>$request->short_description_ind,
                    'long_description_en'=>$request->long_description_en,
                    'long_description_ind'=>$request->long_description_ind
                ]);

            content_detail_tbl::where('content_id',$id)
                ->update([
                    'address'=>$request->address,
                    'place_id'=>$request->place_id,
                    'map_area_detail'=>$request->map_area_detail,
                    'latitude_detail'=>$request->latitude_detail,
                    'longitude_detail'=>$request->longitude_detail,
                    //'url_vr'=>auth('admin')->user()->is_admin_master == "Y" ? $request->url_vr : "",
                    'url_vr'=>$request->url_vr,
                    'url_website'=>$request->url_website,
                    'phone'=>$request->phone,
                    'email'=>$request->email,
                    //'opening_sunday'=>$request->opening_sunday,
                    //'opening_moday'=>$request->opening_moday,
                    //'opening_tuesday'=>$request->opening_tuesday,
                    //'opening_wednesday'=>$request->opening_wednesday,
                    //'opening_thursday'=>$request->opening_thursday,
                    //'opening_friday'=>$request->opening_friday,
                    //'opening_saturday'=>$request->opening_saturday,
                    'opening_day_ind'=>$request->opening_day_ind,
                    'opening_day_en'=>$request->opening_day_en,
                    'opening_hour'=>$request->opening_hour,
                    'close_en'=>$request->close_en,
                    'close_ind'=>$request->close_ind,
                ]);
        }catch (\Exception $exception){
            DB::rollback();
            return $exception;
        }
        DB::commit();
        Alert::success('Content updated successfully');
        return redirect()->route('content-pages',['category'=>$category]);
    }

    public function content_delete($category,$id)
    {
        $category_id = category_content_tbl::getIDCategoryContent($category);
        content_tbl::where('id',$id)->update([
            'is_active'=>"N"
        ]);

        Alert::success('Content deleted successfully');
        return redirect()->route('content-pages',['category'=>$category]);
    }

    public function content_approve($category,$id)
    {
        $category_id = category_content_tbl::getIDCategoryContent($category);
        content_tbl::where('id',$id)->update([
            'is_active'=>"Y"
        ]);

        Alert::success('Content deleted successfully');
        return redirect()->route('content-pages',['category'=>$category]);
    }

    public function content_visiting()
    {
        return view('BE.pages.visitingOrder.index');
    }

    public function content_visiting_get()
    {
        if(auth('admin')->user()->is_admin_master == "Y")
        {
            $data = visiting_order::orderBy('created_at', "DESC");
        }else{
            $data = visiting_order::select(['visiting_order.*'])
                ->join('content', 'content.id', '=', 'visiting_order.content_id')
                ->where('institutional_id', auth('admin')->user()->institutional_id);
        }

        return DataTables::of($data)
            ->editColumn('information', function ($data){
                $substr = substr($data->information, 0, 250);
                return $substr."<a href='".route('content-visiting-detail', ['id'=>$data->id])."'>...readmore</a>";
            })
            ->editColumn('messages_response', function ($data){
                $substr = substr($data->messages_response, 0, 250);
                if($data->messages_response == null)
                {
                    return "";
                }else{
                    return $substr."<a href='".route('content-visiting-detail', ['id'=>$data->id])."'>...readmore</a>";
                }
            })
            ->addColumn('contact', function ($data) {
                return "Email : ".$data->email."<br> Phone : ".$data->phone;
            })
            ->addColumn('detail', function ($data) {
                $btn = '<a href="'.route('content-visiting-detail', ['id'=>$data->id]).'" class="btn btn-warning">Detail</a>';
                return "<div class='btn-group'>".$btn."</div>";
            })
            ->rawColumns(['information','messages_response','contact','detail'])
            ->make(true);
    }

    public function content_visiting_detail($id)
    {
        $data = visiting_order::find($id);
        return view('BE.pages.visitingOrder.detail', compact('id', 'data'));
    }

    public function content_visiting_send(Request $request, $id)
    {
        $data = visiting_order::where('id',$id);

        if($data->first()->is_send == "N")
        {
            $data->update([
                'is_send' => "Y",
                'messages_response' => $request->messages_response
            ]);

            Mail::send('BE.email.visiting-order', [
                'code_booking' => $data->first()->code_booking,
                'institutional_name' => $data->first()->institutional_name,
                'phone' => $data->first()->phone,
                'pax' => $data->first()->visitor,
                'date' => $data->first()->date,
                'information' => $data->first()->information,
                'messages_response' => $request->messages_response,
            ], function ($m) use ($data) {
                $m->from(auth('admin')->user()->email, auth('admin')->user()->name);
                $m->to($data->first()->email, $data->first()->institutional_name)->subject('iHeritage.id - reply to visiting order '.$data->first()->kode_booking);
            });
        }

        Alert::success('messages succesfuly send to email');
        return redirect()->route('content-visiting');
    }

    // gallery
    public function content_gallery($category,$id)
    {
        $gallery = content_gallery_tbl::select('id','photo')->where('content_id',$id)->get();
        return view('BE.pages.content.gallery', compact('category','id','gallery'));
    }
    public function content_gallery_upload(Request $request,$category,$id)
    {
        if (!empty($request->file('photo')))
        {
            $valid = helpers::validationImage($request->file("photo"));
            if ($valid != true)
            {
                Alert::info('format photo not valid');
                return redirect()->back();
            }

            $photo = helpers::uploadImage($request->file("photo"),date("Ymd").rand(100,999),"img/BE/gallery");
            if ($photo != true)
            {
                Alert::info('photo failed to upload');
                return redirect()->back();
            }else{
                $photo = url('/img/BE/gallery/'.$photo);
            }
        }else{
            Alert::error('Image hasnt been uploaded yet');
            return redirect()->back();
        }

        $simpan = new content_gallery_tbl;
        $simpan->content_id = $id;
        $simpan->photo = $photo;
        $simpan->save();

        return redirect()->route('content-pages',['category'=>$category]);
    }
    public function content_gallery_delete($category,$id)
    {
        // delete file storage
        $path = content_gallery_tbl::select('photo')->where('id',$id)->first()->photo;
        $file = substr($path, strrpos($path, '/') + 1);
        if(file_exists(public_path('img/BE/gallery/'.$file)))
        {
            unlink(public_path('img/BE/gallery/'.$file));
        }

        content_gallery_tbl::where('id',$id)->delete();
        return redirect()->route('content-pages',['category'=>$category]);
    }

    // collection
    public function content_collection($category,$id)
    {
        $collection = content_collection_tbl::where('content_id',$id)->where('is_active',"Y")->get();
        return view('BE.pages.content.collection', compact('category','id','collection'));
    }

    function geocode($address){

        // url encode the address
        $address = urlencode($address);

        // google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=".env('GOOGLE_MAPS_KEY')."";

        // get the json response
        $resp_json = file_get_contents($url);

        // decode the json
        $resp = json_decode($resp_json, true);

        // response status will be 'OK', if able to geocode given address
        if($resp['status'] == 'OK')
        {

            // get the important data
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";

            // verify if data is complete
            if($lati && $longi && $formatted_address){

                // put the data in the array
                $data_arr = array();

                array_push(
                    $data_arr,
                    $lati,
                    $longi,
                    $formatted_address
                );

                return $data_arr;

            }else{
                return false;
            }

        }else{
            echo "<strong>ERROR: {$resp['status']}</strong>";
            return false;
        }
    }
    public function get_map($location)
    {
        $map_location = $this->geocode($location);
        $latitude = null;
        $longitude = null;
        $address = null;
        if($map_location)
        {
            $latitude = $map_location[0];
            $longitude = $map_location[1];
            $address = $map_location[2];
        }

        return $this->get_json_latitude_longitude(200, $latitude, $longitude, $address);
    }

    public function content_collection_upload(Request $request,$category,$id)
    {
        if (($request->media_type == "document") || ($request->media_type == "image"))
        {
            if ($request->file('upload_media'))
            {
                if ($request->media_type == "image")
                {
                    $size = 5000000;
                    $msg = "must format jpg, jpeg or png";
                } else if ($request->media_type == "document") {
                    $size = 5000000;
                    $msg = "must format pdf";
                }

                $valid = helpers::validationMedia($request->file("upload_media"), $request->media_type);
                if ($valid != true)
                {
                    Alert::error('upload unsuccessful, ' . $msg);
                    return redirect()->back();
                }

                $media = helpers::uploadMedia($request->file("upload_media"), date("Ymd") . rand(100, 999), "img/BE/media", $size);
                if ($media != true)
                {
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

        if($request->media_type != "image")
        {
            $institutional = content_tbl::fieldContent($id, 'institutional_id');
            $category = institutional::getData($institutional, 'category')->category;
            if ($request->file('banner'))
            {
                $valid = helpers::validationImage($request->file("banner"));
                if ($valid != true)
                {
                    return redirect()->back();
                }

                $banner = helpers::uploadImage($request->file("banner"), date("Ymd") . rand(100, 999), "img/BE/content/" . $category);
                if ($banner != true)
                {
                    return redirect()->back();
                } else {
                    $banner = url('/img/BE/content/' . $category . '/' . $banner);
                }
            } else {
                Alert::error('Banner is empty');
                return redirect()->back();
            }
        }else{
            $banner = $media;
        }

        if($request->place_id)
        {
            $place_id = $request->place_id;
        }else{
            $place_id = content_detail_tbl::fieldContent($id, "place_id");
        }

        if($request->map_area_detail)
        {
            $map_area_detail = $request->map_area_detail;
            $latitude_detail = $request->latitude_detail;
            $longitude_detail = $request->longitude_detail;
        }else{
            $map_area_detail = content_detail_tbl::fieldContent($id, "map_area_detail");
            $latitude_detail = content_detail_tbl::fieldContent($id, "latitude_detail");
            $longitude_detail = content_detail_tbl::fieldContent($id, "longitude_detail");
        }

        $simpan = new content_collection_tbl;
        $simpan->content_id = $id;
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
        return redirect()->route('content-pages',['category'=>$category]);
    }
    public function content_collection_delete($category,$id)
    {
        // delete file storage
        $path = content_collection_tbl::select('media','banner')->where('id',$id)->first();
        $file_media = substr($path->media, strrpos($path->media, '/') + 1);
        $file_banner = substr($path->banner, strrpos($path->banner, '/') + 1);
        if(file_exists(public_path('img/BE/media/'.$file_media)))
        {
            unlink(public_path('img/BE/media/'.$file_media));
        }
        if(file_exists(public_path('img/BE/media/'.$file_banner)))
        {
            unlink(public_path('img/BE/media/'.$file_banner));
        }

        content_collection_tbl::where('id',$id)->update(['is_active'=>"N"]);
        Alert::success('Data collection successfully deleted');
        return redirect()->route('content-pages',['category'=>$category]);
    }
}
