@extends('BE.layout_register')
@section('title')
    @lang('messages.register_visitor')
@endsection
@section('content')
    <div class="card card-signin my-5">
        <div class="card-body">
            <!-- <h5 class="card-title text-center">Login</h5> -->
            <div class="d-flex justify-content-center mb-3">
                <a href="{{url('/')}}">
                    <img src="{{asset('bootstrap/vendor/iheritage.png')}}" style="width:200px;height:85px;">
                </a>
            </div>
            <h3 class="mb-3 text-center">@lang('messages.register_visitor')</h3>
            <form class="form-signin" action="{{url('register-visitor')}}" method="post">
                @csrf
                <div class="form-label-group">
                    <input type="text" name="name" id="inputName" class="form-control" placeholder="@lang('messages.full_name')" required autofocus>
                    <label for="inputName">@lang('messages.full_name')</label>
                </div>

                <div class="form-label-group">
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="@lang('messages.email_address')" required autofocus>
                    <label for="inputEmail">@lang('messages.email_address')</label>
                </div>

                <div class="form-label-group">
                    <input type="text" name="phone" id="inputPhone" class="form-control" placeholder="@lang('messages.no_phone')" required autofocus>
                    <label for="inputPhone">@lang('messages.no_phone')</label>
                </div>

                <div class="form-label-group">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <label for="inputPassword">Password</label>
                </div>

                <div class="form-label-group">
                    <input type="password" name="re_password" id="inputRePassword" class="form-control" placeholder="@lang('messages.re_password')" required>
                    <label for="inputRePassword">@lang('messages.re_password')</label>
                </div>

                <button class="btn btn-lg btn-warning btn-block text-uppercase">@lang('messages.register_visitor')</button>
                <hr class="sidebar-divider d-none d-md-block">
                <a href="{{url('login-visitor')}}" class="btn btn-lg btn-dark btn-block text-uppercase">@lang('messages.login_visitor')</a>
            </form>
        </div>
@endsection