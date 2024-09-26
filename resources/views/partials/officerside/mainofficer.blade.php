<main class="main-content position-relative border-radius-lg">

    <div class="container-fluid py-4">
        @include('partials.officerside.mcdays')
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
              <div class="card">
                <div class="card-header pb-1 p-1">

        <!-- MC Application Section -->
        <div id="McApprove" class="content-section" style="display: none;">
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
                                                <form action="" method="POST">
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

<!-- MC Application Section -->
<div id="McApply" class="content-section" style="display: none;">
    <!-- MC Applications Table Section -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Permohonan Cuti</h6>
                        <!-- Button to trigger MC Application Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcApplicationModal">
                            <i class="fas fa-file-alt"></i> Memohon Surat Cuti
                        </button>
                    </div>
                </div>

                <!-- MC Application Modal -->
                <div class="modal fade" id="mcApplicationModal" tabindex="-1" aria-labelledby="mcApplicationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mcApplicationModalLabel">Permohonan Cuti</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('officer.mcApplication.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Tarikh Mula</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">Tarikh Tamat</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="document_path" class="form-label">Dokumen MC</label>
                                        <input type="file" class="form-control" id="document_path" name="document_path" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reason" class="form-label">Sebab</label>
                                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Hantar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- Closing modal -->

                <!-- MC Applications Table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">Bil</th>
                                <th class="text-center" width="10%">Tarikh Mula</th>
                                <th class="text-center" width="10%">Tarikh Tamat</th>
                                <th class="text-center" width="10%">Sebab</th>
                                <th class="text-center" width="10%">Dokumen</th>
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mcApplications as $index => $mcApplication)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $mcApplication->start_date }}</td>
                                    <td class="text-center">{{ $mcApplication->end_date }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $mcApplication->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Modal for showing the reason -->
                                        <div class="modal fade" id="reasonModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="reasonModalLabel{{ $mcApplication->id }}">Sebab Permohonan MC</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $mcApplication->reason }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($mcApplication->document_path)
                                            <a href="{{ Storage::url($mcApplication->document_path) }}" target="_blank" class="text-primary">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                        @else
                                            <span>Tidak Ada Dokumen</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($mcApplication->admin_approved)
                                            <span class="badge bg-success">Diluluskan</span>
                                        @elseif($mcApplication->status == 'pending')
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($mcApplication->status === 'pending')
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editMcModal{{ $mcApplication->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <!-- Edit MC Application Modal -->
                                            <div class="modal fade" id="editMcModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="editMcModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editMcModalLabel{{ $mcApplication->id }}">Edit Permohonan MC</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('officer.mc.edit', $mcApplication->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="start_date{{ $mcApplication->id }}" class="form-label">Tarikh Mula</label>
                                                                    <input type="date" class="form-control" id="start_date{{ $mcApplication->id }}" name="start_date" value="{{ $mcApplication->start_date }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="end_date{{ $mcApplication->id }}" class="form-label">Tarikh Tamat</label>
                                                                    <input type="date" class="form-control" id="end_date{{ $mcApplication->id }}" name="end_date" value="{{ $mcApplication->end_date }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="document_path{{ $mcApplication->id }}" class="form-label">Dokumen MC (biarkan kosong jika tidak mengubah)</label>
                                                                    <input type="file" class="form-control" id="document_path{{ $mcApplication->id }}" name="document_path">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="reason{{ $mcApplication->id }}" class="form-label">Sebab</label>
                                                                    <textarea class="form-control" id="reason{{ $mcApplication->id }}" name="reason" rows="3" required>{{ $mcApplication->reason }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fas fa-save"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('officer.deleteMC', $mcApplication->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE') <!-- Include this line to specify that the method is DELETE -->
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Adakah anda pasti ingin menghapus permohonan ini?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span>-</span>
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
                            <!-- Profile Information -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
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
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <p class="form-control" id="phone_number">{{ Auth::user()->phone_number }}</p>
                            </div>
                        </div>

                        <h5 class="mt-4">Address Information</h5>
                        <div class="row mt-3">
                            <!-- Address -->
                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <p class="form-control" id="address">{{ Auth::user()->address }}</p>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <!-- State, City, Postcode -->
                            <div class="col-md-4">
                                <label for="postcode" class="form-label">Postcode</label>
                                <p class="form-control" id="postcode">{{ Auth::user()->postcode }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <p class="form-control" id="state">{{ Auth::user()->state }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">City</label>
                                <p class="form-control" id="city">{{ Auth::user()->city }}</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="{{ route('officer.editProfile') }}" class="btn btn-primary" title="Edit Profile">
                                <i class="fas fa-edit"></i> <!-- Edit symbol -->
                            </a>
                        </div>
                    </div>
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
