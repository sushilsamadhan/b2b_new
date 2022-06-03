<div class="row my-2">
    <div class="col-md-9" id="myTab">
<?php
if(isset($_GET['page'])){
    if($_GET['page']==1){
        $to   = 1;
    }else{
        $to   = ($_GET['page']-1)*50;
    }
    if(count($docContents)==50){
        $from = ($_GET['page'])*50;
    }else{
        $from = $docContents->total();
    }
}else{
    $to   = 1;
    $from = count($docContents);
}
?>
                                    <p id="Showing_Of_Results">Showing {{$to}} - {{$from}} Of {{$docContents->total()}} Results</p>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-0">
            <div class="search__container">
                <input onkeyup="searchdata(this.value)" type="text" class="search__input" placeholder="Search">
                <div class="overflow-hidden search-list w-100">
                    <div id="appendSearchCart1"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active show">
        <div class="row" id="set-content-data">
            @foreach($docContents as $docContents_val)
            <div style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal" onclick="openYoutobeurl('{{$docContents_val->url}}','{{$docContents_val->title}}')" class="col-md-4 col-6 mb-3">
                <div class="product-grid3 mt-3 h-100 shadow-lg rounded">
                    <div class="product-image3">
                        @php
                            $video_id = explode("?v=", $docContents_val->url);
                            $video_id = $video_id[1];
                        @endphp
                        <img class="img-fluid" alt="{{$docContents_val->title}}" src="http://img.youtube.com/vi/{{$video_id}}/maxresdefault.jpg">
                        <span class="position-absolute video-link cursor-pointer">
                        <svg style="margin-left: 2px;" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" size="40" height="25" width="40" xmlns="http://www.w3.org/2000/svg">
                            <path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path>
                        </svg>
                        </span>
                    </div>
                    <div class="product-content pb-0"><b class="title cursor-pointer mb-0 pb-0" title="{{$docContents_val->title}}">{{$docContents_val->title}}</b></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="row w-100 mt-5">
    <div class="col-lg-12">
    
    {{$docContents->links()}}

    </div>
</div>