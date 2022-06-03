@extends('layouts.master')
@include('layouts.include.form.form_css')
@section('content')
<!-- Tagsinput js -->
<script src="{{asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-tagsinput/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/custom-form-select.js')}}"></script>
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Edit Notification</h3>
            </div>
        </div>
        <div class="card-body">
        {!! Form::model($slider, ['method' => 'PATCH','files' => 'true','enctype'=>'multipart/form-data','route' => ['admin-notification.update', $slider->id]]) !!}
                   
                             
                
        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">Title  <span class="validType">*</span></label>
                                          <div class="col-sm-6">
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $slider->title }}" placeholder="Title">
                                             @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">User <span class="validType">*</span></label>
                                            <div class="col-sm-6">
                                                <select class="form-control @error('user') is-invalid @enderror" name="user">
                                                    <option value="">Select User</option>
                                                    @foreach($users as $users)
                                                        <option value="{{ $users->id }}" {{ $users->id  == $slider->user_id ? 'selected' : ''}}>{{ $users->name }}</option>
                                                    @endforeach
                                                    </select>
                                                @error('user')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    </div>
                                      <!-- <div class="form-group row">
                                  <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                                  <div class="col-sm-6">
                                        <textarea type="text" class="form-control" id="description" name="description" placeholder="URL"></textarea>          
                                  </div>
                                </div> -->
                                <div class="form-group row">
                                          <label for="inputPassword" class="col-sm-2 col-form-label">Image <span class="validType">*</span></label>
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                          <div class="col-sm-6">
                                                <input type="file" class="form-control" id="" name="image" value="{{ $slider->image }}">
                                          </div>
                                        </div>
                                        @if($slider->image)
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="example"></label>
                                            <div class="col-sm-6">
                                                <img src="{{ asset('storage/'.$slider->image) }}" class="@error('image') is-invalid @enderror" alt="images" height="50" width="50">
                                            </div>
                                        </div>     
@endif

                    <div class="form-group row">
                        
                            <label for="inputPassword" class="col-sm-2 col-form-label">Description <span class="validType">*</span></label>
                                 
                        <div class="col-sm-10">
                            <textarea
                                   id="questitle"
                                   class="form-control ques-class @error('description') is-invalid @enderror"
                                   name="description" placeholder="@translate(Enter  description)" aria-required="true"
                                   >{{ $slider->description }}</textarea>
                            @error('description') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
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
            {!! Form::close() !!}
    </div>
</div>

@endsection

@section('scripts')

@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
<script type='text/javascript'>
   
   $(document).ready(function(){
      $('#content_type').change(function(){
          var course_type = $(this).val();
          if(course_type){
          $.ajax({
             type:"get",
             url:"{{url('dashboard/testquestions/catesByCourseType')}}/"+course_type,
             success:function(response)
             {      
                
              var optstring = '<option value="">Select</option>'+"\r\n";
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
                  $('#category_id').html(optstring); 
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
                               
                                var optstring = '<option value="">Select Unit</option>'+"\r\n";
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

  
     });
     </script>
  

<script src="{{asset('assets/plugins/tinymce/tinymce4/tinymce.min.js')}}"></script>
<script async="" type="text/javascript" src="https://latex.codecogs.com/editor3.js"></script>
  <script src="{{asset('assets/plugins/tinymce/tinymce4/plugins/tiny_mce_wiris/integration/WIRISplugins.js')}}"></script>
<script type="text/javascript">
var dir = 'ltr';

function example_image_upload_handler (blobInfo, success, failure, progress) {
  var xhr, formData;
  xhr = new XMLHttpRequest();
  xhr.withCredentials = false;
  xhr.open('POST', '{{ route('imageUpload') }}');
 // xhr.setRequestHeader : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};
  xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
  xhr.upload.onprogress = function (e) {
    progress(e.loaded / e.total * 100);
  };

  xhr.onload = function() {
    var json;

    if (xhr.status === 403) {
      failure('HTTP Error: ' + xhr.status, { remove: true });
      return;
    }

    if (xhr.status < 200 || xhr.status >= 300) {
      failure('HTTP Error: ' + xhr.status);
      return;
    }

    json = JSON.parse(xhr.responseText);

    if (!json || typeof json.location != 'string') {
      failure('Invalid JSON: ' + xhr.responseText);
      return;
    }

    success(json.location);
  };

  xhr.onerror = function () {
    failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
  };

  formData = new FormData();
  formData.append('file', blobInfo.blob(), blobInfo.filename());

  xhr.send(formData);
};

var dir = 'ltr';





tinymce.init({
            selector: "#questitle",            
            height : 300,
            //auto_focus:false,
            directionality : dir,
            menubar : 'table',

            plugins: ["tiny_mce_wiris codesample", "advlist autolink lists link image code charmap preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media save table contextmenu directionality",
                "paste textcolor colorpicker textpattern"],   
            file_picker_types: 'image',      
            toolbar: 'undo redo | bold italic underline strikethrough  fontselect fontsizeselect formatselect | superscript subscript | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl,|,tiny_mce_wiris_formulaEditor,tiny_mce_wiris_formulaEditorChemistry,|,fullscreen,',
            wirisimagebgcolor: '#FFFFFF',
            wirisimagesymbolcolor: '#000000',
            wiristransparency: 'true',
            wirisimagefontsize: '16',
            wirisimagenumbercolor: '#000000',
            wirisimageidentcolor: '#000000',            
            setup : function(ed)
            {
                ed.on('init', function()
                {
                    this.getDoc().body.style.fontSize = '16px';
                    this.getDoc().body.style.fontFamily = 'Arial, "Helvetica Neue", Helvetica, sans-serif';
                });
            },
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/uploads',
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                            var input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            input.setAttribute('accept', 'image/*');
                            input.onchange = function () {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.onload = function () {
                                var id = 'passage' + (new Date()).getTime();
                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(',')[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);
                                cb(blobInfo.blobUri(), { title: file.name });
                            };
                            reader.readAsDataURL(file);
                            };

                            input.click();
                        }, 

                        images_upload_handler: example_image_upload_handler

                        
        });


</script>
<script type="text/javascript" src="{{asset('assets/plugins/tinymce/js/prism.js')}}"></script>
    <script>
        "use strict"
        var count = 0;
        $('#add-answer').on('click', function () {
            count++;
            var clone = $(".answer-form-table tbody tr:first").clone();
            clone.attr({
                id: "emlRow_" + count,
            });
            clone.find(".remove").each(function () {
                $(this).attr({
                    id: $(this).attr("id") + count,
                });
            });

            $(".answer-form-table  tbody").append(clone);
        });

        function deleteTr(id) {
            $('#emlRow_' + id).remove();
        }
    </script>