<!-- MC Apply Application Section -->
<div id="McApply" class="content-section" style="display: none;">
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>PERMOHONAN CUTI</b></h4>
    </nav>

    <!-- MC Applications Table Section -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container-fluid py-2">
                <div class="row">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h4 class="mb-2"></h4>
                                <!-- Add MC Application Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcApplicationModal">
                                    Memohon Surat Cuti
                                </button>
                            </div>
                        </div>

                       <!-- Add MC Application Modal -->
<div class="modal fade" id="mcApplicationModal" tabindex="-1" aria-labelledby="mcApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f0f0f0;">
                <h5 class="modal-title" id="mcApplicationModalLabel">Permohonan Cuti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('staff.mc.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Tarikh Mula<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Tarikh Tamat<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>

                    <!-- Leave Type Selection -->
                    <div class="col-md-12 mb-3">
                        <label for="leave_type" class="form-label">Jenis Cuti<span class="text-danger">*</span></label>
                        <select class="form-control" id="leave_type" name="leave_type" required>
                            <option value="mc">Cuti Sakit (MC)</option>
                            <option value="annual">Cuti Tahunan</option>
                            <option value="other">Lain-lain</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="document_path" class="form-label">Dokumen MC<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="document_path" name="document_path" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="reason" class="form-label">Ulasan<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Permohonan terus ke Admin:</label><br>
                        <input type="radio" id="yes" name="direct_admin_approval" value="1">
                        <label for="yes">Ya</label><br>
                        <input type="radio" id="no" name="direct_admin_approval" value="0" checked>
                        <label for="no">Tidak</label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


                        <!-- List of MC Applications -->
                        <div class="card-body">
                            <div style="overflow-x: auto; position: relative;">
                                @if($mcApplications->isEmpty())
                                    <div class="alert alert-warning" role="alert">
                                        Tiada permohonan yang dibuat.
                                    </div>
                                @else
                                    <table class="table table-striped table-bordered text-center" style="width: 100%;">
                                        <thead style="background-color: #f0f0f0;">
                                            <tr>
                                                <th style="width: 3%; position: sticky; left: 0;">BIL</th>
                                                <th style="width: 15%;">TARIKH MULA</th>
                                                <th style="width: 15%;">TARIKH TAMAT</th>
                                                <th style="width: 15%;">ULASAN</th>
                                                <th style="width: 15%;">DOKUMEN</th>
                                                <th style="width: 15%;">STATUS</th>
                                                <th style="width: 15%;">TINDAKAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($mcApplications as $index => $mcApplication)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $mcApplication->start_date }}</td>
                                                    <td>{{ $mcApplication->end_date }}</td>
                                                    <td>{{ $mcApplication->reason }}</td>
                                                    <td>
                                                        @if($mcApplication->document_path)
                                                            <a href="{{ Storage::url($mcApplication->document_path) }}" target="_blank" title="Download Dokumen">
                                                                <i class="fas fa-file-pdf text-lg me-1"></i> PDF
                                                            </a>
                                                        @else
                                                            <span>Tidak Ada Dokumen</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($mcApplication->admin_approved && $mcApplication->officer_approved)
                                                            <span class="badge bg-gradient-success">Diterima</span>
                                                        @elseif($mcApplication->officer_approved)
                                                            <span class="badge bg-gradient-warning">Kelulusan dalam proses</span>
                                                        @elseif($mcApplication->status == 'pending')
                                                            <span class="badge bg-gradient-warning">Dalam Proses</span>
                                                        @else
                                                            <span class="badge bg-gradient-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($mcApplication->admin_approved && $mcApplication->officer_approved)
                                                        Tiada Tindakan
                                                        @else
                                                        <!-- Button to trigger modal for editing -->
                                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editMcModal{{ $mcApplication->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <!-- Delete button -->
                                                        <form action="{{ route('staff.deleteMC', $mcApplication->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>

                                                        <!-- Edit MC applications -->
                                                        <div class="modal fade" id="editMcModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="editMcModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editMcModalLabel{{ $mcApplication->id }}">Kemas Kini Permohonan</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{ route('staff.mc.edit', $mcApplication->id) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <label for="start_date{{ $mcApplication->id }}" class="form-label">Tarikh Mula</label>
                                                                                <input type="date" class="form-control" id="start_date{{ $mcApplication->id }}" name="start_date" value="{{ $mcApplication->start_date }}" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="end_date{{ $mcApplication->id }}" class="form-label">Tarikh Tamat</label>
                                                                                <input type="date" class="form-control" id="end_date{{ $mcApplication->id }}" name="end_date" value="{{ $mcApplication->end_date }}" required>
                                                                            </div>

                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="leave_type{{ $mcApplication->id }}" class="form-label">Jenis Cuti<span class="text-danger">*</span></label>
                                                                                <select class="form-control" id="leave_type{{ $mcApplication->id }}" name="leave_type" required>
                                                                                    <option value="mc" {{ $mcApplication->leave_type == 'mc' ? 'selected' : '' }}>Cuti Sakit (MC)</option>
                                                                                    <option value="annual" {{ $mcApplication->leave_type == 'annual' ? 'selected' : '' }}>Cuti Tahunan</option>
                                                                                    <option value="other" {{ $mcApplication->leave_type == 'other' ? 'selected' : '' }}>Lain-lain</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="document_path{{ $mcApplication->id }}" class="form-label">Dokumen (Biarkan kosong jika tiada perubahan)</label>
                                                                                <input type="file" class="form-control" id="document_path{{ $mcApplication->id }}" name="document_path">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="reason{{ $mcApplication->id }}" class="form-label">Sebab</label>
                                                                                <textarea class="form-control" id="reason{{ $mcApplication->id }}" name="reason" rows="3" required>{{ $mcApplication->reason }}</textarea>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label>Permohonan terus ke admin?:</label><br>
                                                                                <input type="radio" id="yes{{ $mcApplication->id }}" name="direct_admin_approval" value="1" {{ $mcApplication->direct_admin_approval ? 'checked' : '' }}>
                                                                                <label for="yes{{ $mcApplication->id }}">Yes</label><br>
                                                                                <input type="radio" id="no{{ $mcApplication->id }}" name="direct_admin_approval" value="0" {{ !$mcApplication->direct_admin_approval ? 'checked' : '' }}>
                                                                                <label for="no{{ $mcApplication->id }}">No</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-primary">
                                                                                <i class="fas fa-save"></i>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
