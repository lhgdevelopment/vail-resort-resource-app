@extends('layouts.admin')

@section('cdn')
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')

<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update Category</h5>

        <!-- Category Form -->
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <!-- Name -->
            <div class="form-group mb-3">
                <label for="name">Name<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $category->name) }}">
            </div>
    
            <!-- Banner Drag-and-Drop Area -->
            <div class="form-group mb-3">
                <label for="banner">Banner (optional)</label>
                <div id="banner-dropzone" class="dropzone mb-3" style="border: 2px dashed #ccc; padding: 20px; text-align: center;">
                    <p>Drag & Drop Banner Image Here or Click to Select</p>
                    <input type="file" name="banner" id="bannerInput" accept="image/*" style="display: none;">
                </div>
                @if ($category->banner)
                    <img id="currentBanner" src="{{ asset('storage/' . $category->banner) }}" alt="Current Banner" style="max-width: 300px; max-height: 200px;">
                @endif
                <img id="bannerPreview" src="#" alt="Banner Preview" style="display: none; max-width: 300px; max-height: 200px;">
            </div>

            <!-- Thumbnail Drag-and-Drop Area -->
            <div class="form-group mb-3">
                <label for="thumbnail">Thumbnail (optional)</label>
                <div id="thumbnail-dropzone" class="dropzone mb-3" style="border: 2px dashed #ccc; padding: 20px; text-align: center;">
                    <p>Drag & Drop Thumbnail Image Here or Click to Select</p>
                    <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*" style="display: none;">
                </div>
                @if ($category->thumbnail)
                    <img id="currentThumbnail" src="{{ asset('storage/' . $category->thumbnail) }}" alt="Current Thumbnail" style="max-width: 200px; max-height: 200px;">
                @endif
                <img id="thumbnailPreview" src="#" alt="Thumbnail Preview" style="display: none; max-width: 200px; max-height: 200px;">
            </div>
    
            <!-- Short Description -->
            <div class="form-group mb-3">
                <label for="short_description">Short Description (optional)</label>
                <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $category->short_description) }}</textarea>
            </div>
    
            <!-- Long Description -->
            <div class="form-group mb-3">
                <label for="long_description">Long Description (optional)</label>
                <textarea name="long_description" class="form-control" rows="5">{{ old('long_description', $category->long_description) }}</textarea>
            </div>
    
            <!-- Priority -->
            <div class="form-group mb-3">
                <label for="priority">Priority (optional)</label>
                <input type="number" name="priority" class="form-control" value="{{ old('priority', $category->priority) }}">
            </div>
            
            <!-- Role -->
            <div class="form-group mb-3">
                <label for="roles">Roles</label>
                <select name="roles[]" id="roles" class="form-control select2-multiple" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" 
                            {{ isset($category) && in_array($role->name, $category->roles ?? []) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Is Featured -->
            <div class="form-group mb-3 form-check">
                <input type="checkbox" name="is_featured" class="form-check-input" id="isFeatured" {{ old('is_featured', $category->is_featured) ? 'checked' : '' }}>
                <label class="form-check-label" for="isFeatured">Is Featured</label>
            </div>
    
            <!-- Status -->
            <div class="form-group mb-3">
                <label for="status">Status<span class="text-danger">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="active" {{ old('status', $category->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $category->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
    
            <!-- Submit Button -->
            <a href="{{ route('categories.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
        

      </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#roles').select2({
            placeholder: 'Select roles',
            allowClear: true
        });
    });
</script>

<!-- JavaScript for Drag-and-Drop and Image Preview -->
<script>
    // Banner Drag-and-Drop
    const bannerDropzone = document.getElementById('banner-dropzone');
    const bannerInput = document.getElementById('bannerInput');
    const bannerPreview = document.getElementById('bannerPreview');
    const currentBanner = document.getElementById('currentBanner');

    bannerDropzone.addEventListener('click', () => {
        bannerInput.click();
    });

    bannerDropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        bannerDropzone.style.backgroundColor = '#f0f0f0';
    });

    bannerDropzone.addEventListener('dragleave', () => {
        bannerDropzone.style.backgroundColor = '#fff';
    });

    bannerDropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        bannerDropzone.style.backgroundColor = '#fff';
        const file = e.dataTransfer.files[0];
        if (file) {
            bannerInput.files = e.dataTransfer.files;
            previewImage(file, bannerPreview);
            if (currentBanner) {
                currentBanner.style.display = 'none';
            }
        }
    });

    bannerInput.addEventListener('change', () => {
        const file = bannerInput.files[0];
        if (file) {
            previewImage(file, bannerPreview);
            if (currentBanner) {
                currentBanner.style.display = 'none';
            }
        }
    });

    // Thumbnail Drag-and-Drop
    const thumbnailDropzone = document.getElementById('thumbnail-dropzone');
    const thumbnailInput = document.getElementById('thumbnailInput');
    const thumbnailPreview = document.getElementById('thumbnailPreview');
    const currentThumbnail = document.getElementById('currentThumbnail');

    thumbnailDropzone.addEventListener('click', () => {
        thumbnailInput.click();
    });

    thumbnailDropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        thumbnailDropzone.style.backgroundColor = '#f0f0f0';
    });

    thumbnailDropzone.addEventListener('dragleave', () => {
        thumbnailDropzone.style.backgroundColor = '#fff';
    });

    thumbnailDropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        thumbnailDropzone.style.backgroundColor = '#fff';
        const file = e.dataTransfer.files[0];
        if (file) {
            thumbnailInput.files = e.dataTransfer.files;
            previewImage(file, thumbnailPreview);
            if (currentThumbnail) {
                currentThumbnail.style.display = 'none';
            }
        }
    });

    thumbnailInput.addEventListener('change', () => {
        const file = thumbnailInput.files[0];
        if (file) {
            previewImage(file, thumbnailPreview);
            if (currentThumbnail) {
                currentThumbnail.style.display = 'none';
            }
        }
    });

    // Function to preview images
    function previewImage(file, previewElement) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewElement.src = e.target.result;
            previewElement.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
</script>
@endsection