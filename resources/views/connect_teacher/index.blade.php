@extends('rumbok.app')
@section('content') 
<link rel="stylesheet" type="text/css" href="{{ asset('captcha/captcha.css') }}" >    

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <style>
      .gj-timepicker-bootstrap [role=right-icon] button {
    width: 38px;
    position: relative;
    border: 1px solid #ddd;
}
.gj-picker [role=header] [role=mode] span {
  line-height:24px;
  font-size:13px;
}
.gj-picker.timepicker [role=header] {
    font-size: 40px;
}
.gj-timepicker-bootstrap [role=right-icon] button .gj-icon, .gj-timepicker-bootstrap [role=right-icon] button .material-icons {
  top: 5px;
}
</style>
    <section class="py-3">
            <div class="container bg-light rounded border shadow-lg">
              <div class="row no-gutter">
                <div class="col-md-6">
                  <div class="clearfix px-4">
                            <form class="needs-validation" method="post" id="connect-with-us" action="{{ route('connect_teacher_uspost') }}" novalidate>
                                        <div class=" my-2">
                                            @csrf
                                            <h3>Become Tutor</h3>
                                              @if (session('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('success') }}
                                                </div>
                                              @endif
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group mb-2">
                                                  <label class="text-inverse font-weight-bold small" for="name">Name<span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control form-control-sm" pattern="^[\pL\s\-]+$" id="name" placeholder="Full Name" name="name" required>
                                                  @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                              </div>
                                          </div>
                                          
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="text-inverse font-weight-bold small" for="phone">Phone<span class="text-danger">*</span></label>
                                                  <input type="text" id="phone" class="form-control form-control-sm" placeholder="Phone No." maxlength="10" pattern="[6-9]{1}[0-9]{9}" name="phone" required>
                                                  <div class="invalid-feedback">
                                                    Please Enter Valid Mobile No.
                                                  </div>
                                                  @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="text-inverse font-weight-bold small" for="email" >Email<span class="text-danger">*</span></label>
                                                  <input type="email" id="email" class="form-control form-control-sm" placeholder="Email" name="email" required>
                                                  @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                              </div>
                                          </div>
                                          
                                        </div>
                                        <div class="row">
                                        
                                        <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="text-inverse font-weight-bold small" for="qualification" >Qualification<span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control form-control-sm" id="qualification" placeholder="Qualification" name="qualification" required >
                                                  @error('qualification')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="text-inverse font-weight-bold small" for="subject" >Subject<span class="text-danger">*</span></label>
                                                  <input type="text" id="subject" class="form-control form-control-sm"  placeholder="Subject" name="subject"  required>
                                                  @error('subject')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                              </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                              
                                          </div>
                                           <div class="col-md-6">
                                                 <div class="form-group mb-2">
                                                    <label class="text-inverse font-weight-bold small" for="day">Select Day<span class="text-danger">*</span></label>
                                                    <select id="select-day" id="day" class="form-control form-control-sm" name="day" required>
                                                          <option value="" disabled selected>Select Day</option>
                                                          <option value="Sunday">Sunday</option>
                                                          <option value="Monday">Monday</option>
                                                          <option value="Tuesday">Tuesday</option>
                                                          <option value="Wednesday">Wednesday</option>
                                                          <option value="Thursday">Thursday</option>
                                                          <option value="Friday">Friday</option>
                                                          <option value="Saturday">Saturday</option>
                                                          @error('day')
                                                          <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                 </div>
                                           </div>
                                           <div class="col-md-6">
                                             <div class="row">
                                               <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                  <label class="text-inverse font-weight-bold small" for="day">From<span class="text-danger">*</span></label>
                                                  <input type="text" id="timepicker1" name="starttime" placeholder="HH:MM" min="09:00" max="18:00" class="form-control form-control-sm" required>
                                                </div>
                                               </div>
                                               <div class="col-md-6">
                                               <div class="form-group mb-2">
                                               <label class="text-inverse font-weight-bold small" for="day">To<span class="text-danger">*</span></label>
                                                 <input type="text" id="timepicker2" name="endtime" placeholder="HH:MM" min="09:00" max="18:00" class="form-control form-control-sm" required>
                                                 @error('starttime')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                                  @error('endtime')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                               </div>
                                               </div>
                                             </div>
                                             
                                           </div>
                                          
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                  <label class="text-inverse font-weight-bold small" for="pincode">Pincode<span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control form-control-sm" id="pincode" maxlength="6" pattern="[0-9]{6}" placeholder="Pincode" name="pincode"  required>
                                                  @error('pincode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="text-inverse font-weight-bold small" for="location">Location<span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control form-control-sm" id="location" placeholder="Location" name="location" required >
                                                  @error('location')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                              </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                  <label class="text-inverse font-weight-bold small" for="city" >City<span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control form-control-sm" minlength="2"  id="city" placeholder="City" name="city" required>
                                                  @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                               <div class="form-group">
                                                  <label class="text-inverse font-weight-bold small" for="state" >State<span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control form-control-sm" minlength="2" id="state" placeholder="State" name="State" required>
                                                  @error('State')
                                                    <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                              </div>
                                          </div>
                                        </div>
                                        
                                        <div class="row">
                                          <div class="col-md-12">
                                          <label class="text-inverse font-weight-bold small" for="UserCaptchaCode" >Captcha<span class="text-danger">*</span></label>
                                          </div>
                                          <div class="col-md-6">
                                                  <div class='CaptchaWrap form-group text-left'>
                                                    <div id="CaptchaImageCode" class="CaptchaTxtField">
                                                      <canvas id="CapCode" class="capcode" width="300" height="80"></canvas>
                                                    </div> 
                                                    <input type="button" class="ReloadBtn" onclick='CreateCaptcha();'>
                                                  </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                        
                                                        <input type="text" id="UserCaptchaCode" class="form-control form-control-sm" placeholder='Enter Captcha' required>
                                                        <span id="WrongCaptchaError" class="error"></span>
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
                <div class="col-md-6">
                  <img src="{{ asset('asset_rumbok/new/images/become-a-tutor.jpg') }}" class="img-fluid"/>
                </div>
              </div>
            </div>
          
            <div class="row">
                <div class="col-sm-10">
                    <div class="contant">
                            
                         </div>
                    </div>
                                
                </div>

         </section>
    @endsection 


    @section('js')
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

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
<script src="{{asset('captcha/captcha.js')}}"></script>  
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>        -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script>
        $('#timepicker1').timepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>     
    <script>
        $('#timepicker2').timepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>     
 @stop
        