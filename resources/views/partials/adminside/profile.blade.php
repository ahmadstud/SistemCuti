<!-- Profile Section -->
<div id="Profile" class="content-section" style="display: none;">
<nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
    <h4><b>PROFIL PEKERJA<b></h4>
</nav>

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
                                        <div class="mb-3">
                                            <label for="profile_image" class="form-label">Muat Naik Gambar Profil</label>
                                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                                        </div>

                                        <!-- Profile Information -->
                                        <h5 class="mt-4">MAKLUMAT DIRI</h5>
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
                                                <input type="text" class="form-control" id="state" name="state" value="{{ Auth::user()->state }}">
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
                                                <p class="form-control" id="mc_days" required min="1">{{ Auth::user()->total_mc_days }}</p>
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

                        {{-- Pekerjaan --}}
                        <h5 class="mt-4">MAKLUMAT PEKERJAAN</h5>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="role" class="form-label">PERANAN</label>
                                <p class="form-control" id="role">{{ Auth::user()->role }}</p>
                            </div>

                            <div class="col-md-4">
                                <label for="job_status" class="form-label">STATUS PEKERJAAN</label>
                                <p class="form-control" id="role">{{ Auth::user()->job_status }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="role" class="form-label">KETUA BAHAGIAN</label>
                                <p class="form-control" id="role">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
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