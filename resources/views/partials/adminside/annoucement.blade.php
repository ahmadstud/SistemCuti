 <!-- Announcement Section -->
 <div id="Annouce" class="content-section" style="display: none;">
    <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px;">
        <h4><b>PENGURUSAN<b></h4>
    </nav>

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container-fluid py-2">
                <div class="row">

                    <!-- List of Announcements -->
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h4 class="text-capitalize">SENARAI PENGUMUMAN</h4>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">Cipta Pengumuman</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="overflow-x: auto; position: relative;">
                                <table class="table" style="table-layout: fixed; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">NO</th>
                                            <th style="width: 30%;">TAJUK</th>
                                            <th style="width: 30%;">ISI</th>
                                            <th style="width: 30%;">TARIKH MULA</th>
                                            <th style="width: 30%;">TARIKH TAMAT</th>
                                            <th style="width: 30%;">GAMBAR</th>
                                            <th style="width: 30%;">TINDAKAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($announcements as $announcement)
                                            <tr>
                                                <td style="position: sticky; left: 0; background: white; z-index: 1;"><p class="text-m text-secondary">{{ $loop->iteration }}</p></td>
                                                <td style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;"><p class="text-m text-secondary">{{ $announcement->title }}</p></td>
                                                <td style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $announcement->content }}</p>
                                                </td>
                                                <td style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $announcement->start_date }}</p>
                                                </td>
                                                <td style="overflow-wrap: break-word; word-wrap: break-word; white-space: normal;">
                                                    <p class="text-m text-secondary">{{ $announcement->end_date }}</p>
                                                </td>
                                                <td class="text-center">
                                                    @if($announcement->image_path)
                                                        <img src="{{ asset('storage/' . $announcement->image_path) }}" class="d-block mx-auto" style="max-width: 100%; height: auto;" alt="{{ $announcement->title }}">
                                                    @else
                                                        Tiada Gambar
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <button class="btn btn-md btn-warning" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal{{ $announcement->id }}">
                                                        <i class="fas fa-pencil-alt text-m font-weight-bold me-2"></i>
                                                    </button>
                                                    <!-- Delete button for announcement -->
                                                    <form action="{{ route('deleteAnnouncement', $announcement->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-md btn-danger" title="Delete">
                                                            <i class="fas fa-trash-alt"></i> <!-- Delete symbol -->
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Edit Announcement Modal -->
                                            <div class="modal fade" id="editAnnouncementModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="editAnnouncementLabel{{ $announcement->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editAnnouncementLabel{{ $announcement->id }}">Kemas Kini Pengumuman</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('updateAnnouncement', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="title{{ $announcement->id }}" class="form-label">Tajuk</label>
                                                                    <input type="text" class="form-control" id="title{{ $announcement->id }}" name="title" value="{{ $announcement->title }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="content{{ $announcement->id }}" class="form-label">Isi Pengumuman</label>
                                                                    <textarea class="form-control" id="content{{ $announcement->id }}" name="content" rows="4" required>{{ $announcement->content }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="image{{ $announcement->id }}" class="form-label">Gambar (pilihan)</label>
                                                                    <input type="file" class="form-control" id="image{{ $announcement->id }}" name="image_path" accept="image/*">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="start_date{{ $announcement->id }}" class="form-label">Tarikh Mula<span class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control" id="start_date{{ $announcement->id }}" name="start_date" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="end_date{{ $announcement->id }}" class="form-label">Tarikh Akhir<span class="text-danger">*</span></label>
                                                                        <input type="date" class="form-control" id="end_date{{ $announcement->id }}" name="end_date" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Kemaskini</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Create Announcement Modal -->
                    <div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createAnnouncementLabel">Create Announcement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.storeAnnouncement') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        </div>
                                        <p class="text-muted">
                                            Please upload images with the following specifications:
                                            <br>
                                            - Recommended size: **1200 x 675 pixels** (16:9 aspect ratio)
                                            <br>
                                            - Minimum width: **800 pixels**
                                            <br>
                                            - File formats: **JPG, PNG**
                                            <br>
                                            - Maximum file size: **2MB**
                                        </p>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Tarikh Mula<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">Tarikh Akhir<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Create</button>
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
