@extends('FE.layout')
@section('content')

    <!-- Page Content -->
    <div class="container mt-5">
        <div class="row mt-4">
            <div class="col-md-12 mb-5">
                <h2 class="text-capitalize mb-4">@lang('messages.services_title')</h2>
                <div class="row">
                    @foreach($data as $item)
                        <div class="col-md-12 mb-4">
                            <div class="card text-white bg-secondary">
                                <a href="{{url('our-services/detail/'.$item->id)}}" class="text-white">
                                <div class="row no-gutters">
                                    <div class="col-md-3">
                                        <img src="{{$item->banner}}" class="card-img" height="230" width="350" alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title text-capitalize">{{App::isLocale('id') ? $item->title_ind : $item->title_en}}</h5>
                                            @php
                                                $text = App::isLocale('id') ? htmlspecialchars_decode($item->description_ind) : ($item->description_en);
                                            @endphp
                                            <p class="card-text">{!! $text !!}</p>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.row -->
            </div>
            <div class="col-md-12">
                <h3 class="text-center mb-3 text-uppercase">Get in touch with Us</h3>
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('form-question')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputSubject">Subject</label>
                                <input type="text" name="subject" class="form-control" id="exampleInputSubject" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMessage">Messages</label>
                                <textarea name="messages" class="form-control" id="exampleInputMessage" rows="8"></textarea>
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