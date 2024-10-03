<main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
    @include('partials.logout')
    @include('partials.staffside.mcdays')
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->

    <!-- MC Apply Application Section -->
<div id="McApply" class="content-section" style="display: none;">
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>PERMOHONAN CUTI<b></h4>
    </nav>
    <!-- MC Applications Table Section -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container-fluid py-2">
                <div class="row">

                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h4 class="mb-2"></h4>
                                <!-- Add MC Application Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcApplicationModal">
                                    Memohon Surat Cuti
                                </button>
                            </div>
                        </div>

                        <!-- Add MC Application Modal -->
                        <div class="modal fade" id="mcApplicationModal" tabindex="-1" aria-labelledby="mcApplicationModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                        <h5 class="modal-title" id="mcApplicationModalLabel">Permohonan Cuti</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('officer.mcApplication.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row g-3">
                                                <div class="col-md-6 mb-3">
                                                    <label for="start_date" class="form-label">Tarikh Mula<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="end_date" class="form-label">Tarikh Tamat<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="document_path" class="form-label">Dokumen MC<span class="text-danger">*</span></label>
                                                <input type="file" class="form-control" id="document_path" name="document_path" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="reason" class="form-label">Ulasan<span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- List of MC Applications -->
                        <div class="card-body">
                            <div style="overflow-x: auto; position: relative;">
                                <table class="table" style="table-layout: fixed; width: 100%;">
                                    <thead style="background-color: #f0f0f0;">
                                        <tr>
                                            <th style="width: 3%; position: sticky; left: 0; z-index: 1; padding: 8px;">BIL</th>
                                            <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                            <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH TAMAT</th>
                                            <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                            <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN</th>
                                            <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">STATUS</th>
                                            <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mcApplications as $index => $mcApplication)
                                            <tr>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $index + 1 }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $mcApplication->start_date }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $mcApplication->end_date }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $mcApplication->reason }}</p>
                                                </td>
                                                <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    @if($mcApplication->document_path)
                                                        <a href="{{ Storage::url($mcApplication->document_path) }}" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</a>
                                                    @else
                                                        <span>Tidak Ada Dokumen</span>
                                                    @endif
                                                </td>
                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    @if($mcApplication->admin_approved)
                                                        <span class="badge badge-md bg-gradient-success">Diluluskan</span>
                                                    @elseif($mcApplication->status == 'pending')
                                                        <span class="badge badge-md bg-gradient-warning">Menunggu</span>
                                                    @else
                                                        <span class="badge badge-md bg-gradient-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    @if ($mcApplication->status === 'pending')
                                                        <!-- Edit button -->
                                                        <button class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#editMcModal{{ $mcApplication->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>

                                                        <!-- Edit MC Application Modal -->
                                                        <div class="modal fade" id="editMcModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="editMcModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                                                        <h5 class="modal-title" id="editMcModalLabel{{ $mcApplication->id }}">Edit Permohonan MC</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('staff.mc.edit', $mcApplication->id) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="row g-3">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="start_date{{ $mcApplication->id }}" class="form-label">Tarikh Mula</label>
                                                                                    <input type="date" class="form-control" id="start_date{{ $mcApplication->id }}" name="start_date" value="{{ $mcApplication->start_date }}" required>
                                                                                </div>
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="end_date{{ $mcApplication->id }}" class="form-label">Tarikh Tamat</label>
                                                                                    <input type="date" class="form-control" id="end_date{{ $mcApplication->id }}" name="end_date" value="{{ $mcApplication->end_date }}" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="document_path{{ $mcApplication->id }}" class="form-label">Dokumen MC</label>
                                                                                <input type="file" class="form-control" id="document_path{{ $mcApplication->id }}" name="document_path">
                                                                                <p class="text-secondary">* Kosongkan jika tidak ingin menukar dokumen.</p>
                                                                            </div>
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="reason{{ $mcApplication->id }}" class="form-label">Ulasan</label>
                                                                                <textarea class="form-control" id="reason{{ $mcApplication->id }}" name="reason" rows="3" required>{{ $mcApplication->reason }}</textarea>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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

    <!-- Dashboard Section -->
    <div id="Dashboard" class="content-section" style="display: none;">
        <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
            <h4><b>DASHBOARD</b></h4> <!-- Fixed closing tag -->
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
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"
                                                    data-title="{{ $announcement->title }}"
                                                    data-content="{{ $announcement->content }}"
                                                    data-start-date="{{ $announcement->start_date }}"
                                                    data-end-date="{{ $announcement->end_date }}">
                                                    <div style="width: 100%; height: 0; padding-bottom: 40%; position: relative;">
                                                        <img src="{{ asset(Storage::url($announcement->image_path)) }}"
                                                            alt="{{ $announcement->title }}"
                                                            style="position: absolute; top: 50%; left: 50%; width: 100%; height: auto; transform: translate(-50%, -50%); object-fit: cover;">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Title and Content Section -->
                                        <div class="text-center mt-3">
                                            @if($announcements->count() > 0) <!-- Check if announcements exist -->
                                                <h2 id="announcementTitle" style="text-transform: uppercase;">{{ $announcements[0]->title }}</h2>
                                                <p id="announcementContent">{{ $announcements[0]->content }}</p>
                                                <p id="announcementDates">
                                                    Tarikh Buka: <strong id="startDate">{{ $announcements[0]->start_date }}</strong><br>
                                                    Tarikh Tutup: <strong id="endDate">{{ $announcements[0]->end_date }}</strong>
                                                </p>
                                            @else
                                                <h2>No Announcements</h2>
                                                <p>No announcements available at this time.</p>
                                            @endif
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

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const carouselElement = document.getElementById('announcementCarousel');

                                            carouselElement.addEventListener('slide.bs.carousel', function(event) {
                                                // Get the new active item
                                                const nextItem = event.relatedTarget;

                                                // Get data attributes
                                                const title = nextItem.getAttribute('data-title');
                                                const content = nextItem.getAttribute('data-content');
                                                const startDate = nextItem.getAttribute('data-start-date');
                                                const endDate = nextItem.getAttribute('data-end-date');

                                                // Update the content
                                                document.getElementById('announcementTitle').textContent = title;
                                                document.getElementById('announcementContent').textContent = content;
                                                document.getElementById('startDate').textContent = startDate;
                                                document.getElementById('endDate').textContent = endDate;
                                            });
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
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>PROFIL PEKERJA<b></h4>
    </nav>

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container-fluid py-2">
                <div class="row">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2"></h6>
                                <!-- Edit Profile Button -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editStaffProfile">
                                    Kemaskini Maklumat
                                </button>
                            </div>
                        </div>

                        <!-- Edit Profile Modal -->
                        <div class="modal fade" id="editStaffProfile" tabindex="-1" aria-labelledby="editStaffProfileLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                        <h5 class="modal-title" id="editStaffProfileLabel">KEMASKINI MAKLUMAT</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('updateOwnDetails2') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <!-- Profile Image Upload -->
                                        <div class="mb-3">
                                            <label for="profile_image" class="form-label">Muat Naik Gambar Profil</label>
                                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                                        </div>
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

                            <div class="card-body">
                                <!-- Profile Image -->
                                 <div class="text-center">
                                     @if(Auth::user()->profile_image)
                                         <img src="{{ asset('' . Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle" width="150" height="150">
                                     @else
                                         <img src="{{ asset('storage/profile_image/default.jpg') }}" alt="Default Profile Image" class="rounded-circle" width="150" height="150">
                                     @endif
                                 </div>
                             </div>

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

                            <!-- Job Status -->
                            <h5 class="mt-4">MAKLUMAT PEKERJAAN</h5>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="role" class="form-label">PERANAN</label>
                                    <p class="form-control" id="role">{{ Auth::user()->role }}</p>
                                </div>


                                <div class="col-md-4">
                                    <label for="assigned_officer" class="form-label">KETUA BAHAGIAN</label>
                                    <p class="form-control" id="assigned_officer">
                                        {{ Auth::user()->officer ? Auth::user()->officer->name : 'Tiada Penyelia' }}
                                    </p>
                                </div>

                                <div class="col-md-4">
                                    <label for="job_status" class="form-label">STATUS PEKERJAAN</label>
                                    <p class="form-control" id="job_status">{{ Auth::user()->job_status }}</p>
                                </div>

                                <div class="col-md-4">
                                    <label for="mc_days" class="form-label">JUMLAH CUTI</label>
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
</div>

<!-- Separate Change Password Section -->
<div id="ChangePassword" class="content-section" style="display: none;">
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>TUKAR KATA LALUAN</b></h4>
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
                            <form action="{{ route('updateOwnDetails2') }}" method="POST">
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

</main> <!-- Closing main-content -->
