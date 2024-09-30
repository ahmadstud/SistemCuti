<!-- Mc Remaining Days -->
<div class="container-fluid py-4">
    <div class="row">
      <!-- First Card -->
      <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4 color-green">
        <div class="card"> <!-- Inline style for green background -->
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8 text-center">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold position:center">Jumlah Cuti yang berbaki</p>
                  <h5 class="font-weight-bolder">{{ Auth::user()->total_mc_days }} Hari</h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                  <i class="ni ni-sound-wave text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
