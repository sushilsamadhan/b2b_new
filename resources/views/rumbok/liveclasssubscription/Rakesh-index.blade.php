@extends('rumbok.app')

@section('content')


    <!-- Breadcrumb Section Starts -->
    <section class="heading-n-breadcrub-part bg-form-live-class">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-md-6">
                  <div class="logo-part-live-class">
                     <img src="{{asset('asset_rumbok/images/logo-part.png')}}"/>
                  </div>
                  <div class="live-class-header-content">
                     <h3>Secure marks in your Term II Examination</h3>
                     <p>Structured, Holistically scaled Live Online Classroom Program</p>
                  </div>
               </div>
               <div class="col-md-6">
                <div class="form-register-now">
                   <h3 class="text-center"><span class="font-weight-normal">Attend live classes by</span></br> India's top Educators</h3>
                   <form class="" name="live_subscription"  action="{{route('liveclasssubscription.store')}}" method="POST">
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
                        </div>
                     </div>
                     <div class="col-md-12 otp-row" style="display:none;">
                        <div class="form-group">
                           <div class="d-flex align-items-center">
                              <input class="form-control form-control-sm  @error('otp') is-invalid @enderror" type="text" id="user-otp" name="user-otp" placeholder="Enter OTP*" maxlength="6" required/>
                              <span class="invalid-feedback otp-error" role="alert"></span>
                              <a href="javascript:void(0);" id="verifyBtn" class="send-otp ml-auto">Verify OTP</a>
                           </div>
                        </div>
                     </div>
                     
                        <div class="col-md-12 other_forms_fields" style="display:none;">
                           <div class="form-group">
                              <input class="form-control form-control-sm @error('name') is-invalid @enderror" 
                              type="text" id="name" name="name" placeholder="Enter Name of the student*" required/>
                              @error('name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                           </div>
                        </div>
                        <div class="col-md-6 other_forms_fields" style="display:none;">
                           <div class="form-group">
                              <input type="email" class="form-control form-control-sm" name="email" placeholder="Enter Student Email"/>
                           </div>
                        </div>
                        <div class="col-md-6 other_forms_fields" style="display:none;">
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
                        <div class="col-md-6 other_forms_fields" style="display:none;">
                           <div class="form-group">
                              <select name="class_name" id="class_name" class="form-control form-control-sm @error('class_name') is-invalid @enderror selectpicker"
                              required="required">
                                 <option>Select Class*</option>
                                 <option value="Class 11">Class 11</option>
                                 <option value="Class 12">Class 12</option>
                              </select>
                              @error('class_name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                           </div>
                        </div>
                        <div class="col-md-6 other_forms_fields" style="display:none;">
                           <div class="form-group">
                              <select name="stream" id="stream" class="form-control form-control-sm @error('stream') is-invalid @enderror" required="required">
                                 <option>Select Stream*</option>
                                 <option value="Art">Art</option>
                                 <option value="Commerce">Commerce</option>
                                 <option value="Science">Science</option>
                              </select>
                              @error('stream') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                           </div>
                        </div>

                     <div class="col-md-12"><input type="submit" id="book_free_trial" value="Subscribe For Free Live Classes" class="btn-free-trial-class" disabled></div>
                  </div>
               </form>
                </div>
               </div>
            </div>
         </div>
      </section>
    <!-- Course Details Section Starts -->
    <section class="py-3 bg-white section-team ">
    <div class="section-tittle">
<h2 class="key-highlights-text">Highlights of <span class="aakash-color">OLE</span><span class="byjus-color">xpert’s</span> Live Program </h2>
</div>
        <div class="container">
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter">
                     <div class="col-sm-6">
                     <img src="{{asset('asset_rumbok/new/images/live-online-class.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image key-align-left">
                     </div>
                     <div class="col-sm-6 bg-color1 keyhighlight-text">
                        <div>
                        <h2 class="highlight-card-title margin-alignment">Live Online Classes</h2>
                        <h5 class="highlight-card-text">Join interactive live classes for a better conceptual understanding by <b>India's best</b> faculty just by staying at home. </h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter reverse">
                     <div class="col-sm-6 bg-color2 keyhighlight-text">
                        <div>
                           <h2 class="highlight-card-title margin-alignment">Experienced Mentors</h2>
                           <h5 class="highlight-card-text">Experienced mentors to assist and review your progress for better and continuous improvement.</h5>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <img src="{{asset('asset_rumbok/new/images/live-online-class-2.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image ">
                     </div>
                  </div>
               </div>
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter">
                     <div class="col-sm-6">
                     <img src="{{asset('asset_rumbok/new/images/instant-doubt-clearence.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image key-align-left">
                     </div>
                     <div class="col-sm-6 bg-color1 keyhighlight-text">
                        <div>
                        <h2 class="highlight-card-title margin-alignment">Instant Doubt Clearance</h2>
                        <h5 class="highlight-card-text">Live chat feature has been introduced to resolve your doubts during and after classes by Subject experts for a stronger conceptual understanding. </h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter reverse">
                     <div class="col-sm-6 bg-color2 keyhighlight-text">
                        <div>
                           <h2 class="highlight-card-title margin-alignment">Chapterwise Recorded Lectures</h2>
                           <h5 class="highlight-card-text">Missed lectures can easily be accessed by accessing recordings of live classes. No more Hindrances in your preparation.</h5>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <img src="{{asset('asset_rumbok/new/images/recorded-videos.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image ">
                     </div>
                  </div>
               </div>
               <div class="keyhighlight-alignment">
                  <div class="row no-gutter">
                     <div class="col-sm-6">
                     <img src="{{asset('asset_rumbok/new/images/previous-year-question-paper.jpg')}}" alt-text="key-highlightsection-image" class="highlight-image key-align-left">
                     </div>
                     <div class="col-sm-6 bg-color1 keyhighlight-text">
                        <div>
                        <h2 class="highlight-card-title margin-alignment">Previous 20 Years Question Papers</h2>
                        <h5 class="highlight-card-text">Previous year's questions papers are mapped on the current curriculum which helps in improving the overall coherence of a course of study and its effectiveness.</h5>
                        </div>
                     </div>
                  </div>
               </div>
        </div>


        
    </section>

<section class="clearfix bg-info py-3">
   <div class="section-tittle">
      <h2 class="key-highlights-text text-white">The <span class="text-white">OLE</span><span class="text-white">xpert’s</span> Edge </h2>
   </div>
   <div class="container">
      <div class="owl-carousel owl-theme hp-package-slider">
         <div class="item">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>India's Top Faculty</h3>
                  <p>Learn from our experienced faculties, where they deliver the top-of-the-line knowledge and confidence to help you make your world better.</p>
               </div>
            </div>
         </div>
         <div class="item">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Bilingual Approach for Lecture Delivery</h3>
                  <p>Bilingual approach offers an alternative tool in order to enhance the learners' language ability. We are diversified to teach bilingually enabling learners across India to comprehend & upgrade knowledge with ease in Hindi & English.</p>
               </div>
            </div>
         </div>
         <div class="item">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Interactive Learning Content</h3>
                  <p>Expertly designed learning content assists the students to enhance their learning process. Download chapter-wise study notes and improve your performance.</p>
               </div>
            </div>
         </div>
         <div class="item">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Mind Maps for Quick Revision</h3>
                  <p>Mind Maps are a visual representation of information. Enhance student study activity with mind mapping. Here you will get topics-wise mind maps of all subjects for quick revision.</p>
               </div>
            </div>
         </div>
         <div class="item">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Real-time Based Test Series</h3>
                  <p>Test series serve as an important self-assessment tool for all who want to score good marks in the examination. Here learners will get real time experience to increase selection chances by 14x. </p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="clearfix py-5 edge-content">
   <div class="container">
      <div class="row no-gutter">
         <div class="col-md-6">
            <img src="{{asset('asset_rumbok/new/images/mukesh-sir.jpg')}}" alt-text="" class="aakash-content">
         </div>
         <div class="col-md-6 text-block">
            <div>
               <h2 class="edge-content-tittle text-uppercase"><span class="orange-color">WE BELIEVE</span><br> <span class="blue-color">We work</span> <br><span class="red-color">We conquer</span></h2>
               <h5 class="edge-content-text">"We believe Hard Work, Commitment, Personal Care &amp; Proper Planning
      have made Aakash - a Brand that is associated with Quality Coaching."</h5>
               <h2 class="edge-chairman-name blue-color">C.A. Mukesh Shukla</h2>
               <h5 class="edge-chairman-designation">Chairman &amp; Managing Director</h5>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="clearfix bg-info py-3 mb-5">
   <div class="section-tittle">
      <h2 class="key-highlights-text text-white">Our Guiding Principles</h2>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Student-driven Learning</h3>                 
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Think and work holistically</h3>                 
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Focus on value</h3>                 
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Emphasizing Quality</h3>                 
               </div>
            </div>
         </div>
      </div>
      
   </div>
</section>



<section class="latest-updates">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-12">
            <div class="testimonial-section">
               <h2 class="sec-title mb-5">What Student Says?</h2>
               <div class="testimonial-slider owl-carousel">
               
                     
                        <div class="item">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" data-src="https://olexpert.org.in/public/storage/thumbnail/testimonial/Mlhf2cvIsuCPfhqS3mONialhE8dMHwLGNhscEeYW.jpg" alt="Saurabh" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
                                 <h5>Saurabh</h5>
                                 <span>Student</span>
                              </div>
                              <p>
                                 OLExpert’s videos make the concepts interesting and understandable. By attending their live sessions I solved all my subjective queries.
                              </p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" alt="Akansha" src="https://olexpert.org.in/public/storage/thumbnail/testimonial/Q1wzg3wuXMGjM9Sgu1Vfe3hPFvgAlvXee5fYltv1.jpg" style="display: block;">
                                 <h5>Akansha</h5>
                                 <span>Student</span>
                              </div>
                              <p>
                                 Customization in package selection makes this platform different and unique.  I customized and bought a package of my choice.
                              </p>
                           </div>
                        </div>
                        <div class="item ">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" alt="Vishwas" src="https://olexpert.org.in/public/storage/thumbnail/testimonial/RsC4zUKCAQkAOs7s3aMyiXYij782baf44qufte7E.jpg" style="display: block;">
                                 <h5>Vishwas</h5>
                                 <span>Student</span>
                              </div>
                              <p>
                                 By joining the live sessions at OLExpert, I get all my doubts cleared. This platform provides me the experience of a personalized learning experience.
                              </p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" alt="Rishi" src="https://olexpert.org.in/public/storage/thumbnail/testimonial/9GjDZ49IISgv3ASSxp3906UTPo6Ngcbnt6Hvd9ba.jpg" style="display: block;">
                                 <h5>Rishi</h5>
                                 <span>Student</span>
                              </div>
                              <p>
                                 OLExpert will boost your exam preparation with extensive courses by the best educators.  At this platform I got understandable tips and tricks of typical questions.
                              </p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" alt="Anjali" src="https://olexpert.org.in/public/storage/thumbnail/testimonial/WYVy75zBnNfvaoGdwAVGgyBwBZSzmK3jgKWgUIBy.jpg" style="display: block;">
                                 <h5>Anjali</h5>
                                 <span>Instructor</span>
                              </div>
                              <p>
                                 I do believe in clearing concepts. I have seen that here at OLExpert, experts are used to teach from very basic.
                              </p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" alt="Saurabh" src="https://olexpert.org.in/public/storage/thumbnail/testimonial/Mlhf2cvIsuCPfhqS3mONialhE8dMHwLGNhscEeYW.jpg" style="display: block;">
                                 <h5>Saurabh</h5>
                                 <span>Student</span>
                              </div>
                              <p>
                                 OLExpert’s videos make the concepts interesting and understandable. By attending their live sessions I solved all my subjective queries.
                              </p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" alt="Akansha" src="https://olexpert.org.in/public/storage/thumbnail/testimonial/Q1wzg3wuXMGjM9Sgu1Vfe3hPFvgAlvXee5fYltv1.jpg" style="display: block;">
                                 <h5>Akansha</h5>
                                 <span>Student</span>
                              </div>
                              <p>
                                 Customization in package selection makes this platform different and unique.  I customized and bought a package of my choice.
                              </p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" alt="Vishwas" src="https://olexpert.org.in/public/storage/thumbnail/testimonial/RsC4zUKCAQkAOs7s3aMyiXYij782baf44qufte7E.jpg" style="display: block;">
                                 <h5>Vishwas</h5>
                                 <span>Student</span>
                              </div>
                              <p>
                                 By joining the live sessions at OLExpert, I get all my doubts cleared. This platform provides me the experience of a personalized learning experience.
                              </p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" alt="Rishi" src="https://olexpert.org.in/public/storage/thumbnail/testimonial/9GjDZ49IISgv3ASSxp3906UTPo6Ngcbnt6Hvd9ba.jpg" style="display: block;">
                                 <h5>Rishi</h5>
                                 <span>Student</span>
                              </div>
                              <p>
                                 OLExpert will boost your exam preparation with extensive courses by the best educators.  At this platform I got understandable tips and tricks of typical questions.
                              </p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" alt="Anjali" src="https://olexpert.org.in/public/storage/thumbnail/testimonial/WYVy75zBnNfvaoGdwAVGgyBwBZSzmK3jgKWgUIBy.jpg" style="display: block;">
                                 <h5>Anjali</h5>
                                 <span>Instructor</span>
                              </div>
                              <p>
                                 I do believe in clearing concepts. I have seen that here at OLExpert, experts are used to teach from very basic.
                              </p>
                           </div>
                        </div>
                        <div class="item">
                           <div class="testimonial-item h-100">
                              <div class="testi-author">
                                 <img class="lazy" alt="Saurabh" src="https://olexpert.org.in/public/storage/thumbnail/testimonial/Mlhf2cvIsuCPfhqS3mONialhE8dMHwLGNhscEeYW.jpg" style="display: block;">
                                 <h5>Saurabh</h5>
                                 <span>Student</span>
                              </div>
                              <p>
                                 OLExpert’s videos make the concepts interesting and understandable. By attending their live sessions I solved all my subjective queries.
                              </p>
                           </div>
                        </div>
                  
                  
                  
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-12">
            <div class="blog-section">
               <h2 class="sec-title mb-5">FAQs</h2>
               
               <div class="faq_area section_padding_130" id="faq">
                     <div class="row justify-content-center">
                           <!-- FAQ Area-->
                           <div class="col-12">
                              <div class="accordion faq-accordian" id="faqAccordion">
                                 <div class="card mb-1 border">
                                       <div class="card-header" id="headingOne">
                                          <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">What is NEP 2020? Does OLExpert work on the Principles of NEP 2020? <span class="lni-chevron-up"></span></h6>
                                       </div>
                                       <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                          <div class="card-body">
                                             <p>NEP 202 is an education system that contributes to an equitable and vibrant knowledge society, by providing high-quality education to all. It develops a deep sense of respect towards the fundamental rights, duties, and Constitutional values bonding with one’s country, and conscious awareness of one’s role and responsibilities in a changing world. Yes, OLExpert works on the Principle of  NEP 2020. </p>
                                          </div>
                                       </div>
                                 </div>
                                 <div class="card mb-1 border">
                                       <div class="card-header" id="headingTwo">
                                          <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">What is OLExpert’s Live Program? <span class="lni-chevron-up"></span></h6>
                                       </div>
                                       <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                                          <div class="card-body">
                                             <p>OLExpert's Live program allows interaction with students through chats and comments, which helps to make the class more dynamic, encourages debate, and allows immediate answers to questions. Under this program, students will score good marks in their exams and improve their academic performance. </p>
                                          </div>
                                       </div>
                                 </div>
                                 <div class="card mb-1 border">
                                       <div class="card-header" id="headingFour">
                                          <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">Who can be a part of the Live program? Can students get the demo classes? <span class="lni-chevron-up"></span></h6>
                                       </div>
                                       <div class="collapse" id="collapseFour" aria-labelledby="headingFour" data-parent="#faqAccordion">
                                          <div class="card-body">
                                             <p>This program is open to students currently studying in 10th & 12th and preparing for the term II examination. Yes! Students can attend the demo classes free. </p>
                                          </div>
                                       </div>
                                 </div>
                                 <div class="card mb-1 border">
                                       <div class="card-header" id="heading5">
                                          <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">What extra components students will get for their exam preparation?  <span class="lni-chevron-up"></span></h6>
                                       </div>
                                       <div class="collapse" id="collapse5" aria-labelledby="heading5" data-parent="#faqAccordion">
                                          <div class="card-body">
                                             <p>1. Recorded Lectures</p>
                                             <p>2. Mind Maps</p>
                                             <p>3. Real-time based Test series</p>
                                             <p>4. Chapter-wise study notes</p>
                                          </div>
                                       </div>
                                 </div>
                                 <div class="card mb-1 border">
                                       <div class="card-header" id="heading6">
                                          <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">How many classes will be there in a week? <span class="lni-chevron-up"></span></h6>
                                       </div>
                                       <div class="collapse" id="collapse6" aria-labelledby="heading6" data-parent="#faqAccordion">
                                          <div class="card-body">
                                             <p>2-3 Lectures per subject per week. The frequency may vary. </p>
                                          </div>
                                       </div>
                                 </div>
                                 <div class="card mb-1 border">
                                       <div class="card-header" id="heading7">
                                          <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">How can students ask their queries? <span class="lni-chevron-up"></span></h6>
                                       </div>
                                       <div class="collapse" id="collapse7" aria-labelledby="heading7" data-parent="#faqAccordion">
                                          <div class="card-body">
                                             <p>Students can ask their queries in chat or comment boxes.</p>
                                          </div>
                                       </div>
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
<!-- <section class="clearfix section-team">
      <div class="container">           
            <div class="row">
                <div class="col-sm-6 col-lg-4 col-xl-3 col-6">
                    <div class="single-person">
                        <div class="person-image">
                           <img class="lazy" alt="Lubna Hafeez" src="https://olexpert.org.in/public/uploads/instructor/RxxgLDuSYRBgRMzr7d1O5WfoAMYUjlzepz9W3V2w.png" style="display: inline;">
                        </div>
                        <div class="person-info text-center">
                            <h3 class="full-name">Lubna Hafeez</h3>
                            <span class="speciality d-block">Ph.D.  Scholar,  M.Sc (Zoology)</span>
                            <span class="badge badge-info">6+ Years</span><br>
                            <a href="https://olexpert.org.in/class-time-table/6" class="bisylms-btn-6">View Profile</a>
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-3 col-6">
                    <div class="single-person">
                        <div class="person-image">
                           <img class="lazy" alt="Utkarsh Tiwari" src="https://olexpert.org.in/public/uploads/instructor/egwiM2Z1uGwZGPWKVStiWImfODhmvCBzxegMGE18.png" style="display: inline;">
                        </div>
                        <div class="person-info text-center">
                            <h3 class="full-name">Utkarsh Tiwari</h3>
                            <span class="speciality d-block">B. Tech (Mechanical)</span>
                            <span class="badge badge-info">6+ Years</span><br>
                            <a href="https://olexpert.org.in/class-time-table/7" class="bisylms-btn-6">View Profile</a>
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-3 col-6">
                    <div class="single-person">
                        <div class="person-image">
                           <img class="lazy" alt="Gaurav Upadhyay" src="https://olexpert.org.in/public/uploads/instructor/msLhXsJ02PcLyLVrQ7jaNlBPNl5Sef2CpHgWCRKl.png" style="display: inline;">
                        </div>
                        <div class="person-info text-center">
                            <h3 class="full-name">Gaurav Upadhyay</h3>
                            <span class="speciality d-block">MBA</span>
                            <span class="badge badge-info">12+ Years</span><br>
                            <a href="https://olexpert.org.in/class-time-table/8" class="bisylms-btn-6">View Profile</a>
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-3 col-6">
                    <div class="single-person">
                        <div class="person-image">                                 
                            <img class="lazy" alt="Richa Ghai" src="https://olexpert.org.in/public/uploads/instructor/SORA4lfv7k8lj7eKG07Dnix6inngYqOmKAyr7pcN.png" style="display: inline;">
                        </div>
                        <div class="person-info text-center">
                            <h3 class="full-name">Richa Ghai</h3>
                            <span class="badge badge-info">25+ Years</span><br>
                            <a href="javascript:void(0);" class="bisylms-btn-6">View Profile</a>
                        </div>
                    </div>
                    
                </div>
                    
            </div>
            <div class="clearfix text-center mt-4">
                <div class="d-block">
                    <a href="https://olexpert.org.in/all-instructors" class="bisylms-btn-5">View All</a>
                </div>
            </div>
        </div>
</section> -->

    

@endsection
@section('js')
<script>
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
            $('#book_free_trial').attr('disabled',false);
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
</script>
@endsection