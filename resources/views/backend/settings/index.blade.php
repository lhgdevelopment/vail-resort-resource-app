@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>General Settings</h1>

    <div class="card mb-3">
        <div class="card-header">
            Site Name
        </div>
        <div class="card-body">
            <p>{{ $setting->site_name }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Logo
        </div>
        <div class="card-body">
            @if($setting->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" style="max-width: 200px;">
            @else
                <p>No logo uploaded.</p>
            @endif
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Icon
        </div>
        <div class="card-body">
            @if($setting->icon)
                <img src="{{ asset('storage/' . $setting->icon) }}" alt="Icon" style="max-width: 100px;">
            @else
                <p>No icon uploaded.</p>
            @endif
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Contact Information
        </div>
        <div class="card-body">
            <p>{{ $setting->contact ?? 'No contact information provided.' }}</p>
        </div>
    </div>

    @can('edit-settings')
        <a href="{{ route('settings.edit') }}" class="btn btn-primary">Edit Settings</a>
    @endcan
</div>
@endsection
