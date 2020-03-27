@extends('BE.layout')
@section('header')
    @php
        $institutional_id = auth('admin')->user()->is_admin_master == "Y" ? "all" : auth('admin')->user()->institutional_id;
    @endphp
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var visitor = <?php echo \App\Model\visitor_counting::visitorLineChart($institutional_id); ?>;
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(visitor);
            var options = {
                title: 'Number of visitors per day',
                curveType: 'function',
                legend: { position: 'bottom' }
            };
            var chart = new google.visualization.LineChart(document.getElementById('linechart'));
            chart.draw(data, options);
        }
    </script>

    {{--<script type="text/javascript">--}}
        {{--google.charts.load("current", {packages:["corechart"]});--}}
        {{--google.charts.setOnLoadCallback(drawChart);--}}
        {{--function drawChart() {--}}
            {{--var data = google.visualization.arrayToDataTable([--}}
                {{--['View', 'All'],--}}
                {{--['Collection',     "{{\App\Model\visitor_counting::viewPieChart($institutional_id, "collection")}}"],--}}
                {{--['Education',      "{{\App\Model\visitor_counting::viewPieChart($institutional_id, "education")}}"],--}}
                {{--['Event',  "{{\App\Model\visitor_counting::viewPieChart($institutional_id, "event")}}"]--}}
            {{--]);--}}

            {{--var options = {--}}
                {{--title: 'All View',--}}
                {{--pieHole: 0.5,--}}
            {{--};--}}

            {{--var chart = new google.visualization.PieChart(document.getElementById('donutchart'));--}}
            {{--chart.draw(data, options);--}}
        {{--}--}}
    {{--</script>--}}
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="{{auth('admin')->user()->is_admin_master == "Y" ? "col-xl-3 col-md-6" : "col-xl-4 col-md-6"}} mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">@lang('messages_be.dashboard_visiting')</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Model\visitor_counting::visitor_perday($institutional_id)}}</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="{{auth('admin')->user()->is_admin_master == "Y" ? "col-xl-3 col-md-6" : "col-xl-4 col-md-6"}} mb-4">
        <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">@lang('messages_be.dashboard_collection')</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Model\content_collection_tbl::countCollection(auth('admin')->user()->is_admin_master, auth('admin')->user()->institutional_id)}}</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-folder fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    @if(auth('admin')->user()->is_admin_master == "Y")
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">@lang('messages_be.dashboard_approval')</div>
                <div class="row no-gutters align-items-center">
                <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\User::countWaitingAppr()}}</div>
                </div>
                <!-- <div class="col">
                    <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div> -->
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>
    @endif

    <!-- Pending Requests Card Example -->
    <div class="{{auth('admin')->user()->is_admin_master == "Y" ? "col-xl-3 col-md-6" : "col-xl-4 col-md-6"}} mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Admin</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\User::countAdmin(auth('admin')->user()->is_admin_master, auth('admin')->user()->institutional_id)}}</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        @if(\App\Model\visitor_counting::visitorLineChart($institutional_id) != '[["Date","Visit"]]')
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">@lang('messages_be.dashboard_visitor')</h6>
                    {{--<div class="dropdown no-arrow">--}}
                    {{--<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                        {{--<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">--}}
                        {{--<div class="dropdown-header">Dropdown Header:</div>--}}
                        {{--<a class="dropdown-item" href="#">Action</a>--}}
                        {{--<a class="dropdown-item" href="#">Another action</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="linechart" style="width: 100%; height: 320px;"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Pie Chart -->
        {{--<div class="col-xl-12 col-lg-12">--}}
            {{--<div class="card shadow mb-4">--}}
                {{--<!-- Card Body -->--}}
                {{--<div class="card-body">--}}
                    {{--<div class="table-responsive">--}}
                        {{--<div id="donutchart" style="width: 100%; height: 373px;"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

</div>
@endsection
@section('footer')
    <!-- Page level plugins -->
    <script src="{{url('backend/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('backend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{url('backend/js/demo/chart-pie-demo.js')}}"></script>
@endsection