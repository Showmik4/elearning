@extends('layouts.main')
@section('title'){{ 'Question Edit' }}@endsection
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
                        <h3>Question Edit</h3>
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
                            <form class="form-wizard" action="{{ route('question.update', $question->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="survey">Survey</label><span class="text-danger">*</span>
                                            <select class="form-control" name="survey_id">
                                                <option value="">Select Survery</option>
                                                @foreach ($survey as $surveys)
                                                <option value="{{$surveys->id}}" @if($question->survey_id === $question->id) selected @endif>{{$surveys->title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"> <b>{{  $errors->first('survey_id') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="questionTitle">Question</label><span class="text-danger">*</span>
                                            <input class="form-control" id="title" name="title" type="text" placeholder="Question Title" value="{{$question->title}}">
                                            <span class="text-danger"><b>{{  $errors->first('title') }}</b></span>
                                        </div> 
                                                                             
                                        <div class="row" id="optionArea">
                                            <h5 class="text-center">Offered Answer</h5>
                                            <hr>
                                            @foreach ($question->question_point as $point)
                                            <div class="mb-3 col-md-6">
                                                <label for="forMinor">Offered Answer</label><span class="text-danger">*</span>
                                                <input class="form-control" id="option" name="offered_answer[]" value="{{$point->offered_answer}}" type="text" placeholder="Enter Offered Answer">
                                                <input type="hidden" value="{{ $point->id }}" name="offered_answer_id[]">
                                                <span class="text-danger"><b>{{ $errors->first('offered_answer') }}</b></span>
                                            </div> 
                                            @endforeach
                                            {{-- <div class="mb-3 col-md-12">
                                                <button type="button" class="btn btn-primary px-5" onclick="addMoreOption()">Add More</button>
                                            </div> --}}
                                        </div>                                    
                                                                               
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('question.show') }}">Cancel</a></button>
                                            <button class="btn btn-primary" type="submit">Update</button>
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
   
@endsection
