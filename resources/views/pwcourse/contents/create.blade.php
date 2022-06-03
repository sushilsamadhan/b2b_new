<link rel="stylesheet" href="{{ asset('css/dropify.css') }}">

<form id="content_form" action="{{ route('pwcourse.contents.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    {{-- Title --}}
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="val-title">
            @translate(Title) <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="val-title" name="title"
                   placeholder="@translate(Enter Title)" required>
            @error('title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>
    {{-- Class --}}
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="val-Class">
            @translate(Class) <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            <select class="form-control @error('class_id') is-invalid @enderror" id="val-Class"
                    required name="class_id" aria-required="true">
                <option value="" name="class_id">
                    @translate(Select Class)
                </option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->title }}</option>
                @endforeach
            </select>
            @error('class_id') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
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
                    @translate(Select Content Type)
                </option>
                <option value="Video" id="youtube">
                    @translate(Video)
                </option>
                <option value="Document" id="document">
                    @translate(Document)
                </option>
            </select>
            @error('content_type') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>

    {{-- This Div will appear, if Content type is Selected --}}
    <div class="output">
        {{-- Video Url --}}
        <div id="Video" class="docs">
            {{-- provider --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-provider">
                    @translate(Provider)</label>
                <div class="col-lg-9">
                    <select class="form-control lang @error('provider') is-invalid @enderror" id="val-provider"
                            name="provider">
                        <option value="">
                            @translate(Select Provider)
                        </option>
                        <option value="Youtube">
                            @translate(Youtube)
                        </option>
                    </select>
                    @error('provider') <span class="invalid-feedback"
                                             role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-video_url">
                    @translate(Video File/Link)</label>
                <div class="col-lg-9">
                    <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="val-video_url"
                           name="video_url" placeholder="@translate(Enter Video Url Link)">

                   <video controls crossorigin playsinline id="player" class="w-100 video_file_preview rounded shadow-sm d-none" src=""></video>

                    <input type="hidden" name="video_raw_url" class="video_raw_url" value="">

                    @if (MediaActive())
                        {{-- media --}}
                        <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'file')"
                           class="btn btn-primary media-btn d-none mt-2 p-2">Upload From Media <i
                                class="fa fa-cloud-upload ml-2" aria-hidden="true"></i> </a>
                    @endif

                    @error('video_url') <span class="invalid-feedback"
                                              role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>

        </div>
        {{-- file --}}
        <div id="Document" class="docs">
            <div class="form-group row is-invalid">
                <label class="col-lg-3 col-form-label" for="val-file">File</label>
                <div class="col-lg-9">
                    <input type="file" class="form-control dropify @error('file') is-invalid @enderror" id="val-file"
                           name="file">
                    @error('file') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    
    {{--duriation--}}
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="val-title">
            @translate(Content duration) <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            <input type="number" min="0" class="form-control @error('duration') is-invalid @enderror" name="duration"
                   placeholder="@translate(Enter content duration in minutes)" required>
            @error('duration') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>

    {{-- Demo Type --}}
        
            
        <div class="form-group row">
        <label class="col-lg-3 col-form-label">Choose Demo Type</label>
            <label class="form-check form-check-inline">
                <input id="demoVideo" class="form-check-input" type="radio" name="demo_type"
                    value="video" {{ (old('demo_type') == 'video')?'checked':'' }}>
                <span class="form-check-label"> Video</span>
            </label>
            <label class="form-check form-check-inline">
                <input id="demoFile" class="form-check-input" type="radio" name="demo_type"
                    value="file" {{ (old('demo_type') == 'file')?'checked':'' }}>
                <span class="form-check-label"> Pdf</span>
            </label>
            <label class="form-check form-check-inline">
                <input id="demoType" class="form-check-input" type="radio" name="demo_type"
                    value="NULL" {{ (old('demo_type') == 'NULL')?'checked':'' }}>
                <span class="form-check-label">None</span>
            </label>
        
        </div> <!-- form-group end.// -->
                                               
        {{-- Demo Url --}}
        <div class="form-group row" id="demo_url">
        <label class="col-lg-3 col-form-label">Demo Url</label>
        <div class="col-lg-9">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                        </div>
                        <input type="text" id="val-demo_url" value="{{ old('demo_url') }}" name="demo_url" class="form-control @error('demo_url') is-invalid @enderror">
                          
                    </div>
                </div>
        </div>
        {{--Demo duriation--}}
    <div class="form-group row" id="demo_duration">
        <label class="col-lg-3 col-form-label" for="val-duration">
            @translate(Demo duration) <span class="text-danger"></span></label>
        <div class="col-lg-9">
            <input type="number" min="0" class="form-control @error('demo_duration') is-invalid @enderror" name="demo_duration"
                   placeholder="@translate(Enter content duration in minutes)" value="{old('demo_duration')}}">
           
        </div>
    </div>
    {{-- Submit button --}}
    <button type="submit" class="btn btn-primary float-left">
        @translate(Submit)
    </button>
</form>
{{-- Script --}}

<script src="{{ asset('js/dropify.js') }}"></script>
<script>
    $('.dropify').dropify();

    $(function () {
        $("#demoVideo, #demoFile, #demoType").click(function () {  
            if($("#demoVideo").prop("checked")){
                $("#demo_url").show();
                $("#demo_duration").show(); 
            }
            if($("#demoFile").prop("checked")){
                $("#demo_url").show();
                $("#demo_duration").show(); 
            }
            if($("#demoType").prop("checked")){
                $("#val-demo_url").val("");
                $("#val-demo_duration").val("");
                $("#demo_url").hide();
                $("#demo_duration").hide(); 
            }
        });
    });
</script>

<script type="text/javascript" src="{{ asset('assets/js/custom/class.js') }}"></script>



