<!-- Admin Approval Section -->
<div id="applications-section" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Permohonan Staf melalui Persetujuan Penyelia</h6>
                    </div>
                </div>
                <div class="card-body">
                    <!-- View Applications Section -->
                    <div id="viewApplications">
                        <div class="table-responsive">
                            <table class="table align-items-center" style="table-layout: auto;">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID Permohonan</th>
                                        <th class="text-center">Nama Staf</th>
                                        <th class="text-center">Tarikh Mula</th>
                                        <th class="text-center">Tarikh Tamat</th>
                                        <th class="text-center">Sebab</th>
                                        <th class="text-center">Dokumen</th>
                                        <th class="text-center">Persetujuan Penyelia</th>
                                        <th class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                        <tr>
                                            <td class="text-center">{{ $application->id }}</td>
                                            <td class="text-center">{{ $application->user_name }}</td>
                                            <td class="text-center">{{ $application->start_date }}</td>
                                            <td class="text-center">{{ $application->end_date }}</td>
                                            <td class="text-center">{{ $application->reason }}</td> <!-- Displaying reason directly -->
                                            <td class="text-center">
                                                @if($application->document_path)
                                                    <a href="{{ Storage::url($application->document_path) }}" target="_blank"><i class="fas fa-file-alt"></i></a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $application->officer_approved ? 'Yes' : 'No' }}
                                            </td>
                                            <td class="text-center">
                                                @if($application->officer_approved && !$application->admin_approved)
                                                    <form action="{{ route('admin.approve', $application->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                                                    </form>
                                                @else
                                                    <button type="button" class="btn btn-secondary" disabled><i class="fas fa-check-double"></i></button>
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
    </div>
</div>
