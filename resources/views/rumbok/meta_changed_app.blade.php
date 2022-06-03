<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="OLE">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv = "content-language" content = "en">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="{{ env('APP_NAME') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php  $getMeta = \App\model\SystemSetting::select('type','value')->whereIn('type' , ['site_title' ,'site_description' ,'site_keywords'])->get(); 
        session()->put('getData',$getMeta);
        $setMeta = session()->get('getData')->pluck('value','type');
    @endphp 
   
    <meta name="description" content="{{ (isset($pageMeta['meta_description'])) ? $pageMeta['meta_description']:  $setMeta['site_description'] }}">
    <meta name="title" content="{{ (isset($pageMeta['meta_title']) && !empty($pageMeta['meta_title'])) ? $pageMeta['meta_title']:  $setMeta['site_title'] }}">
    <meta name="keywords" content="{{ (isset($pageMeta['tag'])) ? $pageMeta['tag']:  $setMeta['site_keywords'] }}">

    <title>{{ (isset($pageMeta['meta_title'])&& !empty($pageMeta['meta_title'])) ? $pageMeta['meta_title']  : $setMeta['site_title'] }}</title>
   
    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ filePath(getSystemSetting('favicon_icon')->value) }}">
    <link async href="{{ asset('css/font.css') }}">
    <!-- inject:css -->
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/bootstrap.min.css')}}"/>
    <!-- <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/theme.min.css')}}"/> -->
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/theme.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/responsive.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/owl.carousel.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/owl.theme.default.min.css')}}"/>
<style type="text/css">
    iframe [title] {
        right:0 !important;
        bottom:200px !important;
    }


    input#pass {
    position: relative;
}
    .potrait { display:block;position: relative; }
  .landscape { display:none; }

@media (max-width:767px) {
    /* (A) WRONG ORIENTATION - SHOW MESSAGE HIDE CONTENT */
@media only screen and (orientation:landscape) {
  .potrait { display:none; }
  .landscape { display:block; }
}

/* (B) CORRECT ORIENTATION - SHOW CONTENT HIDE MESSAGE */
@media only screen and (orientation:portrait) {
  .potrait { display:block; }
  .landscape { display:none; }
}
}

.noti-img {
    padding: 5px;
    border: 1px solid #f3f3f3;
    border-radius: 5px;
    background: #fafafa;
    margin-top: 5px;
}
</style>
    <!-- end inject -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GNP26SZ9HT"></script>
<script type="text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GNP26SZ9HT');
  gtag('config', 'G-ZM8E9T06VZ');
</script>

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '458997021212574');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=458997021212574&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
</head>

<body class="notLoaded">



    <!-- Preloader Starts -->
    <!-- Preloader Icon -->
    <!-- <div class="preloader bg-white" id="loader">
        <div class="loaderInner">
            <div class="preloader-img"><img src="{{asset('asset_rumbok/images/Preloader-breathe.gif')}}" alt=""/></div>
            
        </div>
    </div> -->
    <!-- Preloader Icon -->
