@extends('layouts.master')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Project Work Category / Sub Category</h3>
            </div>
            <div class="float-right">
           
                <div class="row">
                 
                    <div class="col">
                    <a href="{{route('projectworkcat.create')}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            Add Project Work Category
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
                        <th>Parent Category</th>
                        <th>Sub Category</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($projectworkcat)  && $projectworkcat->count()>0)  
                        @php $i = 0;  @endphp
                        @foreach ($projectworkcat as $key => $pVal)
                            @php  
                                $pSubCat =  getSubCat($pVal->id);
                            @endphp 
                     
                                         
                            @if(count($pSubCat)>0)  
                                
                                    @foreach ($pSubCat as $item)
                                    <tr>   
                                        <td>{{++$i}}</td>
                                        <td>{{$pVal->category_name}}</td>                                
                                        <td>{{$item->category_name}}</td>
                                        <td>{{($item->status==1) ? 'Active' : 'Inactive'}}</td>
                                        <td>
                                            <div class="kanban-menu">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                                        aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                        <a class="dropdown-item" href="{{ route('projectworkcat.edit',$item->id) }}">
                                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                                        {{-- <a class="dropdown-item"  onclick="confirm_modal('{{ route('projectworkcat.destroy', $pVal->id) }}')">
                                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>  --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        </tr>
                                    @endforeach                                   
                                  @else
                                  <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$pVal->category_name}}</td>                                
                                        <td>{{'N/A'}}</td>
                                        <td>{{($pVal->status==1) ? 'Active' : 'Inactive'}}</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                  @endif  
                        @endforeach
                    @endif    
                    <tbody>
                </table>
            </div>
        </div>
@endsection
