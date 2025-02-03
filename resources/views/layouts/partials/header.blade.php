<!-- BEGIN: Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @if(isset($setting->logoDark))
  <link rel="icon" href="{{ $setting->logo}}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ $setting->logo }}" type="image/x-icon">
  @else
  <link rel="icon" href="{{ $setting->logo }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ $setting->logo }}" type="image/x-icon">
  @endif
  @if(\Request::route()->getName() === 'index')
  <title>Dashboard | Mentor</title>
  @elseif(\Request::route()->getName() === 'login')
  <title>Login | Mentor</title>
  @else
  <title>@yield('title') | Mentor</title>
  @endif
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/vendors/icofont.css') }}">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/vendors/themify.css') }}">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/vendors/flag-icon.css') }}">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/vendors/feather-icon.css') }}">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/vendors/scrollbar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/vendors/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/vendors/date-picker.css') }}">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/vendors/bootstrap.css') }}">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/style.css') }}">
  <link id="color" rel="stylesheet" href="{{ url('public/assets/css/color-1.css') }}" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/responsive.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/custom.css') }}">
  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/vendors/datatables.css') }}">
  <!-- toastr -->
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/select2/select2.min.css') }}" />

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <style>
    .page-loader {
      width: 100%;
      height: 100vh;
      position: absolute;
      background: #272727;
      z-index: 1000;
    }


    .spinner {
      position: relative;
      top: 35%;
      width: 120px;
      height: 120px;
      padding: 10px;
      margin: 0 auto;
      background-color: #f1bb09;
      background-position: center;
      background-size: 100% 100%;

      border-radius: 100%;
      -webkit-animation: sk-scaleout 1.5s infinite ease-in-out;
      animation: sk-scaleout 1.5s infinite ease-in-out;
    }

    @-webkit-keyframes sk-scaleout {
      0% {
        -webkit-transform: scale(0)
      }

      100% {
        -webkit-transform: scale(1.0);
        opacity: 0;
      }
    }

    @keyframes sk-scaleout {
      0% {
        -webkit-transform: scale(0);
        transform: scale(0);
      }

      100% {
        -webkit-transform: scale(1.0);
        transform: scale(1.0);
        opacity: 0;
      }
    }

    div.dataTables_wrapper div.dataTables_paginate {
    margin-bottom: 20px;
    margin-left: 0px;
    white-space: nowrap;
    text-align: right;
   }
  </style>
  @yield('header.css')
</head>
<!-- END: Head-->