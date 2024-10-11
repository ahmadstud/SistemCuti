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
      Staf - Bahagian Profil
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
                @include('partials.staffside.aside')

    <main class="main-content position-relative border-radius-lg">
        <div class="container-fluid py-4">
                @include('partials.logout')
                @include('partials.staffside.mcdays')

        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
                <div class="card">
                    <div class="card-header pb-1 p-1">

 <!-- Profile Section -->
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>PROFIL PEKERJA<b></h4>
    </nav>

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container-fluid py-2">
                <div class="row">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2"></h6>
                                <!-- Edit Profile Button -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editStaffProfile">
                                    Kemaskini Maklumat
                                </button>
                            </div>
                        </div>

                        <!-- Edit Profile Modal -->
                        <div class="modal fade" id="editStaffProfile" tabindex="-1" aria-labelledby="editStaffProfileLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                        <h5 class="modal-title" id="editStaffProfileLabel">KEMASKINI MAKLUMAT</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('updateOwnDetails2') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <!-- Profile Image Upload -->
                                        <div class="mb-3">
                                            <label for="profile_image" class="form-label">Muat Naik Gambar Profil<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                                        </div>
                                            <!-- Profile Information -->
                                            <h5 class="mt-4">MAKLUMAT DIRI</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="name" class="form-label">NAMA<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">EMEL<span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label for="ic" class="form-label">NO K/P<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ic" name="ic" value="{{ Auth::user()->ic }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phone_number" class="form-label">NO TELEFON<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}">
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <h5 class="mt-4">MAKLUMAT TEMPAT TINGGAL</h5>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label for="address" class="form-label">ALAMAT<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="postcode" class="form-label">POSKOD<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="postcode" name="postcode" value="{{ Auth::user()->postcode }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="city" class="form-label">BANDAR<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="city" name="city" value="{{ Auth::user()->city }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="state" class="form-label">NEGERI<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="state" name="state" value="{{ Auth::user()->state }}">
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

                        <!-- View Profile Section -->
                        <div class="card-body">

                            <div class="card-body">
                                <!-- Profile Image -->
                                <div class="text-center">
                                    @if(Auth::user()->profile_image)
                                        <img src="{{ asset('' . Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle" width="150" height="150">
                                    @else
                                        <img src="{{ asset('storage/profile_image/default.jpg') }}" alt="Default Profile Image" class="rounded-circle" width="150" height="150">
                                    @endif
                                </div>
                            </div>

                            <!-- Profile Information -->
                            <h5 class="mt-4">MAKLUMAT DIRI</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">NAMA</label>
                                    <p class="form-control" id="name">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">EMEL</label>
                                    <p class="form-control" id="email">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
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

                            <!-- Job Status -->
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
                                    <label for="assigned_officer" class="form-label">KETUA BAHAGIAN</label>
                                    <p class="form-control" id="assigned_officer">
                                        {{ Auth::user()->officer ? Auth::user()->officer->name : 'Tiada Penyelia' }}
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
                                    <label for="mc_days" class="form-label">JUMLAH CUTI</label>
                                    <p class="form-control" id="mc_days">{{ Auth::user()->total_mc_days }}</p>
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

</body>
</html>
