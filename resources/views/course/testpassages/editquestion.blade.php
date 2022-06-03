@extends('layouts.master')
@include('layouts.include.form.form_css')
@section('js-link')
    @include('layouts.include.form.form_js')
@stop
@section('content')
<!-- Tagsinput js -->
<script src="{{asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-tagsinput/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/custom-form-select.js')}}"></script>

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Edit Passage Question / #{{$testquestion->parent_id}} / #{{$ComprehensionQuestionId->id}}</h3>
            </div>
            
        </div>

        <div class="card-body">
            <form action="{{ route('testpassages.updatequestion',$ComprehensionQuestionId->id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$testquestion->id}}">
                <input type="hidden" name="qid" value="{{$ComprehensionQuestionId->id}}">
                @csrf
               
                      
                
                <div class="container"> 
                   
                    <div class="row">
                    
                        <div class="form-group col-md-12 p-3">
                            <label class="" for="question_title">
                                @translate(Question Title) <span class="text-danger">*</span></label>
                            <div class="">
                                <textarea
                                    id="question_title"
                                    class="form-control ques-class @error('question_title') is-invalid @enderror"
                                    name="question_title" placeholder="@translate(Enter Questions Title)" aria-required="true"
                                    >{{$ComprehensionQuestionId->body}}</textarea>
                                @error('question_title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                            </div>

                
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 p-3">
                            <label class="" for="option1">
                                @translate(Option#1) <span class="text-danger"></span></label>
                            <div class="">
                                <textarea
                                    id="option1"
                                    class="form-control ques-class @error('option1') is-invalid @enderror"
                                    name="option[]" placeholder="@translate(Enter option#1)" aria-required="true"
                                    >{{(!empty($option) && isset($option[0]))?$option[0]->option_title:''}}</textarea>
                                <select class="form-control" id="option1status" name="optionstatus[]">
                                    <option value="0" {{ (!empty($option) && isset($option[0])) && ($option[0]->flag_correct == '0')?'selected':'' }}>False</option>
                                    <option value="1" {{ (!empty($option) && isset($option[0])) && ($option[0]->flag_correct == '0')?'selected':'' }}>True</option>
                                </select>
                            
                            </div>

                
                        </div>
                        <div class="form-group col-md-6 p-3">
                            <label class="" for="option2">
                                @translate(Option#2) <span class="text-danger"></span></label>
                            <div class="">
                                <textarea
                                    id="option2"
                                    class="form-control ques-class @error('option2') is-invalid @enderror"
                                    name="option[]" placeholder="@translate(Enter option#2)" aria-required="true"
                                    >{{(!empty($option) && isset($option[1]))?$option[1]->option_title:''}}</textarea>
                                <select class="form-control" id="option2status" name="optionstatus[]">
                                
                                    <option value="0" {{ (!empty($option) && isset($option[1])) && ($option[1]->flag_correct == '0')?'selected':'' }}>False</option>
                                    <option value="1" {{ (!empty($option) && isset($option[1])) && ($option[1]->flag_correct == '0')?'selected':'' }}>True</option>
                                </select>
                            
                            </div>

                
                        </div>
                        </div> 

                        <div class="row">
                        <div class="form-group col-md-6 p-3">
                            <label class="" for="option3">
                                @translate(Option#3) <span class="text-danger"></span></label>
                            <div class="">
                                <textarea
                                    id="option3"
                                    class="form-control ques-class @error('option3') is-invalid @enderror"
                                    name="option[]" placeholder="@translate(Enter option#3)" aria-required="true"
                                    >{{(!empty($option) && isset($option[2]))?$option[2]->option_title:''}}</textarea>
                                <select class="form-control" id="option3status" name="optionstatus[]">
                                    <option value="0" {{ (!empty($option) && isset($option[2])) && ($option[2]->flag_correct == '0')?'selected':'' }}>False</option>
                                    <option value="1" {{ (!empty($option) && isset($option[2])) && ($option[2]->flag_correct == '0')?'selected':'' }}>True</option>
                                </select>
                            
                            </div>

                
                        </div>
                            <div class="form-group col-md-6 p-3">
                                <label class="" for="option4">
                                    @translate(Option#4) <span class="text-danger"></span></label>
                                <div class="">
                                    <textarea
                                        id="option4"
                                        class="form-control ques-class @error('option4') is-invalid @enderror"
                                        name="option[]" placeholder="@translate(Enter option#6)" aria-required="true"
                                        >{{(!empty($option) && isset($option[3]))?$option[3]->option_title:''}}</textarea>
                                    <select class="form-control" id="option4status" name="optionstatus[]">
                                    
                                        <option value="0" {{ (!empty($option) && isset($option[3])) && ($option[3]->flag_correct == '0')?'selected':'' }}>False</option>
                                        <option value="1" {{ (!empty($option) && isset($option[3])) && ($option[3]->flag_correct == '0')?'selected':'' }}>True</option>
                                    </select>
                                
                                </div>

                    
                            </div>

                            <div class="form-group col-md-6 p-3">
                                <label class="" for="option5">
                                    @translate(Option#5) <span class="text-danger"></span></label>
                                <div class="">
                                    <textarea
                                        id="option4"
                                        class="form-control ques-class @error('option4') is-invalid @enderror"
                                        name="option[]" placeholder="@translate(Enter option#5)" aria-required="true"
                                        >{{(!empty($option) && isset($option[4]))?$option[4]->option_title:''}}</textarea>
                                    <select class="form-control" id="option4status" name="optionstatus[]">
                                    
                                        <option value="0" {{ (!empty($option) && isset($option[4])) && ($option[4]->flag_correct == '0')?'selected':'' }}>False</option>
                                        <option value="1" {{ (!empty($option) && isset($option[4])) && ($option[4]->flag_correct == '0')?'selected':'' }}>True</option>
                                    </select>
                                
                                </div>

                    
                            </div>

                            <div class="form-group col-md-6 p-3">
                                <label class="" for="option6">
                                    @translate(Option#6) <span class="text-danger"></span></label>
                                <div class="">
                                    <textarea
                                        id="option6"
                                        class="form-control ques-class @error('option6') is-invalid @enderror"
                                        name="option[]" placeholder="@translate(Enter option#6)" aria-required="true"
                                        >{{(!empty($option) && isset($option[5]))?$option[5]->option_title:''}}</textarea>
                                    <select class="form-control" id="option4status" name="optionstatus[]">
                                    
                                        <option value="0" {{ (!empty($option) && isset($option[5])) && ($option[5]->flag_correct == '0')?'selected':'' }}>False</option>
                                        <option value="1" {{ (!empty($option) && isset($option[5])) && ($option[5]->flag_correct == '0')?'selected':'' }}>True</option>
                                    </select>
                                
                                </div>

                    
                            </div>

                        </div> 

                        <div class="row">
                    
                        <div class="form-group col-md-12 p-3">
                            <label class="" for="question_solution">
                                @translate(Solution) <span class="text-danger">*</span></label>
                            <div class="">
                                <textarea
                                    id="question_solution"
                                    class="form-control ques-class @error('question_solution') is-invalid @enderror"
                                    name="question_solution" placeholder="@translate(Enter Solution)" aria-required="true"
                                    >{{$ComprehensionQuestionId->solution}}</textarea>
                                @error('question_solution') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                            </div>

                
                        </div>
                    </div>

                </div>


                <div class="container">        
                    <div class="row">

                    <div class="form-group col-md-6 p-3">
                            <label class="" for="status">
                                @translate(Status) <span class="text-danger"></span></label>
                            <div class="">
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ ($ComprehensionQuestionId->status == '1')?'selected':'' }}>Active</option>
                                    <option value="0" {{ ($ComprehensionQuestionId->status == '0')?'selected':'' }}>In Active</option>
                                </select>
                            </div>

                
                        </div>
                        <div class="col-sm-12 text-center">  
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
<!-- END:content -->
    <div class="contentbar">
        <div class="card m-b-30">
            <h4 class="card-header">@translate(All Passage Question)</h4>
            <div class="card-body mx-3">
            <table class="table table-striped- table-bordered table-hover text-center">
                            <thead>
                            <tr>
                            <th>S.No.</th>
                                    <th>@translate(Question Name)</th>
                                    <th>@translate(Action)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($getData as  $item)
                            @if($item->parent_id != 0)
                                <tr>
                                    <td>{{$loop->index+1}}</td>

                                    <td>@php echo html_entity_decode($item->body)  @endphp</td>
                                    <!-- <td></td> -->


                                    <td>
                                    <div class="kanban-menu">
                                                        <div class="dropdown">
                                                            <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                                    id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                                            <div class="dropdown-menu dropdown-menu-right action-btn"
                                                                aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                                
                                                                <a class="dropdown-item" href="{{ route('testpassages.editquestion',$item->id) }}"
                                                                    >
                                                                    <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                                                <a class="dropdown-item"
                                                                onclick="confirm_modal('{{ route('testpassages.passagedelete', $item->id) }}')"
                                                                href="#!">
                                                                    <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                    </td>
                                </tr>
                                @endif
                            @empty

                                <tr></tr>

                                <tr>
                                    <td><h3 class="text-center">@translate(No Data Found)</h3></td>
                                </tr>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>

                            @endforelse
                            </tbody>
                        </table>
            </div>  <!-- End List section  -->
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
                $('#category_id').html(optstring); 
           }

        });
        }

    });


    $('#ques_cat_id').change(function(){
    var nid = $(this).val();
    if(nid){
       
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

tinymce.init({
            selector: "#questitle,#question_title,#question_solution,#option1,#option2,#option3,#option4,#option5,#option6",            
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