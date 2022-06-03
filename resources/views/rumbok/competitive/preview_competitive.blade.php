@extends('rumbok.app')

@section('content')
    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
                 class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a>/{{$getData->pkg_name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Details Section Starts -->
        <section class="course-details-section padding-120">
            <div class="container">
                <div class="row">
                   

                        <div class="col-lg-8">
                           
                            <!--<div class="course-details-title">
                                <h2 class="pacakage-name mb-2"></h2>
                            </div> -->
                            <div class="course-details-tab">
                                
                                <div class="margin-top-30">
                                    <div class="clearfix package-box">
                                        <div class="row">
                                            <div class="col-lg-3">
                                            <div class="package-thumbnail">
                                             <img src="{{ filePath($getData->pkg_image) }}" alt="{{ $getData->pkg_name }}">
                                            </div>
                                            </div>
                                            <div class="col-lg-9">
                                               <div class="package-content">
                                                   <h3 class="pacakage-name mb-2">{{$getData->pkg_name}}</h3>
                                                   <p class="package-discription text-justify">{{strip_tags(html_entity_decode($getData->pkg_desc))}}.</p>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>

                            
                            <div class="course-details-tab">
                                
                                <div class="margin-top-30">
                                    <div class="clearfix package-box">
                                        <div class="row">
                                            
                                            <div class="col-lg-12">
                                               <div class="package-content">
                                                   <h3 class="pacakage-name mb-2"><h2 class="pacakage-name mb-2 text-center">Choose Contents</h2></h3>
                                                   <p class="package-discription text-justify">{{strip_tags(html_entity_decode($getData->pkg_desc))}}.</p>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-4">
                            <div class="course-details-sidebar border">
                                <div class="course-details-widget">
                                    <div class="course-widget-title">
                                        <h6 class="border-bottom pb-2">Buy Now</h6>
                                    
                                    </div>
                                    <div class="course-widget-items">
                                        
                                        <div class="single-item">
                                            <div class="item-left">
                                                <span class="font-weight-bold"> @translate(Packages)</span>
                                            </div>
                                            
                                            <div class="item-right">
                                                <span class="font-weight-bold">Price</span>
                                            </div>
                                        </div>
                                        <div class="single-item">
                                            <div class="item-left">
                                                <span class="small"><input type="radio" name="Price" id="qtrPrice" value="{{$getData->quarterly_coverage_price}}">&nbsp;&nbsp;Quarterly(3 Months)</span>
                                            </div>
                                            <div class="item-right">
                                                <span class="small"><i class="fa fa-inr"></i> {{$getData->quarterly_coverage_price}}</span>
                                            </div>
                                        </div>
                                        <div class="single-item">
                                            <div class="item-left">
                                                <span class="small"><input type="radio" name="Price" id="hlfPrice" value="{{$getData->halfyrly_coverage_price}}">&nbsp;&nbsp;Halferly(6 Months)</span>
                                            </div>
                                            <div class="item-right">
                                                <span class="small"><i class="fa fa-inr"></i> {{$getData->halfyrly_coverage_price}}</span>
                                            </div>
                                        </div>
                                        <div class="single-item">
                                            <div class="item-left">
                                                <span class="small"><input type="radio" name="Price" id="yrlPrice" value="{{$getData->annually_coverage_price}}">&nbsp;&nbsp;Yearly(1 Year)</span>
                                            </div>
                                            <div class="item-right">
                                                <span class="small"><i class="fa fa-inr"></i> {{$getData->annually_coverage_price}}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="single-item">
                                            <div class="item-left">
                                                <span class="font-weight-bold"> @translate(Services)</span>
                                            </div>
                                            <div class="item-right">
                                                <span class="font-weight-bold">Price</span>
                                            </div>
                                        </div>  
                                        @foreach($getAddon as $val)
                                            <div class="single-item">
                                                <div class="item-left">
                                                    <span class="small"><input type="checkbox" name="addOnPrice[]" id="addOnPrice" value="{{$val->price}}" class="addonC">&nbsp;&nbsp;{{$val->service_name}}</span>
                                                </div>
                                                <div class="item-right">
                                                    <span class="small"><i class="fa fa-inr"></i> {{$val->price}}</span>
                                                </div>                                               
                                            </div>  
                                        @endforeach

                                       

                                        <div class="single-item">
                                            <div class="item-left">
                                                <span class="font-weight-bold">Apply For:</span>
                                            </div>
                                            
                                            <div class="item-right">
                                                <span class="font-weight-bold">Price</span>
                                            </div>
                                        </div>  
                                        <div class="single-item">
                                            <div class="item-left">
                                            <span class="small"><input type="hidden" name="default_discount" id="default_discount" value="{{$getData->default_discount}}">Discount ({{$getData->default_discount}})</span>
                                            </div>
                                            
                                            <div class="item-right">
                                            <span id="discountP" class="small"><i class="fa fa-inr"></i> 0.00</span>
                                            </div>
                                        </div>  
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
                                                <span class="font-weight-bold text-success">Total:</span>
                                            </div>
                                            
                                            <div class="item-right">
                                            <span id="totalPrice" class="font-weight-bold text-success"><i class="fa fa-inr"></i> 0.00</span>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="course-widget-buttons">

                                        @auth()
                                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                                <a href="#!"
                                                class="template-button addToCart-{{$getData->id}}"
                                                onclick="addToCart({{$getData->id}},'{{route('add.to.cart')}}')">@translate(Add to cart)</a>
                                            @else
                                                <a href="{{route('login')}}" class="template-button">@translate(Add to cart)</a>
                                            @endif
                                        @endauth
                                        @guest
                                            <a href="{{route('login')}}" class="template-button">@translate(Add to cart)</a>

                                        @endguest
                                    </div> 
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </section>



    </div>



@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript">
    $(document).ready(function () {
        $(this).on('click', function () {
            var value = $("[name=Price]:checked").val();

            //var default_discount  = 0.00;
            var default_discount = $('#default_discount').val();

            

            var addOnPrice = 0.00;
            $('.addonC:checked').each(function() {
                addOnPrice +=parseFloat($(this).val());
            });
            
            var subTotal = parseFloat(value) + parseFloat(addOnPrice);
            
            var discount = parseFloat(subTotal) * default_discount / 100;  
                
            var totalPrice = parseFloat(subTotal) - parseFloat(discount);

            $('#totalPrice').html(totalPrice.toFixed(2));
            $('#discountP').html(discount.toFixed(2));
            
        }); 
        
    });

</script>