@extends('layouts.master')
@section('title','Subscriber List')
@section('parentPageTitle', 'All Subscribers')
@section('content')

<style>
   form{
       padding-left: 5%;
       padding-bottom: 5%;
       padding-right: 5%;
   } 
</style>
<section class="py-3">
    <div class="container">
        <h2>update Mentor</h2>
        <div class="row ">
            <div class="col-md-12">                  
                <form class="needs-validation" enctype="multipart/form-data" method="post"  action="{{ url('list-edit-update',['id' => $item->id]) }}" novalidate>                                        
                    @csrf
                    <div class="row">                            
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-inverse font-weight-bold small" for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" pattern="^[\pL\s\-]+$" id="name" value = '<?php echo $item->name; ?>' placeholder="Full Name" name="name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-inverse font-weight-bold small" for="phone">Phone<span class="text-danger">*</span></label>
                                <input type="text" id="phone" class="form-control form-control-sm" placeholder="Phone No." maxlength="10" pattern="[6-9]{1}[0-9]{9}" value = '<?php echo $item->phone; ?>' name="phone" required>
                                <div class="invalid-feedback">
                                    Please Enter Valid Mobile No.
                                </div>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>                                                    
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="text-inverse font-weight-bold small" for="experience" >Experience<span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control form-control-sm " id="experience" placeholder="experience" name="experience"  required >{{ $item->experience }}</textarea>
                                <div class="invalid-feedback">
                                    Experience required
                                </div>
                            </div>
                        </div>                                                    
                    </div>                                            
                    <div class="row">                                                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-inverse font-weight-bold small" for="photo" >Upload Image</label>
                                <input type="file" class="form-control form-control-sm" id="photo" placeholder="photo" value = '<?php echo $item->photo; ?>' name="photo" >                                                       
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-inverse font-weight-bold small" for="title" >Profile Title<span class="text-danger">*</span></label>
                                <input type="text" id="title" class="form-control form-control-sm"  placeholder="title" name="profile_title" value = '<?php echo $item->profile_title; ?>' required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="text-inverse font-weight-bold small" for="discription" >Full Discription<span class="text-danger">*</span></label>
                                <textarea type="text" id="discription" class="form-control form-control-sm summernote"  placeholder="Full Discription" name="profile_desc"  required>{{ $item->profile_desc }}</textarea>
                                <div class="invalid-feedback">
                                    Full Discription required
                                </div>
                            </div>
                        </div>                                                    
                    </div>                      
                    <div class="row">
                        <div class="col-md-12">
                            <input id="submit" type="submit" class="btn btn-info btn-block" value="Submit" >   
                        </div>                                          
                    </div> 
                </form>
            
            </div>
        </div>
    </div>
</section>

@endsection


