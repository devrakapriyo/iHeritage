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
                    <a href="{{url('education-program/detail/'.$item->seo.'/'.$item->id)}}" class="text-dark">
                        <img class="card-img-top" src="{{$item->banner}}" alt="" height="200" widht="400">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <p class="card-text">
                                <small class="card-text text-uppercase">{{$item->map_area_detail}}</small>
                            </p>
                            @php
                                $text = App::isLocale('id') ? htmlspecialchars_decode($item->description_ind) : htmlspecialchars_decode($item->description_en);
                                $text = stripslashes($text);
                                $limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('education-program/detail/'.$item->seo.'/'.$item->id)."'> ...readmore</a>" : $text;
                            @endphp
                            <p class="card-text">{!! $limit_text !!}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <!-- /.row -->
    </div>
@endsection