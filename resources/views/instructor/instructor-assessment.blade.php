@extends('layouts.master')
@section('title','assessment')
@section('parentPageTitle', 'view')


@section('content')
    <!-- BEGIN:content -->

    <div class="card m-b-30">
    <div class="card-header">
            <div class="float-left">
                <h3>Assign Subject & Create Schedule</h3>
                
            </div>
            
        </div>
        <div class="card-body">
        <div class="container">
            <div class="col-md-12">
                                <form class="form-horizontal" action="{{ route('save-instructor-assessment') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                        <input type="hidden" name="id" value="{{ Request::segment(3) }}">
                        <div class="row col-md-12">
            <div class="col-md-3">
                        <div class="form-group col-md-12 p-3">
                            <label class="" for="package_type"> @translate(Course Type) <span class="text-danger">*</span></label>
                            <select class="form-control langr stpicker" id="package_type" name="package_type">
                                <option value=""> @translate(Please Select Course Type)</option>
                                <option value="board" {{ (old('package_type') == 'board')?'selected':'' }}>Board</option>
                                <option value="competitive-courses" {{ (old('package_type') == 'competitive-courses')?'selected':'' }}>Competitive Courses</option>
                            </select>
                        </div>
                       
                          
</div>
<div class="col-md-3">
{{-- Category --}}
                        <div class="form-group col-md-12 p-3">
                            <label class="" for="val-category_id">@translate(Board/Exam) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('category_id') is-invalid @enderror"
                                        id="val-category_id" name="category_id">
                                        <option value=""> @translate(Please Select)</option>
                                </select>
                            </div>
                        </div> 
                        </div>

                        <div class="col-md-3" id="showSbject"  style="display:none;">
{{-- Category --}}
                        <div class="form-group col-md-12 p-3">
                            <label class="" for="val-category_id">@translate(Subject) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('subject_id') is-invalid @enderror"
                                        id="subject_id" name="subject_id">
                                        <option value=""> @translate(Please Select)</option>
                               @foreach($competitiveSubjects as $competitivesubject)
                                <option value="{{ $competitivesubject->id }}"> {{ $competitivesubject->tag_name }}</option>
                               @endforeach
                                </select>
                            </div>
                        </div> 
                        </div>

                        <div class="col-md-3">
                    {{-- Sub Category --}}
                        <div class="form-group col-md-12 p-3" id="sub_category_id_display">
                            <label class="" for="val-sub_category_id">@translate(Class) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('sub_category_id') is-invalid @enderror"
                                        id="val-sub_category_id" name="sub_category_id">
                                        <option value=""> @translate(Please Select Classes)</option>
                                </select>
                            </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                    {{-- Subjects --}}
                        <div class="form-group col-md-12 p-3" id="board_view">
                            <label class="" for="val-course_id">@translate(Subject) <span class="text-danger"></span></label>
                            <div class="">
                                <select class="form-control langr @error('course_id') is-invalid @enderror"
                                        id="val-course_id" name="course_id">
                                        <option value=""> @translate(Please Select Subject)</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    </div>
                    <div class="col-sm-12 text-center">  
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="example"></label>
                            <div class="col-md-6">
                                <button type="submit" class="btn waves-effect waves-light btn-primary">Add Subject</button>
                            </div>
                        </div>
                    </div>


                    </form>
                </div>
            </div>
            <!-- End Row -->
    </div>
    <div class="card m-b-30 lcard-body">
    <div class="row flex-row">
                <div class="col-xl-12">
                    <!-- Begin Widget -->
                    <div class="widget has-shadow">
                        <div class="widget-body">
                            <div class="mt-5">
                            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                <th>No</th>
                                <th>Course type</th>
                                <th>Course Id</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($instructorAssessments as $key => $instructorAssessment)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                    @if($instructorAssessment->course_type == 'competitive-courses')
                                    Competitive Courses
                                    @else
                                    Board
                                    @endif
                                    </td>
                                    <td>{{ $instructorAssessment->name }}</td>
                                    <td>
                                    @if($instructorAssessment->subCat)
                                    {{ $instructorAssessment->subCat }}
                                    @else
                                    NA
                                    @endif
                                     </td>
                                     <td>
                                     @if($instructorAssessment->course_type == 'competitive-courses')
                                     @php $subjectName = App\QuestionTag::where('id' , $instructorAssessment->subject_id )->first(); @endphp
                                        @if($subjectName)
                                     {{ $subjectName->tag_name }}
                                     @endif
                                     @else
                                        {{ $instructorAssessment->title }}
                                     @endif   
                                     </td>
                                    <td>
                                        <a class="" href="{{ route('instructor-schedule',$instructorAssessment->id) }}">
                                            @translate(Add Schedule)</a>
                                            &nbsp;&nbsp;&nbsp;
                                        <a class="" href="{{ route('delete-instructor-subject', $instructorAssessment->id) }}"  onclick="return confirm('Are you sure you want to delete this subject?');">
                                            <i class="feather icon-trash mr-2"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            <tbody>
                            </table>
</div>
</div>
</div>  
</div>
</div> 
</div>           
    </div>
   
    <!-- END:content -->
@endsection
@section('page-script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type='text/javascript'>
    $(document).on('change', '#package_type', function(){    
    var course_type = $(this).val();
    //alert(course_type);
               
            $.ajax({
                type:'POST',
                url:'{{ route("categoriesByCourseType") }}',
                headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{'course_type':course_type},
                success: function (response) {                    
                    var optstring = '<option value="">Please Select</option>'+"\r\n";
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
        });
</script>

<script type='text/javascript'>
   
        $(document).ready(function() {
            $('#val-category_id').change(function() {
            var category_id = $('#val-category_id').val(); 
            var competitive_courses = $('#package_type').val();
            if(category_id && competitive_courses!='competitive-courses'){  
                $("#sub_category_id_display").css("display", "block");
                $("#board_view").css("display","block");
               
                
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
                }else{
                    $("#sub_category_id_display").css("display", "none");
                    $("#board_view").css("display","none");
                    $("#showSbject").css("display","block");
                    //alert()
                    
                    var categoryid = $('#val-category_id').val(); 
                    var course_type = $('#package_type').val();
                    $.ajax({
                            type:"get",
                            url:"{{url('dashboard/packagesettings/categoriesByCourseParentType')}}/"+categoryid,
                            success:function(res)
                            {     
                                  
                                if(res)
                                {
                                    $("#val-free_subject").empty();
                                    $("#val-free_subject").append('<option>Please Select</option>');
                                    $.each(res,function(key,value){
                                       // alert(value);
                                        $("#val-free_subject").append('<option value="'+key+'">'+value+'</option>');
                                    });
                                }
                            }

                        });
//===================
                }

            });


//Courses
$('#val-sub_category_id').change(function(){
            var category_id = $('#val-sub_category_id').val();
            if(category_id){  
            
                $.ajax({
                type:"get",
                url:"{{url('dashboard/packagesettings/categoriesByCourseId')}}/"+category_id,
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


    $('#val-course_id').change(function(){
        var course_id = $('#val-course_id').val();
        var category_id = $('#val-sub_category_id').val();

        if(course_id)
        {  
            var commnId = category_id+'_'+course_id;
            $.ajax({
                type:"get",
                url:"{{url('dashboard/packagesettings/categoriesByFreeCourseId')}}/"+commnId,
                success:function(res)
                {       
                    if(res)
                    {
                        $("#val-free_subject").empty();
                        $("#val-free_subject").append('<option>Select Free Subject</option>');
                        $.each(res,function(key,value)
                        {
                            $("#val-free_subject").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }

            });
        }

    });




//val-free_subject   val-category_id         
 });


</script>


@stop
