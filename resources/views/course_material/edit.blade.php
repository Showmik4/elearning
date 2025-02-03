@extends('layouts.main')
@section('title'){{ 'Course Material Edit' }}@endsection
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
                        <h3>Course Material Edit</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Course Material Edit</li>
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
                            <form class="form-wizard" action="{{ route('course_material.update', $course_material->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">                                  
                                        
                                        <div class="mb-3">
                                            <label for="field">File</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="file" type="file" placeholder="Enter Image">
                                            <span class="text-danger"><b>{{  $errors->first('file') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="field">Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="description" type="text" placeholder="Enter Description"  required>{{$course_material->description}}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('description') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="field">Status</label><span class="text-danger">*</span>
                                            <select class="form-control" name="status">
                                                <option value="">Select Status</option>                                            
                                                <option value="Active" @if($course_material->status ===  'Active') selected @endif >Active</option>
                                                <option value="Inactive" @if($course_material->status ===  'Inactive') selected @endif>Inactive</option>                                                                                            
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('status') }}</b></span>
                                        </div>
                                      
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('course.show') }}">Cancel</a></button>
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