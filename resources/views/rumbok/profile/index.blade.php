@extends('rumbok.app')
@section('content')
    <!-- ================================
      START DASHBOARD AREA
  ================================= -->
<style>
    .bread-img-wrap {
    max-width: 70px;
    margin-right: 10px;
}
.bread-img-wrap img {
    width: 100%;
}
.profile-detail .profile-name {
    font-weight: bold;
    font-size: 14px;
    margin-right: 15px;
    display: inline-block;
    width: 30%;
    margin-bottom: 10px;
}
.profile-detail .profile-desc {
    font-weight: normal;
    font-size: 14px;
    display: inline-block;
    border-bottom: 1px dotted #ddd;
    width: calc(100% - 38%);
    margin-bottom: 10px;
    line-height: 30px;
}
.profile-detail .list-items li {
    margin-bottom: 15px;
    position: relative;
    display: block;
    width: 100%;
}
.profile-detail {
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 5px;
}
.profile-head {
    display:flex;
    align-items: center;
    justify-content: center;
}
.section-heading .section__title {
    font-size:24px;
}
.section-heading p {
    position:relative;
    padding-left:20px;
    line-height:18px;
}
.section-heading p i {
    position:absolute;
    left:0;
    top:2px;
}
.profile-number-n-email ul li {
    font-size: 13px;
    padding-left:20px;
    position:relative;
}
.profile-number-n-email ul li i {
    position:absolute;
    left:0;
    top:5px;
}
.section-heading {
    max-width:500px;
}
.bg-1 {
    background: #ff3019;
    background: -moz-linear-gradient(top, #ff3019 0%, #cf0404 100%);
    background: -webkit-linear-gradient(top, #ff3019 0%,#cf0404 100%);
    background: linear-gradient(to bottom, #ff3019 0%,#cf0404 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff3019', endColorstr='#cf0404',GradientType=0 );
}
.card-dashboard.bg-1 {
    border: 1px solid #ff3019;
}
.card-dashboard {
    box-shadow: 2px 1px 17px 4px rgb(0 0 0 / 12%);
    margin-bottom:20px;
}
.card-dashboard.bg-1 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-1 h2 {
    color: #fff;
}
.bg-2 {
    background: #7abcff;
    background: -moz-linear-gradient(top, #7abcff 0%, #60abf8 44%, #4096ee 100%);
    background: -webkit-linear-gradient(top, #7abcff 0%,#60abf8 44%,#4096ee 100%);
    background: linear-gradient(to bottom, #7abcff 0%,#60abf8 44%,#4096ee 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7abcff', endColorstr='#4096ee',GradientType=0 );
}
.card-dashboard.bg-2 {
    border: 1px solid #7abcff;
}
.card-dashboard.bg-2 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-2 h2 {
    color: #fff;
}
.bg-3 {
    background: #87e0fd;
    background: -moz-linear-gradient(top, #87e0fd 0%, #53cbf1 40%, #05abe0 100%);
    background: -webkit-linear-gradient(top, #87e0fd 0%,#53cbf1 40%,#05abe0 100%);
    background: linear-gradient(to bottom, #87e0fd 0%,#53cbf1 40%,#05abe0 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#05abe0',GradientType=0 );
}
.card-dashboard.bg-3 {
    border: 1px solid #87e0fd;
}
.card-dashboard.bg-3 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-3 h2 {
    color: #fff;
}
.bg-4 {
    background: #8fc400;
    background: -moz-linear-gradient(top, #8fc400 0%, #8fc400 100%);
    background: -webkit-linear-gradient(top, #8fc400 0%,#8fc400 100%);
    background: linear-gradient(to bottom, #8fc400 0%,#8fc400 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8fc400', endColorstr='#8fc400',GradientType=0 );
}
.card-dashboard.bg-4 {
    border: 1px solid #8fc400;
}
.card-dashboard.bg-4 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-4 h2 {
    color: #fff;
}
.bg-5 {
    background: #ff0084;
    background: -moz-linear-gradient(top, #ff0084 0%, #ff0084 100%);
    background: -webkit-linear-gradient(top, #ff0084 0%,#ff0084 100%);
    background: linear-gradient(to bottom, #ff0084 0%,#ff0084 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0084', endColorstr='#ff0084',GradientType=0 );
}
.card-dashboard.bg-5 {
    border: 1px solid #ff0084;
}
.card-dashboard.bg-5 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-5 h2 {
    color: #fff;
}
.bg-6 {
    background: #ffd65e;
    background: -moz-linear-gradient(top, #ffd65e 0%, #febf04 100%);
    background: -webkit-linear-gradient(top, #ffd65e 0%,#febf04 100%);
    background: linear-gradient(to bottom, #ffd65e 0%,#febf04 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffd65e', endColorstr='#febf04',GradientType=0 );
}
.card-dashboard.bg-6 {
    border: 1px solid #ffd65e;
}
.card-dashboard.bg-6 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-6 h2 {
    color: #fff;
}
.card-dashboard.bg-6 h2 a {
    border: 1px solid #fff;
    padding: 3px 20px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
}
.card-dashboard.bg-6 h2 a:hover {
    background:#fff;
    color: #ffd65e;
}
a.btn-custom-enroll {
    border: 1px solid #fff;
    padding: 3px 20px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
    font-weight: normal;
}
a.btn-custom-enroll:hover {
    background:#fff;
    color: #000;
}
a.btn-custom-join {
    border: 1px solid #fff;
    padding: 3px 20px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
    font-weight: normal;
}
a.btn-custom-join:hover {
    background:#fff;
    color:#000;
}
@media (max-width:767px) {
    .profile-head {
        display:block;
        margin-bottom:10px;
    }
    .section-heading {
        width:100%;
    }
}
</style>
{{--
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="title-page">
                <h1>Profile</h1>
              </div>              
          </div>
          <div class="col-lg-6">
              
          </div>
      </div>
  </div>
</section>
--}}
    <section class="dashboard-area">
       {{-- @include('rumbok.dashboard.sidebar') --}}
        <div class="clearfix pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-content dashboard-bread-content bg-light border p-2">
                            <div class="profile-head">
                                <div class="profile-img-n-address">
                                    <div class="user-bread-content d-flex align-items-center">
                                        <div class="bread-img-wrap">
                                            <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                ? asset('asset_rumbok/images/student.png')
                                                : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                alt="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                                        </div>
                                        <div class="section-heading">
                                            <h2 class="section__title font-size-30 mb-0">{{ $student->name }}</h2>
                                            <p class="text-muted small mb-0 profile-desc pl-0"><b>Joined on:</b> {{ $student->created_at->format('D d M Y, h:i:s A') }}</p>
                                            <p class="text-muted small mb-0"><i class="ti-mobile"></i> {{ $student->student->phone ?? '' }} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-number-n-email ml-auto">
                                    <ul class="list-unstyled mb-2 ">
                                    <li class="text-muted small mb-0">@php if (filter_var($student->alternate_email_user, FILTER_VALIDATE_EMAIL)) {  @endphp <i class="ti-email"></i>{{ $student->alternate_email_user ?? '' }}  @php } @endphp</li>

                                        <li class="text-right"><a href="{{ route('student.edit') }}" class="btn-link font-size-30">@translate(Edit Profile)</a></li>
                                    
                                    </ul>            
                                </div>
                            </div>
                           
                           
                            <!-- <div class="upload-btn-box">elite-courses/industrial-courses route('elite-courses.industrial-courses')
                            <button class="openbtn" onclick="openNav()">☰ My Account</button>
                                $competitiveCount       = 0;
            $freeStudyCount         = 0;
            $currentAffairCount     = 0;
            $projectWorksCount      = 0;
                            </div> -->

                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            <div class="row mt-3">
                        <div class="col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-1 h-100">
                                <div class="card-body text-center">
                                    <h3>Study Material</h3>
                                @if($freeStudyCount > 0)
                                    <h2><a href="{{url('my/courses')}}" class="btn-custom-join">{{$freeStudyCount??''}}</a></h2> 
                                @else
                                    <h2>{{$freeStudyCount??''}}</h2> 
                                @endif                 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-2 h-100">
                                <div class="card-body text-center">
                                    <h3>K-12 Package</h3>
                                @if($k12CourseCount > 0)
                                    <h2><a href="{{url('my/packages')}}" class="btn-custom-join">{{$k12CourseCount??''}}</a></h2> 
                                @else
                                    <h2>{{$k12CourseCount??''}}</h2> 
                                @endif                  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-3 h-100">
                                <div class="card-body text-center">
                                    <h3>Competitive Course</h3>
                                    <h2><a href="{{url('my/packages')}}" class="btn-custom-join">{{$competitiveCount}}</a></h2>                
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-4 h-100">
                                <div class="card-body text-center">
                                    <h3>Project Work</h3>
                                    <h2><a href="{{route('my.projectwork')}}" class="btn-custom-enroll">{{$projectWorksCount}}</a></h2>               
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-5 h-100">
                                <div class="card-body text-center">
                                    <h3>Elite Programme</h3>
                                    <h2><a href="{{url('/elite-courses/industrial-courses')}}" class="btn-custom-join">Join</a></h2>            
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-6 h-100">
                                <div class="card-body text-center">
                                    <h3>Help desk</h3>
                                    <h2><a href="https://ole.org.in/help-and-support" class="btn-custom-join">Connect</a></h2>            
                                </div>
                            </div>
                        </div>
                    
                
            </div>
            <div class="row">
                <div class="col-md-12">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!--div id="chart_div" style="min-height:500px;"></div-->
                <script>
                    google.charts.load('current', {packages: ['corechart', 'bar']});
                    google.charts.setOnLoadCallback(drawAxisTickColors);

                    function drawAxisTickColors() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('timeofday', 'Time of Day');
                        data.addColumn('number', 'Motivation Level');
                        data.addColumn('number', 'Energy Level');

                        data.addRows([
                            [{v: [8, 0, 0], f: '8 am'}, 1, .25],
                            [{v: [9, 0, 0], f: '9 am'}, 2, .5],
                            [{v: [10, 0, 0], f:'10 am'}, 3, 1],
                            [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
                            [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
                            [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
                            [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
                            [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
                            [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
                            [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
                        ]);

                        var options = {
                            title: 'Motivation and Energy Level Throughout the Day',
                            focusTarget: 'category',
                            hAxis: {
                            title: 'Time of Day',
                            format: 'h:mm a',
                            viewWindow: {
                                min: [7, 30, 0],
                                max: [17, 30, 0]
                            },
                            textStyle: {
                                fontSize: 14,
                                color: '#053061',
                                bold: true,
                                italic: false
                            },
                            titleTextStyle: {
                                fontSize: 18,
                                color: '#053061',
                                bold: true,
                                italic: false
                            }
                            },
                            vAxis: {
                            title: 'Rating (scale of 1-10)',
                            textStyle: {
                                fontSize: 18,
                                color: '#67001f',
                                bold: false,
                                italic: false
                            },
                            titleTextStyle: {
                                fontSize: 18,
                                color: '#67001f',
                                bold: true,
                                italic: false
                            }
                            }
                        };

                        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                        }
                </script>
                </div>
            </div>
            {{--    <div class="row mt-5">
                    <div class="col-md-8 offset-md-2">
                        <div class="profile-detail pb-5 shadow-sm mb-5">
                            <ul class="list-items list-unstyled">
                                <li>
                                    <span class="profile-name ">@translate(Registration Date):</span><span
                                        class="profile-desc">{{ $student->created_at->format('D d M Y, h:i:s A') }}</span>
                                </li>
                                <li><span class="profile-name">@translate(Full Name):</span><span
                                        class="profile-desc">{{ $student->name }}</span></li>
                                <li><span class="profile-name">@translate(Father Name):</span><span
                                class="profile-desc">{{ $student->student->father_name??'' }}</span></li>
                                <li><span class="profile-name">@translate(Email):</span><span
                                        class="profile-desc">{{ $student->alternate_email_user ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(Phone Number):</span><span
                                        class="profile-desc">{{ $student->student->phone ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(Address):</span><span
                                        class="profile-desc">{{ $student->student->address ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(Facebook):</span><span
                                        class="profile-desc">{{ $student->student->fb ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(Twitter):</span><span
                                        class="profile-desc">{{ $student->student->tw ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(Linked in):</span><span
                                        class="profile-desc">{{ $student->student->linked ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(About):</span><span
                                        class="profile-desc">{!! $student->student->about !!}</span></li>

                            </ul>
                        </div>
                    </div><!-- end col-lg-8 -->
                </div><!-- end row -->
--}}

                @include('rumbok.dashboard.footer')


            </div><!-- end container-fluid -->
        </div><!-- end dashboard-content-wrap -->

    </section><!-- end dashboard-area -->
    <!-- ================================
        END DASHBOARD AREA
    ================================= -->
@endsection
