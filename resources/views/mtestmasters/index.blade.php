@extends('layouts.master')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Mock Test Masters</h3>
            </div>
            <div class="float-right">
           
                <div class="row">
                 
                    <div class="col">
                    <a href="{{route('mtestmasters.create')}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            Add Mock Test Masters
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
                        <th>Course Type</th>
                        <th>Category</th>
                        <th style="width:30%">Name</th>
                        <th>Available On</th>
                        <th>Test Type</th>
                        <th>Total No. Of Question</th>
                        <th>Total Time(HH:MM)</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                 @if(isset($mtestmasters))  
                    @php $i = 0;    @endphp
                            @foreach ($mtestmasters as $key => $mtestmaster)

                                    @php 

                                   
                                            if(!empty($mtestmaster->status) && $mtestmaster->status==0)
                                            {
                                                $mtestmaster->status = "Draft";
                                            }
                                            else if(!empty($mtestmaster->status) && $mtestmaster->status==1)
                                            {
                                                $mtestmaster->status = "Publish";
                                            }
                                            else if(!empty($mtestmaster->status) && $mtestmaster->status==2)
                                            {
                                                $mtestmaster->status = "Un-Publish";
                                            }
                                            else
                                            {
                                                $mtestmaster->status = "Draft";
                                            }

                                            if($mtestmaster->available_on==0)
                                            {
                                                $mtestmaster->available_on = "Free";
                                            }
                                            else if($mtestmaster->available_on==1)
                                            {
                                                $mtestmaster->available_on = "Paid";
                                            }else
                                            {
                                                $mtestmaster->available_on = "Free";    
                                            } 
                                              
                                    @endphp  
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$mtestmaster->course_type}}</td>
                                        <td>{{$mtestmaster->catName}}</td>
                                        <td>{{$mtestmaster->name}}</td>
                                        <td>{{$mtestmaster->available_on}}</td>  
                                        <td>{{$mtestmaster->test_type}}</td>
                                        <td>{{$mtestmaster->total_no_of_question}}</td>
                                        <td>{{$mtestmaster->total_time}}</td>
                                        <td>{{$mtestmaster->status}}</td>
                                        <td>
                                            <div class="kanban-menu">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                                        aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewMTModal" onClick = "openMTSection('{{ $mtestmaster->id }}');" >
                                                        <i class="feather icon-edit-2 mr-2"></i>@translate(Preview)</a>

                                                        <a class="dropdown-item" href="{{ route('mtestmasters.edit',$mtestmaster->id) }}">
                                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                                        <a class="dropdown-item"  onclick="confirm_modal('{{ route('mtestmasters.destroy', $mtestmaster->id) }}')">
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


            <!-- Modal viewParaQuestionModal -->
<div class="modal fade" id="viewMTModal" tabindex="-1" role="dialog" aria-labelledby="viewMTModal" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mock Test Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="getMT">
            </div>
      </div>
    </div>
  </div>
</div>


<script type='text/javascript'>
   
   function openMTSection(id){
     
      if(id){
         
          $.ajax({
             type:"get",
             url:"{{url('dashboard/mtestmasters/viewMTSection')}}/"+id,
             success:function(res)
             {    
                  if(res)
                  {
                      $("#getMT").html(res);
                  }
             }
  
          });
          }
     }

     </script>
@endsection
