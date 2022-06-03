@extends('layouts.master')
@section('title','Edit Agent')
@section('parentPageTitle', 'Agent')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Edit Agent</h3>
            </div>
            
        </div>

        <div class="card-body">
        <form action="{{ route('agent.update') }}" method="POST">
            @csrf
            <div class="row">
            <div class="col-sm-6">
            <div class="form-group row">
            <label for="agent_name" class="col-sm-3 col-form-label">Agent Name<span class="validType">*</span></label>
                <div class="col-sm-9">
                    <input type="text" id="agent_name" name="agent_name" value="{{ $agent->agent_name}}" placeholder="Agent Name" class="form-control ">
                    <input type="hidden" name="id" value="{{ $agent->id }}">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
            <label for="agent_contact_number" class="col-sm-3 col-form-label">Contact Number<span class="validType">*</span></label>
                <div class="col-sm-9">
                    <input type="text" id="agent_contact_number" name="agent_contact_number" placeholder="Contact Person Number" class="form-control" value="{{ $agent->agent_contact_number}}">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
            <label for="agent_email" class="col-sm-3 col-form-label">Contact Email</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="agent_email" value="{{ $agent->agent_email}}" name="agent_email" placeholder="Agent Email Address">
                </div>
            </div>
        </div>
    
        <div class="col-sm-6">
            <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="1" @if($agent->status == 1) selected @endif>Active</option>
                        <option value="0" @if($agent->status == 0) selected @endif>Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-12 text-center">  
            <div class="form-group row">
                <label class="col-md-2 col-form-label" for="example"></label>
                <div class="col-md-6">
                    <button type="submit" class="btn waves-effect waves-light btn-primary">Update</button>
                </div>
            </div>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection
