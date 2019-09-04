@extends('BE.layout')
@section('edu-program')
    active
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">education program</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">add new education program</h6>
                    <a href="{{route('edu-page')}}" class="btn btn-success text-capitalize">list education program</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post" action="{{route('edu-post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Name Education Program : </label>
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
                                    <label>Closing Hours (bahasa inggris): </label>
                                    <input type="text" name="close_en" class="form-control">
                                    <small class="text-danger">example value : National holiday</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Closing Hours (bahasa indonesia): </label>
                                    <input type="text" name="close_ind" class="form-control">
                                    <small class="text-danger">example value : Hari libur nasional</small>
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
                                    <label>Description (Bahasa Inggris): </label>
                                    <textarea name="description_en" class="form-control" row="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description (Bahasa Indonesia): </label>
                                    <textarea name="description_ind" class="form-control" row="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary text-capitalize">open schedule</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sunday : </label>
                                            <input type="text" name="opening_sunday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Monday : </label>
                                            <input type="text" name="opening_monday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tuesday : </label>
                                            <input type="text" name="opening_tuesday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Wednesday : </label>
                                            <input type="text" name="opening_wednesday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Thursday : </label>
                                            <input type="text" name="opening_thursday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Friday : </label>
                                            <input type="text" name="opening_friday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Saturday : </label>
                                            <input type="text" name="opening_saturday" class="form-control">
                                            <small class="text-danger">example value : 09:00 - 15:00</small>
                                        </div>
                                    </div>
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