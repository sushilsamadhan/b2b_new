<div class="col-lg-9">
                <!--Category -->
                <div class="row">
                    <div class="col-lg-1">
                        <p class="font-weight-bold mr-3">Sections</p>
                    </div>
                    <div class="col-lg-8">
                        <div class="scroller scroller-left"><i class="fa fa-arrow-left"></i></div>
                        <div class="scroller scroller-right"><i class="fa fa-arrow-right"></i></div>
                            <div class="wrapper">
                                <ul class="nav nav-tabs mb-0 list border-0" role="tablist" id="myTab">
                                    @foreach($mockTest->mockTestSection as $mockTestSection)
                                 
                                    @php $start_section_time = date("H", strtotime($mockTestSection->section_time));
                 
                                         $middel_section_time = date("i", strtotime($mockTestSection->section_time));
                                        
                                         $end_section_time = date("s", strtotime($mockTestSection->section_time));
                                    @endphp
                                    <input type="hidden" data-start_section_time="{{ $start_section_time }}" id="start_section_time" class="button"
                            value="{{ $start_section_time }}">
                        <input type="hidden" data-middel_section_time="{{ $middel_section_time }}" id="middel_section_time" class="button middel_section_time"
                            value="{{ $middel_section_time }}">
                        <input type="hidden" data-end_section_time="{{ $end_section_time }}" id="end_section_time" class="button"
                            value="{{ $end_section_time }}">
         
                                    <li role="presentation" class="nav-item" data-tab="{{ $mockTestSection->id }}">
                                        <a href="#work{{ $mockTestSection->id }}" role="tab" class="nav-link {{ $mockTestSection->id == $mockTestSectionId->id ? 'active' : ''}} tabvalues btn btn-outline-primary border rounded btn-sm"  data-tabactive="{{ $mockTestSection->id }}" data-toggle="tab">
                                            {{ $mockTestSection->section_name }}<br> 
                                            <span class="section_days" style="display:none">0</span> <span class="section_hours">0</span> :
                                            <span class="section_minutes">0</span> : <span class="section_seconds">0</span>
                          
                                        </a>
                                        
                                    </li>                            
                                    @endforeach                              
                                </ul>
                            </div>
                    </div>
                    <div class="col-lg-3">
                    <div class="row">
                            <div class="col-md-4"><p class="small">View In:</p> </div>
                            <div class="col-md-8">
                                <select class="form-control">
                                    <option> English </option>
                                    <option> Hindi </option>
                                </select>
                            </div>
                    </div>
                    </div>
                </div>
                <hr width="100%">
                <div class="show content-holder">

                    <div class="tab-content"  >
                    
                <div role="tabpanel" class="tab-pane Active" id="work">
                            @php $i = 1;
                            $j = 1;
                            $k = 1;
                            $p =1;
                            $s= 1;
                            $n = 1;
							$a= 1;
                            $mockTestSectionQuestions = \App\MockTestSectionQuestion::where(['mock_test_master_id'
                            =>$mockTestSectionId->mock_test_master_id ,'mock_test_section_id' => $mockTestSectionId->id])->get(); @endphp

                            @foreach($mockTestSectionQuestions as $mockTestSectionQuestion)
                            @php
                            $studentTestQuestions =
                            \App\StudentTestQuestion::where('id',$mockTestSectionQuestion->student_test_question_id)->first();
                            @endphp

                            <div class="clearfix content" id="content-{{$j++ }}"
                                data-count="{{ $mockTestSectionQuestions->count() }}" data-question="{{ $mockTestSectionQuestion->student_test_question_id}}" data-section="{{ $mockTestSectionId->id }}" data-id="{{ $k++ }}"
                                style={{ ($p++ == 1) ? "display:block!important" : 'display:none!important'}}>
                               <div class="row">
                                <div class="col-md-5">
                                    Question {{ $i++}}:
                                </div>
                                <div class="col-md-3">
                                    <button class="button"> Time: <label id="minutes1{{$s++}}"
                                            class="minutes mb-0">00</label>:<label id="seconds1{{$n++}}"
                                            class="seconds mb-0">00</label></button>
                                </div>
                                <div class="col-md-4 text-right">
                                    <button class="button">Marks:<span style="color:green;">+1 </span> <span
                                            style="color:red;">-0 </span></button>&nbsp; &nbsp;
                                    <a href="#" data-toggle="modal"
                                        data-target="#myModal{{ $studentTestQuestions->id }}">Report</a>

                                </div>
                               </div>
                                <hr width="100%">
                                <div id="sidebar" class="clearfix">
                                    <div class="row">
                                    <div class="col-lg-12">
                                        @if($studentTestQuestions->question_type == 1)
                                            @php
                                            $getQuestions = \App\Option::where('question_id',$studentTestQuestions->id)->get();
                                            @endphp
                                            <p class="mb-3 font-weight-bold text-dark"><span class="">{{ strip_tags($studentTestQuestions->body) }} </span></p>
                                            @foreach($getQuestions as $getQuestion)
                                                <div class="answer-option"><label class="ans-sec"><input type="radio" class="ans_button" data-buttonColor="{{ $a++ }}"  name="ans-{{ $studentTestQuestions->id }}"  value="{{ $getQuestion->id }}"> {{ strip_tags($getQuestion->option_title) }} <span class="checkmark"></span></label></div>
                                            @endforeach
                                        @endif                                 
                                    </div>
                                    <!-- @if($studentTestQuestions->question_type == 3)
                                    @php
                                        $comprehensionQuestions = \App\ComprehensionQuestion::where('student_test_question_id' , $studentTestQuestions->id)->get();
                                    @endphp
                                    <div class="col-lg-6">
                                            <p class="small font-weight-bold text-dark"><u>Comprehension</u></p>

                                            <p class="text-dark"><strong>Direction : </strong>  </p>
                                                {{ strip_tags($studentTestQuestions->body) }}
                                            </div>
                                        <div class="col-lg-6">
                                            <p class="small font-weight-bold text-dark"><u>Questions</u></p>
                                        @foreach($comprehensionQuestions as $comprehensionQuestion)
                                            @php $getQuestions = \App\Option::where(['question_id' => $comprehensionQuestion->student_test_question_id , 'passage_question_id' => $comprehensionQuestion->id ])->get();
                                            @endphp
                                            
                                            <p class="mb-3 font-weight-bold text-dark"><span class="">{{ strip_tags($comprehensionQuestion->question_title) }} </span></p>
                                            @foreach($getQuestions as $getQuestion)
                                                <div class="answer-option"><label class="ans-sec"><input type="radio" class="ans_button" data-buttonColor="{{ $a++ }}"  name="ans-{{ $comprehensionQuestion->id }}"  value="{{ $getQuestion->id }}"> {{ strip_tags($getQuestion->option_title) }} <span class="checkmark"></span></label></div>
                                            @endforeach
                                        @endforeach    
                                    </div>
                                    
                                    @endif
                                        -->
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->

                            <div class="modal fade" id="myModal{{ $studentTestQuestions->id}}" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <select class="form-control">
                                                    <option>Type Of Error</option>
                                                    <option>Wrong Question</option>
                                                    <option>Wrong Options</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <textarea class="form-control"
                                                    row="10">Please write your error here..</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Submit
                                                Report</button>
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Tab panes -->

                            @endforeach
                        </div>
                    </div>
                    <div class="clearfix py-3 mt-3 border-top border-bottom">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-outline-dark mark_review_next" id="">Mark for review & Next</button>
                            <button class="btn btn-outline-dark" id="showbacks">Clear Response </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-success next" id="">Save & Next</button>
                            <button type="button" class="btn btn-danger back" id="">Back</button>
                            <a class="btn btn-primary ready" href="{{ route('mock-test-start',$mockTest->id)}}"
                                id="show222" style="display:none" disabled>I am ready to begin</a>
                        </div>
                    </div>
                    </div>
                </div>





                <!-- end col-lg-8 -->
                <!-- end row -->

                <!-- end card-content-wrapper -->
            </div>
            @php $i = $j= $r = $k = 1;
            $mockTestSectionQuestions = \App\MockTestSectionQuestion::where(['mock_test_master_id' => $mockTest->id
            ,'mock_test_section_id' => $mockTestSectionId->id])->get(); @endphp

            <div class="col-lg-3">

                <div class="clearfix" id="product-10">
                    <div class="clearfix bg-dark">
                        <div class="user-name-image text-center"> 
                            <div class=" d-flex align-items-center">
                            <div class="user-img-thumb"></div>
                            <div class="user-name-text">{{\Illuminate\Support\Facades\Auth::user()->name }}</div>
                            </div>
                        </div>
                      <div class="p-3">
                        <div class="row">
                         
                        <div class="col-lg-4 px-2">
                            <span class="d-flex align-items-center"> <span class="badge badge-warning mr-1" id="marked">0</span><span class="text-white small">Marked</span></span>
                        </div>
						<div class="col-lg-4 px-2">
                        <span class="d-flex align-items-center"> <span class="badge badge-info mr-1" id="notVisited"></span> <span class="text-white small">Not visited</span></span>
                        </div>
						
                        <div class="col-lg-4 px-2">
                        <span class="d-flex align-items-center"> <span class="badge badge-success mr-1" id="answered">0</span> <span class="text-white small">Attempted</span></span>
                        </div>
                        <div class="col-lg-6 px-2">
                        <span class="d-flex align-items-center"> <span class="badge badge-primary mr-1">0</span> <span class="text-white small">Marked & Answered</span></span>						 
						</div>
						<div class="col-lg-6 px-2">
                        <span class="d-flex align-items-center"> <span class="badge badge-danger mr-1" id="visited">0</span> <span class="text-white small">Not Answered</span></span>
                        </div>
                        </div>
                      </div>
                    </div>

                    <div class="mb-3 p-2 bg-danger text-white" style="">
                        Sections :{{ $mockTestSectionId->section_name }} 
                    </div>

                    <div class="row next1selector">
                    
                    @foreach($mockTestSectionQuestions as $mockTestSectionQuestion)
                    @php
                    $studentTestQuestions =\App\StudentTestQuestion::where('id',$mockTestSectionQuestion->student_test_question_id)->first();
                    @endphp
                    <div class="col-2">
                    	<button type="button" class="btn btn-secondary next1 mb-1 btn-sm btn-block px-1"  data-test="{{ $r++ }}"  value="{{ $j++ }}" data-question="{{ $studentTestQuestions->id }}" data-section="{{ $mockTestSection->id }}" id="">{{ $i++ }}</button>
                    </div>
                    @endforeach
                    </div>
					<button class="btn btn-primary col-lg-12 mt-2">Intructions</button>
                    <button class="btn btn-primary col-lg-12 mt-2 submit_form" id="confirmModal"   data-toggle="modal" data-target="#GSCCModal" style="background-color:#0a1b48">Submit Test</button>

                    <div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
                                <h4 class="modal-title" id="myModalLabel"></h4>
                            </div>
                            <div class="modal-body">
                                <h6>Are you sure submit your test ?</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-success">Yes</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




						    