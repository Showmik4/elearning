<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @if(\Request::route()->getName() === 'homepage')
    <title>Homepage | Mentor</title>
    @elseif(\Request::route()->getName() === 'login')
    <title>Login | Mentor</title>
    @else
    <title>@yield('title') | Mentor</title>
    @endif
    <meta name="description" content="">
    <meta name="keywords" content="">
  
    <!-- Favicons -->
    @if(isset($setting->logoDark))
    <link href="{{ $setting->logo}}" rel="icon">
    <link href="{{ $setting->logo}}" rel="apple-touch-icon">
    @endif
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
    <!-- Vendor CSS Files -->
    <link href="{{ url('public/frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url('public/frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ url('public/frontend/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{ url('public/frontend/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{ url('public/frontend/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  
    <!-- Main CSS File -->
    <link href="{{ url('public/frontend/assets/css/main.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  
    @yield('frontend_header.css')
  </head>