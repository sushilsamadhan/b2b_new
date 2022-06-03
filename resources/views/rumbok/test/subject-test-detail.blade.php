<style>
p {
 text-transform: capitalize; 
}
.header-menu-area {
	display:none;
}

.footer-area {
    display: none;
}
span.squaere {
	width: 6px;
    height: 6px;
    margin-right: 5px;
    display: block;
    box-sizing: border-box;
    padding: 14px;
}
@media (max-width:767px) {
	.show2 button, .show2 a.btn {
		font-size:12px;
		padding:6px 6px;
	}
}
</style>
@extends('frontend.app')

@section('content')

    <!--======================================
          START breadcrumb AREA
  ======================================-->

   

    <!--======================================
            END breadcrumb AREA
    ======================================-->


    <!--======================================
            START COURSE AREA
    ======================================-->

	<section class="course-area">
		<div class="bg-white border-bottom py-2 mb-3">
			<div class="container">
			<div class="row">
				<div class="col-lg-3">            
					<div class="logo mr-3"><img src="{{ url('public/asset_rumbok/images/logo-ole.png') }}" style="max-width:120px"/></div>                    
				</div>
			</div>
			</div>
		</div>
        <div class="course-wrapper">
            <div class="container">
			@if ($notification = Session::get('success'))
			<div class="alert alert-danger alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>	
					<strong>{{ $notification }}</strong>
					@php 
						$path = Session::get('location_path');
						$path1 = Session::get('location_path1');
                    @endphp
					@if($path)
						<input type="button" value="Back" class="btn btn-danger"  style="margin-left: 675px !important;" data-dismiss="modal" id="btnHome" onClick="document.location.href='{{ url('')}}/package/{{$path}}/{{$path1}}'" />
					@else
					<a href="javascript:history.back()" class="btn btn-danger" style="margin-left: 675px !important;"><span class="link-text"> Back  </span> </a>                        
					@endif
			</div>
			@endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="clearfix">

                            <ul class="clearfix" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <span title="grid view">
                                  <h3 class="widget-title">
								  @if(Request::segment(1) == 'unit-test-detail')
										{{ $packageDetail->subjectName->title  }} Unit Test - {{ $unitName->title }} 
								  @elseif(Request::segment(1) == 'chapter-test-detail')
										{{ $packageDetail->subjectName->title  }} Chapter Test - {{ $unitName->title }} 
								  @else
								  <?php
										$s_course = \App\Course::find(Request::segment(3));
									?>
                            		{{ $s_course->title}} Subject Test
								  @endif
									<span class="float-right d-flex justify-content-between h6">
									<span class="small" style="min-width: 60px;">View In:</span>
									<select class="form-control" style="height: 22px;width: 100px;font-size: 10px;padding: 3px;">
										<option> English </option>
										<option> Hindi </option>
                                    </select>
									</span>
								  </h3>
                                      <!-- <i class="la la-th-large nav-link icon-element active"></i> -->
                                  </span>
                              
                            </ul>

                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="course-content-wrapper mt-4">
                    <div class="row">

                        {{-- sidebar --}}
                        <div class="col-lg-12">
                            <div class="sidebar">
                                    <!--Category -->
                                    <div class="card shadow">
										<div class="card-header bg-primary">
										<h5 class="card-title font-weight-bold text-white mb-0">Instruction</h5>  
										</div>
                                     <div class="card-body">
                                                                            
                                    <div class="row"> 
                                        <div class="col-md-12"> 
                                            <p class="mb-3 text-dark"><strong>General Instruction:</strong></p>
                                        </div>                                        
                                    </div>
									<div class="show">
									 <div class="col-md-12">
										<ol class="mt-2 mb-4 text-dark">
											<li class="mb-2">Total duration of examination is {{ $packageDetail->no_of_test_questions * 2}} min</li>
											<li class="mb-2">You clock will be set</li>
											<li class="mb-2">However ,this exam will be conducted with sectional timing. </li>
										</ol>					
									 </div>
										<div class="clearfix mb-2 mt-2">
											<div class="d-flex mb-2">
												<span class="squaere bg-success"></span>
												<span>You have answered the question.</span>
											</div>
											<div class="d-flex mb-2">
												<span class="squaere bg-warning"></span>
												<span>You have visited but not answered yet.</span>
											</div>
											<div class="d-flex mb-2">
												<span class="squaere bg-info"></span>
												<span>You have not answered the question but have marked for review</span>
											</div>
											<div class="d-flex mb-2">
												<span class="squaere bg-primary"></span>
												<span>You have answered the question but have marked for review</span>
											</div>
											<div class="d-flex mb-2">
												<span class="squaere bg-danger"></span>
												<span>You have not visited the question.</span>
											</div>
										</div>
									 </div>
									 <div class="show3" style="display:none;">
									 <div class="row col-md-12"> 
                                        <div class="col-md-12"style="margin-bottom: 25px;"> 
                                            Read the following instructions carefully.
                                        </div>
										  <div class="col-md-12"> 
										<div class="table-responsive">
										<table class="table table-bordered">
										  <thead>
											<tr>
											  <th scope="col">SNo.</th>
											  <th scope="col">Section Name</th>
											  <th scope="col">No. of Question</th>
											  <th scope="col">Maximum Marks</th>
											   <th scope="col">Negative Marks</th>
											    <th scope="col">positive Marks</th>
											</tr>
										  </thead>
										  <tbody>
										  @php $i = 1;@endphp
										 <tr>
											    
											<th scope="row">{{ $i++}}</th>
											<td>{{ isset($s_course)?$s_course->title:$packageDetail->subjectName->title  }}</td>
											<td>{{ floor($totalQuestion) }}</td>
											<td>{{ $packageDetail->no_of_test_questions *2 }}</td>
											<td>0</td>
											<td>2</td>
												
										 </tr>
										  </tbody>
										</table>
