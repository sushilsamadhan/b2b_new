@extends('layouts.master')
@section('title','Subscriber List')
@section('parentPageTitle', 'All Subscribers')
@section('content')
<div class="card mx-2 mb-3">
    <div class="card-header">
        <div class="float-left">
            <h3>@translate({{ $headingforsubscription }})</h3>
        </div>
        <div class="float-right">
            <div class="row">
                <div class="col">
                    <form method="get" action="">
                        <div class="input-group">

<select class="form-control langr " id="val-category_id" name="category_id" onchange="getBoardClasses(this.value);">
	<option value=""> Select Board/Preparation</option>
</select>

<select class="form-control langr " id="show_for_class" name="class_id">
	<option value=""> Select Class/Exam</option>
</select>
        

                            <input type="text" name="search" class="form-control col-12" placeholder="@translate(Search by subject)" value="{{Request::get('search')}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    @translate(Search)</button>
                            </div>
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
                    <th>S/L</th>
                    <th>
                        @translate(Name)
                    </th>
                    <th>
                        @translate(Email)</th>
                    <th>
                        @translate(instructor)</th>
                    {{--<th>
                        @translate(Preference Type)</th>--}}
                    <th>
                        @translate(Board/Exam)</th>
                    <th>
                        @translate(class)</th>
                    <th>
                        @translate(subject)</th>
                    <th>
                        @translate(Booking Date)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($subscribers as $item)
                <tr>
                    <td>{{ ($loop->index+1) + ($subscribers->currentPage() - 1)*$subscribers->perPage() }}</td>
                    <td class="text-center">
                     {{ $item->stuname }}
                    </td>
                    <td>
                        {{ ($item->email) ? $item->email : '' }}
                    </td>
                    <td>{{$item->instname}}</td>
                    {{--<td>{{ ($item->course_type == 'board') ? 'Academic Courses' : 'Competitive Courses' }} </td>--}}
                    <td>{{$item->catname}}</td>
                    <td>{{$item->cat2name }}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->booked_on }}</td>

                </tr>
                @empty
                <tr>
                    <td colspan="7"><h3 class="text-center">No Data Found</h3></td>
                </tr>
                @endforelse
            </tbody>
            <div class="float-left">
                {{ $subscribers->links() }}
            </div>
        </table>
    </div>
</div>
<script type="text/javascript">
@if($headingforsubscription == 'Academic Courses Subscription') 

	var workval = 'board';

@endif 
@if($headingforsubscription == 'Competitive Courses Subscription') 

	var workval = 'competitive-courses'; 

@endif 

	if(workval=="board"){
	var urlin = "{{url('dashboard/get-board')}}";
	}
	if (workval=="competitive-courses") {
	var urlin = "{{url('dashboard/get-competitive-courses')}}";
	}
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
	document.getElementById("val-category_id").innerHTML =
	this.responseText;
	}
	xhttp.open("GET", urlin);
	xhttp.send();



function getBoardClasses(classid) {
	var package_type = $("#package_type").val();
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
	document.getElementById("show_for_class").innerHTML =
	this.responseText;
	}
	xhttp.open("GET", "{{url('dashboard/get-board-classes')}}/"+classid);
	xhttp.send();
}
</script>
@endsection
