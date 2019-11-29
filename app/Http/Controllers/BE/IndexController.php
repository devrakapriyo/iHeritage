<?php

namespace App\Http\Controllers\BE;

use App\Model\category_content_tbl;
use App\Model\institutional;
use App\User;
use App\UserVisitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

use App\Model\users;

use Alert;
use Auth;

use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function login()
    {
        return view('BE.login');
    }
    public function login_action(Request $request)
    {
        $email = User::select('email')->where('email',$request->email)->first();
        if($email == true)
        {
            $auth = auth('admin');
            if ($auth->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('dashboard');
            } else {
                Alert::error('Password wrong');
                return redirect()->back();
            }
        }else{
            Alert::error('Account not registered');
            return redirect()->back();
        }

    }

    public function login_visitor()
    {
        return view('BE.login-visitor');
    }
    public function login_visitor_action(Request $request)
    {
        $email = UserVisitor::select('email')->where('email',$request->email)->first();
        if($email == true)
        {
            $auth = auth('visitor');
            if ($auth->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/');
            } else {
                Alert::error('Password wrong');
                return redirect()->back();
            }
        }else{
            Alert::error('Account not registered');
            return redirect()->back();
        }
    }

    public function logout()
    {
        auth('visitor')->logout();
        auth('admin')->logout();
        return redirect()->back();
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

        $instansi = new institutional;
        $instansi->institutional_name = $request->institutional_name;
        $instansi->address = $request->address;
        $instansi->place_id = $request->place_id;
        $instansi->email = $request->email;
        $instansi->phone = $request->phone;
        $instansi->category = $request->category;
        $instansi->is_active = "Y";
        $instansi->save();

        $simpan = new users;
        $simpan->name = $request->name;
        $simpan->email = $request->email;
        $simpan->phone = $request->phone;
        $simpan->password = Hash::make($request->password);
        $simpan->none_has_pass = $request->password;
        $simpan->institutional_id = $instansi->id;
        $simpan->is_admin = "Y";
        $simpan->is_active = "Y";
        $simpan->save();

        Mail::send('BE.email.register', [
            'name' => $simpan->name,
            'email' => $simpan->email,
            'password' => $simpan->none_has_pass,
            'role' => "Admin",
        ], function ($m) use ($simpan) {
            $m->from('info@iheritage.id', 'Info iHeritage ID');
            $m->to($simpan->email, $simpan->name)->subject('iHeritage.id - thank you for registering an account at iHeritage.id');
        });

        Alert::success('congratulations your account has been registered');
        return redirect()->back()->with('info', "congratulations your account has been registered");
    }

    public function register_visitor()
    {
        return view('BE.register-visitor');
    }
    public function register_visitor_post(Request $request)
    {
        $email = UserVisitor::select('email')->where('email',$request->email)->first();
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

        $simpan = new UserVisitor;
        $simpan->name = $request->name;
        $simpan->email = $request->email;
        $simpan->phone = $request->phone;
        $simpan->is_active = "Y";
        $simpan->password = Hash::make($request->password);
        $simpan->none_has_pass = $request->password;
        $simpan->save();

        $auth = auth('visitor');
        if ($auth->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            Mail::send('BE.email.register', [
                'name' => $simpan->name,
                'email' => $simpan->email,
                'password' => $simpan->none_has_pass,
                'role' => "Visitor",
            ], function ($m) use ($simpan) {
                $m->from('info@iheritage.id', 'Info iHeritage ID');
                $m->to($simpan->email, $simpan->name)->subject('iHeritage.id - thank you for registering an account at iHeritage.id');
            });

            Alert::success('success', 'congratulations your account has been registered');
            return redirect('/');
        } else {
            Alert::error('Opps something wrong');
            return redirect('/login-visitor');
        }
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
