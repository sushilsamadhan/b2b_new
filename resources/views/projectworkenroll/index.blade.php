@extends('layouts.master')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>View Project Work Enrollments</h3>
            </div>
            <div class="float-right">
           
                <div class="row">
                 
                    <div class="col">
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Name</th>
                    
                        <!-- <th>School Name</th>
                        <th>Class Title</th> -->
                    
                        <th>Category Title</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                 @if(isset($enrolls))  
                    @php $i = 0;    @endphp
                            @foreach ($enrolls as $key => $pVal)

                                    @php 

                                           if($pVal->status==0)
                                            {
                                                $pVal->status = "New";
                                            }
                                            else if($pVal->status==1)
                                            {
                                                $pVal->status = "Re-Submission";
                                            }
                                            else if($pVal->status==2)
                                            {
                                                $pVal->status = "Submitted";
                                            }
                                            else if($pVal->status==3)
                                            {
                                                $pVal->status = "Approved";
                                            }
                                            else
                                            {
                                                $pVal->status = "Rejected";    
                                            } 
                                              
                                    @endphp  
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$pVal->name}}</td>
                                        <!-- <td>{{$pVal->school_name}}</td>
                                        <td>{{--$pVal->getclassname->class_title--}}</td> -->
                                        <td>{{ $pVal->category_name }}</td>
                                        <td>{{$pVal->status}}</td>

                                        <td>
                                            <div class="kanban-menu">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                                        aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                        <a class="dropdown-item"  onclick="confirm_modal('{{ route('projectworkenroll.destroy', $pVal->id) }}')">
                                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                                        <a class="dropdown-item"  href="{{ url('dashboard/projectworkenroll-details') }}/{{ $pVal->slug }}/{{ $pVal->pwenruser_id}}">
                                                            <i class="fa-solid fa-info mr-2"></i>@translate(Details)</a>
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
