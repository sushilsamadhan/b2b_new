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
                <form action="{{ route('school.B2B.course.permissions.store') }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$id}}" name="school_id">
                    <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="" for="content-type">
                            @translate(Select Content Type)
                        </label> 
    <div class="">
        <div class="radio-toolbar mb-3 col-md-12">
            <input class="content-type" id="radio16board" value="board" type="radio" name="workon">
            <label for="radio16board">School</label>
            <input class="content-type" id="radio18college" value="college" type="radio" name="workon">
            <label for="radio18college">College</label>
            <input class="content-type" id="radio18competitive" value="competitive-courses" type="radio" name="workon">
            <label for="radio18competitive">Competitive</label>
            <input class="content-type" id="radio16free" value="free-study-material" type="radio" name="workon">
            <label for="radio16free">Free Study Material</label>
            <input class="content-type" id="radio18current" value="current-affairs" type="radio" name="workon">
            <label for="radio18current">Current Affairs</label>
            <input class="content-type" id="radio16project" value="project-works" type="radio" name="workon">
            <label for="radio16project">Project Works</label>
            <input class="content-type" id="radio16traditional" value="traditional-courses" type="radio" name="workon">
            <label for="radio16traditional">Traditional Courses</label>
        </div> 
    </div>  

    <!-- <input class="btn btn-primary content-type" type="button" name="" value="board">
    <input class="btn btn-primary content-type" type="button" name="" value="competitive-courses">
    <input class="btn btn-primary content-type" type="button" name="" value="free-study-material">
    <input class="btn btn-primary content-type" type="button" name="" value="current-affairs">
    <input class="btn btn-primary content-type" type="button" name="" value="project-works">
    <input class="btn btn-primary content-type" type="button" name="" value="traditional-courses"> -->

<!-- <p class="btn btn-primary content-type">Board</p>
<p class="btn btn-primary content-type">Competitive Courses</p>
<p class="btn btn-primary content-type">Free Study Materia</p>
<p class="btn btn-primary content-type">Current Affairs</p>
<p class="btn btn-primary content-type">Project Works</p>
<p class="btn btn-primary content-type">Traditional Courses</p> -->

                            {{--<select class="form-control langr selectpicker" id="content-type" name="content_type" autofocus required>
                                <option value="" class="mb-2">
                                @translate(Please select Content type)</option>
                                <option value="board" {{ (old('content_type') == 'board')?'selected':'' }}>Board</option>
                                <option value="competitive-courses" {{ (old('content_type') == 'competitive-courses')?'selected':'' }}>Competitive Courses</option>
                                <option value="free-study-material" {{ (old('content_type') == 'free-study-material')?'selected':'' }}>Free Study Material</option>
                                <option value="current-affairs" {{ (old('content_type') == 'current-affairs')?'selected':'' }}>Current Affairs</option>                                        
                                <option value="project-works" {{ (old('content_type') == 'project-works')?'selected':'' }}>Project Works</option>
                                <option value="traditional-courses" {{ (old('content_type') == 'traditional-courses')?'selected':'' }}>Traditional Courses</option>                                    
                        </select>--}}

                    </div>
                        <div class="col-md-8">
                                    <label class="" for="val-category_id">
                                        @translate(Category) 
                                    </label>
<div class="row" id="val-category_id">
          
</div>
                                            <!-- <select class="form-control lang @error('category_id') is-invalid @enderror selectpicker" id="val-category_id" name="category_id" autofocus required>
                                                <option value="" class="mb-2">
                                                @translate(Please Category)</option>
                                            </select> -->

                                            </div>
                        @error('category_id') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                <!-- <div class="card-body table-responsive mt-3">
                    <div class="" id="demo"></div>
                </div> -->

                
                <div class="form-group text-center mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                </form>
        </div>
</div>
@endsection
@section('js-link')
@include('layouts.include.form.form_js')
<script>


// $(document).on('change', '#val-category_id', function(){    
//     var catId = $(this).val();  
//     $.ajax({
//           type:'POST',
//           url:'{{ route("categoriesById") }}',
//           headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//           data:{'catId':catId},
//           success: function (response) {
//             if(response.data.length!=0){
//                 $('.subcategory-show').show(); 
//                 $("#val-sub-category_id").prop('required',true);               
//                 var optstring = '<option value="">Please Select</option>'+"\r\n";
//                 $(response.data).each(function(key,val){
//                     optstring += '<option value="'+val.id+'">'+val.name+'</option>'+"\r\n";
//                 });
//                 $('#val-sub-category_id').html(optstring);
//             } else{
//                 $('.subcategory-show').hide();
//                 $("#val-sub-category_id").prop('required',false);
//             }         
//           },
//           error: function(XMLHttpRequest, textStatus, errorThrown) 
//           { 
//             var msg=(JSON.parse(XMLHttpRequest.responseText).message);
//           } 
//       });

