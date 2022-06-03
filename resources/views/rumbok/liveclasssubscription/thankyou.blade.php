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
                     <h3>Secure marks in your Term II Examination for class 10th and 12th (CBSE / ICSE)</h3>
                     <p>Structured, Holistically scaled Live Online Classroom Program</p>
                  </div>
               </div>
               <div class="col-md-6">
                <div class="form-register-now">
                  <div class="thank-you-message text-center p-3">
                        @if (Session::has('message'))
                                {!! Session::get('message') !!}
                        @endif
                        
                         @if(Session::has('instructor') && !empty(Session::get('instructor')))
                            <?php 
                              
                              $instructor = Session::get('instructor');

                           ?>
                         @endif
                           @if(isset($instructor) && !empty($instructor))
                              @if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructor->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructor->end_time) )
                                <?php $instructor_live_class_id = base64_encode($instructor->id); ?>
                                 <a class="btn btn-success btn-sm py-1 line-height-1"  href='{{ url("live-class/".$instructor_live_class_id) }}'>Join Now</a>
                              @else
                                 <?php $instructor_live_class_id = base64_encode($instructor->id); ?>
                                 <a class="btn btn-success btn-sm py-1 line-height-1"  href='{{ url("get-live-class") }}'>Join Now</a>
                           @endif
                        @endif
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
               <h5 class="edge-content-text">"Keep yourself motivated if you really want to achieve your goals. Innovations do not come easy, they tackle time, mistakes, and a lot of motivation to become successful."</h5>
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
         <div class="col-lg-3 col-md-3 col-sm-6 mb-2">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Student-driven Learning</h3>                 
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6 mb-2">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Think and work holistically</h3>                 
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6 mb-2">
            <div class="expert-edge-block h-100">
               <div class="icon-expert-edge"></div>
               <div class="content-expert-edge">
                  <h3>Focus on value</h3>                 
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-6 mb-2">
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


<?php 
    $testimonials = \App\Model\Testimonial::orderby('id', 'desc')->get();
?>
<section class="latest-updates">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-12">
            <div class="testimonial-section">
               <h2 class="sec-title mb-5">What Student Says?</h2>
               <div class="testimonial-slider owl-carousel">
                      @foreach($testimonials as $testimonial)
								<div class="testimonial-item h-100">
									<div class="testi-author">
                                        @if($testimonial->image)
										    <img src="{{ asset('storage/'.$testimonial->image) }}" alt="" />
                                        @else
                                            <img src="{{ asset('asset_rumbok/new/images/no_image.png') }}" alt="" />
                                        @endif
										<h5>{{ $testimonial->name }}</h5>
										<span>{{ $testimonial->type }}</span>
									</div>
									<p>
                                    {!! $testimonial->description !!}
									</p>
								</div>
                      @endforeach
								
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


    

@endsection
