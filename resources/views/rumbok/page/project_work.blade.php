@extends('rumbok.app')
@section('content')

  <!--======================================
          START breadcrumb AREA
  ======================================-->
<style>
section.why-ole:after {
    content: '';
    width: 100%;
    height: 10px;
    background: #253a73;
    position: absolute;
    bottom: 0px;
    z-index: 0;
}
section.why-ole {
    padding: 60px 0;
    margin: 0px 0;
    position: relative;
    background: #f5f5f5;
    border-top: 10px solid #253a73;
}
.question-mark {
    text-align: center;
}
.quextion-mark-icon {
    max-width: 300px;
    margin: 0 auto;
    font-size: 514px;
    line-height: 370px;
    text-shadow: 5px 5px 5px rgb(0 0 0 / 20%);
    color: #fff;
    -webkit-text-stroke: black;
    -webkit-text-stroke-color: #253a73;
    -webkit-text-stroke-width: 5px;
    position: relative;
    z-index: 2;
}
.why-heading h1 {
    text-transform: uppercase;
    font-weight: bold;
    font-size: 50px;
    line-height: 1;
    color: #ff8100;
    -webkit-text-stroke: 1px sienna;
}
ul.pointers {
    margin: 0;
    padding: 0;
    list-style: none;
    margin-top: 30px;
}
.pointers li {
    display: flex;
    font-size: 13px;
    margin-bottom: 10px;
    background: #dbfdff;
    padding: 4px 10px;
    border-radius: 10px;
    color: #0f2256;
    border: 1px solid #253a73;
    box-shadow: 5px 5px 8px rgb(0 0 0 / 20%);
}
.pointers li img {
    width: 19px;
    margin-right: 10px;
    margin-top: 4px;
    height: 19px;
}

.project-card {
  display: inline-block;
  width: 100%;
  padding: 4rem 1rem 4rem 1rem;
  background-color: teal;
  position: relative;
}
.project-card:after {
  content: "";
  display: block;
  width: 0px;
  height: 0px;
  background-color: skyblue;
  top: 0px;
  right: 0px;
  border-bottom: 20px solid #006767;
  border-left: 20px solid #006767;
  border-right: 20px solid yellow;
  border-top: 20px solid yellow;
  position: absolute;
}
.project-card:before {
  content: "";
  display: block;
  width: 0px;
  height: 0px;
  border-top: 40px solid #006767;
  border-right: 40px solid #006767;
  border-left: 40px solid yellow;
  border-bottom: 40px solid yellow;
  bottom: 0px;
  left: 0px;
  position: absolute;
  margin-right: 10%;
}
/* .project-card:nth-of-type(1) {
  margin-right: 9%;
} */
.project-card h2 {
  color: snow;
  margin-bottom: 1rem;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 1px;
}
.project-card p {
  color: snow;
  font-size: 1.1rem;
  line-height: 140%;
}
section.project-learning {
    padding: 60px 0;
    background: yellow;
}
.count-project-card {
    font-size: 75px;
    font-weight: 700;
    color: #fff;
    right: 10px;
    bottom: 32px;
    opacity: 0.5;
}
.ps-timeline-sec {
  position: relative;
  background: #fff;
}
.ps-timeline-sec .container {
  position: relative;
}

