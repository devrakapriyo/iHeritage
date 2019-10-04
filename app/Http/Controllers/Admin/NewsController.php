<?php

namespace App\Http\Controllers\Admin;

use App\Helper\helpers;
use App\Model\admin_news_tbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Alert;

class NewsController extends Controller
{
    public function news_pages()
    {
        return view('BE.pages.adminNews.index');
    }

    public function news_get()
    {

        $data = admin_news_tbl::where('is_active', "Y");
        return DataTables::of($data)
            ->editColumn('banner', function ($data){
                return "<a href='".$data->banner."' class='btn btn-success btn-sm' target='_blank'>view banner</a>";
            })
            ->addColumn('action', function ($data) {
                $btn_edit = '<a href="'.route('news-edit', ['id'=>$data->id]).'" class="btn btn-warning">Edit</a>';
                $btn_hapus = '<a href="'.route('news-delete', ['id'=>$data->id]).'" class="btn btn-danger">Delete</a>';
                return "<div class='btn-group'>".$btn_edit." ".$btn_hapus."</div>";
            })
            ->rawColumns(['banner','action'])
            ->make(true);
    }

    public function news_add()
    {
        return view('BE.pages.adminNews.add');
    }

    public function news_post(Request $request)
    {
        if (!empty($request->file('banner')))
        {
            $valid = helpers::validationImage($request->file("banner"));
            if ($valid != true)
            {
                Alert::error("Validation banner not valid");
                return redirect()->back();
            }

            $banner = helpers::uploadImage($request->file("banner"),date("Ymd").rand(100,999),"img/Admin/news");
            if ($banner != true)
            {
                Alert::error("Banner failed to uploaded");
                return redirect()->back();
            }else{
                $banner = url('/img/Admin/news/'.$banner);
            }
        }else{
            $banner = 'https://via.placeholder.com/300';
        }

        $simpan = new admin_news_tbl;
        $simpan->title_en = $request->title_en;
        $simpan->title_ind = $request->title_ind;
        $simpan->description_en = $request->description_en;
        $simpan->description_ind = $request->description_ind;
        $simpan->banner = $banner;
        $simpan->is_active = "Y";
        $simpan->created_at = date("Y-m-d H:i:s");
        $simpan->save();

        Alert::success('News successfuly save');
        return redirect()->route('news-pages');
    }

    public function news_edit($id)
    {
        $data = admin_news_tbl::find($id);
        return view('BE.pages.adminNews.edit', compact('data','id'));
    }

    public function news_update(Request $request, $id)
    {
        if (!empty($request->file('banner')))
        {
            $valid = helpers::validationImage($request->file("banner"));
            if ($valid != true)
            {
                Alert::error("Validation banner not valid");
                return redirect()->back();
            }

            $banner = helpers::uploadImage($request->file("banner"),date("Ymd").rand(100,999),"img/Admin/news");
            if ($banner != true)
            {
                Alert::error("Banner failed to uploaded");
                return redirect()->back();
            }else{
                // delete file storage
                $path = admin_news_tbl::select('banner')->where('id',$id)->first()->banner;
                $file = substr($path, strrpos($path, '/') + 1);
                if(file_exists(public_path('img/Admin/news/'.$file)))
                {
                    unlink(public_path('img/Admin/news/'.$file));
                }

                $banner = url('/img/Admin/news/'.$banner);
            }
        }else{
            $banner = admin_news_tbl::select('banner')->where('id',$id)->first()->banner;
        }

        admin_news_tbl::where('id',$id)->update([
            'title_en'=>$request->title_en,
            'title_ind'=>$request->title_ind,
            'description_en'=>$request->description_en,
            'description_ind'=>$request->description_ind,
            'banner'=>$banner,
        ]);

        Alert::success('News successfuly updated');
        return redirect()->route('news-pages');
    }

    public function news_delete($id)
    {
        admin_news_tbl::where('id',$id)->update([
            'is_active'=>'N'
        ]);

        Alert::success('News nonactive');
        return redirect()->route('news-pages');
    }
}
