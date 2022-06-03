@extends('rumbok.app')
@section('content')

  <!--======================================
          START breadcrumb AREA
  ======================================-->
<style>

</style>

<section class="why-pbl">
 <div class="container">
  <div class="row">
   <div class="col-md-6">
    <div class="pbl-content">
      <div class="why-pbl-heading">
        <h1>What is Project Based Learning (PBL)</h1>
      </div>
      <div class="why-pbl-content">
        <p>PBL involves the real time interaction of student with live machine, teaching, industries and experience the real world problems and complex senarios. </p>
      </div>
      <div class="quote-text-main">
        <div class="quote-part-top"><span><img src="{{asset('asset_rumbok/new/images/quotes-top.png')}}"></span></div>
        <div class="quote-text">
          A journery from<br><span class="text-uppercase text-warning font-weight-bold">subjective knowledge to</span><br><span class="text-uppercase text-white font-weight-bold">practical world</span>
        </div>
        <div class="quote-part-bottom"><span><img src="{{asset('asset_rumbok/new/images/quotes-bottom.png')}}"></span></div>
      </div>
    </div>
   </div>
   <div class="col-md-6"></div>
  </div>
 </div>
</section>

<section class="why-to-join-pbl my-3">
 <div class="container">
  <div class="gutter-parent-div">
    <div class="row no-gutter">
    <div class="col-md-6">
      <img src="{{asset('asset_rumbok/new/images/industrail-learning.jpg')}}" class="w-100">
    </div>
    <div class="col-md-6 bg-light-logo-1">
      <div class="clearfix p-3">
        <div class="content-part-gutter-div pr-3">
          <h2>Why Project work from OLExpert?</h2>
          <ul>
            <li>Rote learning to Industrial approach</li>
            <li>Breaking the concept of traditional learning pattern</li>
            <li>Holistic Development </li>
            <li>Verbal, Visual, Logical and Kinesthetic module based</li>
          </ul>
          {{-- 
          <a class="pbl-button" href="#"><span class="pbl-btn-icon"><img src="https://olexpert.org.in/public/asset_rumbok/new/images/pbl-projects.png"></span> See our PBL projects</a>
          --}}
        </div>
      </div>
    </div>
    </div>
  </div>
 </div>
</section>

<section class="why-to-join-pbl my-3">
 <div class="container">
  <div class="gutter-parent-div">
    <div class="row no-gutter">
    <div class="col-md-6 bg-light-logo-2">
      <div class="clearfix p-3">
        <div class="content-part-gutter-div pl-3">
          <h2>Importance of Project based learning</h2>
          <ul>
            <li>Skill based learning</li>
            <li>Learning with Practicals</li>
            <li>Garnering support in higher education </li>
            <li>Constructing mental models of the world</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <img src="{{asset('asset_rumbok/new/images/importance-pbl.jpg')}}" class="w-100">
    </div>
    </div>
  </div>
 </div>
</section>

