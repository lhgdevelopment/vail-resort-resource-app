@extends('layouts.admin')

@section('content')
<div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update General Settings</h5>

        <!-- General Settings Form -->
        <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <!-- Site Name -->
            <div class="form-group mb-3">
                <label for="site_name">Site Name<span class="text-danger">*</span></label>
                <input type="text" name="site_name" class="form-control" required value="{{ old('site_name', $setting->site_name) }}">
            </div>
    
            <!-- Logo Input Field -->
            <div class="form-group mb-3">
                <label for="logo">Logo (optional)</label>
                <input type="file" name="logo" id="logoInput" accept="image/*" class="form-control">
                @if ($setting->logo)
                    <img id="currentLogo" src="{{ asset('storage/' . $setting->logo) }}" alt="Current Logo" style="max-width: 100px; max-height: 100px;">
                @endif
                <img id="logoPreview" src="#" alt="Logo Preview" style="display: none; max-width: 100px; max-height: 100px;">
            </div>

            <!-- Icon Input Field -->
            <div class="form-group mb-3">
                <label for="icon">Icon (optional)</label>
                <input type="file" name="icon" id="iconInput" accept="image/*" class="form-control">
                @if ($setting->icon)
                    <img id="currentIcon" src="{{ asset('storage/' . $setting->icon) }}" alt="Current Icon" style="max-width: 50px; max-height: 50px;">
                @endif
                <img id="iconPreview" src="#" alt="Icon Preview" style="display: none; max-width: 50px; max-height: 50px;">
            </div>

            <!-- Contact -->
            <div class="form-group mb-3">
                <label for="contact">Contact (optional)</label>
                <input type="text" name="contact" class="form-control" value="{{ old('contact', $setting->contact) }}">
            </div>
    
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Settings</button>
        </form>

      </div>
    </div>
</div>

@endsection

@section('script')
<script>
    // Logo Preview
    const logoInput = document.getElementById('logoInput');
    const logoPreview = document.getElementById('logoPreview');
    const currentLogo = document.getElementById('currentLogo');

    logoInput.addEventListener('change', function() {
        const file = logoInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreview.src = e.target.result;
                logoPreview.style.display = 'block';
                if (currentLogo) {
                    currentLogo.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Icon Preview
    const iconInput = document.getElementById('iconInput');
    const iconPreview = document.getElementById('iconPreview');
    const currentIcon = document.getElementById('currentIcon');

    iconInput.addEventListener('change', function() {
        const file = iconInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                iconPreview.src = e.target.result;
                iconPreview.style.display = 'block';
                if (currentIcon) {
                    currentIcon.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
