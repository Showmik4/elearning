@extends('layouts.main')
@section('title'){{ 'Kpi Create' }}@endsection
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
                        <h3>Kpi</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Kpi</li>
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
                            <form class="form-wizard" action="{{ route('kpi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="type">Kpi Type</label><span class="text-danger">*</span>
                                            <select class="form-control" name="fk_type_id" id="type" onchange="typeChange()">
                                                <option value="">Select Kpi Type</option>
                                                @foreach ($type as $types)
                                                <option value="{{$types->id}}">{{$types->type_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('fk_type_id') }}</b></span>
                                        </div>  
                                        
                                        <div class="mb-3">
                                            <label for="subType">Kpi Sub Type</label><span class="text-danger">*</span>
                                            <select class="form-control" name="fk_subtype_id" id="subtype" onchange="subTypeChange()">
                                                <option value="">Select Kpi Sub Type</option>                                               
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('fk_subtype_id') }}</b></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="subTypeTopic">Kpi Sub Type Topic</label><span class="text-danger">*</span>
                                            <select class="form-control" name="fk_subtype_topic_id" id="subtypeTopic">
                                                <option value="">Select Kpi Sub Type Topic</option>                                               
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('fk_subtype_topic_id') }}</b></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="date">Date</label><span class="text-danger">*</span>
                                            <input class="form-control" id="date" name="date" type="date" placeholder="Date" value="{{ old('date') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('date') }}</b></span>
                                        </div>  

                                        <div class="row" id="fileArea">
                                            <div class="mb-3">
                                            <label for="forMinor">Attachment</label><span class="text-danger">*</span>
                                            <input class="form-control" id="file" name="file[]" type="file" placeholder="Attach Document" >
                                                <span class="text-danger"><b>{{ $errors->first('file') }}</b></span>
                                            </div>
        
                                            <div class="mb-3 col-md-12">
                                            <button type="button" class="btn btn-primary px-5" onclick="addMoreFile()">Add More</button>
                                            </div>
                                        </div> 
                                        
                                        <div class="mb-3">
                                            <label for="member">Assigned To</label><span class="text-danger">*</span>
                                            <select class="form-control" name="fk_user_id[]" aria-placeholder="select" id="member" multiple>
                                                <option value="">Select Member</option>
                                                @foreach ($user as $users)
                                                <option value="{{$users->userId}}">{{$users->firstName .''.$users->lastName}}</option>
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
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('kpi_subtype.show') }}">Cancel</a></button>
                                            <button class="btn btn-primary" type="submit">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
$('#type').select2({
tags:true,
});   

$('#subtype').select2({
tags:true,
}); 

$('#subtypeTopic').select2({
tags:true,
}); 

$('#member').select2({
    tags:true,
}); 
});

//type change

function typeChange() {
    var typeId = $('#type').val();
    $.ajax({
        type: 'POST',
        url: "{{ route('kpi.findSubType') }}",
        data: {
            'typeId': typeId,
            _token: "{{ csrf_token() }}"
        },
        success: function (data) {
            var length = data.subType.length;
            $("#subtype").empty().append('<option label="blank">Select Kpi Sub Type</option>');
            if (length > 0) {
                $("#subtype").empty().append('<option label="blank">Select Kpi Sub Type</option>')
                $.each(data.subType, function (index, item) {                    
                    $("#subtype").append("<option value= " + item.id + ">" + item
                        .subtype_name + "</option>")
                });
            }
        }
    });
}

//Sub Type Change

function subTypeChange() {
    var subtypeId = $('#subtype').val();
    $.ajax({
        type: 'POST',
        url: "{{ route('kpi.findSubTypeTopic') }}",
        data: {
            'subtypeId': subtypeId,
            _token: "{{ csrf_token() }}"
        },
        success: function (data) {
            var length = data.subTypeTopic.length;
            $("#subtypeTopic").empty().append('<option label="blank">Select Kpi Sub Type Topic</option>');
            if (length > 0) {
                $("#subtypeTopic").empty().append('<option label="blank">Select Kpi Sub Type Topic</option>')
                $.each(data.subTypeTopic, function (index, item) {                    
                    $("#subtypeTopic").append("<option value= " + item.id + ">" + item
                        .topic_name + "</option>")
                });
            }
        }
    });
}

//Multiple Topic

let fileCounter = 1; 

function addMoreFile() {
    event.preventDefault();       

    const newFileRowId = `fileRow_${fileCounter}`;        
    var newFileArea = `
        <div class="row" id="${newFileRowId}">
            <div class="mb-3 col-md-6">
                <label for="file">Attachment</label><span class="text-danger">*</span>
                <input class="form-control" name="file[]" type="file" placeholder="Attach Document" >
                <span class="text-danger"><b>{{ $errors->first('file') }}</b></span>
            </div>  

            <div class="mb-3 col-md-12">
                <button type="button" class="btn btn-primary px-5" onclick="addMoreFile()">Add More</button>
                <button type="button" class="btn btn-danger px-5" onclick="removeFile('${newFileRowId}')">Remove</button>
            </div>
        </div>
    `;      
    $('#fileArea').append(newFileArea);        
    fileCounter++;  
}

function removeFile(rowId) {       
    $(`#${rowId}`).remove();
}
</script>
@endsection