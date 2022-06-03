@extends('rumbok.app')
@section('content')
<style>
p {
 text-transform: capitalize; 
}
.btn-vsm {
    padding: 2px 5px !important;
    line-height: 1;
    color: #fff !important;
    font-size: 12px;
}

.card-test {
  padding: auto;
  text-align: center;
  background: #fff;
  border-radius: 10px;
  box-shadow: 25px 25px 50px #e3e3e36b, -25px -25px 50px #e3e3e3ad;
  margin-bottom:15px;
}
.card-test .card__content {
  width: 90%;
  background: #fff;
  margin: 10px auto;
  border-radius: 5px;
  padding: 20px;
  cursor: pointer;
  box-shadow: 16px 16px 44px #e3e3e366, -16px -16px 44px #e3e3e3;
  transition: 0.3s all ease-in-out;
}
.card-test .card__content:hover {
  margin-top: -10px;
}
.card-test .card__header {
  text-transform: uppercase;
  font-size: 20px;
  margin: 10px auto;
}
.card-test .card__button {
  padding: 10px;
  border-radius: 50px;
  background: #1f75c4;
  color: white;
  font-weight: bold;
  cursor: pointer;
  border: none;
  margin: 10px auto;
}
.btn-rounded {
    border-radius: 50px;
}
.card-test-footer {
    border-top: 1px solid #ddd;
    padding-top: 15px;
    margin-left: -20px;
    margin-right: -20px;
}
.data-card {
  display: flex;
  flex-direction: column;
  overflow: hidden;
  border-radius: 0.5em;
  text-decoration: none;
  background: #fff;
  margin: 1em;
  padding: 1.50em 1.5em;
  border:1px solid #ddd;
  box-shadow: 0 1.5em 2.5em -0.5em rgba(0, 0, 0, 0.1);
  transition: transform 0.45s ease, background 0.45s ease;
}
.data-card h3 {
    color: #2e3c40;
    font-size: 1.1em;
    font-weight: 600;
    line-height: 1;
    padding-bottom: 0.5em;
    margin: 0 0 1.142857143em;
    border-bottom: 2px solid #253a73;
    transition: color 0.45s ease, border 0.45s ease;
}
.data-card h4 {
  color: #627084;
  text-transform: uppercase;
  font-size: 1.125em;
  font-weight: 700;
  line-height: 1;
  letter-spacing: 0.1em;
  margin: 0 0 1.2em;
  transition: color 0.45s ease;
}
.data-card p {
  opacity: 1;
  color: #111;
  font-weight: 600;
  line-height: 1.8;
  margin: 0 0 1.25em;
  transform: translateY(-1em);
  transition: opacity 0.45s ease, transform 0.5s ease;
}
.data-card .link-text {
  display: block;
  color: #e86a2f;
  font-size: 1.125em;
  font-weight: 600;
  line-height: 1.2;
  margin: auto 0 0;
  transition: color 0.45s ease;
}
.data-card .link-text svg {
  margin-left: 0.5em;
  transition: transform 0.6s ease;
}
.data-card .link-text svg path {
  transition: fill 0.45s ease;
}
.data-card:hover {
  background: #e86a2f;
  transform: scale(1.02);
  text-decoration:none;
}
.data-card:hover h3 {
  color: #ffffff;
  border-bottom-color: #e86a2f;
}
.data-card:hover h4 {
  color: #ffffff;
}
.data-card:hover p {
  opacity: 1;
  transform: none;
  color: #fff;
}
.data-card:hover .link-text {
  color: #ffffff;
}
.data-card:hover .link-text svg {
  -webkit-animation: point 1.25s infinite alternate;
          animation: point 1.25s infinite alternate;
}
.data-card .link-text svg path {
  fill: #e86a2f;
}
.data-card:hover .link-text svg path {
  fill: #ffffff;
}

@-webkit-keyframes point {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(0.125em);
  }
}

@keyframes point {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(0.125em);
  }
}
</style>
    <!--======================================
          START breadcrumb AREA
  ======================================-->
    <section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="title-page">
                <h1>{{ $packageDetail->pkg_name }} Practice Test</h1>
              </div>              
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <!-- <ul class="bread-crumb-part-list">
                      <li>
                          <a href="#">Home</a>
                      </li>
                      <li>
                        <span>Courses CBSE</span>
                      </li>
                  </ul> -->
              </div>
          </div>
      </div>
  </div>
</section>
    <!--======================================
            END breadcrumb AREA
    ======================================-->


    <!--======================================
            START COURSE AREA
    ======================================-->
    <section class="course-area padding-top-80px padding-bottom-120px">
        <div class="course-wrapper">
            <div class="container">                
                <div class="course-content-wrapper mt-4">
                    <div class="row">
                        {{-- sidebar --}}
                        <div class="col-lg-3">
                            <div class="card-test">
                            @if($type == 'Subject')
                                <div class="card__content">

                                    <h3 class="card__header">Subject Test</h3>
                                    <div class="card__info">
                                              @if($totalAttend != 0)
                                                            @if($totalAttend < $packageDetail->no_of_sectional_test )
                                                        <p> <span class="badge bg-warning text-dark"> {{ $totalAttend }}/{{ $packageDetail->no_of_sectional_test }}</span>    </p>  
                                                            <!-- <p><a href="{{ route('subject-test-detail',$packageDetail->id) }}" class="btn btn-success">Re-attempt</a> </p> -->
                                                            @else
                                                            <p><span class="badge bg-warning text-dark"> {{ $totalAttend }}/{{ $packageDetail->no_of_sectional_test }}</span></p>
                                                            <p class="btn btn-success">Completed</p> 
                                                            @endif
                                                        @else
                                                        <p><span class="badge bg-warning text-dark"> 0/{{ $packageDetail->no_of_sectional_test }}</span></p> 
                                                                                    
                                                        <!-- <p><a href="{{ route('subject-test-detail',$packageDetail->id) }}" class="btn btn-primary">Attempt</a></p> -->
                                                        @endif
                                    </div>
                                    <!-- <div class="card-test-footer text-center">
                                        <a class="btn btn-outline-dark btn-rounded" data-toggle="collapse" href="#subjectTest" role="button" aria-expanded="false" aria-controls="collapseExample">View Details</a>
                                    </div> -->
                                </div>
                                @elseif($type == 'Unit')
                                <div class="card__content">

                                    <h3 class="card__header">Unit Test</h3>
                                    <div class="card__info">
                                              @if($totalUnitAttend != 0)
                                                            @if($totalUnitAttend < $packageDetail->no_of_practice_test )
                                                        <p> <span class="badge bg-warning text-dark"> {{ $totalUnitAttend }}/{{ $packageDetail->no_of_practice_test }}</span>    </p>  
                                                            <!-- <p><a href="{{ route('unit-test-detail',$packageDetail->id) }}" class="btn btn-success">Re-attempt</a> </p> -->
                                                            @else
                                                            <p><span class="badge bg-warning text-dark"> {{ $totalUnitAttend }}/{{ $packageDetail->no_of_practice_test }}</span></p>
                                                            <p class="btn btn-success">Completed</p> 
                                                            @endif
                                                        @else
                                                        <p><span class="badge bg-warning text-dark"> 0/{{ $packageDetail->no_of_practice_test }}</span></p> 
                                                                                    
                                                        <!-- <p><a href="{{ route('unit-test-detail',$packageDetail->id) }}" class="btn btn-primary">Attempt</a></p> -->
                                                        @endif
                                    </div>
                                    <!-- <div class="card-test-footer text-center">
                                        <a class="btn btn-outline-dark btn-rounded" data-toggle="collapse" href="#subjectTest" role="button" aria-expanded="false" aria-controls="collapseExample">View Details</a>
                                    </div> -->
                                </div>
                                @else
                                <div class="card__content">

                                <h3 class="card__header">Chapter Test</h3>
                                <div class="card__info">
                                          @if($totalChapterAttend != 0)
                                                        @if($totalChapterAttend < $packageDetail->no_of_test )
                                                    <p> <span class="badge bg-warning text-dark"> {{ $totalChapterAttend }}/{{ $packageDetail->no_of_test }}</span>    </p>  
                                                        <!-- <p><a href="{{ route('chapter-test-detail',$packageDetail->id) }}" class="btn btn-success">Re-attempt</a> </p> -->
                                                          
                                                        @else
                                                        <p><span class="badge bg-warning text-dark"> {{ $totalChapterAttend }}/{{ $packageDetail->no_of_test }}</span></p>
                                                        <p class="btn btn-success">Completed</p> 
                                                        @endif
                                                    @else
                                                    <p><span class="badge bg-warning text-dark"> 0/{{ $packageDetail->no_of_test }}</span></p> 
                                                                                
                                                    <p><a href="{{ route('chapter-test-detail',$packageDetail->id) }}" class="btn btn-primary">Attempt</a></p>
                                                    @endif
                                </div>
                                <!-- <div class="card-test-footer text-center">
                                    <a class="btn btn-outline-dark btn-rounded" data-toggle="collapse" href="#subjectTest" role="button" aria-expanded="false" aria-controls="collapseExample">View Details</a>
                                </div> -->
                               
                                </div>
                                @endif
                                @php 
                                $path = Session::get('location_path');
                                $path1 = Session::get('location_path1');
                         
                                @endphp
                                @if($path)
                                <i class="fas fa-arrow-left"></i> 
                                    <input type="button" value="Back" class="btn btn-default" data-dismiss="modal" id="btnHome" onClick="document.location.href='{{ url('')}}/package/{{$path}}/{{$path1}}'" />
                                @else
                                <a href="javascript:history.back()">  <i class="fas fa-arrow-left"></i> <span class="link-text">
                                              Back
                                            
                                          </span>
                                </a>                        
                                @endif
                        
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                              @foreach($getTestReports as $getTestReport)
                                <div class="col-lg-6">
                                  <a href="{{ route('mock_analytical_report' , [$packageDetail->id , $getTestReport->id]) }}" class="data-card">

                                  @php $getCreated =  getCreatedAtAttribute($getTestReport->created_at) ;@endphp
                                      
                                  @php $getTotalMarks = getTotalMarks($getTestReport->id ,$packageDetail->id);  @endphp
                                  <h3>{{ $getCreated }} <span class="badge badge-primary float-right"> {{ $getTotalMarks * 2 }}/{{ $getTestReport->MockTestEnrollmentAnswer->count() *2 }}</span></h3>
                                      <h4>No. of questions - {{ $getTestReport->MockTestEnrollmentAnswer->count() }}</h4>
                                     
                                      @php $start_time = date("H", strtotime($getTestReport->mock_test_duration));
                                      $middel_time = date("i", strtotime($getTestReport->mock_test_duration));
                                      $end_time = date("s", strtotime($getTestReport->mock_test_duration));
                                      @endphp 
                                      <p><i class="fa fa-clock"></i> {{ $start_time }} hrs : {{$middel_time}} min : {{ $end_time }} sec</p>
                                      <span class="link-text">
                                      View Detail Report
                                      <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
                                  </svg>
                                      </span>
                                  </a>
                                </div>
                                @endforeach
                                <!-- <div class="col-lg-6">
                                <a href="#" class="data-card">
                                    <h3>25 October 2021 <span class="badge badge-warning float-right">345/450</span></h3>
                                    <h4>No. of questions - 30</h4>
                                    <p><i class="fa fa-clock"></i> 02 hrs : 03 min : 35 sec</p>
                                    <span class="link-text">
                                    View Detail Report
                                    <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
                                </svg>
                                    </span>
                                </a>
                                </div>
                                <div class="col-lg-6">
                                <a href="#" class="data-card">
                                    <h3>25 October 2021 <span class="badge badge-warning float-right">345/450</span></h3>
                                    <h4>No. of questions - 30</h4>
                                    <p><i class="fa fa-clock"></i> 02 hrs : 03 min : 35 sec</p>
                                    <span class="link-text">
                                    View Detail Report
                                    <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
                                </svg>
                                    </span>
                                </a>
                                </div>
                                <div class="col-lg-6">
                                <a href="#" class="data-card">
                                    <h3>25 October 2021 <span class="badge badge-warning float-right">345/450</span></h3>
                                    <h4>No. of questions - 30</h4>
                                    <p><i class="fa fa-clock"></i> 02 hrs : 03 min : 35 sec</p>
                                    <span class="link-text">
                                    View Detail Report
                                    <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
                                </svg>
                                    </span>
                                </a>
                                </div>
                                <div class="col-lg-6">
                                <a href="#" class="data-card">
                                    <h3>25 October 2021 <span class="badge badge-warning float-right">345/450</span></h3>
                                    <h4>No. of questions - 30</h4>
                                    <p><i class="fa fa-clock"></i> 02 hrs : 03 min : 35 sec</p>
                                    <span class="link-text">
                                    View Detail Report
                                    <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
                                </svg>
                                    </span>
                                </a>
                                </div>
                                <div class="col-lg-6">
                                <a href="#" class="data-card">
                                    <h3>25 October 2021 <span class="badge badge-warning float-right">345/450</span></h3>
                                    <h4>No. of questions - 30</h4>
                                    <p><i class="fa fa-clock"></i> 02 hrs : 03 min : 35 sec</p>
                                    <span class="link-text">
                                    View Detail Report
                                    <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
                                </svg>
                                    </span>
                                </a>
                                </div>
                                <div class="col-lg-6">
                                <a href="#" class="data-card">
                                    <h3>25 October 2021 <span class="badge badge-warning float-right">345/450</span></h3>
                                    <h4>No. of questions - 30</h4>
                                    <p><i class="fa fa-clock"></i> 02 hrs : 03 min : 35 sec</p>
                                    <span class="link-text">
                                    View Detail Report
                                    <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
                                </svg>
                                    </span>
                                </a>
                                </div>
                                <div class="col-lg-6">
                                <a href="#" class="data-card">
                                    <h3>25 October 2021 <span class="badge badge-warning float-right">345/450</span></h3>
                                    <h4>No. of questions - 30</h4>
                                    <p><i class="fa fa-clock"></i> 02 hrs : 03 min : 35 sec</p>
                                    <span class="link-text">
                                    View Detail Report
                                    <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
                                </svg>
                                    </span>
                                </a>
                                </div> -->
                            </div>
                        </div>

                    </div>
                    
                </div><!-- end card-content-wrapper -->
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section><!-- end courses-area -->
    <!--======================================
            END COURSE AREA
    ======================================-->
@endsection
