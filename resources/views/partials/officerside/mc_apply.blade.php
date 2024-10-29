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
    <div class="min-height-500 position-absolute w-100" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;"></div>    @include('partials.officerside.aside')

        <main class="main-content position-relative border-radius-lg">
            <div class="container-fluid py-4">
                @include('partials.logout')
                @include('partials.officerside.mcdays')

                <div class="row mt-4">
                    <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
                        <div class="card">
                            <div class="card-header pb-1 p-1">

                                <!-- MC Apply Application Section -->
                                <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                                    <h4><b>PERMOHONAN CUTI</b></h4>
                                    <!-- Breadcrumb -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="#">UTAMA</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">PERMOHONAN CUTI</li>
                                        </ol>
                                    </nav>
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
                                        <form action="{{ route('officer.mcApplication.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <select class="form-control" id="leave_type" name="leave_type" required>
                                                    <option selected disabled>--- Pilih Jenis Cuti ---</option>
                                                    @foreach($notes as $jeniscuti)
                                                        <option value="{{ $jeniscuti->title }}">{{ $jeniscuti->title }}</option>  <!-- Ensure this is the ID -->
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Document Upload Field -->
                                            <div class="col-md-12 mb-3" id="document_upload_field">
                                                <label for="document_path" class="form-label">Dokumen MC<span class="text-danger">*</span></label>
                                                <input type="file" class="form-control" id="document_path" name="document_path">
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="reason" class="form-label">Ulasan<span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
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
                        <div class="card-body ">
                            <div style="overflow-x: auto; position: relative;">
                            @if($mcApplications->isEmpty())
                               <!-- Display a message when no applications exist inside the table -->
                               <table class="table">
                                <thead style="background-color: #f0f0f0;">
                                    <tr>
                                        <th style="width: 5%; padding: 8px;">BIL</th>
                                        <th style="width: 10%;  padding: 8px; overflow-wrap:  white-space: normal;">TARIKH MULA</th>
                                        <th style="width: 10%;  padding: 8px; overflow-wrap:  white-space: normal;">TARIKH TAMAT</th>
                                        <th style="width: 30%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN</th>
                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JENIS CUTI</th>
                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">STATUS</th>
                                        <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="8" class="text-center" style="padding: 20px;">
                                            <p class="text-muted">Tiada permohonan yang dibuat</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @else
                                <table class="table">
                                    <thead style="background-color: #f0f0f0;">
                                        <tr>
                                            <th style="width: 5%;   padding: 8px;">BIL</th>
                                           <th style="width: 10%; padding: 8px; overflow-wrap: white-space: normal;">
                                                <a href="{{ route('officer.mc_application', ['sort' => 'start_date', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                                    TARIKH MULA
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
                                            <th style="width: 10%; padding: 8px; overflow-wrap: white-space: normal;">
                                                <a href="{{ route('officer.mc_application', ['sort' => 'end_date', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                                    TARIKH TAMAT
                                                    @if(request('sort') == 'end_date')
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
                                            <th style="width: 30%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                            <th style="width: 10%;  padding: 8px; overflow-wrap: white-space: normal;">DOKUMEN RUJUKAN</th>
                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JENIS CUTI</th>
                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">STATUS</th>
                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mcApplications as $index => $mcApplication)
                                            <tr>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $index + 1 }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ \Carbon\Carbon::parse($mcApplication->start_date)->format('d/m/Y') }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ \Carbon\Carbon::parse($mcApplication->end_date)->format('d/m/Y') }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $mcApplication->reason }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    @if($mcApplication->document_path)
                                                        <a href="{{ Storage::url($mcApplication->document_path) }}" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</a>
                                                    @else
                                                        <span>Tidak Ada Dokumen</span>
                                                    @endif
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <span class="badge bg-success">
                                                        {{ $selectedLeaveTypes[$mcApplication->id] ?? 'Tiada Cuti Dipilih' }}
                                                    </span>
                                                </td>
                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
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
                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    @if ($mcApplication->status === 'pending')
                                                        <!-- Edit button -->
                                                        <button class="btn btn-md btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editMcModal{{ $mcApplication->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>

                                                        <!-- Delete button -->
                                                        <form action="{{ route('officer.deleteMC', $mcApplication->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE') <!-- Spoof DELETE method -->
                                                            <button type="submit" class="btn btn-md btn-danger" onclick="return confirm('Adakah anda pasti ingin menghapus permohonan ini?');">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>

                                                        <!-- Edit MC Application Modal -->
                                                        <div class="modal fade" id="editMcModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="editMcModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                                                        <h5 class="modal-title" id="editMcModalLabel{{ $mcApplication->id }}">Kemaskini Permohonan Cuti</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('officer.mc.edit', $mcApplication->id) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="row g-3">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="start_date{{ $mcApplication->id }}" class="form-label">Tarikh Mula</label>
                                                                                    <input type="date" class="form-control" id="start_date{{ $mcApplication->id }}" name="start_date" value="{{ $mcApplication->start_date }}" required>
                                                                                </div>
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="end_date{{ $mcApplication->id }}" class="form-label">Tarikh Tamat</label>
                                                                                    <input type="date" class="form-control" id="end_date{{ $mcApplication->id }}" name="end_date" value="{{ $mcApplication->end_date }}" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="leave_type{{ $mcApplication->id }}" class="form-label">Jenis Cuti<span class="text-danger">*</span></label>
                                                                                <select class="form-control" id="leave_type{{ $mcApplication->id }}" name="leave_type" required>
                                                                                    <option selected disabled>--- Pilih Jenis Cuti ---</option>
                                                                                    @foreach($notes as $note) <!-- Fetch notes dynamically -->
                                                                                        <option value="{{ $note->title }}" {{ $mcApplication->leave_type == $note->title ? 'selected' : '' }}>
                                                                                            {{ $note->title }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="document_path{{ $mcApplication->id }}" class="form-label">Dokumen MC (biarkan kosong jika tidak mengubah)</label>
                                                                                <input type="file" class="form-control" id="document_path{{ $mcApplication->id }}" name="document_path">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="reason{{ $mcApplication->id }}" class="form-label">Sebab</label>
                                                                                <textarea class="form-control" id="reason{{ $mcApplication->id }}" name="reason" rows="3" required>{{ $mcApplication->reason }}</textarea>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif($mcApplication->status == 'rejected')
                                                        {{ $mcApplication->rejection_reason }}
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                                </table>
                                                @endif
                                                <!-- Pagination Links -->
                                                    @if($mcApplications->hasPages())
                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                        <div>
                                                            Showing {{ $mcApplications->firstItem() }} to {{ $mcApplications->lastItem() }} of {{ $mcApplications->total() }} results
                                                        </div>
                                                        <div>
                                                            {{ $mcApplications->links() }}
                                                        </div>
                                                    </div>
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
        </main>
        <!-- Closing main-content -->

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
