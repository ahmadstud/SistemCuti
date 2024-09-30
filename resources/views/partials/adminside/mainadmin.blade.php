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
                                                        <p id="announcementContent">tarikh mula - tarikh akhir</p>
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
                                                <h4 class="text-capitalize"></h4>
                                                <!-- Add Pengumuman Button -->
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
                                                    Tambah Pengumuman
                                                </button>
                                            </div>

                                            <!-- Add Announcement Modal -->
                                            <div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="background-color: #f0f0f0;">
                                                            <h5 class="modal-title" id="createAnnouncementLabel">Tambah Pengumuman</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.storeAnnouncement') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label">Tajuk<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="title" name="title" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="content" class="form-label">Isi Kandungan<span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <label for="announcementStartDate" class="form-label">Tarikh Mula<span class="text-danger">*</span></label>
                                                                        <input type="date" class="form-control" id="announcementStartDate" name="start_date" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="announcementEndDate" class="form-label">Tarikh Akhir<span class="text-danger">*</span></label>
                                                                        <input type="date" class="form-control" id="announcementEndDate" name="end_date" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="image" class="form-label">Gambar<span class="text-danger">*</span></label>
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

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        {{-- List of Announcements --}}
                                        <div class="card-body">
                                            <div style="overflow-x: auto; position: relative;">
                                                <table class="table" style="table-layout: fixed; width: 100%;">
                                                    <thead style="background-color: #f0f0f0;">
                                                        <tr>
                                                            <th style="width: 3%; position: sticky; left: 0; z-index: 1; padding: 8px;">BIL</th>
                                                            <th style="width: 15%; padding: 8px;">TAJUK</th>
                                                            <th style="width: 30%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ISI KANDUNGAN</th>
                                                            <th style="width: 10%; padding: 8px;">TARIKH MULA</th>
                                                            <th style="width: 10%; padding: 8px;">TARIKH AKHIR</th>
                                                            <th style="width: 20%; padding: 8px;">GAMBAR</th>
                                                            <th style="width: 10%; padding: 8px;">TINDAKAN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($announcements as $announcement)
                                                            <tr>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $announcement->title }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap; break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $announcement->content }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $announcement->title }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $announcement->title }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    @if($announcement->image_path)
                                                                        <img src="{{ asset('storage/' . $announcement->image_path) }}" class="d-block w-25" alt="{{ $announcement->title }}">
                                                                    @else
                                                                        No Image
                                                                    @endif
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px;">
                                                                    <!-- Edit Button -->
                                                                    <button class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal{{ $announcement->id }}">
                                                                        <i class="fas fa-pencil-alt"></i>
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
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color: #f0f0f0;">
                                                                            <h5 class="modal-title" id="editAnnouncementLabel{{ $announcement->id }}">Kemaskini Pengumuman</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('updateAnnouncement', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="mb-3">
                                                                                    <label for="title{{ $announcement->id }}" class="form-label">Tajuk</label>
                                                                                    <input type="text" class="form-control" id="title{{ $announcement->id }}" name="title" value="{{ $announcement->title }}" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="content{{ $announcement->id }}" class="form-label">Isi Kandungan</label>
                                                                                    <textarea class="form-control" id="content{{ $announcement->id }}" name="content" rows="4" required>{{ $announcement->content }}</textarea>
                                                                                </div>
                                                                                <div class="row mb-3">
                                                                                    <div class="col-md-6">
                                                                                        <label for="announcementStartDate" class="form-label">Tarikh Mula Pengumuman</label>
                                                                                        <input type="date" class="form-control" id="announcementStartDate" name="pm_tarikhmula">
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label for="announcementEndDate" class="form-label">Tarikh Akhir Pengumuman</label>
                                                                                        <input type="date" class="form-control" id="announcementEndDate" name="pm_tarikhakhir">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="image{{ $announcement->id }}" class="form-label">Gambar (pilihan)</label>
                                                                                    @if ($announcement->image_path)
                                                                                        <img src="{{ asset('storage/' . $announcement->image_path) }}" class="d-block w-25 mb-2" alt="{{ $announcement->title }}">
                                                                                    @endif
                                                                                    <input type="file" class="form-control" id="image{{ $announcement->id }}" name="image_path" accept="image/*">
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
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-success">Simpan</button>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            
                <!-- Senarai Pengguna section -->
                <div id="users-section" class="content-section" style="display: none;">
                    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                        <h4><b>SENARAI PEKERJA<b></h4>
                    </nav>

                    <div class="row mt-4">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="container-fluid py-2">
                                <div class="row">

                                    <!-- List of Staff -->
                                    <div class="card">
                                        <div class="card-header pb-0 p-3">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="text-capitalize"></h4>
                                                <!-- Add Staff/Officer Button -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                                                    Tambah Staff / Pegawai
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Add Staff/Officer Modal -->
                                        <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                                        <h5 class="modal-title" id="addStaffModalLabel">Tambah Staff / Pegawai</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('storeUser') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                        
                                                            <div class="row g-3">
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="name" class="form-label">Nama<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="email" class="form-label">E-mel<span class="text-danger">*</span></label>
                                                                    <input type="email" class="form-control" id="email" name="email" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="password" class="form-label">Kata Kunci<span class="text-danger">*</span></label>
                                                                    <input type="password" class="form-control" id="password" name="password" required>
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="ic" class="form-label">No K/P<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="ic" name="ic">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="phone_number" class="form-label">No Telefon<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="role" class="form-label">Peranan<span class="text-danger">*</span></label>
                                                                    <select class="form-select" id="role" name="role" required>
                                                                        <option selected disabled>--- Pilih Peranan ---</option>
                                                                        <option value="admin">Admin</option>
                                                                        <option value="staff">Staf</option>
                                                                        <option value="officer">Pegawai</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="job_status" class="form-label">Status Pekerjaan<<span class="text-danger">*</span></label>
                                                                    <select class="form-select" id="job_status" name="job_status" required>
                                                                        <option selected disabled>--- Pilih Status ---</option>
                                                                        <option value="Permenant">Tetap</option>
                                                                        <option value="Contract">Kontrak</option>
                                                                        <option value="Freelance">Berhenti</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="pegawai" class="form-label">Ketua Bahagian/Pegawai <span class="text-danger">*</span></label>
                                                                    <select class="form-select" id="pegawai" name="pegawai" required>
                                                                        <option selected disabled>--- Pilih Ketua Bahagian ---</option>
                                                                        <option value="Ketua 1 / Pegawai 1">Ketua 1 / Pegawai 1</option>
                                                                        <option value="Ketua 2 / Pegawai 2">Ketua 2 / Pegawai 2</option>
                                                                        <option value="Tiada Berkenaan">Tiada Berkenaan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="mc_days" class="form-label">Jumlah cuti<span class="text-danger">*</span></label>
                                                                    <input type="number" class="form-control" id="mc_days" name="mc_days" required min="1">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row g-3">
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="address" class="form-label">Alamat<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="address" name="address" required>
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="city" class="form-label">Bandar<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="city" name="city" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="postcode" class="form-label">Poskod<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="postcode" name="postcode" required>
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="state" class="form-label">Negeri<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="state" name="state" required>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- List of staff --}}
                                        <div class="card-body">
                                            <div style="overflow-x: auto; position: relative;">
                                                <table class="table" style="table-layout: fixed; width: 100%;">
                                                    <thead style="background-color: #f0f0f0;">
                                                        <tr>
                                                            <th style="width: 3%; position: sticky; left: 0; z-index: 1;  padding: 8px;">BIL</th>
                                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                                            <th style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">EMEL</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NO K/P</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NO TELEFON</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">PERANAN</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">KETUA BAHAGIAN</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">STATUS PEKERJAAN</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TIDAKAN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($users as $user)
                                                            <tr>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $user->name }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $user->email }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $user->ic }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $user->phone_number }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    @if($user->role == 'admin')
                                                                        <span class="badge badge-md bg-gradient-danger">{{ $user->role }}</span>
                                                                    @elseif($user->role == 'staff')
                                                                        <span class="badge badge-md bg-gradient-info">{{ $user->role }}</span>
                                                                    @elseif($user->role == 'officer')
                                                                        <span class="badge badge-md bg-gradient-warning">{{ $user->role }}</span>
                                                                    @else
                                                                        <span class="badge badge-md bg-gradient-secondary">{{ $user->role }}</span>
                                                                    @endif
                                                                </td>     
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $user->job_status }}</p>
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    @if($user->job_status == 'Permenant')
                                                                        <span class="badge badge-md bg-gradient-info">{{ $user->job_status }}</span>
                                                                    @elseif($user->job_status == 'Contract')
                                                                        <span class="badge badge-md bg-gradient-success">{{ $user->job_status }}</span>
                                                                    @else
                                                                        <span class="badge badge-md bg-gradient-secondary">{{ $user->job_status }}</span>
                                                                    @endif
                                                                </td>
                                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">

                                                                    <!-- Edit Button -->
                                                                    <button class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </button>
                                                
                                                                    <!-- Delete button -->
                                                                    <form action="{{ route('deleteUser', $user->id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-md btn-danger" title="Delete">
                                                                            <i class="fas fa-trash-alt"></i> <!-- Delete symbol -->
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>                                                 

                                                            <!-- Edit User Modal -->
                                                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color: #f0f0f0;">
                                                                            <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User - {{ $user->name }}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('updateUser', $user->id) }}" method="POST">
                                                                                @csrf
                                                                            
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-12 mb-3">
                                                                                        <label for="name{{ $user->id }}" class="form-label">Nama</label>
                                                                                        <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="email{{ $user->id }}" class="form-label">E-mel</label>
                                                                                        <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="ic{{ $user->id }}" class="form-label">No K/P</label>
                                                                                        <input type="text" class="form-control" id="ic{{ $user->id }}" name="ic" value="{{ $user->ic }}">
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="phone_number{{ $user->id }}" class="form-label">No Telefon</label>
                                                                                        <input type="text" class="form-control" id="phone_number{{ $user->id }}" name="phone_number" value="{{ $user->phone_number }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="role{{ $user->id }}" class="form-label">Peranan</label>
                                                                                        <select class="form-select" id="role{{ $user->id }}" name="role">
                                                                                            <option selected disabled>--- Pilih Peranan ---</option>
                                                                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                                            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staf</option>
                                                                                            <option value="officer" {{ $user->role == 'officer' ? 'selected' : '' }}>Pegawai</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="job_status{{ $user->id }}" class="form-label">Status Pekerjaan</label>
                                                                                        <select class="form-select" id="job_status{{ $user->id }}" name="job_status" required>
                                                                                            <option selected disabled>--- Pilih Status Pekerjaan ---</option>
                                                                                            <option value="Permenant" {{ $user->job_status == 'Permenant' ? 'selected' : '' }}>Tetap</option>
                                                                                            <option value="Contract" {{ $user->job_status == 'Contract' ? 'selected' : '' }}>Kontrak</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="pegawai" class="form-label">Ketua Bahagian/Pegawai</label>
                                                                                        <select class="form-select" id="pegawai" name="pegawai" required>
                                                                                            <option selected disabled>--- Pilih Ketua Bahagian ---</option>
                                                                                            <option value="Ketua 1 / Pegawai 1">Ketua 1 / Pegawai 1</option>
                                                                                            <option value="Ketua 2 / Pegawai 2">Ketua 2 / Pegawai 2</option>
                                                                                            <option value="Tiada Berkenaan">Tiada Berkenaan</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="mc_days{{ $user->id }}" class="form-label">MC Days</label>
                                                                                        <input type="number" class="form-control" id="mc_days{{ $user->id }}" name="total_mc_days" value="{{ $user->total_mc_days }}" required min="0">
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-12 mb-3">
                                                                                        <label for="address{{ $user->id }}" class="form-label">Address</label>
                                                                                        <input type="text" class="form-control" id="address{{ $user->id }}" name="address" value="{{ $user->address }}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="city{{ $user->id }}" class="form-label">City</label>
                                                                                        <input type="text" class="form-control" id="city{{ $user->id }}" name="city" value="{{ $user->city }}" required>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="postcode{{ $user->id }}" class="form-label">Postcode</label>
                                                                                        <input type="text" class="form-control" id="postcode{{ $user->id }}" name="postcode" value="{{ $user->postcode }}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="state{{ $user->id }}" class="form-label">State</label>
                                                                                        <input type="text" class="form-control" id="state{{ $user->id }}" name="state" value="{{ $user->state }}" required>
                                                                                    </div>
                                                                                </div>
                                                                           
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-success">Simpan</button>
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
                                        </div> <!-- Closing for card-body -->
                                    </div> <!-- Closing for card -->
                                </div>
                            </div>

                        </div> <!-- Closing for col-lg-12 -->
                    </div> <!-- Closing for row -->
                </div> 


                <!-- Senarai All Admin Approval Section -->
                <div id="all-approval-section" class="content-section" style="display: none;">
                    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                        <h4><b>SENARAI KESELURUHAN PERMOHONAN<b></h4>
                    </nav>

                    <div class="row mt-4">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="container-fluid py-2">
                                <div class="row">

                                    {{-- List of Direct Admin Approval --}}
                                    <div class="card">
                                        <div class="card-header pb-0 p-3">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-2"></h6>
                                            </div>
                                        </div>
                                        
                                        
                                        <!-- View Applications Section -->
                                        <div class="card-body">
                                            <div style="overflow-x: auto; position: relative;">
                                                <table class="table" style="table-layout: fixed; width: 100%;">
                                                    <thead style="background-color: #f0f0f0;">
                                                        <tr>
                                                            <th style="width: 3%; position: sticky; left: 0; z-index: 1;  padding: 8px;">BIL</th>
                                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAME</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TEMPOH BAKI CUTI</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">KEPUTUSAN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($directAdminApplications as $application)
                                                            <tr>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->user->name }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->start_date }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->end_date }}</p>
                                                                </td>
                                                                {{-- <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    
                                                                    <!-- Button to trigger modal to show reason -->
                                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#directReasonModal{{ $application->id }}" aria-label="View Reason">
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>

                                                                    <!-- Modal for showing the reason -->
                                                                    <div class="modal fade" id="directReasonModal{{ $application->id }}" tabindex="-1" aria-labelledby="directReasonModalLabel{{ $application->id }}" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="directReasonModalLabel{{ $application->id }}">Alasan Permohonan MC</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                                                                    {{ $application->reason }}
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td> --}}
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    @if($application->document_path)
                                                                        <a href="{{ Storage::url($application->document_path) }}" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</a>
                                                                    @endif
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    {{-- @if($status == 'Lulus')
                                                                    <span class="btn btn-success btn-xs" id="statusLulus">{{ $status }}</span>
                                                                    @else
                                                                        <span class="btn btn-danger btn-xs" id="statusGagal">{{ $status }}</span>
                                                                    @endif --}}
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
                </div>
                


                <!-- Admin Approval Section -->
                <div id="applications-section" class="content-section" style="display: none;">
                    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                        <h4><b>KELULUSAN ADMIN UNTUK PERMOHONAN STAF<b></h4>
                    </nav>

                    <div class="row mt-4">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="container-fluid py-2">
                                <div class="row">

                                    <!-- List of Admin Approval -->
                                    <div class="card">
                                        <div class="card-header pb-0 p-3">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="mb-2"></h4>
                                            </div>
                                        </div>

                                        <!-- View Applications Section -->
                                        <div class="card-body">
                                            <div style="overflow-x: auto; position: relative;">
                                                <table class="table" style="table-layout: fixed; width: 100%;">
                                                    <thead style="background-color: #f0f0f0;">
                                                        <tr>
                                                            <th style="width: 3%; position: sticky; left: 0; z-index: 1;  padding: 8px;">BIL</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAME</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                                            <th style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DILULUSKAN OLEH</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($applications as $application)
                                                            <tr>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->id }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->user_id }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->start_date }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->end_date }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    
                                                                    <!-- View button -->
                                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $application->id }}">
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>

                                                                    <!-- Modal for view the reason -->
                                                                    <div class="modal fade" id="reasonModal{{ $application->id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $application->id }}" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="reasonModalLabel{{ $application->id }}">Alasan Permohonan MC</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body" style="word-wrap: break-word; white-space: normal;">
                                                                                    {{ $application->reason }}
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    @if($application->document_path)
                                                                        <a href="{{ Storage::url($application->document_path) }}" target="_blank"><i class="fas fa-file-alt"></i></a>
                                                                    @endif
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    {{ $application->officer_approved ? 'Yes' : 'No' }}
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
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
                </div>



                <!-- Direct Admin Approval Section -->
                <div id="admin-approval-section" class="content-section" style="display: none;">
                    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                        <h4><b>KELULUSAN TERUS ADMIN UNTUK PERMOHONAN STAF<b></h4>
                    </nav>

                    <div class="row mt-4">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="container-fluid py-2">
                                <div class="row">

                                    {{-- List of Direct Admin Approval --}}
                                    <div class="card">
                                        <div class="card-header pb-0 p-3">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-2"></h6>
                                            </div>
                                        </div>
                                        
                                        
                                        <!-- View Applications Section -->
                                        <div class="card-body">
                                            <div style="overflow-x: auto; position: relative;">
                                                <table class="table" style="table-layout: fixed; width: 100%;">
                                                    <thead style="background-color: #f0f0f0;">
                                                        <tr>
                                                            <th style="width: 3%; position: sticky; left: 0; z-index: 1;  padding: 8px;">BIL</th>
                                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAME</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                                            <th style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($directAdminApplications as $application)
                                                            <tr>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->user->name }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->start_date }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->end_date }}</p>
                                                                </td>
                                                                {{-- <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    
                                                                    <!-- Button to trigger modal to show reason -->
                                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#directReasonModal{{ $application->id }}" aria-label="View Reason">
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>

                                                                    <!-- Modal for showing the reason -->
                                                                    <div class="modal fade" id="directReasonModal{{ $application->id }}" tabindex="-1" aria-labelledby="directReasonModalLabel{{ $application->id }}" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="directReasonModalLabel{{ $application->id }}">Alasan Permohonan MC</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                                                                    {{ $application->reason }}
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td> --}}
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                    @if($application->document_path)
                                                                        <a href="{{ Storage::url($application->document_path) }}" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</a>
                                                                    @endif
                                                                </td>
                                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
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
                </div>



                <!-- Profile Section -->
                <div id="Profile" class="content-section" style="display: none;">
                    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                        <h4><b>PROFIL PEKERJA<b></h4>
                    </nav>

                    <div class="row mt-4">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="container-fluid py-2">
                                <div class="row">

                                    <!-- Profile Card -->
                                    <div class="card">
                                        <div class="card-header pb-0 p-3">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="mb-2"></h4>
                                                <!-- Edit Profile Button -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editStaffProfil">
                                                    Kemaskini Maklumat
                                                </button>
                                                <!-- Edit maklumat -->
                                                {{-- <a href="{{ route('admin.editProfile') }}" class="btn btn-primary" title="Edit Profile">
                                                    Kemaskini Maklumat
                                                </a> --}}
                                            </div>
                                        </div>

                                        <!-- Edit Profile Modal -->
                                        <div class="modal fade" id="editStaffProfil" tabindex="-1" aria-labelledby="editStaffProfilLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                                        <h5 class="modal-title" id="editStaffProfilLabel">KEMASKINI MAKLUMAT</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('updateOwnDetails') }}"  method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                        
                                                            <!-- Profile Information -->
                                                            <h5 class="mt-4">MAKLUMAT DIRI</h5>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="name" class="form-label">NAMA</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="email" class="form-label">EMEL</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-6">
                                                                    <label for="ic" class="form-label">NO K/P</label>
                                                                    <input type="text" class="form-control" id="ic" name="ic" value="{{ Auth::user()->ic }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="phone_number" class="form-label">NO TELEFON</label>
                                                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}">
                                                                </div>
                                                            </div>

                                                            <!-- Address -->
                                                            <h5 class="mt-4">MAKLUMAT TEMPAT TINGGAL</h5>
                                                            <div class="row mt-3">
                                                                <div class="col-md-12">
                                                                    <label for="address" class="form-label">ALAMAT</label>
                                                                    <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-4">
                                                                    <label for="postcode" class="form-label">POSKOD</label>
                                                                    <input type="text" class="form-control" id="postcode" name="postcode" value="{{ Auth::user()->postcode }}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="city" class="form-label">BANDAR</label>
                                                                    <input type="text" class="form-control" id="city" name="city" value="{{ Auth::user()->city }}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="state" class="form-label">NEGERI</label>
                                                                    <input type="text" class="form-control" id="state" name="state" value="{{ Auth::user()->state }}">
                                                                </div>
                                                            </div>

                                                            {{-- Pekerjaan --}}
                                                            <h5 class="mt-4">MAKLUMAT PEKERJAAN</h5>
                                                            <div class="row mt-3">
                                                                <div class="col-md-4">
                                                                    {{-- <p class="form-control" id="role">{{ Auth::user()->role }}</p> --}}
                                                                    <label for="role{{ Auth::user()->role }}" class="form-label">PERANAN</label>
                                                                    <select class="form-select" id="role{{ Auth::user()->role }}" name="role">
                                                                        <option selected disabled>--- Pilih Peranan ---</option>
                                                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                        <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staf</option>
                                                                        <option value="officer" {{ $user->role == 'officer' ? 'selected' : '' }}>Pegawai</option>
                                                                    </select>
                                                                </div>


                                                                <div class="col-md-4">
                                                                    {{-- <p class="form-control" id="role">{{ Auth::user()->job_status }}</p> --}}
                                                                    <label for="job_status{{ Auth::user()->job_status }}" class="form-label">Status Pekerjaan</label>
                                                                    <select class="form-select" id="job_status{{ Auth::user()->job_status }}" name="job_status" required>
                                                                        <option selected disabled>--- Pilih Pekerjaan ---</option>
                                                                        <option value="Permenant" {{ $user->job_status == 'Permenant' ? 'selected' : '' }}>Tetap</option>
                                                                        <option value="Contract" {{ $user->job_status == 'Contract' ? 'selected' : '' }}>Kontrak</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    {{-- <p class="form-control" id="role">{{ Auth::user()->role }}</p> --}}
                                                                    <label for="pegawai" class="form-label">KETUA BAHAGIAN</label>
                                                                    <select class="form-select" id="pegawai" name="pegawai" required>
                                                                        <option selected disabled>--- Pilih Ketua Bahagian ---</option>
                                                                        <option value="Ketua 1 / Pegawai 1">Ketua 1 / Pegawai 1</option>
                                                                        <option value="Ketua 2 / Pegawai 2">Ketua 2 / Pegawai 2</option>
                                                                        <option value="Tiada Berkenaan">Tiada Berkenaan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-4">
                                                                    <label for="mc_days" class="form-label">JUMLAH CUTI</label>
                                                                    <p class="form-control" id="mc_days" required min="1">{{ Auth::user()->total_mc_days }}</p>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- View Profile Section -->
                                        <div class="card-body">

                                            <!-- Profile Information -->
                                            <h5 class="mt-4">MAKLUMAT DIRI</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="name" class="form-label">NAMA</label>
                                                    <p class="form-control" id="name">{{ Auth::user()->name }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">EMEL</label>
                                                    <p class="form-control" id="email">{{ Auth::user()->email }}</p>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label for="ic" class="form-label">NO K/P</label>
                                                    <p class="form-control" id="ic">{{ Auth::user()->ic }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phone_number" class="form-label">NO TELEFON</label>
                                                    <p class="form-control" id="phone_number">{{ Auth::user()->phone_number }}</p>
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <h5 class="mt-4">MAKLUMAT TEMPAT TINGGAL</h5>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label for="address" class="form-label">ALAMAT</label>
                                                    <p class="form-control" id="address">{{ Auth::user()->address }}</p>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="postcode" class="form-label">POSKOD</label>
                                                    <p class="form-control" id="postcode">{{ Auth::user()->postcode }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="city" class="form-label">BANDAR</label>
                                                    <p class="form-control" id="city">{{ Auth::user()->city }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="state" class="form-label">NEGERI</label>
                                                    <p class="form-control" id="state">{{ Auth::user()->state }}</p>
                                                </div>
                                            </div>

                                            {{-- Pekerjaan --}}
                                            <h5 class="mt-4">MAKLUMAT PEKERJAAN</h5>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="role" class="form-label">PERANAN</label>
                                                    <p class="form-control" id="role">{{ Auth::user()->role }}</p>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="job_status" class="form-label">STATUS PEKERJAAN</label>
                                                    <p class="form-control" id="role">{{ Auth::user()->job_status }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="role" class="form-label">KETUA BAHAGIAN</label>
                                                    <p class="form-control" id="role">{{ Auth::user()->role }}</p>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="mc_days" class="form-label">JUMLAH CUTI</label>
                                                    <p class="form-control" id="mc_days">{{ Auth::user()->total_mc_days }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Separate Change Password Section -->
                <div id="ChangePassword" class="content-section" style="display: none;">
                    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
                        <h4><b>TUKAR KATA LALUAN<b></h4>
                    </nav>

                    <div class="row mt-4">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="container-fluid py-2">
                                <div class="row">

                                    {{-- Tukar kata laluan --}}
                                    <div class="card">
                                        <div class="card-header pb-0 p-3">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-2"></h6>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <form action="{{ route('updateOwnDetails') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Kata Laluan Baru<span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password_confirmation" class="form-label">Sahkan Kata Laluan Baru<span class="text-danger">*</span></label>
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


