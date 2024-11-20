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
                <label class="form-label" for="inputEmail">Description:</label>
                <div id="quill-editor" class="mb-3" style="height: 300px;">
                    <!-- Quill editor will be initialized here -->
                </div>
                <textarea 
                    rows="3" 
                    class="mb-3 d-none" 
                    name="description" 
                    id="quill-editor-area">{{ $lto->description ?? old('description') }}</textarea>

                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <a href="{{ route('ltos.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">{{ isset($lto) ? 'Update' : 'Create' }}</button>
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


<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Quill editor if textarea exists
        if (document.getElementById('quill-editor-area')) {
            var editor = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['bold', 'italic', 'underline'],
                        ['link'],
                        ['blockquote']
                    ]
                }
            });

            // Set the initial content of the Quill editor
            var quillEditorArea = document.getElementById('quill-editor-area');
            if (quillEditorArea.value) {
                editor.root.innerHTML = quillEditorArea.value;
            }

            // Update the hidden textarea with the editor's HTML content
            editor.on('text-change', function() {
                quillEditorArea.value = editor.root.innerHTML;
            });
        }
    });
</script>

@endsection
