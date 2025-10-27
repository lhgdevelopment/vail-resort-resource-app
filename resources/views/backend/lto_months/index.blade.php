@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">LTO Categories List</h5>
                @can('create-lto-month')
                    <div class="bt mt-2"><a href="{{ route('lto_months.create') }}" class="btn btn-sm btn-primary">Create</a></div>
                @endcan
            </div>

            <!-- LTO Categories Table -->
            <table class="table" id="lto-categories-table">
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">⋮⋮</th>
                        <th>Category Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="lto-categories-tbody">
                    @foreach ($ltoMonths->sortBy('priority') as $ltoMonth)
                        <tr data-id="{{ $ltoMonth->id }}">
                            <td class="drag-handle text-center" style="cursor: move;">
                                <i class="bi bi-grip-vertical" style="font-size: 1.2em; color: #6c757d;"></i>
                            </td>
                            <td>{{ $ltoMonth->title ?? $ltoMonth->month_name ?? 'N/A' }}</td>
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

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.querySelector('#lto-categories-tbody');
    
    if (!tbody) return;
    
    if (typeof Sortable !== 'undefined') {
        const sortable = Sortable.create(tbody, {
            animation: 150,
            handle: '.drag-handle',
            ghostClass: 'bg-info',
            chosenClass: 'bg-light',
            onEnd: function(evt) {
                const rows = tbody.querySelectorAll('tr');
                const orders = [];
                
                rows.forEach((row, index) => {
                    const id = row.dataset.id;
                    if (id) {
                        orders.push({
                            id: parseInt(id),
                            priority: index
                        });
                    }
                });
                
                fetch('{{ route("lto_months.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ orders: orders })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const alert = document.createElement('div');
                        alert.className = 'alert alert-success alert-dismissible fade show';
                        alert.innerHTML = '<strong>Success!</strong> ' + data.message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                        
                        const cardBody = document.querySelector('.card-body');
                        if (cardBody) {
                            cardBody.insertBefore(alert, cardBody.firstChild);
                            setTimeout(() => { alert.remove(); }, 3000);
                        }
                    }
                })
                .catch(error => console.error('Error updating order:', error));
            }
        });
    }
});
</script>
@endsection