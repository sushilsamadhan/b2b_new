@extends('layouts.master')
@section('title','Revenue For Academic')
@section('parentPageTitle', 'Revenue')
@section('content')
    <div class="card mx-2 mb-3">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(Revenue For Academic)</h3>
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
                    <th>@translate(Total Revenue)</th>
                    <th>{{$total ? $total : 0}}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
