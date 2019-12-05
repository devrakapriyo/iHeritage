<?php

namespace App\Http\Controllers\BE;

use App\Helper\helpers;
use App\Model\content_edu_tbl;
use App\Model\content_tbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class EduController extends Controller
{
    public function edu_page()
    {
        return view('BE.pages.edu.index');
    }

    public function edu_get()
    {
        if(auth('admin')->user()->is_admin_master == "Y")
        {
            $data = content_edu_tbl::select(['content_edu_program.*', 'content.name', 'place.place_ind', 'is_publish'])
                ->join('content', 'content.id', '=', 'content_edu_program.content_id')
                ->join('place', 'place.id', '=', 'content_edu_program.place_id');
        }else{
            $data = content_edu_tbl::select(['content_edu_program.*', 'content.name', 'place.place_ind', 'is_publish'])
                ->join('content', 'content.id', '=', 'content_edu_program.content_id')
                ->join('place', 'place.id', '=', 'content_edu_program.place_id')
                ->where('institutional_id', auth('admin')->user()->institutional_id)
                ->where('content_edu_program.is_active', "Y");
        }
        return DataTables::of($data)
            ->editColumn('description_en', function ($data){
                $substr = substr($data->description_en, 0, 100);
                return $substr."<a href='".route('edu-edit', ['id'=>$data->id])."'>...readmore</a>";
            })
            ->editColumn('description_ind', function ($data){
                $substr = substr($data->description_ind, 0, 100);
                return $substr."<a href='".route('edu-edit', ['id'=>$data->id])."'>...readmore</a>";
            })
            ->addColumn('action', function ($data) {
                $btn_edit = '<a href="'.route('edu-edit', ['id'=>$data->id]).'" class="btn btn-xs btn-warning">Edit</a>';
                $btn_hapus = '<a href="'.route('edu-delete', ['id'=>$data->id]).'" class="btn btn-xs btn-danger">Hapus</a>';
                $btn_approve = '<a href="'.route('edu-approve', ['id'=>$data->id]).'" class="btn btn-xs btn-primary">Approve</a>';

                if(auth('admin')->user()->is_admin_master == "Y")
                {
                    if($data->is_publish == "N")
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
            ->rawColumns(['description_en','description_ind','action'])
            ->make(true);
    }

    public function edu_add()
    {
        if (auth('admin')->user()->is_admin_master == "Y") {
            $content = content_tbl::select('id', 'name')->where('is_active', "Y")->get();
        } else {
            $content = content_tbl::listContent(auth('admin')->user()->institutional_id);
        }
        return view('BE.pages.edu.add', compact('content'));
    }

    public function edu_post(Request $request)
    {
        DB::begintransaction();
        try{
            if (!empty($request->file('banner')))
            {
                $valid = helpers::validationImage($request->file("banner"));
                if ($valid != true)
                {
                    return redirect()->back();
                }

                $banner = helpers::uploadImage($request->file("banner"),date("Ymd").rand(100,999),"img/BE/edu");
                if ($banner != true)
                {
                    return redirect()->back();
                }else{
                    $banner = url('/img/BE/edu/'.$banner);
                }
            }else{
                $banner = 'https://via.placeholder.com/300';
            }

            $simpan = new content_edu_tbl;
            $simpan->content_id = $request->content_id;
            $simpan->banner = $banner;
            $simpan->name = $request->name;
            $simpan->seo = Str::slug($request->name);
            $simpan->description_en = $request->description_en;
            $simpan->description_ind = $request->description_ind;
            $simpan->opening_sunday = $request->opening_sunday;
            $simpan->opening_monday = $request->opening_monday;
            $simpan->opening_tuesday = $request->opening_tuesday;
            $simpan->opening_wednesday = $request->opening_wednesday;
            $simpan->opening_thursday = $request->opening_thursday;
            $simpan->opening_friday = $request->opening_friday;
            $simpan->opening_saturday = $request->opening_saturday;
            $simpan->close_en = $request->close_en;
            $simpan->close_ind = $request->close_ind;
            $simpan->place_id = $request->place_id;
            $simpan->map_area_detail = $request->map_area_detail;
            $simpan->latitude_detail = $request->latitude_detail;
            $simpan->longitude_detail = $request->longitude_detail;
            $simpan->is_active = "Y";
            $simpan->created_by = auth('admin')->user()->name;
            $simpan->save();

        }catch (\Exception $exception){
            DB::rollback();
            return $exception;
        }
        DB::commit();
        return redirect()->route('edu-page');
    }

    public function edu_edit($id)
    {
        $detail = content_edu_tbl::where('id',$id)->first();
        return view('BE.pages.edu.edit', compact('id','detail'));
    }

    public function edu_update(Request $request,$id)
    {
        DB::begintransaction();
        try{
            if (!empty($request->file('banner')))
            {
                $valid = helpers::validationImage($request->file("banner"));
                if ($valid != true)
                {
                    return redirect()->back();
                }

                $banner = helpers::uploadImage($request->file("banner"),date("Ymd").rand(100,999),"img/BE/edu");
                if ($banner != true)
                {
                    return redirect()->back();
                }else{
                    // delete file storage
                    $path = content_edu_tbl::select('banner')->where('id',$id)->first()->banner;
                    $file = substr($path, strrpos($path, '/') + 1);
                    if(file_exists(public_path('img/BE/edu/'.$file)))
                    {
                        unlink(public_path('img/BE/edu/'.$file));
                    }

                    $banner = url('/img/BE/edu/'.$banner);
                }
            }else{
                $banner = content_edu_tbl::select('banner')->where('id',$id)->first()->banner;
            }

            content_edu_tbl::where('id',$id)
                ->update([
                    'banner'=>$banner,
                    'place_id'=>$request->place_id,
                    'map_area_detail'=>$request->map_area_detail,
                    'latitude_detail'=>$request->latitude_detail,
                    'longitude_detail'=>$request->longitude_detail,
                    'description_en'=>$request->description_en,
                    'description_ind'=>$request->description_ind,
                    'opening_sunday'=>$request->opening_sunday,
                    'opening_monday'=>$request->opening_monday,
                    'opening_tuesday'=>$request->opening_tuesday,
                    'opening_wednesday'=>$request->opening_wednesday,
                    'opening_thursday'=>$request->opening_thursday,
                    'opening_friday'=>$request->opening_friday,
                    'opening_saturday'=>$request->opening_saturday,
                    'close_en'=>$request->close_en,
                    'close_ind'=>$request->close_ind
                ]);

        }catch (\Exception $exception){
            DB::rollback();
            return $exception;
        }
        DB::commit();
        return redirect()->route('edu-page');
    }

    public function edu_delete($id)
    {
        content_edu_tbl::where('id',$id)->update([
            'is_active'=>"N"
        ]);

        return redirect()->route('edu-page');
    }

    public function edu_approve($id)
    {
        content_edu_tbl::where('id',$id)->update([
            'is_publish'=>"Y"
        ]);

        return redirect()->route('edu-page');
    }
}
