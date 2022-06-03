@extends('rumbok.app')

@section('content')

<style>
    
.header-search1 form input {
    border: 1px solid #fad2a9;
    border-radius: 10px;
    width: 100%;
}

.header-search1 form button {
    color: #ffffff;
    background-color: #ffa02b;
    border: 0px 10px 10px 0px;
    padding: 12px 20px;
    border-radius: 0px 10px 10px 0px;
    position: absolute;
    bottom: 0px;
    right: 0px;
    border: none;
     margin: 20px 1px 76px -12px;
}
.job-tab ul.nav.nav-tabs {
    overflow-x: auto;
    white-space: nowrap;
    display: flex !important;
    flex-direction: row;
    flex-wrap: nowrap;
    border-bottom: 0;
    padding: 15px 0;
    margin-bottom: 10px;
}
.job-tab .nav-tabs {
    position: relative;
    z-index: 1;
}
.job-tab .nav-tabs li {
    margin-right: 8px;
}
.job-tab .nav-tabs>li {
    float: none;
    display: inline;
}
.job-tab .nav-tabs>li.active>a.active {
    background-color: #e86a2f;
}
.job-tab .nav-tabs>li a {
    align-items: center;
    appearance: none;
    border-radius: 4px;
    border-style: none;
    box-shadow: rgb(0 0 0 / 20%) 0 3px 1px -2px, rgb(0 0 0 / 14%) 0 2px 2px 0, rgb(0 0 0 / 12%) 0 1px 5px 0;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-flex;
    font-family: Roboto,sans-serif;
    font-size: .875rem;
    font-weight: 500;
    height: 36px;
    justify-content: center;
    letter-spacing: .0892857em;
    line-height: normal;
    min-width: 64px;
    outline: none;
    overflow: visible;
    padding: 0 10px;
    position: relative;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1);
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    will-change: transform,opacity;
    background-color: #253a73;
}
.job-tab .nav-tabs>li>a.active {
    background-color: #e86a2f;
}

.date-card {
  position: relative;
  width: 100%;
  height: 130px;
  transform-style: preserve-3d;
  transform: rotatey(0deg) translatex(0px) translatey(0px);
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.4);
  margin: 5px;
  cursor: pointer;
  margin-bottom: 20px;
}
.date-card .front-facing {
    transform: rotateY(
0deg) translateZ(2px);
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    border: 2px white solid;
    border-radius: 5px;
}
.bg-date-card-0 .front-facing {
    background: #ffc107;
}
.bg-date-card-1 .front-facing {
    background: #ffc107;
}
.bg-date-card-2 .front-facing {
    background: #fc3359;
}
.bg-date-card-3 .front-facing {
    background: #007bb6;
}
.bg-date-card-4 .front-facing {
    background: #00aced;
}
.bg-date-card-5 .front-facing {
    background: #3f51b5;
}
.bg-date-card-6 .front-facing {
	background: #9c27b0;
}
.bg-date-card-7 .front-facing {
	background: #4caf50;
}
.bg-date-card-8 .front-facing {
    background: #009688;
}
.date-card .front-facing .abr {
    width: 100%;
    position: absolute;
    top: 50%;
    left: 0;
    font-size: 42px;
    margin: -45px 0 0 0;
    text-align: center;
    color: #ffffff;
    line-height: 1;
}
.date-card .front-facing .title {
	width: 100%;
    position: absolute;
    top: 50%;
    left: 0;
    text-transform: uppercase;
    font-size: 18px;
    margin: -5px 0 0 0;
    text-align: center;
    color: #ffffff;
}
.date-card .front-facing .atomic-number {
	position: absolute;
    top: 10px;
    left: 10px;
    font-size: 16px;
    color: #e86a2f;
    background: #ffffff;
    line-height: 1;
    border-radius: 4px;
    padding: 8px 8px;
    box-shadow: 5px 5px 18px 4px rgb(0 0 0 / 20%);
}
.date-card .front-facing .atomic-mass {
	position: absolute;
    bottom: 10px;
    right: 10px;
    font-size: 12px;
    border: 1px solid #fff;
    color: #ffffff;
    padding: 5px 12px;
    line-height: 1;
    border-radius: 20px;
}
.d-column {
    display: table-cell;
    vertical-align: middle !important;
}
span.count-block {
    display: inline-block;
    width: 25px;
    height: 25px;
    background: #efefef;
    border-radius: 50%;
    text-align: center;
    line-height: 25px;
    margin-right: 10px;
}
</style>
    {{--new design--}}

    <!-- Breadcrumb Section Starts -->
    <section class="heading-n-breadcrub-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
				<div class="d-flex align-items-center">
                            <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                            <div class="title-page">
							<h1>Current Affairs</h1>
                            </div>
                    </div>          
                </div>
                <div class="col-lg-6">
                    <div class="bread-crumb-part">
                        <ul class="bread-crumb-part-list">
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <span>Current Affairs</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Course Category Section Starts -->
    <section class="course-category-section padding-top-30 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="job-tab">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a class="active" href="#daily" aria-controls="hot-jobs" role="tab" data-toggle="tab" aria-selected="true">Daily</a>
                                        </li>
                                       {{-- <li>
                                            <a href="#weekly" aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false">Weekly</a>
                                        </li>
                                        <li>
                                            <a href="#monthly" aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false">Monthly</a>
                                        </li>    --}}                            
                                    </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade overview-content show active" id="daily">
							<div class="row">
								<?php
					$color = array('danger'=>'danger','primary'=>'primary','secondary'=>'secondary','success'=>'success','warning'=>'warning','info'=>'info');
								?>
								@if($courses->count() > 0)
									@foreach($courses as $item)
									<div class="col-md-12">
										<div class="clearfix border overflow-hidden shadow-sm mb-2">
										<div class="row no-gutter">
											<div class="col-md-3 bg-{{array_rand($color)}}">
												<div class="clearfix text-center py-2 text-center h-100 ">
													<div class="d-table w-100 h-100">
											        <div class="d-column">
    													<h2 class="text-white mb-0 font-weight-normal">
															{{date("d M",strtotime($item->course_date))}}
														</h2>
														<h1 class="text-white mb-0">
														{{date("Y",strtotime($item->course_date))}}
														</h1>
											        </div>
											    </div>
												</div>
											</div>
											<div class="col-md-9 bg-white">
												<div class="clearfix px-2 py-2 pr-4">
													<div class="clearfix">
														<ul class="list-group list-group-flush small">
														@php
