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
            <form action="{{url('search')}}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <select class="form-control search-place">
                                <option value="all">@lang('messages.home_select_place')</option>
                                @foreach(\App\Model\place_tbl::listSearch() as $items)
                                    <option value="{{$items->id}}">{{App::isLocale('id') ? $items->place_ind : $items->place_en}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-control search-category">
                                <option value="all">@lang('messages.home_select_heritage')</option>
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
                <h2>@lang('messages.home_result_search')</h2>
                <hr>
            </div>
            @forelse($data as $list)
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <a href="{{url('content/'.$list->seo.'/'.$list->id)}}" class="text-dark">
                            <img class="card-img-top" src="{{$list->photo}}" alt="" height="200" widht="400">
                            <div class="card-body">
                                <h5 class="card-title">{{$list->name}}</h5>
                                <p class="card-text">
                                    <span class="badge badge-warning text-uppercase">{{$list->location}}</span> |
                                    <span class="badge badge-secondary text-uppercase">{{$list->category}}</span>
                                </p>
                                <p class="card-text mt-2">
                                    @php
                                        $text = App::isLocale('id') ? htmlspecialchars_decode($list->short_description_ind) : htmlspecialchars_decode($list->short_description_en);
                                        $limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;
                                    @endphp
                                    {!! $limit_text !!}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">@lang('messages.title_search')</h1>
                            <p class="lead">@lang('messages.msg_search')</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <!-- /.row -->
    </div>
@endsection