//             const xhttp = new XMLHttpRequest();
//             xhttp.onload = function() {
//                 document.getElementById("demo").innerHTML =
//                 this.responseText;
//             }
//             xhttp.open("GET", "{{url('dashboard/getForPermission')}}?id="+catId);
//             xhttp.send();
// });


$(document).on('click', '.content-type', function(){    
    var course_type = $(this).val();
    
    if(course_type == 'free-study-material'){
        $('.free-hide').hide();
    }else{
        $('.free-hide').show(); 
    }
    if(course_type == 'current-affairs'){
        $('.affairs_date_div').show();
    }else{
        $('.affairs_date_div').hide(); 
    }       
    $.ajax({
          type:'POST',
          url:'{{ route("b2bcategoriesByCourseType") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'course_type':course_type},
          success: function (response) {                    
            var optstring = '';
            $(response.data).each(function(key,val){
                if(val.child.length!=0){
                    var mainId = val.id;
                    optstring += '<div class="row ml-4"><div class="col-md-12"> <label class="form-check-label font-weight-bold" for="defaultCheck'+val.id+'"> '+val.name+' </label><input onclick="workonMessage(this.value);" style="margin-left: 24px;" class="form-check-input" type="checkbox" value="'+val.id+'" id="defaultCheck'+val.id+'" name="category_name[]"></div>';
                }else{

                    optstring += '<div class="form-group col-md-3"> <div class="form-check"> <input class="form-check-input checkBoxClass-'+mainId+'" type="checkbox" value="'+val.id+'" id="defaultCheck'+val.id+'" name="category_name[]"></div> </div>';

                    
                }
                
                if(val.child.length!=0){
                    $(val.child).each(function(key1,val1){
                        optstring += '<div class="form-group col-md-3"> <div class="form-check"> <input class="form-check-input checkBoxClass-'+mainId+'" type="checkbox" value="'+val1.id+'" id="defaultCheck'+val1.id+'" name="category_name[]"> <label class="form-check-label" for="defaultCheck'+val1.id+'"> '+val1.name+' </label> </div> </div>';
                    });
                    optstring += '</div>';
                }
            });
            $('#val-category_id').html(optstring);           
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          { 
            var msg=(JSON.parse(XMLHttpRequest.responseText).message);
          } 
      });

const myTimeout = setTimeout(myGreeting, 1000);
function myGreeting() {      
    if(course_type=='board'){
        $("#val-category_id").append('<div class="row ml-4"> <div class="col-md-12 font-weight-bold"><label class="form-check-label font-weight-bold" for="defaultCheckproject-work"> Project Work </label><input onclick="workonMessage(this.value);" style="margin-left: 24px;" class="form-check-input" type="checkbox" value="project-work" id="defaultCheckproject-work" name=""></div><div class="form-group col-md-6"> <div class="form-check"> <input class="form-check-input checkBoxClass-project-work" type="checkbox" value="college-level" id="defaultCheck-college" name="category_name[]"> <label class="form-check-label" for="defaultCheck-college">College Level</label> </div> </div> <div class="form-group col-md-6"> <div class="form-check"> <input class="form-check-input checkBoxClass-project-work" type="checkbox" value="school-level" id="defaultCheck-school" name="category_name[]"> <label class="form-check-label" for="defaultCheck-school">School Level</label> </div> </div> </div> </div>');
      }
}



});
$(function () {
    @if(old('content_type'))
    var course_type = "{{old('content_type')}}";
    if(course_type == 'free-study-material'){
        $('.free-hide').hide();
    }else{
        $('.free-hide').show(); 
    }
    if(course_type == 'current-affairs'){
        $('.affairs_date_div').show();
    }else{
        $('.affairs_date_div').hide(); 
    }     
    $.ajax({
          type:'POST',
          url:'{{ route("categoriesByCourseType") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'course_type':course_type},
          success: function (response) {                    
            var optstring = '<option value="">Please Select</option>'+"\r\n";
            $(response.data).each(function(key,val){
                if(val.child.length!=0){
                    optstring += '<optgroup Label="'+val.name+'">';
                }else{
                    optstring += '<option value="'+val.id+'">'+val.name+'</option>'+"\r\n";
                }
                
                if(val.child.length!=0){
                    $(val.child).each(function(key1,val1){
                        optstring += '<option value="'+val1.id+'">'+val1.name+'</option>'+"\r\n";
                    });
                    optstring += '</optgroup>';
                }
            });
            $('#val-category_id').html(optstring);           
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          { 
            var msg=(JSON.parse(XMLHttpRequest.responseText).message);
          } 
      });
    @endif
});


function workonMessage(workval) {
    // alert(workval);
    if ($('#defaultCheck'+workval).is(':checked')) {
            $(".checkBoxClass-"+workval).prop('checked', true);
        }else{
            $(".checkBoxClass-"+workval).prop('checked', false);
        }
} 
</script>
@stop