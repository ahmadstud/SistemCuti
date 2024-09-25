<main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
        
        @include ('partials.adminside.mcdata')

            <div class="row mt-4">
                <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
                    <div class="card">
                        <div class="card-header pb-1 p-1">

                            <!-- Dashboard Section -->
                            <div id="Dashboard" class="content-section" style="display: none;">
                                <h6 class="mb-2">Dashboard</h6>

                                {{-- senarai dashboard --}}
                                <div class="col-lg-12 mb-lg-0 mb-4">
                                    <div class="card card-announcement overflow-hidden h-100 p-0 mb-4">

                                        <p><strong>1. Senarai Pengguna (User List):</strong> This section allows administrators to view and manage a list of all users within the system. It provides detailed information about each user, such as their name, email, and role. Administrators can perform actions such as viewing more details or editing user information directly from this list. This functionality is essential for maintaining user data and managing user roles and permissions.</p>
                                        <p><strong>2. Pending MC Applications:</strong> In this section, administrators can manage medical certificate (MC) applications submitted by staff members. It lists all pending applications, providing details such as the applicant’s name and the duration of the leave. Administrators have the ability to accept or reject these applications based on their review. This functionality ensures that MC requests are processed in a timely manner and helps in managing staff leave effectively.</p>
                                        <p><strong>3. Profile Management:</strong> This section is dedicated to managing the administrator's personal account details. Administrators can update their profile information, including changing their username and email address. Additionally, it provides an option to change the password, enhancing the security of the administrator's account. This functionality ensures that admin profiles are kept up-to-date and secure.</p>
                                        <p><strong>4. Admin Roles and Responsibilities:</strong> This section outlines the various roles and responsibilities assigned to administrators within the system. It provides an overview of what is expected from an admin, such as managing users, handling MC applications, and updating personal profiles. Understanding these roles helps in clarifying the scope of administrative duties and ensuring that all responsibilities are met efficiently.</p>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    {{-- purata ketidakhadiran --}}
                                    <div class="col-lg-7 mb-lg-0 mb-4">
                                        <div class="card z-index-2 h-100">
                                            <div class="card-header pb-0 pt-3 bg-transparent">
                                            <h6 class="text-capitalize">Purata Ketidakhadiran</h6>
                                            <p class="text-sm mb-0">
                                                <i class="fa fa-arrow-up text-success"></i>
                                                <span class="font-weight-bold">4% more</span> in 2021
                                            </p>
                                            </div>
                                            <div class="card-body p-3">
                                            <div class="chart">
                                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    {{-- senarai staff cuti harian --}}
                                    <div class="col-lg-5">
                                        <div class="card h-100 mb-4">
                                            <div class="card-header pb-0 px-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                <h6 class="mb-0">SENARAI STAFF CUTI HARIAN</h6>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                                <i class="far fa-calendar-alt me-2"></i>
                                                <small>September</small>
                                                </div>
                                            </div>
                                            </div>
            
                                            <div class="card-body pt-4 p-3">
                                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Hari ini</h6>
                                            <ul class="list-group">
                                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex align-items-center">
                                                <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user1">
                                                    <div class="d-flex flex-column">
                                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                                    01.01.2024 - 03.01.2024
                                                </div>
                                                </li>
                                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex align-items-center">
                                                <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user1">
                                                    <div class="d-flex flex-column">
                                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                                    01.01.2024 - 03.01.2024
                                                </div>
                                                </li>
                                            </ul>
            
                                            <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Esok</h6>
                                            <ul class="list-group">
                                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex align-items-center">
                                                <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user1">
                                                    <div class="d-flex flex-column">
                                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                                    01.01.2024 - 03.01.2024
                                                </div>
                                                </li>
                                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex align-items-center">
                                                <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user1">
                                                    <div class="d-flex flex-column">
                                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                                    01.01.2024 - 03.01.2024
                                                </div>
                                                </li>
            
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- Senarai Pengguna Section -->
                            <div id="users-section" class="content-section" style="display: none;">
                                <h1><b>SENARAI STAFF</b></h1>

                                <!-- Combined Table -->
                                <div class="table-responsive">

                                    <!-- Add Staff/Officer Button -->
                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                                        Add Staff/Officer
                                    </button> --}}
                                    <div class="d-flex justify-content-end mb-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahStaffModal">
                                          Tambah Staff
                                        </button>
                                    </div>

                                    <!-- Add Staff/Officer Modal -->
                                    {{-- <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addStaffModalLabel">Add Staff/Officer</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('storeUser') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email" name="email" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">Password</label>
                                                            <input type="password" class="form-control" id="password" name="password" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="ic" class="form-label">IC</label>
                                                            <input type="text" class="form-control" id="ic" name="ic">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone_number" class="form-label">Phone Number</label>
                                                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="role" class="form-label">Role</label>
                                                            <select class="form-select" id="role" name="role" required>
                                                                <option value="staff">Staff</option>
                                                                <option value="officer">Officer</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Add Staff/Officer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- Modal for Adding Staff -->
                                    <div class="modal fade" id="tambahStaffModal" tabindex="-1" aria-labelledby="tambahStaffModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="tambahStaffModalLabel">Tambah Staff</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                
                                            <!-- Form for Adding Staff -->
                                            <form action="{{ route('storeUser') }}" method="POST">
                                                @csrf
                
                                                <div class="mb-3">
                                                <label for="namaStaff" class="form-label">Nama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="namaStaff" name="namaStaff" placeholder="Nama" required>
                                                </div>
                                                <div class="mb-3">
                                                <label for="emailStaff" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="emailStaff" name="emailStaff" placeholder="Email" required>
                                                </div>
                                                <div class="mb-3">
                                                <label for="noKp" class="form-label">No Kad Pengenalan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="noKp" name="noKp" placeholder="No Kad Pengenalan" required>
                                                </div>
                                                <div class="mb-3">
                                                <label for="noTelefon" class="form-label">No Telefon <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="noTelefon" name="noTelefon" placeholder="No Telefon" required>
                                                </div>
                                                <div class="mb-3">
                                                <label for="peranan" class="form-label">Peranan <span class="text-danger">*</span></label>
                                                <select class="form-select" id="peranan" name="peranan" required>
                                                    <option selected disabled>--- Pilih Jenis Peranan ---</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Staff">Staff</option>
                                                    <option value="Ketua Bahagian">Ketua Bahagian</option>
                                                    {{-- <option value="Pegawai">Pegawai</option> --}}
                                                </select>
                                                </div>
                                                <div class="mb-3">
                                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option selected disabled>--- Pilih Status ---</option>
                                                    <option value="Kontrak">Kontrak</option>
                                                    <option value="Tetap">Tetap</option>
                                                    <option value="Berhenti">Berhenti</option>
                                                </select>
                                                </div>
                                                <div class="mb-3">
                                                <label for="kbahagian" class="form-label">Ketua Bahagian/Pegawai <span class="text-danger">*</span></label>
                                                <select class="form-select" id="kbahagian" name="kbahagian" required>
                                                    <option selected disabled>--- Pilih Ketua Bahagian ---</option>
                                                    <option value="Ketua 1 / Pegawai 1">Ketua 1 / Pegawai 1</option>
                                                    <option value="Ketua 2 / Pegawai 2">Ketua 2 / Pegawai 2</option>
                                                    <option value="Tiada Berkenaan">Tiada Berkenaan</option>
                                                </select>
                                                </div>
                                                <div class="mb-3">
                                                <label for="jumlahCuti" class="form-label">Jumlah Cuti <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="jumlahCuti" name="jumlahCuti" placeholder="Masukkan jumlah cuti" min="0" required>
                                                </div>
                
                                                <!-- Tambah butang type submit -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

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
                                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                                        Update
                                                    </button>

                                                    <!-- Delete button -->
                                                    <form action="{{ route('deleteUser', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User - {{ $user->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('updateUser', $user->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <!-- Form fields for user data -->
                                                                <div class="mb-3">
                                                                    <label for="name{{ $user->id }}" class="form-label">Name</label>
                                                                    <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="ic{{ $user->id }}" class="form-label">IC</label>
                                                                    <input type="text" class="form-control" id="ic{{ $user->id }}" name="ic" value="{{ $user->ic }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone_number{{ $user->id }}" class="form-label">Phone Number</label>
                                                                    <input type="text" class="form-control" id="phone_number{{ $user->id }}" name="phone_number" value="{{ $user->phone_number }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="role{{ $user->id }}" class="form-label">Role</label>
                                                                    <select class="form-select" id="role{{ $user->id }}" name="role">
                                                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                        <option value="officer" {{ $user->role == 'officer' ? 'selected' : '' }}>Officer</option>
                                                                        <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update User</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <table class="table align-items-center mb-0">
                                        <thead>
                                          <tr>
                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">No</th>
                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">Nama</th>
                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7 ">No Kad Pengenalan</th>
                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7 ">No Telefon</th>
                                            <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Peranan</th>
                                            <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Status</th>
                                            <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Ketua Bahagian/Pegawai</th>
                                            <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Tindakan</th>
                                          </tr>
                                        </thead>
                      
                                        {{-- <tbody>
                                          @foreach ($staff as $key => $s)
                                          <tr>
                                            <td>
                                              <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center text-center">
                                                  <h6 class="mb-0 text-m">{{ $key + 1 }}</h6>
                                                </div>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-6" alt="user1"> <!-- Changed me-3 to me-4 -->
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $s->sm_nama }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $s->sm_email }}</p>
                                                </div>
                                            </div>
                                            
                                            </td>
                                            <td>
                                              <p class="text-m text-secondary text-center mb-0">{{ $s->sm_ic }}</p>
                                            </td>
                                            <td>
                                              <p class="text-m text-secondary text-center mb-0">{{ $s->sm_telefon }}</p>
                                            </td>
                                            <td class="align-middle text-center text-md">
                                              @if($s->sm_peranan == 'Admin')
                                                  <span class="badge badge-md bg-gradient-danger">{{ $s->sm_peranan }}</span>
                                              @elseif($s->sm_peranan == 'Staff')
                                                  <span class="badge badge-md bg-gradient-info">{{ $s->sm_peranan }}</span>
                                              @elseif($s->sm_peranan == 'Ketua Bahagian')
                                                  <span class="badge badge-md bg-gradient-warning">{{ $s->sm_peranan }}</span>
                                              @elseif($s->sm_peranan == 'Pegawai')
                                                  <span class="badge badge-md bg-gradient-primary">{{ $s->sm_peranan }}</span>
                                              @else
                                                  <span class="badge badge-md bg-gradient-secondary">{{ $s->sm_peranan }}</span>
                                              @endif
                                            </td>                          
                                            <td class="align-middle text-center text-md">
                                              @if($s->sm_status == 'Kontrak')
                                                  <span class="badge badge-md bg-gradient-info">{{ $s->sm_status }}</span>
                                              @elseif($s->sm_status == 'Tetap')
                                                  <span class="badge badge-md bg-gradient-success">{{ $s->sm_status }}</span>
                                              @elseif($s->sm_status == 'Berhenti')
                                                  <span class="badge badge-md bg-gradient-danger">{{ $s->sm_status }}</span>
                                              @else
                                                  <span class="badge badge-md bg-gradient-secondary">{{ $s->sm_status }}</span>
                                              @endif
                                            </td>
                                            <td class="align-middle text-center text-md">
                                              <p class="text-m text-secondary text-center mb-0">{{ $s->sm_ketua }}</p>
                                            </td>
                                            <td class="align-middle text-center text-md">
                                              <a class="btn btn-primary btn-md" href="{{ route('staff.edit', $s->sm_id) }}" role="button">
                                                <i class="fas fa-pencil-alt text-m font-weight-bold me-2"></i>
                                              </a>
                                              <form action="{{ route('staff.destroy', $s->sm_id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-md" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt text-m font-weight-bold me-2"></i></button>
                                              </form>
                                            </td>
                                          </tr>
                                          @endforeach
                                        </tbody> --}}
                                    </table>
                                </div>
                            </div> 



                            <!-- Admin Approval Section -->
                            <div id="applications-section" class="content-section" style="display: none;">
                                <h6 class="mb-2">Admin Approval for Staff Application</h6>

                                <div class="table-responsive">
                                    <table class="table align-items-center" style="table-layout: auto;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">User ID</th>
                                                <th class="text-center">Start Date</th>
                                                <th class="text-center">End Date</th>
                                                <th class="text-center">Reason</th>
                                                <th class="text-center">Document</th>
                                                <th class="text-center">Officer Approved</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($applications as $application)
                                                <tr>
                                                    <td class="text-center">{{ $application->id }}</td>
                                                    <td class="text-center">{{ $application->user_id }}</td>
                                                    <td class="text-center">{{ $application->start_date }}</td>
                                                    <td class="text-center">{{ $application->end_date }}</td>
                                                    <td class="text-center">
                                                        <!-- Button to trigger modal to show reason -->
                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $application->id }}">
                                                            View Reason
                                                        </button>

                                                        <!-- Modal for showing the reason -->
                                                        <div class="modal fade" id="reasonModal{{ $application->id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $application->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="reasonModalLabel{{ $application->id }}">Reason for MC Application</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body" style="word-wrap: break-word; white-space: normal;">
                                                                        {{ $application->reason }}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($application->document_path)
                                                            <a href="{{ Storage::url($application->document_path) }}" target="_blank">View Document</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $application->officer_approved ? 'Yes' : 'No' }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($application->officer_approved && !$application->admin_approved)
                                                            <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Approve</button>
                                                            </form>
                                                        @else
                                                            <button type="button" class="btn btn-secondary" disabled>Approved</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <!-- Direct Admin Approval Section -->
                            <div id="admin-approval-section" class="content-section" style="display: none;">
                                <h6 class="mb-2">Direct Admin Approval by Staff Application</h6>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-responsive-sm align-items-center" style="table-layout: auto;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">User</th>
                                                <th class="text-center">Start Date</th>
                                                <th class="text-center">End Date</th>
                                                <th class="text-center">Reason</th>
                                                <th class="text-center">Document</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($directAdminApplications as $application)
                                                <tr>
                                                    <td class="text-center">{{ $application->id }}</td>
                                                    <td class="text-center">{{ $application->user->name }}</td>
                                                    <td class="text-center">{{ $application->start_date }}</td>
                                                    <td class="text-center">{{ $application->end_date }}</td>
                                                    <td class="text-center">
                                                        <!-- Button to trigger modal to show reason -->
                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#directReasonModal{{ $application->id }}" aria-label="View Reason">
                                                            View Reason
                                                        </button>

                                                        <!-- Modal for showing the reason -->
                                                        <div class="modal fade" id="directReasonModal{{ $application->id }}" tabindex="-1" aria-labelledby="directReasonModalLabel{{ $application->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="directReasonModalLabel{{ $application->id }}">Reason for MC Application</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body" style="max-height: 400px; overflow-y: auto; word-wrap: break-word; white-space: normal;">
                                                                        {{ $application->reason }}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($application->document_path)
                                                            <a href="{{ Storage::url($application->document_path) }}" target="_blank">View Document</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <form action="{{ route('admin.approve', $application->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="fas fa-check"></i> Approve
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.reject', $application->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning">
                                                                <i class="fas fa-check"></i> Reject
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            

                            <!-- Management Section -->
                            <div id="management-section" class="content-section" style="display: none;">
                                {{-- <h6 class="mb-2">Direct Admin Approval by Staff Application</h6> --}}
                                <div class="row mt-4">
                                    <div class="col-12">         
                                        <div div class="card mb-4">
                                            <div class="card-header pb-0">
                                              <h4>SENARAI PENGUMUMAN</h4>
                    
                                              <!-- Add Buttons -->
                                              <div class="d-flex justify-content-end mb-3">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPengumumanModal">
                                                  Tambah Pengumuman
                                                </button>
                                              </div>
                    
                                              <!-- Modal for Adding Announcement -->
                                              <div class="modal fade" id="tambahPengumumanModal" tabindex="-1" aria-labelledby="tambahPengumumanModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="tambahPengumumanModalLabel">Tambah Pengumuman</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                    
                                                            <!-- Form for Adding Announcement -->
                                                            {{-- <form action="{{ route('pengurusan.store') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf --}}
                    
                                                                <div class="mb-3">
                                                                    <label for="announcementTitle" class="form-label">Tajuk Pengumuman<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="announcementTitle" name="pm_tajuk" placeholder="Masukkan tajuk pengumuman" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="announcementContent" class="form-label">Kandungan Pengumuman<span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" id="announcementContent" name="pm_kandungan" rows="3" placeholder="Masukkan kandungan pengumuman" required></textarea>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <label for="announcementStartDate" class="form-label">Tarikh Mula Pengumuman<span class="text-danger">*</span></label>
                                                                        <input type="date" class="form-control" id="announcementStartDate" name="pm_tarikhmula" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="announcementEndDate" class="form-label">Tarikh Akhir Pengumuman<span class="text-danger">*</span></label>
                                                                        <input type="date" class="form-control" id="announcementEndDate" name="pm_tarikhakhir" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="announcementImage" class="form-label">Gambar Pengumuman<span class="text-danger">*</span></label>
                                                                    <input class="form-control" type="file" id="announcementImage" name="pm_gambar">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                    
                                              @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                              @endif
                    
                                            </div>
                    
                                            {{-- table --}}
                                            <div class="card-body px-0 pt-0 pb-2">
                                                <div class="table-responsive p-0">
                                                    <table class="table align-items-center mb-0">
                                                      <thead>
                                                          <tr>
                                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">No</th>
                                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">Tajuk Pengumuman</th>
                                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">Kandungan Ringkas</th>
                                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7 text-center">Tarikh Mula</th>
                                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7 text-center">Tarikh Akhir</th>
                                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7 text-center">Tindakan</th>
                                                          </tr>
                                                      </thead>
                                                      
                                                      <tbody>
                                                        {{-- @foreach($pengurusan as $index => $item) --}}
                                                        <tr>
                                                            <td class="align-middle text-center text-sm">
                                                                <p class="text-xs font-weight-bold mb-0">1</p>
                                                            </td>
                                                            <td>
                                                                <span class="text-secondary text-s font-weight-bold"></span>
                                                            </td>
                                                            <td>
                                                                <span class="text-secondary text-xs"></span>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <span class="text-secondary text-s font-weight-bold"></span>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <span class="text-secondary text-s font-weight-bold"></span>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                              {{-- <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editPengumumanModal-{{ $item->pm_id }}">
                                                                <i class="fas fa-pencil-alt text-s font-weight-bold me-2"></i>Kemaskini
                                                              </a> --}}
                                                              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editPengumumanModal">
                                                                <i class="fas fa-pencil-alt text-s font-weight-bold me-2"></i></button>
                                                              
                                                              <button class="btn btn-danger btn-sm" onclick="deleteAnnouncement()">
                                                                  <i class="fas fa-trash text-s font-weight-bold me-2"></i>   </button>
                                                            </td>
                                                        </tr>
                                                        {{-- @endforeach --}}
                                                      </tbody>
                                                    </table>
                    
                                                    <!-- Modal for Editing Announcement -->
                                                    <div class="modal fade" id="editPengumumanModal" tabindex="-1" aria-labelledby="editPengumumanModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editPengumumanModalLabel">Edit Pengumuman</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                    
                                                            <div class="modal-body">
                                                              
                                                                <!-- Form for Editing Announcement -->
                                                                {{-- <form action="{{ route('pengurusan.update', $item->pm_id) }}" method="POST"> --}}
                                                                  @csrf
                                                                  @method('PUT') <!-- This ensures the form submission is treated as an update (PUT request) -->
                    
                                                                    <div class="mb-3">
                                                                        <label for="pm_tajuk" class="form-label">Tajuk Pengumuman</label>
                                                                        <input class="form-control rounded-3 border border-secondary" type="text" id="pm_tajuk" name="pm_tajuk" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="pm_kandungan" class="form-label">Kandungan Pengumuman</label>
                                                                        <!-- Textarea with CKEditor -->
                                                                        <textarea class="form-control rounded-3 border border-secondary" id="pm_kandungan" name="pm_kandungan" required></textarea>
                    
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label for="pm_tarikhawal" class="form-label">Tarikh Mula Pengumuman</label>
                                                                            <input type="date" class="form-control" id="pm_tarikhawal" name="pm_tarikhawal"  required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="pm_tarikhakhir" class="form-label">Tarikh Akhir Pengumuman</label>
                                                                            <input type="date" class="form-control" id="pm_tarikhakhir" name="pm_tarikhakhir" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="pm_gambar" class="form-label">Gambar Pengumuman</label>
                                                                        <input class="form-control" type="file" id="pm_gambar" name="pm_gambar">
                                                                        {{-- @if($item->pm_gambar)
                                                                            <img src="{{ Storage::url($item->pm_gambar) }}" alt="Pengumuman Image" width="100" class="mt-2">
                                                                        @endif --}}
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="button" class="btn btn-primary">Kemaskini Pengumuman</button>
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



                            <!-- Profile Section -->
                            <div id="Profile" class="content-section" style="display: none;">
                                <h6 class="mb-2">Your Profile</h6>

                                <!-- View Profile Section -->
                                <div id="viewProfile">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <p class="form-control" id="name">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <p class="form-control" id="email">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="ic" class="form-label">IC</label>
                                    <p class="form-control" id="ic">{{ Auth::user()->ic }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <p class="form-control" id="phone_number">{{ Auth::user()->phone_number }}</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="toggleEditProfile()">Edit Profile</button>
                                </div>
                                </div>

                                <!-- Edit Profile Section (Initially Hidden) -->
                                <form id="editProfile" action="{{ route('updateOwnDetails') }}" method="POST" style="display: none;">
                                    @csrf
                                    <!-- Form fields for user data -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ic" class="form-label">IC</label>
                                        <input type="text" class="form-control" id="ic" name="ic" value="{{ Auth::user()->ic }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}">
                                    </div>

                                    <!-- Update Password Section -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password (Leave blank if not changing)</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update Details</button>
                                        <button type="button" class="btn btn-secondary" onclick="toggleViewProfile()">Cancel</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
</main>



