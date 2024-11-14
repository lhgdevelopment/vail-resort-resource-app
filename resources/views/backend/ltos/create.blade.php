@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ isset($lto) ? 'Edit LTO' : 'Create New LTO' }}</h5>

        <form action="{{ isset($lto) ? route('ltos.update', $lto->id) : route('ltos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($lto))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" value="{{ $lto->title ?? old('title') }}" class="form-control" required>
            </div>

            <!-- LTO Month Dropdown -->
            <div class="mb-3">
                <label for="lto_month_id" class="form-label">LTO Month</label>
                <select name="lto_month_id" id="lto_month_id" class="form-control">
                    <option value="">Select Month</option>
                    @foreach($ltoMonths as $month)
                        <option value="{{ $month->id }}" 
                            {{ (old('lto_month_id') == $month->id) || (isset($lto) && $lto->lto_month_id == $month->id) ? 'selected' : '' }}>
                            {{ $month->month_name }} - {{ $month->year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" name="from_date" id="from_date" value="{{ $lto->from_date ?? old('from_date') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" name="to_date" id="to_date" value="{{ $lto->to_date ?? old('to_date') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $lto->description ?? old('description') }}</textarea>
            </div>

            <!-- Images Upload -->
            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*" onchange="previewImages(event)">
                @if(isset($lto) && $lto->images)
                    <div class="mt-2" id="existingImages">
                        <p>Current Images:</p>
                        @foreach($lto->images as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Image" width="80" class="me-2 mb-2">
                        @endforeach
                    </div>
                @endif
                <div class="mt-2" id="imagePreview"></div>
            </div>

            <a href="{{ route('ltos.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">{{ isset($lto) ? 'Update' : 'Create' }}</button>
        </form>
        

      </div>
    </div>
</div>


@endsection

@section('script')

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: [
                'heading', // You can include this or remove it if not needed
                '|',
                'bold',
                'italic',
                'underline',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'link'
            ],
            // Disable the file upload options
            ckfinder: {
                uploadUrl: '', // Set to an empty string or omit to disable file uploads
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>

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
