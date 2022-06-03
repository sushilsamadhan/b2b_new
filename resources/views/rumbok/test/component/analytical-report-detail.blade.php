@extends('rumbok.app')

@section('content')
<style>
.analytic-card-1 {
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    box-shadow: 5px 5px 5px rgb(0 0 0 / 16%);
}
.analytic-card-1-heading {
    font-size: 12px;
    font-weight: 600;
    color: #ffffff;
    text-transform: uppercase;
}
.analytic-card-1-count {
    font-weight: bold;
    font-size: 20px;
    color: #fff;
}
.icon-analytic-card-1 {
    width: 50px;
    height: 50px;
    background: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: 50px;
    font-size: 18px;
    font-weight: bold;
}
.blue {
    background: #071f41;
}
.blue .icon-analytic-card-1 {
    color:#071f41;
}
.sea-blue {
    background: #004b5a;
}
.sea-blue .icon-analytic-card-1 {
    color:#004b5a;
}
.light-red {
    background: #ed4534;
}
.light-red .icon-analytic-card-1 {
    color:#ed4534;
}
.dark-red {
    background: #bc342c;
}
.dark-red .icon-analytic-card-1 {
    color:#bc342c;
}
.is-striped {
  background-color: rgba(233, 200, 147, 0.2);
}

/* Table column sizing
================================== */
.date-cell {
  width: 20%;
}

.topic-cell {
  width: 25%;
}

.access-link-cell {
  width: 13%;
}

.replay-link-cell {
  width: 13%;
}

.pdf-cell {
  width: 13%;
}

/* Apply styles
================================== */
.Rtable {
  display: flex;
  flex-wrap: wrap;
  margin: 0 0 0em 0;
  padding: 0;
  font-size: 13px;
}
.Rtable .Rtable-row {
  width: 100%;
  display: flex;
}
.Rtable .Rtable-row .Rtable-cell {
  box-sizing: border-box;
  flex-grow: 1;
  padding: 0.2em 1.0em;
  overflow: hidden;
  list-style: none;
}
.Rtable .Rtable-row .Rtable-cell.column-heading {
  background-color: #43BAC0;
  color: white;
  padding: 0.2em 1em;
}
.Rtable .Rtable-row .Rtable-cell .Rtable-cell--heading {
  display: none;
}
.Rtable .Rtable-row .Rtable-cell .Rtable-cell--content a {
  font-size: 1em;
  color: #333;
}
.Rtable .Rtable-row .Rtable-cell .Rtable-cell--content .webinar-date {
  font-weight: 700;
}

/* Responsive
==================================== */
@media all and (max-width: 750px) {
  .is-striped {
    background-color: white;
  }

  .Rtable--collapse {
    display: block;
    width: 100%;
    padding: 1em;
    box-shadow: none;
  }
  .Rtable--collapse .Rtable-row {
    box-sizing: border-box;
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 2em;
  }
  .Rtable--collapse .Rtable-row .Rtable-cell {
    width: 100% !important;
    display: flex;
    align-items: center;
  }
  .Rtable--collapse .Rtable-row .Rtable-cell .Rtable-cell--heading {
    display: inline-block;
    flex: 1;
    max-width: 120px;
    min-width: 120px;
    color: #43BAC0;
    font-weight: 700;
    border-right: 1px solid #ccc;
    margin-right: 1em;
  }
  .Rtable--collapse .Rtable-row .Rtable-cell .Rtable-cell--content {
    flex: 2;
    padding-left: 1em;
  }
  .Rtable--collapse .topic-cell {
    background-color: #43BAC0;
    color: white;
    font-weight: 700;
    order: -1;
  }
  .Rtable--collapse .topic-cell .Rtable-cell--content {
    padding-left: 0 !important;
  }
  .Rtable--collapse .Rtable-row--head {
    display: none;
  }
}
.no-flexbox .Rtable {
  display: block;
}
.no-flexbox .Rtable.Rtable-cell {
  width: 100%;
}
.analytic-2-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    text-align: center;
    line-height: 50px;
    font-size: 20px;
}
</style>
<!--======================================
          START breadcrumb AREA
  ======================================-->




<!--======================================
            END breadcrumb AREA
    ======================================-->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!--======================================
            START COURSE AREA
    ====================================== padding-top-80px padding-bottom-120px-->
<section class="heading-n-breadcrub-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="title-page">
                @php $countAttempt =  \App\MockTestEnrollment::where(['user_id' => $mockTestEnrollment->user_id ,'package_id' => $packageDetail->id, 'test_type' => $mockTestEnrollment->test_type ] )->where('id' ,'<=', $mockTestEnrollment->id)->get();
                @endphp
                    <h1>{{ $packageDetail->pkg_name }} Practice Test - Attempt {{ $countAttempt->count() }}</h1>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="clearfix">
                <a href="{{ route('report-detail' ,[$packageDetail->id, $mockTestEnrollment->id]) }}" type="botton" class="btn btn-danger btn-block"> Questions View</a>
                </div>
            </div>
        </div>
    </div>
</section>
@php $studentTestQuestions = \App\MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id , 'user_id' => $mockTestEnrollment->user_id])->get();
@endphp
<section class="clearfix">
    <div class="container">
    <div class="row">
            <div class="col-md-4">
                <div class="analytic-card-1 blue">
                    <div class="d-flex align-items-center">
                    @php
                        $getTotalMarks = getTotalMarks($mockTestEnrollment->id ,$packageDetail->id);  @endphp
                    
                        <div class="heading-and-count">
                            <div class="analytic-card-1-heading">Score</div>
                            <div class="analytic-card-1-count">{{ $getTotalMarks *2}}/{{ $studentTestQuestions->count() *2 }}</div>
                        </div>
                        <div class="icon-analytic-card-1 ml-auto">
                            <i class="ti-flag"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="analytic-card-1 sea-blue">
                    <div class="d-flex align-items-center">
                        <div class="heading-and-count">
                            <div class="analytic-card-1-heading">Accuracy</div>
                            <div class="analytic-card-1-count">0%</div>
                        </div>
                        <div class="icon-analytic-card-1 ml-auto">
                            <i class="ti-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="analytic-card-1 light-red">
                    <div class="d-flex align-items-center">
                        <div class="heading-and-count">
                            <div class="analytic-card-1-heading">Percentage</div>
                            @php     $getTotalMarks = getTotalMarks($mockTestEnrollment->id ,$packageDetail->id); 
                    
                             $newPercentage = ($getTotalMarks / 100) * $studentTestQuestions->count(); @endphp
                            <div class="analytic-card-1-count">{{ $newPercentage }}%</div>
                      
                        </div>
                        <div class="icon-analytic-card-1 ml-auto">
                            <i class="ti-stats-up"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="analytic-card-1 dark-red">
                    <div class="d-flex align-items-center">
                        <div class="heading-and-count">
                            <div class="analytic-card-1-heading">Percentile</div>
                            <div class="analytic-card-1-count">29.84%</div>
                        </div>
                        <div class="icon-analytic-card-1 ml-auto">
                            <i class="ti-bar-chart"></i>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="analytic-card-1 border-info">
                    <div class="d-flex align-items-center">
                        <div class="analytic-heading-and-count">
                        @php  $studentTestQuestionsAttend = \App\MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id , 'attempt_status' => 'A','user_id' => $mockTestEnrollment->user_id])->get();
                            @endphp
                            <div class="analytic-heading-2 text-info small text-uppercase">Attempted</div>
                            <div class="analytic-count">{{ $studentTestQuestionsAttend->count() }} of {{ $studentTestQuestions->count() }}</div>
                        </div>
                        <div class="analytic-2-icon ml-auto bg-info text-white shadow">
                            <i class="ti-ink-pen"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="analytic-card-1 border-success">
                    <div class="d-flex align-items-center">
                        <div class="analytic-heading-and-count">
                        @php  $studentTestQuestionsAttend = \App\MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id , 'attempt_status' => 'A','user_id' => $mockTestEnrollment->user_id])->get();
                              $getTotalMarks = getTotalMarks($mockTestEnrollment->id ,$packageDetail->id);  @endphp
                            <div class="analytic-heading-2 text-success small text-uppercase">Correct</div>
                            <div class="analytic-count">{{ $getTotalMarks }} of {{ $studentTestQuestions->count() }}</div>
                        </div>
                        <div class="analytic-2-icon ml-auto bg-success text-white shadow">
                            <i class="ti-check"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="analytic-card-1 border-danger">
                    <div class="d-flex align-items-center">
                        <div class="analytic-heading-and-count">
                        @php  
                        $studentTestQuestionsAttend = \App\MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id , 'attempt_status' => 'A','user_id' => $mockTestEnrollment->user_id])->get();
                        $getTotalMarks = getTotalMarks($mockTestEnrollment->id ,$packageDetail->id);  
                        $totalIncorrect =  $studentTestQuestionsAttend->count() -  $getTotalMarks;
                        
                        @endphp
                            <div class="analytic-heading-2 text-danger small text-uppercase">Incorrect</div>
                            <div class="analytic-count">{{ $totalIncorrect }} of {{ $studentTestQuestions->count() }}</div>
                        </div>
                        <div class="analytic-2-icon ml-auto bg-danger text-white shadow">
                            <i class="ti-close"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="analytic-card-1 border-warning">
                    <div class="d-flex align-items-center">
                        <div class="analytic-heading-and-count">
                            <div class="analytic-heading-2 text-warning small text-uppercase">Total Time</div>
                            <div class="analytic-count">
                            @php
                            $datetime1 = new DateTime($mockTestEnrollment->mock_test_duration);
                            $datetime2 = new DateTime($mockTestEnrollment->test_taken_time);
                            $interval = $datetime1->diff($datetime2);
                            echo $interval->format('%h')."h: ".$interval->format('%i')."m:".$interval->format('%s')."s";
                            @endphp
                        </div>
                        </div>
                        <div class="analytic-2-icon ml-auto bg-warning text-white shadow">
                            <i class="ti-alarm-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-md-5">
                <div class="card mt-3 mb-4">
                    <div class="card-header py-2">
                        <div class="card-title mb-0">
                            <p class="mb-0">Overview</p>
                        </div>
                    </div>
                    <div class="card-body">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Work',     11],
                        ['Eat',      2],
                        ['Commute',  2],
                        ['Watch TV', 2],
                        ['Sleep',    7]
                        ]);

                        var options = {
                        title: 'My Daily Activities'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                        chart.draw(data, options);
                    }
                    </script>
                    <div id="piechart" style="width: 100%; height: 210px;"></div>
                    </div>
                </div>
            </div> -->
            <div class="col-md-12">
                <div class="card mt-3 mb-4">
                    <div class="card-header py-2">
                        <div class="card-title mb-0">
                            <p class="mb-0">Unit wise distribution</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="Rtable Rtable--5cols Rtable--collapse">
                            <div class="Rtable-row Rtable-row--head">
                                <div class="Rtable-cell date-cell column-heading">Unit</div>
                                <div class="Rtable-cell topic-cell column-heading">Attempted</div>
                                <div class="Rtable-cell access-link-cell column-heading">Correct</div>
                                <div class="Rtable-cell replay-link-cell column-heading">Accuracy</div>
             
                            </div>
                            @php $i = 1; @endphp
                            @foreach ($arrayValues as $key => $arrayValue)
                            <div class="Rtable-row">
                                <div class="Rtable-cell date-cell">
                                    <div class="Rtable-cell--heading">Unit</div>
                                   @php  $getUnit = \App\Model\Classes::where('id', $arrayValue)->first(); @endphp
                                    <div class="Rtable-cell--content date-content"><span class="webinar-date">Unit{{ $i++ }} - {{ $getUnit->unit }}</div>
                                </div>
                                @php  
                                    $getQuestionsssss =0;
                                    $getquestion = 0;
                                    $getQuestionsssss =0;
                                    $getquestion = 0;
                                    foreach($totalAttend as $total ) {
                                        if($total['unit_id'] ==  $arrayValue && $total['answer_id'] != ''){
                                                $getQuestionsss = \App\Option::where(['id' => $total['answer_id'] ,'question_id'=> $total['id'] , 'flag_correct' => 1])->count();   
                                            if($getQuestionsss != 0) {
                                                $getQuestionsssss++;     
                                            }
                                            $getquestion ++;  
                                                        
                                        }
                                    }
                                @endphp
                                <div class="Rtable-cell topic-cell">
                                    
                                    <div class="Rtable-cell--content title-content">{{ $getquestion }}</div>
                                </div>
                                <div class="Rtable-cell access-link-cell">
                                    <div class="Rtable-cell--heading">Correct</div>
                                    <div class="Rtable-cell--content access-link-content">{{ $getQuestionsssss }}</div>
                                </div>
                                <div class="Rtable-cell replay-link-cell">
                                    <div class="Rtable-cell--heading">Accuracy</div>
                                    <div class="Rtable-cell--content replay-link-content">0.00%</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <div class="row mt-5">
            <?php
            if($mockTestEnrollment->test_type  == 'subject'  || $mockTestEnrollment->test_type  == 'unit' ) {
            $i = $j = $k= 1;
            foreach ($arrayValues as $key => $arrayValue) {
                $aa  =  array_count_values(array_column($countArray, 'unit_id'))[$arrayValue];
                $getUnit = \App\Model\Classes::where('id', $arrayValue)->first();
                $dataPoints1[] = 
                    //array("label"=> 'Unit' .$i++ .'-'. $getUnit->unit, "y"=> $aa);
                    array("label" => 'Unit' . $i++ . '-' . $getUnit->unit, "y" => $aa);
                // array("label1"=> 'Attend' .$i++ .'-'. $getUnit->unit.'</br>' .'Attend' , "y1"=> $aa);
                //echo '<pre>'; print_R($countArray);
                //foreach($countArray as $){
                // $studentQuestion = \App\StudentTestQuestion::where(['id'=> $countArray[0]['id'] ,'unit_id' => $arrayValue])->first();
                // echo '<pre>'; print_R($studentQuestion);                   
                //}
                // foreach($totalAttend as $totalAttend){
                //     where('unit_id' => $totalAttend->uint_id; )

                // }
               // in_array($arrayValue , $totalAttend);
                //echo '<pre>'; print_R($totalAttend);  die;
                $getQuestionsssss =0;
                $getquestion = 0;
                foreach($totalAttend as $total ){
                    if($total['unit_id'] ==  $arrayValue && $total['answer_id'] != ''){
                            $getQuestionsss = \App\Option::where(['id' => $total['answer_id'] ,'question_id'=> $total['id'] , 'flag_correct' => 1])->count();   
                        if($getQuestionsss != 0) {
                            $getQuestionsssss++;     
                               
                        }
                        $getquestion ++;  
                                    
                    }
                }

                $dataPoints2[] =
                array("label" => 'Unit' . $j++ . '-' . $getUnit->unit, "y" => $getquestion);
    
                $dataPoints3[] =
                    array("label" => 'Unit' . $k++ . '-' . $getUnit->unit, "y" =>$getQuestionsssss);
                
                } 
             } else {
                $i = $j = $k= 1;
                foreach ($arrayValues as $key => $arrayValue) {
                    $aa  =  array_count_values(array_column($countArray, 'chapter_id'))[$arrayValue];
                    $getClassContent = \App\Model\ClassContent::where('id', $arrayValue)->first();
                   if($getClassContent){
                    $dataPoints1[] = 
                        
                        array("label" => 'Chapter' . $i++ . '-' . $getClassContent->title, "y" => $aa);
          
                    $getQuestionsssss =0;
                    $getquestion = 0;
                    foreach($totalAttend as $total ){
                        if($total['chapter_id'] ==  $arrayValue && $total['answer_id'] != ''){
                                $getQuestionsss = \App\Option::where(['id' => $total['answer_id'] ,'question_id'=> $total['id'] , 'flag_correct' => 1])->count();   
                            if($getQuestionsss != 0) {
                                $getQuestionsssss++;     
                                   
                            }
                            $getquestion ++;  
                                        
                        }
                    }
    
                    $dataPoints2[] =
                        array("label" => 'Chapter' . $j++ . '-' .$getClassContent->title , "y" => $getquestion);
        
                    $dataPoints3[] =
                        array("label" => 'Chapter' . $k++ . '-' . $getClassContent->title, "y" =>$getQuestionsssss);
                    
                }
                    } 

                    
            }
            ?>
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <script>
                    window.onload = function() {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            title: {
                                text: "Graphical Test Report for {{ ucfirst($mockTestEnrollment->test_type)}}"
                            },
                            theme: "light2",
                            animationEnabled: true,
                            toolTip: {
                                shared: true,
                                reversed: true
                            },
                            axisY: {
                                title: "Unit Question & Answer",
                                suffix: ""
                            },
                            legend: {
                                cursor: "pointer",
                                itemclick: toggleDataSeries
                            },

                            data: [{
                                    type: "stackedColumn",
                                    name: "No of Ques.",
                                    showInLegend: true,
                                    yValueFormatString: "#,##0",
                                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                                },
                                {
                                   // type: "stackedColumn",
                                    name: "Attempted",
                                    showInLegend: true,
                                    yValueFormatString: "#,##0",
                                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                                },
                                {
                                   // type: "stackedColumn",
                                    name: "Correct",
                                    showInLegend: true,
                                    yValueFormatString: "#,##0",
                                    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                                }
                                // {
                                //     type: "stackedColumn",
                                //     name: "Attend",
                                //     //showInLegend: true,
                                //     yValueFormatString: "#,##0",
                                //     dataPoints: <?php// echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                                // },
                                // {
                                //     type: "stackedColumn",
                                //     name: "Correct",
                                //     //showInLegend: true,
                                //     yValueFormatString: "#,##0",
                                //     dataPoints: <?php //echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                                // },
                                //    {
                                //         // type: "stackedColumn",
                                //          name: "Attend",
                                //          //showInLegend: true,
                                //          yValueFormatString: "#,##0 MW",
                                //          dataPoints: <?php //echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); 
                                                        ?>
                                //      },
                                //{
                                //      type: "stackedColumn",
                                //      name: "Americas",
                                //      showInLegend: true,
                                //      yValueFormatString: "#,##0 MW",
                                //      dataPoints: <?php //echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); 
                                                    ?>
                                //  },{
                                //      type: "stackedColumn",
                                //      name: "China",
                                //      showInLegend: true,
                                //      yValueFormatString: "#,##0 MW",
                                //      dataPoints: <?php //echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); 
                                                    ?>
                                //  },{
                                //      type: "stackedColumn",
                                //      name: "Middle East and Africa",
                                //      showInLegend: true,
                                //      yValueFormatString: "#,##0 MW",
                                //      dataPoints: <?php // echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); 
                                                    ?>
                                //  },{
                                //      type: "stackedColumn",
                                //      name: "Rest of the world",
                                //      showInLegend: true,
                                //      yValueFormatString: "#,##0 MW",
                                //      dataPoints: <?php //echo json_encode($dataPoints6, JSON_NUMERIC_CHECK); 
                                                    ?>
                                //  }
                            ]

                        });

                        chart.render();
                        function toggleDataSeries(e) {
                            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                e.dataSeries.visible = false;
                            } else {
                                e.dataSeries.visible = true;
                            }
                            e.chart.render();
                        }

                    }
                </script>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>
    </div>
</section>
<!--======================================
            END COURSE AREA
    ======================================-->
@endsection

@section('js')
{{-- stripe --}}
@endsection