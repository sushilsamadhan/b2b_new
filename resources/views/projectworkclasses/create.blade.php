@extends('layouts.master')
@include('layouts.include.form.form_js')

@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Create Project Work Class</h3>
            </div>
            
        </div>

        <div class="card-body">
            <form action="{{ route('projectworkclasses.store') }}" method="POST">
                @csrf
                 
                <div class="container">   
                        <div class="row">
                                <div class="form-group col-md-3 p-3">
                                    <label class="" for="test_type">
                                        @translate(Class Name) <span class="text-danger">*</span></label>
                                    <div class="">
                                    <input type="text"  class="form-control langr" autocomplete="off" placeholder="@translate(Enter Class Name)"  id="class_title" name="class_title" value="{{old('class_title')}}">
                                    </div>
                                </div>

                                <div class="form-group col-md-3 p-3">
                                    <label class="" for="test">
                                        @translate(Status) <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="form-control langr selectpicker" id="status" name="status">
                                            <option value=""> @translate(Please Select Status)</option>
                                            <option value="1" {{ (old('status') == '1')?'selected':'' }}>Active</option>
                                            <option value="0" {{ (old('status') == '0')?'selected':'' }}>In-Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 text-center">  
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="example"></label>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

                

                    @endsection

@section('scripts')

@endsection

