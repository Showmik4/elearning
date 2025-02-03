@extends('layouts.main')
@section('title'){{ 'Orders' }}@endsection
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
                        <h3>Orders</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Order</li>
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
                                {{-- @can('about.create')
                                <a href="{{ route('about.create') }}" class="btn btn-md btn-info " ><i class="fa fa-plus"></i>Create New</a>
                                @endcan --}}
                               
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
            $('#orderTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('order.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},  
                    {title: 'Course', data: 'course', name: 'course', className: "text-center", orderable: true, searchable: true},   
                    {title: 'Student', data: 'user', name: 'user', className: "text-center", orderable: true, searchable: true},              
                    {title: 'Payment Method', data: 'payment_method', name: 'payment_method', className: "text-center", orderable: true, searchable: true},  
                    {title: 'Total Price', data: 'total_price', name: 'total_price', className: "text-center", orderable: true, searchable: true},         
                    { 
                    title: 'Action', 
                    className: "text-center", 
                    data: function (data) {
                        let buttons = '';                       
                    
                        if (data.permissions.includes('order.course_details')) {
                            buttons += '<a title="course material" class="btn btn-warning btn-sm" data-panel-id="' + data.course_id + '" onclick="courseDetails(this)"><i class="fa fa-eye"></i></a>';
                        }                      
                        return buttons || 'No Actions Available'; 
                    }, 
                    orderable: false, 
                    searchable: false
                 }
                ],              
                
            });
        }); 
        
        function courseDetails(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("order.course_details", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }
      
    </script>
@endsection
