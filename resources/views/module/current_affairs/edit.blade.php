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
    <h4 class="card-header">@translate(Add Current Affairs)</h4>
    <div class="card-body mx-3">
        <form action="{{ route('currentaffairs.edit',[$course->id,$course->slug]) }}" method="post"  enctype="multipart/form-data">
            @csrf     
            {{-- Category --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-category_id">
                    @translate(Category) <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        

                                    <select class="form-control lang @error('category_id') is-invalid @enderror "  name="category_id" autofocus required>
                                        @foreach(\App\Model\Category::Published()->where(['is_current_affairs'=>'1','parent_category_id'=>0])->get() as $category)
                                            <option value="{{$category->id}}" class="mb-2" {{$course->category_id == $category->id ? 'selected':null}}>
                                            {{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    </div>
                @error('category_id') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>
            
            <div class="form-group row affairs_date_div">
                <label class="col-lg-3 col-form-label" for="current_affairs_date">
                @translate(Date) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="date"
                           value="{{$course->course_date != '' ? date('Y-m-d',strtotime($course->course_date)):null}}"
                           class="form-control @error('current_affairs_date') is-invalid @enderror"
                           id="current_affairs_date" name="current_affairs_date" placeholder="@translate(Date)" aria-required="true" required>
                      @error('current_affairs_date') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
            </div>
            {{-- Course Title --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-title">
                    @translate(Subject Title) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="text" required
                           value="{{ $course->title }}"
                           class="form-control @error('title') is-invalid @enderror"
                           id="val-title" name="title" placeholder="@translate(Enter Subject Title)" aria-required="true" autofocus>
                      @error('title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
            </div>
            {{-- Slug --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-slug">
                    @translate(Slug) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="text"
                          required value="{{ $course->slug}}"
                           class="form-control @error('slug') is-invalid @enderror"
                           id="val-slug" name="slug" aria-required="true">
                    <span id="error_email"></span>
                    @error('slug') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
            </div>

            {{-- Content Type --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-Content">
                    @translate(Content Type) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select class="form-control @error('content_type') is-invalid @enderror" required id="val-Content"
                            name="content_type">
                        <option value="">
                            @translate(Select Provider)
                        </option>
                        <option value="Video" id="youtube" disabled>
                            @translate(Video)
                        </option>
                        <option value="Document" id="vimeo" selected>
                            @translate(Document)
                        </option>
                    </select>
                    @error('content_type') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>

            
            {{-- file --}}
        
            <div class="form-group row is-invalid">
                <label class="col-lg-3 col-form-label" for="val-file">File <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="file" class="form-control dropify @error('file') is-invalid @enderror" id="val-file"
                           name="file_name">
                    @error('file') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>
       
            

    

            {{-- Tags --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-tag">
                    @translate(Tags) </label>
                <div class="col-lg-9">
                    <div class="bootstrap-tagsinput">
                        <input type="text"  class="@error('tag') is-invalid @enderror" placeholder="@translate(Enter Tags)"   value="
                            @foreach(json_decode($course->tag) as $item)
                            {{$item}},
                            @endforeach" id="val-tag" name="tag" data-role="tagsinput">
                          @error('tag') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>
            </div>

            {{-- Free --}}
            <div class="form-group row free-hide">
                <label class="col-lg-3 col-form-label" for="">
                    @translate(Free Course)</label>
                <div class="col-lg-9">
                  <div class="switchery-list">
                      <input type="checkbox"   name="is_free" class="js-switch-success" id="val-is_free" {{ $course->is_free === 0 ? ' ' : 'checked' }}/>
                      @error('is_free') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                  </div>
                </div>
            </div>


            <div id="auto_hide">
                {{-- Price --}}
                <div class="form-group row free-hide">
                    <label class="col-lg-3 col-form-label">
                        @translate(Price?)</label>
                    <div class="col-lg-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" min="0" value="{{ $course->price}}" name="price" class="form-control @error('price') is-invalid @enderror">
                              @error('price') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>
                </div>
            </div>
                

            {{-- Meta Title --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-meta_title">
                    @translate(Meta Title)</label>
                <div class="col-lg-9">
                    <div class="bootstrap-tagsinput">
                        <input type="text"  placeholder="@translate(Enter Meta Title)" class=" @error('meta_title') is-invalid @enderror" id="val-meta_title" name="meta_title" data-role="tagsinput" value="
@foreach(json_decode($course->meta_title) as $item)
                            {{$item}},
                            @endforeach">
                          @error('meta_title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>
            </div>

            {{-- Meta Description --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-meta_description">
                    @translate(Meta Description)</label>
                <div class="col-lg-9">
                    <textarea id="val-meta_description" name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" data-role="tagsinput"> {!! $course->meta_description !!}</textarea>
                      @error('meta_description') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
            </div>

         
            {{-- Submit --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label"></label>
                <div class="col-lg-8">
                    <button type="submit" class="btn btn-primary">
                        @translate(Submit)</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- END:content -->
@endsection
@section('js-link')
@include('layouts.include.form.form_js')
<script>
$(document).on('change', '#val-category_id', function(){    
    var catId = $(this).val();        
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
$(document).on('change', '#content-type', function(){    
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
</script>
@stop
@section('page-script')
<script type="text/javascript" src="{{ asset('assets/js/custom/course.js') }}"></script>

@stop
