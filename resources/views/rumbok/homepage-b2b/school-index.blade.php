@extends('rumbok.app')
 @section('content')

<!--======================================
        END HEADER AREA
======================================-->
<style>
    .section-title h2 span {
        color: #f4791e;
    }

    @media (max-width:767px) {
        .navbar-brand {
            display: block;
        }

        .navbar.navbar-expand-lg .navbar-toggler {
            display: block;
        }
    }
    select.rounded-select {
    border-radius: 50px;
    padding: 5px 20px;
    width:100%;
    max-width:200px;
}
/* .hover-card-1-icon-large {
    width: 150px !important;
    height: 150px !important;
} */
.main-highlight-box {
    padding: 40px 0;
}

.hover-card-1 {
    background: #fff;
    border-radius: 10px;
    text-align: center;
    position: relative;
    padding: 5px 5px;
    height: 100%;
}

.animation-effect:after {
    content: '';
    position: absolute;
    width: 100%;
    height: 0;
    bottom: 0;
    left: 0;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.animation-effect:hover:after {
    width: 100%;
    height: 100%;
    bottom: 0;
    left: 0;
}

.hover-card-1 .hover-card-1-icon-large {
    width: 100%;
    height: auto;
    line-height: 40px;
    border-radius: 10px;
    margin: 0 auto;
    margin-bottom: 10px;
    overflow: hidden;
    position: relative;
    z-index: 2;
    margin-top: -50px;
}

.hover-card-1 .hover-card-1-icon-large img {
    width: 100%;
}

.hc-1-desc {
    position: relative;
    z-index: 1;
}

.heading-hc-1 {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 15px;
}

.animation-effect .heading-hc-1 {
    color: #fff;
}

.text-hc-1 {
    font-size: 14px;
    line-height: 20px;
}

.animation-effect .text-hc-1 {
    color: #fff;
}

.animation-effect .hover-card-1-icon-large {
    border: 1px solid #fff;
}

.arrow-hc-1 {
    color: #000;
}

.animation-effect .arrow-hc-1 {
    color: #fff;
}

.effect-1 {
    border: 1px solid #fe494e;
    box-shadow: 4px 3px 15px 11px rgb(254 73 78 / 12%);
    border-bottom-width: 4px;
    background-color: #fe494e;
}

.effect-1 .hover-card-1-icon-large {
    background: none;
    border: none;
}

.animation-effect.effect-1:after {
    background-color: rgba(0, 0, 0, .11);
}

.hover-card-1 .hover-card-1-icon-large {
    width: 100%;
    height: auto;
    line-height: 40px;
    border-radius: 10px;
    margin: 0 auto;
    margin-bottom: 10px;
    overflow: hidden;
    position: relative;
    z-index: 2;
    margin-top: -50px;
}

.hover-card-1 .hover-card-1-icon-large img {
    width: 100%;
}

.effect-2 {
    border: 1px solid #fb6823;
    box-shadow: 4px 3px 15px 11px rgb(251 104 35 / 12%);
    border-bottom-width: 4px;
    background-color: #fb6823;
}

.effect-2 .hover-card-1-icon-large {
    background: none;
    border: none;
}

.animation-effect.effect-2:after {
    background-color: rgba(0, 0, 0, .11);
}

.effect-3 {
    border: 1px solid #253a73;
    box-shadow: 4px 3px 15px 11px rgb(37 58 115 / 12%);
    border-bottom-width: 4px;
    background-color: #253a73;
}

.effect-3 .hover-card-1-icon-large {
    background: none;
    border: none;
}

.animation-effect.effect-3:after {
    background-color: rgba(0, 0, 0, .11);
}

.effect-4 {
    border: 1px solid #00e5b7;
    box-shadow: 4px 3px 15px 11px rgb(0 229 183 / 12%);
    border-bottom-width: 4px;
    background-color: #00e5b7;
}

.effect-4 .hover-card-1-icon-large {
    background: none;
    border: none;
}

.animation-effect.effect-4:after {
    background-color: rgba(0, 0, 0, .11);
}

.effect-5 {
    border: 1px solid #e86a2f;
    box-shadow: 4px 3px 15px 11px rgb(232 106 47 / 12%);
    border-bottom-width: 4px;
    background-color: #e86a2f;
}

.effect-5 .hover-card-1-icon-large {
    background: none;
    border: none;
}

.animation-effect.effect-5:after {
    background-color: rgba(0, 0, 0, .11);
}

.pbllive {
    background-color: #e1f6ff;
    position: relative;
    padding: 30px 0;
}

.pbllive .pbltext .first-text {
    color: #e86a2f;
    font-size: 34px;
    font-weight: bold;
    line-height: 1;
    margin-bottom: 20px;
}

.pbllive .pbltext .second-text {
    color: #000;
    font-size: 24px;
    font-weight: 600;
    line-height: 1;
    margin-bottom: 20px;
}

.pbllive .pbltext .third-text {
    color: #253a73;
    font-size: 24px;
    font-weight: 600;
    line-height: 1;
    margin-bottom: 20px;
}

.color-main-1 {
    color: #e86a2f;
}

.color-main-2 {
    color: #253a73;
}

.color-main-3 {
    color: #e31e24;
}

.pbllive .pbltext .fourth-text {
    color: #253a73;
    font-size: 24px;
    font-weight: 600;
    line-height: 1;
    margin-bottom: 20px;
}

.text-pbl-block {
    font-size: 12px;
    background-color: #57e7a499;
    padding: 3px 0px;
}

a {
    text-decoration: none;
}

@media (max-width:420px) {
    .text-pbl-block {
        font-size: 10px;
    }
}
</style>
{{-- <link async rel="stylesheet" href="https://olexpert.org.in/public/asset_rumbok/new/css/theme.css?ver=2.005"/> --}}

<!--================================
     START SLIDER AREA
=================================-->
    <!-- For Common To all Hero Banner Start -->
    @if(isset($rumbokSliders))
    <section class="hero-banner-2 pb-2">
        <div class="home-slides owl-carousel">
            @foreach($rumbokSliders as $rumbokSlider)
            <div class="home-slides-item">
                <a href="{{ route('login')}}"><img  class="lazy" src="{{ asset('storage/'.$rumbokSlider->image)}}" title="{{ $rumbokSlider->name }}"  alt="{{ $rumbokSlider->name }}" /></a>
            </div>
            @endforeach
        </div>
    </section>
    @endif
    <!-- End For Common To all Hero Banner Start -->

    <!-- For School Start Here -->
<section class="board-n-class-selection py-5">
    <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="text-uppercase mb-2">
                        Select your Class 
                        
                    </h2>
                    <div class="row mb-4">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="forn-group">
                                    <select onchange="BoardChangeId(this.value);" class="rounded-select">
                                    @forelse ($p_category_school as $p_category_val)
                                        {{--@if($p_category_val->name!='')--}}
                                            <option value="{{$p_category_val->id}}">{{$p_category_val->name}}</option>
                                        {{--@endif--}}
                                    @empty

                                    @endforelse
                                    </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
            @php $x=1; @endphp
            @forelse ($p_category_school as $p_category_val)
        <div class="row justify-content-center boardClasseshideshow" id="boardClasses-{{$p_category_val->id}}"  @if($x!=1) style="display:none;"  @endif >
                @php  
                $s_category = \App\Category_permission::where('school_id', $school_id)
                                        ->where('type', 's_category')->where('main_category', 'school')              
                                        ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
                                        ->select('cate.id','cate.name','cate.slug')
                                        ->where('cate.parent_category_id','=',$p_category_val->id)
                                        ->get();
                @endphp

                @forelse ($s_category as $s_category_val)        
                <div class="col-md-3 col-6" onclick="location.href='{{url('/')}}/board-{{$p_category_val->slug}}-{{$s_category_val->slug}}';">
                    <div class="select-class-block">
                        <label for="class12">
                            <div class="card-class-block">
                                <div class="card-class-name">
                                    Class
                                </div>
                                <div class="card-class-no pb-0">
                                {{str_replace("Class ","",$s_category_val->name)}}
                                </div>
                                <p class="text-center">{{$p_category_val->name}}</p>
                            </div>
                        </label>
                    </div>
                </div>
                @empty

                @endforelse
                @php $x++; @endphp
        </div>
                @empty

                @endforelse
    </div>
</section>

@if($permission['STUDY_MATERIAL'] && count($courses) >0)
          <!-- Pricing Start -->
        <section class="pricing-section">
            <div class="container">
				<div class="heading-section">
					<div class="row">
						<div class="col-md-12 text-center">
							<h2 class="sec-title mb-3">Study For Free</h2>
						</div>
					</div>
				</div>
				<div class="owl-carousel owl-theme hp-package-slider">
                    @foreach($courses as $course)
					<div class="item">
                        <div class="pricing-item w-100">
                            
                            <div class="thumbnail-image">
                                
                            @if($course->lms_refference_id == 0 && $course->ole_refference_id > 0)
                                <img class="lazy" src="https://olexpert.org.in/public/{{$course->image}}"
                                    alt="https://olexpert.org.in/public/uploads/{{$course->image}}">
                            @endif
                            @if($course->lms_refference_id > 0 && $course->ole_refference_id > 0)
                                <img class="lazy" src="https://courses.iid.org.in/public/{{$course->image}}"
                                    alt="https://courses.iid.org.in/public/uploads/{{$course->image}}">
                            @endif
                            @if($course->ole_refference_id == 0 && $course->lms_refference_id == 0)
                                <img class="lazy" src="{{url('public')}}/{{$course->image}}"
                                    alt="{{url('public')}}/{{$course->image}}">
                            @endif

                                <!-- <img  class="lazy" src="{{ filePath($course->image) }}" alt="{{ filePath($course->image) }}"/> -->

                                <span class="position-absolute classs-block small">{{$course->category->name}}</span>		
                                <div class="hover-details">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                    
                                        <span class="l-c-count">
                                        <i class="fa fa-play-circle-o"></i>
                                            <?php
                                                $itemLectureCount = 0;
                                                foreach($course->classes as $course_classes){
                                                    foreach($course_classes->contents as $class_content){
                                                        $itemLectureCount++;
                                                    }
                                                }
                                            ?>
                                                {{$itemLectureCount}} 
                                            </span>
                                        
                                            
                                            
                                            <span class="l-c-text">
                                                    @translate(Lectures)
                                            </span>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                        <span class="l-c-count">
                                                @php
                                                    $total_duration = 0;
                                                    foreach ($course->classes as $item){
                                                        $total_duration +=$item->contents->sum('duration');
                                                    }
                                                @endphp
                                                <i class="fa fa-clock-o"></i>
                                                {{duration($total_duration)}}
                                            </span>
                                            <span class="l-c-text">
                                               Duration
                                            </span>
                                        </div>
                                    </div>
                                    </div>									
                                </div>
                            </div>	
                            <h3 class="page-title">{{ Str::limit($course->title,50) }}</h3>
                            
                            <div class="available-in">
                            </div>
                            
                             <div class="align-items-center justify-content-between border-top pt-2">
                                <div class="d-block">
                                    <a href="{{route('course.single',$course->slug)}}" class="bisylms-btn-2 d-block">View Details</a>
                                </div>
                            </div> 
                           
                        </div>
					</div>
                    @endforeach
					
					
					<div class="item">
						<div class="pricing-item w-100 min-height bg-light d-flex align-items-center text-center">					
							<div class="clearfix w-100">
                         		<a href="#" class="bisylms-btn-5">View All</a>
							</div>						  
                        </div>
					</div>		
				</div>
            </div>
        </section>
        <!-- Pricing End -->
@endif
@if($permission['project-work'])
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row no-gutter align-items-center">
                <div class="col-lg-6 col-md-6 d-none d-md-block d-lg-block">
                    <img src="{{url('/')}}/public/new-b2b/images/banner-bg/pbl-banner-img.png" class="img-fluid">
                </div>
                <div class="col-lg-6 col-md-6">
                <div class="clearfix p-4 are-you-tutor">
                        <h3 class="text-uppercase">Project Based Learning</h3>
                        <h4 class="font-weight-normal mb-3">Creating a modern education of<br>
                            Curiosty, Innovation, and Impact</h4>
                            <p class="my-5 text-right">
                                <a href="https://olexpert.org.in/become-tutor"  class="button-light-pink m-0 bg-white" role="button">Start Now</a>
                            </p>
                </div>
                </div>
            </div>
        </div>
    </section>
@endif
    <section class="py-5 light-pink-bg">
        <div class="container">
            <div class="row no-gutter align-items-center">

                <div class="col-lg-6 col-md-6">
                    <div class="clearfix p-4 are-you-tutor">
                        <h3 class="text-uppercase">Practice Test Made Perfect</h3>
                        <h4 class="font-weight-normal mb-3">Analyze your learning at our Practice Test
                            Platform on different levels</h4>

                        <ul class="mock-test-checklist">
                            <li class="mb-2">Subjective Test</li>
                            <li class="mb-2">Unit Test</li>
                            <li class="mb-2">Chapter Test</li>
                        </ul>

                        <p class="my-3">
                            <a href="http://3.108.39.127/v2/login" class="button-light-pink m-0 bg-white"
                                role="button">Join Us Now</a>
                        </p>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 d-none d-md-block d-lg-block">
                    <img src="http://3.108.39.127/v2/public/asset_rumbok/new/images/banner-bg/responsive-web.png"
                        class="img-fluid">
                </div>

            </div>

        </div>

    </section>
    <!-- End For School Start Here -->

@if(
    $permission['collage']==1 || 
    $permission['competitive']==1 ||
    $permission['entrepreneur']==1 ||
    $permission['folk-programme']==1
)

<section class="main-highlight-box">
    <div class="container">
        <div class="row my-3 justify-content-center">
            <div class="col-md-12 text-center">
				<h2 class="sec-title mb-3">Switch To Other Feature</h2>
			</div>

            {{-- @if($permission['school'])
            <div class="col col-md col-6 sm-mb-5">
                <a href="{{route('school')}}">
                    <div class="hover-card-1 animation-effect effect-1">
                        <div class="hc-1-desc">
                        <div class="hover-card-1-icon-large">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/school-girl.png">
                        </div>
                        <div class="heading-hc-1">
                            School
                        </div>     
                        <div class="text-hc-1">
                            CBSE . ICSE<br>STATE BOARDS<br><span class="font-weight-bold">with</span><br>PRACTICE TEST
                        </div>
                        <div class="arrow-hc-1">
                            <i class="fas fa-arrow-right"></i>
                        </div>         
                        </div>
                    </div>
                </a>
            </div>
            @endif --}}

            @if($permission['collage'])
            <div class="col col-md col-6 sm-mb-5">
                <a href="{{route('collage')}}">
                    <div class="hover-card-1 animation-effect effect-2">
                        <div class="hc-1-desc">
                        <div class="hover-card-1-icon-large">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/college-student-1.png">
                        </div>
                        <div class="heading-hc-1">
                            College
                        </div>     
                        <div class="text-hc-1">
                            PROFESSIONAL . TECHNICAL<br>LANGUAGE COURSES<br><span class="font-weight-bold">with</span><br>ASSESSMENT
                        </div>
                        <div class="arrow-hc-1">
                            <i class="fas fa-arrow-right"></i>
                        </div>         
                        </div>
                    </div>
                </a>
            </div>
            @endif

            @if($permission['competitive'])
            <div class="col col-md col-6 sm-mb-5">
                <a href="{{route('competitive')}}">
                    <div class="hover-card-1 animation-effect effect-3">
                        <div class="hc-1-desc">
                        <div class="hover-card-1-icon-large">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/engineering-man.png">
                        </div>
                        <div class="heading-hc-1">
                            Competitive Courses
                        </div>     
                        <div class="text-hc-1">
                            BANKING . MEDICAL . LAW<br>&amp; many more COURSES<br><span class="font-weight-bold">with</span><br>MOCK TEST
                        </div>
                        <div class="arrow-hc-1">
                            <i class="fas fa-arrow-right"></i>
                        </div>         
                        </div>
                    </div>
                </a>
            </div>
            @endif

            @if($permission['entrepreneur'])
            <div class="col col-md col-6 sm-mb-5">
                <a href="{{route('entrepreneur')}}">
                    <div class="hover-card-1 animation-effect effect-4">
                        <div class="hc-1-desc">
                        <div class="hover-card-1-icon-large">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/industrial-man.png">
                        </div>
                        <div class="heading-hc-1">
                            Industrial Courses
                        </div>     
                        <div class="text-hc-1">
                            FOOD PROCESSING<br>CROP CULTIVATION<br>&amp; more courses<br><span class="font-weight-bold">with</span><br>CERTIFICATE

                        </div>
                        <div class="arrow-hc-1">
                            <i class="fas fa-arrow-right"></i>
                        </div>         
                        </div>
                    </div>
                </a>
            </div>
            @endif

            @if($permission['folk-programme'])
            <div class="col col-md sm-mb-5 col-6">
                <a href="{{route('folk-programme')}}">
                    <div class="hover-card-1 animation-effect effect-5">
                        <div class="hc-1-desc">
                        <div class="hover-card-1-icon-large">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/temple-hindu.png">
                        </div>
                        <div class="heading-hc-1">
                            Folklore Programs
                        </div>     
                        <div class="text-hc-1">
							<span class="font-weight-bold">Know</span> <br>
                            <span class="font-weight-bold">India's</span><br>CULTURAL &amp; TRADITIONAL<br>RICHNESS<br>
                        </div>
                        <div class="arrow-hc-1">
                            <i class="fas fa-arrow-right"></i>
                        </div>         
                        </div>
                    </div>
                </a>
            </div>
            @endif

        </div>
    </div>
</section>






{{-- <section class="cc-course-individual py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
				<h2 class="sec-title mb-3">Switch To Other Feature</h2>
			</div>
            @if($permission['collage'])
                    <div class="item col-md-3">
                        <div class="individual-career-course">
                            <div class="icc-inner-1">
                                <div class="icc-inner-2">
                                    <img src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/upssc11.png" class="icc-img">
                                </div>
                                <div class="icc-details">
                                    <h3>Collage</h3>
                                    <a href="{{route('collage')}}">
                                        View Details <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
            @if($permission['competitive'])
                    <div class="item col-md-3">
                        <div class="individual-career-course">
                            <div class="icc-inner-1">
                                <div class="icc-inner-2">
                                    <img src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/upssc11.png" class="icc-img">
                                </div>
                                <div class="icc-details">
                                    <h3>Competitive</h3>
                                    <a href="{{route('competitive')}}">
                                        View Details <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
            @if($permission['entrepreneur'])
                    <div class="item col-md-3">
                        <div class="individual-career-course">
                            <div class="icc-inner-1">
                                <div class="icc-inner-2">
                                    <img src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/upssc11.png" class="icc-img">
                                </div>
                                <div class="icc-details">
                                    <h3>Entrepreneur</h3>
                                    <a href="{{route('entrepreneur')}}">
                                        View Details <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
            @if($permission['folk-programme'])
                    <div class="item col-md-3">
                        <div class="individual-career-course">
                            <div class="icc-inner-1">
                                <div class="icc-inner-2">
                                    <img src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/upssc11.png" class="icc-img">
                                </div>
                                <div class="icc-details">
                                    <h3>Folk Programme</h3>
                                    <a href="{{route('folk-programme')}}">
                                        View Details <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
    </div>
</section> --}}
@endif




    <!-- For Common All Models -->
    @if(isset($testimonials))
    <section class="individual-student-testimonial py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-uppercase mb-5">WHAT STUDENTS SAYS?</h3>
                </div>
                <div class="col-md-12">
                    <div class="testi-student-block">
                        <div class="testi-student-header">
                            <span class="blue-circle"></span>
                            <span class="blue-circle"></span>
                            <span class="blue-circle"></span>
                        </div>
                        <div class="d-flex align-items-center p-2">
                            <div class="small-logo-ole">
                                <img src="{{url('/')}}/public/new-b2b/images/OLE-Logo.png">
                            </div>
                            <div class="ml-auto dummy-bar">
                                <i class="fas fa-bars"></i>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme job-slides">
                        @foreach($testimonials as $testimonial)
                            <div class="item">
                                <div class="testi-student">
                                    <div class="student-remark">
                                        <p>“{!! $testimonial->description !!}”</p>
                                        <h5 class="mb-0 text-right">{{ $testimonial->type }}<br><span
                                                class="font-weight-normal small">{{ $testimonial->name }}</span></h5>
                                    </div>
                                    <div class="student-image">
                                        <div class="student-image-box">
                                        @if($testimonial->image)
										    <img class="lazy" src="{{ asset('storage/'.$testimonial->image) }}" alt="{{ $testimonial->name }}" />
                                        @else
                                            <img class="lazy" src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="image" />
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- For End Common All Models -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            window.setTimeout('fadeout();', 500);

        });

        function fadeout() {
            $('#loader').delay(1000).fadeOut('slow', function () {
                $('.notLoaded').removeClass('notLoaded');
            });
        }
        function openTopmenu() {
            document.getElementById("maniNav").style.width = "100%";
        }

        function closeTopmenu() {
            document.getElementById("maniNav").style.width = "0%";
        }
        $('#show-more-content').hide();

        $('#show-more').click(function(){
            $('#show-more-content').show(300);
            $('#show-less').show();
            $('#show-more').hide();
        });

        $('#show-less').click(function(){
            $('#show-more-content').hide(150);
            $('#show-more').show();
            $(this).hide();
        });

function BoardChangeId(boardId){
    $('.boardClasseshideshow').hide();
    $('#boardClasses-'+boardId).show();
}

    </script>
    @endsection