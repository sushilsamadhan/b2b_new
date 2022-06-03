@extends('rumbok.app')
@section('content')

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

<section class="section-team mb-5">
  <div class="container">
  	<a href="{{ route('user.register') }}" class="btn btn-primary mb-2">Back</a>
		@if(session()->has('success'))
   		<div class="alert alert-success">
   			{{ session()->get('success') }}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
   		</div>
   	@endif

   	@if($total_number)
   		<div class="alert alert-danger">
   			Total {{ $total_number }} Duplicates Phone Number Exists : 
   				<br/>
   				{{ $invalid_data }}

   			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>	
   		</div>
   	@endif

    @if($newmissingdata)
      <div class="alert alert-danger">
        Missing Data (Class Type/Board/Class Name) for these phone numbers {{ $newmissingdata }}    
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>
    @endif


   	@if(session()->has('total_insertion'))
   		<div class="alert alert-success">
   			Total {{ session()->get('total_insertion') }} Data Inserted Successfully.
   				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
   		</div>
   	@endif
   	
  </div>
</section>

@endsection

