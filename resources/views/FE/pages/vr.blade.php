@extends('FE.layout')
@section('vr-tour')
    active
@endsection
@section('content')

<!-- Page Content -->
<div class="container mt-5">
    @if(auth('visitor')->check() == false)
    <div class="jumbotron">
        <h3 class="display-5 text-capitalize">@lang('messages.vr_banner_title')</h3>
        <hr class="my-4">
        <a class="btn btn-warning" href="{{url('login-visitor')}}">@lang('messages.vr_banner_button')</a>
    </div>
    @endif
    <h2 class="text-capitalize mt-5">@lang('messages.vr_title') 360&deg;</h2>
    <hr>
    <div class="row">
        @foreach($data as $item)
        {{--desktop view--}}
        <div class="col-md-6 mb-4 d-none d-lg-block">
            <div class="card">
                <a href="{{auth('visitor')->check() ? $item->url_vr : url('login-visitor')}}" target="_blank" class="text-dark">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img src="{{$item->photo}}" class="card-img" alt="{{$item->photo}}" width="200" height="190">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">
                                    {{App::isLocale('id') ? $item->name : $item->name_en}}
                                </h5>
                                {{--<p class="card-text">virtual reality tour 360&deg;<br> <small>{{\Illuminate\Support\Str::replaceArray('http://', [""], $item->url_vr)}}</small></p>--}}
                                <p class="card-text"><small class="text-muted">{{\App\Model\place_tbl::placeNameLang($item->place_id)}}</small></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{--mobile view--}}
        <div class="col-md-12 mb-5 d-lg-none">
            <div class="card h-100">
                <a href="{{auth('visitor')->check() ? $item->url_vr : url('login-visitor')}}" target="_blank" class="text-dark">
                    <img class="card-img-top" src="{{$item->photo}}" alt="" height="200" widht="400">
                    <div class="card-body">
                        <h5 class="card-title">{{App::isLocale('id') ? $item->name : $item->name_en}}</h5>
                        {{--<p class="card-text">virtual reality tour 360&deg;<br> <small>{{\Illuminate\Support\Str::replaceArray('http://', [""], $item->url_vr)}}</small></p>--}}
                        <p class="card-text"><small class="text-muted">{{\App\Model\place_tbl::placeNameLang($item->place_id)}}</small></p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection