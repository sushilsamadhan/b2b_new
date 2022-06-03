<style>
	p {
		text-transform: capitalize;
	}

	.header-menu-area {
		display: none;
	}

	.footer-area {
		display: none;
	}

	span.squaere {
		width: 25px;
		height: 25px;
		margin-right: 5px;
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
					<div class="logo mr-3"><img src="{{ url('public/asset_rumbok/images/logo-ole.png')}}" style="max-width:120px" /></div>
				</div>
			</div>
		</div>
	</div>
	<div class="course-wrapper">
		<div class="container">

			<div class="row">
				<div class="col-lg-12">
					<div class="clearfix">

						<ul class="clearfix" id="myTab" role="tablist">
							<li class="nav-item">
								<span title="grid view">
									<h3 class="widget-title">
										Mock Test - {{ $mockTest->name}}
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
												<li class="mb-2">Total duration of examination is 60 min</li>
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
											<div class="col-md-12" style="margin-bottom: 25px;">
												Read the following instructions carefully.
											</div>
											<div class="col-md-12">
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
														@foreach($mockTest->mockTestSection as $mockTestSection)
														<tr>

															<th scope="row">{{ $i++}}</th>
															<td>{{ ucfirst($mockTestSection['section_name']) }}</td>
															<td>{{ $mockTestSection->no_of_question }}</td>
															<td>{{ $mockTestSection->no_of_question * $mockTestSection->question_value}}</td>
															<td>{{ $mockTestSection->negative_marking_value }}</td>
															<td>{{ $mockTestSection->question_value }}</td>

														</tr>
														@endforeach


													</tbody>
												</table>
												<div class="row col-md-12" id="editVehicle">

													<div class="col-md-6">
														<input type="radio" name="section" id="dd" class="first" value="with_section"> With lock Section
														<span id="reqTxtAddress" class="reqError"></span><br />
													</div>
													<div class="col-md-6">
														<input type="radio" name="section" class="second" value="without_section"> Without lock Section
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<ul class="">
													<li>1.Total duration of examination is 120 min</li>
													<li>2.You clock will be set</li>
													<li>3.However ,this exam will be conducted with sectional timing. </li>
												</ul>
											</div>
											<div class="col-lg-12" style="margin-bottom:10px; margin-top:10px;">
												<input type="checkbox" id="vehicle3" name="readStatus" value="">
												<label for="vehicle3"> I have read and understood the instructions.</label>
											</div>
										</div>

									</div>
									<div class="show2 py-3">
										<div class="row">
											<div class="col-md-6">
												<button class="btn btn-primary goback" style="display:none" id="showbacks">Go back</button>
											</div>
											<div class="col-md-6 text-right">
												<button class="btn btn-primary back" id="show">Next</button>

												<a class="btn btn-primary ready disabled" href="{{ route('mock-test-start',[$packageDetail->id, $mockTest->id])}}" id="show222" style="display:none">I am ready to begin</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- end col-lg-8 -->
						</div><!-- end row -->

					</div><!-- egend card-content-wrapper -->
				</div><!-- end container -->
			</div><!-- end course-wrapper -->
</section><!-- end courses-area -->
<!--======================================
            END COURSE AREA
    ======================================-->

@endsection

@section('js')
{{-- stripe --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript">
	document.querySelector(".first").addEventListener('click', function() {
		sweetAlert("With Section Lock", "You have to select with section lock !", "success");
	});
	document.querySelector(".second").addEventListener('click', function() {
		sweetAlert("WithOut Section Lock", "You have to select without section lock !", "success");
	});
	$(document).ready(function() {

		$('input[type="radio"]').click(function() {
			var section = $(this).val();
			localStorage['test'] = section;
			window.localStorage.setItem('user', section);
			$.ajax({
				url: "{{ route('section-value') }}",
				data: {
					section: section
				},
				success: function(data) {
					//  $('#result').html(data);  
				}
			});
		});


		$('input[type=checkbox][name=readStatus]').change(function() {
			if ($(this).prop("checked")) {
				 //alert(window.localStorage.getItem('user') )
				if (window.localStorage.getItem('user') == '') {
					window.localStorage.setItem('user', 'with_section');
				}
				$('#show222').removeClass('disabled');
			}
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