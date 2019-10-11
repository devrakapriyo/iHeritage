@extends('FE.layout')
@section('event')
    active
@endsection
@section('content')

    <div class="container">
        <h2 class="text-capitalize mt-5">@lang('messages.event_title')</h2>
        <hr>
        <div class="row mb-5 mt-4">
            @foreach($data as $item)
            <div class="col-md-4">
                <div class="card h-100">
                    <img class="card-img-top" src="{{$item->banner}}" alt="" height="200" widht="400">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-7">
                                <p class="card-text text-secondary">
                                    {{\App\Helper\helpers::dateFormat($item->start_date)}}
                                </p>
                            </div>
                            <div class="col-md-5">
                                <p class="card-text">
                                    <small class="btn btn-sm btn-success float-right text-capitalize">{{$item->price == 0 ? App::isLocale('id') ? "Gratis" : "Free" : "Rp. ".number_format($item->price) }}</small>
                                </p>
                            </div>
                        </div>
                        <h5 class="card-title"><a href="{{url('event/detail/'.$item->seo.'/'.$item->id)}}" class="text-dark">{{$item->name}}</a></h5>
                        <small class="card-text" title="{{$item->map_area_detail}}">
                            @php
                                $text = $item->map_area_detail;
                                $limit_text = substr($text, 0, 48);
                                $more = strlen($text) <= 48 ? "" : "...";
                            @endphp
                            {{$limit_text}}{{$more}}
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- /.row -->
    </div>
@endsection