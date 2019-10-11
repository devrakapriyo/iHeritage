@extends('FE.layout')
@section('heritage-place')
    active
@endsection
@section('content')
<!-- Header -->
<div class="bd-example mb-5">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{url('bootstrap/asset-img/slider/pura-bali.jpg')}}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
      <img src="{{url('bootstrap/asset-img/slider/pura-bali.jpg')}}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
      <img src="{{url('bootstrap/asset-img/slider/pura-bali.jpg')}}" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<!-- Page Content -->
<div class="container">
    <h2 class="text-capitalize">@lang('messages.heritage_title')</h2>
    <hr>
    <div class="row mb-5 mt-4">
        @foreach($data as $item)
        <div class="col-md-4">
            <div class="card h-100">
                <img class="card-img-top" src="{{$item->banner}}" alt="{{$item->banner}}" height="200" widht="400">
                <div class="card-body">
                    <h5 class="card-title text-uppercase"><a href="#" class="text-dark">{{$item->name}}</a></h5>
                    <p class="card-text">
                        <small class="card-text text-uppercase">{{\App\Model\place_tbl::placeNameLang($item->place_id)}}</small>
                    </p>
                    <a href="" class="btn btn-block btn-{{$color_media[$item->media_type]}} text-uppercase">{{$item->media_type}}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection