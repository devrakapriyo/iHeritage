<?php

namespace App\Http\Controllers\BE;

use App\Model\category_content_tbl;
use App\Model\institutional;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

use App\Model\users;

use Alert;
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
        $email = User::select('email')->where('email',$request->email)->first();
        if($email == true)
        {
            Alert::error('Email is already registered');
            return redirect()->back();
        }

        if($request->password != $request->re_password)
        {
            Alert::error('Password incorect');
            return redirect()->back();
        }

        $instansi = institutional::select('institutional_name')->where('institutional_name',$request->institutional_name)->first();
        if($instansi == true)
        {
            Alert::error('Institutional is already registered');
            return redirect()->back();
        }

        $simpan = new users;
        $simpan->name = $request->name;
        $simpan->email = $request->email;
        $simpan->phone = $request->phone;
        $simpan->password = Hash::make($request->password);
        $simpan->save();

        $instansi = new institutional;
        $instansi->institutional_name = $request->institutional_name;
        $instansi->address = $request->address;
        $instansi->place_id = $request->place_id;
        $instansi->email = $request->email;
        $instansi->phone = $request->phone;
        $instansi->category = $request->category;
        $instansi->save();

        return redirect()->back()->with('info', "akun anda berhasil terdaftar");
    }

    public function dashboard()
    {
        return view('BE.pages.dashboard');
    }

    public function category_content()
    {
        return view('BE.pages.category.index');
    }

    public function category_get()
    {
        $data = category_content_tbl::select(['*']);
        return Datatables::of($data)
            ->make(true);
    }

    public function category_add()
    {
        return view('BE.pages.category.add');
    }

    public function category_post(Request $request)
    {
        $simpan = new category_content_tbl;
        $simpan->category = $request->category;
        $simpan->category_ctn_name_en = $request->category_ctn_name_en;
        $simpan->category_ctn_name_ind = $request->category_ctn_name_ind;
        $simpan->save();

        return redirect()->back()->with('info', "kategori berhasil tersimpan");
    }
}
