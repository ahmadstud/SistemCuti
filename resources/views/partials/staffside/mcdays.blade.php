<div class="container-fluid py-3">
    <div class="row">
        <!-- First Card -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 d-flex align-items-center justify-content-center">
                <div class="card-body p-5 text-center">

                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">Cuti Sakit</p>
                        <h5 class="font-weight-bolder" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ Auth::user()->total_mc_days }} Hari</h5>
                    </div>

                    <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                        <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                    </div>

                </div>
            </div>
        </div>

         <!-- Second Card -->
         <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 d-flex align-items-center justify-content-center">
                <div class="card-body p-5 text-center">

                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">Cuti Tahunan</p>
                        <h5 class="font-weight-bolder" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ Auth::user()->total_annual }} Hari</h5>
                    </div>

                    <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                        <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                    </div>

                </div>
            </div>
        </div>

         <!-- Third Card -->
         <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 d-flex align-items-center justify-content-center">
                <div class="card-body p-5 text-center">

                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">Cuti lain-lain</p>
                        <h5 class="font-weight-bolder" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ Auth::user()->total_others }} Hari</h5>
                    </div>

                    <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                        <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
