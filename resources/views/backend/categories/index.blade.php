@extends('layouts.admin')

@section('content')
<style>
    .sortable-ghost {
        opacity: 0.5;
        background-color: #f0f0f0;
    }
    .drag-handle {
        cursor: move;
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
            <table class="table" id="categories-table">
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">⋮⋮</th>
                        <th style="width: 60px; text-align: center;">Serial</th>
                        <th>Thumbnail</th>
                        <th style="text-align: left;">Name</th>
                        <th>Is Featured</th>
                        <th>Status</th>
                        <th>Short Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="categories-tbody">
                    @foreach ($categories as $index => $category)
                        <tr data-id="{{ $category->id }}">
                            <td class="drag-handle text-center" style="cursor: move;">
                                <i class="bi bi-grip-vertical" style="font-size: 1.2em; color: #6c757d;"></i>
                            </td>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>
                                @if ($category->thumbnail)
                                    <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="Thumbnail" width="50" height="50">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td style="text-align: left;">{{ $category->name }}</td>
                            <td>{{ $category->is_featured ? 'Yes' : 'No' }}</td>
                            <td>{{ ucfirst($category->status) }}</td>
                            <td>{{ $category->short_description ?? 'N/A' }}</td>
                            <td>
                                @can('view-categories')
                                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info" title="View"><i class="bi bi-eye"></i></a>
                                @endcan
                                @can('edit-categories')
                                    <a href="{{ route('categories.files.index', $category->id) }}" class="btn btn-sm btn-secondary" title="Manage Files"><i class="bi bi-file-earmark"></i></a>
                                @endcan
                                @can('edit-categories')
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                @endcan
        
                                @can('delete-categories')
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this category?');"
                                                title="Delete">
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

@section('script')
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
        const tbody = document.getElementById('categories-tbody');
        
        if (!tbody) return;
        
        const sortable = Sortable.create(tbody, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            
            onEnd: function(evt) {
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const orders = rows.map((row, index) => ({
                    id: parseInt(row.getAttribute('data-id')),
                    priority: index
                }));
                
                fetch('{{ route("categories.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ orders: orders })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success toast notification
                        showToast('Category order updated successfully!', 'success');
                    } else {
                        showToast('Failed to update category order.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error updating category order:', error);
                    showToast('An error occurred while updating order.', 'error');
                });
            }
        });
    });
</script>
@endsection