@extends('layouts.master')
@section('title','Edit School')
@section('parentPageTitle', 'School')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Edit School/Institute</h3>
            </div>
            
        </div>

        <div class="card-body">
        <form action="{{ route('school.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label for="university_name" class="col-sm-3 col-form-label">Institute Name<span class="validType">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="university_name" name="university_name" placeholder="Institute Name" class="form-control" value="{{ $school->university_name }}">
                            <input type="hidden" name="id" value="{{ $school->id }}">
                         <!--    @error('university_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group row">
                <label for="branch" class="col-sm-3 col-form-label">Branch Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="branch" value="{{ $school->branch }}" name="branch" placeholder="Institute Branch Name" class="form-control">
                    </div>
                </div>
            </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label for="contact_person_name" class="col-sm-3 col-form-label">Contact Person Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name" value="{{ $school->contact_person_name }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label for="contact_person_number   " class="col-sm-3 col-form-label">Contact Number<span class="validType">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="contact_person_number" name="contact_person_number" placeholder="Contact Person Number" class="form-control" value="{{ $school->contact_person_number }}">
                            <!-- @error('contact_person_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label for="contact_person_email" class="col-sm-3 col-form-label">Contact Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="contact_person_email" name="contact_person_email" placeholder="Contact Person Email" value="{{ $school->contact_person_email }}">
                        </div>
                    </div>
                </div>
               
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $school->address }}" id="address" name="address" placeholder="Address">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label for="pincode" class="col-sm-3 col-form-label">Pincode<span class="validType">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="pincode" name="pincode" placeholder="Pincode" class="form-control" value="{{ $school->pincode }}">
                            <!-- @error('pincode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label for="state" class="col-sm-3 col-form-label">State</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ $school->state }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">City<span class="validType">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="city" name="city" placeholder="City" class="form-control" value="{{ $school->city }}">
                           <!--  @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                        </div>
                    </div>
                </div>
            
                <div class="col-sm-6">
                    <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1" @if($school->status == 1) selected @endif>Active</option>
                                <option value="0" @if($school->status == 0) selected @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="logo" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control"  name="logo" id="logo">
                            <img src="{{ asset('school/logo/'.$school->logo )}}" width="40" height="40">
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
