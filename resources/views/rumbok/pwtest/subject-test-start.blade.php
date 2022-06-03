<style>
    .header-menu-area {
        display: none;
    }

    .button {
        background-color: #e9ecef;
        border: none;
        color: #000;
        padding: 4px 24px;
        text-align: center;
        border: 1px solid #ddd;
        text-decoration: none;
        display: inline-block !important;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .button-section {
        background-color: #233d63;
        border: 11px;
        color: #fff;
        padding: 8px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block !important;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 8px;
    }

    .btn-default {
        background-color: #7f889785 !important;
    }

    .footer-area {
        display: none;
    }

    .content {
        display: none !important;
    }

    button {
        margin-top: 30px;
    }

    .back {
        display: none !important;
    }

    .end {
        display: none !important;
    }

    .border {
        border-radius: 0px !important;
    }

    .borderss {
        border-radius: 0px !important;
        background-color: #dc3545 !important;
    }

    .borderssGreen {
        border-radius: 0px !important;
    }

    .next1selector .col-2:first-child .next1 {
        background-color: #dc3545 !important;
        /* border-radius : 12px; */
    }

    .next1:first-child {
        /* background-color:red  !important; */
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

    .ans-sec {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 16px;
        /* color:#000; */
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
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
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
        top: 8px;
        left: 8px;
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
        background: url(<?php echo url('/public/asset_rumbok/images/category-icon-6-home-2.png') ?>);
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
</style>
@extends('frontend.app')

@section('content')

<!--======================================
          START breadcrumb AREA
  ======================================-->



<!--======================================
            END breadcrumb AREA
    ======================================-->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!--======================================
            START COURSE AREA
    ====================================== padding-top-80px padding-bottom-120px-->
  
<section class="">
    <div class="row">
        <div class="col-lg-12">
            <div class="filter-bar d-flex justify-content-between align-items-center">
                <div class="clearfix">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo mr-3"><img src="{{ url('public/asset_rumbok/images/logo-ole.png') }}" style="max-width:90px" /></div>
                        <p class="font-weight-bold text-dark">
                            <span class="badge bg-primary text-white">Subject Test</span><br>
                            <?php
                                $s_course = \App\Course::find(Request::segment(3));
                            ?>
                            {{-- $s_course->title --}}
                            {{ isset($s_course)?$s_course->title:$packageDetail->subjectName->title  }}
                        </p>
                    </div>
                </div>


                <div class="clearfix">
                    <div id="countdown-container">
                        <div id="countdown" class="button">
                            <span id="days" style="display:none">0</span> <span id="hours">0</span> :
                            <span id="minutes">0</span> : <span id="seconds">0</span>
                        </div>
                    </div>
                    @php $start_time = 00;
                    $middel_time = $totalTime;
                    $end_time = 00;
                    @endphp

                    <input type="hidden" data-start_time="{{ $start_time }}" id="start_time" class="button" value="{{ $start_time }}">
                    <input type="hidden" data-middel_time="{{ $middel_time }}" id="middel_time" class="button" value="{{ $middel_time }}">
                    <input type="hidden" data-end_time="{{ $end_time }}" id="end_time" class="button" value="{{ $end_time }}">
                </div>
                <button class="button" onclick="fullscreen()">Enter Full Screen</button>
            </div>
        </div><!-- end col-lg-12 -->
    </div><!-- end row -->
    <div class="course-content-wrapper mt-4">
        <div class="container-fluid">
            {{-- sidebar --}}
           
            <div class="row" id="product-gallery-holder-2222">
           
                @include('rumbok.test.component.subject-test-start-filter')

            </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
            <h4 class="modal-title" id="myModalLabel">Test Detail</h4> -->
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center"> Test Summary</h5>
                        <p class="mt-2 mb-2">Your answer have been successfully Pleaase take a few moments to summary</p>

                        No Of Question: <span id="totalNoOfQuestion"></span></br>
                        Answered : <span id="finalanswered"></span> </br>
                        Not Answered : <span id="finalVisited"></span> </br>
                        Marked for Review : <span id="finalmarked"></span></br>
                        Marked & Answered : 0</br>
                        Not Visited : <span id="finalnotVisited"></span></br>
                    </div>
                    <div class="modal-footer">
                        @php
                        $mockTestEnrollmentcounts = \App\MockTestEnrollment::where(['user_id' => Auth::id(), 'package_id' => $packageDetail->id, 'test_status' => 'running'])->orderBy('id', 'desc')->first();
                        @endphp
                        <a href="{{ route('mock_analytical_report' ,[$packageDetail->id , $mockTestEnrollmentcounts->id]) }}" type="button" class="btn btn-success">Proceed</a>

                        <!-- @php 
            $path = Session::get('location_path');
            $path1 = Session::get('location_path1');
        @endphp
        @if($path)
            <input type="button" value="Proceed" class="btn btn-success" data-dismiss="modal" id="btnHome" 
onClick="document.location.href='https://ole.org.in/package/{{$path}}/{{$path1}}'" />
        @else
        <button onclick="goBack()" class="btn btn-success" data-dismiss="modal" id="btnHome">Proceed</button>
        @endif     -->
                    </div>
                </div>

            </div>
        </div>

</section><!-- end courses-area -->

<!--======================================
            END COURSE AREA
    ======================================-->
@endsection

@section('js')
{{-- stripe --}}
<script type="text/javascript">
    //csrf tken
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

  

  $('body').on('click', '#questionReport', function() {
      var error = $('#error').val();
      var type_error = $('#type_error').val();
      var test_type = $('#test_type').val();
      var question = $('#question').val();
      var package = $('#package').val();
      
    $.ajax({
        method: "POST",
        url: "{{ route('update-error-report') }}",
        data: {
            error: error,
            type_error: type_error,
            test_type: test_type,
            question: question,
            package: package
        },
        success: function(data) {
            $('.modal').modal('hide');
            $("#showMessage").html(data.showMessage);
           // $("#showMessage").html('report submit !');
        }
    });
      
      

  });



    var id = $('.content:visible').data('id');
    var totatCount = $('.content:visible').data('count');
    var test = 1;
    $('.content').removeAttr('style');
    $('[data-id="' + test + '"]').attr('style', 'display:block !important');
    $('.next1').removeAttr('style');
    $('[data-test="' + test + '"]').addClass('borderss');
    //$('.next1').addClass('borderss_layout');
    //$('.next1').removeAttr('style');
    //$('[data-test="' + test + '"]').attr('style', 'border-radius:0px !important; border-radius:0px !important');

    $('[data-test="' + test + '"]').attr('style', 'background:#dc3545 !important;border-radius:12px !important');

    var minutesLabel = document.getElementById("minutes1" + test + "");
    var secondsLabel = document.getElementById("seconds1" + test + "");
    var totalSeconds = 0;
    setInterval(setTime, 1000);

    function setTime() {
        ++totalSeconds;
        secondsLabel.innerHTML = pad(totalSeconds % 60);
        minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
    }

    function pad(val) {
        var valString = val + "";
        if (valString.length < 2) {
            return "0" + valString;
        } else {
            return valString;
        }
    }
    var dataId = '{{ $studentTestQuestions[0]->question_id }}';
    var dataSelection = '{{ $packageDetail->id }}';
    var pacakge_id = '{{ request()->id  }}';
    var testType = '{{Request::segment(1) }}';
    // alert(dataId)
    var type = 'visited';

    $.ajax({
        method: "POST",
        url: "{{ route('question-subject-update') }}",
        data: {
            id: dataId,
            section: dataSelection,
            type: type,
            pacakge_id: pacakge_id,
            testType: testType
        },
        success: function(data) {
            console.log(data.visited);
            $("#visited").html(data.visited);
            $("#notVisited").html(data.notVisited);
            $("#answered").html(data.answered);
            $("#marked").html(data.marked);
        }
    });
    // $("#visited").html(data.visited);
    // $("#notVisited").html(data.notVisited);
    // $("#answered").html(data.answered);

    $('body').on('click', '.submitFinalReport', function() {

        var package_id = '{{ $packageDetail->id }}';
        var testType = '{{Request::segment(1) }}';
        var section_min = $("#minutes").text();
        var section_seconds = $("#seconds").text();
        var section_hours = $("#hours").text();

        $.ajax({
            method: "POST",
            url: "{{ route('get-final-report') }}",
            data: {
                pacakge_id: pacakge_id,
                testType: testType,
                section_min: section_min,
                section_seconds: section_seconds,
                section_hours: section_hours
            },
            success: function(data) {
                $('#GSCCModal').modal('hide');
                $(".course-content-wrapper").fadeTo(200, 1);
                console.log(data.visited);
                $("#finalVisited").html(data.visited);
                $("#finalnotVisited").html(data.notVisited);
                $("#finalanswered").html(data.answered);
                $("#finalmarked").html(data.marked);
                $("#totalNoOfQuestion").html(data.totalNoOfQuestion);


            }

        });
    });
    $('body').on('click', '.next', function() {
        var id = $('.content:visible').data('id');
        var dataId = $('.content:visible').data('question');
        //alert(dataId)
        var totatCount = $('.content:visible').data('count');
        var nextId = $('.content:visible').data('id') + 1;
        if (nextId > totatCount) {
            // $('.next').hide();
            //$('.back').show();
            // $('.back').attr('style', 'display:block !important');
            $('#GSCCModal1').modal('show');
            $('[data-id="' + 1 + '"]').attr('style', 'display:block !important');
            $('[data-test="' + 1 + '"]').attr('style', 'background:#dc3545 !important;border-radius:12px !important');
            // $('[data-test="' + 1 + '"]').removeClass('border');
        }
        $('[data-id="' + id + '"]').removeAttr('style');
        $('[data-id="' + nextId + '"]').attr('style', 'display:block !important');
        $('[data-test="' + id + '"]').removeAttr('style');

        $('[data-test="' + id + '"]').addClass('borderss');


        var minutesLabel = document.getElementById("minutes1" + nextId + "");
        var secondsLabel = document.getElementById("seconds1" + nextId + "");
        var totalSeconds = 0;
        setInterval(setTime, 1000);

        function setTime() {
            ++totalSeconds;
            secondsLabel.innerHTML = pad(totalSeconds % 60);
            minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
        }

        function pad(val) {
            var valString = val + "";
            if (valString.length < 2) {
                return "0" + valString;
            } else {
                return valString;
            }
        }

        // alert(dataId)
        var dataSelection = $('.content:visible').data('section');
        var pacakge_id = '{{ request()->id  }}';
        var testType = '{{Request::segment(1) }}';
        //var checked =  $('input[name="ans"]:unchecked');
        //this.checked = false;
        // $( ".ans_button" ).prop( "checked", false );
        $('input[name="ans-' + dataId + '"]:checked').attr('checked', true);
        var checked = $('input[name="ans-' + dataId + '"]:checked').val();
        // $('input[name="ans-'+dataId+'"]').prop("checked", true);
        if (checked) {
            //alert(checked)

            $('[data-test="' + id + '"]').attr('style', 'background:#28a745 !important;border-radius:0px !important');
            $('[data-test="' + nextId + '"]').attr('style', 'background:#dc3545 !important;border-radius:12px !important');


            var type = 'saveNextValue';
            $.ajax({
                method: "POST",
                url: "{{ route('question-subject-update') }}",
                data: {
                    id: dataId,
                    section: dataSelection,
                    type: type,
                    answer: checked,
                    pacakge_id: pacakge_id,
                    testType: testType
                },
                success: function(data) {
                    //console.log(data.visited); 
                    $("#visited").html(data.visited);
                    $("#notVisited").html(data.notVisited);
                    $("#answered").html(data.answered);
                }
            });

        } else {

            var type = 'saveNext';
            $('[data-test="' + nextId + '"]').attr('style', 'background:#dc3545 !important;border-radius:12px !important');

            $.ajax({
                method: "POST",
                url: "{{ route('question-subject-update') }}",
                data: {
                    id: dataId,
                    section: dataSelection,
                    type: type,
                    pacakge_id: pacakge_id,
                    testType: testType
                },
                success: function(data) {
                    //console.log(data.visited); 
                    $("#visited").html(data.visited);
                    $("#notVisited").html(data.notVisited);
                }
            });
        }
    });
    $('body').on('click', '.mark_review_next', function() {

        var id = $('.content:visible').data('id');
        var totatCount = $('.content:visible').data('count');
        var nextId = $('.content:visible').data('id') + 1;
        if (nextId > totatCount) {} else {
            $('[data-id="' + id + '"]').removeAttr('style');
            $('[data-id="' + nextId + '"]').attr('style', 'display:block !important');
            $('[data-test="' + nextId + '"]').attr('style', 'background:#dc3545 !important;border-radius:12px !important');
            $('[data-test="' + id + '"]').attr('style', 'background:#ffc107 !important');
        }

        var dataId = $('.content:visible').data('question');
        var dataSelection = $('.content:visible').data('section');
        var type = 'marked';
        var testType = '{{Request::segment(1) }}';
        var pacakge_id = '{{ request()->id  }}';
        $.ajax({
            method: "POST",
            url: "{{ route('question-subject-update') }}",
            data: {
                id: dataId,
                section: dataSelection,
                type: type,
                testType: testType,
                pacakge_id: pacakge_id
            },
            success: function(data) {
                //console.log(data.visited); 
                $("#visited").html(data.visited);
                $("#notVisited").html(data.notVisited);
                $('#marked').html(data.marked);
            }
        });
    });
    //Question no button sidebar
    $('body').on('click', '.next1', function() {
        var id = $('.content:visible').data('id');
        var totatCount = $('.content:visible').data('count');
        var test = $(this).val();
        var pacakge_id = '{{ request()->id  }}';
        $('.content').removeAttr('style');
        //$('.next1').addClass('border');
        $('[data-id="' + test + '"]').attr('style', 'display:block !important');
        //$('.next1').removeAttr('style');
        $('[data-test="' + test + '"]').addClass('borderss');
        //$('.next1').addClass('borderss_layout');
        //$('.next1').removeAttr('style');
        //$('[data-test="' + test + '"]').attr('style', 'border-radius:0px !important; border-radius:0px !important');

        $('[data-test="' + test + '"]').attr('style', 'background:#dc3545 !important;');
       // alert(test);
        let minutesLabel1 = document.getElementById("minutes1"+ test +"");
        //alert(minutesLabel1);
        var secondsLabel1 = document.getElementById("seconds1"+ test +"");
        var totalSeconds = 0;
        if (totalSeconds <= 0) {
                clearInterval();
        }
        setInterval(setTime, 1000);

        function setTime() {
            ++totalSeconds;
            secondsLabel1.innerHTML = pad(totalSeconds % 60);
            minutesLabel1.innerHTML = pad(parseInt(totalSeconds / 60));
        }

        function pad(val) {
            var valString = val + "";
            if (valString.length < 2) {
                return "0" + valString;
            } else {
                return valString;
            }
        }
        var dataId = $(this).data('question');
        var dataSelection = $(this).data('section');
        //alert(dataSelection)
        var testType = '{{Request::segment(1) }}';
        var type = 'visited';
        $.ajax({
            method: "POST",
            url: "{{ route('question-subject-update') }}",
            data: {
                id: dataId,
                section: dataSelection,
                type: type,
                testType: testType,
                pacakge_id: pacakge_id
            },
            success: function(data) {
                console.log(data.visited);
                $("#visited").html(data.visited);
                $("#notVisited").html(data.notVisited);
            }
        });
    });

    //section filter on tab
    $('body').on('click', '.tabvalues', function() {
        var id = $(this).data('tabactive');
        $.ajax({
            method: "POST",
            url: "{{ route('get_select_mocktest') }}",
            data: {
                id: id,
                // '_token':'{{ csrf_token() }}'
            },
            success: function(data) {
                $('.nav-link').addClass('active');
                $("#product-gallery-holder-2222").html(data);
                var minutesLabel = document.getElementById("minutes1" + id + "");
                var secondsLabel = document.getElementById("seconds1" + id + "");
                var totalSeconds = 0;
                setInterval(setTime, 1000);

                function setTime() {
                    ++totalSeconds;
                    secondsLabel.innerHTML = pad(totalSeconds % 60);
                    minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
                }

                function pad(val) {
                    var valString = val + "";
                    if (valString.length < 2) {
                        return "0" + valString;
                    } else {
                        return valString;
                    }
                }
            }
        });
    });
    //answer green button
    // $('body').on('click', '.ans_button', function() {
    // 	var ans =   $('.content:visible').data('id');
    // 	$('[data-test="' + ans + '"]').attr('style', 'background:green !important');
    // });
    function goBack() {
        window.history.go(-2);
        // window.location.replace(document.referrer);
    }
    //Submit button
    $('body').on('click', '.GetReport', function() {

        var question = $(this).data('question_id');
        var package = $(this).data('package_id');
        $('#question').val(question);
        $('#package').val(package);
    });

    $('.clearResponse').click(function() {
        $('input:radio:checked').prop('checked', false);
        // var dataId =  $('.content:visible').data('question');
        //$('input[name="ans-'+dataId+'"]:checked').attr('unchecked', true);

        // var checked =  $('input[name="ans-'+dataId+'"]').val();

        //$('.ans-sec').removeClass('input:checked');
        //var checked =  $('input[name="ans-'+dataId+'"]:checked').val();
        // alert(checked)
        // $('input[name="ans-'+dataId+'"]:checked').attr('checked', false);
        //var checked =  $('input[name="ans-'+dataId+'"]:checked').val();

    });
    $(document).ready(function() {

        var minutesLabel = document.getElementById("minutes11");
        var secondsLabel = document.getElementById("seconds11");
        
        var totalSeconds = 0;
        setInterval(setTime, 1000);

        function setTime() {
            ++totalSeconds;
            secondsLabel.innerHTML = pad(totalSeconds % 60);
            minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
        }

        function pad(val) {
            var valString = val + "";
            if (valString.length < 2) {
                return "0" + valString;
            } else {
                return valString;
            }
        }

        let days = 2; //starting number of days
        let hours = document.getElementById('start_time').value; // starting number of hours
        let minutes = document.getElementById('middel_time').value; // starting number of minutes
        let seconds = 0; // starting number of seconds
        // converts all to seconds
        let totalSeconds1 = days * 60 * 60 * 24 + hours * 60 * 60 + minutes * 60 + seconds;
        //temporary seconds holder
        let tempSeconds = totalSeconds1;
        // calculates number of days, hours, minutes and seconds from a given number of seconds
        const convert = (value, inSeconds) => {
            if (value > inSeconds) {
                let x = value % inSeconds;
                tempSeconds = x;
                return (value - x) / inSeconds;
            } else {
                return 0;
            }
        };
        //sets seconds
        const setSeconds = (s) => {
            document.querySelector("#seconds").textContent = s + "s";
        };
        //sets minutes
        const setMinutes = (m) => {
            document.querySelector("#minutes").textContent = m + "m";
        };
        //sets hours
        const setHours = (h) => {
            document.querySelector("#hours").textContent = h + "h";
        };
        //sets Days
        const setDays = (d) => {
            document.querySelector("#days").textContent = d + "d";
        };
        // Update the count down every 1 second
        var x = setInterval(() => {
            //clears countdown when all seconds are counted
            if (totalSeconds1 <= 0) {
                clearInterval(x);
            }
            setDays(convert(tempSeconds, 24 * 60 * 60));
            setHours(convert(tempSeconds, 60 * 60));
            setMinutes(convert(tempSeconds, 60));
            setSeconds(tempSeconds == 60 ? 59 : tempSeconds);
            totalSeconds1--;
            tempSeconds = totalSeconds1;
        }, 1000);

        let daysSection = 2; //starting number of days
        let hoursSection = 00; // starting number of hours
        let minutesSection = $('.middel_section_time').data('middel_section_time');
        let secondsSection = 0; // starting number of seconds
        // converts all to seconds
        let totalSeconds11 = daysSection * 60 * 60 * 24 + hoursSection * 60 * 60 + minutesSection * 60 + secondsSection;
        //temporary seconds holder
        let tempSecondss = totalSeconds11;
        // calculates number of days, hours, minutes and seconds from a given number of seconds
        const convertSection = (value, inSeconds) => {
            if (value > inSeconds) {
                let x = value % inSeconds;
                tempSecondss = x;
                return (value - x) / inSeconds;
            } else {
                return 0;
            }
        };
        //sets seconds
        const setSecondsSection = (s) => {
            document.querySelector(".section_seconds").textContent = s + "s";
        };
        //sets minutes
        const setMinutesSection = (m) => {
            document.querySelector(".section_minutes").textContent = m + "m";
        };
        //sets hours
        const setHoursSection = (h) => {
            document.querySelector(".section_hours").textContent = h + "h";
        };
        //sets Days
        const setDaysSection = (d) => {
            document.querySelector(".section_days").textContent = d + "d";
        };
        // Update the count down every 1 second
        var x = setInterval(() => {
            //clears countdown when all seconds are counted
            if (totalSeconds11 <= 0) {
                clearInterval(x);
            }
            setDaysSection(convertSection(tempSecondss, 24 * 60 * 60));
            setHoursSection(convertSection(tempSecondss, 60 * 60));
            setMinutesSection(convertSection(tempSecondss, 60));
            setSecondsSection(tempSecondss == 60 ? 59 : tempSecondss);
            totalSeconds11--;
            tempSecondss = totalSeconds11;
        }, 1000);
    });

    //Open full screen 
    function fullscreen() {
        var isInFullScreen = (document.fullscreenElement && document.fullscreenElement !== null) ||
            (document.webkitFullscreenElement && document.webkitFullscreenElement !== null) ||
            (document.mozFullScreenElement && document.mozFullScreenElement !== null) ||
            (document.msFullscreenElement && document.msFullscreenElement !== null);

        var docElm = document.documentElement;
        if (!isInFullScreen) {
            if (docElm.requestFullscreen) {
                docElm.requestFullscreen();
            } else if (docElm.mozRequestFullScreen) {
                docElm.mozRequestFullScreen();
            } else if (docElm.webkitRequestFullScreen) {
                docElm.webkitRequestFullScreen();
            } else if (docElm.msRequestFullscreen) {
                docElm.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    }


    var hidWidth;
    var scrollBarWidths = 40;

    var widthOfList = function() {
        var itemsWidth = 0;
        $('.list li').each(function() {
            var itemWidth = $(this).outerWidth();
            itemsWidth += itemWidth;
        });
        return itemsWidth;
    };

    var widthOfHidden = function() {
        return (($('.wrapper').outerWidth()) - widthOfList() - getLeftPosi()) - scrollBarWidths;
    };

    var getLeftPosi = function() {
        return $('.list').position().left;
    };

    var reAdjust = function() {
        if (($('.wrapper').outerWidth()) < widthOfList()) {
            $('.scroller-right').show();
        } else {
            $('.scroller-right').hide();
        }

        if (getLeftPosi() < 0) {
            $('.scroller-left').show();
        } else {
            $('.item').animate({
                left: "-=" + getLeftPosi() + "px"
            }, 'slow');
            $('.scroller-left').hide();
        }
    }

    reAdjust();
    $(window).on('resize', function(e) {
        reAdjust();
    });

    $('.scroller-right').click(function() {

        $('.scroller-left').fadeIn('slow');
        $('.scroller-right').fadeOut('slow');

        $('.list').animate({
            left: "+=" + widthOfHidden() + "px"
        }, 'slow', function() {

        });
    });

    $('.scroller-left').click(function() {
        $('.scroller-right').fadeIn('slow');
        $('.scroller-left').fadeOut('slow');

        $('.list').animate({
            left: "-=" + getLeftPosi() + "px"
        }, 'slow', function() {

        });
    });
</script>
<!-- <script type="text/javascript">
    window.onbeforeunload = function() {
        return "are you sure you want to leave?";
    }
</script> -->
@endsection