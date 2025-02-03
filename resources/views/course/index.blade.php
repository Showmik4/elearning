@extends('layouts.main')
@section('title'){{ 'Course' }}@endsection
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
                        <h3>Course</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Course</li>
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
                                @can('course.create')
                                <a href="{{ route('course.create') }}" class="btn btn-md btn-info " ><i class="fa fa-plus"></i>Create New</a>
                                @endcan
                               
                            </div>
                            <div class="table-responsive">
                                <table id="courseTable" class="table table-striped"></table>
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
            $('#courseTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('course.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Title', data: 'title', name: 'title', className: "text-center", orderable: true, searchable: true},   
                    {title: 'category', data: 'category', name: 'category', className: "text-center", orderable: true, searchable: true},  
                    {title: 'trainer', data: 'trainer', name: 'trainer', className: "text-center", orderable: true, searchable: true},            
                    { 
                    title: 'Action', 
                    className: "text-center", 
                    data: function (data) {
                        let buttons = '';                       
                    
                        if (data.permissions.includes('course.edit')) {
                            buttons += '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editCourse(this)"><i class="fa fa-edit"></i></a>';
                        }
                        if (data.permissions.includes('course.delete')) {
                            buttons += ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.id + '" onclick="deleteCourse(this)"><i class="fa fa-trash"></i></a>';
                        }

                        if (data.permissions.includes('course_material.create')) {
                            buttons += ' <a title="course material" class="btn btn-primary btn-sm" data-panel-id="' + data.id + '" onclick="uploadFile(this)"><i class="fa fa-plus"></i></a>';
                        }
                        return buttons || 'No Actions Available'; 
                    }, 
                    orderable: false, 
                    searchable: false
                 }
                ],              
                
            });
        });

        function editCourse(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("course.edit", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function deleteCourse(x) {
            let id = $(x).data('panel-id');
            if (!confirm("Delete This Course")) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{{ route('course.delete') }}",
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id
                },
                success: function (data) {
                    toastr.success('Course deleted successfully!');
                    $('#courseTable').DataTable().clear().draw();
                },
            });
        }

        function uploadFile(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("course_material.create", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }
    </script>
@endsection
