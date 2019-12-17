@extends('BE.layout')
@section('users')
    active
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">users management</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">edit user</h6>
                        @if(auth('admin')->user()->is_admin == "Y")
                            <a href="{{route('users-pages')}}" class="btn btn-success text-capitalize">list users</a>
                        @endif
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('users-update', ['id'=>$id])}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Institutional Name : </label>
                                        <input type="text" name="institutional_name" class="form-control" value="{{\App\Model\institutional::getData($data->institutional_id, "institutional_name")->institutional_name}}" {{auth('admin')->user()->is_admin_master == "Y" ? "" : "readonly"}} required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name : </label>
                                        <input type="text" name="name" class="form-control" value="{{$data->name}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email : </label>
                                        <input type="email" name="email" class="form-control" value="{{$data->email}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Phone Number : </label>
                                        <input type="text" name="phone" class="form-control" value="{{$data->phone}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password : </label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Re-enter Password : </label>
                                        <input type="password" name="re_password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-info btn-block">UPDATE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection