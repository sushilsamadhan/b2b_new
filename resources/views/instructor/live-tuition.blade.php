@extends('layouts.master')
@section('title','assessment')
@section('parentPageTitle', 'view')


@section('content')
    <!-- BEGIN:content -->

    <div class="card m-b-30">


@if($instructorName)       


    <div class="card-header">
            <div class="float-left">
    <h4> @if($instructorName != '' ) {{ $instructorName->insname }} @endif </h4>
       <table class="table">
           <tr>
               <th scope="row">Class</th>
               <th scope="row">Board</th>
               <th scope="row">Subject</th>
           </tr>
@if(count($instructorDetails) >=0 )
@foreach($instructorDetails as $insdetails)
           <tr>
               <td>{{ @str_replace("lass"," - ",$insdetails->name) }}</td>
               <td>{{ $insdetails->bname }}</td>
               <td>{{ $insdetails->subjectname }}</td>
           </tr>
@endforeach
@endif
       </table>
            </div>


            <div class="float-right">       
@php
     $getinstructors =   \App\InstructorAssessment::leftjoin('instructors as ins','ins.id','=','instructor_subjects.instructor_id')
         ->where('ins.is_display','=','1')
         ->select('ins.available_start_time','ins.available_end_time','ins.teach_time_minutes','ins.break_time_minutes')->where('ins.id','=',$instructorId)->first();
@endphp
 
    <h4> Tuition Schedule </h4>
       <table class="table">
           <tr>
               <th scope="row">Start Duration :</th>
               <td scope="row">
@php
$mainstart="";
if($getinstructors->available_end_time > 12){
   $mainstart = ($getinstructors->available_start_time-12).":00 PM";
}else{
   $mainstart = ($getinstructors->available_start_time).":00 AM";
}
@endphp
{{$mainstart}}
</td>
           </tr>
           <tr>
               <th scope="row">End Duration :</th>
               <td scope="row">
@php
$mainstart="";
if($getinstructors->available_end_time > 12){
   $mainstart = ($getinstructors->available_end_time-12).":00 PM";
}else{
   $mainstart = ($getinstructors->available_end_time).":00 AM";
}
@endphp
{{$mainstart}}
               </td>
           </tr>
           <tr>
               <th scope="row">Priode</th>
               <td scope="row">{{ $getinstructors->teach_time_minutes == '' ? '20' : $getinstructors->teach_time_minutes }}</td>
           </tr>
           <tr>
               <th scope="row">Break/Gap</th>
               <td scope="row">{{ $getinstructors->break_time_minutes == '' ? '20' : $getinstructors->break_time_minutes }}</td>
           </tr>
       </table>



            </div>

        </div>

        <div class="card-body">
            <div class="col-md-12">
                <style>
