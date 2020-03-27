@extends('BE.layout')
@section('users')
    active
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages.home_select_heritage')</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.user_edit')</h6>
                        @if((auth('admin')->user()->is_admin_master == "Y"))
                            @if((\App\User::where('id', $id)->first()->is_delete == "N"))
                                @if((\App\User::where('id', $id)->first()->is_active == "N"))
                                    <a onclick="return confirm('Are you sure you want active this account?');" href="{{route('users-active', ['id'=>$id])}}" class="btn btn-success">Activate Account</a>
                                @endif
                            @endif
                        @endif
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('messages.home_select_heritage') : </label>
                                        <input type="text" class="form-control" value="{{$data->institutional_name}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>@lang('messages.collection_address') : </label>
                                        <textarea class="form-control" rows="5" readonly>{{$data->address}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('messages.home_select_place') : </label>
                                        <input type="text" class="form-control" value="{{\App\Model\place_tbl::placeNameLang($data->place_id)}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('messages.category') : </label>
                                        <input type="text" class="form-control" value="{{$data->category}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email : </label>
                                        <input type="text" class="form-control" value="{{$data->email}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone : </label>
                                        <input type="text" class="form-control" value="{{$data->phone}}" readonly>
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