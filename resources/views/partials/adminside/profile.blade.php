 <!-- Profile Section -->
 <div id="Profile" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Profil</h6>
                    </div>
                </div>
                <div class="card-body">
                    <!-- View Profile Section -->
                    <div id="viewProfile">
                        <div class="row">
                            <!-- Profile Information -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <p class="form-control" id="name">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <p class="form-control" id="email">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <!-- IC and Phone Number -->
                            <div class="col-md-6">
                                <label for="ic" class="form-label">IC</label>
                                <p class="form-control" id="ic">{{ Auth::user()->ic }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Nombor Telefon</label>
                                <p class="form-control" id="phone_number">{{ Auth::user()->phone_number }}</p>
                            </div>
                        </div>

                        <h5 class="mt-4">Maklumat Alamat</h5>
                        <div class="row mt-3">
                            <!-- Address -->
                            <div class="col-md-12">
                                <label for="address" class="form-label">Alamat</label>
                                <p class="form-control" id="address">{{ Auth::user()->address }}</p>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <!-- State, City, Postcode -->
                            <div class="col-md-4">
                                <label for="postcode" class="form-label">Poskod</label>
                                <p class="form-control" id="postcode">{{ Auth::user()->postcode }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">Negeri</label>
                                <p class="form-control" id="state">{{ Auth::user()->state }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">Bandar</label>
                                <p class="form-control" id="city">{{ Auth::user()->city }}</p>
                            </div>
                        </div>

                        <h5 class="mt-4">Status Pekerjaan</h5>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="role" class="form-label">Peranan</label>
                                <p class="form-control" id="role">{{ Auth::user()->role }}</p>
                            </div>

                            <div class="col-md-4">
                                <label for="job_status" class="form-label">Status Kerja</label>
                                <p class="form-control" id="role">{{ Auth::user()->job_status }}</p>
                            </div>

                            <div class="col-md-4">
                                <label for="mc_days" class="form-label">Jumlah cuti berbaki</label>
                                <p class="form-control" id="mc_days">{{ Auth::user()->total_mc_days }}</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="{{ route('admin.editProfile') }}" class="btn btn-primary" title="Edit Profile">
                                <i class="fas fa-edit"></i> <!-- Edit symbol -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
