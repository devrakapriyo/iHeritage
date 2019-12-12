@extends('BE.layout')
@section('event')
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
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">event</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        @php
            $content_id = \App\Model\content_tbl::select('id')->where('institutional_id', auth('admin')->user()->institutional_id)->first()->id;
        @endphp
        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">add new event</h6>
                    <a href="{{route('event-page')}}" class="btn btn-success text-capitalize">list event</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post" action="{{route('event-post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Institution : </label>
                                    @if(auth('admin')->user()->is_admin_master == "Y")
                                        <select name="content_id" class="form-control" required>
                                            <option value=""></option>
                                            @foreach($content as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="hidden" name="content_id" value="{{\App\Model\content_tbl::content(auth('admin')->user()->institutional_id)->id}}">
                                        <input type="text" value="{{\App\Model\content_tbl::content(auth('admin')->user()->institutional_id)->name}}" class="form-control" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name Event (Bahasa Indonesia): </label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name Event (Bahasa Inggris): </label>
                                    <input type="text" name="name_en" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Banner Event : </label>
                                    <input type="file" name="banner" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date : </label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date : </label>
                                    <input type="date" name="end_date" class="form-control" required>
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
                                            <option value="{{$item->id}}" {{\App\Model\content_detail_tbl::fieldContent($content_id, "place_id") == $item->id ? "selected" : ""}}>{{$item->place_ind}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Location Name :</label>
                                    <input type="text" name="map_area_detail" class="form-control" id="location" value="{{\App\Model\content_detail_tbl::fieldContent($content_id, "map_area_detail")}}" onchange="check_location()" required>
                                    <input type="hidden" name="latitude_detail" id="latitude" value="{{\App\Model\content_detail_tbl::fieldContent($content_id, "latitude_detail")}}">
                                    <input type="hidden" name="longitude_detail" id="longitude" value="{{\App\Model\content_detail_tbl::fieldContent($content_id, "latitude_detail")}}">
                                </div>
                                <div id='address-examples'>
                                    <div>Location Name examples :</div>
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
                                    <label>Ticket Price : </label>
                                    <input type="text" name="price" class="form-control">
                                    <small class="text-danger">if the event is free then empty it</small>
                                </div>
                            </div>
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Close Registration : </label>--}}
                                    {{--<input type="datetime-local" name="close_registration" class="form-control" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short Description (Bahasa Indonesia): </label>
                                    <textarea name="short_description_ind" class="form-control" row="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short Description (Bahasa Inggris): </label>
                                    <textarea name="short_description_en" class="form-control" row="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Long Description (Bahasa Indonesia): </label>
                                    <textarea name="long_description_ind" class="form-control text-editor" row="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Long Description (Bahasa Inggris): </label>
                                    <textarea name="long_description_en" class="form-control text-editor" row="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-info btn-block">SAVE</button>
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