@extends('FE.layout')
@section('content')
<!-- Page Content -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                @if(($detail->media_type == "url") || ($detail->media_type == "document") || ($detail->media_type == "ebook"))
                    <a href="{{$detail->media}}" target="_blank">
                        <iframe src="{{$detail->media}}" type="application/pdf" style="width: 100%; height: 515px; border-width:0" allowfullscreen="" frameborder="0" scrolling="no"></iframe>
                    </a>
                @elseif($detail->media_type == "video")
                    <pre id="video"></pre>
                @elseif($detail->media_type == "audio")
                    <img src="{{$detail->banner}}" class="card-img-top" width="100%" height="250" alt="{{$detail->banner}}">
                    <div class="container">
                        <audio controls style="width: 100%;margin-top: 15px;">
                            <source src="{{$detail->media}}" type="audio/mp3">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @else
                    <a href="" data-toggle="modal" data-target="#exampleModal">
                        <img src="{{$detail->banner}}" class="card-img-top" width="100%" height="250" alt="{{$detail->banner}}">
                    </a>
                @endif
                <div class="card-body">
                    @if(($detail->media_type == "url") || ($detail->media_type == "document") || ($detail->media_type == "ebook") || ($detail->media_type == "video"))
                        <a href="{{$detail->media}}" target="_blank" class="btn btn-warning btn-sm btn-block text-uppercase">@lang('messages.collection_btn_view')</a>
                    @elseif($detail->media_type == "image")
                        <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-warning btn-sm btn-block text-uppercase">@lang('messages.collection_btn_view')</a>
                    @endif
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <a href="{{$facebook}}" class="btn btn-sm btn-facebook btn-block" target="_blank" title="share facebook"><i class="fa fa-facebook"></i></a>
                        </div>
                        <div class="col-md-6 mt-2">
                            <a href="{{$twitter}}" class="btn btn-sm btn-twitter btn-block" target="_blank" title="share twitter"><i class="fa fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mapouter"><div class="gmap_canvas"><iframe style="width: 100%" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$detail->map_area_detail}}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/">best wordpress themes</a></div><style>.mapouter{position:relative;text-align:right;height:250px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:250px;width:100%;}</style></div>
        </div>
        <div class="col-md-8">
            <h2 class="text-capitalize">{{App::isLocale('id') ? $detail->name : $detail->name_en}}</h2>
            @php
                $text = App::isLocale('id') ? $detail->description_ind : $detail->description_en;
            @endphp
            {!! $text !!}

            <div class="form-group mt-5">
                <p class="text-capitalize">

                </p>
            </div>
            <div class="form-group mt-5">
                <p class="text-capitalize">@lang('messages.collection_creator') : <br><strong>{{$detail->creator}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_year') : <br><strong>{{$detail->created_year}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_type') : <br>
                    <strong>
                        @if($detail->media_type == "url")
                            HTML5
                        @elseif($detail->media_type == "document")
                            PDF
                        @elseif($detail->media_type == "ebook")
                            eBook
                        @else
                            {{$detail->media_type}}
                        @endif
                    </strong>
                </p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">@lang('messages.collection_lang') : <br><strong>{{$detail->lang}}</strong></p>
            </div>
            <hr>
            <div class="form-group">
                <p class="text-capitalize">
                    @lang('messages.collection_topic') : <br>
                    <strong>
                        <a href="{{url('collection-search?place_id=all&media_type=all&topic='.$detail->topic.'&institutional_id=all')}}">@lang('messages.'.$detail->topic)</a>
                    </strong>
                </p>
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
                <p class="text-capitalize">
                    @lang('messages.collection_institution') : <br>
                    <strong><a href="{{url('content/'.App\Model\content_tbl::fieldContent($detail->content_id, "seo").'/'.App\Model\content_tbl::fieldContent($detail->content_id, "id"))}}">{{$detail->institution_owner}}</a></strong>
                </p>
            </div>
            <hr>
            <div class="form-group">
                <p>@lang('messages.collection_link') : <br><strong>{{$detail->link_url}}</strong></p>
            </div>
            <hr>

        </div>
    </div>
    @if(count(\App\Model\content_collection_tbl::listCollectionMetaTopic($id, $detail->topic, 6)) > 0)
        <h3 class="card-title mb-3 mt-5">
            "@lang('messages.heritage_topic_related')"
        </h3>
        <hr>
        <div class="row">
            @foreach(\App\Model\content_collection_tbl::listCollectionMetaTopic($id, $detail->topic, 6) as $item)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <a href="{{route('collection-detail', ['id'=>$item->id])}}">
                            <img class="card-img-top" src="{{$item->banner}}" alt="{{$item->banner}}" height="200" widht="200">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">
                                    <a href="{{route('collection-detail', ['id'=>$item->id])}}" class="text-dark">{{App::isLocale('id') ? $item->name : $item->name_en}}</a>
                                </h5>
                                <small class="card-text">
                                    @lang('messages.collection_institution') : <a href="{{url('collection-search?place_id=all&media_type=all&topic=all&institutional_id='.App\Model\content_tbl::fieldContent($item->content_id, "institutional_id"))}}">{{\App\Model\institutional::getName($item->content_id)}}</a><br>
                                    @lang('messages.collection_topic') : <a href="{{url('collection-search?place_id=all&media_type=all&topic='.$item->topic.'&institutional_id=all')}}">@lang('messages.'.$item->topic)</a><br>
                                    @lang('messages.collection_location') : {{\App\Model\place_tbl::placeNameLang($item->place_id)}}<br>
                                    @lang('messages.collection_type') :
                                    <span class="text text-dark">
                                    @if($item->media_type == "url")
                                            HTML5
                                    @elseif($item->media_type == "document")
                                        PDF
                                    @elseif($item->media_type == "ebook")
                                        eBook
                                    @else
                                        {{$item->media_type}}
                                    @endif
                                </span>
                                </small>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
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
                        <embed src="{{$detail->media}}" style="width: 100%; height: 515px;">
                    @elseif($detail->media_type == "ebook")
                        <embed src="{{$detail->media}}" style="width: 100%; height: 515px;">
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