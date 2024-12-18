<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <!-- Third Card (Notes) -->
        @foreach ($notes as $note)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                <div class="card h-100 d-flex align-items-center justify-content-center">
                    <div class="card-body p-3 text-center">
                        <div class="numbers">
                            @php
                                $columnName = Str::slug($note->title, '_');
                            @endphp
                            <p class="text-sm mb-1 text-uppercase font-weight-bold">{{ $note->title }}</p>
                            <h6 class="font-weight-bolder">Baki cuti <br>
                                {{ old($columnName, Auth::user()->$columnName ?? '0') }} Hari
                            </h6>
                        </div>
                        <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle" style="width: 40px; height: 40px; margin-top: 10px;">
                            <i class="fas fa-umbrella-beach" style="font-size: 1.25rem; opacity: 10;" aria-hidden="true" aria-label="{{ $note->title }} icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<<<<<<< HEAD

=======
>>>>>>> origin
