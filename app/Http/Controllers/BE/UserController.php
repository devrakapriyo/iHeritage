<?php

namespace App\Http\Controllers\BE;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
                ->where('user_admin.is_active', "Y");
        }else{
            $data = User::select(['user_admin.*', 'institutional.institutional_name'])
                ->join('institutional', 'institutional.id', '=', 'user_admin.institutional_id')
                ->where('institutional_id', auth('admin')->user()->institutional_id)
                ->where('user_admin.is_active', "Y");
        }
        return DataTables::of($data)
            ->editColumn('institutional_name', function ($data){
                return "<span class='btn btn-success btn-sm'>".$data->institutional_name."</span>";
            })
            ->editColumn('is_admin', function ($data){
                return $data->is_admin == "Y" ? "Admin" : "";
            })
            ->addColumn('action', function ($data) {
                $btn_edit = '<a href="'.route('users-edit', ['id'=>$data->id]).'" class="btn btn-warning">Edit</a>';
                $btn_hapus = '<a href="'.route('users-delete', ['id'=>$data->id]).'" class="btn btn-danger">Hapus</a>';
                if((auth('admin')->user()->is_admin == "Y") || (auth('admin')->user()->is_admin_master == "Y"))
                {
                    return "<div class='btn-group'>".$btn_edit." ".$btn_hapus."</div>";
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

        User::where('id',$id)->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'password'=>$request->password ? Hash::make($request->password) : User::select('password')->where('id',$id)->first()->password,
            'none_has_pass'=>$request->password ? $request->password : User::select('password')->where('id',$id)->first()->none_has_pass,
        ]);

        Alert::success('User update');
        return redirect()->route('users-pages');
    }

    public function users_delete($id)
    {
        $data = User::where('id',$id);
        if(($data->first()->is_admin == "Y") || ($data->first()->is_admin_master == "Y"))
        {
            Alert::error('User cannot to delete');
            return redirect()->back();
        }

        $data->update([
            'is_active'=>'N'
        ]);

        Alert::success('User nonactive');
        return redirect()->route('users-pages');
    }
}
