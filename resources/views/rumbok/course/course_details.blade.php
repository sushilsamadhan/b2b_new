@extends('rumbok.app')

@section('content')

<style>
    .bottom-menu {
        display:none;
    }
</style>
    <!-- Breadcrumb Section Starts -->
    <section class="heading-n-breadcrub-part">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
               <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                        <h1>{{ $s_course->title }}</h1>
                        <span>{{ $cat->name }}</span>
                    </div>
               </div>                   
               </div>
               <div class="col-lg-6">
                  <div class="bread-crumb-part">
                     <ul class="bread-crumb-part-list">
                        <li>
                           <a href="#">@translate(home)</a>
                        </li>
                        <li>
                           <span>{{ $cat->name }}</span>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>
    <!-- Course Details Section Starts -->
    <section class="course-details-section padding-120">
        <div class="container">
            <div class="row">
                

                <div class="col-lg-8">
                    <div class="row">                   
                        
                        <div class="col-md-12">
                            <ul class="list-inline">
                            <li class="list-inline-item">
                                <div class="course-features-custom d-flex">
                                    <div class="feature-custom-number">
                                    <?php
                                        $itemLectureCount = 0;
                                        foreach($s_course->classes as $course_classes){
                                            foreach($course_classes->contents as $class_content){
                                                $itemLectureCount++;
                                            }
                                        }
                                    ?>
                                        {{$itemLectureCount}} 
                                   </div>
                                    <div class="feature-custom-text">Lectures</div>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="course-features-custom d-flex">
                                         @php
                                            $total_duration = 0;
                                            foreach ($s_course->classes as $item){
                                                $total_duration +=$item->contents->sum('duration');
                                            }

                                        @endphp
                                    <div class="feature-custom-number">{{duration($total_duration)}}</div>
                                    <div class="feature-custom-text">Duration</div>
                                </div>
                            </li>
                        </ul>
                        </div>
                    </div>
                   <div class="course-details-tab corses-details-custom">
                    <div class="course-details-tab">
                        <div class="job-tab">
                        <div class="tab">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#overview" role="tab">@translate(overview)</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#curriculum" role="tab">Curriculum</a>                                    
                                </li>
                                <li class="nav-item d-none">
                                <a class="nav-link" data-toggle="tab" href="#instructor" role="tab">@translate(instructor)</a>
                                </li>
                                <li class="nav-item d-none">
                                <a class="nav-link" data-toggle="tab" href="#review" role="tab">@translate(review)</a>
                                </li>
                                
                            </ul>
                        </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane overview-content" id="overview">
                                <?php /*?>    
                                <div class="overview-title margin-top-30">
                                        {!! $s_course->short_description !!}
                                    </div>
                                    <?php */?>

                                
                                    <?php /*?>
                                    <div class="overview-title margin-top-20">
                                        <h4>@translate(requirements)</h4>
                                    </div>
                                    <ul class="require-item">
                                        @foreach(json_decode($s_course->requirement) as $requirement)
                                            <li><i class="fa fa-square"></i><span>{{ $requirement }}</span></li>
                                        @endforeach
                                    </ul> <?php */?>

                                    <h4>@translate(course description)</h4>
                                    <p class="margin-top-20">  {!! $s_course->big_description !!}</p>
                                    @if(count(json_decode($s_course->tag)))
                                    <h4>@translate(Tags)</h4>
                                    <p class="margin-top-20">  {!! implode(",",json_decode($s_course->tag)) !!}</p>
                                    @endif
                            </div>

                            <div class="tab-pane curriculum-content active" id="curriculum">
                                <h4>@translate(course content)</h4>
                                <div class="curriculum-accordion margin-top-30">
                                    <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                        @forelse ($s_course->classes as $item)
                                            <div class="card">
                                                <div class="card-header border" id="heading{{ $item->id }}">
                                                    
                                                    <a href="#" role="button" class="w-100 border-0 bg-light rounded-0 d-flex justify-content-between" data-toggle="collapse"
                                                       data-target="#collapse{{ $item->id }}" aria-expanded="true"
                                                       aria-controls="collapse{{ $item->id }}">{{ $item->title }} <span class="mr-3">{{ $item->contents->count() }} @translate(lectures)</span></a>
                                                </div>
                                                <div id="collapse{{ $item->id }}"
                                                     class="collapse {{ $loop->first ? 'show' : '' }}"
                                                     aria-labelledby="heading{{ $item->id }}"
                                                     data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        @forelse ($item->contents as $content)
                                                            
                                                                @if ($content->is_preview == 1)
                                                                <div class="single-course-video border-bottom mb-2 pb-1 d-flex" {{$content->id}}>
                                                                    <a href="javascript:void(0)"
                                                                       class="button-video v-small"
                                                                       onclick="forModal('{{ route('content.video.preview', $content->id) }}', '{{$content->title}}')">
                                                                        <i class="fa fa-play-circle mr-2"></i>{{ $content->title }}
                                                                    </a>
                                                                    <div class="property-course ml-auto">
                                                                        <span class="badge badge-success">@translate(Preview)</span>
                                                                        <span>{{duration($content->duration)}}</span>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="single-course-video border-bottom mb-2 pb-1 d-flex" {{$content->id}}>
                                                                    <a class="button-video v-small" href="javascript:void(0)">
                                                                        @if($content->content_type == 'Video')
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @elseif($content->content_type == 'Document')
                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                        @else
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @endif
                                                                        {{ $content->title }}
                                                                    </a>
                                                                    <div class="property-course ml-auto">
                                                                        @auth
                                                                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Student")
                                                                            @if(checkIsCourseEnrolled($s_course->id,\Illuminate\Support\Facades\Auth::user()->id))
                                                                            {{-- <span class="badge badge-success" ><a href="javascript:void(0)" class="addToCart-{{$s_course->id}}" onclick="addToCart({{$s_course->id}},'{{route('add.to.cart')}}')">@translate(View)</a></span> --}}
                                                                            @else
                                                                            <span class="locked"><a href="javascript:void(0)">@translate(Locked)</a></span>
                                                                            @endif
                                                                        @endif
                                                                        @endauth
                                                                        @guest
                                                                            <span class="locked"><a href="javascript:void(0)">@translate(Locked)</a></span>
                                                                        @endguest
                                                                        <span>{{duration($content->duration)}}</span>
                                                                    </div>
                                                                </div>
                                                                @endif                                                               
                                                            
                                                        @empty
                                                            @translate(NO content)
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            @translate(No Items)
                                        @endforelse
                                    </div>
                                </div>
                                {{-- <div class="overview-title margin-top-30">
                                    <h4>@translate(requirements)</h4>
                                </div>
                                <ul class="require-item">
                                    @foreach(json_decode($s_course->requirement) as $requirement)
                                        <li><i class="fa fa-square"></i> <span>{{ $requirement }}</span></li>
                                    @endforeach
                                </ul> --}}
                            </div>


                            <div class="tab-pane instructor-content" id="instructor">
                                <div class="row align-items-center">
                                    <div class="col-lg-5">
                                        <div class="instructor-author">
                                            <div class="single-instructor">
                                                
                                                <div class="instructor-image">
                                                    <a href="{{route('single.instructor',$s_course->relationBetweenInstructorUser->slug)}}">
                                                        <img
                                                            src="{{ filePath($s_course->relationBetweenInstructorUser->image) }}"
                                                            alt="image" class="img-fluid">
                                                    </a>
                                                </div>
                                                {{-- <div class="instructor-content">
                                                    <h4>
                                                        <a href="#">{{$s_course->relationBetweenInstructorUser->name}}</a>
                                                    </h4>
                                                </div>--}}
                                                <div class="hover-state">
                                                    <ul>
                                                        @if($s_course->relationBetweenInstructorUser->fb)
                                                            <li>
                                                                <a href="{{ $s_course->relationBetweenInstructorUser->fb }}"><i
                                                                        class="fa fa-facebook"></i></a></li>
                                                        @endif
                                                        @if($s_course->relationBetweenInstructorUser->tw)
                                                            <li>
                                                                <a href="{{ $s_course->relationBetweenInstructorUser->tw }}"><i
                                                                        class="fa fa-twitter"></i></a></li>
                                                        @endif

                                                        @if($s_course->relationBetweenInstructorUser->linked )
                                                            <li>
                                                                <a href="{{ $s_course->relationBetweenInstructorUser->linked }}"><i
                                                                        class="fa fa-linkedin"></i></a></li>
                                                        @endif

                                                        @if($s_course->relationBetweenInstructorUser->skype)
                                                            <li>
                                                                <a href="{{ $s_course->relationBetweenInstructorUser->skype }}"><i
                                                                        class="fa fa-skype"></i></a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="instructor-about">
                                            <h4>
                                                @translate {{$s_course->relationBetweenInstructorUser->name}}</h4>
                                                
                                            <p class="margin-top-20">{{$s_course->relationBetweenInstructorUser->relationBetweenInstructor->about}}</p>
                                            {{--<div class="instructor-button margin-top-30">
                                                <a href="{{route('single.instructor',$s_course->relationBetweenInstructorUser->slug)}}"
                                                   class="template-button">@translate(know more)</a>
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>

                                <div class="instructor-skill-part margin-top-30 d-none">
                                    <div class="bottom-content-title">
                                        <h4>my skills</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="single-skill-item">
                                                <div class="progress-info d-flex justify-content-between">
                                                    <div class="progress-info-left">
                                                        <span>UI & UX design</span>
                                                    </div>
                                                    <div class="progress-info-right">
                                                        <span>80%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                         role="progressbar" style="width: 80%" aria-valuenow="80"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-skill-item">
                                                <div class="progress-info d-flex justify-content-between">
                                                    <div class="progress-info-left">
                                                        <span>wordPress</span>
                                                    </div>
                                                    <div class="progress-info-right">
                                                        <span>90%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                         role="progressbar" style="width: 90%" aria-valuenow="90"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-skill-item">
                                                <div class="progress-info d-flex justify-content-between">
                                                    <div class="progress-info-left">
                                                        <span>technology</span>
                                                    </div>
                                                    <div class="progress-info-right">
                                                        <span>70%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                         role="progressbar" style="width: 70%" aria-valuenow="70"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-skill-item">
                                                <div class="progress-info d-flex justify-content-between">
                                                    <div class="progress-info-left">
                                                        <span>marketing</span>
                                                    </div>
                                                    <div class="progress-info-right">
                                                        <span>60%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                         role="progressbar" style="width: 60%" aria-valuenow="60"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane review-content d-none" id="review">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="rating-left">
                                            <h2>4.5</h2>
                                            <ul class="green-starts">
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star-half-o"></i></a></li>
                                            </ul>
                                            <span>average rating</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="rating-right">
                                            <div class="review-title">
                                                <h4>course reviews</h4>
                                            </div>
                                            <div class="single-review">
                                                <div class="progress-part">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 80%" aria-valuenow="80"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="start-part">
                                                    <ul class="yellow-starts">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="percentage-part">
                                                    <span>80%</span>
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="progress-part">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 50%" aria-valuenow="50"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="start-part">
                                                    <ul class="yellow-starts">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="percentage-part">
                                                    <span>50%</span>
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="progress-part">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 20%" aria-valuenow="20"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="start-part">
                                                    <ul class="yellow-starts">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="percentage-part">
                                                    <span>20%</span>
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="progress-part">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 10%" aria-valuenow="10"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="start-part">
                                                    <ul class="yellow-starts">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="percentage-part">
                                                    <span>10%</span>
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="progress-part">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 10%" aria-valuenow="10"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="start-part">
                                                    <ul class="yellow-starts">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="percentage-part">
                                                    <span>10%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>
                </div>

                <div class="col-lg-4">
                    <div class="course-details-sidebar border mb-3">
                    <div class="package-thumbnail">
                                        <a href="javascript:void(0)" data-toggle="modal" class="button-video position-absolute classs-block text-white"  style="left:25px;" data-url="{{$s_course->overview_url}}" id="checkoutforfree">
                                            Preview Video <i class="fa fa-play"></i>
                                        </a>
                        
                        <img src="{{ filePath($s_course->image) }}" alt="thumbnail" class="img-fluid">
                    </div>
                        <div class="course-details-widget">
                        @if($s_course->content_type!='free-study-material')
                            <div class="course-widget-items">

                                <div class="single-item bg-success text-white p-1 rounded border-0">
                                    <div class="item-left">
                                        <span><i class="fa fa-inr"></i> @translate(price)</span>
                                    </div>
                                    <div class="item-right">
                                        @if($s_course->is_free)
                                            {{-- free price --}}
                                            <span class="price-current">@translate(Free)</span>
                                        @else
                                            @if($s_course->is_discount)
                                                {{-- discounted price --}}
                                                <span
                                                    class="price-current f-24">{{formatPrice($s_course->discount_price)}}</span>
                                            @else
                                                {{-- actual price --}}
                                                <span
                                                    class="price-current f-24">{{formatPrice($s_course->price)}}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                            
                            <div class="course-widget-buttons mt-2">

                                @auth()
                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                        @if($s_course->content_type=='free-study-material')
                                            <a href="#!"
                                            class="template-button  btn btn-block btn-warning text-dark addToCart-{{$s_course->id}}"
                                            onclick="addToCart({{$s_course->id}},'{{route('add.to.cart')}}')">@translate(Checkout For Free)</a>
                                        @else
                                        <a href="#!"
                                            class="template-button  btn btn-block btn-warning text-dark addToCart-{{$s_course->id}}"
                                            onclick="addToCart({{$s_course->id}},'{{route('add.to.cart')}}')">@translate(Add to cart)</a>
                                        @endif
                                    @else
                                        @if($s_course->content_type=='free-study-material')
                                            <a href="{{route('login')}}" class="template-button btn btn-block btn-warning text-dark">@translate(Checkout For Free)</a>
                                        @else
                                            <a href="{{route('login')}}" class="template-button btn btn-block btn-warning text-dark">@translate(Add to cart)</a>
                                        @endif
                                    @endif
                                @endauth
                                @guest
                                    @if($s_course->content_type=='free-study-material')
                                        <a href="{{route('login')}}" class="template-button btn btn-block btn-warning text-dark">@translate(Checkout For Free)</a>
                                    @else
                                        <a href="{{route('login')}}" class="template-button btn btn-block btn-warning text-dark">@translate(Add to cart)</a>
                                    @endif

                                @endguest
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    {{--======================================= Course Preview: START =====================================--}}

 
        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@translate(Course Preview): {{ $s_course->title }}</h5>
                        <button type="button" class="close position-absolute" data-dismiss="modal" style="top: 31px;right: 30px;z-index: 2;background: #000;opacity: 1;text-shadow: none;color: #fff;width: 30px;line-height: 30px;height: 30px;border-radius: 50%;padding: 0;">×</button>
                    </div>
                    <div class="modal-body">
                        @if (isset($s_course->overview_url))
                            @if ($s_course->provider === "Youtube")

                                <iframe  id="showVideo" width="100%" height="600"
                                        src="{{ Str::after($s_course->overview_url,'https://youtu.be/') }}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>

                            @elseif($s_course->provider === "Vimeo")
                                <iframe  id="showVideo"
                                    src="https://player.vimeo.com/video/{{ Str::after($s_course->overview_url,'https://vimeo.com/') }}"
                                    width="100%" height="600" frameborder="0" allow="autoplay; fullscreen"
                                    allowfullscreen></iframe>
                            @else
                                <video controls crossorigin playsinline id="player">
                                    <source src="{{$s_course->overview_url}}"
                                            type="video/mp4" size="100%"/>

                                </video>
                            @endif

                        @endif

                    </div>
                </div>
            </div>
        </div><!-- end modal -->

    
    {{--======================================= Course Preview: END =====================================--}}

@endsection
@section('js')
<style>

</style>
<script>
$(document).ready(function() {
// Gets the video src from the data-src on each button
var videoSrc='';  
$(document).on('click', '[data-url]', function(e){
    videoSrc = $(this).attr('data-url');
    $('#myModal').modal('show');
    //alert(videoSrc)
});
console.log(videoSrc);
// when the modal is opened autoplay it  
$('#myModal').on('shown.bs.modal', function (e) {
// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
$("#showVideo").attr('src',videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
})
// stop playing the youtube video when I close the modal
$('#myModal').on('hide.bs.modal', function (e) {
    // a poor man's stop video
    $("#showVideo").attr('src',videoSrc); 
}) 
// document ready  
});
</script>
@endsection