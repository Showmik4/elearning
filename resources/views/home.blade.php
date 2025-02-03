@extends('layouts.main')
@section('header.css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
@section('main.content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
    <!-- Include Font Awesome -->


    <div class="container-fluid py-4">
        <div class="row">
            <!-- Total Users Card -->
            <div class="col-md-3">
                <div class="card bg-primary text-white shadow-lg rounded-2xl p-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fa-solid fa-users fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Total Trainer</h5>
                            <h3>{{$totalTrainer}}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Card -->
            <div class="col-md-3">
                <div class="card bg-success text-white shadow-lg rounded-2xl p-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fa-solid fa-cart-shopping fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Total Sales</h5>
                            <h3>{{$totalSales}}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Card -->
            <div class="col-md-3">
                <div class="card bg-warning text-white shadow-lg rounded-2xl p-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fa-solid fa-box fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Total Orders</h5>
                            <h3>{{$totalOrders}}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="col-md-3">
                <div class="card bg-danger text-white shadow-lg rounded-2xl p-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fa-solid fa-graduation-cap fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Total Course</h5>
                            <h3>{{$totalCourse}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        
    </div>  
@endsection
@section('footer.js')

@endsection