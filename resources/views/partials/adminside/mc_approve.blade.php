<!-- Admin Approval Section -->
<div id="applications-section" class="content-section" style="display: none;">
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>KELULUSAN ADMIN UNTUK PERMOHONAN STAF<b></h4>
    </nav>

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container-fluid py-2">
                <div class="row">

                    <!-- List of Admin Approval -->
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
                                            <th style="width: 5%; position: sticky; left: 0; z-index: 1;  padding: 8px;">BIL</th>
                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">NAMA</th>
                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH MULA</th>
                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TARIKH AKHIR</th>
                                            <th style="width: 20%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">ULASAN</th>
                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DOKUMEN RUJUKAN</th>
                                            <th style="width: 15%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">DILULUSKAN OLEH</th>
                                            <th style="width: 10%;  padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($applications->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center" style="padding: 20px;">
                                                    <p class="text-muted">Tiada Permohonan</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach($applications as $application)
                                                <tr>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->id }}</p>
                                                    </td>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        <p class="text-m text-secondary">{{ $application->user_name }}</p>
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
                                                            <a href="{{ Storage::url($application->document_path) }}" target="_blank"><i class="fas fa-file-alt"></i></a>
                                                        @endif
                                                    </td>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        {{ $application->officer_approved ? 'Yes' : 'No' }}
                                                    </td>
                                                    <td style="background: white; z-index: 1; border: 1px solid #dee2e6; padding: 8px; overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                        @if($application->officer_approved && !$application->admin_approved)
                                                            <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                                            </form>
                                                        @else
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fas fa-check-double"></i></button>
                                                        @endif
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