<main class="main-content position-relative border-radius-lg">

    <div class="container-fluid py-4">
        @include('partials.officerside.mcdays')
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4" > <!-- Adjust column to full width -->
              <div class="card">
                <div class="card-header pb-1 p-1">

        <!-- MC Application Section -->
        <div id="McApply" class="content-section" style="display: none;">
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
                                        <th class="text-center" width="10%">User ID</th>
                                        <th class="text-center" width="10%">Start Date</th>
                                        <th class="text-center" width="10%">End Date</th>
                                        <th class="text-center" width="10%">Reason</th>
                                        <th class="text-center" width="10%">Document</th>
                                        <th class="text-center" width="10%">Status</th>
                                        <th class="text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                        <tr>
                                            <td class="text-center">{{ $application->id }}</td>
                                            <td class="text-center">{{ $application->user_id }}</td>
                                            <td class="text-center">{{ $application->start_date }}</td>
                                            <td class="text-center">{{ $application->end_date }}</td>
                                            <td class="text-center">{{ $application->reason }}</td>
                                            <td class="text-center">
                                                @if($application->document_path)
                                                    <a href="{{ Storage::url($application->document_path) }}" target="_blank">View Document</a>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $application->status }}</td>
                                            <td class="text-center">
                                                <!-- Accept or Reject Buttons -->
                                                <form action="{{ route('officer.updateStatus', $application->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" name="status" value="approved_by_officer" class="btn btn-success">Accept</button>
                                                    <button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
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
        </div>

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
                            </div>

                            <!-- Edit Profile Section (Initially Hidden) -->
                            <form id="editProfile" action="{{ route('updateOwnDetails3') }}" method="POST" style="display: none;">
                                @csrf
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
</div>
    </div>
</main>
