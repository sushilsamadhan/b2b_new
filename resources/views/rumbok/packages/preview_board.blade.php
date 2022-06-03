@extends('rumbok.app')

@section('content')

<style>
.badgemm {
    width: 75px;
    z-index: 2;
    top: -24px;
    background: #e86a2f;
    color: #fff;
    text-align: center;
    padding: 2px 5px;
    border-radius: 10px;
    text-transform: uppercase;
    left: 0;
    font-size: 9px;
}
.bottom-menu {
    display:none;
}
ul.social-media-list img {
    padding: 5px;
    border-radius: 5px;
    background-color: lightblue;
    width: 36px;
    height: 36px;
}

ul.social-media-list li {
    display: inline-block;
}
.single-item .item-left .small input[type="radio"] {
 display:inline-block;
}
</style>
    <!-- Breadcrumb Section Starts -->
    <!-- <section class="breadcrumb-section custom-padding-header">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
                 class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{ $getData->pkg_name }}</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a> / {{ $getData->pkg_name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="section-breadcrumb">
        <div class="container text-right">
        <div class="breadcrumb-link margin-top-10">
            <span><a href="{{route('homepage')}}">@translate(home)</a> / {{ $getData->pkg_name }}</span>
        </div>
        </div>
    
    </div> -->
    <section class="heading-n-breadcrub-part">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
               <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                  <h1 class="mb-0">{{$getData->pkg_name}}</h1>
                     <span>{{ $getData->catName }}/{{ $getData->subName }}</span>
                    </div>
               </div> 
               </div>
               <div class="col-lg-6">
                  <div class="bread-crumb-part">
                     <ul class="bread-crumb-part-list">
                        <li>
                           <a href="#">@translate(home)</a>
                        </li>
                        <li>
                           <span>{{ $getData->pkg_name }}</span>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>
    <!-- Course Details Section Starts -->
<section class="course-details-section mt-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                   
                    <div class="col-md-6">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <div class="course-features-custom d-flex">
                                <div class="feature-custom-number">
                                <?php $chapter_count=0;?>
                                @if($getData->course_id!=0 && isset($s_course) && !empty($s_course))
                                    @foreach($s_course->classes as $itemContent)
                                        @if($itemContent->contents->count()>0)
                                        <?php $chapter_count++;?>
                                        @endif
                                    @endforeach
                                    @elseif($getData->course_id==0)
                                        <?php $chapter_count = count($getFreeCourses);?>
                                @endif
                                {{$getData->is_all_subject==1?(count($getFreeCourses)+1):$chapter_count}}
                                </div>
                                <div class="feature-custom-text">{{$getData->is_all_subject==1?"Subject":"Chapters"}}</div>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="course-features-custom d-flex">
                                <div class="feature-custom-number">{{$count+$countLecture}}</div>
                                <div class="feature-custom-text">Lectures</div>
                            </div>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="course-details-tab corses-details-custom">
                    <div class="job-tab">
                    <div class="tab mb-0">
                    <?php $imageName = '';  $shareUrl = '';?>
                    @if(isset($getData->pkg_image) && !empty($getData->pkg_image))
                        <?php 
                            $imageName = filePath($getData->pkg_image);
                            $shareUrl = url('curriculum-'.request()->segment(2));
    // $shareUrl = route('packages.preview_board',[request()->segment(2),request()->segment(3),request()->segment(4)]);
                            $shareTitle = $getData->pkg_name;
                        ?>
                        <meta property="og:image" itemprop="image" content="{{$imageName}}">
                    @endif
                    <ul class="nav nav-tabs py-1 mb-0" role="tablist">
                       @if(!empty($getAddToCartData->enrollment_id))
                       <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#home" role="tab">Overview</a></li>
                       <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Curriculum</a></li>
                       <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages" role="tab">Package</a></li>
                      
                        
                       
                       
                        @else
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#home" role="tab">Overview</a></li>
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Curriculum</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages" role="tab">Package</a></li>
                       
                        @endif
                        
                    </ul>
                    
                    <ul class="social-media-list d-none">
                        <li><a class="" onclick="shareinsocialmedia('https://www.facebook.com/sharer/sharer.php?u={{$shareUrl}}&title={{$shareTitle}}')" href="javascript:void(0);">
                            <img src="{{asset('images/facebook.gif')}}" title="share in facebook">
                            </a>
                        </li>
                        <li>
                            <a onclick="shareinsocialmedia('http://twitter.com/home?status=<?php echo $shareTitle; ?>+<?php echo $shareUrl; ?>')" href="javascript:void(0);">
                                <img src="{{asset('images/twitter.gif')}}" title="share in twitter">
                            </a>
                        </li>
                        <li>
                            <a onclick="shareinsocialmedia('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $shareUrl; ?>&title=<?php echo $shareTitle; ?>')" href="javascript:void(0);">
                            <img src="{{asset('images/linkedin.gif')}}" title="share in linkexdin">
                            </a>
                        </li>
                        <li>
                            <a onclick="shareinsocialmedia('whatsapp://send?text=<?php echo $shareUrl; ?>')" href="javascript:void(0);">
                                <i class="fa fa-whatsapp"></i>Whats app
                            </a>
                        </li>
                        <li>
                            <a onclick="shareinsocialmedia('https://web.whatsapp.com?text=<?php echo $shareUrl; ?>')" href="javascript:void(0);">
                                <i class="fa fa-whatsapp"></i>web Whats app
                            </a>
                        </li>
                    </ul>
                    </div>
                    
                    </div>
                    @if(empty($getAddToCartData->enrollment_id))
                    
                    <p class="d-md-none d-lg-none d-sm-block"><a class="small text-info border border-info p-1" href="#buyscroll" role="tab">Customize your package</a></p>
                    @endif
                    <div class="tab-content">
                    @if(!empty($getAddToCartData->enrollment_id))
                    <div class="tab-pane  course-individual-tab" id="home">
                        @else
                        <div class="tab-pane  course-individual-tab" id="home">

                        @endif
                        <h3>Key Highlights</h3>
                        

                        <?php $short_desc = explode("\n",$getData->short_desc); ?>
                        
                        <?php

                                                    if(isset($short_desc) && count($short_desc)!=1){
                                                        

                                                        ?>
                                        <ul class="key-highlights mb-3">                
                                                <?php foreach($short_desc as $shortDesc){ 
                                                   
                                                    ?>  
                                                        <li>&nbsp;<?php echo $shortDesc;?></li>
                                                    <?php } 
                                                   
                                                    ?>
                                                        </ul>
                                                <?php  } ?>

                        <h3>Overview</h3>
                        <div class="text-justify mb-3 text show-more-height">
                            <?php echo $getData->big_description;?>

                            
                        </div>
                        <div class="text show-more-height">
                        <div class="show-more"></div>
                        </div>
                        <!-- <h3>Tags : <span class="tag-single">JEE Main</span>, <span class="tag-single">JEE Main</span>, <span class="tag-single">JEE Main</span>, <span class="tag-single">JEE Main</span>, <span class="tag-single">JEE Main</span>,</h3> -->
                        
                        @if(count($getFreeCourses)>0)
                        <h3>@if(count($getFreeCourses) !=0 && $getData->is_all_subject ==0)    Free Courses @else Premium Courses @endif ({{count($getFreeCourses)}})</h3>
                            @foreach($getFreeCourses as $freeCourse)                        
                                <div class="clearfix bg-light border p-2 mb-3 rounded">
                                    <h4>{{$freeCourse->title}}</h4>
                                    <div class="text-justify mb-3">
                                        @php echo $freeCourse->big_description;@endphp
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        
                    </div>
                    @if(!empty($getAddToCartData->enrollment_id))
                    <div class="tab-pane active course-individual-tab" id="profile">
                    @else
                    <div class="tab-pane active course-individual-tab" id="profile">

                    @endif
                        <h3>Course content</h3>
                        @php  $chptr = 0; @endphp
                    @if($getData->course_id!=0)
                       
                        <div class="row">
                            <div class="col-md-5">
                                <div class="course-title-custom">
                                <p><strong>{{$getData->title}}</strong> <span class="badge badge-warning">Premium</span></p>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul class="list-inline float-right">
                                <li class="list-inline-item">
                                    <div class="course-features-custom-2 d-flex">
                                        <div class="feature-custom-number">{{isset($s_course)?count($s_course->classes):'0'}}</div>
                                        @if($getData->course_id == 0)
                                        <div class="feature-custom-text">Subjects</div> 
                                            @else
                                            <div class="feature-custom-text">Chapters</div>
                                            @endif 
                                      
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="course-features-custom-2 d-flex">
                                        <div class="feature-custom-number">{{$count}}</div>
                                        <div class="feature-custom-text">Lectures</div>
                                    </div>
                                </li>
                                @if(!empty($getAddToCartData->enrollment_id))
                                <li class="list-inline-item d-inline-block">
                                    <?php //$s_course->slug.'_'.$getData->id ?>
                                    <div class="btn-success-custom">
                                        <a href="{{ route('package_details',[$s_course->slug,$getAddToCartData->enrollment_id]) }}" class="feature-custom-text">@translate(Go to lesson) <i class="la la-arrow-right"></i></a>
                                    </div>
                                </li>
                                @endif
                                </ul>
                            </div>
                        </div>  
                        <div class="curriculum-accordion mb-3">
                            <div id="accordionExample" class="accordion-wrapper tab-margin-bottom-50">
                        @if(!empty($s_course))  
                            @forelse ($s_course->classes as $item)
                                @if($item->contents->count()>0)
                                <div class="card">
                                <div id="heading{{ $item->id }}" class="card-header">
                                    <div class="d-flex align-items-center border pl-0">
                                        <!--<div class="bg-light-grey px-3 py-2">
                                            <input type="checkbox" name="chapter[]" id="chapter" class="chaptersel" value="" disabled="disabled"/>
                                            </div>--> <a class="w-100 border-0 bg-light rounded-0 collapsed d-flex justify-content-between" role="button" href="#" data-toggle="collapse" data-target="#collapse{{ $item->id }}" aria-expanded="false" aria-controls="collapse{{ $item->id }}">{{ $item->title }} <span class="mr-3">{{ $item->contents->count() }} @translate(lectures)</span></a>
                                    </div>
                                </div>
                                <div id="collapse{{ $item->id }}" class="collapse {{ $loop->first ? '' : '' }}" aria-labelledby="heading{{ $item->id }}" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @if(!empty($getAddToCartData->enrollment_id))        
                                             @php  
                                             $getCourse = explode(',',$getAddToCartData->course_id);  
                                             
                                             if(in_array($item->id,$getCourse))
                                             {
                                             @endphp   
                                                    @forelse ($item->contents as $content)

                                                    @php
                                                        $getCountMindMap = \App\Model\MindMap::where(['class_content_id' => $content->id])->get();
                                                    @endphp
                                                    @if ($content->is_preview == 1) 
                                                    <div class="single-course-video border-bottom mb-2 pb-1 d-flex">
                                                            
                                                         <a class="button-video v-small"><i class="fa fa-play-circle mr-2"></i> {{ $content->title }} &nbsp;&nbsp;@if($getCountMindMap->count()>0)<span class="badgemm" title="Mind Maps available, purchase to view.">Mind Maps<i class="fas fa-badge-check"></i></span> @endif</a>
                                                        <div class="property-course ml-auto">{{duration($content->duration)}}</div>
                                                    </div>
                                                    @else

                                                    <div class="single-course-video border-bottom mb-2 pb-1 d-flex">
                                                            
                                                            <a class="button-video v-small">@if($content->content_type == 'Video')
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @elseif($content->content_type == 'Document')
                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                        @else
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @endif {{ $content->title }} &nbsp;&nbsp;@if($getCountMindMap->count()>0)<span class="badgemm" title="Mind Maps available, purchase to view.">Mind Maps<i class="fas fa-badge-check"></i></span> @endif</a>
                                                           <div class="property-course ml-auto">{{duration($content->duration)}}</div>
                                                       </div>

                                                    @endif

                                                    @empty @translate(NO content) @endforelse
                                            @php  }else{  @endphp

                                                @forelse ($item->contents as $content)

                                                @php
                                                        $getCountMindMap = \App\Model\MindMap::where(['class_content_id' => $content->id])->get();
                                                    @endphp
                                                <div class="single-course-video border-bottom mb-2 pb-1 d-flex">
                                                            
                                                @if ($content->is_preview == 1) 
                                                        <a class="button-video"> <i class="fa fa-play-circle mr-2"></i>{{ $content->title }} &nbsp;&nbsp;@if($getCountMindMap->count()>0)<span class="badgemm" title="Mind Maps available, purchase to view.">Mind Maps<i class="fas fa-badge-check"></i></span> @endif</a>
                                                        <div class="property-course ml-auto">{{duration($content->duration)}}</div>
                                                        @else <a class="button-video v-small">@if($content->content_type == 'Video')
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @elseif($content->content_type == 'Document')
                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                        @else
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @endif
                                                                        {{ $content->title }}&nbsp;&nbsp;@if($getCountMindMap->count()>0)<span class="badgemm" title="Mind Maps available, purchase to view.">Mind Maps<i class="fas fa-badge-check"></i></span> @endif</a>
                                                        <div class="property-course ml-auto">
                                                          @if($content->demo_type!='' && ($content->demo_type=='video' || $content->demo_type=='file'))  
                                                              <span class=""> <a href="{{ route('package_details',[$s_course->slug,$getAddToCartData->enrollment_id]) }}">@translate(View)</a></span>
                                                          @else
                                                          <span class="locked"> <a> @translate(Locked)</a></span>
                                                          @endif
                                                              
                                                          &nbsp; {{duration($content->duration)}}</div>
                                                        @endif

                                                    </div>
                                                    @empty @translate(NO content) @endforelse    
                                                @php  }  @endphp     
                                            @else
                                                @forelse ($item->contents as $content)
                                                @php
                                                        $getCountMindMap = \App\Model\MindMap::where(['class_content_id' => $content->id])->get();
                                                    @endphp
                                                    <div class="single-course-video border-bottom mb-2 pb-1 d-flex">
                                                            
                                                        @if ($content->is_preview == 1) <a class="button-video v-small"> <i class="fa fa-play-circle mr-2"></i>{{ $content->title }} &nbsp;&nbsp;@if($getCountMindMap->count()>0)<span class="badgemm" title="Mind Maps available, purchase to view.">Mind Maps<i class="fas fa-badge-check"></i></span> @endif</a></a>
                                                        <div class="property-course ml-auto">{{duration($content->duration)}}</div>
                                                        @else <a class="button-video v-small">
                                                        @if($content->content_type == 'Video')
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @elseif($content->content_type == 'Document')
                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                        @else
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @endif
                                                        {{ $content->title }} &nbsp;&nbsp;@if($getCountMindMap->count()>0)<span class="badgemm" title="Mind Maps available, purchase to view.">Mind Maps<i class="fas fa-badge-check"></i></span> @endif</a></a>
                                                        <div class="property-course ml-auto">
                                                        @if($content->demo_type!='' && ($content->demo_type=='video' || $content->demo_type=='file') && !empty($content->demo_url))  
                                                        <span class=""> 
                                                             <a href="#!" data-toggle="modal" data-target="#myDemoUrl{{$content->id}}" class="badge bg-primary text-white"> @translate(Demo Video)</a>
                                                        </span>


                                                        <div class="modal fade" id="myDemoUrl{{$content->id}}" role="dialog">
                                                        
                                                                <div class="modal-dialog  modal-lg">
                                                                <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <button type="button" class="close position-absolute" data-dismiss="modal" style=" top: -10px; right: -10px;    z-index: 2;    background: #000; opacity: 1; text-shadow: none; color: #fff; width: 30px; height: 30px; border-radius: 50%;">×</button>
                                                                        
                                                                        <div class="modal-body mb-0 pb-0">
                                                                            <iframe loading="lazy" width="100%" height="500"
                                                                                        src="{{$content->demo_url}}"
                                                                                        frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" autoplay="1"
                                                                                        allowfullscreen></iframe>
                                                                        </div>
                                                                    
                                                                        
                                                                    </div>
                                                                
                                                                </div>
                                                        </div>
                                                            &nbsp;{{duration($content->demo_duration)}}
                                                          @else
                                                        <span class="locked"> <a> @translate(Locked)</a></spallow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreenan>
                                                        &nbsp;{{duration($content->duration)}}
                                                        @endif
                                                        
                                                        </div>
                                                        @endif

                                                    </div>
                                                    @empty @translate(NO content) 
                                                @endforelse
                                    
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @empty @translate(No Items) 
                            @endforelse 
                        @endif
                            </div>
                        </div>
                    @endif

                    @if($getData->is_all_subject==0) 
                            @if(count($getFreeCourses)>0)                 
                                <h3>Free Course</h3>
                            @endif
                    @endif
                        
                    
                    <!-- start free -->
                    @php $calLecs = 0; @endphp
                        @foreach($getFreeCourses as $getFreeData)
                            @php $chptr +=count($getFreeData->classes); @endphp
                        
                        <div class="row">
                                <div class="col-md-5">
                                    <div class="course-title-custom">
                                        <h5>{{$getFreeData->title}}  @if($getData->course_id==0) <span class="badge badge-warning">Premium</span>@endif</h5>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="list-inline float-right">
                                    <li class="list-inline-item">
                                        <div class="course-features-custom-2 d-flex">
                                            <div class="feature-custom-number">{{isset($getFreeData)?count($getFreeData->classes):'0'}}</div>
                                            <div class="feature-custom-text">Chapters</div>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="course-features-custom-2 d-flex">
                                            <div class="feature-custom-number" id="lecture_count_{{$getFreeData->id}}">0</div>
                                            <div class="feature-custom-text">Lectures</div>
                                        </div>
                                    </li>
                                    @if(!empty($getAddToCartData->enrollment_id))
                                    <li class="list-inline-item d-inline-block">
                                        <div class="btn-success-custom">
                                            <a href="{{ route('package_details',[$getFreeData->slug,$getAddToCartData->enrollment_id]) }}" class="feature-custom-text">@translate(Go to lesson) <i class="la la-arrow-right"></i></a>
                                        </div>
                                    </li>
                                    @endif
                                    </ul>
                                </div>
                            </div>
                            
                        
                        <div class="curriculum-accordion mb-3">
                            <div id="accordionExample" class="accordion-wrapper tab-margin-bottom-50">
                            @php $calLec = 0;@endphp
                        
                                @if(!empty($getFreeData->classes))
                                    <input id="totalChapterss" name="totalChapterss" type="hidden" value="{{count($getFreeData->classes)}}"/> 
                                    
                                    @foreach ($getFreeData->classes as $itemData)
                                      @if($itemData->contents->count()>0)
                                    {{$itemData->demo_type}}
                                            <div class="card">
                                                <div id="heading{{ $itemData->id }}" class="card-header">
                                                    <div class="d-flex align-items-center border pl-0">
                                                        <a class="w-100 border-0 bg-light rounded-0 collapsed d-flex justify-content-between" role="button" href="#"  data-toggle="collapse" data-target="#collapse{{ $itemData->id }}" aria-expanded="false" aria-controls="collapse{{ $itemData->id }}">{{ $itemData->title }} <span class="mr-3">{{ $itemData->contents->count() }} @translate(lectures)</span></a>
                                                    </div>
                                                </div>
                                                <div id="collapse{{ $itemData->id }}" class="collapse {{ $loop->first ? '' : '' }}" aria-labelledby="heading{{ $itemData->id }}" data-parent="#accordionExample">
                                                        
                                            
                                                
                                                <div class="card-body">
                                                        @forelse ($itemData->contents as $contentData)
                                                        @php
                                                                    $getCountMindMap = \App\Model\MindMap::where(['class_content_id' => $contentData->id])->get();
                                                                @endphp
                                                                <div class="single-course-video border-bottom mb-2 pb-1 d-flex" data-count="{{$itemData->contents->count()}}">
                                                                @if(!empty($getAddToCartData->enrollment_id))

                                                                
                                                                    {{-- @if ($contentData->is_preview == 1) --}}
                                                                            <a class="button-video v-small"> {{ $contentData->title }} &nbsp;&nbsp;@if($getCountMindMap->count()>0)<span class="badgemm" title="Mind Maps available, purchase to view.">Mind Maps<i class="fas fa-badge-check"></i></span> @endif</a>
                                                                            <div class="property-course ml-auto">{{duration($contentData->duration)}}</div>
                                                                    {{--  @else 
                                                                            <a class="button-video v-small">{{ $contentData->title }} </a>
                                                                            <div class="property-course ml-auto"><span class="locked"> <a> @translate(Locked)</a></span>
                                                                            &nbsp;{{duration($contentData->duration)}}</div> 
                                                                        @endif  --}}

                                                                        @else
                                                                        @if ($contentData->is_preview == 1)
                                                                            <a class="button-video v-small"> <i class="fa fa-play-circle mr-2"></i>{{ $contentData->title }} &nbsp;&nbsp;@if($getCountMindMap->count()>0)<span class="badgemm" title="Mind Maps available, purchase to view.">Mind Maps<i class="fas fa-badge-check"></i></span> @endif</a>
                                                                            <div class="property-course ml-auto">{{duration($contentData->duration)}}</div>
                                                                        @else 
                                                                            <a class="button-vide v-small">@if($contentData->content_type == 'Video')
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @elseif($contentData->content_type == 'Document')
                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                        @else
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @endif
                                                                        {{ $contentData->title }} &nbsp;&nbsp;@if($getCountMindMap->count()>0)<span class="badgemm" title="Mind Maps available, purchase to view.">Mind Maps<i class="fas fa-badge-check"></i></span> @endif</a>
                                                                            <div class="property-course ml-auto">
                                                                                
                                                                            
                                                                                @if($contentData->demo_type!='' && ($contentData->demo_type=='video' || $contentData->demo_type=='file') && !empty($contentData->demo_url))  
                                                                                        <span class=""> 
                                                                                            <a href="#!" data-toggle="modal" data-target="#myDemoUrl{{$contentData->id}}" class="badge bg-primary text-white"> @translate(Demo Video)</a>
                                                                                        </span>


                                                                                        <div class="modal fade" id="myDemoUrl{{$contentData->id}}" role="dialog">
                                                        
                                                                <div class="modal-dialog  modal-lg">
                                                                <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <button type="button" class="close position-absolute" data-dismiss="modal" style=" top: -10px; right: -10px;    z-index: 2;    background: #000; opacity: 1; text-shadow: none; color: #fff; width: 30px; height: 30px; border-radius: 50%;">×</button>
                                                                        
                                                                        <div class="modal-body mb-0 pb-0">
                                                                            <iframe loading="lazy" width="100%" height="500"
                                                                                        src="{{$contentData->demo_url}}"
                                                                                        frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" autoplay="1"
                                                                                        allowfullscreen></iframe>
                                                                        </div>
                                                                    
                                                                        
                                                                    </div>
                                                                
                                                                </div>
                                                        </div>
                                                                                            &nbsp; {{duration($contentData->demo_duration)}}
                                                                                    @else
                                                                                        <span class="locked"> <a> @translate(Locked)</a></spallow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreenan>
                                                                                        &nbsp; {{duration($contentData->duration)}}
                                                                                    @endif

                                                                            </div> 
                                                                        @endif  
                                                                    @endif
                                                                    </div>
                                                                    
                                                        @endforeach
                                                        </div>
                                            </div>
                                            </div>   
                                            @php $calLec += $itemData->contents->count(); @endphp
                                        @endif    
                                        @endforeach
                                        @php $calLecs = $calLec; @endphp
                                        <input type="hidden" name="idL[]" id="idL" value="{{$getFreeData->id}}">

                                        <input type="hidden" id="lecture_count_value_{{$getFreeData->id}}" value="{{$calLecs}}">
                                        
                                @endif
                            
                            </div>
                        </div>
                        @endforeach
                    <!-- end-->
                        
                    </div>
                    <div class="tab-pane course-individual-tab" id="messages">
                        <div class="text-justify mb-3">
                            @php echo $getData->pkg_desc; @endphp
                        </div>
                    </div>
                    </div>
                </div>
            </div>
           
            <div class="col-lg-4">
                                    <div class="course-details-sidebar border">
                                        
                                                    <div class="package-thumbnail">
                                                    <span class="position-absolute classs-block" style="left: 18px;" id="buyscroll">
                                                    {{ $getData->subName }}</span> 
                                                    <img src="{{ filePath($getData->pkg_image) }}" alt="{{ $getData->pkg_name }}">
                                                    </div>
                                    @if(!empty($getAddToCartData->enrollment_id))                                             
                                    <div class="content-right">
                                        <a href="{{ route('package_details',[$s_course->slug,$getAddToCartData->enrollment_id]) }}"
                                           class="btn btn-primary mt-2 pointer d-block">@translate(Go To lesson)</a>
                                    </div>                
                                    @endif        
                                    @if(empty($getAddToCartData->enrollment_id))
                                    
                                        <div class="course-details-widget">
                                            <div class="course-widget-title">
                                                <h6 class="border-bottom pb-2">Buy Now</h6>
                                            
                                            </div>
                                            
                                            <div class="course-widget-items">
                                                    <input type="hidden" name="selected_package" id="selected_package" value="qtrPrice">
                                                <div class="single-item">
                                                    <div class="item-left">
                                                        <span class="font-weight-bold"> @translate(Packages)</span>
                                                    </div>
                                                    
                                                    <div class="item-right">
                                                        <span class="font-weight-bold">Price</span>
                                                    </div>
                                                </div>
                                                @if(($getData->quarterly_coverage_price!='0.00' && $getData->quarterly_coverage_price!=null) && ($getData->quarterly_course_coverage!='0.00' && $getData->quarterly_course_coverage!=null))
                                                <div class="single-item">
                                                    <div class="item-left">
                                                        <span class="small"><input class="mr-1" type="radio" name="Price" id="qtrPrice" value="{{$getData->quarterly_coverage_price}}_3_{{$getData->quarterly_course_coverage}}" {{(!empty($getAddToCartData) && $getAddToCartData->package_type=='3')?'checked':''}}> Quarterly(3 Months)  </span>

                                                        <div class="p-0 m-0 line-height-1">
                                                        <button class="btn btn-v-small p-0 text-underline packages-show packages-show" onclick="viewPackage()" id="view_package_3" style="display:none"><u>Show selected package</u></button>
                                                        </div>
                                                    </div>
                                                    <div class="item-right">
                                                        <span class="small">Rs. {{$getData->quarterly_coverage_price}}</span>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(($getData->halfyrly_coverage_price!='0.00' && $getData->halfyrly_coverage_price!=null) && ($getData->halfyrly_course_coverage!='0.00' && $getData->halfyrly_course_coverage!=null))
                                                <div class="single-item">
                                                    <div class="item-left">
                                                        <span class="small"><input class="mr-1" type="radio" name="Price" id="hlfPrice"  value="{{$getData->halfyrly_coverage_price}}_2_{{$getData->halfyrly_course_coverage}}" {{(!empty($getAddToCartData) && $getAddToCartData->package_type=='2')?'checked':''}}> Half yearly(6 Months) </button></span>

                                                        <div class="p-0 m-0 line-height-1">
                                                        <button class="btn btn-v-small p-0 text-underline packages-show" onclick="viewPackage()" id="view_package_2" style="display:none"><u>Show selected package</u></button>
                                                        </div>

                                                    </div>
                                                    <div class="item-right">
                                                        <span class="small">Rs.  {{$getData->halfyrly_coverage_price}}</span>
                                                    </div>
                                                </div>
                                                @endif

                                                @if(($getData->annually_course_coverage!='0.00' && $getData->annually_course_coverage!=null) && ($getData->annually_coverage_price!='0.00' && $getData->annually_coverage_price!=null))
                                                <div class="single-item">
                                                    <div class="item-left">
                                                        <span class="small" ><input class="mr-1" type="radio" name="Price" id="yrlPrice" value="{{$getData->annually_coverage_price}}_1_{{$getData->annually_course_coverage}}" {{(!empty($getAddToCartData) && $getAddToCartData->package_type=='1')?'checked':'checked'}}> Yearly(1 Year)  
                                                    </span>
                                                        <div class="p-0 m-0 line-height-1">
                                                        <button class="btn btn-v-small p-0 text-underline packages-show" onclick="viewPackage()" id="view_package_1" style="display:none"><u>Show selected package</u></button>
                                                        </div>
                                                            
                                                    </div>
                                                    <div class="item-right">
                                                        <span class="small">Rs. {{$getData->annually_coverage_price}}</span>
                                                    </div>
                                                </div>
                                                @else

                                                <div class="single-item">
                                                    <div class="item-left">
                                                        <span class="small"><input class="mr-1" type="radio" name="Price" id="yrlPrice" value="" checked="checked"> Yearly(1 Year) 
                                                    </span>
                                                        <div class="p-0 m-0 line-height-1">
                                                        </div>
                                                            
                                                    </div>
                                                    <div class="item-right">
                                                        <span class="small">Rs. {{$getData->annually_coverage_price}}</span>
                                                    </div>
                                                </div>
                                                @endif
                                                {{--<div class="single-item">
                                                    <div class="item-left">
                                                        <span class="font-weight-bold"> @translate(Services)</span>
                                                    </div>
                                                    <div class="item-right">
                                                        <span class="font-weight-bold">Price</span>
                                                    </div>
                                                </div>--}} 
                                                {{--@if(count($getAddon)!=0) 
                                                    @foreach($getAddon as $val)
                                                        <div class="single-item">
                                                            <div class="item-left">
                                                                <span class="small">
                                                                    <input type="checkbox" name="addOnPrice[]" id="addOnPrice" value="{{$val->price}}_{{$val->addon_service_id}}" class="addonC" @php if(!empty($getAddToCartData)){$servId = explode(',',$getAddToCartData->service_id);if(in_array($val->addon_service_id,$servId)){echo 'checked="checked"';}}@endphp>
                                                                {{$val->service_name}}</span>
                                                            </div>
                                                            <div class="item-right">
                                                                <span class="small">Rs. {{$val->price}}</span>
                                                            </div>                                               
                                                        </div>  
                                                    @endforeach
                                                @endif--}}

                                            

                                                <div class="single-item">
                                                    <div class="item-left">
                                                        <span class="font-weight-bold">Total:</span>
                                                    </div>
                                                    
                                                    <div class="item-right">Rs.
                                                        <span class="font-weight-bold" id="subT">@php if(!empty($getAddToCartData)){echo $getAddToCartData->discount_price+$getAddToCartData->total_amount;}else{echo '0.00';}@endphp</span>
                                                    </div>
                                                </div>  
                                                <input type="hidden" name="default_discount" id="default_discount" value="{{$getData->default_discount}}">
                                                @if(isset($getData->default_discount) && $getData->default_discount!=0)
                                                <div class="single-item">
                                                    <div class="item-left">
                                                    <span class="small">Discount({{$getData->default_discount}}%)</span>
                                                    </div>
                                                    
                                                    <div class="item-right">Rs.
                                                    <span id="discountP" class="small">@php if(!empty($getAddToCartData->discount_price)){echo '-'.$getAddToCartData->discount_price;}else{echo '0.00';}@endphp</span>
                                                    </div>
                                                </div> 
                                                @endif
                                            {{--
                                                <div class="single-item">
                                                    <div class="item-left">
                                                    <span class="small"><input type="checkbox" name="member_discount" id="member_discount" value="{{$getData->member_discount}}">&nbsp;&nbsp;Member</span>
                                                    </div>
                                                    <div class="item-right">
                                                        <span class="small">{{$getData->member_discount}}%</span>
                                                    </div>
                                                </div>  
                                            --}}

                                                <div class="single-item">
                                                    <div class="item-left">
                                                        <span class="font-weight-bold text-success">Payable Amount: </span>
                                                    </div>
                                                    
                                                    <div class="item-right"><input type="hidden" id="totalPkgPrice" value="0.00">
                                                    <input type="hidden" id="pkgType" value="pkg">
                                                    <input type="hidden" id="service_id" value="">
                                                    <input type="hidden" id="discount_price" value="">
                                                    <input type="hidden" id="pkgselectType" value="">
                                                    <input type="hidden" id="course_id" value="">
                                                    <!-- package_type,service_id,course_id,discount_price pkgselectType-->
                                                    Rs. <span id="totalPrice" class="font-weight-bold text-success">@php if(!empty($getAddToCartData->total_amount)){echo $getAddToCartData->total_amount;}else{echo '0.00';}@endphp</span>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="course-widget-buttons">
                                                @if($getData->is_all_subject!=1)
                                                    <!-- <span id="isPackageCustomize">
                                                        <a href="#buyscroll"
                                                            class="template-button btn btn-block btn-warning"
                                                            onclick="customizePackage();">@translate(Add to cart)</a>
                                                    </span> -->
                                                @endif
                                                @auth()
                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                                    <span class="addToCartBtn" >
                                                        <a href="#buyscroll"
                                                        class="template-button btn btn-block btn-warning addToCart-{{$getData->id}}"
                                                        onclick="addToCart('{{$getData->id}}','{{route('add.to.cart')}}')">@translate(Add to cart)</a>
                                                    </span>
                                                    
                                                    @else
                                                    <span class="addToCartBtn" >
                                                        <a href="{{route('login')}}#buyscroll" class="template-button btn btn-block btn-warning">@translate(Add to cart)</a>
                                                    </span>
                                                    @endif
                                                    {{-- checkout --}}

{{-- PAYUMONEY PAYMENT GATEWAY --}}
    {{-- <form action="{{route('initiate.direct-payment')}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
        <input type="hidden" id="hashurl" name="hashurl" value="{{url('resources/views/addon/setup/payumoney/index.php')}}" />
        <input type="hidden" id="surl" name="surl" value="{{route('payumoney.payment')}}" />
        <input type="hidden" id="key" name="key" value="SWX8LxLC" /> <!--CaertTiG,Uuio8LHKPl -->
        <input type="hidden" id="salt" name="salt" value="cXhuLZsI4t" />
        <input type="hidden" id="txnid" name="txnid" value="{{ strtotime('now') }}" />

            <input type="hidden" id="amount" name="amount" value="">

        <input type="hidden" id="pinfo" name="pinfo" value="cart_payment" />
        <input type="hidden" id="fname" name="fname" value="{{ Auth::user()->name }}" />
        <input type="hidden" id="email" name="email" value="{{ Auth::user()->alternate_email_user }}" />
        <input type="hidden" id="mobile" name="mobile" value="{{ Auth::user()->email }}" />
        <input type="hidden" id="hash" name="hash" value="" />
        <div class="card">
            <input type="button" class="btn btn-primary" value="Pay" onclick="addToCartDirectCheckout('{{$getData->id}}','{{route('add.to.cart')}}');" />
        </div>
    </form> --}}
{{-- END PAYUMONEY PAYMENT GATEWAY --}}    

                                                {{--<span class="addToCartBtn" >
                                                    <a href="{{route('login')}}#buyscroll" class="btn btn-block btn-primary">@translate(Checkout PAY)</a>--}}
                                                </span>

                                                @endauth
                                                @guest
                                                <span class="addToCartBtn" >
                                                    <a href="{{route('login')}}#buyscroll" class="btn btn-block btn-warning">@translate(Add to cart)</a>
                                                </span>

                                                <span class="addToCartBtn" >
                                                    <a href="{{route('login')}}#buyscroll" class="btn btn-block btn-primary">@translate(Checkout PAY)</a>
                                                </span>

                                                @endguest
                                            </div> 
                                            {{--
                                            <div class="d-flex justify-content-center align-items-center my-3">
                                                <div class="card-coupon text-center">
                                                    <div class="image"><img src="https://i.imgur.com/DC94rZe.png" width="150"></div>
                                                    <div class="image2"><img src="https://i.imgur.com/DC94rZe.png" width="150"></div>
                                                    <span class="d-block text-uppercase mb-2">Apply Coupon</span>
                                                    <h1>LAUNCH100</h1><span class="d-block">at checkout page to get this course for</span><span class="d-block font-weight-bold">FREE</span>
                                                    
                                                </div>
                                            </div>
                                            --}}
                                        </div>
                                    </div> 
                                    @endif
                                </div>
            </div>
            
        </div>

    </div>
</section>

    </div>
            @if(empty($getAddToCartData->enrollment_id))
                @if($getData->course_id!=0) 
    
                    <div id="mySidenav" class="sidenav">
                        <p class="position-relative font-weight-bold">Customize your package now <a href="javascript:void(0)" class="closebtn" onclick="closeSideNav()">&times;</a><br/><span class="small text-success text-justify" id="errorMsg"></span></p>

                        <div class="tab-two-content tab-content-bg curriculum-content lost">
                            <div class="curriculum-sidebaraccordion margin-top-30">
                                <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                    <small id="checkAll" style="cursor:pointer;display:none" >Select All</small>
                                    @if(!empty($s_course))
                                    <?php $i=0;?>
                                    @forelse ($s_course->classes as $item)
                                                @if($item->contents->count()>0)
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $item->id }}">
                                            <div class="d-flex align-items-center border pl-0">
                                            <div class="bg-light px-3 py-2">
                                            <input type="checkbox" name="chapter[]" id="chapter{{ $item->id }}" class="chaptersel" value="{{ $item->id }}" @php if(!empty($getAddToCartData)){$servId = explode(',',$getAddToCartData->course_id);if(in_array($item->id,$servId)){echo 'checked="checked"';}}@endphp/>
                                            </div>
                                            <a href="#" class="small w-100 border-0 collapsed" role="button" data-toggle="collapse"
                                                data-target="#collapsesidebar{{ $item->id }}" aria-expanded="false"
                                                aria-controls="collapsesidebar{{ $item->id }}">{{ $item->title }} <span>
                                                    {{ $item->contents->count() }} @translate(lectures)</span></a>
                                                </div>

                                            </div>
                                            <div id="collapsesidebar{{ $item->id }}"
                                                class="collapse {{ $loop->first ? '' : '' }}"
                                                aria-labelledby="heading{{ $item->id }}"
                                                data-parent="#accordionExample">
                                                <div class="card-body">
                                                    @forelse ($item->contents as $content)
                                                        <div class="single-course-video single-course-video border-bottom mb-2 pb-1 line-height-1 d-block">
                                                            @if ($content->is_preview == 1)
                                                                <a href="javascript:void(0)"
                                                                class="button-video d-block w-100 mb-1 line-height-1 v-small"
                                                                onclick="forModal('{{ route('content.video.preview', $content->id) }}', '{{$content->title}}')">
                                                                    <i class="fa fa-play-circle mr-2"></i>{{ $content->title }}
                                                                </a>
                                                                {{-- commented by Ashish on 17 Feb 2022 because enrollment_id was not found
                                                                    <span class="badge-label"><a href="{{ route('package_details',[$s_course->slug,$getAddToCartData->enrollment_id]) }}">@translate(View)</a></span>
                                                                    --}}
                                                                
                                                            @else
                                                                <a class="button-video d-block w-100 mb-1 line-height-1 v-small" href="javascript:void(0)">
                                                                        @if($content->content_type == 'Video')
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @elseif($content->content_type == 'Document')
                                                                            <i class="fa fa-file-pdf mr-2"></i>
                                                                        @else
                                                                            <i class="fa fa-play-circle mr-2"></i>
                                                                        @endif
                                                                        {{ $content->title }}
                                                                </a>
                                                                <span class="locked mr-2">
                                                                    <a href="javascript:void(0)">@translate(Locked)</a></span>
                                                            @endif

                                                            <span class="badge badge-warning">&nbsp;{{duration($content->duration)}}</span>
                                                        </div>
                                                    @empty
                                                        @translate(NO content)
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <!--  <div class="alert p-0 border-0 rounded-0">
                                        <marquee class="mb-0 pb-0 text-danger line-height-1 small" width="100%" direction="left" scrollamount="4">
                                            This is a sample scrolling text that has scrolls in the upper direction.
                                        </marquee>
                                        </div> -->
                                        <?php $i++;?>
                                        @endif    
                                    @empty
                                        @translate(No Items)
                                    @endforelse
                                    <input type="hidden" name="totalChapter" id="totalChapter" value="{{$i}}"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                    
                    </div>
                @endif
            @endif




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

/*add cart or wishlist*/
function addToCartDirectCheckout(course_id, url) {
    alert('====');
    if (course_id != null && url != null) {

        var pkgtype = '';
        var pkgPrice = 0.00;
        var discount_price = 0.00;
        var service_id = '';
        var pkgselectType = '';
       // var course_id = '';
        var chapterId = '';

        if($('#pkgType').val()!='')
        {
            pkgtype = $('#pkgType').val();
        }
        else
        {
            pkgtype = '';
        }

        if($('#totalPkgPrice').val()!='')
        {
            pkgPrice = $('#totalPkgPrice').val();
        }
        else
        {
            pkgPrice = '';
        }

        if($('#discount_price').val()!='')
        {
            discount_price = $('#discount_price').val();
        }
        else
        {
            discount_price = '';
        }

        if($('#service_id').val()!='')
        {
            service_id = $('#service_id').val();
        }
        else
        {
            service_id = '';
        }
        if($('#pkgselectType').val()!='')
        {
            pkgselectType = $('#pkgselectType').val();
        }
        else
        {
            pkgselectType = '';
        }

        if($('#course_id').val()!='')
        {
            chapterId = $('#course_id').val();
        }
        else
        {
            chapterId = '';
        }

        //course_id = course_id.split('-');service_id discount_price pkgselectType
       /* $.ajax({
            url: url,
            method: 'GET',
            data: {cart: course_id,
                    pkgtype:pkgtype,
                    price: pkgPrice,
                    service_id:service_id,
                    discount_price:discount_price,
                    pkgselectType:pkgselectType,
                    course_id : chapterId                 
                  }, 
            success: function (result) {
                //alert(result);
                $.notify.defaults({
                    elementPosition: 'middle right',
                    globalPosition: 'right middle',
                })
                if (result.id_is != null) {
                    
                    $.notify('Removed Successfully', 'info')
                    $(".love-" + result.id_is).prop("href", '#!');
                    $(".love-" + result.id_is).removeClass('primary-color-2');
                    $(".love-" + result.id_is).removeClass('icon-color');
                    $(".love-span-" + result.id_is).removeClass('la-heart-o');
                    $(".love-span-" + result.id_is).addClass('la-heart-o');
                } else {

                    $.notify('Added Successfully', 'success')
                }
                cartList(course_id,pkgtype);
               // wishList();
                //enrollCourse();
            }
        })*/
    } else {
        location.reload()
    }

}








    var showSidebar = false;
