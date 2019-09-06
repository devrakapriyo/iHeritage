@extends('FE.layout')
@section('content')
<!-- Header -->
<header class="ctn-museum-bg py-5">
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
                $description = App::isLocale('id') ? $detail->long_description_ind : $detail->long_description_en;
            @endphp
            {{$description}}

            <div class="form-group mt-5">
                <h2 class="text-capitalize">@lang('messages.museum_gallery_title') {{$detail->name}}</h2>
            </div>
            <hr>
            @foreach($gallery as $item)
                <div class="card mb-3">
                    <img src="{{$item->photo}}" class="card-img-top" alt="...">
                </div>
            @endforeach
            @if(count($gallery) > 3)
            <div class="form-group">
                <button class="btn btn-block btn-outline-dark text-capitalize">@lang('messages.museum_gallery_button')</button>
            </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q=museum%20kepresidenan&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/">best wordpress themes</a></div><style>.mapouter{position:relative;text-align:right;height:250px;width:350px;}.gmap_canvas {overflow:hidden;background:none!important;height:250px;width:350px;}</style></div>
            <div class="form-group mt-3">
                <h5>{{$detail->name}}</h5>
                <p>{{$detail->address}}</p>
            </div>
            <div class="form-group">
                <h5>@lang('messages.museum_information')</h5>
                <p>Virtual Reality Tour 360&deg; : <a href="{{$detail->url_vr}}" target="_blank">{{\Illuminate\Support\Str::replaceArray('http://', [""], $detail->url_vr)}}</a></p>
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
                    <li class="list-group-item">
                        @lang('messages.museum_information_monday')<br>
                        <strong>{{$detail->opening_monday}}</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_tuesday')<br>
                        <strong>{{$detail->opening_tuesday}}</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_wednesday')<br>
                        <strong>{{$detail->opening_wednesday}}</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_thursday')<br>
                        <strong>{{$detail->opening_thursday}}</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_friday')<br>
                        <strong>{{$detail->opening_friday}}</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_saturday')<br>
                        <strong>{{$detail->opening_saturday}}</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_sunday')<br>
                        <strong>{{$detail->opening_sunday}}</strong>
                    </li>
                    <li class="list-group-item">
                        @php
                            $close = App::isLocale('id') ? $detail->close_ind : $detail->close_en;
                        @endphp
                        {{$close}}
                        <strong class="text-danger">(CLOSE)</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
@endsection