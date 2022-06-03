@extends(themeManager().'.app')

@section('content')
<style>
    @media (max-width:767px){
        header.header-section {
            display:none;
        }
        .bottom-menu {
            display:none;
        }
    }
    body {
        margin-bottom:0;
        padding: 0;
    }
    .potrait { display:block; }
  .landscape { display:none; }

@media(max-width:767px) {
    @media only screen and (orientation:landscape) {
  .potrait { display:block; }
  .landscape { display:none; }
}

@media only screen and (orientation:portrait) {
  .potrait { display:block; }
  .landscape { display:none; }
}
</style>
<style>
.radio-toolbar .for_class_name_type {
  display: none;
}
.radio-toolbar label {
    display: block;
    padding: 0px 12px;
    font-family: Arial;
    font-size: 16px;
    pointer-events: all;
    cursor: pointer;
    color: #000;
    font-weight: normal;
    text-align: center;
    border-radius: 3px;
}
.radio-toolbar .for_class_name_type:checked+label span {
  background-color: blue;
  color: #fff;
}
.header-new {
    position: relative;
}
</style>
  <!-- ================================
         START LOGIN AREA
  ================================= -->
  @if(themeManager() == 'rumbok')
  <section class="login-register">
    <div class="container">
     <div class="row my-5">
      <div class="col-md-10 offset-md-1">
        <div class="row no-gutter">
            <div class="col-md-6">
            <div class="form">      
                    <ul class="tab-group">
                        <li class="logintab active"><a href="?login">Log In</a></li>
                        <li class="logintab"><a href="?signup">Register</a></li>
                    </ul>
                    
                    <div class="tab-content">
                        <div class="login-center-logo d-md-none d-lg-none d-sm-block">
                            <a class="navbar-brand" href="{{ route('homepage') }}"
                                            title="{{getSystemSetting('type_name')->value}}">
                                                <img class="img-fluid header-logo"
                                                src="{{ filePath(getSystemSetting('type_logo')->value) }}"
                                                alt="{{getSystemSetting('type_name')->value}}">
                            </a>
                        </div>
                        <div id="signup" @if(!$_GET || isset($_GET['login'])) style="display: block;" @else style="display: none;" @endif>   
                            <h1 class="mb-3">Login To Your Account!</h1>
                        
                            <form action="{{ route('login') }}" method="post" autocomplete="off">
                                @csrf
                                <input type="hidden" name="referral_url" value="{{ @$_SERVER['HTTP_REFERER'] }}" />
                                <div class="field-wrap">
                                    <label for="logemail">
                                        Phone Number<span class="req">*</span>
                                    </label>
                                    <input class="@error('email') is-invalid @enderror" type="text" id="logemail" name="email"  required value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                                    
                                <div class="field-wrap">
                                    <label for="pass">
                                        Password<span class="req">*</span>
                                    </label>
                                
                                    <input id="pass" class="@error('password') is-invalid @enderror pl-2" type="password" name="password"  required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="top-row">
                                    <div class="field-wrap">
                                        <div class="checkbox-part" onclick="myFunction()">
                                            <!-- <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}> -->
                                            <label for="remember">Show Password</label>
                                        </div>
                                    </div>                        
                                    <div class="field-wrap text-right">
                                        <a href="{{route('student.password.reset')}}">forgot password?</a>
                                    </div>
                                </div>
                            
                                <button type="submit" class="button button-block">Login to your account</button>
                                <div class="text-center">
                                  <p class="small">Not a member yet? <a onclick="opensignup()" class="cta">Click Here</a></p>
                                </div>
                            </form> 
                
                        </div>
                        
                        <div id="login" @if(isset($_GET['signup'])) style="display: block;" @else style="display: none;" @endif>   
                            <h1>Register</h1>
                            <p class="text-dark"> We will send one time password (OTP) on this Mobile number</p>
                            <form action="{{ route('student.create') }}" autocomplete="off" method="post">
                                    <div class="field-wrap" id="name-row">
                                        <label>
                                            Enter Full Name<span class="req">*</span>
                                        </label>
                                        <input class="@error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}"  autocomplete="off">
                                        <span class="invalid-feedback name-error" role="alert"></span>
                                    <div class="field-wrap">
                                        <label>Phone Number<span class="req">*</span>
                                        </label>
                                        <div class="d-flex align-items-center">
                                            <input class="@error('email') is-invalid @enderror" id="email" type="number" name="email"  value="{{ old('email') }}" maxlength="10" autocomplete="off">
                                            <span class="ml-auto" id="button-otp"><a href="javascript:void(0);" id="send-otp" class="send-otp ml-auto" style=" padding: 10px; ">Send OTP</a></span>
                                        </div>
                                        <span class="email-error" role="alert"  style="font-size: 80%;"></span>
                                    </div>
                                    
                                    <div class="field-wrap otp-row" style="display:none;">
                                        <label>
                                            OTP<span class="req">*</span>
                                        </label>
                                        <input class="@error('otp') is-invalid @enderror" id="user-otp" type="text" name="user-otp"  value="" maxlength="4" autocomplete="off">
                                        <span class="invalid-feedback otp-error" role="alert"></span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="field-wrap resend-otp-btn" style="display:none;">
                                            <div class="btn-box">
                                                <button class="btn btn-sm" id="resend-otp" type="button">Resend OTP in <span id="timer"></span></button>
                                            </div>
                                        </div>

                                        <div class="field-wrap verify-btn ml-auto" style="display:none;">
                                            <div class="btn-box">
                                                <button class="btn btn-warning btn-sm"  id="verifyBtn" type="button">@translate(Verify)</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Choose Your Preference<span class="req">*</span></label>
                                        <div class="radio-toolbar mb-2 row">
                                            <input id="radio_for_k12" value="k12" type="radio" name="class_type" class="for_class_name_type" onclick="FunctionForclass_name_type(this.value)">
                                            <label for="radio_for_k12" class="col-6">
                                            <span class="small d-block border border-dark rounded">School</span></label>
                                            
                                            <input id="radio_for_college" value="college" type="radio" name="class_type" class="for_class_name_type" onclick="FunctionForclass_name_type(this.value)">
                                            <label for="radio_for_college" class="col-6">
                                                <span class="small d-block border border-dark rounded">College</span>
                                            </label>   

                                            <input id="radio_for_18pluse" value="18+" type="radio" name="class_type" class="for_class_name_type" onclick="FunctionForclass_name_type(this.value)">
                                            <label for="radio_for_18pluse" class="col-6">
                                                <span class="small d-block border border-dark rounded">Competitive Courses</span>
                                            </label>
                                            
                                            <input id="radio_for_industrial" value="industrial" type="radio" name="class_type" class="for_class_name_type" onclick="FunctionForclass_name_type(this.value)">
                                            <label for="radio_for_industrial" class="col-6">
                                                <span class="small d-block border border-dark rounded">Industrial Courses</span>
                                            </label>  

                                            <input id="radio_for_other" value="other" type="radio" name="class_type" class="for_class_name_type" onclick="FunctionForclass_name_type(this.value)">
                                            <label for="radio_for_other" class="col-6">
                                                <span class="small d-block border border-dark rounded">Other</span>
                                            </label>                                         
                                        </div>
                                        <span class="class_type-error" role="alert" style="font-size: 80%;"></span>
                                    </div>

                                <div id="show_for_k12" style="display:none;">

