<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo-sm.png') }}" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo-dark.png') }}" alt="" height="17" />
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo-sm.png') }}" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo-light.png') }}" alt="" height="17" />
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('dashboard') }}" >
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                @can(['masters.allmasters'])
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-layout-3-line"></i>
                        <span data-key="t-layouts">Masters</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('firestations.index') }}" class="nav-link" data-key="t-horizontal">Fire Stations</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('vehicle_details.index') }}" class="nav-link" data-key="t-horizontal">Vehicle Detalis</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('designations.index') }}" class="nav-link" data-key="t-horizontal">Designations</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('driver_details.index') }}" class="nav-link" data-key="t-horizontal">Driver Details</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan


                @canany(['users.view', 'roles.view'])
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-user-settings-line"></i>
                        <span data-key="t-layouts">User Managements</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            @can('users.view')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link" data-key="t-horizontal">Users</a>
                                </li>
                            @endcan
                            @can('roles.view')
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link" data-key="t-horizontal">Roles</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-list-check"></i>
                        <span data-key="t-layouts">Slips</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('slips_list') }}" class="nav-link" data-key="t-horizontal">Total Slip</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('new_generated_slip') }}" class="nav-link" data-key="t-horizontal">New Generated Slip</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-book-line"></i>
                        <span data-key="t-layouts">Occurance Book</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('action_taken_slips_list') }}" class="nav-link" data-key="t-horizontal">Taken Action List</a>
                            </li>

                            {{-- <li class="nav-item">
                                <a href="{{ route('vardi_ahaval_list') }}" class="nav-link" data-key="t-horizontal">Vardi Ahaval</a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                @canany(['actionpermissions.create_vardi_book', 'actionpermissions.download_vardi_ahaval'])
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('vardi_ahaval_list') }}" >
                        <i class="ri-file-chart-line"></i>
                        <span data-key="t-vardiAhaval">Vardi Ahaval</span>
                    </a>
                </li>
                @endcan

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>


<div class="vertical-overlay"></div>
