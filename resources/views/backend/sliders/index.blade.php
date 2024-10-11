@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">Sliders List</h5>
                @can('create-sliders')
                    <div class="bt mt-2"><a href="{{ route('sliders.create') }}" class="btn btn-sm btn-primary">Create</a></div>
                @endcan
            </div>

            <!-- Sliders Table -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Sub-Title</th>
                        <th>Button Link</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image" style="max-width: 150px; max-height: 100px;">
                            </td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->sub_title }}</td>
                            <td>
                                @if($slider->btn_link)
                                    <a href="{{ $slider->btn_link }}" target="_blank">{{ $slider->btn_link }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $slider->priority }}</td>
                            <td>
                                @if($slider->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @can('view-sliders')
                                    <a href="{{ route('sliders.show', $slider->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                @endcan
                                @can('edit-sliders')
                                    <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                @endcan
                                @can('delete-sliders')
                                    <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" style="display:inline-block;">
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