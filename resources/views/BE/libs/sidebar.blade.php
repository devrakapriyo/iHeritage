<ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">
    @php
        $auth = auth('admin')->user();
    @endphp
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
    <div class="sidebar-brand-text mx-3">iHeritage.id</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
    <a class="nav-link" href="{{route('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading
    <div class="sidebar-heading">
        Content Website
    </div>

    Nav Item - Pages Collapse Menu
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components Content</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Content :</h6>
                <a class="collapse-item" href="#">Header</a>
                <a class="collapse-item" href="#">Body</a>
                <a class="collapse-item" href="#">Footer</a>
            </div>
        </div>
    </li>

    Nav Item - Utilities Collapse Menu
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="#">Logo</a>
                <a class="collapse-item" href="#">Color</a>
            </div>
        </div>
    </li>

    Divider
    <hr class="sidebar-divider"> -->

    <!-- Heading -->
    <div class="sidebar-heading">
        Content
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Setting Pages</span>
        </a>
        <div id="collapsePages" class="collapse @yield('ctn-pgs')" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @php
                    $category = \App\Model\institutional::getData($auth->institutional_id, "category")->category;
                    $notif_museum = \App\Model\content_tbl::countWaitingAppr("museum");
                    $notif_library = \App\Model\content_tbl::countWaitingAppr("library");
                    $notif_gallery = \App\Model\content_tbl::countWaitingAppr("gallery");
                    $notif_archive = \App\Model\content_tbl::countWaitingAppr("archive");
                    $notif_temple = \App\Model\content_tbl::countWaitingAppr("temple");
                    $notif_palace = \App\Model\content_tbl::countWaitingAppr("palace");
                    $notif_nature = \App\Model\content_tbl::countWaitingAppr("nature");
                    $notif_historical = \App\Model\content_tbl::countWaitingAppr("historical-building");
                    $notif_personal_activities = \App\Model\content_tbl::countWaitingAppr("personal-activities");
                @endphp
                @if($auth->is_admin_master == "Y")
                    <a class="collapse-item @yield('museum')" href="{{route('content-pages', ['category'=>'museum'])}}">Museum @if($notif_museum != 0)<span class="badge badge-warning" title="waiting approve">{{$notif_museum}}</span>@endif</a>
                    <a class="collapse-item @yield('library')" href="{{route('content-pages', ['category'=>'library'])}}">Library @if($notif_library != 0)<span class="badge badge-warning" title="waiting approve">{{$notif_library}}</span>@endif</a>
                    <a class="collapse-item @yield('gallery')" href="{{route('content-pages', ['category'=>'gallery'])}}">Gallery @if($notif_gallery != 0)<span class="badge badge-warning" title="waiting approve">{{$notif_gallery}}</span>@endif</a>
                    <a class="collapse-item @yield('archive')" href="{{route('content-pages', ['category'=>'archive'])}}">Archive @if($notif_archive != 0)<span class="badge badge-warning" title="waiting approve">{{$notif_archive}}</span>@endif</a>
                    <a class="collapse-item @yield('temple')" href="{{route('content-pages', ['category'=>'temple'])}}">Temple @if($notif_temple != 0)<span class="badge badge-warning" title="waiting approve">{{$notif_temple}}</span>@endif</a>
                    <a class="collapse-item @yield('palace')" href="{{route('content-pages', ['category'=>'palace'])}}">Palace @if($notif_palace != 0)<span class="badge badge-warning" title="waiting approve">{{$notif_palace}}</span>@endif</a>
                    <a class="collapse-item @yield('nature')" href="{{route('content-pages', ['category'=>'nature'])}}">Nature @if($notif_nature != 0)<span class="badge badge-warning" title="waiting approve">{{$notif_nature}}</span>@endif</a>
                    <a class="collapse-item @yield('historical-building')" href="{{route('content-pages', ['category'=>'historical-building'])}}">Historical Building @if($notif_historical != 0)<span class="badge badge-warning" title="waiting approve">{{$notif_historical}}</span>@endif</a>
                    <a class="collapse-item @yield('personal-activities')" href="{{route('content-pages', ['category'=>'personal-activities'])}}">Personal Activities @if($notif_personal_activities != 0)<span class="badge badge-warning" title="waiting approve">{{$notif_personal_activities}}</span>@endif</a>
                @else
                    <a class="collapse-item @yield($category) text-capitalize" href="{{route('content-pages', ['category'=>$category])}}">{{str_replace("-", " ",$category)}}</a>
                @endif
            </div>
        </div>
    </li>

    <!-- Nav Item - Collection -->
    <li class="nav-item @yield('collection')">
        <a class="nav-link" href="{{route('collection-pages')}}">
            <i class="fas fa-fw fa-atlas"></i>
            <span>Collection</span>
        </a>
    </li>

    <!-- Nav Item - Photo -->
    <li class="nav-item @yield('photo')">
        <a class="nav-link" href="{{route('gallery-pages')}}">
            <i class="fas fa-fw fa-atlas"></i>
            <span>Photo</span>
        </a>
    </li>

    <!-- Nav Item - VR -->
    <li class="nav-item @yield('vr')">
        <a class="nav-link" href="{{route('vr-page')}}">
            <i class="fas fa-fw fa-atlas"></i>
            <span>Virtual Reality Tour 360<sup>o</sup></span>
        </a>
    </li>

    <!-- Nav Item - Event -->
    <li class="nav-item @yield('event')">
        <a class="nav-link" href="{{route('event-page')}}">
            <i class="fas fa-fw fa-compass"></i>
            <span>Event</span>
        </a>
    </li>

    <!-- Nav Item - Education Program -->
    <li class="nav-item @yield('edu-program')">
        <a class="nav-link" href="{{route('edu-page')}}">
            <i class="fas fa-fw fa-book-reader"></i>
            <span>Education Program</span>
        </a>
    </li>

    @if($auth->is_admin == "Y")
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Administrator
        </div>

        @if($auth->is_admin_master == "Y")
            <!-- Nav Item - Account -->
            <li class="nav-item @yield('heritage')">
                <a class="nav-link" href="{{route('heritage-pages')}}">
                    <i class="fas fa-fw fa-university"></i>
                    <span>About Heritage</span>
                </a>
            </li>
            <li class="nav-item @yield('our-services')">
                <a class="nav-link" href="{{route('our-services-pages')}}">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>List Our Services</span>
                </a>
            </li>
            <li class="nav-item @yield('news')">
                <a class="nav-link" href="{{route('news-pages')}}">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>List News</span>
                </a>
            </li>
            <li class="nav-item @yield('form-question')">
                <a class="nav-link" href="{{route('form-question-pages')}}">
                    <i class="fas fa-fw fa-question-circle"></i>
                    <span>List Form Question</span>
                </a>
            </li>
        @endif
        <li class="nav-item @yield('users')">
            <a class="nav-link" href="{{route('users-pages')}}">
                <i class="fas fa-fw fa-users"></i>
                <span>List Users</span>
            </a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>