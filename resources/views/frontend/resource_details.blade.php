@extends('layouts.front')

@section('content')

</header>
<!--================ header section html code end here =================-->
<!--========================= full screen slider part hear ======================-->
<section id="hero"  class="heroSection">
    <div class="category_item">
        <div class="img">
            <img src="{{ asset('storage/' . $category->banner) }}" alt="Category Banner"  class="animated animate-slide-right">
        </div>
        <div class="category UpdateCode">
            <h1 class="animated animate-slide-left">{{ $category->name }}</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ul class="breadcrumb animated animate-slide-right">
                <li class="breadcrumb-item cat-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item cat-item"><a href="{{ route('category.details', $category->id) }}">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Resources Details</li>
              </ul>
            </nav>
        </div>
    </div>
</section>

<!--====================== Product Description Section ====================-->
<section id="description" class="pb-5 bgwhite pt-5 pagedetails">
    <div class="resource-details">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3" style="background-color: #29292B;">
                    <div class="row g-0 p-4 bg_white rounded">
                        <div class="card-body">
                            <h5 class="card-title cardtitle animated animate-slide-left">{{ $resource->title }}</h5>
                            <p class="card-text text-white animated animate-slide-right mb-4">{{ $resource->description }}</p>
                            <!-- <p class="card-text text-white animated animate-slide-right">
                                <small>Author: {{ $resource->author }}</small>
                            </p> -->

                            <!-- Display Associated Files -->
                            @if ($resource->resourceFiles->isNotEmpty())
                                <!-- <h5 class="text-white mt-4">Resource Files</h5> -->
                                <!-- <hr class="text-white"> -->
                                @foreach ($resource->resourceFiles as $file)
                                    <div class="mb-3">
                                        <!-- Display Resource Type -->
                                        <!-- <p class="text-white">
                                            <strong>Type:</strong> {{ ucwords(str_replace('_', ' ', $file->resource_type)) }}
                                        </p> -->

                                        @if ($file->resource_type === 'file' && $file->file_path)
                                            @php
                                                $fileType = mime_content_type(storage_path('app/public/' . $file->file_path));
                                            @endphp

                                            @if (strpos($fileType, 'image/') === 0)
                                                <!-- Display Image -->
                                                <img src="{{ asset('storage/' . $file->file_path) }}" alt="Image" class="img-fluid img-responsive rounded product-image" style="max-width: 100%;">
                                                <div class="mt-2">
                                                    <a href="{{ asset('storage/' . $file->file_path) }}" class="btn btn-success" download>
                                                        <i class="fa-solid fa-download"></i> Download
                                                    </a>
                                                </div>
                                            @elseif ($fileType === 'application/pdf')
                                                <!-- Display PDF -->
                                                <embed src="{{ asset('storage/' . $file->file_path) }}" type="application/pdf" width="100%" height="600px" />
                                                <div class="mt-2">
                                                    <a href="{{ asset('storage/' . $file->file_path) }}" class="btn btn-success" download>
                                                        <i class="fa-solid fa-download"></i> Download
                                                    </a>
                                                </div>
                                            @else
                                                <!-- Generic File Download -->
                                                <a href="{{ asset('storage/' . $file->file_path) }}" class="btn btn-info" download>
                                                    <i class="fa-solid fa-download"></i> Download File
                                                </a>
                                            @endif

                                        @elseif ($file->resource_type === 'embed_code' && $file->embed_code)
                                            <!-- Display Embed Code -->
                                            <div class="imgheight" style="overflow: hidden;">
                                                {!! $file->embed_code !!}
                                            </div>

                                        @elseif ($file->resource_type === 'external_link' && $file->external_link)
                                            <!-- Display External Link -->
                                            <a href="{{ $file->external_link }}" target="_blank" class="btn btn-primary">
                                                <i class="fa fa-external-link-alt"></i> Visit Link
                                            </a>
                                        @else
                                            <p class="text-muted">No content available for this file.</p>
                                        @endif
                                    </div>
                                    <!-- Add <hr> if not the last item -->
                                    @if (!$loop->last)
                                        <hr class="text-white">
                                    @endif
                                @endforeach
                            @else
                                <p class="text-muted mt-4">No associated files found for this resource.</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--====================== Product Description Section End ====================-->
@endsection