<div class="potrait">
            {{--

        @include('rumbok.include.sidebar')

        --}}

        <!--======================================
            START HEADER AREA
        ======================================-->

        <!-- Header Section Starts -->
    <header class="header-section">
            <!-- Header Info Starts -->



        {{--       @if (!request()->is('student/*')) --}}
            <!-- Topbar Start -->
            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="topbar-left d-flex align-items-center">
                                    <div class="sub-logo">
                                        <a href="javascript:void(0);">
                                            <img src="{{asset('asset_rumbok/new/images/sm-TV-logo.png')}}" />
                                        </a>
                                    </div>
                                    {{-- <a class="mobile-search-btn d-md-none user-btn" href="javascript:void(0);"><i
                                            class="ti-search"></i></a>
                                    <div class="search-bar">
                                        <form class="search-box" method="post" action="#">
                                            <input type="search" name="s" placeholder="Search Courses..." />
                                            <button type="submit"><i class="ti-search"></i></button>
                                        </form>
                                    </div> --}}
                                </div>
                                <div class="topbar-right d-flex align-items-center">
                                    <ul>
                                    @guest()
                                        <li class="d-none d-md-block"><a href="{{ route('login') }}">Register/Login</a></li>
                                
                                        <li class="d-md-none"><a href="{{ route('login') }}" class="user-btn"><i
                                                    class="ti-user"></i></a></li>
                                    @endguest
                                    @auth
                                        @if (Auth::user()->user_type === "Student")
                                        {{--<li class="">
                                            <a href="{{ route('logout') }}" class="d-block text-white"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="la la-power-off text-danger"></i>
                                                @translate(Logout)
                                            </a>
                                        </li>--}}

                                        <form id="logout-form"
                                                action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                            @csrf
                                        </form>

                                        <li>
                                            <a class="cart-box" href="javascript:void(0);" onclick="cart_open()">
                                                <span class="cart-span"><i class="ti-shopping-cart"></i></span>
                                                <span class="cart-item-count cart-quantity">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="cart-box" href="javascript:void(0);" onclick="notification_open()">
                                            <span class="cart-span">
                                                <i class="ti-bell"></i>
                                            </span>
                                            <span class="cart-item-count">{{ App\Notification::where(['user_id' => Auth::user()->id , 'user_id' =>0 ])->count() }}</span>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                        <a class="user-btn show-mobile" data-toggle="collapse" href="#usermenucollapse" role="button" aria-expanded="false" aria-controls="usermenucollapse"><i class="ti-user"></i></a>
                                            <a class="dropdown-toggle user-btn hide-mobile" href="#" id="navbardrop" data-toggle="dropdown"><i class="ti-user"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="main-div-name-image">
                                                    <div class="d-flex">
                                                        <div class="user-img">
                                                            
                                                        <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                                            ? asset('rumbok/images/student.png')
                                                                            : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                                alt="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
                                                        
                                                    
                                                    </div>
                                                        <div class="name-mobile">
                                                            <span class="user-name">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                                            <span class="user-mobile">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="dropdown-item" href="{{ route('student.profile') }}"><span class="mr-1"><i class="ti-user"></i></span> My Profile</a>
                                                <a class="dropdown-item" href="{{ route('my.courses') }}"><span class="mr-1"><i class="ti-video-camera"></i></span> My Free Courses</a>
                                                <a class="dropdown-item" href="{{ route('my.packages') }}"><span class="mr-1"><i class="ti-video-camera"></i></span> My Packages</a>
                                                <a class="dropdown-item" href="{{ route('my.projectwork') }}"><span class="mr-1"><i class="ti-video-camera"></i></span> My Project Work</a>
