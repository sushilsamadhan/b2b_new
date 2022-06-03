<div class="col-md-12 text-center">
<h4 class="my-3" id="witchtypeofcource"></h4>
</div>

<?php
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
// echo date('d-m-Y H:i:s');
?>

<div class="col-md-12">
  <div class="job-tab">
   <div class="nav nav-tabs radio-toolbar border-0">
@for ($i = 0; $i <= 6; $i++)
@php
  $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + $i, date('Y')));
  $dayname = date('l', strtotime($date));

$timestamp = strtotime($date);
$daynum = date('d', $timestamp);

@endphp
  <div class="px-2">
  <input onclick="getTutitionByDate(this.value);" id="day_name_{{ $i }}" type="radio" name="day_name" value="{{ $date }}" class="for_class_name_type" 
      @if($i == 0)
      {{ 'checked' }}
      @endif
    >
      <label for="day_name_{{ $i }}">
      <span class="border border-dark rounded py-1 px-2 line-height-1">

    @if($i == 0)
      {{ $daynum }} <br>
      {{ 'Today' }}
    @elseif ($i == 1)
      {{ $daynum }} <br>
      {{ 'Tomorrow' }}
    @else
      {{ $daynum }} <br>
      {{ $dayname }}
    @endif
      </span>
      </label> 
    </div>
@endfor
  </div>
  </div>
</div>








<div class="col-md-12" id="whenonlytimes">
@if(count($getTimeTables) <= 0)
<div class="col-md-12 text-center"> {{ ' Sorry, Schedule not available at the moment check after some time..' }} </div>
@endif
@foreach($getTimeTables as $getTimeTablesvalaa)    
      @php
$conn = array(
    'instructor_id' => $getTimeTablesvalaa->instructor_id,
    'subject_id' => $getTimeTablesvalaa->subject_id,
    'course_type' => $getTimeTablesvalaa->course_type,
    'course_id' => $getTimeTablesvalaa->course_id,
    'class_id' => $getTimeTablesvalaa->class_id,
    'instructor_type' => '2'
 );
     $getTimeTablescc  =   \App\InstructorAssessment::leftjoin('categories as cat','cat.id','=','instructor_subjects.course_id')
         ->leftjoin('courses as c','c.id','=','instructor_subjects.subject_id')
         ->leftjoin('instructors as ins','ins.id','=','instructor_subjects.instructor_id')
         ->where('ins.is_display','=','1')
         ->select('cat.name','c.title','instructor_subjects.*','ins.name','ins.image')
         ->orderBy('id', 'DESC')->where($conn)->get();
      @endphp
@foreach($getTimeTablescc as $getTimeTablesval) 

@php
 $currentdate = date('H:i', time());

if($formatedate == date('Y-m-d')){
  $getTimeings  =   \App\Tutitionschedule::where('instructor_subject_id','=', $getTimeTablesval->id)
                      ->where('day','=', $todayname)
                      ->where('start_time','>=', $currentdate)
                      ->select('*')->get();
}else{
  $getTimeings  =   \App\Tutitionschedule::where('instructor_subject_id','=', $getTimeTablesval->id)->                  where('day','=', $todayname)->select('*')->get();
}
@endphp

@if(count($getTimeings)>=1)

  <div class="row">
  <div class="col-lg-2 col-md-3">
   <div class="clearfix text-center">
<img src="public/{{ $getTimeTablesval->image }}" alt="{{ $getTimeTablesval->name }}" style=" width: 65px; ">
   </div>
   <p id="techname{{ Auth::user()->id }}{{ $getTimeTablesval->id }}" class="bio text-uppercase mb-0 text-dark text-center font-weight-bold line-height-1 text-center small">{{ $getTimeTablesval->name }}</p>
  </div>
  <div class="col-lg-10 col-md-9">
    <div class="row align-items-center">
     
      <div class="col-md-12">
        <ul class="time-table-list">

@php
 $currentdate = date('H:i', time());

if($formatedate == date('Y-m-d')){
  $getTimeings  =   \App\Tutitionschedule::where('instructor_subject_id','=', $getTimeTablesval->id)
                      ->where('day','=', $todayname)
                      ->where('start_time','>=', $currentdate)
                      ->select('*')->get();
}else{
  $getTimeings  =   \App\Tutitionschedule::where('instructor_subject_id','=', $getTimeTablesval->id)->                  where('day','=', $todayname)->select('*')->get();
}

@endphp


@foreach($getTimeings as $getTimeing)

@php
  $conn = array('user_id' => Auth::user()->id,'instructor_subjects_id' => $getTimeTablesval->id,'date_of_booking' => $formatedate,'time_of_booking' => $getTimeing->timing );
  $conn1 = array('instructor_subjects_id' => $getTimeTablesval->id,'date_of_booking' => $formatedate,'time_of_booking' => $getTimeing->timing );
  $getbookingdata = getTutitionBookingSchedule($conn,$conn1);
@endphp

@if($getbookingdata==0)
          <li  id="bookedclass{{ Auth::user()->id }}{{ $getTimeTablesval->id }}{{ $getTimeing->timing }}">
            <div class="listed-items h-100">
              <p class="d-flex w-100 h-100 align-items-center">
                <a onclick="bookLiveDailyClass('{{ Auth::user()->id }}','{{ $getTimeTablesval->id }}','{{ $getTimeing->timing }}','{{ $getTimeing->id }}');" class="book-now">{{ $getTimeing->timing }}</a>
              </p>
            </div>
          </li>
@endif
@if($getbookingdata==1)
          <li>
            <div class="listed-items h-100">
              <p>{{ $getTimeing->timing }}</p>
              <span class="status-time-table">
                <span class="booked-icon">
                  <i class="fa fa-check"></i>
                </span> Booked</span>
            </div>
          </li>
@endif
@if($getbookingdata==2)
          <li>
            <div class="listed-items h-100 disabled">
              <p class="d-flex w-100 h-100 align-items-center">{{ $getTimeing->timing }}<br/> Not Available</p>
            </div>
          </li>
@endif
@endforeach

        </ul>
      </div>
    </div>
    </div>
  </div>
@else
{{--<div class="col-md-12 text-center"> Sorry Not Schedule at this time please check after some time </div>--}}
@endif

      @endforeach
    @endforeach
</div>