@extends('layouts.master')
@include('layouts.include.form.form_css')
@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Update Project Class work</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('projectworkclasses.update',$projectworkclass->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$projectworkclass->id}}">
                <div class="container">   
                    <div class="row">
                        <div class="accordion" style="width:100% !important;">
                            <div class="card">
                                
                                        <div class="card-body">
                                            <div class="container">                    
                                                <div class="row">

                                                <div class="form-group col-md-6 p-3">
                                                    <label class="" for="class_title">
                                                        @translate(Class Name) <span class="text-danger">*</span></label>
                                                    <div class="">
                                                    <input type="text"  class="form-control langr" placeholder="@translate(Enter Class Name)"  id="class_title" name="class_title" value="{{$projectworkclass->title}}">

                                                    </div>
                                                </div>


                                                <div class="form-group col-md-6 p-3">
                                                    <label class="" for="test">
                                                        @translate(Status) <span class="text-danger">*</span></label>
                                                    <div class="">
                                                        <select class="form-control langr selectpicker" id="status" name="status">
                                                            <option value=""> @translate(Please Select Status)</option>
                                                            <option value="1" {{ ($projectworkclass->status == '1')?'selected':'' }}>Active</option>
                                                            <option value="0" {{ ($projectworkclass->status == '0')?'selected':'' }}>In-Active</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                </div>
                                            </div><!-- Container end.// -->
                                        </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
                <div class="container">   
                    <div class="row">
                        <div class="col-sm-4 text-center">  
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="example"></label>
                                <div class="col-md-6">
                                    <button type="submit" class="btn waves-effect waves-light btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

        
    </div>
    
</div>

@endsection

@section('scripts')

@endsection

<style>
    .bs-example{
        margin: 20px;
    }
    .accordion .fa{
        margin-right: 0.5rem;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    // $(document).ready(function(){
    //     // Add minus icon for collapse element which is open by default
    //     $(".collapse.show").each(function(){
    //     	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
    //     });
        
    //     // Toggle plus minus icon on show hide of collapse element
    //     $(".collapse").on('show.bs.collapse', function(){
    //     	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
    //     }).on('hide.bs.collapse', function(){
    //     	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
    //     });
    // });
</script>
<script type='text/javascript'>
    // $(document).on('change', '#course_type', function(){    
    // var course_type = $(this).val();
               
    //         $.ajax({
    //             type:'POST',
    //             url:'{{ route("categoriesByCourseType") }}',
    //             headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //             data:{'course_type':course_type},
    //             success: function (response) {                    
    //                 var optstring = '<option value="">Please Select</option>'+"\r\n";
    //                 $(response.data).each(function(key,val){
    //                     if(val.child.length!=0){
    //                         optstring += '<optgroup Label="'+val.name+'">';
    //                     }else{
    //                         optstring += '<option value="'+val.id+'">'+val.name+'</option>'+"\r\n";
    //                     }
                        
    //                     if(val.child.length!=0){
    //                         $(val.child).each(function(key1,val1){
    //                             optstring += '<option value="'+val1.id+'">'+val1.name+'</option>'+"\r\n";
    //                         });
    //                         optstring += '</optgroup>';
    //                     }
    //                 });
    //                 $('#val-category_id').html(optstring);           
    //             },
    //             error: function(XMLHttpRequest, textStatus, errorThrown) 
    //             { 
    //                 var msg=(JSON.parse(XMLHttpRequest.responseText).message);
    //             } 
    //         });
    //     });
</script>