@extends('layouts.master')
@section('title','Subscriber List')
@section('parentPageTitle', 'All Subscribers')
@section('content')
<style>
    .short_discription{
        padding-bottom: 2%;
    }
    .image{
       width: 60%;
       height: inherit;
    }
    </style>
    
<h2>Job Notification Details</h2>  
<button class="float-right"><a href="{{route('job.job_list')}}">Go Back</a></button><br><br>
<div class="container">

    <div>
        <div class="text-center"><h2>{{ $item->title }}</h2></div>
        <div class="text-left short_discription "><h4>{{ $item->short_discription }}</h4></div>
        <div class="text"><p>{!! $item->discription !!}</p></div>
        @if($item->image != null)
        <div class="text-center" id="img"> <img class="image" src="{{ asset('job_images/'.$item->image )}}" alt={{$item->image}}/></div>
        
         @else                      <!-- <div class="text-center" id="img"> <img class="image" src="{{ asset('job_images/'.$item->image )}}" alt={{$item->image}}/></div> -->
    
         <div class="text-center" id="img"> </div>      
         
         @endif
    <div class="text-right mt-3"> <a href = "{{ url('/job_Edit',['id' => $item->id]) }}" style="font-size: x-large;"><i class="fa fa-edit">Edit</i></a> </div>
    </div>    
</div>


@endsection