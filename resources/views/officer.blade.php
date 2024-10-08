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
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/Erawhiz.png">
  <link rel="icon" type="image/png" href="./assets/img/Erawhiz.png">
  <title>
    Sistem Permohonan Cuti - Pegawai
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-500 bg-primary position-absolute w-100"></div>
    @include('partials.officerside.aside')

    <main class="main-content position-relative border-radius-lg">
        <div class="container-fluid py-4">
            @include('partials.logout')
            @include('partials.officerside.mcdays')

            <div class="row mt-4">
                <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
                    <div class="card">
                        <div class="card-header pb-1 p-1">
                            @include('partials.officerside.dashboard')
                            @include('partials.officerside.mc_approve')
                            @include('partials.officerside.mc_apply')
                            @include('partials.officerside.profile')
                            @include('partials.officerside.password')

            </div>
                </div>
                    </div>
                        </div>
        </div>
</main> <!-- Closing main-content -->

    <!-- Core JS Files -->
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <!-- Most Important JS Files -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>


</html>
