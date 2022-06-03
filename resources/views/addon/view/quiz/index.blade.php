@extends('layouts.master')
@section('title','Course Create')
@section('parentPageTitle', 'Course')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
    <!-- BEGIN:content -->
    <div class="card m-b-30">
        <h4 class="card-header">@translate(Create New Assessment)</h4>
        <div class="card-body mx-3">
            <form action="{{route('quiz.store')}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-title">
                            @translate(Assessment Name) <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" required
                                   value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" placeholder="@translate(Enter Assessment Name)" aria-required="true" autofocus>
                            @error('name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-title">
                            @translate(Quiz Time)(Minutes) Ex:10</label>
                        <div class="">
                            <input type="number"
                                   value=""
                                   class="form-control"
                                   name="quiz_time" placeholder="@translate(Default infinity)" aria-required="true"
                                   autofocus>
                        </div>
                    </div>

                    <div class="form-group col-md-6 p-3">
                        <label class="" id="content-type">
                            @translate(Select Assessment For ) <span class="text-danger">*</span></label>
                        <div class="">
                            <select class="form-control langr selectpicker" id="content-type" name="content_type" autofocus required>
                                <option value="" class="mb-2">
                                @translate(Please select Content type)</option>
                                <option value="board" {{ (old('content_type') == 'board')?'selected':'' }}>Board</option>
                                <option value="competitive-courses" {{ (old('content_type') == 'competitive-courses')?'selected':'' }}>Competitive Courses</option>
                                <option value="free-study-material" {{ (old('content_type') == 'free-study-material')?'selected':'' }}>Free Study Material</option>
                                <option value="current-affairs" {{ (old('content_type') == 'current-affairs')?'selected':'' }}>Current Affairs</option>                                        
                                <option value="project-works" {{ (old('content_type') == 'project-works')?'selected':'' }}>Project Works</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-category_id">
                            @translate(Category)</label>
                        <div class="">
                            <select class="form-control lang @error('category_id') is-invalid @enderror selectpicker" id="val-category_id" name="category_id" autofocus required>
                                <option value="" class="mb-2">
                                @translate(Please Category)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12 p-3 subcategory-show" style="display:none;">
                        <label class="" for="val-sub-category_id">
                            @translate(Sub Category)</label>
                        <div class="">
                        <select class="form-control lang @error('sub_category_id') is-invalid @enderror selectpicker" id="val-sub-category_id" name="sub_category_id">
                            <option value="" class="mb-2">
                            @translate(Please Category)</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-course">@translate(Select Course) </label>
                        <div class="">
                            <select class="form-control" id="val-course" name="course_id" required>
                                <option value="">@translate(Select Course)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-title">
                            @translate(Pass Mark)</label>
                        <div class="">
                            <input type="number" step="0.01" required
                                   value=""
                                   class="form-control"
                                   name="pass_mark" placeholder="@translate(Pass Mark)" aria-required="true" autofocus>
                        </div>
                    </div>

                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-attempts">
                            @translate(Number of attempts)</label>
                        <div class="">
                            <input type="number" step="1" required
                                   value=""
                                   class="form-control"
                                   name="attempts" placeholder="@translate(Number of attempts)" aria-required="true" autofocus>
                        </div>
                    </div>


                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-provider">
                            @translate(Status) </label>
                        <div class="">
                            <select class="form-control" name="status" required>
                                <option value="1">
                                    @translate(Active)
                                </option>
                                <option value="0">
                                    @translate(Deactivate)
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-outline-success" type="submit"> @translate(Submit)</button>
            </form>
        </div>
    </div>
    <!-- END:content -->
    @if(request()->is('dashboard/quiz/list'))
        <div class="card m-b-30">
            <h4 class="card-header">@translate(All Assessment)</h4>
            <div class="card-body mx-3">
                <table class="table table-striped- table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th>S/L</th>
                        <th>@translate(Name)</th>
                        <th>@translate(Course)</th>
                        <th>@translate(Quiz Time)</th>
                        <th>@translate(Pass Mark)</th>
                        <th>@translate(Number of attempts)</th>
                        <th>@translate(Status)</th>
                        <th>@translate(Action)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($quiz as  $item)
                        <tr>
                            <td>{{ ($loop->index+1) + ($quiz->currentPage() - 1)*$quiz->perPage() }}</td>

                            <td>{{$item->name}}</td>
                            <td>
                            <?php 
                                      $breadCrum = getCoursesBreadCrumb($item->course->id);
                                       printf("%s / %s",@$breadCrum[1],@$breadCrum[0]);
                            ?>   
                            {{' / '.$item->course->title ?? 'N/A'}}</td>
                            <td>{{$item->quiz_time ?? 'infinite'}} (Minutes)</td>
                            <td>{{$item->pass_mark ?? 'infinite'}}</td>
                            <td>{{$item->number_of_attempts ?? 'N/A'}}</td>

                            <td>
                                <div class="switchery-list">
                                    <input type="checkbox" data-url="{{route('quiz.published')}}"
                                           data-id="{{$item->id}}"
                                           class="js-switch-success"
                                           id="category-switch" {{$item->status == true ? 'checked' : null}} />
                                </div>
                            </td>

                            <td>
                                <div class="kanban-menu">
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                        <div class="dropdown-menu dropdown-menu-right action-btn"
                                             aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                            <a class="dropdown-item" href="{{ route('question.add', $item->id) }}">
                                                <i class="fa fa-question-circle mr-2"></i>@translate(Questions)</a>
                                            <a class="dropdown-item" href="{{ route('question.import', $item->id) }}">
                                                <i class="fa fa-upload mr-2"></i>@translate(Bulk Import)</a>
                                            <a class="dropdown-item" href="#!"
                                               onclick="forModal('{{ route('quiz.edit', $item->id) }}', '@translate(Assesment Edit)')">
                                                <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                            <a class="dropdown-item"
                                               onclick="confirm_modal('{{ route('quiz.delete', $item->id) }}')"
                                               href="#!">
                                                <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty

                        <tr></tr>
                        <tr></tr>
                        <tr>
                            <td><h3 class="text-center">@translate(No Data Found)</h3></td>
                        </tr>
                        <tr></tr>
                        <tr></tr>
                        <tr></tr>

                    @endforelse
                    </tbody>
                    <div class="float-left">
                        {{ $quiz->links() }}
                    </div>
                </table>
            </div>
        </div>
    @endif
@endsection
@section('js-link')
    @include('layouts.include.form.form_js')
@stop
@section('page-script')
    <script type="text/javascript" src="{{ asset('assets/js/custom/course.js') }}"></script>
    <script>
    $(document).ready(function(){
        $.fn.getCourses = function(catId){
            $('#val-course').html('<option value="">Please Select</option>'); 
            $.ajax({
                type:'POST',
                url:'{{ route("coursesByCategoryId") }}',
                headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{'catId':catId},
                success: function (response) {
                    var optstring = '<option value="">Please Select</option>'+"\r\n";
                    if(response.data.length!=0){
                        $(response.data).each(function(key,val){
                            optstring += '<option value="'+val.id+'">'+val.title+'</option>'+"\r\n";
                        });
                        $('#val-course').html(optstring);
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
    });
    $(document).on('change', '#content-type', function(){    
    var course_type = $(this).val();
    $('#val-category_id').html('<option value="">Please Select</option>');
    $('#val-sub-category_id').html('<option value="">Please Select</option>');
    $('#val-course').html('<option value="">Please Select</option>');
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
                $('#val-category_id').html(optstring);           
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) 
            { 
                var msg=(JSON.parse(XMLHttpRequest.responseText).message);
            } 
        });
});
$(document).on('change', '#val-category_id', function(){    
    var catId = $(this).val(); 
    $('#val-sub-category_id').html('<option value="">Please Select</option>');
    $('#val-course').html('<option value="">Please Select</option>');      
    $.ajax({
          type:'POST',
          url:'{{ route("categoriesById") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'catId':catId},
          success: function (response) {
            if(response.data.length!=0){
                $('.subcategory-show').show(); 
                $("#val-sub-category_id").prop('required',true);               
                var optstring = '<option value="">Please Select</option>'+"\r\n";
                $(response.data).each(function(key,val){
                    optstring += '<option value="'+val.id+'">'+val.name+'</option>'+"\r\n";
                });
                $('#val-sub-category_id').html(optstring);
            } else{
                $.fn.getCourses(catId);
                $('.subcategory-show').hide();
                $("#val-sub-category_id").prop('required',false);
            }         
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          { 
            var msg=(JSON.parse(XMLHttpRequest.responseText).message);
          } 
      });
});
$(document).on('change', '#val-sub-category_id', function(){ 
    var catId = $(this).val();
    $.fn.getCourses(catId);
});
    </script>
@stop
