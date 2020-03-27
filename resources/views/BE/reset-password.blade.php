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
            <form class="form-signin" action="{{url('reset-password/'.$role)}}" method="post">
                @csrf
                <p class="text-center">@lang('messages_be.reset_msg_text') {{$role}}</p>
                <div class="form-label-group">
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <label for="inputEmail">Email</label>
                </div>

                <button class="btn btn-lg btn-dark btn-block text-uppercase">@lang('messages.btn_reset_password')</button>
            </form>
        </div>
    </div>
@endsection