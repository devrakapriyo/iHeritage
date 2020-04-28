@extends('FE.layout')
@section('home')
    active
@endsection
@section('content')

    <!-- Page Search Desktop-->
    <div class="mb-3 mt-2 container d-none d-lg-block">
        <div class="card bg-light">
            <div class="card-body">
                <form method="get" action="{{url('search')}}">
                    <div class="row ml-5 mr-5">
                        <div class="col-md-6">
                            <div class="form-group mt-5">
                                <select name="place_id" class="form-control">
                                    <option value="all">@lang('messages.home_select_place')</option>
                                    @foreach(\App\Model\place_tbl::listSearch() as $items)
                                        <option value="{{$items->id}}">{{App::isLocale('id') ? $items->place_ind : $items->place_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-5">
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
                    </div>
                    <div class="row ml-5 mr-5">
                        <div class="col-md-9">
                            <div class="form-group mt-2 mb-5">
                                <input type="text" name="input_search" class="form-control" placeholder="@lang('messages.input_search')">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mt-2 mb-5">
                                <button class="btn btn-block btn-dark">@lang('messages.home_select_search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--mobile view--}}
    <div class="mb-3 col-md-12 d-lg-none">
        <div class="card bg-light">
            <div class="card-body">
                <form action="{{url('search')}}">
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
                                <input type="text" name="input_search" class="form-control" placeholder="@lang('messages.input_search')">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-block btn-warning text-uppercase">@lang('messages.home_select_search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container">

        <!-- List Content -->
        @if(count($data_content) > 0)
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-capitalize">
                        @lang('messages.home_result_search') @lang('messages.collection_institution')
                    </h2>
                    <hr>
                </div>
                @forelse($data_content as $list)
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
                                    <span class="badge badge-warning text-uppercase">{{$list->location}}</span> |
                                    <span class="badge badge-secondary text-uppercase">@lang('messages.'.$list->category)</span>
                                </p>
                                {{--<p class="card-text mt-2">--}}
                                    {{--@php--}}
                                        {{--$text = App::isLocale('id') ? strip_tags($list->short_description_ind) : strip_tags($list->short_description_en);--}}
                                        {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('content/'.$list->seo.'/'.$list->id)."'> ...readmore</a>" : $text;--}}
                                    {{--@endphp--}}
                                    {{--{!! $limit_text !!}--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            @lang('messages.title_search') @lang('messages.msg_search')
                        </div>
                    </div>
                @endforelse
            </div>
        @endif
        <!-- /.row -->

        <!-- List Collection -->
        @if(count($data_collection) > 0)
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-capitalize">
                        @lang('messages.home_result_search') @lang('messages.heritage_title')
                    </h2>
                    <hr>
                </div>
                @forelse($data_collection as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <a href="{{route('collection-detail', ['id'=>$item->id])}}">
                                <img class="card-img-top" src="{{$item->banner}}" alt="{{$item->banner}}" height="200" widht="200">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase">
                                        <a href="{{route('collection-detail', ['id'=>$item->id])}}" class="text-dark">{{App::isLocale('id') ? $item->name : $item->name_en}}</a>
                                    </h5>
                                    <small class="card-text">
                                        @lang('messages.collection_topic') : <a href="{{url('collection-search?place_id=all&media_type=all&topic='.$item->topic.'&institutional_id=all')}}">@lang('messages.'.$item->topic)</a><br>
                                        @lang('messages.collection_location') : {{\App\Model\place_tbl::placeNameLang($item->place_id)}}<br>
                                        @lang('messages.collection_type') :
                                        <span class="text text-dark">
                                                @if($item->media_type == "url")
                                                HTML5
                                            @elseif($item->media_type == "document")
                                                PDF
                                            @else
                                                {{$item->media_type}}
                                            @endif
                                            </span>
                                    </small>
                                    {{--<hr>--}}
                                    {{--<p class="card-text">--}}
                                    {{--@php--}}
                                    {{--$text = App::isLocale('id') ? htmlspecialchars_decode($item->description_ind) : htmlspecialchars_decode($item->description_en);--}}
                                    {{--$limit_text = strlen($text) > 150 ? substr($text, 0, 150)."<a href='".url('collection/detail/'.$item->id)."'> ...readmore</a>" : $text;--}}
                                    {{--@endphp--}}
                                    {{--{!! $limit_text !!}--}}
                                    {{--</p>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            @lang('messages.title_search') @lang('messages.msg_search')
                        </div>
                    </div>
                @endforelse
            </div>
        @endif
        <!-- /.row -->

        <!-- List Event -->
        @if(count($data_event) > 0)
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-capitalize">
                        @lang('messages.home_result_search') @lang('messages.event_title')
                    </h2>
                    <hr>
                </div>
                @forelse($data_event as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <a href="{{url('event/detail/'.$item->seo.'/'.$item->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$item->banner}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-7">
                                        <p class="card-text text-secondary">
                                            {{\App\Helper\helpers::dateFormat($item->start_date)}}
                                        </p>
                                    </div>
                                    <div class="col-md-5">
                                        <p class="card-text">
                                            <small class="btn btn-sm btn-success float-right text-capitalize">{{$item->price == 0 ? App::isLocale('id') ? "Gratis" : "Free" : "Rp. ".number_format($item->price) }}</small>
                                        </p>
                                    </div>
                                </div>
                                <h5 class="card-title">
                                    <a href="{{url('event/detail/'.$item->seo.'/'.$item->id)}}" class="text-dark">
                                        {{App::isLocale('id') ? $item->name : $item->name_en}}
                                    </a>
                                </h5>
                                <small class="card-text" title="{{$item->map_area_detail}}">
                                    @php
                                        $text = $item->map_area_detail;
                                        $limit_text = substr($text, 0, 48);
                                        $more = strlen($text) <= 48 ? "" : "<a href='".url('event/detail/'.$item->seo.'/'.$item->id)."'> ...readmore</a>";
                                    @endphp
                                    {{$limit_text}}{{$more}}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            @lang('messages.title_search') @lang('messages.msg_search')
                        </div>
                    </div>
                @endforelse
            </div>
        @endif
        <!-- /.row -->

        <!-- List Education -->
        @if(count($data_education) > 0)
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-capitalize">
                        @lang('messages.home_result_search') @lang('messages.edu_title')
                    </h2>
                    <hr>
                </div>
                @forelse($data_education as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <a href="{{url('education-program/detail/'.$item->seo.'/'.$item->id)}}" class="text-dark">
                                <img class="card-img-top" src="{{$item->banner}}" alt="" height="200" widht="400">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{url('education-program/detail/'.$item->seo.'/'.$item->id)}}" class="text-dark">
                                        {{App::isLocale('id') ? $item->name : $item->name_en}}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="card-text text-uppercase">{{$item->map_area_detail}}</small>
                                </p>
                                @php
                                    $text = App::isLocale('id') ? strip_tags($item->description_ind) : strip_tags($item->description_en);
                                    $text = stripslashes($text);
                                    $limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('education-program/detail/'.$item->seo.'/'.$item->id)."'> ...readmore</a>" : $text;
                                @endphp
                                <p class="card-text">{!! $limit_text !!}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            @lang('messages.title_search') @lang('messages.msg_search')
                        </div>
                    </div>
                @endforelse
            </div>
        @endif
        <!-- /.row -->
    </div>
@endsection