@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">Resource List</h5>
                @can('create-resources')
                    <div class="bt mt-2"><a href="{{ route('resources.create') }}" class="btn btn-sm btn-primary">Create</a></div>
                @endcan
            </div>

            <!-- Resource Table -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Author</th>
                        <th>Tags</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resources as $resource)
                        <tr>
                            <td>{{ $resource->title }}</td>
                            <td>{{ $resource->category?->name }}</td>
                            <td>{{ ucfirst($resource->type) }}</td>
                            <td>{{ $resource->author }}</td>
                            <td>{{ $resource->tags }}</td>
                            <td>{{ ucfirst($resource->status) }}</td>
                            <td>
                                @can('view-resources')
                                    <a href="{{ route('resources.show', $resource->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                @endcan
                                @can('edit-resources')
                                    <a href="{{ route('resources.edit', $resource->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                @endcan
                                @can('delete-resources')
                                    <form action="{{ route('resources.destroy', $resource->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this resource?');">
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