<a class="dropdown-item" href="{{ route('my.tuition') }}"><span class="mr-1"><i class="ti-video-camera"></i></span> My Tuition</a>
                                                
                                                {{-- <a class="dropdown-item" href="{{route('student.message')}}"><span class="mr-1"><i class="ti-bell"></i></span> Message</a> --}}
                                                <a class="dropdown-item" href="{{ route('student.purchase.history') }}"><span class="mr-1"><i class="ti-shopping-cart"></i></span> Purchase History</a>
                                                {{-- <a class="dropdown-item" href="{{ route('affiliate.area') }}"><span class="mr-1"><i class="ti-star"></i></span> Affiliate Area</a> --}}
                                                <a class="dropdown-item border-0" href="https://ole.org.in/help-and-support" ><span class="mr-1"><i class="ti-headphone"></i></span> Help and Support</a>
                                                <a class="dropdown-item border-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="mr-1"><i class="ti-power-off text-danger"></i></span> Logout</a>
                                            </div>
                                        </li>
                                        
                                        @else

                                        <li class="mb-0">
                                            <a href="{{ route('dashboard') }}"
                                                class="d-block">
                                                <i class="la la-dashboard"></i> @translate(Go To Dashboard)
                                            </a>
                                        </li>
                                    
                                        @endif
                                        @else
                                        <li>
                                            <a class="cart-box" href="javascript:void(0);">
                                                <span class="cart-span"><i class="ti-shopping-cart"></i></span>
                                                <span class="cart-item-count quantity cart-quantity">0</span>
                                            </a>
                                        </li>
                                    @endauth
                                    </ul>
                                    @auth
                                    @if (Auth::user()->user_type === "Student")
                                    <!-- Cart Side bar -->
                                    <div class="cart-block" style="" id="mycart">
                                            <div class="cart-title d-flex justify-content-between align-items-center px-2 my-2">
                                                <span>My Cart</span>
                                                <button onclick="cart_close()" class="closecustom">&times;</button>
                                            </div>
                                                    
                                            <div class="shopping-cart px-2 py-2">
                                                <div class="shopping-cart-header d-flex justify-content-between align-items-center">
                                                    <div class="clearfix">
                                                        <i class="fa fa-shopping-cart cart-icon"></i>
                                                        <span class="badge bg-warning cart-quantity">0</span>
                                                    </div>				  
                                                        <div class="shopping-cart-total ml-auto">
                                                            <span class="lighter-text font-weight-bold text-success">Total:</span>
                                                            <span class="main-color-text text-success font-weight-bold item__price theme-color totalcartPrice">0</span>
                                                        </div>
                                                        </div> <!--end shopping-cart-header -->
                                                    
                                                        <ul class="shopping-cart-items list-unstyled" id="cartAppend">
                                                            <img src="{{ asset('asset_rumbok/images/empty_cart.png') }}" alt="empty cart" />
                                                        </ul>
                                                        @auth()
                                                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Student")
                                                                <input value="{{route('cart.list')}}" type="hidden"
                                                                        id="cartUrl" name="cartUrl">
                                                                <input value="{{route('wish.list')}}" type="hidden"
                                                                        id="wishUrl" name="wishUrl">
                                                                <input value="{{route('enroll.courses')}}" type="hidden"
                                                                        id="enrollUrl" name="enrollUrl">
                                                                <input value="{{route('shopping.cart')}}" type="hidden"
                                                                        id="shoppingCart" name="shoppingCart">
                                                                <input value="{{ asset('asset_rumbok/images/empty_cart.png') }}" type="hidden"
                                                                        id="cartImg" name="shoppingCart">
                                                                <input value="@translate(Go To Cart)" type="hidden"
                                                                        id="textUrl" name="textUrl">

                                                            @endif
                                                        @endauth
                                                        <div id="cartBtn">
                                                            <a href="{{route('my.packages')}}" class="btn btn-block btn-primary">@translate(Get Your Packages)</a>
                                                    </div>
                                                    </div>
                                                    
                                                </div>
                                        <!-- Cart Side bar -->
                                        <!-- Notification Side bar -->
                                        <div class="cart-block" id="notification" >
                                            <div class="cart-title d-flex justify-content-between align-items-center px-2 my-2">
                                                <span>My Notification</span>
                                                <button onclick="notification_close()" class="closecustom">×</button>
                                            </div>	
                                            <div class="shopping-cart px-2 py-2">	
                                                <div class="box bg-white mb-3">
                                                    @php $notifications = App\Notification::where(['user_id' => Auth::user()->id , 'user_id' =>0 ])->latest()->take(6)->get(); @endphp 
                                              
                                                    @forelse( $notifications as $item)			
                                                    <div class="box-body p-0">
                                                        <div class="border border-warning p-2 osahan-post-header shadow-sm rounded mb-2 alert alert-warning">					
                                                            <div class="mr-0">
                                                          
                                                                <div class="text-truncate font-weight-normal v-small badge badge-success">{{ $item->created_at->diffForHumans() }}</div>
                                                                <div class="clearfix">
                                                                    <div class="small line-height-1">{{ $item->title }}</div>
                                                                    <div class="small line-height-1">  <p class="text mb-0"><?php echo html_entity_decode( @translate($notification->description)); ?></p> </div>
                                                                    <div class="noti-img">
                                                                    @if($item->image)
                                                                    <img class="" src="{{ asset('storage/'.$item->image) }}" alt="images" style="width:100%;">
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>				
                                                    </div>
                                                    @empty
                                                        <div class="content text-center no-notify">
                                                            <img src="{{ asset('rumbok/images/notify.png') }}" class="w-100" alt="">
                                                        </div>
                                                    @endforelse
                                                    <a href="{{ route('student.dashboard') }}" class="btn btn-block btn-primary mt-2">View All</a>
                                                </div>
                                            </div>
                                        </div>

                                            @endif
                                        @endauth
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Topbar End -->
            @auth
            <div class="collapse" id="usermenucollapse">
                            <div class="card user-menu-mobile rounded-0">
                                <div class="card-body">
                                                <div class="main-div-name-image">
                                                    <div class="d-flex align-items-center ">
                                                    
                                                        <div class="user-img">
                                                            
                                                        <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                                            ? asset('rumbok/images/student.png')
                                                                            : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                                alt="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
                                                        
                                                    
                                                    </div>
                                                        <div class="name-mobile">
                                                            <span class="user-name">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                                            <span class="user-mobile">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>
                                                        </div>
                                                        <a class="text-white ml-auto" data-toggle="collapse" href="#usermenucollapse" role="button" aria-expanded="true" aria-controls="usermenucollapse"><i class="ti-arrow-up"></i></a>
                                                    </div>
                                                </div>
                                                <a class="dropdown-item" href="{{ route('student.profile') }}"><span class="mr-1"><i class="ti-user"></i></span> My Profile</a>
                                                <a class="dropdown-item" href="{{ route('my.courses') }}"><span class="mr-1"><i class="ti-video-camera"></i></span> My Free Courses</a>
                                                <a class="dropdown-item" href="{{ route('my.packages') }}"><span class="mr-1"><i class="ti-video-camera"></i></span> My Packages</a>
                                                <a class="dropdown-item" href="{{ route('my.projectwork') }}"><span class="mr-1"><i class="ti-video-camera"></i></span> My Project Work</a>
