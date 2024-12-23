@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create LTO Banner Slider</h5>

            <form action="{{ route('lto-banner-slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- File Upload -->
                <div class="form-group mb-3">
                    <label for="file_path">Upload File<span class="text-danger">*</span></label>
                    <input type="file" name="file_path" id="fileInput" accept="image/*" class="form-control" required>
                    <img id="filePreview" src="#" alt="File Preview" style="display: none; max-width: 300px; max-height: 200px; margin-top: 10px;">
                </div>

                <!-- File Name -->
                <div class="form-group mb-3">
                    <label for="file_name">File Name<span class="text-danger">*</span></label>
                    <input type="text" name="file_name" class="form-control" id="file_name" required value="{{ old('file_name') }}">
                </div>

                <!-- Submit Button -->
                <a href="{{ route('lto-banner-slider.index') }}" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Create Slider</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // File Preview Functionality
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                filePreview.src = e.target.result;
                filePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
