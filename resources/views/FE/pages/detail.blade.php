@extends('FE.layout')
@section('content')
<!-- Header -->
<header class="ctn-museum-bg py-5" style="background-image: url('{{$detail->photo}}')">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="text-capitalize">{{$detail->name}}</h2>
            @php
                $text = App::isLocale('id') ? $detail->short_description_ind : $detail->short_description_en;
            @endphp
            <small>{{$text}}</small>
            <hr>
            @php
                $text = App::isLocale('id') ? htmlspecialchars_decode($detail->long_description_ind) : htmlspecialchars_decode($detail->long_description_en);
                $btn_loadmore = App::isLocale('id') ? "muat lebih banyak" : "loadmore";
                $limit_text = strlen($text) > 1000 ? substr($text, 0, 1000)."<a class='btn btn-block btn-warning mt-3 text-uppercase' id='btn-loadmore'>".$btn_loadmore."</a>" : $text;
                $next_text = substr($text, 1000);
            @endphp
            {!! $limit_text !!}<span id="page-loadmore">{!! $next_text !!}</span>
            <a class='btn btn-block btn-dark text-white mt-3 text-uppercase' id='btn-hide-loadmore'>@lang('messages.museum_btn_hide_loadmore')</a>

            {{--collection--}}
            @if(count($collection) > 0)
                <div class="form-group mt-5">
                    <h2 class="text-capitalize">@lang('messages.heritage_title')</h2>
                </div>
                <hr>
                <div class="row">
                    @foreach($collection as $item)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="{{route('collection-detail', ['id'=>$item->id])}}">
                                    <img class="card-img-top" src="{{$item->banner}}" alt="{{$item->banner}}" height="200" widht="200">
                                    <div class="card-body">
                                        <h5 class="card-title text-uppercase">
                                            <a href="{{route('collection-detail', ['id'=>$item->id])}}" class="text-dark">{{$item->name}}</a>
                                        </h5>
                                        <small class="card-text">
                                            @lang('messages.collection_address') : {{\App\Model\place_tbl::placeNameLang($item->place_id)}}<br>
                                            media : <span class="text text-{{$color_media[$item->media_type]}}">{{$item->media_type}}</span>
                                        </small>
                                        <hr>
                                        <p class="card-text">
                                            @php
                                                $text = App::isLocale('id') ? htmlspecialchars_decode($item->description_ind) : htmlspecialchars_decode($item->description_en);
                                                $limit_text = strlen($text) > 150 ? substr($text, 0, 150)." ...readmore" : $text;
                                            @endphp
                                            {!! $limit_text !!}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{--education--}}
            @if(count($education) > 0)
                <div class="form-group mt-5">
                    <h2 class="text-capitalize">@lang('messages.edu_title')}</h2>
                </div>
                <hr>
                <div class="row">
                    @foreach($education as $item)
                        <div class="col-md-6">
                            <div class="card h-100">
                                <a href="{{url('education-program/detail/'.$item->seo.'/'.$item->id)}}" class="text-dark">
                                    <img class="card-img-top" src="{{$item->banner}}" alt="" height="200" widht="400">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$item->name}}</h5>
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
                </div>
            @endif

            {{--event--}}
            @if(count($event) > 0)
                <div class="form-group mt-5">
                    <h2 class="text-capitalize">@lang('messages.events_title')}</h2>
                </div>
                <hr>
                <div class="row">
                    @foreach($event as $item)
                        <div class="col-md-6">
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
                                        <h5 class="card-title">{{$item->name}}</h5>
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
                </div>
            @endif

            {{--gallery--}}
            @if(count($gallery) > 0)
                <div class="form-group mt-5">
                    <h2 class="text-capitalize">@lang('messages.museum_gallery_title')</h2>
                </div>
                <hr>
                <div class="row">
                    @foreach($gallery as $item)
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="{{$item->photo}}" class="card-img-top" alt="{{$item->photo}}" height="150" data-toggle="modal" data-target=".bd-example-modal-xl-{{$item->id}}">
                            </div>
                        </div>

                        {{--modal--}}
                        <div class="modal fade bd-example-modal-xl-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <img src="{{$item->photo}}" class="card-img-top" alt="{{$item->photo}}">
                                </div>
                            </div>
                        </div>
                        {{--end modal--}}
                    @endforeach
                </div>
            @endif
            @if(count($gallery) > 3)
                <div class="form-group">
                    <button class="btn btn-block btn-outline-dark text-capitalize">@lang('messages.museum_gallery_button')</button>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$detail->map_area_detail}}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/">best wordpress themes</a></div><style>.mapouter{position:relative;text-align:right;height:250px;width:350px;}.gmap_canvas {overflow:hidden;background:none!important;height:250px;width:350px;}</style></div>
            <div class="form-group mt-3">
                <h5>{{$detail->name}}</h5>
                <span class="font-weight-lighter">{{$detail->address}}<br>
                    {{\App\Model\place_tbl::placeNameLang($detail->place_id)}}</span>
            </div>
            <div class="form-group">
                <p>Website : <a href="{{$detail->url_website}}" target="_blank">{{\Illuminate\Support\Str::replaceArray('http://', [""], $detail->url_website)}}</a></p>
            </div>
            <div class="form-group">
                <p>Phone : {{$detail->phone}}</p>
            </div>
            <div class="form-group">
                <p>Email : {{$detail->email}}</p>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('messages.museum_information_opening')</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @if(!empty($detail->opening_monday))
                    <li class="list-group-item">
                        @lang('messages.museum_information_monday')<br>
                        <strong>{{$detail->opening_monday}}</strong>
                    </li>
                    @endif
                    @if(!empty($detail->opening_tuesday))
                    <li class="list-group-item">
                        @lang('messages.museum_information_tuesday')<br>
                        <strong>{{$detail->opening_tuesday}}</strong>
                    </li>
                    @endif
                    @if(!empty($detail->opening_tuesday))
                    <li class="list-group-item">
                        @lang('messages.museum_information_wednesday')<br>
                        <strong>{{$detail->opening_tuesday}}</strong>
                    </li>
                    @endif
                    @if(!empty($detail->opening_thursday))
                    <li class="list-group-item">
                        @lang('messages.museum_information_thursday')<br>
                        <strong>{{$detail->opening_thursday}}</strong>
                    </li>
                    @endif
                    @if(!empty($detail->opening_friday))
                    <li class="list-group-item">
                        @lang('messages.museum_information_friday')<br>
                        <strong>{{$detail->opening_friday}}</strong>
                    </li>
                    @endif
                    @if(!empty($detail->opening_saturday))
                    <li class="list-group-item">
                        @lang('messages.museum_information_saturday')<br>
                        <strong>{{$detail->opening_saturday}}</strong>
                    </li>
                    @endif
                    @if(!empty($detail->opening_sunday))
                    <li class="list-group-item">
                        @lang('messages.museum_information_sunday')<br>
                        <strong>{{$detail->opening_sunday}}</strong>
                    </li>
                    @endif
                    <li class="list-group-item">
                        @php
                            $close_shedule = App::isLocale('id') ? $detail->close_ind : $detail->close_en;
                        @endphp
                        {{$close_shedule}}
                        <strong class="text-danger">@lang('messages.museum_close')</strong>
                    </li>
                </ul>
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
            $("#page-loadmore").hide();
            $("#btn-hide-loadmore").hide();
            $("#btn-loadmore").show();

            $("#btn-loadmore").on("click", function () {
                $("#page-loadmore").show();
                $("#btn-hide-loadmore").show();
                $("#btn-loadmore").hide();
            });

            $("#btn-hide-loadmore").on("click", function () {
                $("#page-loadmore").hide();
                $("#btn-hide-loadmore").hide();
                $("#btn-loadmore").show();
            });
        });
    </script>
@endsection