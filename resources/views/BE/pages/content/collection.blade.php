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
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">{{\App\Model\content_tbl::fieldContent($id,"name")}}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">add new collection</h6>
                        <a href="{{route('content-pages', ['category'=>$category])}}" class="btn btn-success text-capitalize">list content {{str_replace("-", " ",$category)}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('content-collection-upload',['category'=>$category,'id'=>$id])}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name : </label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Media Type : </label>
                                        <select name="media_type" class="form-control">
                                            <option value=""></option>
                                            <option value="image">Image</option>
                                            <option value="video">Video</option>
                                            <option value="audio">Audio</option>
                                            <option value="document">Document</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Upload Media : </label>
                                        <input type="file" name="media" class="form-control">
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
                                                <option value="{{$item->id}}">{{$item->place_ind}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Address:</label>
                                        <input type="text" name="map_area_detail" class="form-control" id="location" value="{{\App\Model\content_tbl::fieldContent($id,"name")}}, {{\App\Model\content_tbl::fieldContent($id,"location")}}" onchange="check_location()">
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
                                        <label>Description :</label>
                                        <textarea name="description" class="form-control" rows="5"></textarea>
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

                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary text-capitalize">collection content</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="row">
                                    @foreach($collection as $item)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    @if($item->media_type == "image")
                                                        <div class="form-group">
                                                            <label>Photo</label>
                                                            <div class="alert alert-secondary" role="alert">
                                                                <a href="{{$item->media}}" target="_blank">lihat {{$item->name}}</a>
                                                            </div>
                                                        </div>
                                                    @elseif($item->media_type == "video")
                                                        <div class="form-group">
                                                            <label>Video</label>
                                                            <div class="alert alert-secondary" role="alert">
                                                                <a href="{{$item->media}}" target="_blank">lihat {{$item->name}}</a>
                                                            </div>
                                                        </div>
                                                    @elseif($item->media_type == "audio")
                                                        <div class="form-group">
                                                            <label>{{$item->name}}</label>
                                                            <audio controls>
                                                                <source src="{{$item->media}}" type="audio/mp3">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        </div>
                                                    @elseif($item->media_type == "document")
                                                        <div class="form-group">
                                                            <label>Dokumen</label>
                                                            <div class="alert alert-secondary" role="alert">
                                                                <a href="{{$item->media}}" target="_blank">lihat {{$item->name}}</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <a href="{{route('content-collection-delete',['category'=>$category,'id'=>$item->id])}}" class="btn btn-block btn-danger">Delete Collection</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
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