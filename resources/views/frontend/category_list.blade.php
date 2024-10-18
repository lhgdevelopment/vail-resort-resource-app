@extends('layouts.front')

@section('content')

</header>
<!--================ header section html code end here =================-->
<!--========================= full screen slider part hear ======================-->
<section id="hero">
    <div class="category_item" >
        <div class="img animated animate-slide-right">
            <img src="{{asset('')}}front/images/pexels-photo-3888007.jpeg" alt="image">
        </div>
        <div class="category">
            <h1 class="animated animate-slide-left">Cape of Good Hope Riebeeksrivier Western Slopes</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ul class="breadcrumb animated animate-slide-left">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
              </ul>
            </nav>
        </div>
    </div>
</section>

<!--================ Current_category section html code start here =================-->
<section class="Current_category py-5">
    <div class="container">
        <div class="row">
            <div class="form-inline d-flex gap-3 pb-4 justify-content-between px-3">
                <span class="mr-md-auto">Showing {{ $categories->firstItem() }}–{{ $categories->lastItem() }} of {{ $categories->total() }} results</span>
                <div class="search-container">
                    <input type="text" id="category-search" name="search" value="{{ $search ?? '' }}" placeholder="Type and press enter to search" class="search-input">
                    <span class="search-icon"><i class="fa-solid fa-search"></i></span>
                </div>
                
            </div>
            <hr class="pb-4">
            
            <!-- Loop through the categories -->
            @foreach($categories as $category)
            <div class="col-lg-3 col-md-6 col-sm-6 pb-4 animated animate-slide-left">
                <div class="cardcontainer card">
                    <div class="photo animated animate-fade-up">
                        <img src="{{ asset('storage/' . $category->thumbnail) }}" class="d-block w-100" alt="{{ $category->name }}">
                    </div>
                    <div class="content animated animate-slide-right">
                        <h2 class="txt4">{{ $category->name }}</h2>
                        <p class="txt2 text-limit-10">{{ \Illuminate\Support\Str::words($category->short_description, 10, '...') }}</p>
                    </div>
                    <div class="footer">
                        <a class="btn" href="{{ route('category.details', $category->id) }}"> More Details</a>
                    </div>
                </div>
            </div>
            @endforeach
      
            <div class="paginations">
                <ul class="pagination">
                    <!-- Previous Button -->
                    @if ($categories->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $categories->previousPageUrl() }}">Previous</a>
                        </li>
                    @endif
            
                    <!-- Page Numbers -->
                    @for ($i = 1; $i <= $categories->lastPage(); $i++)
                        <li class="page-item {{ $categories->currentPage() === $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
            
                    <!-- Next Button -->
                    @if ($categories->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $categories->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    @endif
                </ul>
            </div>
            
            
        </div>
    </div>
</section>
<!--================ Current_category section html code end here =================-->

<script>
    document.getElementById('category-search').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            // Redirect to the same page with search query
            const query = this.value.trim();
            if (query) {
                window.location.href = `?search=${query}`;
            } else {
                window.location.href = `{{ route('category.index') }}`; // Reset to index without search
            }
        }
    });
</script>
@endsection