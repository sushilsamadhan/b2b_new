@extends('rumbok.app')
@section('content')
<style>
#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px; 
  background-color: red;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 2;
  right:0;
  font-size: 17px;
  top:500;
}
#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
@-webkit-keyframes fadein {
  from {opacity: 0;} 
  to {opacity: 1;}
}
@-webkit-keyframes fadeout {
  from { opacity: 1;} 
  to {opacity: 0;}
}
</style>

<div id="snackbar">Permission Denied !..</div>

    <!--================================
         START SLIDER AREA
=================================-->
<!-- Hero Banner Start -->
    @if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->silder_area==1)
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
    @endif
<?php
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
// echo date('d-m-Y H:i:s');
?>
@if(count($dataBooking) >0)
<section class="notification-section">
    <div class="container">
        @foreach($dataBooking as $valBooking)
                    @php


    $startTime = date("H:i", strtotime('- 10 minutes', strtotime($valBooking->start_time)));
    $end_time = date("H:i", strtotime('- 0 minutes', strtotime($valBooking->end_time)));

            $currentdate = date('H:i', time());
            if($startTime < $currentdate && $end_time > $currentdate){
                        $linktojoin = "notification-green";
                    }
                    else{
                        $linktojoin = "notification-grey";
                    }
                    @endphp
        <div class="notification-container {{$linktojoin}}">
            <div class="notification-cell">
                <div class="notification">
                    <div class="notification-icon">
                        <i class="ti-bell"></i>
                    </div>
                    <div class="notification-content">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h3>{{$valBooking->boardname}} - {{$valBooking->classname}}<sup>th</sup></h3>
                            </div>
                            <div class="col-md-3">
                               <h4>{{$valBooking->insname}}</h4>     
                            </div>
                            <div class="col-md-3">
                              <p><i class="fa fa-clock"></i> {{$valBooking->time_of_booking}}</p>
                            </div>
                            <div class="col-md-3">
                    @if($startTime < $currentdate && $end_time > $currentdate)
                                <a class="notification-join-btn" href="{{url('my/tuition')}}/{{$valBooking->unic_jitsi_code}}" data-toggle="tooltip" title="tution link would be enable 5 mins before schedule ">Click to join</a>
                    @else
                                <a class="notification-join-btn" href="#" data-toggle="tooltip" title="tution link would be enable 5 mins before schedule ">Click to join</a>
                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endforeach
        {{--<div class="notification-container notification-green">
            <div class="notification-cell">
                <div class="notification">
                    <div class="notification-icon">
                        <i class="ti-bell"></i>
                    </div>
                    <div class="notification-content">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h3>Class - CBSE 7<sup>th</sup></h3>
                            </div>
                            <div class="col-md-3">
                               <h4>Pankaj Sir</h4>     
                            </div>
                            <div class="col-md-3">
                              <p><i class="fa fa-clock"></i> 8:00 AM to 8:30 AM</p>
                            </div>
                            <div class="col-md-3">
                                <a class="notification-join-btn" href="#" data-toggle="tooltip" title="tution link would be enable 5 mins before schedule ">Click to join</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="notification-container notification-green">
            <div class="notification-cell">
                <div class="notification">
                    <div class="notification-icon">
                        <i class="ti-bell"></i>
                    </div>
                    <div class="notification-content">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h3>Class - CBSE 7<sup>th</sup></h3>
                            </div>
                            <div class="col-md-3">
                               <h4>Pankaj Sir</h4>     
                            </div>
                            <div class="col-md-3">
                              <p><i class="fa fa-clock"></i> 8:00 AM to 8:30 AM</p>
                            </div>
                            <div class="col-md-3">
                                <a class="notification-join-btn" href="#" data-toggle="tooltip" title="tution link would be enable 5 mins before schedule ">Click to join</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="notification-container notification-green">
            <div class="notification-cell">
                <div class="notification">
                    <div class="notification-icon">
                        <i class="ti-bell"></i>
                    </div>
                    <div class="notification-content">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h3>Class - CBSE 7<sup>th</sup></h3>
                            </div>
                            <div class="col-md-3">
                               <h4>Pankaj Sir</h4>     
                            </div>
                            <div class="col-md-3">
                              <p><i class="fa fa-clock"></i> 8:00 AM to 8:30 AM</p>
                            </div>
                            <div class="col-md-3">
                                <a class="notification-join-btn" href="#" data-toggle="tooltip" title="tution link would be enable 5 mins before schedule ">Click to join</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
</section>
@endif
<!-- <section class="launch-offer mb-2">
<div class="container">
    <div class="d-flex align-items-center launch-block">
        <div class="thumb-icon-launch">
        <image  src="{{asset('asset_rumbok/new/images/launch-offer.png')}}" />
        </div>
        <div class="launch-text">
        <div class="blinking">Register and get any one K-12 course curriculum or competitive exam course for <span class="bg-info px-2 rounded ">FREE</span></div>
        </div>
    </div>
</div>
</section> -->
    <!-- Feature Section Starts -->
   {{-- <section class="feature-section">
        <div class="container">
            <div class="row flex-nowrap">
                @php
                    $color = array('learning-content.png','faq.png','future-ready.png');
                    $i = 0;
                @endphp
                @foreach(\App\KnowAbout::where('align','top')->get()->take(3) as $topContent)

                <div class="col-lg-4 col-md-8 col-10 stretch-card">
                    <div class="feature-item">
                        <img class="lazy" src="{{asset('asset_rumbok/new/images/features').'/'.$color[$loop->index++]}}" title="{{$topContent->title}}" alt="{{$topContent->title}}" />
                        <h4>{{$topContent->title}}</h4>
                        <p>{{$topContent->desc}}.</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>--}}
    <!--================================
            END SLIDER AREA
    =================================-->
<!-- How We Function Start -->
{{--<section class="how-we-function">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="position-relative">
                    <div class="content-section position-absolute fixed-width-block">
                        <h2 class="sec-title">How We Function?</h2>
                    </div>
                    <div class="course-wrapper function-carousel owl-carousel hidden-content">
                        <div class="course-item-1 text-center">
                            
                            <image width="74" height="60" xlink:href="{{asset('asset_rumbok/new/images/desktop1-image.png')}}" />
                        
                <h4><a href="">Bilingual Approach For Lecture Delivery</a></h4>

            </div>
                        
                @php
                    $color = array('bilingual.png','innovative.png','preperation.png','career.png','encouragement.png','study.png','online-class.png','certification.png','classroom-to-career.png');
                    $i = 1;
                @endphp
                @foreach(\App\KnowAbout::where('align','left')->orWhere('align','right')->get() as $leftContent)
                    <div class="course-item-1 text-center">
                                <div class="img-icon">
                                <image class="lazy" src="{{asset('asset_rumbok/new/images').'/'.$color[$loop->index++]}}" />
                                </div>
                                
                            
                    <h4><a href="">{{$leftContent->title}}</a></h4>
                    <div class="tab-{{$i}}">
                        <p>{{$leftContent->desc}}</p>
                    </div>
                    <div class="position-absolute right-side-button">
                        <button class="display{{$i}}"><i class="icon_plus"></i></button>
                    </div>


                    </div>
                    <?php $i++;?>
                @endforeach
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</section>--}}
<!-- Special Banners Start -->
@if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->special_banners==1)
<section class="special-banners">
    <div class="container">
        <div class="special-slides owl-carousel">
            @foreach($rumbokMiddleSliders as $rumbokMiddleSlider)
            <div class="special-item rounded overflow-hidden">
                @if(!empty($rumbokMiddleSlider->url))
                 <a href="{{url($rumbokMiddleSlider->url)}}"><img  class="lazy" src="{{ asset('storage/'.$rumbokMiddleSlider->image)}}" title="{{ $rumbokMiddleSlider->name }}" alt="{{ $rumbokMiddleSlider->name }}" /></a>
                @else
                    <img class="lazy" src="{{ asset('storage/'.$rumbokMiddleSlider->image)}}" title="{{ $rumbokMiddleSlider->name }} " alt="{{ $rumbokMiddleSlider->name }} " />
                @endif
            </div>
            @endforeach
           
        </div>
    </div>
</section>
@endif
    @endif
		<!-- Special Banners End -->

    <!--======================================
                START CATEGORY AREA
        ======================================-->




        <!-- How We Function End -->

    <!-- Category Section Starts -->

   <!-- Free Live Course Start -->
   @if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->free_live_course==1)
		<section>
            @foreach($rumbokBanners as $rumbokBanner)
			<div class="container">
				<a href="{{ route('get-live-class')}}"><img  src="{{ asset('storage/'.$rumbokBanner->image)}}" alt="{{ $rumbokBanner->name }}"  class="lazy img-fluid lazy"></a>
              <!-- <a href="{{ route('get-live-class')}}">  <img  src="{{ asset('asset_rumbok/new/images/live-classes-small.jpg') }}" alt="{{ $rumbokBanner->name }}" class=" lazy img-fluid d-block d-md-none d-lg-none lazy"></a> -->
			</div>
            @endforeach
		</section>   
    @endif
    @endif
		<!-- Free Live Course End -->
{{--
<?php
    $packageDataBoards = \App\PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
    ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
    ->leftjoin('courses as c','c.id','=','package_settings.course_id')
    ->select('package_settings.*','Cat.name as catName','Cat.slug as slug','subCat.name as subName','c.title')
    ->where('package_settings.package_type','=','board')
    ->orderBy('id', 'DESC')->take(3)->get();
?>
    

@if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->pricing_area==1)
          <!-- Pricing Start -->
        <section class="pricing-section">
            <div class="container">
				<div class="heading-section">
					<div class="row">
						<div class="col-md-12 text-center">
							<h2 class="sec-title mb-3">K-12 Packages</h2>
						</div>
					</div>
				</div>
				<div class="owl-carousel owl-theme hp-package-slider">
                    @foreach($packageDataBoards as $data)
					<div class="item">
						<div class="pricing-item w-100">
                                    @php
                                        $freeData = explode(',',$data->free_subject);
                                        $course_chapter_count =  getCountData($data->course_id,$freeData);
                                    @endphp
							<div class="thumbnail-image">
								<img src="{{ filePath($data->pkg_image) }}" alt="{{ $data->pkg_name }}"/>
                                <span class="position-absolute classs-block lazy">{{$data->subName}}</span>		
								<div class="hover-details">
								  <div class="d-flex justify-content-between align-items-center">
									<div class="lectures-n-chapters">
										<div class="d-flex justify-content-between align-items-center">
                                            <span class="l-c-count">
                                            {{$course_chapter_count[0]}}
											</span>
											<span class="l-c-text">
												Chapters
											</span>	
										</div>
									</div>
									<div class="lectures-n-chapters">
										<div class="d-flex justify-content-between align-items-center">
										<span class="l-c-count">
                                            {{$course_chapter_count[1]}}
											</span>
											<span class="l-c-text">
												Lectures
										</span>	
                                       
										</div>
									</div>
								  </div>									
                                </div>
							</div>	
							<h3 class="page-title">{{$data->pkg_name}}</h3>
                            <?php $short_desc = explode("\n",$data->short_desc);?>
                            @if(count($short_desc)>0)
                            <ul>
                            <?php
                            if(isset($short_desc) && count($short_desc)!=1){
                                $i=0;
                                foreach($short_desc as $shortDesc){
                            ?>            
                                <li><i class="icon_check"></i>{{$shortDesc}}</li>
                            <?php $i++;
                            //<li class="disable"><i class="icon_check"></i>Certificate after completion</li>
                                } 

                            } 
                            ?>
                            </ul>
                            @endif
							<div class="available-in">
								<ul class="list-inline">									
									<li class="list-inline-item">Available in :</li>
                                    @if(($data->quarterly_course_coverage!=null && $data->quarterly_course_coverage!='0.00') && ($data->halfyrly_course_coverage!=null && $data->halfyrly_course_coverage!='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item"> <span class="badge badge-warning">3 Months </span></li>
                                    <li class="list-inline-item"> <span class="badge badge-success" >6 Months </span></li>
                                    <li class="list-inline-item">  <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage=='0.00' && $data->quarterly_course_coverage==null) && ($data->halfyrly_course_coverage!=null && $data->halfyrly_course_coverage!='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item"> <span class="badge badge-success">6 Months </span></li>
                                    <li class="list-inline-item"> <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage!=null && $data->quarterly_course_coverage!='0.00') && ($data->halfyrly_course_coverage==null && $data->halfyrly_course_coverage=='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item">   <span class="badge badge-warning">3 Months </span></li>
                                    <li class="list-inline-item">  <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage=='0.00' && $data->quarterly_course_coverage==null) && ($data->halfyrly_course_coverage==null && $data->halfyrly_course_coverage=='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item">  <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage!=null && $data->quarterly_course_coverage!='0.00') && ($data->halfyrly_course_coverage!=null && $data->halfyrly_course_coverage!='0.00') && ($data->annually_course_coverage==null && $data->annually_course_coverage=='0.00'))
                                    <li class="list-inline-item">  <span class="badge badge-warning">3 Months </span></li>
                                    <li class="list-inline-item">   <span class="badge badge-success">6 Months </span></li>
                                    @else
                                    <li class="list-inline-item"><span class="badge badge-warning">Free </span></li>
                                    @endif
								</ul>
							</div>
							<div class="align-items-center d-flex justify-content-between border-top pt-2">
                            <?php
                                $subUri1 = $data->slug.'-'.str_replace(" ","-",strtolower($data->subName));
                                $rString = str_replace(' ', '-', strtolower($data->pkg_name));
                                $subUri2 = preg_replace('/[^A-Z0-9]+/i', "-",$rString);
                            ?>
                                <div class="d-block">
                                    <a href="{{route('packages.preview_board',[$data->id,$subUri1,$subUri2])}}" class="bisylms-btn-2 d-block">View Details</a>
                                </div>
                                @if(isset($data->demo_course_id) && $data->demo_course_id>0)
                                    
                                    <?php
                                        $courseDetail = \App\Model\Course::find($data->demo_course_id);
                                        $url = route('course.trial',[$courseDetail->slug,$data->id,$subUri1,$subUri2]);
                                    ?>
                                    <a href="{{$url}}" class="btn btn-link d-block btn-sm try-for-free">Try for free</a>
                                @endif
							</div>
                        </div>
					</div>
                    @endforeach
					
					
					<div class="item">
						<div class="pricing-item w-100 min-height bg-light d-flex align-items-center text-center">					
							<div class="clearfix w-100">
                         		<a href="{{url('courses/cbse')}}" class="bisylms-btn-5">View All</a>
							</div>						  
                        </div>
					</div>		
				</div>
            </div>
        </section>
        <!-- Pricing End -->
    
        @endif
    @endif
--}}
<section class="html-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="html-banner-content mb-4">
                    <h2>CONNECTING</h2>
                    <div class="d-flex align-items-center mid-part">
                        <div class="left-content-html-banner">
                            ClassRoom
                        </div>
                        <div class="mid-content-html-banner">
                            <img src="{{ asset('asset_rumbok/new/images/connecting.png') }}" />
                        </div>
                        <div class="right-content-html-banner">Real World</div>
                    </div>
                </div>
                <div class="html-banner-content ">
                        <h3>JOIN <span style="color:#e86a2f;">O</span><span style="color:#253a73;">L</span><span style="color:#e86a2f;">E</span><span><span style="color:#e31e24;">XPERT</span></h3>

                        <h3>PROJECT BASED LEARNING PROGRAM</h3>

                        <p class="my-4"><a href="https://olexpert.org.in/project-work" class="join-now-btn-purple">Join Now</a></p>
                </div>
            </div>
            <div class="col-md-5">
                <img src="{{ asset('asset_rumbok/new/images/pwp-info.png') }}" class="img-fluid" />
            </div>
        </div>
    </div>
</section>
 <!--======================================
            START Curriculum Promo
    ======================================-->

 @if(count($rumbokCurriculumPromos) >0)
<!-- Special Banners Start -->
    
@if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->curriculum_promo==1)
<section class="special-banners">
    <div class="container">
        <div class="special-slides owl-carousel">
            @foreach($rumbokCurriculumPromos as $rumbokCurriculumPromo)
            <div class="special-item rounded overflow-hidden">
                @if(!empty($rumbokCurriculumPromo->url))
                 <a href="{{url($rumbokCurriculumPromo->url)}}"><img class="lazy" src="{{ asset('storage/'.$rumbokCurriculumPromo->image)}}" alt="{{ $rumbokCurriculumPromo->name }}" /></a>
                @else
                    <img class="lazy" src="{{ asset('storage/'.$rumbokCurriculumPromo->image)}}" alt="{{ $rumbokCurriculumPromo->name }} " />
                @endif
            </div>
            @endforeach
           
        </div>
    </div>
</section>

@endif
@endif
    
@if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->affiliate_program==1)
<section class="py-2 bg-light">
    <div class="container">
        <div class="row no-gutter align-items-center">
            <div class="col-lg-8 col-md-8">
              <div class="clearfix p-4">
                    <h3 class="">Are you a <span class="text-uppercase">TUTOR?</span></h3>
                    <h4 class="font-weight-normal mb-3">Join our affiliate program. Publish your course and <span class="font-weight-bold"><u>Earn Money</u></span></h4>
                    <h6 class="font-weight-bold mb-3 text-uppercase"><u>We Provide</u></h6>
                    <ul class="white-check-list">
                            <li class="mb-2">Technology Support</li>
                            <li class="mb-2">Content Development Support</li>
                            <li class="mb-2">Platform to upload your content &amp; online training</li>
                            <li class="mb-2"><strong><u>Earn Money</u></strong> on each sale</li>
                        </ul>
                        <p class="my-5">
                            <a href="{{url('/become-tutor')}}" class="join-us-today">Join Us Now</a>
                        </p>
                
              </div>
            </div>
            <div class="col-lg-4 col-md-4 d-none d-md-block d-lg-block">
            <img src="{{ asset('asset_rumbok/new/images/become-a-tutor-2.png') }}" class="img-fluid">
            </div>
        </div>
        
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                
            </div>
            <div class="col-md-7">
                
            </div>
        </div>
    </div>
</section>

@endif
@endif
@endif
		<!-- Special Banners End -->
        
        <?php
    $packageDataComp = \App\PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
    ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
    ->leftjoin('courses as c','c.id','=','package_settings.course_id')
    ->select('package_settings.*','Cat.name as catName','Cat.slug as slug','subCat.name as subName','c.title')
    ->where('package_settings.package_type','=','competitive-courses')
    ->orderBy('id', 'DESC')->take(3)->get();
?>
     
@if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->competitive_classes_area==1)   
@if(count($packageDataComp) >0)
          <!-- Pricing Start -->
        <section class="pricing-section">
            <div class="container">
				<div class="heading-section">
					<div class="row">
						<div class="col-md-12 text-center">
							<h2 class="sec-title mb-3">Competitive Classes</h2>
						</div>
					</div>
				</div>
				<div class="owl-carousel owl-theme hp-package-slider">
                    @foreach($packageDataComp as $data)
					<div class="item">
						<div class="pricing-item w-100">
                                    @php
                                        $freeData = explode(',',$data->free_subject);
                                        $course_chapter_count =  getCountData($data->course_id,$freeData);
                                    @endphp
							<div class="thumbnail-image">
								<img class="lazy" src="{{ filePath($data->pkg_image) }}" alt="{{ $data->pkg_name }}"/>	
                                <span class="position-absolute classs-block">{{$data->subName}}</span>
								<div class="hover-details">
								  <div class="d-flex justify-content-between align-items-center">
									<div class="lectures-n-chapters">
										<div class="d-flex justify-content-between align-items-center">
                                        <span class="l-c-count">
                                            {{$course_chapter_count[0]}}
											</span>
											<span class="l-c-text">
												Chapters
											</span>
                                       
										</div>
									</div>
                                   
									<div class="lectures-n-chapters">
										<div class="d-flex justify-content-between align-items-center">
                                        <span class="l-c-count">
                                            {{$course_chapter_count[1]}}
											</span>
											<span class="l-c-text">
												Lectures
											</span>
										</div>
									</div>
								  </div>									
                                </div>
							</div>	
							<h3 class="page-title">{{$data->pkg_name}}</h3>
                            <?php $short_desc = explode("\n",$data->short_desc);?>
                            @if(count($short_desc)>0)
                            <ul>
                            <?php
                            if(isset($short_desc) && count($short_desc)!=1){
                                $i=0;
                                foreach($short_desc as $shortDesc){
                            ?>            
                                <li><i class="icon_check"></i>{{$shortDesc}}</li>
                            <?php $i++;
                            //<li class="disable"><i class="icon_check"></i>Certificate after completion</li>
                                } 

                            } 
                            ?>
                            </ul>
                            @endif
							<div class="available-in">
								<ul class="list-inline">									
									<li class="list-inline-item">Available in :</li>
                                    @if(($data->quarterly_course_coverage!=null && $data->quarterly_course_coverage!='0.00') && ($data->halfyrly_course_coverage!=null && $data->halfyrly_course_coverage!='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item"> <span class="badge badge-warning">3 Months </span></li>
                                    <li class="list-inline-item"> <span class="badge badge-success" >6 Months </span></li>
                                    <li class="list-inline-item">  <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage=='0.00' && $data->quarterly_course_coverage==null) && ($data->halfyrly_course_coverage!=null && $data->halfyrly_course_coverage!='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item"> <span class="badge badge-success">6 Months </span></li>
                                    <li class="list-inline-item"> <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage!=null && $data->quarterly_course_coverage!='0.00') && ($data->halfyrly_course_coverage==null && $data->halfyrly_course_coverage=='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item">   <span class="badge badge-warning">3 Months </span></li>
                                    <li class="list-inline-item">  <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage=='0.00' && $data->quarterly_course_coverage==null) && ($data->halfyrly_course_coverage==null && $data->halfyrly_course_coverage=='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item">  <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage!=null && $data->quarterly_course_coverage!='0.00') && ($data->halfyrly_course_coverage!=null && $data->halfyrly_course_coverage!='0.00') && ($data->annually_course_coverage==null && $data->annually_course_coverage=='0.00'))
                                    <li class="list-inline-item">  <span class="badge badge-warning">3 Months </span></li>
                                    <li class="list-inline-item">   <span class="badge badge-success">6 Months </span></li>
                                    @else
                                    <li class="list-inline-item"><span class="badge badge-warning">Free </span></li>
                                    @endif
								</ul>
							</div>
							<div class="align-items-center d-flex justify-content-between border-top pt-2">
                                <div class="d-block">
                                    <?php
                                        $subUri1 = $data->slug.'-'.str_replace(" ","-",strtolower($data->subName));
                                        $rString = str_replace(' ', '-', strtolower($data->pkg_name));
                                        $subUri2 = preg_replace('/[^A-Z0-9]+/i', "-",$rString);
                                    ?>
                                    <a href="{{route('packages.preview_board',[$data->id,$subUri1,$subUri2])}}" class="bisylms-btn-2 d-block">View Details</a>
                                </div>
                                @if(isset($data->demo_course_id) && $data->demo_course_id>0)
                                    
                                    <?php
                                        $courseDetail = \App\Model\Course::find($data->demo_course_id);
                                        $url = route('course.trial',[$courseDetail->slug,$data->id,$subUri1,$subUri2]);
                                    ?>
                                    <a href="{{$url}}" class="btn btn-link d-block btn-sm try-for-free">Try for free</a>
                                @endif
							</div>
                        </div>
					</div>
                    @endforeach
					
					
					<div class="item">
						<div class="pricing-item w-100 bg-light d-flex align-items-center text-center">					
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
@endif
@endif

     
@if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->test_series_program==1)   

<section class="clearfix">
    <div class="container">
    @auth
    @if (Auth::user()->user_type === "Student")                                    
    <a href="{{url('test-series')}}"><img  src="{{ asset('asset_rumbok/new/images/Test-series-program-banner-design-min.jpg') }}" alt="" class="lazy img-fluid lazy"></a></li>
    @else                                    
    <a href="{{url('test-series-login')}}"><img  src="{{ asset('asset_rumbok/new/images/Test-series-program-banner-design-min.jpg') }}" alt="" class="lazy img-fluid lazy"></a>
    @endif
    @endauth
    @guest
    <a href="{{url('test-series-login')}}"><img  src="{{ asset('asset_rumbok/new/images/Test-series-program-banner-design-min.jpg') }}" alt="" class="lazy img-fluid lazy"></a>
    @endguest

    </div>
</section>
@endif
@endif
<?php
    $categories = \App\Model\Category::with('child')->where('is_free_study', 1)->Published()->get();
    $catId = array();
    if($categories->count()>0)
    {
        foreach ($categories as $item) {
            $catId = array_merge($catId, [$item->id]);
            if($item->child->count()>0){
                foreach ($item->child as $child) {
                    $catId = array_merge($catId, [$child->id]);
                }
            }
        }
    }
    $courses = \App\Model\Course::Published()->whereIn('category_id', $catId)->latest()->take(3)->get();
?>

@if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->study_for_free==1)
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
@endif
@endif
    

    <!--======================================
            END CATEGORY AREA
    ======================================-->


    <!--======================================
            START COURSE AREA
    ======================================-->

    @if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->study_for_free==1)
    <section class="section-team mb-5">
        <div class="container">
            <div class="heading-section">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="sec-title mb-3">Top Online Instructors</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach(\App\Model\Instructor::with('courses')->whereNotIn('id',[20,3])->where('is_display','=','1')->where('is_external','0')->get()->random(4) as $instructor)
            <?php
                $liveClassDetail = \App\InstructorLiveClass::where('instructor_id',$instructor->id)->first();
                $timeTableUrl = "javascript:void(0);";
                if($liveClassDetail){
                    $timeTableUrl = url('class-time-table/'.$liveClassDetail->id);
                }
            ?>
                <!-- Start Single Person -->
                <div class="col-sm-6 col-lg-4 col-xl-3 col-6">
                    <div class="single-person">
                        <div class="person-image">
                            @if($instructor->image)     
                            <img  class="lazy" src="{{filePath($instructor->image)}}" alt="{{$instructor->name}}">
                            @else
                            <img class="lazy" src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="image" />
                            @endif
                        </div>
                        <div class="person-info text-center">
                            <h3 class="full-name">{{$instructor->name}}</h3>
                            @if(isset($instructor->heighst_qualification) && $instructor->heighst_qualification!='')
                                <span class="speciality d-block">{{$instructor->heighst_qualification}}</span>
                            @endif
                            @if(isset($instructor->total_experience) && $instructor->total_experience!='')
                                <span class="badge badge-info">{{$instructor->total_experience}}</span><br>
                            @endif
							<a href="{{$timeTableUrl}}" class="bisylms-btn-6">View Profile</a>
                        </div>
                    </div>
                    
                </div>
                <!-- / End Single Person -->
            @endforeach
        
            </div>
            <div class="clearfix text-center mt-4">
                <div class="d-block">
                    <a href="{{route('all.instructors')}}" class="bisylms-btn-5">View All</a>
                </div>
            </div>
        </div>
    </section>
@endif
@endif
 <!--======================================
            START Career Promo
    ======================================-->


    @if(count($govjobs) >0)
          <!-- Pricing Start -->
        <section class="pricing-section bg-light mb-5">
            <div class="container">
                <div class="heading-section">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2 class="sec-title mb-3">Government Jobs</h2>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel owl-theme job-slides">
                    @foreach($govjobs as $govjobsval)
                    <div class="item">
                        <div class="job-slide w-100">
                            
                            
                            <a href="{{url('job-notification')}}">
                            <h3 class="page-title">{{ Str::limit($govjobsval->title,250) }}</h3>
                            </a> 
                            <div class="job-listing-date-time">
                                <span class="job-listing-date"><i class="icon_calendar"></i> {{ $govjobsval->created_at }}</span>
                            </div>
                        
                        </div>
                    </div>
                    @endforeach
                   <!-- // fdgdfgf -->
                    
                    <div class="item">
                        <div class="job-slide w-100 h-100">                  
                            <div class="clearfix w-100 d-flex justify-content-center pt-4">
                                <a href="{{url('job-notification')}}" class="bisylms-btn-5">View All</a>
                            </div>                        
                        </div>
                    </div>      
                </div>
            </div>
        </section>
        <!-- Pricing End -->
@endif






@if(count($rumbokCareerPromos) >0)
<!-- Special Banners Start -->
<section class="special-banners">
    <div class="container">
        <div class="special-slides owl-carousel">
            @foreach($rumbokCareerPromos as $rumbokCareerPromo)
            <div class="special-item rounded overflow-hidden">
                @if(!empty($rumbokCareerPromo->url))
                 <a href="{{url($rumbokCareerPromo->url)}}"><img class="lazy" src="{{ asset('storage/'.$rumbokCareerPromo->image)}}" alt="{{ $rumbokCareerPromo->name }}" /></a>
                @else
                    <img class="lazy" src="{{ asset('storage/'.$rumbokCareerPromo->image)}}" alt="{{ $rumbokCareerPromo->name }} " />
                @endif
            </div>
            @endforeach
           
        </div>
    </div>
</section>
@endif


    <!--======================================
           START SUBSCRIPTION AREA
   ======================================-->
    @if (subscriptionActive())
        <section class="package-area section--padding">
            <div class="container">
                <div class="row">

                    @foreach ($subscriptions as $subscription)
                        <div class="col-lg-4 column-td-half">
                            <div class="package-item package-item-active">

                                @if ($subscription->popular == true)
                                    <div class="package-tooltip">
                                        <span class="package__tooltip">@translate(Recommended)</span>
                                    </div><!-- end package-tooltip -->
                                @endif

                                <div class="package-title text-center">
                                    <h3 class="package__price"><span>{{ formatPrice($subscription->price) }}</span></h3>
                                    <h3 class="package__title">{{ $subscription->name }}</h3>
                                </div><!-- end package-title -->

                                <ul class="list-items margin-bottom-35px">
                                    @foreach (json_decode($subscription->description) as $item)
                                        <li><i class="la la-check"></i> {{ $item }}</li>
                                    @endforeach
                                </ul>

                                <div class="btn-box">
                                    <a href="{{ route('subscription.frontend', $subscription->duration) }}"
                                       class="theme-btn">{{ App\SubscriptionCourse::where('subscription_duration','LIKE','%'.$subscription->duration.'%')->count() }}
                                        Courses</a>
                                    <form action="{{ route('subscription.cart') }}" method="get">
                                        @csrf

                                        <input type="hidden" value="{{ $subscription->duration }}"
                                               name="subscription_package">
                                        <input type="hidden" value="{{ $subscription->price }}"
                                               name="subscription_price">
                                        <input type="hidden" value="{{ $subscription->id }}" name="subscription_id">
                                        @foreach (App\SubscriptionCourse::where('subscription_duration','LIKE','%'.$subscription->duration.'%')->get() as $item)
                                            <input type="hidden" name="course_id[]" value="{{ $item->course_id }}">
                                        @endforeach

                                        @auth
                                            @if (!App\SubscriptionEnrollment::where('user_id', Auth::user()->id)->where('subscription_package', $subscription->duration)->exists())
                                                <button type="submit" class="theme-btn mt-3">@translate(choose plan)
                                                </button>
                                            @else
                                                <button type="button" disabled class="theme-btn mt-3">
                                                    @translate(Purchased)
                                                </button>
                                            @endif
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}" class="theme-btn mt-3">@translate(choose
                                                plan)</a>
                                        @endguest


                                    </form>
                                    <p class="package__meta">@translate(no hidden charges)!</p>
                                </div>

                            </div><!-- end package-item -->
                        </div><!-- end col-lg-4 -->
                    @endforeach

                </div><!-- end row -->
            </div><!-- end container -->
        </section>
    @endif

    <!--======================================
            END SUBSCRIPTION AREA
    ======================================-->

    <!-- Testimonial Start -->
    <section class="latest-updates">
            <div class="container">
                <div class="row">
                    
    @if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->what_student_says==1)
					<div class="col-lg-6 col-12">
						<div class="testimonial-section">
							<h2 class="sec-title mb-5">What Student Says?</h2>
							<div class="testimonial-slider owl-carousel">
                                @foreach($testimonials as $testimonial)
								<div class="testimonial-item h-100">
									<div class="testi-author">
                                        @if($testimonial->image)
										    <img class="lazy" src="{{ asset('storage/'.$testimonial->image) }}" alt="{{ $testimonial->name }}" />
                                        @else
                                            <img class="lazy" src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="image" />
                                        @endif
										<h5>{{ $testimonial->name }}</h5>
										<span>{{ $testimonial->type }}</span>
									</div>
									<p>
                                    {!! $testimonial->description !!}
									</p>
								</div>
                                @endforeach
								
							</div>
						</div>
                    </div>
     
    @endif
    @endif
                        
    @if($b2bconfigrationpermition)
    @if($b2bconfigrationpermition->blog_area==1)
                    <div class="col-lg-6 col-12">
                        <div class="blog-section">
							<h2 class="sec-title mb-5">Latest from the Blog</h2>
							<div class="blog-slider owl-carousel">
                            @foreach(\App\Blog::where('is_active',1)->orderBy('id','desc')->get()->take(3) as $blog)
								<div class="post-item-1 h-100">
									@if(!empty($blog->img))
                                        <a href="{{ route('blog.details',$blog->blog_slug) }}"><img class="lazy" src="{{filePath($blog->img)}}" alt="blog"></a>
                                    @endif
									<div class="b-post-details">
										<h3><a href="javascript:void(0);">{{\Illuminate\Support\Str::limit($blog->title,80)}}</h3>
										<a class="read-more" href="{{route('blog.details',$blog->blog_slug)}}">Read More<i class="arrow_right"></i></a>
									</div>
								</div>
                            @endforeach
								
							</div>
						</div>
                    </div>
        
    @endif
    @endif
                </div>
            </div>
        </section>
        <!-- Testimonial End -->

