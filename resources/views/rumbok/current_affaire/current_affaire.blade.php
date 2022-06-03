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

</style>
    {{--new design--}}

    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape" class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">                
                    <h2>
                    @if(Request::segment(2) == $slug)
                        {{ $name }} 
                    @else
                        @php
                            $x = 2;
                        @endphp
                            @if ($x <= count(Request::segments()))
                                {{str_replace('-', ' ',ucfirst(Request::segment(2)))}}
                            @else
                                @if($breadcrumb != null)
                                    {{$breadcrumb}}
                                    @else
                                    {{str_replace('-', ' ',ucfirst(Request::segment(1)))}}
                                @endif
                            @endif
                        @endif
                    </h2>
                    @if(Request::segment(2) == $slug )
                    <div class="breadcrumb-link margin-top-10">
                        <span>
                            <a href="{{ route('homepage') }}">@translate(home)</a> /
                            {{ $type}}
                             </span>
                        
                            <span>{{$name}}</span>
                        
                    </div>
                    @else

                    <div class="breadcrumb-link margin-top-10">
                        <span>
                            <a href="{{ route('homepage') }}">@translate(home)</a> /
                             @for($i = 1; $i <= count(Request::segments()); $i++)
                            <a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">{{str_replace('-', ' ',ucfirst(Request::segment($i)))}}</a></span>
                        @endfor
                        @if($breadcrumb != null)
                            <li>{{$breadcrumb}}</li>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Course Category Section Starts -->
    <section class="course-category-section padding-top-30 padding-bottom-90">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                <div class="clearfix page-content-inner">       
                    <div class="row m-viewsearch">
                            <div class="col-lg-6 col-xs-12">
                            <div class="section-title mb-10">
                                    <div class="title-header">
                                        <h3 class="title text-dark mb-0">
                                            @if(Request::segment(2) == $slug)
                                                {{ $name }} 
                                            @else
                                                @php
                                                    $x = 2;
                                                @endphp
                                                    @if ($x <= count(Request::segments()))
                                                        {{str_replace('-', ' ',ucfirst(Request::segment(2)))}}
                                                    @else
                                                        @if($breadcrumb != null)
                                                            {{$breadcrumb}}
                                                            @else
                                                            {{str_replace('-', ' ',ucfirst(Request::segment(1)))}}
                                                    @endif
                                                @endif
                                            @endif
                                    </h3>
                                    </div>
                                    <div class="heading-seperator">
                                        <span></span>
                                    </div>


                                    
                                <span>Total {{count($courses)}} records found  </span>
                            </div>
                            </div>
                            <div class="col-lg-6 col-xs-12 text-right">

                            @php
                                                if(isset($_GET['reportrange']) && $_GET['reportrange']!=''){
                                                    $dateRange = $_GET['reportrange'];
                                                }else{

                                                    $dateRange = '';
                                                }
                                                @endphp
                                <!--  Search for Courses -->
                                    <div class="header-search1 d-block" style="float:right;">
                                        <form action="#">
                                            <div>
                                            <input type="hidden" value="{{$dateRange}}" id="getR">

                                        <input class="form-control" id="reportrange" name="reportrange"
                                        style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" 
                                        type="text" placeholder="Search for Date Range" value="{{$dateRange}}"><button type="submit" class="header-search1"><i class="fa fa-search"></i></button>
                                    </div>
                                        </form>
                                    </div>
                            <!-- END -->
                            </div>
                    </div>
                </div>    
                
          
                    <div class="row">
                        @forelse($courses as $course)
                            <div class="col-md-4">
                                <div class="course-single-item single-course-item {{$loop->index++ %2 == 0 ? 'diffrent-bg' :'rumon'}}">
                                    <div class="course-image">
                                        <img src="{{ filePath($course->image) }}" alt="{{ $course->title }}" >
                                        <i class="badge showcs">{{$course->category->name}}</i>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-title margin-top-10">
                                            <h5>{{ Str::limit($course->title,50) }}</h5>
                                        </div>
                                       
                                        <div class="course-instructor-rating margin-top-20">
                                            <div class="course-instructor">
                                            @if(isset($course->relationBetweenInstructorUser))
                                             <img src="{{filePath($course->relationBetweenInstructorUser->image)}}" alt="instructor">
                                                <h6>{{$course->relationBetweenInstructorUser->name}}</h6>                                                
                                            @else
                                                <h6>Rating</h6>
                                            @endif
                                            </div>
                                            <div class="course-rating">
                                                <ul>
                                                    @for ($i = 0; $i < enrolmentStare(\App\Model\Enrollment::where('course_id',$course->id)->count()); $i++)
                                                        <li><i class="fa fa-star"></i></li>
                                                    @endfor
                                                </ul>
                                                <span>{{number_format(enrolmentStare(\App\Model\Enrollment::where('course_id',$course->id)->count()),1)}}({{\App\Model\Enrollment::where('course_id',$course->id)->count()}})</span>
                                            </div>
                                        </div>
                                        <div class="course-info margin-top-20">
                                        
                                            <div class="course-video">
                                                <i class="fa fa-play-circle-o"></i>
                                                <span>{{$course->classes->count()}} @translate(Classes)</span>
                                            </div>
                                            <div class="course-time">
                                                @php
                                                    $total_duration = 0;
                                                    foreach ($course->classes as $item){
                                                        $total_duration +=$item->contents->sum('duration');
                                                    }
                                                @endphp
                                                <i class="fa fa-clock-o"></i>
                                                <span>{{duration($total_duration)}}</span>
                                            </div>
                                        </div>
                                        <div class="course-price-cart margin-top-20">
                                            <div class="course-price">
                                                @if($course->is_free)
                                                    <span
                                                        class="span-big">@translate(Free)</span>
                                                @else
                                                    @if($course->is_discount)
                                                        <span
                                                            class="span-big">{{formatPrice($course->discount_price)}}</span>
                                                        <span class="span-cross">{{formatPrice($course->price)}}</span>
                                                    @else
                                                        <span
                                                            class="span-big">{{formatPrice($course->price)}}</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hover-state">
                                        <span class="heart-icon">
                                            @auth()
                                                <span
                                                    class="la la-heart-o love-span-{{$course->id}} love-{{$course->id}}" onclick="addToCart({{$course->id}},'{{route('add.to.wishlist')}}')"></span>

                                                <a href="#!"
                                                   onclick="addToCart({{$course->id}},'{{route('add.to.wishlist')}}')"
                                                   class="invisible love-{{$course->id}}"><span
                                                        class="la la-heart-o love-span-{{$course->id}}"></span></a>
                                            @endauth

                                            @guest()
                                                <a href="{{route('login')}}"><i class="fa fa-heart-o"></i></a>
                                            @endguest
                                        </span>
                                        {{-- <span class="title-tag">@translate(by instructor)</span>--}}
                                        <div class="course-title margin-top-10">
                                            <h5>
                                                <a href="{{route('course.single',$course->slug)}}">{{ Str::limit($course->title,58) }}</a>
                                            </h5>
                                        </div>
                                        <div class="course-price-info margin-top-20">
                                            @if(bestSellingTags($course->id))
                                                <span class="best-seller">@translate(best seller)</span>
                                            @endif
                                            <span class="course-category"><a
                                                    href="{{route('course.category',$course->category->slug)}}">{{$course->category->name}}</a></span>
                                            <span class="course-price">
                                                @if($course->is_free)
                                                    <span
                                                        class="span-big">@translate(Free)</span>
                                                @else
                                                    @if($course->is_discount)
                                                        <span
                                                            class="span-big">{{formatPrice($course->discount_price)}}</span>
                                                    @else
                                                        <span
                                                            class="span-big">{{formatPrice($course->price)}}</span>
                                                    @endif
                                                @endif
                                            </span>
                                        </div>
                                        <div class="course-info margin-top-30">
											<!--<div class="course-enroll">
												<span>@translate(enrolled) {{\App\Model\Enrollment::where('course_id',$course->id)->count()}}</span>
											</div>-->
                                        <div class="course-video">
                                            <i class="fa fa-play-circle-o"></i>
                                            <span>{{$course->classes->count()}} @translate(Classes)</span>
                                        </div>
                                        <div class="course-time">
                                            <i class="fa fa-clock-o"></i>
                                            @php
                                                $total_duration = 0;
                                                foreach ($course->classes as $item){
                                                    $total_duration +=$item->contents->sum('duration');
                                                }
                                            @endphp
                                            <span>{{duration($total_duration)}}</span>
                                        </div>
                                        </div>
                                        <ul class="margin-top-20">
                                            {{ (Str::limit( html_entity_decode(strip_tags($course->short_description)),160)) }}
                                        </ul>
                                        <div class="preview-button margin-top-20">
                                            <a href="{{route('course.single',$course->slug)}}" class="template-button">@translate(course preview)</a>

                                            @auth()
                                                @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                                    <a href="#!"
                                                       class="template-button margin-left-10 addToCart-{{$course->id}}"
                                                       onclick="addToCart({{$course->id}},'{{route('add.to.cart')}}')">@translate(Add
                                                        to cart)</a>
                                                @else
                                                    <a href="{{route('login')}}"
                                                       class="template-button margin-left-10">@translate(Add to cart)</a>
                                                @endif
                                            @endauth
                                            @guest()
                                                <a href="{{route('login')}}"
                                                   class="template-button margin-left-10">@translate(Add to cart)</a>
                                            @endguest
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty

                            <div class="col-12 m-5">
                                <img src="{{asset('no_data.png')}}" class="w-100 img-fluid">
                            </div>
                        @endforelse
							<div class="col-12">
								{{ $courses->links('rumbok.include.paginate') }}
							</div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<!-- template js files -->
<!-- Javascript Files -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
var Jquery = $.noConflict();

Jquery(document).ready(function () {
    function cb(start, end) {

        if(getR!='undefined' || getR!='null' || getR!=''){

            Jquery('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        }else{

            Jquery('#reportrange span').html('');

        }
    }

    Jquery('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    var getR    = $('#getR').val();
    if(getR!='undefined' || getR!='null' || getR!=''){

         var splt    = getR.split('-');

        var start   = splt[0];//moment();//moment().subtract(29, 'days');
        var end     = splt[1];//moment();////moment();
        cb(start, end);

    }else{

        var start   = '';//moment();//moment().subtract(29, 'days');
        var end     = '';
        cb('', '');
    }


    

});
</script>

@include('layouts.modal')

@include('sweetalert::alert')
@yield('js')



