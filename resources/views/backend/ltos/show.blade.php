@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card to display LTO details -->
            <div class="card">
                <div class="card-header">
                    <h3>{{ $lto->title }}</h3>
                </div>

                <div class="card-body">
                    <!-- Display LTO Dates -->
                    <p><strong>From Date:</strong> {{ \Carbon\Carbon::parse($lto->from_date)->format('F d, Y') }}</p>
                    <p><strong>To Date:</strong> {{ \Carbon\Carbon::parse($lto->to_date)->format('F d, Y') }}</p>
                    
                    <!-- Display LTO Description if available -->
                    @if($lto->description)
                        <div class="mt-3">
                            <h5>Description:</h5>
                            <p>{!! $lto->description !!}</p>
                        </div>
                    @endif
                </div>

                <div class="card-footer">
                    <!-- Link to go back to LTO listing -->
                    <a href="{{ route('ltos.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection