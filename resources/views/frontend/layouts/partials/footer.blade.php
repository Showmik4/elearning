<footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Mentor</span>
          </a>
          <div class="footer-contact pt-3">
            <p>{{@$setting->address}}</p>
            {{-- <p>New York, NY 535022</p> --}}
            <p class="mt-3"><strong>Phone:</strong> <span>{{@$setting->phone}}</span></p>
            <p><strong>Email:</strong> <span>{{@$setting->email}}</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href="{{@$setting->twitter_link}}"><i class="bi bi-twitter-x"></i></a>
            <a href="{{@$setting->facebook_link}}"><i class="bi bi-facebook"></i></a>
            <a href="{{@$setting->instagram_link}}"><i class="bi bi-instagram"></i></a>
            <a href="{{@$setting->linkedin_link}}"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li><a href="{{route('aboutus')}}">About us</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>         
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="{{route('course')}}">Courses</a></li>
            <li><a href="{{route('trainer')}}">Trainers</a></li>           
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Description</h4>
          <p>{{@$setting->footer_text}}</p>
          {{-- <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form> --}}
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Mentor</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
       
        Developed By <a href="https://bootstrapmade.com/">{{@$setting->companyName}}</a>
      </div>
    </div>
  </footer>