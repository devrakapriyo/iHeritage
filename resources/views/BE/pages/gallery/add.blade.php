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
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">add new photo</h6>
                        <a href="{{route('gallery-pages')}}" class="btn btn-success text-capitalize">list photo</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('gallery-upload')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Institution :</label>
                                        @if(auth('admin')->user()->is_admin_master == "Y")
                                            <select name="content_id" class="form-control" required>
                                                <option value=""></option>
                                                @foreach($content as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="hidden" name="content_id" value="{{\App\Model\content_tbl::content(auth('admin')->user()->institutional_id)->id}}">
                                            <input type="text" value="{{\App\Model\content_tbl::content(auth('admin')->user()->institutional_id)->name}}" class="form-control">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Photo : </label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="color:transparent;">btn</label>
                                        <button class="btn btn-info btn-block">UPLOAD</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection