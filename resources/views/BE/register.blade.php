@extends('BE.layout_register')
@section('title')
    @lang('messages.register_admin')
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
            <h3 class="mb-3 text-center">@lang('messages.register_admin')</h3>
            @if(Session::has('info'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    {{Session::get('info')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form class="form-signin" action="{{url('register')}}" method="post">
                @csrf
                <div class="form-label-group">
                    <input type="text" name="name" id="inputName" class="form-control" placeholder="Name" required autofocus>
                    <label for="inputName">Name</label>
                </div>

                <div class="form-label-group">
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <label for="inputEmail">Email address</label>
                </div>

                <div class="form-label-group">
                    <input type="text" name="phone" id="inputPhone" class="form-control" placeholder="Phone numbers" required autofocus>
                    <label for="inputPhone">Phone</label>
                </div>

                <div class="form-label-group">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <label for="inputPassword">Password</label>
                </div>

                <div class="form-label-group">
                    <input type="password" name="re_password" id="inputRePassword" class="form-control" placeholder="Re Password" required>
                    <label for="inputRePassword">Re Password</label>
                </div>

                <hr class="sidebar-divider d-none d-md-block">

                <div class="form-group">
                    <label for="inputInstitutional">Institutional Name</label>
                    <input type="text" name="institutional_name" id="inputInstitutional" class="form-control" required autofocus>
                </div>

                <div class="form-group">
                    <label for="inputCategory">Category</label>
                    <select name="category" class="form-control" id="inputCategory" required>
                        <option value=""></option>
                        <option value="museum">Museum</option>
                        <option value="library">Library</option>
                        <option value="gallery">Gallery</option>
                        <option value="archive">Archive</option>
                        <option value="temple">Temple</option>
                        <option value="palace">Palace</option>
                        <option value="natural-place">Natural Place</option>
                        <option value="historical-building">Historical Building</option>
                        <option value="personal-activities">Personal Activities</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputPlace">Province</label>
                    <select name="place_id" class="form-control" id="inputPlace" required>
                        <option value=""></option>
                        @foreach(\App\Model\place_tbl::listSearch() as $item)
                            <option value="{{$item->id}}">{{$item->place_en}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <textarea name="address" id="inputAddress" class="form-control" rows="5" required></textarea>
                </div>

                <button class="btn btn-lg btn-warning btn-block text-uppercase">@lang('messages.btn_register')</button>
                <hr class="my-4">
                <a href="{{url('login')}}" class="btn btn-lg btn-dark btn-block text-uppercase">@lang('messages.login_admin')</a>
            </form>
        </div>
    </div>
@endsection