<section class="clearfix my-3">
  <div class="container text-center">
    <a class="pbl-button" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><span class="pbl-btn-icon"><img src="{{asset('asset_rumbok/new/images/pbl-projects.png')}}"/></span> See our PBL projects</a>
  </div>
  <div class="container text-center my-2 collapse" id="collapseExample">
      <div class="row">
                <div class="col-md-12">
                    <h2 class="project-learning-heading text-center mb-2">Choose your study standard</h2>
                </div>
      </div>
      
      <div class="wrapper-select">
        @foreach($pwCategory as $pwcat)
          @php
            $cat_slug = str_replace(" ","-",strtolower($pwcat->category_name));
          @endphp
          @if($pwcat->child->count()>0)
          <style>
            #{{$cat_slug}}:checked:checked ~ .{{$cat_slug}} {
                  border-color: #0069d9;
                  background: #0069d9;
              }
              #{{$cat_slug}}:hover ~ .{{$cat_slug}} {
                  border-color: #0069d9;
                  background: #0069d9;
              }
              #{{$cat_slug}}:checked:checked ~ .{{$cat_slug}} .dot {
                  background: #fff;
              }
              #{{$cat_slug}}:hover ~ .{{$cat_slug}} .dot {
                  background: #fff;
              }
              #{{$cat_slug}}:checked:checked ~ .{{$cat_slug}} span {
                  color: #fff;
              }
              #{{$cat_slug}}:checked:checked ~ .{{$cat_slug}} .dot::before {
                  opacity: 1;
                  transform: scale(1);
              }
              #{{$cat_slug}}:hover ~ .{{$cat_slug}} .dot::before {
                  opacity: 1;
                  transform: scale(1);
              }
              .wrapper-select .option:hover span {
                  color: #fff;
              }
              .wrapper-select .option:hover {
                  border-color: #0069d9;
                  background: #0069d9;
              }
              .wrapper-select .option:hover .dot::before {
                  opacity: 1;
                  transform: scale(1);
              }
          </style>
            <input type="radio" name="select" id="{{$cat_slug}}">
            <label for="{{$cat_slug}}" class="option {{$cat_slug}}" data-toggle="collapse" data-target="#{{$cat_slug}}" aria-expanded="false" aria-controls="{{$cat_slug}}">
              <div class="dot"></div>
                <span>{{$pwcat->category_name}}</span>
            </label>
          @else
            <a href="{{route('project_work.pw_course_list',[$pwcat->slug])}}" class="option"  tabindex="-1">
            <div class="dot"></div>  
            <span>{{$pwcat->category_name}}</span></a>
          @endif
        @endforeach
      </div>
      @foreach($pwCategory as $pwcat)
    @php
      $cat_slug = str_replace(" ","-",strtolower($pwcat->category_name));
    @endphp
    
      @if($pwcat->child->count()>0)
        <div class="container collapse my-3" id="{{$cat_slug}}">
          
          <div class="row">
          @foreach($pwcat->child as $child)
            <div class="col-md-2 mb-3">
              <a href="{{route('project_work.pw_course_list',[$child->slug])}}">
                  <div class="college-stream h-100 text-center" tabindex="-1">
                    <div class="full-form"><h5>{{$child->category_name}}</h5></div>
                  </div>
              </a>
            </div>
          @endforeach
          </div>
        </div>
      @endif
    
  @endforeach
    </div>
<div id="collapseExample"></div>


@foreach($pwCategory as $pwcat)
          @php
            $cat_slug = str_replace(" ","-",strtolower($pwcat->category_name));
          @endphp
          @if($pwcat->child->count()>0)
<div id="{{$cat_slug}}"></div>
@else
            
          @endif
        @endforeach
 
  <!-- <div class="container collapse" id="stream">
        <div class="row">
           <div class="col-md-2 mb-3">
              <div class="college-stream h-100 text-center" tabindex="-1">
                 <div class="full-form"><h5>Arts</h5></div>
              </div>
           </div>
           <div class="col-md-2 mb-3">
              <div class="college-stream h-100 text-center" tabindex="-1">
                 
                 <div class="full-form"><h5>Architecture</h5></div>
              </div>
           </div>
           <div class="col-md-2 mb-3">
              <div class="college-stream h-100 text-center" tabindex="-1">
                 
                 <div class="full-form"><h5>Engineering</h5></div>
              </div>
           </div>
           <div class="col-md-2 mb-3">
              <div class="college-stream h-100 text-center" tabindex="-1">
                 <div class="full-form"><h5>Commerce</h5></div>
              </div>
           </div>
           <div class="col-md-2 mb-3">
              <div class="college-stream h-100 text-center" tabindex="-1">
                 <div class="full-form"><h5>Medical</h5></div>
              </div>
           </div>
           <div class="col-md-2 mb-3">
              <div class="college-stream h-100 text-center" tabindex="-1">
                 <div class="full-form"><h5>Indian Army</h5></div>
              </div>
           </div>
        </div>
  </div> -->

</section>


    
@endsection
