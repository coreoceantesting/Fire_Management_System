<style>
    .modal-backdrop {
  z-index: 1;
}
</style>
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ route('home') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('admin/images/logo.png') }}" alt="" height="22" />
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('admin/images/logo.png') }}" alt="" height="45" />
                        </span>
                    </a>

                    <a href="{{ route('home') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('admin/images/logo.png') }}" alt="" height="22" />
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('admin/images/logo.png') }}" alt="" height="45" />
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="" />
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                        <div data-simplebar style="max-height: 320px">
                            <!-- item-->
                            <div class="dropdown-header">
                                <h6 class="text-overflow text-muted mb-0 text-uppercase">
                                    Recent Searches
                                </h6>
                            </div>

                            <div class="dropdown-item bg-transparent text-wrap">
                                <a href="index.html" class="btn btn-soft-primary btn-sm rounded-pill">how to setup
                                    <i class="mdi mdi-magnify ms-1"></i></a>
                                <a href="index.html" class="btn btn-soft-primary btn-sm rounded-pill">buttons
                                    <i class="mdi mdi-magnify ms-1"></i></a>
                            </div>
                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-1 text-uppercase">
                                    Pages
                                </h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                <span>Analytics Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                <span>Help Center</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                <span>My account settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-2 text-uppercase">
                                    Members
                                </h6>
                            </div>

                            <div class="notification-list">
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="{{ asset('admin/images/users/avatar-2.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic" />
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">
                                                Angela Bernier
                                            </h6>
                                            <span class="fs-11 mb-0 text-muted">Manager</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="{{ asset('admin/images/users/avatar-3.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic" />
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">
                                                David Grasso
                                            </h6>
                                            <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="{{ asset('admin/images/users/avatar-5.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic" />
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">
                                                Mike Bunch
                                            </h6>
                                            <span class="fs-11 mb-0 text-muted">React
                                                Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="text-center pt-3 pb-1">
                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results
                                <i class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">
                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username" />
                                    <button class="btn btn-primary" type="submit">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if ( auth()->user()->name === 'CFO' )
                    <div id="notification-bell" style="cursor: pointer;">
                        <i class="fa fa-bell" style="font-size: 25px;color:gold"></i>
                        <span id="notification-count" style="color:white;font-weight:bold"></span>
                    </div>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                                <button type="button" class="close" id="closeNotification" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul id="notification-list" class="list-group">
                                    <!-- Notifications will be dynamically added here -->
                                </ul>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                <a href="{{ route('slips_list') }}" class="btn btn-warning" data-dismiss="modal">View All</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class="bx bx-fullscreen fs-22"></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none">
                    <button type="button" id="change-theme-button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class="bx bx-moon fs-22"></i>
                    </button>
                </div>


                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{ asset('admin/images/users/user-dummy-img.jpg') }}" alt="Header Avatar" />
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-semibold user-name-text">{{ ucfirst(auth()->user()->name) }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ auth()->user()->roles[0]->name }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">
                            Welcome {{ ucfirst(auth()->user()->name) }}!
                        </h6>
                        {{-- <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Profile</span>
                        </a> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle" data-key="t-logout">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width: 100px; height: 100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">
                            Are you sure you want to remove this
                            Notification ?
                        </p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">
                        Yes, Delete It!
                    </button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


@push('scripts')
    <script>
        $(document).ready(function(){

            $("#change-theme-button").click(function(e){
                e.preventDefault();

                $.ajax({
                    url: "{{ route('change-theme-mode') }}",
                    type: 'GET',
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function(data, textStatus, jqXHR)
                    {
                        console.log("theme color changed");
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        console.log("something whent wrong while changing theme color");
                    },
                });

            });

        });
    </script>

    <script>
        function fetchNotificationCount() {
            $.ajax({
                url: '/notifications/count',
                method: 'GET',
                success: function(data) {
                    $('#notification-count').text(data.count);
                }
            });
        }
        
        $(document).ready(function() {
            fetchNotificationCount();
            setInterval(fetchNotificationCount, 60000); // Update every minute
        });
    </script>

    <script>
        function fetchNotifications() {
            $.ajax({
                url: '/notifications',
                method: 'GET',
                success: function(data) {
                    var notificationList = $('#notification-list');
                    notificationList.empty();
                    data.notifications.forEach(function(notification) {
                        var listItem = $('<li class="list-group-item" style="cursor:pointer"></li>');
                        listItem.attr('data-notification-id', notification.notification_id); // Assuming notification has an 'id' field
                        listItem.html(
                            '<strong>' + notification.caller_name + '</strong><br>' +
                            '<small>' + notification.slip_date + '</small>'
                        );

                        notificationList.append(listItem);
                        // Click event handler for each notification
                        listItem.on('click', function() {
                            var notificationId = $(this).data('notification-id');
                            markNotificationAsRead(notificationId);
                        });

                    });
                    $('#notificationModal').modal('show');
                }
            });
        }

        function markNotificationAsRead(notificationId) {
            $.ajax({
                url: '/notifications/' + notificationId + '/mark-as-read',
                method: 'POST', // Assuming you use POST for updating
                data: {
                    _token: '{{ csrf_token() }}' // Laravel CSRF protection
                },
                success: function(response) {
                    // Handle success if needed
                    console.log('Notification marked as read:', notificationId);
                    fetchNotifications();
                    fetchNotificationCount();
                    // Optionally, close the modal or update UI
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error('Error marking notification as read:', error);
                }
            });
        }
        
        $('#notification-bell').on('click', function() {
            fetchNotifications();
        });
    </script>
    <script>
        $('#closeNotification').on('click', function() {
            $('#notificationModal').modal('hide');
        });
    </script>
@endpush
