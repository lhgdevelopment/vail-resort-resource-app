@extends('layouts.front')

@section('content')

</header>
{{-- <!--================ header section html code end here =================-->
<!--========================= full screen slider part hear ======================-->
<section id="hero">
    <div class="category_item" >
        <div class="img">
            <img src="images/pixelcut-export9.png" alt="image">
        </div>
        <div class="category">
            <h1>wine partners portfolios</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">wine partners portfolios</li>
              </ul>
            </nav>
        </div>
    </div>
</section>

<!--================ Current_category section html code start here =================-->
<section id="description" class="PaddingTop">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                <div class="cards mb-3" >
                      <div class="cards_img">
                          <div class=" imgheight">
                                <img class="" src="images/pixelcut-export11.png" alt="image">
                              <div class="cards_content">
                                <h5 class="cardtitle">wine partners portfolios</h5>
                                <h6>category description</h6>
                                <p class="cardtext">Lorem ipsum dolor sit amet consectetur.</p>
                                <p class="cardtext">Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ullam sunt provident explicabo cupiditate quaerat, modi, expedita earum culpa, vel quisquam fuga commodi possimus placeat tempora, illo unde adipisci hic consequatur?</p>
                              </div>
                          </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </section>
<!--================ Current_category section html code end here =================-->

<!--================ bg_banner section html code start here =================-->
<section id="bg_banner" class=" productlistpage py-xl-8">
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-12">
        <h2 class="mb-4 display-5 text-center">Category Resources </h2>
      </div>
    </div>
    <div class="img_container">
        <a href="#">
            <div class="image col2">
                <div class="txt">
                    <h3>bar menu building guide</h3>
                    <p>We partner with over 53 nonprofit organizations</p>
                </div>
                <img src="images/pixelcut-export3.png" alt="image">
            </div>
        </a>
        <a href="#">
            <div class="image col1">
                <div class="txt">
                    <h3>bar menu building guide</h3>
                    <p>We partner with over 53 nonprofit organizations</p>
                </div>
                <img src="images/pixelcut-export2.png" alt="image">
            </div>
        </a>
        <a href="#">
            <div class="image col1">
                <div class="txt">
                    <h3>bar menu building guide</h3>
                    <p>We partner with over 53 nonprofit organizations</p>
                </div>
                <img src="images/pixelcut-export.png" alt="image">
            </div>
        </a>
        <a href="#">
            <div class="image col2">
                <div class="txt">
                    <h3>bar menu building guide</h3>
                    <p>We partner with over 53 nonprofit organizations</p>
                </div>
                <img src="images/pixelcut-export4.png" alt="image">
            </div>
        </a>
    </div>
  </div>
</section>
<!--================ bg_banner section html code end here =================--> --}}

<!-- Category Banner and Breadcrumb -->
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

<!-- Category Description Section -->
<section id="description" class="PaddingTop">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="cards mb-3">
                    <div class="cards_img">
                        <div class="imgheight">
                            <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}">
                            <div class="cards_content">
                                <h5 class="cardtitle">{{ $category->name }}</h5>
                                <h6>{{ $category->short_description }}</h6>
                                <p class="cardtext">{{ $category->long_description }}</p>
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
                                <h3>{{ $resource->title }}</h3>
                                <p>{{ $resource->description }}</p>
                            </div>

                            <!-- Display File or Embed Code -->
                            @if ($resource->type === 'file' && $resource->file_path)
                                @php
                                    $fileType = mime_content_type(storage_path('app/public/' . $resource->file_path));
                                @endphp
                                @if (strpos($fileType, 'image/') === 0)
                                    <!-- Image file display -->
                                    <img src="{{ asset('storage/' . $resource->file_path) }}" alt="Image" class="img-fluid img-responsive rounded product-image" style="max-width: 100%; height: auto;">
                                    <div class="social">
                                        <a href="{{ asset('storage/' . $resource->file_path) }}" download>
                                            <span><i class="fa-solid fa-download"></i></span>Download
                                        </a>
                                    </div>
                                @elseif ($fileType === 'application/pdf')
                                    <!-- PDF file display -->
                                    <embed src="{{ asset('storage/' . $resource->file_path) }}" type="application/pdf" width="100%" height="600px" />
                                    <div class="social">
                                        <a href="{{ asset('storage/' . $resource->file_path) }}" download>
                                            <span><i class="fa-solid fa-download"></i></span>Download
                                        </a>
                                    </div>
                                @endif
                            @elseif ($resource->type === 'link' && $resource->embed_code)
                                <!-- Embed code for link type resources -->
                                <div class="embed-responsive">
                                    {!! $resource->embed_code !!}
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</section>



  @endsection