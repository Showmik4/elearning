@extends('layouts.main')
@section('title'){{ 'Trainer Edit' }}@endsection
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
                        <h3>Trainer Edit</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Trainer</li>
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
                            <form class="form-wizard" action="{{ route('trainer.update', $trainer->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="name">Name</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="name" type="text" placeholder="Enter Name" value="{{$trainer->name}}" required>
                                            <span class="text-danger"><b>{{  $errors->first('name') }}</b></span>
                                        </div>   
                                        <div class="mb-3">
                                            <label for="field">Field</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="field" type="text" placeholder="Enter Trainer Field" value="{{$trainer->field}}" required>
                                            <span class="text-danger"><b>{{  $errors->first('field') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="field">Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="description" type="text" placeholder="Enter Description"  required>{{$trainer->description}}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('description') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="field">Image</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="image" type="file" placeholder="Enter Image">
                                            <span class="text-danger"><b>{{  $errors->first('image') }}</b></span>
                                        </div> 
                                        @if(isset($trainer->image))
                                        <div class="mb-3">
                                            <img height="100px" width="100px" src="{{ url(@$trainer->image) }}" alt="">
                                        </div>
                                        @endif
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('trainer.show') }}">Cancel</a></button>
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


@endsection