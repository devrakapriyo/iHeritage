@extends('FE.layout')
@section('event')
    active
@endsection
@section('content')
    <!-- Page Content -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <img src="{{$detail->banner}}" class="card-img-top" alt="{{$detail->banner}}">
                    <div class="card-body">
                        <h5 class="card-title">{{App::isLocale('id') ? $detail->name : $detail->name_en}}</h5>
                        <p class="card-text">
                            @php
                                $description = App::isLocale('id') ? $detail->long_description_ind : $detail->long_description_en;
                            @endphp
                            {!! $description !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$detail->map_area_detail}}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/">best wordpress themes</a></div><style>.mapouter{position:relative;text-align:right;height:250px;width:350px;}.gmap_canvas {overflow:hidden;background:none!important;height:250px;width:350px;}</style></div>
                <div class="form-group mt-3">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>{{App::isLocale('id') ? $detail->name : $detail->name_en}}</h5>
                        </div>
                        <div class="col-md-5">
                            <small class="btn btn-sm btn-success text-capitalize float-right">{{$detail->price == 0 ? App::isLocale('id') ? "Gratis" : "Free" : "Rp. ".number_format($detail->price) }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h5>@lang('messages.event_information')</h5>
                </div>
                <div class="form-group">
                    <p>
                        <span class="font-weight-bold">@lang('messages.event_date')</span><br>
                        <span class="font-weight-lighter">{{\App\Helper\helpers::dateFormat($detail->start_date)}}<br>
                            {{\App\Helper\helpers::dateFormat($detail->end_date)}}</span>
                    </p>
                </div>
                <div class="form-group">
                    <p>
                        <span class="font-weight-bold">@lang('messages.event_location')</span><br>
                        <span class="font-weight-lighter">{{$detail->map_area_detail}}<br>
                            {{\App\Model\place_tbl::placeNameLang($detail->place_id)}}</span>
                    </p>
                </div>
                {{--<div class="form-group">--}}
                    {{--<p>--}}
                        {{--<span class="font-weight-bold">@lang('messages.event_close')</span><br>--}}
                        {{--<span class="badge badge-danger">{{\App\Helper\helpers::dateFormatTime($detail->close_registration)}}</span>--}}
                    {{--</p>--}}
                {{--</div>--}}
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection