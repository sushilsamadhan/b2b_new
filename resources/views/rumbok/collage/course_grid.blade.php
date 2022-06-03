@extends('rumbok.app')

@section('content')

@if($cat->is_traditional_course == '1') 
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
/* .background-part{
    background-image: url({{asset('bharat-mata-mandir.jpg')}})      
}
.background-part {
    position: relative;
    background-repeat: no-repeat;
    width: 100%;
    background-size: cover;
    height: 60vh;
} */
h1.content-h1 {
    position: absolute;
    right: 4%;
    top: 161px;
    font-size: 75px;
    font-weight: 800;
    color: #765607;
    border-left: 10px solid #db7d0e;
    padding-left: 34px;
    text-align: inherit;
    
  font-family: "Roboto";
  text-transform: uppercase;
  line-height: 1.2;
  text-shadow: 2px 7px 1.5px #fad326;
}
h1.content-h11 {
    position: absolute;
    top: 181px;
    font-size: 42px !important;
    font-weight: 800;
    color: #4e0d01;
    border-left: 6px solid #c14304;
    padding-left: 34px;
    text-align: inherit;
    font-family: "Roboto";
    text-transform: uppercase;
    line-height: 1.2;
    text-shadow: 2px 7px 1.5px #fad326;
}



h2.hindi-heading{
    position: relative;
    font-size: 50px;
    font-weight: 800;
    color: #735309;
}
h2.hindi-heading::before {
    content: "";
    position: absolute;
    right: 70%;
    left: auto;
    background-color: #765607;
    top: 50%;
    width: 70px;
}
h2.hindi-heading::after {
    content: "";
    position: absolute;
    right: auto;
    left: 70%;
    background-color: #765607;
    top: 50%;
    width: 70px
}
/* ---------------------------------------------------------------------------- */
.theme-box {
    background: #fff;
    background-size: 100%;
    padding: 30px 20px 5px 20px;
    
}
.theme-box > div {
box-shadow:
      0 1px 1px hsl(0deg 0% 0% / 0.075),
      0 2px 2px hsl(0deg 0% 0% / 0.075),
      0 4px 4px hsl(0deg 0% 0% / 0.075),
      0 8px 8px hsl(0deg 0% 0% / 0.075),
      0 16px 16px hsl(0deg 0% 0% / 0.075) !important;
}    
/* .theme-box > div {
    position: relative;
    border: 3px dotted #dcdcdc;
    padding: 20px;
    height: 100%;
} */
.theme-box > div:before {
    content: '';
    background: url({{asset('border_2.png')}})  no-repeat center;
    position: absolute;
    left: 0;
    top: 0;
    height: 80px;
    width: 80px;
}
.theme-box > div:after {
    content: '';
    background: url({{asset('border_1.png')}})  no-repeat center;
    position: absolute;
    right: 0;
    bottom: 0;
    height: 80px;
    width: 80px;
}
.classs-block {
    border-radius: 0px;
    z-index: 2;
    background: #b56312;
    top: -12px;
    color: #fff;
    margin-left: -14px;
    position: absolute;
    line-height: 33px;
}
.theme-box > div {
    position: relative;
    border: 3px dotted #dcdcdc;
    padding: 37px;
    background-color: #fcf6dc;
}
.demo-video-thumb {
    border-radius: 0px;
    overflow: hidden;
    position: relative;
    top: 3px;
    max-height: initial;
}
span.content-heading {
   
    font-size: 15px;
    color: #735309;
    font-family: Poppins, sans-serif;

}
.div1 {
    border-bottom: double;
    width: 85%;
    margin-left: 28px;
    color: #735309;
}
.hindi-heading::before {
  content: "";
  display: block;
  width: 32px;
  padding-top: 3px;
  border-bottom: 2px solid #f9dd94;
}  
.hindi-heading::after {
  content: "";
  display: block;
  width: 32px;
  padding-top: 3px;
  border-bottom: 2px solid #f9dd94;
}  
.tabs-menu {
    background: none;
    
}
.box-header {
    text-align: center;
    font-size: 15px;
    position: relative;
    margin: 0 auto 20px;
    width: 75%;
    color: #fff;
    height: 54px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-top: 2px dotted #fff;
    border-bottom: 2px dotted #fff;
    background-image:  url({{asset('s1.png')}});
    text-shadow: 0 0 3px rgb(0 0 0 / 18%);
}
.bgh3 {
    background: #b56312;
}
.bgh3:before {
    background-image:  url({{asset('b3.png')}});
}
.box-header:before {
    background-color: transparent;
    background-repeat: no-repeat;
    content: '';
    height: 50px;
    width: 30px;
    left: -25px;
    top: 0;
    position: absolute;
}
.bgh3:after {
    background-image:  url({{asset('b4.png')}});
}
.box-header:after {
    background-color: transparent;
    background-repeat: no-repeat;
    content: '';
    height: 50px;
    width: 34px;
    right: -25px;
    top: 0;
    position: absolute;
}
.btn:hover {
    color: #ffffff;
    text-decoration: none;
}
.btn{
    color: #e9dfdf;
}
.hover-demo-video-icon a {
    color: #ffffff;
    font-size: 15px;
    position: absolute;
    right: 100px;
    bottom: 65px;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    background: #f00;
    border-radius: 50%;
    box-shadow: 5px 5px 5px rgb(0 0 0 / 20%);
}
h6.content-h6 {
    color: #d45f1c;
}
.hover-demo-video-icon a:hover {
    color: #fcf6dc;
    text-decoration: none;
}
@media screen and (max-width: 425px) {
 /* .hindi-heading::before {
  content: "";
  display: block;
  width: 32px;
  padding-top: 3px;
  border-bottom: 2px solid #f9dd94;
}  
.hindi-heading::after {
  content: "";
  display: block;
  width: 32px;
  padding-top: 3px;
  border-bottom: 2px solid #f9dd94;
}  */

h2.hindi-heading::before {
    content: "";
    position: absolute;
    right: 82% !important;
    background-color: #765607;
    top: 50%;
    width: 70px;
}
h2.hindi-heading::after {
    content: "";
    position: absolute;
    left: 82%;
    background-color: #765607;
    top: 50%;
    width: 70px
} 
h2.hindi-heading {
    position: relative;
    font-size: 25px;
    font-weight: 800;
    color: #735309;
}
}
</style>
<section class="">
    <img src="{{url('public')}}/bharat-mata-mandir.jpg" class="img-fluid">
</section>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="hindi-heading text-center py-3">जानिये हमारे भारत को</h2>
                <h6 class="content-h6">भारतीय संस्कृति परंपराओं, त्योहारों, प्रसिद्ध हस्तियों, आविष्कारों के बारे में जानें</h6>
                <img src="{{asset('separator.png')}}">
            </div>
        </div>
    </div>
</section>
@else
<!-- <div id="ctl00_hdcirculerletter" class="box-header bgh3">Circular/ Letter/ Orders</div> -->
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

</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                    <h1>{{$cat->name}}</h1>
                    </div>
               </div> 
                           
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                          <a href="{{url('/')}}">Home</a>
                      </li>
                      <li>
                          @if(Request::segment(1)=='elite-courses')
                            <span>Our Elite Courses</span>
                          @else
                            <span>Study Material</span>
                          @endif
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
@endif
<section class="product-category">
    
   @if($cat->is_traditional_course != '1')    
    <div class="container">    
        @if(Request::segment(1)=='freestudy-courses')
        <div class="heading-row clearfix">
            <form name="filterForm" id="filterForm" action="">
                <div class="row">
                    
                    <div class="col-lg-8 col-md-8 col-sm-6 col-10">
                {{--
                    <a href="{{url('demo-courses/'.$cat->slug)}}"><img src="{{ asset('watch-demo.jpg') }}" alt="" class="img-fluid d-md-block d-lg-block d-none"></a>
                    <a href="{{url('demo-courses/'.$cat->slug)}}"><img src="{{ asset('watch-demo-mobile.jpg') }}" alt="" class="img-fluid d-md-none d-lg-none d-sm-block"></a>
                        <div class="card-rdp">
                            <div class="cardinner">
                            </div>
                        </div>   --}}
                            
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-6 col-2">
                        <button type="button" class="btn btn-sm btn-warning d-md-none d-lg-none d-sm-block" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="ti-search"></i></button>
                        <div class="clearfix d-md-block d-lg-block d-none">
                            <div class="row">
                                <div class="col-lg-6 col-6">
                                    <div class="form-group">
                                        <label>Board </label>
                                        <select class="form-control custom-form-control" id="board" name="board">
                                            @foreach(\App\Model\Category::Published()->where(['is_free_study'=> '1','parent_category_id'=>0])->get() as $category)
                                                <option value="{{$category->slug}}" {{($cat->slug == $category->slug)?'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <div class="form-group">
                                        <label>Class</label>
                                        <select class="form-control custom-form-control" name="classes" id="classes">
                                            <option value="">All Classes</option>
                                            @foreach($boardClasses as $classes)
                                                <option value="{{$classes->id}}" {{(Request()->classes == $classes->id)?'selected':''}}>{{$classes->name}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <form name="filterForm" id="filterFormm" action="">
                <div class="row d-md-none d-lg-none d-sm-block collapse" id="collapseExample">
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label>Board </label>
                                    <select class="form-control custom-form-control" id="boardm" name="board">
                                        @foreach(\App\Model\Category::Published()->where(['is_free_study'=> '1','parent_category_id'=>0])->get() as $category)
                                            <option value="{{$category->slug}}" {{($cat->slug == $category->slug)?'selected':''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label>Class</label>
                                    <select class="form-control custom-form-control" name="classes" id="classesm">
                                        <option value="">All Classes</option>
                                        @foreach($boardClasses as $classes)
                                            <option value="{{$classes->id}}" {{(Request()->classes == $classes->id)?'selected':''}}>{{$classes->name}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                        </div>
            </form>
        </div>
        @else
        <div class="heading-row clearfix">
            <form name="filterForm" id="filterForm" action="">
                <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Search </label>
                            <input class="form-control custom-form-control" type="text" id="search" name="search"/>
                            <div class="overflow-hidden search-list w-100">
                                <div id="appendSearchCart1"></div>
                            </div>
                            {{--some ajax value--}}
                            <input value="@translate(Your Cart is Empty)" type="hidden"
                                   id="emptyUrl" name="emptyUrl">
                            <input value="{{route('search.courses')}}" type="hidden"
                                   id="searchUrl" name="searchUrl">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endif 
        <div class="row">
            <div class="col-md-12">
            <label class="mb-0">Total {{ $courses->total() }} records found</label>    
            </div>
        </div>
        <div class="row">

        
            @forelse($courses as $course)
                <div class="col-md-6 col-lg-4 col-sm-12">
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

                                {{--@if($course->lms_refference_id>0)
                                    <img src="{{ 'https://courses.iid.org.in/public'.$course->image }}" alt="{{ $course->image }}"/>
                                @else
                                    <img src="{{ filePath($course->image) }}" alt="{{ filePath($course->image) }}"/>
                                @endif
                                <span class="position-absolute classs-block small">{{$course->category->name}}</span>--}}		
                                <div class="hover-details">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                    
                                        <span class="l-c-count">
                                       
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
                            {{--
                            <div class="d-flex align-items-center justify-content-between border-top pt-2">
                            
                            @if(Request::segment(1)=='elite-courses')
                                @if($course->is_free)
                                    <span
                                        class="p-price">@translate(Free)</span>
                                @else
                                    @if($course->is_discount)
                                        <span
                                            class="p-price">{{formatPrice($course->discount_price)}}</span>
                                        <span class="p-price">{{formatPrice($course->price)}}</span>
                                    @else
                                        <span
                                            class="p-price">{{formatPrice($course->price)}}</span>
                                    @endif
                                @endif
                                <a href="{{route('course.single',$course->slug)}}" class="bisylms-btn-2">View Details</a>
                            </div>
                            @else @endif --}}
                             <div class="align-items-center justify-content-between border-top pt-2">
                                <div class="d-block">
                                    <a href="{{route('edp.preview',$course->slug)}}" class="bisylms-btn-2 d-block">View Details</a>
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
                {{ $courses->links() }}
            </div>

        </div>
    </div>
    @else
                    
        <section class="product-category">
            <div class="container">
                {{--<div class="tab-menu-category mb-3 box-header bgh3">
                <div class="tabs-menu">
                    <ul class="nav nav-tabs">
                    <li><a href="{{ Request::segment(2) }}" class="btn m-2 p-2">ALL</a></li>
                        @forelse($boardClasses as $bdclass)
                            <li><a href="{{ Request::segment(2) }}?{{$bdclass->slug}}" class="btn  m-2 p-2">{{ $bdclass->name }}</a></li>
                        @empty
                               
                        @endforelse
                    </ul>
                </div>
                </div>
                <img src="{{asset('border-heavy.png')}}">--}}
                <div class="tab-content p-0">
                <div id="all" class="tab-pane in active">
            
                @forelse($data as $key=>$democat)
                        <?php
                            $keyId = str_replace(" ","",trim($key));
                        ?>
                    <div class="row random-bg">
                  @foreach($democat as $demoData)
                           <div class="col-lg-4 col-md-4 col-sm-6 col-12" >
                                <div class="theme-box">
                                <div class="demo-video-block shadow bg-type">
                                    <div class="demo-video-thumb shadow">
                                        {{--<span class="classs-block small line-height-1">{{$demoData['subject_name']}}</span>--}}
                                             @php
                                              $mainyoutube = str_replace("https://youtu.be/","",$demoData['demo_url']);
                                                $thumbdata = "https://img.youtube.com/vi/".$mainyoutube."/sddefault.jpg";
                                             @endphp                                       
                                        <img src="{{$thumbdata}}" alt="" class="img-fluid">
                                        <div class="hover-demo-video-icon">
                                      <a  data-toggle="modal" href="javascript:void(0);" onclick="forgetSrc('{{$demoData['demo_url']}}')"><i class="fa fa-play"></i></a>
                                       </div>
                                    </div>
                                    <div class="demo-video-content pt-2">
                                        <!-- <div class="demo-videp-title"></div> -->
                                        {{-- <div class="h6 text-muted small text-center"></div>--}}
                                        {{-- <a href="#" class="bisylms-btn-2 d-block">View Details</a>--}}
                                    </div>
                               </div>
                             </div>
                             <div class="div1 text-center"><span class="content-heading py-1">{{$demoData['chapter_name']}}</span></div>
               </div>
                @endforeach
                </div>
                           
                @empty

                @endforelse
                </div>  
               
                @forelse($data as $key=>$democat)
                        <?php
                            $keyId = str_replace(" ","",trim($key));
                        ?>
                    <div id="{{$keyId}}" class="tab-pane">
                        <div class="row random-bg">
                    @foreach($democat as $demoData)
                        
                            <div class="col-lg-4 theme-box col-md-4 col-sm-6 col-12" >
                                <div class="demo-video-block shadow bg-type">
                                    <div class="demo-video-thumb shadow">
                                        {{--<span class=" position-absolute classs-block small line-height-1">{{$demoData['subject_name']}}</span>--}}
                                        <img src="{{ filePath($demoData['course_image']) }}" alt="" class="img-fluid">
                                        <div class="hover-demo-video-icon">
<a  data-toggle="modal" href="javascript:void(0);" onclick="forgetSrc('{{$demoData['demo_url']}}')" class="video-btn"><i class="fa fa-play"></i></a>
                                            <span>{{$demoData['chapter_name']}}</span>
                                        </div>
                                    </div>
                                    <div class="demo-video-content pt-2">
                                        {{-- <div class="h6 text-muted small text-center"></div>--}}
                                        {{-- <a href="#" class="bisylms-btn-2 d-block">View Details</a> --}}
                                    </div>

                                    

                                </div>
                                <span>{{$demoData['chapter_name']}}</span>

                            </div>
                    @endforeach
                        </div>
                </div>
                
                @empty
                    <div class="col-12 m-5">
                        <img src="{{asset('no_data.png')}}" class="w-100 img-fluid">
                    </div>
                @endforelse
                </div>

            </div>
        </section>
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <button type="button" class="close position-absolute" data-dismiss="modal" style=" top: -10px; right: -10px;    z-index: 2;    background: #000; opacity: 1; text-shadow: none; color: #fff; width: 30px; height: 30px; border-radius: 50%;">×</button>
                <!-- Modal Header -->
                
                
                <!-- Modal body -->
                <div class="modal-body">
                     <iframe id="showVideo" width="100%" height="500" src="" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" autoplay="1" allowfullscreen=""></iframe>
                </div>
                
            
                
            </div>
            </div>
        </div>
    @endif
</section>
@endsection
@section('js')
<script>
    $(document).on('change', '#classes', function(e){
        e.preventDefault();
        $('#filterForm').submit();
    });
    $(document).on('change', '#board', function(e){
        e.preventDefault();
        $("#classes").val('');
        var url = '{{url("freestudy-courses")}}'+'/'+$('#board').val();
        $('#filterForm').prop('action', url);
        $('#filterForm').submit();
    });
    $(document).on('change', '#classesm', function(e){
        e.preventDefault();
        //var url = '{{url("courses")}}'+'/'+$('#board').val();
        //$('#filterForm').prop('action', url);
        //
        $('#filterFormm').submit();
    });
    $(document).on('change', '#boardm', function(e){
        e.preventDefault();
        $("#classes").val('');
        var url = '{{url("coursesm")}}'+'/'+$('#boardm').val();
        $('#filterFormm').prop('action', url);
        $('#filterFormm').submit();
    });
</script>


<script>
    $(document).on('change', '#classes', function(e){
        e.preventDefault();
        $('#filterForm').submit();
    });
    $(document).on('change', '#board', function(e){
        e.preventDefault();
        $("#classes").val('');
        var url = '{{url("courses")}}'+'/'+$('#board').val();
        $('#filterForm').prop('action', url);
        $('#filterForm').submit();
    });
</script>
<script>
function forgetSrc(videoSrc){
    $('#myModal').modal('show');
    var videoSrc = videoSrc.replace("https://youtu.be/", "https://www.youtube.com/embed/");
    $("#showVideo").attr('src',videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
}
</script>

@endsection
