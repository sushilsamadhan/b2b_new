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
                <h3>Video Link Validation</h3>

            </div>
        </div>

            <div class="card-body">
            <form action="{{ route('incorrect_report.incorrectvideo') }}" method="POST" >
                @csrf
            <div class="container">                    
                <div class="row">                
                    <div class="form-group col-md-3 p-3">
                        <label class="" for="ques_cat_id">
                            @translate(Course Type) <span class="text-danger">*</span></label>
                        <div class="">
                        <select class="form-control langr selectpicker" id="ques_cat_id" name="ques_cat_id" required>
                        <option value=""> @translate(--- Please Select Course Type ---)</option>
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
                            Validate</button>
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
                                <th>@translate(Status)</th>
                                <th>@translate( Content Title)</th>
                                <th>@translate(Incorrect Video Link)</th>
                                <th>@translate(Action)</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                              @php
                                 $i = 0; 
                              @endphp

                            @foreach($courses as  $item)
                              @php
                                  $string = \App\Http\Controllers\DataAnalyticController::getAnalyticalCount($item->id);
                                  $allCounts = (explode('|',$string));
                              @endphp
                                <tr>
                                <td> {{++$i}} </td>
                                    <td>{{$item->course_title}}</td>
                                    <td> 
                                    @if ($item->is_demo==0)
                                         {{'Normal'}} 
                                     @else
                                     <span class="text-danger"> {{'Demo'}} </span>
                                     @endif
                                </td>
                              <td> {{$item->content_title}} </td> 
                                      
                              <td class="text-danger"> 
                                  @if ($item->video_url=='')
                                          {{'Not Available'}}
                                    @else
                                          {{$item->video_url}} 
                                  @endif
                               </td>
                               <td> <a href="#" data-link="{{ $item->video_url }}" data-id="{{ $item->id }}" class="text-secondary video_link" 
                                    class="text-secondary" data-toggle="modal" data-target="#exampleModal"> <i class="la la-pencil"></i>Edit </a></td>
                                </tr>
                                @endforeach 
                            </tbody>
                            @if(count($courses)>0)    
                            <div class="float-left">
                                {{--$courses->links()--}}
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
    
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Video Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('incorrect_report.update.link') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="form-group">
                <label>Video Link</label>  
                <input type="text" class="form-control" name="linkId" id="linkId" pattern="https://www.youtube.com/embed/.*" autocomplete="off" required>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter embed URL only.</div>
                <input type="hidden" class="form-control" name ="id" id="id">
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="btn_submit" class="btn btn-primary">Submit</button>
      </div>
        <span id="error_msg" class="text-danger"></span>
      </form>
    </div>
  </div>
</div>
<!-- End Modal -->

    <!-- END:content -->
@endsection
@section('js-link')

<script>
    $('.video_link').on('click',function(){
        var id = $(this).data('id');
        var link = $(this).data('link'); 
        $('#id').val(id);
        $('#linkId').val(link);  
    });
    $('#btn_submit').on('click',function(){
        var video_url = $('#linkId').val();
        var  pattern = "embed";
        var result = video_url.match(pattern);
        if (result== "") {
            $('#error_msg').html("Invalid Video URL!"); 
            return false;
        } 
    });
</script>

<script>
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type='text/javascript'>
   
 $(document).ready(function(){

    $('#ques_cat_id').change(function() { 
        var nid = $('#ques_cat_id').val();
        // alert (nid);

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


