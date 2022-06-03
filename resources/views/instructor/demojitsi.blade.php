{{--@extends('rumbok.app')
@section('content')--}}
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" sizes="16x16" href="{{url('/')}}/public/uploads/site/dSVxgvji1yCtuqQGMdShUFSP34NnydGWbo49sVyQ.ico">

    <style type="text/css">
        iframe#jitsiConferenceFrame0 {
            height: 700px !important;
        }
        .watermark.leftwatermark{
            left: 32px;
            top: 32px;
            /*background-image: url(http://localhost/ole/public/uploads/site/wDJtujetIoeun969DW0jhsyw07HHJE8ijsSH0nwk.png) !important;*/
            background-position: center left;
            visibility: hidden;
            }
.button {
    background-color: red;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 0;
    cursor: pointer;
    position: absolute;
    right: 0;
}
    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body style="position:relative;">

<a href="{{url('my/tuition-close')}}/{{Request::segment(3)}}" class="button" style=" float: right; "><i class="fa fa-phone" aria-hidden="true"></i>
 Close</a>

{{-- <script src="{{url()}}public/asset_rumbok/new/js/external_api.js"></script> --}}

<script src="https://meet.jit.si/external_api.js"></script>
<script>
    const domain = 'meet.jit.si';
    const options = {
        roomName: '<?php echo "Name_Room_".substr(md5(Request::segment(3)), 0, 4); ?>',
        width: '100%',
        height: '100%',
        parentNode: undefined,
        userInfo: {
            // email: '<?php// echo "sg3613340@gmail.com"; ?>',
            displayName: '{{Auth::user()->name}}'
        },
        configOverwrite: {
            disableScreensharingVirtualBackground: true,
            requireDisplayName: true,
            doNotStoreRoom: true,
            disableModeratorIndicator: true,
            <?php if (Auth::user()->user_type == "Student") echo "
            disableDeepLinking: true,
            disableRemoteMute: true,
            remoteVideoMenu: {disableKick: true, disableGrantModerator: true},
            toolbarButtons: ['camera','chat','desktop','fullscreen','hangup',
            'microphone','profile','raisehand','select-background','settings','tileview','toggle-camera','videoquality','__end']
            ";
            ?>
        },
        interfaceConfigOverwrite: {
            OPTIMAL_BROWSERS: ['chrome','chromium','firefox'],
            MOBILE_APP_PROMO: false,
            DEFAULT_LOCAL_DISPLAY_NAME: 'Me',
            DISABLE_JOIN_LEAVE_NOTIFICATIONS: true,
            SHOW_CHROME_EXTENSION_BANNER: false,
            <?php if (Auth::user()->user_type == "Student") echo "SETTINGS_SECTIONS: ['devices','language','profile','sounds']"; ?>
        }
    }
    const api = new JitsiMeetExternalAPI(domain, options);
    api.executeCommand('subject', 'Live classroom');
</script>


</body>
</html>
{{--@endsection--}}  