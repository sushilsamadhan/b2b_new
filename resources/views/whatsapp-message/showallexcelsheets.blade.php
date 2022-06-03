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
            <h3>@translate(What's app Message Excel Sheets)</h3>
        </div>
    </div>

    <div class="card-body table-responsive">
    	<div class="container">
    		@if(count($files)>0)
    		@foreach($files as $key => $filesdata)
    		@if($key > 1)
    		<div class="mb-3">
			  <p>{{$filesdata}}</p>
			  <a class="btn btn-success" href="{{url('storage/app/public/asset_rumbok/whatsapp/excelfiles')}}/{{$filesdata}}" download>
				  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
				  Download EXCEL
			  </a>
    		</div>
    		@endif
    		@endforeach
    		@endif

		</div>
    </div>
</div>

@endsection