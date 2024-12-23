@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="hgt">
                        <h5 class="card-title">LTO Banner Sliders</h5>
                        @can('edit-feel-special')
                            <div class="bt mt-2">
                                <a href="{{ route('lto-banner-slider.create') }}" class="btn btn-sm btn-primary">Create</a>
                            </div>
                        @endcan
                    </div>

                    <!-- Sliders Table -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>File Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td>
                                        @if($slider->file_path)
                                            <img src="{{ asset('storage/' . $slider->file_path) }}" alt="Slider Image" style="max-width: 150px; max-height: 100px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $slider->file_name }}</td>
                                    <td>
                                        @can('edit-feel-special')
                                            <a href="{{ route('lto-banner-slider.show', $slider->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                        @endcan
                                        
                                        @can('edit-feel-special')
                                            <form action="{{ route('lto-banner-slider.destroy', $slider->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this slider?');"><i class="bi bi-trash"></i></button>
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
