<div class="row">

  {{-- jumlah pengguna --}}
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card" style="height: 150px; width: 100%;">
      <div class="card-body p-4 mt-2">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah<br>Pengguna</p>
              <h5 class="font-weight-bolder">
                {{ $totalUsers }} Orang
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- jumlah permohonan --}}
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card" style="height: 150px; width: 100%;">
      <div class="card-body p-4 mt-2">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah<br>Permohonan</p>
              <h5 class="font-weight-bolder">
                {{ $totalMcApplications }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
              <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- jumlah permohonan diterima --}}
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card" style="height: 150px; width: 100%;">
      <div class="card-body p-4 mt-2">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Permohonan<br>diterima</p>
              <h5 class="font-weight-bolder">
                {{ $acceptedMcApplications }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- jumlah permohonan ditolak --}}
  <div class="col-xl-3 col-sm-6">
    <div class="card" style="height: 150px; width: 100%;">
      <div class="card-body p-4 mt-2">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Permohonan<br>ditolak</p>
              <h5 class="font-weight-bolder">
                {{ $rejectedMcApplications }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
              <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>


