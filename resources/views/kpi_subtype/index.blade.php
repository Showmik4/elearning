@extends('layouts.main')
@section('title'){{ 'Kpi Sub Type' }}@endsection
@section('header.css')
    <style>

    </style>
@endsection
@section('main.content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Kpi Sub Type</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Kpi Sub Type</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-end mb-3">
                                @can('kpi_subtype.create')
                                <a href="{{ route('kpi_subtype.create') }}" class="btn btn-md btn-info " ><i class="fa fa-plus"></i>Create New</a>
                                @endcan
                               
                            </div>
                            <div class="table-responsive">
                                <table id="subtypeTable" class="table table-striped"></table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@section('footer.js')
    <script>
        $(document).ready(function () {
            $('#subtypeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('kpi_subtype.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Type Name', data: 'type', name: 'type', className: "text-center", orderable: true, searchable: true},   
                    {title: 'SubType Name', data: 'subtype_name', name: 'subtype_name', className: "text-center", orderable: true, searchable: true},  
                    {title: 'Topics Name', data: 'topic_name', name: 'topic_name', className: "text-center", orderable: true, searchable: true},            
                    { 
                    title: 'Action', 
                    className: "text-center", 
                    data: function (data) {
                        let buttons = '';                       
                    
                        if (data.permissions.includes('kpi_subtype.edit')) {
                            buttons += '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editSubType(this)"><i class="fa fa-edit"></i></a>';
                        }
                        if (data.permissions.includes('kpi_subtype.delete')) {
                            buttons += ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.id + '" onclick="deleteSubType(this)"><i class="fa fa-trash"></i></a>';
                        }
                        return buttons || 'No Actions Available'; 
                    }, 
                    orderable: false, 
                    searchable: false
                 }
                ],              
                
            });
        });

        function editSubType(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("kpi_subtype.edit", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function deleteSubType(x) {
            let id = $(x).data('panel-id');
            if (!confirm("Delete This Sub Type")) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{{ route('kpi_subtype.delete') }}",
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id
                },
                success: function (data) {
                    toastr.success('Sub Type deleted successfully!');
                    $('#subtypeTable').DataTable().clear().draw();
                },
            });
        }
    </script>
@endsection
