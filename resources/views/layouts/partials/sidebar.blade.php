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
                  
                    @canany(['survey.show','survey.complete_survey'])
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="archive"></i><span>Survey</span></a>
                        <ul class="sidebar-submenu">
                            @can('survey.show')
                            <li><a href="{{ route('survey.show') }}">Survey</a></li>
                            @endcan
                            @can('survey.complete_survey')
                            <li><a href="{{ route('survey.complete_survey') }}">Complete Survey List</a></li>
                            @endcan                          
                        </ul>
                    </li>
                    @endcan

                    @canany(['kpi_type.show','kpi_subtype.show','kpi.show','kpi.all_assigned_kpi'])
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="clipboard"></i><span>KPI</span></a>
                        <ul class="sidebar-submenu">
                            @can('kpi.show')
                            <li><a href="{{ route('kpi.show') }}">KPI List</a></li>
                            @endcan
                            @can('kpi_subtype.show')
                            <li><a href="{{ route('kpi_subtype.show') }}">KPI Subtype</a></li>
                            @endcan
                            @can('kpi_type.show')
                            <li><a href="{{ route('kpi_type.show') }}">KPI Type</a></li>
                            @endcan
                            @can('kpi.all_assigned_kpi')
                            <li><a href="{{ route('kpi.all_assigned_kpi') }}">Assigned KPI List</a></li>
                            @endcan

                        </ul>
                    </li>
                    @endcan

                    @canany(['setting.show','user.view-employee','userType.show'])
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="file-text"></i><span>Settings</span></a>
                        <ul class="sidebar-submenu">
                            @can('setting.show')
                            <li><a href="{{ route('setting.show') }}">Setting</a></li>
                            @endcan
                            @can('team.show')
                            <li><a href="{{ route('team.show') }}">Team</a></li>
                            @endcan
                            @can('user.view-employee')
                            <li><a href="{{ route('user.view-employee') }}">Team Member</a></li>
                            @endcan
                            @can('userType.show')
                            <li><a href="{{ route('userType.show') }}">Role & Permission</a></li>
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