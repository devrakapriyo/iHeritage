@extends('BE.layout')
@section('news')
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
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages_be.news_title')</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.news_list')</h6>
                    <a href="{{route('news-add')}}" class="btn btn-primary">@lang('messages_be.news_add')</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>@lang('messages_be.news_input_title')</th>
                                <th>@lang('messages_be.news_input_description')</th>
                                <th>Banner</th>
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
            ajax: '{{route('news-get')}}',
            columns: [
                { data: 'title_ind', name: 'title_ind' },
                { data: 'description_ind', name: 'description_ind' },
                { data: 'banner', name: 'banner', orderable: false, searchable: false},
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection