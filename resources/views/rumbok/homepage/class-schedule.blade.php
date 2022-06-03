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
grid-template-columns: repeat(8, minmax(0, 1fr));
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
padding: 0px 12px;
font-family: Arial;
font-size: 16px;
pointer-events: all;
cursor: pointer;
color: #000;
font-weight: normal;
text-align: center;
border-radius: 3px;
}
.radio-toolbar .for_class_name_type:checked+label span {
background-color: blue;
color: #fff;
}
</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="d-flex align-items-center">
          <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
          <div class="title-page">
            <h1>Daily Class Schedule</h1>
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
              <span>Class Schedule</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="row my-3">
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
  </div>
  <div class="p-3 clearfix bg-light border rounded">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="" for="package_type"> Preference Type <span class="text-danger">*</span></label>
            <select class="form-control langr stpicker" id="package_type" name="package_type" onchange="getBoardOrCompetitive(this.value);">
              <option value=""> Select</option>
              <option value="board">Academic Courses</option>
              <option value="competitive-courses">Competitive Courses</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="" for="val-category_id">Board/Exam <span class="text-danger">*</span></label>
            <div class="">
              <select class="form-control langr " id="val-category_id" name="category_id" onchange="getBoardClasses(this.value);">
                <option value=""> Please Select</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-12 px-0 ">
          <div class="job-tab">
           <ul class="nav nav-tabs radio-toolbar" id="show_for_class">
             
           </ul>
          </div>
        </div>
      </div>
  </div>

  
  <div class="row" id="show_for_all_class_shedule">

  </div>
</div>
<script type="text/javascript">
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
          } else {
            // swal("Your imaginary file is safe!");
          }
        });
@endguest

@auth

if(workval=="board"){
var urlin = "{{url('get-board')}}";
$("#show_for_class").html('');
}
if (workval=="competitive-courses") {
var urlin = "{{url('get-competitive-courses')}}";
$("#show_for_class").html('');
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
   document.getElementById("show_for_class").innerHTML = '<div id="wait" class="m-auto"><img src="https://culturebuffgames.com/resources/dashboard/images/demo_wait_.gif" /></div>';
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
document.getElementById("show_for_class").innerHTML =
this.responseText;
}
xhttp.open("GET", "{{url('get-board-classes')}}/"+classid);
xhttp.send();
// }
}
function getinstructor_subjectsClasses(class_id,class_text) {
var course_type = $("#package_type").val();
var course_id = $("#val-category_id").val();
 document.getElementById("show_for_all_class_shedule").innerHTML = '<div id="wait" class="m-auto"><img src="https://culturebuffgames.com/resources/dashboard/images/demo_wait_.gif" /></div>';
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
 document.getElementById("show_for_all_class_shedule").innerHTML =
this.responseText;

var course_type_text = $("#package_type option:selected").text();
var course_id_text = $("#val-category_id option:selected").text();

 document.getElementById("witchtypeofcource").innerHTML = course_type_text+" <span id='boardclasss'>"+course_id_text+" "+class_text+"</span>";
}
xhttp.open("GET", "{{url('get-board-classes-subjects')}}?course_type="+course_type+"&course_id="+course_id+"&class_id="+class_id);
xhttp.send();
}

function bookLiveDailyClass(user_id,instructor_id,course_type,course_id,class_id,subject_id){
  var boardclasss = $("#boardclasss").text();
  var techname = $("#techname"+subject_id+class_id+instructor_id).text();
  var subname = $("#subname"+subject_id+class_id+instructor_id).text();



    var values = {
            'user_id': user_id,
            'instructor_id': instructor_id,
            'course_type': course_type,
            'course_id': course_id,
            'class_id': class_id,
            'subject_id': subject_id,
    };
    $.ajax({
        url: "{{url('store-board-class-schedule')}}",
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
               document.getElementById("bookedclass"+subject_id+class_id+instructor_id).innerHTML = '<a href="javascript:void(0);"> Join Now </a>';
             }
          } 
    });
}
// 
</script>
@endsection