@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">File List for: <a href="{{ route('ltos.show', $lto->id) }}">{{ $lto->title }}</a></h5>
                @can('create-ltos')
                    <div class="bt mt-2"><a href="{{ route('ltos.files.create', $lto->id) }}" class="btn btn-sm btn-primary">Add New File</a></div>
                @endcan
            </div>

            <!-- LTO Files Table -->
            <table class="table" id="lto-files-table">
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">⋮⋮</th>
                        <th>File Name</th>
                        <th>File Type</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="lto-files-tbody">
                    @foreach ($files as $file)
                        <tr data-id="{{ $file->id }}">
                            <td class="drag-handle text-center" style="cursor: move;">
                                <i class="bi bi-grip-vertical" style="font-size: 1.2em; color: #6c757d;"></i>
                            </td>
                            <td>{{ $file->file_name }}</td>
                            <td>{{ $file->file_type }}</td>
                            <td>
                                <!-- Display file based on type -->
                                @if(in_array($file->file_type, ['jpg', 'jpeg', 'png', 'gif']))
                                    <!-- Display image -->
                                    <img src="{{ asset('storage/' . $file->file_path) }}" alt="{{ $file->file_name }}" class="img-fluid" style="max-width: 150px;">
                                @elseif($file->file_type == 'pdf')
                                    <!-- Display PDF icon or thumbnail -->
                                    <embed src="{{ asset('storage/' . $file->file_path) }}" type="application/pdf" width="150" height="200px" />
                                @else
                                    <!-- Default for other file types (you can add more extensions if needed) -->
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="bi bi-file-earmark"></i> View File
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('delete-ltos')
                                    <form action="{{ route('ltos.files.destroy', $file->id) }}" method="POST" class="d-inline">
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
    const tbody = document.querySelector('#lto-files-tbody');
    
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
                
                fetch('{{ route("ltos.files.reorder") }}', {
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
                        showToast('LTO files order updated successfully!', 'success');
                    } else {
                        showToast('Failed to update LTO files order.', 'error');
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
