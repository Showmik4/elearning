@extends('layouts.main')
@section('title'){{ 'Course Material' }}@endsection
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
                        <h3>Course Material Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Course Material</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-wizard" action="{{ route('course_material.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">                                  
                                        <input type="hidden" name="course_id" value="{{$course->id}}">
                                        <div class="mb-3">
                                            <label for="field">File</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="file" type="file" placeholder="Enter Image"  required>
                                            <span class="text-danger"><b>{{  $errors->first('file') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="field">Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="description" type="text" placeholder="Enter Description"  required></textarea>
                                            <span class="text-danger"><b>{{  $errors->first('description') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="field">Status</label><span class="text-danger">*</span>
                                            <select class="form-control" name="status">
                                                <option value="">Select Status</option>                                            
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>                                                                                            
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('status') }}</b></span>
                                        </div>
                                      
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('course_material.show') }}">Cancel</a></button>
                                            <button class="btn btn-primary" type="submit">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="materialTable" class="table table-striped"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer.js')
<script>
    $(document).ready( function () {
        CKEDITOR.replace( 'details_page_banner_description');  
        CKEDITOR.replace( 'long_details');                
    });

    
    $(document).ready(function () {
        $('#materialTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{route('course_material.list')}}",
                "type": "POST",
                data: function (d) {
                    d._token = "{{ csrf_token() }}";
                    d.course_id = {{ @$course->id }}
                },
            },
            columns: [
                {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                {title: 'Course', data: 'course', name: 'course', className: "text-center", orderable: true, searchable: true},  
                {title: 'Description', data: 'description', name: 'description', className: "text-center", orderable: true, searchable: true}, 
                {title: 'File', data: 'Downloads', name: 'Downloads', className: "text-center", orderable: true, searchable: true},  
                {title: 'Status', data: 'status', name: 'status', className: "text-center", orderable: true, searchable: true},            
                { 
                title: 'Action', 
                className: "text-center", 
                data: function (data) {
                    let buttons = '';                      
                
                    if (data.permissions.includes('course_material.edit')) {
                        buttons += '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editCourseMaterial(this)"><i class="fa fa-edit"></i></a>';
                    }
                   
                    return buttons || 'No Actions Available'; 
                }, 
                orderable: false, 
                searchable: false
                }
            ],              
            
        });
    });

    function editCourseMaterial(x) {
        let btn = $(x).data('panel-id');
        let url = '{{route("course_material.edit", ":id") }}';
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