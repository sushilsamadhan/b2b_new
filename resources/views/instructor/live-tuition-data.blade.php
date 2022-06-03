@extends('layouts.master')
@section('title','Instructor List')
@section('parentPageTitle', 'All Student')
@section('content')
<div class="card mx-2 mb-3">
    <div class="card-header">
        <div class="float-left">
            <h3>@translate(Tuition Booking Details)</h3>
        </div>
        <div class="float-right">
            <div class="row">
                <div class="col">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="text-center">
                    <th>
                        @translate(Student name)
                    </th>
                    <th>
                        @translate(Subject)</th>
                    <th>
                        @translate(Class)</th>
                    <th>
                        @translate(Period)</th>
                    <th>
                        @translate(Date Of Booking)</th>
                </tr>
            </thead>
            <tbody class="text-center" id="showBooking">
@if (count($dataBooking)>=1)
     @foreach($dataBooking as $val)   
        <tr>
            <td class="text-center">{{$val->uname}}</td>
            <td>{{$val->title}}</td>
            <td>{{$val->cname}}</td>
            <td>{{$val->time_of_booking}}</td>
            <td>{{$val->date_of_booking}}</td>
        </tr>
@endforeach
@else
<tr>
    <td><h3 class="text-center">No Data Found</h3></td>
</tr>
@endif
            </tbody>
        </table>
    </div>
    {{--<div class="float-left">
                {{ $instructors->links() }}
    </div>--}}
</div>
<script type="text/javascript">
function Getbooking(insId){
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("showBooking").innerHTML =
    this.responseText;
  }
  xhttp.open("GET", "{{url('dashboard/one-to-one-instructor/get-view-booking')}}/"+insId);
  xhttp.send();   
}
</script>
@endsection
