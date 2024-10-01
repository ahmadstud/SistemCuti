 <!-- All MC application section -->
 <div id="all-applications-section" class="content-section" style="display: none;">
    <!--All MC application Table Section -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Senarai Permohonan Cuti (Semua)</h6>
                    </div>
                </div>

                <!-- All MC application Table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">Bil</th>
                                <th class="text-center" width="10%">Nama Pemohon</th>
                                <th class="text-center" width="10%">Peranan</th>
                                <th class="text-center" width="10%">Tarikh Mula</th>
                                <th class="text-center" width="10%">Tarikh Tamat</th>
                                <th class="text-center" width="10%">Sebab-sebab</th>
                                <th class="text-center" width="10%">Dokumen berkaitan</th>
                                <th class="text-center" width="10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allMcApplication as $index => $mcApplication)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $mcApplication->user_name }}</td> <!-- User's name -->
                                    <td class="text-center">{{ $mcApplication->user_role }}</td> <!-- User's role -->
                                    <td class="text-center">{{ $mcApplication->start_date }}</td>
                                    <td class="text-center">{{ $mcApplication->end_date }}</td>
                                    <td class="text-center">
                                        <!-- Button to trigger reason modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $mcApplication->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Modal for showing the reason -->
                                        <div class="modal fade" id="reasonModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="reasonModalLabel{{ $mcApplication->id }}">Sebab Permohonan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $mcApplication->reason }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($mcApplication->document_path)
                                            <a href="{{ Storage::url($mcApplication->document_path) }}" target="_blank" class="text-primary">
                                                <i class="fas fa-file-alt"></i> <!-- Document icon -->
                                            </a>
                                        @else
                                            <span>Tiada Dokumen</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($mcApplication->admin_approved && $mcApplication->officer_approved)
                                            <span class="badge bg-success">Diterima</span>
                                        @elseif($mcApplication->admin_approved)
                                            <span class="badge bg-info">Diterima terus</span>
                                        @elseif($mcApplication->officer_approved)
                                            <span class="badge bg-info">Permohonan diterima</span>
                                        @elseif($mcApplication->status == 'pending')
                                            <span class="badge bg-warning text-dark">Dalam Proses</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div> <!-- Closing table-responsive -->
            </div> <!-- Closing card -->
        </div> <!-- Closing col-lg-12 -->
    </div> <!-- Closing row -->
</div> <!-- Closing McApply section -->
