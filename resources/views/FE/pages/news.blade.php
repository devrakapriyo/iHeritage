@extends('FE.layout')
@section('content')

    <!-- Page Content -->
    <div class="container mt-5">
        <h2 class="text-capitalize">@lang('messages.news_title')</h2>
        <hr>
        <div class="row mt-4 mb-5">
            @foreach($data as $item)
                {{--desktop view--}}
                <div class="col-md-12 mb-4 d-none d-lg-block">
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                                <a href="{{url('news/detail/'.$item->id)}}" class="text-dark">
                                    <img src="{{$item->banner}}" class="card-img ctn-vr-thumbnail" alt="{{$item->banner}}">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><a href="{{url('news/detail/'.$item->id)}}" class="text-dark">{{App::isLocale('id') ? $item->title_ind : $item->title_en}}</a></h5>
                                    @php
                                        $text = App::isLocale('id') ? strip_tags($item->description_ind) : strip_tags($item->description_en);
                                        $text = stripslashes($text);
                                        $limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('news/detail/'.$item->id)."'> ...readmore</a>" : $text;
                                    @endphp
                                    <p class="card-text">{!! $limit_text !!}</p>
                                    <p class="card-text"><small class="text-muted">{{$item->created_at->diffForHumans()}}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--mobile view--}}
                <div class="col-md-12 mb-5 d-lg-none">
                    <div class="card h-100">
                        <a href="{{url('news/detail/'.$item->id)}}" class="text-dark">
                            <img class="card-img-top" src="{{$item->banner}}" alt="" height="200" widht="400">
                            <div class="card-body">
                                <h5 class="card-title">{{App::isLocale('id') ? $item->title_ind : $item->title_en}}</h5>
                                <p class="card-text">
                                    @php
                                        $text = App::isLocale('id') ? strip_tags($item->description_ind) : strip_tags($item->description_en);
                                        $limit_text = strlen($text) > 250 ? substr($text, 0, 250)."<a href='".url('news/detail/'.$item->id)."'> ...readmore</a>" : $text;
                                    @endphp
                                    {!! $limit_text !!}
                                </p>
                                <p class="card-text"><small class="text-muted text-white">{{$item->created_at->diffForHumans()}}</small></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $data->links() }}
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection