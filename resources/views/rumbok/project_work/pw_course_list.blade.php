@extends('rumbok.app')
@section('content')

  <!--======================================
          START breadcrumb AREA
  ======================================-->

  <!-- <section class="heading-n-breadcrub-part mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="title-page">
                          <h1>Project Work</h1>
                        </div>              
                    </div>
                    <div class="col-lg-6">
                        <div class="bread-crumb-part">
                            <ul class="bread-crumb-part-list">
                                <li>
                                <a href="{{route('homepage')}}">@translate(home)</a>
                                </li>
                                <li>
                                  <span> {{'Project Work'}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
  </section> -->
  <!--======================================
          END breadcrumb AREA
  ======================================-->

   <section class="clearfix py-3 header-project">
   <div class="container">
      <div class="row align-items-end">
         <div class="col-md-10">
            
            <ul class="listing-person">
               <li>
                  <span> <a href="{{route('project_work')}}" class="text-white">Project Work</a></span>
               </li>
               @if($category->parent_category_id>0)
                  <li>{{(isset($category->parent))?$category->parent->category_name:''}}</li>
                  <li>{{(isset($category))?$category->category_name:''}}</li>
               @else
                  <li>{{(isset($category))?$category->category_name:''}}</li>
               @endif
            </ul>
         </div>
         <div class="col-md-2">
            <a class="btn btn-block btn-warning text-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="ti-reload"></i> Change</a>
         </div>
      </div>
   </div>
   </section>
   <div class="container text-center my-4 collapse" id="collapseExample">
      <div class="row my-4">
                <div class="col-md-12">
                    <h4 class="project-learning-heading text-center mb-0">Change Your Stream</h4>
                </div>
      </div>
     
      <div class="wrapper-select">
        @foreach($pwCategory as $pwcat)
          @php
            $cat_slug = str_replace(" ","-",strtolower($pwcat->category_name));
          @endphp
          @if($pwcat->child->count()>0)
          <style>
            #{{$cat_slug}}:checked:checked ~ .{{$cat_slug}} {
                  border-color: #0069d9;
                  background: #0069d9;
              }
              #{{$cat_slug}}:checked:checked ~ .{{$cat_slug}} .dot {
                  background: #fff;
              }
              #{{$cat_slug}}:checked:checked ~ .{{$cat_slug}} span {
                  color: #fff;
              }
              #{{$cat_slug}}:checked:checked ~ .{{$cat_slug}} .dot::before {
                  opacity: 1;
                  transform: scale(1);
              }
          </style>
            <input type="radio" name="select" id="{{$cat_slug}}">
            <label for="{{$cat_slug}}" class="option {{$cat_slug}}" data-toggle="collapse" data-target="#{{$cat_slug}}" aria-expanded="false" aria-controls="{{$cat_slug}}">
              <div class="dot"></div>
                <span>{{$pwcat->category_name}}</span>
            </label>
          @else
            <a href="{{route('project_work.pw_course_list',[$pwcat->slug])}}" class="option"><span>{{$pwcat->category_name}}</span></a>
          @endif
        @endforeach
      </div>
  </div>
  @foreach($pwCategory as $pwcat)
    @php
      $cat_slug = str_replace(" ","-",strtolower($pwcat->category_name));
    @endphp
    
      @if($pwcat->child->count()>0)
        <div class="container collapse" id="{{$cat_slug}}">
          
          <div class="row">
          @foreach($pwcat->child as $child)
            <div class="col-md-2 mb-3">
            <a href="{{route('project_work.pw_course_list',[$child->slug])}}">
                <div class="college-stream h-100 text-center" tabindex="-1">
                  <div class="full-form"><h5>{{$child->category_name}}</h5></div>
                </div>
            </a>
            </div>
          @endforeach
          </div>
        </div>
      @endif
   @endforeach

  <section class="clearfix my-3">
     <div class="container">
      <div class="row my-2">
         <div class="col-md-9">
            <p>Total <strong>{{$courses->total()}} records</strong> found</p>
         </div>
         <div class="col-md-3">
            <div class="form-group mb-0">
               <div class="search__container">
                  <input class="search__input" id="search" type="text" placeholder="Search">
                  <input type="hidden" id="searchUrl" value="{{route('projectwork.search')}}">
                  <div class="overflow-hidden search-list w-100">
                     <div id="appendSearchCart1"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row my-4">
      @forelse($courses as $course)
         <div class="col-md-4">
            <div class="schedule-thumb-summary">
               <div class="schedule-thumb">
                  <div class="badge-minheight">
                  <?php
                     $itemLectureCount = 0;
                     foreach($course->classes as $course_classes){
                           foreach($course_classes->contents as $class_content){
                              $itemLectureCount++;
                           }
                     }
                     $total_duration = 0;
                     foreach ($course->classes as $item){
                         $total_duration +=$item->contents->sum('duration');
                     }
                  ?>
                     <span class="badge"><i class="social_youtube"></i> {{$itemLectureCount}} Lectures</span> 
                     <span class="offer-badge-one">{{duration($total_duration)}} Duration</span>
                  </div>
                  <div class="detailed-content">
                     <div class="schedule-detail-summary">
                        <div class="schedule-date" style="margin-bottom:0;line-height:24px;height:50px;">
                           <div class="media">
                              <a href="{{route('project_work.pw_course_detail',$course->slug)}}">{{$course->title}}</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  @guest
                  <div class="course-cost-summary">
                     <div class="media">
                        @if($course->is_free)
                           <span
                                 class="course-cost align-self-center">@translate(Free)</span>
                        @else
                           @if($course->is_discount)
                                 <span
                                    class="course-cost align-self-center">{{formatPrice($course->discount_price)}}</span>
                                 <span class="course-cost align-self-center">{{formatPrice($course->price)}}</span>
                           @else
                                 <span
                                    class="course-cost align-self-center">{{formatPrice($course->price)}}</span>
                           @endif
                        @endif
                        <div class="media-body">
                           <div class="course-exclusive-content align-self-center">
                              (Excl all taxes)
                           </div>
                        </div>
                     </div>
                  </div>
                  @endguest
                  @auth
                     @if(Auth::user()->user_type == 'Student')
                        @if(checkProjectWorkEnrolled($course->id,\Illuminate\Support\Facades\Auth::user()->id))
                        <div class="course-cost-summary">
                           <div class="media">
                           </div>
                        </div>
                        @else
                        <div class="course-cost-summary">
                           <div class="media">
                              @if($course->is_free)
                                 <span
                                       class="course-cost align-self-center">@translate(Free)</span>
                              @else
                                 @if($course->is_discount)
                                       <span
                                          class="course-cost align-self-center">{{formatPrice($course->discount_price)}}</span>
                                       <span class="course-cost align-self-center">{{formatPrice($course->price)}}</span>
                                 @else
                                       <span
                                          class="course-cost align-self-center">{{formatPrice($course->price)}}</span>
                                 @endif
                              @endif
                              <div class="media-body">
                                 <div class="course-exclusive-content align-self-center">
                                    (Excl all taxes)
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endif
                     @else
                     <div class="course-cost-summary">
                        <div class="media">
                           @if($course->is_free)
                              <span
                                    class="course-cost align-self-center">@translate(Free)</span>
                           @else
                              @if($course->is_discount)
                                    <span
                                       class="course-cost align-self-center">{{formatPrice($course->discount_price)}}</span>
                                    <span class="course-cost align-self-center">{{formatPrice($course->price)}}</span>
                              @else
                                    <span
                                       class="course-cost align-self-center">{{formatPrice($course->price)}}</span>
                              @endif
                           @endif
                           <div class="media-body">
                              <div class="course-exclusive-content align-self-center">
                                 (Excl all taxes)
                              </div>
                           </div>
                        </div>
                     </div>
                     @endif
                  @endauth
                  @auth
                     @if(Auth::user()->user_type == 'Student')
                        @if($course->price)
                           <!--form action="#" class="enroll-form" method="post" accept-charset="utf-8" novalidate="novalidate">
                              <button name="enroll" type="submit" class="course-enroll enroll loader " data-loader-text="ENROLLING..." disabled>ENROL NOW</button>
                           </form--->
                           @if(checkProjectWorkEnrolled($course->id,\Illuminate\Support\Facades\Auth::user()->id))
                              <a class="course-enroll enroll loader " href="{{ route('project_work_lesson_details',$course->slug) }}" >Go For Project Work</a>
                           @else
                              {{-- PAYUMONEY PAYMENT GATEWAY --}}
                              <form action="{{route('initiate.payment')}}" method="post">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                 <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
                                 <input type="hidden" id="udf1" name="udf1" value="project_work" />
                                 <input type="hidden" id="udf2" name="udf2" value="{{$course->id}}" />
                                 <input type="hidden" id="hashurl" name="hashurl" value="{{url('resources/views/addon/setup/payumoney/index.php')}}" />
                                 <input type="hidden" id="surl" name="surl" value="{{route('payumoney.payment')}}" />
                                 <input type="hidden" id="key" name="key" value="SWX8LxLC" />{{-- CaertTiG,Uuio8LHKPl --}}
                                 <input type="hidden" id="salt" name="salt" value="cXhuLZsI4t" />
                                 <input type="hidden" id="txnid" name="txnid" value="{{ strtotime('now') }}" />
                                 <input type="hidden" id="amount" name="amount" value="{{ StripePrice($course->price) }}">
                                 <input type="hidden" id="pinfo" name="pinfo" value="cart_payment" />
                                 <input type="hidden" id="fname" name="fname" value="{{ Auth::user()->name }}" />
                                 <input type="hidden" id="email" name="email" value="{{ Auth::user()->alternate_email_user }}" />
                                 <input type="hidden" id="mobile" name="mobile" value="{{ Auth::user()->email }}" />
                                 <input type="hidden" id="hash" name="hash" value="" />
                                 
                                 <button name="enroll" type="submit" class="course-enroll enroll loader " data-loader-text="ENROLLING...">ENROLL NOW</button>
                                    <!--input type="submit" class="btn btn-primary" value="Pay" /-->
                                 
                              </form>
                              {{-- END PAYUMONEY PAYMENT GATEWAY --}}
                           @endif
                          
                        @else
                           <a class="course-enroll enroll loader " href="#!" >ENROLL NOW</a>
                        @endif
                       
                     @else
                        <a class="course-enroll enroll loader " href="{{route('login')}}" >ENROLL NOW</a>
                     @endif
                  @endauth
                  @guest
                     <a class="course-enroll enroll loader " href="{{route('login')}}" >ENROLL NOW</a>
                  @endguest
                 
               </div>
            </div>
         </div>
      @empty
         <div class="col-12 m-5">
            <img src="{{asset('no_data.png')}}" class="w-100 img-fluid">
         </div>
      @endforelse
      <div class="col-12">
            {{ $courses->links() }}
      </div>
        
      </div>
     </div>
  </section>
@endsection
