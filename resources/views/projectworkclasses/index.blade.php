@extends('layouts.master')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>View Project Work Classes</h3>
            </div>
            <div class="float-right">
           
                <div class="row">
                 
                    <div class="col">
                    <a href="{{route('projectworkclasses.create')}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            Add Project Work Classes
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Class Title</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                 @if(isset($projectworkclass))  
                    @php $i = 0;    @endphp
                            @foreach ($projectworkclass as $key => $pVal)
                                    @php 
                                        if($pVal->status==1) {
                                            $pVal->status = "Active";
                                        } else {
                                            $pVal->status = "In-Active";    
                                        }      
                                    @endphp  
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$pVal->title}}</td>
                                        <td>{{$pVal->status}}</td>
                                        <td>
                                            <div class="kanban-menu">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                                        aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                        <a class="dropdown-item" href="{{ route('projectworkclasses.edit',$pVal->id) }}">
                                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                                        <a class="dropdown-item"  onclick="confirm_modal('{{ route('projectworkclasses.destroy', $pVal->id) }}')">
                                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        <tbody>
                    </table>
                </div>
            </div>


  

@endsection
