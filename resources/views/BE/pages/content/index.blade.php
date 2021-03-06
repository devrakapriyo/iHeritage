@extends('BE.layout')
@section('ctn-pgs')
    show
@endsection
@section($category)
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
        <h1 class="h3 mb-0 text-gray-800 text-capitalize">{{str_replace("-", " ",$category)}}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">@lang('messages_be.content_list')</h6>
                    @php
                        $auth = auth('admin')->user();
                        $content = App\Model\content_tbl::select('institutional_id')->where('institutional_id', $auth->institutional_id)->first();
                    @endphp
                    @if($auth->is_admin_master == "Y")
                        <a href="{{route('content-add', ['category'=>$category])}}" class="btn btn-primary">@lang('messages_be.content_add')</a>
                    @else
                        @if(empty($content))
                            <a href="{{route('content-add', ['category'=>$category])}}" class="btn btn-primary">@lang('messages_be.content_add')</a>
                        @endif
                    @endif
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>@lang('messages_be.content_input_name')</th>
                                <th>@lang('messages_be.content_input_town')</th>
                                <th>@lang('messages_be.content_input_description')</th>
                                <th>@lang('messages_be.info_price')</th>
                                <th></th>
                                <th></th>
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
            ajax: '{{route('content-get', ['category'=>$category])}}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'location', name: 'location' },
                { data: 'long_description_en', name: 'long_description_en' },
                { data: 'price', name: 'price', orderable: false, searchable: false},
                { data: 'gallery', name: 'gallery', orderable: false, searchable: false},
                { data: 'collection', name: 'collection', orderable: false, searchable: false},
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection