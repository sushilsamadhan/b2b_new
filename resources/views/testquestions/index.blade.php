<script src="{{asset('assets/plugins/tinymce/tinymce4/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image')}}"></script>

@extends('layouts.master')

@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Test Question</h3>
            </div>
            <div class="float-right">
           
                <div class="row">
                    <div class="col">
                    <a href="{{route('testpassages.createpassage')}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            Add Comprehention Passages
                        </a>
                    </div>
                    <div class="col">
                    <a href="{{route('testquestions.create')}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            Add Single Selection Question
                        </a>
                    </div>
                </div>
            </div>
        </div>
<!-- Search Start -->
        <div class="card-header"> 
            <div class="row card m-2 float-right">
                <div class="row-12">
            <form name ="form-search" method="get" action="" class="form-inline">
                <div class="input-group">
                    <input type="text" name="q_tag" class="form-control form-control-sm col-12"
                            placeholder="@translate(Subjetc / Question Tag)" value="{{Request::get('q_tag')}}" 
                            autocomplete="off" required>
                    <div class="input-group-append mr-2">
                        <button class="btn btn-primary btn-sm" type="submit">@translate(Search)</button>
                    </div>
                    </form>    
                    <form name ="form-clear" method="get" action="{{ url('dashboard/testquestions') }}" class="form-inline mb-0">    
                        <div class="input-group-append mr-2">
                            <button class="btn btn-primary btn-sm" type="submit">@translate(Clear)</button>
                         <!--   <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="clearSearch">Clear</a> -->
                        </div>    
                    </div>
                </form>
                </div>
            </div>
        </div>
<!-- Search End -->
        <div class="card-body">
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Q.ID</th>
                        <th>Course Type/Updated On</th>
                        <th>Subject</th>
                        <th style="width:30%">Title</th>
                        <th>Level</th>
                        <th>Type</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                                    
                                    @foreach ($testquestions as $key => $testquestion)

                                    @php 
                                               
                                                

                                                if($testquestion->level_id=='E')
                                                {

                                                    $testquestion->level_id = 'Easy';
                                                }
                                                else if($testquestion->level_id=='M')
                                                {

                                                    $testquestion->level_id = 'Moderate';

                                                }
                                                else if($testquestion->level_id=='D')
                                                {

                                                    $testquestion->level_id = 'Difficult';

                                                }
                                                else
                                                {

                                                    $testquestion->level_id = '';
                                                }


                                            if($testquestion->question_type=='1')
                                            {
                                                $testquestion->question_type = 'Single Selection';
                                            }
                                            else if($testquestion->question_type=='2')
                                            {
                                                $testquestion->question_type = 'Multiple Selection';
                                            } 
                                            else if($testquestion->question_type=='3')
                                            {
                                                $testquestion->question_type = 'Paragraph';
                                            } 
                                            else
                                            {
                                                $testquestion->question_type = '';
                                            }    
                                             $j = $i+1;   
                                            $testId = $testquestion->id.'_'.$j;
                                    @endphp
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $testquestion->id  }}</td>
                                        <td>{{ $testquestion->category_type }}<br>@php echo date('d, M-Y H:i',strtotime($testquestion->updated_at)); @endphp</td>
                                        <td>{{ ($testquestion->coursesTitle!='')?$testquestion->coursesTitle:$testquestion->tag_name }}</td>
                                        <td  style="width:30%"><?php echo html_entity_decode($testquestion->body)?>
                                            @if(isset($testquestion->q_tag))
                                                    @foreach(json_decode($testquestion->q_tag) as $item)
                                                        <span class="badge badge-secondary"> {{ $item }}</span>
                                                    @endforeach
                                            @endif
                                    </td>
                                        <td>{{ $testquestion->level_id }}</td>
                                        <td>{{ $testquestion->question_type }}</td>
                                        <td>
                                    
                                        <div class="kanban-menu">
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                        <div class="dropdown-menu dropdown-menu-right action-btn"
                                            aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                            @if($testquestion->question_type=='Paragraph')
                                            <a class="dropdown-item" target="_blank" href="{{ route('testpassages.editpassage',$testquestion->id) }}">
                                                <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewParaQuestionModal" onClick = "openParaSolution('{{ $testId }}');" >
                                                <i class="feather icon-edit-2 mr-2"></i>@translate(Preview)</a>
                                            @else
                                            <a class="dropdown-item" href="{{ route('testquestions.edit',$testquestion->id) }}">
                                                <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                            
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewQuestionModal" onClick = "openSolution('{{ $testId }}');" >
                                                <i class="feather icon-edit-2 mr-2"></i>@translate(Preview)</a>
                                                @endif
                                            <a class="dropdown-item"  onclick="confirm_modal('{{ route('testquestions.delete', $testquestion->id) }}')">
                                                <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                <tbody>
            </table> <div class="float-right">{{ $testquestions->links() }}</div>
        </div>
    </div>

<!-- Modal viewParaQuestionModal -->
<div class="modal fade" id="viewQuestionModal" tabindex="-1" role="dialog" aria-labelledby="viewQuestionModal" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Question Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="getQuestion">
            </div>
      </div>
    </div>
  </div>
</div>



<!-- modal -->
<div class="modal fade" id="viewParaQuestionModal" tabindex="-1" role="dialog" aria-labelledby="viewParaQuestionModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Question Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="getPara">
        </div>
        
        
      </div>
    </div>
  </div>


@endsection


<script type='text/javascript'>
   
   function openSolution(id){
     
      if(id){
         
          $.ajax({
             type:"get",
             url:"{{url('dashboard/testquestions/viewQuestion')}}/"+id,
             success:function(res)
             {    
                  if(res)
                  {
                      $("#getQuestion").html(res);
                  }
             }
  
          });
          }
     }


     function openParaSolution(id){
     
     if(id){
        
         $.ajax({
            type:"get",
            url:"{{url('dashboard/testquestions/viewParaQuestion')}}/"+id,
            success:function(res)
            {    
                //alert(res);
                 if(res)
                 {
                     $("#getPara").html(res);
                 }
            }
 
         });
         }
    }

     </script>