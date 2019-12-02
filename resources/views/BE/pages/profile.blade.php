@extends('BE.layout')
@section('heritage')
    active
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">Admin Heritage</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">Profile</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('profile-post')}}">
                            @csrf
                            <div class="form-group">
                                <label>@lang('messages.full_name')</label>
                                <input type="text" name="name" class="form-control" value="{{auth('admin')->user()->name}}" placeholder="Masukan nama lengkap anda..." required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" value="{{auth('admin')->user()->email}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>@lang('messages.no_phone')</label>
                                <input type="text" class="form-control" value="{{auth('admin')->user()->phone}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="@lang('messages.placeholder_password')">
                            </div>
                            <div class="form-group">
                                <label>@lang('messages.re_password')</label>
                                <input type="password" name="re_password" class="form-control">
                            </div>
                            <button class="btn btn-warning float-right">@lang('messages.button_update')</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('footer')

@endsection