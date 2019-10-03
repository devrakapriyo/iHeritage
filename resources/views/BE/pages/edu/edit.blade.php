@extends('BE.layout')
@section('edu-program')
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
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">education program</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">add new education program</h6>
                        <a href="{{route('edu-page')}}" class="btn btn-success text-capitalize">list education program</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('edu-post')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Name Education Program : </label>
                                        <input type="text" name="name" class="form-control" value="{{$detail->name}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Content : </label>
                                        <select name="content_id" class="form-control">
                                            @foreach(App\Model\content_tbl::listContent(\Illuminate\Support\Facades\Auth::user()->institutional_id) as $item)
                                                <option {{$detail->content_id == $item->id ? "selected" : ""}} value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <a href="{{route('content-pages', ['category'=>'museum'])}}">Content are not yet available, click here...</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Banner Event : </label>
                                        <input type="file" name="banner" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Closing Hours (bahasa inggris): </label>
                                        <input type="text" name="close_en" class="form-control" value="{{$detail->close_en}}">
                                        <small class="text-danger">example value : National holiday</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Closing Hours (bahasa indonesia): </label>
                                        <input type="text" name="close_ind" class="form-control" value="{{$detail->close_ind}}">
                                        <small class="text-danger">example value : Hari libur nasional</small>
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
                                                <option {{$detail->place_id == $item->id ? "selected" : ""}} value="{{$item->id}}">{{$item->place_ind}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Address:</label>
                                        <input type="text" name="map_area_detail" class="form-control" id="location" value="Istana Bogor, Indonesia" onchange="check_location()">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description (Bahasa Inggris): </label>
                                        <textarea name="description_en" class="form-control" row="3">{!! $detail->description_en !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description (Bahasa Indonesia): </label>
                                        <textarea name="description_ind" class="form-control" row="3">{!! $detail->description_ind !!}</textarea>
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
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Sunday : </label>
                                                <input type="text" name="opening_sunday" class="form-control" value="{{$detail->opening_sunday}}">
                                                <small class="text-danger">example value : 09:00 - 15:00</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Monday : </label>
                                                <input type="text" name="opening_monday" class="form-control" value="{{$detail->opening_monday}}">
                                                <small class="text-danger">example value : 09:00 - 15:00</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tuesday : </label>
                                                <input type="text" name="opening_tuesday" class="form-control" value="{{$detail->opening_tuesday}}">
                                                <small class="text-danger">example value : 09:00 - 15:00</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Wednesday : </label>
                                                <input type="text" name="opening_wednesday" class="form-control" value="{{$detail->opening_wednesday}}">
                                                <small class="text-danger">example value : 09:00 - 15:00</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Thursday : </label>
                                                <input type="text" name="opening_thursday" class="form-control" value="{{$detail->opening_thursday}}">
                                                <small class="text-danger">example value : 09:00 - 15:00</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Friday : </label>
                                                <input type="text" name="opening_friday" class="form-control" value="{{$detail->opening_friday}}">
                                                <small class="text-danger">example value : 09:00 - 15:00</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Saturday : </label>
                                                <input type="text" name="opening_saturday" class="form-control" value="{{$detail->opening_saturday}}">
                                                <small class="text-danger">example value : 09:00 - 15:00</small>
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