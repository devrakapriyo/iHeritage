@extends('FE.layout')
@section('content')

    <!-- Page Content -->
    <div class="container mt-5">
        <div class="row mt-4 mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-capitalize mb-3">{{App::isLocale('id') ? $data->title_ind : $data->title_en}}</h2>
                        @php
                            $description = App::isLocale('id') ? $data->description_ind : $data->description_en;
                        @endphp
                        {{$description}}
                    </div>
                    <img src="{{$data->banner}}" class="card-img-top" alt="{{$data->banner}}">
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection