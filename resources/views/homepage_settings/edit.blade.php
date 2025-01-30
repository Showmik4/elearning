@extends('layouts.main')
@section('title'){{ 'Homepage Settings' }}@endsection
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
                        <h3>Homepage Settings</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Homepage Settings</li>
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
                            <form class="form-wizard" action="{{ route('homepage_settings.update', $home_setting->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="field">Banner Short Text</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="banner_short_text" type="text" placeholder="Enter Banner Short Text">{{$home_setting->banner_short_text}}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('banner_short_text') }}</b></span>
                                        </div>  
                                        <div class="mb-3">
                                            <label for="field">Banner Large Text</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="banner_large_text" type="text" placeholder="Enter Large Text">{{$home_setting->banner_large_text}}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('banner_large_text') }}</b></span>
                                        </div> 
 
                                        <div class="mb-3">
                                            <label for="field">Banner Image</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="banner_image" type="file" placeholder="Enter Banner Image">
                                            <span class="text-danger"><b>{{  $errors->first('banner_image') }}</b></span>
                                        </div> 
                                        @if(isset($home_setting->banner_image))
                                        <div class="mb-3">
                                            <img height="100px" width="100px" src="{{ url(@$home_setting->banner_image) }}" alt="">
                                        </div>
                                        @endif

                                        <div class="mb-3">
                                            <label for="field">About Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="about_description" type="text" placeholder="Enter About Description">{{$home_setting->about_description}}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('about_description') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="field">About Image</label><span class="text-danger">*</span>
                                            <input class="form-control" id="" name="about_image" type="file" placeholder="Enter About Image">
                                            <span class="text-danger"><b>{{  $errors->first('about_image') }}</b></span>
                                        </div> 
                                        @if(isset($home_setting->about_image))
                                        <div class="mb-3">
                                            <img height="100px" width="100px" src="{{ url(@$home_setting->about_image) }}" alt="">
                                        </div>
                                        @endif                                    
                                       
                                        <div class="mb-3">
                                            <label for="field">Why Choose Us Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="why_chose_us_description" type="text" placeholder="Enter Detail Page Banner Description"  required>{{ $home_setting->why_chose_us_description }}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('why_chose_us_description') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="field">Feature-1</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="feature_1" type="text" placeholder="Enter Feature-1"  required>{{ $home_setting->feature_1 }}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('feature_1') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="field">Feature-2</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="feature_2" type="text" placeholder="Enter Feature-2"  required>{{ $home_setting->feature_2 }}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('feature_2') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="field">Feature-3</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="" name="feature_3" type="text" placeholder="Enter Feature-3"  required>{{ $home_setting->feature_3 }}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('feature_3') }}</b></span>
                                        </div> 

                                      
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('homepage_settings.show') }}">Cancel</a></button>
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
    CKEDITOR.replace( 'why_chose_us_description');   
    CKEDITOR.replace( 'feature_1'); 
    CKEDITOR.replace( 'feature_2'); 
    CKEDITOR.replace( 'feature_3'); 
    // CKEDITOR.replace( 'footer_text');
    // CKEDITOR.replace( 'aboutTitle');
    // CKEDITOR.replace( 'aboutTop');
    // CKEDITOR.replace( 'aboutLeftText');
    // CKEDITOR.replace( 'aboutRightText');
    // CKEDITOR.replace( 'homeCategoryText');
    // CKEDITOR.replace( 'homeAboutUsText');
    // CKEDITOR.replace( 'newProductText');
    // CKEDITOR.replace( 'homeShowroomText');
    // CKEDITOR.replace( 'nav_banner_text');   
    // CKEDITOR.replace( 'about_page_md_message');
    // CKEDITOR.replace( 'about_page_ceo_message');         
});
</script>


@endsection