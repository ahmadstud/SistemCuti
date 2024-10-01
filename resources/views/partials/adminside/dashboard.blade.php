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
