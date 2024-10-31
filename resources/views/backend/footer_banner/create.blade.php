@extends('layouts.admin')

@section('content')
<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Footer Banner</h2>

            <form action="{{ route($banner ? 'footer-banner.update' : 'footer-banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($banner) @method('PUT') @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="sub_title">Subtitle</label>
                    <input type="text" name="sub_title" class="form-control" value="{{ old('sub_title', $banner->sub_title ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="button_title">Button Title</label>
                    <input type="text" name="button_title" class="form-control" value="{{ old('button_title', $banner->button_title ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="button_link">Button Link</label>
                    <input type="url" name="button_link" class="form-control" value="{{ old('button_link', $banner->button_link ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if ($banner && $banner->image)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="Current Image" style="max-width: 150px;">
                        </div>
                    @endif
                </div>

                @can('edit-footer-banner')
                    <button type="submit" class="btn btn-primary mt-3">{{ $banner ? 'Update' : 'Create' }} Footer Banner</button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endsection
