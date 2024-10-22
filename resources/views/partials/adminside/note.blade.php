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
                                                </div>
                                                <br>

                                                <div class="d-flex justify-content-end pe-3">
                                                    <!-- Add Nota Button -->
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNoteModal">
                                                        Tambah Nota
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

                                                <!-- Add Note Modal -->
                                                <div class="modal fade" id="createNoteModal" tabindex="-1" aria-labelledby="createNoteLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #f0f0f0;">
                                                                <h5 class="modal-title" id="createNoteLabel">Tambah Nota</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('admin.storeNote') }}" method="POST" enctype="multipart/form-data">
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
                                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                                    </div>
                                                                </form>
                                                                

                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $('#createNoteModal').on('shown.bs.modal', function () {
                                                                            $('.summernote').summernote({
                                                                                height: 200, // Set editor height
                                                                                toolbar: [
                                                                                    ['style', ['style']],
                                                                                    ['font', ['bold', 'underline', 'clear']],
                                                                                    ['fontname', ['fontname']],
                                                                                    ['para', ['ul', 'ol', 'paragraph']],
                                                                                    ['insert', ['link', 'picture', 'video']],
                                                                                    ['view', ['fullscreen', 'codeview', 'help']]
                                                                                ]
                                                                            });
                                                                        });
                                                                    });
                                                                </script>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                {{-- List of Notes --}}
                                                <div class="card-body">
                                                    <div style="overflow-x: auto; position: relative;">
                                                        <table class="table" style="table-layout: fixed; width: 100%;">
                                                            <thead style="background-color: #f0f0f0;">
                                                                <tr>
                                                                    <th style="width: 5%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">BIL</th>
                                                                    <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TAJUK</th>
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
                                                                                    <i class="fas fa-pencil-alt"></i>
                                                                                </button>
                                                            
                                                                                <!-- Delete button for note -->
                                                                                <form action="{{ route('deleteNote', $note->id) }}" method="POST" style="margin: 0;"> <!-- Set margin to 0 for proper alignment -->
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="btn btn-md btn-danger" title="Delete">
                                                                                        <i class="fas fa-trash-alt"></i> <!-- Delete symbol -->
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                            
                                                                    <!-- Edit Note Modal -->
                                                                    <div class="modal fade" id="editNoteModal{{ $note->id }}" tabindex="-1" aria-labelledby="editNoteLabel{{ $note->id }}" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header" style="background-color: #f0f0f0;">
                                                                                    <h5 class="modal-title" id="editNoteLabel{{ $note->id }}">Kemaskini Nota</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="{{ route('updateNote', $note->id) }}" method="POST" enctype="multipart/form-data">
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
