@extends('layouts.main')
@section('title'){{ 'Employee Create' }}@endsection
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
                        <h3>Employee Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li> --}}
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Add Employee</li>
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
                            <form class="form-wizard" action="{{ route('user.employee-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="firstName">First Name<span class="text-danger">*</span></label>
                                            <input class="form-control" id="" name="firstName" type="text" placeholder="Enter First Name" value="{{ old('firstName') }}" required>
                                            <span class="text-danger"><b>{{ $errors->first('firstName') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="firstName">Last Name<span class="text-danger">*</span></label>
                                            <input class="form-control" id="" name="lastName" type="text" placeholder="Enter Last Name" value="{{ old('lastName') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('lastName') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone">phone<span class="text-danger">*</span></label>
                                            <input class="form-control" id="" name="phone" type="text" placeholder="Enter Phone No" value="{{ old('phone') }}">
                                            <span class="text-danger"><b>{{  $errors->first('phone') }}</b></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <input class="form-control" id="" name="email" type="email" placeholder="Enter Email" value="{{ old('email') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('email') }}</b></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password">Password<span class="text-danger">*</span></label>
                                            <input class="form-control" id="" name="password" type="password" placeholder="Enter Password" value="{{ old('password') }}" required>
                                            <span class="text-danger"><b>{{  $errors->first('password') }}</b></span>
                                        </div>

                                        <div class="mb-3">
                                            <label >Confirm Password<span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control" >
                                            <span class="text-danger"> <b>{{ $errors->first('password_confirmation') }}</b></span>
                                        </div>

                                        <div class="mb-3">
                                            <label>Role<span class="text-danger">*</span></label>
                                            <select class="form-control" name="fkUserTypeId">
                                                <option value="">Select Role</option>
                                                @foreach ($userType as $item)
                                                <option value="{{$item->userTypeId}}">{{$item->typeName}}</option>
                                                @endforeach                                                
                                            </select>                                            
                                            <span class="text-danger"> <b>{{ $errors->first('fkUserTypeId') }}</b></span>
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label>Team<span class="text-danger">*</span></label>
                                            <select class="form-control" name="fk_team_id">
                                                <option value="">Select Team</option>
                                                @foreach ($team as $teams)
                                                <option value="{{$teams->id}}">{{$teams->name}}</option>
                                                @endforeach                                                
                                            </select>                                            
                                            <span class="text-danger"> <b>{{ $errors->first('fk_team_id') }}</b></span>
                                        </div> --}}

                                        <div class="mb-3">
                                            <label>Status<span class="text-danger">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="">Select Employee Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>                                                                                             
                                            </select>                                            
                                            <span class="text-danger"> <b>{{ $errors->first('status') }}</b></span>
                                        </div>
                                        <div class="text-end btn-mb">                                           
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
