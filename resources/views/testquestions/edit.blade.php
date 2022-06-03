@extends('layouts.master')
@include('layouts.include.form.form_css')
@section('content')
<!-- Tagsinput js -->
<script src="{{asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-tagsinput/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/custom-form-select.js')}}"></script>

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Edit Question</h3>
            </div>
            
        </div>


        <div class="card-body">
        <form action="{{ route('testquestions.update',$testquestion->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
                        @method('PUT')



                <input type="hidden" name="id" value="{{$testquestion->id}}">
            <div class="container">    
                <div class="row">
                    <div class="form-group col-md-3 p-3">
                        <label class="" for="ques_cat_id">
                            @translate(Course Type) <span class="text-danger">*</span></label>
                        <div class="">
                        <select class="form-control langr selectpicker" id="ques_cat_id" name="ques_cat_id">
                        <option value=""> @translate(Please Select Course Type)</option>
                                @foreach ($queCat as $queCatVal)
                                <option value="{{$queCatVal->id}}" {{ ($queCatVal->id == $testquestion->question_categorie_id)?'selected':'' }}  class="mb-2">{{$queCatVal->category_type}}</option>
                                @endforeach
                            </select>
                        </div>

                
                    </div>

                            <!----   Board Start   --->
                            
                            @if($testquestion->question_categorie_id == '1' || $testquestion->question_categorie_id == '3')

                            @php $display = 'none'; @endphp

                            @else

                            @php $display = 'displayBlock'; @endphp

                            @endif

                            @if($testquestion->question_categorie_id == '2')

                            @php $displayB = 'none'; @endphp

                            @else

                            @php $displayB = 'block'; @endphp

                            @endif
                            {{-- Category --}}
                        <div class="form-group col-md-4 p-3 displayBlock" style="display:{{$display}}">
                            <label class="" for="val-category_id">@translate(Board/Exam) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('q_cat_id') is-invalid @enderror"
                                        id="val-category_id" name="q_cat_id">
                                        <option value="">Please Select</option>
                                @php $i=0; @endphp

                                    @foreach ($categories as $category)

                                        @if(count($category['child'])!=0)

                                            <optgroup Label="{{ $category->name }}">

                                        @else
                                             <option value="{{ $category->id }}" {{$testquestion->q_cat_id == $category->id ? 'selected':null}}>{{ $category->name }}</option>
                                        @endif
                                     @if(count($category['child'])!=0)
                                        @php $j=0; @endphp

                                            @foreach($category['child'] as $val)

                                                <option value="{{ $val->id }}" {{$testquestion->q_cat_id == $val->id ? 'selected':null}}>{{ $val->name }}</option>
                                                @php $j++; @endphp

                                            @endforeach

                                        @endif

                                        @php $i++; @endphp
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                    </div>   


                    {{-- Sub Category --}}
                        <div class="form-group col-md-4 p-3 displayBlock" id="sub_category_id_display" style="display:{{$display}}">
                            <label class="" for="val-sub_category_id">@translate(Class) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('sub_cat_id') is-invalid @enderror"
                                        id="val-sub_category_id" name="sub_cat_id">
                                        <option value=""> @translate(Select Classes)</option>
                                        @foreach($subCatdetail as $subCat)
                                             <option value="{{$subCat->id}}" {{ ($testquestion->sub_cat_id == $subCat->id)?'selected':'' }}>{{$subCat->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                    </div>
                    
                    {{-- Subjects --}}
                        <div class="form-group col-md-4 p-3 displayBlock" id="course_id" style="display:{{$display}}">
                            <label class="" for="val-course_id">@translate(Subject) <span class="text-danger"></span></label>
                            <div class="">
                                <select class="form-control langr @error('course_id') is-invalid @enderror"
                                        id="val-course_id" name="course_id">
                                        <option value=""> @translate(Select Subject)</option>
                                        @foreach($courses_detail as $courseVal)
                                             <option value="{{$courseVal->id}}" {{ ($testquestion->course_id == $courseVal->id)?'selected':'' }}>{{$courseVal->title}}</option>
                                        @endforeach
                                </select>
                            </div>
                    </div>

                    {{-- Unit --}}
                        <div class="form-group col-md-4 p-3 displayBlock" id="unit_id" style="display:{{$display}}">
                            <label class="" for="val-unit_id">@translate(Chapters) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('unit_id') is-invalid @enderror"
                                        id="val-unit_id" name="unit_id">
                                        <option value=""> @translate(Select Unit)</option>


                                        @php $i=0; @endphp

                                            @foreach ($chapter_detail as $chapter)

                                                @if(count($chapter['contents'])!=0)

                                                    <optgroup Label="{{ $chapter->title }}">

                                                @else
                                                    <option value="{{ $chapter->id }}" {{$testquestion->unit_id == $chapter->id ? 'selected':null}}>{{ $chapter->title }}</option>
                                                @endif
                                            @if(count($chapter['contents'])!=0)
                                                @php $j=0; @endphp

                                                    @foreach($chapter['contents'] as $val)

                                                        <option value="{{ $val->id }}-{{$chapter->id}}" {{$testquestion->chapter_id == $val->id ? 'selected':null}}>{{ $val->title }}</option>
                                                        @php $j++; @endphp

                                                    @endforeach

                                                @endif

                                                @php $i++; @endphp
                                               

                                                </optgroup>
                                            @endforeach

                                            <option value="0">No Option</option>
                                      
                                </select>
                            </div>
                    </div>

                    
<!----   Board End   --->
                    
                        <div class="form-group col-md-3 p-3 displayNone" style="display:{{$displayB}}">
                            <label class="" for="tag_id">
                                @translate(Question Subject) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr selectpicker" id="tag_id" name="tag_id">
                                        <option value="">Please Select Question Subject</option>
                                        @foreach ($queCatTag as $queCatTagVal)
                                            <option value="{{$queCatTagVal->id}}" {{ ($queCatTagVal->id == $testquestion->question_tag_id)?'selected':'' }}  class="mb-2">{{$queCatTagVal->tag_name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
@if($testquestion->question_categorie_id == 1)
                        <div class="form-group col-md-3 p-3 displayNone" >
                        <label class="" for="q_tag_type_id">
                            @translate(Question Tag ) <span class="text-danger"></span></label>
                        <div class="">
                            <select class="form-control langr selectpicker" id="q_tag_type_id" name="q_tag_type_id">
                                    <option value="">Select Question Tag</option>
                                    @foreach ($queTypeTag as $queTypeTagVal)
                                        <option value="{{$queTypeTagVal->id}}" {{ ($queTypeTagVal->id == $testquestion->q_tag_type_id)?'selected':'' }}  class="mb-2">{{$queTypeTagVal->tag_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="form-group col-md-3 p-3">
                        <label class="" for="level_id">
                            @translate(Level) <span class="text-danger">*</span></label>
                        <div class="">
                            <select class="form-control langr selectpicker" id="level_id" name="level_id">
                            <option value="" selected>Select Level Type</option>
                                <option value="E" {{ ($testquestion->level_id=='E')?'selected':'' }}>Easy</option>
                                <option value="M" {{ ($testquestion->level_id=='M')?'selected':'' }}>Moderate</option>
                                <option value="D" {{ ($testquestion->level_id=='D')?'selected':'' }}>Difficult</option>
                            </select>
                        </div>
                
                    </div>

                    <div class="form-group col-md-3 p-3">
                        <label class="" for="question_type">
                            @translate(Question Type) <span class="text-danger">*</span></label>
                        <div class="">
                        <select class="form-control langr selectpicker" id="question_type" name="question_type">
                                <option value="1" {{ ($testquestion->question_type=='1')?'selected':'' }}>Single Selection</option>
                                <option value="2" {{ ($testquestion->question_type=='2')?'selected':'' }} disabled>Multiple Selection</option>
                                <option value="3" {{ ($testquestion->question_type=='3')?'selected':'' }} disabled>Paragraph</option>
                            </select>
                        </div>
                
                    </div>
                    <div class="form-group col-md-12 p-3">
                        <label class="" for="questitle">
                            @translate(Question Tag) <span class="text-danger">*</span></label>
                            <div class="bootstrap-tagsinput">
<input type="text"  class="@error('q_tag') is-invalid @enderror" placeholder="@translate(Enter Question Tag)"  id="val-q_tag" name="q_tag" data-role="tagsinput" value="@if(isset($testquestion->q_tag))@foreach(json_decode($testquestion->q_tag) as $item){{$item}},@endforeach @endif">
                                @error('q_tag') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                            </div>
                    </div>
                    <div class="form-group col-md-12 p-3">
                        <label class="" for="questitle">
                            @translate(Question Title) <span class="text-danger">*</span></label>
                        <div class="">
                            <textarea
                                   id="questitle"
                                   class="form-control ques-class @error('title') is-invalid @enderror"
                                   name="title" placeholder="@translate(Enter Questions Title)" aria-required="true"
                                   >{{ $testquestion->body }}</textarea>
                            @error('title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>

               
                      </div>

                      
                </div>  
                
            </div>          
            </div> 

                     
            <div class="container">
                    <div class="row">
                        <div class="form-group col-md-6 p-3">
                            <label class="" for="option3">
                            @translate(Option#1) <span class="text-danger"></span></label>
                            <div class="">
                                <textarea
                                    id="option1"
                                    class="form-control ques-class @error('option1') is-invalid @enderror"
                                    name="option[]" placeholder="@translate(Enter option#1)" aria-required="true"
                                    >{{(!empty($option) && isset($option[0]))?$option[0]->option_title:''}}</textarea>
                                <select class="form-control" id="option1status" name="optionstatus[]">
                                    <option value="0" {{ (!empty($option) && isset($option[0])) && ($option[0]->flag_correct == '0')?'selected':'' }}>False</option>
                                    <option value="1"  {{ (!empty($option) && isset($option[0])) && ($option[0]->flag_correct == '1')?'selected':'' }}>True</option>
                                </select>
                            
                            </div>
                      </div>
                      <div class="form-group col-md-6 p-3">
                        <label class="" for="option2">
                            @translate(Option#2) <span class="text-danger"></span></label>
                        <div class="">
                            <textarea
                                   id="option2"
                                   class="form-control ques-class @error('option4') is-invalid @enderror"
                                   name="option[]" placeholder="@translate(Enter option#2)" aria-required="true"
                                   >{{(!empty($option) && isset($option[1]))?$option[1]->option_title:''}}</textarea>
                            <select class="form-control" id="option2status" name="optionstatus[]">
                               
                            <option value="0" {{ (!empty($option) && isset($option[1])) && ($option[1]->flag_correct == '0')?'selected':'' }}>False</option>
                                <option value="1"  {{ (!empty($option) && isset($option[1])) && ($option[1]->flag_correct == '1')?'selected':'' }}>True</option>
                            </select>
                        
                        </div>

               
                      </div>
                    </div> 
                
                    
                    <div class="row">
                    <div class="form-group col-md-6 p-3">
                        <label class="" for="option3">
                            @translate(Option#3) <span class="text-danger"></span></label>
                        <div class="">
                            <textarea
                                   id="option3"
                                   class="form-control ques-class @error('option3') is-invalid @enderror"
                                   name="option[]" placeholder="@translate(Enter option#3)" aria-required="true"
                                   >{{(!empty($option) && isset($option[2]))?$option[2]->option_title:''}}</textarea>
                            <select class="form-control" id="option3status" name="optionstatus[]">
                            <option value="0" {{ (!empty($option) && isset($option[2])) && ($option[2]->flag_correct == '0')?'selected':'' }}>False</option>
                                <option value="1"  {{ (!empty($option) && isset($option[2])) && ($option[2]->flag_correct == '1')?'selected':'' }}>True</option>
                            </select>
                        
                        </div>

               
                      </div>
                      <div class="form-group col-md-6 p-3">
                        <label class="" for="option4">
                            @translate(Option#4) <span class="text-danger"></span></label>
                        <div class="">
                            <textarea
                                   id="option4"
                                   class="form-control ques-class @error('option4') is-invalid @enderror"
                                   name="option[]" placeholder="@translate(Enter option#4)" aria-required="true"
                                   >{{(!empty($option) && isset($option[3]))?$option[3]->option_title:''}}</textarea>
                            <select class="form-control" id="option4status" name="optionstatus[]">
                               
                            <option value="0" {{ (!empty($option) && isset($option[3])) && ($option[3]->flag_correct == '0')?'selected':'' }}>False</option>
                                <option value="1"  {{ (!empty($option) && isset($option[3])) && ($option[3]->flag_correct == '1')?'selected':'' }}>True</option>
                            </select>
                        
                        </div>

               
                      </div>
                    </div> 
                    <div class="row">
                    <div class="form-group col-md-6 p-3">
                        <label class="" for="option5">
                            @translate(Option#5) <span class="text-danger"></span></label>
                        <div class="">
                            <textarea
                                   id="option5"
                                   class="form-control ques-class @error('option5') is-invalid @enderror"
                                   name="option[]" placeholder="@translate(Enter option#5)" aria-required="true"
                                   >{{(!empty($option) && isset($option[4]))?$option[4]->option_title:''}}</textarea>
                            <select class="form-control" id="option5status" name="optionstatus[]">
                            <option value="0" {{ (!empty($option) && isset($option[4])) && ($option[4]->flag_correct == '0')?'selected':'' }}>False</option>
                                <option value="1"  {{ (!empty($option) && isset($option[4])) && ($option[4]->flag_correct == '1')?'selected':'' }}>True</option>
                            </select>
                        
                        </div>

               
                      </div>
                      <div class="form-group col-md-6 p-3">
                        <label class="" for="option6">
                            @translate(Option#6) <span class="text-danger"></span></label>
                        <div class="">
                            <textarea
                                   id="option6"
                                   class="form-control ques-class @error('option6') is-invalid @enderror"
                                   name="option[]" placeholder="@translate(Enter option#6)" aria-required="true"
                                   >{{(!empty($option) && isset($option[5]))?$option[5]->option_title:''}}</textarea>
                            <select class="form-control" id="option6status" name="optionstatus[]">
                               
                            <option value="0" {{ (!empty($option) && isset($option[5])) && ($option[5]->flag_correct == '0')?'selected':'' }}>False</option>
                                <option value="1"  {{ (!empty($option) && isset($option[5])) && ($option[5]->flag_correct == '1')?'selected':'' }}>True</option>
                            </select>
                        
                        </div>

               
                      </div>
                    </div> 
                    <div class="row">
                    <div class="form-group col-md-6 p-3">
                        <label class="" for="option7">
                            @translate(Option#7) <span class="text-danger"></span></label>
                        <div class="">
                            <textarea
                                   id="option7"
                                   class="form-control ques-class @error('option7') is-invalid @enderror"
                                   name="option[]" placeholder="@translate(Enter option#7)" aria-required="true"
                                   >{{(!empty($option) && isset($option[6]))?$option[6]->option_title:''}}</textarea>
                            <select class="form-control" id="option7status" name="optionstatus[]">
                            <option value="0" {{ (!empty($option) && isset($option[6])) && ($option[6]->flag_correct == '0')?'selected':'' }}>False</option>
                                <option value="1"  {{ (!empty($option) && isset($option[6])) && ($option[6]->flag_correct == '1')?'selected':'' }}>True</option>
                            </select>
                        
                        </div>

               
                      </div>
                      <div class="form-group col-md-6 p-3">
                        <label class="" for="option8">
                            @translate(Option#8) <span class="text-danger"></span></label>
                        <div class="">
                            <textarea
                                   id="option8"
                                   class="form-control ques-class @error('option8') is-invalid @enderror"
                                   name="option[]" placeholder="@translate(Enter option#8)" aria-required="true"
                                   >{{(!empty($option) && isset($option[7]))?$option[7]->option_title:''}}</textarea>
                            <select class="form-control" id="option8status" name="optionstatus[]">
                               
                            <option value="0" {{ (!empty($option) && isset($option[7])) && ($option[7]->flag_correct == '0')?'selected':'' }}>False</option>
                                <option value="1"  {{ (!empty($option) && isset($option[7])) && ($option[7]->flag_correct == '1')?'selected':'' }}>True</option>
                            </select>
                        
                        </div>

               
                      </div>
                    </div> 
</div>    
<div class="container">        
                <div class="row">
                <div class="form-group col-md-12 p-3">
                        <label class="" for="solution">
                            @translate(Solution) <span class="text-danger">*</span></label>
                        <div class="">
                            <textarea
                                   id="solution"
                                   class="form-control ques-class @error('solution') is-invalid @enderror"
                                   name="solution" placeholder="@translate(Enter Solution)" aria-required="true"
                                   >{{ $testquestion->solution }}</textarea>
                            @error('solution') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>

               
                      </div>
                                <div class="col-sm-12 text-center">  
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="example"></label>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn waves-effect waves-light btn-primary">Update</button>
                                        </div>
                                    </div>
                                    </div>
                                </div></div>
                            </form>
        </div>
    </div>

@endsection

@section('scripts')

@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
<script type='text/javascript'>
   
 $(document).ready(function(){
    $('#content_type').change(function(){
        var course_type = $("#course_type").val();
        if(course_type){
        $.ajax({
           type:"get",
           url:"{{url('dashboard/testquestions/catesByCourseType')}}/"+course_type,
           success:function(response)
           {      
              
            var optstring = '<option value="">Select</option>'+"\r\n";
            $(response.data).each(function(key,val){
                if(val.child.length!=0){
                    optstring += '<optgroup Label="'+val.name+'">';
                }else{
                    if(val.id!=78){
                    optstring += '<option value="'+val.id+'">'+val.name+'</option>'+"\r\n";
                    }
                }
                
                if(val.child.length!=0){
                    $(val.child).each(function(key1,val1){
                        optstring += '<option value="'+val1.id+'">'+val1.name+'</option>'+"\r\n";
                    });
                    optstring += '</optgroup>';
                }
            });
                $('#category_id').html(optstring); 
           }

        });
        }

    });


    $('#tag_id').change(function(){

var nid = $('#tag_id').val();

    $(".displayBlock").css("display", "none");
    $(".displayNone").css("display", "block");
    //displayNone displayBlock
    $.ajax({
    type:"get",
    url:"{{url('dashboard/testquestions/getQuestionTag')}}/"+nid,
    success:function(res)
    {       
        
            if(res)
            {
                $("#q_tag_type_id").empty();
                $("#q_tag_type_id").append('<option>Select Question Tag</option>');
                $.each(res,function(key,value){

                    $("#q_tag_type_id").append('<option value="'+key+'">'+value+'</option>');
                });
            }
    }

    });

});

    $('#ques_cat_id').change(function(){

        var nid = $('#ques_cat_id').val();
        if(nid=='1' || nid=='3')
        {  
            $(".displayBlock").css("display", "none");
            $(".displayNone").css("display", "block");
            //displayNone displayBlock
            $.ajax({
            type:"get",
            url:"{{url('dashboard/testquestions/getTagData')}}/"+nid,
            success:function(res)
            {       
                
                    if(res)
                    {
                        $("#tag_id").empty();
                        $("#tag_id").append('<option>Select Question Tag</option>');
                        $.each(res,function(key,value){

                            $("#tag_id").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
            }

            });
        } 
        else if(nid=='2')
        {
            $(".displayBlock").css("display", "block");
            $(".displayNone").css("display", "none");
            course_type = 'board';
            $.ajax({
                type:'POST',
                url:'{{ route("categoriesByCourseType") }}',
                headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{'course_type':course_type},
                success: function (response) {                    
                    var optstring = '<option value="">Select</option>'+"\r\n";
                    $(response.data).each(function(key,val){
                        if(val.child.length!=0)
                        {
                            if(val.name!='Blog')
                            {
                                optstring += '<optgroup Label="'+val.name+'">';
                            }
                        }else{
                            if(val.name!='Blog')
                            {
                                optstring += '<option value="'+val.id+'">'+val.name+'</option>'+"\r\n";
                            }
                        }
                        
                        if(val.child.length!=0){
                            $(val.child).each(function(key1,val1)
                            {
                                if(val1.name!='Blog')
                                {
                                    optstring += '<option value="'+val1.id+'">'+val1.name+'</option>'+"\r\n";
                                }
                            });
                            optstring += '</optgroup>';
                        }
                    });
                    $('#val-category_id').html(optstring);           
                }
            });

        }
        else
        {
            $(".displayBlock").css("display", "block");
            $(".displayNone").css("display", "none");

        }

    });

//Sub cat

$('#val-category_id').change(function(){

var category_id = $('#val-category_id').val(); 
//var competitive_courses = $('#package_type').val();
    var nid = $('#ques_cat_id').val();
    if(category_id && nid=='2'){
        $.ajax({
                type:"get",
                url:"{{url('dashboard/packagesettings/categoriesById')}}/"+category_id,
                success:function(res)
                {       
                    if(res)
                    {
                        $("#val-sub_category_id").empty();
                        $("#val-sub_category_id").append('<option>Select Sub Category</option>');
                        $.each(res,function(key,value){
                            $("#val-sub_category_id").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }

        });
    }

});


//Courses

    $('#val-sub_category_id').change(function(){
        var category_id = $('#val-sub_category_id').val();
        if(category_id){  
                $.ajax({
                        type:"get",
                        url:"{{url('dashboard/packagesettings/categoriesByQuestionCourseId')}}/"+category_id,
                        success:function(res)
                        {       
                            if(res)
                            {
                                $("#val-course_id").empty();
                                $("#val-course_id").append('<option>Select Subject</option>');
                                $.each(res,function(key,value){
                                    $("#val-course_id").append('<option value="'+key+'">'+value+'</option>');
                                });
                            }
                        }

                    });
            }

    });

//Chapter chapter_id


$('#val-course_id').change(function(){
        var course_id = $('#val-course_id').val();
        if(course_id){  
                $.ajax({
                        type:"get",
                        url:"{{url('dashboard/testquestions/courseById')}}/"+course_id,
                        success:function(res)
                        {     //console.log(res);  
                            if(res)
                            {
                                
                                var optstring = '<option value="">Select Unit</option>'+"\r\n";
                                $(res).each(function(key,val){
                                    if(val.contents.length!=0)
                                    {
                                        optstring += '<optgroup Label="'+val.title+'">';
                                    }else{
                                        optstring += '<option value="'+val.id+'">'+val.title+'</option>'+"\r\n";
                                    }

                                    if(val.contents.length!=0){
                                        $(val.contents).each(function(key1,val1)
                                        {                                           
                                            optstring += '<option value="'+val1.id+'-'+val.id+'">'+val1.title+'</option>'+"\r\n";
                                        });
                                        optstring += '</optgroup>';
                                    }
                                    console.log(val.title);

                                     
                                });
                                $('#val-unit_id').html(optstring);
                                // $("#val-unit_id").empty();
                                // $("#val-unit_id").append('<option>Select Unit</option>');
                                // $.each(res,function(key,value){
                                //     $("#val-unit_id").append('<option value="'+key+'">'+value+'</option>');
                                // });

                                // $("#val-unit_id").append('<option value="0">No Option</option>');

                            }
                        }

                    });
            }

    });

    


   });
   </script>
  
<script src="{{asset('assets/plugins/tinymce/tinymce4/tinymce.min.js')}}"></script>
<script async="" type="text/javascript" src="https://latex.codecogs.com/editor3.js"></script>

<script src="{{asset('assets/plugins/tinymce/tinymce4/plugins/tiny_mce_wiris/integration/WIRISplugins.js')}}"></script>
<script type="text/javascript">
var dir = 'ltr';

function example_image_upload_handler (blobInfo, success, failure, progress) {
  var xhr, formData;
  xhr = new XMLHttpRequest();
  xhr.withCredentials = false;
  xhr.open('POST', '{{ route('imageUpload') }}');
 // xhr.setRequestHeader : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};
  xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
  xhr.upload.onprogress = function (e) {
    progress(e.loaded / e.total * 100);
  };

  xhr.onload = function() {
    var json;

    if (xhr.status === 403) {
      failure('HTTP Error: ' + xhr.status, { remove: true });
      return;
    }

    if (xhr.status < 200 || xhr.status >= 300) {
      failure('HTTP Error: ' + xhr.status);
      return;
    }

    json = JSON.parse(xhr.responseText);

    if (!json || typeof json.location != 'string') {
      failure('Invalid JSON: ' + xhr.responseText);
      return;
    }

    success(json.location);
  };

  xhr.onerror = function () {
    failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
  };

  formData = new FormData();
  formData.append('file', blobInfo.blob(), blobInfo.filename());

  xhr.send(formData);
};

var dir = 'ltr';





tinymce.init({
            selector: "#questitle,#solution,#option1,#option2,#option3,#option4,#option5,#option6,#option7,#option8",            
            height : 300,
            //auto_focus:false,
            directionality : dir,
            menubar : 'table',

            plugins: ["eqneditor advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste","tiny_mce_wiris codesample", "advlist autolink lists link image code charmap preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media save table contextmenu directionality",
                "paste textcolor colorpicker textpattern"],    
            file_picker_types: 'image',      
            toolbar: 'undo redo | eqneditor | styleselect | bold italic | underline strikethrough  fontselect fontsizeselect formatselect | superscript subscript | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl,|,fullscreen,',
            wirisimagebgcolor: '#FFFFFF',
            wirisimagesymbolcolor: '#000000',
            wiristransparency: 'true',
            wirisimagefontsize: '16',
            wirisimagenumbercolor: '#000000',
            wirisimageidentcolor: '#000000',            
            setup : function(ed)
            {
                ed.on('init', function()
                {
                    this.getDoc().body.style.fontSize = '16px';
                    this.getDoc().body.style.fontFamily = 'Arial, "Helvetica Neue", Helvetica, sans-serif';
                });
            },
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/uploads',
            image_upload_base_path: 'https://olexpert.org.in',
            file_picker_types: 'image',
            relative_urls : false,
            file_picker_callback: function (cb, value, meta) {
                            var input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            input.setAttribute('accept', 'image/*');
                            input.onchange = function () {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.onload = function () {
                                var id = 'passage' + (new Date()).getTime();
                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(',')[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);
                                cb(blobInfo.blobUri(), { title: file.name });
                            };
                            reader.readAsDataURL(file);
                            };

                            input.click();
                        }, 

                        images_upload_handler: example_image_upload_handler

                        
        });


</script>
<script type="text/javascript" src="{{asset('assets/plugins/tinymce/js/prism.js')}}"></script>
    <script>
        "use strict"
        var count = 0;
        $('#add-answer').on('click', function () {
            count++;
            var clone = $(".answer-form-table tbody tr:first").clone();
            clone.attr({
                id: "emlRow_" + count,
            });
            clone.find(".remove").each(function () {
                $(this).attr({
                    id: $(this).attr("id") + count,
                });
            });

            $(".answer-form-table  tbody").append(clone);
        });

        function deleteTr(id) {
            $('#emlRow_' + id).remove();
        }
    </script>