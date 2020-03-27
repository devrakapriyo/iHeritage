@extends('BE.layout')
@section('news')
    active
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages_be.news_title')</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.news_add')</h6>
                    <a href="{{route('news-pages')}}" class="btn btn-success text-capitalize">@lang('messages_be.news_list')</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post" action="{{route('news-post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('messages_be.news_input_title') (bahasa indonesia) : </label>
                                    <input type="text" name="title_ind" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('messages_be.news_input_title') (bahasa inggris) : </label>
                                    <input type="text" name="title_en" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('messages_be.news_input_description') (bahasa indonesia) : </label>
                                    <textarea name="description_ind" class="form-control text-editor" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('messages_be.news_input_description') (bahasa inggris) : </label>
                                    <textarea name="description_en" class="form-control text-editor" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Banner : </label>
                                    <input type="file" name="banner" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-info btn-block">SAVE</button>
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