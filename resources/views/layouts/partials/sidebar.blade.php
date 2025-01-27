<!-- Page Sidebar Start-->
<div class="sidebar-wrapper" style="height: 100%;background-color:#ffffff">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('index') }}">
                <img class="img-fluid for-light" src="{{ url(@$setting->logo) }}" style="height:80px" alt="">
                <img class="img-fluid for-dark" src="{{ url(@$setting->logo) }}" style="height:80px" alt="">
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"></i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('index') }}"><img class="img-fluid"
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
                  
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->