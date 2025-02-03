@extends('layouts.main')
@section('title'){{ 'Course Details' }}@endsection
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
                        <h3>Course Details</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Course Details</li>
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
                               
                            </div>
                            <div class="table-responsive">
                                <table id="orderTable" class="table table-striped"></table>
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
            var courseId = "{{ $course->id ?? '' }}";
            $('#orderTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('order.course_detailsList')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.course_id=courseId;
                    },
                },
                columns: [
                {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                {title: 'Course', data: 'course', name: 'course', className: "text-center", orderable: true, searchable: true},  
                {title: 'Description', data: 'description', name: 'description', className: "text-center", orderable: true, searchable: true}, 
                {title: 'File', data: 'Downloads', name: 'Downloads', className: "text-center", orderable: true, searchable: true},  
                {title: 'Status', data: 'status', name: 'status', className: "text-center", orderable: true, searchable: true},       
              
                ],              
                
            });
        }); 
        
           
    </script>
@endsection
