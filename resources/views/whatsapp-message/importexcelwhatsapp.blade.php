@extends('layouts.master')
@section('title','Send Whats app Message')
@section('content')
<style>
.radio-toolbar input[type="radio"] {
  display: none;
}
.radio-toolbar label {
display: inline-block;
    background-color: gray;
    padding: 10px 10px;
    font-family: Arial;
    font-size: 16px;
    cursor: pointer;
    color: white;
    margin-right: 14px;
    border-radius: 7px;
}
.radio-toolbar input[type="radio"]:checked+label {
  background-color: blue;
}
.checkedraam {
  color: orange;
}
</style>
<div class="card mx-2 mb-3">
    <div class="card-header">
        <div class="float-left">
            <h3>@translate(send What's app Message Using Excel Sheets)</h3>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{url('storage/app/public/asset_rumbok/whatsapp/sample')}}/sample-style-excel-sheets.xlsx" download>
				  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
				  Sample EXCEL Sheets
			</a>
            <a class="btn btn-success" href="{{url('dashboard/show-excel-files')}}">
				  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
				  Show EXCEL Sheets
			</a>
        </div>
    </div>
<div class="row ml-2">
	<div class="col-md-6">
		<p><b>Bold</b>: Place an asterisk on either side (*bold*).</p>
		<p><b>Italicize</b>: Place an underscore on either side (_italic_).</p>
		<p><b>Strikethrough</b>: Place a tilde on either side (~strikethrough~).</p>
		<p><b>Monospace</b>: Place three back ticks on either side (```monospace```).</p>
	</div>

	<div class="col-md-6">
		<img src="https://www.howtogeek.com/wp-content/uploads/2019/08/1-5.png?trim=1,1&bg-color=000&pad=1,1">
	</div>
</div>


    <div class="card-body table-responsive">
        <form class="row" action="{{route('send-whats-app-msg-using-excel')}}" method="post" enctype="multipart/form-data">
        	@csrf
		  <div class="mb-3 col-md-6">
		    <label class="form-label">Import Your Excel Sheet</label>
		    <input type="file" name="excelfile" class="form-control">
		  </div>
		  <div class="mb-3 col-md-6">
		    <label class="form-label">Import Your Excel Sheet</label>
		    <input type="text" name="excelfileuoloadname" class="form-control" placeholder="Please Enter Excel heading">
		  </div>

   <div class="radio-toolbar mb-3 col-md-12">
        <input onclick="workonMessage(this.value);" id="radio16" value="text" type="radio" name="workon" checked>
        <label for="radio16">Text Message</label>

        <input onclick="workonMessage(this.value);" id="radio18" value="image" type="radio" name="workon">
        <label for="radio18">Image Message</label>

        <input onclick="workonMessage(this.value);" id="radio19" value="video" type="radio" name="workon">
        <label for="radio19">Video Message</label>

        <input onclick="workonMessage(this.value);" id="radio110" value="audio" type="radio" name="workon">
        <label for="radio110">Audio Message</label> 

        <input onclick="workonMessage(this.value);" id="radio111" value="document" type="radio" name="workon">
        <label for="radio111">Document Message</label> 
    </div>
	<div class="mb-3 col-md-12">
		<div class="row" id="appendworkdata">
		  <div class="mb-3 col-md-12">
			<textarea required name="messageTotext" class="form-control" style=" height: 200px; " placeholder="Please Enter some text to send message"></textarea>
		  </div>
		</div>
	</div>
<div class="mb-3 col-md-12" id="fileappend"></div>
<input type="hidden" name="fileuploads" id="fileuploads" value="">
		  <div class="mb-3 col-md-12">
		        <button type="submit" class="btn btn-primary">Send <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
		  </div>
		</form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	function workonMessage(workval) {
		if(workval=="text"){
			$("#appendworkdata").html('<div class="mb-3 col-md-12"> <textarea required name="messageTotext" class="form-control" style=" height: 200px; " placeholder="Please Enter some text to send message"></textarea> </div>');
		}
		if(workval=="image"){
			var changework = "'image'";
			$("#appendworkdata").html('<div class="mb-3 col-md-6"> <input type="file" name="file_image" class="form-control" accept="image/*" onchange="UploadFiles('+changework+');" id="image"> </div> <div class="mb-3 col-md-6"> <textarea required name="caption_image" class="form-control" placeholder="Please Enter Image Full Caption"></textarea> </div>');
		}
		if(workval=="video"){
			var changework = "'video'";
			$("#appendworkdata").html('<div class="mb-3 col-md-6"> <input type="file" name="file_image" class="form-control" accept="video/mp4,video/x-m4v,video/*" onchange="UploadFiles('+changework+');" id="video"> </div> <div class="mb-3 col-md-6"> <input type="text" name="caption_image" class="form-control" placeholder="Please Enter Video Name"> </div>');		
		}
		if(workval=="audio"){
			var changework = "'audio'";
			$("#appendworkdata").html('<div class="mb-3 col-md-6"> <input type="file" name="file_image" class="form-control" accept=".mp3,audio/*" onchange="UploadFiles('+changework+');" id="audio"> </div> <div class="mb-3 col-md-6"> <input type="text" name="caption_image" class="form-control" placeholder="Please Enter Audio Name"> </div>');		
		}
		if(workval=="document"){
			var changework = "'document'";
			$("#appendworkdata").html('<div class="mb-3 col-md-6"> <input type="file" name="file_image" class="form-control" accept= "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*" onchange="UploadFiles('+changework+');" id="document"> </div> <div class="mb-3 col-md-6"> <input type="text" name="caption_image" class="form-control" placeholder="Please Enter Document Name"> </div>');		
		}
	}
///////////////////////////////////////////////////////////////////////
function UploadFiles(work){
	var form_data = new FormData();
   form_data.append('_token', '{{ csrf_token() }}');
   var totalfiles = document.getElementById(work).files.length;
   for (var index = 0; index < totalfiles; index++) {
	  form_data.append("files", document.getElementById(work).files[index]);
   } 
	$.ajax({
	  url: "{{url('dashboard/upload-files-send-whats-app-msg')}}",
	  data: form_data,
	  processData: false,
	  contentType: false,
	  type: 'POST',
	  success: function(data){
	  	$("#fileuploads").val(data);
		if  (work=="image") {
			$("#fileappend").html("<img src='"+data+"' style=' height: 200px; width: 200px; '>");
		}if (work=="video") {
			$("#fileappend").html('<video width="400" controls> <source src="'+data+'" type="video/mp4"> Your browser does not support HTML video. </video>');
		}if (work=="audio") {
			$("#fileappend").html('<audio controls> <source src="'+data+'" type="audio/mpeg"> Your browser does not support the audio element. </audio>');	
		}if (work=="document") {
			
		}
	  }
	});
}
</script>
@endsection