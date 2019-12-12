@extends('FE.layout')
@section('education-program')
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
                                $description = App::isLocale('id') ? $detail->description_ind : $detail->description_en;
                            @endphp
                            {!! $description !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$detail->map_area_detail}}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/">best wordpress themes</a></div><style>.mapouter{position:relative;text-align:right;height:250px;width:350px;}.gmap_canvas {overflow:hidden;background:none!important;height:250px;width:350px;}</style></div>
                <div class="form-group mt-3">
                    <h5>@lang('messages.edu_information')</h5>
                </div>
                <div class="form-group">
                    <p>
                        <span class="font-weight-bold">@lang('messages.event_location')</span><br>
                        <span class="font-weight-lighter">{{$detail->map_area_detail}}<br>
                            {{\App\Model\place_tbl::placeNameLang($detail->place_id)}}</span>
                    </p>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@lang('messages.edu_information_opening')</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if(!empty($detail->opening_monday))
                            <li class="list-group-item">
                                @lang('messages.edu_information_monday')<br>
                                <strong>{{$detail->opening_monday}}</strong>
                            </li>
                        @endif
                        @if(!empty($detail->opening_tuesday))
                            <li class="list-group-item">
                                @lang('messages.edu_information_tuesday')<br>
                                <strong>{{$detail->opening_tuesday}}</strong>
                            </li>
                        @endif
                        @if(!empty($detail->opening_tuesday))
                            <li class="list-group-item">
                                @lang('messages.edu_information_wednesday')<br>
                                <strong>{{$detail->opening_tuesday}}</strong>
                            </li>
                        @endif
                        @if(!empty($detail->opening_thursday))
                            <li class="list-group-item">
                                @lang('messages.edu_information_thursday')<br>
                                <strong>{{$detail->opening_thursday}}</strong>
                            </li>
                        @endif
                        @if(!empty($detail->opening_friday))
                            <li class="list-group-item">
                                @lang('messages.edu_information_friday')<br>
                                <strong>{{$detail->opening_friday}}</strong>
                            </li>
                        @endif
                        @if(!empty($detail->opening_saturday))
                            <li class="list-group-item">
                                @lang('messages.edu_information_saturday')<br>
                                <strong>{{$detail->opening_saturday}}</strong>
                            </li>
                        @endif
                        @if(!empty($detail->opening_sunday))
                            <li class="list-group-item">
                                @lang('messages.edu_information_sunday')<br>
                                <strong>{{$detail->opening_sunday}}</strong>
                            </li>
                        @endif
                        <li class="list-group-item">
                            @php
                                $close_shedule = App::isLocale('id') ? $detail->close_ind : $detail->close_en;
                            @endphp
                            {{$close_shedule}}
                            <strong class="text-danger">@lang('messages.edu_close')</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection