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
padding: 0px 20px;
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
background: green;
color: #fff;
padding: 2px 8px 2px 20px;
border-radius: 10px;
font-size: 13px;
line-height: 1;
z-index: 2;
left: 0;
top: -5px;
}
.live-class:before {
width: 10px;
height: 10px;
background: #fff;
content: '';
position: absolute;
left: 5px;
border-radius: 50%;
top: 3px;
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
.term-grid {
max-width: 100%;
margin: auto;
display: grid;
grid-template-columns: repeat(5, minmax(0, 1fr));
grid-gap: 2em;
color: #222;
border-bottom: 1px solid #ddd;
padding: 0.2em 0.5em;
}
.grid-header {
background: #253a73;
color: #fff;
}
.term-grid label {
font-weight: 600;
font-size:13px;
text-align: center;
margin-bottom:0;
}
.term-grid label:first-child {
text-align: left;
}
/* .grid-header {
text-decoration: underline;
border-bottom: unset;
} */
.time {
font-size: 11px;
line-height: 1;
text-align: center;
}
.join-now-btn {
  margin-top: 10px;
text-align: center;
}
.join-now-btn a {
background: #4caf50;
font-size: 12px;
padding: 1px 5px;
border-radius: 10px;
color: #fff;
}
@media (max-width: 991px) {
.time-table .container {
width:100%;
max-width:100%;
}
}
@media (max-width:991px) {
.term-grid {
grid-template-columns: repeat(4, minmax(0, 1fr));
grid-gap: 0.5em;
border-top:1px solid #ddd;
}
.monday {
text-align:center;
border: 1px solid #ddd;
background: #fafafa;
}
.monday:before {
content:'Monday';
font-weight:600;
font-size:13px;
}
.tuesday {
text-align:center;
border: 1px solid #ddd;
background: #fafafa;
}
.tuesday:before {
content:'Tuesday';
font-weight:600;
font-size:13px;
}
.wednesday {
text-align:center;
border: 1px solid #ddd;
background: #fafafa;
}
.wednesday:before {
content:'Wednesday';
font-weight:600;
font-size:13px;
}
.thursday {
text-align:center;
border: 1px solid #ddd;
background: #fafafa;
}
.thursday:before {
content:'Thursday';
font-weight:600;
font-size:13px;
}
.friday {
text-align:center;
border: 1px solid #ddd;
background: #fafafa;
}
.friday:before {
content:'Friday';
font-weight:600;
font-size:13px;
}
.saturday {
text-align:center;
border: 1px solid #ddd;
background: #fafafa;
}
.saturday:before {
content:'Saturday';
font-weight:600;
font-size:13px;
}
.sunday {
text-align:center;
border: 1px solid #ddd;
background: #fafafa;
}
.sunday:before {
content:'Sunday';
font-weight:600;
font-size:13px;
}
.term-grid label:first-child {
text-align: center;
margin: 0;
background: #e86a2f;
color: #fff;
grid-column-start: 1;
grid-column-end: 5;
grid-row-start: row1-start;
grid-row-end: 1;
}
.alternate {
margin-top: -10px;
font-style: italic;
order: 1;
}

.definition {
order: 2;
}
.grid-header {
display: none;
}
}
@media (max-width: 767px) {
.time-table .container {
width:100%;
}
.monday {
text-align:center;
}
.monday:before {
content:'Monday';
font-weight:600;
font-size:13px;
}
.tuesday {
text-align:center;
}
.tuesday:before {
content:'Tuesday';
font-weight:600;
font-size:13px;
}
.wednesday {
text-align:center;
}
.wednesday:before {
content:'Wednesday';
font-weight:600;
font-size:13px;
}
.thursday {
text-align:center;
}
.thursday:before {
content:'Thursday';
font-weight:600;
font-size:13px;
}
.friday {
text-align:center;
}
.friday:before {
content:'Friday';
font-weight:600;
font-size:13px;
}
.saturday {
text-align:center;
}
.saturday:before {
content:'Saturday';
font-weight:600;
font-size:13px;
}
.sunday {
text-align:center;
}
.sunday:before {
content:'Sunday';
font-weight:600;
font-size:13px;
}
.term-grid {
grid-template-columns: repeat(2, minmax(0, 1fr));
grid-gap: 0.5em;
border-top:1px solid #ddd;
}

.term-grid label:first-child {
text-align: center;
margin: 0;
background: #e86a2f;
color: #fff;
grid-column-start: 1;
grid-column-end: 3;
grid-row-start: row1-start;
grid-row-end: 1;
}
.alternate {
margin-top: -10px;
font-style: italic;
order: 1;
}

.definition {
order: 2;
}
.grid-header {
display: none;
}
}
.daily-schedule-block {
    z-index: 1 !important;
}
</style>
<style>
.radio-toolbar .for_class_name_type {
display: none;
}
.radio-toolbar label {
    display: block;
    padding: 0px 0px;
    font-family: Arial;
    font-size: 16px;
    pointer-events: all;
    cursor: pointer;
    color: #000;
    font-weight: normal;
    text-align: center;
    border-radius: 3px;
    height: 100%;
    display: table;
    width: 100%;
    vertical-align: middle;
}
.radio-toolbar .for_class_name_type:checked+label span {
background-color: blue;
color: #fff;
}
.listed-items.h-100.disabled {
    cursor: not-allowed;
}
.listed-items.h-100 {
    cursor: pointer;
}

.listed-items.disabled {
    background-color: #efefef;
    opacity: 0.5;
    border: 1px dotted orange;
}
</style>
<section class="heading-n-breadcrub-part header-project">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="d-flex align-items-center">
          <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
          <div class="bread-crumb-part">
          <ul class="bread-crumb-part-list">
            <li>
              <a href="#"  class="text-white">Home</a>
            </li>
            <li>
              <span  class="text-white">Live Tuition</span>
            </li>
          </ul>
        </div>
          <div class="title-page">
            <!-- <h1 class="text-white">Live Tuition</h1> -->
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        
      </div>
    </div>
  </div>
</section>
<div class="container">
  {{--<div class="row my-3">
    <div class="col-12">
      <div class="three-step-heading">
        <h3>Find your schedule</h3>
        <div class="search-steps"><span class="center-step"></span></div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="daily-schedule-main-block block-1 h-100">
          <div class="daily-schedule-block h-100">
            <div class="schedule-block-icon">
              <img src="{{asset('asset_rumbok/new/images/select-course.png')}}" class="img-fluid"/>
            </div>
            <div class="schedule-step"><span class="step-name">Step 1</span></div>
            <div class="schedule-heading-box">Select Your Preference</div>
          </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="daily-schedule-main-block block-2 h-100">
          <div class="daily-schedule-block h-100">
            <div class="schedule-block-icon">
              <img src="{{asset('asset_rumbok/new/images/select-exam.png')}}" class="img-fluid"/>
            </div>
            <div class="schedule-step"><span class="step-name">Step 2</span></div>
            <div class="schedule-heading-box">Select Your Board/Preparation</div>
          </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="daily-schedule-main-block block-3 h-100">
          <div class="daily-schedule-block h-100">
            <div class="schedule-block-icon">
              <img src="{{asset('asset_rumbok/new/images/slect-class.png')}}" class="img-fluid"/>
            </div>
            <div class="schedule-step"><span class="step-name">Step 3</span></div>
            <div class="schedule-heading-box">Choose Your Class/Exam</div>
          </div>
      </div>
    </div>
  </div>--}}

<div class="row">
 <div class="col-md-8">
  <div class="p-3 clearfix bg-light border rounded">
      <div class="row">
        @if(empty($student))
          <div class="col-md-12">
                      <div class="float-left">
                        <h4 class="font-weight-normal">
                            Book Live Tuition
                        </h4>
                      </div>
                      <div class="float-right">

                      </div>
              </div>
        @endif

        @if(!empty($student))
            @if($student->class_type == "" || $student->board == "" || $student->class_name == "")
              <div class="col-md-12">
                      <div class="float-left">
                        <h4 class="font-weight-normal">
                            Book Live Tuition
                        </h4>
                      </div>
                      <div class="float-right">

                      </div>
              </div>
            @else
            @php
                $boardsname = \App\Model\Category::where('id',$student->board)->first();
                $classesname = \App\Model\Category::where('id',$student->class_name)->first();
            @endphp
              
                    <div class="col-md-12">
                      <div class="float-left">
                        <h4 class="font-weight-normal">
                           Book Live Tuition For
                            @if($boardsname)
                            {{$boardsname->name}}
                            {{$classesname->name}}
                             @endif
                        </h4>
                      </div>
                      <div class="float-right">
                          <a  id="forallreadyShow" style="cursor:pointer;" class="change-btn text-right">Change</a>
                      </div>
                    </div>
             

            @endif
            @endif
            @guest
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="" for="package_type"> Preference <span class="text-danger">*</span></label>
                        <select class="form-control langr stpicker" id="package_type" name="package_type" onchange="getBoardOrCompetitive(this.value);">
                          <option value=""> Select</option>
                          <option value="board">Academic Courses</option>
                          <option value="competitive-courses">Competitive Courses</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="" for="val-category_id">Board/Exam <span class="text-danger">*</span></label>
                        <div class="">
                          <select class="form-control langr " id="val-category_id" name="category_id" onchange="getBoardClasses(this.value);">
                            <option value=""> Please Select</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label class="" for="show_for_class">Class/Courses <span class="text-danger">*</span></label>
                        <div class="">
                          <select class="form-control langr " id="show_for_class" name="" onchange="getinstructor_subjectsClasses(this.value);" >
                            <option value=""> Please Select</option>
                          </select>
                        </div>
                      </div>
                    </div>




            <div class="col-md-12 px-0 ">
              <div class="job-tab">
              <ul class="nav nav-tabs radio-toolbar border-0" id="show_for_class_subject">

              </ul>
              </div>
            </div>
            @endguest
             @if(empty($student))
      <div class="alert align-default text-center">
        Dear User, Please fill your tuition preferences above to book <span class="text-danger text-uppercase border-bottom border-danger h5 blinking-live"><i class="fa fa-wifi" aria-hidden="true"></i> LIVE</span> TUITION classes.
      </div>
             @endif
            @auth
 @if(!empty($student))
                    <div id="forallready1" class='col-md-4'  @if($student->class_type == "" || $student->board == "" || $student->class_name == "")  @else style='display:none;' @endif>
                      <div class="form-group">
                        <label class="" for="package_type"> Preference <span class="text-danger">*</span></label>
                        <select class="form-control langr stpicker" id="package_type" name="package_type" onchange="getBoardOrCompetitive(this.value);">
                          <option value=""> Select</option>
                          <option @if($student->class_type == 'k12') {{ 'selected' }} @endif value="board">Academic Courses</option>
                          <option @if($student->class_type == '18+') {{ 'selected' }} @endif value="competitive-courses">Competitive Courses</option>
                        </select>
                      </div>
                    </div>
                    <div id="forallready2" class='forallready col-md-4'  @if($student->class_type == "" || $student->board == "" || $student->class_name == "")  @else style='display:none;' @endif>
                      <div class="form-group">
                        <label class="" for="val-category_id">Board/Exam <span class="text-danger">*</span></label>
                        <div class="">
                            <select class="form-control langr " id="val-category_id" name="category_id" onchange="getBoardClasses(this.value);">
                              <option value=""> Please Select</option>
                              @php
                              $boards = \App\Model\Category::where('parent_category_id',83)->get();
                              @endphp
                              @foreach($boards as $boardsval)
                          <option @if($student->board == $boardsval->id) {{ 'selected' }} @endif value="{{ $boardsval->id }}">{{ $boardsval->name }}</option>
                            @endforeach

                            </select>
                        </div>
                      </div>
                    </div>
                    <div id="forallready3" class='forallready col-md-4'  @if($student->class_type == "" || $student->board == "" || $student->class_name == "")  @else style='display:none;' @endif>
                      <div class="form-group">
                      <label class="" for="show_for_class">Class/Courses <span class="text-danger">*</span></label>
                        <div class="">
                          <select class="form-control langr " id="show_for_class" name="" onchange="getinstructor_subjectsClasses(this.value);" >
                            <option value=""> Please Select</option>
                              @php
            $classes = \App\Model\Category::where('parent_category_id',$student->board)->get();
                              @endphp
                              @foreach($classes as $classesval)
                          <option @if($student->class_name == $classesval->id) {{ 'selected' }} @endif value="{{ $classesval->id }}">{{ $classesval->name }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>
                    </div>
    @if($student->class_type == "" || $student->board == "" || $student->class_name == "")

      <div class="alert align-default text-center">
        Dear User, Please fill your tuition preferences above to book <span class="text-danger text-uppercase border-bottom border-danger h5 blinking-live"><i class="fa fa-wifi" aria-hidden="true"></i> LIVE</span> TUITION classes.
      </div>

    @endif
                    <div class="col-md-12 px-0 ">
                    <h6 class='my-3 text-center @if($student->class_type == "" || $student->board == "" || $student->class_name == "") d-none @endif' id="Choose_a_Subject">Choose a Subject</h6>
                      <div class="nav nav-tabs radio-toolbar border-0" id="show_for_class_subject">
                        
                      <!-- <div class="row"> -->

                              @php
            $courses_detail = \App\Model\Course::where("category_id",$student->class_name)->where('is_free','=','0')->select('title','id')->get();
            $i=0;
                              @endphp
                              @foreach($courses_detail as $courses_detailval)
                          <div class="col-md-4 mb-3">
                            <input onclick="getinstructor_tutition({{ $courses_detailval->id }},'{{ $courses_detailval->title }}');" id="class_name_{{ $courses_detailval->id }}" type="radio" name="class_name" value="{{ $courses_detailval->id }}" class="for_class_name_type" 
      @if($i == 0)
      {{ 'checked' }}
      @endif
                            > <label for="class_name_{{ $courses_detailval->id }}"><span class="border border-dark rounded py-1 px-2">{{ $courses_detailval->title }}</span></label> 
                          </div>
                          @php $i++; @endphp
            @endforeach
                        

                      <!-- </div> -->
                      </div>
                    </div>
                    @endif
            @endauth

      </div>
  </div>  
  <div class="row" id="show_for_all_class_shedule">

  </div>









<style>
.section-title h2 span {
    color: #f4791e;
}
.card-tution {
  border: 1px solid #ddd;
  padding: 10px 15px;
  box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.12);
  margin-bottom:20px;
}
.card-tution .teacher-deatails .teacher-name h3 {
  font-size: 18px;
  font-weight: 600;
  color: #000;
  margin-bottom: 0;
}
.teacher-deatails .teacher-name p {
  color: #8c8c8c;
  text-transform: uppercase;
  font-size: 13px;
  margin-bottom: 5px;
}
.date-time-tution .tutuion-day-date {
  font-size: 13px;
  font-weight: 600;
}
.date-time-tution .tutuion-day-time {
  font-size: 13px;
  font-weight: 600;
}
.date-time-tution {
  background: #ffdac8;
  border: 1px solid #e86a2f;
  text-align: center;
  padding: 5px;
  border-radius: 5px;
  margin-bottom: 5px;
}
.class-board {
  background: #253a73;
  color: #fff;
  line-height: 1;
  border-radius: 4px;
  font-size: 10px;
  padding: 5px 5px;
  text-transform: uppercase;
  text-align: center;
  max-width: 100px;
  margin: 5px auto;
}
.teacher-img {
    width: 86px;
    height: 86px;
    margin: 0 auto;
    margin-bottom: 5px;
    border-radius: 50%;
    overflow: hidden;
}
.teacher-img img.img-fluid {
    height: 100%;
}
a.join-now.not-active {
  background: #888;
  text-decoration: none;
  color: #fff;
  border-radius: 3px;
  padding: 5px 10px;
  line-height: 1;
  display: inline-block;
  font-size: 12px;
  text-transform: uppercase;
}
.change-btnhis {
    color: #0063de !important;
    border-bottom: 1px dotted #0063de;
/*    position: relative;
    padding-right: 10px;*/
    font-size: 14px;
}
</style>
<?php
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
// echo date('d-m-Y H:i:s');
?>
    <section class="feature-section mt-5">
       {{--@if($dataBooking == "")--}}
          @if(count($dataBooking) > 0)
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="float-left">
                <h5>My Upcoming Tuition</h5>
              </div>
              <div class="float-right">
                <a href="{{url('my/tuition')}}" class="change-btnhis text-right">History</a>
              </div>
            </div>
          </div>
        <div class="row py-0">
          @foreach($dataBooking as $valBooking)
        <div class="col-lg-12 col-md-12">
        <div class="card-tution">
                <div class="row py-0">
                    <div class="col-md-4">
                        <div class="class-board">{{$valBooking->boardname}} - {{$valBooking->classname}}</div>
                        <div class="teacher-img">
                        @if($valBooking->image)     
                      <img src="{{filePath($valBooking->image)}}" alt="{{$valBooking->insname}}" class="img-fluid">
                        @else
                        <img src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="" class="img-fluid"/>
                        @endif 
                        </div>
                        @php

                        $startTime = date("H:i", strtotime('- 10 minutes', strtotime($valBooking->start_time)));
                $end_time = date("H:i", strtotime('- 0 minutes', strtotime($valBooking->end_time)));

                        $currentdate = date('H:i', time());
                        @endphp
                        @if($startTime < $currentdate && $end_time > $currentdate)
                        <div class="clearfix text-center"><a class="bg-success join-now active" href="{{url('my/demojitsi')}}/{{$valBooking->unic_jitsi_code}}">Join Now</a></div>   

                        @else

                        <div class="clearfix text-center"><a class="join-now not-active" href="#">Join Now</a></div> 

                        @endif 
                    </div>
                    <div class="col-md-8">
                        <div class="teacher-deatails">
                            <div class="teacher-name">
                                <h3>{{$valBooking->insname}}</h3>
                                <p>{{$valBooking->title}}</p>
                            </div>
                            <div class="date-time-tution">
                                    <div class="tutuion-day-date"><i class="fa fa-calendar"></i> {{date('l', strtotime($valBooking->date_of_booking))}}, {{$valBooking->date_of_booking}}</div>
                                    <div class="tutuion-day-time ml-auto"><i class="fa fa-clock"></i> {{$valBooking->time_of_booking}}</div>
                            </div>
                            <div class="d-flex align-items-center">
                                @php

                                  $startTime = date("H:i", strtotime('- 5 minutes', strtotime($valBooking->start_time)));
                $end_time = date("H:i", strtotime('- 0 minutes', strtotime($valBooking->end_time)));

                                  $currentdate = date('H:i', time());
                                  @endphp
                                  @if($startTime < $currentdate && $end_time > $currentdate)
                                 
                                      

                                  @else

                                  <p class="mb-0 small text-danger line-height-1">*Join link would active before 5 minutes </p>
                                  

                                  @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            
        </div> 
         @endforeach
       
        </div>
        </div>
         @endif
         {{--@endif--}}
    </section>












 </div>
 <div class="col-md-4">
 <img src="{{asset('asset_rumbok/new/images/side-banner-one-tone.jpg')}}" class="img-fluid"/>
 </div>
</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
$('#forallreadyShow').click(function() {
    $("#forallready1").toggle(1000);
    $("#forallready2").toggle(1000);
    $("#forallready3").toggle(1000);
});
const myTimeout = setTimeout(myGreeting, 1000);

function myGreeting() {
  var class_name = $('input[name="class_name"]:checked').val();
  $('#class_name_'+class_name).trigger('click');
  
}
function getBoardOrCompetitive(workval){
@guest()
var myhtml = document.createElement("div");
         myhtml.innerHTML = "<div style=' text-align: center; '>Login to your <b>OLEXPERT</b> account to view the Live Class schedule!<div>";
        swal({
            title: "",
            content: myhtml,
            icon: "warning",
            buttons: "Proceed to Login",
            closeOnClickOutside: false,
           })
        .then((willDelete) => {
          if (willDelete) {
            window.location.href = "{{ route('login') }}";
          } 
        });
@endguest
@auth
if(workval=="board"){
var urlin = "{{url('tuition-get-board')}}";
}
if (workval=="competitive-courses") {
var urlin = "{{url('tuition-get-competitive-courses')}}";
}
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
document.getElementById("val-category_id").innerHTML =
this.responseText;
}
xhttp.open("GET", urlin);
xhttp.send();
@endauth
}


function getBoardClasses(classid) {
var package_type = $("#package_type").val();
// if(package_type=='board'){
  document.getElementById("show_for_all_class_shedule").innerHTML = '';
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
document.getElementById("show_for_class").innerHTML =
this.responseText;
}
xhttp.open("GET", "{{url('tuition-get-board-classes')}}/"+classid);
xhttp.send();
// }
}

function getinstructor_subjectsClasses(category_id) {
          @if(!empty($dataBooking))   
          @if(!empty($student))

            @if($student->class_type == "" || $student->board == "" || $student->class_name == "")

            //var date_of_booking = $('input[name="day_name"]:checked').val();
            var package_type = $("#package_type option:selected").val();
            if(package_type=="board"){
                var class_type = "k12";
            }
            if(package_type=="competitive-courses"){
                var class_type = "18+";
            }
            var boardid = $("#val-category_id option:selected").val();

            $.ajax({
                type:"get",
                url:"{{url('store-student-board-classes-subjects')}}?class_type="+class_type+"&class_name="+category_id+"&board="+boardid,
                success:function(res)
                {  
                  if(res==1){
                    location.reload();
                    // break;
                  }
                }

                });

            @endif
          @endif
          @endif




document.getElementById("show_for_all_class_shedule").innerHTML = '';
    document.getElementById("show_for_class_subject").innerHTML = '<div id="wait" class="m-auto"><img width="70px" src="{{url('')}}/public/asset_rumbok/images/Preloader-breathe.gif" /></div>';
  if(category_id){  
            
                $.ajax({
                type:"get",
                url:"{{url('tuition-get-board-classes-subjects')}}/"+category_id,
                success:function(res)
                {  
                    if(res != 1)
                    {
                        $("#show_for_class_subject").html('');
                        $("#Choose_a_Subject").html('Choose a Subject');

                        var ii = 0;
                        $.each(res,function(key,value){
                          var checked = "";
                          if (ii==0) {
                            var checked = "checked";
                          }
                  var subject_text = "'"+value+"'";
$("#show_for_class_subject").append('<div class="col-md-4 mb-3"><input onclick="getinstructor_tutition(this.value,'+subject_text+');" id="class_name_'+key+'" type="radio" name="class_name" value="'+key+'" class="for_class_name_type" '+checked+'> <label for="class_name_'+key+'"><span class="border border-dark rounded py-1 px-2">'+value+'</span></label> </div>');
                         ii++;
                        });
                    }else{
                      $("#show_for_class_subject").html('<div class="col-md-12 text-center"> Subject Not Available This Class </div>');
                       $("#show_for_class_subject").fadeIn();
                    }

                    myGreeting();
                }

                });
                }
              }

