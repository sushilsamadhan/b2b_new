@extends('rumbok.app')

@section('content')
<style>
.flp-category-page {
     position: relative;
     background-color: white;
 }

 @media screen and (max-width:450px){
    .flp-cat-sb-block-inner .flp-cat-sb-img{
        left: -7px;
    }
    
}

@media (max-width:767px) {
    .flp-cat-sidebar {
        /* height: 100vh; */
        overflow-y: auto;
    }
}

.videoIcon {
    font-size: 20px;
    margin-top: 10px;
    color: #F97316BF;
    display: block;
}
.flp-cat-sidebar {
    position: relative;
    height: 100%;
    padding: 14px;
    background-color: #f1925180;
}
.flp-cat-sb-block:hover {
    background-color: #F97316BF;
    transform: translateY(-7px);
    box-shadow: 5px 4px 9px -2px rgb(0 0 0 / 61%);
    -webkit-box-shadow: 5px 4px 9px -2px rgb(0 0 0 / 61%);
    -moz-box-shadow: 5px 4px 9px -2px rgba(0, 0, 0, 0.61);
    transition: all ease-in-out 0.5s;
}
.activeflp {
    background-color: #F97316BF;
    transform: translateY(-10px);
    box-shadow: 5px 4px 9px -2px rgb(0 0 0 / 61%);
    -webkit-box-shadow: 5px 4px 9px -2px rgb(0 0 0 / 61%);
    -moz-box-shadow: 5px 4px 9px -2px rgba(0, 0, 0, 0.61);
    transition: all ease-in-out 0.5s;
}
.flp-cat-sb-block {
    padding: 12px;
    border-radius: 7px;
    margin: 15px 2px;
    transition: all ease-in-out 0.5s;
    border: 2px solid #FFF;
}
</style>
<section class="heading-n-breadcrub-part mb-0">
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
                          <span> Traditional Learning</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="flp-category-page">
    <div class="container">
        <div class="row no-gutter">
            <div class="col-md-2 col-3">
                <div class="flp-cat-sidebar p-2">
                    <div class="flp-cat-sb-block border rounded activeflp">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-1.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Dharmik Evam Etihasik Sthal</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-2.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Vrat Evam Tyohar</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-3.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Incredible India</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-4.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Swatantrata Senani</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-5.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Rastra Bhakt Evam Amar Balidani</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-6.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Aadi Rishi</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-7.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Pauraanik Vishav Guru</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-8.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Famous Hindi poets and litterateurs and their poems</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-9.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Vedas - Puranas and Religious Texts</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-10.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Matri Shakti</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-11.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Great and popular ruler</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flp-cat-sb-block rounded">
                        <div class="flp-cat-sb-block-inner">
                            <div class="flp-cat-sb-img">
                                <img src="https://olexpert.org.in/public/asset_rumbok/new/images/banner-bg/cat-12.jpg"/>
                            </div>
                            <div class="flp-cat-sb-name">
                                <h4>Prerak Prasang</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-9">
                <div class="clearfix p-2">
                    <div class="row my-3">
                        <div class="col-md-8">
                            <p class="m-0">Total {{count($data)}} Recods found</p>
                        </div>
                        <div class="col-md-4">
                            <!-- <div class="d-flex align-items-center">
                                <div class="form-group mb-0 mr-2">
                                <div class="search__container">
                                    <input class="search__input" id="search" type="text" placeholder="Search">
                                    <input type="hidden" id="searchUrl" value="https://olexpert.org.in/project-work-search">
                                    <div class="overflow-hidden search-list w-100">
                                        <div id="appendSearchCart1"></div>
                                    </div>
                                    </div>
                                </div>
                                <div class="view-more-btn ml-auto">
                                    <a href="#" class="btn-rounded rounded-view-more"><i class="fas fa-ellipsis-h"></i>
                                    </a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                       
                            @foreach($data as $demoData)
                                <?php
                                    $mainyoutube = str_replace("https://youtu.be/","",$demoData['demo_url']);
                                    $thumbdata = "https://img.youtube.com/vi/".$mainyoutube."/sddefault.jpg";
                                ?>
                                <div class="col-md-4">
                                    <a href="javascript:void(0);" onclick="forgetSrc('{{$demoData['demo_url']}}')">
                                    <div class="flp-cate-indi">
                                        <div class="cat-indi-outer">
                                            <div class="cat-indi-inner">
                                                <div class="cat-feature-img">
                                                    <img src="{{$thumbdata}}"/>
                                                </div>
                                                <div class="cat-indi-title">
                                                    {{$demoData['chapter_name']}}
                                                    </br>
                                                    <i class="fas fa-play-circle videoIcon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            @endforeach
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function forgetSrc(videoSrc){
    $('#myModal').modal('show');
    var videoSrc = videoSrc.replace("https://youtu.be/", "https://www.youtube.com/embed/");
    $("#showVideo").attr('src',videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
}
</script>
@endsection
@section('js')

@endsection

