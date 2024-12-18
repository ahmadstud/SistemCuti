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
            Admin - Bahagian Profil Pengguna
        </title>

        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
       <!-- Font Awesome Icons (For additional icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
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


                                <!-- Profile Section -->
                                <div class="d-flex align-items-center justify-content-between mb-4 p-3" style="background-color: rgba(0, 0, 0, 0);">
                                    <h4 class="mb-0 text-uppercase fw-bold "><b>
                                        <i class="bi bi-speedometer2 me-2"></i> PROFIL PEKERJA </b>
                                    </h4>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-12 mb-lg-0 mb-4">
                                        <div class="container-fluid py-2">
                                            <div class="row">

                                                <!-- Profile Card -->
                                                <div class="card">
                                                    <div class="card-header pb-0 p-3">
                                                        <div class="d-flex justify-content-between">
                                                            <h4 class="mb-2"></h4>

                                                            <!-- Edit Profile Button -->
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editStaffProfil">
                                                                Kemaskini Maklumat
                                                            </button>
                                                            <!-- Edit maklumat -->
                                                            {{-- <a href="{{ route('admin.editProfile') }}" class="btn btn-primary" title="Edit Profile">
                                                                Kemaskini Maklumat
                                                            </a> --}}
                                                        </div>
                                                    </div>

                                                    <!-- Edit Profile Modal -->
                                                    <div class="modal fade" id="editStaffProfil" tabindex="-1" aria-labelledby="editStaffProfilLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #f0f0f0;">
                                                                    <h5 class="modal-title" id="editStaffProfilLabel">KEMASKINI MAKLUMAT</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('updateOwnDetails') }}"  method="POST" enctype="multipart/form-data">
                                                                        @csrf

                                                                        <!-- Profile Image Upload -->
                                                                        <h5 class="mt-4">MAKLUMAT DIRI</h5>
                                                                        <div class="mb-3">
                                                                            <label for="profile_image" class="form-label">Muat Naik Gambar Profil</label>
                                                                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                                                                        </div>

                                                                        <!-- Profile Information -->
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-12">
                                                                                <label for="ic" class="form-label">NAMA PENUH</label>
                                                                                <input type="text" class="form-control" id="ic" name="ic" value="{{ Auth::user()->fullname }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="name" class="form-label">NAMA</label>
                                                                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="email" class="form-label">EMEL</label>
                                                                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-6">
                                                                                <label for="ic" class="form-label">NO K/P</label>
                                                                                <input type="text" class="form-control" id="ic" name="ic" value="{{ Auth::user()->ic }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="phone_number" class="form-label">NO TELEFON</label>
                                                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Address -->
                                                                        <h5 class="mt-4">MAKLUMAT TEMPAT TINGGAL</h5>
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-12">
                                                                                <label for="address" class="form-label">ALAMAT</label>
                                                                                <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-4">
                                                                                <label for="postcode" class="form-label">POSKOD</label>
                                                                                <input type="text" class="form-control" id="postcode" name="postcode" value="{{ Auth::user()->postcode }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label for="city" class="form-label">BANDAR</label>
                                                                                <input type="text" class="form-control" id="city" name="city" value="{{ Auth::user()->city }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label for="state" class="form-label">NEGERI</label>
                                                                                <select class="form-control" id="state" name="state">
                                                                                    <option value="">-- Pilih Negeri --</option>
                                                                                    <option value="Johor" {{ Auth::user()->state == 'Johor' ? 'selected' : '' }}>Johor</option>
                                                                                    <option value="Kedah" {{ Auth::user()->state == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                                                                                    <option value="Kelantan" {{ Auth::user()->state == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                                                                                    <option value="Melaka" {{ Auth::user()->state == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                                                                                    <option value="Negeri Sembilan" {{ Auth::user()->state == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                                                                                    <option value="Pahang" {{ Auth::user()->state == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                                                                                    <option value="Perak" {{ Auth::user()->state == 'Perak' ? 'selected' : '' }}>Perak</option>
                                                                                    <option value="Perlis" {{ Auth::user()->state == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                                                                                    <option value="Pulau Pinang" {{ Auth::user()->state == 'Pulau Pinang' ? 'selected' : '' }}>Pulau Pinang</option>
                                                                                    <option value="Sabah" {{ Auth::user()->state == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                                                                                    <option value="Sarawak" {{ Auth::user()->state == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                                                                                    <option value="Selangor" {{ Auth::user()->state == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                                                                                    <option value="Terengganu" {{ Auth::user()->state == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                                                                                    <option value="Wilayah Persekutuan Kuala Lumpur" {{ Auth::user()->state == 'Wilayah Persekutuan Kuala Lumpur' ? 'selected' : '' }}>Wilayah Persekutuan Kuala Lumpur</option>
                                                                                    <option value="Wilayah Persekutuan Labuan" {{ Auth::user()->state == 'Wilayah Persekutuan Labuan' ? 'selected' : '' }}>Wilayah Persekutuan Labuan</option>
                                                                                    <option value="Wilayah Persekutuan Putrajaya" {{ Auth::user()->state == 'Wilayah Persekutuan Putrajaya' ? 'selected' : '' }}>Wilayah Persekutuan Putrajaya</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        {{-- Pekerjaan --}}
                                                                        <h5 class="mt-4">MAKLUMAT PEKERJAAN</h5>
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-4">
                                                                                {{-- <p class="form-control" id="role">{{ Auth::user()->role }}</p> --}}
                                                                                <label for="role{{ Auth::user()->role }}" class="form-label">PERANAN</label>
                                                                                <select class="form-select" id="role{{ Auth::user()->role }}" name="role">
                                                                                    <option selected disabled>--- Pilih Peranan ---</option>
                                                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staf</option>
                                                                                    <option value="officer" {{ $user->role == 'officer' ? 'selected' : '' }}>Pegawai</option>
                                                                                </select>
                                                                            </div>


                                                                            <div class="col-md-4">
                                                                                {{-- <p class="form-control" id="role">{{ Auth::user()->job_status }}</p> --}}
                                                                                <label for="job_status{{ Auth::user()->job_status }}" class="form-label">Status Pekerjaan</label>
                                                                                <select class="form-select" id="job_status{{ Auth::user()->job_status }}" name="job_status" required>
                                                                                    <option selected disabled>--- Pilih Pekerjaan ---</option>
                                                                                    <option value="Permenant" {{ $user->job_status == 'Permenant' ? 'selected' : '' }}>Tetap</option>
                                                                                    <option value="Contract" {{ $user->job_status == 'Contract' ? 'selected' : '' }}>Kontrak</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                {{-- <p class="form-control" id="role">{{ Auth::user()->role }}</p> --}}
                                                                                <label for="pegawai" class="form-label">KETUA BAHAGIAN</label>
                                                                                <select class="form-select" id="pegawai" name="pegawai" required>
                                                                                    <option selected disabled>--- Pilih Ketua Bahagian ---</option>
                                                                                    <option value="Ketua 1 / Pegawai 1">Ketua 1 / Pegawai 1</option>
                                                                                    <option value="Ketua 2 / Pegawai 2">Ketua 2 / Pegawai 2</option>
                                                                                    <option value="Tiada Berkenaan">Tiada Berkenaan</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-4">
                                                                                <label for="mc_days" class="form-label">JUMLAH CUTI</label>
                                                                                <input type="text" class="form-control" id="mc_days" value="{{ Auth::user()->total_mc_days }}" readonly>
                                                                            </div>
                                                                        </div>

                                                                        <br>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- View Profile Section -->
                                                    <div class="card-body">

                                                        <!-- Profile Image and Full Name -->
                                                        <div class="row align-items-center mt-3">
                                                            <div class="col-md-10">
                                                                <label for="fullname" class="form-label">NAMA PENUH</label>
                                                                <p class="form-control" id="fullname">{{ Auth::user()->fullname }}</p>
                                                            </div>
                                                            <div class="col-md-2 text-center">
                                                                @if(Auth::user()->profile_image)
                                                                    <img src="{{ asset('' . Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                                                                @else
                                                                    <img src="{{ asset('storage/profile_image/default.jpg') }}" alt="Default Profile Image" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <!-- Name and Email -->
                                                        <div class="row mt-3">
                                                            <div class="col-md-6">
                                                                <label for="name" class="form-label">NAMA</label>
                                                                <p class="form-control" id="name">{{ Auth::user()->name }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="email" class="form-label">EMEL</label>
                                                                <p class="form-control" id="email">{{ Auth::user()->email }}</p>
                                                            </div>
                                                        </div>

                                                        <!-- IC and Phone Number -->
                                                        <div class="row mt-3">
                                                            <div class="col-md-6">
                                                                <label for="ic" class="form-label">NO K/P</label>
                                                                <p class="form-control" id="ic">{{ Auth::user()->ic }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="phone_number" class="form-label">NO TELEFON</label>
                                                                <p class="form-control" id="phone_number">{{ Auth::user()->phone_number }}</p>
                                                            </div>
                                                        </div>

                                                        <!-- Address -->
                                                        <h5 class="mt-4">MAKLUMAT TEMPAT TINGGAL</h5>
                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <label for="address" class="form-label">ALAMAT</label>
                                                                <p class="form-control" id="address">{{ Auth::user()->address }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-4">
                                                                <label for="postcode" class="form-label">POSKOD</label>
                                                                <p class="form-control" id="postcode">{{ Auth::user()->postcode }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="city" class="form-label">BANDAR</label>
                                                                <p class="form-control" id="city">{{ Auth::user()->city }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="state" class="form-label">NEGERI</label>
                                                                <p class="form-control" id="state">{{ Auth::user()->state }}</p>
                                                            </div>
                                                        </div>

                                                        {{-- Pekerjaan --}}
                                                        <h5 class="mt-4">MAKLUMAT PEKERJAAN</h5>
                                                        <div class="row mt-3">
                                                            <div class="col-md-4">
                                                                <label for="role" class="form-label">PERANAN</label>
                                                               <p class="form-control" id="role">
                                                                        @php
                                                                            $roleMapping = [
                                                                                'admin' => 'Admin',
                                                                                'staff' => 'Staf',
                                                                                'officer' => 'Pegawai',
                                                                            ];
                                                                        @endphp
                                                                        {{ $roleMapping[Auth::user()->role] ?? Auth::user()->role }}
                                                                    </p>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="job_status" class="form-label">STATUS PEKERJAAN</label>
                                                                <p class="form-control" id="job_status">
                                                                    @php
                                                                        $roleMapping = [
                                                                            'Contract' => 'Kontrak',
                                                                            'Permenant' => 'Tetap',
                                                                        ];
                                                                    @endphp
                                                                    {{ $roleMapping[Auth::user()->job_status] ?? Auth::user()->job_status }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="role" class="form-label">KETUA BAHAGIAN</label>
                                                                <p class="form-control" id="role">{{ Auth::user()->role }}</p>
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

