@extends('layouts.main')
@section('title'){{ 'Question Create' }}@endsection
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
                        <h3>Question Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Question</li>
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
                            <form class="form-wizard" action="{{ route('question.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="survey">Select Survey</label><span class="text-danger">*</span>                                          
                                            <select class="form-control" name="survey_id">
                                                <option value="">Select Survery</option>
                                                @foreach ($survey as $surveys)
                                                <option value="{{$surveys->id}}">{{$surveys->title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('survey_id') }}</b></span>
                                        </div>  

                                        <div class="mb-3">
                                            <label for="questionTitle">Question</label><span class="text-danger">*</span>
                                            <input class="form-control" id="title" name="title" type="text" placeholder="Question Title" value="{{ old('title') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('title') }}</b></span>
                                        </div> 
                                                                             
                                        <div class="row" id="optionArea">
                                            <div class="mb-3">
                                                <label for="forMinor">Offered Answer</label><span class="text-danger">*</span>
                                                <input class="form-control" id="option" name="offered_answer[]" type="text" placeholder="Enter Offered Answer">
                                                <span class="text-danger"><b>{{ $errors->first('offered_answer') }}</b></span>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <button type="button" class="btn btn-primary px-5" onclick="addMoreOption()">Add More</button>
                                            </div>
                                        </div>
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('question.show') }}">Cancel</a></button>
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
     let fileCounter = 1; 
     function addMoreOption() {
        event.preventDefault();      
        const newFileRowId = `fileRow_${fileCounter}`;        
        var newFileArea = `
            <div class="row" id="${newFileRowId}">
                <div class="mb-3">
                <label for="forMinor">Option</label><span class="text-danger">*</span>
                <input class="form-control" id="option" name="offered_answer[]" type="text" placeholder="Enter Option">
                <span class="text-danger"><b>{{ $errors->first('offered_answer') }}</b></span>
                </div>

                <div class="mb-3 col-md-12">
                    <button type="button" class="btn btn-primary px-5" onclick="addMoreOption()">Add More</button>
                    <button type="button" class="btn btn-danger px-5" onclick="removeFile('${newFileRowId}')">Remove</button>
                </div>
            </div>
        `;      
        $('#optionArea').append(newFileArea);        
        fileCounter++;  
    }

    function removeFile(rowId) {       
        $(`#${rowId}`).remove();
    }

   </script>
@endsection