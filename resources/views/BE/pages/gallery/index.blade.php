@extends('BE.layout')
@section('photo')
    active
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages_be.gallery_title')</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.gallery_list')</h6>
                        <a href="{{route('gallery-add')}}" class="btn btn-success text-capitalize">@lang('messages_be.gallery_add')</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.gallery_title')</h6>
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
                                                    <div class="form-group">
                                                        <a href="{{route('gallery-edit', ['id' => $item->id])}}" class="btn btn-block btn-warning">EDIT</a>
                                                    </div>
                                                    <div class="form-group">
                                                        <a onclick="return confirm('Are you sure you want to delete this data?');" href="{{route('gallery-delete',['id'=>$item->id])}}" class="btn btn-block btn-danger">Delete Photo</a>
                                                    </div>
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