$gettittle  =   \App\Course::where('content_type','current_affairs')->whereNull('deleted_at')->where('course_date',$item->course_date)->select('title','slug')->get();		
$ii = 1;				
@endphp	
@foreach($gettittle as $itemaa)
														<li class="list-group-item d-flex align-items-center py-1">
															<span class="count-block">{{ $ii }}</span> {{ $itemaa->title }}
															@auth
															<a href="{{route('show.current_affairs.detail',$itemaa->slug)}}" class="text-info ml-auto">View</a>
															@endauth
															@guest
															<a href="{{route('login')}}" class="text-info ml-auto">View</a>
															@endguest
														</li>
														@php
$ii++;
@endphp													  	
@endforeach

														</ul>
													
													</div>
												</div>
											</div>

										</div>
									</div>
											
								</div>
									@endforeach
								@endif
							</div>
							<div class="row">
								<div class="col-12">
									<div class="template-pagination margin-top-20">
									{{ $courses->links() }}
									</div>
								</div>
            				</div>
                        </div>
                        <div class="tab-pane fade overview-content" id="weekly">
							<div class="row">
								<div class="col-md-3">
									<div class="date-card bg-date-card-1">
										<div class="front-facing">
											<h1 class="abr">15</h1>
											<p class="title">August 2021</p>
											<span class="atomic-number"><i class="fa fa-calendar"></i></span>
											<a href="#" class="atomic-mass">View</a>
										</div>
										
									</div>
								</div>
								<div class="col-md-3">
									<div class="date-card bg-date-card-2">
										<div class="front-facing">
											<h1 class="abr">15</h1>
											<p class="title">August 2021</p>
											<span class="atomic-number"><i class="fa fa-calendar"></i></span>
											<a href="#" class="atomic-mass">View</a>
										</div>
										
									</div>
								</div>
								<div class="col-md-3">
									<div class="date-card bg-date-card-3">
										<div class="front-facing">
											<h1 class="abr">15</h1>
											<p class="title">August 2021</p>
											<span class="atomic-number"><i class="fa fa-calendar"></i></span>
											<a href="#" class="atomic-mass">View</a>
										</div>
										
									</div>
								</div>
								<div class="col-md-3">
									<div class="date-card bg-date-card-4">
										<div class="front-facing">
											<h1 class="abr">15</h1>
											<p class="title">August 2021</p>
											<span class="atomic-number"><i class="fa fa-calendar"></i></span>
											<a href="#" class="atomic-mass">View</a>
										</div>
										
									</div>
								</div>
								<div class="col-md-3">
									<div class="date-card bg-date-card-5">
										<div class="front-facing">
											<h1 class="abr">15</h1>
											<p class="title">August 2021</p>
											<span class="atomic-number"><i class="fa fa-calendar"></i></span>
											<a href="#" class="atomic-mass">View</a>
										</div>
										
									</div>
								</div>
								<div class="col-md-3">
									<div class="date-card bg-date-card-6">
										<div class="front-facing">
											<h1 class="abr">15</h1>
											<p class="title">August 2021</p>
											<span class="atomic-number"><i class="fa fa-calendar"></i></span>
											<a href="#" class="atomic-mass">View</a>
										</div>
										
									</div>
								</div>
								<div class="col-md-3">
									<div class="date-card bg-date-card-7">
										<div class="front-facing">
											<h1 class="abr">15</h1>
											<p class="title">August 2021</p>
											<span class="atomic-number"><i class="fa fa-calendar"></i></span>
											<a href="#" class="atomic-mass">View</a>
										</div>
										
									</div>
								</div>
								<div class="col-md-3">
									<div class="date-card bg-date-card-8">
										<div class="front-facing">
											<h1 class="abr">15</h1>
											<p class="title">August 2021</p>
											<span class="atomic-number"><i class="fa fa-calendar"></i></span>
											<a href="#" class="atomic-mass">View</a>
										</div>
										
									</div>
								</div>
							</div>
                        </div>
                        <div class="tab-pane fade overview-content"  id="monthly">
							<div class="row">
									<div class="col-md-3">
										<div class="date-card bg-date-card-1">
											<div class="front-facing">
												<h1 class="abr">15</h1>
												<p class="title">August 2021</p>
												<span class="atomic-number"><i class="fa fa-calendar"></i></span>
												<a href="#" class="atomic-mass">View</a>
											</div>
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="date-card bg-date-card-2">
											<div class="front-facing">
												<h1 class="abr">15</h1>
												<p class="title">August 2021</p>
												<span class="atomic-number"><i class="fa fa-calendar"></i></span>
												<a href="#" class="atomic-mass">View</a>
											</div>
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="date-card bg-date-card-3">
											<div class="front-facing">
												<h1 class="abr">15</h1>
												<p class="title">August 2021</p>
												<span class="atomic-number"><i class="fa fa-calendar"></i></span>
												<a href="#" class="atomic-mass">View</a>
											</div>
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="date-card bg-date-card-4">
											<div class="front-facing">
												<h1 class="abr">15</h1>
												<p class="title">August 2021</p>
												<span class="atomic-number"><i class="fa fa-calendar"></i></span>
												<a href="#" class="atomic-mass">View</a>
											</div>
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="date-card bg-date-card-5">
											<div class="front-facing">
												<h1 class="abr">15</h1>
												<p class="title">August 2021</p>
												<span class="atomic-number"><i class="fa fa-calendar"></i></span>
												<a href="#" class="atomic-mass">View</a>
											</div>
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="date-card bg-date-card-6">
											<div class="front-facing">
												<h1 class="abr">15</h1>
												<p class="title">August 2021</p>
												<span class="atomic-number"><i class="fa fa-calendar"></i></span>
												<a href="#" class="atomic-mass">View</a>
											</div>
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="date-card bg-date-card-7">
											<div class="front-facing">
												<h1 class="abr">15</h1>
												<p class="title">August 2021</p>
												<span class="atomic-number"><i class="fa fa-calendar"></i></span>
												<a href="#" class="atomic-mass">View</a>
											</div>
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="date-card bg-date-card-8">
											<div class="front-facing">
												<h1 class="abr">15</h1>
												<p class="title">August 2021</p>
												<span class="atomic-number"><i class="fa fa-calendar"></i></span>
												<a href="#" class="atomic-mass">View</a>
											</div>
											
										</div>
									</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
    </section>
@endsection