<div class="radio-toolbar mb-2 row">
@php
$classes = \App\Model\Category::where('parent_category_id',9)->get();
@endphp
@foreach($classes as $classesval)
    <input id="class_name_{{ $classesval->id }}" type="radio" name="class_name" value="{{ $classesval->id }}" class="for_class_name_type">
    <label for="class_name_{{ $classesval->id }}" class="col-3">
        <span class="d-block border border-dark rounded">{{ $classesval->name }}</span>
    </label>
@endforeach

                                     
</div>     
    <span class="class_name-error" role="alert" style="font-size: 80%;margin-left: 13px;"></span>

                                                        <div class="form-group">
                                                                        <label>Board<span class="req">*</span></label>
                                                                        @php
                                                                            $boards = \App\Model\Category::where('parent_category_id',83)->get();
                                                                        @endphp
                                                                        <select class="form-control bg-transparent" name="board" id="board">
                                                                                <option value="">Select</option>
                                                                            @foreach($boards as $boardsval)
                                                                                <option value="{{ $boardsval->id }}">{{ $boardsval->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span class="board-error" role="alert" style="font-size: 80%;"></span>
                                                        </div>
                                </div>

                                <div id="show_for_18" style="display:none;">
                                        <div class="form-group">
                                                    <label>Competitive<span class="req">*</span></label>
                                                    @php
                                                    $con = ['is_compitative' => '1', 'parent_category_id' => '0'];

                                                        $Competitive = \App\Model\Category::where($con)->get();
                                                    @endphp
                                                    <select class="form-control bg-transparent" id="competitive" >
                                                            <option value="">Select</option>
                                                        @foreach($Competitive as $Competitiveval)
                                                            <option value="{{ $Competitiveval->name }}">{{ $Competitiveval->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="competitive-error" role="alert" style="font-size: 80%;"></span>
                                        </div>
                                </div>

















                                        <input type="hidden" id="ifverifynumber" value="0">


                                        <label>
                                            Password<span class="req">*</span>
                                        </label>
                                        <input class="@error('password') is-invalid @enderror" id="password" type="password" name="password"   autocomplete="off">
                                        <span class="invalid-feedback password-error" role="alert">
                                        </span>

                                        <label>
                                            Confirm Password<span class="req">*</span>
                                        </label>
                                        <input class="@error('password_confirmation') is-invalid @enderror" id="password_confirmation" type="password" name="password_confirmation"  autocomplete="off">
                                        <span class="invalid-feedback confirm-error" role="alert">
                                        </span>
                                    </div>

                                    <div class="field-wrap login-btn">
                                        <div class="btn-box">
                                            <button class="button button-block"  id="loginBtn" type="button">@translate(Submit)</button>
                                        </div>
                                    </div>

                            </form>
                
                        </div>
                        
                    </div><!-- tab-content -->
                    
                </div> <!-- /form -->
                <!--<div class="form bg-transparent p-0 shadow-none">
                    <div class="clearfix">
                    <a href="https://ole.org.in/help-and-support">
                    <img src="{{asset('asset_rumbok/new/images/help-and-support.png')}}" alt="" class="img-fluid w-100"/>
                    </a>
                </div>
                </div>-->
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
                 <span><i class="fa fa-play"></i></span> Download Now</a>
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
  @elseif(false)

  @else
      <section class="login-area section--padding py-5">
          <div class="container">
              <div class="row">
                  <div class="col-lg-7 mx-auto">
                      <div class="card-box-shared">
                          <div class="card-box-shared-title text-center">
                              <h3 class="widget-title font-size-35">@translate(Login to Your Account)!</h3>
                          </div>

                          {{-- Flash message after successful registration --}}
                          @if (Session::has('message'))
                              <div class="alert alert-info text-center">{{ Session::get('message') }}</div>
                          @endif



                          {{-- Login form --}}
                          <div class="card-box-shared-body">
                              <div class="contact-form-action">
                                  <form method="post" action="{{ route('login') }}">
                                      @csrf
                                      <div class="row">
                                          @if(env('GOOGLE_APP_ID') != "")
                                              <div class="col-12">
                                                  <div class="form-group">
                                                      <a class="theme-btn w-100 text-center" href="{{ url('/auth/redirect/google') }}">
                                                          <i class="fa fa-google mr-2"></i>@translate(Google)
                                                      </a>
                                                  </div>
                                              </div><!-- end col-lg-4 -->
                                              <div class="col-lg-12">
                                                  <div class="account-assist mt-3 margin-bottom-35px text-center">
                                                      <p class="account__desc">@translate(or)</p>
                                                  </div>
                                              </div><!-- end col-md-12 -->
                                          @endif
                                              @if(env('DEMO') == "YES")
                                                  <hr>
                                                  <div class="row">
                                                      <div class="col-md-4 col-sm-12 mb-2">
                                                          <button class="btn btn-primary px-5 " type="button" id="admin">Admin</button>
                                                      </div>

                                                      <div class="col-md-4 col-sm-12  mb-2">
                                                          <button class="btn btn-primary  px-5 " type="button" id="instructor">Instructor</button>
                                                      </div>

                                                      <div class="col-md-4 col-sm-12  mb-2">
                                                          <button class="btn btn-primary px-5" type="button" id="student">Student</button>
                                                      </div>
                                                  </div>
                                              @endif
                                          <div class="col-lg-12">
                                              <div class="input-box">
                                                  <label class="label-text">@translate(Phone Number)<span class="primary-color-2 ml-1">*</span></label>
                                                  <div class="form-group">
                                                      <input class="form-control @error('email') is-invalid @enderror" id="email" type="text" name="email" placeholder="@translate(Phone Number)" required value="{{ old('email') }}">
                                                      <span class="la la-phone input-icon"></span>

                                                      @error('email')
                                                      <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                      @enderror

                                                  </div>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12">
                                              <div class="input-box">
                                                  <label class="label-text">@translate(Password)<span class="primary-color-2 ml-1">*</span></label>
                                                  <div class="form-group">
                                                      <input id="pass" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="@translate(Password)" required>
                                                      <span class="la la-lock input-icon"></span>

                                                      @error('password')
                                                      <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                    </span>
                                                      @enderror

                                                  </div>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12">
                                              <div class="form-group">
                                                  <div class="custom-checkbox d-flex justify-content-between" onclick="myFunction()">
                                                      <input type="checkbox" id="chb1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                      <label for="chb1">@translate(Show Password)</label>
                                                      <a href="{{route('student.password.reset')}}" class="primary-color-2"> @translate(Forgot my password)?</a>
                                                  </div>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12 ">
                                              <div class="btn-box">
                                                  <button class="theme-btn" id="loginBtn" type="submit">@translate(login account)</button>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12">
                                              <p class="mt-4">@translate(Don't have an account)? <a href="{{ route('student.register') }}" class="primary-color-2">@translate(Register)</a></p>
                                          </div><!-- end col-md-12 -->
                                      </div><!-- end row -->
                                  </form>
                              </div><!-- end contact-form -->
                          </div>
                      </div>
                  </div><!-- end col-lg-7 -->
              </div><!-- end row -->
          </div><!-- end container -->
      </section><!-- end login-area -->
  @endif
  <!-- ================================
         START LOGIN AREA
  ================================= -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
</script>

<script>
    $(document).on('click', '#send-otp,#resend-otp', function(){    
    var mobile = $('#email').val();
    $.ajax({
          type:'POST',
          url:'{{ route("password.mobile_check_otp") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'email':mobile},
          success: function (response) { 
              console.log(response);
              $('.otp-row').show(); 
              $('.verify-btn').show();
              $('.otp-btn').hide(); 
              $('#email').attr('readonly',true);
              $('#email').removeClass('is-invalid ');
              $('.email-error').html('');
              $('#user-otp').addClass('is-valid'); 
              $('.otp-error').removeClass('invalid-feedback');  
              $('.otp-error').removeClass('text-danger');
              $('.otp-error').addClass('valid-feedback');                
              $('.otp-error').html('<strong>'+response.message+'</strong>');
              $('.resend-otp-btn').show();
              $('#resend-otp').attr('disabled',true);
              $('#resend-otp').removeClass('btn-success');
              $('#resend-otp').addClass('btn-danger');
              timer(300);
                      
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          { 
            response = JSON.parse(XMLHttpRequest.responseText);
            if(response.errors.email){
               // alert(response.errors.email[0]);
                $('#email').addClass('is-invalid ');  
                $('.email-error').addClass('text-danger');
                $('.email-error').html('<strong>'+response.errors.email[0]+'</strong>');
            }
          } 
      });
     //}
});
$(document).on('click', '#verifyBtn', function(){
    var userOtp = $('#user-otp').val();
    var mobile = $('#email').val();
    $('#verifyBtn').attr('disabled',true);
    if(userOtp!='' && userOtp.length==4){
        $.ajax({
          type:'POST',
          url:'{{ route("password.mobile_otp_verify") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'otp':userOtp,'email':mobile},
          success: function (response) { 
              //$('.otp-row').show(); 
              //$('.verify-btn').show();
              //$('.otp-btn').hide(); 
              $('#email').attr('readonly',true);
              $('#email').removeClass('is-invalid ');
              $('.email-error').html('');
              $('#user-otp').addClass('is-valid'); 
              $('.otp-error').removeClass('text-danger');
              $('.otp-error').addClass('text-success');                 
              $('.otp-error').html('<strong>'+response.message+'</strong>');


              $('.send-otp').addClass('bg-success');                  
              $('.send-otp').html('<strong>Verified</strong>');                
              $('#ifverifynumber').val('1');


              if(response.message=="OTP verified successfully"){
                $('.otp-row').hide(); 
                $('.otp-btn').hide();
                $('.resend-otp-btn').hide();
                $('.verify-btn').hide();
                $('.login-btn').show();
                $('#name-row').show();
              }
              console.log(response);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          {  
            response = JSON.parse(XMLHttpRequest.responseText);
            console.log(response);
            if(response.errors.otp){
                $('.otp-error').removeClass('valid-feedback');
                $('.otp-error').addClass('is-invalid text-danger');
                $('#user-otp').addClass('is-invalid ');
                $('.otp-error').html('<strong>'+response.errors.otp[0]+'</strong>');
                $('#verifyBtn').attr('disabled',false);
            }
          } 
      });
    }
});
$(document).on('click', '#loginBtn', function(){
    // alert('==================');
    var name = $('#name').val();
    var ifverifynumber = $('#ifverifynumber').val();
    var mobile = $('#email').val();

    // var class_type = $('#class_type').val();
    // var class_name = $('#class_name').val();

    var class_type = $('input[name="class_type"]:checked').val();
    var class_name = $('input[name="class_name"]:checked').val();

    var board = $('#board').val();
    var competitive = $('#competitive').val();

    var password = $('#password').val();
    var password_confirmation = $('#password_confirmation').val();




            
            


            if (name=="") {
                $('#name').addClass('is-invalid ');
                $('.name-error').html('<strong>The name field is required.</strong>');
            }
            else{
            // $('.name-error').html('');
            if (ifverifynumber==0) {
                $('.email-error').addClass('text-danger ');
                $('.email-error').html('<strong>Please verify your number</strong>');
            }else{

              if(!class_type){
                $('.class_type-error').addClass('text-danger ');
                $('.class_type-error').html('<strong>Choose your age group</strong>');
            }else{
                if(class_type=="k12"){
                if(!class_name){
                    $('.class_name-error').addClass('text-danger ');
                    $('.class_name-error').html('<strong>This field is required</strong>');
                }else{
                if(board==""){
                    $('.board-error').addClass('text-danger ');
                    $('.board-error').html('<strong>Board is required</strong>');
                }else{
                                    
        $.ajax({
          type:'POST',
          url:'{{ route("password.user_login") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'name':name,'email':mobile,'class_type':class_type,'class_name':class_name,'board':board,'competitive':competitive,'password':password,'password_confirmation':password_confirmation},
          success: function (response) { 
             // $('.otp-row').show(); 
             // $('.login-btn').show();
              //$('.otp-btn').hide(); 
              $('#email').attr('readonly',true);
              $('#email').removeClass('is-invalid ');
              $('.email-error').html('');
              $('#user-otp').addClass('is-valid');                  
              //$('.otp-error').html('<strong>'+response.message+'</strong>');
              if(response.status=='done'){
                window.location='{{url("/")}}';
              }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          { 
            response = JSON.parse(XMLHttpRequest.responseText);
            if(response.errors.name){
                $('#name').addClass('is-invalid ');
                $('.name-error').html('<strong>'+response.errors.name[0]+'</strong>');
            }
            if(response.errors.password){
                $('#password').addClass('is-invalid ');
                $('.password-error').html('<strong>'+response.errors.password[0]+'</strong>');
            }
            if(response.errors.class_type){
                //alert(response.errors.class_type[0]);
                $('.class_type-error').addClass('text-danger ');
                $('.class_type-error').html('<strong>'+response.errors.class_type[0]+'</strong>');
            }
          } 
      });
                }  
                }
                }

                if(class_type=="18+"){
                    if(competitive==""){
                        $('.competitive-error').addClass('text-danger ');
                        $('.competitive-error').html('<strong>Choose a exam</strong>');
                    }else{
                                        
                            $.ajax({
                            type:'POST',
                            url:'{{ route("password.user_login") }}',
                            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data:{'name':name,'email':mobile,'class_type':class_type,'class_name':class_name,'board':board,'competitive':competitive,'password':password,'password_confirmation':password_confirmation},
                            success: function (response) { 
                                // $('.otp-row').show(); 
                                // $('.login-btn').show();
                                //$('.otp-btn').hide(); 
                                $('#email').attr('readonly',true);
                                $('#email').removeClass('is-invalid ');
                                $('.email-error').html('');
                                $('#user-otp').addClass('is-valid');                  
                                //$('.otp-error').html('<strong>'+response.message+'</strong>');
                                if(response.status=='done'){
                                    window.location='{{url("/")}}';
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) 
                            { 
                                response = JSON.parse(XMLHttpRequest.responseText);
                                if(response.errors.name){
                                    $('#name').addClass('is-invalid ');
                                    $('.name-error').html('<strong>'+response.errors.name[0]+'</strong>');
                                }
                                if(response.errors.password){
                                    $('#password').addClass('is-invalid ');
                                    $('.password-error').html('<strong>'+response.errors.password[0]+'</strong>');
                                }
                                if(response.errors.class_type){
                                    //alert(response.errors.class_type[0]);
                                    $('.class_type-error').addClass('text-danger ');
                                    $('.class_type-error').html('<strong>'+response.errors.class_type[0]+'</strong>');
                                }
                            } 
                        });
                    }
                }
                
                if(class_type=="other" || class_type=="industrial" || class_type=="college"){
                            $.ajax({
                            type:'POST',
                            url:'{{ route("password.user_login") }}',
                            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data:{'name':name,'email':mobile,'class_type':class_type,'class_name':'','board':'','competitive':'','password':password,'password_confirmation':password_confirmation},
                            success: function (response) { 
                                // $('.otp-row').show(); 
                                // $('.login-btn').show();
                                //$('.otp-btn').hide(); 
                                $('#email').attr('readonly',true);
                                $('#email').removeClass('is-invalid ');
                                $('.email-error').html('');
                                $('#user-otp').addClass('is-valid');                  
                                //$('.otp-error').html('<strong>'+response.message+'</strong>');
                                if(response.status=='done'){
                                    window.location='{{url("/")}}';
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) 
                            { 
                                response = JSON.parse(XMLHttpRequest.responseText);
                                if(response.errors.name){
                                    $('#name').addClass('is-invalid ');
                                    $('.name-error').html('<strong>'+response.errors.name[0]+'</strong>');
                                }
                                if(response.errors.password){
                                    $('#password').addClass('is-invalid ');
                                    $('.password-error').html('<strong>'+response.errors.password[0]+'</strong>');
                                }
                                if(response.errors.class_type){
                                    //alert(response.errors.class_type[0]);
                                    $('.class_type-error').addClass('text-danger ');
                                    $('.class_type-error').html('<strong>'+response.errors.class_type[0]+'</strong>');
                                }
                            } 
                        });
                    
                }
            }  
    }  
}
});
let timerOn = true;
function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;

  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;

  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }

  // Do timeout stuff here
  //alert('Timeout for otp');
  //
  //window.location.reload();
  $('#resend-otp').html('');
  $('#resend-otp').html('Resend OTP <span id="timer"></span>');
  $('#resend-otp').attr('disabled',false);
  $('#resend-otp').removeClass('btn-danger');
  $('#resend-otp').addClass('btn-success');

 
}
</script>
<script>
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function FunctionForclass_name_type(workval) {
    if (workval=="k12") {
        $("#show_for_k12").show();
        $("#show_for_18").hide();
    }
    if (workval=="18+") {
        $("#show_for_18").show();
        $("#show_for_k12").hide();
    }
    if (workval=="other" || workval=="industrial" || workval=="college") {
        $("#show_for_18").hide();
        $("#show_for_k12").hide();
    }
}
function opensignup() {
  document.getElementById("login").style.display = "block";
  document.getElementById("signup").style.display = "none";
}
 </script>  

@endsection

