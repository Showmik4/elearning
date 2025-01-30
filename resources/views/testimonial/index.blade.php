@extends('layouts.main')
@section('title'){{ 'Testimonial' }}@endsection
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
                        <h3>Testimonial</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Testimonial</li>
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
                                @can('testimonial.create')
                                <a href="{{ route('testimonial.create') }}" class="btn btn-md btn-info " ><i class="fa fa-plus"></i>Create New</a>
                                @endcan
                               
                            </div>
                            <div class="table-responsive">
                                <table id="testimonialTable" class="table table-striped"></table>
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
            $('#testimonialTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('testimonial.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Name', data: 'name', name: 'name', className: "text-center", orderable: true, searchable: true},   
                    {title: 'Field', data: 'job', name: 'job', className: "text-center", orderable: true, searchable: true},  
                    {title: 'Review', data: 'review', name: 'review', className: "text-center", orderable: true, searchable: true},  
                    {title: 'Image', data: 'image', name: 'image', className: "text-center", orderable: true, searchable: true},            
                    { 
                    title: 'Action', 
                    className: "text-center", 
                    data: function (data) {
                        let buttons = '';                       
                    
                        if (data.permissions.includes('testimonial.edit')) {
                            buttons += '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editTestimonial(this)"><i class="fa fa-edit"></i></a>';
                        }
                        if (data.permissions.includes('testimonial.delete')) {
                            buttons += ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.id + '" onclick="deleteTestimonial(this)"><i class="fa fa-trash"></i></a>';
                        }
                        return buttons || 'No Actions Available'; 
                    }, 
                    orderable: false, 
                    searchable: false
                 }
                ],              
                
            });
        });

        function editTestimonial(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("testimonial.edit", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function deleteTestimonial(x) {
            let id = $(x).data('panel-id');
            if (!confirm("Delete This Trainer")) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{{ route('testimonial.delete') }}",
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id
                },
                success: function (data) {
                    toastr.success('Testimonial deleted successfully!');
                    $('#testimonialTable').DataTable().clear().draw();
                },
            });
        }
    </script>
@endsection
