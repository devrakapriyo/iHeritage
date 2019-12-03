@extends('FE.layout')
@section('content')
<!-- Page Content -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="{{$detail->banner}}" class="card-img-top" width="250" height="250" alt="{{$detail->banner}}">
                <div class="card-body">
                    <a href="" class="btn btn-warning btn-sm btn-block text-uppercase" data-toggle="modal" data-target="#exampleModal">view collection</a>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <a href="{{$facebook}}" class="btn btn-sm btn-facebook btn-block" target="_blank" title="share facebook"><i class="fa fa-facebook"></i></a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{$twitter}}" class="btn btn-sm btn-twitter btn-block" target="_blank" title="share twitter"><i class="fa fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$detail->map_area_detail}}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/">best wordpress themes</a></div><style>.mapouter{position:relative;text-align:right;height:250px;width:350px;}.gmap_canvas {overflow:hidden;background:none!important;height:250px;width:350px;}</style></div>
        </div>
        <div class="col-md-8">
            <h2 class="text-capitalize">{{$detail->name}}</h2>
            @php
                $text = App::isLocale('id') ? $detail->description_ind : $detail->description_en;
            @endphp
            <small>{!! $text !!}</small>

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

    <!-- Modal -->
    <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$detail->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($detail->media_type == "image")
                        <img src="{{$detail->media}}" class="card-img-top" alt="{{$detail->media}}">
                    @elseif($detail->media_type == "video")
                        <pre id="video"></pre>
                    @elseif($detail->media_type == "audio")
                        <audio controls>
                            <source src="{{$detail->media}}" type="audio/mp3">
                            Your browser does not support the audio element.
                        </audio>
                    @elseif($detail->media_type == "document")
                        {{--<a href="{{$detail->media}}" class="btn btn-block btn-primary" target="_blank">lihat {{$detail->name}}</a>--}}
                        <embed src="{{$detail->media}}" type="application/pdf" style="width: 100%; height: 515px;">
                    @elseif($detail->media_type == "url")
                        <a href="{{$item->media}}" class="btn btn-success btn-block" target="_blank">WEBSITE</a>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container -->
@endsection
@section('footer')
    @if($detail->media_type == "video")
        <script>

            function getId(url) {
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                var match = url.match(regExp);

                if (match && match[2].length == 11) {
                    return match[2];
                } else {
                    return 'error';
                }
            }

            var video = getId('{{$detail->media}}');
            $(document).ready(function(){
                $('#video').html('<iframe style="width: 100%; height: 515px;" src="//www.youtube.com/embed/' + video + '" frameborder="0" allowfullscreen></iframe>');
            });
        </script>
    @endif
@endsection