@extends('rumbok.app')

@section('content')


<style>

    .tab-menu-category button.owl-next {
    position: absolute;
    right: -35px;
    width: 20px;
    height: 20px;
    border-radius: 50% !important;
    background: #000 !important;
    line-height: 20px !important;
    opacity: 1;
    color: #fff !important;
}
.tab-menu-category button.owl-prev.disabled {
    position: absolute;
    left: -35px;
    width: 20px;
    height: 20px;
    border-radius: 50% !important;
    background: #000 !important;
    line-height: 20px !important;
    opacity: 1;
    color: #fff;
}
.tab-menu-category .owl-nav {
    position: absolute;
    top: -2px;
    width: 100%;
}
.tab-menu-category {
    padding: 0;
    position: relative;
}
.tab-menu-category .owl-item span {
    padding: 5px 10px;
    font-size: 13px;
    background: #efefef;
    border-radius: 30px;
}
.demo-video-block {
    border: 1px solid #ddd;
    padding: 5px;
    border-radius: 10px;
    margin-bottom: 15px;
}
.demo-video-thumb {
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    max-height:168px;
}
.hover-demo-video-icon {
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    text-align: center;
    display:table;
    color: #fff !important;
}
.hover-demo-video-icon a {
    color: #ff5100;
    font-size: 15px;
    position: absolute;
    right: 10px;
    bottom: 10px;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 5px 5px 5px rgb(0 0 0 / 20%);
}
.hover-demo-video-icon span {
    display: block;
    line-height: 22px;
    font-size: 14px;
    margin-top: 0px;
    padding: 5px 10px;
    font-weight: 600;
    display:table-cell;
    vertical-align:middle;
    color: #000;
}
.demo-videp-title {
    font-weight: 600;
    color: #000;
    text-align: center;
    line-height: 20px;
    padding: 5px 0;
    font-size: 14px;
}
.tabs-menu ul.nav.nav-tabs {
    overflow-x: auto;
    white-space: nowrap;
    display: flex !important;
    flex-direction: row;
    flex-wrap: nowrap;
    border-bottom: 0;
}
.tabs-menu a.nav-link {
    border: 0;
    height: 100px;
    width: 100px;
    line-height: 100px;
    text-align: center;
    padding: 0;
    background: #fff;
    border-radius: 10px;
    margin-right: 10px;
    font-weight:bold;
}
.tabs-menu a.nav-link.active {
    background: #e86a2f;
    color:#fff;
}
.tabs-menu {
    background: #253a73;
    padding: 10px;
    border-radius: 10px 0 0 10px;
}
.nav-tabs::-webkit-scrollbar {
    display: none; /*Safari and Chrome*/
}

#sticky_sidebar_wrapper_destop {
    position: relative;
}
#sticky_sidebar_destop {
    position: absolute;
}
#sticky_sidebar_destop.fixed {
    position: fixed;
    top: 100px;
    max-width:262px;
}
</style>
<section class="ic-banner">
        <div class="banner-img-part">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-7">
                        <div class="cc-heading-text  py-5">
                            <div class="cc-heading-one h1 text-blue py-5">
                                <div class="text-center"><span class="text-uppercase font-weight-bold text-orange">JOIN</span> <span class="text-uppercase font-weight-bold text-orange">OL</span><span class="text-uppercase font-weight-bold text-danger">EXPERT</span></br>
                                </div>
                                <div class="text-center"> <span class="text-uppercase font-weight-bold text-blue"> Industrial Courses</span></br>
                                </div>
                                <div class="text-center"> <span class="text-uppercase font-weight-bold text-blue">&</span></div>
                                <div class="text-center"><span class="font-weight-normal text-uppercase h3 text-blue">Make yourself Industry Ready</span></div>
                            </div>
                        </div>
                        <!-- <div class="cc-heading-text mb-4">
                            <div class="cc-heading-one h2 text-blue"><span class="text-uppercase font-weight-bold">INDUSTRIAL</span> <span class="font-weight-normal text-uppercase">COURSES</span></div>
                        </div>
                        <div class="sb-text clearfix mb-3">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="point-infographics">
                                        <div class="bottom-part">
                                            <div class="top-part">
                                                <span class="tab-name">
                                                    SUPPLY CHAIN
                                       </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="point-infographics">
                                        <div class="bottom-part">
                                            <div class="top-part">
                                                <span class="tab-name">
                                                    MACHINE REQUIREMENT
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="point-infographics">
                                        <div class="bottom-part">
                                            <div class="top-part">
                                                <span class="tab-name">
                                                    INFRASTRUCTURE REQUIREMENT
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="point-infographics">
                                        <div class="bottom-part">
                                            <div class="top-part">
                                                <span class="tab-name">
                                                    SITE SELECTION CRITERIA
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="point-infographics">
                                        <div class="bottom-part">
                                            <div class="top-part">
                                                <span class="tab-name">
                                                    FINANCIAL ASPECTS
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div> -->

                    </div>
                    <div class="col-lg-5 col-md-5 d-none d-md-block d-lg-block">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/industrial-courses-banner-image.jpg" class="img-fluid">
                    </div>
                </div>
            </div>

        </div>
