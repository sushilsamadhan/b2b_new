@extends('layouts.master')
@section('title','Coupon Usages Summary')
@section('parentPageTitle', 'All Coupon Usage')
@section('content')
    <div class="card mx-2 mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                <h3>@translate(Coupon Application Summary)</h3>
                </div>
            </div>
        </div>
        <div class="card-header">    
            <div class="row">
                <div class="col-lg-6"><b>Duration : </b> {{$dateFrom}} <b>To : </b> {{$dateTo}}</div>
                <div class="col-lg-6">
                    <form method="get" action="">
                        <div class="input-group">
                            <input type="date" name="start_date" class="form-control col-12"
                                    placeholder="@translate(Search by name or email)"
                                    value="{{Request::get('start_date')}}">
                            <input type="date" name="end_date" class="form-control col-12"
                                    placeholder="@translate(Search by name or email)"
                                    value="{{Request::get('end_date')}}">

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">@translate(Search)</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>S/L</th>
                    <th>@translate(Coupon Code)</th>
                    <th>@translate(Usage)</th>
                    <th>@translate(Discount)</th>
                    <th>@translate(Total Cart Value)</th>
                    <th>@translate(Total Discount)</th>
                </tr>
                </thead>
                <tbody>
                @if(count($coupon_order_details)>0)
                @foreach($coupon_order_details as $coupon_order)
               		<tr>
               			<td>{{ ($loop->index+1) +($coupon_order_details->currentPage() - 1)*$coupon_order_details->perPage() }}</td>
               			<td>{{ $coupon_order->code}}</td>
                        
                        @if(Auth::user()->user_type == "Instructor" && Auth::user()->is_external == '3') 
                        <td> {{ $coupon_order->total_count }}</td>
                        @else
                        <td><a href="{{ route('coupon_detail.index',[$coupon_order->code, 'start_date'=>Request::get('start_date'), 'end_date'=>Request::get('end_date')]) }}" data-toggle="tooltip" data-placement="top" title="Users Course Detail">{{ $coupon_order->total_count }}</a></td>
                        @endif
                        
                        @php
                         $rate = '';
                        if($coupon_order->discount_type == 'F'){
                            $rate =  'Rs. '.$coupon_order->rate.".00";
                        }
                        if($coupon_order->discount_type == 'P'){
                            $rate = $coupon_order->rate.' % ';
                        }
                        @endphp
                        <td>{{  $rate }}</td>
                        <td>{{ $coupon_order->total_order }}</td>
                        <td>{{ $coupon_order->total_discount }}</td>
               		</tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="6"><b>No Data Available</b></td>
                    </tr>   
                @endif 
                </tbody>
                <div class="float-left">
                    {{ $coupon_order_details->links() }}
                </div>
            </table>
        </div>
    </div>

@endsection
