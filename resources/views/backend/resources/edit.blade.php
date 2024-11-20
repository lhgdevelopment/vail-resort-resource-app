@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update Resource</h5>

        <!-- Resource Form -->
        <form action="{{ route('resources.update', $resource->id) }}" method="POST" enctype="multipart/form-data" id="resourceForm">
            @csrf
            @method('PUT')
    
            <!-- Title -->
            <div class="form-group mb-3">
                <label for="title">Title<span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" required value="{{ old('title', $resource->title) }}">
            </div>
    
            <!-- Description -->
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ old('description', $resource->description) }}</textarea>
            </div>
    
            <!-- Author -->
            <div class="form-group mb-3">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $resource->author) }}">
            </div>
    
            <!-- Category -->
            <div class="form-group mb-3">
                <label for="category_id">Category<span class="text-danger">*</span></label>
                <select name="category_id" class="form-control" required>
                    <option value="" disabled>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $resource->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="feature_image">Feature Image</label>
                <div id="dropzone" class="dropzone border p-3 text-center">
                    Click or Drag and Drop File Here
                </div>
                <input type="file" name="feature_image" id="file_input" class="form-control-file d-none" accept="image/*">

                <!-- Display Current Image Preview -->
                <div class="mt-2">
                    @if ($resource->feature_image)
                        <img id="filePreview" 
                            src="{{ asset('storage/' . $resource->feature_image) }}" 
                            alt="File Preview" 
                            style="max-width: 200px; max-height: 200px;">
                    @else
                        <img id="filePreview" 
                            src="#" 
                            alt="File Preview" 
                            style="display: none; max-width: 200px; max-height: 200px;">
                    @endif
                </div>
            </div>
    
            <!-- Tags -->
            <div class="form-group mb-3">
                <label for="tags">Tags</label>
                <input type="text" name="tags" class="form-control" value="{{ old('tags', $resource->tags) }}">
            </div>
    
            <!-- Status -->
            <div class="form-group mb-3">
                <label for="status">Status<span class="text-danger">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="" disabled>Select status</option>
                    <option value="active" {{ (old('status', $resource->status) == 'active') ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ (old('status', $resource->status) == 'inactive') ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
    
            <!-- Submit Button -->
            <a href="{{ route('resources.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Update Resource</button>
        </form>

      </div>
    </div>
</div>


<!-- Optional: Include Dropzone CSS for better styling (if using Dropzone.js) -->
<style>
    /* Basic styling for drag-and-drop area */
    #dropzone {
        border: 2px dashed #cccccc;
        border-radius: 5px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
    }

    #dropzone.bg-light {
        background-color: #f8f9fa;
    }
</style>

@endsection

@section('script')
<!-- JavaScript for Drag-and-Drop and Image Preview -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('file_input');
        const filePreview = document.getElementById('filePreview');

        // Drag-and-Drop Functionality
        dropzone.addEventListener('click', () => {
            fileInput.click();
        });

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('bg-light');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('bg-light');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('bg-light');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files; // Set dropped files to the input
                previewFile(files[0]);  // Preview the first file
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                previewFile(fileInput.files[0]); // Preview the selected file
            }
        });

        function previewFile(file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                if (file.type.startsWith('image/')) {
                    filePreview.src = e.target.result;
                    filePreview.style.display = 'block'; // Show preview
                } else {
                    filePreview.style.display = 'none'; // Hide if not an image
                }
            };

            if (file) {
                reader.readAsDataURL(file); // Read file as data URL
            }
        }
    });
</script>
@endsection