<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main" style="height: calc(100vh - 60px;); overflow-y: auto;">
    <div class="sidenav-header logo-section">

      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <div style="display: flex; align-items: center;">
                <img src="{{ asset('assets/img/Erawhiz.png') }}" class="navbar-brand-img" alt="main_logo" style="width: 80px; max-height: 80px; object-fit: contain; border-radius: 10px; margin-right: 20px;"> <!-- Increased margin-right -->
                <div style="max-width: 150px; word-wrap: break-word; white-space: normal;">
                    <span style="font-weight: bold; font-size: 1rem;">Sistem Pengurusan Cuti</span>
                </div>
            </div>
        </a>
        <div class="text-center" style="margin-bottom: 1rem; width: 100%;">

            <!-- Papan Pemuka Staf -->
            <div id="info-card" style="background-image: url('https://img.freepik.com/free-vector/gradient-dynamic-purple-lines-background_23-2148995757.jpg?w=360'); color: white; border-radius: 0; padding: 10px; display: flex; flex-direction: column; align-items: center; height: 100%; width: 100%; background-size: cover; background-position: center;">
                <img src="{{ asset(Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle" width="50" height="50" style="margin-bottom: 10px;">
                <div style="font-size: 1rem; font-weight: bold;">{{ Auth::user()->name }}</div>
                <span style="font-size: 1rem; color: #ccc;">Papan Pemuka Staf</span> <!-- Moved here -->
            </div>

        </div>

        <!-- Date and Time Section with added margin -->
        <div id="date-time" class="text-center mt-2" style="margin-bottom: 1rem;">
            <i class="fas fa-calendar-alt"></i>
            <span id="current-date" style="font-size: 0.8rem;"></span> <br>
            <i class="fas fa-clock"></i>
            <span id="current-time" style="font-size: 0.8rem;"></span>
        </div>

        <hr class="horizontal dark mt-0">

        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">

                <!-- Nav item Utama -->
                <li class="nav-item">
                    <form action="{{ route('staff') }}" method="GET" style="display: none;" id="dashboard-form">
                    </form>
                    <a class="nav-link {{ request()->routeIs('staff') ? 'active' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('dashboard-form').submit();">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Utama</span>
                    </a>
                </li>

                <!-- Nav item Permohonan Cuti Sakit -->
                <li class="nav-item">
                    <form action="{{ route('staff.mc_application') }}" method="GET" style="display: none;" id="mcapply-form">
                    </form>
                    <a class="nav-link {{ request()->routeIs('staff.mc_application') ? 'active' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('mcapply-form').submit();">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-briefcase-24 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Permohonan Cuti Sakit</span>
                    </a>
                </li>

                <!-- Nav item Halaman Akaun -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Halaman Akaun</h6>
                </li>

                <!-- Nav itemProfil Pengguna -->
                <li class="nav-item">
                    <form action="{{ route('staff.profile') }}" method="GET" style="display: none;" id="profile-form">
                    </form>
                    <a class="nav-link {{ request()->routeIs('staff.profile') ? 'active' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('profile-form').submit();">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profil Pengguna</span>
                    </a>
                </li>

                <!-- Nav item Tukar Kata Laluan -->
                <li class="nav-item">
                    <form action="{{ route('staff.password') }}" method="GET" style="display: none;" id="password-form">
                    </form>
                    <a class="nav-link {{ request()->routeIs('staff.password') ? 'active' : '' }}" href="#" onclick="event.preventDefault(); document.getElementById('password-form').submit();">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-lock-circle-open text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tukar Kata Laluan</span>
                    </a>
                </li>

                    <!-- Log Keluar -->
                <li class="nav-item" style="margin-bottom: 0;">
                    <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-sign-out-alt text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Log Keluar</span>
                    </a>
                </li>

            </ul>
        </div>

    </div>
</aside>

