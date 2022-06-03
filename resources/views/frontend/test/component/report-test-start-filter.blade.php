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
                            <div class="clearfix" id="">
                               <div class="row">
                                <div class="col-md-5">
                                    Question {{ $i++}}:
                                </div>
                                <div class="col-md-3">
                                    <!-- <button class="button"> Time: <label id="minutes1{{$s++}}"
                                            class="minutes mb-0">00</label>:<label id="seconds1{{$n++}}"
                                            class="seconds mb-0">00</label></button> -->
                                </div>
                                <!-- <div class="col-md-4 text-right">
                                    <button class="button">Marks:<span style="color:green;">+1 </span> <span
                                            style="color:red;">-0 </span></button>&nbsp; &nbsp;
                                    </div> -->
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
                                                <div class="answer-option"><label class="ans-sec"><input type="radio" class="ans_button"  id="form_id" data-buttonColor="{{ $a++ }}"  name="ans-{{ $studentTestQuestion->question_id }}"  value="{{ $getQuestion->id }}"> {{ html_entity_decode(strip_tags($getQuestion->option_title)) }} <span class="checkmark"></span></label></div>
                                            @endforeach
                                        @endif                                 
                                    </div>
                                   
                                    </div>
                                </div>
                            </div>

                           

                            @endforeach
                        </div>
                    </div>
                    <!-- <div class="clearfix py-3 mt-3 border-top border-bottom"> -->
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-outline-dark mark_review_next" id="">Mark for review & Next</button>
                            <button class="btn btn-outline-dark clearResponse" id="showbacks">Clear Response </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-success next" id="">Save & Next</button>
                        </div>
                    </div> -->
                    <!-- </div> -->
                </div>
                <!-- end col-lg-8 -->
                <!-- end row -->

                <!-- end card-content-wrapper -->
            </div>
           




						    