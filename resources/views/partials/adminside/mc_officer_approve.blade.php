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
                     @include('partials.logout')
                    @include('partials.adminside.mcdata')

                <div class="row mt-4">
                    <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
                        <div class="card">
                            <div class="card-header pb-1 p-1">

                                <!-- Admin Approval Section -->
                                <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                                    <h4><b>KELULUSAN ADMIN UNTUK PERMOHONAN STAF<b></h4>
                                </nav>

                                <div class="row mt-4">
                                    <div class="col-lg-12 mb-lg-0 mb-4">
                                        <div class="container-fluid py-2">
                                            <div class="row">

                                                <!-- List of Admin Approval -->
                                                <div class="card">
                                                    <div class="card-header pb-0 p-3">
                                                        <div class="d-flex justify-content-between">
                                                            <h4 class="mb-2"></h4>
                                                        </div>
                                                    </div>

                                                    <!-- View Applications Section -->
                                                    <div class="card-body">
                                                        <div style="overflow-x: auto; position: relative;">
                                                            <table class="table" style="table-layout: fixed; width: 100%;">
                                                                <thead style="background-color: #f0f0f0;">
                                                                    <tr>
                                                                        <th style="width: 5%; position: sticky; left: 0; z-index: 1;  padding: 8px;">BIL</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JENIS CUTI</th>
                                                                        <th style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                                                        <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                                                        <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DILULUSKAN OLEH</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if($applications->isEmpty())
                                                                        <tr>
                                                                            <td colspan="8" class="text-center" style="padding: 20px;">
                                                                                <p class="text-muted">Tiada Permohonan</p>
                                                                            </td>
                                                                        </tr>
                                                                    @else
                                                                        @foreach($applications as $index => $application)
                                                                            <tr>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    <p class="text-m text-secondary">{{ $index + 1 }}</p>
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    <p class="text-m text-secondary">{{ $application->user->name }}</p>
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    <p class="text-m text-secondary">{{ $application->start_date }}</p>
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    <p class="text-m text-secondary">{{ $application->end_date }}</p>
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
                                                                                    <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    <p class="text-m text-secondary">
                                                                                    @if($application->document_path)
                                                                                    <a href="{{ Storage::url($application->document_path) }}" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</a>                                                                                    @else
                                                                                        No Document
                                                                                    @endif
                                                                                    </p>
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    {{ $application->officer_name ? $application->officer_name : 'Tiada Penyelia' }}
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; white-space: normal;">
                                                                                    @if($application->status === 'pending_admin')
                                                                                    <div class="d-flex justify-content-between">
                                                                                        <form action="{{ route('admin.approve', $application->id) }}" method="POST" class="d-inline">
                                                                                            @csrf
                                                                                            <button type="submit" class="btn btn-success btn-sm" aria-label="Accept">
                                                                                                <i class="fas fa-check"></i>
                                                                                            </button>
                                                                                        </form>

                                                                                        <form action="{{ route('admin.reject', $application->id) }}" method="POST" class="d-inline">
                                                                                            @csrf
                                                                                            <button type="submit" class="btn btn-danger btn-sm" aria-label="Reject">
                                                                                                <i class="fas fa-times"></i>
                                                                                            </button>
                                                                                        </form>
                                                                                    </div>
                                                                                    @elseif($application->status === 'accepted')
                                                                                        <button type="button" class="btn btn-primary btn-sm" disabled aria-label="Accepted">
                                                                                            <i class="fas fa-check-circle"></i>
                                                                                        </button>
                                                                                    @elseif($application->status === 'rejected')
                                                                                        <button type="button" class="btn btn-secondary btn-sm" disabled aria-label="Rejected">
                                                                                            <i class="fas fa-times-circle"></i>
                                                                                        </button>
                                                                                    @else
                                                                                        <button type="button" class="btn btn-secondary btn-sm" disabled aria-label="Pending">
                                                                                            <i class="fas fa-check-double"></i>
                                                                                        </button>
                                                                                    @endif
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
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>
</html>

