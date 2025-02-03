@extends('layouts.main')
@section('title'){{ 'Homepage Settings' }}@endsection
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
                        <h3>Homepage Settings</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Homepage Settings</li>
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
                                {{-- @can('trainer.create')
                                <a href="{{ route('trainer.create') }}" class="btn btn-md btn-info " ><i class="fa fa-plus"></i>Create New</a>
                                @endcan --}}
                               
                            </div>
                            <div class="table-responsive">
                                <table id="settingTable" class="table table-striped"></table>
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
            $('#settingTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('homepage_settings.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [   
                             
                    {title: 'Banner Image', data: 'banner_image', name: 'banner_image', className: "text-center", orderable: true, searchable: true},  
                    {title: 'About Image', data: 'about_image', name: 'about_image', className: "text-center", orderable: true, searchable: true},                           
                    { 
                    title: 'Action', 
                    className: "text-center", 
                    data: function (data) {
                        let buttons = '';                       
                    
                        if (data.permissions.includes('trainer.edit')) {
                            buttons += '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editSetting(this)"><i class="fa fa-edit"></i></a>';
                        }
                     
                        return buttons || 'No Actions Available'; 
                    }, 
                    orderable: false, 
                    searchable: false
                 }
                ],              
                
            });
        });

        function editSetting(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("homepage_settings.edit", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }
       
    </script>
@endsection