/*.time-picker {
     margin: 0 -5px;
}*/
/* .time-picker-header {
     position: relative;
}*/
 .date-slot {
     list-style: none;
     padding: 0;
}
/* .date-slot-wrapper {
     width: 20%;
     text-align: center;
     float: left;
}*/
 .date-slot-item {
     margin: 0 20px 10px;
     padding: 10px;
     border: 1px solid transparent;
}
 .date-slot-item.active {
     border: 1px solid #0279b3;
}
 .date-slot-item.no-free-slot>* {
     color: #666;
}
 .date-slot-day, .date-slot-date {
     display: block;
}
 .date-slot-day {
     font-size: 16px;
     line-height: 24px;
     color: #666;
}
 .date-slot-date {
     font-size: 24px;
     line-height: 36px;
     color: #000;
}
 .time-slot {
     list-style: none;
     padding: 0;
     float: left;
     display: inline-block;
     width: 14%;
}
 .time-slot-item {
     font-size: 14px;
     line-height: 22px;
     color: #666;
     border: 1px solid #ccc;
     border-radius: 4px;
     line-height: 2;
     margin: 7px 3px;
     text-align: center;
     /*height: 66px;*/
     /*cursor: pointer;*/
}
 .time-slot-item-class {
     cursor: pointer;   
     height: 30px;
     line-height: 30px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

 .time-slot-item-class:hover, .time-slot-item-class.picked {
     background: #0279b3;
     border-color: #0279b3;
     color: #FFF;
}
.time-slot-item-header {
    font-size: 20px;
    font-weight: 600;
    line-height: 22px;
    color: #666;
    border: 1px solid #ccc;
    border-radius: 4px;
    line-height: 3;
    margin: 7px 3px;
    text-align: center;
    cursor: pointer;
}
</style>
<!-- onclick="setTimeinModal('08:00 AM - 09:00 AM');" -->
<!-- picked -->

<?php
if(!empty($getinstructors->available_start_time) && !empty($getinstructors->available_end_time) && !empty($getinstructors->teach_time_minutes) && !empty($getinstructors->break_time_minutes)){
    $dstart             = $getinstructors->available_start_time;   //get post value from the form --}}
    $dend               = $getinstructors->available_end_time;  // get post end day value from form --}}
    $class_duration     = $getinstructors->teach_time_minutes ; //duration always in minutes - obtained from form post --}}
    $gapTime            = $getinstructors->break_time_minutes; 
}else{
    $dstart             = 6;   //get post value from the form --}}
    $dend               = 9+1;  // get post end day value from form --}}
    $class_duration     = 20; //duration always in minutes - obtained from form post --}}
    $gapTime            = 20;
}
    $gap_duration       = $class_duration+$gapTime ; //gap b/w two classes - obtained from form post --}}
    $dstartss = $dstart.":00"; 
?>

<ul class="time-slot">
   <li class="time-slot-item-header">Monday</li>
<?php
    for ($dstart; $dstart <=$dend; $dstart++){
        $slot_start_time    = date("h:i A",strtotime($dstartss));

        $endTime = date("h:i A", strtotime('+'.$class_duration.' minutes', strtotime($dstartss)));
        
    $slot_end_time = date("h:i A", strtotime('+'.$gap_duration.' minutes', strtotime($dstartss)));
    $timingmain = $slot_start_time.' - '.$endTime;

    $st = date('H:i', strtotime($slot_start_time));
    $et = date('H:i', strtotime($endTime));

    $dstartss = $slot_end_time;     
?>
<li class="time-slot-item">
<div>{{$timingmain}}</div>
<ul class="list-inline">
@php
  $conn1 = array('instructor_id' => $instructorId,'day' => 'Monday','timing' => $timingmain );
  $gettimingdata1 = getTutitionScheduletimepart($conn1);
@endphp
@if($gettimingdata1==0)
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
            <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark" Monday>{{ @str_replace("lass"," - ",$classname->name) }}</span>
            </li>
@endforeach
@endif
@else
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
@php
  $conn = array('instructor_subject_id' => $classname->inssubject,'day' => 'Monday','timing' => $timingmain );
  $gettimingdata = getTutitionScheduletime($conn);
@endphp
    @if($gettimingdata!=0)


@php
  $connBooking = array('instructor_subjects_id' => $classname->inssubject,'tutitionschedules_id' => $gettimingdata,'time_of_booking' => $timingmain, 'date_of_booking' => date('Y-m-d') );
  $getBookinggdata = getTutitionScheduletimeBooking($connBooking);
@endphp
     @if($getBookinggdata != '0')

            <li class="list-inline-item">
                <span class="bg-success time-slot-item-class px-1 rounded border border-dark picked" onclick="JoinTuitionclass('{{$getBookinggdata}}');" >
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>
@else
             <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark picked">
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>           
@endif




    @endif
@endforeach
@endif
@endif
        </ul>
        </li>

<?php } ?>
</ul>


  
<?php
if(!empty($getinstructors->available_start_time) && !empty($getinstructors->available_end_time) && !empty($getinstructors->teach_time_minutes) && !empty($getinstructors->break_time_minutes)){
    $dstart             = $getinstructors->available_start_time;   //get post value from the form --}}
    $dend               = $getinstructors->available_end_time;  // get post end day value from form --}}
    $class_duration     = $getinstructors->teach_time_minutes ; //duration always in minutes - obtained from form post --}}
    $gapTime            = $getinstructors->break_time_minutes; 
}else{
    $dstart             = 6;   //get post value from the form --}}
    $dend               = 9+1;  // get post end day value from form --}}
    $class_duration     = 20; //duration always in minutes - obtained from form post --}}
    $gapTime            = 20;
}
    $gap_duration       = $class_duration+$gapTime ; //gap b/w two classes - obtained from form post --}}
    $dstartss = $dstart.":00"; 
?>

<ul class="time-slot">
   <li class="time-slot-item-header">Tuesday</li>
<?php
    for ($dstart; $dstart <=$dend; $dstart++){
        $slot_start_time    = date("h:i A",strtotime($dstartss));

        $endTime = date("h:i A", strtotime('+'.$class_duration.' minutes', strtotime($dstartss)));
        
    $slot_end_time = date("h:i A", strtotime('+'.$gap_duration.' minutes', strtotime($dstartss)));
    $timingmain = $slot_start_time.' - '.$endTime;

    $st = date('H:i', strtotime($slot_start_time));
    $et = date('H:i', strtotime($endTime));

    $dstartss = $slot_end_time;     
?>
<li class="time-slot-item">
<div>{{$timingmain}}</div>
<ul class="list-inline">
@php
  $conn1 = array('instructor_id' => $instructorId,'day' => 'Tuesday','timing' => $timingmain );
  $gettimingdata1 = getTutitionScheduletimepart($conn1);
@endphp
@if($gettimingdata1==0)
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
            <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark" Tuesday>{{ @str_replace("lass"," - ",$classname->name) }}</span>
            </li>
@endforeach
@endif
@else
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
@php
  $conn = array('instructor_subject_id' => $classname->inssubject,'day' => 'Tuesday','timing' => $timingmain );
  $gettimingdata = getTutitionScheduletime($conn);
@endphp
    @if($gettimingdata!=0)

@php
  $connBooking = array('instructor_subjects_id' => $classname->inssubject,'tutitionschedules_id' => $gettimingdata,'time_of_booking' => $timingmain, 'date_of_booking' => date('Y-m-d') );
  $getBookinggdata = getTutitionScheduletimeBooking($connBooking);
@endphp
     @if($getBookinggdata != '0')

            <li class="list-inline-item">
                <span class="bg-success time-slot-item-class px-1 rounded border border-dark picked" onclick="JoinTuitionclass('{{$getBookinggdata}}');" >
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>
@else
             <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark picked">
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>           
@endif


    @endif
@endforeach
@endif
@endif
        </ul>
        </li>

<?php } ?>
</ul>

  
  
<?php
if(!empty($getinstructors->available_start_time) && !empty($getinstructors->available_end_time) && !empty($getinstructors->teach_time_minutes) && !empty($getinstructors->break_time_minutes)){
    $dstart             = $getinstructors->available_start_time;   //get post value from the form --}}
    $dend               = $getinstructors->available_end_time;  // get post end day value from form --}}
    $class_duration     = $getinstructors->teach_time_minutes ; //duration always in minutes - obtained from form post --}}
    $gapTime            = $getinstructors->break_time_minutes; 
}else{
    $dstart             = 6;   //get post value from the form --}}
    $dend               = 9+1;  // get post end day value from form --}}
    $class_duration     = 20; //duration always in minutes - obtained from form post --}}
    $gapTime            = 20;
}
    $gap_duration       = $class_duration+$gapTime ; //gap b/w two classes - obtained from form post --}}
    $dstartss = $dstart.":00"; 
?>

<ul class="time-slot">
   <li class="time-slot-item-header">Wednesday</li>
<?php
    for ($dstart; $dstart <=$dend; $dstart++){
        $slot_start_time    = date("h:i A",strtotime($dstartss));

        $endTime = date("h:i A", strtotime('+'.$class_duration.' minutes', strtotime($dstartss)));
        
    $slot_end_time = date("h:i A", strtotime('+'.$gap_duration.' minutes', strtotime($dstartss)));
    $timingmain = $slot_start_time.' - '.$endTime;

    $st = date('H:i', strtotime($slot_start_time));
    $et = date('H:i', strtotime($endTime));

    $dstartss = $slot_end_time;     
?>
<li class="time-slot-item">
<div>{{$timingmain}}</div>
<ul class="list-inline">
@php
  $conn1 = array('instructor_id' => $instructorId,'day' => 'Wednesday','timing' => $timingmain );
  $gettimingdata1 = getTutitionScheduletimepart($conn1);
@endphp
@if($gettimingdata1==0)
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
            <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark" Wednesday>{{ @str_replace("lass"," - ",$classname->name) }}</span>
            </li>
@endforeach
@endif
@else
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
@php
  $conn = array('instructor_subject_id' => $classname->inssubject,'day' => 'Wednesday','timing' => $timingmain );
  $gettimingdata = getTutitionScheduletime($conn);
@endphp
    @if($gettimingdata!=0)

@php
  $connBooking = array('instructor_subjects_id' => $classname->inssubject,'tutitionschedules_id' => $gettimingdata,'time_of_booking' => $timingmain, 'date_of_booking' => date('Y-m-d') );
  $getBookinggdata = getTutitionScheduletimeBooking($connBooking);
@endphp
     @if($getBookinggdata != '0')

            <li class="list-inline-item">
                <span class="bg-success time-slot-item-class px-1 rounded border border-dark picked" onclick="JoinTuitionclass('{{$getBookinggdata}}');" >
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>
@else
             <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark picked">
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>           
@endif


    @endif
@endforeach
@endif
@endif
        </ul>
        </li>

<?php } ?>
</ul>


  
<?php
if(!empty($getinstructors->available_start_time) && !empty($getinstructors->available_end_time) && !empty($getinstructors->teach_time_minutes) && !empty($getinstructors->break_time_minutes)){
    $dstart             = $getinstructors->available_start_time;   //get post value from the form --}}
    $dend               = $getinstructors->available_end_time;  // get post end day value from form --}}
    $class_duration     = $getinstructors->teach_time_minutes ; //duration always in minutes - obtained from form post --}}
    $gapTime            = $getinstructors->break_time_minutes; 
}else{
    $dstart             = 6;   //get post value from the form --}}
    $dend               = 9+1;  // get post end day value from form --}}
    $class_duration     = 20; //duration always in minutes - obtained from form post --}}
    $gapTime            = 20;
}
    $gap_duration       = $class_duration+$gapTime ; //gap b/w two classes - obtained from form post --}}
    $dstartss = $dstart.":00"; 
?>

<ul class="time-slot">
   <li class="time-slot-item-header">Thursday</li>
<?php
    for ($dstart; $dstart <=$dend; $dstart++){
        $slot_start_time    = date("h:i A",strtotime($dstartss));

        $endTime = date("h:i A", strtotime('+'.$class_duration.' minutes', strtotime($dstartss)));
        
    $slot_end_time = date("h:i A", strtotime('+'.$gap_duration.' minutes', strtotime($dstartss)));
    $timingmain = $slot_start_time.' - '.$endTime;

    $st = date('H:i', strtotime($slot_start_time));
    $et = date('H:i', strtotime($endTime));

    $dstartss = $slot_end_time;     
?>
<li class="time-slot-item">
<div>{{$timingmain}}</div>
<ul class="list-inline">
@php
  $conn1 = array('instructor_id' => $instructorId,'day' => 'Thursday','timing' => $timingmain );
  $gettimingdata1 = getTutitionScheduletimepart($conn1);
@endphp
@if($gettimingdata1==0)
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
            <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark" Thursday>{{ @str_replace("lass"," - ",$classname->name) }}</span>
            </li>
@endforeach
@endif
@else
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
@php
  $conn = array('instructor_subject_id' => $classname->inssubject,'day' => 'Thursday','timing' => $timingmain );
  $gettimingdata = getTutitionScheduletime($conn);
@endphp
    @if($gettimingdata!=0)

@php
  $connBooking = array('instructor_subjects_id' => $classname->inssubject,'tutitionschedules_id' => $gettimingdata,'time_of_booking' => $timingmain, 'date_of_booking' => date('Y-m-d') );
  $getBookinggdata = getTutitionScheduletimeBooking($connBooking);
@endphp
     @if($getBookinggdata != '0')

            <li class="list-inline-item">
                <span class="bg-success time-slot-item-class px-1 rounded border border-dark picked" onclick="JoinTuitionclass('{{$getBookinggdata}}');" >
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>
@else
             <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark picked">
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>           
@endif


    @endif
@endforeach
@endif
@endif
        </ul>
        </li>

<?php } ?>
</ul>

  
<?php
if(!empty($getinstructors->available_start_time) && !empty($getinstructors->available_end_time) && !empty($getinstructors->teach_time_minutes) && !empty($getinstructors->break_time_minutes)){
    $dstart             = $getinstructors->available_start_time;   //get post value from the form --}}
    $dend               = $getinstructors->available_end_time;  // get post end day value from form --}}
    $class_duration     = $getinstructors->teach_time_minutes ; //duration always in minutes - obtained from form post --}}
    $gapTime            = $getinstructors->break_time_minutes; 
}else{
    $dstart             = 6;   //get post value from the form --}}
    $dend               = 9+1;  // get post end day value from form --}}
    $class_duration     = 20; //duration always in minutes - obtained from form post --}}
    $gapTime            = 20;
}
    $gap_duration       = $class_duration+$gapTime ; //gap b/w two classes - obtained from form post --}}
    $dstartss = $dstart.":00"; 
?>

<ul class="time-slot">
   <li class="time-slot-item-header">Friday</li>
<?php
    for ($dstart; $dstart <=$dend; $dstart++){
        $slot_start_time    = date("h:i A",strtotime($dstartss));

        $endTime = date("h:i A", strtotime('+'.$class_duration.' minutes', strtotime($dstartss)));
        
    $slot_end_time = date("h:i A", strtotime('+'.$gap_duration.' minutes', strtotime($dstartss)));
    $timingmain = $slot_start_time.' - '.$endTime;

    $st = date('H:i', strtotime($slot_start_time));
    $et = date('H:i', strtotime($endTime));

    $dstartss = $slot_end_time;     
?>
<li class="time-slot-item">
<div>{{$timingmain}}</div>
<ul class="list-inline">
@php
  $conn1 = array('instructor_id' => $instructorId,'day' => 'Friday','timing' => $timingmain );
  $gettimingdata1 = getTutitionScheduletimepart($conn1);
@endphp
@if($gettimingdata1==0)
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
            <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark" Friday>{{ @str_replace("lass"," - ",$classname->name) }}</span>
            </li>
@endforeach
@endif
@else
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
@php
  $conn = array('instructor_subject_id' => $classname->inssubject,'day' => 'Friday','timing' => $timingmain );
  $gettimingdata = getTutitionScheduletime($conn);
@endphp
    @if($gettimingdata!=0)

@php
  $connBooking = array('instructor_subjects_id' => $classname->inssubject,'tutitionschedules_id' => $gettimingdata,'time_of_booking' => $timingmain, 'date_of_booking' => date('Y-m-d') );
  $getBookinggdata = getTutitionScheduletimeBooking($connBooking);
@endphp
     @if($getBookinggdata != '0')

            <li class="list-inline-item">
                <span class="bg-success time-slot-item-class px-1 rounded border border-dark picked" onclick="JoinTuitionclass('{{$getBookinggdata}}');" >
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>
@else
             <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark picked">
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>           
@endif


    @endif
@endforeach
@endif
@endif
        </ul>
        </li>

<?php } ?>
</ul>


 
<?php
if(!empty($getinstructors->available_start_time) && !empty($getinstructors->available_end_time) && !empty($getinstructors->teach_time_minutes) && !empty($getinstructors->break_time_minutes)){
    $dstart             = $getinstructors->available_start_time;   //get post value from the form --}}
    $dend               = $getinstructors->available_end_time;  // get post end day value from form --}}
    $class_duration     = $getinstructors->teach_time_minutes ; //duration always in minutes - obtained from form post --}}
    $gapTime            = $getinstructors->break_time_minutes; 
}else{
    $dstart             = 6;   //get post value from the form --}}
    $dend               = 9+1;  // get post end day value from form --}}
    $class_duration     = 20; //duration always in minutes - obtained from form post --}}
    $gapTime            = 20;
}
    $gap_duration       = $class_duration+$gapTime ; //gap b/w two classes - obtained from form post --}}
    $dstartss = $dstart.":00"; 
?>

<ul class="time-slot">
   <li class="time-slot-item-header">Saturday</li>
<?php
    for ($dstart; $dstart <=$dend; $dstart++){
        $slot_start_time    = date("h:i A",strtotime($dstartss));

        $endTime = date("h:i A", strtotime('+'.$class_duration.' minutes', strtotime($dstartss)));
        
    $slot_end_time = date("h:i A", strtotime('+'.$gap_duration.' minutes', strtotime($dstartss)));
    $timingmain = $slot_start_time.' - '.$endTime;

    $st = date('H:i', strtotime($slot_start_time));
    $et = date('H:i', strtotime($endTime));

    $dstartss = $slot_end_time;     
?>
<li class="time-slot-item">
<div>{{$timingmain}}</div>
<ul class="list-inline">
@php
  $conn1 = array('instructor_id' => $instructorId,'day' => 'Saturday','timing' => $timingmain );
  $gettimingdata1 = getTutitionScheduletimepart($conn1);
@endphp
@if($gettimingdata1==0)
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
            <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark" Saturday>{{ @str_replace("lass"," - ",$classname->name) }}</span>
            </li>
@endforeach
@endif
@else
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
@php
  $conn = array('instructor_subject_id' => $classname->inssubject,'day' => 'Saturday','timing' => $timingmain );
  $gettimingdata = getTutitionScheduletime($conn);
@endphp
    @if($gettimingdata!=0)

@php
  $connBooking = array('instructor_subjects_id' => $classname->inssubject,'tutitionschedules_id' => $gettimingdata,'time_of_booking' => $timingmain, 'date_of_booking' => date('Y-m-d') );
  $getBookinggdata = getTutitionScheduletimeBooking($connBooking);
@endphp
     @if($getBookinggdata != '0')

            <li class="list-inline-item">
                <span class="bg-success time-slot-item-class px-1 rounded border border-dark picked" onclick="JoinTuitionclass('{{$getBookinggdata}}');" >
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>
@else
             <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark picked">
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>           
@endif


    @endif
@endforeach
@endif
@endif
        </ul>
        </li>

<?php } ?>
</ul>



<?php
if(!empty($getinstructors->available_start_time) && !empty($getinstructors->available_end_time) && !empty($getinstructors->teach_time_minutes) && !empty($getinstructors->break_time_minutes)){
    $dstart             = $getinstructors->available_start_time;   //get post value from the form --}}
    $dend               = $getinstructors->available_end_time;  // get post end day value from form --}}
    $class_duration     = $getinstructors->teach_time_minutes ; //duration always in minutes - obtained from form post --}}
    $gapTime            = $getinstructors->break_time_minutes; 
}else{
    $dstart             = 6;   //get post value from the form --}}
    $dend               = 9+1;  // get post end day value from form --}}
    $class_duration     = 20; //duration always in minutes - obtained from form post --}}
    $gapTime            = 20;
}
    $gap_duration       = $class_duration+$gapTime ; //gap b/w two classes - obtained from form post --}}
    $dstartss = $dstart.":00"; 
?>

<ul class="time-slot">
   <li class="time-slot-item-header">Sunday</li>
<?php
    for ($dstart; $dstart <=$dend; $dstart++){
        $slot_start_time    = date("h:i A",strtotime($dstartss));

        $endTime = date("h:i A", strtotime('+'.$class_duration.' minutes', strtotime($dstartss)));
        
    $slot_end_time = date("h:i A", strtotime('+'.$gap_duration.' minutes', strtotime($dstartss)));
    $timingmain = $slot_start_time.' - '.$endTime;

    $st = date('H:i', strtotime($slot_start_time));
    $et = date('H:i', strtotime($endTime));

    $dstartss = $slot_end_time;     
?>
<li class="time-slot-item">
<div>{{$timingmain}}</div>
<ul class="list-inline">
@php
  $conn1 = array('instructor_id' => $instructorId,'day' => 'Sunday','timing' => $timingmain );
  $gettimingdata1 = getTutitionScheduletimepart($conn1);
@endphp
@if($gettimingdata1==0)
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
            <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark" Sunday>{{ @str_replace("lass"," - ",$classname->name) }}</span>
            </li>
@endforeach
@endif
@else
@if(count($instructorDaySchedules) >= 1)
@foreach($instructorDaySchedules as $classname)
@php
  $conn = array('instructor_subject_id' => $classname->inssubject,'day' => 'Sunday','timing' => $timingmain );
  $gettimingdata = getTutitionScheduletime($conn);
@endphp
    @if($gettimingdata!=0)

@php
  $connBooking = array('instructor_subjects_id' => $classname->inssubject,'tutitionschedules_id' => $gettimingdata,'time_of_booking' => $timingmain, 'date_of_booking' => date('Y-m-d') );
  $getBookinggdata = getTutitionScheduletimeBooking($connBooking);
@endphp
     @if($getBookinggdata != '0')

            <li class="list-inline-item">
                <span class="bg-success time-slot-item-class px-1 rounded border border-dark picked" onclick="JoinTuitionclass('{{$getBookinggdata}}');" >
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>
@else
             <li class="list-inline-item">
                <span class="time-slot-item-class px-1 rounded border border-dark picked">
{{ @str_replace("lass"," - ",$classname->name) }} &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger"><i class="fa fa-sign-in mr-2"></i></span>
                </span>
            </li>           
@endif


    @endif
@endforeach
@endif
@endif
        </ul>
        </li>

<?php } ?>
</ul>




            </div>
            <!-- End Row -->
    </div>
    @else
<h2 class="text-center">Your Class Not Available At this time</h2>
    @endif
</div>
   
    <!-- END:content -->
@endsection
@section('page-script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript">
    
// function setTimeinModal(instructor_id,inssubject,day,timing,slot_start_time,endTime) {

//     @if(empty($getinstructors->available_start_time) && empty($getinstructors->available_end_time) && empty($getinstructors->teach_time_minutes) && empty($getinstructors->break_time_minutes))
//     swal({
//           title: "Choose schedule?",
//           text: "First Choose schedule afet set class schedule!",
//           icon: "warning",
//           // buttons: true,
//           dangerMode: true,
//         });
//     @else
//             var values = {
//             '_token' : '<?php echo csrf_token() ?>',
//             'instructor_id': instructor_id,
//             'instructor_subject_id': inssubject,
//             'day': day,
//             'timing': timing,
//             'start_time': slot_start_time,
//             'end_time': endTime
//         };
//         $.ajax({
//             url: "{{route('save-tutition-schedule')}}",
//             type: "POST",
//             data: values,
//           success: function(response) {
//              if(response==1){
//              location.reload();
//         }
//       } 
//     });
//     @endif
// }

    function JoinTuitionclass(scheduleId) {

      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {

if(this.responseText == "0"){
   
        var myhtml = document.createElement("div");
         myhtml.innerHTML = "<div style=' text-align: center; '>This Schedule Not Booked..<div>";
        swal({
          content: myhtml,
          icon: "warning",
          buttons: "Okay",
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

                alert(scheduleId);

         } 
        }); 
}else{
const obj = JSON.parse(this.responseText);

if(obj){        
var alertval = "Your are going to start tuition period with <b>"+obj.uname+" "+obj.cname+" "+obj.title+"</b>" ; 
}


        var myhtml = document.createElement("div");
         myhtml.innerHTML = "<div style=' text-align: center; '>"+alertval+"<div>";
        swal({
          title: "Are you sure?",
          content: myhtml,
          icon: "warning",
          buttons: true,
          buttons: ["Cancel", "START NOW ->"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            window.location.replace("{{url('my/tuition')}}/"+scheduleId);

         } 
        }); 
}


      }
      xhttp.open("GET", "{{route('show-tuition-booking-student')}}?id="+scheduleId);
      xhttp.send();

    }

    $(function () {
        $(".checked").click(function () {
            //alert()
            //if ($(this).is(":checked")) {
                $("#dvPassport").show();
           // } else {
              //  $("#dvPassport").hide();
           // }
        });
    });
</script>
@stop
