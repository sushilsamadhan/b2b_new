<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="{{$instructor->url}}" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
</div>

<div class="live-classroom-div" style="max-width: 240px; margin: 20px auto;">
  <a onclick="Watchvaideo();"><img src="https://olexpert.org.in/public/asset_rumbok/new/images/live-class-room.png" style="width:100%;"/></a>

</div>

<script type="text/javascript">
function Watchvaideo(){
  // if( /Android/i.test(navigator.userAgent ) ) {
    // If the user is using an Android device.
    setTimeout(function () { window.location = "market://details?id=com.google.android.youtube"; }, 25);
    window.location = "vnd.youtube://www.youtube.com/watch?v=Ce3U6O-aqto";
  // }
}
</script>