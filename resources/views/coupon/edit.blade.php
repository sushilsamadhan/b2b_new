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
                           <form method="post" action="{{route('coupon.update', $single_coupon->id)}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>@translate(Coupon Code)</label>
            <input type="text" name="code" value="{{ $single_coupon->code }}" class="form-control"
                   placeholder="@translate(Coupon Code)" required>
        </div>

        <div class="form-group">
            <label>@translate(Discount Type)</label>
            <select name="discount_type" class="form-control" placeholder="@translate(Discount Type)">
                <option value="F" {{ ($single_coupon->discount_type=='F')?'selected':'' }}>Flat</option>
                <option value="P" {{ ($single_coupon->discount_type=='P')?'selected':'' }}>Percentage</option>
            </select>
        </div>

        <div class="form-group">
            <label>@translate(Discount)</label>
            <input type="number" name="rate" value="{{ $single_coupon->rate }}" min="0" step="0.01" class="form-control"
                   placeholder="@translate(Discount Amount)" required>
        </div>
        <div class="form-group">
            <label>@translate(Limit Per User)</label>
            <select class="form-control" name="limit_per_user" required>
                <option {{ ($single_coupon->limit_per_user=='1')?'selected':'' }}>1</option>
                <option {{ ($single_coupon->limit_per_user=='2')?'selected':'' }}>2</option>
                <option {{ ($single_coupon->limit_per_user=='3')?'selected':'' }}>3</option>
                <option {{ ($single_coupon->limit_per_user=='4')?'selected':'' }}>4</option>
                <option {{ ($single_coupon->limit_per_user=='5')?'selected':'' }}>5</option>
            </select>
        </div>
        <div class="form-group">
            <label>@translate(Starting Date)</label>
            <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                <input type="text" name="start_day" value="{{ $single_coupon->start_day }}"
                       class="form-control datetimepicker-input" data-target="#datetimepicker3"
                       placeholder="@translate(Starting Date)" required/>
                <div class="input-group-append form-group" data-target="#datetimepicker3" data-toggle="datetimepicker">
                    <div class="input-group-text form-group p-10"></div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label>@translate(Ending Date)</label>
            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                <input type="text" name="end_day" value="{{ $single_coupon->end_day }}"
                       class="form-control datetimepicker-input" data-target="#datetimepicker4"
                       placeholder="@translate(Ending Date)" required/>
                <div class="input-group-append form-group" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text form-group p-10"></div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label>@translate(Minimum Shopping Amount)</label>
            <input type="number" name="min_value" value="{{ $single_coupon->min_value }}" class="form-control" min="0"
                   placeholder="@translate(Minimum Shopping Amount)" required>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Terms And Conditions</label>
                    <textarea required="required" class="form-control summernote" name="short_description_for_term" rows="5" aria-required="true">{{ $single_coupon->short_description_for_term }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <input type="checkbox" name="is_published"
                   id="published" {{ $single_coupon->is_published == 1 ? 'checked' : '' }}>
            <label for="published">@translate(Is published?)</label>
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





