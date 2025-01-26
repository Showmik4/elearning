@extends('layouts.main')
@section('title'){{ 'Surveys Create' }}@endsection
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
                        <h3>Survey Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Survey</li>
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
                            <form class="form-wizard" action="{{ route('survey.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="title">Title</label><span class="text-danger">*</span>
                                            <input class="form-control" id="title" name="title" type="text" placeholder="Title" value="{{ old('title') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('title') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="description">Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="Description" name="description" type="text" placeholder="Description" value="{{ old('description') }}" required></textarea>
                                            <span class="text-danger"><b>{{  $errors->first('description') }}</b></span>
                                        </div>                                   
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('survey.show') }}">Cancel</a></button>
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