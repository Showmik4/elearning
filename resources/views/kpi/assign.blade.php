@extends('layouts.main')
@section('title'){{ 'Kpi Assign' }}@endsection
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
                        <h3>Kpi Assign</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Kpi Assign</li>
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
                            <form class="form-wizard" action="{{ route('kpi.assign_submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <input type="hidden" name="fk_kpi_id" value="{{$kpi->id}}">
                                        <div class="mb-3">
                                            <label for="member">Assigned To</label><span class="text-danger">*</span>
                                            <select class="form-control" name="fk_user_id[]" aria-placeholder="select" id="member" multiple>
                                                <option value="">Select Member</option>
                                                @foreach ($user as $users)
                                                <option value="{{$users->userId}}">{{$users->firstName .' '.$users->lastName}}</option>
                                                @endforeach
                                            </select>                                            
                                            <span class="text-danger"> <b>{{  $errors->first('fk_user_id') }}</b></span>
                                        </div>  
                                        <div class="mb-3">
                                            <label for="member">Target</label><span class="text-danger">*</span>
                                            <input type="number" name="target" class="form-control">                                       
                                            <span class="text-danger"> <b>{{  $errors->first('target') }}</b></span>
                                        </div>                                                                 
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('kpi.show') }}">Kpi List</a></button>
                                            <button class="btn btn-primary" type="submit">Assign</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="assignTable" class="table table-striped table-bordered"></table>
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
    //Select2
    $(document).ready(function () {          
    $('#member').select2({
    tags:true,
    });  
  
    });

    //Assign Table 
    $(document).ready(function () {
            $('#assignTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('kpi.assignList')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.kpi_id = {{ @$kpi->id }} 
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Member', data: 'member', name: 'member', className: "text-center", orderable: true, searchable: true},
                    {title: 'Type Name', data: 'type', name: 'type', className: "text-center", orderable: true, searchable: true},   
                    {title: 'SubType Name', data: 'subtype', name: 'subtype', className: "text-center", orderable: true, searchable: true},  
                    {title: 'Topics Name', data: 'topic', name: 'topic', className: "text-center", orderable: true, searchable: true}, 
                    {title: 'Target', data: 'target', name: 'target', className: "text-center", orderable: true, searchable: true}, 
                    {title: 'Total Complete', data: 'total_complete', name: 'total_complete', className: "text-center", orderable: true, searchable: true},
                    {title: 'Date', data: 'date', name: 'date', className: "text-center", orderable: true, searchable: true},
                    {title: 'Assigned By', data: 'added_by', name: 'added_by', className: "text-center", orderable: true, searchable: true},                    
                    {title: 'Downloads', data: 'Downloads', name: 'Downloads', className: "text-center", orderable: true, searchable: true},       
                ],             
                
            });
    });

</script> 
@endsection
