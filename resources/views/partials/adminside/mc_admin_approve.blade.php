<!-- Direct Admin Approval Section -->
<div id="admin-approval-section" class="content-section" style="display: none;">
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>KELULUSAN TERUS ADMIN UNTUK PERMOHONAN STAF<b></h4>
    </nav>

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container-fluid py-2">
                <div class="row">

                    {{-- List of Direct Admin Approval --}}
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h4 class="mb-2"></h4>
                            </div>
                        </div>


                        <!-- View Applications Section -->
                        <div class="card-body">
                            <div style="overflow-x: auto; position: relative;">
                                <table class="table" style="table-layout: fixed; width: 100%;">
                                    <thead style="background-color: #f0f0f0;">
                                        <tr>
                                            <th style="width: 3%; position: sticky; left: 0; z-index: 1;  padding: 8px;">BIL</th>
                                            <th style="width: 17%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                            <th style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($directAdminApplications->isEmpty())
                                            <tr>
                                                <td colspan="7" class="text-center" style="padding: 20px;">
                                                    <p class="text-muted">Tiada Permohonan</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($directAdminApplications as $application)
                                                <tr>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $loop->iteration }}</p>
                                                    </td>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->user->name }}</p>
                                                    </td>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->start_date }}</p>
                                                    </td>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->end_date }}</p>
                                                    </td>

                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->reason }}</p>
                                                    </td>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        @if($application->document_path)
                                                            <a href="{{ Storage::url($application->document_path) }}" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</a>
                                                        @endif
                                                    </td>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <div class="d-flex justify-content-start"> <!-- Flex container for side-by-side buttons -->
                                                            <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="margin-right: 5px;"> <!-- Add margin for spacing -->
                                                                @csrf
                                                                <button type="submit" class="btn btn-success" aria-label="Approve">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('admin.reject', $application->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger" aria-label="Reject">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>