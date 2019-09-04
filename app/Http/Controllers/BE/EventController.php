<?php

namespace App\Http\Controllers\BE;

use App\Helper\helpers;
use App\Model\content_event_tbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{
    public function event_page()
    {
        return view('BE.pages.event.index');
    }

    public function event_get()
    {
        $data = content_event_tbl::select(['content_event.*', 'content.name', 'place.place_ind'])
            ->join('content', 'content.id', '=', 'content_event.content_id')
            ->join('place', 'place.id', '=', 'content_event.place_id')
            ->where('users_id', Auth::user()->id)
            ->where('content_event.is_active', "Y");
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $btn_edit = '<a href="'.route('event-edit', ['id'=>$data->id]).'" class="btn btn-xs btn-warning">Edit</a>';
                $btn_hapus = '<a href="'.route('event-delete', ['id'=>$data->id]).'" class="btn btn-xs btn-danger">Hapus</a>';
                return "<div class='btn-group'>".$btn_edit." ".$btn_hapus."</div>";
            })
            ->make(true);
    }

    public function event_add()
    {
        return view('BE.pages.event.add');
    }

    public function event_post(Request $request)
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

                $banner = helpers::uploadImage($request->file("banner"),date("Ymd").rand(100,999),"img/BE/event");
                if ($banner != true)
                {
                    return redirect()->back();
                }else{
                    $banner = url('/img/BE/event/'.$banner);
                }
            }else{
                $banner = 'https://via.placeholder.com/300';
            }

            $simpan = new content_event_tbl;
            $simpan->content_id = $request->content_id;
            $simpan->banner = $banner;
            $simpan->name = $request->name;
            $simpan->seo = Str::slug($request->name);
            $simpan->place_id = $request->place_id;
            $simpan->start_date = $request->start_date;
            $simpan->end_date = $request->end_date;
            $simpan->short_description_en = $request->short_description_en;
            $simpan->short_description_ind = $request->short_description_ind;
            $simpan->long_description_en = $request->long_description_en;
            $simpan->long_description_ind = $request->long_description_ind;
            $simpan->price = $request->price;
            $simpan->close_registration = $request->close_registration;
            $simpan->is_active = "Y";
            $simpan->save();

        }catch (\Exception $exception){
            DB::rollback();
            return $exception;
        }
        DB::commit();
        return redirect()->route('event-page');
    }

    public function event_edit($id)
    {
        $detail = content_event_tbl::where('id',$id)->first();
        return view('BE.pages.event.edit', compact('id','detail'));
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

                $banner = helpers::uploadImage($request->file("banner"),date("Ymd").rand(100,999),"img/BE/event");
                if ($banner != true)
                {
                    return redirect()->back();
                }else{
                    // delete file storage
                    $path = content_event_tbl::select('banner')->where('id',$id)->first()->banner;
                    $file = substr($path, strrpos($path, '/') + 1);
                    if(file_exists(public_path('img/BE/event/'.$file)))
                    {
                        unlink(public_path('img/BE/event/'.$file));
                    }

                    $banner = url('/img/BE/event/'.$banner);
                }
            }else{
                $banner = content_event_tbl::select('banner')->where('id',$id)->first()->banner;
            }

            content_event_tbl::where('id',$id)
                ->update([
                    'banner'=>$banner,
                    'place_id'=>$request->place_id,
                    'start_date'=>$request->start_date,
                    'end_date'=>$request->end_date,
                    'short_description_en'=>$request->short_description_en,
                    'short_description_ind'=>$request->short_description_ind,
                    'long_description_en'=>$request->long_description_en,
                    'long_description_ind'=>$request->long_description_ind,
                    'price'=>$request->price,
                    'close_registration'=>$request->close_registration
                ]);
        }catch (\Exception $exception){
            DB::rollback();
            return $exception;
        }
        DB::commit();
        return redirect()->route('event-page');
    }

    public function event_delete($id)
    {
        content_event_tbl::where('id',$id)->update([
            'is_active'=>"N"
        ]);

        return redirect()->route('event-page');
    }
}
