@extends('layouts.master')
@section('title','Agent Register Users')
@section('parentPageTitle', 'Agent')
@section('content')
<div class="card mx-2 mb-3">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(All Agents Register Users)</h3>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control col-12"
                                       placeholder="@translate(Search by name or phone)"
                                       value="{{Request::get('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
                                <a href="{{ route('agent.index') }}" class="btn btn-primary ml-3">Back</a>
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
			      <th scope="col">#</th>
			      <th scope="col">@translate(Name)</th>
			      <th scope="col">@translate(Student Id)</th>
			      <th scope="col">@translate(Email)</th>
			      <th scope="col">@translate(Phone)</th>
		     	  <th scope="col">@translate(Address)</th>
		     	  <th scope="col">@translate(Class Name)</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@if(count($agent_users)>0)
			  	@foreach($agent_users as $agent_user)
				  	<tr>
				       <td>{{ ($loop->index+1) + ($agent_users->currentPage() - 1)*$agent_users->perPage() }}</td>
				       <td>{{ $agent_user->name }}</td>
				       <td>{{ $agent_user->id }}</td>
				       <td>{{ $agent_user->email ?? 'NA'}}</td>
				       <td>{{ $agent_user->phone ?? 'NA' }}</td>
				       <td>{{ $agent_user->address ?? 'NA'}}</td>
				       @php
				       if($agent_user->class_name){
				       	$name = DB::table('categories')->where('id',$agent_user->class_name)->first();
				       }

				       @endphp

				       <td>{{ $name->name?$name->name : 'NA' }}</td>
			  	@endforeach	
			  	@else
			  	<tr><td colspan ="7"><h4>No Data Available<h4></td></tr>   
			  	@endif
			  </tbody>
			  <div class="float-left">
                    {{ $agent_users->links() }}
                </div>
			</table>
        </div>
    </div>
@endsection