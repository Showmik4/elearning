<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .login-container {
            height: 100vh;
            display: flex;
        }
        .login-left {
            background: #97B5BF26;
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
        }
        .login-left img {
            max-width: 150px;
        }
        .login-left h3 {
            margin-top: 20px;
        }
        .login-right {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8f9fa;
            position: relative;
            overflow: hidden;
        }
        .login-right::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: url("../images/login/login_bg.jpg") no-repeat center center;
            background-size: contain;
            opacity: 0.1; /* Adjust opacity for watermark effect */
            width: 80%;
            height: 80%;
            z-index: 1; /* Ensure it's below the form */
        }

        .login-form {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            z-index: 2; /* Ensures form stays above watermark */
        }
        .login-form h2 {
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-login {
            background-color: #e63946;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-login:hover {
            background-color: #d62828;
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Left Section -->
    <div class="login-left">
        <div class="text-center">
            <img src="https://via.placeholder.com/150" alt="Logo">
            <h3>bKash SIS</h3>
        </div>
    </div>

    <!-- Right Section -->
    <div class="login-right">
        <div class="login-form">
            <h2>Sign In</h2>
            <p class="text-center text-muted">To access the portal</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="test@gmail.com" value="{{ old('email') }}">                                   
                        <span class="text-danger mb-2"><b>{{ $errors->first('email') }}</b></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="*********" value="{{ old('password') }}">
                        <span class="text-danger mb-2"><b>{{ $errors->first('password') }}</b></span>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember" value="true">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <a href="{{route('register')}}" class="text-decoration-none text-muted">Registration</a>
                </div>
                <button type="submit" class="btn btn-login w-100">Login</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
