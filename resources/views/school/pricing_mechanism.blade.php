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

            <input onclick="location.href = '/dashboard/school/b2bconfigurations/{{$id}}';" id="radio16" value="siteconfig" type="radio" name="workon">
            <label for="radio16">Site Configuration</label>

<input onclick="location.href = '/dashboard/school/b2bpricing_mechanism/{{$id}}';" id="radio20" value="siteconfig" type="radio" name="workon" checked>
<label for="radio20">Pricing Mechanism</label>

<input onclick="location.href = '/dashboard/school/b2bmeta_configration/{{$id}}';" id="radio201" value="siteconfig" type="radio" name="workon">
<label for="radio201">Meta Configuration</label>
            

        </div>

        <div class="card-body">
            <form id="target" action="{{ route('b2bpricing_mechanism.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="school_id" value="{{$id}}">
                
                <div class="row container-fluid">
                    <div class="form-check col-md-3">
                        <input onclick="PricingMechanism(this.value);" value="Discount" class="form-check-input" type="radio" name="mechanisms_type" id="mechanisms_type1" @if($existMechanism)  @if($existMechanism->mechanisms_type=='Discount') checked @endif @endif>
                        <label class="form-check-label" for="mechanisms_type1">
                            Discount
                        </label>
                    </div>

                    <div class="form-check col-md-3">
                        <input onclick="PricingMechanism(this.value);" value="Hike" class="form-check-input" type="radio" name="mechanisms_type" id="mechanisms_type2"   @if($existMechanism)  @if($existMechanism->mechanisms_type=='Hike') checked @endif @endif>
                        <label class="form-check-label" for="mechanisms_type2">
                            Hike
                        </label>
                    </div>

                    <div class="form-check col-md-3">
                        <input onclick="PricingMechanism(this.value);" value="Free" class="form-check-input" type="radio" name="mechanisms_type" id="mechanisms_type3"   @if($existMechanism) @if($existMechanism->mechanisms_type=='Free') checked @endif @endif>
                        <label class="form-check-label" for="mechanisms_type3">
                            Free
                        </label>
                    </div>
                </div>

<div class="input-group mb-3 mt-4 w-50" id="PricingMechanismType">

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
<script>
    function PricingMechanism(mechanism){
        if(mechanism=='Discount'){
            document.getElementById("PricingMechanismType").innerHTML = '<div class="input-group-prepend"> <span class="input-group-text"></span> </div> <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="value" value="@if($existMechanism) @if($existMechanism->mechanisms_type=="Discount") {{$existMechanism->value}} @endif @endif "> <div class="input-group-append"> <span class="input-group-text">.%</span> </div>';
        } 
        if(mechanism=='Hike'){
            document.getElementById("PricingMechanismType").innerHTML = '<div class="input-group-prepend"> <span class="input-group-text"></span> </div> <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="value" value="@if($existMechanism) @if($existMechanism->mechanisms_type=="Hike") {{$existMechanism->value}} @endif @endif"> <div class="input-group-append"> <span class="input-group-text">.%</span> </div>';
        }  
        if(mechanism=='Free'){
            document.getElementById("PricingMechanismType").innerHTML = '';
        }  
    }

    if($('input:radio[name=mechanisms_type]:checked').val()){
        PricingMechanism($('input:radio[name=mechanisms_type]:checked').val());
    }

</script>
@stop