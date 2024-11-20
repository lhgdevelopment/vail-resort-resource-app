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
            <p><strong>Category:</strong> {{ $resource->category?->name }}</p>
            <p><strong>Tags:</strong> {{ $resource->tags }}</p>
            <p><strong>Status:</strong> {{ ucfirst($resource->status) }}</p>
             <!-- Display Feature Image -->
            @if ($resource->feature_image)
                <div class="mt-4">
                    <strong>Feature Image:</strong>
                    <img src="{{ asset('storage/' . $resource->feature_image) }}" 
                        alt="Feature Image" 
                        style="max-width: 200px; height: 200px;">
                </div>
            @endif



            @if ($resource->resourceFiles->isNotEmpty())
                <h4 class="mt-4">Associated Files</h4>
                <div class="row">
                    @foreach ($resource->resourceFiles as $file)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <p><strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $file->resource_type)) }}</p>
                                    @if ($file->resource_type === 'file' && $file->file_path)
                                        @php
                                            $fileType = mime_content_type(storage_path('app/public/' . $file->file_path));
                                        @endphp

                                        @if (strpos($fileType, 'image/') === 0)
                                            <img src="{{ asset('storage/' . $file->file_path) }}" alt="File Image" style="max-width: 100%; height: auto;">
                                        @elseif ($fileType === 'application/pdf')
                                            <embed src="{{ asset('storage/' . $file->file_path) }}" type="application/pdf" style="width: 100%; height: 300px;" />
                                        @else
                                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="btn btn-info">Download File</a>
                                        @endif
                                    @elseif ($file->resource_type === 'embed_code' && $file->embed_code)
                                        <div class="embed-responsive" style="width: 100%; height: 575px; overflow: hidden;">
                                            {!! $file->embed_code !!}
                                        </div>
                                    @elseif ($file->resource_type === 'external_link' && $file->external_link)
                                        <a href="{{ $file->external_link }}" target="_blank" class="btn btn-primary">
                                            Visit External Link <i class="fa fa-external-link-alt"></i>
                                        </a>
                                    @else
                                        <p>No associated content available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mt-4">No associated files found for this resource.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('resources.index') }}" class="btn btn-secondary mt-3">Back to Resources</a>
</div>
@endsection