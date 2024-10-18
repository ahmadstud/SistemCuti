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
        <div class="min-height-500 bg-primary position-absolute w-100"></div>
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
                                                                                    <p class="text-m text-secondary">{{ \Carbon\Carbon::parse($application->start_date)->format('d/m/Y') }}</p>
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    <p class="text-m text-secondary">{{ \Carbon\Carbon::parse($application->end_date)->format('d/m/Y') }}</p></td>
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    <p class="text-m text-secondary">
                                                                                    @if($application->document_path)
                                                                                        <a href="{{ asset($application->document_path) }}" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</a>
                                                                                    @else
                                                                                        <span>Tidak Ada Dokumen</span>
                                                                                    @endif
                                                                                    </p>
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    {{ $application->officer_approved ? 'Yes' : 'No' }}
                                                                                </td>

                                                                                {{-- <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    @if($application->officer_approved && !$application->admin_approved)
                                                                                        <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="display:inline;">
                                                                                            @csrf
                                                                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                                                                        </form>
                                                                                    @else
                                                                                        <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fas fa-check-double"></i></button>
                                                                                    @endif
                                                                                </td> --}}

                                                                                <td style="background-color: transparent; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    @if($application->officer_approved && !$application->admin_approved)
                                                                                        <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="display:inline;">
                                                                                            @csrf
                                                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                                                <i class="fas fa-check"></i> <!-- Check symbol for approval -->
                                                                                            </button>
                                                                                        </form>
                                                                                        <!-- Rejection Button (Modal Trigger) -->
                                                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#adminRejectionModal-{{ $application->id }}">
                                                                                            <i class="fas fa-times"></i> <!-- Reject symbol -->
                                                                                        </button>
                                                                                
                                                                                        <!-- Rejection Reason Modal -->
                                                                                        <div class="modal fade" id="adminRejectionModal-{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="adminRejectionModalLabel-{{ $application->id }}" aria-hidden="true">
                                                                                            <div class="modal-dialog" role="document">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="adminRejectionModalLabel-{{ $application->id }}">Alasan Penolakan</h5>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <form action="{{ route('admin.reject', $application->id) }}" method="POST" class="reject-form">
                                                                                                            @csrf
                                                                                                            <label for="rejection_reason_{{ $application->id }}">Alasan Penolakan:</label>
                                                                                                            <textarea name="rejection_reason" id="rejection_reason_{{ $application->id }}" rows="3" class="form-control" required></textarea>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                                                        <button type="submit" class="btn btn-danger">Hantar Tolakan</button>
                                                                                                    </div>
                                                                                                        </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <button type="button" class="btn btn-secondary btn-sm" disabled>
                                                                                            <i class="fas fa-check-double"></i> <!-- Double-check symbol for already approved -->
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

