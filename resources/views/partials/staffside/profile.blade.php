<!-- Profile Section -->
<div id="Profile" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Profil Pengguna</h6>
                    </div>
                </div>
                <div class="card-body">
                   <!-- Profile Image -->
                    <div class="text-center">
                        @if(Auth::user()->profile_image)
                            <img src="{{ asset('' . Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle" width="150" height="150">
                        @else
                            <img src="{{ asset('storage/profile_image/default.png') }}" alt="Default Profile Image" class="rounded-circle" width="150" height="150">
                        @endif
                    </div>
                </div>

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
                                <p class="form-control" id="job_status">{{ Auth::user()->job_status }}</p>
                            </div>

                            <div class="col-md-4">
                                <label for="mc_days" class="form-label">Jumlah cuti berbaki</label>
                                <p class="form-control" id="mc_days">{{ Auth::user()->total_mc_days }}</p>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="assigned_officer" class="form-label">Penyelia</label>
                                    <p class="form-control" id="assigned_officer">
                                        {{ Auth::user()->officer ? Auth::user()->officer->name : 'Tiada Penyelia' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" title="Edit Profile" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="fas fa-edit"></i> <!-- Edit symbol -->
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal Structure -->
 <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Kemaskini Profil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form with enctype for file upload -->
          <form action="{{ route('updateOwnDetails2') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Profile Image -->
            <div class="text-center">
              @if(Auth::user()->profile_image)
                <img src="{{ asset('' . Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle" width="150" height="150">
              @else
                <img src="{{ asset('storage/profile_image/default.png') }}" alt="Default Profile Image" class="rounded-circle" width="150" height="150">
              @endif
            </div>

            <!-- Profile Image Upload -->
            <div class="mb-3">
              <label for="profile_image" class="form-label">Muat Naik Gambar Profil</label>
              <input type="file" class="form-control" id="profile_image" name="profile_image">
            </div>

            <h5 class="mt-4">Maklumat Profil</h5>
            <div class="row">
              <!-- Profile Information -->
              <div class="col-md-6">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
              </div>
            </div>

            <div class="row mt-3">
              <!-- IC and Phone Number -->
              <div class="col-md-6">
                <label for="ic" class="form-label">IC</label>
                <input type="text" class="form-control" id="ic" name="ic" value="{{ Auth::user()->ic }}">
              </div>
              <div class="col-md-6">
                <label for="phone_number" class="form-label">Nombor Telefon</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}">
              </div>
            </div>

            <h5 class="mt-4">Maklumat Alamat</h5>
            <div class="row mt-3">
              <!-- Address -->
              <div class="col-md-12">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
              </div>
            </div>

            <div class="row mt-3">
              <!-- Postcode, State, City -->
              <div class="col-md-4">
                <label for="postcode" class="form-label">Poskod</label>
                <input type="text" class="form-control" id="postcode" name="postcode" value="{{ Auth::user()->postcode }}">
              </div>
              <div class="col-md-4">
                <label for="state" class="form-label">Negeri</label>
                <input type="text" class="form-control" id="state" name="state" value="{{ Auth::user()->state }}">
              </div>
              <div class="col-md-4">
                <label for="city" class="form-label">Bandar</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ Auth::user()->city }}">
              </div>
            </div>

            <div class="mt-3">
              <button type="submit" class="btn btn-primary">Kemaskini</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>


