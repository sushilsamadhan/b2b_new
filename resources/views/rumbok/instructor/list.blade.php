@extends('rumbok.app')
@section('content')
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="title-page">
                <h1>Instructors</h1>
              </div>              
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                          <a href="#">Home</a>
                      </li>
                      <li>
                        <span>All Instructors</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
<section class="section-team mb-5">
        <div class="container">
            <div class="heading-section">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="sec-title mb-3">Meet Our Passionate Instructors</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach($instructors as $instructor)
            <?php
                $liveClassDetail = \App\InstructorLiveClass::where('instructor_id',$instructor->id)->latest()->first();
                $timeTableUrl = "javascript:void(0);";
                if($liveClassDetail){
                    $timeTableUrl = url('class-time-table/'.$liveClassDetail->id);
                }
            ?>
                <!-- Start Single Person -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            @if($instructor->image)     
                            <img src="{{filePath($instructor->image)}}" alt="{{$instructor->name}}">
                            @else
                            <img src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="" />
                            @endif
                        </div>
                        <div class="person-info text-center">
                            <h3 class="full-name">{{$instructor->name}}</h3>
                            @if(isset($instructor->heighst_qualification) && $instructor->heighst_qualification!='')
                                <span class="speciality">{{$instructor->heighst_qualification}}</span><br>
                            @endif
                            @if(isset($instructor->total_experience) && $instructor->total_experience!='')
                                <span class="badge badge-info">{{$instructor->total_experience}}</span>
                            @endif
                            <br>
                            <a href="{{$timeTableUrl}}" class="bisylms-btn-6">View Profile</a>
                        </div>
                    </div>
                    
                </div>
                <!-- / End Single Person -->
            @endforeach
        
            </div>
            
        </div>
    </section>


@endsection
