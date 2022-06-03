@extends('rumbok.app')
@section('content')


<section class="login-register">
    <div class="container">
        <div class="form">      
           
            
            <div class="tab-content">
                <div id="signup">   
                <h1 class="mb-5">@translate(Instructor Registration)</h1>
                 <!-- @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        @translate(OTP send to your mobile number - )
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        @translate(OTP did not matched.)
                    </div>
                @endif -->
                <form action="{{ route('instructor.create') }}" method="post" autocomplete="off">
                    @csrf
                    <input type="hidden" required name="package_id" value="{{$packages->id}}"
                                                   class="card-input-element">
                                           
                    <div class="field-wrap">
                        <span class="la la-user input-icon"> <label class="label-text">@translate(Full Name)<span
                                                class="primary-color-2 ml-1">*</span></label></span>
                        <div class="form-group">
                            <input class="form-control pl-2 @error('name') is-invalid @enderror"
                                    type="text" name="name" placeholder="Full name" required
                                    value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>
                    <div class="field-wrap">
                    <span class="la la-envelope input-icon">
                        <label class="label-text">@translate(Email Address)<span class="primary-color-2 ml-1">*</span></label>
                    </span>
                        <div class="form-group">
                            <input class="form-control pl-2 @error('email') is-invalid @enderror"
                                    type="email" name="email" placeholder="Email address"
                                    required value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>




                    <div class="field-wrap">
                    <span class="la la-envelope input-icon">
                        <label class="label-text">@translate(Instructor Type)<span class="primary-color-2 ml-1">*</span></label>
                    </span>
                        <div class="form-group">
                            <select name="is_external" class="form-control pl-2" required>
                                <option value="0">Internal (Olexpert Teachers)</option>
                                <option value="2">External (Freelancers)</option>
                                <option value="1">Internal and External Both</option>
                            </select>

                        </div>
                    </div>

                    
                    <div class="field-wrap">
                        <span class="la la-lock input-icon">
                            <label class="label-text">@translate(Password)<span
                                class="primary-color-2 ml-1">*</span></label>
                        </span>
                        <div class="form-group">
                            <input class="form-control pl-2 @error('password') is-invalid @enderror"
                                    type="password" name="password" placeholder="Password"
                                    required>
                            <small id="emailHelp" class="form-text text-muted">Password minimum
                                8 characters.</small>


                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        
                    </div>

                    <div class="field-wrap">
                        <div class="input-box">
                            <span class="la la-lock input-icon">
                                            <label class="label-text">@translate(Confirm Password)<span
                                                class="primary-color-2 ml-1">*</span></label>
                            </span>
                                    <div class="form-group">
                                        <input class="form-control pl-2 @error('confirm_password') is-invalid @enderror"
                                            type="password" name="confirm_password"
                                            placeholder="Confirm password" required>
                                        @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror

                                    </div>
                        </div>
                    </div><!-- end col-lg-12 -->

                    <!-- <div class="top-row"> 
                        <div class="field-wrap text-right">
                            <a href="{{ route('login') }}">@translate(Login)</a>
                        </div>
                    </div> -->
                
                <button type="submit" class="button button-block">@translate(register account)</button>
                <span>@translate(Already have an account)? <a href="{{ route('login') }}" class="login-link">@translate(Login)</a></span>
                </form>
        
                </div>
                
                <div id="login">   
                
                </div>
                
            </div><!-- tab-content -->
            
        </div> <!-- /form -->
    </div>
</section>
@endsection
