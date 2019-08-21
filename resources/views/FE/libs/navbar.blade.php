<nav class="ctn-home-topnavbar">
    <div class="container">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link text-light" href="#">ABOUT US</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#">OUR SERVICES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#">NEWS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-block btn-outline-warning btn-sm" href="#">LOGIN ACCOUNT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#"> | </a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-switch-lang" href="#">
                    <img src="https://cdn1.iconfinder.com/data/icons/flags-of-the-world-set-1-1/100/.svg-24-512.png" class="switch-lang">
                </a>
                <a class="nav-switch-lang" href="#">
                    <img src="https://cdn1.iconfinder.com/data/icons/ensign-11/512/117_Ensign_Flag_Nation_indonesia-512.png" class="switch-lang">
                </a>
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Language
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index:10000">
                    <a class="dropdown-item" href="#">English</a>
                    <a class="dropdown-item" href="#">Indonesia</a>
                </div>
            </li> -->
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
                <a class="nav-link" href="{{url('heritage-place')}}">Heritage</a>
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