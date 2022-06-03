@extends(themeManager().'.app')
@section('content')
<style>
    @media (max-width:767px){
        header.header-section {
            display:none;
        }
    }
</style>


<section class="login-register">
    <div class="container">
    <div class="row my-5">
            <div class="col-md-10 offset-md-1">
                <div class="row no-gutter">
                    <div class="col-md-6">
                    <div class="form">      
                        <div class="tab-content">
                            <div id="signup"> 
                                <div class="login-center-logo d-md-none d-lg-none d-sm-block">
                                    <a class="" href="{{ route('homepage') }}" title="{{getSystemSetting('type_name')->value}}">
                                    <img class="img-fluid header-logo" src="{{ filePath(getSystemSetting('type_logo')->value) }}" alt="{{getSystemSetting('type_name')->value}}">
                                    </a>
                                </div>  
                                <h1 class="mb-3">Forgot Password</h1>
                                <p class="text-dark"> @translate(Enter the phone number of your account to reset password.Then you will receive OTP to mobile number to reset the  password.If you have any issue about reset password)<br><a href="mail:{{getSystemSetting('type_mail')->value}}" class="primary-color-2 text-info">@translate(contact us)</a></p>
                            
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="{{ route('password.reset-otp') }}" method="post" autocomplete="off">
                                    @csrf
                                    
                                    <div class="field-wrap">
                                        <label for="logemail">
                                            @translate(Phone Number)<span class="req">*</span>
                                        </label>
                                        <input class="@error('mobile') is-invalid @enderror" type="text" id="logemail" minlength="10" maxlength="10" value="{{ old('mobile') }}" name="mobile"  required>
                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="top-row"> 
                                        <div class="field-wrap"></div>
                                            <div class="field-wrap text-right">
                                                <a href="{{ route('login') }}">@translate(Login)</a>
                                            </div>
                                        </div>
                                        <button type="submit" class="button button-block">@translate(Send OTP)</button>
                                </form>
                    
                            </div>
                            <div id="login">   
                            </div>
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
        
    </div>
</section>
@endsection
@section('js')
<script>
$(document).ready(function(){
    $('.logintab a').on('click', function (e) {
        e.preventDefault();
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        target = $(this).attr('href');

        $('.tab-content > div').not(target).hide();

        $(target).fadeIn(600);
        
    });
   
});

</sctipt>
@endsection