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
            @php
                $content_id = \App\Model\content_tbl::select('id')->where('institutional_id', auth('admin')->user()->institutional_id)->first()->id;
            @endphp
            <!-- Area Chart -->
            <div class="col-md-12">
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
                                            @elseif($item->media_type == "url")
                                                <div class="form-group">
                                                    <a href="{{$item->media}}" class="btn btn-success btn-block" target="_blank">WEBSITE</a>
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
                                        <label>Name Collection (Bahasa Indonesia): </label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name Collection (Bahasa Inggris): </label>
                                        <input type="text" name="name_en" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Media Type : </label>
                                        <select name="media_type" class="form-control" id="media_type" required>
                                            <option value=""></option>
                                            <option value="image">Image</option>
                                            <option value="video">Video</option>
                                            <option value="audio">Audio</option>
                                            <option value="document">PDF</option>
                                            <option value="url">HTML5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group" id="media">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Creator : </label>
                                        <input type="text" name="creator" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Created Year : </label>
                                        <input type="text" name="created_year" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Language : </label>
                                        <input type="text" name="lang" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Topic : </label>
                                        <select name="topic" class="form-control" required>
                                            <option value=""></option>
                                            <option value="collection_manuscript">@lang('messages.collection_manuscript')</option>
                                            <option value="collection_traditional_weapon">@lang('messages.collection_traditional_weapon')</option>
                                            <option value="collection_traditional_music">@lang('messages.collection_traditional_music')</option>
                                            <option value="collection_ceramic">@lang('messages.collection_ceramic')</option>
                                            <option value="collection_painting">@lang('messages.collection_painting')</option>
                                            <option value="collection_traditional_house)">@lang('messages.collection_traditional_house')</option>
                                            <option value="collection_performing_arts">@lang('messages.collection_performing_arts')</option>
                                            <option value="collection_temple">@lang('messages.collection_temple')</option>
                                            <option value="collection_statue">@lang('messages.collection_statue')</option>
                                            <option value="collection_crown">@lang('messages.collection_crown')</option>
                                            <option value="collection_jewelry">@lang('messages.collection_jewelry')</option>
                                            <option value="collection_vehicle">@lang('messages.collection_vehicle')</option>
                                            <option value="collection_literature">@lang('messages.collection_literature')</option>
                                            <option value="collection_traditional_cloth">@lang('messages.collection_traditional_cloth')</option>
                                            <option value="collection_movie">@lang('messages.collection_movie')</option>
                                            <option value="collection_inscription">@lang('messages.collection_inscription')</option>
                                            <option value="collection_puppet">@lang('messages.collection_puppet')</option>
                                            <option value="collection_mask">@lang('messages.collection_mask')</option>
                                            <option value="collection_dance">@lang('messages.collection_dance')</option>
                                            <option value="collection_material_art">@lang('messages.collection_material_art')</option>
                                            <option value="collection_history">@lang('messages.collection_history')</option>
                                            <option value="collection_historic_building">@lang('messages.collection_historic_building')</option>
                                            <option value="collection_site">@lang('messages.collection_site')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Publisher : </label>
                                        <input type="text" name="publisher" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Institution Owner : </label>
                                        <input type="text" name="institution_owner" value="{{\App\Model\institutional::getData(auth('admin')->user()->institutional_id, "institutional_name")->institutional_name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Link Url : </label>
                                        <input type="text" name="link_url" value="{{\App\Model\content_detail_tbl::fieldContent($content_id, "url_website")}}" class="form-control">
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
                                                <option value="{{$item->id}}" {{\App\Model\content_detail_tbl::fieldContent($content_id, "place_id") == $item->id ? "selected" : ""}}>{{$item->place_ind}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Address:</label>
                                        <input type="text" name="map_area_detail" class="form-control" id="location" value="{{\App\Model\content_detail_tbl::fieldContent($content_id, "map_area_detail")}}" onchange="check_location()">
                                        <input type="hidden" name="latitude_detail" id="latitude" value="{{\App\Model\content_detail_tbl::fieldContent($content_id, "latitude_detail")}}">
                                        <input type="hidden" name="longitude_detail" id="longitude" value="{{\App\Model\content_detail_tbl::fieldContent($content_id, "longitude_detail")}}">
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
                                        <input type="text" name="physical_description" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description (bahasa indonesia):</label>
                                        <textarea name="description_ind" class="form-control text-editor" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description (bahasa inggris):</label>
                                        <textarea name="description_en" class="form-control text-editor" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="banner">
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

            $("#media_type").on("change", function () {
                $("#media").empty();
                if($("#media_type").val() == "video"){
                    $("#media").append('' +
                        '<label>Link Youtube : </label>\n' +
                        '<input type="text" name="media" class="form-control" placeholder="https://www.youtube.com/watch?v=zLAhRiUeJ8E&list=RDZRztvfiu-RM&index=12">\n' +
                        '<small class="text-danger">paste your url from youtube</small>');

                    $("#banner").append('' +
                        '<div class="col-md-12">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Upload Banner : </label>\n' +
                        '                                    <input type="file" name="banner" class="form-control" required>\n' +
                        '                                </div>\n' +
                        '                            </div>');
                }else if($("#media_type").val() == "audio"){
                    $("#media").append('' +
                        '<label>Link File Audio : </label>\n' +
                        '<input type="text" name="media" class="form-control">\n' +
                        '<small class="text-danger">paste your link repository file audio</small>');

                    $("#banner").append('' +
                        '<div class="col-md-12">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Upload Banner : </label>\n' +
                        '                                    <input type="file" name="banner" class="form-control" required>\n' +
                        '                                </div>\n' +
                        '                            </div>');
                }else if($("#media_type").val() === "url"){
                    $("#media").append('' +
                        '<label>Link Website : </label>\n' +
                        '<input type="text" name="media" class="form-control">\n' +
                        '<small class="text-danger">paste your link website</small>');

                    $("#banner").append('' +
                        '<div class="col-md-12">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Upload Banner : </label>\n' +
                        '                                    <input type="file" name="banner" class="form-control" required>\n' +
                        '                                </div>\n' +
                        '                            </div>');
                }else if($("#media_type").val() === "document"){
                    $("#media").append('' +
                        '<label>Upload Media : </label>\n' +
                        '<input type="file" name="upload_media" class="form-control">\n' +
                        '<small class="text-danger">maximum upload file 5mb</small>');

                    $("#banner").append('' +
                        '<div class="col-md-12">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Upload Banner : </label>\n' +
                        '                                    <input type="file" name="banner" class="form-control" required>\n' +
                        '                                </div>\n' +
                        '                            </div>');
                }else if($("#media_type").val() === "image"){
                    $("#media").append('' +
                        '<label>Upload Media : </label>\n' +
                        '<input type="file" name="upload_media" class="form-control">\n' +
                        '<small class="text-danger">maximum upload file 5mb</small>')
                }
            });
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