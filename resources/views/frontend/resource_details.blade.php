@extends('layouts.front')

@section('content')

</header>
<!--================ header section html code end here =================-->
<!--========================= full screen slider part hear ======================-->
<section id="hero">
    <div class="category_item">
        <div class="img">
            <img src="{{ asset('storage/' . $category->banner) }}" alt="Category Banner">
        </div>
        <div class="category">
            <h1 class="animated animate-slide-left">{{ $category->name }}</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ul class="breadcrumb animated animate-slide-right">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category.details', $category->id) }}">{{ $category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $resource->title }}</li>
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
                            <p class="card-text text-white animated animate-slide-right">{{ $resource->description }}</p>
                            <p class="card-text text-white animated animate-slide-right"><small class="text-muted">Author: {{ $resource->author }}</small></p>

                            <!-- Download Button for Files -->
                            @if ($resource->type === 'file' && $resource->file_path)
                                <div class="footer download-btn">
                                    <a class="btn btn-success" href="{{ asset('storage/' . $resource->file_path) }}" download>
                                        <span class="mx-2"><i class="fa-solid fa-download"></i></span>Download
                                    </a>
                                </div>
                            @endif
                            
                            <!-- Conditional Display for File or Embed Code -->
                            @if ($resource->type === 'file' && $resource->file_path)
                                @php
                                    $fileType = mime_content_type(storage_path('app/public/' . $resource->file_path));
                                @endphp
                                
                                @if (strpos($fileType, 'image/') === 0)
                                    <!-- Image File Display -->
                                    <img src="{{ asset('storage/' . $resource->file_path) }}" alt="Image" class="img-fluid img-responsive rounded product-image" style="max-width: 100%; height: auto;">
                                    <div class="social">
                                        <a href="{{ asset('storage/' . $resource->file_path) }}" download>
                                            <span><i class="fa-solid fa-download"></i></span>Download
                                        </a>
                                    </div>
                                @elseif ($fileType === 'application/pdf')
                                    <!-- PDF File Display -->
                                    <embed src="{{ asset('storage/' . $resource->file_path) }}" type="application/pdf" width="100%" height="600px" />
                                    <div class="social">
                                        <a href="{{ asset('storage/' . $resource->file_path) }}" download>
                                            <span><i class="fa-solid fa-download"></i></span>Download
                                        </a>
                                    </div>
                                @endif

                            @elseif ($resource->type === 'link' && $resource->embed_code)
                                <!-- Embed Code Display for Link Type -->
                                <div class="imgheight">
                                    {!! $resource->embed_code !!}
                                </div>
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