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
  margin-bottom:15px;
}
.card-test .card__content {
  width: 90%;
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
  padding: 10px 15px;
  border: none;
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
</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
          <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                    <h1>{{$s_course->title}}</h1>
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
                        <h4>{{$s_course->title}}</h4>
                        <div class="curriculum-accordion margin-top-30">
                            <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                <input value="{{route('seen.list',$s_course->id)}}" type="hidden" id="seenList">
                               @if(count($s_course->classes)>0)
                               @if(!empty($pkgId))
                            @foreach ($s_course->classes as $item)
                                @php  $chkArr = explode(',',$getChapter);  @endphp

                                @if(in_array($item->id,$chkArr))
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
                                                                        <div class="col-8">
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
                                                                        <div class="col-8">
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
                                    @endif

                                    
                                
                                @endforeach
                                 <!-- code block to list block items -->     
                                @foreach ($s_course->classes as $item)
                                @php  $chkArr = explode(',',$getChapter);  @endphp
                                    @if(!in_array($item->id,$chkArr))
                                    <div class="card">
                                        <div class="card-header" id="heading-{{ $item->id }}">
                                            <a href="#" role="button" data-toggle="collapse"
                                               data-target="#collapse-{{ $item->id }}"
                                               aria-expanded="false"
                                               aria-controls="collapse-{{ $item->id }}" class="collapsed d-flex justify-content-between px-1">
                                               <div style="max-width:180px;">{{ $item->title }}</div>
                                               <span class="locked mr-4 v-small" title="Not available in selected package."> @translate(Upgrade)</span>
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
                                    @endforeach

                                    @else
                                    @foreach ($s_course->classes as $item)
                                        
                                        <div class="card">
                                            <div class="card-header" id="heading-{{ $item->id }}">
                                                <a href="#" role="button" data-toggle="collapse"
                                                data-target="#collapse-{{ $item->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse-{{ $item->id }}" class="colapsed rounded-0 px-1"><span style="max-width:230px;">{{ $item->title }}</span></a>
                                            </div>

                                            <div id="collapse-{{ $item->id }}"
                                                class="collapse {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                                <div class="card-body">
                                            
                                                    @forelse ($item->contents as $content)
                                                    
                                                    @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                            <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                
                                                                <input type="hidden"
                                                                    id="contentVideoUrl-{{$content->id}}"
                                                                    value="{{route('class.content',$content->id)}}">
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
                                                                                @endif  {{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4 text-right">
                                                                                 <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                            </div>
                                                                        </div>

                                                                    @endif
                                                               
                                                            {{--
                                                                @if($content->source_code != null)
                                                                    <div class="msg-action-dot">
                                                                            <a class="resource-btn theme-btn-light"
                                                                            href="{{filePath($content->source_code)}}"
                                                                            target="_blank">

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
                                                        @endforeach
                                                
                                                                                                
                                                </div>
                                            </div>
                                        </div>
                                    
                                    @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="course-video-part mt-2 embed-responsive embed-responsive-21by9" id="videoId">
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
                                <li class="active">
                                    <a class="active" href="#overview" aria-controls="hot-jobs" role="tab" data-toggle="tab" aria-selected="true">@translate(overview)</a>
                                </li>
                                <li >
                                    <a href="#mindmap" aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false">@translate(Mind Maps)</a>
                                </li>
                                @if(env('CERTIFICATE_ACTIVE') === 'YES' && $PackageDetail != '')
                                    <li>
                                        @if($PackageDetail->package_type != 'competitive-courses')
                                            <a href="#practice" aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false"> @translate(Practice Test)</a>
                                        @else
                                            <a href="#practice" aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false"> @translate(Mock Test)</a>
                                        @endif                         
                                    </li>
                                @endif
                               
                                <li >
                                    <a href="#comment" aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false">@translate(Comment)</a>
                                </li>
                                {{-- <li  onclick="forModal('{{route('message.create',$s_course->id)}}','{{ $s_course->relationBetweenInstructorUser->name }}')">
                                    <a href="#message" aria-controls="recent-jobs" role="tab" data-toggle="tab" class="" aria-selected="false">@translate(Send message)</a>
                                </li> --}}
                              
                                
                            </ul>
                            <div class="hr-line"></div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade overview-content show active" id="overview">
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
                            </div>
                            
                            <div class="tab-pane fade overview-content" id="mindmap">
                                <div class="video-tab-title">
                                    <h5>@translate(Mind Maps)</h5>
                                </div>
                                <div class="video-playlist-sidebar d-none d-lg-block d-xl-block">
                                    <h4>{{$s_course->title}}</h4>
                                    <div class="curriculum-accordion margin-top-30">
                                        <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                            <input value="{{route('seen.list',$s_course->id)}}" type="hidden" id="seenList">
                    @php
                            $getCountMindMapCourse = \App\Model\MindMap::where(['course_id' => $s_course->id])->get();
                                                                                        
                     @endphp

                                        @if(isset($getCountMindMapCourse) && $getCountMindMapCourse->count() > 0)

                                                                                  
                                            @if(count($s_course->classes)>0)
                                                @if(!empty($pkgId))
                              
                                               
                                                            @foreach ($s_course->classes as $item)
                                                                @php  $chkArr = explode(',',$getChapter);  @endphp
                                                                
                                                                @if($item->mindMapCount->count() >0 )
                                                            
                                                                    @if(in_array($item->id,$chkArr))
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
                                                                                                            <div class="col-7">
                                                                                                                <a href="#" class="button-video line-height-1 text-left v-small">
                                                                                                                <i class="fa fa-play-circle mr-2"></i> {{ $content->title }}
                                                                                                                </a> 
                                                                                                            </div>
                                                                                                            <div class="col-5">
                                                                                                                <span class="time-span px-1 small line-height-1 float-right p-2"> <a href="{{ route('lesson.view_mind_map',$content->id) }}" class="badgemm " target="_blank"><span>Mind Maps <i class="fas fa-badge-check"></i></span></a> </span>
                                                                                                            </div>
                                                                                                        </div>
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
                                                                                                                <span class="time-span px-1 small line-height-1 float-right p-2"> <a href="{{ route('lesson.view_mind_map',$content->id) }}" class="badgemm " target="_blank"><span>Mind Maps <i class="fas fa-badge-check"></i></span></a> </span>
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
                                                                                            @endif
                                                                                        @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                       
                                                            <!-- code block to list block items -->     
                       

                                                    @else
                                                            @foreach ($s_course->classes as $item)
                                                                        
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
                                                                                                        <div class="col-7">
                                                                                                            <a href="#" class="button-video line-height-1 text-left v-small">
                                                                                                            <i class="fa fa-play-circle mr-2"></i>{{ $content->title }}
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div class="col-5 text-right">
                                                                                                            <span class="time-span px-1 text-right d-block v-small"> <a href="{{route('lesson.view_mind_map',$content->id)}}" class="badgemm" target="_blank"><span>Mind Maps <i class="fas fa-badge-check"></i></span></a> </span>
                                                                                                        </div>
                                                                                                    </div>
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
                                                                                                        <div class="col-5 text-right">
                                                                                                            <span class="time-span px-1 text-right d-block v-small"> <a href="{{route('lesson.view_mind_map',$content->id)}}" class="badgemm" target="_blank"><span>Mind Maps <i class="fas fa-badge-check"></i></span></a> </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            
                                                                                            {{--
                                                                                                @if($content->source_code != null)
                                                                                                    <div class="msg-action-dot">
                                                                                                            <a class="resource-btn theme-btn-light"
                                                                                                            href="{{filePath($content->source_code)}}"
                                                                                                            target="_blank">

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
                                <div class="tab-pane fade in announcement-content" id="practice">
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
                                                <div class="row col-lg-12">
                                                    @if($mockTests->count() > 0)
                                                    @foreach($mockTests as $mockTest)
                                                   <div class="col-lg-4">
                                                        <div class="card-test">
                                                            <div class="card__content">
                                                                <h3 class="card__header">{{ $mockTest->name }}- Mock Test</h3>
                                                                <div class="card__info">
                                                             @php   $totalMockTestAttend = \App\MockTestEnrollment::where(['test_type' => 'mockTest','user_id' => Auth::id(),'mock_test_id' => $mockTest->id ,'package_id' => $enroll[0]['package_id']])->count(); @endphp
            
                                                                @if($totalMockTestAttend != 0)
                                                                                        @if($totalMockTestAttend < $PackageDetail->no_of_test )
                                                                                    <p> <span class="badge bg-warning text-dark"> {{ $totalMockTestAttend }}/{{ $PackageDetail->no_of_test }}</span>    </p>  
                                                                                        <p><a href="{{ route('mock-test-detail',[$PackageDetail->id , $mockTest->id]) }}" class="btn btn-success">Re-attempt</a> </p>
                                                                                        @else
                                                                                        <p><span class="badge bg-warning text-dark"> {{ $totalMockTestAttend }}/{{ $PackageDetail->no_of_test }}</span></p>
                                                                                        <p class="btn btn-success">Completed</p> 
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                                                            <a class="btn btn-outline-dark btn-rounded" href="{{ route('mock-test-package',[$PackageDetail->id , $mockTest->id]) }}">View Details</a>
                                                                                        </div>
                                                                                    @else
                                                                                    <p><span class="badge bg-warning text-dark"> 0 /{{ $PackageDetail->no_of_test }}</span></p>                  
                                                                                    <p><a href="{{ route('mock-test-detail',[$PackageDetail->id , $mockTest->id]) }}" class="btn btn-primary">Attempt</a></p>
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
                                                    Error Occrred 5093 ! 
                                                    @endif
                                               
                                                </div>
                                                 @else
                                                   <div class="row col-lg-12">
                                                   <div class="col-lg-4">
                                                        <div class="card-test">
                                                            <div class="card__content">
                                                                <h3 class="card__header">Subject Test</h3>
                                                                <div class="card__info">
                                                                @if($totalAttend != 0)
                                                                                        @if($totalAttend < $PackageDetail->no_of_sectional_test )
                                                                                    <p> <span class="badge bg-warning text-dark"> {{ $totalAttend }}/{{ $PackageDetail->no_of_sectional_test }}</span>    </p>  
                                                                                        <p><a href="{{ route('subject-test-detail',$PackageDetail->id) }}" class="btn btn-success">Re-attempt</a> </p>
                                                                                        @else
                                                                                        <p><span class="badge bg-warning text-dark"> {{ $totalAttend }}/{{ $PackageDetail->no_of_sectional_test }}</span></p>
                                                                                        <p class="btn btn-success">Completed</p> 
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                            <a class="btn btn-outline-dark btn-rounded" href="{{ route('subject-test-package' , $PackageDetail->id)}}">View Details</a>
                                                        </div>
                                                                                    @else
                                                                                    <p><span class="badge bg-warning text-dark"> 0/{{ $PackageDetail->no_of_sectional_test }}</span></p> 
                                                                                                                
                                                                                    <p><a href="{{ route('subject-test-detail',$PackageDetail->id) }}" class="btn btn-primary">Attempt</a></p>
                                                                                    @endif
                                                                </div>
                                                                <!-- <div class="card-test-footer text-center">
                                                                    <a class="btn btn-outline-dark btn-rounded" data-toggle="collapse" href="#subjectTest" role="button" aria-expanded="false" aria-controls="collapseExample">View Details</a>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card-test">
                                                            <div class="card__content">
                                                                <h3 class="card__header">Unit Test</h3>
                                                                <div class="card__info">
                                                                @if($totalUnitAttend != 0)
                                                                                        @if($totalUnitAttend < $PackageDetail->no_of_practice_test )
                                                                                    <p> <span class="badge bg-warning text-dark"> {{ $totalUnitAttend }}/{{ $PackageDetail->no_of_practice_test }}</span>    </p>  
                                                                                        <p><a href="{{ route('unit-test-detail',$PackageDetail->id) }}" class="btn btn-success">Re-attempt</a> </p>
                                                                                      
                                                                                        @else
                                                                                        <p><span class="badge bg-warning text-dark"> {{ $totalUnitAttend }}/{{ $PackageDetail->no_of_sectional_test }}</span></p>
                                                                                        <p class="btn btn-success">Completed</p> 
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                                                            <a class="btn btn-outline-dark btn-rounded" href="{{ route('unit-test-package' , $PackageDetail->id)}}">View Details</a>
                                                                                        </div>
                                                                                    @else
                                                                                    <p><span class="badge bg-warning text-dark"> 0/{{ $PackageDetail->no_of_practice_test }}</span></p> 
                                                                                                                
                                                                                    <p><a href="{{ route('unit-test-detail',$PackageDetail->id) }}" class="btn btn-primary">Attempt</a></p>
                                                                                    @endif
                                                                </div>
                                                                <!-- <div class="card-test-footer text-center">
                                                                    <a class="btn btn-outline-dark btn-rounded" data-toggle="collapse" href="#subjectTest" role="button" aria-expanded="false" aria-controls="collapseExample">View Details</a>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card-test">
                                                            <div class="card__content">
                                                                <h3 class="card__header">Chapter Test</h3>
                                                                <div class="card__info">
                                                                @if($totalChapterAttend != 0)
                                                                                        @if($totalChapterAttend < $PackageDetail->no_of_test )
                                                                                    <p> <span class="badge bg-warning text-dark"> {{ $totalChapterAttend }}/{{ $PackageDetail->no_of_test }}</span>    </p>  
                                                                                        <p><a href="{{ route('chapter-test-detail',$PackageDetail->id) }}" class="btn btn-success">Re-attempt</a> </p>
                                                                                        @else
                                                                                        <p><span class="badge bg-warning text-dark"> {{ $totalChapterAttend }}/{{ $PackageDetail->no_of_test }}</span></p>
                                                                                        <p class="btn btn-success">Completed</p> 
                                                                                        @endif
                                                                                        <div class="card-test-footer text-center">
                                                                    <a class="btn btn-outline-dark btn-rounded" href="{{ route('chapter-test-package' , $PackageDetail->id)}}">View Details</a>
                                                    </div>
                                                                                    @else
                                                                                    <p><span class="badge bg-warning text-dark"> 0/{{ $PackageDetail->no_of_test }}</span></p> 
                                                                                                                
                                                                                    <p><a href="{{ route('chapter-test-detail',$PackageDetail->id) }}" class="btn btn-primary">Attempt</a></p>
                                                                                    @endif
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
                                                 
                                                        <!-- <div class="progress"
                                                             data-percentage="100">
															 
															<span class="progress-left">
																<span class="progress-bar"></span>
															</span>
                                                            <span class="progress-right">
																<span class="progress-bar"></span>
															</span>
															
                                                            <div class="progress-value">
                                                                <div>
                                                                    100
                                                                    %<br>
                                                                    <span>@translate(completed)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>												 -->
												 @if($quiz_status == 1 && $s_course->category->is_free_study!='1')
                                                    @if(isset($s_course->classes[0]->contents[0]))
                                                        <div class="text-center">
                                                         {{--   <a href="{{route('start',[$s_course->id, $s_course->classes[0]->contents[0]->id])}}" target="_blank" class="btn btn-success"> @translate(Give Assessment)</a> --}}
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
																				 style="width: 0%;"></div>
																		</div> <!-- End Skill Bar -->
																	</div>
																	<div
																		class="skill-bar-percent">0
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
                        <h4>{{$s_course->title}}</h4>
                        <div class="curriculum-accordion margin-top-30">
                            <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                <input value="{{route('seen.list',$s_course->id)}}" type="hidden" id="seenList">
                               @if(count($s_course->classes)>0)
                               @if(!empty($pkgId))
                            @foreach ($s_course->classes as $item)
                                @php  $chkArr = explode(',',$getChapter);  @endphp

                                @if(in_array($item->id,$chkArr))
                                    <div class="card">
                                        <div class="card-header" id="heading-{{ $item->id }}">
                                            <a href="#" role="button" data-toggle="collapse"
                                               data-target="#collapse-{{ $item->id }}"
                                               aria-expanded="false"
                                               aria-controls="collapse-{{ $item->id }}" class="colapsed rounded-0 px-1"><span style="max-width:290px;display:inline-block;">{{ $item->title }}</span></a>
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
                                                                            <div class="col-8">
                                                                                <a href="#" class="button-video line-height-1 text-left v-small">
                                                                                <i class="fa fa-play-circle mr-2"></i>{{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                            </div>
                                                                        </div>
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
                                                                                @endif
                                                                                                                {{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4">
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
                                    @endif

                                    
                                
                                @endforeach
                                 <!-- code block to list block items -->     
                                @foreach ($s_course->classes as $item)
                                @php  $chkArr = explode(',',$getChapter);  @endphp
                                @if(!in_array($item->id,$chkArr))
                                    <div class="card">
                                        <div class="card-header" id="heading-{{ $item->id }}">
                                            <a href="#" role="button" data-toggle="collapse"
                                               data-target="#collapse-{{ $item->id }}"
                                               aria-expanded="false"
                                               aria-controls="collapse-{{ $item->id }}" class="collapsed d-flex justify-content-between px-1"><div style="max-width:205px;">{{ $item->title }}</div><span class="locked mr-4" title="Not available in selected package."> @translate(Upgrade)</span></a>
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
                                                                                <a href="#" class="button-video line-height-1 text-left v-small">
                                                                                <i class="fa fa-play-circle mr-2"></i>{{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                            </div>
                                                                        </div>
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
                                                                                @endif{{ $content->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-4">
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
                                    @endforeach

                                    @else
                                    @foreach ($s_course->classes as $item)
                                        
                                        <div class="card">
                                            <div class="card-header" id="heading-{{ $item->id }}">
                                                <a href="#" role="button" data-toggle="collapse"
                                                data-target="#collapse-{{ $item->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse-{{ $item->id }}" class="colapsed rounded-0 px-1"><span style="max-width:290px;display:inline-block;">{{ $item->title }}</span></a>
                                            </div>

                                            <div id="collapse-{{ $item->id }}"
                                                class="collapse {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                                <div class="card-body">
                                            
                                                    @forelse ($item->contents as $content)
                                                    
                                                    @php  //if($content->provider=='Youtube')  'Youtube','HTML5','Vimeo','File','Live','Quiz' @endphp
                                                            <div class="single-course-video pb-1 d-block" onclick="contentData('{{$content->id}}')">
                                                                
                                                                <input type="hidden"
                                                                    id="contentVideoUrl-{{$content->id}}"
                                                                    value="{{route('class.content',$content->id)}}">
                                                                    @if ($content->is_preview == 1)

                                                                    <div class="row">
                                                                        <div class="col-8">
                                                                            
                                                                            <a href="#" class="button-video line-height-1 text-left small">
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
                                                                       
                                                                            <a href="#" class="button-video line-height-1 text-left small">
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
                                                                                <span class="time-span px-1 text-right d-block v-small">{{duration($content->duration)}}</span>
                                                                            </div>
                                                                    </div>

                                                                    @endif
                                                                
                                                                
                                                               
                                                            {{--
                                                                @if($content->source_code != null)
                                                                    <div class="msg-action-dot">
                                                                            <a class="resource-btn theme-btn-light"
                                                                            href="{{filePath($content->source_code)}}"
                                                                            target="_blank">

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
                                                        @endforeach
                                                
                                                                                                
                                                </div>
                                            </div>
                                        </div>
                                    
                                    @endforeach
                                    @endif
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
            $('#videoId').append('<a href="' + data + '" target="_blank" class="float-play-icon" title="Live Class URL"><img src="{{ filePath('live.jpg') }}" class="w-100" alt="#Liveclass"><span class="as-play-icon"><i class="fa fa-video-camera m-auto" aria-hidden="true"></i></span></a>');
        }

        /*fot document*/
        function playDoc(data, item1, item2, description) {
            var dUrl = '';
            var isPdf = false;
            if(item2!=''){
            dUrl = '    <a href="' + data + '" class="btn btn-success btn-lg fa fa-download" target="_blank">  ' + item2 + '</a>\n' ;
                var splitArr = data.split(/\.(?=[^\.]+$)/);
                console.log(splitArr);
                if(splitArr[1].toLowerCase() == 'pdf'){
                    isPdf = true;
                }
            }

            if(isPdf){
                $('#videoId').append(
                '  <iframe src="'+data+'" style="width:100%; min-height:500px;" title="'+item2+'"></iframe>\n' );                
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
@endsection

