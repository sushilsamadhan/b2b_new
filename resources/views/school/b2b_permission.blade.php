@extends('layouts.master')
@section('title','School List')
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
<div class="card mx-2 mb-3">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(Course Type Permissions)  -  ({{$school->university_name}})</h3>
            </div>
            
            <div class="float-right">
                <div class="row">
                	<!-- @if(session('success'))
                		<div class="alert alert-success">{{ session('success') }}</div>
                	@endif -->
                </div>
            </div>

        </div>
        <div class="card-body table-responsive">
<form action="" method="post"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$id}}" name="school_id">
                    <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="" for="content-type">
                            @translate(Select Content Type)
                        </label> 
                    <div class="">
                        <div class="radio-toolbar mb-3 col-md-12">
                            <input onclick="workonMessage(this.value);" class="content-type" id="radio16board" value="school" type="radio" name="main_category">
                            <label for="radio16board">School</label>
                            <input onclick="workonMessage(this.value);" class="content-type" id="radio18college" value="collage" type="radio" name="main_category">
                            <label for="radio18college">College</label>
                            <input onclick="workonMessage(this.value);" class="content-type" id="radio18competitive" value="competitive" type="radio" name="main_category">
                            <label for="radio18competitive">Competitive</label>
                            <input onclick="workonMessage(this.value);" class="content-type" id="radio16folk" value="folk-programme" type="radio" name="main_category">
                            <label for="radio16folk">Folk programme</label>
                            <input onclick="workonMessage(this.value);" class="content-type" id="radio18entrepreneur" value="entrepreneur" type="radio" name="main_category">
                            <label for="radio18entrepreneur">Entrepreneur</label>
                        </div> 
                    </div>  

                    <div id="demo"></div>
                
                <div class="form-group text-center mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                </div>

</form>
        </div>
</div>
        </div>
</div>
<script>
function workonMessage(workval) {
    // alert(workval);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("demo").innerHTML =
        this.responseText;
    }
    xhttp.open("GET", "{{url('dashboard/getForPermission')}}?id="+workval+"&school_id="+{{$id}});
    xhttp.send();
} 

function workonMessage11(workval) {
    // alert(workval);
    if ($('#defaultCheck'+workval).is(':checked')) {
            $(".checkBoxClass-"+workval).prop('checked', true);
        }else{
            $(".checkBoxClass-"+workval).prop('checked', false);
        }
} 
</script>
@endsection