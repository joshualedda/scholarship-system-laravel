
    @if (Auth::user()->role === 1)
        <style>
            #header {
                background-color: lightcoral;
            }
        </style>
    @elseif (Auth::user()->role === 0)
        <style>
            #header {
                background-color: rgb(189, 189, 92);
            }
        </style>
    @elseif (Auth::user()->role === 2)
        <style>
            #header {
                background-color: rgb(68, 177, 68);
            }
        </style>
    @endif

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <div class="logo d-flex align-items-center">
            <img src="{{ asset('assets/images/updated.png') }}" alt="">
            <span>DMMMSU</span>
        </div>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            @can('admin-access')
                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                    </a>


                    <!-- End Notification Dropdown Items -->
                    <livewire:notifications-dropdown>
                    <!-- End Notification Nav -->
                    

                </li>
            @endcan

            <li class="nav-item pe-3">
                <div class="nav-profile align-items-center p-2">
                    <h6 class="profile-name">{{ auth()->user()->name }}</h6>
                    <span class="profile-role">{{ auth()->user()->getRoleText() }}</span>
                </div>
                <!-- End Profile Iamge Icon -->
            </li>
            <!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
