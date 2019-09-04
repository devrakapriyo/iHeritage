@extends('BE.layout')
@section('event')
    active
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">event</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">add new event</h6>
                    <a href="{{route('event-page')}}" class="btn btn-success text-capitalize">list event</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post" action="{{route('event-post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Name Event : </label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Content : </label>
                                    <select name="content_id" class="form-control">
                                        <option value=""></option>
                                        @foreach(App\Model\content_tbl::listContent(\Illuminate\Support\Facades\Auth::user()->id) as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <a href="{{route('content-pages', ['category'=>'museum'])}}">Content are not yet available, click here...</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Banner Event : </label>
                                    <input type="file" name="banner" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date : </label>
                                    <input type="text" name="start_date" class="form-control">
                                    <small class="text-danger">example value : 1 Januari 2019</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date : </label>
                                    <input type="text" name="end_date" class="form-control">
                                    <small class="text-danger">example value : 10 Januari 2019</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Place : </label>
                                    <select name="place_id" class="form-control">
                                        <option value=""></option>
                                        @foreach(App\Model\place_tbl::listSearch() as $item)
                                            <option value="{{$item->id}}">{{$item->place_ind}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short Description (Bahasa Indonesia): </label>
                                    <textarea name="short_description_ind" class="form-control" row="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short Description (Bahasa Inggris): </label>
                                    <textarea name="short_description_en" class="form-control" row="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Long Description (Bahasa Indonesia): </label>
                                    <textarea name="long_description_ind" class="form-control" row="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Long Description (Bahasa Inggris): </label>
                                    <textarea name="long_description_en" class="form-control" row="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price : </label>
                                    <input type="text" name="price" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Close Registration : </label>
                                    <input type="text" name="close_registration" class="form-control">
                                    <small class="text-danger">example value : 11 Januari 2019</small>
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