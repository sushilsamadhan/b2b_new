

<div class="card">

    <div class="text-center">
        @if (isset($each_contents->video_url))
            @if ($each_contents->provider === "Youtube")

                <iframe width="100%" height="315"
                        src="{{ Str::after($each_contents->video_url,'https://youtu.be/') }}"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            @elseif(($each_contents->provider === "Vimeo"))
                <iframe
                    src="https://player.vimeo.com/video/{{ Str::after($each_contents->video_url,'https://vimeo.com/') }}"
                    width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>

            @elseif(($each_contents->provider === "Live"))
                <a href="{{ filePath($each_contents->video_url) }}" target="_blank" title="Live Class URL">
                    <img src="{{ filePath('live.jpg') }}" class="w-100" alt="#Liveclass">
                </a>

            @elseif(($each_contents->provider === "File"))
                <video controls crossorigin playsinline id="player" class="w-100" src="{{ filePath($each_contents->video_url)  }}"></video>

            @else
                <video controls crossorigin playsinline id="player" class="w-100" src="{{ filePath($each_contents->video_url)  }}"></video>

            @endif

        @endif
        @if (isset($each_contents->file))
            <a href="{{ filePath($each_contents->file)  }}" target="_blank"><img class="card-img-top img-fluid file-type" src="{{ asset('asset_rumbok/images/file.png') }}" alt="{{$each_contents->title}}"></a>
        @endif
    </div>

    <div class="card-body">
        <h5 class="card-title font-18">@translate(Content Type): {{ $each_contents->content_type }} </h5>

        <h5 class="card-title font-18">{{$each_contents->content_type=='file'?'Video Duration':'File Duration'}} :{{duration($each_contents->duration)}}</h5>

        @if (isset($each_contents->video_url))
            <h5 class="card-title font-18">@translate(Provider): {{ $each_contents->provider }}</h5>
        @endif

        <h5 class="card-title font-18">@translate(Description):
          {!! $each_contents->description !!}
        </h5>

        @if (isset($each_contents->source_code))
            <h5 class="card-title font-18">@translate(Source Code): <a
                    href="{{ route('classes.contents.code',$each_contents->id) }}" class="btn-sm btn-primary"> <i
                        class="feather icon-download"></i> </a></h5>
        @else
            <h5 class="card-title font-18">@translate(Source Code): @translate(No source code available)</h5>
        @endif


       
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="title">
            @translate(Content Title) <span class="text-danger"></span></label>
        <div class="col-lg-9">
            <input type="hidden" id="contentId" name="contentId" value="{{$each_contents->id}}">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                   placeholder="@translate(Enter Content Title)" value="{{$each_contents->title}}" onchange="SetUpdate($(this).val());" >
             <span> <strong class="alert alert-success" id="successU"></strong> </span>
            
        </div>
    </div>
    </div>
</div>

<script>


function SetUpdate(Text){

    var title = Text;//$("#title").val();
    var contentId = $("#contentId").val();

    //alert(title+"=="+contentId);

    $.ajax({
            type:"get",
            data:{'contentId':contentId,
                    'title':title},
            url:"{{url('dashboard/class/content/updateTitle')}}",
            success:function(res)
            {     
               // alert(res);  
                $("#successU").html("Content title updated successfully.");
                
            }

    });
}

</script>