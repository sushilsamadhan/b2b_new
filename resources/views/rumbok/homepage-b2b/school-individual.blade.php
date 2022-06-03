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
@php $work='School'; @endphp
    <!-- For Common To all Hero Banner Start -->
    <section class="hero-banner-2 pb-2">
        <div class="home-slides owl-carousel">
            @foreach($rumbokSliders as $rumbokSlider)
            <div class="home-slides-item">
                <a href="{{ route('login')}}"><img  class="lazy" src="{{ asset('storage/'.$rumbokSlider->image)}}" title="{{ $rumbokSlider->name }}"  alt="{{ $rumbokSlider->name }}" /></a>
            </div>
            @endforeach
        </div>
    </section>

    <!-- End For Common To all Hero Banner Start -->


    <!-- **************************************
    ************************************** -->
    <!-- For Single Front Start -->
@if($permission['school']==1 && $permission['only_school']==1)
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
                                        @if($p_category_val->name!='')
                                            <option value="{{$p_category_val->id}}">{{$p_category_val->name}}</option>
                                        @endif
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
                <div class="col-md-3 col-6" onclick="location.href='/board-{{$p_category_val->slug}}-{{$s_category_val->slug}}';">
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
@php
if(\App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'p_category')->where('category_id', 'STUDY-MATERIAL')->where('main_category', 'school')->exists()){
@endphp
@if(count($courses) >0)
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
                                <img  class="lazy" src="{{ filePath($course->image) }}" alt="{{ filePath($course->image) }}"/>
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
@php } @endphp
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row no-gutter align-items-center">
                <div class="col-lg-6 col-md-6 d-none d-md-block d-lg-block">
                    <img src="/public/new-b2b/images/banner-bg/pbl-banner-img.png" class="img-fluid">
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
@endif
@if($permission['collage']==1 && $permission['only_collage']==1)
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
                                    <img src="{{$s_category_val->banner}}" class="icc-img">
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
                                <a href="https://olexpert.org.in/board/cbse" class="bisylms-btn-5">View All</a>
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
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">
                            <img class="lazy" src="https://olexpert.org.in/public//uploads/media_manager/819.jpg"
                                alt="https://olexpert.org.in/public//uploads/media_manager/819.jpg">
                            <span class="position-absolute classs-block small">Class 10</span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-play-circle-o"></i>
                                                1
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>

                                        </div>
                                    </div>
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-clock-o"></i>
                                                00:30:00
                                            </span>
                                            <span class="l-c-text">
                                                Duration
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="page-title">Science</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="https://olexpert.org.in/course/science-study-material-class-10-demo"
                                    class="bisylms-btn-2 d-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">
                            <img class="lazy" src="https://olexpert.org.in/public//uploads/media_manager/818.jpg"
                                alt="https://olexpert.org.in/public//uploads/media_manager/818.jpg">
                            <span class="position-absolute classs-block small">Class 8</span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-play-circle-o"></i>
                                                10
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>
                                        </div>
                                    </div>
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-clock-o"></i>
                                                05:00:05
                                            </span>
                                            <span class="l-c-text">
                                                Duration
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="page-title">Social Science</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="https://olexpert.org.in/course/social-science-study-material-class-8"
                                    class="bisylms-btn-2 d-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">
                            <img class="lazy" src="https://olexpert.org.in/public//uploads/media_manager/818.jpg"
                                alt="https://olexpert.org.in/public//uploads/media_manager/818.jpg">
                            <span class="position-absolute classs-block small">Class 6</span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <span class="l-c-count">
                                                <i class="fa fa-play-circle-o"></i>
                                                28
                                            </span>



                                            <span class="l-c-text">
                                                Lectures
                                            </span>

                                        </div>
                                    </div>

                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-clock-o"></i>
                                                14:00:14
                                            </span>
                                            <span class="l-c-text">
                                                Duration
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="page-title">Social Science</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="https://olexpert.org.in/course/social-science-study-material-class-6"
                                    class="bisylms-btn-2 d-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">
                            <img class="lazy" src="https://olexpert.org.in/public//uploads/media_manager/819.jpg"
                                alt="https://olexpert.org.in/public//uploads/media_manager/819.jpg">
                            <span class="position-absolute classs-block small">Class 10</span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-play-circle-o"></i>
                                                1
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>

                                        </div>
                                    </div>
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-clock-o"></i>
                                                00:30:00
                                            </span>
                                            <span class="l-c-text">
                                                Duration
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="page-title">Science</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="https://olexpert.org.in/course/science-study-material-class-10-demo"
                                    class="bisylms-btn-2 d-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">
                            <img class="lazy" src="https://olexpert.org.in/public//uploads/media_manager/818.jpg"
                                alt="https://olexpert.org.in/public//uploads/media_manager/818.jpg">
                            <span class="position-absolute classs-block small">Class 8</span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-play-circle-o"></i>
                                                10
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>
                                        </div>
                                    </div>
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-clock-o"></i>
                                                05:00:05
                                            </span>
                                            <span class="l-c-text">
                                                Duration
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="page-title">Social Science</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="https://olexpert.org.in/course/social-science-study-material-class-8"
                                    class="bisylms-btn-2 d-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">
                            <img class="lazy" src="https://olexpert.org.in/public//uploads/media_manager/818.jpg"
                                alt="https://olexpert.org.in/public//uploads/media_manager/818.jpg">
                            <span class="position-absolute classs-block small">Class 6</span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <span class="l-c-count">
                                                <i class="fa fa-play-circle-o"></i>
                                                28
                                            </span>



                                            <span class="l-c-text">
                                                Lectures
                                            </span>

                                        </div>
                                    </div>

                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-clock-o"></i>
                                                14:00:14
                                            </span>
                                            <span class="l-c-text">
                                                Duration
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="page-title">Social Science</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="https://olexpert.org.in/course/social-science-study-material-class-6"
                                    class="bisylms-btn-2 d-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
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
@endif
@if($permission['competitive']==1 && $permission['only_competitive']==1)
    <!-- For Comptitive Start Here -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
            @foreach($p_category_competitive as $p_category_val)
                <div class="col-lg-4 col-md-4 col-6">
                    <div class="compt-type-block">
                        <div class="competitive-emax-img-block">
                            <img src="{{$p_category_val->banner}}" alt="{{$p_category_val->name}}">
                        </div>
                        <div class="competitive-btn">
                            <a href="/competitive-curriculum-{{$p_category_val->slug}}" class="comp-btn-link">
                            {{$p_category_val->name}} <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    <section class="competitive-exams-blocks py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-uppercase text-center mb-5">
                        Competitive Exams
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="c-exam-fp-block">
                            <div class="c-exam-fp-block-img">
                                <img src="/public/new-b2b/images/banner-bg/iit-jee-logo.png">
                            </div>
                            <div class="c-exam-fp-block-title">
                                IIT-JEE
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="c-exam-fp-block">
                            <div class="c-exam-fp-block-img">
                                <img src="/public/new-b2b/images/banner-bg/medical-logo.png">
                            </div>
                            <div class="c-exam-fp-block-title">
                                Medical
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="c-exam-fp-block">
                            <div class="c-exam-fp-block-img">
                                <img src="/public/new-b2b/images/banner-bg/foundation-logo.png">
                            </div>
                            <div class="c-exam-fp-block-title">
                                Foundation
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="c-exam-fp-block">
                            <div class="c-exam-fp-block-img">
                                <img src="/public/new-b2b/images/banner-bg/defence-logo.png">
                            </div>
                            <div class="c-exam-fp-block-title">
                                Foundation
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End For Comptitive Start Here -->
@endif

@if($work=='Industrial')
    <!-- For Industrial Start Here -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-uppercase text-center mb-5">
                        FIND BY SECTORS
                    </h3>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">88</div>
                                <div class="sector-name">Agro-Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">02</div>
                                <div class="sector-name">Small Business Models</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">88</div>
                                <div class="sector-name">Agro-Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">02</div>
                                <div class="sector-name">Small Business Models</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div id="show-more" class="col-md-12 text-center"><a href="javascript:void(0)" class="button-light-pink" role="button">Show More</a></div>
            </div>
            <div class="row" id="show-more-content">
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">88</div>
                                <div class="sector-name">Agro-Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">02</div>
                                <div class="sector-name">Small Business Models</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div class="col-md-3 col-6">
                    <a href="#">
                        <div class="individual-sector-block">
                            <div class="d-flex align-items-center">
                                <div class="number-count">08</div>
                                <div class="sector-name">Food Processing</div>
                            </div>
                        </div>
                    </a>            
                </div>
                <div id="show-less" class="col-md-12 text-center"><a href="javascript:void(0)" class="button-light-pink" role="button">Show Less</a></div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-uppercase text-center mb-3">
                        Resent Courses
                    </h3>
                </div>
            </div>
            <div class="owl-carousel owl-theme hp-package-slider owl-loaded owl-drag">
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">
                            <img class="lazy" src="https://olexpert.org.in/public//uploads/media_manager/819.jpg"
                                alt="https://olexpert.org.in/public//uploads/media_manager/819.jpg">
                            <span class="position-absolute classs-block small">Class 10</span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-play-circle-o"></i>
                                                1
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>
                                        </div>
                                    </div>
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-clock-o"></i>
                                                00:30:00
                                            </span>
                                            <span class="l-c-text">
                                                Duration
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="page-title">Science</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="https://olexpert.org.in/course/science-study-material-class-10-demo"
                                    class="bisylms-btn-2 d-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">
                            <img class="lazy" src="https://olexpert.org.in/public//uploads/media_manager/818.jpg"
                                alt="https://olexpert.org.in/public//uploads/media_manager/818.jpg">
                            <span class="position-absolute classs-block small">Class 8</span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-play-circle-o"></i>
                                                10
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>
                                        </div>
                                    </div>
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-clock-o"></i>
                                                05:00:05
                                            </span>
                                            <span class="l-c-text">
                                                Duration
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="page-title">Social Science</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="https://olexpert.org.in/course/social-science-study-material-class-8"
                                    class="bisylms-btn-2 d-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">
                            <img class="lazy" src="https://olexpert.org.in/public//uploads/media_manager/818.jpg"
                                alt="https://olexpert.org.in/public//uploads/media_manager/818.jpg">
                            <span class="position-absolute classs-block small">Class 6</span>
                            <div class="hover-details">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <span class="l-c-count">
                                                <i class="fa fa-play-circle-o"></i>
                                                28
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>
                                        </div>
                                    </div>

                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                                <i class="fa fa-clock-o"></i>
                                                14:00:14
                                            </span>
                                            <span class="l-c-text">
                                                Duration
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="page-title">Social Science</h3>
                        <div class="align-items-center justify-content-between border-top pt-2">
                            <div class="d-block">
                                <a href="https://olexpert.org.in/course/social-science-study-material-class-6"
                                    class="bisylms-btn-2 d-block">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
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
    <section class="light-pink-bg py-5">
        <div class="container container1">
            <div class="row align-items-center">
                <div class="col-lg-6 content-side">
                    <h5 class="h5-content1">ENHANCE YOUR SKILL AND GET</h5>
                    <h2 class="h2-content2">MSME CERTIFICATE</h2>
                    <h5 class="h5-content2 color-main-1">FROM GOVERNMENT OF INDIA</h5>
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
    <!-- End For Industrial Start Here -->
@endif
@if($work=='Folklore')
    <!-- For Folklore Start Here -->
    <section class="fp-banner">
        <div class="banner-img-part">
           <img src="/public/new-b2b/images/banner-bg/flp-banner.jpg" class="img-fluid">           
        </div>
    </section>
    <section class="flp-category">
        <div class="container">
            <div class="row my-3">
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-1.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Dharmik Evam Etihasik Sthal</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-2.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Vrat Evam Tyohar</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-3.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Incredible India</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-4.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Swatantrata Senani</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-5.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Rastra Bhakt Evam Amar Balidani</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-6.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Aadi Rishi</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-7.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Pauraanik Vishav Guru</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-8.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Famous Hindi poets and litterateurs and their poems</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-9.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Vedas - Puranas and Religious Texts</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-10.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Matri Shakti</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-11.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Great and popular ruler</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="/public/new-b2b/images/banner-bg/cat-12.jpg"/>
                                    </div>
                                    <div class="flp-cat-name">
                                        <h4>Prerak Prasang</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End For Folklore Start Here -->
@endif
    <!-- For Single Front End -->
    <!-- **************************************
    ************************************** -->


@if(
    $permission['only_school']==0 && 
    $permission['only_competitive']==0 && 
    $permission['only_collage']==0 &&
    $permission['only_entrepreneur']==0
)

<section class="cc-course-individual py-5">
    <div class="container">
        <div class="row">
        @if($permission['school']==1)
@php
if(\App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'p_category')->whereIn('category_id', ['9', '10', '11'])->where('main_category', 'school')->exists()){
@endphp
            <div class="item col-md-3">
                <div class="individual-career-course">
                    <div class="icc-inner-1">
                        <div class="icc-inner-2">
                            <img src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/upssc11.png" class="icc-img">
                        </div>
                        <div class="icc-details">
                            <h3>Cericulam 12</h3>
                            <a href="#">
                                View Details <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
@php } @endphp 

@php
if(\App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'p_category')->where('category_id', 'project-work')->where('main_category', 'school')->exists()){
@endphp
            <div class="item col-md-3">
                <div class="individual-career-course">
                    <div class="icc-inner-1">
                        <div class="icc-inner-2">
                            <img src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/upssc11.png" class="icc-img">
                        </div>
                        <div class="icc-details">
                            <h3>Project Work</h3>
                            <a href="#">
                                View Details <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
@php } @endphp 

        @endif


        @if($permission['collage']==1)
        @foreach($p_category_collage as $p_category_val)
        @if($p_category_val->id=='156')
        @php  
        $s_category = \App\Category_permission::where('school_id', $school_id)
                                ->where('type', 's_category')->where('main_category', 'collage')                
                                ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
                                ->select('cate.id','cate.name','cate.slug','cate.banner')
                                ->where('cate.parent_category_id','=',$p_category_val->id)
                                ->get();
        @endphp  
            @foreach ($s_category as $s_category_val) 
                <div class="item col-md-3">
                    <div class="individual-career-course">
                        <div class="icc-inner-1">
                            <div class="icc-inner-2">
                                <img src="{{$s_category_val->banner}}" class="icc-img">
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
            @else
            <div class="item col-md-3">
                <div class="individual-career-course">
                    <div class="icc-inner-1">
                        <div class="icc-inner-2">
                            <img src="{{$p_category_val->banner}}" class="icc-img">
                        </div>
                        <div class="icc-details">
                            <h3>{{$p_category_val->name}}</h3>
                            <a href="{{url('/elite-courses')}}-{{$p_category_val->slug}}">
                                View Details <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
        @endif

        @if($permission['competitive']==1)
            <div class="item col-md-3">
                <div class="individual-career-course">
                    <div class="icc-inner-1">
                        <div class="icc-inner-2">
                            <img src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/upssc11.png" class="icc-img">
                        </div>
                        <div class="icc-details">
                            <h3>Competitive</h3>
                            <a href="#">
                                View Details <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @if($permission['entrepreneur']==1)
        @foreach($p_category_entrepreneur as $p_category_val)
            <div class="item col-md-3">
                <div class="individual-career-course">
                    <div class="icc-inner-1">
                        <div class="icc-inner-2">
                            <img src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/upssc11.png" class="icc-img">
                        </div>
                        <div class="icc-details">
                            <h3>{{$p_category_val->name}}</h3>
                            <a href="#">
                                View Details <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
        </div>
    </div>
</section>                                              

@endif









    <!-- For Common All Models -->

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