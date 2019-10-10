<?php

namespace App\Http\Controllers\Admin;

use App\Helper\helpers;
use App\Model\admin_our_services_tbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Alert;

class OurServicesController extends Controller
{
    public function our_services_pages()
    {
        return view('BE.pages.adminOurServices.index');
    }

    public function our_services_get()
    {

        $data = admin_our_services_tbl::where('is_active', "Y");
        return DataTables::of($data)
            ->editColumn('banner', function ($data){
                return "<a href='".$data->banner."' class='btn btn-success btn-sm' target='_blank'>view banner</a>";
            })
            ->addColumn('action', function ($data) {
                $btn_edit = '<a href="'.route('our-services-edit', ['id'=>$data->id]).'" class="btn btn-warning">Edit</a>';
                $btn_hapus = '<a href="'.route('our-services-delete', ['id'=>$data->id]).'" class="btn btn-danger">Delete</a>';
                return "<div class='btn-group'>".$btn_edit." ".$btn_hapus."</div>";
            })
            ->rawColumns(['banner','action'])
            ->make(true);
    }

    public function our_services_add()
    {
        return view('BE.pages.adminOurServices.add');
    }

    public function our_services_post(Request $request)
    {
        if (!empty($request->file('banner')))
        {
            $valid = helpers::validationImage($request->file("banner"));
            if ($valid != true)
            {
                return redirect()->back();
            }

            $banner = helpers::uploadImage($request->file("banner"),date("Ymd").rand(100,999),"img/Admin/our_services");
            if ($banner != true)
            {
                return redirect()->back();
            }else{
                $banner = url('/img/Admin/our_services/'.$banner);
            }
        }else{
            $banner = 'https://via.placeholder.com/300';
        }

        $simpan = new admin_our_services_tbl;
        $simpan->title_en = $request->title_en;
        $simpan->title_ind = $request->title_ind;
        $simpan->description_en = $request->description_en;
        $simpan->description_ind = $request->description_ind;
        $simpan->banner = $banner;
        $simpan->is_active = "Y";
        $simpan->created_at = date("Y-m-d H:i:s");
        $simpan->save();

        Alert::success('Service successfuly save');
        return redirect()->route('our-services-pages');
    }

    public function our_services_edit($id)
    {
        $data = admin_our_services_tbl::find($id);
        return view('BE.pages.adminOurServices.edit', compact('data','id'));
    }

    public function our_services_update(Request $request, $id)
    {
        if (!empty($request->file('banner')))
        {
            $valid = helpers::validationImage($request->file("banner"));
            if ($valid != true)
            {
                return redirect()->back();
            }

            $banner = helpers::uploadImage($request->file("banner"),date("Ymd").rand(100,999),"img/Admin/our_services");
            if ($banner != true)
            {
                return redirect()->back();
            }else{
                // delete file storage
                $path = admin_our_services_tbl::select('banner')->where('id',$id)->first()->banner;
                $file = substr($path, strrpos($path, '/') + 1);
                if(file_exists(public_path('img/Admin/our_services/'.$file)))
                {
                    unlink(public_path('img/Admin/our_services/'.$file));
                }

                $banner = url('/img/Admin/our_services/'.$banner);
            }
        }else{
            $banner = admin_our_services_tbl::select('banner')->where('id',$id)->first()->banner;
        }

        admin_our_services_tbl::where('id',$id)->update([
            'title_en'=>$request->title_en,
            'title_ind'=>$request->title_ind,
            'description_en'=>$request->description_en,
            'description_ind'=>$request->description_ind,
            'banner'=>$banner,
        ]);

        Alert::success('Service successfuly updated');
        return redirect()->route('our-services-pages');
    }

    public function our_services_delete($id)
    {
        admin_our_services_tbl::where('id',$id)->update([
            'is_active'=>'N'
        ]);

        Alert::success('Service nonactive');
        return redirect()->route('our-services-pages');
    }
}