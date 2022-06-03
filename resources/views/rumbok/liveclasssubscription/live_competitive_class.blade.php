@extends('rumbok.app')

@section('content')


    <!-- Breadcrumb Section Starts -->
    <section class="heading-n-breadcrub-part bg-form-live-class-2">
         <div class="container">
         <div class="row align-items-center">
                   <div class="col-md-7">
                      <div class="row align-items-center">
                       <div class="col-md-4">
                        <div class="live-class-block">
                           <div class="live-text">LIVE</div>
                           <div class="free-text">FREE</div>
                           <div class="online-text-program">ONLINE CLASSROOM PROGRAM</div>
                        </div>
                       </div>
                       <div class="col-md-8">
                       <div class="mid-content">
                    <h3>OLExpert</h2>
                    <h3>Leading Learning platform for the preparation of all competitive and foundation examinations by India's top educators. </h3>
                    </div>
                       </div>
                      </div>
                   
                    
                   </div>
                   <div class="col-md-5">
                   <div class="ticker-part-2">
                        <div class="row">
                           <div class="col-md-6">
                              <h4>Offer available till<br><span>30th Mar 2022 only</span></h4>
                           </div>
                           <div class="col-md-6">
                              <section id="countdown-container" class="countdown-container">
                                    <article id="js-countdown" class="countdown">
                                       <section id="js-days" class="number"></section>
                                       <section id="js-separator" class="separator">:</section>
                                       <section id="js-hours" class="number"></section>
                                       <section id="js-separator" class="separator">:</section>
                                       <section id="js-minutes" class="number"></section>
                                       <section id="js-separator" class="separator">:</section>
                                       <section id="js-seconds" class="number"></section>
                                    </article>
                              </section>
                           </div>
                        </div>
                     </div>
                     <div class="form-register-now-2">
                        <h3 class="text-center"><span class="font-weight-normal">Book your <span class="text-uppercase font-weight-bold" style="color:#fd0000;">LIVE classes</span> by</span></br><span class="font-weight-bold text-uppercase" style="color:#101799; letter-spacing:1px;">India's Top Educators</span></h3>
                     <form class="" name="live_subscription"  action="{{route('store-Live-Competitive-Subscription')}}" method="POST">
                           @csrf 
                           <input type="hidden" name="instructor_live_class_id" value="{{(isset($instructor_live_class_id))?$instructor_live_class_id:''}}">  
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <div class="d-flex align-items-center">
                                    <input class="form-control form-control-sm  @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" placeholder="Enter your Mobile number*" maxlength="10" required/>
                                    @error('phone') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                    <span class="invalid-feedback phone-error" role="alert"></span>
                                    <span id="button-otp"><a href="javascript:void(0);" id="send-otp" class="send-otp ml-auto">Send OTP</a></span>
                                    </div>
                                    <small id="showerroreValidation" style="color:red;"></small>
                                 </div>
                              </div>
                              <div class="col-md-12 otp-row" style="display:none;">
                                 <div class="form-group">
                                    <div class="d-flex align-items-center">
                                       <input class="form-control form-control-sm  @error('otp') is-invalid @enderror" type="text" id="user-otp" name="user-otp" placeholder="Enter OTP*" maxlength="6" required/>
                                       <span class="invalid-feedback otp-error" role="alert"></span>
                                       <a href="javascript:void(0);" id="verifyBtn" class="send-otp ml-auto">Verify OTP</a>
                                    </div>
                                    <small id="showerrorefourDigitcode" style="color:red;"></small>
                                 </div>
                              </div>
                              
                                 <div class="col-md-12 other_forms_fields">
                                    <div class="form-group">
                                       <input class="form-control form-control-sm @error('name') is-invalid @enderror" 
                                       type="text" id="name" name="name" placeholder="Enter Name of the student*" required/>
                                       @error('name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-6 other_forms_fields">
                                    <div class="form-group">
                                       <input type="email" class="form-control form-control-sm" name="email" placeholder="Enter Student Email"/>
                                    </div>
                                 </div>
                                 <div class="col-md-6 other_forms_fields">
                                    <div class="form-group">
                                       <select name="state" id="state" class="form-control form-control-sm @error('state') is-invalid @enderror" required>
                                          <option>Select State*</option>
                                          @foreach($states as $item)
                                          <option value="{{$item->id}}">{{$item->state}}</option>
                                          @endforeach
                                       </select>
                                       @error('state') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-6 other_forms_fields">
                                    <div class="form-group">
                                       <select name="exam_name" id="class_name" class="form-control form-control-sm @error('class_name') is-invalid @enderror selectpicker"
                                       required="required">
                                          <option>Select Exam*</option>
                                       @php
                                       $con = ['is_compitative' => '1', 'parent_category_id' => '0'];

                                            $Competitive = \App\Model\Category::where($con)->get();
                                       @endphp
                                            @foreach($Competitive as $Competitiveval)
                                                <option value="{{ $Competitiveval->name }}">{{ $Competitiveval->name }}</option>
                                            @endforeach
                                       </select>
                                       @error('class_name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                    </div>
                                 </div>

                              <div class="col-md-12" id="checkMobileValidation">

                                 <input type="button" id="book_free_trial_checkvalidation" value="Subscribe For Free Live Classes" class="btn-free-trial-class-2">

                              </div>
                           </div>
                        </form>
                     </div>

                   </div>
                </div>
            
         </div>
      </section>


  <section class="clearfix py-3">
      <div class="container">
         <div class="section-tittle">
               <h2 class="key-highlights-text">Our statistics</h2>
         </div>
         <div class="row align-items-center" id="counter">
            <div class="col-md-3">
               <div class="stats-block color-theme-1">
               <div class="stats-block-icon"> <img src="{{asset('asset_rumbok/new/images/questions.png')}}" alt-text="" class=""></div>
               <div class="text-center"><span class="counter-value" data-count="20">10</span><span class="counter-value">Cr+</span></div>
               <div class="heading-counter-block"><h3>Total Questions</h3></div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-block color-theme-2">
               <div class="stats-block-icon"> <img src="{{asset('asset_rumbok/new/images/mind-map.png')}}" alt-text="" class=""></div>
               <div class="text-center"><span class="counter-value" data-count="700">100</span><span class="counter-value">+</span></div>
                  <div class="heading-counter-block"><h3>Total Mind Maps</h3></div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-block color-theme-3">
               <div class="stats-block-icon"> <img src="{{asset('asset_rumbok/new/images/video.png')}}" alt-text="" class=""></div>
               <div class="text-center"><span class="counter-value" data-count="4000">1000</span><span class="counter-value">+</span></div>
                  <div class="heading-counter-block"><h3>Total Videos</h3></div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="stats-block color-theme-4">
               <div class="stats-block-icon"> <img src="{{asset('asset_rumbok/new/images/article.png')}}" alt-text="" class=""></div>
               <div class="text-center"><span class="counter-value" data-count="800">100</span><span class="counter-value">+</span></div>
                  <div class="heading-counter-block"><h3>Total Articles</h3></div>
               </div>
            </div>
         </div>
      </div>
  </section>    

  <section class="clearfix bg-info py-3 mb-5">
   <div class="section-tittle">
      <h2 class="key-highlights-text text-white text-uppercase">Watch</span>.<span>Learn</span>.<span>Perform</span></h2>
   </div>
   <div class="container">
      <div class="row">
         
         <div class="col-md-12">
            <div class="row">
               <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                  <div class="expert-edge-block h-100 p-1">
                     <div class="icon-expert-edge"><img src="{{asset('asset_rumbok/new/images/live-class.png')}}" alt-text="" class=""></div>
                     <div class="content-expert-edge">
                        <h3 style="font-size:17px;">Free Live Classes</h3>                 
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                  <div class="expert-edge-block h-100 p-1">
                     <div class="icon-expert-edge"><img src="{{asset('asset_rumbok/new/images/recorded-video.png')}}" alt-text="" class=""></div>
                     <div class="content-expert-edge">
                        <h3 style="font-size:17px;">Recorded Video Lectures</h3>                 
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                     <div class="expert-edge-block h-100 p-1">
                        <div class="icon-expert-edge"><img src="{{asset('asset_rumbok/new/images/short-tricks.png')}}" alt-text="" class=""></div>
                        <div class="content-expert-edge">
                           <h3  style="font-size:17px;">Interesting short tricks</h3>                 
                        </div>
                     </div>
               </div>  
               <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                     <div class="expert-edge-block p-1">
                        <div class="icon-expert-edge"><img src="{{asset('asset_rumbok/new/images/mock-test.png')}}" alt-text="" class=""></div>
                        <div class="content-expert-edge">
                           <h3 style="font-size:17px;">Mock test based on the real-time exam pattern</h3>                 
                        </div>
                     </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                  <div class="expert-edge-block h-100 p-1">
                     <div class="icon-expert-edge"><img src="{{asset('asset_rumbok/new/images/mind-maps.png')}}" alt-text="" class=""></div>
                     <div class="content-expert-edge">
                        <h3 style="font-size:17px;">Mind maps</h3>                 
                     </div>
                  </div>
               </div> 
               <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                  <div class="expert-edge-block h-100 p-1">
                     <div class="icon-expert-edge"><img src="{{asset('asset_rumbok/new/images/analysis.png')}}" alt-text="" class=""></div>
                     <div class="content-expert-edge">
                        <h3 style="font-size:17px;">Performance analysis</h3>                 
                     </div>
                  </div>
               </div> 
               <div class="col-lg-4 col-md-4 col-sm-6 mb-2 offset-md-4">
                  <div class="expert-edge-block h-100 p-1">
                     <div class="icon-expert-edge"><img src="{{asset('asset_rumbok/new/images/interative-class.png')}}" alt-text="" class=""></div>
                     <div class="content-expert-edge">
                        <h3 style="font-size:17px;">Interactive Learning Classes</h3>                 
                     </div>
                  </div>
               </div> 
            </div>
         </div>
      </div>
      
      
   </div>
</section>
    <!-- Course Details Section Starts -->
    <section class="py-3 bg-white section-team ">
    <div class="section-tittle">
<h2 class="key-highlights-text">Highlights of <span class="aakash-color">OL</span><span class="byjus-color">Expert</span> Live Program </h2>
</div>
        <div class="container">
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter">
                     <div class="col-sm-6">
                     <img src="{{asset('asset_rumbok/new/images/live-online-class.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image key-align-left">
                     </div>
                     <div class="col-sm-6 bg-color1 keyhighlight-text">
                        <div>
                        <h2 class="highlight-card-title margin-alignment">Free Live Sessions</h2>
                        <h5 class="highlight-card-text">Live classes allow interaction with students through chats and comments, which helps to make the class more dynamic, encourages debate, and allows immediate answers to questions.</h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter reverse">
                     <div class="col-sm-6 bg-color2 keyhighlight-text">
                        <div>
                           <h2 class="highlight-card-title margin-alignment">Mock Tests</h2>
                           <h5 class="highlight-card-text">Mock tests are informal examinations taken as a preparation for an actual or formal examination. Our mock test panel looks and feels like the actual exam, so it is a good way to familiarize yourself with the test-taking experience.</h5>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <img src="{{asset('asset_rumbok/new/images/mock-test.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image ">
                     </div>
                  </div>
               </div>
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter">
                     <div class="col-sm-6">
                     <img src="{{asset('asset_rumbok/new/images/mind-maps.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image key-align-left">
                     </div>
                     <div class="col-sm-6 bg-color1 keyhighlight-text">
                        <div>
                        <h2 class="highlight-card-title margin-alignment">Mind Maps</h2>
                        <h5 class="highlight-card-text">Mind mapping is simply a diagram used to visually represent or outline information. This feature can turn a long list of monotonous information into a colorful, memorable, and highly organized diagram that works in line with your brain's natural way of doing things.</h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter reverse">
                     <div class="col-sm-6 bg-color2 keyhighlight-text">
                        <div>
                           <h2 class="highlight-card-title margin-alignment">Daily Current Affairs and study notes</h2>
                           <h5 class="highlight-card-text">For a better perspective and understanding of the particular current news, we provide day-to-day current affairs PDFs. Apart from this, learners will get topic-wise content for easy learning. The PDFs of daily current affairs are downloadable and understandable.</h5>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <img src="{{asset('asset_rumbok/new/images/current-affairs.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image ">
                     </div>
                  </div>
               </div>
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter">
                     <div class="col-sm-6">
                     <img src="{{asset('asset_rumbok/new/images/performance.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image key-align-left">
                     </div>
                     <div class="col-sm-6 bg-color1 keyhighlight-text">
                        <div>
                        <h2 class="highlight-card-title margin-alignment">Performance Analysis</h2>
                        <h5 class="highlight-card-text">Performance analysis is the process by which learners identify and respond to problems and opportunities, through the study of individuals and their organization to determine an appropriate solvent system.</h5>
                        </div>
                     </div>
                  </div>
               </div>
        </div>
    </section>
<section class="clearfix py-5">
   <div class="container">
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter reverse">
                     <div class="col-sm-6">
                        <div class="clearfix py-3 px-5">
                           <h2 class="heading-type-custom">Why OLExpert?</h2>
                           <p>Ensure a quick Preparation with adaptive Learning</p>
                           <ul class="custom-check-icon-list">
                              <li>Free live classes</li>
                              <li>Experienced educator</li>
                              <li>Day to Day Current Affairs</li>
                              <li>Real-Time Based Mock test</li>
                              <li>Mind Maps for Quick Revision.</li>
                              <li>Shortcuts, Tips & Tricks for complex topics</li>
                              <li>Specific live sessions to help students prepare for exams.</li>
                              <li>Topicwise Study Material Targeted for your examination.</li>
                              <li>Understandable explanation of heavy concepts & terminologies.</li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <img src="{{asset('asset_rumbok/new/images/why-ole.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image ">
                     </div>
                  </div>
               </div>
               
   </div>

</section>

<section class="clearfix py-5 bg-light">
   <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                     <h2 class="mb-3">Exams we cover? Ensure a Quick Preparation with Adaptive Learning!</h2>
                     </div>
                     <div class="col-sm-6">
                        <div class="clearfix">
                           
                           <ul class="custom-check-icon-list">
                              <li>Indian Institutes of Technology - Joint Entrance Examination (IIT-JEE)</li>
                              <li>National Eligibility cum Entrance Test (NEET)</li>
                              <li>Common-Law Admission Test (CLAT)</li>
                              <li>National Democratic Alliance (NDA)</li>
                              <li>Combined Defence Services (CDS)</li>
                              <li>Indian Air Force (IAF)</li>
                              <li>Union Public Service Commission (UPSC) Pre - Mains.</li>
                              <li>State - Provincial Civil Service (S PCS)</li>
                              <li>Staff Selection Commission Junior Engineers (SSC JE)</li>
                              <li>Staff Selection Commission - Combined Graduate Level (SSC CGL)</li>
                              <li>Staff Selection Commission Combined - Higher Secondary Level Exam (SSC CHSL)</li>
                              <li>Staff Selection Commission - Central Police Organisation (SSC CPO)</li>
                              <li>Railways Recruitment Board - Junior Engineer (RRB JE)</li>
                              <li>Railways Recruitment Board  - National Thermal Power Corporation (RRB NTPC)</li>
                              
                           </ul>
                        </div>
                     </div>
                     <div class="col-sm-6">
                     <ul class="custom-check-icon-list">
                              <li>State Review Officer (RO)/Assistant Review Officer (ARO)</li>
                              <li>Delhi Police</li>
                              <li>State Police</li>
                              <li>Common Admission Test (CAT)</li>
                              <li>Institute of Banking Personnel Selection - Specialist Officers (IBPS SO)</li>
                              <li>Institute of Banking Personnel Selection - Probationary Officer (IBPS PO)</li>
                              <li>Institute of Banking Personnel Selection - Clerk</li>
                              <li>State Bank of India- Specialist Officer (SBI SO)</li>
                              <li>State Bank of India Probationary Officer (SBI PO)</li>
                              <li>SBI Clerk</li>
                              <li>Graduate Record Examinations (GRE)</li>
                              <li>Graduate Management Admission Test (GMAT)</li>
                              <li>International English Language Testing System (IELTS)</li>
                              <li>Test of English as a Foreign Language (TOEFL)</li>
                              <li>Scholastic Assessment Test (SAT), and many more.</li>
                           </ul>
                     </div>
                  </div>
   </div>

</section>

<section class="clearfix py-5 bg-white">
   <div class="container">
                  <div class="row">
                     
                     <div class="col-sm-4">
                        <div class="clearfix">
                        <h4 class="mb-3">One-stop solution for all your learning needs - Introducing “OLExpert App”</h4>
                        <p>OLExpert is an expert in creating an online interface that helps you make a smooth transition. Our vast clan of experts with a plethora of knowledge & experience collectively works on a common goal of upgrading India. Keeping this thing in mind OLExpert has launched its App, from where learners can get all their respective learning needs in just one Click. </p>
                        </div>
                     </div>
                     <div class="col-sm-8">
                     <ul class="custom-check-icon-list">
                              <li>Class-wise recorded Lectures with easy & understandable chapter material.</li>
                              <li>Live Sessions for instant doubt clearance.</li>
                              <li>Current pattern-based Mock/Practice Test with in-depth performance analysis.</li>
                              <li>One-to-one mentoring & doubt clearing by experts.</li>
                              <li>Revolutionize Teacher, student, and parent connection by technology.</li>
                              <li>Active networking platform among institutes, schools, and colleges for content sharing.</li>
                              <li>Career Guidance to resolve career-related confusion.</li>
                              <li>Teacher Training Programs to upgrade them with the latest trends and technologies.</li>
                              <li>Conduct online workshops and seminars for Project-Based Learning.</li>
                           </ul>
                     </div>
                  </div>
   </div>

</section>






    

@endsection
@section('js')
<script>
$(document).on('change', '#class_name', function(){
   var selectedClass = $(this).val();
   if(selectedClass != 'Class 10'){
      $("#stream").prop('required',true);
      $('#stream').attr('disabled',false);
   }else{
      $('#stream').attr('disabled',true);
      $("#stream").prop('required',false);
   }
});
$(document).on('click', '#send-otp,#resend-otp', function(){    
    var mobile = $('#phone').val();
    $.ajax({
          type:'POST',
          url:'{{ route("liveClass.sendOtp") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'email':mobile},
          success: function (response) { 
               $('.otp-row').show(); 
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          { 
            response = JSON.parse(XMLHttpRequest.responseText);
            if(response.errors.email){
                $('#phone').addClass('is-invalid ');
                $('.phone-error').html('<strong>'+response.errors.email[0]+'</strong>');
            }
          } 
      });
     //}
});
$(document).on('click', '#verifyBtn', function(){
    var userOtp = $('#user-otp').val();
    var mobile = $('#phone').val();
    $('#verifyBtn').attr('disabled',true);
    if(userOtp!=''){
        $.ajax({
          type:'POST',
          url:'{{ route("liveClass.verifyOtp") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'otp':userOtp,'email':mobile},
          success: function (response) {
            $('#button-otp').hide();
            $('#phone').attr('readonly',true);
            $('.otp-row').hide(); 
            $('.other_forms_fields').show();
           // $('#book_free_trial').attr('disabled',false);

document.getElementById("checkMobileValidation").innerHTML = '<input type="submit" id="book_free_trial" value="Subscribe For Free Live Classes" class="btn-free-trial-class">';
   document.getElementById("showerroreValidation").innerHTML = '';
   document.getElementById("showerrorefourDigitcode").innerHTML = '';


          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          {  
            response = JSON.parse(XMLHttpRequest.responseText);
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
$("#book_free_trial_checkvalidation").click(function(){
   document.getElementById("showerroreValidation").innerHTML = 'Validate your mobile number';
   document.getElementById("showerrorefourDigitcode").innerHTML = 'Enter 4 digit OTP';
});

//      if($("#book_free_trial").disable){
//     alert('pppp');
// }
</script>
<script>
   $(function() {
  
  var targetDate  = new Date(Date.UTC(2022, 02, 30));
  var now   = new Date();

  window.days = daysBetween(now, targetDate);
  var secondsLeft = secondsDifference(now, targetDate);
  window.hours = Math.floor(secondsLeft / 60 / 60);
  secondsLeft = secondsLeft - (window.hours * 60 * 60);
  window.minutes = Math.floor(secondsLeft / 60 );
  secondsLeft = secondsLeft - (window.minutes * 60);
  console.log(secondsLeft);
  window.seconds = Math.floor(secondsLeft);

  startCountdown();
});
var interval;

function daysBetween( date1, date2 ) {
  //Get 1 day in milliseconds
  var one_day=1000*60*60*24;

  // Convert both dates to milliseconds
  var date1_ms = date1.getTime();
  var date2_ms = date2.getTime();

  // Calculate the difference in milliseconds
  var difference_ms = date2_ms - date1_ms;
    
  // Convert back to days and return
  return Math.round(difference_ms/one_day); 
}

function secondsDifference( date1, date2 ) {
  //Get 1 day in milliseconds
  var one_day=1000*60*60*24;

  // Convert both dates to milliseconds
  var date1_ms = date1.getTime();
  var date2_ms = date2.getTime();
  var difference_ms = date2_ms - date1_ms;
  var difference = difference_ms / one_day; 
  var offset = difference - Math.floor(difference);
  return offset * (60*60*24);
}



function startCountdown() {
  $('#input-container').hide();
  $('#countdown-container').show();
  
  displayValue('#js-days', window.days);
  displayValue('#js-hours', window.hours);
  displayValue('#js-minutes', window.minutes);
  displayValue('#js-seconds', window.seconds);

  interval = setInterval(function() {
    if (window.seconds > 0) {
      window.seconds--;
      displayValue('#js-seconds', window.seconds);
    } else {
      // Seconds is zero - check the minutes
      if (window.minutes > 0) {
        window.minutes--;
        window.seconds = 59;
        updateValues('minutes');
      } else {
        // Minutes is zero, check the hours
        if (window.hours > 0)  {
          window.hours--;
          window.minutes = 59;
          window.seconds = 59;
          updateValues('hours');
        } else {
          // Hours is zero
          window.days--;
          window.hours = 23;
          window.minutes = 59;
          window.seconds = 59;
          updateValues('days');
        }
        // $('#js-countdown').addClass('remove');
        // $('#js-next-container').addClass('bigger');
      }
    }
  }, 1000);
}


function updateValues(context) {
  if (context === 'days') {
    displayValue('#js-days', window.days);
    displayValue('#js-hours', window.hours);
    displayValue('#js-minutes', window.minutes);
    displayValue('#js-seconds', window.seconds);
  } else if (context === 'hours') {
    displayValue('#js-hours', window.hours);
    displayValue('#js-minutes', window.minutes);
    displayValue('#js-seconds', window.seconds);
  } else if (context === 'minutes') {
    displayValue('#js-minutes', window.minutes);
    displayValue('#js-seconds', window.seconds);
  }
}

function displayValue(target, value) {
  var newDigit = $('<span></span>');
  $(newDigit).text(pad(value))
    .addClass('new');
  $(target).prepend(newDigit);
  $(target).find('.current').addClass('old').removeClass('current');
  setTimeout(function() {
    $(target).find('.old').remove();
    $(target).find('.new').addClass('current').removeClass('new');
  }, 900);
}

function pad(number) {
  return ("0" + number).slice(-2);
}
</script>

<script>
   var a = 0;
$(window).scroll(function() {

  var oTop = $('#counter').offset().top - window.innerHeight;
  if (a == 0 && $(window).scrollTop() > oTop) {
    $('.counter-value').each(function() {
      var $this = $(this),
        countTo = $this.attr('data-count');
      $({
        countNum: $this.text()
      }).animate({
          countNum: countTo
        },

        {

          duration: 2000,
          easing: 'swing',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
            //alert('finished');
          }

        });
    });
    a = 1;
  }

});
</script>
@endsection