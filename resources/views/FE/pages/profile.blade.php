@extends('FE.layout')
@section('content')

    <!-- Page Content -->
    <div class="container mt-5 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="text-uppercase">profil {{auth('visitor')->user()->name}}</span>
                </div>
                <div class="card-body">
                    <form action="{{url('profile-visitor')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>@lang('messages.full_name')</label>
                            <input type="text" name="name" class="form-control" value="{{auth('visitor')->user()->name}}" placeholder="Masukan nama lengkap anda..." required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{auth('visitor')->user()->email}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>@lang('messages.no_phone')</label>
                            <input type="text" class="form-control" value="{{auth('visitor')->user()->phone}}" readonly>
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
        <!-- /.row -->
    </div>
@endsection
@section('footer')
    {{--Custom script for sweetalert--}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection