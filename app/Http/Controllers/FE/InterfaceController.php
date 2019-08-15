<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InterfaceController extends Controller
{
    public function home()
    {
        return view('FE.pages.home');
    }

    public function museum()
    {
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
