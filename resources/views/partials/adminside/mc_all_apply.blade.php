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
            Sistem Permohonan Cuti - Staf
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

    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-500 bg-primary position-absolute w-100" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;"></div>
                    @include('partials.adminside.aside')

        <main class="main-content position-relative border-radius-lg">
            <div class="container-fluid py-4">
                    {{-- @include('partials.logout')
                    @include('partials.adminside.mcdays')
     --}}
                     @include('partials.logout')
                    @include('partials.adminside.mcdata')

                <div class="row mt-4">
                    <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
                        <div class="card">
                            <div class="card-header pb-1 p-1">


                                <!-- Senarai Permohonan Semua (Staf dan Pegawai) -->
                                <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                                    <h4><b>SENARAI KESELURUHAN PERMOHONAN<b></h4>
                                </nav>

                                <div class="row mt-4">
                                    <div class="col-lg-12 mb-lg-0 mb-4">
                                        <div class="container-fluid py-2">

                                            <div class="row">

                                                {{-- List of Direct Admin Approval --}}
                                                <div class="card">
                                                    <div class="card-header pb-0 p-3">
                                                        <div class="d-flex justify-content-between">
                                                            <h6 class="mb-2"></h6>
                                                        </div>
                                                    </div>

                                                    <!-- View Applications Section -->
                                                    <div class="card-body">

                                                        <form method="GET" action="{{ route('admin.mcAllApply') }}" class="mb-3">
                                                            <div class="row g-3">
                                                                <div class="col-md-2">
                                                                    <label for="statusFilter" class="form-label">Status</label>
                                                                    <select name="status" id="statusFilter" class="form-select">
                                                                        <option value="">Semua Status</option>
                                                                        <option value="approved">Lulus</option>
                                                                        <option value="rejected">Gagal</option>
                                                                        <option value="pending">Pending</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="roleFilter" class="form-label">Status</label>
                                                                    <select name="role" id="roleFilter"class="form-select">
                                                                        <option value="">Semua Peranan</option>
                                                                        <option value="staff">Staf</option>
                                                                        <option value="officer">Pegawai</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="leave_typeFilter" class="form-label">Jenis Cuti</label>
                                                                    <select name="leave_type" id="leave_typeFilter  "class="form-select">
                                                                        <option value="">Semua Cuti</option>
                                                                        <option value="mc">Sakit</option>
                                                                        <option value="annual">Tahunan</option>
                                                                        <option value="other">Lain-lain</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="start_date" class="form-label">Tarikh Mula</label>
                                                                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="end_date" class="form-label">Tarikh Akhir</label>
                                                                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">&nbsp;</label>
                                                                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <div style="overflow-x: auto; position: relative;">
                                                            <table class="table" style="table-layout: fixed; width: 100%;">
                                                                <thead style="background-color: #f0f0f0;">
                                                                    <tr>
                                                                        <th style="width: 3%; position: sticky; left: 0; z-index: 1;  padding: 8px;">BIL</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JAWATAN</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                                                        <th style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                                                        <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JENIS CUTI</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">KEPUTUSAN</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($allApplications as $index => $application)
                                                                        <tr>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $index + 1 }}</p>
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $application->user->name }}</p>
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            @if($application->user->role == 'staff')
                                                                            <span class="badge badge-md bg-gradient-info">Staf</span>
                                                                            @else
                                                                            <span class="badge badge-md bg-gradient-warning">Pegawai</span>
                                                                            @endif
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $application->start_date }}</p>
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $application->end_date }}</p>
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">
                                                                                @if($application->document_path)
                                                                                    <a href="{{ asset($application->document_path) }}" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</a>
                                                                                @else
                                                                                    No Document
                                                                                @endif
                                                                                </p>
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                @switch($application->leave_type)
                                                                                @case('mc')
                                                                                    <span class="badge bg-success">Cuti Sakit</span>
                                                                                    @break
                                                                                @case('annual')
                                                                                    <span class="badge bg-success">Cuti Tahunan</span>
                                                                                    @break
                                                                                @default
                                                                                    <span class="badge bg-success">Cuti Lain-lain</span>
                                                                            @endswitch
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">
                                                                                @if($application->status == 'approved')
                                                                                    <span class="badge badge-md bg-gradient-success" id="statusLulus">Lulus</span>
                                                                                @elseif($application->status == 'rejected')
                                                                                    <span class="badge badge-md bg-gradient-danger" id="statusGagal">Gagal</span>
                                                                                @else
                                                                                    <span class="badge badge-md bg-gradient-warning" id="statusPending">Pending</span>
                                                                                @endif
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>

                                                            </table>
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

        <!-- Core JS Files -->
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>
</html>
