@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Create Resource</h5>

        <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data" id="resourceForm">
            @csrf
    
            <!-- Title -->
            <div class="form-group mb-3">
                <label for="title">Title<span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
            </div>
    
            <!-- Description -->
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>
    
            <!-- Author -->
            <div class="form-group mb-3">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" value="{{ old('author') }}">
            </div>
    
            <!-- Category -->
            <div class="form-group mb-3">
                <label for="category_id">Category<span class="text-danger">*</span></label>
                <select name="category_id" class="form-control" required>
                    <option value="" disabled selected>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group mb-3">
                <label for="feature_image">Feature Image</label>
                <div id="dropzone" class="dropzone border p-3 text-center">Click or Drag and Drop File Here</div>
                <input type="file" name="feature_image" id="file_input" class="form-control-file d-none" accept="image/*">
                <div class="mt-2">
                    <img id="filePreview" src="#" alt="File Preview" style="display: none; max-width: 200px; max-height: 200px;">
                </div>
            </div>
    
            <!-- Tags -->
            <div class="form-group mb-3">
                <label for="tags">Tags</label>
                <input type="text" name="tags" class="form-control" value="{{ old('tags') }}">
            </div>
    
            <!-- Status -->
            <div class="form-group mb-3">
                <label for="status">Status<span class="text-danger">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="" disabled selected>Select status</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
    
            <!-- Submit Button -->
            <a href="{{ route('resources.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Create Resource</button>
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
                fileInput.files = files;
                previewFile(files[0]);
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                previewFile(fileInput.files[0]);
            }
        });

        function previewFile(file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                if (file.type.startsWith('image/')) {
                    filePreview.src = e.target.result;
                    filePreview.style.display = 'block';
                } else if (file.type === 'application/pdf') {
                    filePreview.src = 'https://via.placeholder.com/200x200.png?text=PDF';
                    filePreview.style.display = 'block';
                } else {
                    filePreview.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>


@endsection
