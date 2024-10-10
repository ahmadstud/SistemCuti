<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <!-- First Card (Cuti Sakit) -->
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 d-flex align-items-center justify-content-center">
                <div class="card-body p-5 text-center">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">Cuti Sakit</p>
                        <h5 class="font-weight-bolder">{{ Auth::user()->total_mc_days }} Hari</h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle" style="width: 50px; height: 50px; margin-top: 10px;">
                        <i class="fas fa-user-injured" style="font-size: 1.5rem; opacity: 10;" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Card (Cuti Tahunan) -->
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 d-flex align-items-center justify-content-center">
                <div class="card-body p-5 text-center">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">Cuti Tahunan</p>
                        <h5 class="font-weight-bolder">{{ Auth::user()->total_annual }} Hari</h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-info shadow-primary text-center rounded-circle" style="width: 50px; height: 50px; margin-top: 10px;">
                        <i class="fas fa-umbrella-beach" style="font-size: 1.5rem; opacity: 10;" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Card (Cuti lain-lain) -->
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 d-flex align-items-center justify-content-center">
                <div class="card-body p-5 text-center">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">Cuti lain-lain</p>
                        <h5 class="font-weight-bolder">{{ Auth::user()->total_others }} Hari</h5>
                    </div>
                    <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle" style="width: 50px; height: 50px; margin-top: 10px;">
                        <i class="fas fa-calendar-plus" style="font-size: 1.5rem; opacity: 10;" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
