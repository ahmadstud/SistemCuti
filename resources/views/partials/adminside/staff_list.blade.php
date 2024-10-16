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


                                <!-- Senarai Pengguna section -->
                                <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                                <h4><b>SENARAI PEKERJA<b></h4>
                                </nav>

                                <div class="row mt-4">
                                    <div class="col-lg-12 mb-lg-0 mb-4">
                                        <div class="container-fluid py-2">
                                            <div class="row">

                                                <!-- List of Staff -->
                                                <div class="card">
                                                    <div class="card-header pb-0 p-3">

                                                        <div class="d-flex justify-content-between">
                                                            <h6 class="mb-2"></h6>

                                                            <!-- Add Staff/Officer Button -->
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                                                                Tambah Staff / Pegawai
                                                            </button>

                                                            <!-- Add Staff/Officer Modal -->
                                                            <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color: #f0f0f0;">
                                                                            <h5 class="modal-title" id="addStaffModalLabel">Tambah Staff / Pegawai</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('storeUser') }}" method="POST">
                                                                                @csrf

                                                                                <div class="row g-3">
                                                                                    <div class="col-md-12 mb-3">
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
                                                                                <hr>

                                                                                <div class="row g-3">
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
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="total_annual" class="form-label">Jumlah Cuti Tahunan<span class="text-danger">*</span></label>
                                                                                        <input type="number" class="form-control" id="total_annual" name="total_annual" required min="1">
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="mc_days" class="form-label">Jumlah Cuti Sakit<span class="text-danger">*</span></label>
                                                                                        <input type="number" class="form-control" id="mc_days" name="mc_days" required min="1">
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="total_others" class="form-label">Jumlah Cuti lain-lain<span class="text-danger">*</span></label>
                                                                                        <input type="number" class="form-control" id="total_others" name="total_others" required min="1">
                                                                                    </div>
                                                                                    <p class="text-muted">
                                                                                        <em>Nota: Cuti sakit dan cuti tahunan adalah berbeza. Cuti sakit memerlukan sijil cuti sakit (MC), manakala cuti tahunan adalah cuti berbayar yang diperoleh setelah bekerja selama 12 bulan.</em>
                                                                                    </p>
                                                                                </div>
                                                                                <hr>

                                                                                <div class="row g-3">
                                                                                    <div class="col-md-12 mb-3">
                                                                                        <label for="address" class="form-label">Alamat<span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control" id="address" name="address" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="city" class="form-label">Bandar<span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control" id="city" name="city" required>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="postcode" class="form-label">Poskod<span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control" id="postcode" name="postcode" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="state" class="form-label">Negeri<span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control" id="state" name="state" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- List of staff --}}
                                                    <div class="card-body">

                                                        <form action="" method="GET" class="mb-3">
                                                            <div class="row g-3">
                                                                <div class="col-md-4">
                                                                    <label for="roleFilter" class="form-label">Peranan</label>
                                                                    <select class="form-select" id="roleFilter" name="role">
                                                                        <option value="">Semua Peranan</option>
                                                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                        <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staf</option>
                                                                        <option value="officer" {{ request('role') == 'officer' ? 'selected' : '' }}>Pegawai</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="jobStatusFilter" class="form-label">Status Pekerjaan</label>
                                                                    <select class="form-select" id="jobStatusFilter" name="job_status">
                                                                        <option value="">Semua Status</option>
                                                                        <option value="Permenant" {{ request('job_status') == 'Permenant' ? 'selected' : '' }}>Tetap</option>
                                                                        <option value="Contract" {{ request('job_status') == 'Contract' ? 'selected' : '' }}>Kontrak</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">&nbsp;</label>
                                                                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <div style="overflow-x: auto; position: relative;">
                                                            <table class="table" style="table-layout: fixed; width: 100%;">
                                                                <thead style="background-color: #f0f0f0;">
                                                                    <tr>
                                                                        <th style="width: 3%; position: sticky; left: 0; z-index: 1;  padding: 8px;">BIL</th>
                                                                        <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                                                        {{-- <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NO K/P</th> --}}
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NO TELEFON</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">PERANAN</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">KETUA BAHAGIAN</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">STATUS PEKERJAAN</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">BAKI JUMLAH CUTI</th>
                                                                        <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TIDAKAN</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($users as $user)
                                                                        <tr>
                                                                            <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                                            </td>
                                                                            <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $user->name }}</p>
                                                                                <p class="text-sm text-secondary">{{ $user->email }}</p>
                                                                            </td>
                                                                            {{-- <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                                <p class="text-m text-secondary">{{ $user->ic }}</p>
                                                                            </td> --}}
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
                                                                                <p class="text-m text-secondary">    {{ $user->officer ? $user->officer->name : 'Tiada Penyelia' }}</p>
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
                                                                                <p class="text-m text-secondary">Tahunan/MC: <br> {{ $user->total_mc_days }} Hari</p>
                                                                            </td>
                                                                            <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">

                                                                                <!-- Edit Button -->
                                                                                <button class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                                                                    <i class="fas fa-pencil-alt"></i>
                                                                                </button>

                                                                                <!-- Edit User Modal -->
                                                                                <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header" style="background-color: #f0f0f0;">
                                                                                                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User - {{ $user->name }}</h5>
                                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <form action="{{ route('updateUser', $user->id) }}" method="POST">
                                                                                                    @csrf

                                                                                                    <div class="row g-3">
                                                                                                        <div class="col-md-12 mb-3">
                                                                                                            <label for="name{{ $user->id }}" class="form-label">Nama</label>
                                                                                                            <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row g-3">
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
                                                                                                    <hr>
                                                                                                    <div class="row g-3">
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
                                                                                                    </div>
                                                                                                    <div class="row g-3">
                                                                                                        <div class="col-md-6 mb-3">
                                                                                                            <label for="selected_officer_id" class="form-label">Ketua Bahagian/Pegawai</label>
                                                                                                            <select class="form-select" id="selected_officer_id" name="selected_officer_id" required>
                                                                                                                <option selected disabled>--- Tiada Penyelia ---</option>
                                                                                                                @foreach($officers as $officer)
                                                                                                                <option value="{{ $officer->id }}" {{ $user->selected_officer_id == $officer->id ? 'selected' : '' }}>
                                                                                                                    {{ $officer->name }}
                                                                                                                </option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row g-3">
                                                                                                        <div class="col-md-4 mb-3">
                                                                                                            <label for="total_mc_days{{ $user->id }}" class="form-label">Jumlah MC</label>
                                                                                                            <input type="number" class="form-control" id="total_mc_days{{ $user->id }}" name="total_mc_days" value="{{ $user->total_mc_days }}" required min="0">
                                                                                                        </div>
                                                                                                        <div class="col-md-4 mb-3">
                                                                                                            <label for="total_annual{{ $user->id }}" class="form-label">Jumlah Cuti Tahunan</label>
                                                                                                            <input type="number" class="form-control" id="total_annual{{ $user->id }}" name="total_annual" value="{{ $user->total_annual }}" required min="0">
                                                                                                        </div>
                                                                                                        <div class="col-md-4 mb-3">
                                                                                                            <label for="total_others{{ $user->id }}" class="form-label">Jumlah Cuti Lain</label>
                                                                                                            <input type="number" class="form-control" id="total_others{{ $user->id }}" name="total_others" value="{{ $user->total_others }}" required min="0">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <hr>
                                                                                                    <div class="row g-3">
                                                                                                        <div class="col-md-12 mb-3">
                                                                                                            <label for="address{{ $user->id }}" class="form-label">Address</label>
                                                                                                            <input type="text" class="form-control" id="address{{ $user->id }}" name="address" value="{{ $user->address }}" required>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row g-3">
                                                                                                        <div class="col-md-6 mb-3">
                                                                                                            <label for="city{{ $user->id }}" class="form-label">City</label>
                                                                                                            <input type="text" class="form-control" id="city{{ $user->id }}" name="city" value="{{ $user->city }}" required>
                                                                                                        </div>
                                                                                                        <div class="col-md-6 mb-3">
                                                                                                            <label for="postcode{{ $user->id }}" class="form-label">Postcode</label>
                                                                                                            <input type="text" class="form-control" id="postcode{{ $user->id }}" name="postcode" value="{{ $user->postcode }}" required>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row g-3">
                                                                                                        <div class="col-md-6 mb-3">
                                                                                                            <label for="state{{ $user->id }}" class="form-label">State</label>
                                                                                                            <input type="text" class="form-control" id="state{{ $user->id }}" name="state" value="{{ $user->state }}" required>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="modal-footer">
                                                                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                                <!-- Delete button -->
                                                                                <form action="{{ route('deleteUser', $user->id) }}" method="POST" style="display:inline;">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="btn btn-md btn-danger" title="Delete">
                                                                                        <i class="fas fa-trash-alt"></i> <!-- Delete symbol -->
                                                                                    </button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>

                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div> <!-- Closing for card -->
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

