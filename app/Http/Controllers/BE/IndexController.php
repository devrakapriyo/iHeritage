<?php

namespace App\Http\Controllers\BE;

use App\Model\category_content_tbl;
use App\Model\content_detail_tbl;
use App\Model\content_tbl;
use App\Model\institutional;
use App\Model\log_error;
use App\Model\visitor_counting;
use App\User;
use App\UserVisitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

use App\Model\users;

use Alert;
use Auth;
use DB;

use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function login()
    {
        return view('BE.login');
    }
    public function login_action(Request $request)
    {
        $email = User::select('email')->where('email',$request->email)->where('is_active', "Y")->first();
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

    public function login_visitor_vr($content_id)
    {
        //return view('BE.login-visitor-vr', compact('content_id'));

        $url = content_detail_tbl::select('url_vr')->where('content_id', $content_id)->first()->url_vr;
        visitor_counting::simpan(institutional::getId(content_tbl::fieldContent($content_id, 'institutional_id')), $_SERVER['REMOTE_ADDR'], "content", $url);
        return redirect($url);
    }
    public function login_visitor_vr_action(Request $request, $content_id)
    {
        $email = UserVisitor::select('email')->where('email',$request->email)->first();
        if($email == true)
        {
            $auth = auth('visitor');
            if ($auth->attempt(['email' => $request->email, 'password' => $request->password])) {
                if($content_id == "all")
                {
                    return redirect('vr-tour');
                }else{
                    $url = content_detail_tbl::select('url_vr')->where('content_id', $content_id)->first()->url_vr;
                    return redirect($url);
                }
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
        DB::begintransaction();
        try{
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
            $instansi->save();

            $simpan = new users;
            $simpan->name = $request->name;
            $simpan->email = $request->email;
            $simpan->phone = $request->phone;
            $simpan->password = Hash::make($request->password);
            $simpan->none_has_pass = $request->password;
            $simpan->institutional_id = $instansi->id;
            $simpan->is_admin = "Y";
            $simpan->save();

            Mail::send('BE.email.register', [
                'name' => $simpan->name,
                'email' => $simpan->email,
                'password' => $simpan->none_has_pass,
                'role' => "Admin",
                'link' => url('login'),
                'active' => "N"
            ], function ($m) use ($simpan) {
                $m->from('info@iheritage.id', 'Info iHeritage ID');
                $m->to($simpan->email, $simpan->name)->subject('iHeritage.id - thank you for registering an account at iHeritage.id');
            });
        }catch (\Exception $exception){
            DB::rollback();

            log_error::simpan($request->fullUrl(), $exception);
            Alert::warning("please contact admin");
            return redirect()->back();
        }
        DB::commit();

        Alert::success('congratulations your account has been saved, please wait for admin confirmation to activate the account');
        return redirect()->back()->with('info', "congratulations your account has been saved, please wait for admin confirmation to activate the account");
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
                'link' => url('login-visitor'),
                'active' => "Y"
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

    public function profileAdmin()
    {
        return view('BE.pages.profile');
    }

    public function profileAdminPost(Request $request)
    {
        if($request->password)
        {
            if($request->password != $request->re_password)
            {
                if(App::isLocale('id'))
                {
                    Alert::error("Password yang anda masukan tidak sama");
                }else{
                    Alert::error("The password you entered is not the same");
                }
                return redirect()->back();
            }

            $update_field = [
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'none_has_pass' => $request->password,
            ];

            $data = User::find(auth('admin')->user()->id);
            Mail::send('FE.email.password', [
                'name' => $request->name,
                'password' => $request->password
            ], function ($m) use ($request, $data){
                $m->from('info@iheritage.id', 'Info iHeritage ID');
                $m->to($data->email, $request->name)->subject('iHeritage.id - change password account visitor');
            });
        }else{
            $update_field = [
                'name' => $request->name
            ];
        }

        User::where('id', auth('admin')->user()->id)->update($update_field);
        if(App::isLocale('id'))
        {
            Alert::success("Profil berhasil diperbarui");
        }else{
            Alert::success("Profile updated successfully");
        }
        return redirect()->back();
    }
}
