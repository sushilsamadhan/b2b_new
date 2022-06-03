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

@if(
    $permission['collage']==1 || 
    $permission['school']==1 ||
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

            {{-- @if($permission['competitive'])
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
            @endif --}}

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
            @if($permission['school'])
                    <div class="item col-md-3">
                        <div class="individual-career-course">
                            <div class="icc-inner-1">
                                <div class="icc-inner-2">
                                    <img src="https://entrepreneurindia.tv/public/new-b2b/images/banner-bg/upssc11.png" class="icc-img">
                                </div>
                                <div class="icc-details">
                                    <h3>Competitive</h3>
                                    <a href="{{route('school')}}">
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