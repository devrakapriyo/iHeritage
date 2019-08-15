<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function dashboard()
    {
        return view('BE.pages.dashboard');
    }
}
