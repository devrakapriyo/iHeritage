@extends('FE.layout')
@section('content')

    <!-- Page Content -->
    <div class="container mt-5">
        <div class="row mt-4 mb-5">
            <div class="col-md-6">
                <h2 class="text-capitalize mb-3">@lang('messages.about_title')</h2>
                @php
                    $description = App::isLocale('id') ? $data->about_us_ind : $data->about_us_en;
                @endphp
                {!! $description !!}
            </div>
            <div class="col-md-6">
                <img src="{{$data->banner}}" class="img-fluid" alt="{{$data->banner}}">
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <div class="row"></div>
@endsection