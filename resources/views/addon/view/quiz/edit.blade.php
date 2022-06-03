<form action="{{route('quiz.update')}}" method="post"  enctype="multipart/form-data">
    <input name="id" type="hidden" value="{{$quiz->id}}">
    <input name="status" type="hidden" value="{{$quiz->status}}">
    @csrf
    <div class="row">
        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Assessment Name) <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" required
                       value="{{ $quiz->name }}"
                       class="form-control"
                       name="name" placeholder="@translate(Enter Assessment Name)" aria-required="true" autofocus>
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Assessment Time)(Minutes) Ex:10</label>
            <div class="">
                <input type="number"
                       value="{{$quiz->quiz_time}}"
                       class="form-control"
                       name="quiz_time" placeholder="@translate(Default infinity)" aria-required="true"
                       autofocus>
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Pass Mark)</label>
            <div class="">
                <input type="number" step="0.01" required
                       value="{{$quiz->pass_mark}}"
                       class="form-control"
                       name="pass_mark" placeholder="@translate(Pass Mark)" aria-required="true" autofocus>
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Number of attempts)</label>
            <div class="">
                <input type="number" step="1" required
                       value="{{$quiz->number_of_attempts}}"
                       class="form-control"
                       name="attempts" placeholder="@translate(Number of attempts)" aria-required="true" autofocus>
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="content-type-pop">@translate(Select Assesment For) </label>
            <div class="">
            <select class="form-control langr selectpicker" id="content-type-pop" name="content_type" autofocus required>
                <option value="" class="mb-2">
                @translate(Please select Content type)</option>
                <option value="board" {{ ($course_detail->content_type == 'board')?'selected':'' }}>Board</option>
                <option value="competitive-courses" {{ ($course_detail->content_type  == 'competitive-courses')?'selected':'' }}>Competitive Courses</option>
                <option value="free-study-material" {{ ($course_detail->content_type  == 'free-study-material')?'selected':'' }}>Free Study Material</option>
                <option value="current-affairs" {{ ($course_detail->content_type  == 'current-affairs')?'selected':'' }}>Current Affairs</option>                                        
                <option value="project-works" {{ ($course_detail->content_type  == 'project-works')?'selected':'' }}>Project Works</option>
            </select>
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-category_id_pop">
                @translate(Category)</label>
            <div class="">
                <select class="form-control lang @error('category_id') is-invalid @enderror selectpicker" id="val-category_id_pop" name="category_id" autofocus required>
                    <option value="" class="mb-2">
                    @translate(Please Category)</option>
                </select>
            </div>
        </div>

        <div class="form-group col-md-12 p-3 subcategory-show-pop" {{$category_detail->parent_category_id!=0?'style="display:none;"':''}}>
            <label class="" for="val-sub-category_id_pop">
                @translate(Sub Category)</label>
            <div class="">
            <select class="form-control lang @error('sub_category_id') is-invalid @enderror selectpicker" id="val-sub-category_id_pop" name="sub_category_id">
                    <option value="" class="mb-2">
                    @translate(Please Category)</option>
                </select>
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-course-pop">@translate(Select Course) </label>
            <div class="">
                <select class="form-control" id="val-course-pop" name="course_id" required>
                    <option value="">@translate(Select Course)</option>
                    @foreach($courses as $course)
                        <option value="{{$course->id}}" {{$quiz->course_id == $course->id ? 'selected' : null}}>{{$course->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>


    </div>
    <button class="btn btn-outline-success" type="submit"> @translate(Update)</button>
</form>
<script>
$(document).ready(function(){
    $.fn.getCourses = function(catId){
        $('#val-course-pop').html('<option value="">Please Select</option>'); 
        var selected_course = "{{$quiz->course_id}}";
        $.ajax({
            type:'POST',
            url:'{{ route("coursesByCategoryId") }}',
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{'catId':catId},
            success: function (response) {
                var optstring = '<option value="">Please Select</option>'+"\r\n";
                if(response.data.length!=0){
                    $(response.data).each(function(key,val){
                        var selected='';
                        if(selected_course==val.id){
                            selected = 'selected="selected"';
                        }
                        optstring += '<option value="'+val.id+'" '+selected+'>'+val.title+'</option>'+"\r\n";
                    });
                    $('#val-course-pop').html(optstring);
                } else{
                    console.log('No courses found');
                }         
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) 
            { 
                var msg=(JSON.parse(XMLHttpRequest.responseText).message);
            } 
        });
    }
    var course_type = "";
    var selected_category = "";
    @if($course_detail->content_type)
    var course_type = "{{$course_detail->content_type}}";
    var selected_category = "{{($category_detail->parent_category_id!=0)?$category_detail->parent_category_id:$category_detail->id}}";
    var selected_sub_category = "{{($category_detail->parent_category_id!=0)?$category_detail->id:''}}";
    @endif
    if(course_type!='')
    {
        $.ajax({
          type:'POST',
          url:'{{ route("categoriesByCourseType") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'course_type':course_type},
          success: function (response) {                    
            var optstring = '<option value="">Please Select</option>'+"\r\n";
            $(response.data).each(function(key,val){
               var selected='';
                if(selected_category==val.id){
                    selected = 'selected="selected"';
                }
                if(val.child.length!=0){
                    optstring += '<optgroup Label="'+val.name+'">';
                }else{
                    if(val.id!=78){
                        optstring += '<option value="'+val.id+'" '+selected+'>'+val.name+'</option>'+"\r\n";
                    }
                }
                
                if(val.child.length!=0){
                    $(val.child).each(function(key1,val1){
                        var selected='';
                        if(selected_category==val1.id){
                            selected = 'selected="selected"';
                        }
                        optstring += '<option value="'+val1.id+'" '+selected+'>'+val1.name+'</option>'+"\r\n";
                    });
                    optstring += '</optgroup>';
                }
            });
            console.log(optstring);
            $('#val-category_id_pop').html(optstring);           
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          { 
            var msg=(JSON.parse(XMLHttpRequest.responseText).message);
          } 
      });
    }
    if(selected_sub_category!='')
    {
        var catId = selected_category;
        var selected = '';     
        $.ajax({
            type:'POST',
            url:'{{ route("categoriesById") }}',
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{'catId':catId},
            success: function (response) {
                if(response.data.length!=0){
                    $('.subcategory-show-pop').show(); 
                    $("#val-sub-category_id_pop").prop('required',true);               
                    var optstring = '<option value="">Please Select</option>'+"\r\n";
                    $(response.data).each(function(key,val){
                        var selected='';
                        if(selected_sub_category==val.id){
                            selected = 'selected="selected"';
                        }
                        optstring += '<option value="'+val.id+'" '+selected+'>'+val.name+'</option>'+"\r\n";
                    });
                    console.log(optstring);
                    $('#val-sub-category_id_pop').html(optstring);
                } else{
                    $('.subcategory-show-pop').hide();
                    $("#val-sub-category_id_pop").prop('required',false);
                }         
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) 
            { 
                var msg=(JSON.parse(XMLHttpRequest.responseText).message);
            } 
        });
        $.fn.getCourses(selected_sub_category);
    }
});
$(document).on('change', '#val-category_id_pop', function(){    
    var catId = $(this).val(); 
    $('#val-sub-category_id').html('<option value="">Please Select</option>');
    $('#val-course-pop').html('<option value="">Please Select</option>');      
    $.ajax({
          type:'POST',
          url:'{{ route("categoriesById") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'catId':catId},
          success: function (response) {
            if(response.data.length!=0){
                $('.subcategory-show-pop').show(); 
                $("#val-sub-category_id_pop").prop('required',true);               
                var optstring = '<option value="">Please Select</option>'+"\r\n";
                $(response.data).each(function(key,val){
                    optstring += '<option value="'+val.id+'">'+val.name+'</option>'+"\r\n";
                });
                $('#val-sub-category_id_pop').html(optstring);
            } else{
                $.fn.getCourses(catId);
                $('.subcategory-show-pop').hide();
                $("#val-sub-category_id_pop").prop('required',false);
            }         
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          { 
            var msg=(JSON.parse(XMLHttpRequest.responseText).message);
          } 
      });
});
$(document).on('change', '#val-sub-category_id_pop', function(){ 
    var catId = $(this).val();
    $.fn.getCourses(catId);
});
$(document).on('change', '#content-type-pop', function(){    
    var course_type = $(this).val();
    $('#val-category_id_pop').html('<option value="">Please Select</option>');
    $('#val-sub-category_id_pop').html('<option value="">Please Select</option>');
    $('#val-course-pop').html('<option value="">Please Select</option>');
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
                $('#val-category_id_pop').html(optstring);           
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) 
            { 
                var msg=(JSON.parse(XMLHttpRequest.responseText).message);
            } 
        });
});
</script>