@extends('rumbok.app')

@section('content')

<style>



.header-search1 form button {
    color: #ffffff;
    background-color: #ffa02b;
    border: none;
    padding: 10px 15px;
    border-radius: 0px 10px 10px 0px;
    position: absolute;
    bottom: 1px;
    right: 0px;
    margin: 27px 16px 78px 0px;
}
.header-search1 form input {
    border: 1px solid #fad2a9;
    border-radius: 10px;
    width: 100%;
    height: 35.5px;
</style>
    {{--new design--}}

    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape" class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        
        </div>
    </section>

    <!-- Package Section(Board) -->
    <section class="course-category-section padding-top-30 padding-bottom-90">
                <div class="container">
                    <div class="row">
                       
<!-- Start-->
                        @forelse($getData as $pksetting)

                            <div class="col-md-4 mb-3">
                                <div class="course-single-item shadow pb-0 mb-0 single-course-item {{$loop->index++ %2 == 0 ? 'diffrent-bg' :'rumon'}}">
                                    <div class="course-image" >
                                        <img src="{{ filePath($pksetting->pkg_image) }}" alt="{{ $pksetting->pkg_name }}" style="height: 40% !important;">
                                        {{-- <i class="badge showcs">{{$pksetting->subName}}</i> --}}
                                    </div>
                                    <div class="course-content">
                                        <div class="course-title margin-top-10">
                                            <h5 class="mb-1">{{$pksetting->pkg_name}}</h5>
                                          {{--  @if($pksetting->quarterly_course_coverage!='')
                                                <span class="badge badge-info p-1"><i class="fa fa-inr p-1"></i>{{round($pksetting->quarterly_coverage_price,2)}} / 3 Months</span>
                                            @elseif($pksetting->halfyrly_course_coverage!='')
                                                <span class="badge badge-info p-1"><i class="fa fa-inr p-1"></i>{{round($pksetting->halfyrly_coverage_price,2)}} / 6 Months</span>
                                            @else
                                                <span class="badge badge-info p-1"><i class="fa fa-inr p-1"></i>{{round($pksetting->annually_coverage_price,2)}} / Yearly</span>
                                            @endif
--}}




<strong>Available in :</strong>
                                            @if(($pksetting->quarterly_course_coverage!=null && $pksetting->quarterly_course_coverage!='0.00') && ($pksetting->halfyrly_course_coverage!=null && $pksetting->halfyrly_course_coverage!='0.00') && ($pksetting->annually_course_coverage!=null && $pksetting->annually_course_coverage!='0.00'))
                                                <span class="small badge badge-warning p-1 m-1">3 Months </span>
                                                <span class="small badge badge-info p-1 m-1" >6 Months </span>
                                                <span class="small badge badge-info p-1 m-1" >Yearly</span>
                                            @elseif(($pksetting->quarterly_course_coverage=='0.00' && $pksetting->quarterly_course_coverage==null) && ($pksetting->halfyrly_course_coverage!=null && $pksetting->halfyrly_course_coverage!='0.00') && ($pksetting->annually_course_coverage!=null && $pksetting->annually_course_coverage!='0.00'))
                                                <span class="small badge badge-warning p-1 m-1">6 Months </span>
                                                <span class="small badge badge-info p-1 m-1" >Yearly</span>
                                            @elseif(($pksetting->quarterly_course_coverage!=null && $pksetting->quarterly_course_coverage!='0.00') && ($pksetting->halfyrly_course_coverage==null && $pksetting->halfyrly_course_coverage=='0.00') && ($pksetting->annually_course_coverage!=null && $pksetting->annually_course_coverage!='0.00'))
                                                <span class="small badge badge-warning p-1 m-1">3 Months </span>
                                                <span class="small badge badge-info p-1 m-1" >Yearly</span>
                                            @elseif(($pksetting->quarterly_course_coverage=='0.00' && $pksetting->quarterly_course_coverage==null) && ($pksetting->halfyrly_course_coverage==null && $pksetting->halfyrly_course_coverage=='0.00') && ($pksetting->annually_course_coverage!=null && $pksetting->annually_course_coverage!='0.00'))
                                                <span class="small badge badge-warning p-1 m-1" >Yearly</span>
                                            @elseif(($pksetting->quarterly_course_coverage!=null && $pksetting->quarterly_course_coverage!='0.00') && ($pksetting->halfyrly_course_coverage!=null && $pksetting->halfyrly_course_coverage!='0.00') && ($pksetting->annually_course_coverage==null && $pksetting->annually_course_coverage=='0.00'))
                                                <span class="small badge badge-warning p-1 m-1">3 Months </span>
                                                <span class="small badge badge-info p-1 m-1">6 Months </span>
                                            @else
                                            <span class="small badge badge-warning p-1 m-1">Free </span>
                                            @endif
{{--
                                            @if(($pksetting->quarterly_course_coverage!=null && $pksetting->quarterly_course_coverage!='0.00') && ($pksetting->halfyrly_course_coverage!=null && $pksetting->halfyrly_course_coverage!='0.00') && ($pksetting->annually_course_coverage!=null && $pksetting->annually_course_coverage!='0.00'))
                                            <i class="fa fa-inr p-1"></i><span class="badge badge-info p-1"><span class="font-size-18">{{round($pksetting->quarterly_coverage_price,2)}} </span>/ 3 Months</span>

                                            @elseif(($pksetting->quarterly_course_coverage=='0.00' && $pksetting->quarterly_course_coverage==null) && ($pksetting->halfyrly_course_coverage!=null && $pksetting->halfyrly_course_coverage!='0.00') && ($pksetting->annually_course_coverage!=null && $pksetting->annually_course_coverage!='0.00'))
                                            <span class="badge badge-info p-1"><i class="fa fa-inr p-1"></i>{{round($pksetting->halfyrly_coverage_price,2)}} / 3 Months</span>

                                            @elseif(($pksetting->quarterly_course_coverage!=null && $pksetting->quarterly_course_coverage!='0.00') && ($pksetting->halfyrly_course_coverage==null && $pksetting->halfyrly_course_coverage=='0.00') && ($pksetting->annually_course_coverage!=null && $pksetting->annually_course_coverage!='0.00'))
                                            <span class="badge badge-info p-1"><i class="fa fa-inr p-1"></i>{{round($pksetting->quarterly_coverage_price,2)}} / 3 Months</span>

                                            @elseif(($pksetting->quarterly_course_coverage=='0.00' && $pksetting->quarterly_course_coverage==null) && ($pksetting->halfyrly_course_coverage==null && $pksetting->halfyrly_course_coverage=='0.00') && ($pksetting->annually_course_coverage!=null && $pksetting->annually_course_coverage!='0.00'))
                                            <span class="badge badge-info p-1"><i class="fa fa-inr p-1"></i>{{round($pksetting->annually_coverage_price,2)}} / 3 Months</span>
                                            @elseif(($pksetting->quarterly_course_coverage!=null && $pksetting->quarterly_course_coverage!='0.00') && ($pksetting->halfyrly_course_coverage!=null && $pksetting->halfyrly_course_coverage!='0.00') && ($pksetting->annually_course_coverage==null && $pksetting->annually_course_coverage=='0.00'))
                                                <span class="badge badge-info p-1"><i class="fa fa-inr p-1"></i>{{round($pksetting->quarterly_coverage_price,2)}} / 3 Months</span>
                                            @else
                                            <span class="small badge badge-warning p-1 ">Free </span>
                                            @endif


                                            --}}
                                            <br/>
                                            @php
                                                    $freeData = explode(',',$pksetting->free_subject);
                                                    $course_chapter_count =  getCountData($pksetting->course_id,$freeData);

                                             @endphp
                                            <span class="small badge badge-warning p-1 m-1">{{$course_chapter_count[0]}} Chapters</span>
                                                <span class="small badge badge-danger p-1 m-1" > 

                                                    {{$course_chapter_count[1]}}
                                                         Lectures </span>
                                            
                                        </div>
                                        
                                        <div class="course-discription margin-top-10">
                                        <?php 
                                        
                                        $short_desc = explode("\n",$pksetting->short_desc); 

                                            if(isset($short_desc) && count($short_desc)!=1){
                                                $i=0;

                                                ?>
                                           <?php foreach($short_desc as $shortDesc){ 
                                              
                                               ?>  
                                                <i class="fa fa-check"></i>&nbsp;<?php echo $shortDesc;?><br/>
                                            <?php $i++;} 
                                            
                                            ?>
                                                
                                        <?php  } ?>
                                        </div>
                                      
                                        <div class="course-instructor-rating margin-top-20 mb-2">
                                       {{--  <p><strong>Available in :</strong></p>
                                            @if($pksetting->quarterly_course_coverage!='' && $pksetting->halfyrly_course_coverage!='' && $pksetting->annually_course_coverage!='')
                                                <span class="small badge badge-warning p-1 m-1">3 Months </span>
                                                <span class="small badge badge-info p-1 m-1" >6 Months </span>
                                                <span class="small badge badge-info p-1 m-1" >Yearly</span>
                                            @elseif($pksetting->quarterly_course_coverage=='' && $pksetting->halfyrly_course_coverage!='' && $pksetting->annually_course_coverage!='')
                                                <span class="small badge badge-warning p-1 m-1">6 Months </span>
                                                <span class="small badge badge-info p-1 m-1" >Yearly</span>
                                            @elseif($pksetting->quarterly_course_coverage!='' && $pksetting->halfyrly_course_coverage=='' && $pksetting->annually_course_coverage!='')
                                                <span class="small badge badge-warning p-1 m-1">3 Months </span>
                                                <span class="small badge badge-info p-1 m-1" >Yearly</span>
                                            @elseif($pksetting->quarterly_course_coverage=='' && $pksetting->halfyrly_course_coverage=='' && $pksetting->annually_course_coverage!='')
                                                <span class="small badge badge-warning p-1 m-1" >Yearly</span>
                                            @elseif($pksetting->quarterly_course_coverage!='' && $pksetting->halfyrly_course_coverage!='' && $pksetting->annually_course_coverage=='')
                                                <span class="small badge badge-warning p-1 m-1">3 Months </span>
                                                <span class="small badge badge-info p-1 m-1">6 Months </span>
                                            @else
                                            <span class="small badge badge-warning p-1 m-1">Free </span>
                                            @endif
                                           --}}
                                            
                                        </div>
                                       
                                        @auth
                                        <?php
                                            $checkPackege = App\Model\Enrollment::where(['user_id'=>Auth::user()->id,'package_id'=>$pksetting->id])->exists();
                                            
                                        ?>
                                            @if($checkPackege)
                                                <div class="clearfix text-center">
                                                    <a href="{{url('my/packages')}}" class="btn btn-block btn-sm btn-success" >
                                                    Go to lesson</a>
                                                </div>
                                            @else
                                            <div class="clearfix text-center">
                                                    <a href="{{route('packages.preview_board',$pksetting->id)}}" class="btn btn-block btn-sm btn-success" >
                                                    View Details</a>
                                            </div>
                                            @endif
                                        @endauth
                                        @guest
                                        <div class="clearfix text-center">
                                            <a href="{{route('packages.preview_board',$pksetting->id)}}" class="btn btn-block btn-sm btn-success" >
                                            View Details</a>
                                        </div>
                                        @endguest
                                        
                                        
                                    </div>
                                   
                                </div>
                                
                            </div>
                        @empty

                            /* <div class="col-12 m-5">
                                <img src="{{asset('no_data.png')}}" class="w-100 img-fluid">
                            </div> */
                        @endforelse

<!-- End -->
                    </div><div class="float-right">{{ $getData->links() }}</div>
                </div>
    </section>
@endsection


<script>
$(document).ready(function(){
	$(".dropdown-cat").click(function(){
	   $(this).toggleClass("open");
	});
});
</script>
@include('layouts.modal')

@include('sweetalert::alert')
@yield('js')