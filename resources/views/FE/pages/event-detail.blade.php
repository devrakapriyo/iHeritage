@extends('FE.layout')
@section('event')
    active
@endsection
@section('header')
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
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

                <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="card-title">@lang('messages.museum_visiting_order')</h5>
                        <form method="post" action="{{url('content-event/'.$id)}}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="institutional_name" class="form-control" placeholder="@lang('messages.museum_institution')" required>
                                <span class="text-danger">{{ $errors->first('institutional_name') }}</span>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" placeholder="@lang('messages.museum_phone')" required>
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            </div>
                            <div class="form-group">
                                <input type="number" name="visitor" class="form-control" min="0" placeholder="@lang('messages.museum_visitor')" required>
                                <span class="text-danger">{{ $errors->first('visitor') }}</span>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<input type="date" name="date" class="form-control" placeholder="@lang('messages.museum_date')" required>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label>@lang('messages.museum_information')</label>
                                <textarea name="information" class="form-control" rows="5" required></textarea>
                                <span class="text-danger">{{ $errors->first('information') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="captcha">Captcha</label>
                                {!! htmlFormSnippet() !!}
                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">@lang('messages.btn_save')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection