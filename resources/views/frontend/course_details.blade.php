@extends('frontend.layouts.main')

@section('title')
{{ 'Course Details' }}
@endsection

@section('frontend_main.content')

<main class="main">
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Course Details</h1>
              <p class="mb-0">{!!@$course->details_page_banner_description!!}</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li class="current">Course Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Courses Course Details Section -->
    <section id="courses-course-details" class="courses-course-details section">

      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8">
            <img src="{{ url($course->detail_page_image) }}" class="img-fluid" alt="">          
            
            <p>
              {!!@$course->long_details!!}
            </p>
          </div>
          <div class="col-lg-4">

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Trainer</h5>
              <p><a href="#">{{$course->trainer->name}}</a></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Course Fee</h5>
              <p>${{$course->price}}</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Available Seats</h5>
              <p>{{$course->total_seat}}</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Schedule</h5>
              <p>{{$course->schedule}}</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Enroll Now</h5>
              <a href="{{ auth()->check() ? route('checkout', ['id' => $course->id]) : route('login') }}" class="btn btn-primary">Enroll Now</a>
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
