@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Slider Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $slider->file_name }}</h5> 

            @if($slider->file_path)
                <p><strong>File:</strong> <a href="{{ asset('storage/' . $slider->file_path) }}" target="_blank">View File</a></p>
            @endif

            

            <img src="{{ asset('storage/' . $slider->file_path) }}" alt="Slider Image" style="max-width: 500px; max-height: 300px;">
        </div>
    </div>

    <a href="{{ route('lto-banner-slider.index') }}" class="btn btn-secondary mt-3">Back to Sliders</a>
</div>
@endsection
