@extends('FE.layout')
@section('content')

    <!-- Page Content -->
    <div class="container mt-5">
        <div class="row mt-4 mb-5">
            <div class="col-md-7">
                <div class="card">
                    <img src="{{$data->banner}}" class="card-img-top" alt="{{$data->banner}}">
                    <div class="card-body">
                        <h5 class="card-title">{{App::isLocale('id') ? $data->title_ind : $data->title_en}}</h5>
                        <p class="card-text"><small class="text-muted">{{$data->created_at->diffForHumans()}}</small></p>
                        <p class="card-text">
                            @php
                                $description = App::isLocale('id') ? $data->description_ind : $data->description_en;
                            @endphp
                            {{$description}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <h5>@lang('messages.news_list_title')</h5>
                <hr>
                @foreach($news as $item)
                    <a href="{{url('news/detail/'.$item->id)}}" class="text-dark">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{$item->banner}}" class="card-img-top" alt="{{$item->banner}}" style="height: 75px;">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <small>{{App::isLocale('id') ? $item->title_ind : $item->title_en}}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection