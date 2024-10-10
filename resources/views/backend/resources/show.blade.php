@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Resource Details</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $resource->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $resource->description }}</p>
            <p><strong>Author:</strong> {{ $resource->author }}</p>
            <p><strong>Category:</strong> {{ $resource->category->name }}</p>
            <p><strong>Tags:</strong> {{ $resource->tags }}</p>
            <p><strong>Status:</strong> {{ ucfirst($resource->status) }}</p>
            <p><strong>Type:</strong> {{ ucfirst($resource->type) }}</p>



            <!-- Display File or Embed Code -->
            <div class="mb-3">
                @if ($resource->type === 'file' && $resource->file_path)
                    @php
                        $fileType = mime_content_type(storage_path('app/public/' . $resource->file_path));
                    @endphp

                    @if (strpos($fileType, 'image/') === 0)
                        <img src="{{ asset('storage/' . $resource->file_path) }}" alt="Banner" style="max-width: 100%; height: auto;">
                    @elseif ($fileType === 'application/pdf')
                        <embed src="{{ asset('storage/' . $resource->file_path) }}" type="application/pdf" width="100%" height="600px" />
                    @endif
                @elseif ($resource->type === 'link' && $resource->embed_code)
                    <div class="embed-responsive">
                        {!! $resource->embed_code !!}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <a href="{{ route('resources.index') }}" class="btn btn-secondary mt-3">Back to Resources</a>
</div>
@endsection