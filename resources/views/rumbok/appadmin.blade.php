<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="Samadhan Group">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="{{ env('APP_NAME') }}">
    <meta name="subject" content="{{ env('APP_NAME') }} {{ env('APP_VERSION') }}">
    <meta name="description" content="@yield('meta_description', config('app.name'))">
    <meta name="author" content="@yield('meta_author', config('app.name'))">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{getSystemSetting('type_name')->value}}</title>


    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ filePath(getSystemSetting('favicon_icon')->value) }}">
    <link href="{{ asset('css/font.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/elegant-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/themify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/slick.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/lightcase.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/preset.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/theme.css')}}" />
    <link rel="stylesheet" href="{{asset('asset_rumbok/new/css/responsive.css')}}" />

    <!-- end inject -->
</head>

<body>

    <!-- Preloader Starts -->
    <!-- Preloader Icon -->
    {{--<div class="preloader">
        <div class="loaderInner">
            <div id="top" class="mask">
                <div class="plane"></div>
            </div>
            <div id="middle" class="mask">
                <div class="plane"></div>
            </div>
            <div id="bottom" class="mask">
                <div class="plane"></div>
            </div>
            <p>LOADING...</p>
        </div>
    </div>--}}
    <!-- Preloader Icon -->
    {{--

@include('rumbok.include.sidebar')

--}}

    <!--======================================
        START HEADER AREA
    ======================================-->

    <!-- Header Section Starts -->
    <header class="header-section">
        <!-- Header Info Starts -->



        @if (!request()->is('student/*'))
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
                                <a class="mobile-search-btn d-md-none user-btn" href="javascript:void(0);"><i
                                        class="ti-search"></i></a>
                                <div class="search-bar">
                                    <form class="search-box" method="post" action="#">
                                        <input type="search" name="s" placeholder="Search Courses..." />
                                        <button type="submit"><i class="ti-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="topbar-right d-flex align-items-center">
                                <ul>
                                @guest()
                                    <li class="d-none d-md-block"><a href="{{ route('login') }}">Login</a></li>
                               
                                    <li class="d-md-none"><a href="{{ route('login') }}" class="user-btn"><i
                                                class="ti-user"></i></a></li>
                                @endguest
                                @auth
                                    @if (Auth::user()->user_type === "Student")
                                    <li class="">
                                        <a href="{{ route('logout') }}" class="d-block text-white"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="la la-power-off text-danger"></i>
                                            @translate(Logout)
                                        </a>
                                    </li>

                                    <form id="logout-form"
                                            action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                        @csrf
                                    </form>

                                    <li>
                                        <a class="cart-box" href="javascript:void(0);">
                                            <span class="cart-span"><i class="ti-shopping-cart"></i></span>
                                            <span class="cart-item-count">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span>
                                        </a>
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
                                            <span class="cart-item-count">0</span>
                                        </a>
                                    </li>
                                @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        @endif
        <!-- Header Start -->
        <header class="header-02 sticky">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
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
                                    <a class="navbar-brand" href="index.html">
                                        <img src="{{asset('asset_rumbok/new/images/OLE-Logo.png')}}"
                                            alt="OLE - Online Learning With Experts" />
                                    </a>
                                    <button class="close-menu" type="button">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </div>
                                <ul class="navbar-nav">
                                    <li class="d-lg-none">
                                        <a href="{{url('/')}}">Home</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);">@translate(Board) <i
                                                class="ti-angle-down"></i></a>

                                        <ul class="sub-menu">
                                            @foreach(categories() as $item)
                                            @if (($item->is_compitative == '0') && ($item ->is_free_study != '1') &&
                                            ($item ->is_current_affairs != '1') && ($item ->is_project_works != '1'))
                                            @if($item->name!='Blog')
                                            <li class="{{$item->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                <a href="javascript:void(0);">{{$item->name}} <i
                                                        class="ti-angle-right"></i></a>
                                                @if($item->child->count() != 0)
                                                <ul class="sub-menu">
                                                    @foreach($item->child as $child)
                                                    <li
                                                        class="{{$child->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                        <a
                                                            href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
                                                        {{-- @if(\App\Model\Category::where('parent_category_id',$child->id)->count() != 0)
                                                                    <ul class="sub-menu">
                                                                        @foreach(\App\Model\Category::where('parent_category_id',$child->id)->get() as $child1)
                                                                            <li  class="{{$child1->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                        <a
                                                            href="{{route('course.category',$child1->slug)}}">{{$child->id.'CHILD'}}{{$child1->id}}{{$child1->name}}</a>
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
                                    <a href="javascript:void(0);">@translate(Competitive) <i
                                            class="ti-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0);">Engineering <i class="ti-angle-right"></i></a>
                                            <ul class="sub-menu">
                                                @foreach(categories() as $item)
                                                @if ($item->is_compitative != '0')
                                                <li
                                                    class="{{$item->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                    <a href="javascript:void(0);">{{$item->name}} <i
                                                            class="ti-angle-right"></i></a>
                                                    @if($item->child->count() != 0)
                                                    <ul class="sub-menu">
                                                        @foreach($item->child as $child)
                                                        <li
                                                            class="{{$child->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                            <a
                                                                href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">@translate(Study Material) <i
                                            class="ti-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach(categories() as $item)
                                        @if ($item->is_free_study != '0')
                                        <li class="{{$item->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                            @if($item->slug == 'package-on-board')
                                            <a href="{{route('packages.board',$item->slug)}}">{{$item->name}}</a>
                                            @else
                                            <a href="{{route('course.category',$item->slug)}}">{{$item->name}}</a>
                                            @endif

                                            @if($item->child->count() != 0)
                                            <ul class="sub-menu">
                                                @foreach($item->child as $child)
                                                <li
                                                    class="{{$child->child->count() != 0 ? 'menu-item-has-children' : ''}}">
                                                    <a href="{{route('course.category',$child->slug)}}">{{$child->name}}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('current_affaire.category','current-affair')}}">
                                        <span>@translate(Current Affairs)</span>
                                        <!-- <i class="fa fa-chevron-down"></i> -->
                                    </a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">@translate(Project Works) <i
                                            class="ti-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach(categories() as $item)
                                        @if ($item->is_project_works != '0')
                                        <li class="{{$item->child->count() != 0 ? 'have-submenu' : ''}}">
                                            <a href="{{route('course.category',$item->slug)}}">{{$item->name}} <i
                                                    class="ti-angle-right"></i></a>
                                            @if($item->child->count() != 0)
                                            <ul class="sub-menu">
                                                @foreach($item->child as $child)
                                                <li>
                                                    <a
                                                        href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>
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
        <!-- Header End -->

        
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
                                class="quantity">{{ App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->count() }}</span>
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



    @if(!request()->is('student/*'))
    <!-- ================================
           Start FOOTER AREA
  ================================= -->
