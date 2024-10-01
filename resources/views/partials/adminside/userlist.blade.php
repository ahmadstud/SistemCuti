  <!-- Senarai Pengguna section -->
  <div id="users-section" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Senarai Pengguna</h6>
                         <!-- Search Bar -->
                            <form method="GET" action="" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari nama pengguna" value="{{ request()->get('search') }}">
                                    <select name="role" class="form-select">
                                        <option value="">Pilih Peranan</option>
                                        <option value="Staf" {{ request()->get('role') == 'Staf' ? 'selected' : '' }}>Staf</option>
                                        <option value="Penyelia" {{ request()->get('role') == 'Penyelia' ? 'selected' : '' }}>Penyelia</option>
                                    </select>
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </form>
                        <!-- Add Staff/Officer Button -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                            Tambah Penyelia/Staf
                        </button>
                    </div>
                </div>

                <!-- Add Staff/Officer Modal -->
                <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addStaffModalLabel">Tambah Penyelia/Staf</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('storeUser') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Kata Laluan</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="ic" class="form-label">IC</label>
                                            <input type="text" class="form-control" id="ic" name="ic">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone_number" class="form-label">Nombor Telefon</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="role" class="form-label">Peranan</label>
                                            <select class="form-select" id="role" name="role" required>
                                                <option value="Staf">Staf</option>
                                                <option value="Penyelia">Penyelia</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="job_status" class="form-label">Status Kerja</label>
                                            <select class="form-select" id="job_status" name="job_status" required>
                                                <option value="Tetap">Tetap</option>
                                                <option value="Kontrak">Kontrak</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="address" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="address" name="address" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="city" class="form-label">Bandar</label>
                                            <input type="text" class="form-control" id="city" name="city" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="postcode" class="form-label">Poskod</label>
                                            <input type="text" class="form-control" id="postcode" name="postcode" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="state" class="form-label">Negeri</label>
                                            <input type="text" class="form-control" id="state" name="state" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="mc_days" class="form-label">Jumlah Cuti</label>
                                            <input type="number" class="form-control" id="mc_days" name="mc_days" required min="1">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="selected_officer_id">Penyelia</label>
                                            <select name="selected_officer_id" id="selected_officer_id" class="form-control">
                                                <option value="">Pilih Penyelia</option> <!-- This allows for no selection -->
                                                @foreach($officers as $officer)
                                                    <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Tambah Penyelia/Staf</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- Closing for Add Staff/Officer Modal -->

                <div class="card-body">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">Bil</th>
                                <th class="text-center" width="10%">Nama</th>
                                <th class="text-center" width="10%">Email</th>
                                <th class="text-center" width="10%">IC</th>
                                <th class="text-center" width="10%">No Telefon</th>
                                <th class="text-center" width="10%">Peranan</th>
                                <th class="text-center" width="10%">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->ic }}</td>
                                <td class="text-center">{{ $user->phone_number }}</td>
                                <td class="text-center">{{ $user->role }}</td>
                                <td class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}" title="Update">
                                        <i class="fas fa-edit"></i> <!-- Edit symbol -->
                                    </button>

                                    <!-- Delete button -->
                                    <form action="{{ route('deleteUser', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash-alt"></i> <!-- Delete symbol -->
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        <!-- Edit User Modal -->
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Kemas Kini Maklumat Pengguna - {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('updateUser', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name{{ $user->id }}" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email{{ $user->id }}" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                            </div>

                            <!-- IC -->
                            <div class="col-md-6 mb-3">
                                <label for="ic{{ $user->id }}" class="form-label">IC</label>
                                <input type="text" class="form-control" id="ic{{ $user->id }}" name="ic" value="{{ $user->ic }}">
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6 mb-3">
                                <label for="phone_number{{ $user->id }}" class="form-label">Nombor Telefon</label>
                                <input type="text" class="form-control" id="phone_number{{ $user->id }}" name="phone_number" value="{{ $user->phone_number }}">
                            </div>

                            <!-- Role -->
                            <div class="col-md-6 mb-3">
                                <label for="role{{ $user->id }}" class="form-label">Peranan</label>
                                <select class="form-select" id="role{{ $user->id }}" name="role">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Staf" {{ $user->role == 'Staf' ? 'selected' : '' }}>Staf</option>
                                    <option value="Penyelia" {{ $user->role == 'Penyelia' ? 'selected' : '' }}>Penyelia</option>
                                </select>
                            </div>

                            <!-- Job Status -->
                        <div class="col-md-6 mb-3">
                            <label for="job_status{{ $user->id }}" class="form-label">Status Kerja </label>
                            <select class="form-select" id="job_status{{ $user->id }}" name="job_status" required>
                                <option value="Tetap" {{ $user->job_status == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                            <option value="Kontrak" {{ $user->job_status == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                            </select>
                        </div>


                            <!-- Address -->
                            <div class="col-md-6 mb-3">
                                <label for="address{{ $user->id }}" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="address{{ $user->id }}" name="address" value="{{ $user->address }}" required>
                            </div>

                            <!-- City -->
                            <div class="col-md-6 mb-3">
                                <label for="city{{ $user->id }}" class="form-label">Bandar</label>
                                <input type="text" class="form-control" id="city{{ $user->id }}" name="city" value="{{ $user->city }}" required>
                            </div>

                            <!-- Postcode -->
                            <div class="col-md-6 mb-3">
                                <label for="postcode{{ $user->id }}" class="form-label">Poskod</label>
                                <input type="text" class="form-control" id="postcode{{ $user->id }}" name="postcode" value="{{ $user->postcode }}" required>
                            </div>

                            <!-- State -->
                            <div class="col-md-6 mb-3">
                                <label for="state{{ $user->id }}" class="form-label">Negeri</label>
                                <input type="text" class="form-control" id="state{{ $user->id }}" name="state" value="{{ $user->state }}" required>
                            </div>

                            <!-- MC Days -->
                            <div class="col-md-6 mb-3">
                                <label for="mc_days{{ $user->id }}" class="form-label">Cuti</label>
                                <!-- Updated name to match the controller field 'total_mc_days' -->
                                <input type="number" class="form-control" id="mc_days{{ $user->id }}" name="total_mc_days" value="{{ $user->total_mc_days }}" required min="0">
                            </div>

                            <!-- Select Officer -->
                            <div class="col-md-6 mb-3">
                                <label for="selected_officer_id">Penyelia</label>
                                <select name="selected_officer_id" id="selected_officer_id" class="form-control">
                                    <option value="">Pilih Penyelia</option>
                                    @foreach($officers as $officer)
                                        <option value="{{ $officer->id }}" {{ $user->selected_officer_id == $officer->id ? 'selected' : '' }}>
                                            {{ $officer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kemas Kini Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- Closing for card-body -->
            </div> <!-- Closing for card -->
        </div> <!-- Closing for col-lg-12 -->
    </div> <!-- Closing for row -->
</div>
