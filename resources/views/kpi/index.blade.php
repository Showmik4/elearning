@extends('layouts.main')
@section('title'){{ 'Kpi' }}@endsection
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
                        <h3>Kpi</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Kpi</li>
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
                                @can('kpi.create')
                                <a href="{{ route('kpi.create') }}" class="btn btn-md btn-info " ><i class="fa fa-plus"></i>Create New</a>
                                @endcan
                               
                            </div>
                            <div class="table-responsive">
                                <table id="kpiTable" class="table table-striped"></table>
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
            $('#kpiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('kpi.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Type Name', data: 'type', name: 'type', className: "text-center", orderable: true, searchable: true},   
                    {title: 'SubType Name', data: 'subtype', name: 'subtype', className: "text-center", orderable: true, searchable: true},  
                    {title: 'Topics Name', data: 'topic', name: 'topic', className: "text-center", orderable: true, searchable: true},   
                    {title: 'Date', data: 'date', name: 'date', className: "text-center", orderable: true, searchable: true},
                    {title: 'Downloads', data: 'Downloads', name: 'Downloads', className: "text-center", orderable: true, searchable: true},    
                        { 
                        title: 'Action', 
                        className: "text-center", 
                        data: function (data) {
                        let buttons = '';                       
                      
                        if (data.permissions.includes('kpi.assign')) {
                            buttons += '<a title="kpi assign" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="assignKpi(this)"><i class="fa fa-plus"></i></a>';
                        }                     
                        return buttons || 'No Actions Available'; 
                        }, 
                        orderable: false, 
                        searchable: false
                    }    
                  
                ],              
                
            });
        });

        function editKpi(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("kpi.edit", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function assignKpi(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("kpi.assign", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function deleteKpi(x) {
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
