@extends('FE.layout')
@section('collection')
    active
@endsection
@section('content')
<!-- Page Content -->
<div class="container">
    <!-- Page Search Desktop-->
    <div class="mt-5 mb-2 d-none d-lg-block">
        <div class="card bg-light">
            <div class="card-body">
                <h3 class="card-title mb-3">
                    @lang('messages.heritage_title')
                </h3>
                <form method="get" action="{{url('collection-search')}}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="place_id" class="form-control">
                                    <option value="all">@lang('messages.home_select_place')</option>
                                    @foreach(\App\Model\place_tbl::listSearch() as $items)
                                        <option value="{{$items->id}}">{{App::isLocale('id') ? $items->place_ind : $items->place_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="media_type" class="form-control">
                                    <option value="all">@lang('messages.collection_type')</option>
                                    <option value="document">PDF</option>
                                    <option value="audio">@lang('messages.collection_type_audio')</option>
                                    <option value="image">@lang('messages.collection_type_image')</option>
                                    <option value="video">@lang('messages.collection_type_video')</option>
                                    <option value="url">HTML5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="topic" class="form-control">
                                    <option value="all">@lang('messages.collection_topic')</option>
                                    <option value="collection_manuscript">@lang('messages.collection_manuscript')</option>
                                    <option value="collection_traditional_weapon">@lang('messages.collection_traditional_weapon')</option>
                                    <option value="collection_traditional_music">@lang('messages.collection_traditional_music')</option>
                                    <option value="collection_ceramic">@lang('messages.collection_ceramic')</option>
                                    <option value="collection_painting">@lang('messages.collection_painting')</option>
                                    <option value="collection_traditional_house">@lang('messages.collection_traditional_house')</option>
                                    <option value="collection_performing_arts">@lang('messages.collection_performing_arts')</option>
                                    <option value="collection_temple">@lang('messages.collection_temple')</option>
                                    <option value="collection_statue">@lang('messages.collection_statue')</option>
                                    <option value="collection_crown">@lang('messages.collection_crown')</option>
                                    <option value="collection_jewelry">@lang('messages.collection_jewelry')</option>
                                    <option value="collection_vehicle">@lang('messages.collection_vehicle')</option>
                                    <option value="collection_literature">@lang('messages.collection_literature')</option>
                                    <option value="collection_traditional_cloth">@lang('messages.collection_traditional_cloth')</option>
                                    <option value="collection_movie">@lang('messages.collection_movie')</option>
                                    <option value="collection_inscription">@lang('messages.collection_inscription')</option>
                                    <option value="collection_puppet">@lang('messages.collection_puppet')</option>
                                    <option value="collection_mask">@lang('messages.collection_mask')</option>
                                    <option value="collection_dance">@lang('messages.collection_dance')</option>
                                    <option value="collection_material_art">@lang('messages.collection_material_art')</option>
                                    <option value="collection_history">@lang('messages.collection_history')</option>
                                    <option value="collection_historic_building">@lang('messages.collection_historic_building')</option>
                                    <option value="collection_site">@lang('messages.collection_site')</option>
                                    <option value="collection_culinary">@lang('messages.collection_culinary')</option>
                                    <option value="collection_exchange">@lang('messages.collection_exchange')</option>
                                    <option value="collection_medal">@lang('messages.collection_medal')</option>
                                    <option value="collection_navigation">@lang('messages.collection_navigation')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="institutional_id" class="form-control">
                                    <option value="all">@lang('messages.collection_institution')</option>
                                    @foreach(\App\Model\institutional::listInstitutional() as $items)
                                        <option value="{{$items->id}}">{{$items->institutional_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-md-6 col-md-6">
                            <div class="form-group">
                                <button class="btn btn-block btn-warning">@lang('messages.home_select_search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--mobile view--}}
    <div class="mt-3 mb-2 d-lg-none">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-3">
                    @lang('messages.heritage_title')
                </h3>
                <form method="get" action="{{url('collection-search')}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="place_id" class="form-control">
                                    <option value="all">@lang('messages.home_select_place')</option>
                                    @foreach(\App\Model\place_tbl::listSearch() as $items)
                                        <option value="{{$items->id}}">{{App::isLocale('id') ? $items->place_ind : $items->place_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <select name="media_type" class="form-control">
                                    <option value="all">@lang('messages.collection_type')</option>
                                    <option value="document">PDF</option>
                                    <option value="audio">@lang('messages.collection_type_audio')</option>
                                    <option value="image">@lang('messages.collection_type_image')</option>
                                    <option value="video">@lang('messages.collection_type_video')</option>
                                    <option value="url">HTML5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <select name="topic" class="form-control">
                                    <option value="all">@lang('messages.collection_topic')</option>
                                    <option value="collection_manuscript">@lang('messages.collection_manuscript')</option>
                                    <option value="collection_traditional_weapon">@lang('messages.collection_traditional_weapon')</option>
                                    <option value="collection_traditional_music">@lang('messages.collection_traditional_music')</option>
                                    <option value="collection_ceramic">@lang('messages.collection_ceramic')</option>
                                    <option value="collection_painting">@lang('messages.collection_painting')</option>
                                    <option value="collection_traditional_house">@lang('messages.collection_traditional_house')</option>
                                    <option value="collection_performing_arts">@lang('messages.collection_performing_arts')</option>
                                    <option value="collection_temple">@lang('messages.collection_temple')</option>
                                    <option value="collection_statue">@lang('messages.collection_statue')</option>
                                    <option value="collection_crown">@lang('messages.collection_crown')</option>
                                    <option value="collection_jewelry">@lang('messages.collection_jewelry')</option>
                                    <option value="collection_vehicle">@lang('messages.collection_vehicle')</option>
                                    <option value="collection_literature">@lang('messages.collection_literature')</option>
                                    <option value="collection_traditional_cloth">@lang('messages.collection_traditional_cloth')</option>
                                    <option value="collection_movie">@lang('messages.collection_movie')</option>
                                    <option value="collection_inscription">@lang('messages.collection_inscription')</option>
                                    <option value="collection_puppet">@lang('messages.collection_puppet')</option>
                                    <option value="collection_mask">@lang('messages.collection_mask')</option>
                                    <option value="collection_dance">@lang('messages.collection_dance')</option>
                                    <option value="collection_material_art">@lang('messages.collection_material_art')</option>
                                    <option value="collection_history">@lang('messages.collection_history')</option>
                                    <option value="collection_historic_building">@lang('messages.collection_historic_building')</option>
                                    <option value="collection_site">@lang('messages.collection_site')</option>
                                    <option value="collection_culinary">@lang('messages.collection_culinary')</option>
                                    <option value="collection_exchange">@lang('messages.collection_exchange')</option>
                                    <option value="collection_medal">@lang('messages.collection_medal')</option>
                                    <option value="collection_navigation">@lang('messages.collection_navigation')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="institutional_id" class="form-control">
                                    <option value="all">@lang('messages.collection_institution')</option>
                                    @foreach(\App\Model\institutional::listInstitutional() as $items)
                                        <option value="{{$items->id}}">{{$items->institutional_name}}</option>
                                    @endforeach
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

    <div class="row mb-5 mt-4">
        @forelse($data as $item)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <a href="{{route('collection-detail', ['id'=>$item->id])}}">
                    <img class="card-img-top" src="{{$item->banner}}" alt="{{$item->banner}}" height="200" widht="200">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">
                            <a href="{{route('collection-detail', ['id'=>$item->id])}}" class="text-dark">{{App::isLocale('id') ? $item->name : $item->name_en}}</a>
                        </h5>
                        <small class="card-text">
                            @lang('messages.collection_institution') : <a href="{{url('collection-search?place_id=all&media_type=all&topic=all&institutional_id='.App\Model\content_tbl::fieldContent($item->content_id, "institutional_id"))}}">{{\App\Model\institutional::getName($item->content_id)}}</a><br>
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
                                {{--$text = App::isLocale('id') ? strip_tags($item->description_ind) : strip_tags($item->description_en);--}}
                                {{--$limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('collection/detail/'.$item->id)."'> ...readmore</a>" : $text;--}}
                            {{--@endphp--}}
                            {{--{!! $limit_text !!}--}}
                        {{--</p>--}}
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
    {{ $data->links() }}
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection