@section('title','Add Mind Map')


<link rel="stylesheet" href="{{ asset('css/dropify.css') }}">

<form id="content_form" action="{{ route('mindmaps.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    {{-- Title --}}
    <input type="hidden" name="class_content_id" value="{{$contentId}}">
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

                <img class="w-100 source_code_preview rounded shadow-sm d-none" src="" alt="#Source code">
                <input type="hidden" name="source_code_url" class="source_code_url" value="">

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
            <input type="number" min="0" class="form-control @error('sequence') is-invalid @enderror" name="sequence"
                   placeholder="@translate(Enter sequence)" value="{old('sequence')}}" required>
           
        </div>
    </div>
    {{-- Submit button --}}
    <button type="submit" class="btn btn-primary float-left" id="mindmap_submit">
        @translate(Submit)
    </button>
</form>
{{-- Script --}}

<script src="{{ asset('js/dropify.js') }}"></script>
<script>
    $('.dropify').dropify();


    
</script>

<script type="text/javascript" src="{{ asset('assets/js/custom/class.js') }}"></script>



