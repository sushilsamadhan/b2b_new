<div role="tabpanel" class="tab-pane Active" id="work">
                            @php $i = 1;
                            $j = 1;
                            $k = 1;
                            $p =1;
                            $s= 1;
                            $n = 1;
							$a= 1;
                            $mockTestSectionQuestions = \App\MockTestSectionQuestion::where(['mock_test_master_id'
                            =>$mockTestSection->mock_test_master_id ,'mock_test_section_id' => $mockTestSection->id])->get(); @endphp

                            @foreach($mockTestSectionQuestions as $mockTestSectionQuestion)
                            @php
                            $studentTestQuestions =
                            \App\StudentTestQuestion::where('id',$mockTestSectionQuestion->student_test_question_id)->first();
                            @endphp

                            <div class="row col-md-12 content" id="content-{{$j++ }}"
                                data-count="{{ $mockTestSectionQuestions->count() }}" data-question="{{ $mockTestSectionQuestion->student_test_question_id}}" data-section="{{ $mockTestSection->id }}" data-id="{{ $k++ }}"
                                style={{ ($p++ == 1)? "display:block!important" : 'display:none!important'}}>
                                <hr size="8" width="100%" color="blue">
                                <div class="col-md-5">
                                    Question {{ $i++}}:
                                </div>
                                <div class="col-md-3">
                                    <button class="button"> Time: <label id="minutes1{{$s++}}"
                                            class="minutes">00</label>:<label id="seconds1{{$n++}}"
                                            class="seconds">00</label></button>
                                </div>
                                <div class="col-md-4">
                                    <button class="button">Marks:<span style="color:green;">+1 </span> <span
                                            style="color:red;">-0 </span></button>&nbsp; &nbsp;
                                    <a href="#" data-toggle="modal"
                                        data-target="#myModal{{ $studentTestQuestions->id }}">Report</a>

                                </div>
                                <hr size="8" width="100%" color="blue">
                                <div id="sidebar">
                                    @if($studentTestQuestions->question_type == 1)
                                    @php
                                    $getQuestions = \App\Option::where('question_id',$studentTestQuestions->id)->get();
                                    @endphp
                                    <span class="">{{ strip_tags($studentTestQuestions->body) }} </span> </br>
                                        @foreach($getQuestions as $getQuestion)
                                            <input type="radio" class="ans_button" data-buttonColor="{{ $a++ }}" id="X" name="ans-{{ $studentTestQuestions->id }}" value="{{ $getQuestion->id }}"> {{ strip_tags($getQuestion->option_title) }} </br>
                                        @endforeach
                                    @endif
                                    @if($studentTestQuestions->question_type == 3)

                                    @endif
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
						    