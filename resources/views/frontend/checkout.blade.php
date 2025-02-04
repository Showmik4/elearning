@extends('frontend.layouts.main')

@section('title')
{{ 'Checkout' }}
@endsection
@section('frontend_main.content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Checkout</h1>
              <p class="mb-0">Complete your purchase securely.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li class="current">Checkout</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Checkout Section -->
    <section id="checkout" class="checkout section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        {{-- <div class="row gy-4"> --}}
          <form action="{{route('submit_order')}}" method="post" class="php-checkout-form row gy-4">
            @csrf
          <div class="col-lg-6">
            <h3>Billing Details</h3>            
              <div class="row gy-4">
                @auth
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" value="{{auth()->user()->firstName.' '.auth()->user()->lastName}}" placeholder="Full Name" readonly>
                </div>
                <div class="col-md-6">
                  <input type="email" name="email" class="form-control" value="{{auth()->user()->email}}" placeholder="Email Address" readonly>
                </div>
                <div class="col-md-12">
                  <input type="text" name="phone" class="form-control" value="{{auth()->user()->phone}}" placeholder="Phone Number" readonly>
                </div>
                {{-- <div class="col-md-12">
                  <input type="text" name="address" class="form-control" value="{{auth()->user()->address}}" placeholder="Billing Address" readonly>
                </div> --}}
                @endauth
                <div class="col-md-12">
                  <textarea class="form-control" name="note" rows="4" placeholder="Additional Notes (Optional)"></textarea>
                </div>
                <input type="hidden" name="user_id" value="{{auth()->user()->userId}}">
                <input type="hidden" name="course_id" value="{{$course->id}}">
                <input type="hidden" name="total_price" value="{{$course->price}}">
              </div>
           
          </div><!-- End Billing Details -->

          <div class="col-lg-6">
            <h3>Order Summary</h3>
            <div class="order-summary">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Course Name
                  <span class="fw-bold">{{$course->title}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Price
                  <span class="fw-bold">${{$course->price}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <strong>Total</strong>
                  <strong>${{$course->price}}</strong>
                </li>
              </ul>
            </div>
            <div class="payment-method mt-4">
              <h3>Payment Method</h3>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" value="Mobile Banking" required>
                <label class="form-check-label">Mobile Banking</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" value="Card" required>
                <label class="form-check-label">Credit/Debit Card</label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-4">Proceed to Payment</button>
          </div><!-- End Order Summary -->
        </form>
      </div>
    </section><!-- /Checkout Section -->

</main>

@endsection
