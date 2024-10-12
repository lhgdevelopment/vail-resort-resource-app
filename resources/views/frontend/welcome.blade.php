@extends('layouts.front')

@section('content')

<!--========================= full screen slider part hear ======================-->
<div id="carouselExampleAutoplaying" class="carousel slide carousel-fade animate__delay-.2s" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
          <img src="{{asset('')}}front/images/pexels-photo-1705667.jpeg" class="d-block w-100" alt="image">
          <div class="carousel-caption d-md-block">
            <h5 class="animate__animated animate__backInRight animate__delay-.1s fs-2">Consectetur adipisicing elit. </h5>
            <p class="animate__animated animate__backInRight animate__delay-1s fs-5">Vitae reiciendis repellendus placeat beatae id quas voluptatum, consequuntur ad dolorem quae quis tenetur eum laboriosam aperiam.</p>
            <a href="#">view More</a>
          </div>
        </div>

      <div class="carousel-item ">
        <img src="{{asset('')}}front/images/20120319_HV_VailResortsPhotography_001-1-1024x358.jpg" class="d-block w-100" alt="image">
        <div class="carousel-caption d-md-block">
          <h5 class="animate__animated animate__fadeInLeft animate__delay-.1s fs-2" >Lorem ipsum dolor sit, amet.</h5>
          <p class="animate__animated animate__fadeInLeft animate__delay-1s fs-5">Ipsam soluta numquam aliquid, illum, aut ratione. Impedit dolores facere beatae omnis?</p>
          <a href="#">view More</a>
        </div>
      </div>
      
      <div class="carousel-item ">
        <img src="{{asset('')}}front/images/free-photo-of-a-man-skiing.jpeg" class="d-block w-100" alt="image">
        <div class="carousel-caption d-md-block">
          <h5 class="animate__animated animate__backInUp animate__delay-.5s fs-2"> Debitis libero autem harum nobis!.</h5>
          <p class="animate__animated animate__backInUp animate__delay-1s fs-5">Consequuntur ad dolorem quae quis tenetur eum laboriosam aperiam.</p>
          <a href="#">view More</a>
        </div>
      </div>
    </div>
  </div>
</header>
<!--================ header section html code end here =================-->

<!--================ Current_category section html code start here =================-->
<section class="Current_category py-5">
  <div class="container">
      <div class="row">
          <h1>Current Release Category</h1>
          <div class="col-lg-3 col-md-6 col-sm-6 pb-4">
              <div class="cardcontainer card">
                  <div class="photo">
                      <img src="{{asset('')}}front/images/pexels-photo-3600571.jpeg">
                  </div>
                  <div class="content">
                      <h2 class="txt4">Lorem ipsum dolor </h2>
                      <p class="txt2 text-limit-10">New York, the largest city in the U.S., is an architectural marvel, </p>
                  </div>
                  <div class="footer">
                      <a class=" btn" href="details.html"> View Details</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 pb-4">
              <div class="cardcontainer card">
                  <div class="photo">
                      <img src="{{asset('')}}front/images/20120319_HV_VailResortsPhotography_001-1-1024x358.jpg">
                  </div>
                  <div class="content">
                      <h2 class="txt4">Lorem ipsum dolor </h2>
                      <p class="txt2 text-limit-10">New York, the largest city in the U.S., is an architectural marvel, </p>
                  </div>
                  <div class="footer">
                      <a class=" btn" href="details.html"> View Details</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 pb-4">
              <div class="cardcontainer card">
                  <div class="photo">
                      <img src="{{asset('')}}front/images/pexels-photo-1705667.jpeg">
                  </div>
                  <div class="content">
                      <h2 class="txt4">Lorem ipsum dolor </h2>
                      <p class="txt2 text-limit-10">New York, the largest city in the U.S., is an architectural marvel, </p>
                  </div>
                  <div class="footer">
                      <a class=" btn" href="details.html"> View Details</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 pb-4">
              <div class="cardcontainer card">
                  <div class="photo">
                      <img src="{{asset('')}}front/images/Vail-Resorts-11-1024x683.jpg">
                  </div>
                  <div class="content">
                      <h2 class="txt4">Lorem ipsum dolor </h2>
                      <p class="txt2 text-limit-10">New York, the largest city in the U.S., is an architectural marvel, </p>
                  </div>
                  <div class="footer">
                      <a class=" btn" href="details.html"> View Details</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 pb-4">
              <div class="cardcontainer card">
                  <div class="photo">
                      <img src="{{asset('')}}front/images/20221220_BC_Miller_004-1024x819.webp">
                  </div>
                  <div class="content">
                      <h2 class="txt4">Lorem ipsum dolor </h2>
                      <p class="txt2 text-limit-10">New York, the largest city in the U.S., is an architectural marvel, </p>
                  </div>
                  <div class="footer">
                      <a class=" btn" href="details.html"> View Details</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 pb-4">
              <div class="cardcontainer card">
                  <div class="photo">
                      <img src="{{asset('')}}front/images/pexels-photo-1705667.jpeg">
                  </div>
                  <div class="content">
                      <h2 class="txt4">Lorem ipsum dolor </h2>
                      <p class="txt2 text-limit-10">New York, the largest city in the U.S., is an architectural marvel, </p>
                  </div>
                  <div class="footer">
                      <a class=" btn" href="details.html"> View Details</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 pb-4">
              <div class="cardcontainer card">
                  <div class="photo">
                      <img src="{{asset('')}}front/images/Vail-Resorts-11-1024x683.jpg">
                  </div>
                  <div class="content">
                      <h2 class="txt4">Lorem ipsum dolor </h2>
                      <p class="txt2 text-limit-10">New York, the largest city in the U.S., is an architectural marvel, </p>
                  </div>
                  <div class="footer">
                      <a class=" btn" href="details.html"> View Details</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 pb-4">
              <div class="cardcontainer card">
                  <div class="photo">
                      <img src="{{asset('')}}front/images/pexels-photo-1705667.jpeg">
                  </div>
                  <div class="content">
                      <h2 class="txt4">Lorem ipsum dolor </h2>
                      <p class="txt2 text-limit-10">New York, the largest city in the U.S., is an architectural marvel, </p>
                  </div>
                  <div class="footer">
                      <a class=" btn" href="details.html"> View Details</a>
                  </div>
              </div>
          </div>
          <div class="all_btn pt-2">
              <a href="product-list.html">SEE ALL Categories</a>
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