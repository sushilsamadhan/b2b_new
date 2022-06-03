@extends('rumbok.app')
@section('content')

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
/* a.badgemm:after {
    position: absolute;
    width: 0px;
    height: 0px;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #e86a2f;
    content: '';
    left: 6px;
    bottom: -4px;
} */
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
</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
          <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                    <h1>{{$s_course->title}}</h1>
                <span>{{$boardName}}/{{$s_course->category->name}}</span>
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
                        <span>{{$s_course->category->name}}</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
    <section class="course-video-section padding-bottom-110">
        <div class="container">
            <div class="row d-md-block d-lg-none d-sm-block d-xl-none">
                <div class="col-12"><button class="openbtn" onclick="openLesson()">☰ Select Chapter</button></div>
            </div>
            <div id="mySidepanellesson" class="sidepanel-lesson">
            <a href="javascript:void(0)" class="closebtn" onclick="closeLesson()">×</a>
            <div class="video-playlist-sidebar">
                        @php    
                            $chkArr = explode(',',$getChapter);
                        @endphp
                        <h4>{{$s_course->title}}</h4>
                        <div class="curriculum-accordion margin-top-30">
                            <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                <input value="{{route('seen.list',$s_course->id)}}" type="hidden" id="seenList">
                            @if(count($s_course->classes)>0)
                            

                                    @foreach ($s_course->classes as $item)
                                        
                                       

                                            @if($item->contents->count()>0)
                                                @if(($package_type=='1') )
                                                    <div class="card">
                                                        <div class="card-header" id="heading-{{ $item->id }}">
                                                            <a href="#" role="button" data-toggle="collapse"
                                                            data-target="#collapse-{{ $item->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $item->id }}" class="colapsed rounded-0 px-1" ><span style="max-width:230px;display:inline-block;">{{ $item->title }}</span></a>
                                                        </div>

                                                        <div id="collapse-{{ $item->id }}"
                                                            class="collapse {{ $loop->first ? 'show' : '' }}"
                                                            aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                        
                                                                @forelse ($item->contents as $content)
                                                                
                                                                @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                                        <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                            <!-- <div class="custom-checkbox">
                                                                                <div class="custom-checkbox">
                                                                                    <label for="chb-{{$content->id}}">
                                                                                    <input type="checkbox"
                                                                                        data-url="{{route('seen.remove', $content->id)}}"
                                                                                        id="chb-{{$content->id}}">
                                                                                    </label>
                                                                                </div>
                                                                            </div> -->
                                                                            <input type="hidden"
                                                                                id="contentVideoUrl-{{$content->id}}"
                                                                                value="{{route('class.content',$content->id)}}">
                                                                                @if ($content->is_preview == 1)
                                                                                <div class="row">
                                                                                        <div class="col-8 text-left">
                                                                                            <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                            <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                <div class="row">
                                                                                        <div class="col-8 text-left">
                                                                                            <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                            @if($content->content_type == 'Video')
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @elseif($content->content_type == 'Document')
                                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                                        @else
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @endif {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>

                                                                                @endif
                                                                        
                                                                            @if (zoomActive())
                                                                                <div class="">
                                                                                    @if($content->meeting != null)
                                                                                        <p class="course-item-meta">
                                                                                            <i class="la la-video-camera"></i>
                                                                                            @translate(Meeting Id)
                                                                                            - {{$content->meeting->meeting_id}}
                                                                                        </p>
                                                                                        <p class="course-item-meta">
                                                                                            <i class="la la-calendar-check-o"></i>
                                                                                            @translate(Start Time)
                                                                                            - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                                        </p>
                                                                                        @if($content->meeting->duration != null)
                                                                                            <p class="course-item-meta">
                                                                                                <i class="la la-calendar-check-o"></i>
                                                                                                @translate(Duration)
                                                                                                - {{ $content->meeting->duration }}
                                                                                                min
                                                                                            </p>
                                                                                        @endif
                                                                                        <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                                        <a href="javascript:void(0)"
                                                                                        class="countDown d-none"
                                                                                        onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                            
                                                                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif(in_array($item->id,$chkArr))
                                                    <div class="card">
                                                        <div class="card-header" id="heading-{{ $item->id }}">
                                                            <a href="#" role="button" data-toggle="collapse"
                                                            data-target="#collapse-{{ $item->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $item->id }}" class="colapsed rounded-0 px-1" ><span style="max-width:230px;display:inline-block;">{{ $item->title }}</span></a>
                                                        </div>

                                                        <div id="collapse-{{ $item->id }}"
                                                            class="collapse {{ $loop->first ? 'show' : '' }}"
                                                            aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                        
                                                                @forelse ($item->contents as $content)
                                                                
                                                                @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                                        <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                            <!-- <div class="custom-checkbox">
                                                                                <div class="custom-checkbox">
                                                                                    <label for="chb-{{$content->id}}">
                                                                                    <input type="checkbox"
                                                                                        data-url="{{route('seen.remove', $content->id)}}"
                                                                                        id="chb-{{$content->id}}">
                                                                                    </label>
                                                                                </div>
                                                                            </div> -->
                                                                            <input type="hidden"
                                                                                id="contentVideoUrl-{{$content->id}}"
                                                                                value="{{route('class.content',$content->id)}}">
                                                                                @if ($content->is_preview == 1)
                                                                                <div class="row">
                                                                                        <div class="col-8 text-left">
                                                                                            <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                            <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                <div class="row">
                                                                                        <div class="col-8 text-left">
                                                                                            <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                            @if($content->content_type == 'Video')
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @elseif($content->content_type == 'Document')
                                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                                        @else
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @endif {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>

                                                                                @endif
                                                                        
                                                                            @if (zoomActive())
                                                                                <div class="">
                                                                                    @if($content->meeting != null)
                                                                                        <p class="course-item-meta">
                                                                                            <i class="la la-video-camera"></i>
                                                                                            @translate(Meeting Id)
                                                                                            - {{$content->meeting->meeting_id}}
                                                                                        </p>
                                                                                        <p class="course-item-meta">
                                                                                            <i class="la la-calendar-check-o"></i>
                                                                                            @translate(Start Time)
                                                                                            - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                                        </p>
                                                                                        @if($content->meeting->duration != null)
                                                                                            <p class="course-item-meta">
                                                                                                <i class="la la-calendar-check-o"></i>
                                                                                                @translate(Duration)
                                                                                                - {{ $content->meeting->duration }}
                                                                                                min
                                                                                            </p>
                                                                                        @endif
                                                                                        <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                                        <a href="javascript:void(0)"
                                                                                        class="countDown d-none"
                                                                                        onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                            
                                                                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif(!in_array($item->id,$chkArr))
                                                    <div class="card">
                                                        <div class="card-header" id="heading-{{ $item->id }}">
                                                            <a href="#" role="button" data-toggle="collapse"
                                                            data-target="#collapse-{{ $item->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $item->id }}" class="collapsed d-flex justify-content-between px-1">
                                                            <div style="max-width:180px;">{{ $item->title }} </div>
                                                            <span class="locked mr-4 v-small" title="Not available in selected package."> @translate(Upgrade) </span>
                                                            </a>
                                                        </div>

                                                        <div id="collapse-{{ $item->id }}"
                                                            class="false collapse"
                                                            aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                            
                                                                @forelse ($item->contents as $content)
                                                                        <div class="single-course-video pb-1 d-block">
                                                                            
                                                                            <input type="hidden"
                                                                                id="contentVideoUrl-{{$content->id}}"
                                                                                value="">
                                                                                @if ($content->is_preview == 1)
                                                                                <div class="row">
                                                                                        <div class="col-8">
                                                                                            <a href="#" class="button-video line-height-1 text-left v-small" onclick="closeLesson()">
                                                                                            <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                @else

                                                                                    <div class="row">
                                                                                        <div class="col-8">
                                                                                            <a href="#" class="button-video line-height-1 text-left v-small" onclick="closeLesson()">
                                                                                            @if($content->content_type == 'Video')
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @elseif($content->content_type == 'Document')
                                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                                        @else
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @endif {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>

                                                                                @endif
                                                                            
                                                                            
                                                                    
                                                                        </div>
                                                                    @endforeach
                                                            
                                                                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                               
                                            @endif 
                                           
                                    
                                    @endforeach
                                   
                               
                            @endif
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                
                <div class="col-lg-8">
                
                    <div class="course-video-part mt-2 " id="videoId">
                        @if (isset($s_course->overview_url))
                            @if ($s_course->provider === "Youtube")
                                <iframe class="embed-responsive-item"
                                        src="{{ Str::after($s_course->overview_url,'https://youtu.be/') }}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            @elseif($s_course->provider === "Vimeo")
                                <iframe class="embed-responsive-item" 
                                        src="https://player.vimeo.com/video/{{ Str::after($s_course->overview_url,'https://vimeo.com/') }}"
                                        frameborder="0" allow="autoplay; fullscreen"
                                        allowfullscreen></iframe>
                            @elseif($s_course->provider === "HTML5")
                                <video controls crossorigin playsinline id="player">
                                    <source src="{{$s_course->overview_url}}"
                                            type="video/mp4" size="100%"/>
                                </video>
                            @else
                                <div class="">
                                    <h1>@translate(No video found)</h1>
                                </div>
                            @endif

                        @endif
                    </div>

                    <div class="course-video-tab pl-0 pt-2">
                        <div class="job-tab">
                            <ul class="nav nav-tabs">
                                <!-- <li class="active">
                                    <a class="active" href="#overview" aria-controls="hot-jobs" role="tab" data-toggle="tab" aria-selected="true">@translate(overview)</a>
                                </li> -->
                                @if(env('CERTIFICATE_ACTIVE') === 'YES' && $PackageDetail != '')
                                    <li class="active">
                                        @if($PackageDetail->package_type != 'competitive-courses')
                                            <a href="#practice" class="active" aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false"> @translate(Practice Test)</a>
                                        @else
                                            <a href="#practice"  class="active"aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false"> @translate(Mock Test)</a>
                                        @endif                         
                                    </li>
                                @endif
                                <li >
                                    <a href="#mindmap" aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false">@translate(Mind Maps)</a>
                                </li>
                               
                               
                                <li >
                                    <a href="#comment" aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false">@translate(Comment)</a>
                                </li>
                               
                              
                                
                            </ul>
                            <div class="hr-line"></div>
                        </div>
                        <div class="tab-content">
                            <!-- <div class="tab-pane fade overview-content show active" id="overview">
                                <div class="video-tab-title">
                                    <h5>@translate(about this course)</h5>
                                </div>
                                <p class="margin-top-20">{!! $s_course->short_description !!}</p>

                                <div class="video-tab-title margin-top-30">
                                    <h5>@translate(by the numbers)</h5>
                                </div>
                                <div class="content-list-items margin-top-20">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> @translate(skill level) : {{ $s_course->level }}</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> @translate(lecture) : {{ $s_course->classes->count() }}</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> @translate(student) : {{\App\Model\Enrollment::where('course_id',$s_course->id)->count()}}</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> @translate(video length) :
                                                @php
                                                    $total_duration = 0;
                                                    foreach ($s_course->classes as $item){
                                                        if(isset($item->contents)){
                                                        $total_duration +=$item->contents->sum('duration');
                                                        }
                                                    }
                                                @endphp
                                                {{duration($total_duration)}}</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i>@translate(language) : {{ $s_course->language }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if(env('CERTIFICATE_ACTIVE') == 'YES')
                                    <div class="video-tab-title margin-top-30">
                                        <h5>@translate(certificate)</h5>
                                    </div>
                                    <p class="margin-top-20">@translate(Get Course certificate by completing entire course)</p>
                                @endif
                                <div class="video-tab-title margin-top-30">
                                    <h5>@translate(description)</h5>
                                </div>
                                <p class="margin-top-20"> {!! $s_course->big_description !!} </p>
                            </div> -->
                            
                            <div class="tab-pane fade overview-content" id="mindmap">
                                <div class="video-tab-title">
                                    <h5>@translate(Mind Maps)</h5>
                                </div>
                                <div class="video-playlist-sidebar " style="margin-bottom:100px;">
                                    <h4>{{$s_course->title}}</h4>
                                    <div class="curriculum-accordion margin-top-30">
                                        <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                            <input value="{{route('seen.list',$s_course->id)}}" type="hidden" id="seenList">
                    @php
                            $getCountMindMapCourse = \App\Model\MindMap::where(['course_id' => $s_course->id])->get();
                            $mindMaps = array();                                                        
                     @endphp

                                        @if(isset($getCountMindMapCourse) && $getCountMindMapCourse->count() > 0)

                                                                                  
                                            @if(count($s_course->classes)>0)
                                                @if(!empty($pkgId))
                              
                                               
                                                            @foreach ($s_course->classes as $item)

                                                                @if($item->contents->count()>0)
                                                                 @php  $chkArr = explode(',',$getChapter);  @endphp
                                                                
                                                                    @if($item->mindMapCount->count() >0 )
                                                                        @if($package_type=='1')
                                                                            <div class="card">
                                                                                <div class="card-header" id="heading1-{{ $item->id }}">
                                                                                    <a href="#" role="button" data-toggle="collapse"
                                                                                    data-target="#collapse1-{{ $item->id }}"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="collapse1-{{ $item->id }}" class="colapsed rounded-0 px-1"><span style="max-width:290px;display:inline-block;">{{ $item->title }}</span></a>
                                                                                </div>

                                                                                <div id="collapse1-{{ $item->id }}"
                                                                                    class="collapse show"
                                                                                    aria-labelledby="heading1-{{ $item->id }}" data-parent="#accordionExample">
                                                                                    <div class="card-body">
                                                                                
                                                                                        @forelse ($item->contents as $content)
                                                                                        @php
                                                                                            $getCountMindMap = \App\Model\MindMap::where(['class_content_id' => $content->id])->get();
                                                                                            
                                                                                        @endphp
                                                                                        @if($getCountMindMap->count()>0)
                                                                                        @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                                                                <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                                                    <!-- <div class="custom-checkbox">
                                                                                                        <div class="custom-checkbox">
                                                                                                            <label for="chb-{{$content->id}}">
                                                                                                            <input type="checkbox"
                                                                                                                data-url="{{route('seen.remove', $content->id)}}"
                                                                                                                id="chb-{{$content->id}}">
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div> -->
                                                                                                    <input type="hidden"
                                                                                                        id="contentVideoUrl-{{$content->id}}"
                                                                                                        value="{{route('class.content',$content->id)}}">
                                                                                                        @if ($content->is_preview == 1)
                                                                                                            <div class="row">
                                                                                                                <div class="col-8">
                                                                                                                    <a href="#" class="button-video line-height-1 text-left v-small">
                                                                                                                    <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                                                    </a> 
                                                                                                                </div>
                                                                                                                <div class="col-4">
                                                                                                                    <span class="time-span px-1 small line-height-1 float-right p-2" id=""> <a href="{{ route('lesson.view_mind_map',$content->id) }}" id="mindLink_{{$content->id}}" class="badgemm " ><span>Mind Maps <i class="fas fa-badge-check"></i></span></a> </span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <?php $mindMaps[] = $content->id;?>
                                                                                                        @else

                                                                                                        <div class="row">
                                                                                                                <div class="col-7">
                                                                                                                    <a href="#" class="button-video line-height-1 text-left v-small">
                                                                                                                    @if($content->content_type == 'Video')
                                                                                                                        <i class="fa fa-play-circle mr-2"></i>
                                                                                                                    @elseif($content->content_type == 'Document')
                                                                                                                        <i class="fa fa-file-pdf mr-2"></i>
                                                                                                                    @else
                                                                                                                        <i class="fa fa-play-circle mr-2"></i>
                                                                                                                    @endif  {{ $content->title }}
                                                                                                                    </a> 
                                                                                                                </div>
                                                                                                                <div class="col-5">
                                                                                                                    <span class="time-span px-1 small line-height-1 float-right p-2"> <a href="{{ route('lesson.view_mind_map',$content->id) }}" class="badgemm " id="mindLink_{{$content->id}}" ><span>Mind Maps <i class="fas fa-badge-check"></i></span></a> </span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <?php $mindMaps[] = $content->id;?>
                                                                                                        @endif
                                                                                                
                                                                                                    @if (zoomActive())
                                                                                                        <div class="">
                                                                                                            @if($content->meeting != null)
                                                                                                                <p class="course-item-meta">
                                                                                                                    <i class="la la-video-camera"></i>
                                                                                                                    @translate(Meeting Id)
                                                                                                                    - {{$content->meeting->meeting_id}}
                                                                                                                </p>
                                                                                                                <p class="course-item-meta">
                                                                                                                    <i class="la la-calendar-check-o"></i>
                                                                                                                    @translate(Start Time)
                                                                                                                    - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                                                                </p>
                                                                                                                @if($content->meeting->duration != null)
                                                                                                                    <p class="course-item-meta">
                                                                                                                        <i class="la la-calendar-check-o"></i>
                                                                                                                        @translate(Duration)
                                                                                                                        - {{ $content->meeting->duration }}
                                                                                                                        min
                                                                                                                    </p>
                                                                                                                @endif
                                                                                                                <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                                                                <a href="javascript:void(0)"
                                                                                                                class="countDown d-none"
                                                                                                                onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        
                                                                        @elseif(in_array($item->id,$chkArr))
                                                                            <div class="card">
                                                                                <div class="card-header" id="heading1-{{ $item->id }}">
                                                                                    <a href="#" role="button" data-toggle="collapse"
                                                                                    data-target="#collapse1-{{ $item->id }}"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="collapse1-{{ $item->id }}" class="colapsed rounded-0 px-1"><span style="max-width:290px;display:inline-block;">{{ $item->title }}</span></a>
                                                                                </div>

                                                                                <div id="collapse1-{{ $item->id }}"
                                                                                    class="collapse show"
                                                                                    aria-labelledby="heading1-{{ $item->id }}" data-parent="#accordionExample">
                                                                                    <div class="card-body">
                                                                                
                                                                                        @forelse ($item->contents as $content)
                                                                                        @php
                                                                                            $getCountMindMap = \App\Model\MindMap::where(['class_content_id' => $content->id])->get();
                                                                                            
                                                                                        @endphp
                                                                                        @if($getCountMindMap->count()>0)
                                                                                        @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                                                                <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                                                    <!-- <div class="custom-checkbox">
                                                                                                        <div class="custom-checkbox">
                                                                                                            <label for="chb-{{$content->id}}">
                                                                                                            <input type="checkbox"
                                                                                                                data-url="{{route('seen.remove', $content->id)}}"
                                                                                                                id="chb-{{$content->id}}">
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div> -->
                                                                                                    <input type="hidden"
                                                                                                        id="contentVideoUrl-{{$content->id}}"
                                                                                                        value="{{route('class.content',$content->id)}}">
                                                                                                        @if ($content->is_preview == 1)
                                                                                                            <div class="row">
                                                                                                                <div class="col-8">
                                                                                                                    <a href="#" class="button-video line-height-1 text-left v-small">
                                                                                                                    <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                                                    </a> 
                                                                                                                </div>
                                                                                                                <div class="col-4">
                                                                                                                    <span class="time-span px-1 small line-height-1 float-right p-2"> <a href="{{ route('lesson.view_mind_map',$content->id) }}" class="badgemm " id="mindLink_{{$content->id}}" ><span>Mind Maps <i class="fas fa-badge-check"></i></span></a> </span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <?php $mindMaps[] = $content->id;?>
                                                                                                        @else

                                                                                                        <div class="row">
                                                                                                                <div class="col-7">
                                                                                                                    <a href="#" class="button-video line-height-1 text-left v-small">
                                                                                                                    @if($content->content_type == 'Video')
                                                                                                                        <i class="fa fa-play-circle mr-2"></i>
                                                                                                                    @elseif($content->content_type == 'Document')
                                                                                                                        <i class="fa fa-file-pdf mr-2"></i>
                                                                                                                    @else
                                                                                                                        <i class="fa fa-play-circle mr-2"></i>
                                                                                                                    @endif  {{ $content->title }}
                                                                                                                    </a> 
                                                                                                                </div>
                                                                                                                <div class="col-5">
                                                                                                                    <span class="time-span px-1 small line-height-1 float-right p-2"> <a href="{{ route('lesson.view_mind_map',$content->id) }}" class="badgemm" id="mindLink_{{$content->id}}" ><span>Mind Maps <i class="fas fa-badge-check"></i></span></a> </span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <?php $mindMaps[] = $content->id;?>
                                                                                                        @endif
                                                                                                
                                                                                                    @if (zoomActive())
                                                                                                        <div class="">
                                                                                                            @if($content->meeting != null)
                                                                                                                <p class="course-item-meta">
                                                                                                                    <i class="la la-video-camera"></i>
                                                                                                                    @translate(Meeting Id)
                                                                                                                    - {{$content->meeting->meeting_id}}
                                                                                                                </p>
                                                                                                                <p class="course-item-meta">
                                                                                                                    <i class="la la-calendar-check-o"></i>
                                                                                                                    @translate(Start Time)
                                                                                                                    - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                                                                </p>
                                                                                                                @if($content->meeting->duration != null)
                                                                                                                    <p class="course-item-meta">
                                                                                                                        <i class="la la-calendar-check-o"></i>
                                                                                                                        @translate(Duration)
                                                                                                                        - {{ $content->meeting->duration }}
                                                                                                                        min
                                                                                                                    </p>
                                                                                                                @endif
                                                                                                                <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                                                                <a href="javascript:void(0)"
                                                                                                                class="countDown d-none"
                                                                                                                onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                       
                                                            <!-- code block to list block items -->     
                       

                                                    @else
                                                            @foreach ($s_course->classes as $item)
                                                                        @if($item->contents->count()>0)
                                                                        <div class="card">
                                                                            <div class="card-header" id="heading1-{{ $item->id }}">
                                                                                <a href="#" role="button" data-toggle="collapse"
                                                                                data-target="#collapse1-{{ $item->id }}"
                                                                                aria-expanded="false"
                                                                                aria-controls="collapse1-{{ $item->id }}" class="colapsed rounded-0 px-1"><span style="max-width:290px;display:inline-block;">{{ $item->title }}</span></a>
                                                                            </div>

                                                                            <div id="collapse1-{{ $item->id }}"
                                                                                class="collapse {{ $loop->first ? 'show' : '' }}"
                                                                                aria-labelledby="heading1-{{ $item->id }}" data-parent="#accordionExample">
                                                                                <div class="card-body">
                                                                            
                                                                                    @forelse ($item->contents as $content)
                                                                                        @php
                                                                                            $getCountMindMap = \App\Model\MindMap::where(['class_content_id' => $content->id])->get();
                                                                                        
                                                                                        @endphp
                                                                                        @if($getCountMindMap->count()>0)
                                                                                    @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                                                            <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                                                
                                                                                                <input type="hidden"
                                                                                                    id="contentVideoUrl-{{$content->id}}"
                                                                                                    value="{{route('class.content',$content->id)}}">
                                                                                                
                                                                                                @if ($content->is_preview == 1)
                                                                                                    <div class="row">
                                                                                                        <div class="col-8">
                                                                                                            <a href="#" class="button-video line-height-1 text-left v-small">
                                                                                                            <i class="fa fa-play-circle mr-2"></i>{{ $content->title }}
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div class="col-4 text-right">
                                                                                                            <span class="time-span px-1 text-right d-block v-small"> <a href="{{route('lesson.view_mind_map',$content->id)}}" class="badgemm"  id="mindLink_{{$content->id}}"><span>Mind Maps <i class="fas fa-badge-check"></i></span></a> </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <?php $mindMaps[] = $content->id;?>
                                                                                                @else

                                                                                                <div class="row">
                                                                                                        <div class="col-8">
                                                                                                            <a href="#" class="button-video line-height-1 text-left v-small">
                                                                                                            @if($content->content_type == 'Video')
                                                                                                                    <i class="fa fa-play-circle mr-2"></i>
                                                                                                                @elseif($content->content_type == 'Document')
                                                                                                                    <i class="fa fa-file-pdf mr-2"></i>
                                                                                                                @else
                                                                                                                    <i class="fa fa-play-circle mr-2"></i>
                                                                                                                @endif  {{ $content->title }}
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div class="col-4 text-right">
                                                                                                            <span class="time-span px-1 text-right d-block v-small"> <a href="{{route('lesson.view_mind_map',$content->id)}}" class="badgemm" id="mindLink_{{$content->id}}"  ><span>Mind Maps <i class="fas fa-badge-check"></i></span></a> </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <?php $mindMaps[] = $content->id;?>
                                                                                                @endif
                                                                                            
                                                                                            {{--
                                                                                                @if($content->source_code != null)
                                                                                                    <div class="msg-action-dot">
                                                                                                            <a class="resource-btn theme-btn-light"
                                                                                                            href="{{filePath($content->source_code)}}"
                                                                                                            >

                                                                                                                <i class="fa fa-folder-open mr-1"></i>
                                                                                                                @translate(Resources)<i
                                                                                                                    class="fa fa-download ml-1"></i>
                                                                                                            </a>
                                                                                                    </div>
                                                                                                @endif
                                                                                            --}}
                                                                                                @if (zoomActive())
                                                                                                    <div class="">
                                                                                                        @if($content->meeting != null)
                                                                                                            <p class="course-item-meta">
                                                                                                                <i class="la la-video-camera"></i>
                                                                                                                @translate(Meeting Id)
                                                                                                                - {{$content->meeting->meeting_id}}
                                                                                                            </p>
                                                                                                            <p class="course-item-meta">
                                                                                                                <i class="la la-calendar-check-o"></i>
                                                                                                                @translate(Start Time)
                                                                                                                - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                                                            </p>
                                                                                                            @if($content->meeting->duration != null)
                                                                                                                <p class="course-item-meta">
                                                                                                                    <i class="la la-calendar-check-o"></i>
                                                                                                                    @translate(Duration)
                                                                                                                    - {{ $content->meeting->duration }}
                                                                                                                    min
                                                                                                                </p>
                                                                                                            @endif
                                                                                                            <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                                                            <a href="javascript:void(0)"
                                                                                                            class="countDown d-none"
                                                                                                            onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                @endif
                                                                                            </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                
                                                                                                                                
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                @endforeach
                                                    @endif
                                                @endif
                                    @else
                                            @php 
                                            
                                            echo "Sorry, Mind Maps not available in the chosen curriculum.";
                                            
                                            @endphp
                                    @endif
                                    
                                    </div>
                                </div>
                                <input type="hidden" name="mind_map" id="mind_map" value="<?php echo implode(",",$mindMaps);?>">
                                   
                            </div>
                        </div>
                        
                            <div class="tab-pane fade in q-a-content" id="comment">
                                <div class="header-search">
                                    <form id="comment_form">
                                        <input type="hidden" value="{{route('comments')}}"
                                               id="commentSaveUrl">
                                        <input type="hidden" value="{{$s_course->id}}"
                                               id="course_id">
                                        <div class="form-group mb-0">
                                            <input class="form-control" required type="text"
                                                   name="comment" id="comment"
                                                   placeholder="Enter your comment">
                                            <button class="btn btn-primary mb-3 mt-3" type="submit"
                                                    id="comment_submit"><i
                                                    class="la la-arrow-right"></i> Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="video-tab-title margin-top-30">
                                    <h5>@translate(All Comments)</h5>
                                </div>
                                <div class="hr-line"></div>
                                <div id="comments">
                                    <div class="single-question">
                                        <div class="question-image">
                                            <img src="assets/images/question-image.png" alt="image">
                                        </div>
                                        <div class="question-content">
                                            <h6>how to install wordpress in cpanel?</h6>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.!</p>
                                            <div class="content-bottom">
                                                <h6>john doe</h6>
                                                <span>5 min ago</span>
                                                <span><a href="#"><i class="fa fa-comments"></i> 10 comments</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade in note-content d-none" id="comment">
                                <div class="header-search">
                                    <form action="#">
                                        <input type="text" placeholder="Create New Note">
                                        <button type="submit"><i class="fa fa-plus"></i></button>
                                    </form>
                                </div>
                                <span>Click the "Create a new note" box, the "+" button, or press "N" to make your first note.</span>
                            </div>

                            @if(env('CERTIFICATE_ACTIVE') === 'YES')
                                <div class="tab-pane fade in announcement-content show active" id="practice">
                                    <div class="mobile-course-content-wrap">
                                        <div class="mobile-course-menu">
                                            <div class="course-dashboard-side-content">
                                                <div class="accordion course-item-list-accordion"
                                                     id="mobileCourseMenu">
												@if(($time_left == 0) || ($seens != 0))
												
												 <div class="clearfix">
                                                 <div class="curriculum-accordion">
                                                 <!-- && $subjectTests != 0 -->
                                                @if($PackageDetail)
                                                   <div class="accordion-wrapper" id="accordionExample">
                                                @if($PackageDetail->package_type == 'competitive-courses')
                                                <div class="row">
                                                    @if($mockTests->count() > 0)
                                                    @foreach($mockTests as $mockTest)
                                                   <div class="col-lg-4 col-6">
                                                        <div class="card-test">
                                                            <div class="card__content">
                                                                <h3 class="card__header">{{ $mockTest->name }}- Mock Test</h3>
                                                                <div class="card__info">
                                                             @php $totalMockTestAttend = \App\MockTestEnrollment::where(['test_type' => 'mockTest','test_status' => 'finish','user_id' => Auth::id(),'mock_test_id' => $mockTest->id ,'package_id' => $enroll[0]['package_id']])->count(); @endphp
            
                                                                @if($totalMockTestAttend != 0)
                                                                                        @if($totalMockTestAttend < $PackageDetail->no_of_sectional_test && $PackageDetail->no_of_sectional_test != '' )
                                                                                    <p> <span class="badge bg-warning text-dark"> {{ $totalMockTestAttend }}/{{ $PackageDetail->no_of_sectional_test }}</span>    </p>  
                                                                                        <p><a href="{{ route('mock-test-detail',[$PackageDetail->id , $mockTest->id]) }}" class="btn btn-success">Re-attempt</a> </p>
                                                                                        @else
                                                                                        <p><span class="badge bg-warning text-dark"> {{ $totalMockTestAttend }}/{{ $PackageDetail->no_of_sectional_test }}</span></p>
                                                                                        <p class="btn btn-success">Completed</p> 
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                                                            <a class="btn btn-outline-dark btn-rounded" href="{{ route('mock-test-package',[$PackageDetail->id , $mockTest->id]) }}">View Details</a>
                                                                                        </div>
                                                                                    @else
                                                                                        @if($PackageDetail->no_of_sectional_test != '')
                                                                                        <p><span class="badge bg-warning text-dark"> 0 /{{ $PackageDetail->no_of_sectional_test }}</span></p>                  
                                                                                        <p><a href="{{ route('mock-test-detail',[$PackageDetail->id , $mockTest->id]) }}" class="btn btn-primary">Attempt</a></p>
                                                                                        @else
                                                                                            <p><span class="badge bg-warning text-dark"> 0/0</span></p> 
                                                                                            
                                                                                            No. of attempts not allow from admin
                                                                                        @endif

                                                                                    @endif
                                                                </div>
                                                                <!-- <div class="card-test-footer text-center">
                                                                    <a class="btn btn-outline-dark btn-rounded" data-toggle="collapse" href="#subjectTest" role="button" aria-expanded="false" aria-controls="collapseExample">View Details</a>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    Error occurred 5093 ! 
                                                    @endif
                                               
                                                </div>
                                                 @else
                                                   <div class="row">
                                                   <div class="col-lg-4 col-6">
                                                        <div class="card-test">
                                                            <div class="card__content">
                                                                <h3 class="card__header">Subject Test</h3>
                                                                <div class="card__info">
                                                                @if($totalAttend != 0 && $PackageDetail->no_of_sectional_test  != '' )
                                                                                        @if($totalAttend < $PackageDetail->no_of_sectional_test )
                                                                                    <p> <span class="badge bg-warning text-dark"> {{ $totalAttend }}/{{ $PackageDetail->no_of_sectional_test }}</span>    </p>  
                                                                                        <p><a href="{{ route('subject-test-detail',[$PackageDetail->id,$s_course->id]) }}" class="btn btn-success">Re-attempt</a> </p>
                                                                                        @else
                                                                                        <p><span class="badge bg-warning text-dark"> {{ $totalAttend }}/{{ $PackageDetail->no_of_sectional_test }}</span></p>
                                                                                        <p class="btn btn-success">Completed</p> 
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                            <a class="btn btn-outline-dark btn-rounded" href="{{ route('subject-test-package' , $PackageDetail->id)}}">View Details</a>
                                                        </div>
                                                                                    @else
                                                                                       @if($PackageDetail->no_of_sectional_test  != '' )   
                                                                                       <p><span class="badge bg-warning text-dark"> 0/{{ $PackageDetail->no_of_sectional_test }}</span></p>                     
                                                                                        <p><a href="{{ route('subject-test-detail',[$PackageDetail->id,$s_course->id]) }}" class="btn btn-primary">Attempt</a></p>
                                                                                        @else
                                                                                        <p><span class="badge bg-warning text-dark"> 0/0</span></p> 
                                                                                     
                                                                                        No. of attempts not allow from admin
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                                                        <a class="btn btn-outline-dark btn-rounded" href="#">View Details</a>
                                                                                        </div>           
                                                                                    @endif
                                                                </div>
                                                                <!-- <div class="card-test-footer text-center">
                                                                    <a class="btn btn-outline-dark btn-rounded" data-toggle="collapse" href="#subjectTest" role="button" aria-expanded="false" aria-controls="collapseExample">View Details</a>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-6">
                                                        <div class="card-test">
                                                            <div class="card__content">
                                                                <h3 class="card__header">Unit Test</h3>
                                                                <div class="card__info">
                                                                @if($totalUnitAttend != 0 && $PackageDetail->no_of_practice_test != '')
                                                              
                                                                                        @if($totalUnitAttend < $PackageDetail->no_of_practice_test )
                                                                                        <p> <span class="badge bg-warning text-dark"> {{ $totalUnitAttend }}/{{ $PackageDetail->no_of_practice_test }}</span>    </p>  
                                                                                        <!-- <p><a href="{{ route('unit-test-detail',$PackageDetail->id) }}" class="btn btn-success">Re-attempt</a> </p> -->
                                                                                        <p><button type="button" onclick="openSolutionUnit()"   class="btn btn-success btn-sm">Re-attempt</button> </p>
                                                              
                                                                                        @else
                                                                                        <p><span class="badge bg-warning text-dark"> {{ $totalUnitAttend }}/{{ $PackageDetail->no_of_sectional_test }}</span></p>
                                                                                        <p class="btn btn-success">Completed</p> 
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                                                            <a class="btn btn-outline-dark btn-rounded" href="{{ route('unit-test-package' , $PackageDetail->id)}}">View Details</a>
                                                                                        </div>
                                                                                    @else
                                                                                        @if($PackageDetail->no_of_practice_test  != '' )  
                                                                                       
                                                                                        <p><span class="badge bg-warning text-dark"> 0/{{ $PackageDetail->no_of_practice_test }}</span></p> 
                                                                                        <p> <button type="button" onclick="openSolutionUnit()"   class="btn btn-primary btn-sm">Attempt</button> </p>
                                                                                          
                                                                                        <!-- <p><a href="{{ route('unit-test-detail',$PackageDetail->id) }}" class="btn btn-primary">Attempt</a></p> -->
                                                                                        @else
                                                                                        <p><span class="badge bg-warning text-dark"> 0/0</span></p> 
                                                                                        
                                                                                        No. of attempts not allow from admin
                                                                                         
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                                                        <a class="btn btn-outline-dark btn-rounded" href="#">View Details</a>
                                                                                        </div> 
                                                                                     @endif
        <div id="mybottomsolutionUnit" class="botttomsolution">
            <div class="clearfix">
                <div class="container">
                    <div class="solution-scroll-div mb-2">
                    <h4>{{ $s_course->title }}</h4>
                        @if(count($s_course->classes)>0)
                            @foreach ($s_course->classes as $item) 
                                @if($item->contents->count()>0)
                                    @if(($package_type == '1') )
                                        <div class="card">
                                            <div class="card-header" id="heading11-{{ $item->id }}">
                                            @php $unitId = base64_encode($item->id ); @endphp    
                                            <span role="button" data-toggle="collapse"
                                                data-target="#collapse11-{{ $item->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse11-{{ $item->id }}" class="colapsed rounded-0 px-1" ><span class="title-adjust">{{ $item->title }}</span>
                                                <a href="{{ route('unit-test-detail',[$PackageDetail->id,$unitId]) }}" style="right: 0;" class="btn btn-success btn-sm  position-absolute py-1 mr-5 text-white">Start Test</a>
                                            </span>
                                            </div>
                                            


                                            <div id="collapse11-{{ $item->id }}"
                                                class="collapse11 {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="heading11-{{ $item->id }}" data-parent="#accordionExample">
                                                <div class="card-body">
                                            
                                                    @forelse ($item->contents as $content)
                                                    
                                                    @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                            <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                <!-- <div class="custom-checkbox">
                                                                    <div class="custom-checkbox">
                                                                        <label for="chb-{{$content->id}}">
                                                                        <input type="checkbox"
                                                                            data-url="{{route('seen.remove', $content->id)}}"
                                                                            id="chb-{{$content->id}}">
                                                                        </label>
                                                                    </div>
                                                                </div> -->
                                                                <input type="hidden"
                                                                    id="contentVideoUrl-{{$content->id}}"
                                                                    value="{{route('class.content',$content->id)}}">
                                                                    @if ($content->is_preview == 1)
                                                                    <div class="row mt-2">
                                                                            <div class="col-8 text-left">
                                                                                <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4 text-center">
                                                                                <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                            </div>
                                                                           
                                                                        </div>
                                                                    @else
                                                                    <div class="row mt-2">
                                                                            <div class="col-8 text-left">
                                                                                <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                            @if($content->content_type == 'Video')
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                            @elseif($content->content_type == 'Document')
                                                                                <i class="fa fa-file-pdf mr-2"></i>
                                                                            @else
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                            @endif {{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4 text-right">
                                                                                <span class="time-span px-1 text-right d-block v-small">{{ duration($content->duration) }}</span>
                                                                            </div>
                                                                            <!-- <div class="col-2 text-right">
                                                                            @php $chapterId = base64_encode($content->id ); @endphp
                                                                                <span class="time-span px-1 text-right d-block v-small"><a href="{{ route('chapter-test-detail',[$PackageDetail->id,$chapterId]) }}" class="btn btn-success btn-sm">Start Test</a></span>
                                                                            </div> -->
                                                                        </div>

                                                                    @endif
                                                            
                                                                @if (zoomActive())
                                                                    <div class="">
                                                                        @if($content->meeting != null)
                                                                            <p class="course-item-meta">
                                                                                <i class="la la-video-camera"></i>
                                                                                @translate(Meeting Id)
                                                                                - {{$content->meeting->meeting_id}}
                                                                            </p>
                                                                            <p class="course-item-meta">
                                                                                <i class="la la-calendar-check-o"></i>
                                                                                @translate(Start Time)
                                                                                - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                            </p>
                                                                            @if($content->meeting->duration != null)
                                                                                <p class="course-item-meta">
                                                                                    <i class="la la-calendar-check-o"></i>
                                                                                    @translate(Duration)
                                                                                    - {{ $content->meeting->duration }}
                                                                                    min
                                                                                </p>
                                                                            @endif
                                                                            <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                            <a href="javascript:void(0)"
                                                                            class="countDown d-none"
                                                                            onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach                                          
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(in_array($item->id,$chkArr))
                                        <div class="card">
                                            <div class="card-header" id="heading11-{{ $item->id }}">
                                          
                                             @php $unitId = base64_encode($item->id ); @endphp 
                                                <span role="button" data-toggle="collapse"
                                                data-target="#collapse11-{{ $item->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse11-{{ $item->id }}" class="colapsed rounded-0 px-1" ><span class="title-adjust" >{{ $item->title }}</span>
                                                <a href="{{ route('unit-test-detail',[$PackageDetail->id,$unitId]) }}" style="right: 0;" class="btn btn-success btn-sm  position-absolute py-1 mr-5 text-white">Start Test</a>
                                            </span>
                                            
                                                  
                                            </div>
                                            


                                            <div id="collapse11-{{ $item->id }}"
                                                class="collapse11 {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="heading11-{{ $item->id }}" data-parent="#accordionExample">
                                                <div class="card-body">
                                                                      
                                                    @forelse ($item->contents as $content)
                                                    
                                                    @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                            <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                               
                                                            
                                                                          
                                                            <!-- <div class="custom-checkbox">
                                                                    <div class="custom-checkbox">
                                                                        <label for="chb-{{$content->id}}">
                                                                        <input type="checkbox"
                                                                            data-url="{{route('seen.remove', $content->id)}}"
                                                                            id="chb-{{$content->id}}">
                                                                        </label>
                                                                    </div>
                                                                </div> -->
                                                                <input type="hidden"
                                                                    id="contentVideoUrl-{{$content->id}}"
                                                                    value="{{route('class.content',$content->id)}}">
                                                                    @if ($content->is_preview == 1)
                                                                    <div class="row mt-2">
                                                                            <div class="col-8 text-left">
                                                                                <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4 text-right">
                                                                                <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                            </div>
                                                                            <!-- <div class="col-2 text-right">
                                                                                @php $chapterId = base64_encode($content->id ); @endphp
                                                                                <span class="time-span px-1 text-right d-block v-small"><a href="{{ route('chapter-test-detail',[$PackageDetail->id,$chapterId]) }}" class="btn btn-success btn-sm">Start Test</a></span>
                                                                            </div> -->
                                                                        </div>
                                                                    @else
                                                                    <div class="row mt-2">
                                                                            <div class="col-8 text-left">
                                                                                <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                @if($content->content_type == 'Video')
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                            @elseif($content->content_type == 'Document')
                                                                                <i class="fa fa-file-pdf mr-2"></i>
                                                                            @else
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                            @endif {{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4 text-right">
                                                                                <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                            </div>
                                                                            <!-- <div class="col-2 text-right">
                                                                            @php $chapterId = base64_encode($content->id ); @endphp
                                                                                <span class="time-span px-1 text-right d-block v-small"><a href="{{ route('chapter-test-detail',[$PackageDetail->id,$chapterId]) }}" class="btn btn-success btn-sm">Start Test</a></span>
                                                                            </div> -->
                                                                        </div>

                                                                    @endif
                                                            
                                                                @if (zoomActive())
                                                                    <div class="">
                                                                        @if($content->meeting != null)
                                                                            <p class="course-item-meta">
                                                                                <i class="la la-video-camera"></i>
                                                                                @translate(Meeting Id)
                                                                                - {{$content->meeting->meeting_id}}
                                                                            </p>
                                                                            <p class="course-item-meta">
                                                                                <i class="la la-calendar-check-o"></i>
                                                                                @translate(Start Time)
                                                                                - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                            </p>
                                                                            @if($content->meeting->duration != null)
                                                                                <p class="course-item-meta">
                                                                                    <i class="la la-calendar-check-o"></i>
                                                                                    @translate(Duration)
                                                                                    - {{ $content->meeting->duration }}
                                                                                    min
                                                                                </p>
                                                                            @endif
                                                                            <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                            <a href="javascript:void(0)"
                                                                            class="countDown d-none"
                                                                            onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach                                            
                                                </div>
                                            </div>
                                        </div>
                                    
                                    @endif
                                @endif
                            @endforeach
                        @endif
                                    </div>
                                </div>
                            </div>
                                <a href="javascript:void(0)" class="closebtn" onclick="closeSolutionUnit()">&times;</a>
                                </div>                                                          
                                                                </div>
                                                                <!-- <div class="card-test-footer text-center">
                                                                    <a class="btn btn-outline-dark btn-rounded" data-toggle="collapse" href="#subjectTest" role="button" aria-expanded="false" aria-controls="collapseExample">View Details</a>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <div class="card-test">
                                                            <div class="card__content">
                                                                <h3 class="card__header">Chapter Test</h3>
                                                                <div class="card__info">
                                                                @if($totalChapterAttend != 0 && $PackageDetail->no_of_test  != '')
                                                                                        @if($totalChapterAttend < $PackageDetail->no_of_test )
                                                                                       
                                                                                    <p> <span class="badge bg-warning text-dark"> {{ $totalChapterAttend }}/{{ $PackageDetail->no_of_test }}</span>    </p>  
                                                                                        <!-- <p><a href="{{ route('chapter-test-detail',$PackageDetail->id) }}" class="btn btn-success">Re-attempt</a> </p> -->
                                                                                        <p><button type="button" onclick="openSolution()"   class="btn btn-success btn-sm">Re-attempt</button></p>
                                                              
                                                                                        @else
                                                                                        <p><span class="badge bg-warning text-dark"> {{ $totalChapterAttend }}/{{ $PackageDetail->no_of_test }}</span></p>
                                                                                        <p class="btn btn-success">Completed</p> 
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                                                            <a class="btn btn-outline-dark btn-rounded" href="{{ route('chapter-test-package' , $PackageDetail->id)}}">View Details</a>
                                                                                        </div>
                                                                                    @else
                                                                                        @if( $PackageDetail->no_of_test  != '')
                                                                                        <p><span class="badge bg-warning text-dark"> 0/{{ $PackageDetail->no_of_test }}</span></p>   
                                                                                        <p><button type="button" onclick="openSolution()"   class="btn btn-primary btn-sm">Attempt</button></p>
                                                                                   
                                                                                        <!-- <p><a href="{{ route('chapter-test-detail',$PackageDetail->id) }}" class="btn btn-primary">Attempt</a></p> -->
                                                                                        @else
                                                                                            <p><span class="badge bg-warning text-dark"> 0/0</span></p> 
                                                                                            
                                                                                            No. of attempts not allow from admin
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                                                            <a class="btn btn-outline-dark btn-rounded" href="#">View Details</a>
                                                                                        </div>
                                                                                    @endif
                                                                </div>
        <div id="mybottomsolution" class="botttomsolution">
            <div class="clearfix">
                <div class="container">
                    <div class="solution-scroll-div mb-2">
                    <h4>{{ $s_course->title }}</h4>
                        @if(count($s_course->classes)>0)
                            @foreach ($s_course->classes as $item) 
                                @if($item->contents->count()>0)
                                    @if(($package_type == '1') )
                                        <div class="card">
                                            <div class="card-header" id="heading11-{{ $item->id }}">
                                                <a href="#" role="button" data-toggle="collapse"
                                                data-target="#collapse11-{{ $item->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse11-{{ $item->id }}" class="colapsed rounded-0 px-1" ><span style="max-width:230px;display:inline-block;">{{ $item->title }}</span></a>
                                            </div>

                                            <div id="collapse11-{{ $item->id }}"
                                                class="collapse11 {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="heading11-{{ $item->id }}" data-parent="#accordionExample">
                                                <div class="card-body">
                                            
                                                    @forelse ($item->contents as $content)
                                                    
                                                    @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                            <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                <!-- <div class="custom-checkbox">
                                                                    <div class="custom-checkbox">
                                                                        <label for="chb-{{$content->id}}">
                                                                        <input type="checkbox"
                                                                            data-url="{{route('seen.remove', $content->id)}}"
                                                                            id="chb-{{$content->id}}">
                                                                        </label>
                                                                    </div>
                                                                </div> -->
                                                                <input type="hidden"
                                                                    id="contentVideoUrl-{{$content->id}}"
                                                                    value="{{route('class.content',$content->id)}}">
                                                                    @if ($content->is_preview == 1)
                                                                    <div class="row mt-2">
                                                                            <div class="col-8 col-md-6 text-left">
                                                                                <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4 col-md-4 text-center">
                                                                                <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                            </div>
                                                                            <div class="col-12 col-md-2 text-right">
                                                                                @php $chapterId = base64_encode($content->id ); @endphp
                                                                                <span class="time-span px-1 text-right d-block v-small"><a href="{{ route('chapter-test-detail',[$PackageDetail->id,$chapterId]) }}" class="btn btn-success btn-sm">Start Test</a></span>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                    <div class="row mt-2">
                                                                            <div class="col-6 col-md-6 text-left">
                                                                                <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                            @if($content->content_type == 'Video')
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                            @elseif($content->content_type == 'Document')
                                                                                <i class="fa fa-file-pdf mr-2"></i>
                                                                            @else
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                            @endif {{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4 col-md-4 text-right">
                                                                                <span class="time-span px-1 text-right d-block v-small">{{ duration($content->duration) }}</span>
                                                                            </div>
                                                                            <div class="col-12 col-md-2 text-right">
                                                                            @php $chapterId = base64_encode($content->id ); @endphp
                                                                                <span class="time-span px-1 text-right d-block v-small"><a href="{{ route('chapter-test-detail',[$PackageDetail->id,$chapterId]) }}" class="btn btn-success btn-sm">Start Test</a></span>
                                                                            </div>
                                                                        </div>

                                                                    @endif
                                                            
                                                                @if (zoomActive())
                                                                    <div class="">
                                                                        @if($content->meeting != null)
                                                                            <p class="course-item-meta">
                                                                                <i class="la la-video-camera"></i>
                                                                                @translate(Meeting Id)
                                                                                - {{$content->meeting->meeting_id}}
                                                                            </p>
                                                                            <p class="course-item-meta">
                                                                                <i class="la la-calendar-check-o"></i>
                                                                                @translate(Start Time)
                                                                                - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                            </p>
                                                                            @if($content->meeting->duration != null)
                                                                                <p class="course-item-meta">
                                                                                    <i class="la la-calendar-check-o"></i>
                                                                                    @translate(Duration)
                                                                                    - {{ $content->meeting->duration }}
                                                                                    min
                                                                                </p>
                                                                            @endif
                                                                            <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                            <a href="javascript:void(0)"
                                                                            class="countDown d-none"
                                                                            onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach                                          
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(in_array($item->id,$chkArr))
                                        <div class="card">
                                            <div class="card-header" id="heading11-{{ $item->id }}">
                                                <a href="#" role="button" data-toggle="collapse"
                                                data-target="#collapse11-{{ $item->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse11-{{ $item->id }}" class="colapsed rounded-0 px-1" ><span style="max-width:230px;display:inline-block;">{{ $item->title }}</span></a>
                                            </div>

                                            <div id="collapse11-{{ $item->id }}"
                                                class="collapse11 {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="heading11-{{ $item->id }}" data-parent="#accordionExample">
                                                <div class="card-body">
                                            
                                                    @forelse ($item->contents as $content)
                                                    
                                                    @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                            <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                <!-- <div class="custom-checkbox">
                                                                    <div class="custom-checkbox">
                                                                        <label for="chb-{{$content->id}}">
                                                                        <input type="checkbox"
                                                                            data-url="{{route('seen.remove', $content->id)}}"
                                                                            id="chb-{{$content->id}}">
                                                                        </label>
                                                                    </div>
                                                                </div> -->
                                                                <input type="hidden"
                                                                    id="contentVideoUrl-{{$content->id}}"
                                                                    value="{{route('class.content',$content->id)}}">
                                                                    @if ($content->is_preview == 1)
                                                                    <div class="row mt-2">
                                                                            <div class="col-8 col-md-6 text-left">
                                                                                <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4 col-md-4 text-right">
                                                                                <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                            </div>
                                                                            <div class="col-12 col-md-2 text-right">
                                                                                @php $chapterId = base64_encode($content->id ); @endphp
                                                                                <span class="time-span px-1 text-right d-block v-small"><a href="{{ route('chapter-test-detail',[$PackageDetail->id,$chapterId]) }}" class="btn btn-success btn-sm">Start Test</a></span>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                    <div class="row mt-2">
                                                                            <div class="col-8 col-md-6 text-left">
                                                                                <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                @if($content->content_type == 'Video')
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                            @elseif($content->content_type == 'Document')
                                                                                <i class="fa fa-file-pdf mr-2"></i>
                                                                            @else
                                                                                <i class="fa fa-play-circle mr-2"></i>
                                                                            @endif {{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4 col-md-4 text-right">
                                                                                <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                            </div>
                                                                            <div class="col-12 col-md-2 text-right">
                                                                            @php $chapterId = base64_encode($content->id ); @endphp
                                                                                <span class="time-span px-1 text-right d-block v-small"><a href="{{ route('chapter-test-detail',[$PackageDetail->id,$chapterId]) }}" class="btn btn-success btn-sm">Start Test</a></span>
                                                                            </div>
                                                                        </div>

                                                                    @endif
                                                            
                                                                @if (zoomActive())
                                                                    <div class="">
                                                                        @if($content->meeting != null)
                                                                            <p class="course-item-meta">
                                                                                <i class="la la-video-camera"></i>
                                                                                @translate(Meeting Id)
                                                                                - {{$content->meeting->meeting_id}}
                                                                            </p>
                                                                            <p class="course-item-meta">
                                                                                <i class="la la-calendar-check-o"></i>
                                                                                @translate(Start Time)
                                                                                - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                            </p>
                                                                            @if($content->meeting->duration != null)
                                                                                <p class="course-item-meta">
                                                                                    <i class="la la-calendar-check-o"></i>
                                                                                    @translate(Duration)
                                                                                    - {{ $content->meeting->duration }}
                                                                                    min
                                                                                </p>
                                                                            @endif
                                                                            <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                            <a href="javascript:void(0)"
                                                                            class="countDown d-none"
                                                                            onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                
                                                                                                
                                                </div>
                                            </div>
                                        </div>
                                    
                                    @endif
                                @endif
                            @endforeach
                        @endif
      
                                           
                                            </div>
                                        </div>
                                    </div>
                                <a href="javascript:void(0)" class="closebtn" onclick="closeSolution()">&times;</a>
                                </div>                                                          

                                                                <!-- <div class="card-test-footer text-center">
                                                                    <a class="btn btn-outline-dark btn-rounded" data-toggle="collapse" href="#subjectTest" role="button" aria-expanded="false" aria-controls="collapseExample">View Details</a>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                    </div>
                                                @else
                                                    <h5> Not Test Available Yet !</h5>
                                                @endif
                                                    </div>
                                                    </div>
												 @if($quiz_status == 1 && $s_course->category->is_free_study!='1')
                                                    @if(isset($s_course->classes[0]->contents[0]))
                                                        <div class="text-center">
                                                         {{--   <a href="{{route('start',[$s_course->id, $s_course->classes[0]->contents[0]->id])}}"  class="btn btn-success"> @translate(Give Assessment)</a> --}}
                                                        </div>
                                                    @endif
												@endif
												
												@else

													<div class="container p-5 d-flex justify-content-center">
														<div class="countdown-wrapper">
															<div id="countdown" class="countdown"></div>
														</div>
													</div>
													<div class="container px-5 pb-5 justify-content-center w-75 m-auto">
															<div class="course-complete-bar-2 mt-2">
																<div class="progress-item mb-0">
																	<p class="skillbar-title">@translate(Complete):</p>
																	<div class="skillbar-box mt-1">
																		<div class="skillbar">
																			<div class="skillbar-bar skillbar-bar-1"
																				 style="width: {{\App\Http\Controllers\FrontendController::calculateLessonCompletePercentage($enroll->first()->id,$s_course->id) }}%;"></div>
																		</div> <!-- End Skill Bar -->
																	</div>
																	<div
																		class="skill-bar-percent">{{\App\Http\Controllers\FrontendController::calculateLessonCompletePercentage($enroll->first()->id,$s_course->id)}}
																		%
																	</div>
																</div>
															</div>
														</div>
												
												@endif
												
												
												 <input type="hidden" value="{{route('quiz_start')}}" id="quizStartUrl">
												<input type="hidden" value="{{route('quiz_update')}}" id="quizUpdateUrl">
												
												
												<form id="regForm" method="POST" action="{{route('lesson_complete')}}" class="no-validate">
													@csrf
													<input type="hidden" name="course_id" value="{{$s_course->id}}">
												</form>
												
												
												
												
												
												
												
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
              
        <div class="col-lg-4">
        <div class="video-playlist-sidebar d-none d-lg-block d-xl-block">
            <h4>{{ $s_course->title }}</h4>
            <div class="curriculum-accordion margin-top-30">
                <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                    <input value="{{ route('seen.list',$s_course->id) }}" type="hidden" id="seenList">
                    @if(count($s_course->classes)>0)
                            
                    @foreach ($s_course->classes as $item)
                        
                    @if($item->contents->count()>0)
                                                @if(($package_type=='1') )
                                                    <div class="card">
                                                        <div class="card-header" id="heading-{{ $item->id }}">
                                                            <a href="#" role="button" data-toggle="collapse"
                                                            data-target="#collapse-{{ $item->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $item->id }}" class="colapsed rounded-0 px-1" ><span style="max-width:230px;display:inline-block;">{{ $item->title }}</span></a>
                                                        </div>

                                                        <div id="collapse-{{ $item->id }}"
                                                            class="collapse {{ $loop->first ? 'show' : '' }}"
                                                            aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                        
                                                                @forelse ($item->contents as $content)
                                                                
                                                                @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                                        <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                            <!-- <div class="custom-checkbox">
                                                                                <div class="custom-checkbox">
                                                                                    <label for="chb-{{$content->id}}">
                                                                                    <input type="checkbox"
                                                                                        data-url="{{route('seen.remove', $content->id)}}"
                                                                                        id="chb-{{$content->id}}">
                                                                                    </label>
                                                                                </div>
                                                                            </div> -->
                                                                            <input type="hidden"
                                                                                id="contentVideoUrl-{{$content->id}}"
                                                                                value="{{route('class.content',$content->id)}}">
                                                                                @if ($content->is_preview == 1)
                                                                                <div class="row">
                                                                                        <div class="col-8 text-left">
                                                                                            <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                            <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                <div class="row">
                                                                                        <div class="col-8 text-left">
                                                                                            <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                            @if($content->content_type == 'Video')
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @elseif($content->content_type == 'Document')
                                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                                        @else
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @endif {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>

                                                                                @endif
                                                                        
                                                                            @if (zoomActive())
                                                                                <div class="">
                                                                                    @if($content->meeting != null)
                                                                                        <p class="course-item-meta">
                                                                                            <i class="la la-video-camera"></i>
                                                                                            @translate(Meeting Id)
                                                                                            - {{$content->meeting->meeting_id}}
                                                                                        </p>
                                                                                        <p class="course-item-meta">
                                                                                            <i class="la la-calendar-check-o"></i>
                                                                                            @translate(Start Time)
                                                                                            - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                                        </p>
                                                                                        @if($content->meeting->duration != null)
                                                                                            <p class="course-item-meta">
                                                                                                <i class="la la-calendar-check-o"></i>
                                                                                                @translate(Duration)
                                                                                                - {{ $content->meeting->duration }}
                                                                                                min
                                                                                            </p>
                                                                                        @endif
                                                                                        <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                                        <a href="javascript:void(0)"
                                                                                        class="countDown d-none"
                                                                                        onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                            
                                                                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif(in_array($item->id,$chkArr))
                                                    <div class="card">
                                                        <div class="card-header" id="heading-{{ $item->id }}">
                                                            <a href="#" role="button" data-toggle="collapse"
                                                            data-target="#collapse-{{ $item->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $item->id }}" class="colapsed rounded-0 px-1" ><span style="max-width:230px;display:inline-block;">{{ $item->title }}</span></a>
                                                        </div>

                                                        <div id="collapse-{{ $item->id }}"
                                                            class="collapse {{ $loop->first ? 'show' : '' }}"
                                                            aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                        
                                                                @forelse ($item->contents as $content)
                                                                
                                                                @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                                        <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                            <!-- <div class="custom-checkbox">
                                                                                <div class="custom-checkbox">
                                                                                    <label for="chb-{{$content->id}}">
                                                                                    <input type="checkbox"
                                                                                        data-url="{{route('seen.remove', $content->id)}}"
                                                                                        id="chb-{{$content->id}}">
                                                                                    </label>
                                                                                </div>
                                                                            </div> -->
                                                                            <input type="hidden"
                                                                                id="contentVideoUrl-{{$content->id}}"
                                                                                value="{{route('class.content',$content->id)}}">
                                                                                @if ($content->is_preview == 1)
                                                                                <div class="row">
                                                                                        <div class="col-8 text-left">
                                                                                            <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                            <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                <div class="row">
                                                                                        <div class="col-8 text-left">
                                                                                            <a href="#" class="button-video line-height-1 text-left small" onclick="closeLesson()">
                                                                                            @if($content->content_type == 'Video')
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @elseif($content->content_type == 'Document')
                                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                                        @else
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @endif {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>

                                                                                @endif
                                                                        
                                                                            @if (zoomActive())
                                                                                <div class="">
                                                                                    @if($content->meeting != null)
                                                                                        <p class="course-item-meta">
                                                                                            <i class="la la-video-camera"></i>
                                                                                            @translate(Meeting Id)
                                                                                            - {{$content->meeting->meeting_id}}
                                                                                        </p>
                                                                                        <p class="course-item-meta">
                                                                                            <i class="la la-calendar-check-o"></i>
                                                                                            @translate(Start Time)
                                                                                            - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                                        </p>
                                                                                        @if($content->meeting->duration != null)
                                                                                            <p class="course-item-meta">
                                                                                                <i class="la la-calendar-check-o"></i>
                                                                                                @translate(Duration)
                                                                                                - {{ $content->meeting->duration }}
                                                                                                min
                                                                                            </p>
                                                                                        @endif
                                                                                        <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                                        <a href="javascript:void(0)"
                                                                                        class="countDown d-none"
                                                                                        onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                            
                                                                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif(!in_array($item->id,$chkArr))
                                                    <div class="card">
                                                        <div class="card-header" id="heading-{{ $item->id }}">
                                                            <a href="#" role="button" data-toggle="collapse"
                                                            data-target="#collapse-{{ $item->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $item->id }}" class="collapsed d-flex justify-content-between px-1">
                                                            <div style="max-width:180px;">{{ $item->title }}</div>
                                                            <span class="locked mr-4 v-small" title="Not available in selected package."> @translate(Upgrade) </span>
                                                            </a>
                                                        </div>

                                                        <div id="collapse-{{ $item->id }}"
                                                            class="false collapse"
                                                            aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                            
                                                                @forelse ($item->contents as $content)
                                                                        <div class="single-course-video pb-1 d-block">
                                                                            
                                                                            <input type="hidden"
                                                                                id="contentVideoUrl-{{$content->id}}"
                                                                                value="">
                                                                                @if ($content->is_preview == 1)
                                                                                <div class="row">
                                                                                        <div class="col-8">
                                                                                            <a href="#" class="button-video line-height-1 text-left v-small" onclick="closeLesson()">
                                                                                            <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                @else

                                                                                    <div class="row">
                                                                                        <div class="col-8">
                                                                                            <a href="#" class="button-video line-height-1 text-left v-small" onclick="closeLesson()">
                                                                                            @if($content->content_type == 'Video')
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @elseif($content->content_type == 'Document')
                                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                                        @else
                                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                                        @endif {{ $content->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="col-4 text-right">
                                                                                            <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                                        </div>
                                                                                    </div>

                                                                                @endif
                                                                            
                                                                            
                                                                    
                                                                        </div>
                                                                    @endforeach
                                                            
                                                                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                               
                                            @endif 
                    
                    @endforeach
                   
               
            @endif
                </div>
            </div>
        </div>
</div>
            </div>
        </div>
    </section>


@endsection

@section('js')
<script>
$(document).ready(function () {
    var mindMap = $('#mind_map').val();
    if(mindMap!='')
    {
        console.log(mindMap);
        splitedArr = mindMap.split(',');
        $.each(splitedArr, function( index, mindMapId) {
            var oldHref = $('#mindLink_'+mindMapId).attr('href');
            var newHref = oldHref+'/'+btoa(mindMap);
            $('#mindLink_'+mindMapId).attr('href',newHref);
            //alert(newHref);
        });
        console.log(splitedArr);
    }
});
</script>
    <script type="text/javascript">
        "use strict"
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

        $('#comment_form').on('submit', function (e) {
            e.preventDefault();
            commenting();

        });


        //published the all checkbox
        $('input[type="checkbox"]').change(function () {
            var url = this.dataset.url;
            if (url != null) {
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
                        document.getElementById("comments").innerHTML += '<div class="single-question">\n' +
                            '                                        <div class="question-image">\n' +
                            '                                            <img src="' + item.image + '" alt="image">\n' +
                            '                                        </div>\n' +
                            '                                        <div class="question-content">\n' +
                            '                                            <p>' + item.comment + '</p>\n' +
                            '                                            <div class="content-bottom">\n' +
                            '                                                <h6 class="text-left">' + item.name + '</h6>\n' +
                            '                                                <span class="text-right">' + item.time + '</span>\n' +
                            '                                            </div>\n' +
                            '                                        </div>\n' +
                            '                                    </div>';
                    })
                }
            })
            $('#comment').val('');
        }

        /**/

        /*get content data*/
        function contentData(id) {
            var url = $('#contentVideoUrl-' + id).val();
            $.ajax({
                url: url,
                method: 'GET',
                success: function (result) {
                    console.log(result);
                    $('#videoId').empty();
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
            $('#videoId').append('  <iframe  class="embed-responsive-item"' +
                '                                        src="' + url + '"\n' +
                '                                        frameborder="0"\n' +
                '                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"\n' +
                '                                        allowfullscreen></iframe>');
        }

        /*for youtube*/
        function playYoutube(data) {
            $('#videoId').append('  <iframe class="embed-responsive-item"' +
                '                                        src="'+ data + '"\n' +
                '                                        frameborder="0"\n' +
                '                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"\n' +
                '                                        allowfullscreen></iframe>');
        }

        /*for vimeo video*/
        function playVimeo(data) {
            $('#videoId').append(' <iframe class="embed-responsive-item"' +
                '            src="https://player.vimeo.com/video/' + data + '"\n' +
                '             frameborder="0" allow="autoplay; fullscreen"\n' +
                '            allowfullscreen></iframe>');
        }

        /*for Html5 video*/
        function playHtml(data) {
            $('#videoId').append(' <video controls crossorigin playsinline id="player" class="html-video-frame" src="' + data + '"></video>');
        }

        /*for Html5 video*/
        function playFile(data) {
            $('#videoId').append(' <video controls crossorigin playsinline id="player" class="html-video-frame" src="' + data + '"></video>');
        }

        /*for Live Class video*/
        function liveClass(data) {
            $('#videoId').append('<a href="' + data + '"  class="float-play-icon" title="Live Class URL"><img src="{{ filePath('live.jpg') }}" class="w-100" alt="#Liveclass"><span class="as-play-icon"><i class="fa fa-video-camera m-auto" aria-hidden="true"></i></span></a>');
        }

        /*fot document*/
        function playDoc(data, item1, item2, description) {
            var dUrl = '';
            var isPdf = false;
            if(item2!=''){
            dUrl = '    <a href="' + data + '" class="btn btn-success btn-lg fa fa-download" >  ' + item2 + '</a>\n' ;
                var splitArr = data.split(/\.(?=[^\.]+$)/);
                console.log(splitArr);
                if(splitArr[1].toLowerCase() == 'pdf'){
                    isPdf = true;
                }
            }

            if(isPdf){
                $('#videoId').append(                    
                '  <iframe src="https://docs.google.com/viewer?url='+data+'&embedded=true" style="width:100%; min-height:500px;" title="'+item2+'"></iframe>\n' 
                );                
            }else{
                $('#videoId').append('<div class="card text-center w-100">\n' +
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
            $('.countDown').click();
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
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>
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
<script>

var _PDF_DOC,
    _CURRENT_PAGE,
    _TOTAL_PAGES,
    _PAGE_RENDERING_IN_PROGRESS = 0,
    _CANVAS = document.querySelector('#pdf-canvas');

// initialize and load the PDF
async function showPDF(pdf_url) {
    document.querySelector("#pdf-loader").style.display = 'block';

    // get handle of pdf document
    try {
        _PDF_DOC = await pdfjsLib.getDocument({ url: pdf_url });
    }
    catch(error) {
        alert(error.message);
    }

    // total pages in pdf
    _TOTAL_PAGES = _PDF_DOC.numPages;
    
    // Hide the pdf loader and show pdf container
    document.querySelector("#pdf-loader").style.display = 'none';
    document.querySelector("#pdf-contents").style.display = 'block';
    document.querySelector("#pdf-total-pages").innerHTML = _TOTAL_PAGES;

    // show the first page
    showPage(1);
}

// load and render specific page of the PDF
async function showPage(page_no) {
    _PAGE_RENDERING_IN_PROGRESS = 1;
    _CURRENT_PAGE = page_no;

    // disable Previous & Next buttons while page is being loaded
    document.querySelector("#pdf-next").disabled = true;
    document.querySelector("#pdf-prev").disabled = true;

    // while page is being rendered hide the canvas and show a loading message
    document.querySelector("#pdf-canvas").style.display = 'none';
    document.querySelector("#page-loader").style.display = 'block';

    // update current page
    document.querySelector("#pdf-current-page").innerHTML = page_no;
    
    // get handle of page
    try {
        var page = await _PDF_DOC.getPage(page_no);
    }
    catch(error) {
        alert(error.message);
    }

    // original width of the pdf page at scale 1
    var pdf_original_width = page.getViewport(1).width;
    
    // as the canvas is of a fixed width we need to adjust the scale of the viewport where page is rendered
    var scale_required = _CANVAS.width / pdf_original_width;

    // get viewport to render the page at required scale
    var viewport = page.getViewport(scale_required);

    // set canvas height same as viewport height
    _CANVAS.height = viewport.height;

    // setting page loader height for smooth experience
    document.querySelector("#page-loader").style.height =  _CANVAS.height + 'px';
    document.querySelector("#page-loader").style.lineHeight = _CANVAS.height + 'px';

    // page is rendered on <canvas> element
    var render_context = {
        canvasContext: _CANVAS.getContext('2d'),
        viewport: viewport
    };
        
    // render the page contents in the canvas
    try {
        await page.render(render_context);
    }
    catch(error) {
        alert(error.message);
    }

    _PAGE_RENDERING_IN_PROGRESS = 0;

    // re-enable Previous & Next buttons
    document.querySelector("#pdf-next").disabled = false;
    document.querySelector("#pdf-prev").disabled = false;

    // show the canvas and hide the page loader
    document.querySelector("#pdf-canvas").style.display = 'block';
    document.querySelector("#page-loader").style.display = 'none';
}



</script>
<script>
function openSolutionUnit() {

document.getElementById("mybottomsolutionUnit").style.height = "60%";
document.getElementById("mybottomsolutionUnit").style.bottom = "0";
}

function closeSolutionUnit(reportId) {
  document.getElementById("mybottomsolutionUnit").style.height = "0";
  document.getElementById("mybottomsolutionUnit").style.bottom = "-70px";
}
</script>
<script>
function openSolution() {

document.getElementById("mybottomsolution").style.height = "60%";
document.getElementById("mybottomsolution").style.bottom = "0";
}

function closeSolution(reportId) {
  document.getElementById("mybottomsolution").style.height = "0";
  document.getElementById("mybottomsolution").style.bottom = "-70px";
}
</script>
@endsection

