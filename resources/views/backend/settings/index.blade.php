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
            Logo Black
        </div>
        <div class="card-body">
            @if($setting->logo_black)
                <img src="{{ asset('storage/' . $setting->logo_black) }}" alt="Logo_black" style="max-width: 200px;">
            @else
                <p>No logo uploaded.</p>
            @endif
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Logo White
        </div>
        <div class="card-body">
            @if($setting->logo_white)
                <img src="{{ asset('storage/' . $setting->logo_white) }}" alt="logo_white" style="max-width: 200px;">
            @else
                <p>No logo uploaded.</p>
            @endif
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Icon Black
        </div>
        <div class="card-body">
            @if($setting->icon_black)
                <img src="{{ asset('storage/' . $setting->icon_black) }}" alt="icon_black" style="max-width: 100px;">
            @else
                <p>No icon uploaded.</p>
            @endif
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Icon White
        </div>
        <div class="card-body">
            @if($setting->icon_white)
                <img src="{{ asset('storage/' . $setting->icon_white) }}" alt="icon_white" style="max-width: 100px;">
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
