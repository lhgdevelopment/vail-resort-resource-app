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

<!-- Category Resources Section -->
<section id="bg_banner" class="productlistpage py-xl-8">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <h2 class="mb-4 display-5 text-center">Category Resources</h2>
            </div>
        </div>

        <!-- Loop through resources in chunks of 4, and manage col1/col2 layout -->
        @foreach($category->resources->where('status', 'active')->chunk(4) as $chunk)
            <div class="img_container">
                @foreach($chunk as $index => $resource)
                    <a href="{{route('resource.details', $resource->id)}}">
                        <div class="image {{ $index % 4 == 0 || $index % 4 == 3 ? 'col2' : 'col1' }}">
                            <div class="txt">
                                <h3 class="animated animate-slide-left">{{ $resource->title }}</h3>
                                <p class="animated animate-slide-right">{{ $resource->description }}</p>
                            </div>

                            <!-- <img src="{{ asset('storage/' . $resource->feature_image) }}" alt="Image" class="img-fluid img-responsive rounded product-image" style="max-width: 100%; height: auto;"> -->
                        </div>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</section>



  @endsection