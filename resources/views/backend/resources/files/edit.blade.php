@extends('layouts.admin')

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Resource File</h5>

            <form action="{{ route('resources.files.update', $resourceFile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="file_name">File Name</label>
                    <input type="text" name="file_name" class="form-control" id="file_name" value="{{ old('file_name', $resourceFile->file_name) }}">
                </div>

                <!-- Resource Type Dropdown -->
                <div class="form-group mb-3">
                    <label for="type">Resource Type <span class="text-danger">*</span></label>
                    <select name="resource_type" class="form-control" id="resourceType" required>
                        <option value="" disabled>Select type</option>
                        <option value="file" {{ old('resource_type', $resourceFile->resource_type) == 'file' ? 'selected' : '' }}>File</option>
                        <option value="embed_code" {{ old('resource_type', $resourceFile->resource_type) == 'embed_code' ? 'selected' : '' }}>Embed Code</option>
                        <option value="external_link" {{ old('resource_type', $resourceFile->resource_type) == 'external_link' ? 'selected' : '' }}>External Link</option>
                    </select>
                </div>

                <!-- File Upload Section -->
                <div class="form-group mb-3" id="fileUploadSection" style="display: none;">
                    <label for="file_path">Upload File (PDF or Image)</label>
                    @if($resourceFile->resource_type === 'file' && $resourceFile->file_path)
                        <div class="mb-2">
                            <strong>Current File:</strong>
                            @php
                                $extension = pathinfo($resourceFile->file_path, PATHINFO_EXTENSION);
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                            @endphp
                            @if(in_array(strtolower($extension), $imageExtensions))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $resourceFile->file_path) }}" alt="Current File" style="max-width: 200px; max-height: 200px;">
                                </div>
                            @else
                                <a href="{{ asset('storage/' . $resourceFile->file_path) }}" target="_blank" class="btn btn-sm btn-info">View Current File</a>
                            @endif
                        </div>
                    @endif
                    <div id="dropzone" class="dropzone border p-3 text-center">Click or Drag and Drop File Here</div>
                    <input type="file" name="file_path" id="file_input" class="form-control-file d-none" accept=".pdf,.ppt,.pptx,image/*">
                    <div class="mt-2">
                        <img id="filePreview" src="#" alt="File Preview" style="display: none; max-width: 200px; max-height: 200px;">
                    </div>
                    <small class="form-text text-muted">Leave empty to keep the current file</small>
                </div>

                <!-- Embed Code Section -->
                <div class="form-group mb-3" id="embedCodeSection" style="display: none;">
                    <label for="embed_code">Embed Code</label>
                    <textarea name="embed_code" class="form-control" id="embed_code" rows="5">{{ old('embed_code', $resourceFile->embed_code) }}</textarea>
                </div>

                <!-- External Link Section -->
                <div class="form-group mb-3" id="linkSection" style="display: none;">
                    <label for="external_link">External Link</label>
                    <input type="url" name="external_link" class="form-control" id="external_link" value="{{ old('external_link', $resourceFile->external_link) }}">
                </div>

                <!-- Action Buttons -->
                <a href="{{ route('resources.files.index', $resourceFile->resource->id) }}" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const resourceType = document.getElementById('resourceType');
        const fileUploadSection = document.getElementById('fileUploadSection');
        const embedCodeSection = document.getElementById('embedCodeSection');
        const linkSection = document.getElementById('linkSection');
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('file_input');
        const filePreview = document.getElementById('filePreview');

        // Function to toggle sections based on resource type
        function toggleSections() {
            const type = resourceType.value;

            fileUploadSection.style.display = type === 'file' ? 'block' : 'none';
            embedCodeSection.style.display = type === 'embed_code' ? 'block' : 'none';
            linkSection.style.display = type === 'external_link' ? 'block' : 'none';

            // Enable or disable inputs based on selected type
            fileInput.disabled = type !== 'file';
            document.getElementById('embed_code').disabled = type !== 'embed_code';
            document.getElementById('external_link').disabled = type !== 'external_link';
        }

        // Initialize sections based on current resource type
        toggleSections();

        // Event listener for resource type change
        resourceType.addEventListener('change', toggleSections);

        // Drag-and-Drop functionality
        dropzone.addEventListener('click', () => fileInput.click());
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('bg-light');
        });
        dropzone.addEventListener('dragleave', () => dropzone.classList.remove('bg-light'));
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('bg-light');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                previewFile(files[0]);
            }
        });

        // File input change listener
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                previewFile(fileInput.files[0]);
            }
        });

        // Function to preview file
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
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
