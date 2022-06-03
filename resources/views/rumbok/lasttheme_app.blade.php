<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="Rumon Prince Sohan">
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
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/barfiller.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/icofont.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/style.css?v=2.2')}}">
    <link href="{{ asset('css/frontend.css') }}">

    <!-- end inject -->
</head>

<body>

<!-- Preloader Starts -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
</div>


@include('rumbok.include.sidebar')

<!--======================================
        START HEADER AREA
    ======================================-->

<!-- Header Section Starts -->
<header class="header-section">
    <!-- Header Info Starts -->



    @if (!request()->is('student/*'))
        <div class="header-info">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-4">                    
                        <div class="info-left">
                        <a href="#-"><img src="{{asset('sm-TV-logo.png')}}" class="tv-icon"/></a>
                           {{--  <div class="phone-part">
                                <i class="fa fa-phone-square"></i>
                                <span><a href="tel:{{getSystemSetting('type_number')->value}}">{{getSystemSetting('type_number')->value}}</a></span>
                            </div> --}}
                            {{-- <div class="email-part">
                                <i class="fa fa-envelope-open"></i>
                                <span><a href="mailto:{{getSystemSetting('type_mail')->value}}">
                                    {{getSystemSetting('type_mail')->value}}</a></span>
                            </div>--}}
                            {{-- <div class="menu-toggle-bar">
                                <div class="custom-bars">
                                    <div class="custom-bar bar-1"></div>
                                    <div class="custom-bar bar-2"></div>
                                    <div class="custom-bar bar-3"></div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                    <div class="col-8">
                        <div class="info-right float-right">
                        <ul class="tvlogosec d-flex align-item-center my-0">
                                @guest()
                                    <li class="login-button my-auto"><a href="{{ route('login') }}" class="rounded py-2">@translate(Login)</a></li>
                                @endguest
                                @auth
                                <div class="logo-right-button">
                                    <div class="header-action-button d-flex align-items-center">
                                        @if (Auth::user()->user_type === "Student")
                                            <div class="header-widget header-widget2">
                                                <div class="header-right-info">
                                                    <ul class="user-cart d-flex align-items-center ">
                                                        <li class="p-50p">
                                                            <a href="{{route('my.courses')}}"
                                                               class="template-button py-2">@translate(My courses)</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>


                                            <div class="notification-wrap d-flex align-items-center ml-3">
                                                <div class="notification-item mr-3 cart_item">
                                                    <button class="notification-btn" type="button" onclick="openNav()"
                                                            id="cartDropdownMenu">
                                                        <i class="la la-shopping-cart user-cart-btn"></i>
                                                        <span class="quantity cart-quantity">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span>
                                                    </button>


                                                    <div id="mySidebar" class="cart-sidebar">
                                                        <a href="javascript:void(0)" class="closebtn"
                                                           onclick="closeNav()">X</a>
                                                        <a href="javascript:void(0)" class="arrow-btn" onclick="closeNav()"> <i
                                                                class="fa fa-angle-right"></i> </a>

                                                        <div class="text-center">
                                                            <h3>@translate(Your cart)</h3>
                                                            <hr>
                                                        </div>


                                                        <div class="cart_sidebar">
                                                            <input id="cartImg" name="cartImg" type="hidden" value="{{ asset('asset_rumbok/images/empty_cart.png') }}">
                                                            <ul id="cartAppend">
                                                                <img src="{{ asset('asset_rumbok/images/empty_cart.png') }}" class="w-100"  alt="">
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
                                                                    <input value="@translate(Go To Cart)" type="hidden"
                                                                           id="textUrl" name="textUrl">

                                                                @endif
                                                            @endauth

                                                            <div id="cartBtn">
                                                                <a href="{{route('course.filter')}}"
                                                                   class="theme-btn cart-btn btn-cart cart-text f-13 w-50">@translate(Get Your Course)</a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="notification-item mr-3 notify_btn">
                                                    <button class="notification-btn" type="button"
                                                            onclick="notifySidebaropenNav()">
                                                        <i class="la la-bell"></i>
                                                        <span class="quantity">{{ App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->count() }}</span>
                                                    </button>


                                                    <div id="notifySidebar" class="cart-sidebar">
                                                        <a href="javascript:void(0)" class="closebtn"
                                                           onclick="notifySidebarcloseNav()">X</a>
                                                        <a href="javascript:void(0)" class="arrow-btn"
                                                           onclick="notifySidebarcloseNav()"> <i class="fa fa-angle-right"></i>
                                                        </a>

                                                        <div class="text-center p-3">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <h3>@translate(Notifications)</h3>
                                                                </li>
                                                            </ul>
                                                            <hr>
                                                        </div>

                                                        <div class="cart_sidebar">
                                                            <ul class="list-group">
                                                                <li>
                                                                    @forelse (App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->latest()->get() as $notification)
                                                                        <div
                                                                            class="{{ $notification->is_read === 0 ? 'bg-ecf0f1' : '' }}">
                                                                            <div class="mess__item">
                                                                                <div class="icon-element bg-color-1 text-white">
                                                                                    <i class="la la-bolt"></i>
                                                                                </div>
                                                                                <div class="content">
                                                                                    @foreach ($notification->data as $item)
                                                                                        <span
                                                                                            class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                                                        <p class="text">{{ $item }}</p>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @empty
                                                                        <div class="content text-center no-notify">
                                                                            <img src="{{ asset('rumbok/images/notify.png') }}" class="w-100" alt="">
                                                                        </div>
                                                                    @endforelse
                                                                    <a href="{{ route('student.dashboard') }}"
                                                                       class="cart-btn btn-cart cart-text notify-btn f-13 w-50 mt-3">@translate(See all notifications)</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="notification-item mr-3 wishlist_btn">
                                                    <button class="notification-btn" type="button" onclick="wishopenNav()">
                                                        <i class="la la-heart-o"></i>
                                                        <span class="quantity wishlist-quantity"></span>
                                                    </button>


                                                    <div id="wishSidebar" class="cart-sidebar">
                                                        <a href="javascript:void(0)" class="closebtn"
                                                           onclick="wishcloseNav()">X</a>
                                                        <a href="javascript:void(0)" class="arrow-btn" onclick="wishcloseNav()">
                                                            <i class="fa fa-angle-right"></i> </a>

                                                        <div class="text-center">
                                                            <h3>@translate(Your Wishlist)</h3>
                                                            <hr>
                                                        </div>


                                                        <div class="cart_sidebar">
                                                            <input id="wishtImg" name="wishImg" type="hidden" value="{{ asset('rumbok/images/wishlist.png') }}">
                                                            <ul id="wishlistAppend">
                                                                <img src="{{ asset('rumbok/images/wishlist.png') }}" class="w-100" alt="">
                                                            </ul>
                                                            <div id="cartBtn">
                                                                <a href="{{ route('my.wishlist') }}"
                                                                   class="theme-btn cart-btn cart-text w-75">@translate(Show All Wishlist)</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="user-action-wrap">
                                                <div class="notification-item user-action-item">
                                                    <div class="dropdown">
                                                        <button
                                                            class="notification-btn dot-status online-status dropdown-toggle"
                                                            type="button" id="userDropdown" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                             ? asset('rumbok/images/student.png')
                                                             : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                 alt="{{ Auth::user()->name }}"
                                                                 class="avatar-sm rounded-circle">
                                                        </button>
                                                        <div class="dropdown-menu userDrop" aria-labelledby="userDropdown">
                                                            <div class="mess-dropdown">
                                                                <div class="mess__title d-flex align-items-center">

                                                                    <a href="{{ route('student.dashboard') }}">
                                                                        <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                                          ? asset('rumbok/images/student.png')
                                                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                             alt="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                                                             class="avatar-sm rounded-circle">
                                                                    </a>

                                                                    <div class="content ml-8">
                                                                        <h4 class="widget-title font-size-16">
                                                                            <a href="{{ route('student.dashboard') }}"
                                                                               class="text-white">
                                                                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                                                                            </a>
                                                                        </h4>
                                                                        <span
                                                                            class="email">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>
                                                                    </div>
                                                                </div><!-- end mess__title -->
                                                                @if (Auth::user()->user_type == "Student")

                                                                    <div class="mess__body">
                                                                        <ul class="list-items">

                                                                            <li class="mb-0">
                                                                                <a href="{{ route('student.profile') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-user"></i> @translate(My Profile)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('my.courses')}}" class="d-block">
                                                                                    <i class="la la-file-video-o"></i> @translate(My courses)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('student.message')}}"
                                                                                   class="d-block">
                                                                                    <i class="la la-bell"></i>
                                                                                    @translate(Message)
                                                                                </a>
                                                                            </li>


                                                                            <li class="mb-0">
                                                                                <a href="{{ route('student.purchase.history') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-cart-plus"></i>
                                                                                    @translate(Purchase history)
                                                                                </a>
                                                                            </li>
                                                                            @if(affiliateStatus())
                                                                                <li class="mb-0">
                                                                                    <a href="{{ route('affiliate.area') }}"
                                                                                       class="d-block">
                                                                                        <i class="la la-adn"></i>
                                                                                        @translate(Affiliate Area)
                                                                                    </a>
                                                                                </li>
                                                                            @endif

                                                                            <li class="mb-0">
                                                                                <div class="section-block mt-2 mb-2"></div>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{ route('logout') }}" class="d-block"
                                                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                    <i class="la la-power-off text-danger"></i>
                                                                                    @translate(Logout)
                                                                                </a>

                                                                                <form id="logout-form"
                                                                                      action="{{ route('logout') }}" method="POST"
                                                                                      class="d-none">
                                                                                    @csrf
                                                                                </form>
                                                                            </li>

                                                                        </ul>
                                                                    </div>

                                                                @else

                                                                    <div class="mess__body">
                                                                        <ul class="list-items">
                                                                            <li class="mb-0">
                                                                                <a href="{{ route('dashboard') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-dashboard"></i> @translate(Go To Dashboard)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('my.courses')}}" class="d-block">
                                                                                    <i class="la la-file-video-o"></i> @translate(My courses)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <div class="section-block mt-2 mb-2"></div>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{ route('logout') }}" class="d-block"
                                                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                    <i class="la la-power-off text-danger"></i>
                                                                                    @translate(Logout)
                                                                                </a>

                                                                                <form id="logout-form"
                                                                                      action="{{ route('logout') }}" method="POST"
                                                                                      class="d-none">
                                                                                    @csrf
                                                                                </form>
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                            @endif

                                                            <!-- end mess__body -->
                                                            </div><!-- end mess-dropdown -->
                                                        </div><!-- end dropdown-menu -->
                                                    </div><!-- end dropdown -->
                                                </div>
                                            </div>

                                        @else

                                            <div class="header-widget header-widget2">
                                                <div class="header-right-info">
                                                    <ul class="user-cart d-flex align-items-center ">
                                                        <li class="p-50p">
                                                            <a href="{{route('dashboard')}}"
                                                               class="btn btn-success text-white my-course-btn py-2">@translate(Go To Dashboard)</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="user-action-wrap">
                                                <div class="notification-item user-action-item">
                                                    <div class="dropdown">
                                                        <button
                                                            class="notification-btn dot-status online-status dropdown-toggle"
                                                            type="button" id="userDropdown" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                             ? asset('rumbok/images/student.png')
                                                             : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                 alt="{{ Auth::user()->name }}"
                                                                 class="avatar-sm rounded-circle">
                                                        </button>
                                                        <div class="dropdown-menu userDrop" aria-labelledby="userDropdown">
                                                            <div class="mess-dropdown">
                                                                <div class="mess__title d-flex align-items-center">

                                                                    <a href="{{ route('dashboard') }}">
                                                                        <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                                          ? asset('rumbok/images/student.png')
                                                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                             alt="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                                                             class="avatar-sm rounded-circle">
                                                                    </a>

                                                                    <div class="content ml-8">
                                                                        <h4 class="widget-title font-size-16">
                                                                            <a href="{{ route('dashboard') }}"
                                                                               class="text-white">
                                                                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                                                                            </a>
                                                                        </h4>
                                                                        <span
                                                                            class="email">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>
                                                                    </div>
                                                                </div><!-- end mess__title -->


                                                                <div class="mess__body">
                                                                    <ul class="list-items">
                                                                        <li class="mb-0">
                                                                            <a href="{{ route('media.index') }}"
                                                                               class="d-block">
                                                                                <i class="la la-video-camera"></i> @translate(Media Manager)
                                                                            </a>
                                                                        </li>

                                                                        @if (Auth::user()->user_type === 'Admin')

                                                                            @if(env('ADDONS_MANAGER') == "YES")

                                                                                <li class="mb-0">
                                                                                    <a href="{{ route('addons.manager.index') }}"
                                                                                       class="d-block">
                                                                                        <i class="la la-puzzle-piece"></i> @translate(Addons Manager)
                                                                                    </a>
                                                                                </li>

                                                                            @endif

                                                                            <li class="mb-0">
                                                                                <a href="{{route('packages.index')}}" class="d-block">
                                                                                    <i class="la la-briefcase"></i> @translate(Instructor Package)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('affiliate.setting.create')}}" class="d-block">
                                                                                    <i class="la la-chain"></i> @translate(Affiliate Area)
                                                                                </a>
                                                                            </li>


                                                                            <li class="mb-0">
                                                                                <a href="{{route('tickets.index')}}" class="d-block">
                                                                                    <i class="la la-ticket"></i> @translate(Support Ticket)
                                                                                </a>
                                                                            </li>
                                                                        @endif


                                                                        <li class="mb-0">
                                                                            <div class="section-block mt-2 mb-2"></div>
                                                                        </li>

                                                                        <li class="mb-0">
                                                                            <a href="{{ route('logout') }}" class="d-block"
                                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                <i class="la la-power-off text-danger"></i>
                                                                                @translate(Logout)
                                                                            </a>

                                                                            <form id="logout-form"
                                                                                  action="{{ route('logout') }}" method="POST"
                                                                                  class="d-none">
                                                                                @csrf
                                                                            </form>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                                <!-- end mess__body -->
                                                            </div><!-- end mess-dropdown -->
                                                        </div><!-- end dropdown-menu -->
                                                    </div><!-- end dropdown -->
                                                </div>
                                            </div>

                                        @endif

                                    </div>


                                    <div class="menu-toggler d-flex d-lg-none align-items-center">
                                        <!-- <div class="side-menu-open">
                                            <i class="la la-bars"></i>
                                        </div> -->
                                        <div class="my-auto">
                                            <a href="{{ route('student.profile') }}"
                                               class="d-block user-avatar-sm">

                                                <img class="avatar-sm" src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                          ? asset('rumbok/images/student.png')
                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                     alt="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="avatar-sm">
                                            </a>
                                        </div><!-- end user-menu-open -->
                                    </div>
                                </div><!-- end logo-right-button -->
                                @endauth
                                {{-- <li style="margin-left: 5px;"> <a href="#-"><img src="{{asset('sm-TV-logo2.png')}}"  /></a></li> --}}
						</ul>
                        {{-- <ul>
                               
                                <li>
                                    @if (env('FORUM_PANEL') === 'YES')
                                        <div>
                                            <a href="{{ route('forum.index') }}" target="_blank">
                                                <i class="fa fa-comments-o" aria-hidden="true"></i> @translate(Forum)
                                            </a>
                                        </div>
                                    @endif
                                </li>
                                --}}
                                
                               {{-- @if(getSystemSetting('type_fb')->value != null)
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
                                
                            </ul>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

<!-- main Header Starts -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="header-logo">
                        <a href="{{ route('homepage') }}"
                           title="{{getSystemSetting('type_name')->value}}">
                            <img class="img-fluid header-logo" src="{{ filePath(getSystemSetting('type_logo')->value) }}"
                                 alt="{{getSystemSetting('type_name')->value}}"></a>
                    </div>
                </div>
                <div class="col-lg-9 col-6">
                    <div class="main-header-right">
                        <!-- Category Dropdown Starts -->
                        <div class="d-lg-flex d-none">
                            <div class="category-dropdown mr-3">
                                <div class="menu-bar">
                                    <a href="javascript:void(0);">
                                    {{-- route('course.filter') --}}
                                        <span>@translate(Board)</span>
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                </div>
                                <div class="category-menu">
                                    <ul>
                                        @foreach(categories() as $item)
                                            @if (($item->is_compitative == '0') && ($item ->is_free_study != '1') && ($item ->is_current_affairs != '1') && ($item ->is_project_works != '1'))
                                            @if($item->name!='Blog')
                                                <li class="{{$item->child->count() != 0 ? 'have-submenu' : ''}}">
                                                    <a href="javascript:void(0);">{{$item->name}}</a>
                                                    @if($item->child->count() != 0)
                                                        <ul class="sub-menu">
                                                            @foreach($item->child as $child)
                                                                <li>
                                                                    <a href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
                                                                   {{-- @if(\App\Model\Category::where('parent_category_id',$child->id)->count() != 0)
                                                                    <ul class="sub-menu">
                                                                        @foreach(\App\Model\Category::where('parent_category_id',$child->id)->get() as $child1)
                                                                            <li>
                                                                                <a href="{{route('course.category',$child1->slug)}}">{{$child->id.'CHILD'}}{{$child1->id}}{{$child1->name}}</a>
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
                                </div>
                            </div>
                            <div class="category-dropdown mr-3">
                                <div class="menu-bar">
                                    <a href="javascript:void(0);">
                                        <span>@translate(Competitive)</span>
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                </div>
                                <div class="category-menu">
                                    <ul>
                                        @foreach(categories() as $item)
                                            @if ($item->is_compitative != '0')
                                                <li class="{{$item->child->count() != 0 ? 'have-submenu' : ''}}">
                                                    <a href="javascript:void(0);">{{$item->name}}</a>
                                                    @if($item->child->count() != 0)
                                                        <ul class="sub-menu">
                                                            @foreach($item->child as $child)
                                                                <li>
                                                                    <a href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="category-dropdown mr-3">
                                <div class="menu-bar">
                                    <a href="javascript:void(0);">
                                        <span>@translate(Study Material)</span>
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                </div>
                                <div class="category-menu">
                                    <ul>
                                        @foreach(categories() as $item)
                                            @if ($item->is_free_study != '0')
                                                <li class="{{$item->child->count() != 0 ? 'have-submenu' : ''}}">
                                                @if($item->slug == 'package-on-board')
                                                    <a href="{{route('packages.board',$item->slug)}}">{{$item->name}}</a>
                                                @else
                                                    <a href="{{route('course.category',$item->slug)}}">{{$item->name}}</a>
                                                @endif  
                                                
                                                    @if($item->child->count() != 0)
                                                        <ul class="sub-menu">
                                                            @foreach($item->child as $child)
                                                                <li>
                                                                    <a href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="category-dropdown mr-3">
                                <div class="menu-bar">
                                     <a href="{{route('current_affaire.category','current-affair')}}">
                                        <span>@translate(Current Affairs)</span>
                                       <!-- <i class="fa fa-chevron-down"></i> -->
                                    </a>
                                </div>
                               <!-- <div class="category-menu">
                                     <ul>
                                        
                                       {{--
                                        @foreach(categories() as $item)
                                            @if ($item->is_current_affairs != '0')
                                                <li class="{{$item->child->count() != 0 ? 'have-submenu' : ''}}">
                                                    <a href="{{route('current_affaire.category',$item->slug)}}">{{$item->name}}</a>
                                                    @if($item->child->count() != 0)
                                                        <ul class="sub-menu">
                                                            @foreach($item->child as $child)
                                                                <li>
                                                                    <a href="{{route('current_affaire.category',$child->slug)}}">{{$child->name}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach --}}
                                       
                                    </ul>
                                </div>-->
                            </div>
                            <div class="category-dropdown mr-3">
                                <div class="menu-bar">
                                    <a href="javascript:void(0);">
                                        <span>@translate(Project Works)</span>
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                </div>
                                <div class="category-menu">
                                    <ul>
                                        @foreach(categories() as $item)
                                            @if ($item->is_project_works != '0')
                                                <li class="{{$item->child->count() != 0 ? 'have-submenu' : ''}}">
                                                    <a href="{{route('course.category',$item->slug)}}">{{$item->name}}</a>
                                                    @if($item->child->count() != 0)
                                                        <ul class="sub-menu">
                                                            @foreach($item->child as $child)
                                                                <li>
                                                                    <a href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="d-lg-none d-flex">
                            <div class="float-right">
                                <div class="menu-toggle-bar rounded">
                                    <div class="custom-bars">
                                        <div class="custom-bar bar-1"></div>
                                        <div class="custom-bar bar-2"></div>
                                        <div class="custom-bar bar-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Header search and instructor and student login button not visible for now -->
                        <div class="header-search d-none">
                            <form action="#">
                                <input class="form-control" id="search" type="text" name="search"
                                       placeholder="@translate(Search for anything)">
                                <button type="submit"><i class="fa fa-search"></i></button>

                                <!-- Search bar END - -->

                                <!-- ======================== Search Suggession ============================= -->

                                <div class="overflow-hidden search-list w-100">
                                    <div id="appendSearchCart1"></div>
                                </div>
                                {{--some ajax value--}}
                                <input value="@translate(Your Cart is Empty)" type="hidden"
                                       id="emptyUrl" name="emptyUrl">
                                <input value="{{route('search.courses')}}" type="hidden"
                                       id="searchUrl" name="searchUrl">
                            </form>
                        </div>
                        <div class="header-button d-none">
                            @auth
                                <div class="logo-right-button">
                                    <div class="header-action-button d-flex align-items-center">
                                        @if (Auth::user()->user_type === "Student")
                                            <div class="header-widget header-widget2">
                                                <div class="header-right-info">
                                                    <ul class="user-cart d-flex align-items-center ">
                                                        <li class="p-50p">
                                                            <a href="{{route('my.courses')}}"
                                                               class="template-button">@translate(My courses)</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>


                                            <div class="notification-wrap d-flex align-items-center ml-3">
                                                <div class="notification-item mr-3 cart_item">
                                                    <button class="notification-btn" type="button" onclick="openNav()"
                                                            id="cartDropdownMenu">
                                                        <i class="la la-shopping-cart user-cart-btn"></i>
                                                        <span class="quantity cart-quantity">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span>
                                                    </button>


                                                    <div id="mySidebar" class="cart-sidebar">
                                                        <a href="javascript:void(0)" class="closebtn"
                                                           onclick="closeNav()">X</a>
                                                        <a href="javascript:void(0)" class="arrow-btn" onclick="closeNav()"> <i
                                                                class="fa fa-angle-right"></i> </a>

                                                        <div class="text-center">
                                                            <h3>@translate(Your cart)</h3>
                                                            <hr>
                                                        </div>


                                                        <div class="cart_sidebar">
                                                            <input id="cartImg" name="cartImg" type="hidden" value="{{ asset('asset_rumbok/images/empty_cart.png') }}">
                                                            <ul id="cartAppend">
                                                                <img src="{{ asset('asset_rumbok/images/empty_cart.png') }}" class="w-100"  alt="">
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
                                                                    <input value="@translate(Go To Cart)" type="hidden"
                                                                           id="textUrl" name="textUrl">

                                                                @endif
                                                            @endauth

                                                            <div id="cartBtn">
                                                                <a href="{{route('course.filter')}}"
                                                                   class="theme-btn cart-btn btn-cart cart-text f-13 w-50">@translate(Get Your Course)</a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="notification-item mr-3 notify_btn">
                                                    <button class="notification-btn" type="button"
                                                            onclick="notifySidebaropenNav()">
                                                        <i class="la la-bell"></i>
                                                        <span class="quantity">{{ App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->count() }}</span>
                                                    </button>


                                                    <div id="notifySidebar" class="cart-sidebar">
                                                        <a href="javascript:void(0)" class="closebtn"
                                                           onclick="notifySidebarcloseNav()">X</a>
                                                        <a href="javascript:void(0)" class="arrow-btn"
                                                           onclick="notifySidebarcloseNav()"> <i class="fa fa-angle-right"></i>
                                                        </a>

                                                        <div class="text-center p-3">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <h3>@translate(Notifications)</h3>
                                                                </li>
                                                            </ul>
                                                            <hr>
                                                        </div>

                                                        <div class="cart_sidebar">
                                                            <ul class="list-group">
                                                                <li>
                                                                    @forelse (App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->latest()->get() as $notification)
                                                                        <div
                                                                            class="{{ $notification->is_read === 0 ? 'bg-ecf0f1' : '' }}">
                                                                            <div class="mess__item">
                                                                                <div class="icon-element bg-color-1 text-white">
                                                                                    <i class="la la-bolt"></i>
                                                                                </div>
                                                                                <div class="content">
                                                                                    @foreach ($notification->data as $item)
                                                                                        <span
                                                                                            class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                                                        <p class="text">{{ $item }}</p>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @empty
                                                                        <div class="content text-center no-notify">
                                                                            <img src="{{ asset('rumbok/images/notify.png') }}" class="w-100" alt="">
                                                                        </div>
                                                                    @endforelse
                                                                    <a href="{{ route('student.dashboard') }}"
                                                                       class="cart-btn btn-cart cart-text notify-btn f-13 w-50 mt-3">@translate(See all notifications)</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="notification-item mr-3 wishlist_btn">
                                                    <button class="notification-btn" type="button" onclick="wishopenNav()">
                                                        <i class="la la-heart-o"></i>
                                                        <span class="quantity wishlist-quantity"></span>
                                                    </button>


                                                    <div id="wishSidebar" class="cart-sidebar">
                                                        <a href="javascript:void(0)" class="closebtn"
                                                           onclick="wishcloseNav()">X</a>
                                                        <a href="javascript:void(0)" class="arrow-btn" onclick="wishcloseNav()">
                                                            <i class="fa fa-angle-right"></i> </a>

                                                        <div class="text-center">
                                                            <h3>@translate(Your Wishlist)</h3>
                                                            <hr>
                                                        </div>


                                                        <div class="cart_sidebar">
                                                            <input id="wishtImg" name="wishImg" type="hidden" value="{{ asset('rumbok/images/wishlist.png') }}">
                                                            <ul id="wishlistAppend">
                                                                <img src="{{ asset('rumbok/images/wishlist.png') }}" class="w-100" alt="">
                                                            </ul>
                                                            <div id="cartBtn">
                                                                <a href="{{ route('my.wishlist') }}"
                                                                   class="theme-btn cart-btn cart-text w-75">@translate(Show All Wishlist)</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="user-action-wrap">
                                                <div class="notification-item user-action-item">
                                                    <div class="dropdown">
                                                        <button
                                                            class="notification-btn dot-status online-status dropdown-toggle"
                                                            type="button" id="userDropdown" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                             ? asset('rumbok/images/student.png')
                                                             : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                 alt="{{ Auth::user()->name }}"
                                                                 class="avatar-sm rounded-circle">
                                                        </button>
                                                        <div class="dropdown-menu userDrop" aria-labelledby="userDropdown">
                                                            <div class="mess-dropdown">
                                                                <div class="mess__title d-flex align-items-center">

                                                                    <a href="{{ route('student.dashboard') }}">
                                                                        <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                                          ? asset('rumbok/images/student.png')
                                                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                             alt="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                                                             class="avatar-sm rounded-circle">
                                                                    </a>

                                                                    <div class="content ml-8">
                                                                        <h4 class="widget-title font-size-16">
                                                                            <a href="{{ route('student.dashboard') }}"
                                                                               class="text-white">
                                                                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                                                                            </a>
                                                                        </h4>
                                                                        <span
                                                                            class="email">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>
                                                                    </div>
                                                                </div><!-- end mess__title -->
                                                                @if (Auth::user()->user_type == "Student")

                                                                    <div class="mess__body">
                                                                        <ul class="list-items">

                                                                            <li class="mb-0">
                                                                                <a href="{{ route('student.profile') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-user"></i> @translate(My Profile)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('my.courses')}}" class="d-block">
                                                                                    <i class="la la-file-video-o"></i> @translate(My courses)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('student.message')}}"
                                                                                   class="d-block">
                                                                                    <i class="la la-bell"></i>
                                                                                    @translate(Message)
                                                                                </a>
                                                                            </li>


                                                                            <li class="mb-0">
                                                                                <a href="{{ route('student.purchase.history') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-cart-plus"></i>
                                                                                    @translate(Purchase history)
                                                                                </a>
                                                                            </li>
                                                                            @if(affiliateStatus())
                                                                                <li class="mb-0">
                                                                                    <a href="{{ route('affiliate.area') }}"
                                                                                       class="d-block">
                                                                                        <i class="la la-adn"></i>
                                                                                        @translate(Affiliate Area)
                                                                                    </a>
                                                                                </li>
                                                                            @endif

                                                                            <li class="mb-0">
                                                                                <div class="section-block mt-2 mb-2"></div>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{ route('logout') }}" class="d-block"
                                                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                    <i class="la la-power-off text-danger"></i>
                                                                                    @translate(Logout)
                                                                                </a>

                                                                                <form id="logout-form"
                                                                                      action="{{ route('logout') }}" method="POST"
                                                                                      class="d-none">
                                                                                    @csrf
                                                                                </form>
                                                                            </li>

                                                                        </ul>
                                                                    </div>

                                                                @else

                                                                    <div class="mess__body">
                                                                        <ul class="list-items">
                                                                            <li class="mb-0">
                                                                                <a href="{{ route('dashboard') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-dashboard"></i> @translate(Go To Dashboard)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('my.courses')}}" class="d-block">
                                                                                    <i class="la la-file-video-o"></i> @translate(My courses)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <div class="section-block mt-2 mb-2"></div>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{ route('logout') }}" class="d-block"
                                                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                    <i class="la la-power-off text-danger"></i>
                                                                                    @translate(Logout)
                                                                                </a>

                                                                                <form id="logout-form"
                                                                                      action="{{ route('logout') }}" method="POST"
                                                                                      class="d-none">
                                                                                    @csrf
                                                                                </form>
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                            @endif

                                                            <!-- end mess__body -->
                                                            </div><!-- end mess-dropdown -->
                                                        </div><!-- end dropdown-menu -->
                                                    </div><!-- end dropdown -->
                                                </div>
                                            </div>

                                        @else

                                            <div class="header-widget header-widget2">
                                                <div class="header-right-info">
                                                    <ul class="user-cart d-flex align-items-center ">
                                                        <li class="p-50p">
                                                            <a href="{{route('dashboard')}}"
                                                               class="btn btn-success text-white my-course-btn">@translate(Go To Dashboard)</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="user-action-wrap">
                                                <div class="notification-item user-action-item">
                                                    <div class="dropdown">
                                                        <button
                                                            class="notification-btn dot-status online-status dropdown-toggle"
                                                            type="button" id="userDropdown" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                             ? asset('rumbok/images/student.png')
                                                             : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                 alt="{{ Auth::user()->name }}"
                                                                 class="avatar-sm rounded-circle">
                                                        </button>
                                                        <div class="dropdown-menu userDrop" aria-labelledby="userDropdown">
                                                            <div class="mess-dropdown">
                                                                <div class="mess__title d-flex align-items-center">

                                                                    <a href="{{ route('dashboard') }}">
                                                                        <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                                          ? asset('rumbok/images/student.png')
                                                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                             alt="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                                                             class="avatar-sm rounded-circle">
                                                                    </a>

                                                                    <div class="content ml-8">
                                                                        <h4 class="widget-title font-size-16">
                                                                            <a href="{{ route('dashboard') }}"
                                                                               class="text-white">
                                                                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                                                                            </a>
                                                                        </h4>
                                                                        <span
                                                                            class="email">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>
                                                                    </div>
                                                                </div><!-- end mess__title -->


                                                                <div class="mess__body">
                                                                    <ul class="list-items">
                                                                        <li class="mb-0">
                                                                            <a href="{{ route('media.index') }}"
                                                                               class="d-block">
                                                                                <i class="la la-video-camera"></i> @translate(Media Manager)
                                                                            </a>
                                                                        </li>

                                                                        @if (Auth::user()->user_type === 'Admin')

                                                                            @if(env('ADDONS_MANAGER') == "YES")

                                                                                <li class="mb-0">
                                                                                    <a href="{{ route('addons.manager.index') }}"
                                                                                       class="d-block">
                                                                                        <i class="la la-puzzle-piece"></i> @translate(Addons Manager)
                                                                                    </a>
                                                                                </li>

                                                                            @endif

                                                                            <li class="mb-0">
                                                                                <a href="{{route('packages.index')}}" class="d-block">
                                                                                    <i class="la la-briefcase"></i> @translate(Instructor Package)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('affiliate.setting.create')}}" class="d-block">
                                                                                    <i class="la la-chain"></i> @translate(Affiliate Area)
                                                                                </a>
                                                                            </li>


                                                                            <li class="mb-0">
                                                                                <a href="{{route('tickets.index')}}" class="d-block">
                                                                                    <i class="la la-ticket"></i> @translate(Support Ticket)
                                                                                </a>
                                                                            </li>
                                                                        @endif


                                                                        <li class="mb-0">
                                                                            <div class="section-block mt-2 mb-2"></div>
                                                                        </li>

                                                                        <li class="mb-0">
                                                                            <a href="{{ route('logout') }}" class="d-block"
                                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                <i class="la la-power-off text-danger"></i>
                                                                                @translate(Logout)
                                                                            </a>

                                                                            <form id="logout-form"
                                                                                  action="{{ route('logout') }}" method="POST"
                                                                                  class="d-none">
                                                                                @csrf
                                                                            </form>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                                <!-- end mess__body -->
                                                            </div><!-- end mess-dropdown -->
                                                        </div><!-- end dropdown-menu -->
                                                    </div><!-- end dropdown -->
                                                </div>
                                            </div>

                                        @endif

                                    </div>


                                    <div class="menu-toggler d-flex align-items-center">
                                        <div class="side-menu-open">
                                            <i class="la la-bars"></i>
                                        </div><!-- end side-menu-open -->
                                        <div class="user-menu-open ml-2">
                                            <a href="{{ route('student.profile') }}"
                                               class="d-block user-avatar-sm">

                                                <img class="avatar-sm" src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                          ? asset('rumbok/images/student.png')
                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                     alt="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="avatar-sm">
                                            </a>
                                        </div><!-- end user-menu-open -->
                                    </div>
                                </div><!-- end logo-right-button -->
                            @endauth

                            @guest
                                <a href="{{route('student.register')}}" class="template-button-2">@translate(become student)</a>
                                <a href="{{route('instructor.register')}}" class="template-button">@translate(instructor)</a>
                            @endguest

                        </div>
                        <!-- Header search and instructor and student login button not visible for now -->
                    </div>
                </div>
            </div>
        </div>
    </div>



    @auth
        {{-- bottom responsive menu --}}
        <ul class="nav justify-content-center fixed-bottom bg-white btm-fixed-nav d-none">
            <li class="nav-item">
                <div class="notification-item mr-3">
                    <a href="{{ route('shopping.cart') }}">
                        <button class="notification-btn dropdown-toggle">
                            <i class="la la-shopping-cart"></i>
                            <span class="quantity cart-quantity">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span>
                        </button>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <div class="notification-item mr-3">
                    <a href="{{ route('student.dashboard') }}">
                        <button class="notification-btn dropdown-toggle">
                            <i class="la la-bell"></i>
                            <span class="quantity">{{ App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->count() }}</span>
                        </button>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <div class="notification-item mr-3">
                    <a href="{{ route('my.wishlist') }}">
                        <button class="notification-btn dropdown-toggle">
                            <i class="la la-heart-o"></i>
                            <span class="quantity wishlist-quantity">{{ App\Model\Wishlist::where('user_id',Auth::user()->id)->count() }}</span>
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


    @guest()
        <!-- CTA Section Starts -->
        <section class="cta-section gradient-bg padding-top-60 padding-bottom-30">
            <div class="cta-shape">
                <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="image" class="plus-sign item-rotate">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="section-title margin-bottom-40">
                            <h2>@translate(register & join our live classes) <span>@translate(for free today)</span></h2>
                        </div>
						
                        <div class="cta-button">
                            <a href="{{route('frontend.book-free-class.index')}}" class="template-button margin-right-20">@translate(BOOK LIVE CLASS)</a>
                            <a href="{{route('student.register')}}" class="template-button-2">@translate(SIGNUP)</a>
                        </div>
                    </div>
                    <div class="col-xl-4 offset-xl-2 col-lg-6">
                        <div class="cta-image">
                            <img src="{{asset('asset_rumbok/images/cta-image.png')}}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endguest

    <!-- ================================
           Start FOOTER AREA
  ================================= -->

    <!-- Footer Section Starts -->
    <footer class="footer-section padding-top-30 padding-bottom-60">
        <div class="container bottom_border">
			<div class="row">
				<div class=" col-sm-4 col-md col-sm-4  col-12 col">
					<h4 class="title col_white_amrc pt2">@translate(Find us)</h4>
					<!--headin5_amrc-->
					<p class="mb10">@translate(OLE is an online platform that help to reconstruct the teaching learning process it is a seamless transition to online world. A gateway to inclusive education, where streams, learning capacity, topics and subjects meet. When people are waiting for this to happen, Lead the change with OLE.)<br/><a href="{{url('page/about-us')}}" class="font-14p">Read More</a></p>
					<p><i class="icofont-megaphone promo">&nbsp;promoted by:</i> <a href="https://samadhan.group" target="_blank">@translate(Samadhan Group)</a> </p>
					<p><i class="fa-handshake-o promo">&nbsp;incubated by:</i> <a href="https://iid.org.in" target="_blank">@translate(Institute&nbsp;for&nbsp;Industrial&nbsp;Development (IID))</a></p>
					
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
								 alt="{{getSystemSetting('type_name')->value}}" class="round-shape-3" style="width:80px;">
						</a>
					</div>
					<p>&nbsp;</p>
					<p><i class="fa fa-map-marker"></i> {{getSystemSetting('type_address')->value}}</p>
					<p><i class="fa fa-phone"></i>  {{getSystemSetting('type_number')->value}}  </p>
					<p><i class="fa fa fa-envelope"></i> {{getSystemSetting('type_mail')->value}}  </p>
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
    


    <!-- ================================
              END FOOTER AREA
    ================================= -->
@endif





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
<script>
function openNav1() {
  document.getElementById("mySidepanel1").style.width = "250px";
}

function closeNav1() {
  document.getElementById("mySidepanel1").style.width = "0";
}
</script>
@include('layouts.modal')

@include('sweetalert::alert')
@yield('js')

</body>

</html>
