@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ isset($ltoMonth) ? 'Edit LTO Month' : 'Create New LTO Month' }}</h5>

        <form action="{{ isset($ltoMonth) ? route('lto_months.update', $ltoMonth->id) : route('lto_months.store') }}" method="POST">
            @csrf
            @if(isset($ltoMonth))
                @method('PUT')
            @endif

            <!-- Month Name Dropdown -->
            <div class="mb-3">
                <label for="month_name" class="form-label">Month Name</label>
                <select name="month_name" id="month_name" class="form-control" required>
                    @foreach(ltoMonths() as $month)
                        <option value="{{ $month }}" 
                            {{ (isset($ltoMonth) && $ltoMonth->month_name === $month) || old('month_name') == $month ? 'selected' : '' }}>
                            {{ $month }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Year Dropdown -->
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <select name="year" id="year" class="form-control" required>
                    @foreach(range(date('Y'), date('Y') + 3) as $year)
                        <option value="{{ $year }}" 
                            {{ (isset($ltoMonth) && $ltoMonth->year == $year) || old('year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
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
