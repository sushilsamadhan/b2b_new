@section('title','Update Mind Map')


<link rel="stylesheet" href="{{ asset('css/dropify.css') }}">
<div id="mindMapForm" style="display:none;" >
<form id="content_form" action="{{ route('mindmaps.update') }}" method="post" enctype="multipart/form-data" >
    @csrf
    {{-- Title --}}
    <input type="hidden" name="class_content_id" value="{{$contentId}}">
    <input type="hidden" name="id" id="id" value="">
    <input type="hidden" name="course_id" id="course_id" value="">
    <input type="hidden" name="class_id" id="class_id" value="">
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="val-title">
            @translate(Mind Map Title) <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="val-mind_map_title" name="mind_map_title"
                   placeholder="@translate(Enter Mind Map Title)" required>
            @error('mind_map_title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>
    
    
    {{-- source_code --}}
    <div class="">
        <div class="form-group row is-invalid">
            <label class="col-lg-3 col-form-label" for="source_code">@translate(Source Code)</label>
            <div class="col-lg-9">

                <div id="imgSrc"></div>
                <input type="hidden" name="source_code_url" id="source_code_url" class="source_code_url" value="">

                @error('source_code') <span class="invalid-feedback"
                                            role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror

                @if (MediaActive())
                    {{-- media --}}
                    <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'source_code')"
                       class="btn btn-primary media-btn mt-2 p-2">Upload From Media <i class="fa fa-cloud-upload ml-2"
                                                                                       aria-hidden="true"></i> </a>
                @endif

            </div>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="val-sequence">
            @translate(Sequence) <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            <input type="number" min="0" class="form-control @error('sequence') is-invalid @enderror" name="sequence" id="sequence"
                   placeholder="@translate(Enter sequence)" value="{old('sequence')}}" required>
           
        </div>
    </div>
    {{-- Submit button --}}
    <button type="submit" class="btn btn-primary float-left" id="mindmap_submit">
        @translate(Update)
    </button>
</form>
</div>
{{-- Script --}}
<div class="card-body">
            <div class="table-responsive">
                <table class="table foo-filtering-table text-center">
                    <thead class="text-center">
                    <tr class="footable-header">
                        <th>
                            @translate(S/L)
                        </th>
                        <th>
                            @translate(Title)
                        </th>
                        <th>
                            @translate(Url)
                        </th>
                        <th>
                            @translate(Sequence)
                        </th>
                        <th>
                            @translate(Action)
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php  $i=1;  @endphp
                        @foreach($mindMap as $val)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$val->mind_map_title}}</td>
                                <td><img class="card-img avatar-xl" src="{{filePath($val->mind_map_file_url)}}" alt="#Source code"></td>
                                <td>{{$val->sequence}}</td>
                                <td><a class="dropdown-item font-13" id="mindMapEdit" onClick="mindMapEdit({{$val->id}})"
                                           href="#"><i class="feather icon-edit-1"></i>
                                           
                                        </a></td>
                            </tr>
                        @php  $i++;  @endphp
                    @endforeach
                    </tbody>
                    <div class="float-left">
                    </div>
                </table>
            </div>
        </div>
<script src="{{ asset('js/dropify.js') }}"></script>
<script>
    $('.dropify').dropify();

    function mindMapEdit(id)
    {

        $("#mindMapForm").css("display", "block");
          
        $.ajax({
                type:"get",
                url:"{{url('dashboard/mindmaps/getContentList')}}/"+id,
                success:function(res)
                {     
                    var json = $.parseJSON(res); 
                    //alert(json.id);  <div id="imgSrc"><img class="w-100 source_code_preview rounded shadow-sm d-none" src="" alt="#Source code" id="get_source_code_url"> 
                    if(res)
                    {
                        var filep = "https://ole.org.in/public/"+json.mind_map_file_url;
                         //   alert(filep);
                        $("#id").val(json.id);
                        $("#course_id").val(json.course_id);
                        $("#class_id").val(json.class_id);
                            $("#val-mind_map_title").val(json.mind_map_title);
                            $("#source_code_url").val(json.mind_map_file_url);
                            $("#sequence").val(json.sequence);
                            $('#imgSrc').html('<img src="'+filep+'" class="card-img avatar-xl" />');

                        
                    }
                }

        });
                    
    }
    //Courses
   
</script>

<script type="text/javascript" src="{{ asset('assets/js/custom/class.js') }}"></script>



