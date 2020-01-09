@extends('FE.layout')
@section('home')
    active
@endsection
@section('content')
    <!-- Header -->
    <header class="bg-warning py-5">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-12">
                    <h1 class="display-4 text-white mt-5 mb-2">{{App::isLocale('id') ? $about->title_ind : $about->title_en}}</h1>
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
                                <option value="museum">@lang('messages.category_museum')</option>
                                <option value="library">@lang('messages.category_library')</option>
                                <option value="gallery">@lang('messages.category_gallery')</option>
                                <option value="archive">@lang('messages.category_archive')</option>
                                <option value="temple">@lang('messages.category_temple')</option>
                                <option value="palace">@lang('messages.category_palace')</option>
                                <option value="natural-place">@lang('messages.category_natural_place')</option>
                                <option value="historical-building">@lang('messages.category_historical_building')</option>
                                <option value="personal-activities">@lang('messages.category_personal_activities')</option>
                                <option value="site">@lang('messages.category_site')</option>
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
    <div class="mb-5 ctn-home-search d-lg-none">
        <div class="container bg-light">
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
                                <option value="museum">@lang('messages.category_museum')</option>
                                <option value="library">@lang('messages.category_library')</option>
                                <option value="gallery">@lang('messages.category_gallery')</option>
                                <option value="archive">@lang('messages.category_archive')</option>
                                <option value="temple">@lang('messages.category_temple')</option>
                                <option value="palace">@lang('messages.category_palace')</option>
                                <option value="natural-place">@lang('messages.category_natural_place')</option>
                                <option value="historical-building">@lang('messages.category_historical_building')</option>
                                <option value="personal-activities">@lang('messages.category_personal_activities')</option>
                                <option value="site">@lang('messages.category_site')</option>
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
            @foreach($museum as $list)
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
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/palace')}}" class="text-dark">
                            @lang('messages.home_palace_title')
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
                @foreach($palace as $list)
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
        @endif
        <!-- /.row -->

        <!-- List Archive -->
        @if(count($archive) != 0)
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/archive')}}" class="text-dark">
                            @lang('messages.home_archive_title')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/nature')}}">--}}
                        {{--<div class="input-group mb-3">--}}
                            {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_nature_search')" aria-label="@lang('messages.home_nature_search')" aria-describedby="button-addon-museum">--}}
                            {{--<div class="input-group-append">--}}
                                {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach($archive as $list)
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
        @endif
        <!-- /.row -->

        <!-- List Nature -->
        @if(count($nature) != 0)
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        <a href="{{url('search-instantion/nature')}}" class="text-dark">
                            @lang('messages.home_nature_title')
                        </a>
                    </h2>
                    <hr>
                    {{--<form method="get" action="{{url('search-instantion/nature')}}">--}}
                        {{--<div class="input-group mb-3">--}}
                            {{--<input type="text" name="name" class="form-control" placeholder="@lang('messages.home_nature_search')" aria-label="@lang('messages.home_nature_search')" aria-describedby="button-addon-museum">--}}
                            {{--<div class="input-group-append">--}}
                                {{--<button class="btn btn-secondary" type="button" id="button-addon-museum">@lang('messages.home_select_search')</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                </div>
                @foreach($nature as $list)
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
        @endif
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
                                <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                                    {{$item->name}}
                                </a>
                            </h5>
                            <p class="card-text">
                                <small class="card-text text-uppercase">{{$item->location}}</small>
                            </p>
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