<a class="dropdown-item" href="{{ route('my.tuition') }}"><span class="mr-1"><i class="ti-video-camera"></i></span> My Tuition</a>
                                                
                                                {{-- <a class="dropdown-item" href="{{route('student.message')}}"><span class="mr-1"><i class="ti-bell"></i></span> Message</a> --}}
                                            <a class="dropdown-item" href="{{ route('student.purchase.history') }}"><span class="mr-1"><i class="ti-shopping-cart"></i></span> Purchase History</a> 
                                                {{-- <a class="dropdown-item" href="{{ route('affiliate.area') }}"><span class="mr-1"><i class="ti-star"></i></span> Affiliate Area</a> --}}
                                                <a class="dropdown-item" href="https://ole.org.in/help-and-support" ><span class="mr-1"><i class="ti-headphone"></i></span> Help and Support</a>
                                                <a class="dropdown-item border-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="mr-1"><i class="ti-power-off text-danger"></i></span> Logout</a>
                                            </div>
                                </div>
                            </div>
            </div>
        @endauth
            {{-- @endif --}}
            <!-- Header desktop Start -->
            <header class="header-02 sticky">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg ">
                                <!-- logo Start-->
                                <a class="navbar-brand" href="{{ route('homepage') }}"
                                    title="{{getSystemSetting('type_name')->value}}">
                                    <img class="img-fluid header-logo"
                                        src="{{ filePath(getSystemSetting('type_logo')->value) }}"
                                        alt="{{getSystemSetting('type_name')->value}}"></a>

                                <!-- logo End-->

                                <!-- Moblie Btn Start -->
                                <button class="navbar-toggler" type="button">
                                    <i class="fal fa-bars"></i>
                                </button>
                                <!-- Moblie Btn End -->

                                <!-- Nav Menu Start -->
                                <div class="collapse navbar-collapse">
                                    <div class="mobile-logo-div d-lg-none d-flex justify-content-between">
                                        <a class="navbar-brand" href="{{ route('homepage') }}">
                                            <img src="{{asset('asset_rumbok/new/images/OLE-Logo.png')}}"
                                                alt="OLE - Online Learning With Experts" />
                                        </a>
                                        <button class="close-menu" type="button">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </div>
                                    <ul class="navbar-nav">
                                        <li class="d-lg-none">
                                            <a href="{{url('/')}}" title="Home">Home</a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0);" title="Board">@translate(Board) <i
                                                    class="ti-angle-down"></i></a>

                                            <ul class="sub-menu">
                                                @foreach(categories() as $item)
                                                @if (($item->is_compitative == '0') && ($item ->is_free_study != '1') &&
                                                ($item ->is_current_affairs != '1') && ($item ->is_project_works != '1') && ($item ->is_traditional_course != '1'))
                                                @if($item->name!='Blog')
                                                <li class="{{$item->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                    <a href="javascript:void(0);" title="{{$item->name}}">{{$item->name}} <i
                                                            class="ti-angle-right"></i></a>
                                                    @if($item->child->count() != 0)
                                                    <ul class="sub-menu">
                                                        @foreach($item->child as $child)
                                                        <li
                                                            class="{{$child->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                            <a
                                                                href="{{route('course.category',$child->slug)}}" title="{{$child->name}}">{{$child->name}}</a>
                                                            {{-- @if(\App\Model\Category::where('parent_category_id',$child->id)->count() != 0)
                                                                        <ul class="sub-menu">
                                                                            @foreach(\App\Model\Category::where('parent_category_id',$child->id)->get() as $child1)
                                                                                <li  class="{{$child1->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                            <a
                                                                href="{{route('course.category',$child1->slug)}}" title="{{$child1->name}}">{{$child->id.'CHILD'}}{{$child1->id}}{{$child1->name}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif --}}
                                                </li>

                                                @endforeach
                                            </ul>

                                            @endif
                                        </li>
                                        @endif
                                        @endif
                                        @endforeach

                                    </ul>


                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);" title="Competitive">@translate(Competitive) <i
                                                class="ti-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li class="menu-item-has-children">
                                            @foreach(categories() as $item)
                                                    @if ($item->is_compitative != '0')
                                                    <li
                                                        class="{{$item->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                        <a href="{{route('competitive.curriculum',$item->slug)}}" title="{{$item->name}}">{{$item->name}} </a>
                                                    {{-- @if($item->child->count() != 0)
                                                        <ul class="sub-menu">
                                                            @foreach($item->child as $child)
                                                            <li
                                                                class="{{$child->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                                <a
                                                                    href="{{route('competitive.curriculum',$child->slug)}}" title="{{$child->name}}">{{$child->name}}</a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        @endif --}}
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);" title="Study Material">@translate(Study Material) <i
                                                class="ti-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            @foreach(categories() as $item)
                                            @if ($item->is_free_study != '0')
                                            <li class="{{$item->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                <a href="{{route('list_freestudy_courses',$item->slug)}}" title="{{$item->name}}">{{$item->name}}</a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{url('current-affairs')}}" title="Current Affairs">
                                            <span>@translate(Current Affairs)</span>
                                            <!-- <i class="fa fa-chevron-down"></i> -->
                                        </a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);" title="Our Elite Courses">@translate(Our Elite Courses) <i
                                                class="ti-angle-down"></i></a>
                                        <ul class="sub-menu">
                                        <li>
                                            <a
                                                href="{{route('project_work')}}" title="Project Work">Project Work</a>
                                        </li>
                                            @foreach(categories() as $item)
                                            @if(($item->is_project_works != '0') || ($item ->is_traditional_course != '0'))
                                            <li class="{{$item->child->count() != 0 ? 'have-submenu' : ''}}">
                                                <a href="{{route('course.elite',$item->slug)}}" title="{{$item->name}}">{{$item->name}} </a>
                                                @if($item->child->count() != 0)
                                                <ul class="sub-menu">
                                                    @foreach($item->child as $child)
                                                    <li>
                                                        <a
                                                            href="{{route('course.elite',$child->slug)}}" title="{{$child->name}}">{{$child->name}}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    @auth
                                    @if (Auth::user()->user_type === "Student")
                                    <li>
                                        <a href="{{url('test-series')}}" title="Test Series">@translate(Test Series)</a></li>
                                    @else
                                    <li>
                                        <a href="{{url('test-series-login')}}" title="Test Series">@translate(Test Series)</a></li>
                                    @endif
                                    @endauth
                                    @guest
                                    <li>
                                        <a href="{{url('test-series-login')}}" title="Test Series">@translate(Test Series)</a></li>
                                    @endguest
                                    </ul>
                                   
                                    </li>
                                    
                                    

                                    </ul>
                                </div>
                                <!-- Nav Menu End -->
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Header desktop End -->


        
            
            <!-- main Header Starts -->




            @auth
            {{-- bottom responsive menu --}}
            <ul class="nav justify-content-center fixed-bottom bg-white btm-fixed-nav d-none">
                <li class="nav-item">
                    <div class="notification-item mr-3">
                        <a href="{{ route('shopping.cart') }}">
                            <button class="notification-btn dropdown-toggle">
                                <i class="la la-shopping-cart"></i>
                                <span
                                    class="quantity cart-quantity">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span>
                            </button>
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="notification-item mr-3">
                        <a href="{{ route('student.dashboard') }}">
                            <button class="notification-btn dropdown-toggle">
                                <i class="la la-bell"></i>
                                <span
                                    class="quantity">{{ App\Notification::where(['user_id' => Auth::user()->id , 'user_id' => '0' ])->count() }}</span>
                            </button>
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="notification-item mr-3">
                        <a href="{{ route('my.wishlist') }}">
                            <button class="notification-btn dropdown-toggle">
                                <i class="la la-heart-o"></i>
                                <span
                                    class="quantity wishlist-quantity">{{ App\Model\Wishlist::where('user_id',Auth::user()->id)->count() }}</span>
                            </button>
                        </a>
                    </div>
                </li>
            </ul>
            {{-- bottom responsive menu --}}
            @endauth

    </header>


        <!--======================================
            END HEADER AREA
    ======================================-->


    @yield('content')



  {{--  @if(!request()->is('student/*'))   --}}
    

    
        <div class="bottom-menu">
            <div class="d-flex align-items-center justify-content-between">
                <div class="bottom-block">
                <a href="{{url('/')}}" title="Home">
                    <div class="bottom-menu-part">
                        <div class="bottom-menu-icon"><i class="ti-home"></i></div>
                        <div class="bottom-menu-text">Home</div>
                    </div>
                </a>
                </div>
                <div class="bottom-block">
                <a href="#" class="navbar-toggler" title="Category">
                    <div class="bottom-menu-part">
                        <div class="bottom-menu-icon"><i class="ti-bookmark-alt"></i></div>
                        <div class="bottom-menu-text">Category</div>
                    </div>
                </a>
                </div>
                <div class="bottom-block">
                    
                        <div class="bottom-menu-part">
                            <div class="bottom-menu-icon"><i class="ti-user"></i></div>
                            <div class="bottom-menu-text">@auth()
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student') 
                        
                            <a href="{{url('/student/profile')}}" title="My account">My account</a>
                            @else
                                <a class="" href="{{route('login')}}" title="My account">My account </a>
                            @endif
                            @endauth
                        @guest
                        <a class="" href="{{route('login')}}" title="My account">My account</a>
                        @endguest</div>
                        </div>
                    
                </div>
                <div class="bottom-block">
                @auth
                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                    <a href="#" onclick="cart_open()" title="Cart">
                        <div class="bottom-menu-part">
                            <div class="bottom-menu-icon"><i class="ti-shopping-cart"></i><span class="bottom-menu-cart-count cart-item-count cart-quantity">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span></div>
                            <div class="bottom-menu-text">Cart</div>
                        </div>
                    </a>
                    @else
                    <a href="javascript:void(0);" title="Cart">
                        <div class="bottom-menu-part">
                            <div class="bottom-menu-icon"><i class="ti-shopping-cart"></i><span class="bottom-menu-cart-count">0</span></div>
                            <div class="bottom-menu-text">Cart</div>
                        </div>
                    </a>                                    
                    @endif                                     
                @endauth
                @guest
                <a href="javascript:void(0);" title="Cart">
                    <div class="bottom-menu-part">
                        <div class="bottom-menu-icon"><i class="ti-shopping-cart"></i><span class="bottom-menu-cart-count">0</span></div>
                        <div class="bottom-menu-text">Cart</div>
                    </div>
                </a>
                @endguest
                </div>
                <div class="bottom-block">
                <a href="https://tawk.to/chat/61812f0d6885f60a50b9f614/1fjg9vjqi" title="Chat">
                    <div class="bottom-menu-part">
                        <div class="bottom-menu-icon"><i class="ti-comments-smiley"></i></div>
                        <div class="bottom-menu-text">Chat</div>
                    </div>
                </a>
                </div>
            </div>
        </div>
    <!-- ================================
           Start FOOTER AREA
  ================================= -->
    <!-- Footer Section Start -->
        <footer class="footer-1 f-2-color mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <aside class="widget mb-4">
                            <div class="text-center">
                                <!-- <a href="index.html"><img src="assets/images/OLE-Logo.png" alt="OLE - Online Learning With Experts" /></a> -->
                                <div class="ab-social mt-4">
                                @if(getSystemSetting('type_fb')->value != null)
                                    <a class="fac" href="{{getSystemSetting('type_fb')->value}}" target="_blank" title="Facebook"><i class="social_facebook"></i></a>
                                @endif
                                @if(getSystemSetting('type_tw')->value != null)
                                    <a class="twi" href="javascript:void();" target="_blank" title="Twitter"><i class="social_twitter"></i></a>
                                @endif
                                @if(getSystemSetting('type_youtube')->value != null)
                                    <a class="you" href="{{getSystemSetting('type_youtube')->value}}" target="_blank" title="Youtube"><i class="social_youtube"></i></a>
                                @endif
                                <a class="lin" href="https://www.linkedin.com/company/oleclasses/?trk=public_post_share-update_actor-text" target="_blank" title="Linkedin"><i class="social_linkedin"></i></a>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <aside class="widget text-center">
                            {{-- <a href="{{route('pages','about-us')}}" title="About Us">About Us</a> | <a href="#" title="Contact Us">Contact Us</a> | <a href="{{route('blog.all')}}" title="Blog">Blog</a> | <a href="#" title="Privacy Policy">Privacy Policy</a> | <a href="#">Terms &amp; Condition</a> | <a href="#" title="Refund & Cancellation">Refund &amp; Cancellation</a> --}}
                            <a href="{{route('pages','about-us')}}" title="About Us">About Us</a> | {{-- <a href="#" title="Contact Us">Contact Us</a> | --}}<a href="{{route('blog.all')}}" title="Blog">Blog</a> | <a href="{{route('pages','privacy-policy')}}" title="Privacy Policy">Privacy Policy</a> | <a href="{{route('pages','terms-condition')}}" title="Terms & Condition">Terms &amp; Condition</a> | <a href="{{route('pages','refund-cancellation')}}" title="Refund &amp; Cancellation">Refund &amp; Cancellation</a> | <a href="{{route('pages','contact-us')}}" title="Contact Us">Contact Us</a>

                        </aside>
                    </div>
                </div>
                <!-- Copyrigh -->
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="copyright">
                            <p>© 2021 Copyright All Right Reserved.</p>
                            <p>Promoted by <a href="https://samadhan.group" target="_blank" title="Samadhan Group">Samadhan Group</a> &amp; Incubated by <a href="https://iid.org.in" target="_blank" title="Institute for Industrial Development (IID)">Institute for Industrial Development (IID)</a></p>
                        </div>
                    </div>
                </div>
                <!-- Copyrigh -->
            </div>
        </footer>
    <!-- Footer Section End -->
