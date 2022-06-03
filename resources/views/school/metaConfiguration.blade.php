@extends('layouts.master')
@section('title','Add School')
@section('parentPageTitle', 'School')
@section('content')
<style>
    .radio-toolbar input[type="radio"] {
      display: none;
    }
    .radio-toolbar label {
    display: inline-block;
        background-color: gray;
        padding: 10px 10px;
        font-family: Arial;
        font-size: 16px;
        cursor: pointer;
        color: white;
        margin-right: 14px;
        border-radius: 7px;
    }
    .radio-toolbar input[type="radio"]:checked+label {
        background-color: rgb(232 106 47 / 71%);
    }
    .checkedraam {
      color: orange;
    }
</style>
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3> B2B Configuration  -  ({{$school->university_name}}) </h3>
            </div>    
           
        </div>
            
        <div class="radio-toolbar mb-3 col-md-12">

        <input onclick="location.href = '/dashboard/school/b2bconfigurations/{{$id}}';" id="radio161" value="siteconfig" type="radio" name="workon">
            <label for="radio161">Site Configuration</label>

            <input onclick="location.href = '/dashboard/school/b2bpricing_mechanism/{{$id}}';" id="radio162" value="siteconfig" type="radio" name="workon">
            <label for="radio162">Pricing Mechanism</label>

            <input onclick="location.href = '/dashboard/school/b2bmeta_configration/{{$id}}';" id="radio163" value="siteconfig" type="radio" name="workon" checked>
            <label for="radio163">Meta Configuration</label>

        </div>

        <div class="card-body">
            <form id="target" action="{{ route('b2bmeta_configration.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="school_id" value="{{$id}}">
                
                <div class="row container-fluid">
                   <div class="col-md-6">
                       <b>Meta Title</b>
                        <div class="form-group">
                            <input type="text" class="form-control" name="meta_title" value="{{$metaConfig->meta_title}}">
                        </div>
                   </div>
                   <div class="col-md-6">
                       <b>Meta Description</b>
                        <div class="form-group">
                            <input type="text" class="form-control" name="meta_description" value="{{$metaConfig->meta_description}}">
                        </div>
                   </div>
                   <div class="col-md-6">
                       <b>Keywords</b>
                        <div class="form-group">
                            <input type="text" class="form-control" name="tag" value="{{$metaConfig->tag}}">
                        </div>
                   </div>
                   {{--<div class="col-md-6">
                       <b>Keywords</b>
                        <div class="form-group">
                            <input type="text" class="form-control" name="keywords" value="{{$metaConfig->keywords}}">
                        </div>
                   </div>--}}
                   <div class="col-md-6">
                       <b>Fav Icon</b>
                        <div class="form-group">
                            <input type="file" class="form-control" name="fav_icon">
                        </div>
                        @if($metaConfig->fav_icon!='')
                            <img src="{{$metaConfig->fav_icon}}" width="60" height="60">
                        @endif
                   </div>
                </div>

                <div class="col-sm-12 text-center mt-5">  
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="example"></label>
                        <div class="col-md-6">
                            <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection
@section('page-script')
@stop