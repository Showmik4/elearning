@extends('layouts.main')
@section('title'){{ 'Survey' }}@endsection
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
                        <h3>Survey</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Survey</li>
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
                                @can('survey.create')
                                <a href="{{ route('survey.create') }}" class="btn btn-md btn-info " ><i class="fa fa-plus"></i>Create New</a>
                                @endcan                               
                            </div>
                            <div class="table-responsive">
                                <table id="surveyTable" class="table table-striped"></table>
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
            $('#surveyTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('survey.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Title', data: 'title', name: 'title', className: "text-center", orderable: true, searchable: true},   
                    {title: 'Description', data: 'description', name: 'description', className: "text-center", orderable: true, searchable: true},   
                    { 
                    title: 'Action', 
                    className: "text-center", 
                    data: function (data) {
                        let buttons = '';                       
                      
                        if (data.permissions.includes('survey.edit')) {
                            buttons += '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editSurvey(this)"><i class="fa fa-edit"></i></a>';
                        }
                        if (data.permissions.includes('survey.delete')) {
                            buttons += ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.id + '" onclick="deleteSurvey(this)"><i class="fa fa-trash"></i></a>';
                        }
                        if (data.permissions.includes('survey.details')) {
                            buttons += ' <a title="delete" class="btn btn-primary btn-sm" data-panel-id="' + data.id + '" onclick="viewSurvey(this)"><i class="fa fa-eye"></i></a>';
                        }
                        return buttons || 'No Actions Available'; 
                    }, 
                    orderable: false, 
                    searchable: false
                    }            
                  
                ],
                "columnDefs": [
                    {
                        "targets": 2, 
                        "render": function(data, type, row) {                         
                            if (typeof data === 'string') {                            
                                return data.split(',').join('<br>');
                            } else {                              
                                return data;
                            }
                        }
                    }
                ]
                
            });
        });

        function editSurvey(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("survey.edit", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function viewSurvey(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("survey.details", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function deleteSurvey(x) {
            let countryId = $(x).data('panel-id');
            if (!confirm("Delete This Survey?")) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{{ route('survey.delete') }}",
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id
                },
                success: function (data) {
                    toastr.success('Survey deleted successfully!');
                    $('#surveyTable').DataTable().clear().draw();
                },
            });
        }
    </script>
@endsection
