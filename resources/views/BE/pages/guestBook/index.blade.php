@extends('BE.layout')
@section('header')
    <!-- Datatable core CSS -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages_be.sidebar_guest_book')</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.sidebar_guest_book')</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table" id="datatable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Institution Visitor</th>
                                <th>ip Visitor</th>
                                <th>Visit to</th>
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script>
        $(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('list-guest-book-get')}}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'institution', name: 'institution' },
                    { data: 'ip', name: 'ip' },
                    { data: 'museum', name: 'museum' }
                ]
            });
        });
    </script>
@endsection
