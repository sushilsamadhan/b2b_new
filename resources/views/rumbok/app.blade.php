<!DOCTYPE html>
<html>
@php 
$school_id = Session::get('school_id');
$getB2Blogo = App\B2bconfiguration::select('*')->where('universities_id' , $school_id)->first(); 
@endphp 
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="OLE">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-language" content="en">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="{{ env('APP_NAME') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <meta name="description" content="{{ (isset($pageMeta['meta_description'])) ? $pageMeta['meta_description']:  $getB2Blogo->site_description }}">
    <meta name="title" content="{{ (isset($pageMeta['meta_title']) && !empty($pageMeta['meta_title'])) ? $pageMeta['meta_title']:  $getB2Blogo->site_title }}">
    <meta name="keywords" content="{{ (isset($pageMeta['tag'])) ? $pageMeta['tag']:  $getB2Blogo->tag }}">

    <title>{{ (isset($pageMeta['meta_title'])&& !empty($pageMeta['meta_title'])) ? $pageMeta['meta_title']  : $getB2Blogo->meta_title }}</title>
   

    <!-- Favicon -->
    <link rel="icon" sizes="16x16"
        href="{{$getB2Blogo->fav_icon}}">
    <link href="https://olexpert.org.in/public/css/font.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{url('/')}}/public/new-b2b/css/main.css" />
    <link rel="stylesheet" href="{{url('/')}}/public/new-b2b/css/individual-style.css" />
    <style>
        iframe [title] {
            right: 0 !important;
            bottom: 200px !important;
        }
    </style>
    <style>
        input#pass {
            position: relative;
        }

        .potrait {
            display: block;
            position: relative;
        }

        .landscape {
            display: none;
        }

        @media (max-width:767px) {

            /* (A) WRONG ORIENTATION - SHOW MESSAGE HIDE CONTENT */
            @media only screen and (orientation:landscape) {
                .potrait {
                    display: none;
                }

                .landscape {
                    display: block;
                }
            }

            /* (B) CORRECT ORIENTATION - SHOW CONTENT HIDE MESSAGE */
            @media only screen and (orientation:portrait) {
                .potrait {
                    display: block;
                }

                .landscape {
                    display: none;
                }
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
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-GNP26SZ9HT');
    </script>
</head>

<body class="notLoaded">

    <div class="potrait">
        <!--======================================
            START HEADER AREA
        ======================================-->

        <!-- Header Section Starts -->
        <header class="header-section individual-header">
            <!-- Header Info Starts -->
            <div class="header-new sticky">
                <div class="container-fluid">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 d-none d-md-block d-lg-block">
                            <div class="d-flex align-items-center">
                                <div class="icon-top-header icon-top-header-rounded">
                                    <span><i class="ti-mobile"></i></span>
                                    +91 {{$getB2Blogo->m_number}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-3">
                            <a href="{{url('/')}}">
                                <div class="school-logo">
                                    <img src="{{$getB2Blogo->logo}}">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-9">
                            <div class="individual-right-bar">
                                <ul>
                                    <li> 
                                    @guest()
                                        <a href="{{url('/')}}/login" class="tab-btn">
                                            Register/Login
                                        </a>
                                    @endguest
                                    @auth
                                        <a href="{{route('dashboard')}}" class="tab-btn">
                                            Dashboard
                                        </a>
                                    @endauth
                                    </li>
                                    
                                    <li>
                                        <a class="cart-box circle-btn" href="javascript:void(0);" onclick="cart_open()">
                                            <span class="cart-span"><i class="ti-shopping-cart"></i></span>
                                            <span class="cart-item-count cart-quantity">@auth @if(App\Model\Cart::where('user_id',Auth::user()->id)->count()) {{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }} @else 0 @endif @endauth</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                                <!-- Cart Side bar -->
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
                                                                <span class="badge bg-warning cart-quantity">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span>
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
                                <a class="main-menu-btn" onclick="openTopmenu()">
                                    <span class="mainmenu-top">
                                        <i class="fas fa-bars"></i>
                                    </span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="maniNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" onclick="closeTopmenu()">&times;</a>
                <div class="overlay-content">

                </div>
            </div>
        </header>
        

        @yield('content')
    <!-- For Mobile View Only -->
    <div class="bottom-menu">
        <div class="d-flex align-items-center justify-content-between">
            <div class="bottom-block">
                <a href="https://olexpert.org.in" title="Home">
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
                    <div class="bottom-menu-text">

                        <a href="https://olexpert.org.in/student/profile" title="My account">My account</a>
                    </div>
                </div>

            </div>
            <div class="bottom-block">
                <a href="#" onclick="cart_open()" title="Cart">
                    <div class="bottom-menu-part">
                        <div class="bottom-menu-icon"><i class="ti-shopping-cart"></i><span
                                class="bottom-menu-cart-count cart-item-count cart-quantity">1</span></div>
                        <div class="bottom-menu-text">Cart</div>
                    </div>
                </a>

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
    <!-- For End Mobile View Only -->

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
                                <div class="ab-social mt-4">
                                    <a class="fac" href="https://www.facebook.com/Olexperts" target="_blank"
                                        title="Facebook"><i class="social_facebook"></i></a>
                                    <a class="twi" href="javascript:void();" target="_blank" title="Twitter"><i
                                            class="social_twitter"></i></a>
                                    <a class="you" href="https://www.youtube.com/c/onlinelearningwithexperts"
                                        target="_blank" title="Youtube"><i class="social_youtube"></i></a>
                                    <a class="lin"
                                        href="https://www.linkedin.com/company/oleclasses/?trk=public_post_share-update_actor-text"
                                        target="_blank" title="Linkedin"><i class="social_linkedin"></i></a>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-12 col-md-12">
                    <aside class="widget text-center">
 @php
    $allpages = App\Page::where(['school_id' => $school_id , 'active' => '1' ])->get();
 @endphp
                        
                        @foreach($allpages as $allpagesval)
                            <a href="{{route('pages',$allpagesval->slug)}}" title="{{$allpagesval->title}}">{{$allpagesval->title}}</a> | 
                        @endforeach
                            <a href="{{route('blog.all')}}" title="Blog">Blog</a> 
                        </aside>
                    </div>
                </div>
                <!-- Copyrigh -->
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="copyright">
                            <p>© 2021 Copyright All Right Reserved.</p>
                            <p>Promoted by <a href="https://samadhan.group" target="_blank"
                                    title="Samadhan Group">Samadhan
                                    Group</a> &amp; Incubated by <a href="https://iid.org.in" target="_blank"
                                    title="Institute for Industrial Development (IID)">Institute for Industrial
                                    Development
                                    (IID)</a></p>
                        </div>
                    </div>
                </div>
                <!-- Copyrigh -->
            </div>
        </footer>
        <!-- Footer Section End -->
    </div>
    <div class="landscape bg-info py-2"
        style="width:100%;height: 100%;text-align:center;position: fixed;top: 0;left: 0; z-index:1;">
        <h2 class="text-white">Please rotate your device</h2>
        <p class="text-white">We don't support landscape mode yet. Please go back to Portrait mode for the best
            experience.</p>
    </div>

    <!-- ================================
              END FOOTER AREA
    ================================= -->

    <!-- template js files -->
    <!-- Javascript Files -->
    {{--<link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/slick.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/swiper-bundle.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/lightcase.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/preset.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/font-awesome.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/elegant-icons.min.css')}}"/>
    <link async rel="stylesheet" href="{{asset('asset_rumbok/new/css/minified/themify-icons.min.css')}}"/>--}}
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

<!-- <script  src="{{asset('new-b2b/js/theme.js')}}"></script> -->

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
        $(document).ready(function () {
            $(".dropdown-cat").click(function () {
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
    <div class="modal fade " id="show-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body shadow" id="show-form">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade custom-modal" id="show-media-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body shadow" id="show-media-form">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("button.display1").click(function () {
                $(".tab-1").toggle();
            });
            $("button.display2").click(function () {
                $(".tab-2").toggle();
            });
            $("button.display3").click(function () {
                $(".tab-3").toggle();
            });
            $("button.display4").click(function () {
                $(".tab-4").toggle();
            });
            $("button.display5").click(function () {
                $(".tab-5").toggle();
            });
            $("button.display6").click(function () {
                $(".tab-6").toggle();
            });
            $("button.display7").click(function () {
                $(".tab-7").toggle();
            });
            $("button.display8").click(function () {
                $(".tab-8").toggle();
            });
            $("button.display9").click(function () {
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
        $('.oneslideslider').owlCarousel({
            loop: false,
            margin: 0,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
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
                            <img src="https://olexpert.org.in/public/thumbs-up.gif" class="img-fluid" alt="OLExpert">
                        </div>
                        <div class="congrats-content">
                            <h3>Congratulation!!!</h3>
                            <h6><strong>You can now purchase any one paid Class Curriculum or Competitive Package or
                                    Elite Course for FREE.</strong></h6>
                            <h6><strong>Coupon will be auto applied on checkout page.</strong></h6>
                            <p><a href="https://olexpert.org.in" class="btn btn-primary" title="Proceed">Proceed</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            window.setTimeout('fadeout();', 500);

        });

        function fadeout() {
            $('#loader').delay(1000).fadeOut('slow', function () {
                $('.notLoaded').removeClass('notLoaded');
            });
        }
        function openTopmenu() {
            document.getElementById("maniNav").style.width = "100%";
        }

        function closeTopmenu() {
            document.getElementById("maniNav").style.width = "0%";
        }
    </script>

</body>

</html>

{{--@endsection--}}