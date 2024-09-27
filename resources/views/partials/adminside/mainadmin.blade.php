<main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
        @include ('partials.adminside.mcdata')

        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->

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

                <!-- Announcement Section -->
                <div id="Annouce" class="content-section" style="display: none;">
                    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                        <h4><b>PENGURUSAN<b></h4>
                    </nav>

                    <div class="row mt-4">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="container-fluid py-2">
                                <div class="row">

                                    <!-- List of Announcements -->
                                    <div class="card">
                                        <div class="card-header pb-0 p-3">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="text-capitalize">SENARAI PENGUMUMAN</h4>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">Create Announcement</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div style="overflow-x: auto; position: relative;">
                                                <table class="table" style="table-layout: fixed; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 3%;">NO</th>
                                                            <th style="width: 15%;">TAJUK</th>
                                                            <th style="width: 30%; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ISI KANDUNGAN</th>
                                                            <th style="width: 15%;">GAMBAR</th>
                                                            <th style="width: 10%;">TINDAKAN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($announcements as $announcement)
                                                            <tr>
                                                                <td style="position: sticky; left: 0; background: white; z-index: 1;"><p class="text-m text-secondary">{{ $loop->iteration }}</p></td>
                                                                <td><p class="text-m text-secondary">{{ $announcement->title }}</p></td>
                                                                <td style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $announcement->content }}</p>
                                                                </td>
                                                                <td>
                                                                    @if($announcement->image_path)
                                                                        <img src="{{ asset('storage/' . $announcement->image_path) }}" class="d-block w-25" alt="{{ $announcement->title }}">
                                                                    @else
                                                                        No Image
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <!-- Edit Button -->
                                                                    <button class="btn btn-md btn-warning" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal{{ $announcement->id }}">
                                                                        <i class="fas fa-pencil-alt text-m font-weight-bold me-2"></i>
                                                                    </button>
                                                                    <!-- Delete button for announcement -->
                                                                    <form action="{{ route('deleteAnnouncement', $announcement->id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-md btn-danger" title="Delete">
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
                                                                                    <label for="image{{ $announcement->id }}" class="form-label">Image (optional)</label>
                                                                                    <input type="file" class="form-control" id="image{{ $announcement->id }}" name="image_path" accept="image/*">
                                                                                </div>
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
                                                        <p class="text-muted">
                                                            Please upload images with the following specifications:
                                                            <br>
                                                            - Recommended size: **1200 x 675 pixels** (16:9 aspect ratio)
                                                            <br>
                                                            - Minimum width: **800 pixels**
                                                            <br>
                                                            - File formats: **JPG, PNG**
                                                            <br>
                                                            - Maximum file size: **2MB**
                                                        </p>
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
                                                            <label for="job_status" class="form-label">Job Status</label>
                                                            <select class="form-select" id="job_status" name="job_status" required>
                                                                <option value="Permenant">Permenant</option>
                                                                <option value="Contract">Contract</option>
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
                                                        <div class="col-md-6 mb-3">
                                                            <label for="selected_officer_id">Select Officer</label>
                                                            <select name="selected_officer_id" id="selected_officer_id" class="form-control">
                                                                <option value="">Select Officer</option> <!-- This allows for no selection -->
                                                                @foreach($officers as $officer)
                                                                    <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                                                                @endforeach
                                                            </select>
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
                                                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                                    <option value="officer" {{ $user->role == 'officer' ? 'selected' : '' }}>Officer</option>
                                                </select>
                                            </div>

                                                            <!-- Job Status -->
                                        <div class="col-md-6 mb-3">
                                            <label for="job_status{{ $user->id }}" class="form-label">Job Status</label>
                                            <select class="form-select" id="job_status{{ $user->id }}" name="job_status" required>
                                                <option value="Permenant" {{ $user->job_status == 'Permenant' ? 'selected' : '' }}>Permenant</option>
                                            <option value="Contract" {{ $user->job_status == 'Contract' ? 'selected' : '' }}>Contract</option>

                                            </select>
                                        </div>


                                            <!-- Address -->
                                            <div class="col-md-6 mb-3">
                                                <label for="address{{ $user->id }}" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address{{ $user->id }}" name="address" value="{{ $user->address }}" required>
                                            </div>

                                            <!-- City -->
                                            <div class="col-md-6 mb-3">
                                                <label for="city{{ $user->id }}" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city{{ $user->id }}" name="city" value="{{ $user->city }}" required>
                                            </div>

                                            <!-- Postcode -->
                                            <div class="col-md-6 mb-3">
                                                <label for="postcode{{ $user->id }}" class="form-label">Postcode</label>
                                                <input type="text" class="form-control" id="postcode{{ $user->id }}" name="postcode" value="{{ $user->postcode }}" required>
                                            </div>

                                            <!-- State -->
                                            <div class="col-md-6 mb-3">
                                                <label for="state{{ $user->id }}" class="form-label">State</label>
                                                <input type="text" class="form-control" id="state{{ $user->id }}" name="state" value="{{ $user->state }}" required>
                                            </div>

                                            <!-- MC Days -->
                                            <div class="col-md-6 mb-3">
                                                <label for="mc_days{{ $user->id }}" class="form-label">MC Days</label>
                                                <!-- Updated name to match the controller field 'total_mc_days' -->
                                                <input type="number" class="form-control" id="mc_days{{ $user->id }}" name="total_mc_days" value="{{ $user->total_mc_days }}" required min="0">
                                            </div>

                                            <!-- Select Officer -->
                                            <div class="col-md-6 mb-3">
                                                <label for="selected_officer_id">Select Officer</label>
                                                <select name="selected_officer_id" id="selected_officer_id" class="form-control">
                                                    <option value="">Select Officer</option>
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
                                </div> <!-- Closing for card-body -->
                            </div> <!-- Closing for card -->
                        </div> <!-- Closing for col-lg-12 -->
                    </div> <!-- Closing for row -->
                </div>
                <!-- Closing for users-section -->

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
</main>


