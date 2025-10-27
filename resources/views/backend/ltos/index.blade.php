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
            <table class="table" id="ltos-table">
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">⋮⋮</th>
                        <th style="width: 60px; text-align: center;">Serial</th>
                        <th style="text-align: left;">Title</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="ltos-tbody">
                    @foreach ($ltos as $index => $lto)
                        <tr data-id="{{ $lto->id }}">
                            <td class="drag-handle text-center" style="cursor: move;">
                                <i class="bi bi-grip-vertical" style="font-size: 1.2em; color: #6c757d;"></i>
                            </td>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td style="text-align: left;">{{ $lto->title }}</td>
                            <td>{{ $lto->from_date }}</td>
                            <td>{{ $lto->to_date }}</td>
                            <td>
                                @can('view-ltos')
                                    <a href="{{ route('ltos.files.index', $lto->id) }}" class="btn btn-sm btn-info" title="View files">
                                        <i class="bi bi-file-earmark"></i>
                                    </a>
                                @endcan
                                @can('view-ltos')
                                    <a href="{{ route('ltos.show', $lto->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                @endcan
                                @can('create-ltos')
                                <form action="{{ route('ltos.duplicate', $lto->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-warning" title="Duplicate LTO"><i class="bi bi-files"></i></button>
                                </form>
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

@section('script')
<!-- SortableJS for drag-and-drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    // Toast notification function
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background-color: ${type === 'success' ? '#28a745' : '#dc3545'};
            color: white;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            font-size: 14px;
            animation: slideIn 0.3s ease;
        `;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }

document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.querySelector('#ltos-table tbody');
    
    if (!tbody) return;
    
    // Initialize SortableJS
    if (typeof Sortable !== 'undefined') {
        const sortable = Sortable.create(tbody, {
            animation: 150,
            handle: '.drag-handle',
            ghostClass: 'bg-info',
            chosenClass: 'bg-light',
            onEnd: function(evt) {
                // Get updated order immediately on drag end
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
                
                // Send AJAX request to update order
                fetch('{{ route("ltos.reorder") }}', {
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
                        showToast('LTO order updated successfully!', 'success');
                    } else {
                        showToast('Failed to update LTO order.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error updating order:', error);
                    showToast('An error occurred while updating order.', 'error');
                });
            }
        });
    }
});
</script>

<style>
.drag-handle-cell {
    cursor: move !important;
}

.drag-handle-cell:hover {
    background-color: #f0f0f0;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.bg-info {
    background-color: #d1ecf1 !important;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}
</style>
@endsection