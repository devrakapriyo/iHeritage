<?php

namespace App\Http\Controllers\BE;

use App\Helper\helpers;
use App\Model\content_detail_tbl;
use App\Model\content_gallery_tbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

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
        $data = content_tbl::select(['content.id', 'name', 'category_content.category_ctn_name_ind', 'location', 'short_description_ind'])
            ->join('category_content', 'category_content.id', '=', 'content.category_ctn_id')
            ->where('users_id', Auth::user()->id)
            ->where('category', $category)
            ->where('is_active', "Y");
        return Datatables::of($data)
            ->addColumn('gallery', function ($data) use ($category) {
                $btn_gallery = '<a href="'.route('content-gallery', ['category'=>$category, 'id'=>$data->id]).'" class="btn btn-xs btn-info" title="add new photo?">'.content_gallery_tbl::countAlbum($data->id).' photo</a>';
                return $btn_gallery;
            })
            ->addColumn('action', function ($data) use ($category) {
                $btn_edit = '<a href="'.route('content-edit', ['category'=>$category, 'id'=>$data->id]).'" class="btn btn-xs btn-warning">Edit</a>';
                $btn_hapus = '<a href="'.route('content-delete', ['category'=>$category, 'id'=>$data->id]).'" class="btn btn-xs btn-danger">Hapus</a>';
                return "<div class='btn-group'>".$btn_edit." ".$btn_hapus."</div>";
            })
            ->rawColumns(['gallery','action'])
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
                    return redirect()->back();
                }

                $photo = helpers::uploadImage($request->file("photo"),date("Ymd").rand(100,999),"img/BE/content/".$category);
                if ($photo != true)
                {
                    return redirect()->back();
                }else{
                    $photo = url('/img/BE/content/'.$category.'/'.$photo);
                }
            }else{
                $photo = 'https://via.placeholder.com/300';
            }

            $content = new content_tbl;
            $content->photo = $photo;
            $content->name = $request->name;
            $content->seo = Str::slug($request->name);
            $content->category_ctn_id = $request->category_ctn_id;
            $content->location = $request->location;
            $content->short_description_en = $request->short_description_en;
            $content->short_description_ind = $request->short_description_ind;
            $content->long_description_en = $request->long_description_en;
            $content->long_description_ind = $request->long_description_ind;
            $content->is_active = "Y";
            $content->users_id = Auth::user()->id;
            $content->save();

            $detail = new content_detail_tbl;
            $detail->content_id = $content->id;
            $detail->address = $request->address;
            $detail->place_id = $request->place_id;
            $detail->url_vr = $request->url_vr;
            $detail->url_website = $request->url_website;
            $detail->phone = $request->phone;
            $detail->email = $request->email;
            $detail->opening_sunday = $request->opening_sunday;
            $detail->opening_moday = $request->opening_moday;
            $detail->opening_tuesday = $request->opening_tuesday;
            $detail->opening_wednesday = $request->opening_wednesday;
            $detail->opening_thursday = $request->opening_thursday;
            $detail->opening_friday = $request->opening_friday;
            $detail->opening_saturday = $request->opening_saturday;
            $detail->close_en = $request->close_en;
            $detail->close_ind = $request->close_ind;
            $detail->save();
        }catch (\Exception $exception){
            DB::rollback();
            return $exception;
        }
        DB::commit();
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
                    return redirect()->back();
                }

                $photo = helpers::uploadImage($request->file("photo"),date("Ymd").rand(100,999),"img/BE/content/".$category);
                if ($photo != true)
                {
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
                    'photo'=>$photo,
                    'category_ctn_id'=>$request->category_ctn_id,
                    'location'=>$request->location,
                    'short_description_en'=>$request->short_description_en,
                    'short_description_ind'=>$request->short_description_ind,
                    'long_description_en'=>$request->long_description_en,
                    'long_description_ind'=>$request->long_description_ind
                ]);

            content_detail_tbl::where('content_id',$id)
                ->update([
                    'address'=>$request->address,
                    'place_id'=>$request->place_id,
                    'url_vr'=>$request->url_vr,
                    'url_website'=>$request->url_website,
                    'phone'=>$request->phone,
                    'email'=>$request->email,
                    'opening_sunday'=>$request->opening_sunday,
                    'opening_moday'=>$request->opening_moday,
                    'opening_tuesday'=>$request->opening_tuesday,
                    'opening_wednesday'=>$request->opening_wednesday,
                    'opening_thursday'=>$request->opening_thursday,
                    'opening_friday'=>$request->opening_friday,
                    'opening_saturday'=>$request->opening_saturday,
                    'close_en'=>$request->close_en,
                    'close_ind'=>$request->close_ind,
                ]);
        }catch (\Exception $exception){
            DB::rollback();
            return $exception;
        }
        DB::commit();
        return redirect()->route('content-pages',['category'=>$category]);
    }

    public function content_delete($category,$id)
    {
        $category_id = category_content_tbl::select('id')->where('category',$category)->first()->id;
        content_tbl::where('id',$id)->where('category_ctn_id',$category_id)->update([
            'is_active'=>"N"
        ]);

        return redirect()->route('content-pages',['category'=>$category]);
    }

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
                return redirect()->back();
            }

            $photo = helpers::uploadImage($request->file("photo"),date("Ymd").rand(100,999),"img/BE/gallery");
            if ($photo != true)
            {
                return redirect()->back();
            }else{
                $photo = url('/img/BE/gallery/'.$photo);
            }
        }else{
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
}
