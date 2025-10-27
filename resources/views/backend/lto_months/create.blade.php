@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ isset($ltoMonth) ? 'Edit LTO Category' : 'Create New LTO Category' }}</h5>

        <form action="{{ isset($ltoMonth) ? route('lto_months.update', $ltoMonth->id) : route('lto_months.store') }}" method="POST">
            @csrf
            @if(isset($ltoMonth))
                @method('PUT')
            @endif

            <!-- Title/Name Input -->
            <div class="mb-3">
                <label for="title" class="form-label">Category Title/Name</label>
                <input type="text" name="title" id="title" class="form-control" 
                    value="{{ old('title', $ltoMonth->title ?? '') }}" 
                    placeholder="e.g., December, Pride, St. Patrick's Day, Evergreen..." required>
                <small class="form-text text-muted">Enter a custom category name. Examples: month names, special events, or "Evergreen" for ongoing LTOs.</small>
            </div>

            <!-- Priority Input -->
            <div class="mb-3">
                <label for="priority" class="form-label">Priority (Ordering)</label>
                <input type="number" name="priority" id="priority" class="form-control" 
                    value="{{ old('priority', $ltoMonth->priority ?? 0) }}" 
                    placeholder="0" min="0">
                <small class="form-text text-muted">Lower numbers appear first. You can reorder later using drag-and-drop.</small>
            </div>

            <!-- Status Dropdown -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="1" {{ (isset($ltoMonth) && $ltoMonth->status) || old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ (isset($ltoMonth) && !$ltoMonth->status) || old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Submit and Cancel Buttons -->
            <a href="{{ route('lto_months.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">{{ isset($ltoMonth) ? 'Update' : 'Create' }}</button>
        </form>
        

      </div>
    </div>
</div>


@endsection
