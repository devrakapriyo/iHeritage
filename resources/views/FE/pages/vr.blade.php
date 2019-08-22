@extends('FE.layout')
@section('vr-tour')
    active
@endsection
@section('content')

<!-- Page Content -->
<div class="container mt-5">
    <div class="jumbotron">
        <h3 class="display-5 text-capitalize">@lang('messages.vr_banner_title')</h3>
        <hr class="my-4">
        <a class="btn btn-warning" href="#" role="button">@lang('messages.vr_banner_button')</a>
    </div>
    <h2 class="text-capitalize mt-5">@lang('messages.vr_title') 360&deg;</h2>
    <hr>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <a href="http://museumkepresidenan.indonesiaheritage.org/" target="_blank">
                            <img src="{{url('bootstrap/asset-img/vr-tour/mue-kepresidenan-360.png')}}" class="card-img ctn-vr-thumbnail" alt="...">
                        </a>
                    </div>
                    <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">
                            <a href="http://museumkepresidenan.indonesiaheritage.org/" target="_blank" class="text-dark">
                                museum kepresidenan
                            </a>
                        </h5>
                        <p class="card-text">virtual reality tour 360&deg;<br> <a href="http://museumkepresidenan.indonesiaheritage.org/" target="_blank"><small>museumkepresidenan.indonesiaheritage.org</small></a></p>
                        <p class="card-text"><small class="text-muted">8 scenes</small></p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <a href="http://museumnasional.indonesiaheritage.org/" target="_blank">
                            <img src="{{url('bootstrap/asset-img/vr-tour/mue-nasional-360.png')}}" class="card-img ctn-vr-thumbnail" alt="...">
                        </a>
                    </div>
                    <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">
                            <a href="http://museumnasional.indonesiaheritage.org/" target="_blank" class="text-dark">
                                museum nasional
                            </a>
                        </h5>
                        <p class="card-text">virtual reality tour 360&deg;<br> <a href="http://museumnasional.indonesiaheritage.org/" target="_blank"><small>museumnasional.indonesiaheritage.org</small></a></p>
                        <p class="card-text"><small class="text-muted">7 scenes</small></p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <a href="http://museumsribaduga.indonesiaheritage.org/" target="_blank">
                            <img src="{{url('bootstrap/asset-img/vr-tour/mue-sribaduga-360.png')}}" class="card-img ctn-vr-thumbnail" alt="...">
                        </a>
                    </div>
                    <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">
                            <a href="http://museumsribaduga.indonesiaheritage.org/" target="_blank" class="text-dark">
                                museum sri baduga
                            </a>
                        </h5>
                        <p class="card-text">virtual reality tour 360&deg;<br> <a href="http://museumsribaduga.indonesiaheritage.org/" target="_blank"><small>museumsribaduga.indonesiaheritage.org</small></a></p>
                        <p class="card-text"><small class="text-muted">6 scenes</small></p>
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