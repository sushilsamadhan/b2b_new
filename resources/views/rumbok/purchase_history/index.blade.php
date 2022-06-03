@extends('rumbok.app')
@section('content')
  <!-- ================================
      START DASHBOARD AREA
  ================================= -->
  <section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="title-page">
                <h1>Transaction History</h1>
              </div>              
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                      <a href="https://ole.org.in">Home</a>
                      </li>
                      <li>
                        <span>Transaction History</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
  <section class="dashboard-area">
     {{--@include('rumbok.dashboard.sidebar')--}} 
      <div class="course-page-content padding-120">
             <div class="container">
                 <div class="row">
                 @if (count($orderedData) > 0)     
                    @foreach($orderedData as $order)
                     <div class="col-md-6">
                         <div class="card mb-3">
                                <div class="alert alert-warning text-center mb-0 rounded-0 px-1 py-1">
                                        <div class="text-dark font-weight-normal small">Placed On : {{date("d M Y",strtotime($order->created_at))}}</div>
                                </div>
                                    <div class="card-body bg-light border-bottom">
                                        <div class="d-flex justify-content align-items-center text-dark font-weight-bold">
                                            <div class="itmes">{{$order->orderedCourses->count()}} Items</div>
                                            <div class="amount ml-auto"><i class="fa fa-inr"></i> {{$order->transaction_amount?number_format($order->transaction_amount,2):'0.00'}}</div>
                                        </div>
                                        <div class="order-id font-weight-normal small text-muted">{{$order->transaction_id?$order->transaction_id:''}}</div>
                                        <div class="d-flex justify-content-between">
                                        <div class="order-status">
                                            <div class="text-muted small">Order Amt.</div>
                                            <div class="">
                                                <span class="rounded text-danger small">Rs. {{$order->order_total?number_format($order->order_total,2):'0.00'}}</span>
                                            </div>
                                        </div>
                                        <div class="order-through">
                                        <div class="text-muted small">Discount</div>
                                            <div class="">
                                                <span class="rounded text-success small">Rs. {{$order->discount_amount?$order->discount_amount:'0.00'}}</span>
                                            </div>
                                        </div>
                                        <div class="order-through">
                                        <div class="text-muted small">Coupon</div>
                                            <div class="">
                                                <span class="text-info small">{{$order->coupon_code?$order->coupon_code:'N/A'}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="order-status">
                                            <div class="text-muted small">Order Status</div>
                                            <div class="">
                                                <span class="border border-success rounded text-success py-1 px-3 small">{{$order->transaction_status}}</span>
                                            </div>
                                        </div>
                                        <div class="order-through">
                                        <div class="text-muted small">Via {{$order->transaction_mode}}</div>
                                        <div class="">
                                                <span class="border border-info rounded text-info py-1 px-3 small">{{$order->transaction_id}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                         </div>
                     </div>
                    @endforeach
                @else
                    <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-3"><a href="{{url('/')}}"> <img src="{{asset('no-history-found.gif')}}" class="w-100 img-fluid"></a></div>
                    </div>
                </div>
                @endif    
                 </div>
              </div><!-- end container-fluid -->
         </div><!-- end dashboard-content-wrap -->

  </section><!-- end dashboard-area -->
  <!-- ================================
      END DASHBOARD AREA
  ================================= -->
@endsection
