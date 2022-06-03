@extends('layouts.master')
@section('content')
    
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/bootstrap.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/theme.css')}}"/>
    
<style>
.topbar {
    background-color: #ffffff;
    padding: 15px 30px;
    position: fixed;
    z-index: 9;
    left: 250px;
  width: 85%;
    border-bottom: 1px solid rgba(0, 0, 0, 0.03);
}
      
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
   .passed{
     margin-left: 37% ;
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
    
    
</style>
  <section class="heading-n-breadcrub-part mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="title-page">
                          <?php 
                          //echo "<pre>";print_r($pw_single_course->category->category_name);
                          ?>
                          <h3>{{$pw_single_course->title}} <br />
                          
                          @if($pw_single_course->category->parent)
                              <span style="font-size: 12px;margin-top: -4px;position:absolute">
                            {{$pw_single_course->category->parent->category_name}} {{' - '. $pw_single_course->category->category_name}}</span>
                          @else
                          <span style="font-size: 12px;margin-top: -4px;position:absolute">
                            {{ $pw_single_course->category->category_name}}</span>
                          @endif
                            </h3>
                        </div>              
                    </div>                    
                </div>
            </div>
  </section><br>
  <!--======================================
          END breadcrumb AREA
  ======================================-->
  @if (Session::has('message'))
      <div class="alert alert-success text-center">{{ Session::get('message') }}</div>
  @endif
  @php
  $seenPer = \App\Http\Controllers\ProjectWorkEnrollmentController::seenCoursePer($enroll->id,$enroll->user_id,$pw_single_course->id);
  @endphp
  
<section class="clearfix">
  <div class="container">
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
             <div class="heading-pbl-block green">Assessment</div>
             <div class="pbl-block-action">
               <div class="passed">
                        @if($mockTests->count() > 0)
                          @foreach($mockTests as $mockTest)
                          @php 
                            $mockTestAttended = \App\MockTestEnrollment::where(['test_type' => 'mockTest','test_status' => 'finish','user_id' => $enroll->user_id,'mock_test_id' => $mockTest->id ,'package_id' => $pw_single_course->id])->get();
                            $totalMockTestAttend = $mockTestAttended->count();
                          @endphp
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
                          @if($newPercentage>=60)                          
                              <h5 class="d-flex align-items-center">
                                <span class="badge bg-success text-white font-weight-normal">Passed</span>
                              </h5>
                          @else
                            <h5 class="d-flex align-items-center">
                                <span class="badge bg-danger text-white font-weight-normal">Failed</span>
                              </h5>
                          @endif                          
                        @endforeach
                      @endif
                </div>
               @if($seenPer>=50)
               <a href="#menu7"  class="cta">
                 <span class="hover-underline-animation"> Assessment</span>
                  <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                    <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
                  </svg>
               </a>
              @else
              
                 <span class="hover-underline-animation text-danger"> User not completed 50% of course </span>
                  
               
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
             <div class="heading-pbl-block">Submited Project</div>
             <div class="pbl-block-action">
               <a  data-toggle="pill" class="cta active">
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
             <div class="pbl-block-icon">
                <img src="{{asset('asset_rumbok/new/images/certificate-bnw.png')}}" alt=""/>
             </div>
             <div class="heading-pbl-block">Certificate</div>
             <div class="pbl-block-action">
               <a href="javascript:void(0);" class="cta">
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
             @php $i=1; @endphp
              @php $userPassed = false; @endphp
              @foreach ($pw_single_course->classes as $item)
                @if (count($item->contents) >= 1)
                  <div class="active col-sm-12">               
                    <section class="course-video-section padding-bottom-110">
                        <h4>{{$item->title}}</h4>
                        <div class="curriculum-accordion margin-top-30">
                            <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">                                  
                              <div class="card">                                      
                                    <div class="card-body">
                                      @forelse ($item->contents as $content)                                            
                                            <div class="row p-3">                                         
                                                <div class="col-8 text-left ">
                                                  <a>
                                                    {{ $content->title }} 
                                                  </a>
                                                </div>
                                              
                                              @if ( $seen_content != null )
                                              @if ( $seen_content->content_id == $content->id) 
                                                  <div class="col-4 text-right" style="color:green">                                                    
                                                    <i class="fa fa-check">seen</i> 
                                                  </div>
                                               
                                              @else
                                                <div class="col-4 text-right">                                                                                                          
                                                                                                        
                                                </div>
                                              @endif 
                                              @endif
                                             
                                            </div>                                           
                                           
                                      @endforeach
                                  </div>
                              </div>
                              
                            </div>
                        </div>
                    </section>
                  </div> <br><br>
                @else
                  <div></div>
                @endif
                @php $i++; @endphp
              @endforeach              
              <div class="active">
                <div class="row">
                
                  @forelse($pw_single_course->webinar as $webinar)
                  @if($webinar->webinarDetail != NULL)
                    @php
                        $splitRecordedUrl = str_replace("https://www.youtube.com/embed/","",$webinar->webinarDetail->recorded_video_url);
                    @endphp                  
                    <div class="col-md-4 pl-4">
                      <h4>Webinar</h4>
                        <div class="youtube-webinar-box">
                          <div class="youtube-container">
                          <div class="youtube-player" data-id="{{$splitRecordedUrl}}"></div>
                          </div>
                          <div class="youtube-webinar-content">
                            <h4>{{$webinar->webinarDetail->topic}}</h4>
                            <?php //echo "<pre>";print_r($webinar->webinarDetail->recorded_video_url);?>
                            <div class="d-flex align-items-center">
                              <p class="text-muted small">Start Date: {{frontendDateShow($webinar->webinarDetail->start_date)}}</p>
                              <p class="text-muted small ml-auto">End Date : {{frontendDateShow($webinar->webinarDetail->end_date)}}</p>
                            </div>
                          </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-12">
                       No Webinar is available.
                    </div>
                    @endif
                    @empty                   
                    <div class="col-md-12">
                       No Webinar is available.
                    </div>
                  @endforelse
               
                </div>              
              </div><br>            
              
              <div id="menu7"  class="container active">
                <div class="row">                                  
                  @if($mockTests->count() > 0)
                    @foreach($mockTests as $mockTest)
                  <div class="col-lg-4 col-6">
                      <div class="card-test">
                          <div class="card__content">
                              <h3 class="card__header">{{ $mockTest->name }}- Mock Test</h3>
                              <div class="card__info">
                                @php 
                                  $mockTestAttended = \App\MockTestEnrollment::where(['test_type' => 'mockTest','test_status' => 'finish','user_id' => $enroll->user_id,'mock_test_id' => $mockTest->id ,'package_id' => $pw_single_course->id])->get();
                                  
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
                                  <!-- <a href="{{-- route('pw-mock-test-package-details' ,[$pw_single_course->id,$enroll->user_id, $enrollIdForReport]) --}}" class="ml-auto v-small font-weight-normal"><u>View Report</u></a> -->
                                
                                </h4>
                                @else
                                  <h4>
                                    <span class="badge bg-danger text-white">Failed</span>                                   
                                  </h4>
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
                    <div></div> 
                  @endif                           
                </div>                
              </div>
              <div class="container active">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card-test shadow-none">
                        <div class="card__content shadow-none pt-0 mt-0">
                          <h3 class="card__header">Submited Project</h3>
                          <div class="card__info">
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
                            @else
                                <div>
                                  <p style="color: red; padding: 5%;">User Not Submitted Any project Report Yet !</p>
                                </div>
                            @endif
                          </div>
                        </div>
                      </div>     
                    </div> 
                  </div>
              </div>
              <div class="container active"><br>
                <div class="row">
                  <div class="col-md-12">
                  <h4>Mentor</h4><br>
                    <div class="row card-body">
                      @if($mentordata != null)
                        <div class="col-sm-5 pr-2"><img class=" rounded-circle" src="{{filePath($mentordata->photo) }}"></div> 
                        <div class="col-sm-7 "> 
                              <h3> {{ isset($mentordata)?$mentordata->profile_title:''}}</h3> 
                              <div class=""> 
                                <div class="pmp-adv-profile">
                                    <h6>{{ isset($mentordata)?$mentordata->name:''}}</h6> 
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
                        @else
                      <div class="text-left"><img src="{{url('public/uploads/media_manager/33.png')}}" class="rounded-circle avatar-lg" alt="avatar"></div>                      
                      @endif
                    </div>
                  </div>
                </div>
              </div><br>   
          </div> 
        </div>
      </div>
  </div>
  
</section>

@endsection
@section('js')    
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

    </div>
   

@endsection