<div class="col-lg-9">
                <!--Category -->
                <div class="row">
                    <div class="col-lg-9">
                    @if(Request::segment(1) == 'unit-test-start')
                    <p class="font-weight-bold mr-3">Unit Test</p>
                    @elseif(Request::segment(1) == 'chapter-test-start')
                    <p class="font-weight-bold mr-3">Chapter Test</p>
                    @else
                    <p class="font-weight-bold mr-3">Subject Test</p>
                    @endif
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

                    <div class="tab-content">
                    
                <div role="tabpanel" class="tab-pane Active" id="work">
                            @php $i = 1;
                            $j = 1;
                            $k = 1;
                            $p =1;
                            $s= 1;
                            $n = 1;
							$a= 1;
                            @endphp
                            @foreach($studentTestQuestions as $studentTestQuestion)
                            <div class="clearfix content" id="content-{{$j++ }}"
                                data-count="{{ $studentTestQuestions->count() }}" data-question="{{ $studentTestQuestion->question_id }}" data-section="{{ $packageDetail->id }}" data-id="{{ $k++ }}"
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
                                    <a href="#" class="GetReport" data-package_id="{{ $packageDetail->id }}" data-question_id="{{ $studentTestQuestion->question_id }}" data-toggle="modal"
                                        data-target="#myModal{{ $studentTestQuestion->question_id }}">Report</a>
                                </div>
                               </div>
                                <hr width="100%">
                                <div id="sidebar" class="clearfix">
                                    <div class="row">
                                    <div class="col-lg-12">
                                    @php $studentQuestion = \App\StudentTestQuestion::where('id' , $studentTestQuestion->question_id)->first(); @endphp
                                        @if($studentQuestion->question_type == 1)
                                            @php
                                            $getQuestions = \App\Option::where('question_id',$studentTestQuestion->question_id)->get();
                                            @endphp
                                            <p class="mb-3 font-weight-bold text-dark"><span class="">{{ html_entity_decode(strip_tags($studentQuestion->body)) }}  </span></p>
                                            @foreach($getQuestions as $getQuestion)
                                                <div class="answer-option"><label class="ans-sec"><input type="radio" class="ans_button" data-buttonColor="{{ $a++ }}"  name="ans-{{ $studentTestQuestion->question_id }}"  value="{{ $getQuestion->id }}"> {{ htmlspecialchars_decode(strip_tags($getQuestion->option_title)) }} <span class="checkmark"></span></label></div>
                                            @endforeach
                                        @endif                                 
                                    </div>
                                   
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->

                            <div class="modal fade" id="myModal{{ $studentTestQuestion->question_id}}" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                        </div>
                                        <form action="{{ route('update-error-report')}}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" id="question" name="question_id">
                                            <input type="hidden" id="package" name="package">
                                            @if(Request::segment(1) == 'unit-test-start')
                                            <input type="hidden" id="" name="type" value="unit"> 
                                            @elseif(Request::segment(1) == 'chapter-test-start')
                                            <input type="hidden" id="" name="type" value="chapter"> 
                                            @else
                                            <input type="hidden" id="" name="type" value="subject"> 
                                            @endif
                                            
                                            <div class="col-md-12">
                                                <select class="form-control" name="type_error">
                                                    <option >Type Of Error</option>
                                                    <option value="wrong_question">Wrong Question</option>
                                                    <option value="wrong_option">Wrong Options</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <textarea class="form-control" name="error" row="10"></textarea>
                                            </div>
                                        </div>
                                       
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit
                                                Report</button>
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                        </form>
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
                            <button class="btn btn-outline-dark clearResponse" id="showbacks">Clear Response </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-success next" id="">Save & Next</button>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- end col-lg-8 -->
                <!-- end row -->

                <!-- end card-content-wrapper -->
            </div>
            @php $i = $j= $r = $k = 1;
            @endphp

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
                        <span class="d-flex align-items-center"> <span class="badge badge-info mr-1" id="notVisited">0</span> <span class="text-white small">Not visited</span></span>
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
                    Subject :{{ $packageDetail->subjectName->title }} 
                    </div>
                   <div class="clearfix px-3 scroll-bar-div">
                    <div class="row next1selector">
                    
                    @foreach($studentTestQuestions as $studentTestQuestion)
                   
                    <div class="col-2">
                    	<button type="button" class="btn btn-secondary next1 mb-1 btn-sm btn-block px-1 {{ $studentTestQuestion->attempt_status == 'V' ? 'addRad':'' }} {{ $studentTestQuestion->attempt_status == 'M' ? 'addYelleow':'' }} {{ $studentTestQuestion->attempt_status == 'A' ? 'addGreen':'' }}"   data-test="{{ $r++ }}"  value="{{ $j++ }}" data-question="{{ $studentTestQuestion->question_id }}" data-section="{{ $packageDetail->id }}" id="">{{ $i++ }}</button>
                    </div>
                    @endforeach
                    </div>
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
                                <button type="button "  value="{{ $packageDetail->id }}" class="btn btn-success submitFinalReport" data-toggle="modal" data-target="#myModal">Yes</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div id="GSCCModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
                                <h4 class="modal-title" id="myModalLabel"></h4>
                            </div>
                            <div class="modal-body">
                                <h6>You reached all questions are you want to submit ?</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                <button type="button "  value="{{ $packageDetail->id }}" class="btn btn-success submitFinalReport" data-toggle="modal" data-target="#myModal">Yes</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




						    