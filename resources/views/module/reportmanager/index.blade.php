@extends('layouts.master')
@section('title','Report Manager')
@section('parentPageTitle', 'All Users')
@section('content')
    <div class="card mx-2 mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>@translate(All Registered User)</h3>
                </div>
            </div>
        </div>
        <div class="card-header">    
            <div class="row">
                <div class="col-lg-6"><b>Duration : </b> {{$dateFrom}} <b>To : </b> {{$dateTo}}</div>
                <div class="col-lg-6">
                    <form method="get" action="">
                        <div class="input-group">
                            <input type="date" name="start_date" class="form-control col-12"
                                    value="{{Request::get('start_date')}}">
                            <input type="date" name="end_date" class="form-control col-12"
                                    value="{{Request::get('end_date')}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">@translate(Search)</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="text-left font-weight-bold">Total Records : {{ $reports[0]->Total_users }}</p>
          <!--   <div class="row">
                <div class="col-lg-6">
                    <div id="donutChartUserCategory" style="width: 600px; height: 300px;"></div>
                </div>
                <div class="col-lg-6">
                    <div id="donutChartUserDevice" style="width: 600px; height: 300px;"></div>
                </div>
            </div> -->
        </div>
        <div class="row ml-2">
            <div class="col-md-6 text-center">
                <h5>@translate(Category Users)</h5>
            </div>
            <div class="col-md-6 text-center">
                <h5>@translate(Device Users)</h5>
            </div> 
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>@translate(Academic)</th>
                    <th>@translate(Competitive)</th>
                    <th>@translate(Other Students)</th>
                    <th>@translate(Mobile)</th>
                    <th>@translate(Desktop)</th>
                    <th>@translate(Other Users)</th>
                </tr>
                </thead>
                <tbody>
               		<tr>
               			<td>{{ $reports[0]->Academic }}</td>
               			<td>{{ $reports[0]->Competitive }}</td>
                        <td>{{ $reports[0]->OtherStudents }}</td>
               			<td>{{ $reports[0]->Android }}</td>
               			<td>{{ $reports[0]->Desktop }}</td>
                        <td>{{ $reports[0]->OtherUsers }}</td>
               		</tr>
                </tbody>
            </table>
        </div>
        <!-- <div class="row ml-2">
            <div class="col-md-6">
                @translate(Category Users) : {{ $reports[0]->Total_users }}
            </div>        
            <div class="col-md-6">
                <p>Academic  : {{ $reports[0]->Academic }}</p>
                <p> {{ $reports[0]->Competitive }}</p>
                <p>{{ $reports[0]->OtherStudents }}</p>
            </div>        
        </div>

        <div class="row ml-2 mt-3">
            <div class="col-md-6">
                @translate(Device Users) : 
            </div>        
            <div class="col-md-6">
                <p>{{ $reports[0]->Android }}</p>
                <p>{{ $reports[0]->Desktop }}</p>
                <p>{{ $reports[0]->OtherUsers }}</p>
            </div>        
        </div> -->
    </div>

@endsection

@section('page-script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    //   google.charts.load("current", {packages:["corechart"]});
    //   google.charts.setOnLoadCallback(drawChart);
    //   function drawChart() {
    //     var data = google.visualization.arrayToDataTable([
    //       ['User', 'Total Registration'],
    //       ['Academic',  {{ $reports[0]->Academic }} ], // {{ $reports[0]->Academic }}
    //       ['Competitive', {{ $reports[0]->Competitive }} ], // {{ $reports[0]->Competitive }}
    //       ['Others',  {{ $reports[0]->OtherStudents }} ], //{{ $reports[0]->OtherStudents }}
    //     ]);

    //     var options = {
    //       title: "Category Users :",
    //     //  pieHole: 0.1,
    //         pieStartAngle: 100,
    //     };

    //     var chart = new google.visualization.PieChart(document.getElementById('donutChartUserCategory'));
    //     chart.draw(data, options);
    //   }

// for Device
    //   google.charts.setOnLoadCallback(drawChart2);
    //   function drawChart2() {
    //     var data = google.visualization.arrayToDataTable([
    //       ['Usage', 'Per Device'],
    //       ['Android',  {{ $reports[0]->Android }} ], //{{ $reports[0]->Android }}
    //       ['Desktop', {{ $reports[0]->Desktop }} ], //{{ $reports[0]->Desktop }}
    //       ['Others',  {{ $reports[0]->OtherUsers }} ], //{{ $reports[0]->OtherUsers }}
    //     ]);

    //     var options = {
    //        title: 'User Device  :',
    //        pieStartAngle: 100,
    //        tooltip: { isHtml: false }
    //     };

    //     var chart = new google.visualization.PieChart(document.getElementById('donutChartUserDevice'));
    //     chart.draw(data, options);
    // }
      
    </script>    
    @stop