function getinstructor_tutition(subId,subject_text){
var course_type_text = $("#package_type option:selected").text();
var course_id_text = $("#val-category_id option:selected").text();
var class_text = $("#show_for_class option:selected").text();
var class_id = $("#show_for_class option:selected").val();

  document.getElementById("show_for_all_class_shedule").innerHTML = '<div id="wait" class="m-auto"><img width="70px" src="{{url('')}}/public/asset_rumbok/images/Preloader-breathe.gif" /></div>';
    $.ajax({
                type:"get",
                url:"{{url('tuition-get-instructor-schedule')}}/"+subId+"/"+class_id,
                success:function(res)
                {       
                    if(res)
                    {
document.getElementById("show_for_all_class_shedule").innerHTML = res;

document.getElementById("witchtypeofcource").innerHTML = " <span id='boardclasss'>"+course_id_text+" "+class_text+" "+subject_text+"</span>";
                    }
                }

                });
}

function getTutitionByDate(datename){
  //alert(datename);
  //getinstructor_tutition(subId,subject_text)

var course_type_text = $("#package_type option:selected").text();
var course_id_text = $("#val-category_id option:selected").text();
var class_text = $("#show_for_class option:selected").text();
var class_id = $("#show_for_class option:selected").val();

var subId = $('input[name="class_name"]:checked').val();
var subject_text = $('input[name="class_name"]:checked').text();

  document.getElementById("whenonlytimes").innerHTML = '<div id="wait" class="m-auto"><img width="70px" src="{{url('')}}/public/asset_rumbok/images/Preloader-breathe.gif" /></div>';
    $.ajax({
                type:"get",
                url:"{{url('tuition-get-instructor-schedule-time')}}/"+subId+"/"+class_id+"?date="+datename,
                success:function(res)
                {       
                    if(res)
                    {
            document.getElementById("whenonlytimes").innerHTML = res;
                    }else{
            document.getElementById("whenonlytimes").innerHTML = '<div class="col-md-12 text-center"> Sorry, Schedule not available at the moment check after some time.. </div>';
                    }
                }

    });
}

