<main class="main-content position-relative border-radius-lg">

    <div class="container-fluid py-4">
        @include('partials.officerside.mcdays')
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
              <div class="card">
                <div class="card-header pb-1 p-1">

        <!-- MC Application Section -->
        <div id="McApply" class="content-section" style="display: none;">
            <!-- Applications Table Section -->
            <div class="row mt-4">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Senarai Permohonan</h6>
                            </div>
                        </div>
                        <!-- Applications Table -->
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10%">ID</th>
                                        <th class="text-center" width="10%">User ID</th>
                                        <th class="text-center" width="10%">Start Date</th>
                                        <th class="text-center" width="10%">End Date</th>
                                        <th class="text-center" width="10%">Reason</th>
                                        <th class="text-center" width="10%">Document</th>
                                        <th class="text-center" width="10%">Status</th>
                                        <th class="text-center" width="10%">Action</th>
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
                                                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $application->id }}">
                                                    <i class="fas fa-eye"></i> <!-- View icon -->
                                                </button>

                                                <!-- Modal for showing the reason -->
                                                <div class="modal fade" id="reasonModal{{ $application->id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $application->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="reasonModalLabel{{ $application->id }}">Reason for MC Application</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
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
                                                <a href="{{ Storage::url($application->document_path) }}" target="_blank" class="btn btn-link p-0">
                                                    <i class="fas fa-file-alt"></i> <!-- Document icon -->
                                                </a>
                                            @endif
                                            </td>
                                            <td class="text-center">
                                                @if($application->admin_approved && $application->officer_approved)
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($application->admin_approved)
                                                    <span class="badge bg-info">Direct Admin Approved</span>
                                                @elseif($application->officer_approved)
                                                    <span class="badge bg-warning text-dark">Half Approved</span>
                                                @elseif($application->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <!-- Accept or Reject Buttons -->
                                                <form action="{{ route('officer.updateStatus', $application->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" name="status" value="approved_by_officer" class="btn btn-success">
                                                        <i class="fas fa-check"></i> <!-- Right symbol -->
                                                    </button>
                                                    <button type="submit" name="status" value="rejected" class="btn btn-danger">
                                                        <i class="fas fa-times"></i> <!-- Wrong symbol -->
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

        <!-- Dashboard Section -->
<div id="Dashboard" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Dashboard</h6>
                    </div>
                </div>
                <div class="card-body">
                    <p>Welcome to the Dashboard</p>
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
                    <!-- Add more dashboard content here -->
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
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="toggleEditProfile()" title="Edit Profile">
                                <i class="fas fa-edit"></i> <!-- Edit symbol -->
                            </button>
                        </div>
                    </div>

                    <!-- Edit Profile Section (Initially Hidden) -->
                    <form id="editProfile" action="{{ route('updateOwnDetails3') }}" method="POST" style="display: none;">
                        @csrf
                        <div class="row">
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
                    <form action="{{ route('updateOwnDetails3') }}" method="POST">
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
