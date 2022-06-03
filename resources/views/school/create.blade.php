@extends('layouts.master')
@section('title','Add School')
@section('parentPageTitle', 'School')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Add School/Institute</h3>
            </div>
            
        </div>

        <div class="card-body">
        <form action="{{ route('school.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="university_name" class="col-sm-3 col-form-label">@translate(School / Institute Name)<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="university_name" value="{{ old('university_name')}}" name="university_name" placeholder="Institute Name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="branch" class="col-sm-3 col-form-label">Branch Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="branch" name="branch" value="{{ old('branch')}}" placeholder="Institute Branch Name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="contact_person_name" class="col-sm-3 col-form-label">Contact Person<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ old('contact_person_name')}}" id="contact_person_name" name="contact_person_name" placeholder="Contact Person Name">
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="contact_person_number" class="col-sm-3 col-form-label">Contact Number<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="contact_person_number" maxlength="10" value="{{ old('contact_person_number')}}" name="contact_person_number" placeholder="Contact Person Number" class="form-control ">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="contact_person_email" class="col-sm-3 col-form-label">Contact Email<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ old('contact_person_email')}}" id="contact_person_email" name="contact_person_email" placeholder="Contact Person Email">
                       
                    </div>
                </div>
            </div>
           
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="address" class="col-sm-3 col-form-label">Address<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ old('address')}}" id="address" name="address" placeholder="Address">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="pincode" class="col-sm-3 col-form-label">Pincode<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="pincode" value="{{ old('pincode')}}" name="pincode" placeholder="Pincode" class="form-control ">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="state" class="col-sm-3 col-form-label">State<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ old('state')}}" id="state" name="state" placeholder="State">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">City<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="city" name="city" value="{{ old('city')}}" placeholder="City" class="form-control ">
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Status<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <!-- <input type="text" class="form-control" id="status" name="status" placeholder="Title"> -->
                        <select name="status" value="{{ old('status')}}" id="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        
                    </div>
                </div>
            </div>
           
            <div class="col-sm-6">
                <div class="form-group row">
                    <label for="logo" class="col-sm-3 col-form-label">Image <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control"  name="logo" id="logo">
                    
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
@section('page-script')
<script>
    $(document).ready(function(){
        $('#pincode').on('keyup',function(){
            var pincode = $(this).val();
            if(pincode == ''){
                $('#city').val(' ');
                $('#state').val(' ');
            }else{
                $.ajax({
                url: "https://api.postalpincode.in/pincode/"+pincode,
                type: "GET",
                dataType: "json",
                success: function(response){
                    $('#city').val(response[0].PostOffice[0].District);
                    $('#state').val(response[0].PostOffice[0].State);
                }
            });
            }
        });
    });
</script>
@stop