<?php

namespace App\Http\Controllers\BE;

use App\Helper\helpers;
use App\Model\content_gallery_tbl;
use App\Model\content_tbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Alert;

class GalleryController extends Controller
{
    public function gallery_pages()
    {
        if (auth('admin')->user()->is_admin_master == "Y") {
            $gallery = content_gallery_tbl::select(['content_gallery.*', 'institutional_id'])
                ->join('content', 'content.id', '=', 'content_gallery.content_id')
                ->get();
        } else {
            $gallery = content_gallery_tbl::select(['content_gallery.*', 'institutional_id'])
                ->join('content', 'content.id', '=', 'content_gallery.content_id')
                ->where('institutional_id', auth('admin')->user()->institutional_id)
                ->get();
        }
        return view('BE.pages.gallery.index', compact('gallery'));
    }

    public function gallery_add()
    {
        if (auth('admin')->user()->is_admin_master == "Y") {
            $content = content_tbl::select('id', 'name')->where('is_active', "Y")->get();
        } else {
            $content = content_tbl::listContent(auth('admin')->user()->institutional_id);
        }
        return view('BE.pages.gallery.add', compact('content'));
    }
    public function content_gallery_upload(Request $request)
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
        $simpan->content_id = $request->content_id;
        $simpan->photo = $photo;
        $simpan->save();

        return redirect()->route('gallery-pages');
    }
    public function content_gallery_delete($id)
    {
        // delete file storage
        $path = content_gallery_tbl::select('photo')->where('id',$id)->first()->photo;
        $file = substr($path, strrpos($path, '/') + 1);
        if(file_exists(public_path('img/BE/gallery/'.$file)))
        {
            unlink(public_path('img/BE/gallery/'.$file));
        }

        content_gallery_tbl::where('id',$id)->delete();
        return redirect()->route('gallery-pages');
    }
}
