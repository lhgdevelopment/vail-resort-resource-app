@extends('layouts.front')

@section('content')

</header>
<!--========================= full screen slider part hear ======================-->
<section id="hero">
    <div class="category_item">
        <div class="img">
            <img src="{{ asset('storage/' . $category->banner) }}" alt="{{ $category->name }}">
        </div>
        <div class="category">
            <h1>{{ $category->name }}</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!--====================== product details section html code start here ====================-->
<section id="detailProduct" class="bgwhite">
    <div class="container mb-4 px-3 py-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="images p-3">
                                <img id="main-image" src="{{ asset('storage/' . $category->thumbnail) }}" width="100%" alt="{{ $category->name }}" />
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="product p-4">
                                <h4 class="text-uppercase">{{ $category->name }}</h4>
                                <div class="description pt-2">
                                    <strong>Category Description</strong>
                                    <p>{{ $category->short_description }}</p>
                                    <p>{!! $category->long_description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====================== product details section html code end here ====================-->

<!--====================== product category title section html code start here ====================-->
<section id="resource" class="pb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-uppercase text-center fs-3">Category Resources</h3>
            </div>
        </div>
    </div>
</section>
<!--====================== product category title section html code end here ====================-->

<!--====================== product description section html code start here ====================-->
<section id="description" class="pb-5 bgwhite pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @foreach($category->resources as $resource)
                    <div class="card mb-3">
                        <div class="row g-0 p-3 bg-white border rounded">
                            <div class="col-md-4">
                                <div class="img imgheight beforehover">
                                    <!-- Display File or Embed Code -->
                                    @if ($resource->type === 'file' && $resource->file_path)
                                        @php
                                            $fileType = mime_content_type(storage_path('app/public/' . $resource->file_path));
                                        @endphp
                                        @if (strpos($fileType, 'image/') === 0)
                                            <img src="{{ asset('storage/' . $resource->file_path) }}" alt="Image" class="img-fluid img-responsive rounded product-image" style="max-width: 100%; height: auto;">
                                            <div class="social"><a href="{{ asset('storage/' . $resource->file_path) }}" download><span><i class="fa-solid fa-download"></i></span>Download</a></div>
                                        @elseif ($fileType === 'application/pdf')
                                            <embed src="{{ asset('storage/' . $resource->file_path) }}" type="application/pdf" width="100%" height="600px" />
                                            <div class="social"><a href="{{ asset('storage/' . $resource->file_path) }}" download><span><i class="fa-solid fa-download"></i></span>Download</a></div>
                                        @endif
                                    @elseif ($resource->type === 'link' && $resource->embed_code)
                                        <div class="embed-container">
                                            {!! $resource->embed_code !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $resource->title }}</h5>
                                    <p class="card-text">{{ $resource->description }}</p>
                                    <p class="card-text"><small class="text-body-secondary">{{ $resource->author }}</small></p>
                                    <div class="footer">
                                        <a class="btn" href="{{ route('resource.details', $resource->id) }}">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!--====================== product description section html code end here ====================-->

  @endsection