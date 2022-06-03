@extends('layouts.master')
@include('layouts.include.form.form_js')

@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Create Project Work Category</h3>
            </div>
            
        </div>

        <div class="card-body">
            <form action="{{ route('projectworkcat.store') }}" method="POST">
                @csrf
                <div class="container">   
                        <div class="row">
                                <div class="form-group col-md-3 p-3">
                                    <label class="" for="test">
                                        @translate(Parent Category)</label>
                                    <div class="">
                                        <select class="form-control langr selectpicker" id="parent_category_id" name="parent_category_id">
                                            <option value="0">Parent Category</option>
                                            @if($parentCategory->count()>0)
                                                @foreach($parentCategory as $val)
                                                    <option value="{{$val->id}}" {{$val->category_name=='School Level'?'disabled':''}}> {{$val->category_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 p-3">
                                    <label class="" for="test_type">
                                        @translate(Sub Category) <span class="text-danger">*</span></label>
                                    <div class="">
                                    <input type="text"  required autocomplete="off" class="form-control langr" placeholder="@translate(Enter Category Name)"  id="category_name" name="category_name" value="{{old('category_name')}}">
                                    </div>
                                </div>

                                <div class="form-group col-md-3 p-3">
                                    <label class="" for="test">
                                        @translate(Status) <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="form-control langr selectpicker" id="status" name="status" required>
                                            <option value="1">Active</option>
                                            <option value="0">In-Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 text-center">  
                                    <div class="form-group">
                                        <label class="col-md-2 col-form-label" for="example"></label>
                                        <div class="col-md-1">
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