.ps-timeline-sec .container ol:before {
  background: #253a73;
  content: "";
  width: 10px;
  height: 10px;
  border-radius: 100%;
  position: absolute;
  left: 8px;
  margin-top:-6px;
}
.ps-timeline-sec .container ol:after {
  background: #253a73;
  content: "";
  width: 10px;
  height: 10px;
  border-radius: 100%;
  position: absolute;
  right: 8px;
  margin-top:-6px;
}
.ps-timeline-sec .container ol.ps-timeline {
  margin: 220px 0;
  padding: 0;
  border-top: 2px solid #253a73;
  list-style: none;
  min-width: 800px;
}
.ps-timeline-sec .container ol.ps-timeline li {
  float: left;
  width: 20%;
  padding-top: 30px;
  position: relative;
}
.ps-timeline-sec .container ol.ps-timeline li span {
    width: 50px;
    height: 50px;
    margin-left: -25px;
    background: #fff;
    border: 4px solid #253a73;
    border-radius: 50%;
    box-shadow: 0 0 0 0px #fff;
    text-align: center;
    line-height: 45px;
    color: #df8625;
    font-size: 1.42em;
    font-style: normal;
    position: absolute;
    top: -26px;
    left: 50%;
}
.ps-timeline-sec .container ol.ps-timeline li span.ps-sp-top:before {
  content: "";
  color: #253a73;
  width: 2px;
  height: 50px;
  background: #253a73;
  position: absolute;
  top: -50px;
  left: 50%;
}
.ps-timeline-sec .container ol.ps-timeline li span.ps-sp-top:after {
  content: "";
  color: #253a73;
  width: 8px;
  height: 8px;
  background: #253a73;
  position: absolute;
  bottom: 90px;
  left: 44%;
  border-radius: 100%;
}
.ps-timeline-sec .container ol.ps-timeline li span.ps-sp-bot:before {
  content: "";
  color: #253a73;
  width: 2px;
  height: 50px;
  background: #253a73;
  position: absolute;
  bottom: -50px;
  left: 50%;
}
.ps-timeline-sec .container ol.ps-timeline li span.ps-sp-bot:after {
  content: "";
  color: #253a73;
  width: 8px;
  height: 8px;
  background: #253a73;
  position: absolute;
  top: 90px;
  left: 44%;
  border-radius: 100%;
}
.ps-timeline-sec .container ol.ps-timeline li .img-handler-top {
    position: absolute;
    bottom: 0;
    margin: 0 auto;
    margin-bottom: 130px;
    border: 2px solid #263b73;
    width: 80px;
    height: 80px;
    left: 50%;
    transform: translateX(-40px);
    line-height: 80px;
    border-radius: 50%;
    background: #e86a2f;
    text-align: center;
    box-shadow: 5px 5px 5px rgb(0 0 0 / 30%);
}
.ps-timeline-sec .container ol.ps-timeline li .img-handler-top img {
  margin: 0 auto;
  max-width:45px !important;
}
.ps-timeline-sec .container ol.ps-timeline li .img-handler-bot {
    position: absolute;
    margin: 0 auto;
    border: 2px solid #263b73;
    margin-top: 60px;
    width: 80px;
    height: 80px;    
    left: 50%;
    transform: translateX(-40px);
    line-height: 80px;
    border-radius: 50%;
    background: #e86a2f;
    text-align: center;
    box-shadow: 5px 5px 5px rgb(0 0 0 / 30%);
}
.ps-timeline-sec .container ol.ps-timeline li .img-handler-bot img {
  margin: 0 auto;
  max-width:45px !important;
}
.ps-timeline-sec .container ol.ps-timeline li p {
  text-align: center;
  width: 80%;
  margin: 0 auto;
}
.ps-timeline-sec .container ol.ps-timeline li .ps-top {
  position: absolute;
  bottom: 0;
  margin-bottom: 100px;
}
.ps-timeline-sec .container ol.ps-timeline li .ps-bot {
  position: absolute;
  margin-top: 35px;
}
@media screen and (max-width: 767px) {
    .ps-timeline-sec .container {
        width:100%;
        max-width: 100%;
        overflow-x: scroll;
    }
  /* .ps-timeline-sec .container ol:before {
    background: #253a73;
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 100%;
    position: absolute;
    top: 130px !important;
    left: 36px !important;
  }
  .ps-timeline-sec .container ol:after {
    background: #253a73;
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 100%;
    position: absolute;
    top: inherit !important;
    left: 36px;
  }
  .ps-timeline-sec .container ol.ps-timeline {
    margin: 130px 0 !important;
    border-left: 2px solid #253a73;
    padding-left: 0 !important;
    padding-top: 120px !important;
    border-top: 0 !important;
    margin-left: 25px !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li {
    height: 220px;
    float: none !important;
    width: inherit !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li:nth-child(2) .img-handler-bot img {
    width: 70px;
  }
  .ps-timeline-sec .container ol.ps-timeline li:last-child {
    margin: 0;
    bottom: 0 !important;
    height: 120px;
  }
  .ps-timeline-sec .container ol.ps-timeline li:last-child .img-handler-bot {
    bottom: 40px !important;
    width: 40% !important;
    margin-left: 25px !important;
    margin-top: 0 !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li:last-child .img-handler-bot img {
    width: 100%;
  }
  .ps-timeline-sec .container ol.ps-timeline li:last-child .ps-top {
    margin-bottom: 0 !important;
    top: 20px;
    width: 50% !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li span {
    left: 0 !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-top:before {
    content: none !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-top:after {
    content: none !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-bot:before {
    content: none !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-bot:after {
    content: none !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li .img-handler-top {
    position: absolute !important;
    bottom: 150px !important;
    width: 30% !important;
    float: left !important;
    margin-left: 35px !important;
    margin-bottom: 0 !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li .img-handler-top img {
    margin: 0 auto !important;
    width: 80% !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li .img-handler-bot {
    position: absolute !important;
    bottom: 115px !important;
    width: 30% !important;
    float: left !important;
    margin-left: 35px !important;
    margin-bottom: 0 !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li p {
    text-align: left !important;
    width: 100% !important;
    margin: 0 auto !important;
    margin-top: 0px !important;
  }
  .ps-timeline-sec .container ol.ps-timeline li .ps-top {
    width: 60% !important;
    float: right !important;
    right: 0;
    top: -40px;
  }
  .ps-timeline-sec .container ol.ps-timeline li .ps-bot {
    width: 60% !important;
    float: right !important;
    right: 0;
    top: -40px;
  }*/
} 
.cta {
    display: flex;
    padding: 10px 25px;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    font-size: 28px;
    color: white;
    max-width:300px;
    margin:0 auto;
    background: #6225E6;
    transition: 1s;
    box-shadow: 6px 6px 0 black;
    transform: skewX(-15deg);
}

