<div class="container-fluid py-3">
    <div class="row justify-content-center">
        
         <!-- Third Card (Notes) -->
         @foreach ($notes as $note)
<div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card h-100 d-flex align-items-center justify-content-center">
        <div class="card-body p-5 text-center">
            <div class="numbers">
                    @php
                        $columnName = Str::slug($note->title, '_');
                    @endphp
                    <p class="text-md mb-0 text-uppercase font-weight-bold">{{ $note->title }}</p>
                    <h5 class="font-weight-bolder">{{ old($columnName, Auth::user()->$columnName ?? '0') }} Hari</h5>
            </div>
            <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle" style="width: 50px; height: 50px; margin-top: 10px;">
                <i class="fas fa-umbrella-beach" style="font-size: 1.5rem; opacity: 10;" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>
@endforeach
    </div>
</div>
