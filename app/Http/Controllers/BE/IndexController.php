<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Model\users;

use Auth;

class IndexController extends Controller
{
    public function login()
    {
        return view('BE.login');
    }

    public function login_action(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function register()
    {
        return view('BE.register');
    }

    public function register_post(Request $request)
    {
        $simpan = new users;
        $simpan->name = $request->name;
        $simpan->email = $request->email;
        $simpan->phone = $request->phone;
        $simpan->password = Hash::make($request->password);
        $simpan->save();

        return redirect()->back()->with('info', "akun anda berhasil terdaftar");
    }

    public function dashboard()
    {
        return view('BE.pages.dashboard');
    }
}
