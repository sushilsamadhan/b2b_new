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

    <!-- For School Start Here -->
    <section class="fp-banner">
        <div class="banner-img-part">
           <img src="{{url('/')}}/public/new-b2b/images/banner-bg/flp-banner.jpg" class="img-fluid">           
        </div>
    </section>
    <section class="flp-category">
        <div class="container">
            <div class="row my-3">
                <div class="col-md-3">
                    <a href="{{url('/')}}/folklore-course/dharmik-evam-etihasik-sthal">
                        <div class="flp-cat-block">
                            <div class="flp-cat-block-outer">
                                <div class="flp-cat-block-inner">
                                    <div class="flp-cat-img">
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-1.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-2.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-3.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-4.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-5.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-6.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-7.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-8.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-9.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-10.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-11.jpg"/>
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
                                        <img src="{{url('/')}}/public/new-b2b/images/banner-bg/cat-12.jpg"/>
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
    <!-- End For School Start Here -->

@if(
    $permission['collage']==1 || 
    $permission['competitive']==1 ||
    $permission['entrepreneur']==1 ||
    $permission['school']==1
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

            {{-- @if($permission['folk-programme'])
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
            @endif --}}

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
    </div>
</section> --}}
@endif


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