<section class="sitemap-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-9">
                <div class="sitemap-section-content">
                    <h4>Having Trouble in</h4>
                    <h5>Accessing Content?</h5>
                </div>
            </div>
            <div class="col-md-3">
                <a class="explore-more" href="{{url('sitemap')}}">
                    <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                    </span>
                    <span class="button-text">Explore Sitemap</span>
                </a>
            </div>
        </div>
    </div>
</section>
    <?php /*?>

    @if(env('BLOG_ACTIVE') === "YES")
    <!-- News Section Starts -->
    <section class="blog-section padding-top-80 padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>@translate(latest from)<span>@translate( the blog)</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(\App\Blog::where('is_active',1)->orderBy('id')->get()->take(3) as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-single-item">
                        @if($blog->img != null)
                        <div class="single-blog-image">
                            <a href="{{route('blog.details',$blog->id)}}"><img src="{{filePath($blog->img)}}" alt="blog"></a>
                        </div>
                        @endif
                        <div class="blog-meta">
                            <ul>
                                <li><a href="#!"><i class="fa fa-contao"></i>{{$blog->category->name}}</a></li>
                                {{-- <li><a href="#!"><i class="fa fa-tags"></i>@foreach(json_decode($blog->tags) as $tag){{$tag}},@endforeach</a></li> --}}
                            </ul>
                        </div>
                        <div class="single-blog-content">
                            <h5 class="title"><a href="{{route('blog.details',$blog->id)}}">{{\Illuminate\Support\Str::limit($blog->title,80)}}</a></h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-button text-center margin-top-20">
                        <a href="{{route('blog.all')}}" class="template-button">@translate(see more blogs)</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <?php */?>

    
<!-- <div class="sidebar-contact" id="dynamic">
        <div class="toggle"></div>
        <div class="text-center pb-3">
         <h4 class="font-weight-normal">One to one<span><span class="text-danger text-uppercase font-weight-bold"> Live</span> Tuition</span><br><span class="h5">For All Subjects</span></h4>
         <a href="https://olexpert.org.in/live-tuition" class="join-now-btn-purple">BOOK NOW</a>
        </div>
</div> -->
<script>
@if (\Session::has('msgpermisiondenie'))
    myFunction123();
@endif

function myFunction123() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
@endsection



