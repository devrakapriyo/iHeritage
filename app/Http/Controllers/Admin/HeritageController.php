<?php

namespace App\Http\Controllers\Admin;

use App\Helper\helpers;
use App\Model\admin_heritage_tbl;
use App\Model\log_error;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Alert;
use DB;

class HeritageController extends Controller
{
    public function heritage_pages()
    {
        $data = admin_heritage_tbl::find(1);
        return view('BE.pages.admin', compact('data'));
    }

    public function heritage_update(Request $request, $id, $page)
    {
        DB::begintransaction();
        try{
            if($page == "home")
            {
                $field = [
                    'title_ind'=>$request->title_ind,
                    'title_en'=>$request->title_en,
                    'description_ind'=>$request->description_ind,
                    'description_en'=>$request->description_en,
                ];
            }else{
                if (!empty($request->file('banner')))
                {
                    $valid = helpers::validationImage($request->file("banner"));
                    if ($valid != true)
                    {
                        Alert::info('format banner not valid');
                        return redirect()->back();
                    }

                    $banner = helpers::uploadImage($request->file("banner"),date("Ymd").rand(100,999),"img/Admin");
                    if ($banner != true)
                    {
                        Alert::info('photo failed to upload');
                        return redirect()->back();
                    }else{
                        // delete file storage
                        $path = admin_heritage_tbl::select('banner')->where('id',$id)->first()->banner;
                        $file = substr($path, strrpos($path, '/') + 1);
                        if(file_exists(public_path('img/Admin/'.$file)))
                        {
                            unlink(public_path('img/Admin/'.$file));
                        }

                        $banner = url('/img/Admin/'.$banner);
                    }
                }else{
                    $banner = admin_heritage_tbl::select('banner')->where('id',$id)->first()->banner;
                }
                $field = [
                    'about_us_ind'=>$request->about_us_ind,
                    'about_us_en'=>$request->about_us_en,
                    'banner'=>$banner
                ];
            }
            admin_heritage_tbl::where('id',$id)
                ->update($field);
        }catch (\Exception $exception){
            DB::rollback();

            log_error::simpan($request->fullUrl(), $exception);
            Alert::warning("please contact admin");
            return redirect()->back();
        }
        DB::commit();

        Alert::success("updated successfuly");
        return redirect()->back();
    }
}
