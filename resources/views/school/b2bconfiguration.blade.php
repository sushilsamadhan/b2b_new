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
                <h3> B2B Configuration  -  ({{$universitie->university_name}}) </h3>
            </div>


            <div class="float-right">
                @if($schooldata->verified==1)
                    <h3 class="text-success">Verified</h3>
                @endif
                @if($schooldata->verified==0)
                    <h3 class="text-danger">Not Verified</h3>                
                @endif
            </div>     
            @if($schooldata->verified == '1' && $schooldata->status == '1' && $schooldata->slug != "")
            <br>
            <br> 
            <div class="float-right">
            <h3 class="text-dark"> 
                Go To Site 
                <a href="{{url($schooldata->slug)}}"><i class="feather icon-globe mr-2"></i></a>
            </h3>
            </div>
            @endif
        </div>
            
        <div class="radio-toolbar mb-3 col-md-12">
            <input onclick="workonMessage(this.value);" id="radio16" value="siteconfig" type="radio" name="workon" checked>
            <label for="radio16">Site Configuration</label>
    
            <input onclick="workonMessage(this.value);" id="radio18" value="siteconfigaa" type="radio" name="workon">
            <label for="radio18">Theme Configuration</label>
            
            <input onclick="workonMessage(this.value);" id="radio19" value="b2bpricing_mechanism" type="radio" name="workon">
            <label for="radio19">Pricing Mechanism</label>
            
            <input onclick="workonMessage(this.value);" id="radio20" value="b2bmeta_configration" type="radio" name="workon">
            <label for="radio20">Meta Configration</label>

        </div>

        <div class="card-body" id="appendworkdata">
        <form id="target" action="{{ route('b2bconfigurations.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <input type="hidden" name="univercityId" id="univercityId" value="{{$schooldata->universities_id}}">
            <div class="row">
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="university_name" class="col-sm-3 col-form-label">@translate(Slug)<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="university_name" value="{{$schooldata->slug}}" name="slug" placeholder="Short Institute Name for uniqui URL" class="form-control" required>
                        <p id="slugvajidation" class="text-danger"></p>
                    </div>
                </div>
            </div>
            {{--<div class="col-sm-6">
                <div class="form-group row">
                <label for="username_name" class="col-sm-3 col-form-label">@translate(username)<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="username_name" value="{{$schooldata->username}}" name="username" placeholder="Short Institute Name for uniqui URL" class="form-control" required>
                        <p id="usernamevajidation" class="text-danger"></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="password_name" class="col-sm-3 col-form-label">@translate(Password)<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" id="password_name" value="{{$schooldata->passwordplanetest}}" name="password" placeholder="Short Institute Name for uniqui URL" class="form-control" required>
                        <p id="passwordvajidation" class="text-danger"></p>
                    </div>
                </div>
            </div>--}}
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="domain_name" class="col-sm-3 col-form-label">Domain Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$schooldata->domain_name}}" id="domain_name" name="domain_name" placeholder="Domain Name">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="branch" class="col-sm-3 col-form-label">Choose Subscription<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="subscription" value="{{ old('subscription')}}" id="subscription" class="form-control" required>
                            <option value="">Select Subscription</option>
                            <option @if($schooldata->subscription=='subscription 1') selected @endif value="subscription 1">subscription 1</option>
                            <option @if($schooldata->subscription=='subscription 2') selected @endif value="subscription 1">subscription 2</option>
                        </select>
                    </div>
                </div>
            </div>
           
            {{-- <div class="col-sm-6">
                <div class="form-group row">
                <label for="address" class="col-sm-3 col-form-label">Address<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ old('address')}}" id="address" name="address" placeholder="Address">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="pincode" class="col-sm-3 col-form-label">Pincode<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="pincode" value="{{ old('pincode')}}" name="pincode" placeholder="Pincode" class="form-control ">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="state" class="col-sm-3 col-form-label">State<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ old('state')}}" id="state" name="state" placeholder="State">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">City<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="city" name="city" value="{{ old('city')}}" placeholder="City" class="form-control ">
                    </div>
                </div>
            </div> --}}
            
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Status<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <!-- <input type="text" class="form-control" id="status" name="status" placeholder="Title"> -->
                        <select name="status" value="{{ old('status')}}" id="status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option @if($schooldata->status==1) selected @endif value="1">Active</option>
                            <option @if($schooldata->status==0) selected @endif value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
           
            <div class="col-sm-12">
                <div class="form-group row">
                <label for="branch" class="col-sm-2 col-form-label">MOU Term<span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                        <textarea required="" name="mou_term" class="form-control" style=" height: 200px; " placeholder="Please Enter some text to send message">{{$schooldata->mou_term}}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group row">
                <label for="mou_date" class="col-sm-3 col-form-label">MOU Date</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" value="{{$schooldata->mou_date}}" id="mou_date" name="mou_date" placeholder="Mou Date">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="mou_date" class="col-sm-3 col-form-label">Commission Menager</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" value="{{$schooldata->commission}}" id="commission" name="commission" placeholder="Commission">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                <label for="mou_date" class="col-sm-3 col-form-label">Logo</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control"  name="logo" id="logo">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <img src="{{$schooldata->logo}}" style="width: 150px;">
            </div>
            {{-- <div class="col-sm-6">
                <div class="form-group row">
                    <label for="logo" class="col-sm-3 col-form-label">Logo <span class="text-danger">*</span></label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control"  name="logo" id="logo">
                    </div>
                    <div class="col-sm-4">
                        <img src="{{$schooldata->logo}}" style="width: 150px;">
                    </div>
                </div>
            </div> --}}
            <div class="col-sm-12 text-center">  
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="example"></label>
                    <div class="col-md-6">
                        <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                    </div>
                </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('page-script')
<script>
    function workonMessage(workval) {
		if(workval=="siteconfig"){
			location.reload();
		}
		if(workval=="b2bpricing_mechanism"){
			window.location.replace("/dashboard/school/b2bpricing_mechanism/{{$id}}");
		}
		if(workval=="b2bmeta_configration"){
			window.location.replace("/dashboard/school/b2bmeta_configration/{{$id}}");
		}
        if(workval=="permition"){
        @if($schooldata->slug && $b2bconfigrationpermition)
			$("#appendworkdata").html('<div class="mb-3 col-md-12"><form action="{{ route("b2bconfigurations.addpermition") }}" method="POST" enctype="multipart/form-data"> @csrf <input type="hidden" value="{{$schooldata->slug}}" name="slug"> <input @if($b2bconfigrationpermition->silder_area==1) checked @endif  type="checkbox" id="silder_area" name="silder_area" value="1"> <label for="silder_area"> SLIDER AREA</label><br> <input @if($b2bconfigrationpermition->special_banners==1) checked @endif type="checkbox" id="special_banners" name="special_banners" value="1"> <label for="special_banners"> Special Banners Area</label><br> <input @if($b2bconfigrationpermition->category_area==1) checked @endif  type="checkbox" id="category_area" name="category_area" value="1"> <label for="category_area"> CATEGORY AREA</label><br> <input @if($b2bconfigrationpermition->free_live_course==1) checked @endif  type="checkbox" id="free_live_course" name="free_live_course" value="1"> <label for="free_live_course"> Free Live Course Area</label><br> <input @if($b2bconfigrationpermition->pricing_area==1) checked @endif  type="checkbox" id="pricing_area" name="pricing_area" value="1"> <label for="pricing_area"> Pricing AREA</label><br> <input @if($b2bconfigrationpermition->curriculum_promo==1) checked @endif  type="checkbox" id="curriculum_promo" name="curriculum_promo" value="1"> <label for="curriculum_promo"> START Curriculum Promo</label><br> <input @if($b2bconfigrationpermition->affiliate_program==1) checked @endif  type="checkbox" id="affiliate_program" name="affiliate_program" value="1"> <label for="affiliate_program"> Affiliate Program Area</label><br> <input @if($b2bconfigrationpermition->competitive_classes_area==1) checked @endif  type="checkbox" id="competitive_classes_area" name="competitive_classes_area" value="1"> <label for="competitive_classes_area"> Competitive Classes Area</label><br> <input @if($b2bconfigrationpermition->test_series_program==1) checked @endif  type="checkbox" id="test_series_program" name="test_series_program" value="1"> <label for="test_series_program"> test Series Program</label><br> <input @if($b2bconfigrationpermition->study_for_free==1) checked @endif  type="checkbox" id="study_for_free" name="study_for_free" value="1"> <label for="study_for_free"> Study For Free</label><br> <input @if($b2bconfigrationpermition->top_online_instructors==1) checked @endif  type="checkbox" id="top_online_instructors" name="top_online_instructors" value="1"> <label for="top_online_instructors"> Top Online Instructors</label><br> <input @if($b2bconfigrationpermition->what_student_says==1) checked @endif  type="checkbox" id="what_student_says" name="what_student_says" value="1"> <label for="what_student_says"> What Student Says</label><br> <input @if($b2bconfigrationpermition->blog_area==1) checked @endif  type="checkbox" id="blog_area" name="blog_area" value="1"> <label for="blog_area"> Blog Area</label><br><br> <input class="btn btn-primary" type="submit" value="Submit"> </form> </div>');
            
        @else 
			$("#appendworkdata").html('<div class="mb-3 col-md-12"><form action="{{ route("b2bconfigurations.addpermition") }}" method="POST" enctype="multipart/form-data"> @csrf <input type="hidden" value="{{$schooldata->slug}}" name="slug"> <input type="checkbox" id="silder_area" name="silder_area" value="1"> <label for="silder_area"> SLIDER AREA</label><br> <input type="checkbox" id="special_banners" name="special_banners" value="1"> <label for="special_banners"> Special Banners Area</label><br> <input type="checkbox" id="category_area" name="category_area" value="1"> <label for="category_area"> CATEGORY AREA</label><br> <input type="checkbox" id="free_live_course" name="free_live_course" value="1"> <label for="free_live_course"> Free Live Course Area</label><br> <input type="checkbox" id="pricing_area" name="pricing_area" value="1"> <label for="pricing_area"> Pricing AREA</label><br> <input type="checkbox" id="curriculum_promo" name="curriculum_promo" value="1"> <label for="curriculum_promo"> START Curriculum Promo</label><br> <input type="checkbox" id="affiliate_program" name="affiliate_program" value="1"> <label for="affiliate_program"> Affiliate Program Area</label><br> <input type="checkbox" id="competitive_classes_area" name="competitive_classes_area" value="1"> <label for="competitive_classes_area"> Competitive Classes Area</label><br> <input type="checkbox" id="test_series_program" name="test_series_program" value="1"> <label for="test_series_program"> test Series Program</label><br> <input type="checkbox" id="study_for_free" name="study_for_free" value="1"> <label for="study_for_free"> Study For Free</label><br> <input type="checkbox" id="top_online_instructors" name="top_online_instructors" value="1"> <label for="top_online_instructors"> Top Online Instructors</label><br> <input type="checkbox" id="what_student_says" name="what_student_says" value="1"> <label for="what_student_says"> What Student Says</label><br> <input type="checkbox" id="blog_area" name="blog_area" value="1"> <label for="blog_area"> Blog Area</label><br><br> <input class="btn btn-primary" type="submit" value="Submit"> </form> </div>');       
		@endif
        }
		if(workval=="siteconfigaa"){
			$("#appendworkdata").html('<div class="mb-3 col-md-12"><form action="{{ route("b2bconfigurations.add") }}" method="POST" enctype="multipart/form-data"> @csrf <input type="hidden" name="univercityId" id="univercityId" value="{{$schooldata->universities_id}}"> <label for="theme_configration">Select your favorite color:</label> <input type="color" id="theme_configration" name="theme_configration" value="{{$schooldata->theme_configration}}"><br><br> <input type="submit" class="btn btn-primary"> </div>');
		}
	} 

    $( "#target" ).submit(function( event ) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('b2bconfigurations.checkslug') }}", 
            data: {universities_id: $('#univercityId').val(), slug: $('#university_name').val(), "_token": "{{ csrf_token() }}"},
            type: 'post',
            success: function(result) {
                if(result==1){
                    $("#slugvajidation").text('This Slug Already Used');
                    event.preventDefault();
                }
                if(result==0){
                    target.submit();
                }
            }});
    });

    $('#university_name').on('keyup',function(){
        var company_name = $('#university_name').val().replace(/[^A-Z0-9]/ig, "-");
        $('#university_name').val(company_name);
    });
    
    $(document).ready(function(){
        $('#pincode').on('keyup',function(){
            var pincode = $(this).val();
            if(pincode == ''){
                $('#city').val(' ');
                $('#state').val(' ');
            }else{
                $.ajax({
                url: "https://api.postalpincode.in/pincode/"+pincode,
                type: "GET",
                dataType: "json",
                success: function(response){
                    $('#city').val(response[0].PostOffice[0].District);
                    $('#state').val(response[0].PostOffice[0].State);
                }
            });
            }
        });
    });
</script>
@stop