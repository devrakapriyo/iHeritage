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
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.gallery_add')</h6>
                        <a href="{{route('gallery-pages')}}" class="btn btn-success text-capitalize">@lang('messages_be.gallery_list')</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('gallery-upload')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('messages.home_select_heritage') :</label>
                                        @if(auth('admin')->user()->is_admin_master == "Y")
                                            <select name="content_id" class="form-control" required>
                                                <option value=""></option>
                                                @foreach($content as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="hidden" name="content_id" value="{{\App\Model\content_tbl::content(auth('admin')->user()->institutional_id)->id}}">
                                            <input type="text" value="{{\App\Model\content_tbl::content(auth('admin')->user()->institutional_id)->name}}" class="form-control" readonly>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Foto : </label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('messages_be.gallery_input_name') (bahasa indonesia): </label>
                                        <input type="text" name="description_ind" class="form-control" maxlength="250">
                                        <small class="text-danger">@lang('messages_be.info_input_limit')</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('messages_be.gallery_input_name') (bahasa inggris): </label>
                                        <input type="text" name="description_en" class="form-control" maxlength="250">
                                        <small class="text-danger">@lang('messages_be.info_input_limit')</small>
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
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection