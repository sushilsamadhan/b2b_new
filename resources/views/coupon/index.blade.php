@extends('layouts.master')
@section('title','Instructor Account Setup')
@section('parentPageTitle', 'All')

@section('css-link')

<link type="text/javascript" src="{{ asset('assets/plugins/datepicker/datepicker.css') }}"/>

@stop

@section('page-style')

@stop
@section('content')



<div class="card">

    <div class="card-header">
        <span class="h1 card-title">@translate(Coupon Manager)</span>

        <a class="btn btn-primary ml-3" href="{{ route("coupon.all") }}" title="@translate(Coupon Lists)">
            <i class="fa fa-align-left"></i> @translate(Coupon Lists)
        </a>

    </div>

        <!-- /.card-header -->
        <div class="card-body p-2 mt-2">
            <!-- Content starts here -->
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card-body">
                        <form method="post" action="{{route('coupon.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@translate(Coupon Code)</label>
                                <input type="text" name="code" value="{{ old('code') }}" class="form-control"
                                    placeholder="@translate(Coupon Code)" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@translate(Discount Type)</label>
                                <select name="discount_type" class="form-control" placeholder="@translate(Discount Type)">
                                    <option value="F">Flat</option>
                                    <option value="P">Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@translate(Discount)</label>
                                <input type="number" name="rate" value="{{ old('rate') }}" min="0" step="0.01"
                                       class="form-control" placeholder="@translate(Insert Discount Amount)" required>
                            </div>
                        </div> 
                        <!-- value="{{ old('limit_per_user') }}" -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@translate(Limit Per User)</label>
                                <select class="form-control" name="limit_per_user" required>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@translate(Starting Date)</label>
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest" style=" display: block; ">
                                    <input type="datetime-local" name="start_day" value="{{ old('start_day') }}"
                                           class="form-control datetimepicker-input" data-target="#datetimepicker1"
                                           placeholder="@translate(Starting Date)" required/>
                                    <div class="input-group-append form-group" data-target="#datetimepicker1"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text form-group p-10">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@translate(Ending Date)</label>
                                <div class="input-group date" id="datetimepicker2" data-target-input="nearest" style=" display: block; ">
                                    <input type="datetime-local" name="end_day" value="{{ old('end_day') }}"
                                           class="form-control datetimepicker-input" data-target="#datetimepicker2"
                                           placeholder="@translate(Ending Date)" required/>
                                    <div class="input-group-append form-group" data-target="#datetimepicker2"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text form-group p-10">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@translate(Minimum Shopping Amount)</label>
                                <input type="number" name="min_value" value="{{ old('min_value') }}"
                                       class="form-control" min="0" placeholder="@translate(Minimum Shopping Amount)"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Terms And Conditions</label>
                                    <textarea required="required" class="form-control summernote" name="short_description_for_term" rows="5" aria-required="true"></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="checkbox" name="is_published" id="published">
                                <label for="published">@translate(Is published?)</label>
                            </div>
                        </div>
                        
                         </div>

                            <button type="submit" class="btn btn-primary">@translate(Submit)</button>
                       
                        </form>
                    </div>
                </div>

            </div>

            <!-- Content starts here:END -->


        </div>

    </div>

@endsection



@section('js-link')
<script src="{{ asset('assets/plugins/datepicker/datepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/datepicker/i18n/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-form-datepicker.js') }}"></script>
@stop

@section('page-script')


@stop





