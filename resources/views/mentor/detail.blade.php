@extends('layouts.master')
@section('title','Subscriber List')
@section('parentPageTitle', 'All Subscribers')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Mentor Detail</h4>
                <a class="float-right pl-3 rounded-3 btn btn-primary" href="{{route('mentor.list_mentor')}}">Go Back</a><br><br>
            </div>            
            <div class="card-body text-center" >                                      
                <div class="row">
                    <div class="col-sm-3 image text-left">
                        @if($item->photo != null)
                            <img src="{{filePath($item->photo)}}" class=" rounded-circle"><br />
                        @else
                            <img src="{{url('public/uploads/media_manager/33.png')}}" class="rounded-circle avatar-lg" alt="avatar"><br />
                        @endif
                    </div>
                    <div class="col-sm-3 text-left">
                        <h3>{{ $item->profile_title }}</h3> <br> 
                        Name :<h4>{{ $item->name }}</h6><br>
                        Phone :<h4>{{ $item->phone }}</h6>
                    </div>
                </div>                               
                <div class="row ">
                    <div class="col-sm-12 text-left p-5">
                        <label>Experience</label>
                        <h6>{{ $item->experience }}</h6><br><br>
                        <label>Full Discription</label>
                        <div>{!! $item->profile_desc !!}</div>
                    </div>                                        
                </div>    
                <a  class="float-right pl-3 rounded-3 btn btn-primary" href="{{ url('/list-edit',['id' => $item->id]) }}">Edit</a><br><br>                                             
            </div>
        </div>
    </div>
</div>
@endsection