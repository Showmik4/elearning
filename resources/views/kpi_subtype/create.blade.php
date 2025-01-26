@extends('layouts.main')
@section('title'){{ 'Kpi Sub Type Create' }}@endsection
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
                        <h3>Kpi Sub Type Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Kpi Sub Type</li>
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
                            <form class="form-wizard" action="{{ route('kpi_subtype.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="type">Kpi Type</label><span class="text-danger">*</span>
                                            <select class="form-control" name="fk_type_id">
                                                <option value="">Select Kpi Type</option>
                                                @foreach ($type as $types)
                                                <option value="{{$types->id}}">{{$types->type_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('fk_type_id') }}</b></span>
                                        </div>   
                                        <div class="mb-3">
                                            <label for="subTypeName">SubType Name</label><span class="text-danger">*</span>
                                            <input class="form-control" id="subTypeName" name="subtype_name" type="text" placeholder="Sub Type Name" value="{{ old('subtype_name') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('subtype_name') }}</b></span>
                                        </div>  

                                        <div class="row" id="topicArea">
                                            <div class="mb-3">
                                            <label for="forMinor">Sub Type Topic</label><span class="text-danger">*</span>
                                            <input class="form-control" id="topic" name="topic_name[]" type="text" placeholder="Topic Name" >
                                                <span class="text-danger"><b>{{ $errors->first('topic_name') }}</b></span>
                                            </div>
        
                                            <div class="mb-3 col-md-12">
                                            <button type="button" class="btn btn-primary px-5" onclick="addMoreTopic()">Add More</button>
                                            </div>
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
let topicCounter = 1; 

function addMoreTopic() {
    event.preventDefault();       

    const newTopicRowId = `topicRow${topicCounter}`;        
    var newTopicArea = `
        <div class="row" id="${newTopicRowId}">
             <div class="mb-3 col-md-6">
            <label for="forMinor">Sub Type Topic</label><span class="text-danger">*</span>
            <input class="form-control" id="topic" name="topic_name[]" type="text" placeholder="Topic Name" >
            <span class="text-danger"><b>{{ $errors->first('topic_name') }}</b></span>
            </div>

            <div class="mb-3 col-md-12">
                <button type="button" class="btn btn-primary px-5" onclick="addMoreTopic()">Add More</button>
                <button type="button" class="btn btn-danger px-5" onclick="removeTopic('${newTopicRowId}')">Remove</button>
            </div>
        </div>
    `;      
    $('#topicArea').append(newTopicArea);        
    topicCounter++;  
}

function removeTopic(rowId) {       
    $(`#${rowId}`).remove();
}
</script>
@endsection