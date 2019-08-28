<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function login()
    {
        return view('BE.login');
    }

    public function login_action(Request $request)
    {
        if($request->email == "admin@iheritage.id" && $request->password == "admin!1" )
        {
            return redirect('dashboard');
        }else{
            return redirect('login');
        }
    }

    public function logout()
    {
        return redirect('/');
    }

    public function register()
    {
        return view('BE.register');
    }

    public function dashboard()
    {
        return view('BE.pages.dashboard');
    }
}
