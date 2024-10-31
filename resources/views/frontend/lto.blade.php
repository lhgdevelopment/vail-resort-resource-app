@extends('layouts.front')

@section('content')

</header>
<!--================ header section html code end here =================-->
</header>
<!--================ header section html code end here =================-->
<section id="hero">
    <div class="category_item" >
        <div class="img animated animate-slide-right">
            <img src="{{asset('')}}front/images/pixelcut-export9.png" alt="image">
        </div>
        <div class="category">
            <h1 class="animated animate-slide-left">LTO Details</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ul class="breadcrumb animated animate-slide-right">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">LTO Details</li>
              </ul>
            </nav>
        </div>
    </div>
</section>

  <section id="resource" class="pb-3 pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-7">
                @php
                    $selectedMonth = $month;
                    $selectedYear = $year;
        
                    if ($selectedMonth && $selectedYear) {
                        // When month and year are selected
                        $month = (int) $selectedMonth;
                        $year = (int) $selectedYear;
                        $monthName = \Carbon\Carbon::create()->month($month)->format('F');
                    } else {
                        // Default to current month and year if not selected
                        $currentDate = \Carbon\Carbon::now();
                        $monthName = $currentDate->format('F'); 
                        $year = $currentDate->year;
                    }
                @endphp
        
                <h3 class="text-uppercase text-center fs-3 text-white animated animate-slide-left">LTO Details for {{ $monthName }} {{ $year }}</h3>
            </div>
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
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title animated animate-slide-left">{{ $lto->title }}</h5>
                                        <p class="card-date animated animate-slide-left">{{ \Carbon\Carbon::parse($lto->from_date)->format('F d, Y') }} to {{ \Carbon\Carbon::parse($lto->to_date)->format('F d, Y') }}</p>
                                        <p class="card-text animated animate-slide-right">{!! $lto->description !!}</p>
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
                
                <div class="pagination justify-content-center mb-4">
                    {{ $ltos->links() }}
                </div>

                <div class="col-4">
                    <div class="col-2">
                        <button type="button" class="btn btn-warning animated animate-slide-right" onclick="history.back()">Back</button>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>
@endsection
