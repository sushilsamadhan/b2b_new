@extends('layouts.master')
@include('layouts.include.form.form_css')
@section('content')

<div class="card m-2">
    <div class="card-header">
        <div class="float-left">
            <h3>Update Category</h3>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('projectworkcat.update',$projectworkcat->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$projectworkcat->id}}">
            <div class="container">   
                <div class="row">
                    <div class="accordion" style="width:100% !important;">
                        <div class="card">
                            <div class="card-body">
                                <div class="container">                    
                                    <div class="form-group col-md-4">
                                        <label class="" for="test">
                                            @translate(Parent Category Name) <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input type="text" readonly class="form-control langr" id="parent_category_id" name="parent_category_id" value="{{$parentCategory->category_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="" for="test_type">
                                            @translate(Sub Category Name) <span class="text-danger">*</span></label>
                                        <div class="">
                                        <input type="text"  class="form-control langr" placeholder="@translate(Enter Category Name)"  id="category_name" name="category_name" value="{{$projectworkcat->category_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="" for="test">
                                            @translate(Status) <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control langr selectpicker" id="status" name="status">
                                                <option value="1" {{ ($projectworkcat->status == '1')?'selected':'' }}>Active</option>
                                                <option value="0" {{ ($projectworkcat->status == '0')?'selected':'' }}>In-Active</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="example"></label>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn waves-effect waves-light btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>        
    </div>
</div>
@endsection



