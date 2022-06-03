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
                            <div class="col-md-3 mb-3">
                                <div class="course-single-item shadow pb-0 mb-0 single-course-item {{$loop->index++ %2 == 0 ? 'diffrent-bg' :'rumon'}}">
                                    <div class="course-image" >
                                        <img src="{{ filePath($pksetting->pkg_image) }}" alt="{{ $pksetting->pkg_name }}" style="height: 40% !important;">
                                        {{-- <i class="badge showcs">{{$pksetting->subName}}</i> --}}
                                    </div>
                                    <div class="course-content">
                                        <div class="course-title margin-top-10">
                                            <h5 class="mb-1">{{$pksetting->pkg_name}}</h5>
                                            <span class="badge badge-info p-1"><i class="fa fa-inr p-1"></i>{{round($pksetting->quarterly_coverage_price,2)}} / 3 Months</span>
                                        </div>
                                        <div class="course-discription margin-top-10">
                                            {{ Str::limit(strip_tags(html_entity_decode($pksetting->pkg_desc)),200) }}
                                        </div>
                                      
                                        <div class="course-instructor-rating margin-top-20 mb-2">
                                        <p><strong>Available in :</strong></p>
                                            
                                            <span class="small badge badge-warning p-1 ">3 Months </span>                                                
                                            
                                            <span class="small badge badge-info p-1" >6 Months </span>
                                          <span class="small badge badge-info p-1" >Yearly</span>
                                        </div>
                                        <div class="clearfix text-center">
                                        <a href="{{route('competitive.preview_competitive',$pksetting->id.'_qtr')}}" class="btn btn-block btn-sm btn-success" >
                                           Book Now</a></div>
                                        
                                        
                                        
                                    </div>
                                   
                                </div>
                                
                            </div>
                        @empty

                            /* <div class="col-12 m-5">
                                <img src="{{asset('no_data.png')}}" class="w-100 img-fluid">
                            </div> */
                        @endforelse

<!-- End -->
                    </div>
                </div>
    </section>
@endsection
<!-- template js files -->
<!-- Javascript Files -->
<script src="{{asset('asset_rumbok/js/vendor/jquery.js')}}"></script>
<script src="{{ asset('frontend/js/popper.js') }}"></script>
<script src="{{asset('asset_rumbok/js/vendor/bootstrap.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/slick.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/counterup.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/waypoints.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/isotop.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/barfiller.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/countdown.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/easing.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/wow.js')}}"></script>
<script src="{{asset('asset_rumbok/js/main.js')}}"></script>
<script src="{{ asset('js/frontend.js') }}"></script>
<script src="{{ asset('js/notify.js') }}"></script>

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