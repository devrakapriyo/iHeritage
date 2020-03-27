@extends('BE.layout')
@section('users')
    active
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages_be.user_title')</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.user_add')</h6>
                    <a href="{{route('users-pages')}}" class="btn btn-success text-capitalize">@lang('messages_be.user_list')</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post" action="{{route('users-post')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('messages_be.user_input_name') : </label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email : </label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Phone : </label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        @php
                            $auth = auth('admin')->user();
                        @endphp
                        @if($auth->is_admin_master == "Y")
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('messages.home_select_heritage') : </label>
                                    <select class="form-control" name="institutional" required>
                                        <option value=""></option>
                                        @foreach(\App\Model\institutional::listInstitutional() as $items)
                                            <option value="{{$items->id}}">{{$items->institutional_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password : </label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Re-enter Password : </label>
                                    <input type="password" name="re_password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-info btn-block">SAVE</button>
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