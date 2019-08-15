@extends('FE.layout')
@section('vr-tour')
    active
@endsection
@section('content')
<!-- Header -->
<div class="container">
    <div class="card mt-3 mb-5">
        <img class="card-img-top" src="{{url('bootstrap/asset-img/vr-tour/mue-kepresidenan-360.png')}}" alt="" height="450">
    </div>
</div>

<!-- Page Content -->
<div class="container">
    <h2 class="text-capitalize">virtual reality tour 360&deg;</h2>
    <hr>
    <div class="row mb-5 mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                    <img src="{{url('bootstrap/asset-img/vr-tour/mue-kepresidenan-360.png')}}" class="card-img ctn-vr-thumbnail" alt="...">
                    </div>
                    <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">museum kepresidenan</h5>
                        <p class="card-text">virtual reality tour 360&deg;<br> <a href="http://museumkepresidenan.indonesiaheritage.org/" target="_blank"><small>museumkepresidenan.indonesiaheritage.org</small></a></p>
                        <p class="card-text"><small class="text-muted">8 scenes</small></p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-5">
                    <img src="{{url('bootstrap/asset-img/vr-tour/mue-nasional-360.png')}}" class="card-img ctn-vr-thumbnail" alt="...">
                    </div>
                    <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">museum nasional</h5>
                        <p class="card-text">virtual reality tour 360&deg;<br> <a href="http://museumnasional.indonesiaheritage.org/" target="_blank"><small>museumnasional.indonesiaheritage.org</small></a></p>
                        <p class="card-text"><small class="text-muted">7 scenes</small></p>
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