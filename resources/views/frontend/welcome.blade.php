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
                    <a href="{{route('category.details', $category->id)}}">
                        <div class="image {{ $index % 4 == 0 || $index % 4 == 3 ? 'col2' : 'col1' }}">
                            <div class="animated animate-slide-left">
                                <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}">
                            </div>
                            <div class="txt">
                                <h3 class="animated animate-slide-left">{{ $category->name }}</h3>
                                <p class="animated animate-slide-right">{{ $category->short_description }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</section>


<!--================ bg_banner section html code end here =================-->

<!--================ Current_category section html code start here =================-->

<!--================ Current_category section html code end here =================-->

<!--================ bg_banner section html code start here =================-->
<section id="bg_banner" class=" gallery">
  <div class="img_container">
      <a href="#">
          <div class="image col3 animated animate-slide-left">
              <img src="{{asset('')}}front/images/pixcel5.jpg" alt="image">
          </div>
      </a>
          <div class="image col3 topmargin ">
              <div class="txt">
                  <h6 class="animated animate-slide-left">primium wine</h6>
                  <h3 class="animated animate-slide-left">Innovative Spirits: The Future of Winemaking</h3>
                  <p class="animated animate-slide-right">In the realm of premium wine, a new generation of winemakers is emerging, bringing fresh perspectives and innovative techniques to the craft. These artisans are dedicated to exploring the nuances of flavor and sustainability, harnessing both traditional practices and modern technology to produce exceptional wines. Each bottle is a testament to their creativity and commitment, showcasing unique varietals that reflect the terroir and the passion of the winemaker. </p>
                  {{-- <a href="#">load more</a> --}}
              </div>
              <div class="color"></div>
          </div>
          <div class="image col3 topmargin">
              <div class="txt">
                  <h6 class="animated animate-slide-left">primium wine</h6>
                  <h3 class="animated animate-slide-left">a new genaration of winemarkers</h3>
                  <p class="animated animate-slide-right">Discover the innovative spirit of a new generation of winemakers who are redefining the art of winemaking. These trailblazers combine traditional techniques with modern methods, crafting premium wines that capture unique flavors and characteristics. With a commitment to sustainability and quality, they embrace new technologies and practices, ensuring that every bottle reflects their passion and dedication. Experience the future of wine with selections that inspire and delight, celebrating the evolution of this timeless craft.</p>
                  {{-- <a href="#">load more</a> --}}
              </div>
              <div class="color"></div>
          </div>

      <a href="#">
          <div class="image col3 animated animate-slide-right">
              <img src="{{asset('')}}front/images/pixelcut6.jpeg" alt="image">
          </div>
      </a>
  </div>
</section>
<!--================ bg_banner section html code end here =================-->

<!--================ features section html code start here =================-->
<section id="features">
      <div class="colum_img">
          <a class="d-block" href="#">
              <div class="coll">
                  <div class="feature_img">
                      <div class="img animated animate-slide-left">
                          <img src="{{asset('')}}front/images/pixelcut-export7.jpeg" alt="img">
                      </div>
                      <div class="txt">
                        <h3 class="animated animate-slide-left">Join Us on a Journey of Flavor</h3>
                        <p class="animated animate-slide-right">Discover exceptional wines crafted by the new generation of winemakers, where tradition meets innovation. Cheers to unforgettable experiences!</p>                        
                      </div>
                  </div>
              </div>
          </a>
          <a class="d-block"  href="#">
              <div class="coll">
                  <div class="feature_img">
                      <div class="img animated animate-slide-right">
                          <img src="{{asset('')}}front/images/pixelcut-export8.png" alt="image">
                      </div>
                      <div class="txt">
                        <h3 class="animated animate-slide-left">Experience the Art of Winemaking</h3>
                        <p class="animated animate-slide-left">Indulge in premium wines that celebrate the passion and creativity of today's winemakers. Elevate your taste with every sip!</p>                        
                      </div>
                  </div>
              </div>
          </a>
      </div>
</section>
<!--================ features section html code end here =================-->

@endsection