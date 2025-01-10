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
        <!-- Sets the character encoding to UTF-8, ensuring proper display of text and symbols -->
        <meta charset="utf-8" />
        <!-- Configures the page for responsive design, adjusting layout based on device screen size -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- App Icon Settings -->
        <!-- Specifies an Apple Touch Icon for iOS devices -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/Erawhiz.png') }}">
        <!-- Specifies the favicon for browser tabs -->
        <link rel="icon" type="image/png" href="{{ asset('assets/img/Erawhiz.png') }}">

        <!-- Page Title -->
        <!-- Sets the title that appears on the browser tab -->
        <title>Admin - Bahagian Tukar Kata Laluan</title>

        <!-- Fonts and Icons -->
        <!-- Links Google Fonts with Open Sans font family for better typography -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

        <!-- Nucleo Icons for Argon Dashboard UI -->
        <!-- Provides Nucleo icon styles, specific to Argon Dashboard components -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

        <!-- Font Awesome Icons -->
        <!-- Font Awesome Icons (For additional icons) -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <!-- CSS Files -->
        <!-- Argon Dashboard's main stylesheet -->
        <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

        <!-- SweetAlert2 Styles -->
        <!-- Links SweetAlert2 CSS for styled alert pop-ups -->
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
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <!-- Adjust column to full width -->
                            <div class="card">
                                <div class="card-header pb-1 p-1">
                                    <!-- Separate Change Password Section -->
                                    <div class="d-flex align-items-center justify-content-between mb-4 p-3" style="background-color: rgba(0, 0, 0, 0);">
                                        <h4 class="mb-0 text-uppercase fw-bold">
                                            <b><i class="bi bi-speedometer2 me-2"></i> TUKAR KATA LALUAN</b>
                                        </h4>
                                    </div>
                    
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
                                                            <form id="passwordForm" action="{{ route('changePassword') }}" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="password" class="form-label">Kata Laluan Baru<span class="text-danger">*</span></label>
                                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="password_confirmation" class="form-label">Sahkan Kata Laluan Baru<span class="text-danger">*</span></label>
                                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" oninput="checkPasswordMatch();">
                                                                </div>
                    
                                                                <div id="password-alert" class="alert alert-danger d-none">Kata laluan tidak sepadan!</div>
                    
                                                                <div class="modal-footer">
                                                                    <button type="button" onclick="confirmPasswordChange()" class="btn btn-success btn-lg d-flex align-items-center justify-content-center">
                                                                        <i class="fas fa-save me-2"></i>
                                                                        <span>Simpan Kata Laluan Baru</span>
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
                    
                    <script>
                        function confirmPasswordChange() {
                            Swal.fire({
                                title: 'Adakah anda pasti?',
                                text: 'Pastikan semua maklumat adalah tepat!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Simpan!',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Show success alert after confirmation
                                    Swal.fire({
                                        title: 'Berjaya!',
                                        text: 'Kata laluan anda telah dikemaskini.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Close the modal after success alert
                                        $('#yourModalId').modal('hide'); // Make sure to replace 'yourModalId' with the actual modal ID
                                        document.getElementById('passwordForm').submit(); // Submit the form after showing success alert
                                    });
                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    Swal.fire(
                                        'Dibatalkan',
                                        'Proses tukar kata laluan dibatalkan.',
                                        'error'
                                    );
                                }
                            });
                        }
                    
                        function checkPasswordMatch() {
                            var password = document.getElementById("password").value;
                            var confirmPassword = document.getElementById("password_confirmation").value;
                            var alertBox = document.getElementById("password-alert");
                    
                            if (password !== confirmPassword) {
                                alertBox.classList.remove('d-none');
                            } else {
                                alertBox.classList.add('d-none');
                            }
                        }
                    </script>
                    
            </div>
        </main>

        <!-- Core JS Files -->
        <!-- Core Popper.js library to manage popper elements, tooltips, and popovers -->
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <!-- Core Bootstrap JS for Bootstrap-based UI components and functionality -->
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
        <!-- Plugin for smooth and responsive scrolling in containers -->
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <!-- Plugin to enable smooth scrolling transitions -->
        <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <!-- Chart.js plugin to create data visualizations and charts -->
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

        <!-- Primary Application JS -->
        <!-- Main application-specific JavaScript file, for custom scripts and functionalities -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Argon Dashboard JS -->
        <!-- Main script for Argon Dashboard, including parallax effects and example page scripts -->
        <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

        <!-- SweetAlert2 Library -->
        <!-- External library for custom-styled alert boxes and notifications -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    </body>
</html>
