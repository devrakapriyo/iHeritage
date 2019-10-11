<nav class="ctn-home-topnavbar">
    <div class="container">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link text-light text-uppercase" href="{{url('about-us')}}">@lang('messages.head_menu_about')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light text-uppercase" href="{{url('our-services')}}">@lang('messages.head_menu_service')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light text-uppercase" href="{{url('news')}}">@lang('messages.head_menu_news')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-block btn-outline-warning btn-sm  text-uppercase" href="{{url('login')}}">@lang('messages.head_menu_login')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#"> | </a>
            </li>
            <!-- <li class="nav-item mt-2">
                @if(App::isLocale('id'))
                    <a class="nav-switch-lang" href="{{url('locale/en')}}">
                        <img src="https://cdn1.iconfinder.com/data/icons/flags-of-the-world-set-1-1/100/.svg-24-512.png" class="switch-lang" title="Change to English?">
                    </a>
                @else
                    <a class="nav-switch-lang" href="{{url('locale/id')}}">
                        <img src="https://cdn1.iconfinder.com/data/icons/ensign-11/512/117_Ensign_Flag_Nation_indonesia-512.png" class="switch-lang" title="Ubah ke bahasa Indonesia?">
                    </a>
                @endif
            </li> -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Language
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index:10000">
                    <a class="dropdown-item" href="{{url('locale/en')}}">English</a>
                    <a class="dropdown-item" href="{{url('locale/id')}}">Indonesia</a>
                </div>
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
                <a class="nav-link" href="{{url('/')}}">@lang('messages.nav_menu_home')</a>
            </li>
            <li class="nav-item text-uppercase @yield('heritage-place')">
                <a class="nav-link" href="{{url('heritage-place')}}">@lang('messages.nav_menu_heritage')</a>
            </li>
            <li class="nav-item text-uppercase @yield('event')">
                <a class="nav-link" href="{{url('event')}}">@lang('messages.nav_menu_event')</a>
            </li>
            <li class="nav-item text-uppercase @yield('education-program')">
                <a class="nav-link" href="{{url('education-program')}}">@lang('messages.nav_menu_edu_pro')</a>
            </li>
            <li class="nav-item text-uppercase @yield('vr-tour')">
                <a class="nav-link" href="{{url('vr-tour')}}">@lang('messages.nav_menu_vr')</a>
            </li>
        </ul>
        </div>
    </div>
</nav>