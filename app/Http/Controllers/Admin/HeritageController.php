<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin_heritage_tbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Alert;

class HeritageController extends Controller
{
    public function heritage_pages()
    {
        $data = admin_heritage_tbl::find(1);
        return view('BE.pages.admin', compact('data'));
    }

    public function heritage_update(Request $request, $id, $page)
    {
        if($page == "home")
        {
            $field = [
                'title_ind'=>$request->title_ind,
                'title_en'=>$request->title_en,
                'description_ind'=>$request->description_ind,
                'description_en'=>$request->description_en,
            ];
        }else{
            $field = [
                'about_us_ind'=>$request->about_us_ind,
                'about_us_en'=>$request->about_us_en,
            ];
        }
        admin_heritage_tbl::where('id',$id)
            ->update($field);

        Alert::success("updated successfuly");
        return redirect()->back();
    }
}
