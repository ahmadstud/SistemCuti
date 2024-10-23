@if(Auth::check())
    @if(Auth::user()->role === 'admin')
        <!-- Display admin-specific content -->
    @elseif(Auth::user()->role === 'officer')
        <!-- Display officer-specific content -->
    @elseif(Auth::user()->role === 'staff')
        <!-- Display staff-specific content -->
    @endif
@endif

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/Erawhiz.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/img/Erawhiz.png') }}">
        <title>
            Sistem Permohonan Cuti - Staf
        </title>

        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Summernote CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">

        <!-- Summernote JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

        <!-- jQuery (required for Summernote) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    </head>


    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-500 bg-primary position-absolute w-100" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;"></div>
                    @include('partials.adminside.aside')

        <main class="main-content position-relative border-radius-lg">
            <div class="container-fluid py-4">
                     @include('partials.logout')
                    @include('partials.adminside.mcdata')

            <div class="row mt-4">
                <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
                    <div class="card">
                        <div class="card-header pb-1 p-1">

                            <!-- Announcement Section -->
                            <div class="d-flex align-items-center justify-content-between mb-4 p-3" style="background-color: rgba(0, 0, 0, 0);">
                                <h4 class="mb-0 text-uppercase fw-bold "><b>
                                    <i class="bi bi-speedometer2 me-2"></i> Pengurusan </b>
                                </h4>
                            </div>

                            <!-- Announcements Table Section -->
                            <div class="row mt-4">
                                <div class="col-lg-12 mb-lg-0 mb-4">
                                    <div class="container-fluid py-2">
                                        <div class="row">

                                            <!-- List of Announcements -->
                                            <div class="card my-4">
                                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                                        <h6 class="text-white text-capitalize ps-3">PENGUMUMAN</h6>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="d-flex justify-content-end pe-3">
                                                    <!-- Add Pengumuman Button -->
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
                                                        Tambah Pengumuman
                                                    </button>
                                                </div>

                                                    <!-- Display success message -->
                                                    @if(session('success'))
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                            {{ session('success') }}
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    @endif

                                                    <!-- Display error message -->
                                                    @if(session('error'))
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            {{ session('error') }}
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    @endif

                                                    <!-- Add Announcement Modal -->
                                                    <div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #f0f0f0;">
                                                                    <h5 class="modal-title" id="createAnnouncementLabel">Tambah Pengumuman</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="announcementForm" action="{{ route('admin.storeAnnouncement') }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label for="title" class="form-label">Tajuk<span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="title" name="title" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="content" class="form-label">Isi Kandungan<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control summernote" id="content" name="content" rows="4" required></textarea>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-6">
                                                                                <label for="start_date" class="form-label">Tarikh Mula<span class="text-danger">*</span></label>
                                                                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="end_date" class="form-label">Tarikh Akhir<span class="text-danger">*</span></label>
                                                                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="image" class="form-label">Gambar</label>
                                                                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                                        </div>
                                                                        <p class="text-muted">
                                                                            <em>Please upload images with the following specifications:
                                                                                <br> - Recommended size: **1200 x 675 pixels** (16:9 aspect ratio)
                                                                                <br> - Minimum width: **800 pixels**
                                                                                <br> - File formats: **JPG, PNG**
                                                                                <br> - Maximum file size: **2MB**</em>
                                                                        </p>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-success" onclick="confirmSubmission()">Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Script to handle confirmation using SweetAlert2 -->
                                                    <script>
                                                        function confirmSubmission() {
                                                            Swal.fire({
                                                                title: 'Are you sure?',
                                                                text: "Do you want to submit this announcement?",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Yes, submit it!'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    // Submit the form
                                                                    document.getElementById('announcementForm').submit();
                                                                }
                                                            });
                                                        }
                                                    </script>


                                                {{-- List of Announcements --}}
                                                <div class="card-body">
                                                    <div style="overflow-x: auto; position: relative;">
                                                        <table class="table" style="table-layout: fixed; width: 100%;">
                                                            <thead style="background-color: #f0f0f0;">
                                                                <tr>
                                                                    <th style="width: 5%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">BIL</th>
                                                                    <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TAJUK</th>
                                                                    <th style="width: 30%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ISI KANDUNGAN</th>
                                                                    <th style="width: 10%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                                                    <th style="width: 10%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                                                    <th style="width: 20%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">GAMBAR</th>
                                                                    <th style="width: 10%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($announcements as $announcement)
                                                                    <tr>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ $announcement->title }}</p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{!! $announcement->content !!}</p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ \Carbon\Carbon::parse($announcement->start_date)->format('d/m/Y') }}</p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ \Carbon\Carbon::parse($announcement->end_date)->format('d/m/Y') }}</p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            @if($announcement->image_path)
                                                                                <img src="{{ asset('storage/' . $announcement->image_path) }}" class="d-block w-40" alt="{{ $announcement->title }}">
                                                                            @else
                                                                                Tiada gambar
                                                                            @endif
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <div class="d-flex flex-wrap justify-content-start">
                                                                                <!-- Edit button to open the modal -->
                                                                                <button type="button" class="btn btn-md btn-primary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal{{ $announcement->id }}">
                                                                                    <i class="fas fa-pencil-alt"></i>
                                                                                </button>
                                                                        
                                                                                <!-- Delete button for announcement -->
                                                                                <form id="delete-form-{{ $announcement->id }}" action="{{ route('deleteAnnouncement', $announcement->id) }}" method="POST" style="margin: 0;">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="button" class="btn btn-md btn-danger mb-2" title="Delete" onclick="confirmDelete({{ $announcement->id }})">
                                                                                        <i class="fas fa-trash-alt"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </td>

                                                                        <!-- Edit Announcement Modal -->
                                                                        <div class="modal fade" id="editAnnouncementModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="editAnnouncementLabel{{ $announcement->id }}" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                                                                        <h5 class="modal-title" id="editAnnouncementLabel{{ $announcement->id }}">Kemaskini Pengumuman</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form id="edit-form-{{ $announcement->id }}" action="{{ route('updateAnnouncement', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <div class="mb-3">
                                                                                                <label for="title{{ $announcement->id }}" class="form-label">Tajuk</label>
                                                                                                <input type="text" class="form-control" id="title{{ $announcement->id }}" name="title" value="{{ $announcement->title }}">
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="content{{ $announcement->id }}" class="form-label">Isi Kandungan</label>
                                                                                                <textarea class="form-control" id="content{{ $announcement->id }}" name="content" rows="4" required>{{ $announcement->content }}</textarea>
                                                                                            </div>
                                                                                            <div class="row mb-3">
                                                                                                <div class="col-md-6">
                                                                                                    <label for="start_date" class="form-label">Tarikh Mula Pengumuman</label>
                                                                                                    <input type="date" class="form-control" id="start_date{{ $announcement->id }}" name="start_date" value="{{ $announcement->start_date }}">
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <label for="end_date" class="form-label">Tarikh Akhir Pengumuman</label>
                                                                                                    <input type="date" class="form-control" id="end_date{{ $announcement->id }}" name="end_date" value="{{ $announcement->end_date }}">
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
                                                                                                <em>Please upload images with the following specifications:
                                                                                                <br>
                                                                                                - Recommended size: **1200 x 675 pixels** (16:9 aspect ratio)
                                                                                                <br>
                                                                                                - Minimum width: **800 pixels**
                                                                                                <br>
                                                                                                - File formats: **JPG, PNG**
                                                                                                <br>
                                                                                                - Maximum file size: **2MB**</em>
                                                                                            </p>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-success" onclick="confirmEditSubmit({{ $announcement->id }})">Simpan</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <script>
                                                                            function confirmEditSubmit(announcementId) {
                                                                                Swal.fire({
                                                                                    title: 'Are you sure?',
                                                                                    text: "Do you want to save the changes?",
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonColor: '#3085d6',
                                                                                    cancelButtonColor: '#d33',
                                                                                    confirmButtonText: 'Yes, save it!'
                                                                                }).then((result) => {
                                                                                    if (result.isConfirmed) {
                                                                                        // Submit the form after confirmation
                                                                                        document.getElementById('edit-form-' + announcementId).submit();
                                                                                    }
                                                                                });
                                                                            }

                                                                            function confirmDelete(announcementId) {
                                                                                Swal.fire({
                                                                                    title: 'Are you sure?',
                                                                                    text: "This action cannot be undone!",
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonColor: '#3085d6',
                                                                                    cancelButtonColor: '#d33',
                                                                                    confirmButtonText: 'Yes, delete it!'
                                                                                }).then((result) => {
                                                                                    if (result.isConfirmed) {
                                                                                        // Submit the delete form after confirmation
                                                                                        document.getElementById('delete-form-' + announcementId).submit();
                                                                                    }
                                                                                });
                                                                            }
                                                                        </script>                                                                       
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
                    </div>
                </div>
            </div>
        </main>

        <!-- Core JS Files -->
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





    </body>
</html>
