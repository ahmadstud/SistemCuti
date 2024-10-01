<!-- MC Application Section -->
<div id="McApprove" class="content-section" style="display: none;">
    <!-- Applications Table Section -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Senarai Permohonan</h6>

                    </div>
                </div>
                <!-- Applications Table -->
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">ID</th>
                                <th class="text-center" width="10%">ID Pengguna</th>
                                <th class="text-center" width="10%">Tarikh Mula</th>
                                <th class="text-center" width="10%">Tarikh Tamat</th>
                                <th class="text-center" width="10%">Sebab</th>
                                <th class="text-center" width="10%">Dokumen</th>
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="10%">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td class="text-center">{{ $application->id }}</td>
                                    <td class="text-center">{{ $application->user_id }}</td>
                                    <td class="text-center">{{ $application->start_date }}</td>
                                    <td class="text-center">{{ $application->end_date }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $application->id }}">
                                            <i class="fas fa-eye"></i> <!-- View icon -->
                                        </button>

                                        <!-- Modal for showing the reason -->
                                        <div class="modal fade" id="reasonModal{{ $application->id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $application->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="reasonModalLabel{{ $application->id }}">Sebab Permohonan Dibuat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $application->reason }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        @if($application->document_path)
                                        <a href="{{ Storage::url($application->document_path) }}" target="_blank" class="btn btn-link p-0">
                                            <i class="fas fa-file-alt"></i> <!-- Document icon -->
                                        </a>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                        @if($application->admin_approved && $application->officer_approved)
                                            <span class="badge bg-success">Diterima</span>
                                        @elseif($application->admin_approved)
                                            <span class="badge bg-info">Admin Terima</span>
                                        @elseif($application->officer_approved)
                                            <span class="badge bg-warning text-dark">Separuh Terima</span>
                                        @elseif($application->status == 'pending')
                                            <span class="badge bg-warning">Dalam Proses</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <!-- Accept or Reject Buttons -->
                                        <form action="{{ route('officer.updateStatus', ['id' => $application->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" name="status" value="approved_by_officer" class="btn btn-success">
                                                <i class="fas fa-check"></i> <!-- Right symbol -->
                                            </button>
                                            <button type="submit" name="status" value="rejected" class="btn btn-danger">
                                                <i class="fas fa-times"></i> <!-- Wrong symbol -->
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
