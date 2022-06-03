@extends('rumbok.app')
@section('content')

  <!--======================================
          START breadcrumb AREA
  ======================================-->
<style>
  
.card-body{
    background: rgb(192 98 98 / 5%) !important;
}
.accordion-wrapper .card .card-body {
    padding: 0;
    border: 1px solid #ddd;
    background-color:#fff !important;
}
.header-section-backend .header-left .header-title h5 {
    color: #1a6c7e;
}
.accordion-wrapper .card + .card {
    margin-top: 8px;
}
.main-header .header-logo img {
    width: 80%;
}
.embed-responsive .embed-responsive-item, .embed-responsive embed, .embed-responsive iframe, .embed-responsive object, .embed-responsive video {
    height: 100% !important;
}
.course-item-list-accordion .card-header .btn:after {
    display:none;
}
.btn-vsm {
    padding: 2px 5px !important;
    line-height: 1;
    color: #fff !important;
    font-size: 12px;
}
.top-0 {
    top:0 !important;
}
.course-video-tab .tab ul li {
    margin-right:-5px;
}
.btn-vsm {
    padding: 2px 5px !important;
    line-height: 1;
    color: #fff !important;
    font-size: 12px;
}

.card-test {
  padding: auto;
  text-align: center;
  background: #fff;
  border-radius: 10px;
  box-shadow: 25px 25px 50px #e3e3e36b, -25px -25px 50px #e3e3e3ad;
  margin-bottom:0px;
}
.card-test .card__content {
  width: 100%;
  background: #fff;
  margin: 10px auto;
  border-radius: 5px;
  padding: 20px;
  cursor: pointer;
  box-shadow: 16px 16px 44px #e3e3e366, -16px -16px 44px #e3e3e3;
  transition: 0.3s all ease-in-out;
}
.card-test .card__content:hover {
  margin-top: -10px;
}
.card-test .card__header {
  text-transform: uppercase;
  font-size: 20px;
  margin: 10px auto;
}
.card-test .card__button {
  padding: 10px;
  border-radius: 50px;
  background: #1f75c4;
  color: white;
  font-weight: bold;
  cursor: pointer;
  border: none;
  margin: 10px auto;
}
.btn-rounded {
    border-radius: 50px;
}
.card-test-footer {
    border-top: 1px solid #ddd;
    padding-top: 15px;
    margin-left: -20px;
    margin-right: -20px;
}
.btn-success {
    color: #fff;
    background-color: #28a745 !important;
    border-color: #28a745 !important;
}
.job-tab .nav-tabs {
	margin-bottom: 60px;
	border-bottom: 0;
}
.job-tab .nav-tabs>li {
	float: none;
	display: inline;
}
.job-tab .nav-tabs li {
	margin-right: 8px;
}

.job-tab .nav-tabs li:last-child {
	margin-right: 0;
}

