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
                    <div class="carousel-caption d-md-block">
                        <h5 class="animate__animated animate__backInRight animate__delay-.1s fs-2">{{ $slider->title }}</h5>
                        <p class="animate__animated animate__backInRight animate__delay-1s fs-5">{{ $slider->sub_title }}</p>
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
        <h1>Featured Category</h1>
  
        @foreach($featuredCategories as $category)
          <div class="col-lg-3 col-md-6 col-sm-6 pb-4">
            <div class="cardcontainer card">
              <div class="photo">
                <img src="{{ asset('storage/' . $category->thumbnail) }}" class="d-block w-100" alt="{{ $category->name }}">
              </div>
              <div class="content">
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
  
        <div class="all_btn pt-2">
          <a href="{{ route('category.index') }}">SEE ALL Categories</a>
        </div>
      </div>
    </div>
  </section>
  <!--================ Current_category section html code end here =================-->
  

<!--================ bg_banner section html code start here =================-->
<section id="bg_banner">
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              <div class="img">
                  <img src="{{asset('')}}front/images/pexels-photo-2405062.jpeg" alt="img">
              </div>
          </div>
          <div class="col-md-6 alignitem">
              <div class="all_contents">
                  <h6>PREMIUM WINE</h6>
                  <h2>A New Generation of Winemakers</h2>
                  <p>The best wines are born in the noblest lands. The diversity and great richness of our terroirs located in the most recognized valleys of the country give us an incalculable potential to elaborate wines of the highest quality, eu pri accusamus conclusionemque. Ocurreret scripserit ei vis. Eros iusto.</p>
                  <a href="#">load more______</a>
              </div>
          </div>
      </div>
  </div>
</section>
<!--================ bg_banner section html code end here =================-->

<!--================ Current_category section html code start here =================-->

<!--================ Current_category section html code end here =================-->

<!--================ bg_banner section html code start here =================-->
<section id="bg_banner" class="bgcolor">
  <div class="container">
      <div class="row">
          <div class="col-md-6 alignitem">
              <div class="all_contents">
                  <h6>PREMIUM WINE</h6>
                  <h2>Lorem ipsum dolor, sit amet.</h2>
                  <p>The best wines are born in the noblest lands. The diversity and great richness of our terroirs located in the most recognized valleys of the country give us an incalculable potential to elaborate wines of the highest quality, eu pri accusamus conclusionemque. Ocurreret scripserit ei vis. Eros iusto.</p>
                  <a href="#">load more______</a>
              </div>
          </div>
          <div class="col-md-6">
              <div class="img">
                  <img src="{{asset('')}}front/images/pexels-photo-2433363.jpeg" alt="img">
              </div>
          </div>
      </div>
  </div>
</section>
<!--================ bg_banner section html code end here =================-->

<!--================ features section html code start here =================-->
<section id="features">
  <div class="container">
      <div class="row">
          <div class="col-md-6 col-sm-6 pb-3">
              <div class="feature_img">
                  <div class="img">
                      <img src="{{asset('')}}front/images/pexels-photo-1705667.jpeg" alt="img">
                  </div>
                  <div class="txt">
                      <h3>Lorem, ipsum, dolor.</h3>
                      <p>Lorem ipsum dolor sit amet consectetur.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-sm-6 pb-3">
              <div class="feature_img">
                  <div class="img">
                      <img src="{{asset('')}}front/images/pexels-photo-3600571.jpeg" alt="image">
                  </div>
                  <div class="txt">
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