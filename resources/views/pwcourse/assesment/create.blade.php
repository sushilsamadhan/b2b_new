@extends('layouts.master')
@include('layouts.include.form.form_js')

@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Create Mock Test Master</h3>
            </div>
            
        </div>

        <div class="card-body">
            <form action="{{ route('mtestmasters.update',$moctestDetail->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$moctestDetail->id}}">
                <div class="container">   
                    <div class="row">
                    <div class="form-group col-md-3 p-3">
                            <label class="" for="test_type">
                                @translate(Test Type) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr selectpicker" id="test_type" name="test_type">
                                    <option value=""> @translate(Please Select Test Type)</option>
                                    <option value="Mock" {{ ($moctestDetail->test_type == 'Mock')?'selected':'' }}>Mock Test</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group col-md-3 p-3">
                            <label class="" for="test">
                                @translate(Test) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr selectpicker" id="test" name="test">
                                    <option value=""> @translate(Please Select Test)</option>
                                    <option value="Full" {{ ($moctestDetail->test == 'Full')?'selected':'' }}>Full</option>
                                </select>
                            </div>
                        </div>
                    <div class="form-group col-md-6 p-3">
                            <label class="" for="name">
                                @translate(Mock Test Name) <span class="text-danger">*</span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="text"  class="form-control langr" placeholder="@translate(Enter Mock Test Name)"  id="name" name="name" value="{{$moctestDetail->name?$moctestDetail->name:''}}">
                                </div>
                        </div>
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="course_type">
                                @translate(Content Type) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr selectpicker" id="course_type" name="course_type" readonly>
                                    <option value=""> @translate(Please Select Content Type)</option>
                                    <option value="project_work" {{ ($moctestDetail->course_type == 'project_work')?'selected':'' }}>Project Work</option>
                                </select>
                            </div>
                        </div>
                        {{-- Category --}}
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="val-category_id">
                                @translate(Category) <span class="text-danger">*</span></label>
                            <div class="">
                            <select class="form-control langr @error('category_id') is-invalid @enderror"
                                    id="val-category_id" name="category_id" readonly>
                                    <option value=""> @translate(Please Select  Category)</option>

                            </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="total_no_of_question">@translate(No. Of Question) <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="number"  class="form-control" placeholder="@translate(Enter No. Of Question)"  id="total_no_of_question" name="total_no_of_question" value="{{old('total_no_of_question')}}">
                            </div>
                        </div>
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="total_no_of_question">@translate(Total Time) (HH:MM) <span class="text-danger"></span></label>
                            <div class="">
                                <input type="text"  class="form-control" placeholder="HH:MM"  id="total_time" name="total_time" value="{{old('total_time')}}">
                            </div>
                        </div> 
                       
                        <div class="col form-group">
                                                        <label>Choose Status Type?</label>
                                                        <div class="form-group">
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status"
                                                                    value="0" {{ (old('status') == '0')?'checked':'' }}>
                                                                <span class="form-check-label"> Draft</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status"
                                                                    value="1" {{ (old('status') == '1')?'checked':'' }}>
                                                                <span class="form-check-label"> Publish</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status"
                                                                    value="2" {{ (old('status') == '2')?'checked':'' }}>
                                                                <span class="form-check-label"> Un-Publish</span>
                                                            </label>
                                                        </div> <!-- form-group end.// -->
                                                    </div> <!-- form-group end.// -->


                                                    <div class="col form-group">
                                                        <label>Choose Available Type?</label>
                                                        <div class="form-group">
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="available_on"
                                                                    value="0" {{ (old('available_on') == '0')?'checked':'' }}>
                                                                <span class="form-check-label"> Free</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="available_on"
                                                                    value="1" {{ (old('available_on') == '1')?'checked':'' }}>
                                                                <span class="form-check-label"> Paid</span>
                                                            </label>
                                                        
                                                        </div> <!-- form-group end.// -->
                                                    </div> <!-- form-group end.// -->
                                                </div>
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

                    <script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>

<script type='text/javascript'>
    $(document).ready(function(){
        var selected_category = '{{$moctestDetail->category_id}}';
        $.ajax({
          type:'POST',
          url:'{{ route("categoriesByCourseType") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'course_type':'project_work'},
          success: function (response) {                    
            var optstring = '<option value="">Please Select</option>'+"\r\n";
            $(response.data).each(function(key,val){
               var selected='';
                if(selected_category==val.id){
                    selected = 'selected="selected"';
                }
                if(val.child.length!=0){
                    optstring += '<optgroup Label="'+val.category_name+'">';
                }else{
                    optstring += '<option value="'+val.id+'" '+selected+'>'+val.category_name+'</option>'+"\r\n";
                }
                
                if(val.child.length!=0){
                    $(val.child).each(function(key1,val1){
                        var selected='';
                        if(selected_category==val1.id){
                            selected = 'selected="selected"';
                        }
                        optstring += '<option value="'+val1.id+'" '+selected+'>'+val1.category_name+'</option>'+"\r\n";
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
    $(document).on('change', '#course_type', function(){    
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
                        if(val.child.length!=0){
                            optstring += '<optgroup Label="'+val.category_name+'">';
                        }else{
                            optstring += '<option value="'+val.id+'">'+val.category_name+'</option>'+"\r\n";
                        }
                        
                        if(val.child.length!=0){
                            $(val.child).each(function(key1,val1){
                                optstring += '<option value="'+val1.id+'">'+val1.category_name+'</option>'+"\r\n";
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
</script>

                    @endsection

@section('scripts')

@endsection

