@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">Category List</h5>
                @can('create-categories')
                    <div class="bt mt-2"><a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">Create</a></div>
                @endcan
            </div>

            <!-- Category Table -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Banner</th>
                        <th>Thumbnail</th>
                        <th>Name</th>
                        <th>Is Featured</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Short Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                @if ($category->banner)
                                    <img src="{{ asset('storage/' . $category->banner) }}" alt="Banner" width="100" height="50">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($category->thumbnail)
                                    <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="Thumbnail" width="50" height="50">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->is_featured ? 'Yes' : 'No' }}</td>
                            <td>{{ $category->priority ?? 'N/A' }}</td>
                            <td>{{ ucfirst($category->status) }}</td>
                            <td>{{ $category->short_description ?? 'N/A' }}</td>
                            <td>
                                @can('view-categories')
                                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                @endcan
                                @can('edit-categories')
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                @endcan
        
                                @can('delete-categories')
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this category?');">
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