@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update User</h5>

        <!-- User Form -->
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <!-- Name -->
            <div class="form-group mb-3">
                <label for="name">Name<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
            </div>
    
            <!-- Email -->
            <div class="form-group mb-3">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
            </div>
    
            <!-- Password -->
            <div class="form-group mb-3">
                <label for="password">Password <small>(Leave blank to keep current password)</small></label>
                <input type="password" name="password" class="form-control">
            </div>
    
            <!-- Confirm Password -->
            <div class="form-group mb-3">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
    
            <!-- Roles (Single Select) -->
            <div class="form-group mb-3">
                <label for="roles">Assign Role<span class="text-danger">*</span></label>
                <select name="roles" class="form-control" required>
                    <option value="" disabled>Select a role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" 
                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucwords(str_replace('-', ' ', $role->name)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Admin Approval -->
            <div class="form-group mb-3">
                <label for="is_approved">Approve User<span class="text-danger">*</span></label>
                <select name="is_approved" class="form-control" required>
                    <option value="" disabled>Select One</option>
                    <option value="1" @if($user->is_approved) selected @endif>YES</option>
                    <option value="0" @if(!$user->is_approved) selected @endif>NO</option>
                   
                </select>
            </div>
    
            <!-- Current Profile Image -->
            @if ($user->image)
                <div class="form-group mb-3">
                    <label>Current Profile Image:</label><br>
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" width="100" height="100" id="currentImage">
                </div>
            @endif
    
            <!-- Profile Image -->
            <div class="form-group mb-3">
                <label for="image">Change Profile Image (optional)</label>
                <input type="file" name="image" class="form-control form-control-file" accept="image/*" id="imageInput">
                <div class="mt-3">
                    <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; max-height: 200px;">
                </div>
            </div>
    
            <!-- Submit Button -->
            <a href="{{ route('users.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
        

      </div>
    </div>
</div>

@endsection

@section('script')
<!-- Image Preview Script -->
<script>
    document.getElementById('imageInput').addEventListener('change', function(event){
        const [file] = this.files;
        if (file) {
            const preview = document.getElementById('imagePreview');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';

            // Optionally hide the current image preview
            const currentImage = document.getElementById('currentImage');
            if(currentImage){
                currentImage.style.display = 'none';
            }
        }
    });
</script>
@endsection