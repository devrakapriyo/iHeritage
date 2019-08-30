<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\content_tbl;

class InterfaceController extends Controller
{
    public function home()
    {
        $museum = content_tbl::where('is_active', "Y")->orderBy('created_at', 'desc')->take(3)->get();
        return view('FE.pages.home', compact('museum'));
    }

    public function museum($museum_name, $id)
    {
        $museum = content_tbl::select('id', 'name')->where('is_active', "Y")->where('seo', $museum_name)->where('id', $id)->first();
        return view('FE.pages.museum');
    }

    public function heritagePlace()
    {
        return view('FE.pages.heritage-place');
    }

    public function vrTour()
    {
        return view('FE.pages.vr');
    }
}
