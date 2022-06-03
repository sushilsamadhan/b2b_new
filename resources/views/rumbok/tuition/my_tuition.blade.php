@extends('rumbok.app')
@section('content')
<style>
.section-title h2 span {
    color: #f4791e;
}
.card-tution {
  border: 1px solid #ddd;
  padding: 10px 15px;
  box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.12);
  margin-bottom:20px;
}
.card-tution .teacher-deatails .teacher-name h3 {
  font-size: 18px;
  font-weight: 600;
  color: #000;
  margin-bottom: 0;
}
.teacher-deatails .teacher-name p {
  color: #8c8c8c;
  text-transform: uppercase;
  font-size: 13px;
  margin-bottom: 5px;
}
.date-time-tution .tutuion-day-date {
  font-size: 13px;
  font-weight: 600;
}
.date-time-tution .tutuion-day-time {
  font-size: 13px;
  font-weight: 600;
}
.date-time-tution {
  background: #ffdac8;
  border: 1px solid #e86a2f;
  text-align: center;
  padding: 5px;
  border-radius: 5px;
  margin-bottom: 5px;
}
.class-board {
  background: #253a73;
  color: #fff;
  line-height: 1;
  border-radius: 4px;
  font-size: 10px;
  padding: 5px 5px;
  text-transform: uppercase;
  text-align: center;
  max-width: 100px;
  margin: 5px auto;
}
.teacher-img {
    width: 86px;
    height: 86px;
    margin: 0 auto;
    margin-bottom: 5px;
    border-radius: 50%;
    overflow: hidden;
}
.teacher-img img.img-fluid {
    height: 100%;
}
a.join-now.not-active {
  background: #888;
  text-decoration: none;
  color: #fff;
  border-radius: 3px;
  padding: 5px 10px;
  line-height: 1;
  display: inline-block;
  font-size: 12px;
  text-transform: uppercase;
}

</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
          <div class="d-flex align-items-center">
                            <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                            <div class="title-page">
                            <h1>My Tuition</h1>
                            </div>
                            <div class="title-page ml-4">
                            <a href="{{url('live-tuition')}}" class="btn btn-primary btn-sm line-height-1 py-1">+ Book Tuition</a>
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
                        <span>My Tuition</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
    <section class="feature-section">
        <div class="container">
        <div class="row py-0">
          @if(count($dataBooking) > 0)
          @foreach($dataBooking as $valBooking)
        <div class="col-lg-4 col-md-6">
        <div class="card-tution">
                <div class="row py-0">
                    <div class="col-md-4">
                        <div class="class-board">{{$valBooking->boardname}} - {{$valBooking->classname}}</div>
                        <div class="teacher-img">
                        @if($valBooking->image)     
                      <img src="{{filePath($valBooking->image)}}" alt="{{$valBooking->insname}}" class="img-fluid">
                        @else
                        <img src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="" class="img-fluid"/>
                        @endif 
                        </div>

                    @php


    $startTime = date("H:i", strtotime('- 10 minutes', strtotime($valBooking->start_time)));
    $end_time = date("H:i", strtotime('- 0 minutes', strtotime($valBooking->end_time)));

            $currentdate = date('H:i', time());

                    @endphp

                        @if($startTime < $currentdate && $end_time > $currentdate)
                        <div class="clearfix text-center"><a class="bg-success join-now active" href="{{url('my/tuition')}}/{{$valBooking->unic_jitsi_code}}">Join Now</a></div>   

                        @else

                        <div class="clearfix text-center"><a class="join-now not-active" href="#">Join Now</a></div> 

                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="teacher-deatails">
                            <div class="teacher-name">
                                <h3>{{$valBooking->insname}}</h3>
                                <p>{{$valBooking->title}}</p>
                            </div>
                            <div class="date-time-tution">
                                    <div class="tutuion-day-date"><i class="fa fa-calendar"></i> {{date('l', strtotime($valBooking->date_of_booking))}}, {{$valBooking->date_of_booking}}</div>
                                    <div class="tutuion-day-time ml-auto"><i class="fa fa-clock"></i> {{$valBooking->time_of_booking}}</div>
                            </div>
                            <div class="d-flex align-items-center">
                                  @if($startTime < $currentdate && $end_time > $currentdate)
                                  <p class="mb-0 small text-danger line-height-1">*Join link would active before 10 minutes </p>
                                      

                                  @else

                                  <p class="mb-0 small text-danger line-height-1">*Join link would active before 10 minutes </p>
                                  

                                  @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            
        </div> 
         @endforeach
        @else
          <div class="col-md-12 text-center"> <a href="{{url('live-tuition')}}" class="btn btn-primary px-5 py-4">+ Book Tuition</a> </div>
        @endif
        </div>
            <div class="row">
                <div class="col-12">
                    <div class="template-pagination margin-top-20">
                        {{ $dataBooking->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection


