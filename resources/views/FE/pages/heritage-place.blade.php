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
        <div class="col-md-4">
            <div class="card h-100">
                <img class="card-img-top" src="{{url('bootstrap/asset-img/heritage-place/bromo-tengger-semeru.jpg')}}" alt="" height="200" widht="400">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{url('museum')}}" class="text-dark">Bromo Tengger</a></h5>
                    <p class="card-text">
                        <small class="card-text text-uppercase">East Java</small>
                    </p>
                    <p class="card-text">
                    Bromo Tengger Semeru National Park or local people known as TNBTS is a national park located in East Java, Indonesia, to the east of Malang and Lumajang, to the south of Pasuruan and Probolinggo, and to the southeast of Surabaya, the capital of East Java.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <img class="card-img-top" src="{{url('bootstrap/asset-img/heritage-place/borobudur.jpg')}}" alt="" height="200" widht="400">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{url('museum')}}" class="text-dark">Borobudur Temple</a></h5>
                    <p class="card-text">
                        <small class="card-text text-uppercase">Central Java</small>
                    </p>
                    <p class="card-text">
                    Borobudur is a Buddhist temple located in Borobudur, Magelang, Central Java, Indonesia. This temple is located approximately 100 km to the southwest of Semarang, 86 km to the west of Surakarta, and 40 km to the northwest of Yogyakarta.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <img class="card-img-top" src="{{url('bootstrap/asset-img/heritage-place/prambanan.jpg')}}" alt="" height="200" widht="400">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{url('museum')}}" class="text-dark">Prambanan Temple</a></h5>
                    <p class="card-text">
                        <small class="card-text text-uppercase">Yogyakarta</small>
                    </p>
                    <p class="card-text">
                    Prambanan Temple or Roro Jonggrang Temple is the largest Hindu temple complex in Indonesia that was built in the 9th century AD. This temple is dedicated to Trimurti, the three main Hindu deities namely Brahma as the creator god, Wishnu as the guardian god, and Shiva as the god of destruction.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection