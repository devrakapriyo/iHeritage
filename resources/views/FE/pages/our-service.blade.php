@extends('FE.layout')
@section('content')

    <!-- Page Content -->
    <div class="container mt-5">
        <div class="row mt-4 mb-5">
            <div class="col-md-8">
                <h2 class="text-capitalize">@lang('messages.services_title')</h2>
                <div class="row">
                    @foreach($data as $item)
                        <div class="col-md-12 mb-4">
                            <div class="card text-white bg-secondary">
                                <div class="row no-gutters">
                                    <div class="col-md-3">
                                        <img src="{{$item->banner}}" class="card-img ctn-vr-thumbnail" alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title text-capitalize">{{App::isLocale('id') ? $item->title_ind : $item->title_en}}</h5>
                                            @php
                                                $text = App::isLocale('id') ? $item->description_ind : $item->description_en;
                                                $limit_text = substr($text, 0, 150);
                                            @endphp
                                            <p class="card-text">{{$limit_text}} <a href="{{url('our-services/detail/'.$item->id)}}" class="text-white">...readmore</a></p>
                                            <p class="card-text"><small class="text-muted text-white">Last updated 3 day ago</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.row -->
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputName">Name</label>
                                <input type="text" class="form-control" id="exampleInputName" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputSubject">Subject</label>
                                <input type="text" class="form-control" id="exampleInputSubject" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMessage">Subject</label>
                                <textarea class="form-control" id="exampleInputMessage" rows="5"></textarea>
                            </div>
                            <button class="btn btn-warning float-right">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
@endsection