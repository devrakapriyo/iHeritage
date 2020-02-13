@extends('FE.layout')
@section('home')
    active
@endsection
@section('content')
    <!-- Header -->
    <header class="bg-warning py-5">
        <div class="container">
            <div class="row h-100 align-items-center">
                <div class="col-lg-12">
                    <h1 class="display-4 text-white mb-2">{{App::isLocale('id') ? $about->title_ind : $about->title_en}}</h1>
                    <p class="lead mb-5 text-dark">{{App::isLocale('id') ? $about->description_ind : $about->description_en}}</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Search Desktop-->
    <div class="mb-5 ctn-home-search d-none d-lg-block">
        <div class="container bg-light">
            <form method="get" action="{{url('search')}}">
                <div class="row ml-5 mr-5">
                    <div class="col-md-5">
                        <div class="form-group mt-5 mb-5">
                            <select name="place_id" class="form-control">
                                <option value="all">@lang('messages.home_select_place')</option>
                                @foreach(\App\Model\place_tbl::listSearch() as $items)
                                    <option value="{{$items->id}}">{{App::isLocale('id') ? $items->place_ind : $items->place_en}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mt-5 mb-5">
                            <select name="category" class="form-control">
                                <option value="all">@lang('messages.home_select_heritage')</option>
                                @foreach(\App\Model\content_tbl::groupInstitution() as $institution)
                                    <option value="{{\App\Model\category_content_tbl::getData($institution->category_ctn_id, "category")->category}}">@lang('messages.'.\App\Model\category_content_tbl::getData($institution->category_ctn_id, "category")->category)</option>
                                @endforeach
                                {{--<option value="museum">@lang('messages.category_museum')</option>--}}
                                {{--<option value="palace">@lang('messages.category_palace')</option>--}}
                                {{--<option value="temple">@lang('messages.category_temple')</option>--}}
                                {{--<option value="archive">@lang('messages.category_archive')</option>--}}
                                {{--<option value="library">@lang('messages.category_library')</option>--}}
                                {{--<option value="gallery">@lang('messages.category_gallery')</option>--}}
                                {{--<option value="community">@lang('messages.category_community')</option>--}}
                                {{--<option value="personal-activities">@lang('messages.category_personal_activities')</option>--}}

                                {{--<option value="nature">@lang('messages.category_natural_place')</option>--}}
                                {{--<option value="historical-building">@lang('messages.category_historical_building')</option>--}}
                                {{--<option value="site">@lang('messages.category_site')</option>--}}
                                {{--<option value="education-institution">@lang('messages.category_education_institution')</option>--}}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-5 mb-5">
                            <button class="btn btn-block btn-dark">@lang('messages.home_select_search')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{--mobile view--}}
    <div class="mb-5 ctn-home-search container d-lg-none">
        <div class="card bg-light">
            <div class="card-body">
                <form method="get" action="{{url('search')}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <select name="place_id" class="form-control">
                                    <option value="all">@lang('messages.home_select_place')</option>
                                    @foreach(\App\Model\place_tbl::listSearch() as $items)
                                        <option value="{{$items->id}}">{{App::isLocale('id') ? $items->place_ind : $items->place_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="category" class="form-control">
                                    <option value="all">@lang('messages.home_select_heritage')</option>
                                    @foreach(\App\Model\content_tbl::groupInstitution() as $institution)
                                        <option value="{{\App\Model\category_content_tbl::getData($institution->category_ctn_id, "category")->category}}">@lang('messages.'.\App\Model\category_content_tbl::getData($institution->category_ctn_id, "category")->category)</option>
                                    @endforeach
                                    {{--<option value="museum">@lang('messages.category_museum')</option>--}}
                                    {{--<option value="palace">@lang('messages.category_palace')</option>--}}
                                    {{--<option value="temple">@lang('messages.category_temple')</option>--}}
                                    {{--<option value="archive">@lang('messages.category_archive')</option>--}}
                                    {{--<option value="library">@lang('messages.category_library')</option>--}}
                                    {{--<option value="gallery">@lang('messages.category_gallery')</option>--}}
                                    {{--<option value="community">@lang('messages.category_community')</option>--}}
                                    {{--<option value="personal-activities">@lang('messages.category_personal_activities')</option>--}}

                                    {{--<option value="nature">@lang('messages.category_natural_place')</option>--}}
                                    {{--<option value="historical-building">@lang('messages.category_historical_building')</option>--}}
                                    {{--<option value="site">@lang('messages.category_site')</option>--}}
                                    {{--<option value="education-institution">@lang('messages.category_education_institution')</option>--}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-block btn-dark text-uppercase">@lang('messages.home_select_search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container">

        <!-- List Museum -->
        <div class="row">
            <div class="col-md-12">
                <h2>
                    <a href="{{url('search-instantion/museum')}}" class="text-dark">
                        Museum
                    </a>
                </h2>
                <hr>
                {{--<form method="get" action="{{url('search-instantion/museum')}}">--}}
                    {{--<div class="input-group mb-3">--}}
                        {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_museum_search')" aria-label="@lang('messages.home_museum_search')" aria-describedby="button-addon-museum">--}}
                        {{--<div class="input-group-append">--}}
                            {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            </div>
            @foreach(\App\Model\content_tbl::listContentCategory("museum", 3) as $list)
                <div class="col-md-4 mb-2">
                    <div class="card h-100">
                        <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                            <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                    {{App::isLocale('id') ? $list->name : $list->name_en}}
                                </a>
                            </h5>
                            <p class="card-text">
                                <small class="card-text text-uppercase">{{$list->location}}</small>
                            </p>
                            {{--<p class="card-text">--}}
                            {{--@php--}}
                            {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                            {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                            {{--@endphp--}}
                            {{--{!! $limit_text !!}--}}
                            {{--</p>--}}
                        </div>
                    </div>
                </div>
            @endforeach
            @if(count($museum) > 3)
                <div class="col-md-12">
                    <a href="{{url('search-instantion/museum')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') Museum</a>
                </div>
            @endif
        </div>
        <!-- /.row -->

        <!-- Join View Desktop-->
        {{--<div class="d-none d-lg-block">--}}
            {{--<div class="jumbotron bg-warning">--}}
                {{--<h3 class="display-5">@lang('messages.home_banner_title')</h3>--}}
                {{--<p class="lead">@lang('messages.home_banner_description')</p>--}}
                {{--<hr class="my-4">--}}
                {{--<a class="btn btn-light" href="{{url('register')}}" role="button">@lang('messages.home_banner_button')</a>--}}
                {{--<img src="{{asset('img/app-store.png')}}" class="img float-right" style="width: 160px; height: 60px;">--}}
                {{--<img src="{{asset('img/play-store.png')}}" class="img float-right" style="width: 160px; height: 60px;">--}}
            {{--</div>--}}
        {{--</div>--}}

        <!-- Join View Mobile-->
        {{--<div class="d-lg-none">--}}
            {{--<div class="jumbotron bg-warning">--}}
                {{--<h3 class="display-5">@lang('messages.home_banner_title')</h3>--}}
                {{--<p class="lead">@lang('messages.home_banner_description')</p>--}}
                {{--<hr class="my-4">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<a class="btn btn-light btn-block mb-5" href="{{url('register')}}" role="button">@lang('messages.home_banner_button')</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<img src="{{asset('img/app-store.png')}}" class="img float-right" style="width: 100%; height: 100px;">--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<img src="{{asset('img/play-store.png')}}" class="img float-right" style="width: 100%; height: 100px;">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="jumbotron bg-warning">
            <h3 class="display-5">@lang('messages.home_banner_title')</h3>
            <p class="lead">@lang('messages.home_banner_description')</p>
            <hr class="my-4">
            <a class="btn btn-light" href="{{url('register')}}" role="button">@lang('messages.home_banner_button')</a>
        </div>
        <!-- /.row -->

        <!-- List Palace -->
        @if(count($palace) != 0)
            <div class="row mt-3">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/palace')}}" class="text-dark">
                            @lang('messages.category_palace')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/palace')}}">--}}
                        {{--<div class="input-group mb-3">--}}
                            {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_palace_search')" aria-label="@lang('messages.home_palace_search')" aria-describedby="button-addon-museum">--}}
                            {{--<div class="input-group-append">--}}
                                {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach(\App\Model\content_tbl::listContentCategory("palace", 3) as $list)
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                    {{App::isLocale('id') ? $list->name : $list->name_en}}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="card-text text-uppercase">{{$list->location}}</small>
                                </p>
                                {{--<p class="card-text">--}}
                                    {{--@php--}}
                                        {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                        {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                    {{--@endphp--}}
                                    {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($palace) > 3)
                <a href="{{url('search-instantion/palace')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_palace')</a>
            @endif
        @endif
        <!-- /.row -->

        <!-- List Temple -->
        @if(count($temple) != 0)
            <div class="row mt-3">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/temple')}}" class="text-dark">
                            @lang('messages.category_temple')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/temple')}}">--}}
                    {{--<div class="input-group mb-3">--}}
                    {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_nature_search')" aria-label="@lang('messages.home_nature_search')" aria-describedby="button-addon-museum">--}}
                    {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach(\App\Model\content_tbl::listContentCategory("temple", 3) as $list)
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                        {{App::isLocale('id') ? $list->name : $list->name_en}}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="card-text text-uppercase">{{$list->location}}</small>
                                </p>
                                {{--<p class="card-text">--}}
                                {{--@php--}}
                                {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                {{--@endphp--}}
                                {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($temple) > 3)
                <a href="{{url('search-instantion/temple')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_temple')</a>
            @endif
        @endif
        <!-- /.row -->

        <!-- List Archive -->
        @if(count($archive) != 0)
            <div class="row mt-3">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/archive')}}" class="text-dark">
                            @lang('messages.category_archive')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/archive')}}">--}}
                    {{--<div class="input-group mb-3">--}}
                    {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_nature_search')" aria-label="@lang('messages.home_nature_search')" aria-describedby="button-addon-museum">--}}
                    {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach(\App\Model\content_tbl::listContentCategory("archive", 3) as $list)
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                        {{App::isLocale('id') ? $list->name : $list->name_en}}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="card-text text-uppercase">{{$list->location}}</small>
                                </p>
                                {{--<p class="card-text">--}}
                                {{--@php--}}
                                {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                {{--@endphp--}}
                                {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($archive) > 3)
                <a href="{{url('search-instantion/archive')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_archive')</a>
            @endif
        @endif
        <!-- /.row -->

        <!-- List Library -->
        @if(count($library) != 0)
            <div class="row mt-3">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/library')}}" class="text-dark">
                            @lang('messages.category_library')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/library')}}">--}}
                    {{--<div class="input-group mb-3">--}}
                    {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_palace_search')" aria-label="@lang('messages.home_palace_search')" aria-describedby="button-addon-museum">--}}
                    {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach(\App\Model\content_tbl::listContentCategory("library", 3) as $list)
                    <div class="col-md-4 mb-2">
                        <div class="card h-100">
                            <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                        {{App::isLocale('id') ? $list->name : $list->name_en}}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="card-text text-uppercase">{{$list->location}}</small>
                                </p>
                                {{--<p class="card-text">--}}
                                {{--@php--}}
                                {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                {{--@endphp--}}
                                {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($library) > 3)
                <a href="{{url('search-instantion/library')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_library')</a>
            @endif
        @endif
        <!-- /.row -->

        <!-- List Gallery -->
        @if(count($gallery) != 0)
            <div class="row mt-3">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/gallery')}}" class="text-dark">
                            @lang('messages.category_gallery')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/gallery')}}">--}}
                    {{--<div class="input-group mb-3">--}}
                    {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_gallery_search')" aria-label="@lang('messages.home_gallery_search')" aria-describedby="button-addon-museum">--}}
                    {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach(\App\Model\content_tbl::listContentCategory("gallery", 3) as $list)
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                        {{App::isLocale('id') ? $list->name : $list->name_en}}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="card-text text-uppercase">{{$list->location}}</small>
                                </p>
                                {{--<p class="card-text">--}}
                                {{--@php--}}
                                {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                {{--@endphp--}}
                                {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($gallery) > 3)
                <a href="{{url('search-instantion/gallery')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_gallery')</a>
            @endif
        @endif
        <!-- /.row -->

        <!-- List Community -->
        @if(count($community) != 0)
            <div class="row mt-3">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/community')}}" class="text-dark">
                            @lang('messages.category_community')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/community')}}">--}}
                    {{--<div class="input-group mb-3">--}}
                    {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_comunity_search')" aria-label="@lang('messages.home_comunity_search')" aria-describedby="button-addon-museum">--}}
                    {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach(\App\Model\content_tbl::listContentCategory("community", 3) as $list)
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                        {{App::isLocale('id') ? $list->name : $list->name_en}}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="card-text text-uppercase">{{$list->location}}</small>
                                </p>
                                {{--<p class="card-text">--}}
                                {{--@php--}}
                                {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                {{--@endphp--}}
                                {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($community) > 3)
                <a href="{{url('search-instantion/community')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_community')</a>
            @endif
        @endif
        <!-- /.row -->

        <!-- List Personal Activities -->
        @if(count($personal) != 0)
            <div class="row mt-3">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/personal-activities')}}" class="text-dark">
                            @lang('messages.category_personal_activities')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/personal-activities')}}">--}}
                    {{--<div class="input-group mb-3">--}}
                    {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_personal_search')" aria-label="@lang('messages.home_personal_search')" aria-describedby="button-addon-museum">--}}
                    {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach(\App\Model\content_tbl::listContentCategory("personal-activities", 3) as $list)
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                        {{App::isLocale('id') ? $list->name : $list->name_en}}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="card-text text-uppercase">{{$list->location}}</small>
                                </p>
                                {{--<p class="card-text">--}}
                                {{--@php--}}
                                {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                {{--@endphp--}}
                                {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($personal) > 3)
                <a href="{{url('search-instantion/personal-activities')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_personal_activities')</a>
            @endif
        @endif

        <!-- List Nature -->
        {{--@if(count($nature) != 0)--}}
            {{--<div class="row mt-3">--}}
                {{--<div class="col-md-12">--}}
                    {{--<h2>--}}
                        {{--<a href="{{url('search-instantion/nature')}}" class="text-dark">--}}
                            {{--@lang('messages.category_natural_place')--}}
                        {{--</a>--}}
                    {{--</h2>--}}
                    {{--<hr>--}}
                    {{--<form method="get" action="{{url('search-instantion/nature')}}">--}}
                        {{--<div class="input-group mb-3">--}}
                            {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_nature_search')" aria-label="@lang('messages.home_nature_search')" aria-describedby="button-addon-museum">--}}
                            {{--<div class="input-group-append">--}}
                                {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
                {{--@foreach(\App\Model\content_tbl::listContentCategory("nature", 3) as $list)--}}
                    {{--<div class="col-md-4 mb-5">--}}
                        {{--<div class="card h-100">--}}
                            {{--<a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">--}}
                                {{--<img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">--}}
                            {{--</a>--}}
                            {{--<div class="card-body">--}}
                                {{--<h5 class="card-title">--}}
                                    {{--<a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">--}}
                                    {{--{{App::isLocale('id') ? $list->name : $list->name_en}}--}}
                                    {{--</a>--}}
                                {{--</h5>--}}
                                {{--<p class="card-text">--}}
                                    {{--<small class="card-text text-uppercase">{{$list->location}}</small>--}}
                                {{--</p>--}}
                                {{--<p class="card-text">--}}
                                    {{--@php--}}
                                        {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                        {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                    {{--@endphp--}}
                                    {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
            {{--@if(count($nature) > 3)--}}
                {{--<a href="{{url('search-instantion/nature')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_natural_place')</a>--}}
            {{--@endif--}}
        {{--@endif--}}
        <!-- /.row -->

        <!-- List Historical Building -->
        {{--@if(count($historical_building) != 0)--}}
            {{--<div class="row mt-3">--}}
                {{--<div class="col-md-12">--}}
                    {{--<h2>--}}
                        {{--<a href="{{url('search-instantion/historical-building')}}" class="text-dark">--}}
                            {{--@lang('messages.category_historical_building')--}}
                        {{--</a>--}}
                    {{--</h2>--}}
                    {{--<hr>--}}
                    {{--<form method="get" action="{{url('search-instantion/historical-building')}}">--}}
                        {{--<div class="input-group mb-3">--}}
                            {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_history_building_search')" aria-label="@lang('messages.home_history_building_search')" aria-describedby="button-addon-museum">--}}
                            {{--<div class="input-group-append">--}}
                                {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
                {{--@foreach(\App\Model\content_tbl::listContentCategory("historical-building", 3) as $list)--}}
                    {{--<div class="col-md-4 mb-5">--}}
                        {{--<div class="card h-100">--}}
                            {{--<a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">--}}
                                {{--<img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">--}}
                            {{--</a>--}}
                            {{--<div class="card-body">--}}
                                {{--<h5 class="card-title">--}}
                                    {{--<a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">--}}
                                    {{--{{App::isLocale('id') ? $list->name : $list->name_en}}--}}
                                    {{--</a>--}}
                                {{--</h5>--}}
                                {{--<p class="card-text">--}}
                                    {{--<small class="card-text text-uppercase">{{$list->location}}</small>--}}
                                {{--</p>--}}
                                {{--<p class="card-text">--}}
                                    {{--@php--}}
                                        {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                        {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                    {{--@endphp--}}
                                    {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
            {{--@if(count($historical_building) > 3)--}}
                {{--<a href="{{url('search-instantion/historical-building')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_historical_building')</a>--}}
            {{--@endif--}}
        {{--@endif--}}
        <!-- /.row -->

        <!-- List Site -->
        @if(count($site) != 0)
            <div class="row mt-3">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/site')}}" class="text-dark">
                            @lang('messages.category_site')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/site')}}">--}}
                    {{--<div class="input-group mb-3">--}}
                    {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_site_search')" aria-label="@lang('messages.home_site_search')" aria-describedby="button-addon-museum">--}}
                    {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach(\App\Model\content_tbl::listContentCategory("site", 3) as $list)
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                        {{App::isLocale('id') ? $list->name : $list->name_en}}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="card-text text-uppercase">{{$list->location}}</small>
                                </p>
                                {{--<p class="card-text">--}}
                                {{--@php--}}
                                {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                {{--@endphp--}}
                                {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($site) > 3)
                <a href="{{url('search-instantion/site')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_site')</a>
            @endif
        @endif
        <!-- /.row -->

        <!-- List Education Institution -->
        @if(count($education_institution) != 0)
            <div class="row mt-3">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/education-institution')}}" class="text-dark">
                            @lang('messages.category_education_institution')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/site')}}">--}}
                    {{--<div class="input-group mb-3">--}}
                    {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_site_search')" aria-label="@lang('messages.home_site_search')" aria-describedby="button-addon-museum">--}}
                    {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach(\App\Model\content_tbl::listContentCategory("education-institution", 3) as $list)
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                        {{App::isLocale('id') ? $list->name : $list->name_en}}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="card-text text-uppercase">{{$list->location}}</small>
                                </p>
                                {{--<p class="card-text">--}}
                                {{--@php--}}
                                {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                {{--@endphp--}}
                                {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($site) > 3)
                <a href="{{url('search-instantion/education-institution')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_education_institution')</a>
            @endif
        @endif
        <!-- /.row -->

        <!-- List eBook -->
        {{--@if(count($ebook) != 0)--}}
            {{--<div class="row mt-3">--}}
                {{--<div class="col-md-12">--}}
                    {{--<h2>--}}
                        {{--<a href="{{url('search-instantion/ebook')}}" class="text-dark">--}}
                            {{--@lang('messages.category_ebook')--}}
                        {{--</a>--}}
                    {{--</h2>--}}
                    {{--<hr>--}}
                    {{--<form method="get" action="{{url('search-instantion/site')}}">--}}
                    {{--<div class="input-group mb-3">--}}
                    {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_site_search')" aria-label="@lang('messages.home_site_search')" aria-describedby="button-addon-museum">--}}
                    {{--<div class="input-group-append">--}}
                    {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
                {{--@foreach(\App\Model\content_tbl::listContentCategory("ebook", 3) as $list)--}}
                    {{--<div class="col-md-4 mb-5">--}}
                        {{--<div class="card h-100">--}}
                            {{--<a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">--}}
                                {{--<img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">--}}
                            {{--</a>--}}
                            {{--<div class="card-body">--}}
                                {{--<h5 class="card-title">--}}
                                    {{--<a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">--}}
                                        {{--{{App::isLocale('id') ? $list->name : $list->name_en}}--}}
                                    {{--</a>--}}
                                {{--</h5>--}}
                                {{--<p class="card-text">--}}
                                    {{--<small class="card-text text-uppercase">{{$list->location}}</small>--}}
                                {{--</p>--}}
                                {{--<p class="card-text">--}}
                                {{--@php--}}
                                {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                {{--@endphp--}}
                                {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
            {{--@if(count($site) > 3)--}}
                {{--<a href="{{url('search-instantion/ebook')}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.category_ebook')</a>--}}
            {{--@endif--}}
        {{--@endif--}}
        <!-- /.row -->

        <!-- List News -->
        <div class="row">
            <div class="col-md-12">
                <h2>
                    <a href="{{url('news')}}" class="text-dark">
                        @lang('messages.home_news_title')
                    </a>
                </h2>
                <hr>
            </div>
            @foreach($news as $item)
                {{--desktop view--}}
                <div class="col-md-12 mb-4 d-none d-lg-block">
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                                <a href="{{url('news/detail/'.$item->id)}}" class="text-dark">
                                    <img src="{{$item->banner}}" class="card-img ctn-vr-thumbnail" alt="{{$item->banner}}">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><a href="{{url('news/detail/'.$item->id)}}" class="text-dark">{{App::isLocale('id') ? $item->title_ind : $item->title_en}}</a></h5>
                                    @php
                                        $text = App::isLocale('id') ? strip_tags($item->description_ind) : strip_tags($item->description_en);
                                        $text = stripslashes($text);
                                        $limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('news/detail/'.$item->id)."'> ...readmore</a>" : $text;
                                    @endphp
                                    <p class="card-text">{!! $limit_text !!}</p>
                                    <p class="card-text"><small class="text-muted">{{$item->created_at->diffForHumans()}}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--mobile view--}}
                <div class="col-md-12 mb-5 d-lg-none">
                    <div class="card h-100">
                        <a href="{{url('news/detail/'.$item->id)}}" class="text-dark">
                            <img class="card-img-top" src="{{$item->banner}}" alt="" height="200" widht="400">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{url('news/detail/'.$item->id)}}" class="text-dark">
                                    {{App::isLocale('id') ? $item->title_ind : $item->title_en}}
                                </a>
                            </h5>
                            <p class="card-text">
                                @php
                                    $text = App::isLocale('id') ? strip_tags($item->description_ind) : strip_tags($item->description_en);
                                    $limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('news/detail/'.$item->id)."'> ...readmore</a>" : $text;
                                @endphp
                                {!! $limit_text !!}
                            </p>
                            <p class="card-text"><small class="text-muted text-white">{{$item->created_at->diffForHumans()}}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection