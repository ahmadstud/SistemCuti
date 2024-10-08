<!-- MC Approve Application Section -->
<div id="McApprove" class="content-section" style="display: none;">
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>SENARAI PERMOHONAN</b></h4> <!-- Fixed the closing b tag -->
    </nav>

    <!-- Applications Table Section -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container-fluid py-2">
                <div class="row">

                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h4 class="mb-2"></h4>
                            </div>
                        </div>

                        <!-- Applications Table -->
                        <div class="card-body">
                            <div style="overflow-x: auto; position: relative;">
                                @if($applications->isEmpty())
                                    <!-- Display a message when no applications exist -->
                                    <div class="alert alert-warning" role="alert">
                                        Tiada permohonan daripada staf.
                                    </div>
                                @else
                                    <table class="table" style="table-layout: fixed; width: 100%;">
                                        <thead style="background-color: #f0f0f0;">
                                            <tr>
                                                <th style="width: 5%; position: sticky; left: 0; z-index: 1; padding: 8px;">BIL</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">STATUS</th>
                                                <th style="width: 15%; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($applications as $application)
                                                <tr>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->id }}</p>
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->user_name }}</p>
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->start_date }}</p>
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->end_date }}</p>
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        @if($application->document_path)
                                                            <a href="{{ Storage::url($application->document_path) }}" target="_blank" class="btn btn-link p-0">
                                                                <i class="fas fa-file-alt"></i> <!-- Document icon -->
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        @if($application->admin_approved && $application->officer_approved)
                                                            <span class="badge bg-success">Diterima</span>
                                                        @elseif($application->admin_approved)
                                                            <span class="badge bg-info">Diterima</span>
                                                        @elseif($application->officer_approved)
                                                            <span class="badge bg-warning text-dark">Kebenaran Penyelia</span>
                                                        @elseif($application->status == 'pending')
                                                            <span class="badge bg-warning">Menunggu</span>
                                                        @else
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                    <td style="border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <!-- Accept or Reject Buttons -->
                                                        <form action="{{ route('officer.updateStatus',['id' => $application->id]) }}" method="POST">
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
                                @endif
                            </div>
                        </div>
                    </div> <!-- Closed card div -->
                </div>
            </div>
        </div>
    </div>
</div>