<!-- Footer Section Start -->
<footer class="footer-1 f-2-color">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <aside class="widget mb-4">
                    <div class="text-center">
                        <!-- <a href="index.html"><img src="assets/images/OLE-Logo.png" alt="OLE - Online Learning With Experts" /></a> -->
                        <div class="ab-social mt-4">
                        @if(getSystemSetting('type_fb')->value != null)
                            <a class="fac" href="{{getSystemSetting('type_fb')->value}}"><i class="social_facebook"></i></a>
                        @endif
                        @if(getSystemSetting('type_tw')->value != null)
                            <a class="twi" href="javascript:void();"><i class="social_twitter"></i></a>
                        @endif
                        @if(getSystemSetting('type_youtube')->value != null)
                            <a class="you" href="{{getSystemSetting('type_youtube')->value}}"><i class="social_youtube"></i></a>
                        @endif
                        <a class="lin" href="javascript:void();"><i class="social_linkedin"></i></a>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-lg-12 col-md-12">
                <aside class="widget text-center">
                    <a href="{{route('pages','about-us')}}">About Us</a> | <a href="#">Contact Us</a> | <a href="{{route('blog.all')}}">Blog</a> | <a href="#">Privacy Policy</a> | <a href="#">Terms &amp; Condition</a> | <a href="#">Refund &amp; Cancellation</a>
                    </ul>
                </aside>
            </div>
        </div>
        <!-- Copyrigh -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="copyright">
                    <p>© 2021 Copyright All Right Reserved.</p>
                    <p>Promoted by <a href="https://samadhan.group" target="_blank">Samadhan Group</a> &amp; Incubated by <a href="https://iid.org.in" target="_blank">Institute for Industrial Development (IID)</a></p>
                </div>
            </div>
        </div>
        <!-- Copyrigh -->
    </div>