.cta:focus {
   outline: none; 
   color:#fff;
}

.cta:hover {
    transition: 0.5s;
    color:#fff;
    box-shadow: 10px 10px 0 #FBC638;
}

.cta span:nth-child(2) {
    transition: 0.5s;
    margin-right: 0px;
}

.cta:hover  span:nth-child(2) {
    transition: 0.5s;
    margin-right: 45px;
}

.cta span {
    transform: skewX(-4deg) 
  }

.cta span:nth-child(2) {
    width: 20px;
    margin-left: 30px;
    position: relative;
    top: 12%;
  }
  
/**************SVG****************/

path.one {
    transition: 0.4s;
    transform: translateX(-60%);
}

path.two {
    transition: 0.5s;
    transform: translateX(-30%);
}

.cta:hover path.three {
    animation: color_anim 1s infinite 0.2s;
}

.cta:hover path.one {
    transform: translateX(0%);
    animation: color_anim 1s infinite 0.6s;
}

.cta:hover path.two {
    transform: translateX(0%);
    animation: color_anim 1s infinite 0.4s;
}

/* SVG animations */

@keyframes color_anim {
    0% {
        fill: white;
    }
    50% {
        fill: #FBC638;
    }
    100% {
        fill: white;
    }
}
</style>
  <section class="heading-n-breadcrub-part mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                    <div class="d-flex align-items-center">
                            <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                            <div class="title-page">
                            <h1>Project Work</h1>
                            </div>
                    </div>          
                    </div>
                    <div class="col-lg-6">
                        <div class="bread-crumb-part">
                            <ul class="bread-crumb-part-list">
                                <li>
                                <a href="{{route('homepage')}}">@translate(home)</a>
                                </li>
                                <li>
                                  <span> {{'Project Work'}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          </section>
  <!--======================================
          END breadcrumb AREA
  ======================================-->

    <section class="product-category">
        
           <div class="clearfix">
               <img src="{{asset('asset_rumbok/new/images/banner-project.jpg')}}" alt="" class="img-fluid w-100"/>
           </div>
        
        
    </section>
    <section class="why-ole">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="question-mark">
                        <div class="quextion-mark-icon">?</div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="why-heading">
                        <h1> 
                        Why project work with OLexpert?
                        </h1>
                    </div>
                    <div class="why-content">
                        <ul class="pointers">
                        <li><img src="{{asset('asset_rumbok/new/images/arrow-highlight.png')}}" alt=""/> Project-based learning (PBL) is an instructional approach designed to give students the opportunity to develop knowledge and skills through engaging projects set around challenges and problems they may face in the real world.</li>
                        <li><img src="{{asset('asset_rumbok/new/images/arrow-highlight.png')}}" alt=""/> Realtime Learning approach.</li> 
                        <li><img src="{{asset('asset_rumbok/new/images/arrow-highlight.png')}}" alt=""/> OLExpert Discover innovative potential in learners.</li>
                        <li><img src="{{asset('asset_rumbok/new/images/arrow-highlight.png')}}" alt=""/> Provide professional platform to your thoughts with expert guidance.</li>
                        <li><img src="{{asset('asset_rumbok/new/images/arrow-highlight.png')}}" alt=""/> Bring you and your innovation on public platform via Social Media & Digital Promotions.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="project-learning">

        <div class="container">
            
            <div class="row">
                <div class="col-md-12">
                    <h1 class="project-learning-heading text-center mb-5">Importance of Project based learning?</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="project-card h-100">
                    <p>A journey from subjective knowledge to Practical world.</p>
                    <span class="position-absolute count-project-card">01</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="project-card h-100">
                    <p>Realtime Learning approach</p>
                    <span class="position-absolute count-project-card">02</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="project-card h-100">
                    <p>Project-based learning (PBL) is an instructional approach designed to give students the opportunity to develop knowledge and skills through engaging projects set around challenges and problems they may face in the real world.</p>
                    <span class="position-absolute count-project-card">03</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-to-proceed ps-timeline-sec py-5">
        <div class="container-fluid">
        <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mb-3">How to proceed?</h1>
                </div>
            </div>
        </div>
    <div class="container">
    
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                        <img src="{{asset('asset_rumbok/new/images/select-project.png')}}" alt="" class="img-icon"/>
                    </div>
                    <div class="ps-bot">
                        <p>Choose a project as per your current class curriculum and choice</p>
                    </div>
                    <span class="ps-sp-top">01</span>
                </li>
                <li>
                    <div class="img-handler-bot">
                        <img src="{{asset('asset_rumbok/new/images/create-project.png')}}" alt="" class="img-icon"/>
                    </div>
                    <div class="ps-top">
                        <p>Create / Develop project by your own</p>
                    </div>
                    <span class="ps-sp-bot">02</span>
                </li>
                <li>
                    <div class="img-handler-top">
                        <img src="{{asset('asset_rumbok/new/images/submit.png')}}" alt="" class="img-icon"/>
                    </div>
                    <div class="ps-bot">
                        <p>Submit video and project report in pdf format</p>
                    </div>
                    <span class="ps-sp-top">03</span>
                </li>
                <li>
                    <div class="img-handler-bot">
                        <img src="{{asset('asset_rumbok/new/images/verfication.png')}}" alt="" class="img-icon"/>
                    </div>
                    <div class="ps-top">
                        <p>OLExpert Team will verify your submission</p>
                    </div>
                    <span class="ps-sp-bot">04</span>
                </li>
                <li>
                    <div class="img-handler-top">
                        <img src="{{asset('asset_rumbok/new/images/certificate.png')}}" alt="" class="img-icon"/>
                    </div>
                    <div class="ps-bot">
                        <p>After verification and acceptance you will get certificate</p>
                    </div>
                    <span class="ps-sp-top">05</span>
                </li>
            </ol>
        </div>
    </section>
    {{--<section class="py-3">
        <div class="container">
            <div class="text-center">
            @auth()
                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                    <a class="cta" href="{{route('project.create')}}">
                        <span>@translate(Enroll Now)</span>
                        <span>
                        <svg width="50px" height="35px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                            <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                            <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                            </g>
                        </svg>
                        </span> 
                    </a>
                        
                    @else
                    <a class="cta" href="{{route('login')}}">
                        <span>@translate(Enroll Now)</span>
                        <span>
                        <svg width="50px" height="35px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                            <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                            <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                            </g>
                        </svg>
                        </span> 
                    </a>
                    @endif
                @endauth
                @guest
            <a class="cta" href="{{route('login')}}">
                <span>Enroll Now</span>
                <span>
                <svg width="50px" height="35px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                    <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                    <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                    </g>
                </svg>
                </span> 
            </a>
            @endguest
            </div>
        </div>
    </section>--}}
@endsection
