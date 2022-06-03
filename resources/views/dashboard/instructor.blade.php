@extends('layouts.master')
@section('title','dashboard')
@section('parentPageTitle', 'index')
@section('content')
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-8">
            <!-- Start row -->
            <div class="row">
                <div class="col-lg-12 col-xl-4">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="mb-0">{{formatPrice($this_earning)}}</h5>
                                    <p class="font-14 mb-2">@translate(This Month Revenue)</p>
                                </div>
                                <div class="col-12 text-right">
                                    <div id="apex-area3-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-4">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="mb-0">{{formatPrice($prev_earning)}}</h5>
                                    <p class="font-14 mb-2">@translate(Last Month Revenue)</p>
                                </div>
                                <div class="col-12 text-right">
                                    <div id="apex-area2-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-4">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="mb-0">{{formatPrice($total_earning)}}</h5>
                                    <p class="font-14 mb-2">@translate(Total) @translate(Revenue) </p>
                                </div>
                                <div class="col-12 text-right">
                                    <div id="apex-area1-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
                <div class="col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title mb-0">@translate(This Year Revenue)</h5>
                                </div>
                                <div class="col-6 text-right">
                                    <h5 class="card-title mb-0">@translate(Todays Revenue : )
                                    {{formatPrice($today_earning)}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pl-0 py-0">
                            <div id="a-bar-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
            </div>
        </div>
        <!-- Student block start-->
        <div class="col-lg-12 col-xl-4 mb-2">
            <div class="card p-2and5">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title mb-0">@translate(Total Students)</h5>
                            {{$total_students->count()}}
                        </div>
                        <div class="col-6 text-right" >
                            <h5 class="card-title mb-0">@translate(Todays Students)</h5>
                            {{$todays_student->count()}}
                        </div>
                    </div>
                </div>
                <div class="user-slider">
                    <div class="user-slider-item">
                        <table class="table foo-filtering-table text-center">
                            <thead class="text-left">
                                <tr class="footable-header">
                                    <!-- <th class="footable-first-visible">
                                        @translate(S/L)
                                    </th> -->
                                    <th>
                                        @translate(Name)
                                    </th>
                                    <th class="text-right">
                                        @translate(Phone)
                                    </th>
                                </tr> 
                            </thead>
                            <tbody>
                            @php $limit = 1; @endphp
                            @forelse($todays_student as $student)
                                @if($limit<=6)
                                <tr>
                                    <td class="w-45 text-left">{{$student->name}}</td>
                                    <td class="w-45 text-right">{{$student->email}}</td>
                                </tr>
                                @endif
                                @php $limit++; @endphp
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">@translate(No todays records)</td>
                                </tr>
                            @endforelse
                            @if(count($todays_student)>0)
                                <tr>
                                    <td colspan="3" class="text-right">
                                    <a href="{{ route('students.index')}}" class="">View More</a>
                                    </td>
                                </tr>
                            @endif    
                            </tbody>
                        </table> 
                    </div>      
                </div>
            </div>
        </div>
        <!-- Student block end-->
        <!-- <div class="col-lg-12 col-xl-4 mb-2">
            <div class="card p-2and5">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h5 class="card-title mb-0">@translate(Active Users) <span class="float-right font-14 badge badge-success">{{$total_students->count()}}</span></h5>
                        </div>
                    </div>
                </div>
                <div class="user-slider">
                    @forelse($total_students as $item)
                        <div class="user-slider-item">
                            <div class="card-body text-center">
                                <div class="m-4">
                                    <img src="{{filePath($item->image)}}"
                                         class="img-center rounded-circle avatar-xl">
                                </div>
                                <a href="{{route('students.show',$item->user_id)}}">
                                    <h4>{{$item->name}}</h4>
                                    <p>{{$item->email}}</p>
                                    <p><span class="badge badge-primary-inverse">@translate(Details)</span></p></a>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col-6 border-right">
                                        <a href="{{ $item->fb }}">
                                            <h1 class="facebook"><i class="fa fa-facebook-square"></i></h1>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ $item->skype }}">
                                            <h1 class="skype"><i class="fa fa-skype"></i></h1>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3 class="text-center mt-3">@translate(No User)</h3>
                    @endforelse
                </div>
            </div>
        </div> -->
        <!-- End col -->
    </div>
    <!-- End row -->   
    <div class="row">
        <div class="col-md-5 mb-3">
            <div class="card m-b-30 h-100">  
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="card-title mb-0">@translate(Current Statistics)</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body crm-tab-widget">
                    <div class="row">
                        <div class="col-12">
                        <div class="nav nav-pills custom-nav-pills" id="v-pills-ticket-tab" role="tablist"
                                    aria-orientation="vertical">
                                <a class="nav-link" id="v-pills-sales-tab" data-toggle="pill"
                                    href="#v-pills-sales" role="tab" aria-controls="v-pills-sales"
                                    aria-selected="false">
                                    @translate(Active Courses)<span
                                        class="float-right font-14 text-muted ml-2" id="course_count">{{$course->count()}}</span></a>
                                <a class="nav-link" id="v-pills-product-tab" data-toggle="pill"
                                    href="#v-pills-product" role="tab" aria-controls="v-pills-product"
                                    aria-selected="false">
                                    @translate(Active Users)<span
                                        class="float-right font-14 text-muted ml-2">{{$total_students->count()}}
                                    </span></a>
                                <a class="nav-link" id="v-pills-hiring-tab" data-toggle="pill"
                                    href="#v-pills-hiring" role="tab" aria-controls="v-pills-hiring"
                                    aria-selected="false">
                                    @translate(Enrollments)<span
                                        class="float-right font-14 text-muted ml-2">{{$enroll->count()}}</span></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="tab-content" id="v-pills-ticket-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-sales" role="tabpanel"
                                    aria-labelledby="v-pills-sales-tab">
                                    <div id="apex-operation-course-chart"></div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-product" role="tabpanel"
                                    aria-labelledby="v-pills-product-tab">
                                    <div id="apex-operation-student-chart"></div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-hiring" role="tabpanel"
                                    aria-labelledby="v-pills-hiring-tab">
                                    <div id="apex-operation-enroll-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-md-7 mb-3">
            <div class="card m-b-30">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="card-title mb-0">@translate(Other Statistics)</h5>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <form id="searchForm" class="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                            <select class="form-control form-control-sm langr selectpicker" id="inst_id" name="inst_id" required>
                                                <option value=""> @translate(Please Select Type)</option>
                                                <option value="all">All</option>
                                                @foreach ($instructors as $values)
                                                    <option value="{{ $values->id }}">{{ $values->name }}</option>
                                                @endforeach
                                            </select>
                                </div>   
                            </div>
                            <div class="col-md-4">
                            <div class="form-check">
                                        <input class="form-check-input" type="radio" name="date_at" id="date_at1" value="created_at" checked>
                                        <label class="form-check-label" for="date_at1" >Created At</label>
                            </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="date_at" id="date_at2" value="updated_at">
                                        <label class="form-check-label" for="date_at2">Updated At</label>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <button class="btn btn-primary btn-sm" id="submit">Search</button>
                            </div>
                            <div class="col-md-2 col-6">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="clearSearch">Clear</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body crm-tab-widget">
                    <div class="row align-items-center mb-4">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-4 offset-md-4">
                                    <div class="card border bg-info">    
                                        <div class="card-body text-center text-white">
                                            <p class="text-white font-weight-bold mb-1">@translate(Total Courses)</p>
                                            <h2 class="font-weight-bold text-white mb-0"><span id="totCourses">{{$course->count()}}</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card border bg-info mb-4">    
                                        <div class="card-body text-center text-white">
                                            <p class="text-white font-weight-bold mb-1">@translate(Total Lectures)</p>
                                            <h2 class="font-weight-bold text-white mb-0"><span id="totLectures">{{$totLectures}}</span></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border bg-info mb-4">    
                                        <div class="card-body text-center text-white">
                                            <p class="text-white font-weight-bold mb-1">@translate(Total Videos)</p>
                                            <h2 class="font-weight-bold text-white mb-0"><span id="totVideos">{{$totVideos}}</span></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border bg-info mb-4">    
                                        <div class="card-body text-center text-white">
                                            <p class="text-white font-weight-bold mb-1">@translate(Total Articles)</p>
                                            <h2 class="font-weight-bold text-white mb-0"><span id="totPdfs">{{$totPdfs}}</span></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border bg-info mb-4">    
                                        <div class="card-body text-center text-white">
                                            <p class="text-white font-weight-bold mb-1">@translate(Total Mind Maps)</p>
                                            <h2 class="font-weight-bold text-white mb-0"><span id="totMindMaps">{{$totMindMaps}}</span></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border bg-info mb-4">    
                                        <div class="card-body text-center text-white">
                                            <p class="text-white font-weight-bold mb-1">@translate(Total Exam Questions)</p>
                                            <h2 class="font-weight-bold text-white mb-0"><span id="totQuestions">{{$totQuestions}}</span></h2>
                                        </div>
                                    </div>
                                </div>
                            <!-- <div class="col-md-4">
                                    <div class="card border bg-info mb-4">    
                                        <div class="card-body text-center text-white">
                                            <p class="text-white font-weight-bold mb-1">@translate(Total Inactive Assessments)</p>
                                            <h2 class="font-weight-bold text-white mb-0"><span id="totDeActAssessment"></span></h2>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
 @endsection

@section('page-script')
    <script>
        "use strict"
        /* -----  Apex Bar Chart ----- */
        var options = {
            chart: {
                height: 300,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '25%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            colors: ['#506fe4'],
            series: [{
                name: 'Earning',
                // data: [44, 55, 57, 56]
                data: [@foreach($data as $s)
                    '{{$s}}',
                    @endforeach]
            }],
            legend: {
                show: false,
            },
            xaxis: {
                // categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                categories: [@foreach($months as $m)'{{$m}}', @endforeach],
                axisBorder: {
                    show: true,
                    color: 'rgba(0,0,0,0.05)'
                },
                axisTicks: {
                    show: true,
                    color: 'rgba(0,0,0,0.05)'
                }
            },
            grid: {
                row: {
                    colors: ['transparent', 'transparent'], opacity: .2
                },
                borderColor: 'rgba(0,0,0,0.05)'
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#a-bar-chart"),
            options
        );
        chart.render();

        /* ----- Apex Operation Status1 Chart ----- */
        var options = {
            chart: {
                height: 260,
                type: 'radialBar',
                offsetY: -10
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '18px',
                            fontFamily: 'Mukta Vaani',
                            color: '#8A98AC',
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '24px',
                            fontFamily: 'Mukta Vaani',
                            color: '#141d46',
                            formatter: function (val) {
                                return val;
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4
            },
            colors: ["#506fe4"],
            series: [{{$course->count()}}],
            labels: ['@translate(Total Courses)'],
        }
        var chart = new ApexCharts(
            document.querySelector("#apex-operation-course-chart"),
            options
        );
        chart.render();

        /* ----- Apex Operation Status2 Chart ----- */
        var options = {
            chart: {
                height: 260,
                type: 'radialBar',
                offsetY: -10
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '18px',
                            fontFamily: 'Mukta Vaani',
                            color: '#8A98AC',
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '24px',
                            fontFamily: 'Mukta Vaani',
                            color: '#141d46',
                            formatter: function (val) {
                                return val;
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4
            },
            colors: ["#506fe4"],
            series: [{{$enroll->count()}}],
            labels: ['@translate(Total Enrollments)'],
        }
        var chart = new ApexCharts(
            document.querySelector("#apex-operation-enroll-chart"),
            options
        );
        chart.render();

        /* ----- Apex Operation Status4 Chart ----- */
        var options = {
            chart: {
                height: 260,
                type: 'radialBar',
                offsetY: -10
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '18px',
                            fontFamily: 'Mukta Vaani',
                            color: '#8A98AC',
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '24px',
                            fontFamily: 'Mukta Vaani',
                            color: '#141d46',
                            formatter: function (val) {
                                return val;
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4
            },
            colors: ["#506fe4"],
            series: [{{$total_students->count()}}],
            labels: ['@translate(Total Student)'],
        }
        var chart = new ApexCharts(
            document.querySelector("#apex-operation-student-chart"),
            options
        );
        chart.render();

// Funtion for searching statistics by date
$('#searchForm').on('submit',function (e) { 
        e.preventDefault();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var inst_id = $('#inst_id').val();
        var date_at = $("input[name='date_at']:checked").val();
        $.ajax({
          url: "{{ route('statistics.data') }}",
          type:"GET",
          data:{
            "_token": "{{ csrf_token() }}",
            start_date:start_date,
            end_date:end_date,
            inst_id:inst_id,
            date_at:date_at,
          },
            success:function (response) { 
              console.log(response);
            //  alert(response.totQuestions);
                if(response){
                    $('#totCourses').html(response.totCourse);
                    $('#totLectures').html(response.totLectures);
                    $('#totVideos').html(response.totVideos);
                    $('#totPdfs').html(response.totPdfs);
                //    $('#totActAssessment').html(response.totActAssessment);
                    $('#totMindMaps').html(response.totMindMaps);
                    $('#totQuestions').html(response.totQuestions);
                }
            }
        })
    });
    
// Clear Search 
    $("#clearSearch").on('click',function (e) { 
        e.preventDefault();
        $('#start_date').val('');
        $('#end_date').val('');
        $('#inst_id').val('');
        $("input[name='date_at']:checked").val();
        $.ajax({
          url: "{{ route('statistics.data') }}",
          type:"GET",
          data:{
            "_token": "{{ csrf_token() }}",
            start_date:'',
            end_date:'',
            inst_id:'',
            date_at:'',
          },
            success:function (response) { 
            //  alert(response.totQuestions);
                if(response){
                    $('#totCourses').html(response.totCourse);
                    $('#totLectures').html(response.totLectures);
                    $('#totVideos').html(response.totVideos);
                    $('#totPdfs').html(response.totPdfs);
                //    $('#totActAssessment').html(response.totActAssessment);
                    $('#totMindMaps').html(response.totMindMaps);
                    $('#totQuestions').html(response.totQuestions);
                }
            }
        })
    });
    </script>
@endsection
