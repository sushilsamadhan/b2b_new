@extends('layouts.master')
@section('title','Agent List')
@section('parentPageTitle', 'Agent')
@section('content')
<div class="card mx-2 mb-3">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(All Agents)</h3>
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
                                <a href="{{route('agent.create')}}" class="btn btn-primary ml-3">Create Agent</a>
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
			      <th scope="col">@translate(Agent Name)</th>
			      <th scope="col">@translate(Agent Email)</th>
			      <th scope="col">@translate(Agent Code)</th>
		     	  <th scope="col">@translate(Access Key)</th>
		     	   <th scope="col">@translate(Contact Number)</th>
		     	  <th scope="col">@translate(Status)</th>
		     	  <th scope="col">@translate(Action)</th>
			    </tr>
			  </thead>
			  <tbody>
             @if(count($agent)>0)
			  	@foreach($agent as $res)
				  	<tr>
				     <td>{{ ($loop->index+1) + ($agent->currentPage() - 1)*$agent->perPage() }}</td>
				      <td>{{ $res->agent_name }}</td>
				       <td>{{$res->agent_email ?? $res->agent_email  ?? 'N/A'}}</td>
				       <td>{{ $res->agent_code }}</td>
				       <td>{{ $res->access_key }}</td>
				      <td>{{ $res->agent_contact_number }}</td>
				      <td>
				      	@if($res->status ==1)
				      	<span class="badge badge-success">@translate(Active)</span>
				      	@else
				      	<span class="badge badge-warning">@translate(Inactive)</span>
				      	@endif
				      </td>
				      <td>
				      	<div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="{{ route('agent.edit',base64_encode($res->id)) }}">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        <!--
                                        <a class="dropdown-item" href="{{ route('agent.destroy',base64_encode($res->id)) }}">
                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
					-->
                                        <a class="dropdown-item" target="_blank" href="{{ route('agent.agent_register_users',base64_encode($res->agent_code)) }}">
                                                <i class="feather icon-users mr-2"></i>@translate(All Students)</a>   
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
                    {{ $agent->links() }}
                </div>
			</table>
        </div>
    </div>
@endsection