.job-tab .nav-tabs {
	position: relative;
	z-index: 1;
	display: inline-block;
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
.job-tab .nav-tabs>li a.active>:focus, 
.job-tab .nav-tabs>li>a.active:hover,
.job-tab .nav-tabs>li>a:hover {
	box-shadow: rgb(0 0 0 / 20%) 0 2px 4px 3px, rgb(0 0 0 / 14%) 0 4px 7px 3px, rgb(0 0 0 / 12%) 0 1px 10px 3px;
}
.job-tab .nav-tabs>li.active>a.active {
    background-color:#e86a2f;
}
.sidepanel-lesson  {
    width: 0;
    position: fixed;
    z-index: 1051;
    height: 100%;
    top: 0;
    right: -20px;
    overflow-x: hidden;
    transition: 0.5s;
    background: #fff;
    padding-top: 10px;
    padding-left: 10px;
    padding-right: 10px;
}
.sidepanel-lesson .closebtn {
  position: absolute;
  top: 22px;
  right: 25px;
  font-size: 36px;
}

.openbtn {
    font-size: 14px;
    cursor: pointer;
    background-color: #111;
    color: white;
    padding: 5px 15px;
    border: none;
    display: block;
    width: 100%;
}

.openbtn:hover {
  background-color:#444;
}
.nav-tabs::-webkit-scrollbar {
    display: none; /*Safari and Chrome*/
}
.single-course-video:last-child {
    border: none;
    margin-bottom: 0 !important;
}
.single-course-video {
    border-bottom: 1px solid #ddd;
    padding:0 5px;
}
.single-course-video:nth-child(odd) {
    background:#fafafa;
}
.single-course-video:nth-child(even) {
    background:#fff;
}
a.badgemm {
    width: 75px;
    z-index: 2;
    top: -24px;
    background: #e86a2f;
    color: #fff;
    text-align: center;
    padding: 2px 5px;
    border-radius: 10px;
    text-transform: uppercase;
    left: 0;
    font-size: 9px;
}
.video-playlist-sidebar .accordion-wrapper .card .card-header a {
    font-size:12px;
    color: #000;
}
.video-playlist-sidebar .accordion-wrapper .card .card-header a:after {
    right:12px;
}
.accordion-wrapper .card .card-header span.colapsed {
    display: flex;
    font-size: 13px;
    font-weight: 500;
    line-height: 16px;
    font-family: "Poppins", sans-serif;
    background-color: transparent;
    color: #374a5e;
    border: 1px solid #eaeaea;
    border-radius: 5px;
    padding: 14px 24px;
    cursor: pointer;
    position: relative;
    text-transform: capitalize;
}
.accordion-wrapper .card .card-header span.collapsed[aria-expanded="false"]:after {
    content: "\f107" !important;
    font-family: 'Font Awesome 5 Pro';
}
.accordion-wrapper .card .card-header span.colapsed:after {
    content: "\f106" !important;
    font-family: 'Font Awesome 5 Pro';
}
.accordion-wrapper .card .card-header span.colapsed:after {
    position: absolute;
    right: 24px;
    top: 15px;
    font-weight: 700;
}
.title-adjust {
    max-width:90%;
    display:inline-block;
    text-align:left;
}
@media (max-width:767px) {
    .title-adjust {
        max-width:62%;
    }
    .card-test .card__content {
        padding:5px 5px;
    }
    .card-test .card__header {
    text-transform: uppercase;
    font-size: 10px;
    margin: 5px auto;
}
.card__info p {
    margin-bottom:5px;
}
.card__info a.btn.btn-primary {
    font-size: 12px;
    padding: 5px;
    line-height:1;
}
.card-test-footer {
    border-top: 1px solid #ddd;
    padding-top: 3px;
    margin-left: -5px;
    margin-right: -5px;
}
.card-test-footer a.btn.btn-outline-dark.btn-rounded {
    font-size: 12px;
    padding: 3px 5px;
    line-height:1;
}
.card__info button.btn.btn-primary.btn-sm {
    font-size: 12px;
    line-height: 1;
    padding: 3px 5px;
}
.accordion-wrapper .card:last-child {
    padding-bottom:70px;
}
}
.youtube-player {
    position: relative;
}
div.youtube-play-btn {
    z-index: 9;
}
.youtube-player img {
    width: 100%;
}
</style>
  <section class="heading-n-breadcrub-part mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="title-page">
                          <h1>{{$pw_single_course->title}}
                          <br>
                          @if($pw_single_course->category->parent)
                              <span style="font-size: 12px;margin-top: -4px;position:absolute">
                            {{$pw_single_course->category->parent->category_name}} {{' - '. $pw_single_course->category->category_name}}</span>
                          @else
                          <span style="font-size: 12px;margin-top: -4px;position:absolute">
                            {{ $pw_single_course->category->category_name}}</span>
                          @endif
                          </h1>
                        </div>              
                    </div>
                    <div class="col-lg-6">
                        <div class="bread-crumb-part">
                            <ul class="bread-crumb-part-list">
                                <li>
                                <a href="{{route('homepage')}}">@translate(home)</a>
                                </li>
                                <li>
                                  <span> {{'Project Work'}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
  </section>
  <!--======================================
          END breadcrumb AREA
  ======================================-->

<section class="clearfix bglight-blue custom-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <div class="pwd-heading mb-4">
            <h2 class="mb-0">
            Packages comprises of
            </h2>
        </div>
          <ul class="pwd-highlight-points">
            <li>Recorded Lectures</li>
            <li>Study Material - Pdf</li>
            <li>Webinar</li>
            <li>Assessment followed by certificate after completion of 50 %</li>
            <li>Prototype Project view of minimum duration</li>
            <li>Mentorship</li>
            <li>Submission of Project</li>
          </ul>

          <div class="buynow-btn d-flex align-items-center">
            @if(empty($enroll))
              @if($pw_single_course->is_free)
                  <span class="text-dark font-weight-normal mr-2 h5">@translate(Free)</span>
              @else
                  @if($pw_single_course->is_discount)
                  <span class="text-dark font-weight-normal mr-2 h5">{{formatPrice($pw_single_course->discount_price)}}<span>(Excl all taxes)</span></span>
                  <span class="text-dark font-weight-normal mr-2 h5">{{formatPrice($pw_single_course->price)}}<span>(Excl all taxes)</span></span>
                  @else
                  <span class="text-dark font-weight-normal mr-2 h5">{{formatPrice($pw_single_course->price)}}<span>(Excl all taxes)</span></span>
                  @endif
              @endif
            @endif
            @auth
                @if(Auth::user()->user_type == 'Student')
                  @if($pw_single_course->price)
                      <!--form action="#" class="enroll-form" method="post" accept-charset="utf-8" novalidate="novalidate">
                        <button name="enroll" type="submit" class="course-enroll enroll loader " data-loader-text="ENROLLING..." disabled>ENROL NOW</button>
                      </form--->
                      @if(checkProjectWorkEnrolled($pw_single_course->id,\Illuminate\Support\Facades\Auth::user()->id))
                        <a href="{{ route('project_work_lesson_details',$pw_single_course->slug) }}">Go For Project Work <i class="ti-arrow-right"></i></a>
                      @else
                        {{-- PAYUMONEY PAYMENT GATEWAY --}}
                        <form action="{{route('initiate.payment')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
                            <input type="hidden" id="udf1" name="udf1" value="project_work" />
                            <input type="hidden" id="udf2" name="udf2" value="{{$pw_single_course->id}}" />
                            <input type="hidden" id="hashurl" name="hashurl" value="{{url('resources/views/addon/setup/payumoney/index.php')}}" />
                            <input type="hidden" id="surl" name="surl" value="{{route('payumoney.payment')}}" />
                            <input type="hidden" id="key" name="key" value="SWX8LxLC" />{{-- CaertTiG,Uuio8LHKPl --}}
                            <input type="hidden" id="salt" name="salt" value="cXhuLZsI4t" />
                            <input type="hidden" id="txnid" name="txnid" value="{{ strtotime('now') }}" />
                            <input type="hidden" id="amount" name="amount" value="{{ StripePrice($pw_single_course->price) }}">
                            <input type="hidden" id="pinfo" name="pinfo" value="cart_payment" />
                            <input type="hidden" id="fname" name="fname" value="{{ Auth::user()->name }}" />
                            <input type="hidden" id="email" name="email" value="{{ Auth::user()->alternate_email_user }}" />
                            <input type="hidden" id="mobile" name="mobile" value="{{ Auth::user()->email }}" />
                            <input type="hidden" id="hash" name="hash" value="" />
                            
                            <button name="enroll" type="submit" class="enroll-active" data-loader-text="ENROLLING...">ENROLL NOW</button>
                              <!--input type="submit" class="btn btn-primary" value="Pay" /-->
                            
                        </form>
                        {{-- END PAYUMONEY PAYMENT GATEWAY --}}
                      @endif
                    
                  @else
                      <a class="course-enroll enroll loader disabled-btn" href="#!" data-toggle="Wait for price updates" >ENROLL NOW</a>
                  @endif
                  
                @else
                  <a class="enroll-active" href="{{route('login')}}" >ENROLL NOW</a>
                @endif
              @endauth
              @guest
                  <a class="enroll-active" href="{{route('login')}}" >ENROLL NOW</a>
              @endguest
          </div>
      </div>
      <div class="col-md-5">
        @if($pw_single_course->overview_url!='')
        @php
           $splitOverviewUrl = str_replace("https://www.youtube.com/embed/","",$pw_single_course->overview_url);
        @endphp
          <div class="pwd-demo-video">
            <div class="demo-video-thumb">
              <div class="youtube-container">
                <div class="youtube-player" data-id="{{$splitOverviewUrl}}"></div>
              </div>
            </div>
          </div>
        @else
        <div class="pwd-demo-video">
          <div class="demo-video-thumb">
            <img src="https://olexpert.org.in/public/uploads/media_manager/158.jpg" class="img-fluid"/>
          </div>
          <div class="demo-video-icon">
            <a href=""><i class="fa fa-play"></i></a>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>
<section class="clearfix">
  <div class="container">
      <div id="boxHere"></div>
      <div class="tabs-scroll sticky-pw"  id="boxThis">
        <div class="container">
          <nav id="navbar-example2" class="navbar navbar-light bg-white">
            <ul class="nav nav-pills" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#home">Overview</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu1">Recorded Lectures</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu2">Study Material</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu3">Prototype Project Report</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu4">Webinar</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu5">Mentorship</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu6">Submission of Project</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      {{--
      <div class="row my-4">
        <div class="col-md-3 mb-3">
          <div class="card h-100">
           <div class="card-body">
              <div class="progress-circle" data-percentage="50">
                <svg class="progress-circle__svg" viewport="0 0 2000 2000">
                  <circle class="progress-circle__stroke" r="50%" cx="50%" cy="50%"></circle>
                  <circle class="progress-circle__stroke" r="50%" cx="50%" cy="50%"></circle>
                </svg>
                <!-- For Demo Only -->
                <input value="50" type="number" min="0" max="100" maxlength="3" class="circle-bar">
              </div>
              <div class="heading-pbl-block">Completed</div>
              <div class="pbl-block-action"><small>&nbsp;</small></div>
           </div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card h-100">
           <div class="card-body">
             <div class="pbl-block-icon">
               <img src="{{asset('asset_rumbok/new/images/assessment.png')}}" alt=""/>
             </div>
             <div class="heading-pbl-block">Assessment</div>
             <div class="pbl-block-action">
               <a href="#" class="cta">
                 <span class="hover-underline-animation"> Take assessment </span>
                  <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                    <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
                  </svg>
               </a>
             </div>
           </div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
        <div class="card h-100">
           <div class="card-body">
             <div class="pbl-block-icon">
                <img src="{{asset('asset_rumbok/new/images/project-report.png')}}" alt=""/>
             </div>
             <div class="heading-pbl-block">Prototype Project Report</div>
             <div class="pbl-block-action">
               <a href="#" class="cta">
                 <span class="hover-underline-animation"> Download </span>
                  <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                    <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
                  </svg>
               </a>
            </div>
           </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
        <div class="card h-100">
           <div class="card-body">
             <div class="pbl-block-icon">
              <img src="{{asset('asset_rumbok/new/images/submit-project.png')}}" alt=""/>
             </div>
             <div class="heading-pbl-block">Project Submission</div>
             <div class="pbl-block-action">
               <a href="#" class="cta">
                 <span class="hover-underline-animation"> Submit Project </span>
                  <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                    <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
                  </svg>
               </a>
             </div>
           </div>
          </div>
        </div>
      </div>
      --}}
      <div class="row">
        <div class="col-md-12">
          <!-- Tab panes -->
          <div class="tab-content mt-3">
              <div id="home" class="tab-pane active">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="my-2">Overview</h4>
                    <p class="text-justify">{!! $pw_single_course->short_description !!}</p>
                    <p class="text-justify">{!! $pw_single_course->big_description !!}</p>
                  </div>
                </div>
              </div>
              @php $i=1; @endphp
              @forelse ($pw_single_course->classes as $item)
                <div id="menu{{$i}}" class="tab-pane fade">
                  <section class="course-video-section padding-bottom-110">
                    <div class="curriculum-accordion margin-top-30">
                      <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="heading-{{ $item->id }}">
                              <a href="#" role="button" data-toggle="collapse" data-target="#collapse-{{ $item->id }}" aria-expanded="false" aria-controls="collapse-{{ $item->id }}" class="colapsed d-flex align-items-center px-1 pr-4">
                                <span style="display:inline-block;max-width:95%;font-weight: 500;color: #000;padding-left: 10px;">{{ $item->title }}</span>
                                <span class="mr-3 ml-auto">{{ $item->contents->count() }} @translate(lectures)</span></a>
                            </div>
                            <div id="collapse-{{ $item->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                              <div class="card-body">
                              @forelse ($item->contents as $content)
                                                      
                                @if ($content->is_preview == 1)
                                <div class="single-course-video border-bottom mb-2 pb-1 d-flex">
                                    <a href="javascript:void(0)"
                                        class="button-video v-small"
                                        onclick="forModal('{{ route('content.video.preview', $content->id) }}', '{{$content->title}}')">
                                        <i class="fa fa-play-circle mr-2"></i>{{ $content->title }}
                                    </a>
                                    <div class="property-course ml-auto">
                                        <span class="badge badge-success">@translate(Preview)</span>
                                        <span>{{duration($content->duration)}}</span>
                                    </div>
                                </div>
                                @else
                                <div class="single-course-video border-bottom mb-2 pb-1 d-flex">
                                    <a class="button-video v-small" href="javascript:void(0)">
                                        @if($content->content_type == 'Video')
                                            <i class="fa fa-play-circle mr-2"></i>
                                        @elseif($content->content_type == 'Document')
                                            <i class="fa fa-file-pdf mr-2"></i>
                                        @else
                                            <i class="fa fa-play-circle mr-2"></i>
                                        @endif
                                        {{ $content->title }}
                                    </a>
                                    <div class="property-course ml-auto">
                                        <span class="locked"><a href="javascript:void(0)">@translate(Locked)</a></span>
                                        <span>{{duration($content->duration)}}</span>
                                    </div>
                                </div>
                                @endif                                                               
                                  
                              @empty
                                  @translate(NO content)
                              @endforelse
                                  
                              @php $i++; @endphp 
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              @empty
                @translate(No Items)
              @endforelse 
              
              <div id="menu4" class="tab-pane fade"><br>
                <div class="row">
                  @forelse($pw_single_course->webinar as $webinar)
                  <div class="col-md-4">
                   <div class="youtube-webinar-box">
                    <div class="youtube-container disabled">
                    @php
                    $splitRecordedUrl = str_replace("https://www.youtube.com/embed/","",$webinar->webinarDetail->recorded_video_url);
                  @endphp
                      <img src="https://img.youtube.com/vi/{{$splitRecordedUrl}}/hqdefault.jpg" class="w-100">
                    </div>
                      <div class="youtube-webinar-content">
                        <h4>{{$webinar->webinarDetail->topic}}</h4>
                        <div class="d-flex align-items-center">
                          <p class="text-muted small">Start Date: {{frontendDateShow($webinar->webinarDetail->start_date)}}</p>
                          <p class="text-muted small ml-auto">End Date : {{frontendDateShow($webinar->webinarDetail->end_date)}}</p>
                        </div>
                      </div>
                   </div>
                  </div>
                  @empty
                   <!-- <div class="youtube-container">
                      <div class="youtube-player" data-id="6jDKtHsACak"></div>
                    </div> -->
                    <div class="col-md-12">
                      No Webinar is available.
                    </div>
                  @endforelse
                </div>

              
              </div>
              <!-- <div id="menu4" class="container tab-pane fade"><br>
                <h3>Menu 4</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
              </div> -->
              <div id="menu5" class="container tab-pane fade"><br>
                <div class="row blur-content">
                  <div class="col-md-3">
                  <img class="img-fluid" src="https://olexpert.org.in/public/uploads/instructor/TTtjyGdBbC9ZjcpRuxBR1SJhTX6HyFCe2kEzE5wz.png">
                  </div>
                  <div class="col-md-9">
                  <div class="pmp-content"> 
                            <h3> PMP Course Advisor</h3> 
                            <div class=""> 
                              <div class="pmp-adv-profile"> 
                                        <h6>Peter Taylor </h6> 
                                        <span class="adv-title">
                                          VP, Global PMO at Ceridian, Bestselling Author &amp; Keynote Speaker
                                          <span> 
                                            <div class="para">
                                              <p>Author of the #1 bestselling project management book, 'The Lazy Project Manager', Peter is one of the most prominent speakers, trainers, consultants, and coaches in the Project Management domain globally, bringing on board over 30 years of experience.</p>
                                            </div> 
                                          </span>
                                        </span>
                              </div>
                            </div>
                            
                    </div>
                  </div>
                </div>
              </div>
              <div id="menu6" class="container tab-pane fade"><br>
                <h3></h3>
                <p></p>
              </div>
             
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="buynow-btn d-flex align-items-center">
             @if(empty($enroll))   
                @if($pw_single_course->is_free)
                  <span class="text-dark font-weight-normal mr-2 h5">@translate(Free)</span>
                @else
                    @if($pw_single_course->is_discount)
                    <span class="text-dark font-weight-normal mr-2 h5">{{formatPrice($pw_single_course->discount_price)}}<span>(Excl all taxes)</span></span>
                    <span class="text-dark font-weight-normal mr-2 h5">{{formatPrice($pw_single_course->price)}}<span>(Excl all taxes)</span></span>
                    @else
                    <span class="text-dark font-weight-normal mr-2 h5">{{formatPrice($pw_single_course->price)}}<span>(Excl all taxes)</span></span>
                    @endif
                @endif
              @endif
              @auth
                @if(Auth::user()->user_type == 'Student')
                  @if($pw_single_course->price)
                      <!--form action="#" class="enroll-form" method="post" accept-charset="utf-8" novalidate="novalidate">
                        <button name="enroll" type="submit" class="course-enroll enroll loader " data-loader-text="ENROLLING..." disabled>ENROL NOW</button>
                      </form--->
                      @if(checkProjectWorkEnrolled($pw_single_course->id,\Illuminate\Support\Facades\Auth::user()->id))
                        <a href="{{ route('project_work_lesson_details',$pw_single_course->slug) }}">Go For Project Work <i class="ti-arrow-right"></i></a>
                      @else
                        {{-- PAYUMONEY PAYMENT GATEWAY --}}
                        <form action="{{route('initiate.payment')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
                            <input type="hidden" id="udf1" name="udf1" value="project_work" />
                            <input type="hidden" id="udf2" name="udf2" value="{{$pw_single_course->id}}" />
                            <input type="hidden" id="hashurl" name="hashurl" value="{{url('resources/views/addon/setup/payumoney/index.php')}}" />
                            <input type="hidden" id="surl" name="surl" value="{{route('payumoney.payment')}}" />
                            <input type="hidden" id="key" name="key" value="SWX8LxLC" />{{-- CaertTiG,Uuio8LHKPl --}}
                            <input type="hidden" id="salt" name="salt" value="cXhuLZsI4t" />
                            <input type="hidden" id="txnid" name="txnid" value="{{ strtotime('now') }}" />
                            <input type="hidden" id="amount" name="amount" value="{{ StripePrice($pw_single_course->price) }}">
                            <input type="hidden" id="pinfo" name="pinfo" value="cart_payment" />
                            <input type="hidden" id="fname" name="fname" value="{{ Auth::user()->name }}" />
                            <input type="hidden" id="email" name="email" value="{{ Auth::user()->alternate_email_user }}" />
                            <input type="hidden" id="mobile" name="mobile" value="{{ Auth::user()->email }}" />
                            <input type="hidden" id="hash" name="hash" value="" />
                            
                            <button name="enroll" type="submit" class="enroll-active" data-loader-text="ENROLLING...">ENROLL NOW</button>
                              <!--input type="submit" class="btn btn-primary" value="Pay" /-->
                            
                        </form>
                        {{-- END PAYUMONEY PAYMENT GATEWAY --}}
                      @endif
                    
                  @else
                      <a class="course-enroll enroll loader disabled-btn" href="#!" >ENROLL NOW</a>
                  @endif
                  
                @else
                  <a class="enroll-active" href="{{route('login')}}" >ENROLL NOW</a>
                @endif
              @endauth
              @guest
                  <a class="enroll-active" href="{{route('login')}}" >ENROLL NOW</a>
              @endguest
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  
</section>

@endsection