</script>
@if($getData->is_all_subject==1) 
<script>
    var showSidebar = false;
</script>
@endif
<script language="JavaScript" type="text/javascript">

$(document).on('click','#checkAll',function () {
   if($('.chaptersel:checked').length>0)
   {
    $(".chaptersel").prop('checked', false);
        $(this).html('Deselect All');
   }else{
    $(".chaptersel").prop('checked', true);
        $(this).html('Select All');
   }
   
});

$(document).ready(function () { 
    
        if(showSidebar==false){
            var value = $($("#yrlPrice")).val();
        }else{
            var value = $($("#qtrPrice")).val();   
        }

        if($("[name=Price]").is(":visible")){
                var spltVal = value.split('_');
                spltVal[2]= (spltVal[2]=='100.00' || spltVal[2]=='100' || spltVal[2] == '') ? 100 : spltVal[2];
                default_discount = $('#default_discount').val();
                spltVal[2]= (spltVal[2]=='100.00' || spltVal[2]=='100' || spltVal[2] == '') ? 100 : spltVal[2];
                var totalChapter = parseInt(($('#totalChapter').val())*parseInt(spltVal[2])/100);
            setTimeout(function() {
                $("#yrlPrice").trigger('click');
                if(showSidebar==false) firstTimeCheckChapters('all');
                //openSideNav(); 
            },10); 
        }
    //closeSideNav(); 
    var idL =  $("input[name^='idL']").length;
    var idsArr = $("input[name^='idL']");
    var arr_val = '';
    var totalMainChaper = 0;
    for(var i=0;i<=idL;i++) {
        arr_val =  idsArr.eq(i).val();
        //alert(arr_val);
        if(arr_val)
        {
            var content_real_count = $('#lecture_count_value_'+arr_val).val();
            $('#lecture_count_'+arr_val).html(content_real_count);
            totalMainChaper = parseInt(totalMainChaper) + parseInt(content_real_count);
        }
        
    } 
   
    //     var value = $($("#qtrPrice")).val();
    //     var spltVal = value.split('_');
    //     default_discount = $('#default_discount').val();
    //     totalChapter = parseInt($('#totalChapter').val())/parseInt(spltVal[1]);

    //     firstTimeCheckChapters(totalChapter);
    

    // $("#yrlPrice").on("click",function() {
    //     firstTimeCheckChapters('all');
    // });
});
function customizePackage()
{
    var value = $("[name=Price]:checked").val();
    var spltVal = value.split('_');
    spltVal[2]= (spltVal[2]=='100.00' || spltVal[2]=='100' || spltVal[2] == '') ? 100 : spltVal[2];
    var totalChapter = parseInt(($('#totalChapter').val())*parseInt(spltVal[2])/100);
    if(totalChapter < 1) totalChapter =1;
    if($('.chaptersel:checked').length==0){
        swal("Please customize your package");
        openSideNav();
        return false;
    }else if($('.chaptersel:checked').length==0){//$('.chaptersel:checked').length<parseInt(totalChapter)
        swal("Please select "+ parseInt(totalChapter) +" topics");
        document.getElementById("mySidenav").style.width = "310px";
        document.getElementById("mySidenav").style.right = "0";
        return false;
    }else{
        $(".packages-show").hide();
        $("#view_package_"+spltVal[1]).show();
        $('#isPackageCustomize').hide();
        $('.addToCartBtn').show();
        //alert($('.chaptersel:checked').length+'------'+parseInt(totalChapter));
    }
}
function viewPackage()
{   
    document.getElementById("mySidenav").style.width = "310px";
    document.getElementById("mySidenav").style.right = "0";
    let str = $('#course_id').val();
    //alert(str);
    
    if(str!=''){
        const myArr = str.split(',');
        $.each(myArr,function(item){
            $("#chapter"+item).checked = true;
        });
    }
    
    
}
function firstTimeCheckChapters(totalChapter)
{
    if ($("input:radio[name='Price']").is(":checked")) {
        $(".chaptersel").removeAttr("disabled");
        if(totalChapter=='all'){
            calculateCoursePrice(); $('.chaptersel').prop("checked", true);
        }  
        else {
            $('.chaptersel').prop("checked", false);
            var count = 0;
            $('.chaptersel').each(function(){
                if(parseInt(totalChapter)>count)
                {
                    $('.chaptersel')[count].checked = true;
                }else {  $('.chaptersel')[count].checked = false; }
                count++;
            });
         }
    }
}
$(document).on('change','[name=Price]',function(){
    var previousId = $("#selected_package").val();
    
    if(showSidebar==false){
        //$('.chaptersel').prop("checked", true);
        calculateCoursePrice();
    }else{
            if($('.chaptersel:checked').length>0 && $('.packages-show').is(":visible")){
            swal({
                title: "Are you sure?",
                text: 'Your customization will be lost on changing package type. Press "OK" to confirm and proceed or "Cancel" to continue with the same.',
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    @auth
                        @if(Auth::user()->user_type == 'Student')
                            url = "{{route('packages.remove.aks',[request()->segment(3)])}}";
                            $.ajax({
                                url: url,
                                data: {"package_id": '{{request()->segment(3)}}',"user_id":'{{Auth::user()->id}}'},
                                method: 'GET',
                                success: function (result) {
                                    console.log(result);
                                }
                            });
                        @endif
                    @endauth
                    $('.packages-show').hide();
                    $("#selected_package").val($(this).attr('id'));
                    $('.chaptersel').prop('checked', false);
                    $('#isPackageCustomize').show();
                    $('.addToCartBtn').hide();
                    openSideNav();
                } else {                
                    $('#'+previousId).prop('checked', true);
                    $(this).prop('checked', false);
                }
                });
        }else{
            openSideNav();
        }
    }
    
    
});
function calculateCoursePrice()
{
        var default_discount  = 0.00;
        var subTotal = 0.00;
        var discount = 0.00;
        var totalPrice = 0.00;
        var totalChapter = 1;
        var totalPkgPrice =0.00;
        var subT = 0.00;
        $("#errorMsg").html('');
        

        var value = $("[name=Price]:checked").val();

        var spltVal = value.split('_');
        default_discount = $('#default_discount').val();
        spltVal[2]= (spltVal[2]=='100.00' || spltVal[2]=='100' || spltVal[2] == '') ? 100 : spltVal[2];
        var totalChapter = parseInt(($('#totalChapter').val())*parseInt(spltVal[2])/100);
        if(totalChapter < 1) totalChapter =1;
        totalChapter = totalChapter || 0
        $("#errorMsg").html("You can Choose Maximum "+parseInt(totalChapter)+" Topic in this Package.");

        //firstTimeCheckChapters(totalChapter);
        $('.chaptersel').prop("checked", false);
        var val = '';
        var count = 0;
       
        $('.chaptersel:checked').each(function(){
            if(parseInt(totalChapter)==count)
            {
                $("#errorMsg").removeClass('small text-success text-justify');
                $("#errorMsg").addClass('small text-danger text-justify');
                $(this).prop("checked", false);
                return false;
            }else
            {
                $("#errorMsg").removeClass('small text-danger text-justify');
                $("#errorMsg").addClass('small text-success text-justify');
                val += $(this).val()+',';
            } 
            count++;
        });
        str = val.replace(/,\s*$/, "");
        var addOnPrice = 0.00;
        var servId = '';
        $('.addonC:checked').each(function() {
            addonVl = $(this).val();
            splitData = addonVl.split('_');
            addOnPrice +=parseFloat(splitData[0]);                
            servId += (splitData[1])+',';
        });
        servId = servId.replace(/,\s*$/, "");
        subTotal = parseFloat(spltVal[0]) + parseFloat(addOnPrice);
        discount = parseFloat(subTotal) * default_discount / 100;
        totalPrice = parseFloat(subTotal) - parseFloat(discount);
        totalPrice = totalPrice || 0;
        subTotal = subTotal || 0;
        $('#totalPrice').html(totalPrice.toFixed(2));
        $('#amount').val(totalPrice.toFixed(2));

        $('#discountP').html('-'+discount.toFixed(2));
        $('#totalPkgPrice').val(totalPrice.toFixed(2));
        $('#discount_price').val(discount.toFixed(2));
        $('#service_id').val(servId);
        $('#pkgselectType').val(spltVal[1]);
        $('#course_id').val(str);
        $('#subT').html(subTotal.toFixed(2));
}
$(document).on("click",".addonC",function() {
    calculateCoursePrice();
});
$(document).on("click",".chaptersel",function() {
    $("#errorMsg").html('');
    var value = $("[name=Price]:checked").val();
    var spltVal = value.split('_');
    default_discount = $('#default_discount').val();
    spltVal[2]= (spltVal[2]=='100.00' || spltVal[2]=='100' || spltVal[2] == '') ? 100 : spltVal[2];
    var totalChapter = parseInt(($('#totalChapter').val())*parseInt(spltVal[2])/100);
    if(totalChapter < 1) totalChapter =1;
    $("#errorMsg").html("You can Choose Maximum "+parseInt(totalChapter)+" Topic in this Package.");
    var val = '';
    var count = 0;
    $('.chaptersel:checked').each(function(){
        if(parseInt(totalChapter)==count)
        {
            $("#errorMsg").removeClass('small text-success text-justify');
            $("#errorMsg").addClass('small text-danger text-justify');
            $(this).prop("checked", false);
            return false;
        }else
        {
            $("#errorMsg").removeClass('small text-danger text-justify');
            $("#errorMsg").addClass('small text-success text-justify');
            val += $(this).val()+',';
        } 
        count++;
    });
    str = val.replace(/,\s*$/, "");
    var addOnPrice = 0.00;
    var servId = '';
    $('.addonC:checked').each(function() {
        addonVl = $(this).val();
        splitData = addonVl.split('_');
        addOnPrice +=parseFloat(splitData[0]);                
        servId += (splitData[1])+',';
    });
    servId = servId.replace(/,\s*$/, "");
    subTotal = parseFloat(spltVal[0]) + parseFloat(addOnPrice);
    discount = parseFloat(subTotal) * default_discount / 100;
    totalPrice = parseFloat(subTotal) - parseFloat(discount);
    $('#totalPrice').html(totalPrice.toFixed(2));
    $('#amount').val(totalPrice.toFixed(2));
    
    $('#discountP').html('-'+discount.toFixed(2));
    $('#totalPkgPrice').val(totalPrice.toFixed(2));
    $('#discount_price').val(discount.toFixed(2));
    $('#service_id').val(servId);
    $('#pkgselectType').val(spltVal[1]);
    $('#course_id').val(str);
    $('#subT').html(subTotal.toFixed(2));
});
function openSideNav()
{
    
    // alert();
    // var value = $("[name=Price]:checked").val();
    // var spltVal = value.split('_');
    // var totalChapter = parseInt($('#totalChapter').val())/parseInt(spltVal[1]);
    // if(totalChapter < 1) totalChapter =1;
    // if($("[name=Price]:checked").length>0){
    //     swal("Your Customization will be lost1");
    //     if($('.chaptersel:checked').length==parseInt(totalChapter)){
    //         swal("Your Customization will be lost");
    //     }
    // }
   
    calculateCoursePrice();
    
    document.getElementById("mySidenav").style.width = "310px";
    document.getElementById("mySidenav").style.right = "0";
    if($('#yrlPrice').is(':checked')){
        $('#checkAll').show();
    }else{
        $('#checkAll').hide();
    }
}
function closeSideNav()
{
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("mySidenav").style.right = "-40px";

    var value = $("[name=Price]:checked").val();
    var spltVal = value.split('_');
    spltVal[2]= (spltVal[2]=='100.00' || spltVal[2]=='100' || spltVal[2] == '') ? 100 : spltVal[2];
    var totalChapter = parseInt(($('#totalChapter').val())*parseInt(spltVal[2])/100);
    if(totalChapter < 1) totalChapter =1;
    
    if($('.chaptersel:checked').length==parseInt(totalChapter)){
        $("#view_package_"+spltVal[1]).show();
        $('#isPackageCustomize').hide();
        $('.addToCartBtn').show();
    }

}

</script>
<!--<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>-->
<script>
    $(".show-more").click(function () {
        //$(this).text("(Show Less)");
    $(".text").toggleClass("show-more-height");
    });
function shareinsocialmedia(url){
    //window.open(url,'sharein','toolbar=0,status=0,width=648,height=395');
    window.location.href = url;
    return true;
}
</script>
    

@endsection
