@extends('BE.layout')
@section('edu-program')
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
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">@lang('messages_be.education_title')</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.education_list')</h6>
                    @if(\App\Model\content_tbl::select('id')->where('institutional_id', auth('admin')->user()->institutional_id)->first())
                        <a href="{{route('edu-add')}}" class="btn btn-primary">@lang('messages_be.education_add')</a>
                    @endif
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>@lang('messages.home_select_heritage')</th>
                                <th>@lang('messages_be.education_input_name')</th>
                                <th>@lang('messages_be.info_closing_day')</th>
                                <th>@lang('messages_be.content_input_description')</th>
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
            ajax: '{{route('edu-get')}}',
            columns: [
                { data: 'name', name: 'content.name' },
                { data: 'edu_name', name: 'content_edu_program.name' },
                { data: 'close_ind', name: 'close_ind' },
                { data: 'description_en', name: 'description_en' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection