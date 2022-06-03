@extends('rumbok.app')

@section('content')
<style>
    .tab-menu-category button.owl-next {
    position: absolute;
    right: -35px;
    width: 20px;
    height: 20px;
    border-radius: 50% !important;
    background: #000 !important;
    line-height: 20px !important;
    opacity: 1;
    color: #fff !important;
}
.tab-menu-category button.owl-prev.disabled {
    position: absolute;
    left: -35px;
    width: 20px;
    height: 20px;
    border-radius: 50% !important;
    background: #000 !important;
    line-height: 20px !important;
    opacity: 1;
    color: #fff;
}
.tab-menu-category .owl-nav {
    position: absolute;
    top: -2px;
    width: 100%;
}
.tab-menu-category {
    padding: 0;
    position: relative;
}
.tab-menu-category .owl-item span {
    padding: 5px 10px;
    font-size: 13px;
    background: #efefef;
    border-radius: 30px;
}
.demo-video-block {
    border: 1px solid #ddd;
    padding: 5px;
    border-radius: 10px;
    margin-bottom: 15px;
}
.demo-video-thumb {
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    max-height:168px;
}
.hover-demo-video-icon {
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    text-align: center;
    display:table;
    color: #fff !important;
}
.hover-demo-video-icon a {
    color: #ff5100;
    font-size: 15px;
    position: absolute;
    right: 10px;
    bottom: 10px;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 5px 5px 5px rgb(0 0 0 / 20%);
}
.hover-demo-video-icon span {
    display: block;
    line-height: 22px;
    font-size: 14px;
    margin-top: 0px;
    padding: 5px 10px;
    font-weight: 600;
    display:table-cell;
    vertical-align:middle;
    color: #000;
}
.demo-videp-title {
    font-weight: 600;
    color: #000;
    text-align: center;
    line-height: 20px;
    padding: 5px 0;
    font-size: 14px;
}
.tabs-menu ul.nav.nav-tabs {
    overflow-x: auto;
    white-space: nowrap;
    display: flex !important;
    flex-direction: row;
    flex-wrap: nowrap;
    border-bottom: 0;
}
.tabs-menu a.nav-link {
    border: 0;
    height: 100px;
    width: 100px;
    line-height: 100px;
    text-align: center;
    padding: 0;
    background: #fff;
    border-radius: 10px;
    margin-right: 10px;
    font-weight:bold;
}
.tabs-menu a.nav-link.active {
    background: #e86a2f;
    color:#fff;
}
.tabs-menu {
    background: #253a73;
    padding: 10px;
    border-radius: 10px 0 0 10px;
}
.nav-tabs::-webkit-scrollbar {
    display: none; /*Safari and Chrome*/
}
.random-bg .col-lg-3:nth-child(1) .hover-demo-video-icon {
    background-color: #c87ef0;
}
.random-bg .col-lg-3:nth-child(2) .hover-demo-video-icon {
    background-color: #ffc49f;
}
.random-bg .col-lg-3:nth-child(3) .hover-demo-video-icon {
    background-color: #ffea9a;
}
.random-bg .col-lg-3:nth-child(4) .hover-demo-video-icon {
    background-color: #ff99bb;
}
.random-bg .col-lg-3:nth-child(5) .hover-demo-video-icon {
    background-color: #aeaeae;
}
.random-bg .col-lg-3:nth-child(6) .hover-demo-video-icon {
    background-color: #b9ffc3;
}
.random-bg .col-lg-3:nth-child(7) .hover-demo-video-icon {
    background-color: #ffde8e;
}
.random-bg .col-lg-3:nth-child(8) .hover-demo-video-icon {
    background-color: #ff8891;
}
.random-bg .col-lg-3:nth-child(9) .hover-demo-video-icon {
    background-color: #feb8b9;
}
.random-bg .col-lg-3:nth-child(10) .hover-demo-video-icon {
    background-color: #bfdcfc;
}
.random-bg .col-lg-3:nth-child(11) .hover-demo-video-icon {
    background-color: #c87ef0;
}
.random-bg .col-lg-3:nth-child(12) .hover-demo-video-icon {
    background-color: #ffc49f;
}
.random-bg .col-lg-3:nth-child(13) .hover-demo-video-icon {
    background-color: #ffea9a;
}
.random-bg .col-lg-3:nth-child(14) .hover-demo-video-icon {
    background-color: #ff99bb;
}
.random-bg .col-lg-3:nth-child(15) .hover-demo-video-icon {
    background-color: #aeaeae;
}
.random-bg .col-lg-3:nth-child(16) .hover-demo-video-icon {
    background-color: #b9ffc3;
}
.random-bg .col-lg-3:nth-child(17) .hover-demo-video-icon {
    background-color: #ffde8e;
}
.random-bg .col-lg-3:nth-child(18) .hover-demo-video-icon {
    background-color: #ff8891;
}
.random-bg .col-lg-3:nth-child(19) .hover-demo-video-icon {
    background-color: #feb8b9;
}
.random-bg .col-lg-3:nth-child(20) .hover-demo-video-icon {
    background-color: #bfdcfc;
}
.random-bg .col-lg-3:nth-child(21) .hover-demo-video-icon {
    background-color: #c87ef0;
}
.random-bg .col-lg-3:nth-child(22) .hover-demo-video-icon {
    background-color: #ffc49f;
}
.random-bg .col-lg-3:nth-child(23) .hover-demo-video-icon {
    background-color: #ffea9a;
}
.random-bg .col-lg-3:nth-child(24) .hover-demo-video-icon {
    background-color: #ff99bb;
}
.random-bg .col-lg-3:nth-child(25) .hover-demo-video-icon {
    background-color: #aeaeae;
}
.random-bg .col-lg-3:nth-child(26) .hover-demo-video-icon {
    background-color: #b9ffc3;
}
.random-bg .col-lg-3:nth-child(27) .hover-demo-video-icon {
    background-color: #ffde8e;
}
.random-bg .col-lg-3:nth-child(28) .hover-demo-video-icon {
    background-color: #ff8891;
}
.random-bg .col-lg-3:nth-child(29) .hover-demo-video-icon {
    background-color: #feb8b9;
}
.random-bg .col-lg-3:nth-child(30) .hover-demo-video-icon {
    background-color: #bfdcfc;
}
.random-bg .col-lg-3:nth-child(31) .hover-demo-video-icon {
    background-color: #c87ef0;
}
.random-bg .col-lg-3:nth-child(32) .hover-demo-video-icon {
    background-color: #ffc49f;
}
.random-bg .col-lg-3:nth-child(33) .hover-demo-video-icon {
    background-color: #ffea9a;
}
.random-bg .col-lg-3:nth-child(34) .hover-demo-video-icon {
    background-color: #ff99bb;
}
.random-bg .col-lg-3:nth-child(35) .hover-demo-video-icon {
    background-color: #aeaeae;
}
.random-bg .col-lg-3:nth-child(36) .hover-demo-video-icon {
    background-color: #b9ffc3;
}
.random-bg .col-lg-3:nth-child(37) .hover-demo-video-icon {
    background-color: #ffde8e;
}
.random-bg .col-lg-3:nth-child(38) .hover-demo-video-icon {
    background-color: #ff8891;
}
.random-bg .col-lg-3:nth-child(39) .hover-demo-video-icon {
    background-color: #feb8b9;
}
.random-bg .col-lg-3:nth-child(40) .hover-demo-video-icon {
    background-color: #bfdcfc;
}
</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
          <div class="d-flex align-items-center">
              <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
              <div class="title-page">
                <h1>{{$cat->name}}</h1>
              </div>
              </div> 
                          
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                          <a href="{{url('/')}}">Home</a>
                      </li>
                      <li>
                        <span>Demo Videos</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
