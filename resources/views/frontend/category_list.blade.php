@extends('layouts.front')

@section('content')

</header>
<!--================ header section html code end here =================-->
<!--========================= full screen slider part hear ======================-->
<section id="hero">
    <div class="category_item" >
        <div class="img">
            <img src="{{asset('')}}front/images/pexels-photo-3888007.jpeg" alt="image">
        </div>
        <div class="category">
            <h1>Cape of Good Hope Riebeeksrivier Western Slopes</h1>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
                <input type="text" id="category-search" name="search" value="{{ $search ?? '' }}" placeholder="Type and press enter to Search" class="mr-2">
            </div>
            <hr class="pb-4">
            
            <!-- Loop through the categories -->
            @foreach($categories as $category)
            <div class="col-lg-3 col-md-6 col-sm-6 pb-4">
                <div class="cardcontainer card">
                    <div class="photo">
                        <img src="{{ asset('storage/' . $category->thumbnail) }}" class="d-block w-100" alt="{{ $category->name }}">
                    </div>
                    <div class="content">
                        <h2 class="txt4">{{ $category->name }}</h2>
                        <p class="txt2 text-limit-10">{{ \Illuminate\Support\Str::words($category->short_description, 10, '...') }}</p>
                    </div>
                    <div class="footer">
                        <a class="btn" href="{{ route('category.details', $category->id) }}"> More Details</a>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Pagination links -->
            <div class="paginations pt-3">
                {{ $categories->appends(request()->query())->links() }}
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