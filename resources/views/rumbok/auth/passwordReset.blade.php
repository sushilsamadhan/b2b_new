@extends('rumbok.app')
@section('content')


<section class="login-register">
    <div class="container">
        <div class="row my-5">
            <div class="col-md-10 offset-md-1">
                <div class="row no-gutter">
                    <div class="col-md-6">
                        <div class="form">      
                            <div class="tab-content">
                                <div id="signup">   
                                        <h1 class="mb-5">@translate(Reset Password)</h1>
                                        <p class="text-dark"> @translate(Enter the OTP received on your mobile number. Create new password for your account. If you have any issue about reset password) <a href="mail:{{getSystemSetting('type_mail')->value}}" class="primary-color-2 text-dark">@translate(contact us)</a></p>
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                @translate(OTP send to your mobile number - ){{ ' '.$mobile }}
                                            </div>
                                        @endif
                                        
                                        @if (session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                @translate(OTP did not matched.)
                                            </div>
                                        @endif
                                        <form action="{{ route('password.passwordReset') }}" method="post" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="mobile" value="{{ $mobile }}" />
                                            <div class="field-wrap">
                                            <label for="otp">
                                                @translate(OTP)<span class="req">*</span>
                                            </label>
                                            <input class="@error('otp') is-invalid @enderror" type="text"  id="otp" name="otp" autofocus minlength="4" maxlength="4" required autocomplete="off">
                                            @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            </div>
                                            <div class="field-wrap">
                                                    <label for="password">@translate(Create Password)<span class="req">*</span></label>
                                                    <input class="form-control @error('password') is-invalid @enderror" type="password"  id="password" name="password"  minlength="8" required autocomplete="off">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                            <div class="field-wrap">
                                                <div class="input-box">
                                                        <label for="confirmed">@translate(Confirm Password)<span class="req">*</span></label>
                                                        <input class="form-control @error('confirmed') is-invalid @enderror" type="password" id="confirmed" name="confirmed" minlength="8" required autocomplete="off">
                                                        
                                                        @error('confirmed')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div><!-- end col-lg-12 -->
                                            <div class="top-row"> 
                                                <div class="field-wrap text-right">
                                                    <a href="{{ route('login') }}">@translate(Login)</a>
                                                </div>
                                            </div>
                                            <button type="submit" class="button button-block">@translate(Update password)</button>
                                        </form>
                                </div>
                                <div id="login"></div>
                            </div><!-- tab-content -->
                        </div> <!-- /form -->
                    </div>
                    <div class="col-md-6">
                        <div class="login-background-part h-100">
                                <div class="login-bg-content">
                                    <h1 class="olexpert-tag">OLEXPERT</h1>
                                    <div class="app-content">
                                        <p class="text-white">Online Learning with Expert (OLEXPERT) is a solution-oriented initiative that provides guidance to the seekers on a single click through digital content & library.</p>
                                    </div>
                                    <div class="clearfix p-3 d-flex align-items-center">
                                        <div class="download-app-btn">
                                            <a href="https://play.google.com/store/apps/details?id=com.oleexpert" class="app-download-btn">
                                            <span><i class="fab fa-android"></i></span> Download App</a>    
                                        </div>
                                        <div class="support-btn ml-auto">
                                        <a href="https://ole.org.in/help-and-support" class="support-link"><span><i class="fa fa-headphones"></i></span> Help & Support</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
        
    </div>
</section>
@endsection
