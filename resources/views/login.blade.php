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

  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12"></div>
    </div>
  </div>

  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Daftar Masuk</h4>
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
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Daftar Masuk</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Right-side background and text -->
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('./assets/img/Erawhiz.png'); background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Sistem Cuti disediakan kepada staf-staf Era Whiz"</h4>
                <p class="text-white position-relative">Sistem yang memudahkan proses staf dan juga ketua bahagian untuk memohon cuti dengan penggunaan sistem.</p>
              </div>
            </div>

          </div> <!-- End of Row -->
        </div> <!-- End of Container -->
      </div> <!-- End of Page Header -->
    </section>
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
