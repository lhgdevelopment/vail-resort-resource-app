@extends('layouts.front')

@section('content')

</header>
<!-- Category Banner and Breadcrumb -->
<section id="hero" class="heroSection">
    <div class="category_item">
        <div class="img">
            <img src="{{ asset('storage/' . $category->banner) }}" alt="{{ $category->name }}" class="animated animate-slide-right">
        </div>
        <div class="category">
            <h1 class="animated animate-slide-left">{{ $category->name }}</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ul class="breadcrumb animated animate-slide-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Category</li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!-- Category Description Section -->
<section id="description" class="PaddingTop">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="cards mb-3">
                    <div class="cards_img">
                        <div class="imgheight">
                            <!-- <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}" class="animated animate-slide-left"> -->
                            <div class="cards_content">
                                <h5 class="cardtitle animated animate-slide-left">{{ $category->name }}</h5>
                                <h6 class="animated animate-slide-right mb-3">{{ $category->short_description }}</h6>
                                <p class="cardtext animated animate-slide-right">{{ $category->long_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Category Files Section -->
@if($category->categoryFiles && $category->categoryFiles->count() > 0)
<section id="description" class="pb-5 bgwhite pt-5 pagedetails">
    <div class="resource-details">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3" style="background-color: #29292B;">
                    <div class="row g-0 p-4 bg_white rounded">
                        <div class="card-body">
                            {{-- <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title cardtitle animated animate-slide-left">Category Resources</h5>
                                </div>
                            </div> --}}
                            <hr class="text-white">

                            <!-- Display Category Files -->
                            @foreach($category->categoryFiles as $file)
                                <div class="mb-3">
                                    <p class="text-white">
                                        <strong>{{ $file->file_name ?? '' }}</strong>
                                    </p>

                                    @if($file->resource_type === 'file' && $file->file_path)
                                        @php
                                            $fileType = mime_content_type(storage_path('app/public/' . $file->file_path));
                                        @endphp

                                        @if(strpos($fileType, 'image/') === 0)
                                            <!-- Display Image -->
                                            <img src="{{ asset('storage/' . $file->file_path) }}" alt="Image" class="img-fluid img-responsive rounded product-image" style="max-width: 100%;">
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $file->file_path) }}" class="btn btn-success" download>
                                                    <i class="fa-solid fa-download"></i> Download
                                                </a>
                                            </div>
                                        @elseif($fileType === 'application/pdf')
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

                                    @elseif($file->resource_type === 'embed_code' && $file->embed_code)
                                        <!-- Display Embed Code -->
                                        <div class="imgheight" style="overflow: hidden;">
                                            {!! $file->embed_code !!}
                                        </div>

                                    @elseif($file->resource_type === 'external_link' && $file->external_link)
                                        <!-- Display External Link -->
                                        <a href="{{ $file->external_link }}" target="_blank" class="btn btn-primary">
                                            <i class="fa fa-external-link-alt"></i> Visit Link
                                        </a>
                                    @else
                                        <p class="text-muted">No content available for this file.</p>
                                    @endif
                                </div>
                                <!-- Add <hr> if not the last item -->
                                @if(!$loop->last)
                                    <hr class="text-white">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Category Resources Section -->
<section id="bg_banner" class="productlistpage py-xl-8">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <h2 class="mb-4 display-5 text-center">Category Resources</h2>
            </div>
        </div>

        <!-- Loop through resources in chunks of 4, and manage col1/col2 layout -->
        {{-- @foreach($category->resources->where('status', 'active')->chunk(4) as $chunk)
            <div class="img_container">
                @foreach($chunk as $index => $resource)
                    <a href="{{route('resource.details', $resource->id)}}">
                        <div class="image {{ $index % 4 == 0 || $index % 4 == 3 ? 'col2' : 'col1' }}">
                            <div class="txt">
                                <h3 class="animated animate-slide-left">{{ $resource->title }}</h3>
                                <p class="animated animate-slide-right">{{ $resource->description }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endforeach --}}
    </div>
</section>

<section id="description" class="">
    <div class="container-fluid">
        @foreach($category->resources->where('status', 'active')->chunk(4) as $chunk)
            @foreach($chunk as $index => $resource)
                <a href="{{route('resource.details', $resource->id)}}">
                    <div class="row">
                        <div class="col-12">
                            <div class="cards mb-3">
                                <div class="cards_img">
                                    <div class="imgheight" style="min-height: 200px">
                                        <div class="cards_content">
                                            <h3 class="animated animate-slide-left">{{ $resource->title }}</h3>
                                            <p class="animated animate-slide-right">{{ $resource->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @endforeach
    </div>
</section>



  @endsection
