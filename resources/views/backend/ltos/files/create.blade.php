@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ isset($lto) ? 'Edit LTO' : 'Create New LTO' }}</h5>

        <form action="{{ route('ltos.files.store', $lto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file_name" class="form-label">File Name</label>
                <input type="text" name="file_name" id="file_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
            <a href="{{ route('ltos.files.index', $lto->id) }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        

      </div>
    </div>
</div>


@endsection

@section('script')

<!-- JavaScript for Image Preview -->
<script>
    function previewImages(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';
        
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.width = 80;
                img.classList.add('me-2', 'mb-2');
                imagePreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }
</script>

@endsection
