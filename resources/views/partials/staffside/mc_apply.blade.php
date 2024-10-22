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
      Staf - Bahagian Permohonan
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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

<!-- MC Apply Application Section -->
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>PERMOHONAN CUTI</b></h4>
    </nav>

    <!-- MC Applications Table Section -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container-fluid py-2">
                <div class="row">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h4 class="mb-2"></h4>
                                <!-- Add MC Application Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcApplicationModal">
                                    Memohon Surat Cuti
                                </button>
                            </div>
                        </div>

                       <!-- Add MC Application Modal -->
                        <div class="modal fade" id="mcApplicationModal" tabindex="-1" aria-labelledby="mcApplicationModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                        <h5 class="modal-title" id="mcApplicationModalLabel">Permohonan Cuti</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('staff.mc.submit') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-md-6 mb-3">
                                                    <label for="start_date" class="form-label">Tarikh Mula<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="end_date" class="form-label">Tarikh Tamat<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                                </div>
                                            </div>

                                           <!-- Leave Type Selection -->
                                            <div class="col-md-12 mb-3">
                                                <label for="leave_type" class="form-label">Jenis Cuti<span class="text-danger">*</span></label>
                                                <select class="form-control" id="leave_type" name="leave_type" required onchange="toggleDocumentField()">
                                                    <option value="mc">Cuti Sakit (MC)</option>
                                                    <option value="annual">Cuti Tahunan</option>
                                                    <option value="other">Lain-lain</option>
                                                </select>
                                            </div>

                                            <!-- Document Upload Field -->
                                            <div class="col-md-12 mb-3" id="document_upload_field">
                                                <label for="document_path" class="form-label">Dokumen MC<span class="text-danger">*</span></label>
                                                <input type="file" class="form-control" id="document_path" name="document_path" required>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="reason" class="form-label">Ulasan<span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Permohonan terus ke Admin:</label><br>
                                                <input type="radio" id="yes" name="direct_admin_approval" value="1">
                                                <label for="yes">Ya</label><br>
                                                <input type="radio" id="no" name="direct_admin_approval" value="0" checked>
                                                <label for="no">Tidak</label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- List of MC Applications -->
                        <div class="card-body">
                            <div style="overflow-x: auto; position: relative;">
                                @if($mcApplications->isEmpty())
                                 <!-- Display a message when no applications exist inside the table -->
                               <table class="table" style="table-layout: fixed; width: 100%;">
                                <thead style="background-color: #f0f0f0;">
                                    <tr>
                                        <th style="width: 3%; position: sticky; left: 0;">BIL</th>
                                            <th style="width: 15%;">TARIKH MULA</th>
                                            <th style="width: 15%;">TARIKH TAMAT</th>
                                            <th style="width: 15%;">ULASAN</th>
                                            <th style="width: 15%;">DOKUMEN</th>
                                            <th style="width: 15%;">JENIS CUTI</th>
                                            <th style="width: 15%;">STATUS</th>
                                            <th style="width: 15%;">TINDAKAN</th>
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
                                <table class="table" style="table-layout: fixed; width: 100%;">
                                    <thead style="background-color: #f0f0f0;">
                                        <tr>
                                            <th style="width: 5%; position: sticky; left: 0;">BIL</th>
                                            <th style="width: 15%;">TARIKH MULA</th>
                                            <th style="width: 15%;">TARIKH TAMAT</th>
                                            <th style="width: 15%;">ULASAN</th>
                                            <th style="width: 15%;">DOKUMEN</th>
                                            <th style="width: 15%;">JENIS CUTI</th>
                                            <th style="width: 15%;">STATUS</th>
                                            <th style="width: 15%;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mcApplications as $index => $mcApplication)
                                            <tr>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ $index + 1 }}</td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ \Carbon\Carbon::parse($mcApplication->start_date)->format('d/m/Y') }}</td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ \Carbon\Carbon::parse($mcApplication->end_date)->format('d/m/Y') }}</td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ $mcApplication->reason }}</td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    @if($mcApplication->document_path)
                                                        <a href="{{ Storage::url($mcApplication->document_path) }}" target="_blank" title="Download Dokumen">
                                                            <i class="fas fa-file-pdf text-lg me-1"></i> PDF
                                                        </a>
                                                    @else
                                                        <span>Tidak Ada Dokumen</span>
                                                    @endif
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    @switch($mcApplication->leave_type)
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
                                                    @if($mcApplication->status == 'approved')
                                                        <span class="badge bg-gradient-success">Diterima</span>
                                                    @elseif($mcApplication->status == 'pending_admin')
                                                        <span class="badge bg-gradient-warning">Kelulusan dalam proses</span>
                                                    @elseif($mcApplication->status == 'pending')
                                                        <span class="badge bg-gradient-warning">Dalam Proses</span>
                                                    @else
                                                        <span class="badge bg-gradient-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    @if($mcApplication->admin_approved && $mcApplication->officer_approved)
                                                        -
                                                    @elseif($mcApplication->status == 'pending')
                                                        <!-- Button to trigger modal for editing -->
                                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editMcModal{{ $mcApplication->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <!-- Delete button -->
                                                        <form action="{{ route('staff.deleteMC', $mcApplication->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this application?');">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>

                                                        <!-- Edit MC Application Modal -->
                                                        <div class="modal fade" id="editMcModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="editMcModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                                                        <h5 class="modal-title" id="editMcModalLabel{{ $mcApplication->id }}">Kemas Kini Permohonan</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('staff.mc.edit', $mcApplication->id) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="row g-3">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="start_date{{ $mcApplication->id }}" class="form-label">Tarikh Mula<span class="text-danger">*</span></label>
                                                                                    <input type="date" class="form-control" id="start_date{{ $mcApplication->id }}" name="start_date" value="{{ $mcApplication->start_date }}" required>
                                                                                </div>
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="end_date{{ $mcApplication->id }}" class="form-label">Tarikh Tamat<span class="text-danger">*</span></label>
                                                                                    <input type="date" class="form-control" id="end_date{{ $mcApplication->id }}" name="end_date" value="{{ $mcApplication->end_date }}" required>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Leave Type Selection -->
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="leave_type{{ $mcApplication->id }}" class="form-label">Jenis Cuti<span class="text-danger">*</span></label>
                                                                                <select class="form-control" id="leave_type{{ $mcApplication->id }}" name="leave_type" required>
                                                                                    <option value="mc" {{ $mcApplication->leave_type == 'mc' ? 'selected' : '' }}>Cuti Sakit (MC)</option>
                                                                                    <option value="annual" {{ $mcApplication->leave_type == 'annual' ? 'selected' : '' }}>Cuti Tahunan</option>
                                                                                    <option value="other" {{ $mcApplication->leave_type == 'other' ? 'selected' : '' }}>Lain-lain</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="document_path{{ $mcApplication->id }}" class="form-label">Dokumen (Biarkan kosong jika tiada perubahan)</label>
                                                                                <input type="file" class="form-control" id="document_path{{ $mcApplication->id }}" name="document_path">
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="reason{{ $mcApplication->id }}" class="form-label">Sebab<span class="text-danger">*</span></label>
                                                                                <textarea class="form-control" id="reason{{ $mcApplication->id }}" name="reason" rows="3" required>{{ $mcApplication->reason }}</textarea>
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label>Permohonan terus ke Admin:</label><br>
                                                                                <input type="radio" id="yes{{ $mcApplication->id }}" name="direct_admin_approval" value="1" {{ $mcApplication->direct_admin_approval ? 'checked' : '' }}>
                                                                                <label for="yes{{ $mcApplication->id }}">Ya</label><br>
                                                                                <input type="radio" id="no{{ $mcApplication->id }}" name="direct_admin_approval" value="0" {{ !$mcApplication->direct_admin_approval ? 'checked' : '' }}>
                                                                                <label for="no{{ $mcApplication->id }}">Tidak</label>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @elseif($mcApplication->status == 'pending_admin')
                                                        Menunggu kelulusan daripada admin
                                                    @else
                                                        {{ $mcApplication->rejection_reason }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

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