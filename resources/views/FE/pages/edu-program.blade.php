@extends('FE.layout')
@section('education-program')
    active
@endsection
@section('content')

    <div class="container">
        <h2 class="text-capitalize mt-5">@lang('messages.edu_title')</h2>
        <hr>
        <div class="row mb-5 mt-4">
            @foreach($data as $item)
            <div class="col-md-4">
                <div class="card h-100">
                    <img class="card-img-top" src="{{$item->banner}}" alt="" height="200" widht="400">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{url('education-program/detail/'.$item->seo.'/'.$item->id)}}" class="text-dark">{{$item->name}}</a></h5>
                        <p class="card-text">
                            <small class="card-text text-uppercase">{{$item->map_area_detail}}</small>
                        </p>
                        @php
                            $text = App::isLocale('id') ? $item->description_ind : $item->description_en;
                            $limit_text = substr($text, 0, 150);
                        @endphp
                        <p class="card-text">{{$limit_text}} <a href="{{url('education-program/detail/'.$item->seo.'/'.$item->id)}}">...readmore</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- /.row -->
    </div>
@endsection