</footer>
<!-- Footer Section End -->
{{--
    <!-- Footer Section Starts -->
    <footer class="footer-section padding-top-30 padding-bottom-60">
        <div class="container bottom_border">
            <div class="row">
                <div class=" col-sm-4 col-md col-sm-4  col-12 col">
                    <h4 class="title col_white_amrc pt2">@translate(Find us)</h4>
                    <!--headin5_amrc-->
                    <p class="mb10">@translate(OLE is an online platform that help to reconstruct the teaching learning
                        process it is a seamless transition to online world. A gateway to inclusive education, where
                        streams, learning capacity, topics and subjects meet. When people are waiting for this to
                        happen, Lead the change with OLE.)<br /><a href="{{url('page/about-us')}}" class="font-14p">Read
                            More</a></p>
                    <p><i class="icofont-megaphone promo">&nbsp;promoted by:</i> <a href="https://samadhan.group"
                            target="_blank">@translate(Samadhan Group)</a> </p>
                    <p><i class="fa-handshake-o promo">&nbsp;incubated by:</i> <a href="https://iid.org.in"
                            target="_blank">@translate(Institute&nbsp;for&nbsp;Industrial&nbsp;Development (IID))</a>
                    </p>

                </div>


                <div class=" col-sm-4 col-md  col-6 col">
                    <h4 class="title col_white_amrc pt2">@translate(Categories)</h4>
                    <!--headin5_amrc-->
                    <ul class="footer_ul_amrc">
                        @foreach(\App\Model\Category::Published()->where('top', 1)->get() as $item)
                        <li><a href="{{route('course.category',$item->slug)}}">{{$item->name}}</a></li>
                        @endforeach
                        <li><a href="{{route('blog.all')}}">@translate(Blog)</a></li>
                    </ul>

                    <!--footer_ul_amrc ends here-->
                </div>


                <div class=" col-sm-4 col-md  col-6 col">
                    <h4 class="title pt2col_white_amrc pt2">@translate(useful links)</h4>
                    <!--headin5_amrc-->
                    <ul class="footer_ul_amrc">
                        @foreach(\App\Page::where('active',1)->get() as $item)
                        <li><a href="{{route('pages',$item->slug)}}">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                    <!--footer_ul_amrc ends here-->
                </div>


                <div class=" col-sm-4 col-md  col-12 col">
                    <h4 class="title col_white_amrc pt2">@translate(Reach Us)</h4>
                    <!--headin5_amrc ends here-->
                    <div class="footer-logo">
                        <a href="{{route('homepage')}}">
                            <img src="{{ filePath(getSystemSetting('footer_logo')->value) }}"
                                alt="{{getSystemSetting('type_name')->value}}" class="round-shape-3"
                                style="width:80px;">
                        </a>
                    </div>
                    <p>&nbsp;</p>
                    <p><i class="fa fa-map-marker"></i> {{getSystemSetting('type_address')->value}}</p>
                    <p><i class="fa fa-phone"></i> {{getSystemSetting('type_number')->value}} </p>
                    <p><i class="fa fa fa-envelope"></i> {{getSystemSetting('type_mail')->value}} </p>
                    <ul class="social-profile">
                        @if(getSystemSetting('type_fb')->value != null)
                        <li><a href="{{getSystemSetting('type_fb')->value}}" target="_blank"><i
                                    class="fa fa-facebook"></i></a></li>
                        @endif
                        @if(getSystemSetting('type_tw')->value != null)
                        <li><a href="{{getSystemSetting('type_tw')->value}}" target="_blank"><i
                                    class="fa fa-twitter"></i></a></li>
                        @endif
                        @if(getSystemSetting('type_google')->value != null)
                        <li><a href="{{getSystemSetting('type_google')->value}}" target="_blank"><i
                                    class="fa fa-google-plus"></i></a></li>
                        @endif
                        @if(getSystemSetting('type_youtube')->value != null)
                        <li><a href="{{getSystemSetting('type_youtube')->value}}" target="_blank"><i
                                    class="fa fa-youtube-play"></i></a></li>
                        @endif
                    </ul>
                    <!--footer_ul2_amrc ends here-->
                </div>
            </div>
        </div>


        <div class="container">

            <!--foote_bottom_ul_amrc ends here-->
            <p class="text-center">Copyright &copy;{{date('Y')}} - India TV Global Pvt. Ltd.</p>

        </div>
    </footer>
--}}


    <!-- ================================
              END FOOTER AREA
    ================================= -->
    @endif





    <!-- template js files -->
    <!-- Javascript Files -->
    <script src="{{asset('asset_rumbok/new/js/jquery.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/jquery.appear.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/slick.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/TweenMax.min.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/lightcase.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/jquery.shuffle.min.js')}}"></script>
    <script src="{{asset('asset_rumbok/new/js/theme.js')}}"></script>

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
			</script>
</body>

</html>