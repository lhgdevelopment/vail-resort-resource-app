@extends('layouts.front')

@section('content')

</header>
<!--================ header section html code end here =================-->
</header>
<!--================ header section html code end here =================-->
<section id="hero"  class="heroSection">
    <div class="category_item" >
        <div class="img animated animate-slide-right">
            <img src="{{asset('')}}front/images/pixelcut-export9.png" alt="image">
        </div>
        <div class="category">
            <h1 class="animated animate-slide-left">LTO Details</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ul class="breadcrumb animated animate-slide-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item second-item" aria-current="page">LTO</li>
                <li class="breadcrumb-item active" aria-current="page">LTO Details</li>
              </ul>
            </nav>
        </div>
    </div>
</section>

  <section id="resource" class="pb-3 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-7">
                @php
                    // Retrieve month name and year from the selected LTO month
                    $monthName = $ltoMonth->month_name;
                    $year = $ltoMonth->year;
                @endphp
            
                <h3 class="text-uppercase text-left fs-3 text-white animated animate-slide-left">
                    LTO Details for {{ $monthName }} {{ $year }}
                </h3>
            </div>
        </div>
    </div>
</section>

<section id="description" class="description pb-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (count($ltos))
                    @foreach($ltos as $lto)
                        <div class="card mb-3">
                            <div class="row g-0 p-3 BgWhite rounded">
                                <!-- Image Slider with Arrows -->
                                <div class="col-12">
                                    <div id="carousel-{{ $lto->id }}" class="carousel slide" data-bs-interval="false">
                                        <div class="carousel-inner">
                                            @foreach($lto->images as $index => $image)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <!-- Adjust the height with CSS and object-fit to maintain aspect ratio -->
                                                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 carousel-image" alt="LTO Image {{ $index + 1 }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Carousel navigation arrows -->
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $lto->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $lto->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Card Content -->
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title animated animate-slide-left">{{ $lto->title }}</h5>
                                        <p class="card-date animated animate-slide-left">
                                            {{ \Carbon\Carbon::parse($lto->from_date)->format('F d, Y') }} to {{ \Carbon\Carbon::parse($lto->to_date)->format('F d, Y') }}
                                        </p>
                                        <p class="card-text animated animate-slide-right">{!! $lto->description !!}</p>
                                    </div>
                                </div>

                                <!-- Button at the bottom of the card -->
                                <div class="col-12 text-center mt-3 lto-footer">
                                    <a href="{{route('signup.menu-activation')}}" target="_blank" class="btn">
                                        <i class="fas fa-external-link"></i> &nbsp; Sign Up
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach



                @else
                    <div class="card mb-3">
                        <div class="row g-0 p-3 BgWhite rounded">
                            <div class="col-12">
                                <div class="card-body">
                                    <p class="animated animate-slide-left">No Data Found.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif 
                
                <div class="pagination justify-content-center mb-4">
                    {{ $ltos->links() }}
                </div>

                <div class="col-4">
                    <div class="col-2">
                        <button type="button" class="btn btn-primary animated animate-slide-right" onclick="history.back()">Back</button>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>
@endsection
