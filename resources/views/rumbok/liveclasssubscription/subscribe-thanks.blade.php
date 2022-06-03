@extends('rumbok.app')

@section('content')


    <!-- Breadcrumb Section Starts -->
    <section class="heading-n-breadcrub-part">
         <div class="container">
            <div class="row align-items-center">
               
               <div class="col-md-6 m-auto">
                <div class="form-register-now">
                  <div class="thank-you-message text-center p-3">
                        @if (Session::has('message'))
                                {!! Session::get('message') !!}
                        @endif
                   </div>
                </div>
               </div>

            </div>
         </div>
      </section>




    

@endsection
