
<style>
p {
    text-transform: capitalize;
}

.header-menu-area {
    display: none;
}

.button {
    background-color: #e9ecef;
    border: none;
    color: #000;
    padding: 8px 24px;
    text-align: center;
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

//.next {
//margin-left: 50px;
//}
.end {
    display: none !important;
}
       
.borderss {
    border-radius:0px !important;
    background-color:red !important;
}
       
.borderssGreen {
    border-radius:0px !important;
}
.borderss_layout {
  border-radius:0px !important;
}

.next1:first-child {
    background-color:red  !important;
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

                <div class="row col-lg-12">
                    <div class="col-lg-6">
                        <h3 class="widget-title">{{ $mockTest->name}}</h3>
                    </div>
                    <div class="col-md-3">
                        <div id="countdown-container">
                            <div id="countdown" class="button">
                                <span id="days" style="display:none">0</span> <span id="hours">0</span> :
                                <span id="minutes">0</span> : <span id="seconds">0</span>
                            </div>
                        </div>
                        @php $start_time = date("H", strtotime($mockTest->total_time));
                        $middel_time = date("i", strtotime($mockTest->total_time));
                        $end_time = date("s", strtotime($mockTest->total_time));
                        @endphp

                        <input type="hidden" data-start_time="{{ $start_time }}" id="start_time" class="button"
                            value="{{ $start_time }}">
                        <input type="hidden" data-middel_time="{{ $middel_time }}" id="middel_time" class="button"
                            value="{{ $middel_time }}">
                        <input type="hidden" data-end_time="{{ $end_time }}" id="end_time" class="button"
                            value="{{ $end_time }}">
                    </div>
                    <div class="col-md-3">
                        <button class="button" onclick="fullscreen()">Enter Full Screen</button>
                    </div>
                </div>
                <!-- <i class="la la-th-large nav-link icon-element active"></i> -->


            </div>
        </div><!-- end col-lg-12 -->
    </div><!-- end row -->
    <div class="course-content-wrapper mt-4">

        {{-- sidebar --}}
        <div class="row col-lg-12">
            <div class="col-lg-9">
                <!--Category -->
                <div class="filter-bar d-flex justify-content-between  widget-title" style="background:#15aacc14;">
                    <div class="col-md-8">
                        Sections |
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            @foreach($mockTest->mockTestSection as $mockTestSection)
                            <li role="presentation" class="nav-item" data-tab="{{ $mockTestSection->id }}"><a href="#work{{ $mockTestSection->id }}" role="tab"
                                    class="nav-link active tabvalues"  data-tabactive="{{ $mockTestSection->id }}" data-toggle="tab">{{ $mockTestSection->section_name }} </a></li>
                            @endforeach  
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="row col-md-12">
                            <div class="col-md-3">View In:
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

                <div class="show content-holder">

                    <div class="tab-content" id="product-gallery-holder-2222">
                        @include('frontend.test.component.mock-test-start-filter')
                    </div>
                    <div class="row col-md-12 filter-bar d-flex justify-content-between  widget-title">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default mark_review_next" id="">Mark for review & Next</button>
                            <button class="btn btn-default" id="showbacks">Clear Response </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-success next" id="">Save & Next</button>
                            <button type="button" class="btn btn-danger back" id="">Back</button>
                            <a class="btn btn-primary ready" href="{{ route('mock-test-start',$mockTest->id)}}"
                                id="show222" style="display:none" disabled>I am ready to begin</a>
                        </div>
                    </div>
                </div>





                <!-- end col-lg-8 -->
                <!-- end row -->

                <!-- end card-content-wrapper -->
            </div>
            @php $i = $j= $r = $k = 1;
            $mockTestSectionQuestions = \App\MockTestSectionQuestion::where(['mock_test_master_id' =>$mockTest->id
            ,'mock_test_section_id' => $mockTestSection->id])->get(); @endphp

            <div class="col-lg-3 justify-content-between widget-title" style="background:#15aacc14;">

                <div class="col-lg-12">
                    <div style="background-color: #0a1b48;
						padding: 14px;
						color: #fff;
						font-size: 15px;
						margin-left: -28px;
						margin-right: -28px;">
                        <label> {{\Illuminate\Support\Facades\Auth::user()->name }}</label>
                        <div class="col-lg-4">
                            <input type="text" value="0" style="width: 47%;"> &nbsp; <span id="marked">  <span>marked
                            <input type="text" style="width: 47%;" value="{{ $mockTestSectionQuestions->count()}}"> &nbsp; <span id="answered"></span>Attempted
							
                        </div>
						<div class="col-lg-4">
                            <input type="text" value="0" style="width: 47%;"> &nbsp;<span id="visited"></span> not visited
                            <input type="text" style="width: 47%;" value="{{ $mockTestSectionQuestions->count()}}"><span id="notVisited"></span> &nbsp; Not Answered
                        </div>
						<div class="col-lg-4">
						 <input type="text" value="0" style="width: 47%;"> &nbsp; Marked & Answered
						 </div>
                            
                    </div>

                    <div class="mb-4" style="background-color: #e9ecef;margin: 0px;padding: 10px;font-size: 15px;
							margin-left: -28px;
							margin-right: -28px;">
                        Sections :{{ $mockTestSection->section_name }}
                    </div>
                    @foreach($mockTestSectionQuestions as $mockTestSectionQuestion)
                    @php
                        $studentTestQuestions =\App\StudentTestQuestion::where('id',$mockTestSectionQuestion->student_test_question_id)->first();
                    @endphp

                    	<button type="button" class="btn btn-secondary next1 "  data-test="{{ $r++ }}"  value="{{ $j++ }}"  data-question="{{ $studentTestQuestions->id }}" data-section="{{ $mockTestSection->id }}" id="">{{ $i++ }}</button>

                    @endforeach

					<button class="btn btn-primary col-lg-12 mt-5" style="background-color:#b3b1b1">Intructions</button>
                    <button class="btn btn-primary col-lg-12 mt-5 submit_form" id="confirmModal"   data-toggle="modal" data-target="#GSCCModal" style="background-color:#0a1b48">Submit Test</button>

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
        </div>
  
</section><!-- end courses-area -->
<!--======================================
            END COURSE AREA
    ======================================-->

@endsection

@section('js')
{{-- stripe --}}
<script type="text/javascript">
$('body').on('click', '.next', function() {
    var id = $('.content:visible').data('id');
    var dataId =  $('.content:visible').data('question');
    var totatCount = $('.content:visible').data('count');
    var nextId = $('.content:visible').data('id') + 1;
    if (nextId > totatCount) {
       // $('.next').hide();
        //$('.back').show();
       // $('.back').attr('style', 'display:block !important');
        $('[data-id="' + 1 + '"]').attr('style', 'display:block !important');
        $('[data-test="' + 1 + '"]').attr('style', 'background:red !important;border-radius:12px !important');
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
    var dataSelection =  $('.content:visible').data('section');
    //var checked =  $('input[name="ans"]:unchecked');
    //this.checked = false;
  // $( ".ans_button" ).prop( "checked", false );
  $('input[name="ans-'+dataId+'"]:checked').attr('checked', true);
    var checked =  $('input[name="ans-'+dataId+'"]:checked').val();
   // $('input[name="ans-'+dataId+'"]').prop("checked", true);
    if(checked){
        //alert(checked)
        
        $('[data-test="' + id + '"]').attr('style', 'background:green !important;border-radius:12px !important');
        $('[data-test="' + nextId + '"]').attr('style', 'background:red !important;border-radius:12px !important');
       
        var type = 'saveNextValue';
        $.ajax({
            method: "POST",
            url: "{{ route('question-update') }}",
            data: {
                id: dataId,section:dataSelection,type:type,answer:checked
            },
            success: function(data) {
                //console.log(data.visited); 
                $("#visited").html(data.visited);
                $("#notVisited").html(data.notVisited);
                $("#answered").html(data.answered);
            }
        });	 

    } else{
    
        var type = 'saveNext';
        $('[data-test="' + nextId + '"]').attr('style', 'background:red !important;border-radius:12px !important');
       
         $.ajax({
            method: "POST",
            url: "{{ route('question-update') }}",
            data: {
                id: dataId,section:dataSelection,type:type
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
    if (nextId > totatCount) {
    } else {
        $('[data-id="' + id + '"]').removeAttr('style');
        $('[data-id="' + nextId + '"]').attr('style', 'display:block !important');
        $('[data-test="' + nextId + '"]').attr('style', 'background:red !important;border-radius:12px');
        $('[data-test="' + id + '"]').attr('style', 'background:yellow !important');
    }

    var dataId =  $('.content:visible').data('question');
    var dataSelection =  $('.content:visible').data('section');
    var type = 'marked';
    $.ajax({
        method: "POST",
        url: "{{ route('question-update') }}",
        data: {
            id: dataId,section:dataSelection,type:type
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
    $('.content').removeAttr('style');
    $('[data-id="' + test + '"]').attr('style', 'display:block !important');
    $('.next1').removeAttr('style');
    $('[data-test="' + test + '"]').addClass('borderss');
    //$('.next1').addClass('borderss_layout');
   //$('.next1').removeAttr('style');
   //$('[data-test="' + test + '"]').attr('style', 'border-radius:0px !important; border-radius:0px !important');

	$('[data-test="' + test + '"]').attr('style', 'background:red !important;border-radius:12px !important');
    
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
    var dataId =  $(this).data('question');
    var dataSelection = $(this).data('section');
    var type = 'visited';
    $.ajax({
        method: "POST",
        url: "{{ route('question-update') }}",
        data:{
            id: dataId,section:dataSelection,type:type
        },
        success: function(data) {
            console.log(data.visited); 
            $("#visited").html(data.visited);
            $("#notVisited").html(data.notVisited);
        }
    });	
});
//csrf tken
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
//section filter on tab
$('body').on('click', '.tabvalues', function() {
    var id =  $(this).data('tabactive');
    $.ajax({
        method: "POST",
        url: "{{ route('get_select_mocktest') }}",
        data:{
            id: id,
        // '_token':'{{ csrf_token() }}'
        },
        success: function(data) {
            $("#product-gallery-holder-2222").html(data);
        }
    });	
});
//answer green button
// $('body').on('click', '.ans_button', function() {
// 	var ans =   $('.content:visible').data('id');
// 	$('[data-test="' + ans + '"]').attr('style', 'background:green !important');
// });
//Submit button
$('body').on('click', '.submit_form', function() {
	alert('sdad')
	var ans =   $('.content:visible').data('id');
	$('[data-test="' + ans + '"]').attr('style', 'background:green !important');
});
//Back buttion 
$('body').on('click', '.back', function() {
    var id = $('.content:visible').data('id');
    var totatCount = $('.content:visible').data('count');
    var prevId = $('.content:visible').data('id') - 1;
    $('[data-id="' + id + '"]').removeAttr('style');
    $('[data-id="' + prevId + '"]').attr('style', 'display:block !important');
    //show time per question
    var minutesLabel = document.getElementById("minutes1" + prevId + "");
    var secondsLabel = document.getElementById("seconds1" + prevId + "");
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
    if (prevId == 1) {
        $('.next').attr('style', 'display:block !important');
        $('.back').hide();
    }
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
</script>
@endsection