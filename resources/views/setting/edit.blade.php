@extends('layouts.main')
@section('title'){{ 'Setting Edit' }}@endsection
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
                        <h3>Setting Edit</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Setting</li>
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
                            <form class="form-wizard" action="{{ route('setting.update', $setting->settingId) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="companyName">Company Name</label>
                                            <input class="form-control" id="companyName" name="companyName" type="text" placeholder="Company Name" value="{{ @$setting->companyName }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('companyName') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Company Email</label>
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Company Email" value="{{ @$setting->email }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('email') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="logo">Company Logo-1</label>
                                            <input class="form-control" id="logo" name="logo" type="file">
                                            <span class="text-danger"><b>{{ $errors->first('logo') }}</b></span>
                                        </div>
                                        @if(isset($setting->logo))
                                        <div class="mb-3">
                                            <img height="100px" width="100px" src="{{ url(@$setting->logo) }}" alt="">
                                        </div>
                                        @endif
                                        <div class="mb-3">
                                            <label for="logoDark">Company Logo-2</label>
                                            <input class="form-control" id="logoDark" name="logoDark" type="file">
                                            <span class="text-danger"><b>{{ $errors->first('logoDark') }}</b></span>
                                        </div>
                                        @if(isset($setting->logoDark))
                                            <div class="mb-3">
                                                <img height="100px" width="100px" src="{{ url(@$setting->logoDark) }}" alt="">
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <label for="address">Company Address</label>
                                            <input class="form-control" id="address" name="address" type="text" placeholder="Company Address" value="{{ @$setting->address }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('address') }}</b></span>
                                        </div>                                       
                                        <div class="mb-3">
                                            <label for="phone">Company Phone</label>
                                            <input class="form-control" id="phone" name="phone" type="text" placeholder="Company Phone" value="{{ @$setting->phone }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('phone') }}</b></span>
                                        </div>    
                                        
                                        <div class="mb-3">
                                            <label for="phone">Twitter Link</label>
                                            <input class="form-control" id="phone" name="twitter_link" type="text" placeholder="Twitter Link" value="{{ @$setting->twitter_link }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('twitter_link') }}</b></span>
                                        </div>  

                                        <div class="mb-3">
                                            <label for="phone">Facebook Link</label>
                                            <input class="form-control" id="phone" name="facebook_link" type="text" placeholder="Facebook Link" value="{{ @$setting->facebook_link }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('facebook_link') }}</b></span>
                                        </div>  

                                        <div class="mb-3">
                                            <label for="phone">Instagram Link</label>
                                            <input class="form-control" id="phone" name="instagram_link" type="text" placeholder="Instagram Link" value="{{ @$setting->instagram_link }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('instagram_link') }}</b></span>
                                        </div>  

                                        <div class="mb-3">
                                            <label for="phone">Linkedin Link</label>
                                            <input class="form-control" id="phone" name="linkedin_link" type="text" placeholder="Linkedin Link" value="{{ @$setting->linkedin_link }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('linkedin_link') }}</b></span>
                                        </div>  

                                        <div class="mb-3">
                                            <label for="phone">Footer Text</label>
                                            <input class="form-control" id="phone" name="footer_text" type="text" placeholder="Footer_text" value="{{ @$setting->footer_text }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('footer_text') }}</b></span>
                                        </div> 
                                        
                                        <div class="mb-3">
                                            <label for="google_map_link">Google Map Link</label>
                                            <input class="form-control" id="google_map_link" name="google_map_link" type="text" placeholder="Google Map Link" value="{{ @$setting->google_map_link }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('google_map_link') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="contact_page_banner_text">Contact Page Banner Text</label>
                                            <textarea class="form-control" id="contact_page_banner_text" name="contact_page_banner_text" type="text" placeholder="Contact Page Banner Text" value="" required>{{@$setting->contact_page_banner_text}}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('contact_page_banner_text') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="address">Trainer Page Banner Text</label>
                                            <textarea class="form-control" id="trainer_page_banner_text" name="trainer_page_banner_text" type="text" placeholder="Trainer Page Banner Text" value="" required>{{@$setting->trainer_page_banner_text}}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('trainer_page_banner_text') }}</b></span>
                                        </div> 

                                        <div class="mb-3">
                                            <label for="address">Course Page Banner Text</label>
                                            <textarea class="form-control" id="course_page_banner_text" name="course_page_banner_text" type="text" placeholder="Course Page Banner Text" value="" required>{{@$setting->course_page_banner_text}}</textarea>
                                            <span class="text-danger"><b>{{  $errors->first('course_page_banner_text') }}</b></span>
                                        </div> 
                                                                         
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('setting.show') }}">Cancel</a></button>
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
    <script>
        $(document).ready( function () {
            // CKEDITOR.replace( 'contactText1');            
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
            CKEDITOR.replace( 'contact_page_banner_text');  
            CKEDITOR.replace( 'trainer_page_banner_text');  
            CKEDITOR.replace( 'course_page_banner_text');         
        });
    </script>
@endsection
