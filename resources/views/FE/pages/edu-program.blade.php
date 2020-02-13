@extends('FE.layout')
@section('education-program')
    active
@endsection
@section('content')

    <div class="container">
        <!-- Page Search Desktop-->
        <div class="mt-5 mb-2 d-none d-lg-block">
            <div class="card bg-light">
                <div class="card-body">
                    <h3 class="card-title mb-3">
                        @lang('messages.edu_title')
                    </h3>
                    <form method="get" action="{{url('education-program-search')}}">
                        <div class="row">
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
                            <div class="col-md-4">
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
                        @lang('messages.edu_title')
                    </h3>
                    <form method="get" action="{{url('education-program-search')}}">
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
@endsection