@php
    $user = Auth::user();
    $isSuperAdmin = $user->level === 'SUPERADMIN';
@endphp

<!-- Sidebar Start -->
<aside class="left-sidebar" style="background-color: #fbfbfb">
    <!-- Sidebar scroll-->
    <div class="p-3">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('assets/images/logos/logo.png') }}" height="60" class="me-2 mt-2 ps-2" alt="">
            <div class="fw-bolder fs-6">Dian Didaktika</div>
        </a>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">

                <!-- String HOME -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <!-- Dashboard -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('superadmin.dashboard') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- String Daily Use -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Daily Use</span>
                </li>

                <!-- Menu Dashboard -->

                <!-- Manage User School (Hanya untuk SUPERADMIN) -->
                @if ($isSuperAdmin)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('superadmin.manage-userschools') }}"
                            aria-expanded="false">
                            <span>
                                <iconify-icon icon="solar:users-group-rounded-bold-duotone"
                                    class="fs-6"></iconify-icon>
                            </span>
                            <span class="hide-menu">Manage</span>
                        </a>
                    </li>
                @endif


                <!-- Schools -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('superadmin.schools.index') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Schools</span>
                    </a>
                </li>

                <!-- Users -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('superadmin.users.index') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>

                <!-- Menu Content -->
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6"
                        class="fs-6"></iconify-icon>
                    <span class="hide-menu">Content</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('superadmin.photos.index') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:login-3-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Photos</span>
                    </a>
                </li>

                <li class="sidebar-item mb-5">
                    <a class="sidebar-link" href="{{ route('superadmin.videos.index') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Videos</span>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
