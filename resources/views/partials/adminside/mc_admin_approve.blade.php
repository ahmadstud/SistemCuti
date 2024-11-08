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
    <title>Admin - Bahagian Kelulusan terus</title>

    <!-- Fonts and Icons -->
    <!-- Open Sans font from Google Fonts (weights: 300, 400, 600, 700) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons for Argon Dashboard styling -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons for various icon options -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

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
                                        <i class="bi bi-speedometer2 me-2"></i> KELULUSAN TERUS ADMIN UNTUK PERMOHONAN
                                        (STAF DAN PEGAWAI)</b>
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
                                                                    <th
                                                                        style="width: 5%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> BIL</th>
                                                                    <th
                                                                        style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> NAMA</th>
                                                                    <th
                                                                        style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> TARIKH MULA</th>
                                                                    <th
                                                                        style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> TARIKH AKHIR</th>
                                                                    <th
                                                                        style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> JENIS CUTI</th>
                                                                    <th
                                                                        style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> ULASAN</th>
                                                                    <th
                                                                        style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> DOKUMEN RUJUKAN</th>
                                                                    <th
                                                                        style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> TINDAKAN</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if ($directAdminApplications->isEmpty())
                                                                    <tr>
                                                                        <td colspan="7" class="text-center"
                                                                            style="padding: 20px;">
                                                                            <p class="text-muted">Tiada Permohonan</p>
                                                                        </td>
                                                                    </tr>
                                                                @else
                                                                    @foreach ($directAdminApplications as $application)
                                                                    <tr>
                                                                        <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                                        </td>
                                                                        <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ $application->user->name }}</p>
                                                                        </td>
                                                                        <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ \Carbon\Carbon::parse($application->start_date)->format('d/m/Y') }}</p>
                                                                        </td>
                                                                        <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ \Carbon\Carbon::parse($application->end_date)->format('d/m/Y') }}</p>
                                                                        </td>
                                                                        <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <span class="badge bg-success">
                                                                                {{ $selectedLeaveTypes[$application->id] ?? 'Tiada Cuti Dipilih' }}
                                                                            </span>
                                                                        </td>
                                                                        <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                                        </td>
                                                                        <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            @if ($application->document_path)
                                                                                <a href="{{ Storage::url($application->document_path) }}" target="_blank">
                                                                                    <i class="fas fa-file-pdf text-lg me-1"></i> PDF
                                                                                </a>
                                                                            @else
                                                                                <span class="text-danger">Tiada dokumen</span>
                                                                            @endif
                                                                        </td>
                                                                        <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <div class="d-flex justify-content-start">
                                                                                <!-- Approve Button Form -->
                                                                                <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="margin-right: 5px;" class="approve-form">
                                                                                    @csrf
                                                                                    <button type="submit" class="btn btn-success" aria-label="Accept">
                                                                                        <i class="fas fa-check"></i>
                                                                                    </button>
                                                                                </form>

                                                                                <!-- Reject Button Trigger -->
                                                                                <button type="button" class="btn btn-danger" aria-label="Reject" data-toggle="modal" data-target="#rejectModal-{{ $application->id }}">
                                                                                    <i class="fas fa-times"></i>
                                                                                </button>
                                                                            </div>

                                                                            <!-- Modal for rejection reason -->
                                                                            <div class="modal fade" id="rejectModal-{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="rejectModalLabel">Sebab Penolakan</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <form action="{{ route('admin.reject', $application->id) }}" method="POST" class="reject-form">
                                                                                            @csrf
                                                                                            <div class="modal-body">
                                                                                                <div class="form-group">
                                                                                                    <label for="reason-{{ $application->id }}">Sila nyatakan sebab penolakan:</label>
                                                                                                    <textarea id="reason-{{ $application->id }}" name="reason" class="form-control" required></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- SweetAlert for rejection confirmation -->
                                                                            <script>
                                                                                document.querySelectorAll('.reject-form').forEach(form => {
                                                                                    form.addEventListener('submit', function(event) {
                                                                                        event.preventDefault(); // Prevent the default form submission
                                                                                        const reason = document.getElementById(`reason-${{{ $application->id }}}`).value; // Get the reason value

                                                                                        Swal.fire({
                                                                                            title: 'Sahkan Penolakan',
                                                                                            text: `Anda pasti ingin menolak permohonan ini? Sebab: ${reason}`,
                                                                                            icon: 'warning',
                                                                                            showCancelButton: true,
                                                                                            confirmButtonColor: '#d33',
                                                                                            cancelButtonColor: '#3085d6',
                                                                                            confirmButtonText: 'Ya, Tolak!',
                                                                                            cancelButtonText: 'Batal'
                                                                                        }).then((result) => {
                                                                                            if (result.isConfirmed) {
                                                                                                this.submit(); // Submit the form if confirmed
                                                                                            }
                                                                                        });
                                                                                    });
                                                                                });

                                                                                // SweetAlert for success and error messages
                                                                                @if (session('success'))
                                                                                    Swal.fire({
                                                                                        icon: 'success',
                                                                                        title: 'Berjaya',
                                                                                        text: '{{ session('success') }}',
                                                                                        confirmButtonText: 'OK'
                                                                                    });
                                                                                @elseif (session('error'))
                                                                                    Swal.fire({
                                                                                        icon: 'error',
                                                                                        title: 'Ralat',
                                                                                        text: '{{ session('error') }}',
                                                                                        confirmButtonText: 'OK'
                                                                                    });
                                                                                @endif
                                                                            </script>
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
