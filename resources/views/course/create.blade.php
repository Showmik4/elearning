@extends('layouts.main')
@section('title'){{ 'Course Create' }}@endsection
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
                        <h3>Course Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Course</li>
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
                            <form class="form-wizard" action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="name">Title</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="title" type="text" placeholder="Enter Title" value="{{ old('title') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('title') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="name">Price</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="price" type="text" placeholder="Enter Price">
                                            <span class="text-danger"><b>{{  $errors->first('price') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="field">Short Details</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="short_details" type="text" placeholder="Enter Short Details"  required></textarea>
                                            <span class="text-danger"><b>{{  $errors->first('short_details') }}</b></span>
                                        </div>  
                                        <div class="mb-3">
                                            <label for="field">Long Details</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="long_details" type="text" placeholder="Enter Long Details"  required></textarea>
                                            <span class="text-danger"><b>{{  $errors->first('long_details') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="field">Category</label><span class="text-danger">*</span>
                                            <select class="form-control" name="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($category as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach                                                
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('category_id') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="field">Trainer</label><span class="text-danger">*</span>
                                            <select class="form-control" name="trainer_id">
                                                <option value="">Select Trainer</option>
                                                @foreach ($trainer as $trainers)
                                                <option value="{{$trainers->id}}">{{$trainers->name}}</option>
                                                @endforeach                                                
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('trainer_id') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="name">Total Seat</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="total_seat" type="number" placeholder="Enter Total Seat" value="{{ old('total_seat') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('total_seat') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="name">Schedule</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="schedule" type="text" placeholder="Enter Schedule" value="{{ old('schedule') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('schedule') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="field">Detail Page Banner Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="details_page_banner_description" name="details_page_banner_description" type="text" placeholder="Enter Detail Page Banner Description"  required></textarea>
                                            <span class="text-danger"><b>{{  $errors->first('details_page_banner_description') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="field">Image</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="image" type="file" placeholder="Enter Image"  required>
                                            <span class="text-danger"><b>{{  $errors->first('image') }}</b></span>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="field">Detail Page Image</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="detail_page_image" type="file" placeholder="Enter Detail Page Image"  required>
                                            <span class="text-danger"><b>{{  $errors->first('detail_page_image') }}</b></span>
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
<script>
    $(document).ready( function () {
        CKEDITOR.replace( 'details_page_banner_description');  
        CKEDITOR.replace( 'long_details');                
    });
</script>
@endsection