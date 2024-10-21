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
        <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/Erawhiz.png">
        <link rel="icon" type="image/png" href="./assets/img/Erawhiz.png">
        <title>
            Sistem Permohonan Cuti - Admin
        </title>

        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    </head>

    <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-500 bg-primary position-absolute w-100" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;"></div>
        @include('partials.adminside.aside')

        <main class="main-content position-relative border-radius-lg">
          <div class="container-fluid py-4">
            @include('partials.logout')
            @include ('partials.adminside.mcdata')

            <div class="row mt-4">
              <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
                  <div class="card">
                      <div class="card-header pb-1 p-1">

                          <!-- Dashboard Section -->
                          <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                              <h4><b>DASHBOARD</b></h4> <!-- Fixed closing tag -->
                          </nav>
                          <div class="row mt-4">
                              <div class="col-lg-12 mb-lg-0 mb-4">

                                  {{-- First Row --}}
                                  <div class="container-fluid py-2">
                                      <div class="row">

                                          {{-- Card Pengumuman --}}
                                          <div class="col-lg-8 mb-lg-0 mb-4">
                                              <div class="card z-index-2 h-100">
                                                  <div class="card-header pb-0 pt-3 bg-transparent">
                                                      <h4 class="text-capitalize">PENGUMUMAN</h4>
                                                      <p class="text-sm mb-0">
                                                          <span class="font-weight-bold">Latest update on (timestamp)</span>
                                                      </p>
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
                                                                  Tarikh Buka:  <strong id="startDate">{{ $announcements[0]->start_date }}</strong><br>
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
                                                <div class="col-lg-4 mb-lg-0 mb-4">
                                                    <div class="card z-index-2 h-100">
                                                        <div class="card-header pb-0 pt-3 bg-transparent">
                                                            <h4 class="text-capitalize">SENARAI STAFF CUTI HARIAN</h4>
                                                            <p class="text-sm mb-0">
                                                                <i class="fa fa-arrow-up text-success"></i>
                                                                <span class="font-weight-bold">pada </span>{{ now()->format('d F Y') }}
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
                                                                                @if($leave->leave_type == 'mc')
                                                                                    Baki cuti Sakit: {{ $leave->total_mc_days }}
                                                                                @elseif($leave->leave_type == 'annual')
                                                                                    Baki cuti Tahunan: {{ $leave->total_annual }}
                                                                                @else
                                                                                    Baki cuti Lain-lain: {{ $leave->total_others }}
                                                                                @endif
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
                                      <div class="row ">

                                          {{-- Card Purata Ketidakhadiran --}}
                                          <div class="col-lg-7 mb-lg-0 mb-4">
                                              <div class="card z-index-2 h-100">
                                                  <div class="card-header pb-0 pt-3 bg-transparent">
                                                      <h5 class="text-capitalize">PURATA KETIDAKHADIRAN</h5>
                                                      <p class="text-sm mb-0">
                                                          <i class="fa fa-arrow-up text-success"></i>
                                                          <span class="font-weight-bold">4% more</span> in 2021
                                                      </p>
                                                  </div>
                                                  <div class="card-body p-3">
                                                      <div class="chart">
                                                          <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                          {{-- Card Nota --}}
                                          <div class="col-lg-5 mb-lg-0 mb-4">
                                            <div class="card z-index-2 h-100">
                                                <div class="card-header pb-0 pt-3 bg-transparent">
                                                    <h4 class="text-capitalize">NOTA</h4>
                                                </div>

                                                <div class="card-body p-3">

                                                    <div class="accordion" id="accordionExample">
                                                        <div class="accordion-item" style="border: 1px solid #dee2e6; border-radius: 0.375rem; margin-bottom: 1rem;">
                                                            <h2 class="accordion-header" id="headingOne">
                                                                <button class="accordion-button" type="button" style="background-color: #f8f9fa; color: #333; border: none;"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    1. Cuti Tahunan
                                                                </button>
                                                            </h2>
                                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="color: #333; border: none;">
                                                                <div class="accordion-body" style="padding: 1rem;">
                                                                    <ul>
                                                                        <li><p>Pekerja berhak mendapat sejumlah hari cuti tahunan berbayar sebagai tambahan kepada hari rehat dan cuti berbayar.</p></li>
                                                                        <li><p>Kelayakan mengikut Seksyen 60E(1) Akta Pekerjaan 1955:</p>
                                                                            <ul>
                                                                                <li><p>Kurang dari 2 tahun: Tidak kurang dari 8 hari/tahun</p></li>
                                                                                <li><p>2-5 tahun: Tidak kurang dari 12 hari/tahun</p></li>
                                                                                <li><p>Lebih dari 5 tahun: Tidak kurang dari 16 hari/tahun</p></li>
                                                                            </ul>
                                                                        </li>
                                                                        <li><p>Perlu bekerja sekurang-kurangnya 12 bulan untuk layak mendapat cuti tahunan. Jika meninggalkan syarikat sebelum 12 bulan, hari cuti akan dikira secara prorata (0.66 hari/bulan).</p></li>
                                                                        <li><p>Ketidakhadiran tanpa kebenaran selama lebih dari 10% tahun kerja mengakibatkan kehilangan kelayakan.</p></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item" style="border: 1px solid #dee2e6; border-radius: 0.375rem; margin-bottom: 1rem;">
                                                            <h2 class="accordion-header" id="headingTwo">
                                                                <button class="accordion-button collapsed" type="button" style="background-color: #f8f9fa; color: #333; border: none;"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    2. Cuti Sakit
                                                                </button>
                                                            </h2>
                                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="color: #333; border: none;">
                                                                <div class="accordion-body" style="padding: 1rem;">
                                                                    <ul>
                                                                        <li><p>Kelayakan cuti sakit berbayar berdasarkan tempoh pekerjaan:</p>
                                                                            <ul>
                                                                                <li><p>Kurang dari 2 tahun: 14 hari/tahun</p></li>
                                                                                <li><p>2-5 tahun: 18 hari/tahun</p></li>
                                                                                <li><p>Lebih dari 5 tahun: 22 hari/tahun</p></li>
                                                                            </ul>
                                                                        </li>
                                                                        <li><p>Seksyen 60F(3) menyatakan pekerja menerima gaji biasa semasa cuti sakit.</p></li>
                                                                        <li><p>Kelayakan 60 hari cuti sakit berbayar untuk hospitalisasi (Seksyen 60F(1)(bb)).</p></li>
                                                                        <li><p>Maklumkan kepada majikan dalam masa 48 jam ketidakhadiran; jika tidak, dianggap tidak hadir tanpa kebenaran.</p></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item" style="border: 1px solid #dee2e6; border-radius: 0.375rem; margin-bottom: 1rem;">
                                                            <h2 class="accordion-header" id="headingThree">
                                                                <button class="accordion-button collapsed" type="button" style="background-color: #f8f9fa; color: #333; border: none;"
                                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    3. Cuti Umum
                                                                </button>
                                                            </h2>
                                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="color: #333; border: none;">
                                                                <div class="accordion-body" style="padding: 1rem;">
                                                                    <ul>
                                                                        <li><p>Pekerja berhak mendapat cuti berbayar pada 11 cuti umum yang diwartakan (Seksyen 60D(1)).</p></li>
                                                                        <li><p>Cuti umum boleh ditetapkan di bawah Seksyen 8 Akta Cuti 1951.</p></li>
                                                                        <li><p>Majikan boleh meminta pekerja bekerja pada cuti umum dan memberikan hari lain sebagai pengganti.</p></li>
                                                                    </ul>
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
              </div>
            </div>
          </div>
        </main>


        <!--   Core JS Files   -->
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

        <!-- Most Important JS Files -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

        <!-- Include Bootstrap JS and Popper.js -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap JS and Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>

        {{-- Include CKEditor in the HTML Head --}}
        <script src="https://cdn.ckeditor.com/4.25.0/standard/ckeditor.js"></script>


    </body>

</html>
