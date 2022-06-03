@extends('layouts.master')
@section('title','Add Agent')
@section('parentPageTitle', 'Agent')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Add Agent</h3>
            </div>
            
        </div>

        <div class="card-body">
        <form action="{{ route('agent.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="agent_name" class="col-sm-3 col-form-label">Agent Name<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="agent_name"  value="{{ old('agent_name') }}" name="agent_name" placeholder="Agent Name" class="form-control ">
                       <!--  @error('agent_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="agent_contact_number" class="col-sm-3 col-form-label">Contact Number<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="agent_contact_number"  value="{{ old('agent_contact_number') }}" name="agent_contact_number" placeholder="Contact Person Number" class="form-control">
                      <!--   @error('agent_contact_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="agent_email" class="col-sm-3 col-form-label">Contact Email<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="agent_email" value="{{ old('agent_email') }}" name="agent_email" placeholder="Agent Email Address">
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Status<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="status" id="status" value="{{ old('status') }}" class="form-control">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <!--  @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror -->
                    </div>
                </div>
            </div>
           
            <div class="col-sm-12 text-center">  
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="example"></label>
                    <div class="col-md-6">
                        <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                    </div>
                </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
