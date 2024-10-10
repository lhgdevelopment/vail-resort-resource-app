@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Category Details</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $category->name }}</h3>
        </div>
        <div class="card-body">
            @if ($category->banner)
                <div class="mb-3">
                    <strong>Banner:</strong><br>
                    <img src="{{ asset('storage/' . $category->banner) }}" alt="Banner" width="300" height="150">
                </div>
            @endif

            @if ($category->thumbnail)
                <div class="mb-3">
                    <strong>Thumbnail:</strong><br>
                    <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="Thumbnail" width="100" height="100">
                </div>
            @endif

            <p><strong>Is Featured:</strong> {{ $category->is_featured ? 'Yes' : 'No' }}</p>
            <p><strong>Priority:</strong> {{ $category->priority ?? 'N/A' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($category->status) }}</p>
            <p><strong>Short Description:</strong></p>
            <p>{{ $category->short_description ?? 'N/A' }}</p>
            <p><strong>Long Description:</strong></p>
            <p>{{ $category->long_description ?? 'N/A' }}</p>
        </div>
    </div>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Back to Categories</a>
</div>

@endsection