</div>
<div class="landscape bg-info py-2" style="width:100%;height: 100%;text-align:center;position: fixed;top: 0;left: 0; z-index:1;">
    <h2 class="text-white">Please rotate your device</h2>
    <p class="text-white">We don't support landscape mode yet. Please go back to Portrait mode for the best experience.</p>
</div>



    <!-- ================================
              END FOOTER AREA
    ================================= -->
    {{-- @endif  --}}





    <!-- template js files -->
    <!-- Javascript Files -->
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/slick.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/swiper-bundle.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/lightcase.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/preset.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/font-awesome.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/elegant-icons.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/themify-icons.min.css')}}"/>
    <script  src="{{asset('asset_rumbok/new/js/jquery.js')}}"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script  src="{{asset('asset_rumbok/new/js/bootstrap.min.js')}}"></script>
    <script  src="{{asset('js/jquery_lazy/jquery.lazy.min.js')}}"></script>
    <script  src="{{asset('js/jquery_lazy/plugins/jquery.lazy.iframe.min.js')}}"></script>
    <script  src="{{asset('asset_rumbok/new/js/jquery.appear.js')}}"></script>
    <script  src="{{asset('asset_rumbok/new/js/owl.carousel.min.js')}}"></script>
    <script  src="{{asset('asset_rumbok/new/js/slick.js')}}"></script>
    <script  src="{{asset('asset_rumbok/new/js/swiper-bundle.min.js')}}"></script>
    <script  src="{{asset('asset_rumbok/new/js/TweenMax.min.js')}}"></script>
    <script  src="{{asset('asset_rumbok/new/js/lightcase.js')}}"></script>
    <script  src="{{asset('asset_rumbok/new/js/jquery.plugin.min.js')}}"></script>
    <script  src="{{asset('asset_rumbok/new/js/jquery.easing.1.3.js')}}"></script>
    <script  src="{{asset('asset_rumbok/new/js/jquery.shuffle.min.js')}}"></script>

    <script  src="{{asset('asset_rumbok/new/js/theme.js')}}"></script>

	<script  src="{{asset('asset_rumbok/js/vendor/counterup.js')}}"></script>
	<script  src="{{asset('asset_rumbok/js/vendor/jquery.magnific-popup.js')}}"></script>
	<script  src="{{asset('asset_rumbok/js/vendor/isotop.js')}}"></script>
	<script  src="{{asset('asset_rumbok/js/vendor/barfiller.js')}}"></script>
	<script  src="{{asset('asset_rumbok/js/vendor/countdown.js')}}"></script>
	<script  src="{{asset('asset_rumbok/js/vendor/easing.js')}}"></script>
	<script  src="{{asset('asset_rumbok/js/vendor/wow.js')}}"></script>
	<script  src="{{asset('asset_rumbok/js/main.js')}}"></script>
	<script  src="{{ asset('js/frontend.js') }}"></script>
	<script  src="{{ asset('js/notify.js') }}"></script>
    <script  src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".dropdown-cat").click(function() {
            $(this).toggleClass("open");
        });
    });
    </script>
    <script>
    function openNav() {
        document.getElementById("mySidepanel").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidepanel").style.width = "0";
    }
    </script>
    @include('layouts.modal')

    @include('sweetalert::alert')
    @yield('js')
    <script>
			$(document).ready(function(){
				$("button.display1").click(function(){
					$(".tab-1").toggle();
				});
				$("button.display2").click(function(){
					$(".tab-2").toggle();
				});
				$("button.display3").click(function(){
					$(".tab-3").toggle();
				});
				$("button.display4").click(function(){
					$(".tab-4").toggle();
				});
				$("button.display5").click(function(){
					$(".tab-5").toggle();
				});
				$("button.display6").click(function(){
					$(".tab-6").toggle();
				});
				$("button.display7").click(function(){
					$(".tab-7").toggle();
				});
				$("button.display8").click(function(){
					$(".tab-8").toggle();
				});
				$("button.display9").click(function(){
					$(".tab-9").toggle();
				});
				});
                // cart open and close 
				function cart_open() {
				document.getElementById("mycart").style.width = "300px";
				}

				function cart_close() {
				document.getElementById("mycart").style.width = "0";
				}
                function notification_open() {
				document.getElementById("notification").style.width = "300px";
				}

				function notification_close() {
				document.getElementById("notification").style.width = "0";
				}
			</script>



