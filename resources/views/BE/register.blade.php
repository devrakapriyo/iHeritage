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

                <hr class="sidebar-divider d-none d-md-block">

                <div class="form-group">
                    <label for="inputInstitutional">@lang('messages.institutional_name')</label>
                    <input type="text" name="institutional_name" id="inputInstitutional" class="form-control" required autofocus>
                </div>

                <div class="form-group">
                    <label for="inputCategory">@lang('messages.category')</label>
                    <select name="category" class="form-control" id="inputCategory" required>
                        <option value=""></option>
                        <option value="museum">@lang('messages.category_museum')</option>
                        <option value="library">@lang('messages.category_library')</option>
                        <option value="gallery">@lang('messages.category_gallery')</option>
                        <option value="archive">@lang('messages.category_archive')</option>
                        <option value="community">@lang('messages.category_community')</option>
                        <option value="temple">@lang('messages.category_temple')</option>
                        <option value="palace">@lang('messages.category_palace')</option>
                        <option value="nature">@lang('messages.category_natural_place')</option>
                        {{--<option value="historical-building">@lang('messages.category_historical_building')</option>--}}
                        <option value="personal-activities">@lang('messages.category_personal_activities')</option>
                        <option value="site">@lang('messages.category_site')</option>
                        <option value="education-institution">@lang('messages.category_education_institution')</option>
                        {{--<option value="ebook">@lang('messages.category_ebook')</option>--}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputPlace">@lang('messages.collection_place')</label>
                    <select name="place_id" class="form-control" id="inputPlace" required>
                        <option value=""></option>
                        @foreach(\App\Model\place_tbl::listSearch() as $item)
                            <option value="{{$item->id}}">{{App::isLocale('id') ? $item->place_ind : $item->place_en}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputAddress">@lang('messages.collection_address')</label>
                    <textarea name="address" id="inputAddress" class="form-control" rows="5" required></textarea>
                </div>

                <button class="btn btn-lg btn-warning btn-block text-uppercase">@lang('messages.btn_register')</button>
                <hr class="my-4">
                <a href="{{url('login')}}" class="btn btn-lg btn-dark btn-block text-uppercase">@lang('messages.login_admin')</a>
            </form>
        </div>
    </div>
@endsection