@extends('rumbok.app')
@section('content')

<style>

.image{
       width: 60%;
       height: inherit;
    }
    section{
        padding: 2%;
    }
    .heading-n-breadcrub-part button {
    border: 0;
    border-radius: 4px;
    color: #6e2573;
    font-size: 20px;
    vertical-align: middle;
    height: auto;
    padding: 2px 10px;
}
</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
            <div class="d-flex align-items-center">
              <button onclick="goBack()" class=""><i class="ti-arrow-left"></i></button>
              <div class="title-page">
                <h1>@translate(Job notification details)</h1>
              </div>
            </div>              
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                          <a href="{{url('/')}}">@translate(home)</a>
                      </li>
                      <li>
                        <span>@translate(Job notification)</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
<section>
        <!-- <button class="float-right"><a href="{{route('homepage.job_notification')}}">Go Back</a></button><br><br> -->
        <div class="container">

            <div>
                <div class="text-center"><h3>{{ $item->title }}</h3></div>
                <div class="text-center short_discription "><h6>{{ $item->short_discription }}</h6></div>
                <div class="text"><p>{!! $item->discription !!}</p></div>
                @if($item->image != null)
                <div class="text-center" id="img"> <img class="image" src="{{ asset('job_images/'.$item->image )}}" alt={{$item->image}}/></div>
                
                @else                      <!-- <div class="text-center" id="img"> <img class="image" src="{{ asset('job_images/'.$item->image )}}" alt={{$item->image}}/></div> -->
            
                <div class="text-center" id="img"> </div>      
                
                @endif
                
            </div> 
            <div class="text-center">
            <a href="{{ $item->source_url }}" class="btn btn-primary">Visit To Site</a>
            </div>  
        </div>

</section>


@endsection