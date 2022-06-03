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
                          <?php 
                          //echo "<pre>";print_r($pw_single_course->category->category_name);
                          ?>
                          <h1>{{$pw_single_course->title}} <br />
                          
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
  @if (Session::has('message'))
      <div class="alert alert-success text-center">{{ Session::get('message') }}</div>
  @endif
  @php $seenPer = \App\Http\Controllers\ProjectWorkController::seenCourse($enroll->id,$pw_single_course->id); @endphp
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
      
      <div class="row my-4">
        <div class="col-md-3 mb-3">
          <div class="card h-100">
           <div class="card-body">
             
              <div class="progress-circle" data-percentage="{{$seenPer}}">
                <svg class="progress-circle__svg" viewport="0 0 2000 2000">
                  <circle class="progress-circle__stroke" r="50%" cx="50%" cy="50%"></circle>
                  <circle class="progress-circle__stroke" r="50%" cx="50%" cy="50%"></circle>
                </svg>
                <!-- For Demo Only -->
                <input value="{{$seenPer}}%" type="text" min="0" max="100" maxlength="4" class="circle-bar">
              </div>
              <div class="heading-pbl-block">Completed </div>
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
               @if($seenPer>=50)
               <a href="#menu7" data-toggle="pill" class="cta">
                 <span class="hover-underline-animation"> Take assessment </span>
                  <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                    <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
                  </svg>
               </a>
              @else
              
                 <span class="hover-underline-animation"> Assessment will be enable after completing 50% of course </span>
                  
               
              @endif
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
               <a href="#menu6" data-toggle="pill" class="cta">
                 <span class="hover-underline-animation"> Submit Project </span>
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
             <span class="text-right">
                        <a href="#" data-toggle="modal" data-target="#myModal">View demo certificate</a>
              </span>
             <div class="pbl-block-icon">
                <img src="{{asset('asset_rumbok/new/images/certificate-bnw.png')}}" alt=""/>
             </div>
             <div class="heading-pbl-block">Certificate</div>
             <div class="pbl-block-action">
               <a href="#"  class="cta">
                 <span class="hover-underline-animation"> Download </span>
                  <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                    <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
                  </svg>
               </a>
            </div>
           </div>
          </div>
        </div>
      </div>
      
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
              @php $userPassed = false; @endphp
              @foreach ($pw_single_course->classes as $item)
                <div id="menu{{$i}}" class="tab-pane fade">
                  <section class="course-video-section padding-bottom-110">
                      
                      <div class="row d-md-block d-lg-none d-sm-block d-xl-none">
                        <div class="col-12"><button class="openbtn" onclick="openLesson()">☰ Select Chapter</button></div>
                      </div>
                      <div id="mySidepanellesson" class="sidepanel-lesson">
                          <a href="javascript:void(0)" class="closebtn" onclick="closeLesson()">×</a>
                          <div class="video-playlist-sidebar">
                              <h4>{{$item->title}}</h4>
                              <div class="curriculum-accordion margin-top-30">
                                <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                    
                                    <div class="card">
                                      <div class="card-header" id="heading-{{ $item->id }}">
                                          <a href="#" role="button" data-toggle="collapse" data-target="#collapse-{{ $item->id }}" aria-expanded="false" aria-controls="collapse-{{ $item->id }}" class="colapsed rounded-0 px-1"><span style="max-width:230px;display:inline-block;">{{ $item->title }} </span></a>
                                      </div>
                                     
                                      <div id="collapse-{{ $item->id }}" class="collapse show" aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                          <div class="card-body">
                                          @forelse ($item->contents as $content)
                                            <div class="single-course-video pb-1 d-block" onclick="contentData('{{ $content->id }}')">
                                             
                                                <input type="hidden" id="contentVideoUrl-{{$content->id}}" value="{{route('project_work.class.content',$content->id)}}">
                                                <div class="row">
                                                  <div class="col-8 text-left">
                                                      <a href="#" class="button-video line-height-1 text-left small pl-2" onclick="closeLesson()">
                                                      <i class="fa fa-play-circle mr-2"></i>
                                                      {{$content->title}} ({{ $item->contents->count() }})
                                                      </a>
                                                  </div>
                                                  <div class="col-4 text-right">
                                                      <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                  </div>
                                                </div>
                                              
                                                
                                            </div>
                                          @endforeach
                                            
                                          </div>
                                         
                                      </div>
                                    </div>
                                  
                                </div>
                              </div>
                          </div>
                      </div>
                      <p>{{-- 'If a person is loged in' --}}</p>
                      <div class="row">
                        <div class="col-lg-8">
                              {{-- <div class="top-assement-link ">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                          <h6 class="mb-0">Completed <span class="badge badge-success">10%</span></h6>
                                        </div>
                                        <div class="col-md-6 text-right">
                                          <div class="d-flex float-right align-items-center">
                                              <button class="ready-to-take">
                                                  <div>
                                                    <span>
                                                      <p>Take Assessment</p>
                                                    </span>
                                                  </div>
                                                  <div>
                                                    <span>
                                                      <p>Sorry </p> <p> <i class="fa fa-thumbs-down"></i></p>
                                                    </span>
                                                  </div>
                                              </button>
                                          </div>
                                        </div>
                                    </div>
                              </div> --}}
                              <div class="course-video-part mt-2 videoId" id="">
                                  @if (isset($pw_single_course->overview_url))
                                      @if ($pw_single_course->provider === "Youtube")
                                          <iframe class="embed-responsive-item"
                                                  src="{{ Str::after($pw_single_course->overview_url,'https://youtu.be/') }}"
                                                  frameborder="0"
                                                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                  allowfullscreen></iframe>
                                      @elseif($pw_single_course->provider === "Vimeo")
                                          <iframe class="embed-responsive-item" 
                                                  src="https://player.vimeo.com/video/{{ Str::after($pw_single_course->overview_url,'https://vimeo.com/') }}"
                                                  frameborder="0" allow="autoplay; fullscreen"
                                                  allowfullscreen></iframe>
                                      @elseif($pw_single_course->provider === "HTML5")
                                          <video controls crossorigin playsinline id="player">
                                              <source src="{{$pw_single_course->overview_url}}"
                                                      type="video/mp4" size="100%"/>
                                          </video>
                                      @else
                                          <div class="">
                                              <h1>@translate(No video found)</h1>
                                          </div>
                                      @endif

                                  @endif
                              </div>

                              <!-- <div class="progress-status">
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="clearfix p-2 border border-warning bg-warning rounded text-center">
                                      <h6 class="mb-0 text-white">00:22:00</h6>
                                      <p class="mb-0 text-white text-uppercase">Total time</p>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="clearfix p-2 border border-danger bg-danger rounded text-center">
                                      <h6 class="mb-0 text-white">00:22:00</h6>
                                      <p class="mb-0 text-white text-uppercase">Time left</p>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="clearfix p-2 border border-success bg-success rounded text-center">
                                      <h6 class="mb-0 text-white">00:22:00</h6>
                                      <p class="mb-0 text-white text-uppercase">Time spent</p>
                                    </div>
                                  </div>
                                </div>
                                
                              </div> -->
                            
                        </div>
                        <div class="col-lg-4">
                            <div class="video-playlist-sidebar d-none d-lg-block d-xl-block">
                              <h4>{{$item->title}}</h4>
                              <div class="curriculum-accordion margin-top-30">
                                  <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                  
                                    <div class="card">
                                        <div class="card-header" id="heading-{{ $item->id }}">
                                          <a href="#" role="button" data-toggle="collapse" data-target="#collapse-{{ $item->id }}" aria-expanded="false" aria-controls="collapse-{{ $item->id }}" class="colapsed rounded-0 px-1"><span style="max-width:230px;display:inline-block;">{{ $content->title }} ({{ $item->contents->count() }})</span></a>
                                        </div>
                                        <div id="collapse-{{ $item->id }}" class="collapse" aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                          <div class="card-body">
                                            @forelse ($item->contents as $content)
                                              <div class="single-course-video pb-1 d-block" onclick="contentData('{{ $content->id }}')">
                                            
                                                  <input type="hidden" id="contentVideoUrl-{{$content->id}}" value="{{route('project_work.class.content',$content->id)}}">
                                                  <div class="row">
                                                      <div class="col-8 text-left">
                                                        <a href="javascript:void(0);" class="button-video line-height-1 text-left v-small pl-2" >
                                                        <i class="fa fa-play-circle mr-2"></i>
                                                        {{ $content->title }} 
                                                        </a>
                                                      </div>
                                                      <div class="col-4 text-right">
                                                        <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                      </div>
                                                  </div>
                                                
                                              </div>
                                            @endforeach
                                              
                                          </div>
                                        </div>
                                    </div>
                                    
                                  </div>
                              </div>
                            </div>
                        </div>
                      </div>
                  
                  </section>
                </div>
                @php $i++; @endphp
              @endforeach
              
              <div id="menu4" class="tab-pane fade"><br>
                <div class="row">
                  @forelse($pw_single_course->webinar as $webinar)
                  @php
                  $splitRecordedUrl = '';
                  if($webinar->webinarDetail){
                    $splitRecordedUrl = str_replace("https://www.youtube.com/embed/","",$webinar->webinarDetail->recorded_video_url);
                  }
                  @endphp
                  <div class="col-md-4">
                      <div class="youtube-webinar-box">
                        <div class="youtube-container">
                        <div class="youtube-player" data-id="{{$splitRecordedUrl}}"></div>
                        </div>
                        <div class="youtube-webinar-content">
                          <h4>{{(isset($webinar->webinarDetail))?$webinar->webinarDetail->topic:''}}</h4>
                          <?php //echo "<pre>";print_r($webinar->webinarDetail->recorded_video_url);?>
                          <div class="d-flex align-items-center">
                            <p class="text-muted small">Start Date: {{(isset($webinar->webinarDetail))?frontendDateShow($webinar->webinarDetail->start_date):''}}</p>
                            <p class="text-muted small ml-auto">End Date : {{(isset($webinar->webinarDetail))?frontendDateShow($webinar->webinarDetail->end_date):''}}</p>
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
                <div class="row">
                  <div class="col-md-3">
                    <img class="img-fluid" src="{{ filePath($pw_single_course->mentor->photo) }}">
                  </div>
                  <div class="col-md-9">
                  <div class="pmp-content"> 
                            <h3> {{ isset($pw_single_course->mentor)?$pw_single_course->mentor->profile_title:''}}</h3> 
                            <div class=""> 
                              <div class="pmp-adv-profile"> 
                               
                                        <h6>{{ isset($pw_single_course->mentor)?$pw_single_course->mentor->name:''}}</h6> 
                                        <span class="adv-title">
                                            {{ isset($pw_single_course->mentor)?$pw_single_course->mentor->experience:''}}
                                          <span> 
                                            <div class="para">
                                              <p>{!! isset($pw_single_course->mentor)?$pw_single_course->mentor->profile_desc:'' !!}</p>
                                            </div> 
                                          </span>
                                        </span>
                              </div>
                            </div>
                            
                    </div>
                  </div>
                </div>
              </div>
              <div id="menu7" class="container tab-pane fade">

                                <div class="row">
                                  
                                  @if($mockTests->count() > 0)
                                  @foreach($mockTests as $mockTest)
                                  <div class="col-lg-4 col-6">
                                      <div class="card-test">
                                          <div class="card__content">
                                              <h3 class="card__header">{{ $mockTest->name }}- Mock Test</h3>
                                              <div class="card__info">
                                                @php 
                                                  $mockTestAttended = \App\MockTestEnrollment::where(['test_type' => 'mockTest','test_status' => 'finish','user_id' => Auth::id(),'mock_test_id' => $mockTest->id ,'package_id' => $pw_single_course->id])->get();
                                                  
                                                  $totalMockTestAttend = $mockTestAttended->count();
                                                
                                                $enrollIdForReport = 0;
                                               @endphp
                                               @if($totalMockTestAttend != 0)
                                                @foreach($mockTestAttended as $att)
                                                    @php 
                                                    $studentTestQuestions = \App\MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $att->id , 'user_id' => $att->user_id])->get();
                                                      $getTotalMarks = getTotalMarks($att->id ,$pw_single_course->id);
                                                      $newPercentage = ($getTotalMarks / $studentTestQuestions->count()) * 100 ; 
                                                      if($newPercentage>=60){
                                                        $userPassed = true;
                                                        $enrollIdForReport = $att->mock_test_id;
                                                        //echo "<pre>";print_r($att);
                                                      }
                                                    @endphp
                                                    
                                                  @endforeach
                                                @endif

                                                @if($totalMockTestAttend >=2 || $userPassed)
                                               
                                                <p> <span class="badge bg-warning text-dark">No. of attemps - {{ $totalMockTestAttend }}/2</span>    </p> 
                                                @if($userPassed)
                                                <h4 class="d-flex align-items-center">
                                                  <span class="badge bg-success text-white font-weight-normal">Passed</span>
                                                  <a href="{{ route('pw-mock-test-package' ,[$pw_single_course->id, $enrollIdForReport]) }}" class="ml-auto v-small font-weight-normal"><u>View Report</u></a>
                                                
                                                </h4>
                                                @elseif($totalMockTestAttend >=2)
                                                <h3><span class="badge bg-danger text-white">Failed</span></h3>
                                                @endif
                                                @else
                                                <p><span class="badge bg-warning text-dark">No. of attemps - {{$totalMockTestAttend}}/2</span></p>   
                                                <p class="small">Only 2 attempts are allowed, please be carefull.</p>               
                                                <p class="mb-0"><a href="{{ route('pw-mock-test-detail',[$pw_single_course->id , $mockTest->id]) }}" class="btn btn-primary btn-block">Attempt</a></p>
                                                @endif
                                              
                                              </div>
                                             
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
                                  @else
                                    Error occurred 5093 ! 
                                  @endif
                                               
                                </div>
                
              </div>
              <div id="menu6" class="container tab-pane fade">
                  <div class="row">
                    <div class="col-lg-12">
                    <div class="card-test shadow-none">
                      <div class="card__content shadow-none pt-0 mt-0">
                      <h3 class="card__header">Submission of Project</h3>
                        <div class="card__info">
                        @if($userPassed)
                        <div class="row">
                          <div class="col-md-4 offset-md-4">
                            <div class="clearfix my-2 p-3 bg-light border">
                              <form action="{{ route('projectwork.store') }}" method="POST" enctype="multipart/form-data">
                                         <div class="form-group">
                                          @csrf      
                                          <input type="file" name="file_name" class="small w-100" accept=".doc,.docx,.excel">
                                          <input type="hidden" name="projectWorkId" value="{{$pw_single_course->id}}" class="form-control">
                                          @error('file_name')
                                              <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror
                                         </div>
                                          <button type="submit" class="btn btn-success btn-block">Upload</button>                
                              </form>
                            </div>
                          </div>
                        </div>
                        
                              
                        @else
                        
                        <span class="text-danger"><strong>Note*:</strong> You are allowed to submit Project Report only after successfull completion of Project work assessment.</span>

                        @endif
                        </div>
                      </div>
                    </div>
                        
                       
                    </div> 
                  </div>
                
                @if(!empty($enroll->submitted_on_date))
                <table class="table table-bordered table-sm small">
                  <thead class="bg-light">
                    <tr>
                      <th>Project File</th>
                      <th>Submitted On</th>
                      <th>Reviewed By</th>
                      <th>Reviewed On</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="{{filePath('project_work/'.$enroll->submitted_report_file)}}">Download File</a></td>
                      <td>{{($enroll->submitted_on_date!='')?frontendDateShow($enroll->submitted_on_date):'N/A'}}</td>
                      <td>{{($enroll->reviewed_by!='')?$enroll->reviewed_by:'N/A'}}</td>
                      <td>{{($enroll->reviewed_date!='')?frontendDateShow($enroll->reviewed_date):'N/A'}}</td>
                      <td>{{($enroll->status=='1')?'Submitted':'N/A'}}</td>
                    </tr>
                  </tbody>
                </table>
                @endif
              </div>

              
             
          </div>
         
        </div>
      </div>
  </div>
  
</section>

@endsection
@section('js')
<script>
function openLesson() {
  document.getElementById("mySidepanellesson").style.width = "300px";
  document.getElementById("mySidepanellesson").style.right = "0";
}

function closeLesson() {
  document.getElementById("mySidepanellesson").style.width = "0";
  document.getElementById("mySidepanellesson").style.right = "-20px";
}
</script>
<?php /*?>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            (function () {
                var countdown, init_countdown, set_countdown;
        
                if ({{ $time_left }} != 0) {
                    countdown = init_countdown = function () {
                        countdown = new FlipClock($('.countdown'), {
                            clockFace: 'MinuteCounter',
                            language: 'en',
                            autoStart: false,
                            countdown: true,
                            showSeconds: true,
                            callbacks: {
                                start: function () {
                                    
                                    
                                    var url = $('#quizStartUrl').val();
                                    var course_id = $('#course_id').val();
                                    
                                    $.ajax({
                                        url: url,
                                        method: 'POST',
                                        data: {course_id: course_id},
                                        success: function (result) {
                                            console.log('starting quiz saved in database');
                                        }
                                    })
                                    
                                    return console.log('The clock has started!');
                                },
                                stop: function () {
                                    
                                    //$('#regForm').submit();
                                    return console.log('The clock has stopped!');
                                },
                                interval: function () {
                                    
                                    var time;
                                    time = this.factory.getTime().time;
                                    if (time%120 == 0) {
                                        var url = $('#quizUpdateUrl').val();
                                        var course_id = $('#course_id').val();
                                        var time_left = time/60;
                                        
                                        $.ajax({
                                            url: url,
                                            method: 'POST',
                                            data: {course_id: course_id, time_left: time_left},
                                            success: function (result) {
                                                console.log('quiz time updated in database');
                                            }
                                        })
                                        return console.log('Clock interval', time);
                                    }
                                }
                            }
                        });
            
            
                        return countdown;
                    };
        
                    set_countdown = function (minutes, start) {
                        var elapsed, end, left_secs, now, seconds;
                        if (countdown.running) {
                            return;
                        }
                        seconds = minutes * 60;
                        now = new Date();
                        start = new Date(start);
                        end = start.getTime() + seconds * 1000;
                        left_secs = Math.round((end - now.getTime()) / 1000);
                        elapsed = false;
                        if (left_secs < 0) {
                            left_secs *= -1;
                            elapsed = true;
                        }
                        countdown.setTime(left_secs);
                        return countdown.start();
                    };
            
                    init_countdown();
            
                    set_countdown({{ $time_left }}, new Date());
                    // set_countdown({{ $s_course->min_course_time }}, new Date());
                }
        
            }).call(this);
        
        });
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            commenting();
            seenContend();
            // console.clear();

        });
    
    </script>
    
 <?php */ ?>  
    
    <script type="text/javascript">
        "use strict"
       
     
        

        $('#comment_form').on('submit', function (e) {
            e.preventDefault();
            commenting();

        });


        //published the all checkbox
        $('input[type="checkbox"]').change(function () {
            var url = this.dataset.url;
            if (url != null) {
              alert(url);
                $.ajax({
                    url: url,
                    method: 'get',
                    success: function (result) {
                        console.log(result);
                    },
                });
            }

        });


        /*for commenting*/
        function commenting() {
            var comment = $('#comment').val();
            var url = $('#commentSaveUrl').val();
            var course_id = $('#course_id').val();

            $.ajax({
                url: url,
                method: 'POST',
                data: {course_id: course_id, comment: comment},
                success: function (result) {
                    $('#comments').empty();
                    result.data.forEach(function (item, index) {

                        document.getElementById("comments").innerHTML += '<li>\n' +
                            '                                                            <div class="comment">\n' +
                            '                                                                <div class="comment-avatar">\n' +
                            '                                                                    <img class="avatar__img" alt="" src="' + item.image + '">\n' +
                            '                                                                </div>\n' +
                            '                                                                <div class="comment-body">\n' +
                            '                                                                    <div class="meta-data d-flex align-items-center justify-content-between">\n' +
                            '                                                                        <div class="question-meta-content">\n' +
                            '                                                                            <a href="javascript:void(0)">\n' +
                            '                                                                                <h3 class="comment__author">' + item.name + '</h3>\n' +
                            '                                                                                <p class="comment-content">' + item.comment + '</p>\n' +
                            '                                                                            </a>\n' +
                            '                                                                        </div>\n' +
                            '                                                                    </div>\n' +
                            '                                                                    <p class="comment__meta">\n' +
                            '                                                                        <span>' + item.time + '</span>\n' +
                            '                                                                    </p>\n' +
                            '                                                                </div>\n' +
                            '                                                            </div>\n' +
                            '                                                        </li>';
                    })
                }
            })
            $('#comment').val('');
        }

        /**/

        function showPreview(url, provider) {
            $('.videoId').empty();
            if (provider == "Youtube") {
                playYoutube(url)
            } else if (provider == "Vimeo") {
                playVimeo(url)
            } else if (provider == "HTML5") {
                playHtml(url)
            } else if (provider == "File") {
                playFile(url)
            } else if (provider == "Live") {
                liveClass(url)
            } else if (provider == "Quiz") {
                quizView(url)
            }
        }

        /*get content data*/
        function contentData(id) {
            var url = $('#contentVideoUrl-' + id).val();
            //alert(id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (result) {
                    console.log(result);
                    $('.videoId').empty();
                    $('.course-content').empty();
                    if (result.provider == "Youtube") {
                        playYoutube(result.url)
                    } else if (result.provider == "Vimeo") {
                        playVimeo(result.url)
                    } else if (result.provider == "HTML5") {
                        playHtml(result.url)
                    } else if (result.provider == "File") {
                        playFile(result.url)
                    } else if (result.provider == "Live") {
                        liveClass(result.url)
                    } else if (result.provider == "Quiz") {
                        quizView(result.url)
                    } else {
                        playDoc(result.url, result.item1, result.item2, result.description)
                    }
                    $('.course-content').append(result.description);
                    seenContend();
                }
            });
        }

        /*quiz*/
        function quizView(url) {
            $('.videoId').append('  <iframe  ' +
                '                                        src="' + url + '"\n' +
                '                                        frameborder="0"\n' +
                '                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"\n' +
                '                                        allowfullscreen></iframe>');
        }

        /*for youtube*/
        function playYoutube(data) {
            $('.videoId').append('  <iframe' +
                '                                        src="' + data + '"\n' +
                '                                        frameborder="0"\n' +
                '                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"\n' +
                '                                        allowfullscreen></iframe>');
        }

        /*for vimeo video*/
        function playVimeo(data) {
            $('.videoId').append(' <iframe\n' +
                '            src="https://player.vimeo.com/video/' + data + '"\n' +
                '             frameborder="0" allow="autoplay; fullscreen"\n' +
                '            allowfullscreen></iframe>');
        }

        /*for Html5 video*/
        // function playHtml(data) {
        //     $('.videoId').append(' <video controls crossorigin playsinline id="player" class="html-video-frame" src="' + data + '"></video>');
        // }
        function playHtml(data) {
            $('.videoId').append(' <iframe' +
                '                                        src="' + data + '"\n' +
                '                                        frameborder="0"\n' +
                '                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"\n' +
                '                                        allowfullscreen></iframe>');
        }

        /*for Html5 video*/
        function playFile(data) {
            $('.videoId').append(' <video controls crossorigin playsinline id="player" class="html-video-frame" src="' + data + '"></video>');
        }

        /*for Live Class video*/
        function liveClass(data) {
            $('.videoId').append('<a href="' + data + '" target="_blank" class="float-play-icon" title="Live Class URL"><img src="{{ filePath('live.jpg') }}" class="w-100" alt="#Liveclass"><span class="as-play-icon"><i class="fa fa-video-camera m-auto" aria-hidden="true"></i></span></a>');
        }

        /*fot document*/
        // function playDoc(data, item1, item2, description) {

        //     $('.videoId').append('<div class="card text-center document-height w-100">\n' +
        //         '  <div class="card-header">' + item1 + '  </div>\n' +
        //         '  <div class="card-body">\n' +
        //         '  <p class="card-body">' + description + '</p>\n' +
        //         '    <a href="' + data + '" class="btn btn-success btn-lg fa fa-download" target="_blank">  ' + item2 + '</a>\n' +
        //         '  </p>\n' +
        //         '</div>');
        // }
        function playDoc(data, item1, item2, description) {
            var dUrl = '';
            var isPdf = false;
            if(item2!=''){
            dUrl = '    <a href="' + data + '" class="btn btn-success btn-lg fa fa-download" target="_blank">  ' + item2 + '</a>\n' ;
            console.log(data);
                var splitArr = data.split(/\.(?=[^\.]+$)/);
                console.log(splitArr);
                if(splitArr[1].toLowerCase() == 'pdf'){
                    isPdf = true;
                }
            }

            if(isPdf){
                $('.videoId').append('<div class="card text-center w-100">\n' +                
                '  <div class="card-body">\n' +
                '  <iframe src="'+data+'" style="width:100%;" title="'+item2+'"></iframe>\n' +
                
                '  </div>\n' +
                '</div>');                
            }else{
                $('.videoId').append('<div class="card text-center w-100">\n' +
                '  <div class="card-header">' + item1 + '  </div>\n' +
                '  <div class="card-body">\n' +
                '  <p class="card-body">' + description + '</p>\n' +
                dUrl+
                '  </p>\n' +
                '</div>');
            }
            
        }

        /*seen content checked*/
        function seenContend() {
            var url = $('#seenList').val();
            if (url != null) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (result) {
                        result.forEach(function (item, index) {
                            $("#chb-" + item.content_id).prop("checked", true);
                        })
                    }
                })
            }
        }

        $(window).on('load', function () {
            $('.count_down').click();
        });


        function myFunction(expire_date, id) {

            var expire_date = expire_date;
            // Set the date we're counting down to
            var countDownDate = new Date(expire_date).getTime();

            // Update the count down every 1 second
            var x = setInterval(function () {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById(id).innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";

                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(id).innerHTML = "EXPIRED";
                }
            }, 1000);
        }
        $(document).on("click", ".cta", function () {
          $(".cta").removeClass('active');
          $(this).addClass('active');
    });
    </script>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <button type="button" class="close position-absolute" data-dismiss="modal" style=" top: -10px; right: -10px;    z-index: 2;    background: #000; opacity: 1; text-shadow: none; color: #fff; width: 30px; height: 30px; border-radius: 50%;">×</button>
        <!-- Modal Header -->
        
        
        <!-- Modal body -->
        <div class="modal-body">
            <img src="{{ asset('asset_rumbok/new/images/ole-certificate.jpg') }}" class="img-fluid" alt="OLExpert Demo Certificate">
        </div>
        
       
        
      </div>
    </div>
  </div>
@endsection