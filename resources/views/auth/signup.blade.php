@extends(themeManager().'.app')
@section('content')
    <!-- ================================
         START SIGN UP AREA
  ================================= -->
    @if(themeManager() == 'rumbok')
        <!-- Breadcrumb Section Starts -->
        <section class="breadcrumb-section">
            <div class="breadcrumb-shape">
                <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
                     class="hero-round-shape-2 item-moveTwo">
                <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape"
                     class="hero-plus-sign item-rotate">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>@translate(Register )</h2>
                        <div class="breadcrumb-link margin-top-10">
                            <span><a href="{{url('/')}}">@translate(home)</a> / @translate(Register)</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Login student Section Starts -->
        <section class="login-section padding-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login-image">
                            <img src="{{asset('asset_rumbok/images/login-image.jpg')}}" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="login-form">
                            <h3>@translate(signup) <span>@translate(now)</span></h3>

                            @if(env('GOOGLE_APP_ID') != "")
                                <div class="google-button">
                                    <a href="{{ url('/auth/redirect/google') }}" class="template-button"><i class="fa fa-google"></i> @translate(google)</a>
                                </div>
                                <span class="separator">@translate(or)</span>

                            @endif
                            <div class="login-tab d-none">
                                <div class="tab">
                                    <ul>
                                        <li class="tab-one active">
                                            <a href="#" class="template-button-2">admin</a>
                                        </li>
                                        <li class="tab-second">
                                            <a href="#" class="template-button-2">instructor</a>
                                        </li>
                                        <li class="tab-three">
                                            <a href="#" class="template-button-2">student</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content margin-top-30">
                                <div class="tab-one-content lost active">
                                    <form method="post" action="{{ route('student.create') }}" autocomplete="off" id="student-register-form">
                                        @csrf
                                        <div class="col-lg-12">
                                                We will send one time password (OTP) on this Mobile number
                                                </div>
                                          <div class="col-lg-12">
                                              <div class="input-box">
                                                  <label class="label-text">@translate(Phone Number)<span class="primary-color-2 ml-1">*</span></label>
                                                  
                                                  <div class="form-group">
                                                      <input class="form-control @error('email') is-invalid @enderror" id="email" type="number" name="email" placeholder="@translate(Phone Number)" value="{{ old('email') }}" maxlength="10" autocomplete="off">
                                                    <span class="invalid-feedback email-error" role="alert">
                                                    </span>
                                                  </div>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12" id="name-row" style="display:none;">
                                              <div class="input-box">
                                                  <label class="label-text">@translate(Full Name)<span class="primary-color-2 ml-1">*</span></label>
                                                  
                                                  <div class="form-group">
                                                      <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="@translate(Full Name)" value="{{ old('name') }}"  autocomplete="off">
                                                    <span class="invalid-feedback name-error" role="alert">
                                                    </span>
                                                  </div>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12 otp-row" style="display:none;">
                                              <div class="input-box">
                                                  <label class="label-text">@translate(OTP)<span class="primary-color-2 ml-1">*</span></label>
                                                  
                                                  <div class="form-group">
                                                      <input class="form-control @error('otp') is-invalid @enderror" id="user-otp" type="text" name="user-otp" placeholder="@translate(OTP)" value="" maxlength="4" autocomplete="off">
                                                    <span class="invalid-feedback otp-error" role="alert">
                                                        <strong></strong>
                                                    </span>
                                                  </div>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12 otp-btn">
                                              <div class="btn-box">
                                                  <button class="theme-btn" id="send-otp" type="button">@translate(Send OTP)</button>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12 resend-otp-btn text-right" style="display:none;">
                                              <div class="btn-box">
                                                  <button class="btn btn-danger btn-sm" id="resend-otp" type="button">Resend OTP in <span id="timer"></span></button>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12 verify-btn"  style="display:none;">
                                              <div class="btn-box">
                                                  <button class="theme-btn" id="verifyBtn" type="button">@translate(Verify)</button>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12 login-btn"  style="display:none;">
                                              <div class="btn-box">
                                                  <button class="theme-btn" id="loginBtn" type="button">@translate(Submit)</button>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    @endif

    <!-- ================================
           START SIGN UP AREA
    ================================= -->
@endsection

@section('js')

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
                $('#email').addClass('is-invalid ');
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
             // $('.otp-btn').hide(); 
              $('#email').attr('readonly',true);
              $('#email').removeClass('is-invalid ');
              $('.email-error').html('');
              $('#user-otp').addClass('is-valid'); 
              $('.otp-error').removeClass('text-danger');
              $('.otp-error').addClass('text-success');                 
              $('.otp-error').html('<strong>'+response.message+'</strong>');
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
    var name = $('#name').val();
    var mobile = $('#email').val();
    //$('#loginBtn').attr('disabled',true);
    //if(name!=''){
        $.ajax({
          type:'POST',
          url:'{{ route("password.user_login") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'name':name,'email':mobile},
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
          } 
      });
    //}
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

@endsection

