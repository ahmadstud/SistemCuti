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
        <!-- Meta Information -->
        <!-- Character encoding for the document -->
        <meta charset="utf-8" />
        <!-- Responsive viewport for mobile and tablet devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Favicon and Touch Icon -->
        <!-- Apple touch icon for mobile devices -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/Erawhiz.png') }}">
        <!-- Favicon for browsers -->
        <link rel="icon" type="image/png" href="{{ asset('assets/img/Erawhiz.png') }}">

        <!-- Page Title -->
        <title>Admin - Bahagian Nota</title>

        <!-- Fonts and Icons -->
        <!-- Google Fonts (Open Sans) for consistent typography -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

        <!-- Nucleo Icons for enhanced UI elements -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

        <!-- Font Awesome Icons (For additional icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <!-- Core CSS Files -->
        <!-- Argon Dashboard styling for layout and UI components -->
        <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

        <!-- SweetAlert2 CSS for custom alert modals styling -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Summernote CSS and JS -->
        <!-- Summernote CSS for rich text editor styling -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
        <!-- jQuery, required for Summernote functionality -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Summernote JavaScript for rich text editor functionality -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

        <!-- SweetAlert2 JavaScript -->
        <!-- SweetAlert2 for alert modals -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- SweetAlert2 CSS for styling -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>


    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-500 position-absolute w-100" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;"></div>
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

                                <!-- Note Table Section -->
                                <div class="row mt-4">
                                    <div class="col-lg-12 mb-lg-0 mb-4">
                                        <div class="container-fluid py-2">
                                            <div class="row">

                                                <!-- List of Notes -->
                                                <div class="card my-4">
                                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                                            <h6 class="text-white text-capitalize ps-3">NOTA</h6>
                                                        </div>
                                                    </div>
                                                <br>

                                                <!-- Add Nota Button -->
                                                <div class="d-flex justify-content-end pe-3">
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNoteModal">
                                                        Tambah Nota
                                                    </button>
                                                </div>

                                                    <!-- Add Note Modal -->
                                                    <div class="modal fade" id="createNoteModal" tabindex="-1" aria-labelledby="createNoteLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #f0f0f0;">
                                                                    <h5 class="modal-title" id="createNoteLabel">Tambah Nota</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="announcementForm" action="{{ route('admin.storeNote') }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label for="title" class="form-label">Tajuk<span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="title" name="title" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="content" class="form-label">Isi Kandungan<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control summernote" id="content" name="content" rows="4" required></textarea>
                                                                        </div>
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
                                                                title: 'Adakah anda pasti?',
                                                                text: "Adakah anda ingin menghantar nota ini?",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Ya, hantar!'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    // Hantar borang
                                                                    document.getElementById('announcementForm').submit();
                                                                }
                                                            });
                                                        }
                                                    </script>

                                                    <!-- Initialize Summernote -->
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#content').summernote({
                                                                placeholder: 'Masukkan isi kandungan di sini...',
                                                                tabsize: 2,
                                                                height: 150, // Set height of the editor
                                                                toolbar: [ // Customize the toolbar
                                                                    ['style', ['bold', 'italic', 'underline', 'clear']],
                                                                    ['font', ['strikethrough', 'superscript', 'subscript']],
                                                                    ['fontsize', ['fontsize']],
                                                                    ['color', ['color']],
                                                                    ['para', ['ul', 'ol', 'paragraph']],
                                                                    ['insert', ['picture', 'link']],
                                                                    ['view', ['fullscreen', 'codeview', 'help']]
                                                                ]
                                                            });

                                                            // Re-initialize Summernote when the modal is opened
                                                            $('#createNoteModal').on('shown.bs.modal', function () {
                                                                $('#content').summernote('reset'); // Reset content
                                                            });
                                                        });
                                                    </script>

                                                {{-- List of Notes --}}
                                                <div class="card-body">
                                                    <div style="overflow-x: auto; position: relative;">
                                                        <table class="table">
                                                            <thead style="background-color: #f0f0f0;">
                                                                <tr>
                                                                    <th style="width: 5%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">BIL</th>
                                                                    <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">JENIS CUTI</th>
                                                                    <th style="width: 30%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ISI KANDUNGAN</th>
                                                                    <th style="width: 10%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($notes as $note)
                                                                    <tr>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{{ $note->title }}</p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <p class="text-m text-secondary">{!! $note->content !!}</p>
                                                                        </td>
                                                                        <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                                            <div class="d-flex justify-content-start"> <!-- Flex container for side-by-side buttons -->

                                                                                <!-- Edit Button -->
                                                                                <button class="btn btn-md btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editNoteModal{{ $note->id }}">
                                                                                    <i class="fas fa-pencil-alt">Kemaskini</i>
                                                                                </button>

                                                                                <!-- Delete button for note -->
                                                                                <form id="delete-form-{{ $note->id }}" action="{{ route('deleteNote', $note->id) }}" method="POST" style="margin: 0;">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="btn btn-md btn-danger" title="Delete" onclick="return confirmDelete(event, {{ $note->id }})">
                                                                                        <i class="fas fa-trash-alt">Padam</i> <!-- Delete symbol -->
                                                                                    </button>
                                                                                </form>

                                                                            </div>
                                                                        </td>

                                                                        <!-- Edit Note Modal -->
                                                                        <div class="modal fade" id="editNoteModal{{ $note->id }}" tabindex="-1" aria-labelledby="editNoteLabel{{ $note->id }}" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header" style="background-color: #f0f0f0;">
                                                                                        <h5 class="modal-title" id="editNoteLabel{{ $note->id }}">Kemaskini Nota</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form id="edit-form-{{ $note->id }}" action="{{ route('updateNote', $note->id) }}" method="POST" enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <div class="mb-3">
                                                                                                <label for="title{{ $note->id }}" class="form-label">Tajuk</label>
                                                                                                <input type="text" class="form-control" id="title{{ $note->id }}" name="title" value="{{ $note->title }}">
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="content{{ $note->id }}" class="form-label">Isi Kandungan</label>
                                                                                                <textarea class="form-control" id="content{{ $note->id }}" name="content" rows="4" required>{{ $note->content }}</textarea>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-success" onclick="confirmEditSubmit({{ $note->id }})">Simpan</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Script to initialize Summernote -->
                                                                        <script>
                                                                            // Initialize Summernote when the modal opens
                                                                            $('#editNoteModal{{ $note->id }}').on('shown.bs.modal', function () {
                                                                                $('#content{{ $note->id }}').summernote({
                                                                                    height: 200, // Set editor height
                                                                                    toolbar: [ // Customize toolbar
                                                                                        ['style', ['bold', 'italic', 'underline', 'clear']],
                                                                                        ['font', ['strikethrough', 'superscript', 'subscript']],
                                                                                        ['color', ['color']],
                                                                                        ['para', ['ul', 'ol', 'paragraph']],
                                                                                        ['insert', ['link', 'picture', 'video']],
                                                                                        ['view', ['fullscreen', 'codeview', 'help']]
                                                                                    ]
                                                                                });
                                                                            });
                                                                        </script>

                                                                        <script>
                                                                            // Function to confirm edit submit
                                                                            function confirmEditSubmit(noteId) {
                                                                                Swal.fire({
                                                                                    title: 'Adakah anda pasti?',
                                                                                    text: "Adakah anda ingin menyimpan perubahan ini?",
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonColor: '#3085d6',
                                                                                    cancelButtonColor: '#d33',
                                                                                    confirmButtonText: 'Ya, simpan!'
                                                                                }).then((result) => {
                                                                                    if (result.isConfirmed) {
                                                                                        // Hantar borang selepas pengesahan
                                                                                        document.getElementById('edit-form-' + noteId).submit();
                                                                                    }
                                                                                });
                                                                            }

                                                                            // Script to confirm delete
                                                                            function confirmDelete(event, noteId) {
                                                                                event.preventDefault(); // Prevent the form from submitting immediately
                                                                                Swal.fire({
                                                                                    title: 'Adakah anda pasti?',
                                                                                    text: "Tindakan ini tidak boleh dibatalkan!",
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonColor: '#3085d6',
                                                                                    cancelButtonColor: '#d33',
                                                                                    confirmButtonText: 'Ya, padam!'
                                                                                }).then((result) => {
                                                                                    if (result.isConfirmed) {
                                                                                        // Submit the form if confirmed
                                                                                        document.getElementById('delete-form-' + noteId).submit();
                                                                                    }
                                                                                });
                                                                            }

                                                                        </script>

                                                                        @if(session('success'))
                                                                        <script>
                                                                            Swal.fire({
                                                                                icon: 'success',
                                                                                title: 'Berjaya',
                                                                                text: '{{ session('success') }}',
                                                                            });
                                                                        </script>
                                                                        @endif

                                                                        @if(session('error'))
                                                                        <script>
                                                                            Swal.fire({
                                                                                icon: 'error',
                                                                                title: 'Oops...',
                                                                                text: '{{ session('error') }}',
                                                                            });
                                                                        </script>
                                                                        @endif

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

        <!-- Core JavaScript Files -->
        <!-- Popper.js for tooltip and popover positioning -->
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>

        <!-- Bootstrap JavaScript for responsive UI components -->
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

        <!-- Perfect Scrollbar for custom scrollbar styling -->
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>

        <!-- Smooth Scrollbar for smooth scrolling effects -->
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

        <!-- Chart.js for creating responsive charts -->
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

        <!-- Main application JavaScript file -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Argon Dashboard JavaScript for overall layout and functionality -->
        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

        <!-- SweetAlert2 for customizable alert modals -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    </body>
</html>
