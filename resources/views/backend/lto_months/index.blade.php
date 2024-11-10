@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">LTO Months List</h5>
                @can('create-lto-month')
                    <div class="bt mt-2"><a href="{{ route('lto_months.create') }}" class="btn btn-sm btn-primary">Create</a></div>
                @endcan
            </div>

            <!-- LTO Table -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Month Name</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ltoMonths as $ltoMonth)
                        <tr>
                            <td>{{ $ltoMonth->month_name }}</td>
                            <td>{{ $ltoMonth->year }}</td>
                            <td>
                                @if ($ltoMonth->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-warning">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @can('edit-lto-month')
                                <a href="{{ route('lto_months.edit', $ltoMonth->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil-square"></i></a>
                                @endcan
                                @can('delete-lto-month')
                                <form action="{{ route('lto_months.destroy', $ltoMonth->id) }}" method="POST" class="d-inline">
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