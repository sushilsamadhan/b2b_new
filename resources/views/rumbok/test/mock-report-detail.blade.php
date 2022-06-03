@extends('rumbok.app')

@section('content')

<!--======================================
          START breadcrumb AREA
  ======================================-->



<!--======================================
            END breadcrumb AREA
    ======================================-->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!--======================================
            START COURSE AREA
    ====================================== padding-top-80px padding-bottom-120px-->
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="title-page">
              <h1>{{ $mockTests->name }} Mock Test</h1>
              </div>              
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
              <a href="{{ route('mock-test-package' ,[$packageDetail->id, $mockTestEnrollment->mock_test_id]) }}" type="botton" class="btn btn-danger">View Reports</a>
              
                  <!-- <ul class="bread-crumb-part-list">
                      <li>
                          <a href="https://ole.org.in">Home</a>
                      </li>
                      <li><span>Board CBSE</span></li>
                  </ul> -->
              </div>
          </div>
      </div>
  </div>
</section>

<section class="clearfix">
    <div class="container">
        {{-- sidebar --}}
        <div class="row" id="product-gallery-holder-2222">
            @include('rumbok.test.component.mock-report-test-start-filter')            
        </div>
    </div>
</section>
<!--======================================
            END COURSE AREA
    ======================================-->
@endsection

@section('js')
{{-- stripe --}}
@endsection