@extends('rumbok.app')
@section('content')

    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
                 class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Book Free Class</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{url('/')}}">@translate(home)</a> / Book Free Class</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<section class="blog-content-section blog-details-page pb-5">
        <div class="container">
            <div class="row">
				<div class="col-12 col-lg-8 offset-lg-2">
					<h4 class="card-subtitle my-4 text-muted text-center"> Limited Spots Left!</h4>
					<form method="POST" action="{{route('frontend.book-free-class.store')}}" class="jumbotron free_class_form">

						@if (Session('message'))
							<div class="text-center">
								<h5 class="p-3">Congratulation! Your Application form has been submitted successfully. </h5>
								<h6 class="p-3">Kindly be patience, our agent will contact you soon.</h6>
							</div>
						@else
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
							<div class="form-group"> 
								<label for="parent_mobile">Parent's Mobile</label>
								<input type="number" name="parent_mobile"  id="parent_mobile" required value="{{ old('parent_mobile') }}" class="form-control @error('parent_mobile')  is-invalid @enderror pl-2">
								@error('parent_mobile')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="form-group"> 
								<label for="parent_name">Parent's Name</label>
								<input type="text" name="parent_name" id="parent_name" required value="{{ old('parent_name') }}" class="form-control @error('parent_name') is-invalid @enderror pl-2">
								@error('parent_name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="form-group"> 
								<label for="student_name">Student Name</label>
								<input type="text" name="student_name" id="student_name"  required value="{{ old('student_name') }}"  class="form-control @error('student_name') is-invalid @enderror pl-2">
								@error('student_name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror                      
							</div>

							<div class="form-group"> 
								<label for="class">Class</label>
								<select name="class" value="{{ old('class') }}" required class="form-control @error('class') is-invalid @enderror pl-2" id="class">
									<option value="10">10</option>
									<option value="9">9</option>
									<option value="8">8</option>
									<option value="7">7</option>
									<option value="6">6</option>
								</select>
								@error('class')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="form-group"> 
								<button class="form-control btn free_class_button">Submit</button>
							</div>

						@endif
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection