<style>
    .answer-option {
        margin-bottom: 10px;
    }

    .ans-sec {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 16px;
        color: #000;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default radio button */
    .ans-sec input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom radio button */
    .ans-sec .checkmark {
        position: absolute;
        top: 3px;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #eee;
        border-radius: 50%;
        border: 1px solid #a6a6a6;
    }

    /* On mouse-over, add a grey background color */
    .ans-sec:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .ans-sec input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* When the radio button is checked, add a blue background */
    .ans-sec input:unchecked~.checkmark {
        background-color: #219336F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .ans-sec:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .ans-sec input:checked~.ans-sec:after {
        display: block;
    }

    .addRad {
        background-color: #dc3545 !important;
    }

    .addGreen {
        background-color: #28a745 !important;
    }

    .addYelleow {
        background-color: #ffc107 !important;
    }

    /* Style the indicator (dot/circle) */
    .ans-sec .checkmark:after {
        top: 5px;
        left: 5px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: absolute;
        content: '';
        background: white;
    }

    .user-img-thumb {
        width: 40px;
        height: 40px;
        background: #fff;
        border-radius: 50%;
        margin-right: 15px;
        background-repeat: no-repeat;
        background: url(../public/asset_rumbok/images/category-icon-6-home-2.png);
        background-size: cover;
    }

    .user-name-text {
        line-height: 50px;
        color: #fff;
        font-weight: bold;
    }

    .user-name-image {
        padding: 10px 15px;
        background: #000;
    }

    .scroll-bar-div {
        max-height: 200px;
        overflow: auto;
    }

    .checkmark1 {
        background-color: #2196F3;
    }

    .main-wrapper {
        width: 100%;
        top: -40px;
    }

    .wrapper {
        position: relative;
        margin: 0 auto;
        overflow: hidden;
        padding: 5px;
        height: 50px;
    }

    .list {
        position: absolute;
        left: 0px;
        top: 0px;
        min-width: 3000px;
        margin-left: 12px;
        margin-top: 0px;
    }

    .list li {
        display: table-cell;
        position: relative;
        text-align: center;
        cursor: grab;
        cursor: -webkit-grab;
        color: #efefef;
        vertical-align: middle;
        margin-right: 4px;
    }

    .scroller {
        text-align: center;
        cursor: pointer;
        display: none;
        padding: 7px;
        padding-top: 11px;
        white-space: no-wrap;
        vertical-align: middle;
        background-color: #fff;
    }

    .scroller-right {
        float: right;
    }

    .scroller-left {
        float: left;
    }

    .answer-option {
        margin-bottom: 10px;
    }

    .header {
        padding: 10px 0;
        background: #fff;
        color: #f1f1f1;
    }

    .content {
        padding: 16px;
    }

    .fixtop {
        position: fixed;
        top: 58px;
        width: 100%;
        left: 0;
        z-index: 9999;
        border-bottom: 1px solid #ddd;
        box-shadow: 5px 5px 5px rgb(0 0 0 / 20%);
    }

    .fixtop+.content {
        padding-top: 102px;
    }

    .padd {
        padding: 158px 0;
    }

    .sq.scrolldiv:nth-child(odd) {
        background: #f5f5f5;
    }

    .sq.scrolldiv {
        position: relative;
    }

    .my-hidden-span {
        position: absolute;
        top: -200px;
        z-index: -1;
        visibility: hidden;
    }

    .custom-class {
        min-width: 260px;
        max-width: 500px;
        width: 80%;
    }
</style>
<div class="col-lg-12">

    <!--Category -->
    <div class="row">
        <div class="col-lg-9">
            <p class="font-weight-bold mr-3">Mock Test</p>
        </div>
        <div class="col-lg-3">
            <div class="row">
                <div class="col-md-4">
                    <p class="small">View In:</p>
                </div>
                <div class="col-md-8">
                    <select class="form-control">
                        <option> English </option>
                        <option> Hindi </option>
                    </select>
                </div>
            </div>

        </div>
    </div>

    <div class="clearfix">
        <div class="clearfix position-relative">
            <div class="d-flex header" id="myHeader">
                <div class="container">
                    <div class="d-flex">
                        <div class="custom-class">

                            <div class="scroller scroller-left"><i class="fa fa-arrow-left"></i></div>
                            <div class="scroller scroller-right"><i class="fa fa-arrow-right"></i></div>
                            <div class="wrapper">
                                <ul class="nav nav-tabs" id="myTab">
                                    @foreach($mockTests->mockTestSection as $key=>$mockTestSection)
                                    <li class="nav-item">
                                        <a href="#section{{ $mockTestSection->id }}" class="nav-link {{ $key == 0 ? 'active' : ''}}" data-toggle="tab">{{ $mockTestSection->section_name }}</a>
                                    </li>
                                    @endforeach
                                </ul>

                            </div>

                        </div>
                        <div class="text-right ml-auto ">
                            <a class="btn btn-success " href="{{ route('pw-mock-analytical-report' , [$packageDetail->id ,Request::segment(3)])}}">Graphical Report</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="tab-content">
                    <div id="sectionA" class="tab-pane fade show active">
                        <h3>Section A</h3>
                        <p>Aliquip placeat salvia cillum iphone...</p>
                    </div>
                    <div id="sectionB" class="tab-pane fade">
                        <h3>Section B</h3>
                        <p>Vestibulum nec erat eu nulla rhoncus fringilla...</p>
                    </div>
                    <div id="sectionC" class="tab-pane fade">
                        <h3>Section C</h3>
                        <p>Nullam hendrerit justo non leo aliquet...</p>
                    </div>
                </div> -->
        </div>
        <div role="" class="clearfix" id="work">
            @php $i = 1;
            $j = 1;
            $k = 1;
            $p =1;
            $s= 1;
            $n = 1;
            $a= 1;
            @endphp
            <div class="tab-content">
                @php $studentTestQuestionsId = $studentTestQuestions->groupBy('section_id'); @endphp
                @foreach($studentTestQuestionsId as $keys => $studentTestQuestion1)

                @php $section = \App\MockTestSection::where('id' , $keys)->first(); // echo "<pre>";print_r($studentTestQuestion1);
                    @endphp
                    
                <div id="section{{ $section->id }}" class="tab-pane fade show {{  $keys ==  $studentTestQuestions[0]['section_id']  && $keys  ? 'active': '' }}">
                    <h4 class="text-center mt-5"> Section Name : {{ $section->section_name }} </h4>
                    @php
                    $i = 1;
                    $j = 1;
                    $k = 1;
                    $p =1;
                    $s= 1;
                    $n = 1;
                    $a= 1;
                    @endphp
                    @foreach($studentTestQuestion1 as $studentTestQuestion)
                    <div class="clearfix" id="">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <p class="border-bottom text-danger border-danger"><strong>Question {{ $i++}}:</strong> </p>
                            </div>
                        </div>
                        <div id="" class="clearfix position-relative">
                            <div class="row">
                                <div class="col-lg-12">
                                    @php $studentQuestion = \App\StudentTestQuestion::where('id' , $studentTestQuestion->question_id)->first(); @endphp

                                    @if($studentQuestion->question_type == 3)
                                    @php $comprehensionQuestions = \App\StudentTestQuestion::where(['id' => $studentQuestion->parent_id])->first(); @endphp
                                    @if($comprehensionQuestions)
                                    <h5 style="color:#2626e7;">Comprehension:</h1>
                                        <span class=""><?php echo html_entity_decode($comprehensionQuestions->body) ?></span>
                                        @endif
                                        @php $getQuestions = \App\Option::where(['question_id' => $comprehensionQuestions->id , 'passage_question_id' => $studentQuestion->id ])->get(); @endphp

                                        <!-- $getQuestions = \App\Option::where('question_id',$studentTestQuestion->question_id)->get(); -->
                                        @php
                                        $getQuestionsss = \App\Option::where(['question_id'=> $comprehensionQuestions->id ,'passage_question_id' => $studentQuestion->id, 'flag_correct' => 1])->first();
                                        @endphp
                                        <p class="mb-3 font-weight-bold text-dark">

                                            <span class=""><?php echo html_entity_decode($studentQuestion->body) ?>
                                                @if($studentTestQuestion->answer_id && $getQuestionsss != '')
                                                <i class="{{ $studentTestQuestion->answer_id !=  $getQuestionsss->id ? 'fa fa-times' :'fa fa-check'}}" style="color:red;"></i>
                                            </span>
                                            @else
                                            <span style="color:red;">(Not attempted this question)</span>
                                            @endif
                                        </p>
                                        @foreach($getQuestions as $getQuestion)
                                        @if($studentTestQuestion->answer_id)
                                        <div class="answer-option"><label class="ans-sec"><input type="radio" class="ans_button" {{ $studentTestQuestion->answer_id ==  $getQuestion->id ? 'checked' :''}} id="form_id" data-buttonColor="{{ $a++ }}" name="ans-{{ $studentTestQuestion->question_id }}" value="{{ $getQuestion->id }}" disabled> {{ html_entity_decode(strip_tags($getQuestion->option_title)) }} <span class="checkmark"></span> </label>
                                        </div>
                                        @else
                                        <div class="answer-option"><label class="ans-sec"><input type="radio" class="ans_button" id="form_id" data-buttonColor="{{ $a++ }}" name="ans-{{ $studentTestQuestion->question_id }}" disabled value="{{ $getQuestion->id }}"> {{ html_entity_decode(strip_tags($getQuestion->option_title)) }} <span class="checkmark"></span></label></div>
                                        @endif
                                        @endforeach
                                        @else
                                        @php
                                        $getQuestions = \App\Option::where('question_id',$studentTestQuestion->question_id)->get(); @endphp
                                        @php
                                        $getQuestionsss = \App\Option::where(['question_id'=> $studentTestQuestion->question_id , 'flag_correct' => 1])->first();
                                        @endphp
                                        <p class="mb-3 font-weight-bold text-dark">

                                            <span class=""><?php echo html_entity_decode($studentQuestion->body) ?>
                                                @if($studentTestQuestion->answer_id && $getQuestionsss != '')
                                                <i class="{{ $studentTestQuestion->answer_id !=  $getQuestionsss->id ? 'fa fa-times' :'fa fa-check'}}" style="color:red;"></i>
                                            </span>
                                            @else
                                            <span style="color:red;">(Not attempted this question)</span>
                                            @endif
                                        </p>
                                        @foreach($getQuestions as $getQuestion)
                                        @if($studentTestQuestion->answer_id)
                                        <div class="answer-option"><label class="ans-sec"><input type="radio" class="ans_button" {{ $studentTestQuestion->answer_id ==  $getQuestion->id ? 'checked' :''}} id="form_id" data-buttonColor="{{ $a++ }}" name="ans-{{ $studentTestQuestion->question_id }}" value="{{ $getQuestion->id }}" disabled> {{ html_entity_decode(strip_tags($getQuestion->option_title)) }} <span class="checkmark"></span> </label>

                                        </div>
                                        @else
                                        <div class="answer-option"><label class="ans-sec"><input type="radio" class="ans_button" id="form_id" data-buttonColor="{{ $a++ }}" name="ans-{{ $studentTestQuestion->question_id }}" disabled value="{{ $getQuestion->id }}"> {{ html_entity_decode(strip_tags($getQuestion->option_title)) }} <span class="checkmark"></span></label></div>
                                        @endif
                                        @endforeach


                                        @endif

                                </div>

                            </div>
                        </div>
                        @if($studentQuestion->question_type == 3)
                        @php $getQuestionsss = \App\Option::where(['question_id'=> $comprehensionQuestions->id ,'passage_question_id' => $studentTestQuestion->question_id, 'flag_correct' => 1])->first();@endphp
                        @else
                        @php $getQuestionsss = \App\Option::where(['question_id'=> $studentTestQuestion->question_id , 'flag_correct' => 1])->first(); @endphp
                        @endif

                        <div class="col-md-12 mb-3">
                            <p class="border-bottom text-danger border-danger"><strong>Answer {{ $n++}}:</strong> </p>
                        </div>

                        @if($getQuestionsss)
                        <div class="alert alert-success" role="alert">
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="mb-0"><strong>Correct Answer</strong></p>
                                    <p>{{ html_entity_decode(strip_tags($getQuestionsss->option_title)) }}</p>
                                </div>
                                <div class="col-md-2">
                                    <span class="btn btn-success btn-block" onclick="openSolution(<?php echo $studentQuestion->id ?>)">Solution</span>
                                </div>
                            </div>
                            <div id="mybottomsolution{{ $studentQuestion->id }}" class="botttomsolution">
                                <div class="clearfix">
                                    <div class="container">
                                        <div class="solution-scroll-div">
                                            <h5>Solution :</h5>
                                            <?php echo html_entity_decode($studentQuestion->solution) ?>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="closebtn" onclick="closeSolution(<?php echo $studentQuestion->id ?>)">&times;</a>
                            </div>
                        </div>
                        @endif

                    </div>

                    @endforeach


                </div>

                @endforeach
                <div>
                </div>
            </div>

        </div>
        <!-- end col-lg-8 -->
        <!-- end row -->

        <!-- end card-content-wrapper -->
    </div>
    
    <script>
        window.onscroll = function() {
            myFunction()
        };

        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("fixtop");
            } else {
                header.classList.remove("fixtop");
            }
        }
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
            if (window.location.hash.length > 0) {
                window.scrollTo(0, $(window.location.hash).offset().top);
            }
        });
    </script>

    <script>
        function openSolution(reportId) {

            document.getElementById("mybottomsolution" + reportId + "").style.height = "60%";
            document.getElementById("mybottomsolution" + reportId + "").style.bottom = "0";
        }

        function closeSolution(reportId) {
            document.getElementById("mybottomsolution" + reportId + "").style.height = "0";
            document.getElementById("mybottomsolution" + reportId + "").style.bottom = "-70px";
        }
    </script>
   