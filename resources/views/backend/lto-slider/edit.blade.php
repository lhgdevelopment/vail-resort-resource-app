@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update Slider</h5>

        <!-- Slider Form -->
        <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <!-- Title -->
            <div class="form-group mb-3">
                <label for="title">Title<span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" id="title" required value="{{ old('title', $slider->title) }}">
            </div>
    
            <!-- Sub-Title -->
            <div class="form-group mb-3">
                <label for="sub_title">Sub-Title (optional)</label>
                <input type="text" name="sub_title" class="form-control" id="sub_title" value="{{ old('sub_title', $slider->sub_title) }}">
            </div>
    
            <!-- Button Link -->
            <div class="form-group mb-3">
                <label for="btn_link">Button Link (optional)</label>
                <input type="url" name="btn_link" class="form-control" id="btn_link" value="{{ old('btn_link', $slider->btn_link) }}">
            </div>
    
            <!-- Image Upload -->
            <div class="form-group mb-3">
                <label for="image">Image<span class="text-danger">*</span></label>
                <input type="file" name="image" id="imageInput" accept="image/*" class="form-control">
                @if($slider->image)
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Current Slider Image" style="max-width: 300px; max-height: 200px; margin-top: 10px;">
                @endif
                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 300px; max-height: 200px; margin-top: 10px;">
            </div>
    
            <!-- Priority -->
            <div class="form-group mb-3">
                <label for="priority">Priority (optional)</label>
                <input type="number" name="priority" class="form-control" id="priority" value="{{ old('priority', $slider->priority) }}">
                <small class="form-text text-muted">Lower numbers have higher priority.</small>
            </div>
    
            <!-- Status -->
            <div class="form-group mb-3">
                <label for="status">Status<span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-control" required>
                    <option value="active" {{ old('status', $slider->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $slider->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
    
            <!-- Submit Button -->
            <a href="{{ route('sliders.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Update Slider</button>
        </form>
        

      </div>
    </div>
</div>

@endsection

@section('script')
<script>
    // Image Preview Functionality
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection