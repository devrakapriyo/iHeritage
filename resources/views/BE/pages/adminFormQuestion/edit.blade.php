@extends('BE.layout')
@section('form-question')
    active
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages_be.form_questioner_title')</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.form_questioner_detail')</h6>
                        <a href="{{route('form-question-pages')}}" class="btn btn-success text-capitalize">@lang('messages_be.form_questioner_text')</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('form-question-update', ['id'=>$id])}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('messages_be.form_questioner_name') : </label>
                                        <input type="text" name="name" class="form-control" value="{{$data->name}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email : </label>
                                        <input type="email" name="email" class="form-control" value="{{$data->email}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('messages_be.form_questioner_subject') : </label>
                                        <input type="text" name="subject" class="form-control" value="{{$data->subject}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('messages_be.form_questioner_messages') : </label>
                                        <textarea name="messages" class="form-control" rows="5" readonly>{{$data->messages}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status Response : </label>
                                        <select name="status" class="form-control" required>
                                            <option value=""></option>
                                            <option value="response">@lang('messages_be.form_questioner_response_question')</option>
                                            <option value="deleted">@lang('messages_be.form_questioner_delete_question')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('messages_be.form_questioner_response_question') : </label>
                                        <textarea name="messages_response" class="form-control text-editor"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-info btn-block">@lang('messages_be.form_questioner_send')</button>
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