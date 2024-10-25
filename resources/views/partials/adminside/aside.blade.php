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
      <!-- Info Card -->
      <div id="info-card" style="background-color: #5b13ba; color: white; border-radius: 0; padding: 10px; display: flex; flex-direction: column; align-items: center; height: 100%; width: 100%;">
        <img src="{{ asset(Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle" width="50" height="50" style="margin-bottom: 10px;">
        <div style="font-size: 1rem; font-weight: bold;">{{ Auth::user()->name }}</div>
        <span style="font-size: 1rem; color: #ccc;">Papan Pemuka Admin</span> <!-- Moved here -->
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

    <div class="collapse navbar-collapse w-auto nav-section" id="sidenav-collapse-main" style="padding-bottom: 0; margin-bottom: 0;">
      <ul class="navbar-nav" style="padding-bottom: 0; margin-bottom: 0;">

          <!-- Menu Utama -->
          <li class="nav-item" style="margin-bottom: 0;">
              <form action="{{ route('admin') }}" method="GET" id="dashboard-form" style="display:none;"></form>
              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('dashboard-form').submit();">
                  <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                  </div>
                  <span class="nav-link-text ms-1">Utama</span>
              </a>
          </li>

        <!-- Menu Pengurusan -->
        <li class="nav-item" style="margin-bottom: 0;">
            <a class="nav-link" data-bs-toggle="collapse" href="#pengurusanSubmenu" role="button" aria-expanded="false" aria-controls="pengurusanSubmenu">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-copy-04 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Pengurusan</span>
            </a>
            <div class="collapse" id="pengurusanSubmenu">
                <ul class="navbar-nav ms-3">
                    <!-- Pengumuman -->
                    <li class="nav-item" style="margin-bottom: 0;">
                        <form action="{{ route('admin.annoucement') }}" method="GET" id="pengumuman-form" style="display:none;"></form>
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('pengumuman-form').submit();">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-bell-55 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Pengumuman</span>
                        </a>
                    </li>

                    <!-- Nota -->
                    <li class="nav-item" style="margin-bottom: 0;">
                        <form action="{{ route('admin.nota') }}" method="GET" id="nota-form" style="display:none;"></form>
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('nota-form').submit();">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-note-03 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Nota</span>
                        </a>
                    </li>
                </ul>
            </div>

        </li>


          <!-- Senarai Pekerja -->
          <li class="nav-item" style="margin-bottom: 0;">
              <form action="{{ route('admin.stafflist') }}" method="GET" id="stafflist-form" style="display:none;"></form>
              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('stafflist-form').submit();">
                  <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="ni ni-hat-3 text-primary text-sm opacity-10"></i>
                  </div>
                  <span class="nav-link-text ms-1">Senarai Pekerja</span>
              </a>
          </li>

          <!-- Senarai Keseluruhan -->
          <li class="nav-item" style="margin-bottom: 0;">
              <form action="{{ route('admin.mcAllApply') }}" method="GET" id="all-approval-section-form" style="display:none;"></form>
              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('all-approval-section-form').submit();">
                  <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="ni ni-calendar-grid-58 text-primary text-sm opacity-10"></i>
                  </div>
                  <span class="nav-link-text ms-1">Senarai Keseluruhan<br>Permohonan</span>
              </a>
          </li>

          <!-- Permohonan Cuti Tapisan Pegawai -->
          <li class="nav-item" style="margin-bottom: 0;">
              <form action="{{ route('admin.mcOfficerApprove') }}" method="GET" id="officer-applications-section-form" style="display:none;"></form>
              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('officer-applications-section-form').submit();">
                  <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="ni ni-briefcase-24 text-primary text-sm opacity-10"></i>
                  </div>
                  <span class="nav-link-text ms-1">Permohonan Cuti<br>Tapisan Pegawai</span>
              </a>
          </li>

          <!-- Permohonan Cuti Admin -->
          <li class="nav-item" style="margin-bottom: 0;">
              <form action="{{ route('admin.mcAdminApprove') }}" method="GET" id="admin-approval-section-form" style="display:none;"></form>
              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('admin-approval-section-form').submit();">
                  <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="ni ni-check-bold text-primary text-sm opacity-10"></i>
                  </div>
                  <span class="nav-link-text ms-1">Permohonan Cuti<br>oleh Admin</span>
              </a>
          </li>

          <!-- Halaman Akaun -->
          <li class="nav-item mt-3" style="margin-bottom: 0;">
              <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Halaman Akaun</h6>
          </li>

          <!-- Profil Pengguna -->
          <li class="nav-item" style="margin-bottom: 0;">
              <form action="{{ route('admin.profile') }}" method="GET" id="Profile-form" style="display:none;"></form>
              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('Profile-form').submit();">
                  <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                  </div>
                  <span class="nav-link-text ms-1">Profil Pengguna</span>
              </a>
          </li>

          <!-- Tukar Kata Laluan -->
          <li class="nav-item" style="margin-bottom: 0;">
              <form action="{{ route('admin.password') }}" method="GET" id="ChangePassword-form" style="display:none;"></form>
              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('ChangePassword-form').submit();">
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
                    <i class="fa fa-sign-out text-danger text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Log Keluar</span>
            </a>
        </li>
      </ul>
    </div>

  </div>
</aside>
