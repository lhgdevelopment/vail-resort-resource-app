@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Slider Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $slider->title }}</h5>
            @if($slider->sub_title)
                <h6 class="card-subtitle mb-2 text-muted">{{ $slider->sub_title }}</h6>
            @endif

            <p class="card-text">{{ $slider->description }}</p>

            @if($slider->btn_link)
                <p><strong>Button Link:</strong> <a href="{{ $slider->btn_link }}" target="_blank">{{ $slider->btn_link }}</a></p>
            @endif

            <p><strong>Priority:</strong> {{ $slider->priority }}</p>
            <p><strong>Status:</strong>
                @if($slider->status === 'active')
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </p>

            <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image" style="max-width: 500px; max-height: 300px;">
        </div>
    </div>

    <a href="{{ route('sliders.index') }}" class="btn btn-secondary mt-3">Back to Sliders</a>
</div>

@endsection