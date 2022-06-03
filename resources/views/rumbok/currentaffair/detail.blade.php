@extends('rumbok.app')

@section('content')

<style>
    
.header-search1 form input {
    border: 1px solid #fad2a9;
    border-radius: 10px;
    width: 100%;
}

.header-search1 form button {
    color: #ffffff;
    background-color: #ffa02b;
    border: 0px 10px 10px 0px;
    padding: 12px 20px;
    border-radius: 0px 10px 10px 0px;
    position: absolute;
    bottom: 0px;
    right: 0px;
    border: none;
     margin: 20px 1px 76px -12px;
}
.job-tab ul.nav.nav-tabs {
    overflow-x: auto;
    white-space: nowrap;
    display: flex !important;
    flex-direction: row;
    flex-wrap: nowrap;
    border-bottom: 0;
    padding: 15px 0;
    margin-bottom: 10px;
}
.job-tab .nav-tabs {
    position: relative;
    z-index: 1;
}
.job-tab .nav-tabs li {
    margin-right: 8px;
}
.job-tab .nav-tabs>li {
    float: none;
    display: inline;
}
.job-tab .nav-tabs>li.active>a.active {
    background-color: #e86a2f;
}
.job-tab .nav-tabs>li a {
    align-items: center;
    appearance: none;
    border-radius: 4px;
    border-style: none;
    box-shadow: rgb(0 0 0 / 20%) 0 3px 1px -2px, rgb(0 0 0 / 14%) 0 2px 2px 0, rgb(0 0 0 / 12%) 0 1px 5px 0;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-flex;
    font-family: Roboto,sans-serif;
    font-size: .875rem;
    font-weight: 500;
    height: 36px;
    justify-content: center;
    letter-spacing: .0892857em;
    line-height: normal;
    min-width: 64px;
    outline: none;
    overflow: visible;
    padding: 0 10px;
    position: relative;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1);
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    will-change: transform,opacity;
    background-color: #253a73;
}
.job-tab .nav-tabs>li>a.active {
    background-color: #e86a2f;
}

.date-card {
  position: relative;
  width: 100%;
  height: 130px;
  transform-style: preserve-3d;
  transform: rotatey(0deg) translatex(0px) translatey(0px);
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.4);
  margin: 5px;
  cursor: pointer;
  margin-bottom: 20px;
}
.date-card .front-facing {
    transform: rotateY(
0deg) translateZ(2px);
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    border: 2px white solid;
    border-radius: 5px;
}
.bg-date-card-1 .front-facing {
    background: #ffc107;
}
.bg-date-card-2 .front-facing {
    background: #fc3359;
}
.bg-date-card-3 .front-facing {
    background: #007bb6;
}
.bg-date-card-4 .front-facing {
    background: #00aced;
}
.bg-date-card-5 .front-facing {
    background: #3f51b5;
}
.bg-date-card-6 .front-facing {
	background: #9c27b0;
}
.bg-date-card-7 .front-facing {
	background: #4caf50;
}
.bg-date-card-8 .front-facing {
    background: #009688;
}
.date-card .front-facing .abr {
    width: 100%;
    position: absolute;
    top: 50%;
    left: 0;
    font-size: 42px;
    margin: -45px 0 0 0;
    text-align: center;
    color: #ffffff;
    line-height: 1;
}
.date-card .front-facing .title {
	width: 100%;
    position: absolute;
    top: 50%;
    left: 0;
    text-transform: uppercase;
    font-size: 18px;
    margin: -5px 0 0 0;
    text-align: center;
    color: #ffffff;
}
.date-card .front-facing .atomic-number {
	position: absolute;
    top: 10px;
    left: 10px;
    font-size: 16px;
    color: #e86a2f;
    background: #ffffff;
    line-height: 1;
    border-radius: 4px;
    padding: 8px 8px;
    box-shadow: 5px 5px 18px 4px rgb(0 0 0 / 20%);
}
.date-card .front-facing .atomic-mass {
	position: absolute;
    bottom: 10px;
    right: 10px;
    font-size: 12px;
    border: 1px solid #fff;
    color: #ffffff;
    padding: 5px 12px;
    line-height: 1;
    border-radius: 20px;
}
</style>
    {{--new design--}}

    <!-- Breadcrumb Section Starts -->
    <section class="heading-n-breadcrub-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                <div class="d-flex align-items-center">
                            <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                            <div class="title-page">
                            <h1>{{$course->title}}</h1>
                            </div>
                    </div>          
                </div>
                <div class="col-lg-6">
                    <div class="bread-crumb-part">
                        <ul class="bread-crumb-part-list">
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <span>Current Affairs</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php
/*
<iframe src="{{asset($course->file)}}" style="width:100%; min-height:800px;" title="{{$course->title}}"></iframe>
*/
?>
    <!-- Course Category Section Starts -->
    <section class="course-category-section padding-top-30 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="https://docs.google.com/viewer?url={{asset($course->file)}}">Download</a>
                </div>
                <div class="col-md-12">
                    <div id="videoId">
                    <iframe src="https://docs.google.com/viewer?url={{asset($course->file)}}&embedded=true" style="width:100%; min-height:500px;" title="{{$course->title}}" ></iframe>
                    </div>
                </div>
               
            </div>                
        </div>
    </section>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>
<script>

var _PDF_DOC,
    _CURRENT_PAGE,
    _TOTAL_PAGES,
    _PAGE_RENDERING_IN_PROGRESS = 0,
    _CANVAS = document.querySelector('#pdf-canvas');
$( document ).ready(function() {
    showPDF('{{asset($course->file)}}');
});
// initialize and load the PDF
async function showPDF(pdf_url) {
    document.querySelector("#pdf-loader").style.display = 'block';

    // get handle of pdf document
    try {
        _PDF_DOC = await pdfjsLib.getDocument({ url: pdf_url });
    }
    catch(error) {
        alert(error.message);
    }

    // total pages in pdf
    _TOTAL_PAGES = _PDF_DOC.numPages;
    
    // Hide the pdf loader and show pdf container
    document.querySelector("#pdf-loader").style.display = 'none';
    document.querySelector("#pdf-contents").style.display = 'block';
    document.querySelector("#pdf-total-pages").innerHTML = _TOTAL_PAGES;

    // show the first page
    showPage(1);
}

// load and render specific page of the PDF
async function showPage(page_no) {
    _PAGE_RENDERING_IN_PROGRESS = 1;
    _CURRENT_PAGE = page_no;

    // disable Previous & Next buttons while page is being loaded
    document.querySelector("#pdf-next").disabled = true;
    document.querySelector("#pdf-prev").disabled = true;

    // while page is being rendered hide the canvas and show a loading message
    document.querySelector("#pdf-canvas").style.display = 'none';
    document.querySelector("#page-loader").style.display = 'block';

    // update current page
    document.querySelector("#pdf-current-page").innerHTML = page_no;
    
    // get handle of page
    try {
        var page = await _PDF_DOC.getPage(page_no);
    }
    catch(error) {
        alert(error.message);
    }

    // original width of the pdf page at scale 1
    var pdf_original_width = page.getViewport(1).width;
    
    // as the canvas is of a fixed width we need to adjust the scale of the viewport where page is rendered
    var scale_required = _CANVAS.width / pdf_original_width;

    // get viewport to render the page at required scale
    var viewport = page.getViewport(scale_required);

    // set canvas height same as viewport height
    _CANVAS.height = viewport.height;

    // setting page loader height for smooth experience
    document.querySelector("#page-loader").style.height =  _CANVAS.height + 'px';
    document.querySelector("#page-loader").style.lineHeight = _CANVAS.height + 'px';

    // page is rendered on <canvas> element
    var render_context = {
        canvasContext: _CANVAS.getContext('2d'),
        viewport: viewport
    };
        
    // render the page contents in the canvas
    try {
        await page.render(render_context);
    }
    catch(error) {
        alert(error.message);
    }

    _PAGE_RENDERING_IN_PROGRESS = 0;

    // re-enable Previous & Next buttons
    document.querySelector("#pdf-next").disabled = false;
    document.querySelector("#pdf-prev").disabled = false;

    // show the canvas and hide the page loader
    document.querySelector("#pdf-canvas").style.display = 'block';
    document.querySelector("#page-loader").style.display = 'none';
}



</script>
@endsection



