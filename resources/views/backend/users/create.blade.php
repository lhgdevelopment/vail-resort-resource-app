@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Create Role</h5>

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <!-- Name -->
            <div class="form-group mb-3">
                <label for="name">Name<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            </div>
    
            <!-- Email -->
            <div class="form-group mb-3">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            </div>
    
            <!-- Password -->
            <div class="form-group mb-3">
                <label for="password">Password<span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" required>
            </div>
    
            <!-- Confirm Password -->
            <div class="form-group mb-3">
                <label for="password_confirmation">Confirm Password<span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
    
            <!-- Roles (Single Select) -->
            <div class="form-group mb-3">
                <label for="roles">Assign Role<span class="text-danger">*</span></label>
                <select name="roles" class="form-control" required>
                    <option value="" disabled selected>Select a role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ ucwords(str_replace('-', ' ', $role->name)) }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Profile Image -->
            <div class="form-group mb-3">
                <label for="image">Profile Image (optional)</label>
                <input type="file" name="image" class="form-control-file" accept="image/*" id="imageInput">
                <div class="mt-3">
                    <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; max-height: 200px;">
                </div>
            </div>
    
            <!-- Submit Button -->
            <a href="{{ route('users.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
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
        }
    });
</script>
@endsection
