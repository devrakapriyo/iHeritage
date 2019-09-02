@extends('BE.layout')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">category content</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">add new category</h6>
                        <a href="{{route('category-page')}}" class="btn btn-success text-capitalize">list category content</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="post" action="{{route('category-post')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Content : </label>
                                        <select name="category" class="form-control">
                                            <option value=""></option>
                                            <option value="museum">museum</option>
                                            <option value="library">library</option>
                                            <option value="gallery">gallery</option>
                                            <option value="archive">archive</option>
                                            <option value="temple">temple</option>
                                            <option value="palace">palace</option>
                                            <option value="nature">nature</option>
                                            <option value="historical-building">historical building</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name Category Content (bahasa indonesia): </label>
                                        <input type="text" name="category_ctn_name_en" class="form-control">
                                        <small class="text-danger">example value : sejarah</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name Category Content (bahasa inggris): </label>
                                        <input type="text" name="category_ctn_name_ind" class="form-control">
                                        <small class="text-danger">example value : historical</small>
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