<!doctype html>
<html lang="en">
@include('layouts.partials.header')
<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="login-card login-dark">
            <div class="row">
                <div class="col-12 col-md-10 col-xl-8 p-0 mx-auto">
                    <div class="card ">
                        <div class="card-body">
                            <div class="text-center">
                                <a class="logo w-50 mx-auto" href="#">
                                    <img class="img-fluid for-light" src="{{ url(@$setting->logo) }}" style="width: 300px" alt="looginpage">
                                    <img class="img-fluid for-dark" src="{{ url(@$setting->logoDark) }}" alt="looginpage">
                                </a>
                            </div>

                            <form class="theme-form" action="{{ route('register') }}" method="POST">
                                @csrf
                                <h4 class="text-center">Sign Up to create your account</h4>
                                <p class="text-center">Enter your information to register</p>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">First Name<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="firstName" placeholder="First Name" value="{{ old('firstName') }}">                                        
                                        <span class="text-danger mb-2"><b>{{ $errors->first('firstName') }}</b></span>                                       
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Last Name<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="lastName" placeholder="Last Name" value="{{ old('lastName') }}">
                                        <span class="text-danger mb-2"><b>{{ $errors->first('lastName') }}</b></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Phone Number<span class="text-danger">*</span></label>
                                        <input class="form-control" type="tel" name="phone" placeholder="Enter phone" value="{{ old('phone') }}">
                                        <span class="text-danger mb-2"><b>{{ $errors->first('phone') }}</b></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Email<span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                                        <span class="text-danger mb-2"><b>{{ $errors->first('email') }}</b></span>
                                    </div>
                              
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Password<span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" name="password" placeholder="Enter Password" value="{{ old('password') }}">
                                        <span class="text-danger mb-2"><b>{{ $errors->first('password') }}</b></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="Enter Confirm Password" value="{{ old('password_confirmation') }}">
                                        <span class="text-danger mb-2"><b>{{ $errors->first('password_confirmation') }}</b></span>
                                    </div>                                
                                    
                                    <div class="col-md-6 mx-auto">
                                    <div class="text-end mt-3">
                                            <button class="btn btn-primary btn-block w-100" type="submit">Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                            
                                <p class="mt-4 mb-0 text-center">Back to login ?<a class="ms-2" href="{{route('login')}}">Login</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.scripts')
</body>
</html>