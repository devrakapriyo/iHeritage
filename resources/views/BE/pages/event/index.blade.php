@extends('BE.layout')
@section('event')
    active
@endsection
@section('header')
    <!-- Datatable core CSS -->
    <link href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">event</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">data event</h6>
                    @if(\App\Model\content_tbl::select('id')->where('institutional_id', auth('admin')->user()->institutional_id)->first())
                        <a href="{{route('event-add')}}" class="btn btn-primary">Add new event</a>
                    @endif
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Content Name</th>
                                <th>Name Event</th>
                                <th>Place</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Price</th>
                                {{--<th>Close Registration</th>--}}
                                <th><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>    

</div>
@endsection
@section('footer')
<!-- Datatable core JavaScript -->
<script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('event-get')}}',
            columns: [
                { data: 'name', name: 'content.name' },
                { data: 'name', name: 'content_event.name' },
                { data: 'place_ind', name: 'place.place_ind' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'price', name: 'price' },
                //{ data: 'close_registration', name: 'close_registration' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection