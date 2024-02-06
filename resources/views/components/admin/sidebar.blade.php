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
                    <a class="nav-link menu-link" href="#menuone" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-layout-3-line"></i>
                        <span data-key="t-layouts">Masters</span>
                    </a>
                    <div class="collapse menu-dropdown" id="menuone">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('firestations.index') }}" class="nav-link" data-key="t-horizontal">Fire Stations(अग्निशमन केंद्रे)</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('vehicle_details.index') }}" class="nav-link" data-key="t-horizontal">Vehicle Detalis(वाहन तपशील)</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('designations.index') }}" class="nav-link" data-key="t-horizontal">Designations(पदनाम)</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('driver_details.index') }}" class="nav-link" data-key="t-horizontal">Driver Details(ड्रायव्हर तपशील)</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('equipments.index') }}" class="nav-link" data-key="t-horizontal">Equipment(उपकरणे)</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan


                @canany(['users.view', 'roles.view'])
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#menu2" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-user-settings-line"></i>
                        <span data-key="t-layouts">User Master</span>
                    </a>
                    <div class="collapse menu-dropdown" id="menu2">
                        <ul class="nav nav-sm flex-column">
                            @can('users.view')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link" data-key="t-horizontal">Users(वापरकर्ते)</a>
                                </li>
                            @endcan
                            @can('roles.view')
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link" data-key="t-horizontal">Roles(भूमिका)</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#menu3" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-list-check"></i>
                        <span data-key="t-layouts">Slips</span>
                    </a>
                    <div class="collapse menu-dropdown" id="menu3">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('slips_list') }}" class="nav-link" data-key="t-horizontal">New Generate Slip(नवीन निर्माण स्लिप)</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('new_generated_slip') }}" class="nav-link" data-key="t-horizontal">Generated Slip List(निर्माण झालेली स्लिप यादी)</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#menu4" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-book-line"></i>
                        <span data-key="t-layouts">Occurance Book</span>
                    </a>
                    <div class="collapse menu-dropdown" id="menu4">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('action_taken_slips_list') }}" class="nav-link" data-key="t-horizontal">Taken Action List(केलेल्या कारवाईची यादी)</a>
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

                <li class="nav-item">
                    
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#menu5" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-file-excel-2-line"></i>
                        <span data-key="t-layouts">Reports</span>
                    </a>
                    <div class="collapse menu-dropdown" id="menu5">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('todays_list') }}" class="nav-link" data-key="t-horizontal">Today's Slips (आजच्या स्लिप्स)</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('monthly_list') }}" class="nav-link" data-key="t-horizontal">Montly Slips (मासिक स्लिप्स)</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('yearly_list') }}" class="nav-link" data-key="t-horizontal">Yearly Slips (वार्षिक स्लिप्स)</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('action_taken_list') }}" class="nav-link" data-key="t-horizontal">Action Taken Slips(कारवाई केलेल्या स्लिप्स)</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('vardi_ahaval_list') }}" class="nav-link" data-key="t-horizontal">Vardi Ahaval(वर्दी अहवाल)</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#menu6" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-stock-fill"></i>
                        <span data-key="t-layouts">Equipment Management </span>
                    </a>
                    <div class="collapse menu-dropdown" id="menu6">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('add_stock') }}" class="nav-link" data-key="t-horizontal">Add In Stock (स्टॉक जोडा)</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('supply_stock') }}" class="nav-link" data-key="t-horizontal">Supply Equipment (उपकरणे पुरवठा)</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('expire_stock') }}" class="nav-link" data-key="t-horizontal">Expire Equipment (कालबाह्य उपकरणे)</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('overall_stock_detail') }}" class="nav-link" data-key="t-horizontal">Overall Stock Details (एकूण स्टॉक तपशील)</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>


<div class="vertical-overlay"></div>
