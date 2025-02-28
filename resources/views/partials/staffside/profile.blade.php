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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>

    <body class="g-sidenav-show bg-gray-100">


        <div class="min-height-500 position-absolute w-100" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;"></div>            @include('partials.staffside.aside')

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
                                        <h4><b>PROFIL PENGGUNA</b></h4>
                                        <!-- Breadcrumb -->
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb mb-0">
                                                <li class="breadcrumb-item"><a href="{{ route('staff') }}">UTAMA</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">PROFIL PENGGUNA</li>
                                            </ol>
                                        </nav>
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
                                                        <div class="modal fade" id="editStaffProfile" tabindex="-1" aria-labelledby="editStaffProfileLabel">
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
                                                                            <div class="mb-3">
                                                                                <label for="fullname" class="form-label">NAMA PENUH<span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ Auth::user()->fullname }}">
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
                                                            <!-- Profile Information -->
                                                            <div class="row">
                                                                <!-- Profile Image and Full Name -->
                                                                <div class="row align-items-center mb-3">
                                                                <div class="col-md-10">
                                                                    <label for="fullname" class="form-label">NAMA PENUH<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="fullname" name="fullname" value="{{ Auth::user()->fullname }}">
                                                                </div>
                                                                <div class="col-md-2 text-center">
                                                                    @if(Auth::user()->profile_image)
                                                                        <img src="{{ asset('' . Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle" width="120" height="120">
                                                                    @else
                                                                        <img src="{{ asset('storage/profile_image/default.jpg') }}" alt="Default Profile Image" class="rounded-circle" width="120" height="120">
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
                                                                @foreach ($notes as $note)
                                                                        <div class="col-md-4">
                                                                            @php
                                                                                $columnName = Str::slug($note->title, '_');
                                                                            @endphp
                                                                            <label for="{{ $columnName }}" class="form-label">{{ $note->title }}</label>
                                                                            <p class="form-control" id="{{ $columnName }}">{{ old($columnName, Auth::user()->$columnName ?? '0') }}</p>
                                                                        </div>
                                                                    @endforeach
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

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <!-- Most Important JS Files -->
            <script src="{{ asset('js/app.js') }}"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

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
