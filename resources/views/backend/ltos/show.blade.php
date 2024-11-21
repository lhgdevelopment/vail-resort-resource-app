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
                    <!-- Display LTO Month and Year -->
                    <p><strong>Month:</strong> {{ $lto->ltoMonth->month_name }} - {{ $lto->ltoMonth->year }}</p>
            
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
            
                    <!-- Display Files if available -->
                    @if($lto->files && count($lto->files) > 0)
                        <div class="mt-3">
                            <h5>Files:</h5>
                            <ul>
                                @foreach($lto->files as $file)
                                    <li class="mb-2">
                                        @if(in_array($file->file_type, ['jpg', 'jpeg', 'png', 'gif']))
                                            <!-- Show image file -->
                                            <img src="{{ asset('storage/' . $file->file_path) }}" alt="{{ $file->file_name }}" class="img-fluid img-thumbnail" style="width: 100%;">
                                        @elseif($file->file_type === 'pdf')
                                            <!-- Show link to PDF -->
                                            <embed src="{{ asset('storage/' . $file->file_path) }}" type="application/pdf" width="100%" height="250px" />
                                        @else
                                            <!-- Show link for other file types -->
                                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="btn btn-sm btn-secondary" title="{{ $file->file_name }}">
                                                <i class="bi bi-file-earmark"></i>View File
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
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