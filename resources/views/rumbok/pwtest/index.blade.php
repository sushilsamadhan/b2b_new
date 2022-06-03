@extends('rumbok.app')
@section('content')
<style>
.section-title h2 span {
    color: #f4791e;
}
</style>

    <!--================================
         START SLIDER AREA
=================================-->
<!-- Hero Banner Start -->
    <section class="hero-banner-2">
        <div class="home-slides owl-carousel">
            @foreach($rumbokSliders as $rumbokSlider)
            <div class="home-slides-item">
                <img src="{{ asset('storage/'.$rumbokSlider->image)}}" alt="{{ $rumbokSlider->name }}" />
            </div>
            @endforeach
        </div>
    </section>

    <!-- Feature Section Starts -->
    <section class="feature-section">
        <div class="container">
            <div class="row">
                @php
                    $color = array('learning-content.png','faq.png','future-ready.png');
                    $i = 0;
                @endphp
                @foreach(\App\KnowAbout::where('align','top')->get()->take(3) as $topContent)

                <div class="col-lg-4 col-md-8 col-10 stretch-card">
                    <div class="feature-item">
                        <img src="{{asset('asset_rumbok/new/images/features').'/'.$color[$loop->index++]}}" alt="{{$topContent->title}}" />
                        <h4>{{$topContent->title}}</h4>
                        <p>{{$topContent->desc}}.</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--================================
            END SLIDER AREA
    =================================-->

<!-- Special Banners Start -->
<section class="special-banners">
    <div class="container">
        <div class="special-slides owl-carousel">
            @foreach($rumbokMiddleSliders as $rumbokMiddleSlider)
            <div class="special-item">
                <img src="{{ asset('storage/'.$rumbokMiddleSlider->image)}}" alt="{{ $rumbokMiddleSlider->name }}" />
            </div>
            @endforeach
           
        </div>
    </div>
</section>
		<!-- Special Banners End -->

    <!--======================================
                START CATEGORY AREA
        ======================================-->

<!-- How We Function Start -->
<section class="how-we-function">
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
                                <image src="{{asset('asset_rumbok/new/images').'/'.$color[$loop->index++]}}" />
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
</section>
        <!-- How We Function End -->

    <!-- Category Section Starts -->

   <!-- Free Live Course Start -->
		<section>
            @foreach($rumbokBanners as $rumbokBanner)
			<div class="container">
				<a href="{{ route('get-live-class')}}"><img src="{{ asset('storage/'.$rumbokBanner->image)}}" alt="{{ $rumbokBanner->name }}" class="img-fluid d-md-block d-none"></a>
              <a href="{{ route('get-live-class')}}">  <img src="{{ asset('asset_rumbok/new/images/live-classes-small.jpg') }}" class="img-fluid d-block d-md-none d-lg-none"></a>
			</div>
            @endforeach
		</section>
		<!-- Free Live Course End -->

<?php
    $packageDataBoards = \App\PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
    ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
    ->leftjoin('courses as c','c.id','=','package_settings.course_id')
    ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title')
    ->where('package_settings.package_type','=','board')
    ->orderBy('id', 'DESC')->take(3)->get();
?>
    

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
                                <li><i class="icon_check"></i>Access to 45 courses</li>
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
							<div class="align-items-center justify-content-between border-top pt-2">
                                <div class="d-block">
                                    <a href="{{route('packages.preview_board',$data->id)}}" class="bisylms-btn-2 d-block">View Details</a>
                                </div>
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

        <?php
    $packageDataComp = \App\PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
    ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
    ->leftjoin('courses as c','c.id','=','package_settings.course_id')
    ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title')
    ->where('package_settings.package_type','=','competitive-courses')
    ->orderBy('id', 'DESC')->take(3)->get();
?>
    
@if(count($packageDataComp) >0)
          <!-- Pricing Start -->
        <section class="pricing-section">
            <div class="container">
				<div class="heading-section">
					<div class="row">
						<div class="col-md-12 text-center">
							<h2 class="sec-title mb-3">Comptetive Classes</h2>
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
								<img src="{{ filePath($data->pkg_image) }}" alt="{{ $data->pkg_name }}"/>	
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
                                <li><i class="icon_check"></i>Access to 45 courses</li>
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
							<div class="d-flex align-items-center justify-content-between border-top pt-2">
                                <div class="d-block">
                                    <a href="{{route('packages.preview_board',$data->id)}}" class="bisylms-btn-2">View Details</a>
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
    <!--======================================
            END CATEGORY AREA
    ======================================-->


    <!--======================================
            START COURSE AREA
    ======================================-->

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
            @foreach(\App\Model\Instructor::with('courses')->whereNotIn('id',[20,3])->get()->random(4) as $instructor)
            <?php
                $liveClassDetail = \App\InstructorLiveClass::where('instructor_id',$instructor->id)->first();
                $timeTableUrl = "javascript:void(0);";
                if($liveClassDetail){
                    $timeTableUrl = url('class-time-table/'.$liveClassDetail->id);
                }
            ?>
                <!-- Start Single Person -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            @if($instructor->image)     
                            <img src="{{filePath($instructor->image)}}" alt="{{$instructor->name}}">
                            @else
                            <img src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="" />
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
					<div class="col-lg-6 col-12">
						<div class="testimonial-section">
							<h2 class="sec-title mb-5">What Student Says?</h2>
							<div class="testimonial-slider owl-carousel">
                                @foreach($testimonials as $testimonial)
								<div class="testimonial-item">
									<div class="testi-author">
                                        @if($testimonial->image)
										    <img src="{{ asset('storage/'.$testimonial->image) }}" alt="" />
                                        @else
                                            <img src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="" />
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
                    <div class="col-lg-6 col-12">
                        <div class="blog-section">
							<h2 class="sec-title mb-5">Latest from the Blog</h2>
							<div class="blog-slider owl-carousel">
                            @foreach(\App\Blog::where('is_active',1)->orderBy('id','desc')->get()->take(3) as $blog)
								<div class="post-item-1">
									@if(!empty($blog->img))
                                        <a href="{{ route('blog.details',$blog->blog_slug) }}"><img src="{{filePath($blog->img)}}" alt="blog"></a>
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
                </div>
            </div>
        </section>
        <!-- Testimonial End -->
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

    

@endsection