<!--Start of Tawk.to Script-->
<script type="text/javascript">
// var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
// (function(){
// var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
// s1.async=true;
// s1.src='https://embed.tawk.to/61812f0d6885f60a50b9f614/1fjg9vjqi';
// s1.charset='UTF-8';
// s1.setAttribute('crossorigin','*');
// s0.parentNode.insertBefore(s1,s0);
// })();

$('.oneslideslider').owlCarousel({
    loop:false,
    margin:0,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
</script>

<script>
function goBack() {
  window.history.back();
}

</script>
<!--End of Tawk.to Script-->

<div class="modal hide fade" id="reffererCongratulate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body shadow">
                    <div class="pop-up-div-congrats">
                        <div class="thums-up">
                            <img src="{{asset('thumbs-up.gif')}}" class="img-fluid" alt="OLExpert">
                        </div>
                        <div class="congrats-content">
                            <h3>Congratulation!!!</h3>
                            <h6><strong>You can now purchase any one paid Class Curriculum or Competitive Package or Elite Course for FREE.</strong></h6>
                            <h6><strong>Coupon will be auto applied on checkout page.</strong></h6>
                            @auth
                                <p><a href="{{url('/')}}" class="btn btn-primary" title="Proceed">Proceed</a></p>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    {{--
    @auth
        @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
        <?php
            $enrollCoursesCount = \App\Model\Enrollment::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->count();
        ?>
            @if($enrollCoursesCount=='0' && !session()->has('FIRST_COURSE_FREE'))
                <script type="text/javascript">
                    $(window).on('load', function() {
                        $('#reffererCongratulate').modal('show');
                    });
                </script>
                <?php
                    session()->put('FIRST_COURSE_FREE', true);
                ?>
            @endif
        @endauth
    @endauth
    --}}
<script>
    // 	$(document).ready(function(){   
    //     window.setTimeout('fadeout();', 500);
        
    // });

    function fadeout(){
        $('#loader').delay(1000).fadeOut('slow', function() {
           $('.notLoaded').removeClass('notLoaded');
        });
    }
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>

</html>