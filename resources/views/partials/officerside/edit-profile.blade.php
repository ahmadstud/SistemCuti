<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Kemaskini Profil
  </title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

</head>
<style>
    .form-container {
      margin-top: 50px; /* Add space from the top */
      max-width: 1000px; /* Set a maximum width for the form */
      width: 100%; /* Ensure full width */
    }

    .form-card {
      padding: 40px; /* Increased padding for better spacing */
    }

    .form-control {
      min-width: 300px; /* Set a minimum width for input fields */
    }
  </style>
<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    <main class="main-content position-relative border-radius-lg">
        <div class="container-fluid py-4 d-flex justify-content-center">
            <div class="row mt-4">
                <div class="col-lg-12 mb-lg-0 mb-4"> <!-- Full width for the form -->
                    <div class="card form-container">
                        <div class="card-header pb-1 p-1">
                            <div class="form-card">
                                <h2 class="text-center">Kemaskini Profil</h2> <!-- Centered title -->
                                <form action="{{ route('updateOwnDetails3') }}" method="POST">
                                    @csrf
                                    <h5 class="mt-4">Maklumat Profil</h5>
                                    <div class="row">
                                        <!-- Profile Information -->
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <!-- IC and Phone Number -->
                                        <div class="col-md-6">
                                            <label for="ic" class="form-label">IC</label>
                                            <input type="text" class="form-control" id="ic" name="ic" value="{{ Auth::user()->ic }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone_number" class="form-label">Nombor Telefon</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}">
                                        </div>
                                    </div>

                                    <h5 class="mt-4">Maklumat Alamat</h5>
                                    <div class="row mt-3">
                                        <!-- Address -->
                                        <div class="col-md-12">
                                            <label for="address" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <!-- Postcode, State, City -->
                                        <div class="col-md-4">
                                            <label for="postcode" class="form-label">Poskod</label>
                                            <input type="text" class="form-control" id="postcode" name="postcode" value="{{ Auth::user()->postcode }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="state" class="form-label">Negeri</label>
                                            <input type="text" class="form-control" id="state" name="state" value="{{ Auth::user()->state }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="city" class="form-label">Bandar</label>
                                            <input type="text" class="form-control" id="city" name="city" value="{{ Auth::user()->city }}">
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Kemaskini</button>
                                        <a href="{{ route('officer') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </form>
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
    <!-- Most Important JS Files -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
</body>

</html>
