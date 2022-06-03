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
                                    <p class="font-14 mb-2">@translate(Total Revenue)</p>
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
                            <div id="apexs-bar-chart"></div>
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
                        <div class="col-9">
                            <h5 class="card-title mb-0">@translate(Top Instructor)</h5>
                        </div>
                    </div>
                </div>
                <div class="user-slider">
                    @forelse($top_instructor as $item)
                        <div class="user-slider-item">
                            <div class="card-body text-center">
                                <div class="m-4">
                                    <img src="{{filePath($item->image)}}"
                                         class="img-center rounded-circle avatar-xl">
                                </div>
                                <a href="{{route('instructors.show',$item->user_id)}}">
                                    <h5>{{$item->name}}</h5>
                                    <p>{{$item->email}}</p>
                                    <p><span class="badge badge-primary-inverse">@translate(Details)</span></p></a>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col-6 border-right">
                                        @php
                                            $total_student = 0;
                                        @endphp
                                        @foreach(\App\Model\Course::where('user_id',$item->user_id)->get() as $c)
                                            <input type="hidden"
                                                   value="{{$total_student += App\Model\Enrollment::where('course_id' , $c->id)->count()}}"/>
                                        @endforeach
                                        <h4>{{\App\Model\Course::where('user_id',$item->user_id)->count()}}</h4>
                                        <p class="my-2">@translate(Courses)</p>
                                    </div>
                                    <div class="col-6">
                                        <h4>{{$total_student}}</h4>
                                        <p class="my-2">@translate(Users)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <h3 class="text-center mt-3">@translate(No top instructor)</h3>
                        @endforelse
                </div>
            </div>
        </div> -->
        <!-- End col -->
    </div>
        <!-- End row -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card m-b-30 h-100">
                <div class="card-header">
                    <div class="row">
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
                                <a class="nav-link" id="v-pills-support-tab" data-toggle="pill"
                                    href="#v-pills-support" role="tab" aria-controls="v-pills-support"
                                    aria-selected="false">
                                    @translate(Active Courses)<span
                                        class="float-right font-14 text-muted ml-2">{{$total_course}}</span></a>
                                <a class="nav-link" id="v-pills-hiring-tab" data-toggle="pill"
                                    href="#v-pills-hiring" role="tab" aria-controls="v-pills-hiring"
                                    aria-selected="false">
                                    @translate(Active Users)<span
                                        class="float-right font-14 text-muted ml-2">{{$total_students->count()}}
                                    </span></a>
                                <a class="nav-link" id="v-pills-sales-tab" data-toggle="pill"
                                    href="#v-pills-sales" role="tab" aria-controls="v-pills-sales"
                                    aria-selected="false">
                                    @translate(Enrollments)<span
                                        class="float-right font-14 text-muted ml-2">{{$total_enrollments}}</span></a>
                                <a class="nav-link" id="v-pills-product-tab" data-toggle="pill"
                                    href="#v-pills-product" role="tab" aria-controls="v-pills-product"
                                    aria-selected="false">
                                    @translate(Instructors)<span
                                        class="float-right font-14 text-muted ml-2">{{$total_instructor}}</span></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="tab-content" id="v-pills-ticket-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-support" role="tabpanel"
                                        aria-labelledby="v-pills-support-tab">
                                    <div id="apex-operation-course-chart"></div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-sales" role="tabpanel"
                                        aria-labelledby="v-pills-sales-tab">
                                    <div id="apex-operation-enrollment-chart"></div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-product" role="tabpanel"
                                        aria-labelledby="v-pills-product-tab">
                                    <div id="apex-operation-instructor-chart"></div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-hiring" role="tabpanel"
                                        aria-labelledby="v-pills-hiring-tab">
                                    <div id="apex-operation-student-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card m-b-30 h-100">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="card-title mb-0">@translate(Other Statistics)</h5>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <form id="searchForm" class="form-inline">
                                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm mr-2" required>
                                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm mr-2" required>
                                <button class="btn btn-primary btn-sm mr-2" id="submit">Search</button>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="clearSearch">Clear</a>
                            </form>
                        </div>
                    </div>
                </div> 
                <div class="card-body crm-tab-widget">
                    <div class="row align-items-center mb-4">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-4 offset-md-4">
                                    <div class="card border bg-info">    
                                        <div class="card-body text-center text-white">
                                            <p class="text-white font-weight-bold mb-1">@translate(Total Courses)</p>
                                            <h2 class="font-weight-bold text-white mb-0"><span id="totCourses">{{$total_course}}</span></h2>
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
                                            <p class="text-white font-weight-bold mb-1">@translate(Total Articals)</p>
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
        colors: ['#506fe4', '#43d187','#8B0000'],
        series: [{
            name: 'Total Earning',
            data: [@foreach($t_earning as $i)
                '{{$i}}',
                @endforeach]
        }, ],
        legend: {
            show: false,
        },
        xaxis: {
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
        document.querySelector("#apexs-bar-chart"),
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
        colors:["#506fe4"],
        series: [{{$total_course}}],
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
                            return val ;
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
        colors:["#506fe4"],
        series: [{{$total_enrollments}}],
        labels: ['@translate(Total Enrollments)'],
    }
    var chart = new ApexCharts(
        document.querySelector("#apex-operation-enrollment-chart"),
        options
    );
    chart.render();

    /* ----- Apex Operation Status3 Chart ----- */
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
        colors:["#506fe4"],
        series: [{{$total_instructor}}],
        labels: ['@translate(Total Instructor)'],
    }
    var chart = new ApexCharts(
        document.querySelector("#apex-operation-instructor-chart"),
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
    colors:["#506fe4"],
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
        $.ajax({
          url: "{{ route('statistics.data') }}",
          type:"GET",
          data:{
            "_token": "{{ csrf_token() }}",
            start_date:start_date,
            end_date:end_date,
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
        $.ajax({
          url: "{{ route('statistics.data') }}",
          type:"GET",
          data:{
            "_token": "{{ csrf_token() }}",
            start_date:'',
            end_date:'',
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
    </script>
    @endsection
