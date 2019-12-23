@extends('BE.layout')
@section('visiting-order')
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
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">visiting order</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">data visiting order</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table" id="datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Institutional</th>
                                <th>Contact</th>
                                <th>Numbers of Visitor</th>
                                <th>Date</th>
                                <th>Information</th>
                                <th>Response</th>
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
                ajax: '{{route('content-visiting-get')}}',
                columns: [
                    { data: 'code_booking', name: 'code_booking' },
                    { data: 'institutional_name', name: 'institutional_name' },
                    { data: 'contact', name: 'contact', orderable: false, searchable: false},
                    { data: 'visitor', name: 'visitor' },
                    { data: 'date', name: 'date' },
                    { data: 'information', name: 'information' },
                    { data: 'messages_response', name: 'messages_response' },
                    { data: 'detail', name: 'detail', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection