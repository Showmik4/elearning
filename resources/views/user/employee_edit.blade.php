@extends('layouts.main')
@section('title'){{ 'Employee Edit' }}@endsection
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
                    <h3>Employee Edit</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('index') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Employee</li>
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
                        <form class="form-wizard" action="{{ route('user.updateEmployee', $user->userId) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row ">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="categoryName">First Name</label>
                                        <input class="form-control" id="firstName" name="firstName" type="text"
                                            placeholder="first Name" value="{{ @$user->firstName }}" required>
                                        <span class="text-danger"> <b>{{ $errors->first('firstName') }}</b></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="lastName">Last Name</label>
                                        <input class="form-control" id="lastName" name="lastName" type="text"
                                            placeholder="first Name" value="{{ @$user->lastName }}" required>
                                        <span class="text-danger"> <b>{{ $errors->first('lastName') }}</b></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" id="phone" name="phone" type="text"
                                            placeholder="phone" value="{{ @$user->phone }}">
                                        <span class="text-danger"> <b>{{ $errors->first('phone') }}</b></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="text"
                                            placeholder="email" value="{{ @$user->email}}" required>
                                        <span class="text-danger"> <b>{{ $errors->first('email') }}</b></span>
                                    </div>


                                    <div class="mb-3">
                                        <label for="user type">Role</label>
                                        <select class="form-control" name="fkUserTypeId" id="fkUserTypeId">
                                            <option value="">Select Role</option>
                                            @foreach($userType as $utype)
                                            <option value="{{ $utype->userTypeId }}" @if(@$user->fkUserTypeId ===
                                                $utype->userTypeId) selected @endif>{{ $utype->typeName }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger"> <b>{{ $errors->first('fkUserTypeId') }}</b></span>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="user type">Team</label>
                                        <select class="form-control" name="fk_team_id" id="fk_team_id">
                                            <option value="">Select Team</option>
                                            @foreach($team as $teams)
                                            <option value="{{ $teams->id }}" @if(@$user->fk_team_id === $teams->id) selected @endif>{{ $teams->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger"> <b>{{ $errors->first('fk_team_id') }}</b></span>
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="user status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="">Select Employee Status</option>
                                            <option value="active" @if (@$user->status == 'active')  selected @endif>Active</option>
                                            <option value="inactive" @if (@$user->status == 'inactive')  selected @endif>Inactive</option>                                            
                                        </select>
                                        <span class="text-danger"> <b>{{ $errors->first('status') }}</b></span>
                                    </div>
                                    <div class="text-end btn-mb">
                                        <button class="btn btn-secondary" type="button"><a class="text-white"
                                                href="{{ route('user.view-employee') }}">Cancel</a></button>
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