function bookLiveDailyClass(user_id,instructor_subjects_id,time_of_booking,tutitionschedules_id){


  var boardclasss = $("#boardclasss").text();
  var techname = $("#techname"+user_id+instructor_subjects_id).text();
  var subname = $("#subname"+user_id+instructor_subjects_id).text();
  var date_of_booking = $('input[name="day_name"]:checked').val();
         var myhtml1 = document.createElement("div");
         myhtml1.innerHTML = "<div style=' text-align: center; '>Your are going to book Live Tuition Class for <b>"+boardclasss+subname+"</b> by <b>"+techname+".</b> Please click OK button to confirm. <div>";
swal({
  title: "",
  content: myhtml1,
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {


  // alert(date_of_booking);

    var values = {
            'user_id': user_id,
            'instructor_subjects_id': instructor_subjects_id,
            'date_of_booking': date_of_booking,
            'time_of_booking': time_of_booking,
            'tutitionschedules_id': tutitionschedules_id
    };
    $.ajax({
        url: "{{url('tution-store-board-class-schedule')}}",
        type: "GET",
        data: values,
          success: function(response) {
             if(response==1){

         var myhtml = document.createElement("div");
         myhtml.innerHTML = "<div style=' text-align: center; '>You have successfully booked daily class of <b>"+boardclasss+subname+"</b> by <b>"+techname+".</b> Please ensure your availability. Thankyou<div>";
        swal({
            title: "Congratulations!",
            content: myhtml,
            icon: "success",
            buttons: "Close",
            closeOnClickOutside: false,
           })
               document.getElementById("bookedclass"+user_id+instructor_subjects_id+time_of_booking).innerHTML = '<div class="listed-items h-100"> <p>'+time_of_booking+'</p> <span class="status-time-table"> <span class="booked-icon"> <i class="fa fa-check"></i> </span> Booked</span> </div>';
             }
          } 
    });

  }
});
}


// const myTimeout = setTimeout(myGreeting, 1000);
// const myTimeout1 = setTimeout(myGreeting1, 5000);

// function myGreeting() {
//   $("#package_type").val('board');
//   getBoardOrCompetitive('board');
//   // $('#package_type option[value=competitive-courses]').attr('selected',true);
// }
// function myGreeting1() {
//   $('#category_id option[value=9]').attr('selected',true);
// }

// 
</script>
@endsection