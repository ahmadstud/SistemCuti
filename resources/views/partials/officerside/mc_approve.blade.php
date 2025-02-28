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
        Pegawai - Bahagian Permohonan
        </title>
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
         <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
          <!-- SweetAlert2 -->
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    </head>


<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-500 position-absolute w-100" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;"></div>    @include('partials.officerside.aside')

        <main class="main-content position-relative border-radius-lg">
            <div class="container-fluid py-4">
                @include('partials.logout')
                @include('partials.officerside.mcdays')

                <div class="row mt-4">
                    <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
                        <div class="card">
                            <div class="card-header pb-1 p-1">

                                <!-- MC Approve Application Section -->
                                <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                                    <h4><b>SENARAI PERMOHONAN DARIPADA STAF</b></h4>
                                    <!-- Breadcrumb -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="{{ route('officer') }}">UTAMA</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">SENARAI PERMOHONAN DARIPADA STAF</li>
                                        </ol>
                                    </nav>
                                </nav>

                                <!-- Applications Table Section -->
                                <div class="row mt-4">
                                    <div class="col-lg-12 mb-lg-0 mb-4">
                                        <div class="container-fluid py-2">
                                            <div class="row">

                                                <div class="card">
                                                    <div class="card-header pb-0 p-3">
                                                        <div class="d-flex justify-content-between">
                                                            <h4 class="mb-2"></h4>
                                                        </div>
                                                    </div>

                        <!-- Applications Table -->
                        <div class="card-body">
                            <div style="overflow-x: auto; position: relative;">
                                @if($applications->isEmpty())
                                <!-- Display a message when no applications exist inside the table -->
                                <table class="table">
                                    <thead style="background-color: #f0f0f0;">
                                        <tr>
                                            <th style="width: 5%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">BIL</th>
                                            <th style="width: 10%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                            <th style="width: 10%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                            <th style="width: 10%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                            <th style="width: 20%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                            <th style="width: 10%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                            <th style="width: 10%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JENIS CUTI</th>
                                            <th style="width: 10%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="8" class="text-center" style="padding: 20px;">
                                                <p class="text-muted">Tiada Permohonan daripada staf</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <table class="table">
                                    <thead style="background-color: #f0f0f0;">
                                        <tr>
                                            <th style="width: auto; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">BIL</th>
                                            <th style="width: auto; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                            <th style="width: auto; padding: 8px; overflow-wrap: white-space: normal;">
                                                <a href="{{ route('officer.mc_approve', ['sort' => 'start_date', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                                    TARIKH
                                                    @if(request('sort') == 'start_date')
                                                        @if(request('order') == 'asc')
                                                            <i class="fas fa-sort-up"></i> <!-- Ascending icon -->
                                                        @else
                                                            <i class="fas fa-sort-down"></i> <!-- Descending icon -->
                                                        @endif
                                                    @else
                                                        <i class="fas fa-sort"></i> <!-- Neutral sort icon when not sorted -->
                                                    @endif
                                                </a>
                                            </th>
                                            <th style="width: auto; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JUMLAH HARI</th>
                                            <th style="width: auto; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                            <th style="width: auto; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                            <th style="width: auto; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JENIS CUTI</th>
                                            <th style="width: auto; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($applications as $application)
                                            <tr>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $application->user_name }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    {{ \Carbon\Carbon::parse($application->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($application->end_date)->format('d/m/Y') }}
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">
                                                        @php
                                                            // Calculate the difference in days and add 1 to ensure the last day is included
                                                            $startDate = \Carbon\Carbon::parse($application->start_date);
                                                            $endDate = \Carbon\Carbon::parse($application->end_date);
                                                            $daysDifference = $startDate->diffInDays($endDate) + 1; // Add 1 to include both start and end dates
                                                        @endphp
                                                        {{ $daysDifference }} hari
                                                    </p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    @if($application->document_path)
                                                        <a href="{{ Storage::url($application->document_path) }}" target="_blank">
                                                            <i class="fas fa-file-pdf text-lg me-1 text-primary"></i> PDF <!-- Document icon -->
                                                        </a>
                                                        @else
                                                        Tidak Ada Dokumen
                                                    @endif
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <span class="badge bg-success">
                                                            {{ $selectedLeaveTypes[$application->id] ?? 'Tiada Cuti Dipilih' }}
                                                        </span>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <div class="d-flex justify-content-start"> <!-- Flex container for side-by-side buttons -->

                                                        <!-- Accept or Reject Buttons -->
                                                        <div class="d-flex justify-content-between">
                                                            <form action="{{ route('officer.updateStatus', ['id' => $application->id]) }}" method="POST" class="approve-form">
                                                                @csrf
                                                                <!-- Approve Button -->
                                                                <button type="submit" name="status" value="approved_by_officer" class="btn btn-success">
                                                                    <i class="fas fa-check"></i> <!-- Right symbol -->
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('officer.updateStatus', ['id' => $application->id]) }}" method="POST" class="approve-form">
                                                                    @csrf
                                                                <!-- Reject Button to Open Modal -->
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectionReasonModal-{{ $application->id }}">
                                                                    <i class="fas fa-times"></i> <!-- Reject symbol -->
                                                                </button>

                                                                <!-- Rejection Reason Modal -->
                                                                <div class="modal fade" id="rejectionReasonModal-{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectionReasonModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="rejectionReasonModalLabel">Alasan Penolakan</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <label for="rejection_reason">Alasan Penolakan:</label>
                                                                                <textarea name="rejection_reason" id="rejection_reason" rows="3" class="form-control summernote" required></textarea>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                                <!-- Rejection submit button -->
                                                                                <button type="submit" name="status" value="rejected" class="btn btn-danger">
                                                                                    Hantar Tolakan
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                              <!-- Pagination Links -->
                              @if($applications->hasPages())
                              <div class="d-flex justify-content-between align-items-center mt-3">
                                  <div>
                                      Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of {{ $mcApplications->total() }} results
                                  </div>
                                  <div>
                                      {{ $applications->links() }}
                                  </div>
                              </div>
                          @endif

                            </div>
                        </div>
                    </div> <!-- Closed card div -->
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
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
        <!-- Most Important JS Files -->
        <script src="{{ asset('js/app.js') }}"></script>


        <!-- jQuery and Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berjaya!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'OK'
                });
            @elseif(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Ralat!',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'OK'
                });
            @endif
        </script>
    </body>


</html>
