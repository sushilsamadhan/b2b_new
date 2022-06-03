@extends('layouts.master')
@section('title','Subscriber List')
@section('parentPageTitle', 'All Subscribers')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Mentor List</h4>
                <a class="float-right pl-3 rounded-3 btn btn-primary" href="{{route('mentor.index')}}">Add Mentor</a><br><br>
            </div>
            <div class="card-body text-center" >
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>                             
                            <th>Profile Image</th>
                            <th>name</th>
                            <th> profile title</th>
                            <th> phone</th>                                                                               
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mentorsData as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @if($item->photo != null)
                                        <img src="{{filePath( $item->photo)}}" class="img-thumbnail rounded-circle avatar-lg"><br />
                                    @else
                                        <img src="{{url('public/uploads/media_manager/33.png')}}" class="img-thumbnail rounded-circle avatar-lg" alt="avatar"><br />
                                    @endif
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->profile_title }}</td>
                                <td>{{ $item->phone }}</td> 
                                <td>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox"  {{ $item->status == '0'?'checked data-toggle="toggle"':''}} id="verified_{{ $item->id }}" class="custom-control-input" value="{{ $item->id }}" onclick="updateStatus(this.value)" >
                                                <label class="custom-control-label" for="verified_{{ $item->id }}"></label>                                        
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href = "{{ url('/list-detail',['id' => $item->id]) }}"><i class="fa fa-eye"></i> 
                                        </div>
                                        <div class="col-sm-4">                                            
                                            <a href = "{{ url('/list-edit',['id' => $item->id]) }}"><i class="fa fa-edit"></i>                                            
                                        </div>
                                    </div>
                                </td>                                                                                                                                                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function updateStatus(id)
    {
        $.get("{{ url('list-status') }}",{id:id},function(res){
            notification(res);
        });
    }
</script>

@endsection
