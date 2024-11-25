@extends('layouts.front')

@section('content')

<!--========================= full screen slider part hear ======================-->
    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade animate__delay-.2s" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($sliders as $index => $slider)
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="Slider Image">
                    <div class="carousel-caption d-md-block">
                        <h5 class="animated animate-slide-left">{{ $slider->title }}</h5>
                        <hr>
                        <p class="animated animate-slide-right">{{ $slider->sub_title }}</p>
                        @if($slider->btn_link)
                            <a href="{{ $slider->btn_link }}" class="btn btn-primary">View More</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</header>
<!--================ header section html code end here =================-->


<!--================ bg_banner section html code start here =================-->
<section id="bg_banner" class="gallery">
    <div class="img_container">
        <div class="image col3 topmargin">
            <div class="txt animated animate-slide-left">
                <h3>{{ $feelSpecial->title }}</h3>
                <p>{{ $feelSpecial->short_description }}</p>
                <a href="{{route('lto.list')}}" target="_blank">
                    <i class="fas fa-external-link"></i> &nbsp; {{ $feelSpecial->button_title }}
                </a>
            </div>
            <div class="color"></div>
        </div>

        <!-- Image Slider -->
        <div id="feel-special-slider" class="image col3 animated animate-slide-right">
            @foreach($feelSpecial->images as $image)
                <div class="slider-item">
                    <img src="{{ asset('storage/' . $image) }}" alt="Feel Special Image" class="slider-img">
                </div>
            @endforeach
        </div>
    </div>
</section> 


<!--================ bg_banner section html code end here =================-->
<!--================ Current_category section html code start here =================-->
<section id="bg_banner" class="paddingtopbtm gallery">
    <div class="img_container columnOne">
        <div class="image col3">
            <img src="{{ $banner && $banner->image ? asset('storage/' . $banner->image) : asset('front/images/pixelcut-export7.jpeg') }}" alt="image">
            <div class="txt animated animate-slide-left">
                <h3>{{ $banner->title ?? 'a new generation of winemakers' }}</h3>
                <p>{{ $banner->sub_title ?? 'Lorem, ipsum dolor sit amet, consectetur quasi adipisicing elit. Possimus vel, dolorum, eligendi quasi consectetur ab.' }}</p>
                <a class="button" href="{{ $banner->button_link ?? route('signup.menu-activation') }}">{{ $banner->button_title ?? 'view details' }}</a>
            </div>
        </div>
    </div>
</section>
<!--================ Current_category section html code end here =================-->


<!--================ bg_banner section html code start here =================-->

<section id="bg_banner" class="paddingtopbtm py-xl-8">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <h2 class="mb-4 display-5">Resources</h2>
            </div>
        </div>

        @foreach($categories->chunk(4) as $chunk)
            <div class="img_container">
                @foreach($chunk as $index => $category)
                    @if($category->roles && (Auth::user()->hasAnyRole($category->roles)  || Auth::user()->hasRole('admin') || Auth::user()->hasRole('super-admin')))
                        <a href="{{route('category.details', $category->id)}}">
                            <div class="image {{ $index % 4 == 0 || $index % 4 == 3 ? 'col2' : 'col1' }}">
                                <div class="animated animate-slide-left">
                                    <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}">
                                </div>
                                <div class="txt animated animate-slide-left">
                                    <h3>{{ $category->name }}</h3>
                                    <p>{{ $category->short_description }}</p>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</section>



<!--================ bg_banner section html code end here =================-->
@endsection