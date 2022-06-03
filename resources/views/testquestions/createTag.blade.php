
@extends('layouts.master')
@section('title','Categories')
@section('parentPageTitle', 'All Category')
@section('content')

<div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(Create Question Tag)</h3>
            </div>            
        </div>
        <div class="card-body">
            <form action="{{route('questiontag.storeQuestion')}}" method="post" enctype="multipart/form-data">
                @csrf                
                <div class="form-group">
                    <label>@translate(Question Category)</label>
                    <select onchange="forGetsubjectcate(this.value);" class="form-control select2 w-100" name="ques_cat_id" required>
                        <option value="">@translate(Select Category)</option>
                        @foreach($categories as $item)                        
                        <option value="{{$item->id}}">{{$item->category_type}}</option>    
                        @endforeach                     
                    </select>
                </div>            
                <div class="form-group">
                    <label>@translate(Question Tag) <span class="text-danger">*</span></label>
                    <input class="form-control" name="tag_name" placeholder="@translate(Tag Name)" required>
                </div>
                <div class="form-group">
                    <label>@translate(Question Tag Category)</label>
                    <select class="form-control select2 w-100" name="parent_tag_id" id="hgfvhgghvuyhgbjhbjh">                        
                        
                        @foreach($quescat as $ques)                         
                        <option value="{{$ques->id}}">{{$ques->tag_name}}</option>                         
                        @endforeach
                        <option value="">@translate(Select Subject Category )</option>
                                
                    </select>
                </div>                       
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">@translate(Save)</button>
                </div>

            </form>
        </div>
</div>

<script>
    function forGetsubjectcate(id){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("hgfvhgghvuyhgbjhbjh").innerHTML =
            this.responseText;
        }
        xhttp.open("GET", "{{url('dashboard/forGetsubjectcate')}}?id="+id);
        xhttp.send();
    }
</script>
@endsection

