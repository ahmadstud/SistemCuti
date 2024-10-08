 <!-- Separate Change Password Section -->
 <div id="ChangePassword" class="content-section" style="display: none;">
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>TUKAR KATA LALUAN</b></h4>
    </nav>

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container-fluid py-2">
                <div class="row">

                    {{-- Tukar kata laluan --}}
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2"></h6>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('updateOwnDetails2') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata Laluan Baru<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah">
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Sahkan Kata Laluan Baru<span class="text-danger">*</span></label>
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
    </div>
</div>
