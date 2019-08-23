<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\FE\museum_tbl;

class InterfaceController extends Controller
{
    public function home()
    {
        $museum = museum_tbl::where('is_active', 1)->orderBy('created_at', 'desc')->take(3)->get();
        return view('FE.pages.home', compact('museum'));
    }

    public function museum($museum_name, $id)
    {
        $museum = museum_tbl::select('id', 'name')->where('is_active', 1)->where('seo', $museum_name)->where('id', $id)->first();
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