</section>

<section class="feature-section py-3">
        <div class="container">
            <div class="row flex-nowrap">

                <div class="col-lg-4 col-md-8 col-10 stretch-card">
                    <div class="feature-item border-bottom-feature">
                        <img  src="https://olexpert.org.in/public/asset_rumbok/new/images/insight.png" title="INTERACTIVE LEARNING CONTENT" alt="INTERACTIVE LEARNING CONTENT">
                        <div class="feature-item-new">
                        <h4>BUSINESS MODEL INSIGHT WITHIN EACH INDUSTRY</h4>
                        </div>
                        
                        <!-- <h5>within each Industry...</h5> -->
                    </div>
                </div>

                <div class="col-lg-4 col-md-8 col-10 stretch-card">
                    <div class="feature-item border-bottom-feature">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/supply-chain.png" title="LIVE DOUBT CLEARING SESSION" alt="LIVE DOUBT CLEARING SESSION">
                        <div class="feature-item-new">
                        <h4>KEY COMPONENT UNDERSTANDING</h4>
                        <p>like supply chain, infra requirement, finincial aspects etc...</p>
                        </div>
                        
                    </div>
                </div>

                <div class="col-lg-4 col-md-8 col-10 stretch-card">
                    <div class="feature-item border-bottom-feature">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/online-training.png" title="BE FUTURE READY" alt="BE FUTURE READY">
                        <div class="feature-item-new">
                        <h4>ONLINE TRAINING</h4>
                        <p>via video lecture delivery notes and completion certificate after assessment...</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>


