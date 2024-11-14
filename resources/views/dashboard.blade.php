@extends('layouts.admin')

@section('content')
<style>
  .dashboard {
    height: 700px;
  }
</style>
<section class="section dashboard">
    <div class="row">
      @php $counts = tcount(); @endphp
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total Users</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $counts['total_users'] }}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">Total Categories</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-card-list"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $counts['total_categories'] }}</h6>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-3 col-xl-6">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Videos </h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-camera-video-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $counts['total_videos'] }}</h6>

                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->
          <!-- Customers Card -->
          <div class="col-xxl-3 col-xl-6">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Documents </h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-binary"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $counts['total_documents'] }}</h6>

                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->

    </div>
  </section>
@endsection