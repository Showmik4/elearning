@extends('layouts.main')
@section('title')
    {{ 'Roles & Permission' }}
@endsection
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
                        <h3>Roles & Permissions</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Roles & Permissions</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card border-top border-0 border-4 border-success">
                        <div class="card-body">
                            <form class="form-wizard" action="{{ route('userType.update', $userType->userTypeId) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="typeName">Role</label>
                                            <input class="form-control" id="typeName" name="typeName" type="text"
                                                placeholder="User Type Name" value="{{ @$userType->typeName }}" required>
                                            <span class="text-danger"> <b>{{ $errors->first('typeName') }}</b></span>
                                        </div>
                                        <div class="text-start btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white"
                                                    href="{{ route('userType.show') }}">Cancel</a></button>
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
        {{-- <div class="container-fluid">  --}}     
        @php
        $prefixes = ['user','setting','userType','trainer','category','course','homepage_settings','testimonial','about','order','course_material'
        ];
        @endphp
        <div class="col-12 mx-auto">
            <div class="card border-top border-0 border-4 border-success">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0 text-primary">Role Permission</h5>
                    </div>
                    <hr />
                    <form action="{{ route('userType.role-update') }}" method="post">
                        @csrf
                        <input type="hidden" name="role_id" value="{{ $userType->userTypeId }}">
                        <div class="row">
                            @foreach ($prefixes as $prefix)
                            <h3>{{ ucfirst($prefix) }} Permissions</h3>
                            @foreach ($permissions->filter(function ($permission) use ($prefix) {
                            return preg_match("/^{$prefix}(\W|$)/", $permission->name);
                            }) as $permission)
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend mx-4">
                                        <div class="input-group-text">
                                            <input id="permission_id_{{ $permission->id }}" type="checkbox"
                                                name="permission_id[]" value="{{ $permission->id }}" <?php if
                                                (in_array($permission->id,
                                            $rolePermission->pluck('permission_id')->toArray())) echo 'checked'; ?>
                                            aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <label for="permission_id_{{ $permission->id }}">{{ str_replace('_', ' ',\Illuminate\Support\Str::title($permission->name)) }}</label>
                                </div>
                            </div>
                            @endforeach
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
