@extends('rumbok.app')
 @section('content')

<!--======================================
        END HEADER AREA
======================================-->
<style>
    .section-title h2 span {
        color: #f4791e;
    }

    @media (max-width:767px) {
        .navbar-brand {
            display: block;
        }

        .navbar.navbar-expand-lg .navbar-toggler {
            display: block;
        }
    }
    select.rounded-select {
    border-radius: 50px;
    padding: 5px 20px;
    width:100%;
    max-width:200px;
}
</style>
<style>
    .section__title11 {
        font-size: 20px;
        font-weight: 700;
        color: #263a72;
    }
    .product-grid3 .product-image3 .video-link {
        right: 50%;
        width: 50px;
        top: 42%;
        height: 50px;
        line-height: 50px;
        background-color: #fff;
        color: #fd0000;
        border-radius: 50%;
        /* text-align: center; */
        box-shadow: -2px 1px 5px 7px rgb(0 0 0 / 34%);
        -webkit-transform: translate(25px,-25px);
        transform: translate(25px,-25px);
        text-align: center;
        z-index: 1;
    }
    .course-content-wrapper img {
        max-height: 150px;
        min-height: 150px;
        width: 100%;
    }
    .product-grid3 {
        font-family: Roboto,sans-serif;
        text-align: center;
        z-index: 1;
        border: 1px solid #ddd;
    }
    .content-h1 {
        /* background: linear-gradient(180deg,#ffd65e 0,#febf04)!important; 
        background-image: linear-gradient(#ffd65e, #febf04, yellow); */
        background-image: linear-gradient(#59aced, #539bdb, #0060aa);
        text-align: center;
        border: 1px solid #57a4df;
        
    }
    .section-divider1 {
        display: inline-block; 
        / position: relative; /
        / height: 5px; /
        / -webkit-border-radius: 30px; /
        / -moz-border-radius: 30px; /
        / border-radius: 30px; /
        / background-color: #036e65; /
        / width: 90px; /
        / margin-top: 10px; /
        / margin-bottom: 25px; /
        / overflow: hidden; /
    }
    .sidebar-widget
    {
        / background-color: #0060aa; /
        margin-top: 17px;
    }
    .ul-lists {
        text-align: center;
    
        }
        
        span#basic-addon2 {
        background-color: #036e65;
        color: aliceblue;
    }   
    label.course-hvr {
        width: 100%;
        padding: 10px;
        border-bottom: 1px solid white;
        color: #0a0808;
        background-image: linear-gradient(#ffe6a9, #ffd14a, #febf07);
        text-align: left;
    }
    .sidebar-widget .widget-title {
        font-size: 20px;
        margin-bottom: 0px;
    }
    svg {
        overflow: hidden;
        vertical-align: middle;
        height: 23px;
    }
    .page-navigation .page-go-link, .page-navigation .page-go {
        color: #a0baf5;
        font-size: 14px;
        margin-left: 3px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        display: block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        -webkit-transition: all .3s;
        -moz-transition: all .3s;
        -ms-transition: all .3s;
        -o-transition: all .3s;
        transition: all .3s;
    }
    /* .breadcrumb-area
    {
        background-image: url(..images/industry.jpg);
    } */
    .breadcrumb-area {
        background-color: #f7fafd;
        height: 120px;
        display: -webkit-flex;
        display: -ms-flex;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        position: relative;
        text-align: center;
        z-index: 2;
        color: #fff;
        background-image:url(http://3.108.39.127/v2/public/frontend/images/industry.jpg);
        background-size: cover;
        background-position: center;
        box-shadow: 0px 2px 8px 0px rgb(0 0 0 / 12%);
    }
    .breadcrumb-area:before {
        position: absolute;
        content: '';
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #e9f5ff;
        opacity: .90;
        z-index: -1;
    }

    .input-group-append {
        margin-left: -1px;
        height: 38px;
    }
    .filter-bar {
        background-color: #fff;
        border: 0;
    }
    .page-navigation .page-navigation-nav li:hover .page-go-link, .page-navigation .page-navigation-nav li.active .page-go-link {
        background-color: #0060aa;
        color: #fff;
    }

    .custom-checkbox label:hover {
        color: #000;
        background: linear-gradient(180deg,#a9e4f7 0,#0fb4e7)!important;
        text-decoration: none;
    }
    label.course-hvr.active {
        background: linear-gradient(180deg,#a9e4f7 0,#0fb4e7)!important;
    }
    label.course-hvr.active {
        background: linear-gradient(180deg,#a9e4f7 0,#0fb4e7)!important;
    }
    label.course-hvr {
        width: 100%;
        display: block;
        padding: 8px 5px;
        border-bottom: 1px solid white;
        color: #0a0808;
        background-image: linear-gradient(#ffe6a9, #ffd14a, #febf07);
        font-size: 12px;
        line-height: 1;
        margin: 0;
    }
    .product-grid3 {
        font-family: Roboto,sans-serif;
        text-align: center;
        z-index: 1;
        border: 1px solid #ddd;
    }
    .product-image3 {
        position: relative;
    }
    .product-image3:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgb(0 96 170 / 45%);
    }
    .custom-checkbox {
        margin-bottom: 7px;
    }
    .sidebar-widget {
        margin-bottom: 30px;
        border: 0;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        padding: 30px;
        -webkit-box-shadow: 0 0 40px rgb(82 85 90 / 6%);
        -moz-box-shadow: 0 0 40px rgba(82, 85, 90, 0.06);
        box-shadow: 0 0 40px rgb(82 85 90 / 6%);
        background-color: #fff;
    }
    .filter-bar {
        background-color: #fff;
        /* border: 1px solid rgba(127, 136, 151, 0.2); */
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        padding: 6px;
        -webkit-box-shadow: 0 0 40px rgb(82 85 90 / 6%);
        -moz-box-shadow: 0 0 40px rgba(82, 85, 90, 0.06);
        box-shadow: 0 0 40px rgb(82 85 90 / 6%);
    }
    .openbtn {
        font-size: 20px;
        cursor: pointer;
        background-color: #111;
        color: white;
        padding: 10px 15px;
        border: none;
        width: 100%;
        margin-bottom: 10px;
    }
    .form-control.search-type
    {
        max-width: 216px;
    }
    @media  screen and (max-width: 425px) {
        .sidebar-widget
    {
        / background-color: #0060aa; /
        margin-top: 17px;
    }
    .ul-lists {
        text-align: center;
    
        }
        h3.widget-title {
        border: 1px solid;
        height: 71px;
        background-image: linear-gradient(#59aced, #539bdb, #0060aa);
        text-align: center;
    }
    .section-divider {
        display: inline-block;
    
        -webkit-border-radius: 30px;
        -moz-border-radius: 30px;
        border-radius: 30px;
        background-color: #036e65;
        width: 90px;
        margin-top: 10px;
        margin-bottom: 25px;
        overflow: hidden;
    }
    .sidebar-widget .section-divider {
    
        margin-top: 0;
        margin-bottom: 20px;
    }
    label.course-hvr.active {
        background: linear-gradient(180deg,#a9e4f7 0,#0fb4e7)!important;
    }
    .breadcrumb-content .section__title {
        font-size: 25px;
    }
    .side-list{
        padding-top: 0.5rem!important
        font-weight: 700 !important;
        padding-bottom: 0.5rem!important;
        margin-bottom: 0!important;
        font-size: 1rem;
    }
    .product-grid3 .product-image3 .video-link {
        right: 50%;
        width: 50px;
        top: 50%;
    }
    .course-content-wrapper
    {
        
        margin-top: -45px;
    }
    .course-area {
        position: relative;
    }
    .openbtn {
        font-size: 15px;
        cursor: pointer;
        background-color: #111;
        color: white;
        padding: 10px 30px;
        border: none;
        width: 100%;
        margin-bottom: 10px;
        border-radius: 0.4rem;
    }
    .form-control.search-type
    {
        max-width: 126px;
    }
    }
    .sidebar-ic-list ul li a.active {
        background:none;
        font-weight:bold;
    }
</style>
<!--================================
     START SLIDER AREA
=================================-->
    <!-- For Common To all Hero Banner Start -->
<section class="heading-n-breadcrub-part">
    <div class="container">
            <div class="row">
               <div class="col-lg-6">
               <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                        <h1>Industrial Documentry</h1>
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
                           <span>Industrial Documentry</span>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
</section>


<section class="course-area padding-bottom-120px">
    <div class="course-wrapper">
        <div class="container">
            <div class="course-content-wrapper">
                <div class="row">
                        <div class="col-lg-4">
                            <div class="d-none d-md-block d-lg-block">
                               <div class="sidebar-ic-desktop">
                                    <div class="heading-top">
                                        <a href="/industrial-documentry" class="text-white">See All Industrial Documentry</a>
                                    </div>
                                    <div class="sidebar-ic-list">
                                        <div class="filter-by-category">
                                                <ul class="list-tabs set-sidebar" id="">
                                                    @foreach($docCategories as $docCategories_val)
                                                    <li>
                                                        <a href="javascript:void(0);" onclick="GetdataUsingSlug('{{$docCategories_val->slug}}')" for="chb-2" class="@if(Request::segment(2)==$docCategories_val->slug) active @endif" id="{{$docCategories_val->slug}}"> {{$docCategories_val->name}} </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="main" class="d-md-none d-lg-none d-block mt-3">
                                <button class="openbtn" onclick="openFiltersidebar()">☰ Select Documentry</button>
                            </div>
                            <div id="filterSidepanel" class="sidebar-ic">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeFiltersidebar()">×</a>
                                <div class="heading-top">Industrial Documentry</div>
                                    <div class="sidebar-ic-list">
                                        <a href="/industrial-documentry" class="d-block py-3">See All</a>
                                        <div class="filter-by-category">
                                            <ul class="list-tabs set-sidebar" id="">
                                                @foreach($docCategories as $docCategories_val)
                                                <li>
                                                    <a href="javascript:void(0);" onclick="GetdataUsingSlug('{{$docCategories_val->slug}}')" for="chb-2" class="@if(Request::segment(2)==$docCategories_val->slug) active @endif" id="{{$docCategories_val->slug}}"> {{$docCategories_val->name}} </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php
if(isset($_GET['page'])){
    if($_GET['page']==1){
        $to   = 1;
    }else{
        $to   = ($_GET['page']-1)*50;
    }
    if(count($docContents)==50){
        $from = ($_GET['page'])*50;
    }else{
        $from = $docContents->total();
    }
}else{
    $to   = 1;
    $from = count($docContents);
}
?>                                        
                        <div class="col-lg-8" id="course_show">
                            <div class="row my-2">
                                <div class="col-md-9" id="myTab">
                                    <p id="Showing_Of_Results">Showing {{$to}} - {{$from}} Of {{$docContents->total()}} Results</p>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <div class="search__container">
                                            <input onkeyup="searchdata(this.value)" type="text" class="search__input" placeholder="Search">
                                            <div class="overflow-hidden search-list w-100">
                                                <div id="appendSearchCart1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active show">
                                    <div class="row" id="set-content-data">
                                      @foreach($docContents as $docContents_val)
                                        <div style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal" onclick="openYoutobeurl('{{$docContents_val->url}}','{{$docContents_val->title}}')" class="col-md-4 col-6 mb-3">
                                            <div class="product-grid3 mt-3 h-100 shadow-lg rounded">
                                                <div class="product-image3">
                                                    @php
                                                        $video_id = explode("?v=", $docContents_val->url);
                                                        $video_id = $video_id[1];
                                                    @endphp
                                                    <img class="img-fluid" alt="{{$docContents_val->title}}" src="http://img.youtube.com/vi/{{$video_id}}/maxresdefault.jpg">
                                                    <span class="position-absolute video-link cursor-pointer">
                                                    <svg style="margin-left: 2px;" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" size="40" height="25" width="40" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path>
                                                    </svg>
                                                    </span>
                                                </div>
                                                <div class="product-content pb-0"><b class="title cursor-pointer mb-0 pb-0" title="{{$docContents_val->title}}">{{$docContents_val->title}}</b></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row w-100 mt-5">
                                <div class="col-lg-12">
                                
                                {{$docContents->links()}}

                                </div><!-- end col-lg-12 -->
                            </div>
                        </div>
                </div><!-- end card-content-wrapper -->
            </div>
        </div><!-- end container -->
    </div><!-- end course-wrapper -->
</section>
<div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="padding-right: 17px; display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title for-title-set" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body for-youtobe-set"><iframe width="100%" height="345" src=""></iframe></div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function openYoutobeurl(url,title){
        var url = url.replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/");
        $(".for-title-set").html(title);
        $(".for-youtobe-set").html('<iframe width="100%" height="345" src="'+url+'"></iframe>');
    }

    function GetdataUsingSlug(slug){
        if (document.querySelector('li a.active') !== null) {
            document.querySelector('li a.active').classList.remove('active');
        }
        var element = document.getElementById(slug);
        element.classList.add("active");

        const nextURL = "{{url('industrial-documentry')}}/"+slug;
        const nextTitle = slug;
        const nextState = { additionalInformation: 'Updated the URL with JS' };
        window.history.pushState(nextState, nextTitle, nextURL);
        window.history.replaceState(nextState, nextTitle, nextURL);
    
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("course_show").innerHTML =
            this.responseText;
        }
        xhttp.open("GET", "{{url('industrial-documentry')}}/"+slug+"?work=yes");
        xhttp.send();
    }
    function searchdata(searchdata){
        if(!searchdata==''){
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("set-content-data").innerHTML =
                this.responseText;
            }
            xhttp.open("GET", "{{url('industrial-documentry-search')}}/"+searchdata);
            xhttp.send();
        }
    }
</script>
@endsection