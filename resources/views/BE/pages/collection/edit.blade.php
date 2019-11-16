@extends('BE.layout')
@section('ctn-pgs')
    show
@endsection
@section('collection')
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
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">collection</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">edit collection</h6>
                    <a href="{{route('collection-pages')}}" class="btn btn-success text-capitalize">list collection</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post" action="{{route('collection-update', ['id'=>$id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Institution :</label>
                                    <input type="text" name="name" class="form-control" value="{{\App\Model\institutional::getName($detail->content_id)}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title : </label>
                                    <input type="text" name="name" class="form-control" value="{{$detail->name}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Media Type : </label>
                                    <select name="media_type" class="form-control" required>
                                        <option value="{{$detail->media_type}}">{{$detail->media_type}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if($detail->media_type == "video")
                                    <div class="form-group">
                                        <label>Link Youtube : </label>
                                        <input type="text" name="media" class="form-control" placeholder="https://www.youtube.com/watch?v=zLAhRiUeJ8E&list=RDZRztvfiu-RM&index=12" value="{{$detail->media}}" required>
                                        <small class="text-danger">paste your url from youtube</small>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label>Upload Media : </label>
                                        <input type="file" name="media" class="form-control">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Creator : </label>
                                    <input type="text" name="creator" class="form-control" value="{{$detail->creator}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Created Year : </label>
                                    <input type="text" name="created_year" class="form-control" value="{{$detail->created_year}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Language : </label>
                                    <input type="text" name="lang" class="form-control" value="{{$detail->lang}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Topic : </label>
                                    <input type="text" name="topic" class="form-control" value="{{$detail->topic}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Publisher : </label>
                                    <input type="text" name="publisher" class="form-control" value="{{$detail->publisher}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Institution Owner : </label>
                                    <input type="text" name="institution_owner" class="form-control" value="{{$detail->institution_owner}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Link Url : </label>
                                    <input type="text" name="link_url" class="form-control" value="{{$detail->link_url}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Place : </label>
                                    <select name="place_id" class="form-control">
                                        <option value=""></option>
                                        @foreach(App\Model\place_tbl::listSearch() as $item)
                                            <option value="{{$item->id}}" {{$detail->place_id == $item->id ? "selected" : ""}}>{{$item->place_ind}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Address:</label>
                                    <input type="text" name="map_area_detail" class="form-control" id="location" value="{{$detail->map_area_detail}}" onchange="check_location()">
                                    <input type="hidden" name="latitude_detail" id="latitude">
                                    <input type="hidden" name="longitude_detail" id="longitude">
                                </div>
                                <div id='address-examples'>
                                    <div>Address examples:</div>
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
                                    <label>Physical Description :</label>
                                    <input type="text" name="physical_description" class="form-control" value="{{$detail->physical_description}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description (bahasa indonesia):</label>
                                    <textarea name="description_ind" class="form-control text-editor" rows="5">{!! $detail->description_ind !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description (bahasa inggris):</label>
                                    <textarea name="description_en" class="form-control text-editor" rows="5">{!! $detail->description_en !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Upload Banner : </label>
                                    <input type="file" name="banner" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="color:transparent;">btn</label>
                                    <button class="btn btn-info btn-block">UPLOAD</button>
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