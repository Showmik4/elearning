@extends('layouts.main')
@section('title'){{ 'Complete Survey' }}@endsection
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
                            <li class="breadcrumb-item active">Complete Survey</li>
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
                            {{-- <div class="text-end mb-3">
                                <a href="{{ route('survey.create') }}" class="btn btn-md btn-info " ><i class="fa fa-plus"></i>Create New</a>
                            </div> --}}
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
                    "url": "{{route('survey.complete_survey_list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'Reference No', data: 'reference_no', name: 'reference_no', className: "text-center", orderable: true, searchable: true},
                    {title: 'Survey', data: 'survey', name: 'survey', className: "text-center", orderable: true, searchable: true}, 
                    {title: 'User', data: 'user', name: 'user', className: "text-center", orderable: true, searchable: true}, 
                    { 
                    title: 'Action', 
                    className: "text-center", 
                    data: function (data) {
                        let buttons = '';                      
                        if (data.permissions.includes('survey.view_complete_survey_answer')) {
                            buttons += '<a title="view answer" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="viewSurveyAnswer(this)"><i class="fa fa-eye"></i></a>';
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

        function viewSurveyAnswer(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("survey.view_complete_survey_answer", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function viewSurvey(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("survey.details", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

    </script>
@endsection
