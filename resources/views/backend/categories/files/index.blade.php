@extends('layouts.admin')

@section('content')
<style>
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
            <h5 class="card-title">File List for Category: <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></h5>
                @can('edit-categories')
                    <div class="bt mt-2"><a href="{{ route('categories.files.create', $category->id) }}" class="btn btn-sm btn-primary">Add New File</a></div>
                @endcan
            </div>

            <!-- Category Files Table -->
            <table class="table" id="category-files-table">
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">⋮⋮</th>
                        <th>File Name</th>
                        <th>Resource Type</th>
                        <th>Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="category-files-tbody">
                    @foreach ($files as $file)
                        <tr data-id="{{ $file->id }}">
                            <td class="drag-handle text-center" style="cursor: move;">
                                <i class="bi bi-grip-vertical" style="font-size: 1.2em; color: #6c757d;"></i>
                            </td>
                            <td>{{ $file->file_name }}</td>
                            <td>{{ ucfirst($file->resource_type) }}</td>
                            <td>
                                @if($file->resource_type === 'file')
                                    @if(in_array($file->file_type, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset('storage/' . $file->file_path) }}" alt="{{ $file->file_name }}" class="img-fluid" style="max-width: 150px;">
                                    @elseif($file->file_type == 'pdf')
                                        <embed src="{{ asset('storage/' . $file->file_path) }}" type="application/pdf" width="150" height="200px" />
                                    @else
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="bi bi-file-earmark"></i> View File
                                        </a>
                                    @endif
                                @elseif($file->resource_type === 'embed_code')
                                    <span class="badge bg-info">Embed Code</span>
                                @elseif($file->resource_type === 'external_link')
                                    <a href="{{ $file->external_link }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="bi bi-link-45deg"></i> Open Link
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('edit-categories')
                                    <form action="{{ route('categories.files.destroy', $file->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this file?');">
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
    const tbody = document.getElementById('category-files-tbody');
    
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
            
            fetch('{{ route("categories.files.reorder") }}', {
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
                    showToast('Category files order updated successfully!', 'success');
                } else {
                    showToast('Failed to update category files order.', 'error');
                }
            })
            .catch(error => {
                console.error('Error updating category files order:', error);
                showToast('An error occurred while updating order.', 'error');
            });
        }
    });
});
</script>
@endsection

