@extends('frontend.app')
@section('content')

<!--Add Free class -->
<div class="container">
    <div class="card m-3 p-3">
        <div class="card-body">
            <h3 class="card-title text-center">Book Free Class</h3>
            <h5 class="card-subtitle mb-2 text-muted text-center"> Limited Spots Left!</h5>

            
             
           
            <div class="offset-2">
                <form method="POST" action="{{route('frontend.book-free-class.store')}}" class="jumbotron" style="width: 40rem;">
                  @if (Session('message'))
                    <div  style="height: 15rem;background-color:#179f0657;">
                      <h4 class="p-3">Congratulation! Your Application form has been submitted successfully. </h4>
                       <h4 class="p-3">Kindly be patience, our agent will contact you soon.</h4>
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
                        <button class="form-control btn btn-info">Submit</button>
                    </div>
                    @endif

                 
                </form>
            </div>
        </div>
    
    </div>
    
</div>
@endsection