<!-- Separate Change Password Section -->
<div id="ChangePassword" class="content-section" style="display: none;">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Tukar Kata Laluan</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateOwnDetails2') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Laluan Baru</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Biar kosong jika tiada perubahan">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Pengesahan Kata Laluan Baru</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
