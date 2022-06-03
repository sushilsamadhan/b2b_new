@extends('layouts.master')
@section('title','Coupon Usages Summary')
@section('parentPageTitle', 'All Coupon Usage')
@section('content')
    <div class="card mx-2 mb-3">
    <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                <h3>@translate(User Details)</h3>
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
                                    value="{{Request::get('start_date')}}">
                            <input type="date" name="end_date" class="form-control col-12"
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
                    <th>ID</th>
                    <th>@translate(Student Name)</th>
                    <th>@translate(Transaction Id)</th>
                    <th>@translate(Transaction Amount)</th>
                    <th>@translate(Transaction Date)</th>
                    <th>@translate(Cart Item)</th>
                </tr>
                </thead>
                <tbody>

                @if(count($order_details)>0)
                @foreach($order_details as $order_detail)
                    @php
                        $courses_ids = getEnrollCoures($order_detail->user_id);
                        $username = getUsername($order_detail->user_id);
                        $trans_details = userTransDetails($order_detail->user_id,$order_detail->coupon_code);
                    @endphp
                    <tr>
                        <td>
                            {{ ($loop->index+1) +($order_details->currentPage() - 1)*$order_details->perPage() }}
                        </td>
               			<td>{{ $order_detail->user_id }}</td>
                        <td>{{ $username }}</td>
                        <td>{{$trans_details->transaction_id ?? 'N/A'}}</td>
                        <td>{{$trans_details->transaction_amount ?? 'N/A'}}</td>
                        <td>{{$trans_details->transaction_date ?? 'N/A'}}</td>
                        <td>
                        <a href="#!" class="btn btn-primary mb-2"
                            onclick="forModal('{{ route("coupon_detail.getcourse",[$order_detail->user_id,$order_detail->coupon_code]) }}', '@translate(Cart Items)')"> 
                            @translate(View Items)
                        </a>
                        </td>
               		</tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="7">No Data Available</td>
                    </tr>   
                @endif 
                </tbody>
                <div class="float-left">
                    {{ $order_details->links() }}
                </div>
            </table>
        </div>

        <!-- Modal -->
        <!-- <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Course Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div> -->
    </div>

@endsection
