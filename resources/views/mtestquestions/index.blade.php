@extends('layouts.master')

@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Mock Test Section</h3>
            </div>
            <div class="float-right">
           
                <div class="row">
                 
                    <div class="col">
                    <a href="{{route('mtestsections.create')}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            Add Mock Test Section
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
                        <th>Test name</th>
                        <th>Section</th>
                        <th style="width:30%">Question No.</th>
                        <th>Question Time</th>
                        <th>Question Value</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                 @if(isset($mtestsections))  
                   
                            @foreach ($mtestsections as $key => $mtestsection)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$mtestsection->name}}</td>
                                        <td>{{$mtestsection->section_name}}</td>
                                        <td>{{$mtestsection->no_of_question}}</td>
                                        <td>{{$mtestsection->section_time}}</td>
                                        <td>{{$mtestsection->question_value}}</td>
                                        <td>{{($mtestsection->status == '1')?'Active':'In-Active' }}</td>
                                        <td>
                                            <div class="kanban-menu">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                                        aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                        <a class="dropdown-item" href="{{ route('mtestsections.edit',$mtestsection->id) }}">
                                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                                        <a class="dropdown-item"  onclick="confirm_modal('{{ route('mtestsections.destroy', $mtestsection->id) }}')">
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
                    <div class="float-left">
                        {{ $mtestsections->links() }}
                    </div>
                </div>
            </div>
@endsection
