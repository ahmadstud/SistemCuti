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

        <!-- Viewport Settings for Responsive Design -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Icons for Apple Devices and General Favicon -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/Erawhiz.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/img/Erawhiz.png') }}">

        <!-- Page Title -->
        <title>Admin - Bahagian Senarai Staf/Pegawai</title>

        <!-- Fonts and Icons -->
        <!-- Google Fonts - Open Sans for a modern, clean typeface -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons - for additional icon options -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- Font Awesome Icons (For additional icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <!-- Main CSS Files -->
        <!-- Argon Dashboard CSS for layout and styling -->
        <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
        <!-- SweetAlert2 CSS for customizable alert modals -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- SweetAlert2 JavaScript for beautiful alert modals -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- DataTables Integration -->
        <!-- DataTables CSS for table styling -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <!-- jQuery Library - required for DataTables functionality -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <!-- DataTables JavaScript for advanced table features (search, sort, pagination) -->
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


                                <!-- Senarai Pengguna section -->
                                <div class="d-flex align-items-center justify-content-between mb-4 p-3" style="background-color: rgba(0, 0, 0, 0);">
                                    <h4 class="mb-0 text-uppercase fw-bold "><b>
                                        <i class="bi bi-speedometer2 me-2"></i> SENARAI PEKERJA </b>
                                    </h4>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-12 mb-lg-0 mb-4">
                                        <div class="container-fluid py-2">

                                            <div class="row">

                                                <div class="card">
                                                     <!-- Add Staff/Officer Button -->
                                                    <div class="card-header pb-0 p-3">
                                                        <div class="d-flex justify-content-end pe-3">
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                                                                Tambah Staf / Pegawai
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Add Staff/Officer Modal -->
                                                    <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #f0f0f0;">
                                                                    <h5 class="modal-title" id="addStaffModalLabel">Tambah Staff / Pegawai</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="addStaffForm" action="{{ route('storeUser') }}" method="POST">
                                                                        @csrf
                                                                        <div class="row g-3">
                                                                            <h5 class="mt-4">Maklumat Peribadi</h5>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="fullname" class="form-label">Nama Penuh<span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ Auth::user()->fullname }}">
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="name" class="form-label">Nama<span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" id="name" name="name" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row g-3">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="email" class="form-label">E-mel<span class="text-danger">*</span></label>
                                                                                <input type="email" class="form-control" id="email" name="email" required>
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="password" class="form-label">Kata Kunci<span class="text-danger">*</span></label>
                                                                                <input type="password" class="form-control" id="password" name="password" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row g-3">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="ic" class="form-label">No K/P<span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" id="ic" name="ic">
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="phone_number" class="form-label">No Telefon<span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" id="phone_number" name="phone_number">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row g-3">
                                                                            <h5 class="mt-4">Maklumat Pekerjaan</h5>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="role" class="form-label">Peranan<span class="text-danger">*</span></label>
                                                                                <select class="form-select" id="role" name="role" required>
                                                                                    <option selected disabled>--- Pilih Peranan ---</option>
                                                                                    <option value="admin">Admin</option>
                                                                                    <option value="staff">Staf</option>
                                                                                    <option value="officer">Pegawai</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="job_status" class="form-label">Status Pekerjaan<<span class="text-danger">*</span></label>
                                                                                <select class="form-select" id="job_status" name="job_status" required>
                                                                                    <option selected disabled>--- Pilih Status ---</option>
                                                                                    <option value="Permenant">Tetap</option>
                                                                                    <option value="Contract">Kontrak</option>
                                                                                    <option value="">Berhenti</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row g-3">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="selected_officer_id" class="form-label">Ketua Bahagian/Pegawai <span class="text-danger">*</span></label>
                                                                                <select class="form-select" id="selected_officer_id" name="selected_officer_id" required>
                                                                                    <option selected disabled>--- Pilih Ketua Bahagian ---</option>
                                                                                    @foreach($officers as $officer)
                                                                                        <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                                                                                    @endforeach
                                                                                    <option value="">Tiada Penyelia</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row g-3">
                                                                            <h5 class="mt-4">Jenis Cuti</h5>
                                                                            @foreach ($notes as $note)
                                                                                @php
                                                                                    $columnName = Str::slug($note->title, '_');
                                                                                    $noteValue = isset($user) ? $user->$columnName : ''; // Retrieve existing note value for the user
                                                                                @endphp
                                                                                <div class="col-md-3 mb-3">
                                                                                    <label for="{{ $columnName }}" class="form-label">{{ $note->title }}</label>
                                                                                    <input type="text" class="form-control" id="{{ $columnName }}" name="{{ $columnName }}" value="{{ old($columnName, $noteValue) }}">
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="row g-3">
                                                                            <h5 class="mt-4">Maklumat Kediaman</h5>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="address" class="form-label">Alamat<span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" id="address" name="address" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row g-3">
                                                                            <div class="col-md-4 mb-3">
                                                                                <label for="city" class="form-label">Bandar<span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" id="city" name="city" required>
                                                                            </div>
                                                                            <div class="col-md-4 mb-3">
                                                                                <label for="postcode" class="form-label">Poskod<span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" id="postcode" name="postcode" required>
                                                                            </div>
                                                                            <div class="col-md-4 mb-3">
                                                                                <label for="state" class="form-label">Negeri<span class="text-danger">*</span></label>
                                                                                <select class="form-select" id="state" name="state" required>
                                                                                    <option value="" disabled selected>--- Pilih Negeri ---</option>
                                                                                    <option value="Johor">Johor</option>
                                                                                    <option value="Kedah">Kedah</option>
                                                                                    <option value="Kelantan">Kelantan</option>
                                                                                    <option value="Malacca">Melaka</option>
                                                                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                                                    <option value="Pahang">Pahang</option>
                                                                                    <option value="Penang">Pulau Pinang</option>
                                                                                    <option value="Perak">Perak</option>
                                                                                    <option value="Perlis">Perlis</option>
                                                                                    <option value="Selangor">Selangor</option>
                                                                                    <option value="Terengganu">Terengganu</option>
                                                                                    <option value="Sabah">Sabah</option>
                                                                                    <option value="Sarawak">Sarawak</option>
                                                                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                                                                    <option value="Putrajaya">Putrajaya</option>
                                                                                    <option value="Labuan">Labuan</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-success" onclick="confirmSubmission()">Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- SweetAlert2 Script -->
                                                    <script>
                                                        function confirmAddStaff() {
                                                            Swal.fire({
                                                                title: 'Tambah Staff / Pegawai?',
                                                                text: "Adakah anda ingin menambah staff atau pegawai baru?",
                                                                icon: 'question',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Ya, tambah!'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    // Show the modal if confirmed
                                                                    var addStaffModal = new bootstrap.Modal(document.getElementById('addStaffModal'));
                                                                    addStaffModal.show();
                                                                }
                                                            });
                                                        }

                                                        function confirmSubmission() {
                                                            Swal.fire({
                                                                title: 'Adakah anda pasti?',
                                                                text: "Adakah anda ingin menyimpan maklumat staff / pegawai ini?",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Ya, simpan!'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    // Submit the form if confirmed
                                                                    document.getElementById('addStaffForm').submit();
                                                                }
                                                            });
                                                        }
                                                    </script>

                                                    {{-- List of staff --}}
                                                    <div class="card-body">

                                                        {{-- Carian --}}
                                                        <form action="{{ route('admin.stafflist') }}" method="GET" class="mb-3">
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
                                                                <div class="col-md-6">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="roleFilter" class="form-label">Peranan</label>
                                                                    <select class="form-select" id="roleFilter" name="role">
                                                                        <option value="">Semua Peranan</option>
                                                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                        <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staf</option>
                                                                        <option value="officer" {{ request('role') == 'officer' ? 'selected' : '' }}>Pegawai</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="jobStatusFilter" class="form-label">Status Pekerjaan</label>
                                                                    <select class="form-select" id="jobStatusFilter" name="job_status">
                                                                        <option value="">Semua Status</option>
                                                                        <option value="Permenant" {{ request('job_status') == 'Permenant' ? 'selected' : '' }}>Tetap</option>
                                                                        <option value="Contract" {{ request('job_status') == 'Contract' ? 'selected' : '' }}>Kontrak</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <label class="form-label">&nbsp;</label>
                                                                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <div style="overflow-x: auto; position: relative;">
                                                            <table class="table">
                                                                <thead style="background-color: #f0f0f0;">
                                                                    <tr>
                                                                        <th style="width: 3%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">BIL</th>
                                                                        <th style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NO TELEFON</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">PERANAN</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">KETUA BAHAGIAN</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">STATUS PEKERJAAN</th>
                                                                        <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">BAKI JUMLAH CUTI</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($users as $user)
                                                                    <tr>
                                                                        @php
                                                                            $itemsPerPage = 10; // The number of items per page as per your pagination setting
                                                                            $currentPage = $users->currentPage(); // The current page from the paginated collection
                                                                            $startingIndex = ($currentPage - 1) * $itemsPerPage;
                                                                        @endphp
                                                                        <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ $startingIndex + $loop->iteration }}</p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px;">
                                                                            <div style="display: flex; align-items: center; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                @if($user->profile_image)
                                                                                    <img src="{{ asset($user->profile_image) }}" alt="Profile Image" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 30px;">
                                                                                @else
                                                                                    <div style="width: 40px; height: 40px; background-color: black; border-radius: 50%; margin-right: 30px;"></div>
                                                                                @endif
                                                                                <div>
                                                                                    <!-- Display Fullname -->
                                                                                    <p class="text-m text-secondary"><strong>{{ $user->fullname ?? 'No Full Name' }}</strong></p> <!-- Ensure fullname is shown, fallback if not available -->
                                                                                    <p class="text-m text-secondary">{{ $user->name }}</p>
                                                                                    <p class="text-sm text-secondary">{{ $user->email }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ $user->phone_number }}</p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            @if($user->role == 'admin')
                                                                                <span class="badge badge-md bg-gradient-danger">{{ $user->role }}</span>
                                                                            @elseif($user->role == 'staff')
                                                                                <span class="badge badge-md bg-gradient-info">Staf</span>
                                                                            @elseif($user->role == 'officer')
                                                                                <span class="badge badge-md bg-gradient-warning">Pegawai</span>
                                                                            @else
                                                                                <span class="badge badge-md bg-gradient-secondary">{{ $user->role }}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">
                                                                                @if($user->officer)
                                                                                    {{ $user->officer->name }}
                                                                                @else
                                                                                    <span class="text-danger">Tiada Penyelia {{ $user->selected_officer_id }}</span>
                                                                                @endif
                                                                            </p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            @if($user->job_status == 'Permenant')
                                                                                <span class="badge badge-md bg-gradient-warning">Tetap</span>
                                                                            @elseif($user->job_status == 'Contract')
                                                                                <span class="badge badge-md bg-gradient-info">Kontrak</span>
                                                                            @else
                                                                                <span class="text-secondary">{{ $user->job_status }}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">
                                                                                @foreach ($notes as $note)
                                                                                @php
                                                                                    $columnName = Str::slug($note->title, '_');
                                                                                @endphp
                                                                                <strong>{{ $note->title }}: </strong> {{ $user->$columnName ?? '0' }} Hari <br>
                                                                                @endforeach
                                                                            </p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <div class="d-flex justify-content-start">

                                                                                <!-- Edit Button -->
                                                                                <button type="button" class="btn btn-md btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                                                                    <i class="fas fa-pencil-alt"></i>
                                                                                </button>
                                                                                <!-- Delete button -->
                                                                                <form action="{{ route('deleteUser', $user->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $user->id }}">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="button" class="btn btn-md btn-danger" title="Delete" onclick="confirmDelete({{ $user->id }})">
                                                                                        <i class="fas fa-trash-alt"></i> <!-- Delete symbol -->
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </td>

                                                                            <!-- Edit User Modal -->
                                                                            <div 
                                                                                class="modal fade" 
                                                                                id="editModal{{ $user->id }}" 
                                                                                tabindex="-1" 
                                                                                aria-labelledby="editModalLabel{{ $user->id }}" 
                                                                                aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <!-- Modal Header -->
                                                                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                                                                        <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Kemaskini Maklumat - {{ $user->name }}</h5>
                                                                                        <button 
                                                                                            type="button" 
                                                                                            class="btn-close" 
                                                                                            data-bs-dismiss="modal" 
                                                                                            aria-label="Close"></button>
                                                                                    </div>

                                                                                        <!-- Modal Body -->
                                                                                        <div class="modal-body">
                                                                                            <form id="edit-form-{{ $user->id }}" action="{{ route('updateUser', $user->id) }}" method="POST">
                                                                                                @csrf
                                                                                                <div class="row g-3">
                                                                                                    <h5 class="mt-4">Maklumat Diri</h5>
                                                                                                    <div class="col-md-12 mb-3">
                                                                                                        <label for="fullname{{ $user->id }}" class="form-label">Nama Penuh</label>
                                                                                                        <input type="text" class="form-control" id="fullname{{ $user->id }}" name="fullname" value="{{ $user->fullname }}" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row g-3">
                                                                                                    <div class="col-md-6 mb-3">
                                                                                                        <label for="name{{ $user->id }}" class="form-label">Nama</label>
                                                                                                        <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                                                                                    </div>
                                                                                                    <div class="col-md-6 mb-3">
                                                                                                        <label for="email{{ $user->id }}" class="form-label">E-mel</label>
                                                                                                        <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row g-3">
                                                                                                    <div class="col-md-6 mb-3">
                                                                                                        <label for="ic{{ $user->id }}" class="form-label">No K/P</label>
                                                                                                        <input type="text" class="form-control" id="ic{{ $user->id }}" name="ic" value="{{ $user->ic }}">
                                                                                                    </div>
                                                                                                    <div class="col-md-6 mb-3">
                                                                                                        <label for="phone_number{{ $user->id }}" class="form-label">No Telefon</label>
                                                                                                        <input type="text" class="form-control" id="phone_number{{ $user->id }}" name="phone_number" value="{{ $user->phone_number }}">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row g-3">
                                                                                                    <h5 class="mt-4">Maklumat Pekerjaan</h5>
                                                                                                    <div class="col-md-6 mb-3">
                                                                                                        <label for="role{{ $user->id }}" class="form-label">Peranan</label>
                                                                                                        <select class="form-select" id="role{{ $user->id }}" name="role">
                                                                                                            <option selected disabled>--- Pilih Peranan ---</option>
                                                                                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                                                            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staf</option>
                                                                                                            <option value="officer" {{ $user->role == 'officer' ? 'selected' : '' }}>Pegawai</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-md-6 mb-3">
                                                                                                        <label for="job_status{{ $user->id }}" class="form-label">Status Pekerjaan</label>
                                                                                                        <select class="form-select" id="job_status{{ $user->id }}" name="job_status" required>
                                                                                                            <option selected disabled>--- Pilih Status Pekerjaan ---</option>
                                                                                                            <option value="Permenant" {{ $user->job_status == 'Permenant' ? 'selected' : '' }}>Tetap</option>
                                                                                                            <option value="Contract" {{ $user->job_status == 'Contract' ? 'selected' : '' }}>Kontrak</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-md-6 mb-3">
                                                                                                        <label for="selected_officer_id" class="form-label">Ketua Bahagian/Pegawai</label>
                                                                                                        <select class="form-select" id="selected_officer_id" name="selected_officer_id">
                                                                                                            <option value="">--- Tiada Penyelia ---</option>
                                                                                                            @foreach($officers as $officer)
                                                                                                                <option value="{{ $officer->id }}" {{ $user->selected_officer_id == $officer->id ? 'selected' : '' }}>
                                                                                                                    {{ $officer->name }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row g-3">
                                                                                                    <h5 class="mt-4">Jenis Cuti</h5>
                                                                                                    @foreach ($notes as $note)
                                                                                                        @php
                                                                                                            $columnName = Str::slug($note->title, '_');
                                                                                                        @endphp
                                                                                                        <div class="col-md-3 mb-3">
                                                                                                            <label for="{{ $columnName }}" class="form-label">{{ $note->title }}</label>
                                                                                                            <input type="text" class="form-control" id="{{ $columnName }}" name="{{ $columnName }}" value="{{ old($columnName, $user->$columnName ?? '') }}">
                                                                                                        </div>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                                <div class="row g-3">
                                                                                                    <h5 class="mt-4">Maklumat Kediaman</h5>
                                                                                                    <div class="col-md-12 mb-3">
                                                                                                        <label for="address{{ $user->id }}" class="form-label">Alamat</label>
                                                                                                        <input type="text" class="form-control" id="address{{ $user->id }}" name="address" value="{{ $user->address }}" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row g-3">
                                                                                                    <div class="col-md-4 mb-3">
                                                                                                        <label for="city{{ $user->id }}" class="form-label">Bandar</label>
                                                                                                        <input type="text" class="form-control" id="city{{ $user->id }}" name="city" value="{{ $user->city }}" required>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 mb-3">
                                                                                                        <label for="postcode{{ $user->id }}" class="form-label">Poskod</label>
                                                                                                        <input type="text"  class="form-control" id="postcode{{ $user->id }}" name="postcode" value="{{ $user->postcode }}" required>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 mb-3">
                                                                                                        <label for="state{{ $user->id }}" class="form-label">Negeri</label>
                                                                                                        <select class="form-select" id="state{{ $user->id }}" name="state" required>
                                                                                                            <option value="" disabled selected>Pilih Negeri</option>
                                                                                                            <option value="Johor" {{ $user->state == 'Johor' ? 'selected' : '' }}>Johor</option>
                                                                                                            <option value="Kedah" {{ $user->state == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                                                                                                            <option value="Kelantan" {{ $user->state == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                                                                                                            <option value="Melaka" {{ $user->state == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                                                                                                            <option value="Negeri Sembilan" {{ $user->state == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                                                                                                            <option value="Pahang" {{ $user->state == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                                                                                                            <option value="Pulau Pinang" {{ $user->state == 'Pulau Pinang' ? 'selected' : '' }}>Pulau Pinang</option>
                                                                                                            <option value="Perak" {{ $user->state == 'Perak' ? 'selected' : '' }}>Perak</option>
                                                                                                            <option value="Perlis" {{ $user->state == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                                                                                                            <option value="Selangor" {{ $user->state == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                                                                                                            <option value="Terengganu" {{ $user->state == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                                                                                                            <option value="Sabah" {{ $user->state == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                                                                                                            <option value="Sarawak" {{ $user->state == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                                                                                                            <option value="Kuala Lumpur" {{ $user->state == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
                                                                                                            <option value="Putrajaya" {{ $user->state == 'Putrajaya' ? 'selected' : '' }}>Putrajaya</option>
                                                                                                            <option value="Labuan" {{ $user->state == 'Labuan' ? 'selected' : '' }}>Labuan</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="button" class="btn btn-success" onclick="confirmEditSubmit({{ $user->id }})">Simpan</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <script>
                                                                                // Function to confirm edit submission
                                                                                function confirmEditSubmit(announcementId) {
                                                                                    Swal.fire({
                                                                                        title: 'Adakah anda pasti?',
                                                                                        text: "Adakah anda ingin menyimpan perubahan ini?",
                                                                                        icon: 'warning',
                                                                                        showCancelButton: true,
                                                                                        confirmButtonColor: '#3085d6',
                                                                                        cancelButtonColor: '#d33',
                                                                                        confirmButtonText: 'Ya, simpan!'
                                                                                    }).then((result) => {
                                                                                        if (result.isConfirmed) {
                                                                                            // Submit the edit form after confirmation
                                                                                            document.getElementById('edit-form-' + announcementId).submit();
                                                                                        }
                                                                                    });
                                                                                }
                                                                            </script>

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


                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        {{-- Pagination Links --}}
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end align-items-center">
                                                            <div>
                                                                {{ $users->links('vendor.pagination.bootstrap-5') }} <!-- Add pagination links -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> <!-- Closing for col-lg-12 -->
                                </div> <!-- Closing for row -->

                            </div> <!-- Closing for col-lg-12 -->
                        </div> <!-- Closing for row -->
                    </div> <!-- Closing for col-lg-12 -->
                </div> <!-- Closing for row -->

            </div> <!-- Closing for col-lg-12 -->
        </main>


        <!-- Core JavaScript Files -->

        <!-- Popper.js - Required for Bootstrap's dropdowns, tooltips, and popovers -->
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>

        <!-- Bootstrap JS - Core framework for responsive design and component functionality -->
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

        <!-- Perfect Scrollbar - Smooth scrolling for content within fixed-height containers -->
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>

        <!-- Smooth Scrollbar - Enables smooth scrolling for improved user experience -->
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

        <!-- Chart.js - Library for creating responsive, animated charts -->
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

        <!-- SweetAlert JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Application-Specific JavaScript - Main script file for additional app logic -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Argon Dashboard JS - Core dashboard JavaScript with predefined plugins and functions -->
        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

        <!-- SweetAlert2 - JavaScript library for customizable, modern alert modals -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>
</html>

