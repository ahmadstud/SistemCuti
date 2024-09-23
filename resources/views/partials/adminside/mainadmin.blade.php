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
                            <div class="card card-announcement overflow-hidden h-100 p-0 mb-4">

                                    <p><strong>1. Senarai Pengguna (User List):</strong> This section allows administrators to view and manage a list of all users within the system. It provides detailed information about each user, such as their name, email, and role. Administrators can perform actions such as viewing more details or editing user information directly from this list. This functionality is essential for maintaining user data and managing user roles and permissions.</p>
                                    <p><strong>2. Pending MC Applications:</strong> In this section, administrators can manage medical certificate (MC) applications submitted by staff members. It lists all pending applications, providing details such as the applicant’s name and the duration of the leave. Administrators have the ability to accept or reject these applications based on their review. This functionality ensures that MC requests are processed in a timely manner and helps in managing staff leave effectively.</p>
                                    <p><strong>3. Profile Management:</strong> This section is dedicated to managing the administrator's personal account details. Administrators can update their profile information, including changing their username and email address. Additionally, it provides an option to change the password, enhancing the security of the administrator's account. This functionality ensures that admin profiles are kept up-to-date and secure.</p>
                                    <p><strong>4. Admin Roles and Responsibilities:</strong> This section outlines the various roles and responsibilities assigned to administrators within the system. It provides an overview of what is expected from an admin, such as managing users, handling MC applications, and updating personal profiles. Understanding these roles helps in clarifying the scope of administrative duties and ensuring that all responsibilities are met efficiently.</p>
                            </div>
                    </div>

                    <!-- Senarai Pengguna Section -->
                    <div id="users-section" class="content-section" style="display: none;">
                        <h6 class="mb-2">Senarai Pengguna</h6>
                        <!-- Combined Table -->
                        <div class="table-responsive">
                            <!-- Add Staff/Officer Button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                                Add Staff/Officer
                            </button>
                            <!-- Add Staff/Officer Modal -->
                            <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
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
                            </div>

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
                        </div>
                    </div> <!-- Closing div for content-section -->

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


