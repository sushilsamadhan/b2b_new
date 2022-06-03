@extends('rumbok.app')

@section('content')


    {{--new design--}}

    <!-- Breadcrumb Section Starts -->

    <section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="title-page">
                <h1>Industrial Courses</h1>
              </div>              
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                          <a href="https://ole.org.in">@translate(home)</a>
                      </li>
                      <li><span>Industrial Courses</span></li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>

    <!-- Course Category Section Starts -->
    <section class="course-category-section padding-top-30 padding-bottom-90">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="row">
                        @forelse($courses as $course)
                            <div class="col-md-4">
                                <div class="pricing-item w-100 {{$loop->index++ %2 == 0 ? 'diffrent-bg' :'rumon'}}">
                                    <div class="thumbnail-image">
                                        <img src="http://courses.iid.org.in/public{{$course->image }}" alt="{{ $course->title }}" class="img-fluid">
                                        <span class="position-absolute classs-block">Rs.{{number_format($course->price,0)}}</span>
                                    </div>
                                    <h3 class="page-title" style="font-size:15px;">{{ Str::limit($course->title,50) }}</h3>
                                    <div class="available-in">
                                    <p style="display: -webkit-box; max-width: 100%;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;">{{ (Str::limit( html_entity_decode(strip_tags($course->short_description)),160)) }}</p>
                                    </div>
                                    <div class="align-items-center justify-content-between border-top pt-2">
                                        <div class="d-block">
                                        <a href="{{'http://courses.iid.org.in/course/'.$course->slug}}"
                                                   class="bisylms-btn-2 d-block" target="_blank">@translate(View Detail)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty

                            <div class="col-12 m-5">
                                <img src="{{asset('no_data.png')}}" class="w-100 img-fluid">
                            </div>
                        @endforelse
							<div class="col-12">
								{{-- $courses->links('rumbok.include.paginate') --}}
							</div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
