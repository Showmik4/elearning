<!-- Page Sidebar Start-->
<div class="sidebar-wrapper" style="height: 100%;background-color:#ffffff">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('homepage') }}">
                <img class="img-fluid for-light" src="{{ url(@$setting->logo) }}" style="height:80px" alt="">
                <img class="img-fluid for-dark" src="{{ url(@$setting->logo) }}" style="height:80px" alt="">
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"></i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('homepage') }}"><img class="img-fluid"
                    src="{{url($setting->logo ?? $setting->logo)}}" style="height: 50px" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="{{ route('index') }}"><img class="img-fluid"
                                src="{{url($setting->logo ?? $setting->logo)}}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="">Welcome!</h6>
                            <p class="">Greetings from {{ @$setting->companyName }}</p>
                        </div>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav active"
                        href="{{ route('index') }}"><i data-feather="home"> </i><span>Dashboard</span></a>
                    </li>    
                    
                    @can('order.show')
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav active"
                        href="{{ route('order.show') }}"><i data-feather="home"> </i><span>Orders</span></a>
                    </li> 
                    @endcan

                    @can('course.show')
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav active"
                        href="{{ route('course.show') }}"><i data-feather="home"> </i><span>Course</span></a>
                    </li> 
                    @endcan

                    @can('category.show')
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav active"
                        href="{{ route('category.show') }}"><i data-feather="home"> </i><span>Category</span></a>
                    </li> 
                    @endcan  
                 
                    @canany(['setting.show','user.view-employee','userType.show'])
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="file-text"></i><span>Settings</span></a>
                        <ul class="sidebar-submenu">
                            @can('setting.show')
                            <li><a href="{{ route('setting.show') }}">Setting</a></li>
                            @endcan                          
                            @can('user.view-employee')
                            <li><a href="{{ route('user.view-employee') }}">User</a></li>
                            @endcan
                            @can('userType.show')
                            <li><a href="{{ route('userType.show') }}">Role & Permission</a></li>
                            @endcan

                            @can('trainer.show')
                            <li><a href="{{ route('trainer.show') }}">Trainer</a></li>
                            @endcan                                                    

                            @can('homepage_settings.show')
                            <li><a href="{{ route('homepage_settings.show') }}">Homepage Settings</a></li>
                            @endcan

                            @can('testimonial.show')
                            <li><a href="{{ route('testimonial.show') }}">Testimonial</a></li>
                            @endcan

                            @can('about.show')
                            <li><a href="{{ route('about.show') }}">About</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->