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
        <!-- Character Encoding -->
        <meta charset="utf-8" />

        <!-- Responsive Viewport - Ensures proper scaling on all devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Favicon - Icons for different device sizes -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/Erawhiz.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/img/Erawhiz.png') }}">

        <!-- Page Title -->
        <title>Admin - Bahagian Keseluruhan Permohonan</title>

        <!-- Fonts and Icons -->
        <!-- Google Fonts - Open Sans for consistent font styling -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

        <!-- Nucleo Icons - Icon set used within the Argon Dashboard -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

      <!-- Font Awesome Icons (For additional icons) -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <!-- Main CSS File for Argon Dashboard -->
        <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

        <!-- SweetAlert2 CSS - Styling for customizable alert modals -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- SweetAlert2 Script - JavaScript library for modern alert popups -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- DataTables Library -->
        <!-- DataTables CSS - Table styling for enhanced table interactions -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <!-- Buttons Extension CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <!-- Buttons Extension JS -->
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <!-- PDFMake for PDF export -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/vfs_fonts.js"></script>
        <!-- Buttons Extensions for HTML5 export -->
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>



        <!-- jQuery - Required for DataTables functionality -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <!-- DataTables Script - Adds interactive features like sorting and pagination to tables -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

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


                                <!-- Senarai Permohonan Semua (Staf dan Pegawai) -->
                                <div class="d-flex align-items-center justify-content-between mb-4 p-3" style="background-color: rgba(0, 0, 0, 0);">
                                    <h4 class="mb-0 text-uppercase fw-bold "><b>
                                        <i class="bi bi-speedometer2 me-2"></i> SENARAI KESELURUHAN PERMOHONAN</b>
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
                                                            <h6 class="mb-2"></h6>
                                                        </div>
                                                    </div>

                                                    <!-- View Applications Section -->
                                                    <div class="card-body">

                                                       {{-- PDF Generation Button --}}
                                                        <div class="text-end">
                                                            <div class="buttons">
                                                                <a href="{{ route('admin.mcAllApplyPdf') }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i>  Generate PDF</a>
                                                                <a href="{{ route('admin.mcAllApplyExcel') }}" class="btn btn-success"><i class="fas fa-file-excel"></i>  Generate Excel</a>
                                                            </div>

                                                        </div>


                                                        {{-- Carian --}}
                                                        <form method="GET" action="{{ route('admin.mcAllApply') }}" class="mb-3">

                                                            <div class="row g-3">
                                                                <div class="col-md-1">
                                                                    <label for="per_page">Halaman</label>
                                                                    <select name="per_page" id="per_page" class="form-control" onchange="this.form.submit()">
                                                                        <option value="">Semua</option>
                                                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                                                        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="roleFilter" class="form-label">Jawatan</label>
                                                                    <select name="role" id="roleFilter" class="form-select">
                                                                        <option value="" {{ request('role') == '' ? 'selected' : '' }}>Semua Jawatan</option>
                                                                        <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staf</option>
                                                                        <option value="officer" {{ request('role') == 'officer' ? 'selected' : '' }}>Pegawai</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="leave_typeFilter" class="form-label">Jenis Cuti</label>
                                                                    <select name="leave_type" id="leave_typeFilter" class="form-select">
                                                                        <option value="">Semua Cuti</option>
                                                                        @foreach ($notes as $note)
                                                                        <option value="{{ $note->title }}">{{ $note->title }}</option>
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="statusFilter" class="form-label">Status</label>
                                                                    <select name="status" id="statusFilter" class="form-select">
                                                                        <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
                                                                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Lulus</option>
                                                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Gagal</option>
                                                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="monthFilter" class="form-label">Bulan</label>
                                                                    <select name="month" id="monthFilter" class="form-select">
                                                                        <option value="" {{ request('month') == '' ? 'selected' : '' }}>Semua Bulan</option>
                                                                        <option value="01" {{ request('month') == '01' ? 'selected' : '' }}>Januari</option>
                                                                        <option value="02" {{ request('month') == '02' ? 'selected' : '' }}>Februari</option>
                                                                        <option value="03" {{ request('month') == '03' ? 'selected' : '' }}>Mac</option>
                                                                        <option value="04" {{ request('month') == '04' ? 'selected' : '' }}>April</option>
                                                                        <option value="05" {{ request('month') == '05' ? 'selected' : '' }}>Mei</option>
                                                                        <option value="06" {{ request('month') == '06' ? 'selected' : '' }}>Jun</option>
                                                                        <option value="07" {{ request('month') == '07' ? 'selected' : '' }}>Julai</option>
                                                                        <option value="08" {{ request('month') == '08' ? 'selected' : '' }}>Ogos</option>
                                                                        <option value="09" {{ request('month') == '09' ? 'selected' : '' }}>September</option>
                                                                        <option value="10" {{ request('month') == '10' ? 'selected' : '' }}>Oktober</option>
                                                                        <option value="11" {{ request('month') == '11' ? 'selected' : '' }}>November</option>
                                                                        <option value="12" {{ request('month') == '12' ? 'selected' : '' }}>Disember</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <label for="yearFilter" class="form-label">Tahun</label>
                                                                    <select name="year" id="yearFilter" class="form-select">
                                                                        <option value="" {{ request('year') == '' ? 'selected' : '' }}>Semua Tahun</option>
                                                                        <option value="2023" {{ request('year') == '2023' ? 'selected' : '' }}>2023</option>
                                                                        <option value="2024" {{ request('year') == '2024' ? 'selected' : '' }}>2024</option>
                                                                        <option value="2025" {{ request('year') == '2025' ? 'selected' : '' }}>2025</option>
                                                                        <!-- Add more years as needed -->
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <label class="form-label">&nbsp;</label>
                                                                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                                                                </div>
                                                            </div>


                                                        </form>

                                                        {{-- Table --}}
                                                        <div style="overflow-x: auto; position: relative;">
                                                            <table class="table">
                                                                <thead style="background-color: #f0f0f0;">
                                                                    <tr>
                                                                        <th style="width: 5%;   padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">BIL</th>
                                                                        <th style="width: 8%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                                                        <th style="width: 8%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JAWATAN</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JENIS CUTI</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH </th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JUMLAH HARI</th>
                                                                        <th style="width: 16%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                                                        <th style="width: 13%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                                                        <th style="width: 12%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">STATUS</th>
                                                                        <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $itemsPerPage = $allApplications->perPage() ?? 10; // Use perPage() if it's a paginated object
                                                                        $currentPage = $allApplications->currentPage() ?? 1; // Default to 1 if not paginated
                                                                        $startingIndex = ($currentPage - 1) * $itemsPerPage;
                                                                    @endphp
                                                                    @foreach($allApplications as $index => $application)
                                                                        <tr>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $startingIndex + $loop->iteration }}</p>
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
                                                                                <span class="badge bg-success">
                                                                                    {{ $selectedLeaveTypes[$application->id] ?? 'Tiada Cuti Dipilih' }}
                                                                                </span>
                                                                            </td>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary"><b>{{ \Carbon\Carbon::parse($application->start_date)->format('d/m/Y') }} </b> sehingga <b> {{ \Carbon\Carbon::parse($application->end_date)->format('d/m/Y') }} </b></p>

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
                                                                                {!! $application->reason ?? '<p class="text-m text-secondary">Tiada ulasan</p>' !!}
                                                                            </td> 
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">
                                                                                    @if($application->document_path)
                                                                                        <a href="{{ asset('storage/' . $application->document_path) }}" target="_blank"><i class="fas fa-file-pdf text-lg me-1 text-primary "></i> PDF</a>
                                                                                    @else
                                                                                        <span class="text-danger">Tiada Dokumen</span>
                                                                                    @endif
                                                                                </p>
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
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <form id="delete-form-{{ $application->id }}" action="{{ route('applications.delete', $application->id) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $application->id }})">
                                                                                        <i class="fas fa-trash-alt"></i>
                                                                                    </button>
                                                                                </form>

                                                                                <script>
                                                                                    function confirmDelete(id) {
                                                                                        Swal.fire({
                                                                                            title: 'Adakah anda pasti?',
                                                                                            text: "Anda tidak akan dapat memulihkan ini!",
                                                                                            icon: 'warning',
                                                                                            showCancelButton: true,
                                                                                            confirmButtonColor: '#3085d6',
                                                                                            cancelButtonColor: '#d33',
                                                                                            confirmButtonText: 'Ya, padamkan!',
                                                                                            cancelButtonText: 'Batal'
                                                                                        }).then((result) => {
                                                                                            if (result.isConfirmed) {
                                                                                                document.getElementById('delete-form-' + id).submit();
                                                                                            }
                                                                                        })
                                                                                    }
                                                                                </script>

                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        $('#dataTable').DataTable({
                                                                                            dom: 'Bfrtip',
                                                                                            buttons: [
                                                                                                'copy', 'csv', 'excel', 'pdf', 'print'
                                                                                            ]
                                                                                        });
                                                                                    });
                                                                                </script>


                                                                                @if(session('success'))
                                                                                <script>
                                                                                    Swal.fire({
                                                                                        icon: 'success',
                                                                                        title: 'Berjaya',
                                                                                        text: '{{ session('success') }}',
                                                                                    });
                                                                                </script>
                                                                                @endif

                                                                                @if(session('error'))
                                                                                <script>
                                                                                    Swal.fire({
                                                                                        icon: 'error',
                                                                                        title: 'Oops...',
                                                                                        text: '{{ session('error') }}',
                                                                                    });
                                                                                </script>
                                                                                @endif


                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>

                                                            </table>

                                                        </div>

                                                       <!-- Pagination Section -->
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <div>
                                                                Showing {{ $allApplications->firstItem() }} to {{ $allApplications->lastItem() }} of {{ $allApplications->total() }} results
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end align-items-center">
                                                            <div>
                                                                {{ $allApplications->links('vendor.pagination.bootstrap-5') }}
                                                                <!-- Laravel's built-in pagination links -->
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

            </div>
        </main>

        <!-- Core JS Files -->
        <!-- Popper.js - Required for Bootstrap tooltips and popovers -->
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>

        <!-- Bootstrap JS - Core JavaScript library for Bootstrap components -->
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

        <!-- Perfect Scrollbar - Customizes scrollbars for better UX -->
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>

        <!-- Smooth Scrollbar - Enhances scrolling experience on supported devices -->
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

        <!-- Chart.js - Library for creating interactive charts and graphs -->
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

        <!-- Custom App.js - Main JavaScript file for application-specific functionality -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Argon Dashboard Main JS - Provides dashboard-specific functionality and theme integration -->
        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

        <!-- SweetAlert2 - JavaScript library for creating modern, customizable alert popups -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    </body>
</html>
