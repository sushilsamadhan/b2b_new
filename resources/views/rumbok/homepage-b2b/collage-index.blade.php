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
</style>

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

   <!-- For Collage Start Here -->
@foreach($p_category_collage as $p_category_val)

@if($p_category_val->id == 156)
    <section class="cc-course-individual py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-uppercase mb-3 text-center">
                        {{$p_category_val->name}}
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="owl-carousel owl-theme hp-package-slider owl-loaded owl-drag">
  
                @php  
                $s_category = \App\Category_permission::where('school_id', $school_id)
                                        ->where('type', 's_category')->where('main_category', 'collage')                
                                        ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
                                        ->select('cate.id','cate.name','cate.slug','cate.banner')
                                        ->where('cate.parent_category_id','=','156')
                                        ->get();
                @endphp  
                @foreach ($s_category as $s_category_val) 
                    <div class="item">
                        <div class="individual-career-course">
                            <div class="icc-inner-1">
                                <div class="icc-inner-2">
                                    <img src="{{url('/')}}{{$s_category_val->banner}}" class="icc-img">
                                </div>
                                <div class="icc-details">
                                    <h3>{{$s_category_val->name}}</h3>
                                    <a href="{{url('/elite-courses')}}-{{$s_category_val->slug}}">
                                        View Details <i class="fa fa-arrow-right"></i>
                                    </a>
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
        </div>
    </section>
