@extends('FE.layout')
@section('content')

    <!-- Page Content -->
    <div class="container mt-5">
        <h2 class="text-capitalize">@lang('messages.news_title')</h2>
        <hr>
        <div class="row mt-4 mb-5">
            @foreach($data as $item)
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-3">
                            <img src="{{$item->banner}}" class="card-img ctn-vr-thumbnail" alt="{{$item->banner}}">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><a href="{{url('news/detail/'.$item->id)}}" class="text-dark">{{App::isLocale('id') ? $item->title_ind : $item->title_en}}</a></h5>
                                @php
                                    $text = App::isLocale('id') ? $item->description_ind : $item->description_en;
                                    $text = stripslashes($text);
                                    $limit_text = substr($text, 0, 150);
                                @endphp
                                <p class="card-text">{{$limit_text}} <a href="{{url('news/detail/'.$item->id)}}">...readmore</a></p>
                                <p class="card-text"><small class="text-muted text-white">{{$item->created_at->diffForHumans()}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection