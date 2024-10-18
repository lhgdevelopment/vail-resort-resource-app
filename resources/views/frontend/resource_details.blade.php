@extends('layouts.front')

@section('content')

</header>
<!--========================= full screen slider part hear ======================-->
<section id="hero">
    <div class="category_item">
        <div class="img animated animate-slide-right">
            <img src="{{ asset('storage/' . $category->banner) }}" alt="{{ $category->name }}">
        </div>
        <div class="category">
            <h1 class="animated animate-slide-left">{{ $category->name }}</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Resource</li>
                </ul>
            </nav>
        </div>
    </div>
</section>

  <!--====================== product description section html code start here ====================--> 
  {{-- <section id="description" class="pb-5 bgwhite pt-5">
      <div class="container">
          <div class="row">
              <div class="col-12">
                <div class="card mb-3" >
                  <div class="row g-0 p-3 bg-white border rounded">
                    
                    <div class="mb-4">
                      <div class="card-body">
                        <h5 class="card-title">Lorem ipsum, dolor sit amet.</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ullam sunt provident explicabo cupiditate quaerat, modi, expedita earum culpa, vel quisquam fuga commodi possimus placeat tempora, illo unde adipisci hic consequatur?</p>
                        <p class="card-text"><small class="text-body-secondary">Lorem ipsum, dolor sit.</small></p>
                        <div class="footer">
                            <a class=" btn" href="details.html"><span class="mx-2"><i class="fa-solid fa-download"></i></span>Download</a>
                        </div>
                      </div>
                    </div>
                    <div class="">
                        <div class="img imgheight">
                            <img src="{{asset('')}}front/images/pexels-photo-270756.jpeg" class="img-fluid img-responsive rounded product-image" alt="img">
                        </div>
                      </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </section> --}}

  <section id="description_resource" class="pb-5 bgwhite pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0 p-3 bg-white border rounded">

                        <!-- Resource Details Section -->
                        <div class="col-md-12 mb-4 animated animate-slide-right">
                            <div class="card-body">
                                <h5 class="card-title">{{ $resource->title }}</h5>
                                <p class="card-text">{{ $resource->description }}</p>
                                <p class="card-text"><small class="text-body-secondary">Author: {{ $resource->author }}</small></p>

                                <!-- Download Button for Files -->
                                @if ($resource->type === 'file' && $resource->file_path)
                                    <div class="footer">
                                        <a class="btn btn-success" href="{{ asset('storage/' . $resource->file_path) }}" download>
                                            <span class="mx-2"><i class="fa-solid fa-download"></i></span>Download
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- File/Embed Display Section -->
                        <div class="col-md-12 mb-4 animated animate-slide-left">
                            <div class="img imgheight">
                                <!-- Display File or Embed Code -->
                                @if ($resource->type === 'file' && $resource->file_path)
                                    @php
                                        $fileType = mime_content_type(storage_path('app/public/' . $resource->file_path));
                                    @endphp
                                    
                                    @if (strpos($fileType, 'image/') === 0)
                                        <img src="{{ asset('storage/' . $resource->file_path) }}" class="img-fluid img-responsive rounded product-image" alt="Image" style="max-width: 100%; height: auto;">
                                    @elseif ($fileType === 'application/pdf')
                                        <embed src="{{ asset('storage/' . $resource->file_path) }}" type="application/pdf" width="100%" height="600px" />
                                    @endif
                                @elseif ($resource->type === 'link' && $resource->embed_code)
                                    <div class="embed-container-resource">
                                        {!! $resource->embed_code !!}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



  <!--====================== product description section html code end here ====================--> 


@endsection