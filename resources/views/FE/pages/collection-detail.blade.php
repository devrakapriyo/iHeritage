@extends('FE.layout')
@section('content')
<!-- Page Content -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="{{$detail->banner}}" class="card-img-top" width="250" height="250" alt="{{$detail->banner}}">
                <div class="card-body">
                    <a href="" class="btn btn-warning btn-sm btn-block text-uppercase">view collection</a>
                </div>
            </div>
            <div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$detail->map_area_detail}}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/">best wordpress themes</a></div><style>.mapouter{position:relative;text-align:right;height:250px;width:350px;}.gmap_canvas {overflow:hidden;background:none!important;height:250px;width:350px;}</style></div>
            <div class="form-group mt-3">
                <span class="font-weight-lighter">@lang('messages.collection_address') :<br>{{$detail->address}}</span>
            </div>
        </div>
        <div class="col-md-8">
            <h2 class="text-capitalize">{{$detail->name}}</h2>
            @php
                $text = App::isLocale('id') ? $detail->description_ind : $detail->description_en;
            @endphp
            <small>{{$text}}</small>

            <div class="form-group mt-5">
                <p class="text-capitalize">@lang('messages.collection_creator') : <br><strong>{{$detail->creator}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_year') : <br><strong>{{$detail->created_year}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_type') : <br><strong>{{$detail->media_type}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_lang') : <br><strong>{{$detail->lang}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_topic') : <br><strong>{{$detail->topic}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_place') : <br><strong>{{\App\Model\place_tbl::placeNameLang($detail->place_id)}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_physical') : <br><strong>{{$detail->physical_description}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_publisher') : <br><strong>{{$detail->publisher}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_institution') : <br><strong>{{$detail->institution_owner}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_link') : <br><strong>{{$detail->link_url}}</strong></p>
            </div>
            <hr>

        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
@endsection