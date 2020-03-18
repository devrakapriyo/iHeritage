@extends('FE.layout')
@section('header')
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
@endsection
@section('content')
<!-- Header -->
<header class="ctn-museum-bg py-5" style="background: url('{{$detail->photo}}') no-repeat center center fixed; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 mt-2">
            <h2 class="text-capitalize">{{App::isLocale('id') ? $detail->name : $detail->name_en}}</h2>
            {{--@php--}}
                {{--$text = App::isLocale('id') ? $detail->short_description_ind : $detail->short_description_en;--}}
            {{--@endphp--}}
            {{--<small>{{$text}}</small>--}}
            <hr>

            @php
                $text_nonrender = App::isLocale('id') ? $detail->long_description_ind : $detail->long_description_en;
                $text = App::isLocale('id') ? strip_tags($detail->long_description_ind) : strip_tags($detail->long_description_en);
                $short_text = strlen($text) > 1000 ? substr($text, 0, 1000) : $text_nonrender;
            @endphp
            <div id="short">
                {!! $short_text !!}
            </div>
            <div id="long">
                {!! $text_nonrender !!}
            </div>

            <a class='btn btn-block btn-dark text-white mt-3 text-uppercase' id='hide'><i class="fa fa-minus fa-2x"></i></a>
            <a class='btn btn-block btn-light mt-3 text-uppercase' id='show' style="border: 1px #bdc3c7 solid;"><i class="fa fa-plus fa-2x"></i></a>

            {{--collection--}}
            @if(count($collection) > 0)
                <div class="form-group mt-5">
                    <h2 class="text-capitalize">@lang('messages.heritage_title')</h2>
                </div>
                <hr>
                <div class="row">
                    @foreach(\App\Model\content_collection_tbl::listCollection($id, 4) as $item)
                        <div class="col-md-6 mb-4">
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
                    @endforeach
                    @if(count($collection) > 4)
                        <div class="col-md-12">
                            <a href="{{url('collection-search?place_id=all&media_type=all&topic=all&institutional_id='.\App\Model\content_tbl::fieldContent($id, "institutional_id"))}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.heritage_title')</a>
                        </div>
                    @endif
                </div>
            @endif

            {{--education--}}
            @if(count($education) > 0)
                <div class="form-group mt-5">
                    <h2 class="text-capitalize">@lang('messages.edu_title')</h2>
                </div>
                <hr>
                <div class="row">
                    @foreach(\App\Model\content_edu_tbl::listEducation($id, 4) as $item)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="{{url('education-program/detail/'.$item->seo.'/'.$item->id)}}" class="text-dark">
                                    <img class="card-img-top" src="{{$item->banner}}" alt="" height="200" widht="400">
                                    <div class="card-body">
                                        <h5 class="card-title">{{App::isLocale('id') ? $item->name : $item->name_en}}</h5>
                                        <p class="card-text">
                                            <small class="card-text text-uppercase">{{$item->map_area_detail}}</small>
                                        </p>
                                        @php
                                            $text = App::isLocale('id') ? htmlspecialchars_decode($item->description_ind) : htmlspecialchars_decode($item->description_en);
                                            $text = stripslashes($text);
                                            $limit_text = strlen($text) > 150 ? substr($text, 0, 150)."<a href='".url('education-program/detail/'.$item->seo.'/'.$item->id)."'> ...readmore</a>" : $text;
                                        @endphp
                                        <p class="card-text">{!! $limit_text !!}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @if(count($education) > 4)
                        <div class="col-md-12">
                            <a href="{{url('education-program-search?place_id=all&institutional_id='.\App\Model\content_tbl::fieldContent($id, "institutional_id"))}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.edu_title')</a>
                        </div>
                    @endif
                </div>
            @endif

            {{--event--}}
            @if(count($event) > 0)
                <div class="form-group mt-5">
                    <h2 class="text-capitalize">@lang('messages.event_title')</h2>
                </div>
                <hr>
                <div class="row">
                    @foreach(\App\Model\content_event_tbl::listEvent($id, 4) as $item)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="{{url('event/detail/'.$item->seo.'/'.$item->id)}}" class="text-dark">
                                    <img class="card-img-top" src="{{$item->banner}}" alt="" height="200" widht="400">
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
                                            {{App::isLocale('id') ? $item->name : $item->name_en}}
                                        </h5>
                                        <small class="card-text" title="{{$item->map_area_detail}}">
                                            @php
                                                $text = $item->map_area_detail;
                                                $limit_text = substr($text, 0, 150);
                                                $more = strlen($text) <= 150 ? "" : "...";
                                            @endphp
                                            {{$limit_text}}{{$more}}
                                        </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @if(count($event) > 4)
                        <div class="col-md-12">
                            <a href="{{url('event-search?place_id=all&price=all&duration=all&institutional_id='.\App\Model\content_tbl::fieldContent($id, "institutional_id"))}}" class="btn btn-dark btn-block mb-5">@lang('messages.home_more_search') @lang('messages.event_title')</a>
                        </div>
                    @endif
                </div>
            @endif

            {{--gallery--}}
            @if(count($gallery) > 0)
                <div class="form-group mt-5">
                    <h2 class="text-capitalize">@lang('messages.museum_gallery_title')</h2>
                </div>
                <hr>
                <div class="row">
                    @foreach($gallery as $key => $item)
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="{{$item->photo}}" class="card-img-top d-none d-lg-block" alt="{{$item->photo}}" height="150" data-toggle="modal" data-target=".bd-example-modal-xl">
                                <img src="{{$item->photo}}" class="card-img-top d-lg-none" alt="{{$item->photo}}" data-toggle="modal" data-target=".bd-example-modal-xl">
                                @if(($item->description_ind != "") || ($item->description_en != ""))
                                    <div class="card-body">
                                        <small class="d-none d-lg-block">{{App::isLocale('id') ? $item->description_ind : $item->description_en}}</small>
                                        <p class="d-lg-none">{{App::isLocale('id') ? $item->description_ind : $item->description_en}}</p>
                                    </div>
                                @endif
                                @if($key == 0)
                                    <div class="card-footer">
                                        <a data-toggle="modal" data-target=".bd-example-modal-xl" class="btn btn-dark btn-block text-white">@lang('messages.home_detail_btn_photo')</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{--modal--}}
                    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">

                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach(\App\Model\content_gallery_tbl::listGallery($id, "all") as $key => $slider)
                                            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                                <img src="{{$slider->photo}}" class="d-lg-block w-100"  alt="...">
                                                <div class="carousel-caption d-none d-lg-block">
                                                    <h3 class="text-uppercase">{{App::isLocale('id') ? $slider->description_ind : $slider->description_en}}</h3>
                                                </div>
                                                <div class="carousel-caption d-lg-none">
                                                    <p class="text-uppercase">{{App::isLocale('id') ? $slider->description_ind : $slider->description_en}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{--end modal--}}
                </div>
            @endif
            {{--@if(count($gallery) > 3)--}}
                {{--<div class="form-group">--}}
                    {{--<button class="btn btn-block btn-outline-dark text-capitalize">@lang('messages.museum_gallery_button')</button>--}}
                {{--</div>--}}
            {{--@endif--}}
        </div>
        <div class="col-md-4 mt-2">
            <div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$detail->map_area_detail}}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/">best wordpress themes</a></div><style>.mapouter{position:relative;text-align:right;height:250px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:250px;width:100%;}</style></div>
            <div class="form-group mt-3">
                <h5>{{$detail->name}}</h5>
                <span class="font-weight-lighter">{{$detail->address}}<br>
                    {{\App\Model\place_tbl::placeNameLang($detail->place_id)}}</span>
            </div>
            <div class="form-group">
                <p>
                    Website :
                    @if(($detail->url_website == "") || ($detail->url_website == null) || ($detail->url_website == "-"))
                        -
                    @else
                        <a href="{{$detail->url_website}}" target="_blank">{{\Illuminate\Support\Str::replaceArray('http://', [""], $detail->url_website)}}</a>
                    @endif
                </p>
            </div>
            <div class="form-group">
                <p>Phone : {{$detail->phone}}</p>
            </div>
            <div class="form-group">
                <p>Email : {{$detail->email}}</p>
            </div>
            <div class="form-group">
                @if($detail->url_vr != "")
                    {{--<a class="btn btn-primary btn-block" href="{{auth('visitor')->check() ? $detail->url_vr : route('login-visitor-vr', ['content_id'=>$id])}}" target="_blank">@lang('messages.home_detail_btn_vr')</a>--}}
                    <a class="btn btn-primary btn-block" href="{{route('login-visitor-vr', ['content_id'=>$id])}}" target="_blank">@lang('messages.home_detail_btn_vr')</a>
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('messages.museum_information_opening')</h5>
                </div>
                <ul class="list-group list-group-flush">
                    {{--@if(!empty($detail->opening_monday))--}}
                    {{--<li class="list-group-item">--}}
                        {{--@lang('messages.museum_information_monday')<br>--}}
                        {{--<strong>{{$detail->opening_monday}}</strong>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                    {{--@if(!empty($detail->opening_tuesday))--}}
                    {{--<li class="list-group-item">--}}
                        {{--@lang('messages.museum_information_tuesday')<br>--}}
                        {{--<strong>{{$detail->opening_tuesday}}</strong>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                    {{--@if(!empty($detail->opening_tuesday))--}}
                    {{--<li class="list-group-item">--}}
                        {{--@lang('messages.museum_information_wednesday')<br>--}}
                        {{--<strong>{{$detail->opening_tuesday}}</strong>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                    {{--@if(!empty($detail->opening_thursday))--}}
                    {{--<li class="list-group-item">--}}
                        {{--@lang('messages.museum_information_thursday')<br>--}}
                        {{--<strong>{{$detail->opening_thursday}}</strong>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                    {{--@if(!empty($detail->opening_friday))--}}
                    {{--<li class="list-group-item">--}}
                        {{--@lang('messages.museum_information_friday')<br>--}}
                        {{--<strong>{{$detail->opening_friday}}</strong>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                    {{--@if(!empty($detail->opening_saturday))--}}
                    {{--<li class="list-group-item">--}}
                        {{--@lang('messages.museum_information_saturday')<br>--}}
                        {{--<strong>{{$detail->opening_saturday}}</strong>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                    {{--@if(!empty($detail->opening_sunday))--}}
                    {{--<li class="list-group-item">--}}
                        {{--@lang('messages.museum_information_sunday')<br>--}}
                        {{--<strong>{{$detail->opening_sunday}}</strong>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                    <li class="list-group-item">
                        {{App::isLocale('id') ? $detail->opening_day_ind : $detail->opening_day_en}}<br>
                        <strong>{{$detail->opening_hour}}</strong>
                    </li>
                    <li class="list-group-item">
                        @php
                            $close_shedule = App::isLocale('id') ? $detail->close_ind : $detail->close_en;
                        @endphp
                        {{$close_shedule}}
                        <strong class="text-danger">@lang('messages.museum_close')</strong>
                    </li>
                </ul>
            </div>

            @if(($detail->category_ctn_id == 1) || ($detail->category_ctn_id == 4) || ($detail->category_ctn_id == 5) || ($detail->category_ctn_id == 7) || ($detail->category_ctn_id == 12) || ($detail->category_ctn_id == 6))
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">@lang('messages.museum_visiting_price')</h5>
                    @if(($detail->price_student == 0) && ($detail->price_college_student == 0) && ($detail->price_adult == 0))
                        <strong class="text-success">@lang('messages.event_free_price')</strong>
                    @else
                        @lang('messages.museum_visiting_student') : {!! "Rp. ".number_format($detail->price_student) !!}<br>
                        @lang('messages.museum_visiting_college_student') : {!! "Rp. ".number_format($detail->price_college_student) !!}<br>
                        @lang('messages.museum_visiting_adult') : {!! "Rp. ".number_format($detail->price_adult) !!}
                    @endif
                </div>
            </div>
            @endif

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">@lang('messages.museum_visiting_order')</h5>
                    <form method="post" action="{{url('content/'.$id)}}">
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
                        <div class="form-group">
                            <input type="date" name="date" class="form-control" placeholder="@lang('messages.museum_date')" required>
                        </div>
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
@section('footer')
    <script>
        $(document).ready(function () {

            $("#long").hide();
            $("#short").show();

            $("#hide").hide();
            $("#show").show();

            $("#hide").click(function(){
                $("#long").hide();
                $("#short").show();

                $("#hide").hide();
                $("#show").show();
            });

            $("#show").click(function(){
                $("#long").show();
                $("#short").hide();

                $("#hide").show();
                $("#show").hide();
            });
        });
    </script>
@endsection