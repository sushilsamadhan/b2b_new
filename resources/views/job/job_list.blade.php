@extends('layouts.master')
@section('title','Subscriber List')
@section('parentPageTitle', 'All Subscribers')
@section('content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>

#table_data{
  
   height: 15%;
   margin-top: 2%;
}
.box{
    background-color: #b8c1cf;
    padding-left: 5%;
    padding-right: 5%;
    padding-top: 5%;
    border-radius: 10px;
}
.container{
    margin-bottom: 100px;
}


</style>
<section>
<h2>Job Notifications List</h2>
<div class="container job">
    <div class="text-right"><a href="{{route('job.add_job')}}" class="btn btn-primary">Add New Job</a></div>
    <div class="row">        
    @foreach ($jobsdata as $item)
        <div class="col-md-4" id="table_data">
            <div class="box">
                           
                            <h4 class="text-center">{{ $item->title }}</h4>
                              <h6>{{ $item->short_discription }}</h6>
                                <div class="row pt-4 pb-1 ml-4">
                                    <div class="col-sm-4"><a href="{{ route('job.job_index',['id' => $item->id]) }}">View</a></div>
                                    <div class="col-sm-4"><a href = "{{ url('/job_Edit',['id' => $item->id]) }}"><i class="fa fa-edit"></i></a></div>
                                    <div class="col-sm-4">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input type="checkbox"  {{ $item->status == '0'?'checked data-toggle="toggle"':''}} id="verified_{{ $item->id }}" class="custom-control-input" value="{{ $item->id }}" onclick="updateStatus(this.value)" >
                                                    <label class="custom-control-label" for="verified_{{ $item->id }}"></label>
                                            
                                        </div>

                                    </div>        
                                            
                                            
                                </div>
                            </div>                
            </div>
        @endforeach
    </div>
    <div class="float-right m-3">
        {{ $jobsdata->links() }}
        </div>
</div>
 
</section>
@endsection


    <script>
    function updateStatus(id){
       $.get("{{ url('job_upload') }}",{id:id},function(res){
        notification(res);
       });
    }
</script>

