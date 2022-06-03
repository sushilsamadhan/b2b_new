@extends('layouts.master')
@section('title','Instructor List')
@section('parentPageTitle', 'All Student')
@section('content')
<div class="card mx-2 mb-3">
    <div class="card-header">
        <div class="float-left">
            <h3>@translate(One To One Booking Details)</h3>
        </div>
        <div class="float-right">
            <div class="row">
                <div class="col">
                    <form method="get" action="">
                        <div class="input-group">
                            <select onchange="Getbooking(this.value);" class="form-control" name="insid" style=" width: 393px; ">
                                <option>Select Instructors</option>
                                @foreach($instructors as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" name="search" class="form-control col-12" placeholder="@translate(Search by name)" value="{{Request::get('search')}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    @translate(Search)</button>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="text-center">
                    <th>
                        @translate(instructor name)
                    </th>
                    <th>
                        @translate(Subject)</th>
                    <th>
                        @translate(Student name)</th>
                    <th>
                        @translate(Date Of Booking)</th>
                    <th>
                        @translate(Slots)</th>
                </tr>
            </thead>
            <tbody class="text-center" id="showBooking">
                
            </tbody>
        </table>
    </div>
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
