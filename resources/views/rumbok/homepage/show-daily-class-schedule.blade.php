<h4 class="col-lg-12 my-3" id="witchtypeofcource"></h4>
<div class="col-md-12">
@if(!$getTimeTables)
<div class="col-md-12 text-center"> {{ 'Sorry Not Schedule at this time please check after some time' }} </div>
@endif
@foreach($getTimeTables as $getTimeTablesvalaa)    
      @php

$conn = array(
    'instructor_id' => $getTimeTablesvalaa->instructor_id,
    'course_type' => $getTimeTablesvalaa->course_type,
    'course_id' => $getTimeTablesvalaa->course_id,
    'class_id' => $getTimeTablesvalaa->class_id
 );

     $getTimeTablescc  =   \App\InstructorAssessment::leftjoin('categories as cat','cat.id','=','instructor_subjects.course_id')
         ->leftjoin('courses as c','c.id','=','instructor_subjects.subject_id')
         ->leftjoin('instructors as ins','ins.id','=','instructor_subjects.instructor_id')
         ->where('ins.is_display','=','1')
         ->select('cat.name','c.title','instructor_subjects.*','ins.name','ins.image')
         ->orderBy('id', 'DESC')->where($conn)->get();

      
      @endphp

@foreach($getTimeTablescc as $getTimeTablesval)  

 
<div class="row">
  <div class="col-lg-2 col-md-3">

   <div class="clearfix text-center"><img src="public/{{ $getTimeTablesval->image }}" alt="{{ $getTimeTablesval->name }}" style=" width: 65px; "></div>
   <p id="techname{{ $getTimeTablesval->subject_id }}{{ $getTimeTablesval->class_id }}{{ $getTimeTablesval->instructor_id }}" class="bio text-uppercase mb-0 text-dark text-center font-weight-bold line-height-1 text-center small">{{ $getTimeTablesval->name }}</p>



@guest()
   <div class='join-now-btn'><a href="{{ route('login') }}">Book Now</a></div>
@endguest
@auth
@php
  $conn = array('user_id' => Auth::user()->id,'instructor_id' => $getTimeTablesval->instructor_id,'subject_id' => $getTimeTablesval->subject_id );
  $getbookingdata = getBookingSchedule($conn);
@endphp
   <div class='join-now-btn' id="bookedclass{{ $getTimeTablesval->subject_id }}{{ $getTimeTablesval->class_id }}{{ $getTimeTablesval->instructor_id }}">
    @if($getbookingdata==0)
        <a href="javascript:void(0);" onclick="bookLiveDailyClass('{{ Auth::user()->id }}','{{ $getTimeTablesval->instructor_id }}','{{ $getTimeTablesval->course_type }}','{{ $getTimeTablesval->course_id }}','{{ $getTimeTablesval->class_id }}','{{ $getTimeTablesval->subject_id }}');">
          Book Now
        </a>
    @endif
    @if($getbookingdata==1)
        <a href="javascript:void(0);">
          Join Now
        </a>
    @endif
   </div>

@endauth








  </div>
  <div class="col-lg-10 col-md-9">
      <div class="term-grid grid-header">
          <label>Subject</label>
          <label>Mon.</label>
          <label>Tue.</label>
          <label>Wed.</label>
          <label>Thu.</label>
          <label>Fri.</label>
          <label>Sat.</label>
          <label>Sun.</label>
      </div>
      <div class="term-grid border-right border-left" v-for="term in terms">
        <label> 
          <div id="subname{{ $getTimeTablesval->subject_id }}{{ $getTimeTablesval->class_id }}{{ $getTimeTablesval->instructor_id }}" class="profileinfo flex-grow-1 line-height-1 py-2"> {{ $getTimeTablesval->title }} {{-- $getTimeTablesval->tag_name --}} </div>
        </label>


    @php 
      $perdayshedule = \App\InstructorDaySchedules::where('instructor_subject_id', $getTimeTablesval->id)->get();
    @endphp

    <div class="Monday">
    @foreach ($perdayshedule as $perdayshedulevalue)
    @if($perdayshedulevalue->day == "Monday")
      <div class="time text-uppercase text-muted">
        {{ date('g:i A', strtotime($perdayshedulevalue->start_time)) }} - {{ date('g:i A', strtotime($perdayshedulevalue->end_time)) }}
      </div>
    @endif
    @endforeach
    </div>
    
    <div class="Tuesday">
    @foreach ($perdayshedule as $perdayshedulevalue)
    @if($perdayshedulevalue->day == "Tuesday")
      <div class="time text-uppercase text-muted">
        {{ date('g:i A', strtotime($perdayshedulevalue->start_time)) }} - {{ date('g:i A', strtotime($perdayshedulevalue->end_time)) }}
      </div>
    @endif
    @endforeach
    </div>
  
    <div class="Wednesday">
    @foreach ($perdayshedule as $perdayshedulevalue)
    @if($perdayshedulevalue->day == "Wednesday")
      <div class="time text-uppercase text-muted">
        {{ date('g:i A', strtotime($perdayshedulevalue->start_time)) }} - {{ date('g:i A', strtotime($perdayshedulevalue->end_time)) }}
      </div>
    @endif
    @endforeach
    </div>
    
    <div class="Thursday">
    @foreach ($perdayshedule as $perdayshedulevalue)
    @if($perdayshedulevalue->day == "Thursday")
      <div class="time text-uppercase text-muted">
        {{ date('g:i A', strtotime($perdayshedulevalue->start_time)) }} - {{ date('g:i A', strtotime($perdayshedulevalue->end_time)) }}
      </div>
    @endif
    @endforeach
    </div>
    
    <div class="Friday">
    @foreach ($perdayshedule as $perdayshedulevalue)
    @if($perdayshedulevalue->day == "Friday")
      <div class="time text-uppercase text-muted">
        {{ date('g:i A', strtotime($perdayshedulevalue->start_time)) }} - {{ date('g:i A', strtotime($perdayshedulevalue->end_time)) }}
      </div>
    @endif
    @endforeach
    </div>
    
    <div class="Saturday">
    @foreach ($perdayshedule as $perdayshedulevalue)
    @if($perdayshedulevalue->day == "Saturday")
      <div class="time text-uppercase text-muted">
        {{ date('g:i A', strtotime($perdayshedulevalue->start_time)) }} - {{ date('g:i A', strtotime($perdayshedulevalue->end_time)) }}
      </div>
    @endif
    @endforeach
    </div>
    
    <div class="Sunday">
     <div  class="text-center text-danger"> X </div>
    @foreach ($perdayshedule as $perdayshedulevalue)
    @if($perdayshedulevalue->day == "Sunday")
      <div class="time text-uppercase text-muted">
        {{ date('g:i A', strtotime($perdayshedulevalue->start_time)) }} - {{ date('g:i A', strtotime($perdayshedulevalue->end_time)) }}
      </div>
    @endif
    @endforeach
    </div>






      </div>
  </div>
</div>




    @endforeach
    @endforeach





</div>

