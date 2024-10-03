<!-- MC Application Section -->
<div id="McApply" class="content-section" style="display: none;">
    <!-- MC Applications Table Section -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Permohonan Cuti</h6>
                        <!-- Button to trigger MC Application Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcApplicationModal">
                            <i class="fas fa-file-alt"></i> Memohon Surat Cuti
                        </button>
                    </div>
                </div>

                <!-- MC Application Modal -->
                <div class="modal fade" id="mcApplicationModal" tabindex="-1" aria-labelledby="mcApplicationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mcApplicationModalLabel">Permohonan Cuti</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('officer.mcApplication.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Tarikh Mula</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">Tarikh Tamat</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="document_path" class="form-label">Dokumen MC</label>
                                        <input type="file" class="form-control" id="document_path" name="document_path" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Jenis Cuti:</label><br>
                                        <input type="radio" id="sick_leave" name="leave_type" value="sick" required>
                                        <label for="sick_leave">Cuti Sakit (MC)</label><br>
                                        <input type="radio" id="annual_leave" name="leave_type" value="annual" required>
                                        <label for="annual_leave">Cuti Tahunan</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="reason" class="form-label">Sebab</label>
                                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Hantar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- Closing modal -->

                <!-- MC Applications Table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">Bil</th>
                                <th class="text-center" width="10%">Tarikh Mula</th>
                                <th class="text-center" width="10%">Tarikh Tamat</th>
                                <th class="text-center" width="10%">Sebab</th>
                                <th class="text-center" width="10%">Dokumen</th>
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="10%">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mcApplications as $index => $mcApplication)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $mcApplication->start_date }}</td>
                                    <td class="text-center">{{ $mcApplication->end_date }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $mcApplication->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Modal for showing the reason -->
                                        <div class="modal fade" id="reasonModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="reasonModalLabel{{ $mcApplication->id }}">Sebab Permohonan MC</h5>
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
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                        @else
                                            <span>Tidak Ada Dokumen</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($mcApplication->admin_approved)
                                            <span class="badge bg-success">Diterima</span>
                                        @elseif($mcApplication->status == 'pending')
                                            <span class="badge bg-warning text-dark">Dalam Proses</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($mcApplication->status === 'pending')
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editMcModal{{ $mcApplication->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                             <!-- Edit MC Application Modal -->
                                             <div class="modal fade" id="editMcModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="editMcModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editMcModalLabel{{ $mcApplication->id }}">Kemas Kini Permohonan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('officer.mc.edit', $mcApplication->id) }}" method="POST" enctype="multipart/form-data">
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
                                                                <div class="mb-3">
                                                                    <label for="document_path{{ $mcApplication->id }}" class="form-label">Dokumen (Biarkan kosong jika tiada perubahan)</label>
                                                                    <input type="file" class="form-control" id="document_path{{ $mcApplication->id }}" name="document_path">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label>Jenis Cuti:</label><br>
                                                                    <input type="radio" id="sick_leave" name="leave_type" value="sick" {{ $mcApplication->leave_type === 'sick' ? 'checked' : '' }} required>
                                                                    <label for="sick_leave">Cuti Sakit (MC)</label><br>

                                                                    <input type="radio" id="annual_leave" name="leave_type" value="annual" {{ $mcApplication->leave_type === 'annual' ? 'checked' : '' }} required>
<label for="annual_leave">Cuti Tahunan</label>
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
                                            <form action="{{ route('officer.deleteMC', $mcApplication->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE') <!-- Include this line to specify that the method is DELETE -->
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Adakah anda pasti ingin menghapus permohonan ini?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span>-</span>
                                        @endif
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
