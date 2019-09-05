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
            <h1 class="display-4 text-white mt-5 mb-2">@lang('messages.home_title')</h1>
            <p class="lead mb-5 text-dark">@lang('messages.home_description')</p>
        </div>
        </div>
    </div>
</header>

<!-- Page Search -->
<div class="mb-5 ctn-home-search">
    <div class="container bg-light">
        <div class="row ml-5 mr-5">
        <div class="col-md-5">
            <div class="form-group mt-5 mb-5">
                <select class="form-control">
                    <option value="all">@lang('messages.home_select_place')</option>
                    @foreach(\App\Model\place_tbl::listSearch() as $items)
                        <option value="{{$items->id}}">{{App::isLocale('id') ? $items->place_ind : $items->place_en}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mt-5 mb-5">
                <select class="form-control">
                    <option>@lang('messages.home_select_heritage')</option>
                    <option>Museum</option>
                    <option>Library</option>
                    <option>Gallery</option>
                    <option>Archive</option>
                    <option>Temple</option>
                    <option>Palace</option>
                    <option>Nature</option>
                    <option>Historical Building</option>
                    <option>Personal Collection</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mt-5 mb-5">
                <button class="btn btn-block btn-dark">@lang('messages.home_select_search')</button>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="container">

    <!-- List Museum -->
    <div class="row">
        <div class="col-md-12">
            <h2>Museum</h2>
            <hr>
        </div>
        @foreach($museum as $list)
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <a href="{{url('museum/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                    <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                    <div class="card-body">
                    <h5 class="card-title">{{$list->name}}</h5>
                    <p class="card-text">
                        <small class="card-text text-uppercase">{{$list->location}}</small>
                    </p>
                    <p class="card-text">
                        @php
                            $text = App::isLocale('id') ? $list->short_description_ind : $list->short_description_en;
                            $limit_text = substr($text, 0, 150);
                        @endphp
                        {{$text}}
                    </p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.row -->

    <!-- Join -->
    <div class="jumbotron bg-warning">
        <h3 class="display-5">@lang('messages.home_banner_title')</h3>
        <p class="lead">@lang('messages.home_banner_description')</p>
        <hr class="my-4">
        <a class="btn btn-light" href="#" role="button">@lang('messages.home_banner_button')</a>
    </div>
    <!-- /.row -->

    <!-- List Palace -->
    @if(count($palace) != 0)
    <div class="row">
        <div class="col-md-12">
            <h2>@lang('messages.home_palace_title')</h2>
            <hr>
        </div>
        @foreach($palace as $list)
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <a href="{{url('palace/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                        <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                        <div class="card-body">
                            <h5 class="card-title">{{$list->name}}</h5>
                            <p class="card-text">
                                <small class="card-text text-uppercase">{{$list->location}}</small>
                            </p>
                            <p class="card-text">
                                @php
                                    $text = App::isLocale('id') ? $list->short_description_ind : $list->short_description_en;
                                    $limit_text = substr($text, 0, 150);
                                @endphp
                                {{$text}}
                            </p>
                        </div>
                    </a>
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
            <h2>@lang('messages.home_nature_title')</h2>
            <hr>
        </div>
        @foreach($nature as $list)
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <a href="{{url('nature/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                        <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                        <div class="card-body">
                            <h5 class="card-title">{{$list->name}}</h5>
                            <p class="card-text">
                                <small class="card-text text-uppercase">{{$list->location}}</small>
                            </p>
                            <p class="card-text">
                                @php
                                    $text = App::isLocale('id') ? $list->short_description_ind : $list->short_description_en;
                                    $limit_text = substr($text, 0, 150);
                                @endphp
                                {{$text}}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    @endif
    <!-- /.row -->

    <!-- List News -->
    <div class="row">
        <div class="col-md-12">
            <h2>@lang('messages.home_news_title')</h2>
            <hr>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="{{asset('bootstrap/asset-img/museum/asset-mue-konfasiaafrika.jpg')}}" class="card-img ctn-vr-thumbnail" alt="...">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">RECORDING HISTORY OF ASIA-AFRICAN CONFERENCES</h5>
                            @php
                                $text = "The Asia-Africa Conference held in Bandung on April 18-24, 1955 was a very historic event in Indonesian foreign policy and a major event for the Indonesian people.";
                                $limit_text = substr($text, 0, 150);
                            @endphp
                            <p class="card-text">{{$limit_text}} <a href="{{url('/')}}">...readmore</a></p>
                            <p class="card-text"><small class="text-muted">Last updated 3 day ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="{{asset('bootstrap/asset-img/museum/asset-mue-sribaduga.jpg')}}" class="card-img ctn-vr-thumbnail" alt="...">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">DIGITAL PRESERVATION OF ANCIENT ARTEFAC & NASIONAL AT SRI BADUGA MUSEUM</h5>
                            @php
                                $text = "The Sri Baduga Museum is managed by the West Java Provincial Government by utilizing the old building of the former Kawedanan Tegallega. Furthermore, the museum was inaugurated on June 5, 1980 by the then Minister of Education and Culture, Daoed Joesoef.";
                                $limit_text = substr($text, 0, 150);
                            @endphp
                            <p class="card-text">{{$limit_text}} <a href="{{url('/')}}">...readmore</a></p>
                            <p class="card-text"><small class="text-muted">Last updated 4 day ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="{{asset('bootstrap/asset-img/museum/asset-mue-nasional.jpg')}}" class="card-img ctn-vr-thumbnail" alt="...">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">PUBLICATION & EDUCATION EFFORTS IN THE NATIONAL MUSEUM</h5>
                            @php
                                $text = "Bataviaasch Genootschap van Kunsten en Wetenschappen (BG) is an independent institution established for the purpose of advancing research in the arts and sciences, especially in the fields of biology, physics, archeology, literature, ethnology and history";
                                $limit_text = substr($text, 0, 150);
                            @endphp
                            <p class="card-text">{{$limit_text}} <a href="{{url('/')}}">...readmore</a></p>
                            <p class="card-text"><small class="text-muted">Last updated 4 day ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection