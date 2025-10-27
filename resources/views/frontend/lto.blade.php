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
                    // Retrieve title from the selected LTO category
                    $categoryTitle = $ltoMonth->title ?? $ltoMonth->month_name ?? 'LTO';
                    $year = $ltoMonth->year ?? '';
                    $displayTitle = $year ? $categoryTitle . ' ' . $year : $categoryTitle;
                @endphp
            
                <h3 class="text-uppercase text-left fs-3 text-white animated animate-slide-left">
                    LTO Details for {{ $displayTitle }}
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
                        <div class="card mb-4">
                            <div class="row g-0 BgWhite rounded p-3">
                                <!-- Left Column: Content -->
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title animated animate-slide-left">{{ $lto->title }}</h5>
                                        @if($lto->from_date && $lto->to_date)
                                            <p class="card-date animated animate-slide-left">
                                                {{ \Carbon\Carbon::parse($lto->from_date)->format('F d, Y') }} to {{ \Carbon\Carbon::parse($lto->to_date)->format('F d, Y') }}
                                            </p>
                                        @else
                                            <p class="card-date animated animate-slide-left">
                                                <span class="badge bg-success">Evergreen</span>
                                            </p>
                                        @endif
                                        <div class="card-text animated animate-slide-right">
                                            {!! $lto->description !!}
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('signup.lto') }}" target="_blank" class="btn btn-primary">
                                                <i class="fas fa-external-link"></i> &nbsp; Sign Up
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Image Slider -->
                                <div class="col-md-6">
                                    <div id="carousel-{{ $lto->id }}" class="carousel slide" data-bs-interval="false" style="position: relative;">
                                        <div class="carousel-inner">
                                            @foreach($lto->files as $index => $file)
                                                @if(in_array($file->file_type, ['jpg', 'jpeg', 'png']))
                                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                        <img src="{{ asset('storage/' . $file->file_path) }}" class="d-block w-100 carousel-image" alt="LTO File {{ $index + 1 }}">
                                                        <div class="position-absolute top-0 end-0 m-2" style="z-index: 10;">
                                                            <a href="{{ route('ltos.files.download', $file->id) }}" class="btn btn-sm btn-success" title="Download Image" download>
                                                                <i class="fas fa-download"></i> Download
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
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
                                    
                                    <!-- Download Buttons -->
                                    <div class="mt-3">
                                        <h6>Other Files:</h6>
                                        @foreach($lto->files as $file)
                                            @if(!in_array($file->file_type, ['jpg', 'jpeg', 'png']))
                                                <div class="mb-2">
                                                    <a href="{{ asset('storage/' . $file->file_path) }}" download class="btn btn-secondary">
                                                         {{ $file->file_name }}.{{ $file->file_type }}
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
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

                <!-- Pagination -->
                <div class="pagination justify-content-center mb-4">
                    {{ $ltos->links() }}
                </div>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary animated animate-slide-right" onclick="history.back()">Back</button>
                </div>  
            </div>
        </div>
    </div>
</section>
@endsection
