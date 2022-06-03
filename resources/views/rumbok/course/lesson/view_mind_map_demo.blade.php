{{--@extends('rumbok.app')--}}



 <style>
   body {
    font-family: 'Roboto', sans-serif;
   }
.list-mindmaps {
    position: fixed;
    width: 100%;
    z-index: 1;
    margin: 7px 10px;
}
.list-mindmaps ul {
    margin: 0;
    padding: 20px 0;
    list-style: none;
    display: flex;
    width: 100%;
    flex-wrap: nowrap;
    flex-direction: row;
    white-space: nowrap;
    overflow-x: auto;
}   
.list-mindmaps ul li {
    display: inline;
    margin-right: 5px;
}
.list-mindmaps ul li a {
    text-decoration: none;
    padding: 5px 15px;
    background: #000;
    border-radius: 4px;
    display: block;
    font-size:13px;
    color: #fff;
}
.header-search1 form input {
    border: 1px solid #fad2a9;
    border-radius: 10px;
    width: 100%;
}

.header-search1 form button {
    color: #ffffff;
    background-color: #ffa02b;
    border: 0px 10px 10px 0px;
    padding: 12px 20px;
    border-radius: 0px 10px 10px 0px;
    position: absolute;
    bottom: 0px;
    right: 0px;
    border: none;
     margin: 20px 1px 76px -12px;
}
body, html, div {
  width:100%;
  padding:0;
  margin:0;
}
.home-slides-item {
  transform: rotate(0deg);
}
.list-mindmaps ul li a.active {
    background: #fd0000;
}
@media (max-width:991px) {
  .home-slides-item {
  transform: rotate(90deg);
}
}
.pinch-zoom-parent {
            height: 100vh;
            width: 100%;
        }
</style>
<!-- <link rel="stylesheet" href="{{asset('asset_rumbok/new/mind-map/css/example.css')}}" />
	<link rel="stylesheet" href="{{asset('asset_rumbok/new/mind-map/css/pygments.css')}}" />
	<link rel="stylesheet" href="{{asset('asset_rumbok/new/mind-map/css/easyzoom.css')}}" /> -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    {{--new design--}}

    <div class="list-mindmaps">
<ul>
<?php 
      $otherMindMapString = base64_encode(implode(',',$freshOtherMindMapArr));
      $cId = request()->segment(3);
?>
@foreach($getMinMaps as $valImg)
    <?php $classContent = \App\Model\ClassContent::find($valImg->class_content_id);?>
    <li><a href="{{route('lesson.view_mind_map_demo',[$valImg->class_content_id,$otherMindMapString])}}" class="{{$cId==$valImg->class_content_id?'active':''}}">{{$classContent->title}}</a></li>
@endforeach
  @foreach($otherMinMaps as $content)
    <?php $classContent = \App\Model\ClassContent::find($content->class_content_id);?>
    <li><a href="{{route('lesson.view_mind_map_demo',[$content->class_content_id,$otherMindMapString])}}" class="{{$cId==$content->class_content_id?'active':''}}">{{$classContent->title}}</a></li>
  @endforeach
</ul>
    </div>

    <!-- Course Category Section Starts -->
        <!-- Hero Banner Start -->
        <div class="page pinch-zoom-parent" >
        @foreach($getMinMaps as $valImg)
        <div class="pinch-zoom" style="padding-top:150px;">
            <img src="{{filePath($valImg->mind_map_file_url)}}" style="width:100%;" />
        </div>
        @endforeach
    </div>

        <a  onclick="window.history.go(-1); return false;" style="cursor: pointer; background:#000;color:#fff;font-size: 13px;font-weight:bold;text-align:center;display:block;padding: 0px 10px;text-decoration:none;position: fixed;z-index: 9999;top: 2px;left: 10px;border-radius: 3px;">Back</a>


  <script src="https://manuelstofer.github.io/pinchzoom/dist/pinch-zoom.umd.js"></script>
<script>
  var el = document.querySelector('.pinch-zoom');
      new PinchZoom.default(el, {});
</script>
