@extends('layouts.master')
@include('layouts.include.form.form_css')
@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Add/Edit Questions</h3>
            </div>
        </div>
        <div class="card-body">
        <form action="{{ route('mtestquestions.create',$mocktestsection->id) }}" method="GET">


        @if($quesCat_id == '1')

@php $display = 'none'; @endphp

@else

@php $display = 'displayBlock'; @endphp

@endif

@if($quesCat_id == '2')

@php $displayB = 'none'; @endphp

@else

@php $displayB = 'block'; @endphp

@endif


                <div class="container">                    
                    <div class="row">
                        <div class="form-group col-md-12 p-3">
                            <label class="" for="name">
                                @translate(Mock Test Name) <span class="">:</span>{{$mocktestsection->name}}</label><br>
                                <label class="" for="name">
                                @translate(Section Name) <span class="">:</span>{{$mocktestsection->section_name}}</label><br>  
                                <label class="" for="name">
                                @translate(Total) <span class="">:</span>{{$mtQuestion}}</label>
                            </div>
                                                <div class="form-group col-md-3">
                                                <label class="" for="ques_cat_id">
                                                    @translate(Content Type) <span class="text-danger"></span></label>
                                                <div class="">
                                                    <select class="form-control langr selectpicker" id="ques_cat_id" name="ques_cat_id">
                                                    <option value="">--Select--</option>
                                                        <option value="2" {{ ($quesCat_id == '2')?'selected':'' }}>Board</option>
                                                        <option value="1" {{ ($quesCat_id == '1')?'selected':'' }}>Competitive Courses</option>
                                                    </select>
                                                </div>
                                            </div>


                                                    {{-- Category --}}
                                                <div class="form-group col-md-3 displayBlock" style="display:{{$display}}">
                                                    <label class="" for="val-category_id">@translate(Board/Exam) <span class="text-danger"></span></label>
                                                    <div class="">
                                                        <select class="form-control langr @error('q_cat_id') is-invalid @enderror"
                                                                id="val-category_id" name="q_cat_id">
                                                                <option value="">--Select--</option>
                                                                    @php $i=0; @endphp

                                                                        @foreach ($categories as $category)

                                                                            @if(count($category['child'])!=0)

                                                                                <optgroup Label="{{ $category->name }}">

                                                                            @else
                                                                                <option value="{{ $category->id }}" {{$category->id == $q_cat_id ? 'selected':''}}>{{ $category->name }}</option>
                                                                            @endif
                                                                        @if(count($category['child'])!=0)
                                                                            @php $j=0; @endphp

                                                                                @foreach($category['child'] as $val)

                                                                                    <option value="{{ $val->id }}" {{$val->id == $q_cat_id ? 'selected':''}}>{{ $val->name }}</option>
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
                                                <div class="form-group col-md-3 displayBlock" id="sub_category_id_display" style="display:{{$display}}">
                                                    <label class="" for="val-sub_category_id">@translate(Class) <span class="text-danger"></span></label>
                                                    <div class="">
                                                        <select class="form-control langr @error('sub_cat_id') is-invalid @enderror"
                                                                id="val-sub_category_id" name="sub_cat_id">
                                                                <option value="">--Select--</option>
                                                                @foreach($subCatdetail as $subCat)
                                                                    <option value="{{$subCat->id}}" {{ ($subCat->id == $sub_cat_id)?'selected':'' }}>{{$subCat->name}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                            </div>
                                            
                                            {{-- Subjects --}}
                                                <div class="form-group col-md-3 displayBlock" id="course_id" style="display:{{$display}}">
                                                    <label class="" for="val-course_id">@translate(Subject) <span class="text-danger"></span></label>
                                                    <div class="">
                                                        <select class="form-control langr @error('course_id') is-invalid @enderror"
                                                                id="val-course_id" name="course_id">
                                                                <option value="">--Select--</option>
                                                                @foreach($courses_detail as $courseVal)
                                                                    <option value="{{$courseVal->id}}" {{ ($courseVal->id == $course_id)?'selected':'' }}>{{$courseVal->title}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                            </div>

                                           


                                                        {{-- Subject --}}
                                                        <div class="form-group col-md-3 displayNone" style="display:{{$displayB}}">
                                                                <label class="" for="tag_id">
                                                                    @translate(Question Subject) <span class="text-danger"></span></label>
                                                                <div class="">
                                                                    <select class="form-control langr selectpicker" id="tag_id" name="tag_id">
                                                                    <option value="">--Select--</option>
                                                                            @php if(!empty($questionTag)){   @endphp
                                                                               @foreach($questionTag as $valTag)         
                                                                                    <option value="{{$valTag->id}}" {{ ($valTag->id == $catId)?'selected':'' }}>{{$valTag->tag_name}}</option>
                                                                                @endforeach
                                                                           
                                                                           @php } @endphp     
                                                                    </select> 
                                                               </div>
                                                        </div>

                                                        <div class="form-group col-md-3 displayNone" style="display:{{$displayB}}">
                                                            <label class="" for="q_tag_type_id">
                                                                @translate(Question Tag ) <span class="text-danger"></span></label>
                                                            <div class="">
                                                                <select class="form-control langr selectpicker" id="q_tag_type_id" name="q_tag_type_id">
                                                                <option value="">--Select--</option>
                                                                        @php if(!empty($questionTagType)){   @endphp
                                                                               @foreach($questionTagType as $valTagType)         
                                                                                    <option value="{{$valTagType->id}}" {{ ($valTagType->id == $q_tag_type_id)?'selected':'' }}>{{$valTagType->tag_name}}</option>
                                                                                @endforeach
                                                                           
                                                                           @php } @endphp  
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                                <label class="" for="">
                                                                    &nbsp;<span class="text-danger"></span></label>
                                                                <div class="">
                                                                <button class="btn btn-secondary" onclick="searchRecord()">Filter</button> <a href="{{ route('mtestquestions.create',$mocktestsection->id) }}" class="btn btn-secondary">Reset</a>    
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
            </form>                                    
            <form action="{{ route('mtestquestions.store',$mocktestsection->id) }}" method="POST">
                @csrf                                    
                <div class="container">                    
                    <div class="row">

                        <table class="table table-success table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th hidden> </th>
                                    <th>Question</th>
                                    <th>Question Type</th>
                                    <th>Status</th>
                                    <th><input type="checkbox" id="checkAll" /> 
</th>
                                </tr>
                            </thead>
                          
                            <tbody id="myTable">
                             @php $j=0;@endphp 
                          
                            @foreach($studentestquestions as  $item)
                           
                            @php    
                            
                            $content = html_entity_decode($item->body);
                            $content = preg_replace("/<img[^>]+\>/i", " ", $content); 
                            

                            if($item->question_type=='1')
                                            {
                                                $question_type = 'Single Selection';
                                            }
                                            else if($item->question_type=='2')
                                            {
                                                $question_type = 'Multiple Selection';
                                            } 
                                            else if($item->question_type=='3')
                                            {
                                                $question_type = 'Paragraph';
                                            } 
                                            else
                                            {
                                                $question_type = '';
                                            }    

                            @endphp
                            @php  $findmocksection= 0; @endphp
                            @if($item->question_type == 3 &&  $item->parent_id == 0)
                                @php   
                                    $getQuestions = \App\StudentTestQuestion::where(['parent_id' => $item->id ,'status' => '1'])->first();
                                    if($getQuestions) {
                                        $findmocksection = \App\MockTestSectionQuestion::where(['mock_test_section_id'=> $mocktestsection->id, 'student_test_question_id' => $getQuestions->id, 'question_type' => 3, 'status' => '1'])->count(); 
                                    }
                                @endphp
                            @endif
                             @if( $item->question_type == 1 || ($item->question_type == 3 &&  $item->parent_id == 0 && $findmocksection == 0) )
                            
                                <tr>
                                    <td>{{ ++$i}}</td>
                                    <td hidden>{{$item->tag_name}}</td>
                                    <td width="70%">
                                        <input class="form-control" type="hidden" value="{{ $mocktestsection->mock_test_master_id }}" name="mock_test_master_id">
                                        <input class="form-control" type="hidden" value="{{ $mocktestsection->id }}" name="mock_test_section_id">
                                        <input class="form-control" type="hidden" value="{{ $item->question_type }}" name="question_type[]">
                                        
                                        @php echo  $content;@endphp
                                     </td>
                                     <td>{{$question_type}}</td>
                                    <td>
                                        <select class="form-control selectpicker" id="status" name="status[]">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </td>
                                    <td><input class="form-input-check chk" type="checkbox" value="{{$item->id}}" @php if(in_array($item->id,$mtQuestionInArrayData)){echo 'checked="checked"';} @endphp name="student_test_question_id[]"></td>
                                </tr>
                                @endif
                                @php   $j++;  @endphp
                                @endforeach
                            <tbody>
                        </table> <div class="float-left">
                        {{ $studentestquestions->links() }}
                    </div>
                    </div>
                </div>     
                <div class="container">   
                    <div class="row">
                        <div class="col-sm-12 text-center">  
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="example"></label>
                                <div class="col-md-6">
                                    <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type='text/javascript'>
     $(document).ready(function(){
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
                $("#tag_id").append('<option value="">--Select--</option>');
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
            var optstring = '<option value="">--Select--</option>'+"\r\n";
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
                        $("#val-sub_category_id").append('<option value="">--Select--</option>');
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
                                $("#val-course_id").append('<option value="">--Select--</option>');
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
                                
                                var optstring = '<option value="">--Select--</option>'+"\r\n";
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
                                    $("#q_tag_type_id").append('<option value="">--Select--</option>');
                                    $.each(res,function(key,value){

                                        $("#q_tag_type_id").append('<option value="'+key+'">'+value+'</option>');
                                    });
                                }
                        }

         });

});

 });


 $(document).ready(function () {
      $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
      });
      $('.chk').on('click', function () {
        if ($('.chk:checked').length == $('.chk').length) {
          $('#checkAll').prop('checked', true);
        } else {
          $('#checkAll').prop('checked', false);
        }
      });
    });
</script>
@endsection

@section('scripts')

@endsection


