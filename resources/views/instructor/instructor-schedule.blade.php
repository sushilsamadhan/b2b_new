@extends('layouts.master')
@section('title','assessment')
@section('parentPageTitle', 'view')


@section('content')
    <!-- BEGIN:content -->

    <div class="card m-b-30">
    <div class="card-header">
            <div class="float-left">
                <h3>Instructor Schedule</h3>
            </div>
            
        </div>
        <div class="card-body">
        <div class="container">
            <div class="col-md-12">
        <form class="form-horizontal" action="{{ route('save-instructor-schedule') }}" method="post"
                enctype="multipart/form-data">
            @csrf
                        <input type="hidden" name="id" value="{{ Request::segment(3) }}">
<table class="table table-striped">

<!--Table head-->
<thead>
  <tr>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>
    <th>Sunday</th>
  </tr>
</thead>
<!--Table head-->

<!--Table body-->
<tbody>
  <tr class="table-info">
  <td class="checked"><input type="radio" class=""  name="day" value="Monday"></td>
    <td class="checked"><input type="radio" class="" name="day"  value="Tuesday"></td>
    <td class="checked"><input type="radio" class="" name="day" value="Wednesday"></td>
    <td class="checked"><input type="radio" class="" name="day" value="Thursday"></td>
    <td class="checked"><input type="radio" class="" name="day" value="Friday"></td>
    <td class="checked"><input type="radio" class="" name="day" value="Saturday" ></td>
    <td class="checked"><input type="radio" class="" name="day" value="Sunday"></td>
  </tr>
</tbody>
<!--Table body-->
</table>
<div class="row col-md-12" id="dvPassport" style="display:none;">
<div class="col-md-4">
</div>    
<div class="col-md-5">
Start Time : <input type="time" name="start_time" class="form-control">
End Time : <input type="time" name="end_time" class="form-control">
</div>
</div>
<!--Table-->


                    <div class="col-sm-12 text-center mt-3">  
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="example"></label>
                            <div class="col-md-6">
                                <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>


                                </form>
                </div>
            </div>
            <!-- End Row -->
    </div>
    <div class="card m-b-30 lcard-body">
    <div class="row flex-row">
                <div class="col-xl-12">
                    <!-- Begin Widget -->
                    <div class="widget has-shadow">
                        <div class="widget-body">
                            <div class="mt-5">
                            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                <th>No</th>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($instructorDaySchedules as $key => $instructorDaySchedule)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $instructorDaySchedule->day }}</td>
                                    <td>{{ $instructorDaySchedule->start_time }}</td>
                                    <td>
                                    {{ $instructorDaySchedule->end_time }}
                                     </td>
                                    <td>
                                                    
                                        <a class=""  onclick="confirm_modal('{{ route('delete-instructor-schedule', $instructorDaySchedule->id) }}')">
                                            <i class="feather icon-trash mr-2"></i></a>
                                    
                                    </td>
                                </tr>
                                @endforeach
                            <tbody>
                            </table>
</div>
</div>    
    </div>
    </div>
    </div>
    </div>
    </div>
   
    <!-- END:content -->
@endsection
@section('page-script')


<script type="text/javascript">
    $(function () {
        $(".checked").click(function () {
            //alert()
            //if ($(this).is(":checked")) {
                $("#dvPassport").show();
           // } else {
              //  $("#dvPassport").hide();
           // }
        });
    });
</script>

@stop
