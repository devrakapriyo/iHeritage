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
    <div class="row">
        <div class="col-md-8 mb-5">
        <h2>What We Do</h2>
        <hr>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
        </div>
        <div class="col-md-4 mb-5">
        <h2>Contact Us</h2>
        <hr>
        <address>
            <strong>iHeritage.id</strong>
            <br>Jalan Berigin I No 1
            <br>Bogor, 16720
            <br>
        </address>
        <address>
            <abbr title="Phone">P:</abbr>
            081295982920
            <br>
            <abbr title="Email">E:</abbr>
            <a href="mailto:#">info@iheritage.id</a>
        </address>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
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
</div>
<!-- /.container -->
@endsection