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
            <h1 class="animated animate-slide-left">LTO</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ul class="breadcrumb animated animate-slide-right">
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
                <h3 class="text-uppercase text-center fs-3 text-white animated animate-slide-left">LTO</h3>
            </div>
            <div class="col-4">
                <form method="GET" action="{{ route('lto.list') }}" class="d-flex justify-content-end">
                    <div class="me-4">
                        <select name="year" id="year" class="form-control select-year animated animate-slide-right">
                            <option value="">Select Year</option>
                            @foreach(range(2024, 2027) as $y)
                                <option value="{{ $y }}" {{ (int) $year === $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
        
        
    </div>
</section>

<!--====================== product description section html code start here ====================--> 
<section id="description" class="months pb-5 pt-5 pagedetails">
    <div class="container">
        @php
            $months = [
                'january' => 'January',
                'february' => 'February',
                'march' => 'March',
                'april' => 'April',
                'may' => 'May',
                'june' => 'June',
                'july' => 'July',
                'august' => 'August',
                'september' => 'September',
                'october' => 'October',
                'november' => 'November',
                'december' => 'December',
            ];
        @endphp

        <div class="row">
            @foreach($months as $slug => $name)
                <div class="col-md-3 col-sm-6 pt-3 pb-3">
                    <a href="{{ route('lto.data', [$slug, $year]) }}">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $name }}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary pt-3">{{ $year }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</section>
<!--====================== product description section html code end here ====================-->

<script>
    document.getElementById('year').addEventListener('change', function () {
        this.form.submit();
    });
</script>
@endsection
