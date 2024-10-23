@if(Auth::check())
    @if(Auth::user()->role === 'admin')
        <!-- Display admin-specific content -->
    @elseif(Auth::user()->role === 'officer')
        <!-- Display officer-specific content -->
    @elseif(Auth::user()->role === 'staff')
        <!-- Display staff-specific content -->
    @endif
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/Erawhiz.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Erawhiz.png') }}">
    <title>
      Sistem Permohonan Cuti - Pegawai
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  </head>

<body class="g-sidenav-show bg-gray-100">


    <div class="min-height-500 position-absolute w-100" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;"></div>
                @include('partials.staffside.aside')

        <main class="main-content position-relative border-radius-lg">
            <div class="container-fluid py-4">
                    @include('partials.logout')
                    @include('partials.staffside.mcdays')

                    <div class="row mt-4">
                        <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
                            <div class="card">
                                  <div class="card-header pb-1 p-1">

                                      <!-- Dashboard Section -->
                                      <div class="d-flex align-items-center justify-content-between mb-4 p-3" style="background-color: rgba(0, 0, 0, 0);">
                                          <h4 class="mb-0 text-uppercase fw-bold "><b>
                                              <i class="bi bi-speedometer2 me-2"></i> UTAMA </b>
                                          </h4>
                                      </div>

                                      <div class="row mt-4">
                                          <div class="col-lg-12 mb-lg-0 mb-4">

                                          <!-- First Row -->
                                              <div class="container-fluid py-2">
                                                  <div class="row">
                                                      <div class="col-lg-7 d-flex">

                                                          {{-- Card Pengumuman --}}
                                                          <div class="card my-4 flex-fill">
                                                              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                                  <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                                                      <h6 class="text-white text-capitalize ps-3">PENGUMUMAN</h6>
                                                                  </div>
                                                              </div>
                                                              <div class="card-body p-3">

                                                                  <!-- Announcement Carousel -->
                                                                  <div id="announcementCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                                                                      <div class="carousel-inner">
                                                                          @foreach($announcements as $index => $announcement)
                                                                          <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"
                                                                              data-title="{{ $announcement->title }}"
                                                                              data-content="{{ $announcement->content }}"
                                                                              data-start-date="{{ $announcement->start_date }}"
                                                                              data-end-date="{{ $announcement->end_date }}">
                                                                              <div style="width: 100%; height: 0; padding-bottom: 40%; position: relative;">
                                                                                  <img src="{{ asset(Storage::url($announcement->image_path)) }}"
                                                                                      alt="{{ $announcement->title }}"
                                                                                      style="position: absolute; top: 50%; left: 50%; width: 100%; height: auto; transform: translate(-50%, -50%); object-fit: cover;">
                                                                              </div>
                                                                          </div>
                                                                          @endforeach
                                                                      </div>

                                                                      <!-- Title and Content Section -->
                                                                      <div class="text-center mt-3">
                                                                          <h2 id="announcementTitle" style="text-transform: uppercase;">{{ $announcements[0]->title }}</h2>
                                                                          <p id="announcementContent">{{ $announcements[0]->content }}</p>
                                                                          <p id="announcementDates">
                                                                              Tarikh Buka: <strong id="startDate">{{ $announcements[0]->start_date }}</strong><br>
                                                                              Tarikh Tutup: <strong id="endDate">{{ $announcements[0]->end_date }}</strong>
                                                                          </p>
                                                                      </div>
                                                                      <button class="carousel-control-prev" type="button" data-bs-target="#announcementCarousel" data-bs-slide="prev">
                                                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                          <span class="visually-hidden">Previous</span>
                                                                      </button>
                                                                      <button class="carousel-control-next" type="button" data-bs-target="#announcementCarousel" data-bs-slide="next">
                                                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                          <span class="visually-hidden">Next</span>
                                                                      </button>
                                                                  </div>

                                                                  <script>
                                                                      document.addEventListener('DOMContentLoaded', function() {
                                                                          const carouselElement = document.getElementById('announcementCarousel');

                                                                          carouselElement.addEventListener('slide.bs.carousel', function(event) {
                                                                              // Get the new active item
                                                                              const nextItem = event.relatedTarget;

                                                                              // Get data attributes
                                                                              const title = nextItem.getAttribute('data-title');
                                                                              const content = nextItem.getAttribute('data-content');
                                                                              const startDate = nextItem.getAttribute('data-start-date');
                                                                              const endDate = nextItem.getAttribute('data-end-date');

                                                                              // Update the content
                                                                              document.getElementById('announcementTitle').textContent = title;
                                                                              document.getElementById('announcementContent').textContent = content;
                                                                              document.getElementById('startDate').textContent = startDate;
                                                                              document.getElementById('endDate').textContent = endDate;
                                                                          });
                                                                      });
                                                                  </script>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      {{-- Card Senarai Staff Cuti Harian --}}
                                                      <div class="col-lg-5 d-flex">
                                                          <div class="card my-4 flex-fill">

                                                              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                                  <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                                                      <h6 class="text-white text-capitalize ps-3">SENARAI STAFF CUTI HARIAN</h6>
                                                                  </div>
                                                                  <br>
                                                                  <p class="text-md mb-0">
                                                                      <i class="fa fa-bell text-warning"></i>
                                                                      <span class="font-weight-bold ms-2">pada </span>{{ now()->format('d F Y') }}
                                                                  </p>
                                                              </div>

                                                              <div class="card-body pt-4 p-3">
                                                                  <ul class="list-group" id="leaveList">
                                                                      @if($staffOnLeaveToday->isEmpty())
                                                                      <li class="list-group-item">Tiada staff yang cuti hari ini.</li>
                                                                      @else
                                                                      @foreach($staffOnLeaveToday as $leave)
                                                                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                                          <div class="d-flex align-items-center">
                                                                              <!-- Icon button -->
                                                                              <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                                                                  <i class="fas fa-arrow-down"></i>
                                                                              </button>
                                                                              <div class="d-flex flex-column">
                                                                                  <!-- Staff name and leave dates -->
                                                                                  <h6 class="mb-1 text-dark text-md">{{ $leave->user->name }}</h6>
                                                                                  <span class="text-xs">Cuti sehingga {{ \Carbon\Carbon::parse($leave->end_date)->format('d F Y') }}</span>
                                                                              </div>
                                                                          </div>
                                                                          <!-- Display leave balance based on leave type -->
                                                                          <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                                                            Cuti yang diambil :<br>{{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }} hari
                                                                          </div>
                                                                      </li>
                                                                      @endforeach
                                                                      @endif
                                                                  </ul>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>


                                              {{-- Second Row --}}
                                              <div class="container-fluid py-2">
                                                  <div class="row">

                                                      {{-- Card Purata Ketidakhadiran --}}
                                                      <div class="col-lg-7 mb-4 d-flex">
                                                          <div class="card z-index-2 w-100 h-100">
                                                              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                                  <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                                                      <h6 class="text-white text-capitalize ps-3">PURATA KETIDAKHADIRAN</h6>
                                                                  </div>
                                                              </div>
                                                              <br>
                                                              <!-- Year Dropdown -->
                                                              <div class="d-flex justify-content-end pe-3">
                                                                  <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex align-items-center">
                                                                      <div class="d-flex align-items-center mb-3">
                                                                          <label for="year" class="form-label me-2">Select Year:</label>
                                                                          <select name="year" id="year" class="form-select" style="width: 150px;" onchange="this.form.submit()">
                                                                              @foreach ($yearRange as $availableYear)
                                                                                  <option value="{{ $availableYear }}" {{ $year == $availableYear ? 'selected' : '' }}>
                                                                                      {{ $availableYear }}
                                                                                  </option>
                                                                              @endforeach
                                                                          </select>
                                                                      </div>
                                                                  </form>
                                                              </div>
                                                              <div class="card-body p-3">
                                                                  <div class="chart">
                                                                      <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      {{-- Card Nota --}}
                                                      <div class="col-lg-5 mb-4 d-flex">
                                                          <div class="card z-index-2 w-100 h-100">
                                                              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                                  <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                                                      <h6 class="text-white text-capitalize ps-3">NOTA</h6>
                                                                  </div>
                                                              </div>
                                                              <div class="card-body p-3">
                                                                  <div class="accordion" id="notesAccordion">
                                                                      @foreach($notes as $index => $note)
                                                                      <div class="accordion-item" style="border: 1px solid #dee2e6; border-radius: 0.375rem; margin-bottom: 1rem;">
                                                                          <h2 class="accordion-header" id="heading{{ $index }}">
                                                                              <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" style="background-color: #f8f9fa; color: #333; border: none;"
                                                                                      data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                                                                  {{ $index + 1 }}. {{ $note->title }}
                                                                              </button>
                                                                          </h2>
                                                                          <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#notesAccordion" style="color: #333; border: none;">
                                                                              <div class="accordion-body" style="padding: 1rem;">
                                                                                  <p>{{ $note->content }}</p>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      @endforeach
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>

                                                  </div>
                                              </div>

                                          </div>
                                      </div>

                                  </div>
                            </div>
                        </div>
                      </div>
            </div>
        </main> <!-- Closing main-content -->

        <!-- Core JS Files -->
        <script src="./assets/js/core/popper.min.js"></script>
        <script src="./assets/js/core/bootstrap.min.js"></script>
        <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="./assets/js/plugins/chartjs.min.js"></script>

        <!-- Most Important JS Files -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>


</html>
