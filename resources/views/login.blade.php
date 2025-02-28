<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/Erawhiz.png">
    <link rel="icon" type="image/png" href="./assets/img/Erawhiz.png">
    <title>
      Sistem Permohonan Cuti
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  </head>

<body>
  <main class="main-content mt-0">
    <!-- Full-screen header with background image -->
    <div class="page-header min-vh-100 d-flex flex-column justify-content-center align-items-center m-0 border-radius-none"
         style="background-image: url('https://images.squarespace-cdn.com/content/v1/549d41a3e4b003c6ce131926/1473250081033-Z1HR2ON8Z4RMNSDWHN9V/Kuala_Lumpur-Web-107-20150501.jpg?format=1500w');
                background-position: center; background-size: cover;">

      <!-- Dark overlay for the background -->
      <span class="mask bg-gradient-dark opacity-6 position-absolute w-100 h-100"></span>

      <!-- Logo and Title Section (Centered and excluded from opacity) -->
        <div class="text-center z-index-1">
            <h1 class="text-white mb-2 mt-5">
                <a href="https://www.erawhizict.com.my/">
                    <img src="{{ asset('assets/img/Erawhiz.png') }}" alt="Logo"
                        style="width: 200px; height: auto; background-color: white; padding: 10px; border-radius: 10px;">
                </a>
            </h1><br>
            <p class="text-lead text-white">Sistem Permohonan Cuti</p>
        </div>

        <!-- Login Card Centered Vertically and Horizontally -->
        <div class="container d-flex justify-content-center align-items-center h-100 z-index-2">
          <div class="col-xl-4 col-lg-5 col-md-7">
              <div class="card z-index-3">
                  <div class="card-header text-center pt-4">
                      <h5>Daftar Masuk</h5>
                      <p class="mb-0">Masukkan nama dan kata laluan</p>
                  </div>
                  <div class="card-body">
                      <form role="form" action="{{ route('login') }}" method="POST" id="login-form">
                          @csrf
                          <div class="mb-3">
                              <input type="text" class="form-control form-control-lg" placeholder="Nama" name="username" required>
                          </div>
                          <div class="mb-3">
                              <input type="password" class="form-control form-control-lg" placeholder="Kata Laluan" name="password" required>
                          </div>

                          <div class="text-center">
                              <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Log Masuk</button>
                          </div>
                          <p class="text-sm mt-3 mb-0 text-center">Lupa Kata Laluan?
                              <a href="#" class="text-dark font-weight-bolder" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">Tukar Kata Laluan</a>
                          </p>
                      </form>
                  </div>
              </div>
          </div>
        </div>

        <script>
          // Check if there is a session flash message for success or error
          @if(session('error'))
              Swal.fire({
                  title: 'Ralat!',
                  text: '{{ session('error') }}',
                  icon: 'error',
                  confirmButtonText: 'Tutup'
              });
          @elseif(session('success'))
              Swal.fire({
                  title: 'Berjaya!',
                  text: '{{ session('success') }}',
                  icon: 'success',
                  confirmButtonText: 'Okay'
              }).then(() => {
                  window.location.href = '{{ url('/') }}'; // Redirect to home after success
              });
          @endif

          // Check if there are validation errors for specific fields
          @if($errors->any())
              Swal.fire({
                  title: 'Ralat!',
                  text: '{{ $errors->first() }}',  // Show the first error message
                  icon: 'error',
                  confirmButtonText: 'Tutup'
              });
          @endif
        </script>


      

    </div>

    <!-- Modal for Reset Password -->
    <div class="modal fade z-index-5" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="resetPasswordModalLabel">Tukar Kata Laluan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="resetPasswordForm" action="{{ route('reset.password') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Emel</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan emel anda" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Kata Laluan Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukkan kata laluan baru" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Sahkan Kata Laluan Baru</label>
                    <input type="password" class="form-control" id="confirm_password" name="new_password_confirmation" placeholder="Sahkan kata laluan baru" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">Tukar Kata Laluan</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Success Message
  @if(session('success'))
  Swal.fire({
    icon: 'success',
    title: 'Berjaya',
    text: '{{ session('success') }}',
    timer: 3000,
    showConfirmButton: false
  });
  @endif

  // Error Messages
  @if($errors->any())
  Swal.fire({
    icon: 'error',
    title: 'Ralat',
    html: '{!! implode("<br>", $errors->all()) !!}',
    timer: 5000,
    showConfirmButton: true
  });
  @endif
</script>

</body>

</html>
