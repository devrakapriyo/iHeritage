@extends('BE.layout')
@section('ctn-pgs')
    show
@endsection
@section($category)
    active
@endsection
@section('header')
    <style>
        #gmap_canvas{
            width:100%;
            height:30em;
        }

        #map-label,
        #address-examples{
            margin:1em 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">{{str_replace("-", " ",$category)}}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">edit institution</h6>
                        <a href="{{route('content-pages', ['category'=>$category])}}" class="btn btn-success text-capitalize">list institution {{str_replace("-", " ",$category)}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('content-update',['category'=>$category,'id'=>$id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name (Bahasa Indonesia): </label>
                                        <input type="text" name="name" class="form-control" value="{{$content->name}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name (Bahasa Inggris): </label>
                                        <input type="text" name="name_en" class="form-control" value="{{$content->name_en}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Banner : </label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Province : </label>
                                        <select name="place_id" class="form-control" required>
                                            <option value=""></option>
                                            @foreach(App\Model\place_tbl::listSearch() as $item)
                                                <option {{$detail->place_id == $item->id ? "selected" : ""}} value="{{$item->id}}">{{$item->place_ind}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Town Location : </label>
                                        <input type="text" name="location" class="form-control" value="{{$content->location}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name Location :</label>
                                        <input type="text" name="map_area_detail" class="form-control" id="location" value="{{$detail->map_area_detail}}" onchange="check_location()" required>
                                        <input type="hidden" name="latitude_detail" id="latitude" value="{{$detail->latitude_detail}}">
                                        <input type="hidden" name="longitude_detail" id="longitude" value="{{$detail->longitude_detail}}">
                                    </div>
                                    <div id='address-examples'>
                                        <div>Name location examples :</div>
                                        <div>1. Istana Bogor, Indonesia</div>
                                        <div>2. Museum Nasional Indonesia</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="gmap_canvas">Loading map...</div>
                                    <div id='map-label'>Map shows approximate location.</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Street Address : </label>
                                        <textarea name="address" class="form-control" row="3" required>{!! $detail->address !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Link Website : </label>
                                        <input type="text" name="url_website" class="form-control" value="{{$detail->url_website}}">
                                    </div>
                                </div>
                                {{--@if(auth('admin')->user()->is_admin_master == "Y")--}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Link Virtual Reality : </label>
                                        <input type="text" name="url_vr" class="form-control" value="{{$detail->url_vr}}">
                                    </div>
                                </div>
                                {{--@endif--}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Contact Phone : </label>
                                        <input type="text" name="phone" class="form-control" value="{{$detail->phone}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Contact Email : </label>
                                        <input type="email" name="email" class="form-control" value="{{$detail->email}}" required>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="row">--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Short Description (Bahasa Indonesia): </label>--}}
                                        {{--<textarea name="short_description_ind" class="form-control" row="3" required>{!! $content->short_description_ind !!}</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Short Description (Bahasa Inggris): </label>--}}
                                        {{--<textarea name="short_description_en" class="form-control" row="3" required>{!! $content->short_description_en !!}</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description (Bahasa Indonesia): </label>
                                        <textarea name="long_description_ind" class="form-control text-editor" row="5" required>{!! $content->long_description_ind !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description (Bahasa Inggris): </label>
                                        <textarea name="long_description_en" class="form-control text-editor" row="5" required>{!! $content->long_description_en !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">open schedule</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    {{--<div class="row">--}}
                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Sunday : </label>--}}
                                                {{--<input type="text" name="opening_sunday" class="form-control" value="{{$detail->opening_sunday}}">--}}
                                                {{--<small class="text-danger">example value : 09:00 - 15:00</small>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Monday : </label>--}}
                                                {{--<input type="text" name="opening_monday" class="form-control" value="{{$detail->opening_monday}}">--}}
                                                {{--<small class="text-danger">example value : 09:00 - 15:00</small>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Tuesday : </label>--}}
                                                {{--<input type="text" name="opening_tuesday" class="form-control" value="{{$detail->opening_tuesday}}">--}}
                                                {{--<small class="text-danger">example value : 09:00 - 15:00</small>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Wednesday : </label>--}}
                                                {{--<input type="text" name="opening_wednesday" class="form-control" value="{{$detail->opening_wednesday}}">--}}
                                                {{--<small class="text-danger">example value : 09:00 - 15:00</small>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Thursday : </label>--}}
                                                {{--<input type="text" name="opening_thursday" class="form-control" value="{{$detail->opening_thursday}}">--}}
                                                {{--<small class="text-danger">example value : 09:00 - 15:00</small>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Friday : </label>--}}
                                                {{--<input type="text" name="opening_friday" class="form-control" value="{{$detail->opening_friday}}">--}}
                                                {{--<small class="text-danger">example value : 09:00 - 15:00</small>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Saturday : </label>--}}
                                                {{--<input type="text" name="opening_saturday" class="form-control" value="{{$detail->opening_saturday}}">--}}
                                                {{--<small class="text-danger">example value : 09:00 - 15:00</small>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Opening Days (bahasa indonesia): </label>
                                                <input type="text" name="opening_day_ind" class="form-control" value="{{$detail->opening_day_ind}}">
                                                <small class="text-danger">example value : Selasa sampai Minggu</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Opening Days (bahasa inggris): </label>
                                                <input type="text" name="opening_day_en" class="form-control" value="{{$detail->opening_day_en}}">
                                                <small class="text-danger">example value : Tuesday to Sunday</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Opening Hours : </label>
                                                <input type="text" name="opening_hour" class="form-control" value="{{$detail->opening_day_en}}">
                                                <small class="text-danger">example value : 09:00 - 15:00</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Closing Hours (bahasa indonesia): </label>
                                                <input type="text" name="close_ind" class="form-control" value="{{$detail->close_ind}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Closing Hours (bahasa inggris): </label>
                                                <input type="text" name="close_en" class="form-control" value="{{$detail->close_en}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-info btn-block">UPDATE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('footer')
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}"></script>
    <script>
        $(document).ready(function () {
            $("#gmap_canvas").hide();
        });

        function check_location() {
            $.get("{{url('dashboard/map')}}" + "/" + $("#location").val(), function(data){
                $("#gmap_canvas").show();

                var latitude = data.latitude;
                var longitude = data.longitude;
                var address = data.address;

                var myOptions = {
                    zoom: 14,
                    center: new google.maps.LatLng(latitude, longitude),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(latitude, longitude)
                });
                infowindow = new google.maps.InfoWindow({
                    content: address
                });
                google.maps.event.addListener(marker, "click", function () {
                    infowindow.open(map, marker);
                });
                infowindow.open(map, marker);

                $("#latitude").val(latitude);
                $("#longitude").val(longitude);
            });
        }
        google.maps.event.addDomListener(window, 'load', check_location);
    </script>
@endsection