@extends('layouts.admin')

@section('content')
<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">LTO Banner</h2>

            <form action="{{ route('feel_special.update', $feelSpecial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $feelSpecial->title }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" id="short_description">{{ $feelSpecial->short_description }}</textarea>
                </div>
        
                {{-- <div class="mb-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-control" id="images" multiple>
                    
                    <!-- Helping text for image dimensions -->
                    <small class="form-text text-muted">Recommended image dimensions: 950x480 pixels.</small>

                    @if($feelSpecial->images)
                        <div class="mt-2">
                            <p>Existing Images:</p>
                            @foreach($feelSpecial->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="image" width="150" height="150px">
                            @endforeach
                        </div>
                    @endif
                </div>
                <div id="image-preview-container" class="row mt-3">
                    <!-- Image previews will be appended here -->
                </div> --}}
        
                <div class="mb-3">
                    <label for="button_title" class="form-label">Button Title</label>
                    <input type="text" name="button_title" class="form-control" id="button_title" value="{{ $feelSpecial->button_title }}">
                </div>
        
                @can('edit-feel-special')
                    <button type="submit" class="btn btn-primary">Update</button>
                @endcan
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
