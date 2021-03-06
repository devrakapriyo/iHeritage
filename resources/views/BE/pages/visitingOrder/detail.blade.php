@extends('BE.layout')
@section('visiting-order')
    active
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages.museum_visiting_order')</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">#{{$data->code_booking}}</h6>
                        <a href="{{route('content-visiting')}}" class="btn btn-success text-capitalize">data @lang('messages.museum_visiting_order')</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('content-visiting-send', ['id'=>$id])}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('messages_be.email_visiting_code') : </label>
                                        <input type="text" name="code_booking" class="form-control" value="{{$data->code_booking}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('messages.institutional_name') : </label>
                                        <input type="text" name="name" class="form-control" value="{{$data->institutional_name}}" readonly>
                                    </div>
                                </div>
                            </div>
                            @if(\App\Model\visiting_order::get_visitor_order($id) != "-")
                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>@lang('messages_be.sidebar_visiting_order') : </label>
                                            <input type="text" class="form-control" value="{{\App\Model\visiting_order::get_visitor_order($id)}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email : </label>
                                        <input type="email" name="email" class="form-control" value="{{$data->email}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone : </label>
                                        <input type="text" name="phone" class="form-control" value="{{$data->phone}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('messages_be.email_visiting_number') : </label>
                                        <input type="text" name="visitor" class="form-control" value="{{$data->visitor}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('messages_be.email_visiting_date') : </label>
                                        <input type="text" name="visitor" class="form-control" value="{{$data->visitor}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('messages.museum_information') : </label>
                                        <textarea name="information" class="form-control" rows="5" readonly>{{$data->information}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('messages_be.form_questioner_messages') : </label>
                                        <textarea name="messages_response" class="form-control" rows="5">{{$data->messages_response}}</textarea>
                                    </div>
                                </div>
                            </div>
                            @if($data->is_send == "N")
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-info btn-block">SEND EMAIL</button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection