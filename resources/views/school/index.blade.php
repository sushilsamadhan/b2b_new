@extends('layouts.master')
@section('title','School List')
@section('parentPageTitle', 'School')
@section('content')
    <div class="card mx-2 mb-3">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(All School/Institute)</h3>
            </div>
            <div class="float-right">
                <div class="row">
                	<!-- @if(session('success'))
                		<div class="alert alert-success">{{ session('success') }}</div>
                	@endif -->
                    <div class="col">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control col-12"
                                       placeholder="@translate(Search by name or phone)"
                                       value="{{Request::get('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
								<a href="{{route('school.create')}}" class="btn btn-primary ml-3">Create School</a>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover text-center">
			  <thead>
			    <tr>
			      <th scope="col">SNo</th>
			      <th scope="col">@translate(Institute Name)</th>
			      <th scope="col">@translate(Contact Person)</th>
			      <th scope="col">@translate(Contact Number)</th>
			      <th scope="col">@translate(Contact Email)</th>
		     	  <th scope="col">@translate(Address)</th>
		     	  <th scope="col">@translate(Pincode)</th>
		     	  <th scope="col">@translate(State)</th>
		     	  <th scope="col">@translate(City)</th>
		     	  <th scope="col">@translate(Status)</th>
		     	  <th scope="col">@translate(Image)</th>
		     	  <th scope="col">@translate(Action)</th>
			    </tr>
			  </thead>
			  <tbody>
			@if(count($school)>0)
			  	@foreach($school as $res)
				  	<tr>
				      <td>{{ ($loop->index+1) + ($school->currentPage() - 1)*$school->perPage() }}</td>
				      @if($res->branch)
				      <td>{{ $res->university_name }} - {{ $res->university_name }}</td>
				      @else
				      <td>{{ $res->university_name }}</td>
				      @endif
				      <td>{{ $res->contact_person_name }}</td>
				      <td>{{ $res->contact_person_number }}</td>
				      <td>{{ $res->contact_person_email }}</td>
				      <td>{{ $res->address }}</td>
				      <td>{{ $res->pincode }}</td>
				      <td>{{ $res->state }}</td>
				      <td>{{ $res->city }}</td>
				      <td>
				      	@if($res->status ==1)
				      	<span class="badge badge-success">@translate(Active)</span>
				      	@else
				      	<span class="badge badge-warning">@translate(Inactive)</span>
				      	@endif
				      </td>
				      <td><img src="{{asset('school/logo'.'/'.$res->logo )}}" width="40" height="40"></td>
				      <td> <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">

<a class="dropdown-item" href="{{ route('school.b2bconfigurations',$res->id) }}">
	<i class="feather icon-globe mr-2"></i>@translate(B2B Configuration)</a>

<a class="dropdown-item" href="{{ route('school.B2B.category.permissions',$res->id) }}">
   <i class="fa fa-lock mr-2"></i>@translate(B2B category Permissions)</a>

											
                                        <a class="dropdown-item" href="{{ route('school.edit',base64_encode($res->id)) }}">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        
                                        <a class="dropdown-item" href="{{ route('school.destroy',base64_encode($res->id)) }}">
                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                    </div>
                                </div>
                            </div>
						</td>
				    </tr>
			  	@endforeach
			@else
            <tr><td colspan="12"><h4>No Data Available</h4></td></tr>
            @endif 	   
			  </tbody>
			  <div class="float-left">
                    {{ $school->links() }}
                </div>
			</table>
        </div>
    </div>

@endsection
