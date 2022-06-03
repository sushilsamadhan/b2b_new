@extends('rumbok.app')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>

iframe {
    width: 100% !important;
    height: 98% !important; 
}
.font-size-20 {
    font-size: 13px !important;
}
</style>
    <!-- Breadcrumb Section Starts -->
    <!-- <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
                 class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>@translate(cart)</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a> / @translate(cart)</span>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
          <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                    <h1>Checkout</h1>
                    </div>
               </div>  
                         
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                      <a href="{{route('homepage')}}">@translate(home)</a>
                      </li>
                      <li>
                        <span> @translate(cart)</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
    <!-- Cart Section Starts -->
    <section class="cart-section padding-top-120">
        <?php $total_price =0; $coupon=0;?>
        @if(isset($cartList) && !empty($cartList))
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-8">
                        @php
                            $total_price = 0;
                            $carts = $cartList;
                            //512345678902345echo "<pre>"; print_r($carts);die;
                        @endphp
                        @foreach($carts as $item)
                            @if($item->item_type == 'course')
                            <?php //print_r($item); die('pppppppppppppppppppp'); 
                            
                            if($item->course->lms_refference_id == 0 && $item->course->ole_refference_id > 0){
                                $cartsimage = "https://olexpert.org.in/public/".$item->course->image;
                            }
                            if($item->course->lms_refference_id > 0 && $item->course->ole_refference_id > 0){
                                $cartsimage = "https://courses.iid.org.in/public/".$item->course->image;
                            }
                            if($item->course->ole_refference_id == 0 && $item->course->lms_refference_id == 0){
                                $cartsimage = "http://entrepreneurindia.tv/public/".$item->course->image;
                            } 
                            
                            ?>
                                <div class="single-cart-item border p-1 rounded mb-1">
                                    <div class="row align-items-center">
                                        <div class="col-lg-5">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4">
                                                
                                                    <a href="{{route('course.single',$item->course->slug)}}">
                                                        <img src="{{$cartsimage}}"
                                                            alt="{{$item->course->title}}" class="img-fluid"></a>
                                                </div>
                                                <div class="col-lg-8">
                                                    <h5 class="font-weight-normal mb-0">
                                                        <a href="{{route('course.single',$item->course->slug)}}">{{$item->course->title}}</a>
                                                    </h5>
                                                    <span>{{ucfirst(strtolower($item->package_type))}} - {{$item->parent_category_name}} - {{$item->category_name}}</span>
                                                    {{-- <span>@translate(by) <a
                                                            href="#">{{(isset($item->course->relationBetweenInstructorUser))??$item->course->relationBetweenInstructorUser->name}}</a></span> --}}  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <ul class="list-inline d-flex justify-content-between align-items-center">
                                                <li class="list-inline-item">
                                                    @if($item->course->is_free)
                                                        <h5>@translate(Free)</h5>
                                                    @else
                                                        @if($item->course->is_discount)
                                                            <h5>{{formatPrice($item->course->discount_price)}}</h5>
                                                            <input type="hidden"
                                                                value="{{$total_price+=$item->course->discount_price}}">
                                                        @else
                                                        <?php
                                                            if($b2bpricing_mechanisms){
                                                                if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
                                                                    $itemCoursePrice = round($item->course->price + ($item->course->price * ($b2bpricing_mechanisms->value/100)), 0);            
                                                                }
                                                                if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
                                                                    $itemCoursePrice = round($item->course->price - ($item->course->price * ($b2bpricing_mechanisms->value/100)), 0);           
                                                                } 
                                                            }else{
                                                                $itemCoursePrice = round($item->course->price, 0);
                                                            }
                                                        ?>
                                                            <input type="hidden" value="{{$total_price+=$itemCoursePrice}}">
                                                            <h5>{{formatPrice($itemCoursePrice)}}</h5>
                                                        @endif
                                                    @endif
                                                </li>
                                                <li class="list-inline-item"><a href="{{route('cart.remove',$item->id)}}"
                                                    class="btn btn-danger btn-sm"><i class="ti-trash" aria-hidden="true"></i> @translate(remove)</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="single-cart-item p-1 border rounded mb-1">
                                    <div class="row align-items-center">
                                        <div class="col-lg-5">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4">
                                                
                                                    <a href="{{route('packages.preview_board',$item->course_id)}}">
                                                        <img src="{{$item->image}}"
                                                            alt="{{$item->title}}" class="img-fluid"></a>

                                                            
                                                </div>
                                                <div class="col-lg-8">
                                                <?php //echo "<pre>"; ucfirst(strtolower($item->package_type));?>
                                                    <h5 class="font-weight-normal mb-0">
                                                        <a href="{{route('packages.preview_board',$item->course_id)}}">{{$item->title}}</a>
                                                    </h5>
                                                    <span>{{ucfirst(strtolower($item->package_type))}}  - {{$item->parent_category_name}} - {{$item->category_name}}

                                                    
                                                    </span>
                                                    {{--  <span>@translate(by) <a
                                                            href="#">{{(isset($item->course->relationBetweenInstructorUser))??$item->course->relationBetweenInstructorUser->name}}</a></span> --}}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-7">
                                            <ul  class="list-inline d-flex justify-content-between align-items-center">
                                                <li class="list-inline-item">
                                                    @if($item->price=='0' || $item->price=='')
                                                        <h5>@translate(Free)</h5>
                                                    @else
                                                        
                                                    <input type="hidden" value="{{$total_price+=$item->price}}">
                                                    <h5>{{formatPrice($item->price)}}</h5>
                                                        
                                                    @endif
                                                </li>
                                                <li class="list-inline-item"><a href="{{route('packages.remove',$item->id)}}"
                                                    class="btn btn-danger btn-sm"><i class="ti-trash" aria-hidden="true"></i> @translate(remove)</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-4">
                    <div class="cart-detail-wrap">
                    <div class="row">
                    @if(env('COUPON_ACTIVE') != "NO" && 
                            couponRouteForBlade())
                        <div class="col-lg-12">

                            <div class="contact-form-action mt-2 bg-light border p-2">

                                @if(!Session::has('coupon'))

                                <h5 class="widget-title font-size-20">@translate(Have coupon code? Apply here)</h5>

                                <form action="{{ route('checkout.coupon.store') }}" 
                                    class="needs-validation" 
                                    novalidate
                                    method="post">
                                    @csrf

                                    <div class="input-box">
                                        <div class="form-group mb-0 d-flex justify-content-between">
                                            <!-- Search bar -->
                                            <input class="form-control" type="text" name="code" placeholder="Enter Coupon Code Here" style="width:auto;">
                                            <input type="hidden" name="total" value="{{ onlyPrice($total_price) }}">
                                            <button type="submit" class="btn btn-primary btn-sm">@translate(Apply)</button>
                                            <!-- Search bar END - -->
                                        </div>
                                    </div><!-- end input-box -->
                                </form>

                                @endif
                                
                            <div class="mt-4">
        
                                @if(Session::has('success'))
                                    <h5 class="text-center text-success font-weight-normal text-uppercase">{{ Session::get('success') }}</h5>
                                @endif
        
        
                                @if(Session::has('error'))
                                    <h5 class="text-center text-danger font-weight-normal text-uppercase">{{ Session::get('error') }}</h5>
                                @endif

                            </div>


                                @php
                                    if(Session::has('coupon')){
                                        $coupon = session()->get('coupon')['name'];
                                    }
                                @endphp

                            
                            @if(Session::has('coupon'))
                                <!-- coupon -->
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <figure>
                                                <figcaption>
                                                    <h6 class="font-weight-normal border-bottom pb-2 mb-2 pt-2 px-2 rounded d-flex align-items-center">
                                                        
                                                    <span>@translate(Coupon Code Applied)</span> <span
                                                                class="text-success font-weight-bold ml-auto">{{ $coupon }}</span></h6>

                                                    <h6 class="font-weight-normal border-bottom pb-2 mb-2 pt-2 px-2 rounded d-flex align-items-center">
                                                    <span>@translate(Discounted Amount)</span>
                                                        <span class="text-success font-weight-bold ml-auto"> {{ couponDiscount($coupon) }} </span>
                                                    </h6>

                                                </figcaption>
                                                <form action="{{ route('checkout.coupon.destroy') }}" method="post">
                                                    @csrf
                                                    <div class="d-flex justify-content-between mt-4">
                                                    <div class="form-group mb-0">
                                                        <input type="hidden" class="form-control" name="coupon"
                                                            value="{{ $coupon }}">
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <button type="submit" class="btn btn-link btn-sm p-0">@translate(Try Another Coupon)
                                                        </button>
                                                    </div>
                                                    </div>
                                                </form>
                                            </figure>
                                        </div>
                                    </div>
                                <!-- coupon END -->
                            @endif

                            </div>


                        </div>
                        @endif
                    <div class="col-lg-12">
                            <div class="shopping-cart-detail-item border py-2 px-2">
                                <h5 class="widget-title">@translate(Cart Totals)</h5>
                                <div class="shopping-cart-content pt-2">
                                    <ul class="list-items pl-0">
                                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                            <span class="primary-color">@translate(Total):</span>
                                            
                                            <span class="primary-color-3"> {{formatPrice($total_price)}}</span>
                                            @if(Session::has('coupon'))
                                            {{--
                                            <span class="primary-color-3"> <del>{{formatPrice($total_price)}}</del> {{formatPrice($total_price - couponDiscountPrice($coupon))}}</span>
                                            --}}

                                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                                <span class="text-success">Discount</span>
                                                <span class="text-success">
                                                    {{formatPrice(couponDiscountPrice($coupon))}}
                                                </span>
                                            </li>
                                            
                                            @else
                                            {{--
                                                <span class="primary-color-3">{{formatPrice($total_price)}}</span>
                                                --}}

                                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                                    <span class="text-success">Discount</span>
                                                    <span class="text-success">-{{formatPrice('0')}}</span>
                                                </li>
                                            
                                            @endif

                                        </li>
                                        {{-- <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                            <span class="text-success">Discount</span>
                                            <span class="text-success">-₹10.00</span>
                                        </li> --}}
                                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                            <span class="text-info">Payable Amount</span>
                                            <span class="text-info">
                                            @if(Session::has('coupon'))
                                                {{formatPrice($total_price - couponDiscountPrice($coupon))}}
                                            @else
                                                {{formatPrice($total_price)}}
                                            @endif
                                            </span>
                                        </li>
                                    </ul>
                                    <?php //echo formatPrice($total_price);
                                            //echo couponDiscountPrice($coupon); 
                                        // echo $total_price = formatPrice($total_price); 
                                    ?>


                                    @if(onlyPrice($total_price) == 0 || (Session::has('coupon') && (StripePrice($total_price - couponDiscountPrice($coupon)) == 0)))
                                    <div class="btn-box mt-4">
                                        <a href="{{route('free.payment')}}" class="btn btn-info btn-block">@translate(Checkout)</a>
                                    </div>
                                    @else
                                    {{-- checkout --}}

                                    {{-- PAYUMONEY PAYMENT GATEWAY --}}
                                        <form action="{{route('initiate.payment')}}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
                                            <input type="hidden" id="hashurl" name="hashurl" value="{{url('resources/views/addon/setup/payumoney/index.php')}}" />
                                            <input type="hidden" id="surl" name="surl" value="{{route('payumoney.payment')}}" />
                                            <input type="hidden" id="key" name="key" value="SWX8LxLC" />{{-- CaertTiG,Uuio8LHKPl --}}
                                            <input type="hidden" id="salt" name="salt" value="cXhuLZsI4t" />
                                            <input type="hidden" id="txnid" name="txnid" value="{{ strtotime('now') }}" />
                                            @if(Session::has('coupon'))
                                                <input type="hidden" id="amount" name="amount" value="{{ StripePrice($total_price - couponDiscountPrice($coupon)) }}">
                                            @else
                                                <input type="hidden" id="amount" name="amount" value="{{ StripePrice($total_price) }}">
                                            @endif
                                            <input type="hidden" id="pinfo" name="pinfo" value="cart_payment" />
                                            <input type="hidden" id="fname" name="fname" value="{{ Auth::user()->name }}" />
                                            <input type="hidden" id="email" name="email" value="{{ Auth::user()->alternate_email_user }}" />
                                            <input type="hidden" id="mobile" name="mobile" value="{{ Auth::user()->email }}" />
                                            <input type="hidden" id="hash" name="hash" value="" />
                                            <div class="card">
                                                <input type="submit" class="btn btn-primary" value="Pay" />
                                            </div>
                                        </form>
                                    {{-- END PAYUMONEY PAYMENT GATEWAY --}}




                                    <div class="card-box-shared d-none">
                                        <div class="card-box-shared-title">
                                            <h3 class="widget-title">@translate(Select Payment Method)</h3>
                                        </div>
                                        <div class="card-box-shared-body p-0">

                                            {{-- Wallet --}}
                                            

                                        @if(env('WALLET_ACTIVE') == "YES")
                                        <div class="text-center mt-5">
                                            @if (payWithCoin())

                                                @if (checkWallerBalanceForPurchase(WalletPrice($total_price)))

                                                <form action="{{ route('wallet.payment') }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-success w-75 p-3">
                                                        <input type="hidden" name="amount" value="{{ WalletPrice($total_price) }}">
                                                        Pay with {{ walletName() }} ({{ WalletPrice($total_price) }})
                                                    </button>
                                                </form>
                                                    
                                                @else

                                                <p class="btn btn-success w-75 p-3">
                                                    @translate(Not enough) {{ walletName() }} ({{ walletBalance() }}) @translate(to purchase)
                                                </p>
                                                    
                                                @endif
                                                
                                            @else
                                                <p class="btn btn-success w-75 p-3">
                                                    @translate(Not enough) {{ walletName() }} ({{ walletBalance() }}) @translate(to purchase)
                                                </p>
                                            @endif
                                        </div>
                                        @endif
                                    
                                            
                                            <div class="payment-method-wrap">
                                                <div class="checkout-item-list">
                                                    

                                                    <div class="accordion" id="paymentMethodExample">

                                                        {{-- Stripe --}}

                                                        <div class="card">
                                                            <div class="card-header w-75" id="headingTwo">
                                                                <div
                                                                    class="checkout-item d-flex align-items-center justify-content-between">
                                                                    <label for="radio-8 stripe-label"
                                                                        class="radio-trigger collapsed mb-0 w-100"
                                                                        data-toggle="collapse" data-target="#collapseTwo"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseTwo">
                                                                        <span
                                                                            class="widget-title font-size-18 stripe-btn d-block text-center">
                                                                        <img src="{{ asset('frontend/images/stripe.png') }}"
                                                                            class="img-fluid" alt="">
                                                                        </span>
                                                                    </label>

                                                                </div>
                                                            </div>


                                                            <div id="collapseTwo" class="collapse"
                                                                aria-labelledby="headingTwo"
                                                                data-parent="#paymentMethodExample">
                                                                <div class="card-body mb-3">
                                                                    <div class="contact-form-action">


                                                                        <form role="form"
                                                                            action="{{ route('stripe.post') }}"
                                                                            method="post" class="require-validation"
                                                                            data-cc-on-file="false"
                                                                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                                            id="payment-form">
                                                                            @csrf

                                                                            <div class="input-box">
                                                                                <label class="label-text">@translate(Name on Card) <span
                                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                                <div class="form-group">
                                                                                    <span
                                                                                        class="la la-pencil input-icon"></span>
                                                                                    <input class="form-control"
                                                                                        placeholder="Card Name"
                                                                                        type="text" name="text"
                                                                                        required="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-box">
                                                                                <label class="label-text">@translate(Card Number)<span
                                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                                <div class="form-group">
                                                                                    <span
                                                                                        class="la la-pencil input-icon"></span>
                                                                                    <input class="form-control card-number"
                                                                                        name="text"
                                                                                        placeholder="1234  5678  9876  5432"
                                                                                        required="" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-box">
                                                                                <label class="label-text">@translate(Expiry Month)<span
                                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                                <div class="form-group">
                                                                                    <span
                                                                                        class="la la-pencil input-icon"></span>
                                                                                    <input
                                                                                        class="form-control card-expiry-month"
                                                                                        placeholder="MM" required=""
                                                                                        name="text" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-box">
                                                                                <label class="label-text">@translate(Expiry Year)<span
                                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                                <div class="form-group">
                                                                                    <span
                                                                                        class="la la-pencil input-icon"></span>
                                                                                    <input
                                                                                        class="form-control card-expiry-year"
                                                                                        placeholder="YY" required=""
                                                                                        name="text" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-box">
                                                                                <label class="label-text">@translate(CVC)<span
                                                                                        class="primary-color-2 ml-1">*</span></label>
                                                                                <div class="form-group">
                                                                                    <span
                                                                                        class="la la-pencil input-icon"></span>
                                                                                    <input class="form-control card-cvc"
                                                                                        placeholder="CVC" required=""
                                                                                        name="text" type="text">
                                                                                </div>
                                                                            </div>

                                                                            <div class="input-box">
                                                                                <input type="hidden" name="name"
                                                                                    value="{{ Auth::user()->name }}">

                                                                                @if(Session::has('coupon'))

                                                                                    <input type="hidden" id="amount"
                                                                                        name="amount"
                                                                                        value="{{ StripePrice($total_price - couponDiscountPrice($coupon)) }}">

                                                                                @else
                                                                                
                                                                                <input type="hidden" id="amount"
                                                                                    name="amount"
                                                                                    value="{{ StripePrice($total_price) }}">

                                                                                @endif

                                                                            </div>

                                                                            <button type="submit"
                                                                                    class="theme-btn d-block text-center m-auto">
                                                                                    @if(Session::has('coupon'))
                                                                                        @translate(Proceed)({{formatPrice($total_price - couponDiscountPrice($coupon))}})
                                                                                    @else
                                                                                        @translate(Proceed)({{formatPrice($total_price)}})
                                                                                    @endif
                                                                            </button>

                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {{-- Stripe::END --}}


                                                    <!-- end card -->
                                                    {{-- Paypal button --}}

                                                        <div class="card">
                                                            <div id="paypal-button"></div>
                                                        </div><!-- end card -->
                                                    {{-- Paypal button:END --}}

                                                {{-- PAYTM PAYMENT --}}

                                                @if(env('PAYTM_MERCHANT_ID') != "" &&  env('PAYTM_MERCHANT_KEY') != "" &&  env('PAYTM_ACTIVE') != "NO" && paytmRouteForBlade())
                                                    {{--PAYTM--}}

                                                    <form action="{{ route('paytm.payment') }}" method="POST" id="payTmForm">
                                                        @csrf
                                                        @if(Session::has('coupon'))
                                                            <input type="hidden" name="amount" value="{{ PaytmPrice($total_price - couponDiscountPrice($coupon)) }}">
                                                        @else
                                                            <input type="hidden" name="amount" value="{{ PaytmPrice($total_price) }}">
                                                        @endif
                                                    </form>

                                                    <a href="javascript:void()" title="Pay via PayTM" onclick="paytmPay()">
                                                        <div class="card border-bottom-0 paytm-top">
                                                            <div class="card-header">
                                                                <div class="checkout-item d-flex align-items-center justify-content-between">
                                                                    <span class="widget-title font-size-18 stripe-btn w-75 d-block text-center font-weight-bold m-auto">
                                                                            <img src="{{ filePath('paytm.png') }}" height="25px"
                                                                                width="80px" alt="Paytm">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    {{--PAYTM ends--}}
                                                @endif

                                                {{-- PAYTM PAYMENT::END --}}

                                                        <form id="paypal-form" method="post" action="{{route('paypal.paymnet')}}" class="invisible">
                                                            @csrf
                                                            <input type="hidden" name="orderID" id="orderID">
                                                            <input type="hidden" name="payerID" id="payerID">
                                                            <input type="hidden" name="paymentID" id="paymentID">
                                                            <input type="hidden" name="paymentToken" id="paymentToken">
                                                            @if(Session::has('coupon'))
                                                                <input type="hidden" value="{{PaypalPrice($total_price- couponDiscountPrice($coupon))}}" name="amount" id="paytmamount">
                                                            @else
                                                                <input type="hidden" value="{{PaypalPrice($total_price)}}" name="amount" id="paytmamount">
                                                            @endif
                                                        </form>
                                                    </div><!-- end accordion -->
                                                </div>
                                            </div><!-- end payment-method-wrap -->
                                        </div><!-- end card-box-shared-body -->



                                        <div class="m-5">

                                                <h5>We accept -</h5>

                                                @if (env('PAYPAL_CLIENT_ID') != NULL || env('PAYPAL_APP_SECRET') != NULL)
                                                    <img src="{{ filePath('paypal.png') }}" class="w-25 p-2" alt="#paypal">
                                                @endif

                                                @if (env('PAYTM_ACTIVE') != 'NO' || env('PAYTM_MERCHANT_ID') != NULL  || env('PAYTM_MERCHANT_KEY') != NULL)
                                                    <img src="{{ filePath('paytm.png') }}" alt="#paytm" class="w-25 p-2">
                                                @endif

                                                @if (env('STRIPE_KEY') != NULL || env('STRIPE_SECRET') != NULL)
                                                    <img src="{{ filePath('stripe.png') }}" alt="#stripe" class="w-25 p-2">
                                                @endif

                                        </div>

                                    </div>
                                    @endif
                                    {{-- checkout::END --}}


                                    {{-- stripe --}}

                                </div><!-- end shopping-cart-content -->
                            </div><!-- end shopping-cart-detail-item -->
                        </div><!-- end col-lg-4 -->
                    
                        
                    </div><!-- end row -->
                </div>
                    </div>
                </div>
                
                
            </div>
        @else
        <div class="container">
            <div class="row no-gutter">

                <div class="col-md-4">
                    <a href="{{url('/')}}"> <img src="{{asset('cart-empty.jpg')}}" class="w-100 img-fluid"></a>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-danger text-center rounded-0">
                     <h3>Sorry!</h3>
                     <p>Yo don't have any course or package in your cart, to continue browsing click on link given below.</p>
                     <p class="my-3">
                         <a href="{{route('course.category',['cbse'])}}" class="btn btn-primary">Browse More...</a>
                     </p>
                    </div>
                </div>                
            </div>
            </div>
        @endif
    </section>

    <!-- Payment Section Starts -->
    <section class="Payment-section padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="coupon-part d-none">
                        <h3>coupon code</h3>
                        <p class="margin-top-20">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum
                            corporis dolor aperiam aut molestias eveniet sequi.</p>
                        <div class="coupon-code margin-top-30">
                            <div class="header-search">
                                <form action="#">
                                    <input type="text" placeholder="Enter Coupon Code">
                                    <button type="submit"><i class="fa fa-plus"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </section>

    
    @endsection
