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
            <h1 class="animated animate-slide-left">LTO</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ul class="breadcrumb animated animate-slide-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">LTO</li>
              </ul>
            </nav>
        </div>
    </div>
</section>

  <section id="resource" class="pb-3 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3 class="text-uppercase text-left fs-3 text-white animated animate-slide-left">Available LTO Offers</h3>
            </div>
        </div>
        
        
    </div>
</section>

<!--====================== product description section html code start here ====================--> 
<section id="description" class="months pb-5 pt-5 pagedetails">
    <div class="container">
        <div class="row">
            @foreach($ltoMonths as $ltoMonth)
                <div class="col-md-3 col-sm-6 pt-3 pb-3">
                    <a href="{{ route('lto.data', $ltoMonth->id) }}">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $ltoMonth->month_name }}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary pt-3">{{ $ltoMonth->year }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--====================== product description section html code end here ====================-->

@endsection