<section class="product-category py-4">
    <div class="container">    
        <div class="row">
            <div class="col-md-3">
                    <div class="d-none d-md-block d-lg-block" id="sticky_sidebar_wrapper_destop">
                        <div class="sidebar-ic-desktop" id="sticky_sidebar_destop">
                            <div class="heading-top">Find By Sectors</div>
                            <div class="sidebar-ic-list">
                                <a href="{{route('industrial.courses')}}" class="d-block py-3">View All</a>
                                <ul>
                                    @foreach(sectors() as $sector)
                                        <li><a href="{{route('industrial.courses',[$sector->slug])}}">{{$sector->name}}({{$sector->sectors->count()}})</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                        <div id="mySidebar" class="sidebar-ic">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                            <div class="heading-top">Find By Sectors</div>
                            <div class="sidebar-ic-list">
                                <a href="{{route('industrial.courses')}}" class="d-block py-3">View All</a>
                                <ul>
                                    @foreach(sectors() as $sector)
                                        <li><a href="{{route('industrial.courses',[$sector->slug])}}">{{$sector->name}}({{$sector->sectors->count()}})</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div id="main" class="d-md-none d-lg-none d-block">
                            <button class="openbtn" onclick="openNav()">&#9776; Select Sector</button>

                        </div>
            </div>

            <div class="col-md-9">
            <div class="row my-2">
         <div class="col-md-9">
            <p>Total <strong>{{$courses->total()}} records</strong> found</p>
         </div>
         <div class="col-md-3">
            <div class="form-group mb-0">
               <div class="search__container">
                  <input class="search__input" id="search" type="text" placeholder="Search">
                  <input type="hidden" id="searchUrl" value="{{route('industrial.courses.search',[request()->segment(2)])}}">
                  <div class="overflow-hidden search-list w-100">
                     <div id="appendSearchCart1"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
            @php $xx=0; @endphp
            @forelse($courses as $course)
            @if($xx==5)
            <a href="{{route('edp.preview',['entrepreneurship-development-program'])}}" class="border rounded shadow p-2 d-block mb-3">
                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-industrial-large.jpg" class="img-fluid">
            </a>
            @endif
            <div class="hp-course-carousel-block">
                        <div class="hp-course-carousel">
                            <div class="d-flex align-items-center">
                                <a href="{{route('industry.course.preview',$course->slug)}}" class="card__img" title="Mushroom Cultivation Business">
                                   @if($course->lms_refference_id>0)
                                    <div class="hp-course-circle-img" style="background: #263a72 url({{ 'https://courses.iid.org.in/public'.$course->image }});">
                    
                                    </div>
                                    @else
                                    <div class="hp-course-circle-img" style="background: #263a72 url({{ filePath($course->image) }});">
                    
                                    </div>
                                    @endif
                                </a>
                                <div class="hp-course-carousel-content">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>
                                                <a href="{{route('industry.course.preview',$course->slug)}}" title="{{ Str::limit($course->title,50) }}">{{ Str::limit($course->title,50) }}</a>
                                            </h5>
                                            <p>
                                                <span class="badge-custom badg-light mr-2">
                                                Industries Courses    
                                                {{--(isset($course->sector))?$course->sector->name:''--}}</span>
                    
                                            </p>
                                            <div class="d-flex align-items-center my-2">
                                                <div class="no-of-lectures">
                                                    <span class="sm-icon-img"><img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/lectures.png" alt=""></span>
                    
                                                    <?php
                                                $itemLectureCount = 0;
                                                foreach($course->classes as $course_classes){
                                                    foreach($course_classes->contents as $class_content){
                                                        $itemLectureCount++;
                                                    }
                                                }
                                            ?>
                                                {{$itemLectureCount}}  @translate(Lectures)
                                                </div>
                                                <div class="duration-lectures ml-auto">
                                                    <span class="sm-icon-img"><img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/duration.png" alt=""></span> 
                                                    
                                                    @php
                                                    $total_duration = 0;
                                                    foreach ($course->classes as $item){
                                                        $total_duration +=$item->contents->sum('duration');
                                                    }
                                                @endphp
                                                {{duration($total_duration)}}

                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center border-left">
                                            <div class="price-hp-course">
                                                @if($course->is_free)
                                                    {{-- free price --}}
                                                    <span class="price-current">@translate(Free)</span>
                                                @else
                                                    @if($course->is_discount)
                                                        {{-- discounted price --}}
                                                        <span
                                                            class="price-current f-24">{{formatPrice($course->discount_price)}}</span>
                                                    @else
                                                        {{-- actual price --}}
                                                        <span
                                                            class="price-current f-24">{{formatPrice($course->price)}}</span>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="btn-add-to-card-hp my-3">
                    
                                                
                                                @auth()
                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                                        <a href="#!"
                                                            class="btn-hp-add-to-cart addToCart-{{$course->ole_refference_id}}"
                                                            onclick="addToCart({{$course->ole_refference_id}},'{{route('add.to.cart')}}')">@translate(Add to cart)</a>
                                                    @else
                                                        <a href="{{route('login')}}" class="btn-hp-add-to-cart">@translate(Add to cart)</a>
                                                    @endif
                                                @endauth
                                                @guest
                                                        <a href="{{route('login')}}" class="btn-hp-add-to-cart">@translate(Add to cart)</a>

                                                @endguest
                                                <span class="d-block">
                                                    <a href="{{route('industry.course.preview',$course->slug)}}" class="small link-btn">Preview</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            @php $xx++; @endphp
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
       
        <a href="{{route('edp.preview',['entrepreneurship-development-program'])}}" class="border rounded shadow p-2 d-block my-3 mt-5">
          <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-industrial-large.jpg" class="img-fluid w-100" id="footer">
        </a>
    </div>
</section>

<script>
function forgetSrc(videoSrc){
    $('#myModal').modal('show');
    var videoSrc = videoSrc.replace("https://youtu.be/", "https://www.youtube.com/embed/");
    $("#showVideo").attr('src',videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
}
</script>
<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "300px";
        document.getElementById("main").style.marginLeft = "0";
    }

    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
    $(function() {
    var top = $('#sticky_sidebar_destop').offset().top - parseFloat($('#sticky_sidebar_destop').css('marginTop').replace(/auto/, 0));
    var footTop = $('#footer').offset().top - parseFloat($('#footer').css('marginTop').replace(/auto/, 0));

    var maxY = footTop - $('#sticky_sidebar_destop').outerHeight();

    $(window).scroll(function(evt) {
        var y = $(this).scrollTop();
        if (y > top) {
            
//Quand scroll, ajoute une classe ".fixed" et supprime le Css existant 
            if (y < maxY) {
                $('#sticky_sidebar_destop').addClass('fixed').removeAttr('style');
            } else {
                
//Quand la sidebar arrive au footer, supprime la classe "fixed" précèdement ajouté
                $('#sticky_sidebar_destop').removeClass('fixed').css({
                    position: 'absolute',
                    top: (maxY - top) + 'px'
                });
            }
        } else {
            $('#sticky_sidebar_destop').removeClass('fixed');
        }
    });
});
</script>
@endsection