@endif 
@endforeach
@foreach($p_category_collage as $p_category_val)
@if($p_category_val->id != 156)

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-uppercase text-center mb-3">
                        {{$p_category_val->name}}
                    </h3>
                </div>
            </div>
            <div class="owl-carousel owl-theme hp-package-slider owl-loaded owl-drag">
                @php
                    $courses = \App\Model\Course::where('category_id',$p_category_val->id)->with('classes')->take(6)->get();
                @endphp
                @foreach($courses as $courses_val)
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">

                            @if($courses_val->lms_refference_id == 0 && $courses_val->ole_refference_id > 0)
                                <img class="lazy" src="https://olexpert.org.in/public/{{$courses_val->image}}"
                                    alt="https://olexpert.org.in/public/uploads/{{$courses_val->image}}">
                            @endif
                            @if($courses_val->lms_refference_id > 0 && $courses_val->ole_refference_id > 0)
                                <img class="lazy" src="https://courses.iid.org.in/public/{{$courses_val->image}}"
                                    alt="https://courses.iid.org.in/public/uploads/{{$courses_val->image}}">
                            @endif
                            @if($courses_val->ole_refference_id == 0 && $courses_val->lms_refference_id == 0)
                                <img class="lazy" src="{{url('public')}}/{{$courses_val->image}}"
                                    alt="{{url('public')}}/{{$courses_val->image}}">
                            @endif
                            
                            <span class="position-absolute classs-block small"></span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                            
                                            <?php
                                                $itemLectureCount = 0;
                                                foreach($courses_val->classes as $course_classes){
                                                    foreach($course_classes->contents as $class_content){
                                                        $itemLectureCount++;
                                                    }
                                                }
                                            ?>
                                                {{$itemLectureCount}} 
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>

                                        </div>
                                    </div>
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                @php
                                                    $total_duration = 0;
                                                    foreach ($courses_val->classes as $item){
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
                        <h3 class="page-title">{{ Str::limit($courses_val->title,50) }}</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="{{route('course.single',$courses_val->slug)}}"
                                    class="bisylms-btn-2 d-block">View Details</a>
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

@endif
@if($p_category_val->id == 156)
@foreach ($s_category as $s_category_val) 
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-uppercase text-center mb-3">
                        {{$s_category_val->name}}
                    </h3>
                </div>
            </div>
            <div class="owl-carousel owl-theme hp-package-slider owl-loaded owl-drag">
                @php
                    $courses = \App\Model\Course::where('category_id',$s_category_val->id)->with('classes')->take(6)->get();
                @endphp
                @foreach($courses as $courses_val)
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">

                            @if($courses_val->lms_refference_id == 0 && $courses_val->ole_refference_id > 0)
                                <img class="lazy" src="https://olexpert.org.in/public/{{$courses_val->image}}"
                                    alt="https://olexpert.org.in/public/uploads/{{$courses_val->image}}">
                            @endif
                            @if($courses_val->lms_refference_id > 0 && $courses_val->ole_refference_id > 0)
                                <img class="lazy" src="https://courses.iid.org.in/public/{{$courses_val->image}}"
                                    alt="https://courses.iid.org.in/public/uploads/{{$courses_val->image}}">
                            @endif
                            @if($courses_val->ole_refference_id == 0 && $courses_val->lms_refference_id == 0)
                                <img class="lazy" src="{{url('public')}}/{{$courses_val->image}}"
                                    alt="{{url('public')}}/{{$courses_val->image}}">
                            @endif
                            
                            <span class="position-absolute classs-block small"></span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                        <span class="l-c-count">
                                            
                                            <?php
                                                $itemLectureCount = 0;
                                                foreach($courses_val->classes as $course_classes){
                                                    foreach($course_classes->contents as $class_content){
                                                        $itemLectureCount++;
                                                    }
                                                }
                                            ?>
                                                {{$itemLectureCount}} 
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>

                                        </div>
                                    </div>
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                        <span class="l-c-count">
                                                @php
                                                    $total_duration = 0;
                                                    foreach ($courses_val->classes as $item){
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
                        <h3 class="page-title">{{ Str::limit($courses_val->title,50) }}</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="{{route('course.single',$courses_val->slug)}}"
                                    class="bisylms-btn-2 d-block">View Details</a>
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
@endforeach
@endif
@endforeach


    @if($permission['Documentry'])
        <section class="feature-section">
            <div class="container">
                <div class="row">
                    
                <div class="col-md-12">
                    <h3 class="text-uppercase text-center mb-3">
                        Documenteries
                    </h3>
                </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <a href="{{route('industrial-documentry')}}">
                            <img class="img-fluid" src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/industrial-documentary.jpg" alt="Entrepreneur Development Course">
                        </a>                   
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if($permission['Project-Report'])
        <section class="feature-section">
            <div class="container">
                <div class="row">   

                <div class="col-md-12">
                    <h3 class="text-uppercase text-center mb-3">
                        Project Report
                    </h3>
                </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <a href="{{route('project.report')}}">
                            <img class="img-fluid" src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/project-report-banner.jpg" alt="Entrepreneur Development Course">
                        </a>                   
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if($permission['EDP-courses'])
        <section class="feature-section">
            <div class="container">
                <div class="row">
                    
                <div class="col-md-12">
                    <h3 class="text-uppercase text-center mb-3">
                        EDP Courses
                    </h3>
                </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <a href="{{route('edp-courses')}}">
                            <img class="img-fluid" src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/edp-courses-banner.jpg" alt="Entrepreneur Development Course">
                        </a>                   
                    </div>
                </div>
            </div>
        </section>
    @endif


    <section class="light-pink-bg py-5">
        <div class="container container1">
            <div class="row align-items-center">
                <div class="col-lg-6 content-side">
                    <h5 class="h5-content1">ENHANCE YOUR SKILL AND GET</h5>
                    <h2 class="h2-content2">CERTIFICATE</h2>
                    <h5 class="h5-content2 color-main-1"></h5>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="circle circle1">
                            <div class="imgBx">
                                <img src="/public/new-b2b/images/banner-bg/Layer 1.png" class="img-fluid">
                            </div>
                        </div>
                        <div class="contentBx">
                            <h2>SAMPLE CERTIFICATE</h2>
                            <a href="#">VIEW NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="circle circle1">
                            <div class="imgBx">
                                <img src="/public/new-b2b/images/banner-bg/assessment11.png" class="img-fluid">
                            </div>
                        </div>
                        <div class="contentBx">
                            <h2>DEMO ASSESSMENT</h2>
                            <a href="#">VIEW NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End For Collage Start Here -->

@if(
    $permission['school']==1 || 
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

            @if($permission['school'])
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
            @endif

            {{-- @if($permission['collage'])
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
            @endif --}}

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
            @if($permission['school'])
                    <div class="item col-md-3">
                        <div class="individual-career-course">
                            <div class="icc-inner-1">
                                <div class="icc-inner-2">
                                    <img src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/upssc11.png" class="icc-img">
                                </div>
                                <div class="icc-details">
                                    <h3>School</h3>
                                    <a href="{{route('school')}}">
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
                                <img src="/public/new-b2b/images/OLE-Logo.png">
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