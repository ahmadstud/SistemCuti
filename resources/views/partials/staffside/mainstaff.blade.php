<main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
    @include('partials.staffside.mcdays')
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
          <div class="card">
            <div class="card-header pb-1 p-1">

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
                                <h5 class="modal-title" id="mcApplicationModalLabel">Apply for MC</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('staff.mc.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="document_path" class="form-label">MC Document</label>
                                        <input type="file" class="form-control" id="document_path" name="document_path" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reason" class="form-label">Reason</label>
                                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                    </div>


                    <div class="col-md-6 mb-3">
                        <label for="selected_officer_id">Officer</label>

                            @foreach($officers as $officer)
                            <option value="{{ $officer->id }}" {{ Auth::user()->selected_officer_id == $officer->id ? 'selected' : '' }}>
                                 {{ $officer->name }}
                            @endforeach
                        </select>
                    </div>


                                    <div class="mb-3">
                                        <label>Submit for Admin Approval:</label><br>
                                        <input type="radio" id="yes" name="direct_admin_approval" value="1">
                                        <label for="yes">Yes</label><br>
                                        <input type="radio" id="no" name="direct_admin_approval" value="0" checked>
                                        <label for="no">No</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                                <th class="text-center" width="10%">Sebab-sebab</th>
                                <th class="text-center" width="10%">Dokumen berkaitan</th>
                                <th class="text-center" width="10%">Status Permohonan</th>
                                <th class="text-center" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mcApplications as $index => $mcApplication)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $mcApplication->start_date }}</td>
                                    <td class="text-center">{{ $mcApplication->end_date }}</td>
                                    <td class="text-center">
                                        <!-- Button to trigger reason modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $mcApplication->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Modal for showing the reason -->
                                        <div class="modal fade" id="reasonModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="reasonModalLabel{{ $mcApplication->id }}">Reason for MC Application</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $mcApplication->reason }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($mcApplication->document_path)
        <a href="{{ Storage::url($mcApplication->document_path) }}" target="_blank" class="text-primary">
            <i class="fas fa-file-alt"></i> <!-- Document icon -->
        </a>
    @else
        <span>No Document</span>
    @endif
                                    </td>
                                    <td class="text-center">
                                        @if($mcApplication->admin_approved && $mcApplication->officer_approved)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($mcApplication->admin_approved)
                                        <span class="badge bg-info">Direct Admin Approved</span>
                                    @elseif($mcApplication->officer_approved)
                                        <span class="badge bg-info">Half Approve</span>
                                    @elseif($mcApplication->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($mcApplication->status === 'pending')
                                            <!-- Button to trigger modal -->
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editMcModal{{ $mcApplication->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <!-- Edit MC Application Modal -->
                                            <div class="modal fade" id="editMcModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="editMcModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editMcModalLabel{{ $mcApplication->id }}">Edit MC Application</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('staff.mc.edit', $mcApplication->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="start_date{{ $mcApplication->id }}" class="form-label">Start Date</label>
                                                                    <input type="date" class="form-control" id="start_date{{ $mcApplication->id }}" name="start_date" value="{{ $mcApplication->start_date }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="end_date{{ $mcApplication->id }}" class="form-label">End Date</label>
                                                                    <input type="date" class="form-control" id="end_date{{ $mcApplication->id }}" name="end_date" value="{{ $mcApplication->end_date }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="document_path{{ $mcApplication->id }}" class="form-label">MC Document (leave blank if not changing)</label>
                                                                    <input type="file" class="form-control" id="document_path{{ $mcApplication->id }}" name="document_path">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="reason{{ $mcApplication->id }}" class="form-label">Reason</label>
                                                                    <textarea class="form-control" id="reason{{ $mcApplication->id }}" name="reason" rows="3" required>{{ $mcApplication->reason }}</textarea>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label>Submit for Admin Approval:</label><br>
                                                                    <input type="radio" id="yes{{ $mcApplication->id }}" name="direct_admin_approval" value="1" {{ $mcApplication->direct_admin_approval ? 'checked' : '' }}>
                                                                    <label for="yes{{ $mcApplication->id }}">Yes</label><br>
                                                                    <input type="radio" id="no{{ $mcApplication->id }}" name="direct_admin_approval" value="0" {{ !$mcApplication->direct_admin_approval ? 'checked' : '' }}>
                                                                    <label for="no{{ $mcApplication->id }}">No</label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fas fa-save"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('staff.deleteMC', $mcApplication->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @elseif ($mcApplication->status === 'approved')
                                            <form action="{{ route('staff.deleteMC', $mcApplication->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            No Action
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- Closing table-responsive -->
            </div> <!-- Closing card -->
        </div> <!-- Closing col-lg-12 -->
    </div> <!-- Closing row -->
</div> <!-- Closing McApply section -->

 <!-- Dashboard Section -->
 <div id="Dashboard" class="content-section" style="display: none;">
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>DASHBOARD<b></h4>
    </nav>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">

            {{-- First Row --}}
            <div class="container-fluid py-2">
                <div class="row">

                    {{-- Card Pengumuman --}}
                    <div class="col-lg-12 mb-lg-0 mb-4">
                        <div class="card z-index-2 h-100">
                            <div class="card-header pb-0 pt-3 bg-transparent">
                                <h4 class="text-capitalize">PENGUMUMAN</h4>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Latest update on (timestamp)</span>
                                </p>
                            </div>

                            <div class="card-body p-3">

                                <!-- Announcement Carousel -->
                                <div id="announcementCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($announcements as $index => $announcement)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-title="{{ $announcement->title }}" data-content="{{ $announcement->content }}">
                                                <div style="width: 100%; height: 0; padding-bottom: 40%; position: relative;"> <!-- Adjusted padding-bottom -->
                                                    <img src="{{ asset(Storage::url($announcement->image_path)) }}"
                                                        alt="{{ $announcement->title }}"
                                                        style="position: absolute; top: 50%; left: 50%; width: 100%; height: auto; transform: translate(-50%, -50%); object-fit: cover;">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Title and Content Section -->
                                    <div class="text-center mt-3">
                                        <h2 id="announcementTitle" style="text-transform: uppercase;">{{ $announcements[0]->title }}</h2>
                                        <p id="announcementContent">{{ $announcements[0]->content }}</p>
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

                                <!-- JavaScript to Update Title and Content -->
                                <script>
                                    const carousel = document.getElementById('announcementCarousel');
                                    const titleElement = document.getElementById('announcementTitle');
                                    const contentElement = document.getElementById('announcementContent');

                                    carousel.addEventListener('slide.bs.carousel', function (event) {
                                        const currentItem = event.relatedTarget; // The currently active carousel item
                                        const title = currentItem.getAttribute('data-title');
                                        const content = currentItem.getAttribute('data-content');

                                        titleElement.textContent = title; // Update title
                                        contentElement.textContent = content; // Update content
                                    });
                                </script>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Second Row --}}
            <div class="container-fluid py-2">
                <div class="row ">

                    {{-- Card Purata Ketidakhadiran --}}
                    <div class="col-lg-7 mb-lg-0 mb-4">
                        <div class="card z-index-2 h-100">
                            <div class="card-header pb-0 pt-3 bg-transparent">
                                <h4 class="text-capitalize">PURATA KETIDAKHADIRAN</h4>
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

                    {{-- Card Senarai Staff Cuti Harian --}}
                    <div class="col-lg-5">
                        <div class="card h-100 mb-4">
                            <div class="card-header pb-0 px-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="text-capitalize">SENARAI STAFF CUTI HARIAN</h4>
                                </div>
                                <div class="col-md-4 d-flex justify-content-end align-items-center">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <small>September</small>
                                </div>
                            </div>
                            </div>

                            <div class="card-body pt-4 p-3">
                                <h6 class="text-uppercase text-body text-md font-weight-bolder mb-3">Hari ini</h6>
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

                                <h6 class="text-uppercase text-body text-md font-weight-bolder my-3">Esok</h6>
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

                        <h5 class="mt-4">Job Status</h5>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="role" class="form-label">Role</label>
                                <p class="form-control" id="role">{{ Auth::user()->role }}</p>
                            </div>

                            <div class="col-md-4">
                                <label for="job_status" class="form-label">Job Status</label>
                                <p class="form-control" id="role">{{ Auth::user()->job_status }}</p>
                            </div>

                            <div class="col-md-4">
                                <label for="mc_days" class="form-label">Total MC Days</label>
                                <p class="form-control" id="mc_days">{{ Auth::user()->total_mc_days }}</p>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <a href="{{ route('staff.editProfile') }}" class="btn btn-primary" title="Edit Profile">
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
                    <form action="{{ route('updateOwnDetails2') }}" method="POST">
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

  </main> <!-- Closing main-content -->
