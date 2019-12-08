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
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="media_type" class="form-control">
                                    <option value="all">@lang('messages.collection_type')</option>
                                    <option value="document">@lang('messages.collection_type_document')</option>
                                    <option value="audio">@lang('messages.collection_type_audio')</option>
                                    <option value="image">@lang('messages.collection_type_image')</option>
                                    <option value="video">@lang('messages.collection_type_video')</option>
                                    <option value="url">HTML 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="place_id" class="form-control">
                                    <option value="all">@lang('messages.home_select_place')</option>
                                    @foreach(\App\Model\place_tbl::listSearch() as $items)
                                        <option value="{{$items->id}}">{{App::isLocale('id') ? $items->place_ind : $items->place_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                        <div class="offset-md-8 col-md-4">
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
                            <div class="form-group mt-3">
                                <select name="media_type" class="form-control">
                                    <option value="all">@lang('messages.collection_type')</option>
                                    <option value="document">@lang('messages.collection_type_document')</option>
                                    <option value="audio">@lang('messages.collection_type_audio')</option>
                                    <option value="image">@lang('messages.collection_type_image')</option>
                                    <option value="video">@lang('messages.collection_type_video')</option>
                                    <option value="url">HTML 5</option>
                                </select>
                            </div>
                        </div>
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
                            <a href="{{route('collection-detail', ['id'=>$item->id])}}" class="text-dark">{{$item->name}}</a>
                        </h5>
                        <small class="card-text">
                            @lang('messages.collection_institution') : {{\App\Model\institutional::getName($item->content_id)}}<br>
                            @lang('messages.collection_address') : {{\App\Model\place_tbl::placeNameLang($item->place_id)}}<br>
                            media : <span class="text text-{{$color_media[$item->media_type]}}">{{$item->media_type == "url" ? "HTML 5" : $item->media_type}}</span>
                        </small>
                        <hr>
                        <p class="card-text">
                            @php
                                $text = App::isLocale('id') ? strip_tags($item->description_ind) : strip_tags($item->description_en);
                                $limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('collection/detail/'.$item->id)."'> ...readmore</a>" : $text;
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
<!-- /.container -->
@endsection