@extends('layouts.admin')

@section('content')
<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Update Profile</h5>
            <!-- Profile Form -->
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="form-group mb-3">
                    <label for="name">Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $admin->name) }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email">Email<span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', $admin->email) }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Profile Image -->
                <div class="form-group mb-3">
                    <label for="image">Profile Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                    @if ($admin->image)
                        <img src="{{ asset('storage/' . $admin->image) }}" alt="Profile Image" class="mt-2" style="max-width: 150px;">
                    @endif
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>

    <!-- Change Password Section -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Change Password</h5>

            <!-- Password Change Form -->
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div class="form-group mb-3">
                    <label for="current_password">Current Password<span class="text-danger">*</span></label>
                    <input type="password" name="current_password" class="form-control">
                    @error('current_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-group mb-3">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" class="form-control">
                    @error('new_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="form-group mb-3">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                    @error('new_password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button for Password -->
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
