@extends('FE.layout')
@section('collection')
    active
@endsection
@section('content')
<!-- Page Content -->
<div class="container">
    <h2 class="text-capitalize mt-5">@lang('messages.heritage_title')</h2>
    <hr>
    <div class="row mb-5 mt-4">
        @foreach($data as $item)
        <div class="col-md-4">
            <a href="{{route('collection-detail', ['id'=>$item->id])}}">
                <div class="card h-100">
                    <img class="card-img-top" src="{{$item->banner}}" alt="{{$item->banner}}" height="200" widht="200">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">
                            <a href="{{route('collection-detail', ['id'=>$item->id])}}" class="text-dark">{{$item->name}}</a>
                        </h5>
                        <p class="card-text">
                            institutional : {{\App\Model\institutional::getName($item->content_id)}}<br>
                            place : {{\App\Model\place_tbl::placeNameLang($item->place_id)}}<br>
                            media : <span class="text text-{{$color_media[$item->media_type]}}">{{$item->media_type}}</span>
                        </p>
                        <p class="card-text">
                            @php
                                $text = App::isLocale('id') ? $item->description_ind : $item->description_en;
                                $limit_text = strlen($text) > 250 ? substr($text, 0, 250)." ... readmore" : $text;
                            @endphp
                            {{$limit_text}}
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection