@extends('FE.layout')
@section('home')
    active
@endsection
@section('content')
<!-- Header -->
<header class="bg-warning py-5">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
        <div class="col-lg-12">
            <h1 class="display-4 text-white mt-5 mb-2">The Indonesian Heritage Network</h1>
            <p class="lead mb-5 text-dark">Let us explore the extraordinary heritage of the nation to push the boundaries of understanding in the past and today.</p>
        </div>
        </div>
    </div>
</header>

<!-- Page Search -->
<div class="mb-5 ctn-home-search">
    <div class="container bg-light">
        <div class="row ml-5 mr-5">
        <div class="col-md-5">
            <div class="form-group mt-5 mb-5">
                <select class="form-control">
                    <option value="all">All Province in Indonesia</option>
                    @foreach(\App\Model\FE\place_tbl::listSearch() as $items)
                        <option value="{{$items->id}}">{{$items->place_en}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mt-5 mb-5">
                <select class="form-control">
                    <option>All Heritage in Indonesia</option>
                    <option>Museum</option>
                    <option>Library</option>
                    <option>Gallery</option>
                    <option>Archive</option>
                    <option>Temple</option>
                    <option>Palace</option>
                    <option>Nature</option>
                    <option>Historical Building</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mt-5 mb-5">
                <button class="btn btn-block btn-dark">search</button>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="container">

    <!-- List Museum -->
    <div class="row">
        <div class="col-md-12">
            <h2>Museum</h2>
            <hr>
        </div>
        <div class="col-md-4 mb-5">
        <div class="card h-100">
            <img class="card-img-top" src="{{url('bootstrap/asset-img/museum/asset-mue-presiden.jpg')}}" alt="" height="200" widht="400">
            <div class="card-body">
            <h5 class="card-title"><a href="{{url('museum')}}" class="text-dark">Museum Kepresidenan</a></h5>
            <p class="card-text">
                <small class="card-text text-uppercase">Jakarta</small>
            </p>
            <p class="card-text">
                The presidential museum is in the area of ​​the Bogor Presidential Palace with a land area of ​​about 3,211.6m² and a building area of ​​± 5,865m² is the idea and idea of ​​President Susilo Bambang Yudhoyono which began in 2012.
            </p>
            </div>
        </div>
        </div>
        <div class="col-md-4 mb-5">
        <div class="card h-100">
            <img class="card-img-top" src="{{url('bootstrap/asset-img/museum/asset-mue-nasional.jpg')}}" alt="" height="200" widht="400">
            <div class="card-body">
            <h5 class="card-title"><a href="{{url('museum')}}" class="text-dark">Museum Nasional</a></h5>
            <p class="card-text">
                <small class="card-text text-uppercase">Jakarta</small>
            </p>
            <p class="card-text">
                The National Museum in 1862 was often called "Gedung Gajah" or "Museum Gajah" because in the front yard of the museum there was a bronze elephant statue gift from King Chulalongkorn (Rama V) of Thailand who had visited the museum in 1871.
            </p>
            </div>
        </div>
        </div>
        <div class="col-md-4 mb-5">
        <div class="card h-100">
            <img class="card-img-top" src="{{url('bootstrap/asset-img/museum/asset-mue-konfasiaafrika.jpg')}}" alt="" height="200" widht="400">
            <div class="card-body">
            <h5 class="card-title"><a href="{{url('museum')}}" class="text-dark">Museum Konfersi Asia Afrika</a></h5>
            <p class="card-text">
                <small class="card-text text-uppercase">Bandung</small>
            </p>
            <p class="card-text">
                The idea of ​​the establishment of the Museum of the Asian-African Conference was realized by Joop Ave, as the Daily Chair of the Commemoration Committee for the 25th Anniversary of the Asian-African Conference and the Director General of Protocol and Consular of the Ministry of Foreign Affairs.
            </p>
            </div>
        </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Join -->
    <div class="jumbotron bg-warning">
        <h3 class="display-5">Add Your Heritage and show the world, that we are rich in culture.</h3>
        <p class="lead">Its Free...</p>
        <hr class="my-4">
        <a class="btn btn-light" href="#" role="button">Try it out!</a>
    </div>
    <!-- /.row -->

    <!-- List News -->
    <div class="row">
        <div class="col-md-12">
            <h2>Heritage News</h2>
            <hr>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="{{asset('bootstrap/asset-img/museum/asset-mue-konfasiaafrika.jpg')}}" class="card-img ctn-vr-thumbnail" alt="...">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">MEREKAM SEJARAH KONFERENSI ASIA-AFRIKA</h5>
                            @php
                                $text = "The Asia-Africa Conference held in Bandung on April 18-24, 1955 was a very historic event in Indonesian foreign policy and a major event for the Indonesian people.";
                                $limit_text = substr($text, 0, 150);
                            @endphp
                            <p class="card-text">{{$limit_text}} <a href="{{url('/')}}">...readmore</a></p>
                            <p class="card-text"><small class="text-muted">Last updated 3 day ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="{{asset('bootstrap/asset-img/museum/asset-mue-sribaduga.jpg')}}" class="card-img ctn-vr-thumbnail" alt="...">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">DIGITAL PRESERVATION OF ANCIENT ARTEFAC & NASIONAL AT SRI BADUGA MUSEUM</h5>
                            @php
                                $text = "The Sri Baduga Museum is managed by the West Java Provincial Government by utilizing the old building of the former Kawedanan Tegallega. Furthermore, the museum was inaugurated on June 5, 1980 by the then Minister of Education and Culture, Daoed Joesoef.";
                                $limit_text = substr($text, 0, 150);
                            @endphp
                            <p class="card-text">{{$limit_text}} <a href="{{url('/')}}">...readmore</a></p>
                            <p class="card-text"><small class="text-muted">Last updated 4 day ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="{{asset('bootstrap/asset-img/museum/asset-mue-nasional.jpg')}}" class="card-img ctn-vr-thumbnail" alt="...">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">PUBLICATION & EDUCATION EFFORTS IN THE NATIONAL MUSEUM</h5>
                            @php
                                $text = "Bataviaasch Genootschap van Kunsten en Wetenschappen (BG) is an independent institution established for the purpose of advancing research in the arts and sciences, especially in the fields of biology, physics, archeology, literature, ethnology and history";
                                $limit_text = substr($text, 0, 150);
                            @endphp
                            <p class="card-text">{{$limit_text}} <a href="{{url('/')}}">...readmore</a></p>
                            <p class="card-text"><small class="text-muted">Last updated 4 day ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection