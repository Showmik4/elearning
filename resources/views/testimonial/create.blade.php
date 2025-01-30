@extends('layouts.main')
@section('title'){{ 'Testimonial Create' }}@endsection
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
                        <h3>Testimonial Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-wizard" action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="name">Name</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="name" type="text" placeholder="Enter Name" value="{{ old('name') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('name') }}</b></span>
                                        </div>   
                                        <div class="mb-3">
                                            <label for="field">Field</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="job" type="text" placeholder="Enter Field" value="{{ old('job') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('job') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="field">Review</label><span class="text-danger">*</span>
                                            <input class="form-control" type="number" name="review" type="nullable" placeholder="Enter Review" value="{{ old('review') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('review') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="field">Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="description" type="text" placeholder="Enter Description"  required></textarea>
                                            <span class="text-danger"><b>{{  $errors->first('description') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="field">Image</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="image" type="file" placeholder="Enter Image"  required>
                                            <span class="text-danger"><b>{{  $errors->first('image') }}</b></span>
                                        </div> 
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('testimonial.show') }}">Cancel</a></button>
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