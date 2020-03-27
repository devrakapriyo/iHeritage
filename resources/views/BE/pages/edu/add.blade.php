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
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages_be.education_title')</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.education_add')</h6>
                    <a href="{{route('edu-page')}}" class="btn btn-success text-capitalize">@lang('messages_be.education_list')</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post" action="{{route('edu-post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('messages.home_select_heritage') : </label>
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
                                    <label>@lang('messages_be.education_input_name') (Bahasa Indonesia): </label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('messages_be.education_input_name') (Bahasa Inggris): </label>
                                    <input type="text" name="name_en" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Banner : </label>
                                    <input type="file" name="banner" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('messages.home_select_place') : </label>
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
                                    <label>@lang('messages_be.content_input_location') :</label>
                                    <input type="text" name="map_area_detail" class="form-control" id="location" value="{{\App\Model\content_detail_tbl::fieldContent($content_id, "map_area_detail")}}" onchange="check_location()" required>
                                    <input type="hidden" name="latitude_detail" id="latitude" value="{{\App\Model\content_detail_tbl::fieldContent($content_id, "latitude_detail")}}">
                                    <input type="hidden" name="longitude_detail" id="longitude" value="{{\App\Model\content_detail_tbl::fieldContent($content_id, "longitude_detail")}}">
                                </div>
                                <div id='address-examples'>
                                    <div>Location Name examples:</div>
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
                                    <label>@lang('messages_be.content_input_description') (Bahasa Indonesia): </label>
                                    <textarea name="description_ind" class="form-control text-editor" row="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('messages_be.content_input_description') (Bahasa Inggris): </label>
                                    <textarea name="description_en" class="form-control text-editor" row="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.info_schedule')</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('messages.museum_information_sunday') : </label>
                                            <input type="text" name="opening_sunday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('messages.museum_information_monday') : </label>
                                            <input type="text" name="opening_monday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('messages.museum_information_tuesday') : </label>
                                            <input type="text" name="opening_tuesday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('messages.museum_information_wednesday') : </label>
                                            <input type="text" name="opening_wednesday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('messages.museum_information_thursday') : </label>
                                            <input type="text" name="opening_thursday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('messages.museum_information_friday') : </label>
                                            <input type="text" name="opening_friday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>@lang('messages.museum_information_saturday') : </label>
                                            <input type="text" name="opening_saturday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('messages_be.info_closing_day') (bahasa indonesia): </label>
                                    <input type="text" name="close_ind" class="form-control" required>
                                    <small class="text-danger">example value : Senin - Sabtu</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('messages_be.info_closing_day') (bahasa inggris): </label>
                                    <input type="text" name="close_en" class="form-control" required>
                                    <small class="text-danger">example value : Monday - Saturday</small>
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