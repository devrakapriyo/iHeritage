@extends('FE.layout')
@section('event')
    active
@endsection
@section('content')

    <div class="container">
        <!-- Page Search Desktop-->
        <div class="mt-5 mb-2 d-none d-lg-block">
            <div class="card bg-light">
                <div class="card-body">
                    <h3 class="card-title mb-3">
                        @lang('messages.event_title')
                    </h3>
                    <form method="get" action="{{url('event-search')}}">
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="price" class="form-control">
                                        <option value="all">@lang('messages.event_category_ticket')</option>
                                        <option value="free">@lang('messages.event_free_price')</option>
                                        <option value="paid">@lang('messages.event_paid_price')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="duration" class="form-control">
                                        <option value="duration">@lang('messages.event_duration')</option>
                                        <option value="current">@lang('messages.event_current')</option>
                                        <option value="upcoming">@lang('messages.event_upcoming')</option>
                                        <option value="archive">@lang('messages.event_archive')</option>
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
                        @lang('messages.event_title')
                    </h3>
                    <form method="get" action="{{url('event-search')}}">
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
                                    <select name="price" class="form-control">
                                        <option value="all">@lang('messages.event_category_ticket')</option>
                                        <option value="free">@lang('messages.event_free_price')</option>
                                        <option value="paid">@lang('messages.event_paid_price')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="duration" class="form-control">
                                        <option value="duration">@lang('messages.event_duration')</option>
                                        <option value="current">@lang('messages.event_current')</option>
                                        <option value="upcoming">@lang('messages.event_upcoming')</option>
                                        <option value="archive">@lang('messages.event_archive')</option>
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
            <div class="col-md-4">
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