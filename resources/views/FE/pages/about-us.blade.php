@extends('FE.layout')
@section('content')

    <!-- Page Content -->
    <div class="container mt-5">
        <div class="row mt-4 mb-5">
            <div class="col-md-6">
                <h2 class="text-capitalize mb-3">@lang('messages.about_title')</h2>
                @php
                    $description = App::isLocale('id') ? $data->about_us_ind : $data->about_us_en;
                @endphp
                {!! $description !!}
            </div>
            <div class="col-md-6">
                <img src="{{$data->banner}}" class="img-fluid" alt="{{$data->banner}}">
                <div class="row">
                    <div class="col-md-6">
                        <a href="https://pmli.co.id" target="_blank">
                            <img src="{{asset('img/PMLI.png')}}" class="img" style="width:145px;height:88px;margin-left:20px;">
                        </a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <a href="" target="_blank">
                            {{--desktop--}}
                            <img src="{{asset('img/AMI.jpg')}}" class="img d-none d-lg-block" style="width:100%;height:80px;">

                            {{--mobile--}}
                            <img src="{{asset('img/AMI.jpg')}}" class="img d-lg-none" style="width:50%;height:80px;">
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="" target="_blank">
                            {{--desktop--}}
                            <img src="{{asset('img/MAKN.png')}}" class="img d-none d-lg-block" style="width:100%;height:80px;">

                            {{--mobile--}}
                            <img src="{{asset('img/MAKN.png')}}" class="img d-lg-none" style="width:50%;height:80px;">
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="" target="_blank">
                            {{--desktop--}}
                            <img src="{{asset('img/PaSTI.jpg')}}" class="img d-none d-lg-block" style="width:100%;height:80px;">

                            {{--mobile--}}
                            <img src="{{asset('img/PaSTI.jpg')}}" class="img d-lg-none" style="width:50%;height:80px;">
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="" target="_blank">
                            {{--desktop--}}
                            <img src="{{asset('img/AMI-DKI.png')}}" class="img d-none d-lg-block" style="width:100%;height:80px;">

                            {{--mobile--}}
                            <img src="{{asset('img/AMI-DKI.png')}}" class="img d-lg-none" style="width:50%;height:80px;">
                        </a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="https://play.google.com/store/apps/details?id=com.pmli.iHeritage" target="_blank">
                            <img src="{{asset('img/play-store.png')}}" class="img float-right" style="width: 100%;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <div class="row"></div>
@endsection