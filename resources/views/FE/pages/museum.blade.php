@extends('FE.layout')
@section('content')
<!-- Header -->
<header class="ctn-museum-bg py-5">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="text-capitalize">the history of the museum kepresidenan</h2>
            <small>"Every President Wants Do the best for you Nation and Country"</small>
            <hr>
            <p>
                The long history of the famous Indonesian nation
                thanks to its natural wealth gives rise to colonialism by
                foreign nations like the Netherlands and Japan, however
                able to free themselves and proclaim
                its independence was August 17, 1945. Until now
                Indonesia has had seven presidents since
                independence. It is fitting for the Indonesian people to remember
                the services of the nation's leaders who have devoted
                self serving the nation and the people of Indonesia.
            </p>
            <p>
                Event after event passed
                leaving traces in the form of objects
                historic form of photos, books, paintings,
                art objects, notes and others. So
                is worth remembering to be a memory
                all the time. Objects that are
                related to memory should be put
                in a special room, a "Hall of
                Fame "or saving space
                many important memories. The word "Hall of
                Fame "in Indonesian then
                interpreted as the originating Kirti Hall
                from Sanskrit. Hall has meaning
                2
                room and Kirti means fame
                so Balai Kirti means "space."
                save fame ". Balai Kirti
                can be interpreted as a building
                store and showcase variety
                historic relic that is
                once brought fame.
                Bogor Presidential Palace is
                witness to the history of various para activities
                RI President who is part of
                historical milestones
                the nation was then chosen as the location
                construction of saving space
                memorable memories of the RI Presidents
            </p>

            <div class="form-group mt-5">
                <h2 class="text-capitalize">@lang('messages.museum_gallery_title') museum kepresidenan</h2>
            </div>
            <hr>
            <div class="card mb-3">
                <img src="{{url('bootstrap/asset-img/museum/asset-mue-presiden-01.jpg')}}" class="card-img-top" alt="...">
            </div>
            <div class="card mb-3">
                <img src="{{url('bootstrap/asset-img/museum/asset-mue-presiden-03.jpg')}}" class="card-img-top" alt="...">
            </div>
            <div class="card mb-3">
                <img src="{{url('bootstrap/asset-img/museum/asset-mue-presiden-04.jpg')}}" class="card-img-top" alt="...">
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-outline-dark text-capitalize">@lang('messages.museum_gallery_button')</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q=museum%20kepresidenan&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/best-wordpress-themes/">best wordpress themes</a></div><style>.mapouter{position:relative;text-align:right;height:250px;width:350px;}.gmap_canvas {overflow:hidden;background:none!important;height:250px;width:350px;}</style></div>
            <div class="form-group mt-3">
                <h5>Museum Kepresidenan</h5>
                <p>Jl. Ir. H. Juanda No.1 (inside the Bogor Presidential Palace Complex)</p>
            </div>
            <div class="form-group">
                <h5>@lang('messages.museum_information')</h5>
                <p>Virtual Reality Tour 360&deg; : <a href="http://museumkepresidenan.indonesiaheritage.org" target="_blank">museumkepresidenan.indonesiaheritage.org</a></p>
            </div>
            <div class="form-group">
                <p>Website : <a href="https://kebudayaan.kemdikbud.go.id/muspres/" target="_blank">kebudayaan.kemdikbud.go.id/muspres</a></p>
            </div>
            <div class="form-group">
                <p>Phone : (0251) 7561701</p>
            </div>
            <div class="form-group">
                <p>Email : museumkepresidenanindonesia@gmail.com</p>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('messages.museum_information_opening')</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        @lang('messages.museum_information_tuesday')<br>
                        <strong>09:00 - 15:00</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_wednesday')<br>
                        <strong>09:00 - 15:00</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_thursday')<br>
                        <strong>09:00 - 15:00</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_friday')<br>
                        <strong>09:00 - 15:00</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_saturday')<br>
                        <strong>09:00 - 13:00</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_sunday')<br>
                        <strong>09:00 - 13:00</strong>
                    </li>
                    <li class="list-group-item">
                        @lang('messages.museum_information_close')
                        <strong class="text-danger">(CLOSE)</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
@endsection