@section('js')

    {{-- PAYUMONEY STARTS --}}
    
    <!-- BOLT Sandbox/Test -->
  <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
    color="e34524" bolt-logo="https://ole.org.in/public/uploads/site/wDJtujetIoeun969DW0jhsyw07HHJE8ijsSH0nwk.png"></script>

                                    
    
    <!-- BOLT Production/Live -->
       <!-- <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" 
     bolt-logo="https://ole.org.in/public/uploads/site/wDJtujetIoeun969DW0jhsyw07HHJE8ijsSH0nwk.png"></script>  -->

     
                            
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                url: $('#hashurl').val(),
                type: 'post',
                data: JSON.stringify({ 
                    key: $('#key').val(),
                    salt: $('#salt').val(),
                    txnid: $('#txnid').val(),
                    amount: $('#paytmamount').val(),
                    pinfo: $('#pinfo').val(),
                    fname: $('#fname').val(),
                    email: $('#email').val(),
                    mobile: $('#mobile').val(),
                    udf5: $('#udf5').val()
                }),
                contentType: "application/json",
                dataType: 'json',
                success: function(json) {
                    if (json['error']) {
                        $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
                    }
                    else if (json['success']) {	
                        $('#hash').val(json['success']);
                    }
                }
            }); 
        });
    </script>
    <script type="text/javascript">
        function launchBOLT()
        {

          
            bolt.launch({
                key: $('#key').val(),
                txnid: $('#txnid').val(), 
                hash: $('#hash').val(),
                amount: $('#amount').val(),
                firstname: $('#fname').val(),
                email: $('#email').val(),
                phone: $('#mobile').val(),
                productinfo: $('#pinfo').val(),
                udf5: $('#udf5').val(),
                surl : $('#surl').val(),
                furl: $('#surl').val(),
                mode: 'dropout'	
            },
            { 
                responseHandler: function(BOLT){
                   // alert(BOLT.response.txnStatus);	
                    if(BOLT.response.txnStatus != 'CANCEL')
                    {
                       // alert("hhhhh");
                        //Salt is passd here for demo purpose only. For practical use keep salt at server side only.
                        var fr = '<input type=\"hidden\" name=\"_token\" value=\"'+csrf_token+'\" />'+
                        '<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
                        '<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
                        '<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
                        '<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
                        '<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
                        '<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
                        '<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
                        '<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
                        '<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
                        '<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
                        '<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
                        '</form>';
                        var form = jQuery(fr);
                        jQuery('body').append(form);								
                        form.submit();
                    }
                },
                catchException: function(BOLT){
                    alert( BOLT.message );
                }
            });
        }
    </script>

    {{-- PAYUMONEY ENDS --}}


    {{-- stripe --}}
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        "use strict"
        $(function () {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function (e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });


    </script>


    <script src="https://www.paypalobjects.com/api/checkout.js"></script>  
    <script>
        "use strict"
        paypal.Button.render({
            // Configure environment
            env: '{{ env('PAYPAL_ENVIRONMENT') }}',
            client:{
                production: '{{ env('PAYPAL_CLIENT_ID') }}'
            },
        //Todo::must be  env data in client
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'responsive',
                color: 'gold',
                shape: 'pill',
                label: 'checkout',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function (data, actions) {
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            
                            @if(Session::has('coupon'))
                            total: '{{ $total_price  - couponDiscountPrice($coupon) }}',
                            @else
                            total: '{{ $total_price }}',
                            @endif
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function (data, actions) {
                return actions.payment.execute().then(function () {
                    // Show a confirmation message to the buyer
                    /*append data in input form*/
                    $('#orderID').val(data.orderID);
                    $('#payerID').val(data.payerID);
                    $('#paymentID').val(data.paymentID)
                    $('#paymentToken').val(data.paymentToken)
                    $('#paypal-form').submit();
                });
            }
        }, '#paypal-button');

    </script>

    {{-- PAYTM START --}}

		@if(env('PAYTM_MERCHANT_ID') != "" &&  env('PAYTM_MERCHANT_KEY') != "" &&  env('PAYTM_ACTIVE') != "NO" && paytmRouteForBlade())

		<script>
			function paytmPay(){
				$('#payTmForm').submit();
			}
		</script>

		@endif

    {{-- PAYTM END --}}
@endsection
