@extends('BE.layout')
@section('form-question')
    active
@endsection
@section('header')
    <!-- Datatable core CSS -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages_be.form_questioner_title')</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.form_questioner_text')</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>@lang('messages_be.form_questioner_name')</th>
                                <th>Email</th>
                                <th>@lang('messages_be.form_questioner_subject')</th>
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
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('form-question-get')}}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'subject', name: 'subject' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection