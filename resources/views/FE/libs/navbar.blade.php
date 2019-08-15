<nav class="ctn-home-topnavbar">
    <div class="container">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link text-light" href="#">SERVICES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#">NEWS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-block btn-outline-warning btn-sm" href="#">LOGIN ACCOUNT</a>
            </li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{url('bootstrap/vendor/iheritage.png')}}" width="200" height="85">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item text-uppercase @yield('home')">
                <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item text-uppercase @yield('heritage-place')">
                <a class="nav-link" href="{{url('heritage-place')}}">Heritage Place</a>
            </li>
            <li class="nav-item text-uppercase">
                <a class="nav-link" href="#">Event</a>
            </li>
            <li class="nav-item text-uppercase">
                <a class="nav-link" href="#">Education Program</a>
            </li>
            <li class="nav-item text-uppercase @yield('vr-tour')">
                <a class="nav-link" href="{{url('vr-tour')}}">Virtual Reality Tour</a>
            </li>
        </ul>
        </div>
    </div>
</nav>