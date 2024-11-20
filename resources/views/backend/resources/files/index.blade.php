@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">File List for: <a href="{{ route('resources.show', $resource->id) }}">{{ $resource->title }}</a></h5>
                @can('create-resources')
                    <div class="bt mt-2"><a href="{{ route('resources.files.create', $resource->id) }}" class="btn btn-sm btn-primary">Add New File</a></div>
                @endcan
            </div>

            <!-- resource Files Table -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Resource Type</th>
                        <th>Resource</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $file->resource_type)) }} </td>
                            <td>
                                @if ($file->resource_type === 'file' && $file->file_path)
                                    @php
                                        $fileType = mime_content_type(storage_path('app/public/' . $file->file_path));
                                    @endphp

                                    @if (strpos($fileType, 'image/') === 0)
                                        <img src="{{ asset('storage/' . $file->file_path) }}" alt="File Preview" style="max-width: 30%; height: auto; max-height: 200px;">
                                    @elseif ($fileType === 'application/pdf')
                                        <embed src="{{ asset('storage/' . $file->file_path) }}" type="application/pdf" width="40%" height="200px" />
                                    @else
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="btn btn-info">
                                            View File
                                        </a>
                                    @endif
                                @elseif ($file->resource_type === 'embed_code' && $file->embed_code)
                                <div class="imgheight" style="width: 100%; max-width: 350px; height: 200px; overflow: hidden; position: relative;">
                                    <!-- <iframe 
                                        srcdoc="{{ $file->embed_code }}"
                                        style="width: 350px; height: 200px; border: 0; position: absolute; top: 0; left: 0;" 
                                        allowfullscreen>
                                    </iframe> -->
                                    {!! $file->embed_code !!}
                                </div>

                                @elseif ($file->resource_type === 'external_link' && $file->external_link)
                                    <a href="{{ $file->external_link }}" target="_blank" class="btn btn-primary">
                                        <i class="fas fa-external-link"></i> Visit External Link
                                    </a>
                                @else
                                    <span>No resource available</span>
                                @endif
                            </td>


                            <td>
                                @can('delete-resources')
                                    <form action="{{ route('resources.files.destroy', $file->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this file?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
</section>
@endsection
