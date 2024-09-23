<main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
    @include('partials.staffside.mcdays')
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
          <div class="card">
            <div class="card-header pb-1 p-1">
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcApplicationModal">Memohon Surat Cuti</button>
                    </div>
                </div>

                <!-- MC Application Modal -->
                <div class="modal fade" id="mcApplicationModal" tabindex="-1" aria-labelledby="mcApplicationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mcApplicationModalLabel">Apply for MC</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('staff.mc.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="document_path" class="form-label">MC Document</label>
                                        <input type="file" class="form-control" id="document_path" name="document_path" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reason" class="form-label">Reason</label>
                                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Choose Officer (optional):</label>
                                        <select name="selected_officer_id" id="officer" class="form-select">
                                            <option value="">-- None --</option>
                                            @foreach($officers as $officer)
                                                <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Submit for Admin Approval:</label><br>
                                        <input type="radio" id="yes" name="direct_admin_approval" value="1">
                                        <label for="yes">Yes</label><br>
                                        <input type="radio" id="no" name="direct_admin_approval" value="0" checked>
                                        <label for="no">No</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                                <th class="text-center" width="10%">Sebab-sebab</th>
                                <th class="text-center" width="10%">Status Permohonan</th>
                                <th class="text-center" width="10%">Dokumen-Dokumen berkaitan</th>
                                <th class="text-center" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mcApplications as $index => $mcApplication)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $mcApplication->start_date }}</td>
                                    <td class="text-center">{{ $mcApplication->end_date }}</td>
                                    <td class="text-center">
                                        <!-- Button to trigger reason modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $mcApplication->id }}">
                                            View Reason
                                        </button>

                                        <!-- Modal for showing the reason -->
                                        <div class="modal fade" id="reasonModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="reasonModalLabel{{ $mcApplication->id }}">Reason for MC Application</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $mcApplication->reason }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($mcApplication->document_path)
                                            <a href="{{ Storage::url($mcApplication->document_path) }}" target="_blank">View Document</a>
                                        @else
                                            No Document
                                        @endif
                                    </td>
                                    <td class="text-center">
                                    @if($mcApplication->admin_approved && $mcApplication->officer_approved)
                                    <div class="alert alert-success" role="alert">Approved</div>
                                    @elseif($mcApplication->admin_approved)
                                    <div class="alert alert-info" role="alert">Direct Admin Approved</div>
                                    @elseif($mcApplication->officer_approved)
                                        <div class="alert alert-info" role="alert">Half Approve</div>
                                    @elseif($mcApplication->status == 'pending')
                                    <div class="alert alert-warning" role="alert">Pending</div>
                                    @else
                                        <div class="alert alert-danger" role="alert">Rejected</div>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                    @if ($mcApplication->status === 'pending')
                                     <!-- Button to trigger modal -->
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editMcModal{{ $mcApplication->id }}">
                                        Update
                                    </button>
                                    <!-- Edit MC Application Modal -->
                                    <div class="modal fade" id="editMcModal{{ $mcApplication->id }}" tabindex="-1" aria-labelledby="editMcModalLabel{{ $mcApplication->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editMcModalLabel{{ $mcApplication->id }}">Edit MC Application</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('staff.mc.edit', $mcApplication->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="start_date{{ $mcApplication->id }}" class="form-label">Start Date</label>
                                                            <input type="date" class="form-control" id="start_date{{ $mcApplication->id }}" name="start_date" value="{{ $mcApplication->start_date }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="end_date{{ $mcApplication->id }}" class="form-label">End Date</label>
                                                            <input type="date" class="form-control" id="end_date{{ $mcApplication->id }}" name="end_date" value="{{ $mcApplication->end_date }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="document_path{{ $mcApplication->id }}" class="form-label">MC Document (leave blank if not changing)</label>
                                                            <input type="file" class="form-control" id="document_path{{ $mcApplication->id }}" name="document_path">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="reason{{ $mcApplication->id }}" class="form-label">Reason</label>
                                                            <textarea class="form-control" id="reason{{ $mcApplication->id }}" name="reason" rows="3" required>{{ $mcApplication->reason }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Choose Officer (optional):</label>
                                                            <select name="selected_officer_id" class="form-select">
                                                                <option value="">-- None --</option>
                                                                @foreach($officers as $officer)
                                                                    <option value="{{ $officer->id }}" {{ $officer->id == $mcApplication->selected_officer_id ? 'selected' : '' }}>{{ $officer->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Submit for Admin Approval:</label><br>
                                                            <input type="radio" id="yes{{ $mcApplication->id }}" name="direct_admin_approval" value="1" {{ $mcApplication->direct_admin_approval ? 'checked' : '' }}>
                                                            <label for="yes{{ $mcApplication->id }}">Yes</label><br>
                                                            <input type="radio" id="no{{ $mcApplication->id }}" name="direct_admin_approval" value="0" {{ !$mcApplication->direct_admin_approval ? 'checked' : '' }}>
                                                            <label for="no{{ $mcApplication->id }}">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Application</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('staff.deleteMC', $mcApplication->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @elseif ($mcApplication->status === 'approved')
                                    <form action="{{ route('staff.deleteMC', $mcApplication->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @else
                                    No Action
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


    <!-- Dashboard Section -->
    <div id="Dashboard" class="content-section" style="display: none;">
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">Dashboard</h6>
              </div>
            </div>
            <div class="card-body">
              <p>Welcome to the Dashboard</p>
              <!-- Add more dashboard content here -->
            </div>
          </div>
        </div>
      </div>
    </div> <!-- Closing Dashboard section -->

    <!-- Profile Section -->
    <div id="Profile" class="content-section" style="display: none;">
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">Profile</h6>
              </div>
            </div>
            <div class="card-body">
              <!-- View Profile Section -->
              <div id="viewProfile">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <p class="form-control" id="name">{{ Auth::user()->name }}</p>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <p class="form-control" id="email">{{ Auth::user()->email }}</p>
                </div>
                <div class="mb-3">
                  <label for="ic" class="form-label">IC</label>
                  <p class="form-control" id="ic">{{ Auth::user()->ic }}</p>
                </div>
                <div class="mb-3">
                  <label for="phone_number" class="form-label">Phone Number</label>
                  <p class="form-control" id="phone_number">{{ Auth::user()->phone_number }}</p>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="toggleEditProfile()">Edit Profile</button>
                </div>
              </div> <!-- Closing viewProfile -->

              <!-- Edit Profile Section (Initially Hidden) -->
              <form id="editProfile" action="{{ route('updateOwnDetails2') }}" method="POST" style="display: none;">
                @csrf
                <!-- Form fields for user data -->
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                </div>
                <div class="mb-3">
                  <label for="ic" class="form-label">IC</label>
                  <input type="text" class="form-control" id="ic" name="ic" value="{{ Auth::user()->ic }}">
                </div>
                <div class="mb-3">
                  <label for="phone_number" class="form-label">Phone Number</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}">
                </div>

                <!-- Update Password Section -->
                <div class="mb-3">
                  <label for="password" class="form-label">New Password (Leave blank if not changing)</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                  <label for="password_confirmation" class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update Details</button>
                  <button type="button" class="btn btn-secondary" onclick="toggleViewProfile()">Cancel</button>
                </div>
              </form>
            </div> <!-- Closing card-body -->
          </div> <!-- Closing card -->
        </div> <!-- Closing col-lg-12 -->
      </div> <!-- Closing row -->
    </div> <!-- Closing Profile section -->

</div>
</div>
</div>
</div>
</div>

  </main> <!-- Closing main-content -->
