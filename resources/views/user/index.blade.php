@extends('layouts.main')
@section('title'){{ 'Users' }}@endsection
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
                    <h3>Users</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a>
                        </li> --}}
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">All Users</li>
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
                            <a href="{{ route('user.create-employee') }}" class="btn btn-md btn-info "><i
                                    class="fa fa-plus"></i>Create New</a>
                        </div>
                        <div class="table-responsive">
                            <table id="employeeTable" class="table table-striped"></table>
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
            $('#employeeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('user.employee-list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'First Name', data:'firstName', name:'firstName', className: "text-center", orderable: true, searchable: true},    
                    {title: 'Last Name', data:'lastName', name:'lastName', className: "text-center", orderable: true, searchable: true}, 
                    {title: 'Phone', data:'phone', name: 'phone', className: "text-center", orderable: true, searchable: true},   
                    {title: 'Email', data:'email', name: 'email', className: "text-center", orderable: true, searchable: true},   
                    {title: 'Role', data: 'role', name: 'role', className: "text-center", orderable: true, searchable: true}, 
                    // {title: 'Team', data: 'team', name: 'team', className: "text-center", orderable: true, searchable: true},    
                    {title: 'Action', className: "text-center", data: function (data) {
                        return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.userId + '" onclick="editEmployee(this)"><i class="fa fa-edit"></i></a>'+
                            ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.userId + '" onclick="deleteEmployee(this)"><i class="fa fa-trash"></i></a>';
                    }, orderable: false, searchable: false
                }
                ]
            });
        }); 

        function editEmployee(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("user.editEmployee", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }
        
        function deleteEmployee(x) {
            let userId = $(x).data('panel-id');
            if(!confirm("Delete this employee?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('user.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'userId': userId},
                success: function (data) {
                    toastr.success('Employee Deleted Successfully!');
                    $('#employeeTable').DataTable().clear().draw();
                },
            });
        }
</script>
@endsection