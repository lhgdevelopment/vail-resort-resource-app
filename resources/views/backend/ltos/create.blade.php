@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ isset($lto) ? 'Edit LTO' : 'Create New LTO' }}</h5>

        <form action="{{ isset($lto) ? route('ltos.update', $lto->id) : route('ltos.store') }}" method="POST">
            @csrf
            @if(isset($lto))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" value="{{ $lto->title ?? old('title') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" name="from_date" id="from_date" value="{{ $lto->from_date ?? old('from_date') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" name="to_date" id="to_date" value="{{ $lto->to_date ?? old('to_date') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $lto->description ?? old('description') }}</textarea>
            </div>

            <a href="{{ route('ltos.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">{{ isset($lto) ? 'Update' : 'Create' }}</button>
        </form>
        

      </div>
    </div>
</div>


@endsection

@section('script')

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: [
                'heading', // You can include this or remove it if not needed
                '|',
                'bold',
                'italic',
                'underline',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'link'
            ],
            // Disable the file upload options
            ckfinder: {
                uploadUrl: '', // Set to an empty string or omit to disable file uploads
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>



@endsection
