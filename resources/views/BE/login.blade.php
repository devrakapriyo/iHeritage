@extends('BE.layout_login')
@section('title')
    @lang('messages.login_admin')
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
            <form class="form-signin" action="{{url('login')}}" method="post">
                @csrf
                <div class="form-label-group">
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <label for="inputEmail">Email address</label>
                </div>

                <div class="form-label-group">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <label for="inputPassword">Password</label>
                </div>

                <div class="mb-3 text-center">
                    <a href="{{url('reset-password/admin')}}" target="_blank">forgot the password? clik here...</a>
                </div>
                <button class="btn btn-lg btn-warning btn-block text-uppercase">@lang('messages.login_admin')</button>
                <!-- <hr class="my-4"> -->
                <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
                <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
                <a href="{{url('register')}}" class="btn btn-lg btn-dark btn-block text-uppercase">@lang('messages.register_admin')</a>
            </form>
        </div>
    </div>
@endsection