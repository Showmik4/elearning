@extends('frontend.layouts.main')

@section('title')
{{ 'Course' }}
@endsection

@section('frontend_main.content')
<main class="main">
    <!-- Page Tie -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Courses</h1>
              <p class="mb-0">{!!@$setting->course_page_banner_text!!}</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li class="current">Courses</li>
          </ol>
        </div>
      </nav>
    </div><!-- End  Title -->
    <!-- Courses Section -->
    <section id="courses" class="courses section">
      <div class="container">
        <div class="row">
          @foreach ($course as $courses)
          <div class="col-lg-4 col-md-6 mb-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="course-item">
              <a href="{{ route('course_details', ['id' => $courses->id]) }}">
              <img src="{{ url($courses->image) }}" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <p class="category">{{$courses->category->name}}</p>
                  <p class="price">${{$courses->price}}</p>
                </div>
                <h3><a href="course-details.html">{{$courses->title}}</a></h3>
                <p class="description">{{$courses->short_details}}</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <img src="{{ url($courses->trainer->image) }}" class="img-fluid" alt="">
                    <a href="" class="trainer-link">{{$courses->trainer->name}}</a>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="bi bi-person user-icon"></i>&nbsp;50
                    &nbsp;&nbsp;
                    <i class="bi bi-heart heart-icon"></i>&nbsp;65
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div> <!-- End Course Item-->
          @endforeach
        </div>
      </div>
    </section><!-- /Courses Section -->
  </main>
@endsection
