@extends('layouts.master')

@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Order Details</h3>
            </div>
            <div class="float-right">
                <div class="row">
                <div class="col">
                        <form method="get" action="" autocomplete="off">
                            <div class="input-group">
                                <input type="text" name="name" class="form-control col-12"
                                       placeholder="@translate(Search by name)" value="{{Request::get('name')}}">
                                       <input type="text" name="trans_id" class="form-control col-12"
                                       placeholder="@translate(Search by transaction id)" value="{{Request::get('trans_id')}}">
                                       <!-- <input type="date" name="trans_date" class="form-control col-12"
                                       placeholder="@translate(Search by transaction date)" value="{{Request::get('trans_date')}}"> -->
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Transaction Id</th>
                    <th>Transaction Amount</th>
                    <th>Transaction Date</th>
                    <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderDetails as $item)                                
                        <tr>
                            <td>{{ ($loop->index+1) + ($orderDetails->currentPage() - 1)*$orderDetails->perPage() }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{$item->transaction_id}}</td>
                            <td>{{$item->transaction_amount}}</td>
                            <td>{{date('Y-m-d', strtotime($item->transaction_date))}}</td>
                            <td>
                                <div class="kanban-menu">
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                        <div class="dropdown-menu dropdown-menu-right action-btn"
                                                aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                            <a class="dropdown-item" href="{{ route('orders.detail',$item->id) }}">
                                                <i class="feather icon-edit-2 mr-2"></i>@translate(Details)</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach       
                <tbody>
                <div class="float-left">
                    {{ $orderDetails->links() }}
                </div>
            </table>
        </div>
    </div>
@endsection
