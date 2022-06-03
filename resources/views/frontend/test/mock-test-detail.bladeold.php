<style>
p {
 text-transform: capitalize; 
}
.header-menu-area {
	display:none;
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
    <section class="course-area padding-top-80px padding-bottom-120px">
        <div class="course-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filter-bar d-flex justify-content-between align-items-center">

                            <ul class="filter-bar-tab nav nav-tabs align-items-center" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <span title="grid view">
                                  <h3 class="widget-title">{{ $mockTest->name}}</h3>
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
                                    <div class="sidebar-widget ">
                                    <head>
                                        <h3 class="filter-bar d-flex justify-content-between  widget-title" style="background: #cc721538;">  Instruction</h3>
                                    </head>   
                                    <div class="row col-md-12"> 
                                        <div class="col-md-6"> 
                                            General Instruction:
                                        </div>
                                        <div class="col-md-6"> 
                                        <div class="row col-md-12"> 
                                                <div class="col-md-3">View In:
                                                </div> 
                                                <div class="col-md-5">
                                                <select class="form-control">
                                                    <option> English </option>
                                                    <option> Hindi </option>
                                                </select>
                                                </div>
                                                </div>     
                                        </div>
                                    </div>
									<div class="show">
									 <div class="col-md-12">
									  <ul class="">
                                            <li>1.Total duration of examination is 120 min</li>
											<li>2.You clock will be set</li>
											<li>3.However ,this exam will be conducted with sectional timing. </li>
										</ul>		
											
									 </div>
										<div class="col-lg-12" style="margin-bottom:10px; margin-top:10px;">
										  <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
										  <label for="vehicle1"> You have answered the question.</label><br>
										  <input type="checkbox"  id="vehicle2" name="vehicle2" value="Car">
										  <label for="vehicle2"> You have answered the question,</label><br>
										  <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
										  <label for="vehicle3"> You have answered the question.</label><br>
										  <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
										  <label for="vehicle3"> You have answered the question.</label><br>
										  <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
										  <label for="vehicle3"> You have answered the question.</label>
										</div>
									 </div>
									 <div class="show3" style="display:none;">
									 <div class="row col-md-12"> 
                                        <div class="col-md-12"style="margin-bottom: 25px;"> 
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
										</div>
										 <div class="col-md-12">
											<ul class="">
												<li>1.Total duration of examination is 120 min</li>
												<li>2.You clock will be set</li>
												<li>3.However ,this exam will be conducted with sectional timing. </li>
											</ul>		
										</div>
											<div class="col-lg-12" style="margin-bottom:10px; margin-top:10px;">
														  <input type="checkbox" id="vehicle3" name="readStatus" value="Boat">
												<label for="vehicle3"> I have read and understood the instructions.</label>
												</div>
										</div>
									
									</div>									
									 <div class="show2">
									  <div class="row col-md-12 filter-bar d-flex justify-content-between  widget-title">
										  <div class="col-md-6" >
										  <button class="btn btn-primary goback" style="display:none" id="showbacks" >Go back</button>
										  </div>
										  <div class="col-md-6 text-right">
											<button class="btn btn-primary back" id="show">Next</button>
											
											<a class="btn btn-primary ready"  href="{{ route('mock-test-start',$mockTest->id)}}" id="show222" style="display:none" disabled>I am ready to begin</a>
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
		  $('[name^="readStatus"]').click(function(event) {
        
         $('#show222').prop('disabled',false);
    });
    $('#show').click(function() {
		//alert()
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