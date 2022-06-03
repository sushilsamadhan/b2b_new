
<style>


.button {
    background-color: #e9ecef;
    border: none;
    color: #000;
    padding: 4px 24px;
    text-align: center;
    border:1px solid #ddd;
    text-decoration: none;
    display: inline-block !important;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

.button-section {
    background-color: #233d63;
    border: 11px;
    color: #fff;
    padding: 8px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block !important;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
}

.btn-default {
    background-color: #7f889785 !important;
}



button {
    margin-top: 30px;
}

.back {
    display: none !important;
}

//.next {
//margin-left: 50px;
//}
.end {
    display: none !important;
}
       
.border {
    border-radius:0px !important;
}
      
.borderss {
    border-radius:0px !important;
    background-color:#dc3545 !important;
}
       
.borderssGreen {
    border-radius:0px !important;
}

.next1selector .col-2:first-child .next1 {
    background-color:#dc3545  !important;
    /* border-radius : 12px; */
}
.next1:first-child {
    /* background-color:red  !important; */
}

.wrapper {
    position:relative;
    margin:0 auto;
    overflow:hidden;
	padding:5px;
  	height:50px;
}
.list {
    position:absolute;
    left:0px;
    top:0px;
  	min-width:3000px;
  	margin-left:12px;
    margin-top:0px;
}

.list li{
	display:table-cell;
    position:relative;
    text-align:center;
    cursor:grab;
    cursor:-webkit-grab;
    color:#efefef;
    vertical-align:middle;
}

.scroller {
  text-align:center;
  cursor:pointer;
  display:none;
  padding:7px;
  padding-top:11px;
  white-space:no-wrap;
  vertical-align:middle;
  background-color:#fff;
}

.scroller-right{
  float:right;
}

.scroller-left {
  float:left;
}
.answer-option {
    margin-bottom:10px;
}
.ans-sec {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 18px;
  color:#000;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.ans-sec input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.ans-sec .checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
  border: 1px solid #a6a6a6;
}

/* On mouse-over, add a grey background color */
.ans-sec:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.ans-sec input:checked ~ .checkmark {
  background-color: #2196F3;
}
/* When the radio button is checked, add a blue background */
.ans-sec input:unchecked ~ .checkmark {
  background-color: #219336F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.ans-sec:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.ans-sec input:checked ~ .ans-sec:after {
  display: block;
}

.addRad{
    background-color:#dc3545  !important;
}
.addGreen {
    background-color:#28a745  !important;
}
.addYelleow {
    background-color:#ffc107  !important; 
}
/* Style the indicator (dot/circle) */
.ans-sec .checkmark:after {
 	top: 8px;
	left: 8px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
    position:absolute;
    content:'';
	background: white;
}
.user-img-thumb {
    width: 40px;
    height: 40px;
    background: #fff;
    border-radius: 50%;
    margin-right: 15px;
    background-repeat: no-repeat;
    background: url(../public/asset_rumbok/images/category-icon-6-home-2.png);
    background-size: cover;
}
.user-name-text {
    line-height: 50px;
    color:#fff;
    font-weight:bold;
}
.user-name-image {
    padding: 10px 15px;
    background: #000;
}
.scroll-bar-div {
    max-height:200px;
    overflow:auto;
}
</style>
@extends('rumbok.app')

@section('content')

<!--======================================
          START breadcrumb AREA
  ======================================-->



<!--======================================
            END breadcrumb AREA
    ======================================-->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!--======================================
            START COURSE AREA
    ====================================== padding-top-80px padding-bottom-120px-->
<section class="">
    <div class="row">
        <div class="col-lg-12">
            <div class="filter-bar d-flex justify-content-between align-items-center">
            <div class="clearfix">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo mr-3"><img src="../public/asset_rumbok/images/logo-ole.png" style="max-width:90px"/></div>
                <p class="font-weight-bold text-dark">
                <span class="badge bg-primary text-white">Subject Test</span><br>
         fvdv
            </div>
             </div>
            <div class="clearfix">
            </div>
            </div>
        </div><!-- end col-lg-12 -->
    </div><!-- end row -->
    <div class="course-content-wrapper mt-4">
     <div class="container-fluid">
        {{-- sidebar --}}
        <div class="row" id="product-gallery-holder-2222">
            @include('frontend.test.component.report-test-start-filter')            
        </div>
      </div>
  
</section><!-- end courses-area -->
<!--======================================
            END COURSE AREA
    ======================================-->
@endsection

@section('js')
{{-- stripe --}}
@endsection