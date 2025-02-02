@extends('layouts.main')
@section('title'){{ 'About Edit' }}@endsection
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
                        <h3>About Edit</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">About</li>
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
                            <form class="form-wizard" action="{{ route('about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="name">Banner Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="banner_description" type="text" placeholder="Enter Banner Description" >{{$about->banner_description}}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('banner_description') }}</b></span>
                                        </div>  

                                        <div class="mb-3">
                                            <label for="name">About Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="about_description" type="text" placeholder="Enter About Description" >{{$about->about_description}}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('about_description') }}</b></span>
                                        </div>  
                                      
                                        <div class="mb-3">
                                            <label for="field">Image</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="image" type="file" placeholder="Enter Image">
                                            <span class="text-danger"><b>{{  $errors->first('image') }}</b></span>
                                        </div> 
                                        @if(isset($about->image))
                                        <div class="mb-3">
                                            <img height="100px" width="100px" src="{{ url(@$about->image) }}" alt="">
                                        </div>
                                        @endif
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('about.show') }}">Cancel</a></button>
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
    CKEDITOR.replace( 'about_description');  
    CKEDITOR.replace( 'banner_description');  
});
</script>
@endsection

