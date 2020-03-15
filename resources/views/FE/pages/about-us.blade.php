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
                {{--<div class="row">--}}
                {{--<div class="col-md-6">--}}
                {{--<p>@lang('messages.about_supported_by')</p>--}}
                {{--<a href="https://pmli.co.id" target="_blank">--}}
                {{--<img src="{{asset('img/PMLI.png')}}" class="img" style="width:130px;height:73px;margin-left:16px;">--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="row mt-5">
                    <div class="col-md-12">
                        <p>@lang('messages.about_our_partners')</p>
                    </div>
                    <div class="col-md-3">
                        <a href="" target="_blank">
                            {{--desktop--}}
                            {{--<a href="https://pmli.co.id" target="_blank">--}}
                                <img src="{{asset('img/PMLI.png')}}" class="img" style="width:130px;height:73px;margin-left:16px;">
                            {{--</a>--}}
                        </a>
                    </div>
                    <div class="col-md-3">
                        {{--<a href="" target="_blank">--}}
                            {{--desktop--}}
                            <img src="{{asset('img/MAKN.png')}}" class="img d-none d-lg-block d-sm-none" style="width:80%;height:80px;margin-left:16px;">

                            {{--iPad--}}
                            <img src="{{asset('img/MAKN.png')}}" class="img d-none d-sm-block d-lg-none" style="width:100%;height:60px;margin-left:16px;">

                            {{--mobile--}}
                            <img src="{{asset('img/MAKN.png')}}" class="img d-lg-none d-sm-none" style="width:40%;height:130px;margin-left:16px;">
                        {{--</a>--}}
                    </div>
                    <div class="col-md-3">
                        {{--<a href="" target="_blank">--}}
                            {{--desktop--}}
                            <img src="{{asset('img/PaSTI.jpg')}}" class="img d-none d-lg-block d-sm-none" style="width:100%;height:80px;">

                            {{--iPad--}}
                            <img src="{{asset('img/PaSTI.jpg')}}" class="img d-none d-sm-block d-lg-none" style="width:100%;height:40px;">

                            {{--mobile--}}
                            <img src="{{asset('img/PaSTI.jpg')}}" class="img d-lg-none d-sm-none" style="width:50%;height:80px;margin-left:16px;">
                        {{--</a>--}}
                    </div>
                    <div class="col-md-3">
                        {{--<a href="" target="_blank">--}}
                            {{--desktop--}}
                            <img src="{{asset('img/AMI-DKI.png')}}" class="img d-none d-lg-block d-sm-none" style="width:100%;height:80px;">

                            {{--iPad--}}
                            <img src="{{asset('img/AMI-DKI.png')}}" class="img d-none d-sm-block d-lg-none" style="width:100%;height:40px;">

                            {{--mobile--}}
                            <img src="{{asset('img/AMI-DKI.png')}}" class="img d-lg-none d-sm-none" style="width:50%;height:80px;margin-left:16px;">
                        {{--</a>--}}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        {{--<a href="" target="_blank">--}}
                            {{--desktop--}}
                            <img src="{{asset('img/AMI.jpg')}}" class="img d-none d-lg-block d-sm-none" style="width:100%;height:80px;">

                            {{--iPad--}}
                            <img src="{{asset('img/AMI.jpg')}}" class="img d-none d-sm-block d-lg-none" style="width:100%;height:50px;">

                            {{--mobile--}}
                            <img src="{{asset('img/AMI.jpg')}}" class="img d-lg-none d-sm-none" style="width:50%;height:80px;margin-left:16px;;">
                        {{--</a>--}}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="https://play.google.com/store/apps/details?id=com.pmli.iHeritage" target="_blank">
                            {{--desktop--}}
                            <img src="{{asset('img/play-store.png')}}" class="img d-none d-lg-block d-sm-none" style="width:100%;height:100px">

                            {{--iPad--}}
                            <img src="{{asset('img/play-store.png')}}" class="img d-none d-sm-block d-lg-none" style="width:100%;height:70px">

                            {{--mobile--}}
                            <img src="{{asset('img/play-store.png')}}" class="img d-lg-none d-sm-none" style="width:70%;height:100px">
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