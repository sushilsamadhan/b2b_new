@extends('rumbok.app')
@section('content')
<style>
.agent-detail:hover{
color: #e86a2f;
}
img {
    width: 175px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
.card-title.text-center.text_wrapper:hover {
    color: #e86a2f;
    font-size: 25px;
}
</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="title-page">
                <h1>Register User</h1>
              </div>              
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                          <a href="#">Home</a>
                      </li>
                      <li>
                        <span>Register Student</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>

<section class="section-team py-0">
  <div class="container">
	<!-- if Agent Code is Authenticated Start Code here.. -->
        @if(empty(session('agent_code')))
        <form class="row" action="{{ route('add.user.register') }}" method="post">
        	@csrf
        	
        	<div class="col-md-10 offset-md-1">
			  <div class="clearfix border rounded shadow-sm overflow-hidden">
                 <div class="row no-gutter">
					 <div class="col-md-6">
						<div class="clearfix p-5">
							@if(session('error'))
								<div class="alert alert-danger">
										{{ session('error') }}
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
								</div>
							@enderror
							<div class="form-group ">
									<label for="agent_code" class="font-weight-bold small mb-2">Agent Code</label>
									<input type="text" class="form-control @error('agent_code') is-invalid @enderror" id="agent_code" value="{{ old('agent_code')}}" name="agent_code" placeholder="Agent Code here...">
										@error('agent_code')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
							<div class="form-group">
									<label for="access_key" class="font-weight-bold small mb-2">Agent Access Key</label>
									<input type="text" class="form-control @error('access_key') is-invalid @enderror" id="access_key" value="{{ old('access_key')}}" name="access_key" placeholder="Access Key...">
									@error('access_key')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
							</div>
							<div class="form-group">
								<label for="inputState" class="font-weight-bold small mb-2">School/University</label>
								<select id="university_name" name="university_name" class="form-control @error('university_name') is-invalid @enderror">
									<option value="">Choose School/Institute</option>
									@foreach($school as $sch)
										<option value="{{ $sch->id }}">{{ $sch->university_name }}</option>
									@endforeach
								</select>
								@error('university_name')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
							<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block text-uppercase">Submit</button>
							</div>
						</div>
					 </div>
					 <div class="col-md-6 bg-light">
						 <img src="{{asset('asset_rumbok/new/images/login-school.svg')}}" class="w-100">
					 </div>
				 </div>
			  </div>		
        	</div>
        	
		    <div class="col-md-12 text-center">
          
        </div>
		</form>	
		@endif
		<!-- if Agent Code is Authenticated End Code here.. -->
  </div>
</section>

<style>
   @media (max-width:767px){
   header.header-section {
   display:none;
   }
   .bottom-menu {
   display:none;
   }
   }
   body {
   margin-bottom:0;
   padding: 0;
   }
   .potrait { display:block; }
   .landscape { display:none; }
   @media(max-width:767px) {
   @media only screen and (orientation:landscape) {
   .potrait { display:block; }
   .landscape { display:none; }
   }
   @media only screen and (orientation:portrait) {
   .potrait { display:block; }
   .landscape { display:none; }
   }
</style>
<style>
   .radio-toolbar .for_class_name_type {
   display: none;
   }
   .radio-toolbar label {
   display: block;
   padding: 0px 12px;
   font-family: Arial;
   font-size: 16px;
   pointer-events: all;
   cursor: pointer;
   color: #000;
   font-weight: normal;
   text-align: center;
   border-radius: 3px;
   }
   .radio-toolbar .for_class_name_type:checked+label span {
   background-color: blue;
   color: #fff;
   }
</style>


@if(!empty(session('agent_code')))
<section class="login-register">
   <div class="container">
   @if(session()->has('success'))
   		<div class="alert alert-success">{{ session()->get('success') }}</div>
   	@endif
	@error('select_file')
		<div class=" alert alert-danger">{{ $message }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@enderror
   	<div class="row">
		<div class="col-md-2"></div>	
	   	<div class="col-md-4">
		   	<form method="post" id="submitXlForm" action="{{ url('user-register/addData') }}" enctype="multipart/form-data">
				@csrf
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<button type="submit" class="input-group-text">Upload</button>
					</div>
					<div class="custom-file">
						<input type="file" name="select_file" class="custom-file-input" id="inputGroupFile01">
						<label class="custom-file-label" for="inputGroupFile01">Choose Csv file</label>
					</div>
				</div>
			</form>
	   	</div>
	   	<div class="col-md-6">
   			<a href="https://olexpert.org.in/public/uploads/user/AgentSampleSheet.csv" class="btn btn-outline-success mb-1" download>Download Sample File</a> 
	   		<i class="fa fa-info btn btn-outline-success" data-toggle="modal" data-target="#myModal" id="showNotice"></i>
   		</div>
   	</div>

      <div class="row my-5">
         <div class="col-md-10 offset-md-1">
            <div class="row no-gutter">
                <div class="col-md-6">
                	<div class="form">
                	<div class="alert alert-success d-none" id="succ_msg">
                		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    	<span aria-hidden="true">&times;</span>
								  	</button>
                	</div>
                		<ul class="alert alert-danger d-none error_list"></ul>
	               	<div id="login">
	                   <h1 class="text-left mb-3">Student Registration Details For School</h1>
	                    <form id ="formData" class="needs-validation" action="" autocomplete="off" method="post" novalidate>
	                    	@csrf
	                        <div class="field-wrap" id="name-row">
		                         <label>
		                         	Enter Full Name<span class="req">*</span>
		                         </label>
	                        	 <input class="is-invalid" id="name" type="text" name="name" value="{{ old('name') }}"  autocomplete="off" onblur ="checkname(this.value)" pattern="^[A-Za-z\s]{3,}[\.]{0,1}[A-Za-z\s]{0,}$" required>

	                         	<span id="name_error" style="color:red;text-align: center;"></span>
	                        </div>
	                        <div class="field-wrap">
	                            <label>Phone Number<span class="req">*</span>
	                            </label>
	                            <div class="d-flex align-items-center">
	                              <input class="is-invalid" id="phone" type="text" name="phone"  value="{{ old('phone') }}" maxlength="10" onblur ="checkmobile(this.value)" autocomplete="off" required pattern="[6-9]{1}[0-9]{9}">
	                            </div>
                              <span id="phone_error" style="color:red;text-align: center;"></span>
	                						<span id="phone_not_error" style="color:green;text-align: center;"></span>
	                						
	                        </div>
	                        <div class="form-group">
	                            <label>Tell Your Age Group<span class="req">*</span></label>
	                            <div class="radio-toolbar mb-2 row">
	                              <input id="radio_for_k12" value="k12" type="radio" name="class_type" class="for_class_name_type" onclick="FunctionForclass_name_type(this.value)">
	                               <label for="radio_for_k12" class="col-md-6"><span class="small d-block border border-dark rounded">Academic Courses</span></label>

	                              <input id="radio_for_18pluse" value="18+" type="radio" name="class_type" class="for_class_name_type" onclick="FunctionForclass_name_type(this.value)">
	                              <label for="radio_for_18pluse" class="col-md-6">
	                               <span class="small d-block border border-dark rounded">Competitive Courses</span>
	                              </label>                                        
	                            </div>
	                            <span class="class_type-error" role="alert" style="font-size: 80%;"></span>
	                        </div>
	                         <div id="show_for_k12" style="display:none;">
	                            <div class="radio-toolbar mb-2 row">
	                               @php
	                               $classes = \App\Model\Category::where('parent_category_id',9)->get();
	                               @endphp
	                               @foreach($classes as $classesval)
	                               <input id="class_name_{{ $classesval->id }}" type="radio" name="class_name" value="{{ $classesval->id }}" class="for_class_name_type">
	                               <label for="class_name_{{ $classesval->id }}" class="col-3">
	                               <span class="d-block border border-dark rounded">{{ $classesval->name }}</span>
	                               </label>
	                               @endforeach
	                            </div>
	                            <span class="class_name-error" role="alert" style="font-size: 80%;margin-left: 13px;"></span>
								<div class="form-group">
	                               <label>Board<span class="req">*</span></label>
	                               @php

	                               $boards = \App\Model\Category::where('parent_category_id',83)->orWhere('parent_category_id',84)->get();

	                               $categories = \App\Model\Category::where('id',83)->orWhere('id',84)->get();

	                               @endphp

	                               <select class="form-control bg-transparent" name="board" id="board">
	                                  <option value="">Select</option>
	                                  @foreach($categories as $category)
	                                  	<optgroup label="{{ $category->name }}">
	                                  	 	@foreach($boards as $boardsval)
	                                  	 		@if($boardsval->parent_category_id == $category->id )
			                                 	 	<option value="{{ $boardsval->id }}">{{ $boardsval->name }}</option>
			                                  @endif
			                                @endforeach
	                                  	</optgroup>
	                                  @endforeach

	                               </select>
	                               <span class="board-error" role="alert" style="font-size: 80%;"></span>
	                            </div>
	                         </div>
	                         <div id="show_for_18" style="display:none;">
	                            <div class="form-group">
	                               <label>Competitive<span class="req">*</span></label>
	                               @php
	                               $con = ['is_compitative' => '1', 'parent_category_id' => '0'];
	                               $Competitive = \App\Model\Category::where($con)->get();
	                               @endphp
	                               <select class="form-control bg-transparent" id="competitive" name="competitive">
	                                  <option value="">Select</option>
	                                  @foreach($Competitive as $Competitiveval)
	                                  <option value="{{ $Competitiveval->id }}">{{ $Competitiveval->name }}</option>
	                                  @endforeach
	                               </select>
	                               <span class="competitive-error" role="alert" style="font-size: 80%;"></span>
	                            </div>
	                         </div>
	                </div>
	                <div class="field-wrap login-btn">
		                        <div class="btn-box">
		                            <button class="button button-block" type="button" id="dataSubmit">@translate(Submit)</button>
		                        </div>

	                    </form>
	                </div>
	                </div>
                </div>
		      			<div class="col-md-6">
		      				@if(session('agent_code'))
		      					@php
		      						$agent_details = \App\Agent::where('agent_code',session('agent_code'))->first();
		      						$school_details = DB::table('universities')->where('id',session('university_id'))->first();

		      					@endphp

		      						<div class="login-background-part h-100">
		      						 <div class="login-bg-content">
		      						 	<h1 class="olexpert-tag">{{ $school_details->university_name}}</h1>
										  
											<div class="app-content">
											   <h4 class="text-white text-center"><i class="fas fa-map-marker-alt"></i></h4>
											
											<h5 class="text-white font-weight-normal text-center">{{ $school_details->address}}, {{ $school_details->city}}, {{ $school_details->pincode}}</h5>
											
											<p class="text-white"><span class="rounded py-1 my-3 px-3 text-uppercase"><i class="fa fa-user-alt"></i> Agent Name - {{ $agent_details->agent_name }}</span></p>
											<p class="text-white my-3 text-uppercase"><span class="border-top border-bottom py-2">Agent Code - {{ $agent_details->agent_code }}</span></p>
											</div>

											<a class="rounded-white-border-btn" href="{{ route('user.deleteAgentSession') }}">Change School&nbsp;&nbsp;</a>
		                     </div>
											</div>
		      				@endif
		      			</div>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="modal fade come-from-modal right" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	 <h5 class="modal-title" id="exampleModalLabel">Instructions:</h5>
        <button type="button" id="closebtn" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<span>1. Sheet should be in <strong>CSV format</strong> (e.g. : sample.csv). </span><br/>
				<span>2. <strong>Name, Phone, Class Type, Board, Class Name </strong> are mandatory.</span><br/>
				<span>3. <strong>Phone Number</strong> should be unique for each student.</span><br/>
				<span>4. Values of columns <strong>'Class Type' , 'Board', 'Class Name' </strong> should be same as given in sample sheet.</span>
      </div>
    </div>
  </div>
</div>
@endif

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>

		function checkname(valuename){
			var pattern = "^[A-Za-z\s]{2,}[\.]{0,1}[A-Za-z\s]{0,}$";
	
			if(valuename == ''){

					document.getElementById('name_error').innerHTML = "Name must be required.";
				  return false;
				}else if(valuename.match(pattern)){
					document.getElementById('name_error').innerHTML = "Please Enter Correct Name.";
				  return false;
				}else{
					document.getElementById('name_error').innerHTML = "";
				  return false;
				}
		}




	   	function checkmobile(valuenum){

	   		var pattern="[6-9]{1}[0-9]{9}";
	   	
					if(valuenum == ''){
						document.getElementById('phone_error').innerHTML = "Phone number can not be blank";
						return false;
					}else if(valuenum.match(pattern)){
						document.getElementById('phone_error').innerHTML = "";
						return false;
					}else{
						document.getElementById('phone_error').innerHTML = "Phone number invalid";
						return false;
					}

					$.ajax({
						url: "{{ route('user.register.checkmobile') }}",
						type: "GET",
						data: {phone:valuenum},
						success: function(response){
							if(response.status == 1){
								document.getElementById('phone_not_error').innerHTML = response.success;
							}if(response.status == 0){
								document.getElementById('phone_error').innerHTML = '';
							}
						}
					});
	   		}

	   $(document).ready(function(){

	       $('.logintab a').on('click', function (e) {
	           e.preventDefault();
	           $(this).parent().addClass('active');
	           $(this).parent().siblings().removeClass('active');
	           target = $(this).attr('href');
	   
	           $('.tab-content > div').not(target).hide();
	   
	           $(target).fadeIn(600);
	           
	       });
	

	    $('#dataSubmit').on('click',function(e){
	    	e.preventDefault();
	    	var name = $('#name').val();
	    	let regex = /^[a-zA-Z ]{2,50}$/;
	    	if(name == ''){
				document.getElementById('name_error').innerHTML = "Student Name is required!";
				return false;
			}
			if(!regex.test(name)){
				document.getElementById('name_error').innerHTML = "Name Should be String";
				return false;
            }
		    var phone = $('#phone').val();
		    if(phone == ''){
						document.getElementById('name_error').innerHTML = "Phone Number can not be blank and must be unique";
						return false;
				}
		    var class_type =  $("input[name='class_type']:checked").val();
		    var class_name = $("input[name='class_name']:checked").val();
		    var board = $('#board').val();
		    var competitive = $('#competitive').val();

				if (class_type=="k12") {
						var url = "{{route('create.agent.userboard')}}";
					}
					if (class_type=="18+") {
						var url = "{{route('create.agent.usercomptitive')}}";
					}
		    $.ajax({
		    	url: url,
		     	type: "POST",
		     	data: {
			        "_token": "{{ csrf_token() }}",
			        name:name,
			        phone:phone,
			        class_type:class_type,
			        class_name:class_name,
			        board:board,
			        competitive:competitive,
			      },
		     	success:function(response){
		     		if(response.status == 1){
		     			$('#name').val('');
		     			$('#phone').val('');
		     			$('#succ_msg').removeClass('d-none');
		     			$('#succ_msg').text(response.success);
		     		}
		     		if(response.status == 0){
		     			$('.error_list'.removeClass('d-none'));
		     			$.each(response.errors,function(key,value){
		     				$('.error_list').append('<li>'+value+'</li>');
		     			});
		     			// $('#name_error').text(response.errors.name);
		     			// $('#phone_error').text(response.errors.name);
		     		}
		     	}
		     }); 
	    });
	});

	  $('#agent_code').on('blur',function(){
	  	if(this.value != ''){
	  		$(this).removeClass('is-invalid');
	  		$(this).addClass('is-valid');
	  		
	  	}else{
	  			$(this).addClass('is-invalid');
	  			$('.invalid-feedback').text('Please Enter Agent Code');
	  	}
	  });
	  $('#access_key').on('blur',function(){
	  	if(this.value != ''){
	  		$(this).removeClass('is-invalid');
	  		$(this).addClass('is-valid');
	  		
	  	}else{
	  			$(this).addClass('is-invalid');
	  			$('.invalid-feedback').text('Please Enter access key');
	  	}
	  });
	  $('#university_name').on('blur',function(){
	  	if(this.value != ''){
	  		$(this).removeClass('is-invalid');
	  		$(this).addClass('is-valid');
	  		
	  	}else{
	  			$(this).addClass('is-invalid');
	  			$('.invalid-feedback').text('Please select a school');
	  	}
	  });
	</script>
	<script>
	   function myFunction() {
	     var x = document.getElementById("pass");
	     if (x.type === "password") {
	       x.type = "text";
	     } else {
	       x.type = "password";
	     }
	   }
	   
	   function FunctionForclass_name_type(workval) {
	       if (workval=="k12") {
	           $("#show_for_k12").show();
	           $("#show_for_18").hide();
	       }
	       if (workval=="18+") {
	           $("#show_for_18").show();
	           $("#show_for_k12").hide();
	       }
	   }

	   $('#showNotice').mouseover(()=>{
	   		 $("#myModal").modal('show');
	   });

	   $('#closebtn').on('click',()=>{
	   		 $("#myModal").modal('hide');
	   });

	   $('.custom-file input').change(function (e) {
        	if (e.target.files.length) {
            	$(this).next('.custom-file-label').html(e.target.files[0].name);
        	}
    	});
	</script>
@endsection
