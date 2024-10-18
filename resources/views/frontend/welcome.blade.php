@extends('layouts.front')

@section('content')
    <!--========================= full screen slider part ======================-->
    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade animate__delay-.2s" data-bs-ride="carousel">

        <!-- Carousel indicators -->
        <div class="carousel-indicators">
            @foreach($sliders as $key => $slider)
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{{ $key }}" 
                    class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : 'false' }}" 
                    aria-label="Slide {{ $key + 1 }}"></button>
            @endforeach
        </div>

        <!-- Carousel items -->
        <div class="carousel-inner">
            @foreach($sliders as $key => $slider)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="slider image">
                    <div class="carousel-caption d-md-block banner-text-overlay animated animate-slide-right">
                        <h5 class="animate__animated animate__fadeInRight animate__delay-1s fs-2">{{ $slider->title }}</h5>
                        <p class="animate__animated animate__fadeInRight animate__delay-1s fs-5">{{ $slider->sub_title }}</p>
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

<!--================ Current_category section html code start here =================-->
    <section class="Current_category py-5">
        <div class="container">
            <div class="row">
                <h1 class="animated animate-fade-up">Featured Category</h1>
    
                @foreach($featuredCategories as $category)
                    <div class="col-lg-3 col-md-6 col-sm-6 pb-4 animated animate-slide-left">
                        <div class="cardcontainer card">
                            <div class="photo animated animate-fade-up">
                                <img src="{{ asset('storage/' . $category->thumbnail) }}" class="d-block w-100" alt="{{ $category->name }}">
                            </div>
                            <div class="content animated animate-slide-right">
                                <h2 class="txt4">{{ $category->name }}</h2>
                                <p class="txt2 text-limit-10">
                                    {{ \Illuminate\Support\Str::words($category->short_description, 10, '...') }}
                                </p>
                            </div>
                            <div class="footer">
                                <a class="btn" href="{{ route('category.details', $category->id) }}"> View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
    
                <div class="all_btn pt-2 animated animate-fade-up">
                    <a href="{{ route('category.index') }}">SEE ALL Categories</a>
                </div>
            </div>
        </div>
    </section>
    
    

  <!--================ Current_category section html code end here =================-->
  


  <!--================ bg_banner section html code start here =================-->
<section id="bg_banner" class="bgcolor py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 animated animate-slide-left">
                <div class="img">
                    <img src="{{asset('')}}front/images/pexels-photo-2405062.jpeg" alt="img" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 alignitem animated animate-slide-right">
                <div class="all_contents">
                    <h6 class="animated animate-fade-up">PREMIUM WINE</h6>
                    <h2 class="animated animate-fade-up">A New Generation of Winemakers</h2>
                    <p class="animated animate-fade-up">The best wines are born in the noblest lands. The diversity and great richness of our terroirs located in the most recognized valleys of the country give us an incalculable potential to elaborate wines of the highest quality, eu pri accusamus conclusionemque. Ocurreret scripserit ei vis. Eros iusto.</p>
                    <a href="#" class="btn animated animate-fade-up">load more______</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="bg_banner" class="bgcolor py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 alignitem animated animate-slide-left">
                <div class="all_contents">
                    <h6 class="animated animate-fade-up">PREMIUM WINE</h6>
                    <h2 class="animated animate-fade-up">Lorem ipsum dolor, sit amet.</h2>
                    <p class="animated animate-fade-up">The best wines are born in the noblest lands. The diversity and great richness of our terroirs located in the most recognized valleys of the country give us an incalculable potential to elaborate wines of the highest quality, eu pri accusamus conclusionemque. Ocurreret scripserit ei vis. Eros iusto.</p>
                    <a href="#" class="btn animated animate-fade-up">load more______</a>
                </div>
            </div>
            <div class="col-md-6 animated animate-slide-right">
                <div class="img">
                    <img src="{{asset('')}}front/images/pexels-photo-2433363.jpeg" alt="img" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<!--================ bg_banner section html code end here =================-->

<!--================ features section html code start here =================-->
<section id="features" class="py-5">
    <div class="container">
        <div class="row">
            <!-- First Feature Block -->
            <div class="col-md-6 col-sm-6 pb-3 animated animate-slide-left">
                <div class="feature_img position-relative">
                    <div class="img">
                        <img src="{{asset('')}}front/images/pexels-photo-1705667.jpeg" alt="img" class="img-fluid">
                    </div>
                    <div class="txt position-absolute text-overlay animated animate-fade-up">
                        <h3>Lorem, ipsum, dolor.</h3>
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                    </div>
                </div>
            </div>

            <!-- Second Feature Block -->
            <div class="col-md-6 col-sm-6 pb-3 animated animate-slide-right">
                <div class="feature_img position-relative">
                    <div class="img">
                        <img src="{{asset('')}}front/images/pexels-photo-3600571.jpeg" alt="image" class="img-fluid">
                    </div>
                    <div class="txt position-absolute text-overlay animated animate-fade-up">
                        <h3>Lorem, ipsum, dolor.</h3>
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--================ features section html code end here =================-->

@endsection