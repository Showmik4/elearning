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
            CKEDITOR.replace( 'contactText1');            
            CKEDITOR.replace( 'footer_text');
            CKEDITOR.replace( 'aboutTitle');
            CKEDITOR.replace( 'aboutTop');
            CKEDITOR.replace( 'aboutLeftText');
            CKEDITOR.replace( 'aboutRightText');
            CKEDITOR.replace( 'homeCategoryText');
            CKEDITOR.replace( 'homeAboutUsText');
            CKEDITOR.replace( 'newProductText');
            CKEDITOR.replace( 'homeShowroomText');
            CKEDITOR.replace( 'nav_banner_text');   
            CKEDITOR.replace( 'about_page_md_message');
            CKEDITOR.replace( 'about_page_ceo_message');         
        });
    </script>
@endsection
