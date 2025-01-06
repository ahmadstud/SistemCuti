@if (Auth::check())
    @if (Auth::user()->role === 'admin')
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
    <!-- Meta Information -->
    <!-- Sets the character encoding to UTF-8 for better compatibility with various languages and symbols -->
    <meta charset="utf-8" />
    <!-- Ensures responsive scaling for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- App Icon Settings -->
    <!-- Defines the icon for iOS devices -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/Erawhiz.png') }}">
    <!-- Defines the favicon for browsers -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Erawhiz.png') }}">

    <!-- Page Title -->
    <title>Admin - Bahagian Permohonan Belum Diluluskan</title>

    <!-- Fonts and Icons -->
    <!-- Open Sans font from Google Fonts (weights: 300, 400, 600, 700) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons for Argon Dashboard styling -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

   <!-- Font Awesome Icons (For additional icons) -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <!-- Main Argon Dashboard styling -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

    <!-- SweetAlert2 Styles -->
    <!-- Includes SweetAlert2 styling for customizable alert modals -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JavaScript -->
    <!-- Loads the SweetAlert2 library for creating alerts and notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-500 bg-primary position-absolute w-100"
        style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
    </div>
    @include('partials.adminside.aside')

    <main class="main-content position-relative border-radius-lg">
        <div class="container-fluid py-4">
            @include('partials.logout')
            @include('partials.adminside.mcdata')

            <div class="row mt-4">
                <div class="col-lg-12 mb-lg-0 mb-4"> <!-- Adjust column to full width -->
                    <div class="card">
                        <div class="card-header pb-1 p-1">

                            <!-- Direct Admin Approval Section -->
                            <div class="d-flex align-items-center justify-content-between mb-4 p-3"
                                style="background-color: rgba(0, 0, 0, 0);">
                                <h4 class="mb-0 text-uppercase fw-bold "><b>
                                        <i class="bi bi-speedometer2 me-2"></i> KELULUSAN ADMIN UNTUK PERMOHONAN STAF DAN PEGAWAI</b>
                                </h4>
                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-12 mb-lg-0 mb-4">
                                    <div class="container-fluid py-2">
                                        <div class="row">

                                            {{-- List of Direct Admin Approval --}}
                                            <div class="card">
                                                <div class="card-header pb-0 p-3">
                                                    <div class="d-flex justify-content-between">
                                                        <h4 class="mb-2"></h4>
                                                    </div>
                                                </div>

                                                <!-- View Applications Section -->
                                                <div class="card-body">
                                                    <div style="overflow-x: auto; position: relative;">
                                                        <table class="table">
                                                            <thead style="background-color: #f0f0f0;">
                                                                <tr>
                                                                    <th style="width: 5%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> BIL</th>
                                                                    <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> NAMA</th>
                                                                    <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JAWATAN</th>
                                                                    <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> TARIKH PERMOHONAN</th>
                                                                    <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> JENIS CUTI</th>
                                                                    <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> TARIKH CUTI</th>
                                                                    <th style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> ULASAN</th>
                                                                    <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> DOKUMEN RUJUKAN</th>
                                                                    <th style="width: 20%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">PEGAWAI YANG MELULUSKAN</th>
                                                                    <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> TINDAKAN</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if ($pendingApplications->isEmpty())
                                                                    <tr>
                                                                        <td colspan="9" class="text-center" style="padding: 20px;">
                                                                            <p class="text-muted">Tiada Permohonan</p>
                                                                        </td>
                                                                    </tr>
                                                                @else
                                                                    @foreach ($pendingApplications as $application)
                                                                        <tr>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $application->user_name }}</p>
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                @if($application->user->role == 'staff')
                                                                                    <span class="badge badge-md bg-gradient-info">Staf</span>
                                                                                @else
                                                                                    <span class="badge badge-md bg-gradient-warning">Pegawai</span>
                                                                                @endif
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">
                                                                                    {{ \Carbon\Carbon::parse($application->created_at)->format('d/m/Y') }}
                                                                                </p>
                                                                            </td>                                                                            
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <span class="badge bg-success">
                                                                                    {{ $selectedLeaveTypes[$application->id] ?? 'Tiada Cuti Dipilih' }}
                                                                                </span>
                                                                            </td>
                                                                            
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary"><b> {{ \Carbon\Carbon::parse($application->start_date)->format('d/m/Y') }} </b> hingga <b> {{ \Carbon\Carbon::parse($application->end_date)->format('d/m/Y') }} </b></p>
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                {!! $application->reason ?? '<p class="text-m text-secondary">Tiada ulasan</p>' !!}
                                                                            </td>                                                                            
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">
                                                                                    @if ($application->document_path)
                                                                                        <a href="{{ Storage::url($application->document_path) }}" target="_blank">
                                                                                            <i class="fas fa-file-pdf text-lg me-1"></i> PDF
                                                                                        </a>
                                                                                    @else
                                                                                        <span class="text-danger">Tiada dokumen</span>
                                                                                    @endif
                                                                                </p>
                                                                            </td>
                                                                            <td style="background: white; border: 1px solid #dee2e6; padding: 8px;">
                                                                                @if ($application->officer_name)
                                                                                    {{ $application->officer_name }}
                                                                                @else
                                                                                    <span class="text-danger">Tiada Penyelia</span>
                                                                                @endif
                                                                            </td>                                                                            
                                                                            <td style="background: white; border: 1px solid #dee2e6; padding: 8px;">
                                                                                <div class="d-flex justify-content-start">

                                                                                    <!-- Approve Button -->
                                                                                    <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="margin-right: 5px;">
                                                                                        @csrf
                                                                                        <button type="submit" class="btn btn-success">
                                                                                            <i class="fas fa-check"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                    <!-- Reject Button -->
                                                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal-{{ $application->id }}">
                                                                                        <i class="fas fa-times"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <!-- Reject Modal -->
                                                                                <div class="modal fade" id="rejectModal-{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">Sebab Penolakan</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <form action="{{ route('admin.reject', $application->id) }}" method="POST">
                                                                                                @csrf
                                                                                                <div class="modal-body">
                                                                                                    <label>Sila nyatakan sebab:</label>
                                                                                                    <textarea name="reason" class="form-control" required></textarea>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
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
    <!-- Most Important JS Files -->
    <script src="{{ asset('js/app.js') }}"></script>


    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
