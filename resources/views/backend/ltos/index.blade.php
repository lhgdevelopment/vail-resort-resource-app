@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">LTO List</h5>
                @can('create-ltos')
                    <div class="bt mt-2"><a href="{{ route('ltos.create') }}" class="btn btn-sm btn-primary">Create</a></div>
                @endcan
            </div>

            <!-- LTO Table -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ltos as $lto)
                        <tr>
                            <td>{{ $lto->title }}</td>
                            <td>{{ $lto->from_date }}</td>
                            <td>{{ $lto->to_date }}</td>
                            <td>
                                @can('view-ltos')
                                    <a href="{{ route('ltos.show', $lto->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                @endcan
                                @can('edit-ltos')
                                <a href="{{ route('ltos.edit', $lto->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil-square"></i></a>
                                @endcan
                                @can('delete-ltos')
                                <form action="{{ route('ltos.destroy', $lto->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-trash"></i></button>
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