</div>
										</div>
										 <div class="col-md-12">
											<ul class="">
												<li>1.Total duration of examination is {{ $packageDetail->no_of_test_questions * 2 }} min</li>
												<li>2.You clock will be set</li>
												<li>3.However ,this exam will be conducted with sectional timing. </li>
											</ul>		
										</div>
											<div class="col-lg-12" style="margin-bottom:10px; margin-top:10px;">
													<input type="checkbox" id="vehicle3"  name="readStatus" value="Boat">
													<label for="vehicle3"> I have read and understood the instructions.</label>
										    </div>
										</div>
									
									</div>									
									 <div class="show2 py-3">
									  <div class="row">
										  <div class="col-md-6 col-5">
										  <button class="btn btn-primary goback" style="display:none" id="showbacks" >Go back</button>
										  </div>
										  <div class="col-md-6 col-7 text-right">
											<button class="btn btn-primary back" id="show">Next</button>
											
											
											@if(Request::segment(1) == 'unit-test-detail')
											@php  $Ids = Request::segment(3);  @endphp
												@if($Ids != '')
													<a class="btn btn-primary ready disabled"  href="{{ route('unit-test-start',[$packageDetail->id , $Ids])}}" id="show222" style="display:none" >I am ready to begin</a>
												@else 
													<a class="btn btn-primary ready disabled"  href="{{ route('unit-test-start',$packageDetail->id)}}" id="show222" style="display:none" >I am ready to begin</a>
												@endif
											@elseif(Request::segment(1) == 'chapter-test-detail')
											@php  $Ids = Request::segment(3);  @endphp
												@if($Ids != '')
												<a class="btn btn-primary ready disabled"  href="{{ route('chapter-test-start',[$packageDetail->id , $Ids])}}" id="show222" style="display:none" >I am ready to begin</a>
												@else
												<a class="btn btn-primary ready disabled"  href="{{ route('chapter-test-start',$packageDetail->id)}}" id="show222" style="display:none" >I am ready to begin</a>
												@endif
											@else
											@php  $Ids = Request::segment(3);  @endphp
											<a class="btn btn-primary ready disabled"  href="{{ route('subject-test-start',[$packageDetail->id,$Ids])}}" id="show222" style="display:none" >I am ready to begin</a>
											@endif
										</div>
									  </div>
									</div>
									</div>
                                    </div>
                           
                     <!-- end col-lg-8 -->
                    </div><!-- end row -->
     
                </div><!-- end card-content-wrapper -->
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section><!-- end courses-area -->
    <!--======================================
            END COURSE AREA
    ======================================-->

@endsection

@section('js')
    {{-- stripe --}}


<script type="text/javascript">
	$(document).ready(function(){
	
$('input[type=checkbox][name=readStatus]').change(function() {
	if ($(this).prop("checked")) {
		$('#show222').removeClass('disabled');
	}
															// else {
															// 	alert(`${this.value} is unchecked`);
															// }
});
														 
		
    $('#show').click(function() {
        $('.show3').toggle("show");
	    $('.show').hide();
		$('.back').hide();
		$('.ready').show();
		$('.goback').toggle("show");

    });
	
	$('#showbacks').click(function() {
      $('.show').toggle("show");
	  $('.back').show();
	  $('.show3').hide();
	  $('.goback').hide();
	  $('.ready').hide();
    });
	
});
</script>
@endsection