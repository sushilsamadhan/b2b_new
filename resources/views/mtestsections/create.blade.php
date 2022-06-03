@extends('layouts.master')
@include('layouts.include.form.form_css')
@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Create Mock Test Section</h3>
            </div>
            
        </div>

        <div class="card-body">
        <form action="{{ route('mtestsections.store') }}" method="POST">
            @csrf
             <div class="container">                    
                <div class="row">
                    <div class="form-group col-md-8 p-3">
                        <label class="" for="mock_test_master_id">
                        @translate(Test name) <span class="text-danger">*</span></label>
                        <div class="">
                            <select class="form-control langr selectpicker" id="mock_test_master_id" name="mock_test_master_id">
                                    <option value=""> @translate(Please Select Test)</option>
                                @foreach ($mocktestmaster as $testmaster)
                                    <option value="{{$testmaster->id}}" {{(old('mock_test_master_id') == $testmaster->id)?'selected':'' }}  class="mb-2">{{$testmaster->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-8 p-3">
                        <label class="" for="section_name">@translate(Sectin Name) <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text"  class="form-control langr" placeholder="@translate(Enter Section Name)"  id="section_name" name="section_name" value="{{old('section_name')}}">
                        </div>
                    </div>
                    <div class="form-group col-md-8 p-3">
                        <label class="" for="no_of_question">@translate(Number of Question) <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="number"  class="form-control langr" placeholder="@translate(Enter Number of Question)"  id="no_of_question" name="no_of_question" value="{{old('no_of_question')}}">
                        </div>
                    </div>
                    <div class="form-group col-md-8 p-3">
                        <label class="" for="section_time">@translate(Time) <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="time"  class="form-control langr" placeholder="@translate(Enter Section Time)"  id="section_time" name="section_time" value="{{old('section_time')}}">
                        </div>
                    </div>

                    <div class="form-group col-md-8 p-3">
                        <label class="" for="question_value">@translate(Question Value) <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="number"  class="form-control langr" placeholder="@translate(Enter Section Value)"  id="question_value" name="question_value" value="{{old('question_value')}}">
                        </div>
                    </div>

                    <div class="form-group col-md-8 p-3">
                        <label class="" for="status">@translate(Status) <span class="text-danger">*</span></label>
                        <div class="">
                            <select class="form-control langr selectpicker" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{ (old('status') == '1')?'selected':'' }}>Active</option>
                                <option value="0" {{ (old('status') == '0')?'selected':'' }}>In-Active</option>
                            </select>
                        </div>
                    </div>
                </div>  
            </div>       
        <div class="container">   
                <div class="row">
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


