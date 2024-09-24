<main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
        @include ('partials.adminside.mcdata')
        <div class="row mt-4">
          <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
            <div class="card">
              <div class="card-header pb-1 p-1">

                          <!-- Dashboard Section -->
<div id="Dashboard" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-2">Dashboard</h6>
                </div>
                <div class="card-body">
                    <!-- Announcement Carousel -->
                    <div id="announcementCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($announcements as $index => $announcement)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset(Storage::url($announcement->image_path)) }}" class="d-block w-100" alt="{{ $announcement->title }}">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $announcement->title }}</h5>
                                        <p>{{ $announcement->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#announcementCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#announcementCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Announcement Section -->
<div id="Annouce" class="content-section" style="display: none;">
   <!-- List of Announcements -->
<div class="card mt-4">
    <div class="card-header pb-0 p-3">
        <div class="d-flex justify-content-between">
            <h6 class="mb-2">Announcements</h6>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">Create Announcement</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($announcements as $announcement)
                    <tr>
                        <td>{{ $announcement->title }}</td>
                        <td>{{ $announcement->content }}</td>
                        <td>
                            @if($announcement->image_path)
                            <img src="{{ asset('storage/' . $announcement->image_path) }}" class="d-block w-5" alt="{{ $announcement->title }}">
                        @else
                            No Image
                        @endif
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal{{ $announcement->id }}">Edit</button>
                            <!-- Delete button for announcement -->
<form action="{{ route('deleteAnnouncement', $announcement->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
        <i class="fas fa-trash-alt"></i> <!-- Delete symbol -->
    </button>
</form>

                        </td>
                    </tr>

                    <!-- Edit Announcement Modal -->
                    <div class="modal fade" id="editAnnouncementModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="editAnnouncementLabel{{ $announcement->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editAnnouncementLabel{{ $announcement->id }}">Edit Announcement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('updateAnnouncement', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="title{{ $announcement->id }}" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title{{ $announcement->id }}" name="title" value="{{ $announcement->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="content{{ $announcement->id }}" class="form-label">Content</label>
                                            <textarea class="form-control" id="content{{ $announcement->id }}" name="content" rows="4" required>{{ $announcement->content }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image{{ $announcement->image_path }}" class="form-label">Image (optional)</label>
                                            <input type="file" class="form-control" id="image{{ $announcement->id }}" name="image_path" accept="image/*">                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Create Announcement Modal -->
<div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAnnouncementLabel">Create Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.storeAnnouncement') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

                   <!-- Senarai Pengguna section -->
<div id="users-section" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Senarai Pengguna</h6>
                        <!-- Add Staff/Officer Button -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                            Add Staff/Officer
                        </button>
                    </div>
                </div>
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
                                    <div class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="ic" class="form-label">IC</label>
                                            <input type="text" class="form-control" id="ic" name="ic">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone_number" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select class="form-select" id="role" name="role" required>
                                                <option value="staff">Staff</option>
                                                <option value="officer">Officer</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="postcode" class="form-label">Postcode</label>
                                            <input type="text" class="form-control" id="postcode" name="postcode" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control" id="state" name="state" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="mc_days" class="form-label">MC Days</label>
                                            <input type="number" class="form-control" id="mc_days" name="mc_days" required min="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Staff/Officer</button>
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
                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User - {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updateUser', $user->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name{{ $user->id }}" class="form-label">Name</label>
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
                            <label for="phone_number{{ $user->id }}" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number{{ $user->id }}" name="phone_number" value="{{ $user->phone_number }}">
                        </div>

                        <!-- Role -->
                        <div class="col-md-6 mb-3">
                            <label for="role{{ $user->id }}" class="form-label">Role</label>
                            <select class="form-select" id="role{{ $user->id }}" name="role">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="officer" {{ $user->role == 'officer' ? 'selected' : '' }}>Officer</option>
                                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                        </div>

                        <!-- MC Days -->
                        <div class="col-md-6 mb-3">
                            <label for="mc_days{{ $user->id }}" class="form-label">MC Days</label>
                            <input type="number" class="form-control" id="mc_days{{ $user->id }}" name="mc_days" value="{{ $user->mc_days }}" min="1" required>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-3">
                            <label for="address{{ $user->id }}" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address{{ $user->id }}" name="address" value="{{ $user->address }}">
                        </div>

                        <!-- City -->
                        <div class="col-md-6 mb-3">
                            <label for="city{{ $user->id }}" class="form-label">City</label>
                            <input type="text" class="form-control" id="city{{ $user->id }}" name="city" value="{{ $user->city }}">
                        </div>

                        <!-- Postcode -->
                        <div class="col-md-6 mb-3">
                            <label for="postcode{{ $user->id }}" class="form-label">Postcode</label>
                            <input type="text" class="form-control" id="postcode{{ $user->id }}" name="postcode" value="{{ $user->postcode }}">
                        </div>

                        <!-- State -->
                        <div class="col-md-6 mb-3">
                            <label for="state{{ $user->id }}" class="form-label">State</label>
                            <input type="text" class="form-control" id="state{{ $user->id }}" name="state" value="{{ $user->state }}">
                        </div>
                    </div> <!-- End row -->
                </div> <!-- End modal body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- End Edit User Modal -->

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Closing for Senarai Pengguna section -->

           <!-- Admin Approval Section -->
<div id="applications-section" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Admin Approval for Staff Application</h6>
                    </div>
                </div>
                <div class="card-body">
                    <!-- View Applications Section -->
                    <div id="viewApplications">
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
                                                    <i class="fas fa-eye"></i>
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
                                                    <a href="{{ Storage::url($application->document_path) }}" target="_blank"><i class="fas fa-file-alt"></i></a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $application->officer_approved ? 'Yes' : 'No' }}
                                            </td>
                                            <td class="text-center">
                                                @if($application->officer_approved && !$application->admin_approved)
                                                    <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                                                    </form>
                                                @else
                                                    <button type="button" class="btn btn-secondary" disabled><i class="fas fa-check-double"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                 <!-- Direct Admin Approval Section -->
<div id="admin-approval-section" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Direct Admin Approval by Staff Application</h6>
                    </div>
                </div>
                <div class="card-body">
                    <!-- View Applications Section -->
                    <div id="viewApplications">
                        <div class="table-responsive">
                            <table class="table align-items-center" style="table-layout: auto;">
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
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <!-- Modal for showing the reason -->
                                                <div class="modal fade" id="directReasonModal{{ $application->id }}" tabindex="-1" aria-labelledby="directReasonModalLabel{{ $application->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="directReasonModalLabel{{ $application->id }}">Reason for MC Application</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
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
                                                    <a href="{{ Storage::url($application->document_path) }}" target="_blank"><i class="fas fa-file-alt"></i></a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success" aria-label="Approve">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.reject', $application->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" aria-label="Reject">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                   <!-- Profile Section -->
<div id="Profile" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Profile</h6>
                    </div>
                </div>
                <div class="card-body">
                    <!-- View Profile Section -->
                    <div id="viewProfile">
                        <div class="row">
                            <!-- Existing fields -->
                            <div class="col-md-3">
                                <label for="name" class="form-label">Name</label>
                                <p class="form-control" id="name">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email</label>
                                <p class="form-control" id="email">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="ic" class="form-label">IC</label>
                                <p class="form-control" id="ic">{{ Auth::user()->ic }}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <p class="form-control" id="phone_number">{{ Auth::user()->phone_number }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Address Information</h6>
                            </div>
                            <!-- New fields -->
                            <div class="col-md-3">
                                <label for="address" class="form-label">Address</label>
                                <p class="form-control" id="address">{{ Auth::user()->address }}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="city" class="form-label">City</label>
                                <p class="form-control" id="city">{{ Auth::user()->city }}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="postcode" class="form-label">Postcode</label>
                                <p class="form-control" id="postcode">{{ Auth::user()->postcode }}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="state" class="form-label">State</label>
                                <p class="form-control" id="state">{{ Auth::user()->state }}</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="toggleEditProfile()" title="Edit Profile">
                                <i class="fas fa-edit"></i> <!-- Edit symbol -->
                            </button>
                        </div>
                    </div>

                    <!-- Edit Profile Section (Initially Hidden) -->
                    <form id="editProfile" action="{{ route('updateOwnDetails') }}" method="POST" style="display: none;">
                        @csrf
                        <div class="row">
                            <!-- Existing fields -->
                            <div class="col-md-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="ic" class="form-label">IC</label>
                                <input type="text" class="form-control" id="ic" name="ic" value="{{ Auth::user()->ic }}">
                            </div>
                            <div class="col-md-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}">
                            </div>
                            <!-- New fields -->
                            <div class="col-md-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
                            </div>
                            <div class="col-md-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ Auth::user()->city }}">
                            </div>
                            <div class="col-md-3">
                                <label for="postcode" class="form-label">Postcode</label>
                                <input type="text" class="form-control" id="postcode" name="postcode" value="{{ Auth::user()->postcode }}">
                            </div>
                            <div class="col-md-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" id="state" name="state" value="{{ Auth::user()->state }}">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" title="Update">
                                <i class="fas fa-save"></i> <!-- Update symbol -->
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="toggleViewProfile()" title="Cancel">
                                <i class="fas fa-times-circle"></i> <!-- Cancel symbol -->
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Separate Change Password Section -->
<div id="ChangePassword" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Change Password</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateOwnDetails') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank if not changing">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </form>
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


