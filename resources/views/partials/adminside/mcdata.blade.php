<div class="container-fluid py-3">
    <div class="row">

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" style="height: 200px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> <!-- Set a fixed height and text wrapping -->
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-md mb-0 text-uppercase font-weight-bold" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">Jumlah Pengguna</p> <!-- Ensure text wrapping in p element -->
                                <h5 class="font-weight-bolder" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ $totalUsers }} Orang</h5> <!-- Ensure text wrapping in h5 element -->
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-primary text-center rounded-circle" style="width: 60px; height: 60px;">
                                <i class="fas fa-users" style="font-size: 2rem; opacity: 10;" aria-hidden="true"></i> <!-- User List Icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" style="height: 200px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> <!-- Set a fixed height and text wrapping -->
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-md mb-0 text-uppercase font-weight-bold" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">Jumlah Permohonan</p>
                                <h5 class="font-weight-bolder" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ $totalMcApplications }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle" style="width: 60px; height: 60px;"> <!-- Set fixed size for circle -->
                                <i class="fas fa-file-alt" style="font-size: 2rem; opacity: 10;" aria-hidden="true"></i> <!-- Larger icon size -->
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" style="height: 200px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;" > <!-- Set a fixed height -->
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-md mb-0 text-uppercase font-weight-bold" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">Jumlah Permohonan diterima</p>
                                <h5 class="font-weight-bolder" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ $acceptedMcApplications }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle" style="width: 60px; height: 60px;">
                                <i class="fas fa-check-circle" style="font-size: 2rem; opacity: 10;" aria-hidden="true"></i> <!-- Approved Icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" style="height: 200px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"> <!-- Set a fixed height -->
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-md mb-0 text-uppercase font-weight-bold" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">Jumlah Permohonan ditolak</p>
                                <h5 class="font-weight-bolder" style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">{{ $rejectedMcApplications }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle" style="width: 60px; height: 60px;">
                                <i class="fas fa-times-circle"  style="font-size: 2rem; opacity: 10;" aria-hidden="true"></i> <!-- Rejected Icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
