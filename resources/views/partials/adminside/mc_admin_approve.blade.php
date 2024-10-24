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

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                                <!-- Direct Admin Approval Section -->
                                <div class="d-flex align-items-center justify-content-between mb-4 p-3" style="background-color: rgba(0, 0, 0, 0);">
                                    <h4 class="mb-0 text-uppercase fw-bold "><b>
                                        <i class="bi bi-speedometer2 me-2"></i> KELULUSAN TERUS ADMIN UNTUK PERMOHONAN (STAF DAN PEGAWAI)</b>
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
                                                                        <th style="width: 5%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">BIL</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                                                        <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JENIS CUTI</th>
                                                                        <th style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                                                        <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                                                        <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($directAdminApplications->isEmpty())
                                                                        <tr>
                                                                            <td colspan="7" class="text-center" style="padding: 20px;">
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
                                                                                <td>
                                                                                    @switch($application->leave_type)
                                                                                        @case('mc')
                                                                                            <span class="badge bg-success">Cuti Sakit</span>
                                                                                            @break
                                                                                        @case('annual')
                                                                                            <span class="badge bg-primary">Cuti Tahunan</span>
                                                                                            @break
                                                                                        @default
                                                                                            <span class="badge bg-warning">Cuti Lain-lain</span>
                                                                                    @endswitch
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    @if($application->document_path)
                                                                                        <a href="{{ Storage::url($application->document_path) }}" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</a>
                                                                                    @else
                                                                                        <span>Tiada dokumen</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                    <div class="d-flex justify-content-start"> <!-- Flex container for side-by-side buttons -->
                                                                                
                                                                                        <!-- Approve Button Form -->
                                                                                        <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="margin-right: 5px;">
                                                                                            @csrf
                                                                                            <button type="submit" class="btn btn-success" aria-label="Approve" onclick="console.log('Approve button clicked');">
                                                                                                <i class="fas fa-check"></i>
                                                                                            </button>
                                                                                        </form>
                                                                                
                                                                                        <!-- Reject Button Form -->
                                                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectionReasonModal{{ $application->id }}">
                                                                                            <i class="fas fa-times"></i>
                                                                                        </button>
                                                                                
                                                                                        <!-- Modal for Rejection Reason -->
                                                                                        <div class="modal fade" id="rejectionReasonModal{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectionReasonModalLabel{{ $application->id }}" aria-hidden="true">
                                                                                            <div class="modal-dialog" role="document">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="rejectionReasonModalLabel{{ $application->id }}">Alasan Penolakan</h5>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <label for="rejection_reason_{{ $application->id }}">Alasan Penolakan:</label>
                                                                                                        <textarea name="rejection_reason" id="rejection_reason_{{ $application->id }}" rows="3" class="form-control" required></textarea>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                                                        <!-- Submit rejection form with reason -->
                                                                                                        <button type="button" class="btn btn-danger" onclick="submitRejection({{ $application->id }})">
                                                                                                            Hantar Tolakan
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                
                                                                                        <script>
                                                                                            function submitRejection(applicationId) {
                                                                                                // Get the textarea value
                                                                                                const reason = document.getElementById(`rejection_reason_${applicationId}`).value;
                                                                                
                                                                                                // Check if reason is provided
                                                                                                if (reason.trim() === '') {
                                                                                                    alert('Sila nyatakan alasan penolakan.');
                                                                                                    return;
                                                                                                }
                                                                                
                                                                                                // Submit the form using AJAX or a standard form submission
                                                                                                const form = document.createElement('form');
                                                                                                form.method = 'POST';
                                                                                                form.action = '{{ route('admin.reject', '') }}/' + applicationId; // Adjust route
                                                                                                const input = document.createElement('input');
                                                                                                input.type = 'hidden';
                                                                                                input.name = 'rejection_reason';
                                                                                                input.value = reason;
                                                                                                form.appendChild(input);
                                                                                
                                                                                                // Append CSRF token
                                                                                                const csrfInput = document.createElement('input');
                                                                                                csrfInput.type = 'hidden';
                                                                                                csrfInput.name = '_token';
                                                                                                csrfInput.value = '{{ csrf_token() }}'; // Get CSRF token
                                                                                                form.appendChild(csrfInput);
                                                                                
                                                                                                document.body.appendChild(form);
                                                                                                form.submit();
                                                                                            }
                                                                                        </script>
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
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function submitRejection(applicationId) {
                const textarea = document.getElementById(`rejection_reason_${applicationId}`);
                const form = document.getElementById(`reject-form-${applicationId}`);

                // Append the rejection reason to the form
                const rejectionReasonInput = document.createElement('input');
                rejectionReasonInput.type = 'hidden';
                rejectionReasonInput.name = 'rejection_reason';
                rejectionReasonInput.value = textarea.value;

                form.appendChild(rejectionReasonInput);

                // Submit the form
                form.submit();
            }
        </script>


    </body>
</html>
