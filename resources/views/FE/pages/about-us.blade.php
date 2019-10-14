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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <img src="{{asset('bootstrap/asset-img/heritage-place/borobudur.jpg')}}" class="card-img-top" alt="...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <img src="{{asset('bootstrap/asset-img/heritage-place/prambanan.jpg')}}" class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <img src="{{asset('bootstrap/asset-img/heritage-place/bromo-tengger-semeru.jpg')}}" class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <div class="row"></div>
@endsection