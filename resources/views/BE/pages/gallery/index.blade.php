@extends('BE.layout')
@section('photo')
    active
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">photo</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">list photo</h6>
                        @if(\App\Model\content_tbl::select('id')->where('institutional_id', auth('admin')->user()->institutional_id)->first())
                            <a href="{{route('gallery-add')}}" class="btn btn-success text-capitalize">add new photo</a>
                        @endif
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary text-capitalize">gallery photo</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="row">
                                    @foreach($gallery as $item)
                                        <div class="col-md-3">
                                            <div class="card mb-3">
                                                <img src="{{$item->photo}}" class="card-img-top" alt="photo" style="height:150px;">
                                                <div class="card-body">
                                                    <p>Institution : {{\App\Model\institutional::getData($item->institutional_id, "institutional_name")->institutional_name}}</p>
                                                    <p>
                                                        {{$item->description_ind == "" ? "" : "Bahasa Indonesia : ".$item->description_ind}}<br>
                                                        {{$item->description_en == "" ? "" : "Bahasa Inggris : ".$item->description_en}}
                                                    </p>
                                                    <a onclick="return confirm('Are you sure you want to delete this data?');" href="{{route('gallery-delete',['id'=>$item->id])}}" class="btn btn-block btn-danger">Delete Photo</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection