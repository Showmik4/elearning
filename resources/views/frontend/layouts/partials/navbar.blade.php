<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="{{route('homepage')}}" class="logo d-flex align-items-center me-auto">       
        <h1 class="sitename">Mentor</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{route('homepage')}}" class="{{ request()->routeIs('homepage') ? 'active' : '' }}">Home<br></a></li>
          <li><a href="{{route('aboutus')}}" class="{{ request()->routeIs('aboutus') ? 'active' : '' }}">About</a></li>
          <li><a href="{{route('course')}}" class="{{ request()->routeIs('course') ? 'active' : '' }}">Courses</a></li>
          <li><a href="{{route('trainer')}}" class="{{ request()->routeIs('trainer') ? 'active' : '' }}">Trainers</a></li>
          {{-- <li><a href="events.html">Events</a></li>
          <li><a href="pricing.html">Pricing</a></li> --}}
          {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li> --}}
          <li><a href="{{route('contact')}}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
          @guest
          <li><a href="{{route('login')}}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a></li>
          @endguest
          @auth
          <li><a href="{{route('index')}}" class="{{ request()->routeIs('index') ? 'active' : '' }}">Dashboard</a></li>
          @endauth
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>     
    </div>
  </header>