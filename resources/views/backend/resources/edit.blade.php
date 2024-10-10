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
    
            <!-- Type -->
            <div class="form-group mb-3">
                <label for="type">Resource Type<span class="text-danger">*</span></label>
                <select name="type" class="form-control" id="resourceType" required>
                    <option value="" disabled>Select type</option>
                    <option value="file" {{ (old('type', $resource->type) == 'file') ? 'selected' : '' }}>File</option>
                    <option value="link" {{ (old('type', $resource->type) == 'link') ? 'selected' : '' }}>Link</option>
                </select>
            </div>
    
            <!-- File Upload (Visible if type is 'file') -->
            <div class="form-group mb-3" id="fileUploadSection" style="display: none;">
                <label for="file_path">Upload File (PDF or Image)</label>
                <div id="dropzone" class="dropzone">
                    @if ($resource->file_path)
                        @if (in_array(mime_content_type(storage_path('app/public/' . $resource->file_path)), ['image/jpeg', 'image/png', 'image/gif']))
                            <img src="{{ asset('storage/' . $resource->file_path) }}" alt="Current File" style="max-width: 200px; max-height: 200px;">
                        @elseif (mime_content_type(storage_path('app/public/' . $resource->file_path)) === 'application/pdf')
                            <embed src="{{ asset('storage/' . $resource->file_path) }}" type="application/pdf" width="100%" height="200px" />
                        @endif
                    @endif
                </div>
                <input type="file" name="file_path" id="file_input" class="form-control-file" accept=".pdf,image/*" style="display: none;">
                <div class="mt-2">
                    <img id="filePreview" src="#" alt="File Preview" style="display: none; max-width: 200px; max-height: 200px;">
                </div>
            </div>
    
            <!-- Embed Code (Visible if type is 'link') -->
            <div class="form-group mb-3" id="embedCodeSection" style="display: none;">
                <label for="embed_code">Embed Code</label>
                <textarea name="embed_code" class="form-control" id="embed_code">{{ old('embed_code', $resource->embed_code) }}</textarea>
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
        const resourceType = document.getElementById('resourceType');
        const fileUploadSection = document.getElementById('fileUploadSection');
        const embedCodeSection = document.getElementById('embedCodeSection');
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('file_input');
        const filePreview = document.getElementById('filePreview');

        // Function to toggle sections based on resource type
        function toggleSections() {
            const type = resourceType.value;
            if (type === 'file') {
                fileUploadSection.style.display = 'block';
                embedCodeSection.style.display = 'none';
            } else if (type === 'link') {
                fileUploadSection.style.display = 'none';
                embedCodeSection.style.display = 'block';
            } else {
                fileUploadSection.style.display = 'none';
                embedCodeSection.style.display = 'none';
            }
        }

        // Initialize sections based on old input or existing resource
        toggleSections();

        // Event listener for resource type change
        resourceType.addEventListener('change', toggleSections);

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