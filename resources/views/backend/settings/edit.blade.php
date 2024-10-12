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
    
            <!-- Logo Black Input Field -->
            <div class="form-group mb-3">
                <label for="logo_black">Logo Black(optional)</label>
                <input type="file" name="logo_black" id="logoBlackInput" accept="image/*" class="form-control">
                @if ($setting->logo_black)
                    <img id="currentLogoBlack" src="{{ asset('storage/' . $setting->logo_black) }}" alt="Current Logo Black" style="max-width: 100px; max-height: 100px;">
                @endif
                <img id="logoBlackPreview" src="#" alt="Logo Black Preview" style="display: none; max-width: 100px; max-height: 100px;">
            </div>

            <!-- Logo White Input Field -->
            <div class="form-group mb-3">
                <label for="logo_white">Logo White(optional)</label>
                <input type="file" name="logo_white" id="logoWhiteInput" accept="image/*" class="form-control">
                @if ($setting->logo_white)
                    <img id="currentLogoWhite" src="{{ asset('storage/' . $setting->logo_white) }}" alt="Current Logo White" style="max-width: 100px; max-height: 100px;">
                @endif
                <img id="logoWhitePreview" src="#" alt="Logo White Preview" style="display: none; max-width: 100px; max-height: 100px;">
            </div>

            <!-- Icon Black Input Field -->
            <div class="form-group mb-3">
                <label for="icon_black">Icon Black (optional)</label>
                <input type="file" name="icon_black" id="iconBlackInput" accept="image/*" class="form-control">
                @if ($setting->icon_black)
                    <img id="currentBlackIcon" src="{{ asset('storage/' . $setting->icon_black) }}" alt="Current Black Icon" style="max-width: 50px; max-height: 50px;">
                @endif
                <img id="iconBlackPreview" src="#" alt="Icon Black Preview" style="display: none; max-width: 50px; max-height: 50px;">
            </div>

            <!-- Icon White Input Field -->
            <div class="form-group mb-3">
                <label for="icon_white">Icon White (optional)</label>
                <input type="file" name="icon_white" id="iconWhiteInput" accept="image/*" class="form-control">
                @if ($setting->icon_white)
                    <img id="currentWhiteIcon" src="{{ asset('storage/' . $setting->icon_white) }}" alt="Current White Icon" style="max-width: 50px; max-height: 50px;">
                @endif
                <img id="iconWhitePreview" src="#" alt="Icon White Preview" style="display: none; max-width: 50px; max-height: 50px;">
            </div>

            <!-- Contact -->
            <div class="form-group mb-3">
                <label for="contact">Contact (optional)</label>
                <input type="text" name="contact" class="form-control" value="{{ old('contact', $setting->contact) }}">
            </div>
    
            <!-- Submit Button -->
            <a href="{{ route('settings.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Update Settings</button>
        </form>

      </div>
    </div>
</div>

@endsection

@section('script')
<script>
    // Logo Black Preview
    const logoBlackInput = document.getElementById('logoBlackInput');
    const logoBlackPreview = document.getElementById('logoBlackPreview');
    const currentLogoBlack = document.getElementById('currentLogoBlack');

    logoBlackInput.addEventListener('change', function() {
        const file = logoBlackInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                logoBlackPreview.src = e.target.result;
                logoBlackPreview.style.display = 'block';
                if (currentLogoBlack) {
                    currentLogoBlack.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Logo White Preview
    const logoWhiteInput = document.getElementById('logoWhiteInput');
    const logoWhitePreview = document.getElementById('logoWhitePreview');
    const currentLogoWhite = document.getElementById('currentLogoWhite');

    logoWhiteInput.addEventListener('change', function() {
        const file = logoWhiteInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                logoWhitePreview.src = e.target.result;
                logoWhitePreview.style.display = 'block';
                if (currentLogoWhite) {
                    currentLogoWhite.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Icon Black Preview
    const iconBlackInput = document.getElementById('iconBlackInput');
    const iconBlackPreview = document.getElementById('iconBlackPreview');
    const currentBlackIcon = document.getElementById('currentBlackIcon');

    iconBlackInput.addEventListener('change', function() {
        const file = iconBlackInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                iconBlackPreview.src = e.target.result;
                iconBlackPreview.style.display = 'block';
                if (currentBlackIcon) {
                    currentBlackIcon.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Icon White Preview
    const iconWhiteInput = document.getElementById('iconWhiteInput');
    const iconWhitePreview = document.getElementById('iconWhitePreview');
    const currentWhiteIcon = document.getElementById('currentWhiteIcon');

    iconWhiteInput.addEventListener('change', function() {
        const file = iconWhiteInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                iconWhitePreview.src = e.target.result;
                iconWhitePreview.style.display = 'block';
                if (currentWhiteIcon) {
                    currentWhiteIcon.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
