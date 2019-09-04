<?php

namespace App\Http\Controllers\BE;

use App\Helper\helpers;
use App\Model\content_edu_tbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $data = content_edu_tbl::select(['content_edu_program.*', 'content.name', 'place.place_ind'])
            ->join('content', 'content.id', '=', 'content_edu_program.content_id')
            ->join('place', 'place.id', '=', 'content_edu_program.place_id')
            ->where('users_id', Auth::user()->id)
            ->where('content_edu_program.is_active', "Y");
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $btn_edit = '<a href="'.route('edu-edit', ['id'=>$data->id]).'" class="btn btn-xs btn-warning">Edit</a>';
                $btn_hapus = '<a href="'.route('edu-delete', ['id'=>$data->id]).'" class="btn btn-xs btn-danger">Hapus</a>';
                return "<div class='btn-group'>".$btn_edit." ".$btn_hapus."</div>";
            })
            ->make(true);
    }

    public function edu_add()
    {
        return view('BE.pages.edu.add');
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
            $simpan->opening_moday = $request->opening_moday;
            $simpan->opening_tuesday = $request->opening_tuesday;
            $simpan->opening_wednesday = $request->opening_wednesday;
            $simpan->opening_thursday = $request->opening_thursday;
            $simpan->opening_friday = $request->opening_friday;
            $simpan->opening_saturday = $request->opening_saturday;
            $simpan->close_en = $request->close_en;
            $simpan->close_ind = $request->close_ind;
            $simpan->place_id = $request->place_id;
            $simpan->is_active = "Y";
            $simpan->save();

        }catch (\Exception $exception){
            DB::rollback();
            return $exception;
        }
        DB::commit();
        return redirect()->route('edu-page');
    }

    public function event_edit($id)
    {
        $detail = content_edu_tbl::where('id',$id)->first();
        return view('BE.pages.edu.edit', compact('id','detail'));
    }

    public function event_update(Request $request,$id)
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
                    'description_en'=>$request->description_en,
                    'description_ind'=>$request->description_ind,
                    'opening_sunday'=>$request->opening_sunday,
                    'opening_moday'=>$request->opening_moday,
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

    public function event_delete($id)
    {
        content_edu_tbl::where('id',$id)->update([
            'is_active'=>"N"
        ]);

        return redirect()->route('edu-page');
    }
}
