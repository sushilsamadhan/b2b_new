@extends('layouts.master')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-6">
                    <h3>Test Question Validation</h3>
                </div> 
            </div>
        </div>

        <div class="card-body">

        <form action="{{ route('incorrect_report.questionvalidation') }}" method="POST">
                                @csrf
             <div class="container">                    
                <div class="row">
                  
                    <div class="form-group col-md-3 p-3">
                        <label class="" for="ques_cat_id">
                            @translate(Course Type) <span class="text-danger">*</span></label>
                        <div class="">
                        <select class="form-control langr selectpicker" id="ques_cat_id" name="ques_cat_id" required>
                        <option value=""> @translate(Please Select Content Type)</option>
                        
                                @foreach ($queCat as $queCatVal)
                                <option value="{{$queCatVal->id}}"  class="mb-2">{{$queCatVal->category_type}}</option>
                                @endforeach
                            </select>
                        </div>

                
                    </div>
                <!----   Board Start   --->
                    {{-- Category --}}
                        <div class="form-group col-md-3 p-3 displayBlock">
                            <label class="" for="val-category_id">@translate(Board/Exam) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('q_cat_id') is-invalid @enderror"
                                        id="val-category_id" name="q_cat_id" required>
                                        <option value=""> @translate(Please Select)</option>
                                </select>
                            </div>
                    </div>   


                    {{-- Sub Category --}}
                        <div class="form-group col-md-3 p-3 displayBlock" id="sub_category_id_display">
                            <label class="" for="val-sub_category_id">@translate(Class) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('sub_cat_id') is-invalid @enderror"
                                        id="val-sub_category_id" name="sub_cat_id" required>
                                        <option value=""> @translate(Select Classes)</option>
                                </select>
                            </div>
                    </div>
                    
                    {{-- Subjects --}}
                        <div class="form-group col-md-3 p-3 displayBlock" id="course_id">
                            <label class="" for="val-course_id">@translate(Subject) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('course_id') is-invalid @enderror"
                                        id="val-course_id" name="course_id" required>
                                        <option value=""> @translate(Select Subject)</option>
                                </select>
                            </div>
                        </div>
                    <div class="form-group col-md-3 pb-3">
                         <label class=""></label>
                            <div class="">
                              <button type="submit" class="btn waves-effect waves-light btn-primary">Validate</button>
                            </div>
                            </div>
                    </div>

                      </div>
                    </div>
              </form>

            
              <div class="card-body">
                <div class="row ml-3 mb-3">
                    <h3> {{$board->name ?? ' '}}  {{$slash ?? ' '}} {{$class->name ?? ' '}}  {{$slash ?? ' '}} {{$course->title ?? ' '}}</h3>
                </div>
              @if(count($testquestions)>0)    
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Q.ID</th>
                        <th>Course Type</th>
                        <th>Subject</th>
                        <th style="width:30%">Title</th>
                        <th>Error</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                          @php $i = 0;  $error = '';  @endphp  

                    @foreach($testquestions as $key => $testquestion)
                        @php
                           $result = \App\Http\Controllers\IncorrectLinkController::getInvalidData($testquestion->id);
                            if($result==0 OR $result>1) {
                        @endphp     
                           
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $testquestion->id }}</td>
                                <td>{{ $testquestion->category_type }}<br>@php echo date('d, M-Y H:i',strtotime($testquestion->updated_at)); @endphp</td>
                                <td>{{ ($testquestion->coursesTitle!='')?$testquestion->coursesTitle:$testquestion->tag_name }}</td>
                                <td  style="width:30%"><?php echo html_entity_decode($testquestion->body)?>
                                    @if(isset($testquestion->q_tag))
                                            @foreach(json_decode($testquestion->q_tag) as $item)
                                                <span class="badge badge-secondary"> {{ $item }}</span>
                                            @endforeach
                                    @endif
                                </td>
                                <td class="text-danger"> Incorrect Option </td>
                                
                                <td>
                                    @if($testquestion->question_type=='Paragraph')
                                    <a class="dropdown-item" target="_blank" href="{{ route('testpassages.editpassage',$testquestion->id) }}">
                                        <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>

                                    @else
                                    <a class="dropdown-item" target="_blank" href="{{ route('testquestions.edit',$testquestion->id) }}">
                                        <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        @endif
                                    </div>

                                </td>
                            </tr>
                         @php
                           }           
                         @endphp 

                       
                    @endforeach
                 
                <tbody>
            </table> 
            @else
            <h4 class="text-center">{{'No Records Available'}}</h4>
            @endif
        </div>
          
        </div>
    </div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type='text/javascript'>
   
 $(document).ready(function(){
  
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
        if(nid=='1')
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
                        $("#val-sub_category_id").append('<option value="">Select Sub Category</option>');
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
                                $("#val-course_id").append('<option value="">Select Subject</option>');
                                $.each(res,function(key,value){
                                    $("#val-course_id").append('<option value="'+key+'">'+value+'</option>');
                                });
                            }
                        }

                    });
            }

    });

   });
   </script>
