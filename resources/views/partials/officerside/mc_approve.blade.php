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
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  </head>


<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-500 bg-primary position-absolute w-100"></div>
    @include('partials.officerside.aside')

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
        <h4><b>SENARAI PERMOHONAN</b></h4> <!-- Fixed the closing b tag -->
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
                                    <!-- Display a message when no applications exist -->
                                    <div class="alert alert-warning" role="alert">
                                        Tiada permohonan daripada staf.
                                    </div>
                                @else
                                    <table class="table" style="table-layout: fixed; width: 100%;">
                                        <thead style="background-color: #f0f0f0;">
                                            <tr>
                                                <th style="width: 5%; position: sticky; left: 0; z-index: 1; padding: 8px;">BIL</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">STATUS</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($applications as $application)
                                                <tr>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->user_name }}</p>
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->start_date }}</p>
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->end_date }}</p>
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        @if($application->document_path)
                                                            <a href="{{ Storage::url($application->document_path) }}" target="_blank" class="btn btn-link p-0">
                                                                <i class="fas fa-file-alt"></i> <!-- Document icon -->
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        @if($application->admin_approved && $application->officer_approved)
                                                            <span class="badge bg-success">Diterima</span>
                                                        @elseif($application->admin_approved)
                                                            <span class="badge bg-info">Diterima</span>
                                                        @elseif($application->officer_approved)
                                                            <span class="badge bg-warning text-dark">Kebenaran Penyelia</span>
                                                        @elseif($application->status == 'pending')
                                                            <span class="badge bg-warning">Menunggu</span>
                                                        @else
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <!-- Accept or Reject Buttons -->
                                                        <form action="{{ route('officer.updateStatus',['id' => $application->id]) }}" method="POST" class="approve-form">
                                                            @csrf
                                                            <button type="submit" name="status" value="approved_by_officer" class="btn btn-success">
                                                                <i class="fas fa-check"></i> <!-- Right symbol -->
                                                            </button>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectionReasonModal">
                                                                <i class="fas fa-times"></i> <!-- Reject symbol -->
                                                            </button>

                                                            <!-- Rejection Reason Modal -->
                                                            <div class="modal fade" id="rejectionReasonModal" tabindex="-1" role="dialog" aria-labelledby="rejectionReasonModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="rejectionReasonModalLabel">Alasan Penolakan</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <label for="rejection_reason">Alasan Penolakan:</label>
                                                                            <textarea name="rejection_reason" id="rejection_reason" rows="3" class="form-control" required></textarea>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" name="status" value="rejected" class="btn btn-danger">
                                                                                Hantar Tolakan
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
