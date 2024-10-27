@extends('layouts.front')

@section('content')

</header>
<!--================ header section html code end here =================-->
</header>
<!--================ header section html code end here =================-->
<section id="hero">
    <div class="category_item" >
        <div class="img">
            <img src="{{asset('')}}front/images/pixelcut-export9.png" alt="image">
        </div>
        <div class="category">
            <h1>LTO Lists</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">LTO</li>
              </ul>
            </nav>
        </div>
    </div>
</section>

  <section id="resource" class="pb-3 pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                @php
                    $selectedMonth = request('month');
                    if ($selectedMonth) {
                        [$month, $year] = explode('-', $selectedMonth);
                        $month = (int) $month;
                        $monthName = \Carbon\Carbon::create()->month($month)->format('F');
                    } else {
                        $currentDate = \Carbon\Carbon::now();
                        $monthName = $currentDate->format('F'); 
                        $year = $currentDate->year; 
                    }
                @endphp

                <h3 class="text-uppercase text-center fs-3 text-white">LTO for {{ $monthName }} {{ $year }}</h3>
            </div>
            <div class="col-6">
                <select name="month" id="month" class="form-control select-month" onchange="location = this.value;">
                    <option value="">Select Month</option>
                    <option value="09-24" {{ request('month') === '09-24' ? 'selected' : '' }}>September 2024</option>
                    <option value="10-24" {{ request('month') === '10-24' ? 'selected' : '' }}>October 2024</option>
                    <option value="11-24" {{ request('month') === '11-24' ? 'selected' : '' }}>November 2024</option>
                    <option value="12-24" {{ request('month') === '12-24' ? 'selected' : '' }}>December 2024</option>
                    <option value="{{ $currentMonth }}-{{ $currentYear }}" {{ request('month') === "{$currentMonth}-{$currentYear}" ? 'selected' : '' }}>Current Month</option>
                </select>
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
                                        <h5 class="card-title">{{ $lto->title }}</h5>
                                        <p class="card-date">{{ \Carbon\Carbon::parse($lto->from_date)->format('F d, Y') }} to {{ \Carbon\Carbon::parse($lto->to_date)->format('F d, Y') }}</p>
                                        <p class="card-text">{!! $lto->description !!}</p>
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
                                    <p>No Data Found.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="pagination justify-content-center">
                    {{ $ltos->links() }}
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    document.getElementById('month').addEventListener('change', function() {
        const month = this.value;
        window.location.href = `?month=${month}`;
    });
</script>
@endsection
