@extends('frontend.layouts.main')

@section('title')
{{ 'Trainer' }}
@endsection

@section('frontend_main.content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Trainers</h1>
              <p class="mb-0">{!!@$setting->trainer_page_banner_text!!}</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Trainers</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Trainers Section -->
    <section id="trainers" class="section trainers">

      <div class="container">

        <div class="row gy-5">
           @foreach ($trainer as $trainers)
           <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
              <img src="{{ url($trainers->image) }}" class="img-fluid" alt="">
              {{-- <div class="social">
                <a href="#"><i class="bi bi-twitter-x"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
              </div> --}}
            </div>
            <div class="member-info text-center">
              <h4>{{$trainers->name}}</h4>
              <span>{{$trainers->job}}</span>
              <p>{{$trainers->description}}</p>
            </div>
          </div><!-- End Team Member -->
           @endforeach
        </div>
      </div>
    </section><!-- /Trainers Section -->
  </main>
@endsection
