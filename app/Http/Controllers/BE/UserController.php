<?php

namespace App\Http\Controllers\BE;

use App\Model\institutional;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Alert;

class UserController extends Controller
{
    public function users_pages()
    {
        return view('BE.pages.usersManagement.index');
    }

    public function users_get()
    {

        if(auth('admin')->user()->is_admin_master == "Y")
        {
            $data = User::select(['user_admin.*', 'institutional.institutional_name'])
                ->join('institutional', 'institutional.id', '=', 'user_admin.institutional_id')
                ->orderBy('user_admin.updated_at', "DESC");
        }else{
            $data = User::select(['user_admin.*', 'institutional.institutional_name'])
                ->join('institutional', 'institutional.id', '=', 'user_admin.institutional_id')
                ->where('institutional_id', auth('admin')->user()->institutional_id)
                ->where('user_admin.is_active', "Y")
                ->where('user_admin.is_delete', "N")
                ->orderBy('user_admin.updated_at', "DESC");
        }
        return DataTables::of($data)
            ->editColumn('institutional_name', function ($data){
                return "<span class='btn btn-success btn-sm'><a class='text-white' href='".route('users-institutional', ['id'=>$data->id])."'>".$data->institutional_name."</a></span>";
            })
            ->editColumn('is_admin', function ($data){
                return $data->is_admin == "Y" ? "Admin" : "";
            })
            ->addColumn('action', function ($data) {
                $btn_edit = '<a href="'.route('users-edit', ['id'=>$data->id]).'" class="btn btn-warning">Edit</a>';
                $btn_hapus = '<a onclick="return confirm(\'Are you sure you want to delete this data?\');" href="'.route('users-delete', ['id'=>$data->id]).'" class="btn btn-danger">Delete</a>';
                $btn_active = '<a href="'.route('users-institutional', ['id'=>$data->id]).'" class="btn btn-success">Activate Account</a>';
                if((auth('admin')->user()->is_admin == "Y") || (auth('admin')->user()->is_admin_master == "Y"))
                {
                    if($data->is_delete == "N")
                    {
                        if($data->is_active == "N")
                        {
                            return "<div class='btn-group'>".$btn_active." ".$btn_edit." ".$btn_hapus."</div>";
                        }else{
                            return "<div class='btn-group'>".$btn_edit." ".$btn_hapus."</div>";
                        }
                    }else{
                        return "<span class='badge badge-danger'>DELETED</span>";
                    }
                }
            })
            ->rawColumns(['institutional_name','action'])
            ->make(true);
    }

    public function users_add()
    {
        return view('BE.pages.usersManagement.add');
    }

    public function users_post(Request $request)
    {
        $data = User::select('id')->where('institutional_id',auth('admin')->user()->is_admin_master == "Y" ? $request->institutional : auth('admin')->user()->institutional_id)->count();
        if($data > 4)
        {
            Alert::error('Limit user only 3 account admin');
            return redirect()->back();
        }

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

        $simpan = new User;
        $simpan->name = $request->name;
        $simpan->email = $request->email;
        $simpan->phone = $request->phone;
        $simpan->password = Hash::make($request->password);
        $simpan->none_has_pass = $request->password;
        $simpan->institutional_id = auth('admin')->user()->is_admin_master == "Y" ? $request->institutional : auth('admin')->user()->institutional_id;
        $simpan->is_active = "Y";
        $simpan->created_at = date("Y-m-d H:i:s");
        $simpan->save();

        Alert::success('User active');
        return redirect()->route('users-pages');
    }

    public function users_edit($id)
    {
        $data = User::find($id);
        return view('BE.pages.usersManagement.edit', compact('data','id'));
    }

    public function users_update(Request $request, $id)
    {
        if((!empty($request->password)) && (!empty($request->re_password)))
        {
            if($request->password != $request->re_password)
            {
                Alert::error('Password incorect');
                return redirect()->back();
            }
        }

        //if(institutional::where('institutional_name', $request->institutional_name)->first())
        //{
        //    Alert::error('institutional name available');
        //    return redirect()->back();
        //}

        $data = User::where('id',$id);
        $data->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'password'=>$request->password ? Hash::make($request->password) : User::select('password')->where('id',$id)->first()->password,
            'none_has_pass'=>$request->password ? $request->password : User::select('none_has_pass')->where('id',$id)->first()->none_has_pass,
        ]);

        if(auth('admin')->user()->is_admin_master == "Y")
        {
            institutional::where('id', $data->first()->institutional_id)->update([
                'institutional_name'=>$request->institutional_name
            ]);
        }

        Alert::success('User update');
        return redirect()->route('users-pages');
    }

    public function users_delete($id)
    {
        $data = User::where('id',$id);
        if(($data->first()->is_admin_master == "Y"))
        {
            Alert::error('User cannot to delete');
            return redirect()->back();
        }

        $data->update([
            'is_delete'=>'Y'
        ]);

        Alert::success('User nonactive');
        return redirect()->route('users-pages');
    }

    public function users_active($id)
    {
        $data = User::where('id',$id);

        $data->update([
            'is_active'=>"Y"
        ]);

        institutional::where('id', $data->first()->institutional_id)
            ->update([
                'is_active'=>"Y"
            ]);

        Mail::send('BE.email.register', [
            'name' => $data->first()->name,
            'email' => $data->first()->email,
            'password' => $data->first()->none_has_pass,
            'role' => "Admin",
            'link' => url('login'),
            'active' => "Y"
        ], function ($m) use ($data) {
            $m->from('info@iheritage.id', 'Info iHeritage ID');
            $m->to($data->first()->email, $data->first()->name)->subject('iHeritage.id - account activation');
        });

        Alert::success('Congratulations account has been active');
        return redirect()->route('users-pages');
    }

    public function users_institutional($id)
    {
        $data = institutional::find(User::select('institutional_id')->where('id', $id)->first()->institutional_id);
        return view('BE.pages.usersManagement.institutional', compact('id', 'data'));
    }
}
