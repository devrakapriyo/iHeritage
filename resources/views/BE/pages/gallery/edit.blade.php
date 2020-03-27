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
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.gallery_edit')</h6>
                        <a href="{{route('gallery-pages')}}" class="btn btn-success text-capitalize">@lang('messages_be.gallery_list')</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('gallery-update', ['id' => $id])}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('messages_be.gallery_input_name') (bahasa indonesia): </label>
                                        <input type="text" name="description_ind" class="form-control" value="{{$data->description_ind}}" maxlength="250">
                                        <small class="text-danger">@lang('messages_be.info_input_limit')</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('messages_be.gallery_input_name') (bahasa inggris): </label>
                                        <input type="text" name="description_en" class="form-control" value="{{$data->description_en}}" maxlength="250">
                                        <small class="text-danger">@lang('messages_be.info_input_limit')</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:transparent;">btn</label>
                                        <button class="btn btn-info btn-block">UPDATE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <img class="card-img-bottom" src="{{$data->photo}}" alt="{{$data->photo}}">
                </div>
            </div>

        </div>

    </div>
@endsection