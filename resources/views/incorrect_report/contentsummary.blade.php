@extends('layouts.master')
@section('title','Course Index')
@section('parentPageTitle', 'All Course')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
    <!-- BEGIN:content -->
<div class="card">
    <div class="card-header">
            <div class="float-left">
                <h3>Content Summary</h3>
            </div>
        </div>


            <div class="card-body">
            <form action="{{ route('incorrect_report.contentsummary') }}" method="POST" >
                @csrf
            <div class="container">                    
                <div class="row">                
                    <div class="form-group col-md-3 p-3">
                        <label class="" for="ques_cat_id">
                            @translate(Course Type) <span class="text-danger">*</span></label>
                        <div class="">
                        <select class="form-control langr selectpicker" id="ques_cat_id" name="ques_cat_id" required>
                        <option value=""> @translate(---- Please Select Course Type ---)</option>
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
                                    <option value=""> @translate(--- Please Select ---)</option>
                            </select>
                        </div>
                        <input type="hidden" id="sel_board_name" name="sel_board_name"/>
                    </div>   


                    {{-- Sub Category --}}
                    <div class="form-group col-md-3 p-3 displayBlock" id="sub_category_id_display">
                        <label class="" for="val-sub_category_id">@translate(Class) <span class="text-danger">*</span></label>
                        <div class="">
                            <select class="form-control langr @error('sub_cat_id') is-invalid @enderror"
                                    id="val-sub_category_id" name="sub_cat_id" required>
                                    <option value=""> @translate(--- Select Classes ---)</option>
                            </select>
                        </div>
                        <input type="hidden" id="sel_class_name" name="sel_class_name"/>
                    </div>
                    
                    <div class="form-group col-md-3 p-4">
                        <label class=""></label>
                        <div class="">
                            <button type="submit" class="btn btn-primary">
                                Submit</button>
                        </div>
                    </div>
                </div> 
            </div> <!-- cotainer div-->
            </form>
            <!-- Course -->
           
            <div class="container">                    
                <div class="row">
                    @if($class_name) 
                        <div class="float-left">
                            <h3>{{$board_name}} / {{$class_name}}</h3>
                        </div>
                        @endif
                    <div class="card-body table-responsive">
                    @if(count($courses)>0)    

                        <table class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <th>S/L</th>
                                <th>@translate(Course Name)</th>
                                <th>@translate(Total Units)</th>
                                <th>@translate(Total Chapters)</th>
                                <th>@translate(Total Videos)</th>
                                <th>@translate(Total PDFs)</th>
                                <th>@translate(Total Mind Maps)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as  $item)
                    @php
                        $string = \App\Http\Controllers\DataAnalyticController::getAnalyticalCount($item->id);
                        $allCounts = (explode('|',$string));
                    @endphp
                                <tr>
                                    <td>{{ ($loop->index+1) + ($courses->currentPage() - 1)*$courses->perPage() }}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$allCounts[0]}}</td>
                                    <td>{{$allCounts[1]}}</td>
                                    <td>{{$allCounts[2]}}</td>
                                    <td>{{$allCounts[3]}}</td>
                                    <td>{{$allCounts[4]}}</td>
                                </tr>
                                @endforeach 
                            </tbody>
                            @if(count($courses)>0)    
                            <div class="float-left">
                                {{ $courses->links() }}
                            </div>
                            @endif
                        </table>
                        @else
                      
                            @if($board_name)
                            <h3 class="text-center">No Data Found</h3>
                            @endif
                         
                        @endif
                    </div>
                </div>
            </div>
            <!-- Course End-->
        </div>

           
    <!-- END:content -->
@endsection
@section('js-link')

<script>
    $(document).ready(function(){
    $('#courseId').change(function(){ 
        var cid = $(this).val();
        //alert(cid); exit;
        $('#id').val(cid);

    });
});


 </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type='text/javascript'>
   
 $(document).ready(function(){

    $('#ques_cat_id').change(function() { 
        var nid = $('#ques_cat_id').val();
        // alert (nid);

    // start
        //  if(nid=='1') {
        //     $(".displayBlock").css("display", "block");
        //     $(".displayNone").css("display", "none");
        //     course_type = 'competitive';
        //     $.ajax({
        //         type:'POST',
        //         url:'{{ route("categoriesByCourseType") }}',
        //         headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //         data:{'course_type':course_type},
        //         success: function (response) {                    
        //             var optstring = '<option value="">Select</option>'+"\r\n";
        //             $(response.data).each(function(key,val){
        //                 if(val.child.length!=0)
        //                 {
        //                     if(val.name!='Blog')
        //                     {
        //                         optstring += '<optgroup Label="'+val.name+'">';
        //                     }
        //                 }else{
        //                     if(val.name!='Blog')
        //                     {
        //                         optstring += '<option value="'+val.id+'">'+val.name+'</option>'+"\r\n";
        //                     }
        //                 }
                        
        //                 if(val.child.length!=0){
        //                     $(val.child).each(function(key1,val1)
        //                     {
        //                         if(val1.name!='Blog')
        //                         {
        //                             optstring += '<option value="'+val1.id+'">'+val1.name+'</option>'+"\r\n";
        //                         }
        //                     });
        //                     optstring += '</optgroup>';
        //                 }
        //             });
        //             $('#val-category_id').html(optstring);           
        //         }
        //     });
    // stop

        if(nid=='2') {
            $(".displayBlock").css("display", "block");
            $(".displayNone").css("display", "none");
            course_type = 'board';
            $.ajax({
                type:'POST',
                url:'{{ route("categoriesByCourseData") }}',
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
        } else {
            $(".displayBlock").css("display", "block");
            $(".displayNone").css("display", "none");
        }
    });

    //Sub cat

    $('#val-category_id').change(function(){ 
        var category_id = $('#val-category_id').val(); 
        var boardName =   $('#val-category_id').find('option:selected').text();
        $("#sel_board_name").val(boardName);
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
        var className =   $('#val-sub_category_id').find('option:selected').text();
        $("#sel_class_name").val(className);
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
                            $("#val-sub_category_id"). after( "<input type='hidden' name='item_id[]' value="+key+" />" );
                            $("#val-course_id").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }
            });
        }
    });


   });
</script>



@stop
@section('page-script')
@stop


