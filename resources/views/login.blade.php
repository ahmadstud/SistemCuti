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
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  </head>

<body>
  @if(session('login_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Login Successful!',
                text: "Welcome to the Sistem Permohonan Cuti, {{ session('user_name') }}!",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
  @endif

  @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Login Failed!',
                text: "@foreach ($errors->all() as $error) {{ $error }} @endforeach",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
  @endif

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboard.html">
        Era Whiz ICT
      </a>
    </div>
  </nav>
  <!-- End Navbar -->

  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">
              <img src="{{ asset('assets/img/Erawhiz.png') }}" alt="Logo" 
                   style="width: 200px; height: auto; background-color: white; padding: 10px; border-radius: 10px;">
            </h1><br>
            <p class="text-lead text-white">Sistem Permohonan Cuti</p>
          </div>
        </div>
        
        
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Daftar Masuk</h5>
              <p class="mb-0">Masukkan nama dan kata laluan</p>
            </div>

            <div class="card-body">
              <form role="form" action="{{ route('login') }}" method="POST">
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
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../js/app.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
