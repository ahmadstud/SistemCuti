<div class="d-flex justify-content-center">
    <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
        <div class="card" style="height: 200px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-md mb-0 text-uppercase font-weight-bold" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">Jumlah Cuti berbaki</p>
                            <h5 class="font-weight-bolder" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ Auth::user()->total_mc_days }} Hari</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
