<div class="container-fluid py-3">
    <div class="row">
        <!-- First Card: Jumlah Pengguna -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 d-flex align-items-center justify-content-center">
                <div class="card-body p-5 text-center">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">Jumlah Pengguna</p>
                        <h5 class="font-weight-bolder">{{ Auth::user()->totalUsers }} Orang</h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-info shadow-primary text-center rounded-circle" style="width: 50px; height: 50px; margin-top: 10px;">
                        <i class="fas fa-users" style="font-size: 1.5rem; opacity: 10;" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Card: Jumlah Permohonan -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 d-flex align-items-center justify-content-center">
                <div class="card-body p-5 text-center">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">Jumlah Permohonan</p>
                        <h5 class="font-weight-bolder">{{ Auth::user()->totalMcApplications }}</h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle" style="width: 50px; height: 50px; margin-top: 10px;">
                        <i class="fas fa-file-alt" style="font-size: 1.5rem; opacity: 10;" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Card: Jumlah Permohonan diterima -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 d-flex align-items-center justify-content-center">
                <div class="card-body p-5 text-center">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">Jumlah Permohonan diterima</p>
                        <h5 class="font-weight-bolder">{{ Auth::user()->acceptedMcApplications }}</h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle" style="width: 50px; height: 50px; margin-top: 10px;">
                        <i class="fas fa-check" style="font-size: 1.5rem; opacity: 10;" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fourth Card: Jumlah Permohonan ditolak -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 d-flex align-items-center justify-content-center">
                <div class="card-body p-5 text-center">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">Jumlah Permohonan ditolak</p>
                        <h5 class="font-weight-bolder">{{ Auth::user()->rejectedMcApplications }}</h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle" style="width: 50px; height: 50px; margin-top: 10px;">
                        <i class="fas fa-check" style="font-size: 1.5rem; opacity: 10;" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
