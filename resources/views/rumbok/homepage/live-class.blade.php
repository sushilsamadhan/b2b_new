@extends('rumbok.app')
@section('content')
<style>
.section-title h2 span {
    color: #f4791e;
}
.card-content {
  position: relative;
  animation: animatop 0.9s cubic-bezier(0.425, 1.14, 0.47, 1.125) forwards;
  margin-bottom: 30px;
}
.card-class {
  width: 100%;
  min-height: 100px;
  padding: 20px;
  border-radius: 3px;
  background-color: white;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
  position: relative;
  overflow: hidden;
}
.card-class:after {
  content: "";
  display: block;
  width: 190px;
  height: 300px;
  background: #253a73;
  position: absolute;
  animation: rotatemagic 0.75s cubic-bezier(0.425, 1.04, 0.47, 1.105) 1s both;
}

.badgescard {
  padding: 10px 20px;
  border-radius: 3px;
  background-color: #e86a2f;
  width: 96%;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
  position: absolute;
  z-index: -1;
  left: 10px;
  bottom: -10px;
  /* animation: animainfos 0.5s cubic-bezier(0.425, 1.04, 0.47, 1.105) 0.75s forwards; */
}
.badgescard span {
  font-size: 1.6em;
  margin: 0px 6px;
  opacity: 0.6;
}

.card-class .firstinfo {
    display:flex;
  flex-direction: row;
  z-index: 2;
  position: relative;
}
.card-class .firstinfo img {
  border-radius: 50%;
  width: 120px;
  height: 120px;
}
.card-class .firstinfo .profileinfo {
  padding: 0px 0px 0px 20px;
}
.card-class .firstinfo .profileinfo h1 {
    font-size: 1.0em;
    font-weight: 600;
    margin-bottom: 0;
}
.card-class .firstinfo .profileinfo h3 {
  font-size: 1.0em;
  color: #253a73;
  font-weight:normal;
  margin-bottom:0;
}
.card-class .firstinfo .profileinfo p.bio {
  padding: 5px 0px;
  color: #5A5A5A;
  line-height: 1.2;
  font-style: initial;
}
.profileinfo a.link-btn {
    font-size: 13px;
    color: #e86a2f;
}
.live-class {
    background: #fd0000;
    color: #fff;
    padding: 2px 8px 2px 20px;
    border-radius: 50px;
    font-size: 19px;
    line-height: 1;
    z-index: 2;
    right: 25px;
    top: -5px;
    animation: blinker 1s linear infinite;
}
.live-class:before {
    width: 10px;
    height: 10px;
    background: #fff;
    content: '';
    position: absolute;
    left: 5px;
    border-radius: 50%;
    top: 6px;
}
@keyframes blinker {
  50% {
    opacity: 0;
  }
}
@media (max-width:550px) {
.card-class:after {
    display:none;
}
.card-class .firstinfo {
    display:block;
}
.card-class .firstinfo .profileinfo {
    padding: 0px 0px;
}
}
@keyframes animatop {
  0% {
    opacity: 0;
    bottom: -500px;
  }
  100% {
    opacity: 1;
    bottom: 0px;
  }
}
@keyframes animainfos {
  0% {
    bottom: 10px;
  }
  100% {
    bottom: -42px;
  }
}
@keyframes rotatemagic {
  0% {
    opacity: 0;
    transform: rotate(0deg);
    top: -24px;
    left: -253px;
  }
  100% {
    transform: rotate(-30deg);
    top: -24px;
    left: -78px;
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
                            <h1>Live Classes & Schedule</h1>
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
                        <span>Live Classes & Schedule</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
    <section class="feature-section">
        <div class="container">
        <div class="row">
          @if (count($instructors) > 0)            
        @foreach($instructors as $instructor)
        <div class="col-md-6">
            <div class="card-content">
                <div class="card-class">
                    <div class="firstinfo ">
                    <?php $showRegisterBtn = true;
                    $instructor_live_class_id = base64_encode($instructor->id);
                    ?>
                    @if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructor->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructor->end_time) )
                    <?php 
                      
                      $showRegisterBtn = true;
                    ?>
                     <span class="position-absolute live-class">Live</span>
                     
                    @endif  
                     @if($instructor->instructorDetail->image)     
                      <img src="{{filePath($instructor->instructorDetail->image)}}" alt="{{$instructor->instructorDetail->name}}">
                        @else
                        <img src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="" />
                        @endif  
                       <div class="profileinfo flex-grow-1">
                       @php 
                            $subject = \App\Model\Course::where('id' , $instructor->instructor_subject_id)->first();
                            $catDetailname = "";
                        @endphp
                        @if($subject)
                            {{ $subject['title'] }}
                            <?php 
                              $subjectDetail = \App\InstructorAssessment::where(['subject_id'=>$instructor->instructor_subject_id])->first();
                              $catDetail = \App\Model\Category::where('id',$subjectDetail->class_id)->first();
                              $catDetailname = $catDetail->name;
                            ?>
                        @else

                            {{ $instructor->instructor_subject_id }}

                        @php

                        // $subject = \App\QuestionTag::where('id' , $item->instructorDetail->id)->first();
                     
                        @endphp
                            {{-- $subject['tag_name'] --}}
                        @endif
                         <?php 
                              //echo $instructor->instructor_subject_id; die('======');
                         ?>
                        <h5 class="my-0">   

                              {{ $catDetailname }}
                              
                        </h5>
                        <h1>{{ $instructor->live_class_title }}</h1>
                        <!-- <span class="badge badge-warning">Grade 8th - 10th</span> -->
                        <h3>{{  date('g:i A', strtotime($instructor->start_time)) }},{!! date('D d M', strtotime($instructor->date)) !!}.  </h3>
                        <p class="bio text-uppercase mb-0 text-dark">{{ $instructor->instructorDetail->name }} <br><span class="text-muted small font-italic">{{ $instructor->instructorDetail->heighst_qualification }} <span class="badge badge-success font-weight-normal">Experience {{ $instructor->instructorDetail->total_experience}}</span></span></p>
                        @php  $getTimeTables  =   \App\InstructorAssessment::leftjoin('categories as cat','cat.id','=','instructor_subjects.course_id')
                 ->leftjoin('categories as subCat','subCat.id','=','instructor_subjects.class_id')
                ->leftjoin('courses as c','c.id','=','instructor_subjects.subject_id')
                ->leftjoin('question_tags as d','d.id','=','instructor_subjects.subject_id')
                ->select('subCat.name as subCat','cat.name','c.title','d.tag_name','instructor_subjects.*')
               ->orderBy('id', 'DESC')->where('instructor_id',$instructor->instructor_id)->get();
                @endphp
          
                    @if($getTimeTables->count() > 0)
                       <p class="mb-0"> 
                     @php $unique_array = [];        
                          
                     @endphp
               
                     @if($getTimeTables)
                        @foreach($getTimeTables->unique('title')  as $getTimeTable)
                        @if($getTimeTable->subject_id)
                        @php 
                          $subjectName = App\Model\Course::where('id' , $getTimeTable->subject_id )->first(); 
                          $subjectName1 = App\QuestionTag::where('id' , $getTimeTable->subject_id )->first();
                        @endphp 
                        @endif
                       
                   
                        @if($getTimeTable->course_type == 'board' )
                          @if(isset($subjectName) && $subjectName->title!='')
                          <span class="label bg-light border rounded px-2 small mr-1">
                            {{$subjectName ? $subjectName->title : '' }}
                          </span>
                          @endif
                        @else
                        @if($subjectName1->tag_name!='')
                           <span class="label bg-light border rounded px-2 small mr-1">
                             
                              {{ $subjectName1->tag_name }}
                             
                            </span> 
                            @endif
                          @endif
                         @endforeach
                         @endif
                         </p>
                     
                         @endif
                        <div class="d-flex justify-content-end mt-1">
                            {{--<a href="{{ route('class-time-table' , $instructor->id)}}" class="link-btn">Time Table</a>--}}
                            @if($showRegisterBtn)
                          @auth
                          @if (Auth::user()->user_type === "Student")
                          <?php 
                            $liveClassDetail = \App\LiveClassSubscription::where(['instructor_live_class_id'=>$instructor->id])->first();
                          ?>
                              @if($liveClassDetail)
                                <span>
                                  <a class="btn btn-success btn-sm py-1 line-height-1"  href='{{ url("live-class/".$instructor_live_class_id) }}'>Join Now</a>
                                </span>
                              @else
                                <span>
                                  <a  href="{{url('free-live-class/'.$instructor_live_class_id)}}" class="btn btn-website-color line-height-1 btn-sm">
                                  Book Now</a>
                                </span>
                              @endif

                            @else
                            <span>
                              <a  href="{{url('free-live-class/'.$instructor_live_class_id)}}" class="btn btn-website-color line-height-1 btn-sm">
                              Book Now</a>
                            </span>
                          @endif
                          @endauth
                          @guest
                          <span>
                            <a  href="{{url('free-live-class/'.$instructor_live_class_id)}}" class="btn btn-website-color line-height-1 btn-sm">
                            Book Now</a>
                          </span>
                          @endguest
                       @endif
                            
                        </div>
                    </div>
                    </div>
                </div>
                <div class="badgescard"> 
                    
                </div>
            </div>
        </div>
         @endforeach
         @else
         <div class="col-12">
            <div class="row">
                <div class="col-md-6 offset-md-3"><a href="{{url('/')}}"> <img src="{{asset('no-live-classes-found.gif')}}" class="w-100 img-fluid"></a></div>
            </div>
        </div>
         @endif        
        </div>
        </div>
    </section>
    
@endsection


