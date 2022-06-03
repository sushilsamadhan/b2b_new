@extends('rumbok.app')
@section('content')
<section class="heading-n-breadcrub-part mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                    <div class="d-flex align-items-center">
                            <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                            <div class="title-page">
                            <h1>{{$page->title}}</h1>
                            </div>
                    </div>              
                    </div>
                    <div class="col-lg-6">
                        <div class="bread-crumb-part">
                            <ul class="bread-crumb-part-list">
                                <li>
                                <a href="{{route('homepage')}}">@translate(home)</a>
                                </li>
                                <li>
                                  <span> {{$page->title}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          </section>
  <!--======================================
          END breadcrumb AREA
  ======================================-->

  <section class="welcome-content">
      <div class="container">
          <div class="section-heading">
              @foreach ($page->content as $item)
                  <p class="section__desc text-justify">
                  {!! $item->body !!}

              @endforeach
          </div><!-- end section-heading -->
      </div>
  </section>

  

@endsection
