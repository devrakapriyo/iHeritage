@extends('BE.layout')
@section('ctn-pgs')
    show
@endsection
@section($category)
    active
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">{{str_replace("-", " ",$category)}}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">add new photo</h6>
                        <a href="{{route('content-pages', ['category'=>$category])}}" class="btn btn-success text-capitalize">list content {{str_replace("-", " ",$category)}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('content-gallery-upload',['category'=>$category,'id'=>$id])}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Photo : </label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Caption (bahasa indonesia): </label>
                                        <input type="text" name="description_ind" class="form-control" maxlength="250">
                                        <small class="text-danger">limit text 250 character</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Caption (bahasa inggris): </label>
                                        <input type="text" name="description_en" class="form-control" maxlength="250">
                                        <small class="text-danger">limit text 250 character</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:transparent;">btn</label>
                                        <button class="btn btn-info btn-block">UPLOAD</button>
                                    </div>
                                </div>
                            </div>
                        </form>

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
                                            <div class="card">
                                                <img src="{{$item->photo}}" class="card-img-top" alt="photo" style="height:150px;">
                                                <div class="card-body">
                                                    <p>Institution : {{\App\Model\institutional::getData($item->institutional_id, "institutional_name")->institutional_name}}</p>
                                                    <p>
                                                        {{$item->description_ind == "" ? "" : "Bahasa Indonesia : ".$item->description_ind}}<br>
                                                        {{$item->description_en == "" ? "" : "Bahasa Inggris : ".$item->description_en}}
                                                    </p>
                                                    <a href="{{route('content-gallery-delete',['category'=>$category,'id'=>$item->id])}}" class="btn btn-block btn-danger">Delete Photo</a>
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