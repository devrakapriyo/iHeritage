@extends('BE.layout_login')
@section('title')
    @lang('messages.login_visitor')
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
            <form class="form-signin" action="{{url('login-visitor')}}" method="post">
                @csrf
                <div class="form-label-group">
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <label for="inputEmail">Email address</label>
                </div>

                <div class="form-label-group">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <label for="inputPassword">Password</label>
                </div>

                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>
                <button class="btn btn-lg btn-warning btn-block text-uppercase">@lang('messages.login_visitor')</button>
                <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
                <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
                <a href="{{url('register-visitor')}}" class="btn btn-lg btn-dark btn-block text-uppercase">@lang('messages.register_visitor')</a>
                <hr class="my-4">
                <a href="{{url('register')}}" class="btn btn-lg btn-primary btn-block text-uppercase">@lang('messages.register_admin')</a>
            </form>
        </div>
    </div>
@endsection