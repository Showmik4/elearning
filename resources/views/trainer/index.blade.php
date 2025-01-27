@extends('layouts.main')
@section('title'){{ 'Trainer' }}@endsection
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
                        <h3>Trainer</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Trainer</li>
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
                                @can('trainer.create')
                                <a href="{{ route('trainer.create') }}" class="btn btn-md btn-info " ><i class="fa fa-plus"></i>Create New</a>
                                @endcan
                               
                            </div>
                            <div class="table-responsive">
                                <table id="trainerTable" class="table table-striped"></table>
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
            $('#trainerTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('trainer.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Name', data: 'name', name: 'name', className: "text-center", orderable: true, searchable: true},   
                    {title: 'Field', data: 'field', name: 'field', className: "text-center", orderable: true, searchable: true},  
                    {title: 'Image', data: 'image', name: 'image', className: "text-center", orderable: true, searchable: true},            
                    { 
                    title: 'Action', 
                    className: "text-center", 
                    data: function (data) {
                        let buttons = '';                       
                    
                        if (data.permissions.includes('trainer.edit')) {
                            buttons += '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editTrainer(this)"><i class="fa fa-edit"></i></a>';
                        }
                        if (data.permissions.includes('kpi_subtype.delete')) {
                            buttons += ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.id + '" onclick="deleteTrainer(this)"><i class="fa fa-trash"></i></a>';
                        }
                        return buttons || 'No Actions Available'; 
                    }, 
                    orderable: false, 
                    searchable: false
                 }
                ],              
                
            });
        });

        function editTrainer(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("trainer.edit", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function deleteTrainer(x) {
            let id = $(x).data('panel-id');
            if (!confirm("Delete This Trainer")) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{{ route('trainer.delete') }}",
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id
                },
                success: function (data) {
                    toastr.success('Trainer deleted successfully!');
                    $('#trainerTable').DataTable().clear().draw();
                },
            });
        }
    </script>
@endsection
