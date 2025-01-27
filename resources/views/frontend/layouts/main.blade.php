<!DOCTYPE html>
<html lang="en">
@include('frontend.layouts.partials.header')

<body class="index-page">

    @include('frontend.layouts.partials.navbar')
    
    @yield('frontend_main.content')  
 
  @include('frontend.layouts.partials.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  @include('frontend.layouts.partials.script')

</body>

</html>