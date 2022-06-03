@extends('frontend.app')
@section('content')

  <!--======================================
          START breadcrumb AREA
  ======================================-->

  <section class="breadcrumb-area">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="breadcrumb-content">

                      <div class="section-heading">
                        <h2 class="section__title">Mock Test</h2>
                      </div>


                  </div><!-- end breadcrumb-content -->
              </div><!-- end col-lg-12 -->
          </div><!-- end row -->
      </div><!-- end container -->
  </section>

  <!--======================================
          END breadcrumb AREA
  ======================================-->

  <section class="story-area section--padding text-center">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="about-content-box">
                      <div class="section-heading">
                            @foreach($mokeTests as $mokeTest)
                                <p> {{ $mokeTest->name }} </p>
                            @endforeach
                      </div><!-- end section-heading -->
                  </div>
              </div><!-- end col-lg-12 -->
          </div><!-- end row -->
      </div><!-- end container -->
  </section>

@endsection
