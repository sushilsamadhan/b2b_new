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
@media (max-width:850px) {
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
</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
          <div class="d-flex align-items-center">
                            <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                            <div class="title-page">
                            <h1>Live Classes & Schedule</h1>
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
                        <span>Live Classes & Schedule</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
<div class="container">
<div class="row">
<div class="col-md-3">
</div>
<div class="col-md-6">
            <div class="card-content">
                <div class="card-class">
                    <div class="firstinfo ">
                    <?php $showRegisterBtn = false;?>
                    @if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructor->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructor->end_time) )
                    <?php 
                      $instructor_live_class_id = base64_encode($instructor->id);
                      $showRegisterBtn = true;
                    ?>
                     <span class="position-absolute live-class">Live</span>
                     
                    @endif
                      
                     @if($instructor->instructorDetail->image)     
						          <img src="{{filePath($instructor->instructorDetail->image)}}" alt="{{$instructor->instructorDetail->name}}">
                        @else
                        <img src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="" />
                        @endif  
                       <div class="profileinfo flex-grow-1">
                        <h1>{{ $instructor->live_class_title }}</h1>
                        <!-- <span class="badge badge-warning">Grade 8th - 10th</span> -->
                        <h3>{{  date('g:i A', strtotime($instructor->start_time)) }},{!! date('D d M', strtotime($instructor->date)) !!}.  
                          @if($showRegisterBtn)
                          @auth
                          @if (Auth::user()->user_type === "Student")
                          <?php 
                            $liveClassDetail = \App\LiveClassSubscription::where(['instructor_live_class_id'=>$instructor->id,'user_id'=>Auth::user()->id])->first();
                          ?>
                              @if($liveClassDetail)
                                <span>
                                  <a  target="_blank" href='{{ url("$instructor->url") }}'>Join Now</a>
                                </span>
                              @else
                                <span>
                                  <a  href="{{url('live-class-subscription/'.$instructor_live_class_id)}}" class="badge badge-success  border-0">
                                  Register Now</a>
                                </span>
                              @endif

                            @else
                            <span>
                              <a  href="{{url('live-class-subscription/'.$instructor_live_class_id)}}" class="badge badge-success  border-0">
                              Register Now</a>
                            </span>
                          @endif
                          @endauth
                          @guest
                          <span>
                            <a  href="{{url('live-class-subscription/'.$instructor_live_class_id)}}" class="badge badge-success  border-0">
                            Register Now</a>
                          </span>
                          @endguest
                       @endif

                       </h3>
                        <p class="bio text-uppercase mb-0 text-dark">{{ $instructor->instructorDetail->name }} <br><span class="text-muted small font-italic">{{ $instructor->instructorDetail->heighst_qualification }} <span class="badge badge-success font-weight-normal">Experience {{ $instructor->instructorDetail->total_experience}}<sup>+</sup></span></span></p>
                        @foreach($getTimeTables->unique('title')  as $getTimeTable)
                        @php 
                          $subjectName = App\Model\Course::where('id' , $getTimeTable->subject_id )->first(); 
                          $subjectName1 = App\QuestionTag::where('id' , $getTimeTable->subject_id )->first();
                        @endphp 
                        @if($getTimeTable->course_type == 'board')
                        <span class="mb-0">
                          <span class="label bg-light border rounded px-2 small">{{ $subjectName ? $subjectName->title : '' }}</span>
                        @else
                        <span class="label bg-light border rounded px-2 small">{{ $subjectName1 ? $subjectName1->tag_name : ''/$getTimeTable->subCat }}</span>
                        </span>
                          @endif
                         @endforeach
                        <div class="d-flex justify-content-between">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="badgescard"> 
                    
                </div>
            </div>
        </div>
    </div>
    </div>
    <section class="feature-section time-table">
        <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="term-grid grid-header">
              <label>Subject</label>
              <label>Mon.</label>
              <label>Tue.</label>
              <label>Wed.</label>
              <label>Thu.</label>
              <label>Fri.</label>
              <label>Sat.</label>
              <label>Sun.</label>
            </div>
            @if($getTimeTables->count() > 0)
            @foreach($getTimeTables->unique('title') as $getTimeTable)
            <div class="term-grid border-right border-left" v-for="term in terms">
            @php 
              $subjectName = App\Model\Course::where('id' , $getTimeTable->subject_id )->first(); 
              $subjectName1 = App\QuestionTag::where('id' , $getTimeTable->subject_id )->first();
            @endphp 

            @if($getTimeTable->course_type == 'board')
              <label> {{$subjectName ? $subjectName->title .'-'.$getTimeTable->subCat  : '' }}</label>
            @else
              <label>{{ $subjectName1 ? $subjectName1->tag_name : ''/$getTimeTable->subCat }}</label>
            @endif
            <div class="monday py-2">
              @foreach($getTimeTable->instructorsubject  as $instructorsubject)
                @if($instructorsubject->day == 'Monday')
                      <div class="time text-uppercase text-muted"> {{  date('g:i A', strtotime($instructorsubject->start_time)) }} - {{  date('g:i A', strtotime($instructorsubject->end_time)) }}</div>
                     
                      @if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructorsubject->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructorsubject->end_time) )
                      <div class="join-now-btn"><a  target="_blank" href='{{ url("$instructor->url") }}'>Join Now</a></div>
                      @endif
                @endif
                @endforeach
              
            </div>
           
             
            <div class="tuesday py-2">
            @foreach($getTimeTable->instructorsubject  as $instructorsubject)
              @if($instructorsubject->day == 'Tuesday')
              <div class="time text-uppercase text-muted"> {{  date('g:i A', strtotime($instructorsubject->start_time)) }} - {{  date('g:i A', strtotime($instructorsubject->end_time)) }}</div>
                      @if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructorsubject->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructorsubject->end_time) )
                      <div class="join-now-btn"><a  target="_blank" href="{{ $instructor->url }}">Join Now</a></div>
                      @endif
              @endif
            @endforeach
            </div>
              
              <div class="wednesday py-2">
              @foreach($getTimeTable->instructorsubject  as $instructorsubject)
                @if($instructorsubject->day == 'Wednesday')
                <div class="time text-uppercase text-muted"> {{  date('g:i A', strtotime($instructorsubject->start_time)) }} - {{  date('g:i A', strtotime($instructorsubject->end_time)) }}</div>
                      @if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructorsubject->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructorsubject->end_time) )
                      <div class="join-now-btn"><a  target="_blank" href="{{ $instructor->url }}">Join Now</a></div>
                      @endif
                @endif
              @endforeach              
            </div>
              <div class="thursday py-2">
                @foreach($getTimeTable->instructorsubject  as $instructorsubject)
                  @if($instructorsubject->day == 'Thursday')
                  <div class="time text-uppercase text-muted"> {{  date('g:i A', strtotime($instructorsubject->start_time)) }} - {{  date('g:i A', strtotime($instructorsubject->end_time)) }}</div>
                      @if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructorsubject->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructorsubject->end_time) )
                      <div class="join-now-btn"><a  target="_blank" href="{{ $instructor->url }}">Join Now</a></div>
                      @endif
                  @endif
                @endforeach 
              </div>
              <div class="friday py-2">
                @foreach($getTimeTable->instructorsubject  as $instructorsubject)
                  @if($instructorsubject->day == 'Friday')
                  <div class="time text-uppercase text-muted"> {{  date('g:i A', strtotime($instructorsubject->start_time)) }} - {{  date('g:i A', strtotime($instructorsubject->end_time)) }}</div>
                  @if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructorsubject->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructorsubject->end_time) )
                      <div class="join-now-btn"><a  target="_blank" href="{{ $instructor->url }}">Join Now</a></div>
                      @endif
                  @endif
                @endforeach 
              </div>
              <div class="saturday py-2">
              @foreach($getTimeTable->instructorsubject  as $instructorsubject)
                  @if($instructorsubject->day == 'Saturday')
                  <div class="time text-uppercase text-muted">{{  date('g:i A', strtotime($instructorsubject->start_time)) }} - {{  date('g:i A', strtotime($instructorsubject->end_time)) }}</div>
                      @if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructorsubject->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructorsubject->end_time) )
                      <div class="join-now-btn"><a  target="_blank" href="{{ $instructor->url }}">Join Now</a></div>
                      @endif
                  @endif
                @endforeach               
              </div>
              <div class="sunday py-2">
              @foreach($getTimeTable->instructorsubject  as $instructorsubject)
                  @if($instructorsubject->day == 'Sunday')
                  <div class="time text-uppercase text-muted"> {{  date('g:i A', strtotime($instructorsubject->start_time)) }} - {{  date('g:i A', strtotime($instructorsubject->end_time)) }}</div>
                  @if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructorsubject->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructorsubject->end_time) )
                      <div class="join-now-btn"><a  target="_blank" href="{{ $instructor->url }}">Join Now</a></div>
                      @endif
                  @endif
                @endforeach  
              </div>
              
            </div>
            @endforeach
            @endif 
            <!-- <div class="term-grid border-right border-left" v-for="term in terms">
              <label>Physics</label>
              <div class="monday">
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="tuesday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="wednesday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="thursday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="friday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="saturday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="sunday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
            </div>
            <div class="term-grid border-right border-left" v-for="term in terms">
              <label>Chemistry</label>
              <div class="monday">
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="tuesday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="wednesday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="thursday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="friday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="saturday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
              <div class="sunday">
              <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
                <div class="time text-uppercase text-muted">9:00 Am - 11:30 AM</div>
                <div class="join-now-btn"><a href="#">Join Now</a></div>
              </div>
            </div> -->
          </div>
        </div>
        </div>
    </section>
    
@endsection