<section class="product-category">
    <div class="container">
        <div class="tab-menu-category mb-3">
        @if(count($data)>0)
        <div class="tabs-menu">
            
                <ul class="nav nav-tabs">
                <li class="nav-item" ><a class="nav-link active" data-toggle="tab" href="#all">All</a></li>
                    @foreach($data as $key=>$democat)
                    <?php
                        $keyId = str_replace(" ","",trim($key));
                    ?>
                    
                        <li class="nav-item" ><a class="nav-link" data-toggle="tab" href="#{{$keyId}}">{{$key}}</a></li>
                    
                        @endforeach
                </ul>
            
        </div>
        @endif
        </div>
        <div class="tab-content p-0">
        <div id="all" class="tab-pane in active">
       
          @forelse($data as $key=>$democat)
                <?php
                    $keyId = str_replace(" ","",trim($key));
                ?>
             <div class="row random-bg">
               
            @foreach($democat as $demoData)
                
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12" >
                        <div class="demo-video-block shadow bg-type">
                            <div class="demo-video-thumb">
                                <span class="position-absolute classs-block small line-height-1">{{$demoData['subject_name']}}</span>
                                <img src="{{ filePath($demoData['course_image']) }}" alt="" class="img-fluid">
                                <div class="hover-demo-video-icon">
                                    <a  data-toggle="modal" href="javascript:void(0);" data-url="{{$demoData['demo_url']}}" ><i class="fa fa-play"></i></a>
                                    <span>{{$demoData['chapter_name']}}</span>
                                </div>
                            </div>
                            <div class="demo-video-content pt-2">
                                <!-- <div class="demo-videp-title"></div> -->
                                {{-- <div class="h6 text-muted small text-center"></div>--}}
                                {{-- <a href="#" class="bisylms-btn-2 d-block">View Details</a>--}}
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
        
        @empty

        @endforelse
        </div>  
        @forelse($data as $key=>$democat)
                <?php
                    $keyId = str_replace(" ","",trim($key));
                ?>
            <div id="{{$keyId}}" class="tab-pane">
                <div class="row random-bg">
            @foreach($democat as $demoData)
                
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12" >
                        <div class="demo-video-block shadow bg-type">
                            <div class="demo-video-thumb">
                                <span class="position-absolute classs-block small line-height-1">{{$demoData['subject_name']}}</span>
                                <img src="{{ filePath($demoData['course_image']) }}" alt="" class="img-fluid">
                                <div class="hover-demo-video-icon">
                                    <a  data-toggle="modal" href="javascript:void(0);" data-url="{{$demoData['demo_url']}}" class="video-btn"><i class="fa fa-play"></i></a>
                                    <span>{{$demoData['chapter_name']}}</span>
                                </div>
                            </div>
                            <div class="demo-video-content pt-2">
                                {{-- <div class="h6 text-muted small text-center"></div>--}}
                                 {{-- <a href="#" class="bisylms-btn-2 d-block">View Details</a> --}}
                            </div>
                        </div>
                    </div>
            @endforeach
                </div>
           </div>
        
        @empty
            <div class="col-12 m-5">
                <img src="{{asset('no_data.png')}}" class="w-100 img-fluid">
            </div>
        @endforelse
        </div>

    </div>
</section>
 <!-- The Modal -->
 <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <button type="button" class="close position-absolute" data-dismiss="modal" style=" top: -10px; right: -10px;    z-index: 2;    background: #000; opacity: 1; text-shadow: none; color: #fff; width: 30px; height: 30px; border-radius: 50%;">×</button>
        <!-- Modal Header -->
        
        
        <!-- Modal body -->
        <div class="modal-body">
        <iframe id="showVideo" width="100%" height="500" src="" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" autoplay="1" allowfullscreen=""></iframe>
        </div>
        
       
        
      </div>
    </div>
  </div>
@endsection
@section('js')
<script>
    $(document).on('change', '#classes', function(e){
        e.preventDefault();
        $('#filterForm').submit();
    });
    $(document).on('change', '#board', function(e){
        e.preventDefault();
        $("#classes").val('');
        var url = '{{url("courses")}}'+'/'+$('#board').val();
        $('#filterForm').prop('action', url);
        $('#filterForm').submit();
    });
</script>
<script>
$(document).ready(function() {
// Gets the video src from the data-src on each button
var videoSrc='';  
$(document).on('click', '[data-url]', function(e){
    videoSrc = $(this).attr('data-url');
    $('#myModal').modal('show');
});
console.log(videoSrc);
// when the modal is opened autoplay it  
$('#myModal').on('shown.bs.modal', function (e) {
// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
$("#showVideo").attr('src',videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
})
// stop playing the youtube video when I close the modal
$('#myModal').on('hide.bs.modal', function (e) {
    // a poor man's stop video
    $("#showVideo").attr('src',videoSrc); 
}) 
// document ready  
});
</script>
@endsection