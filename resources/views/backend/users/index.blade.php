@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">User List</h5>
              @can('create-users')
                <div class="bt mt-2"><a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Create</a></div>
              @endcan
            </div>

            <!-- Roles Table -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Profile Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Is Approved</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                @if ($user->image)
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" width="50" height="50">
                                @else
                                    <img src="{{ asset('default-profile.png') }}" alt="Default Image" width="50" height="50">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }} @if ($user->email_verification_token == null) <span class="text-success" title="Email Vrified"><i class="bi bi-check-circle-fill"></i></span> @else <span class="text-warning" title="Email Not Vrified"><i class="bi bi-exclamation-triangle-fill"></i></span> @endif</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge bg-secondary">{{ ucwords(str_replace('-', ' ', $role->name)) }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if ($user->is_approved)
                                    <span class="badge bg-secondary">YES</span>
                                @else
                                    <span class="badge bg-warning">NO</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->role != "super-admin")
                                    @can('edit-users')
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('delete-users')
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                @endif
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