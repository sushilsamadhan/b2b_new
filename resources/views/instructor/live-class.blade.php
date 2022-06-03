@extends('layouts.master')
@section('title','Instructor List')
@section('parentPageTitle', 'All Student')
@section('content')
<div class="card mx-2 mb-3">
    <div class="card-header">
        <div class="float-left">
            <h3>@translate(Instructors Live Class)</h3>
        </div>
        <div class="float-right">
            <div class="row">
                <div class="col">
                    <form method="get" action="">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control col-12" placeholder="@translate(Search by name)" value="{{Request::get('search')}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    @translate(Search)</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>

    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="text-center">
                    <th>S/L</th>
                    <th>
                        @translate(Instructor)
                    </th>
                    <th>
                        @translate(Instructor Subject)</th>
                    <th>
                        @translate(Title)</th>
                    <th>
                        @translate(Date)</th>
                    <th>
                        @translate(Start Time)</th>
                    <th>
                        @translate(End Time)</th>
                    <th>
                    @translate(url)</th>
                    <th>
                        @translate(Action)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($instructors as $item)
                <tr>
                    <td>{{ ($loop->index+1) + ($instructors->currentPage() - 1)*$instructors->perPage() }}</td>
                    <td class="text-center">
                    @if($item->instructorDetail)
                     {{ $item->instructorDetail->name }}
                    @endif
                    </td>
                    <td>
                        @php 
                            $subject = \App\Model\Course::where('id' , $item->instructor_subject_id)->first();
                        @endphp
                        @if($subject)
                            {{ $subject['title'] }}
                        @else

                            {{ $item->instructor_subject_id }}

                        @php

                        // $subject = \App\QuestionTag::where('id' , $item->instructorDetail->id)->first();
                     
                        @endphp
                            {{-- $subject['tag_name'] --}}
                        @endif

                    </td>
                    <td>{{$item->live_class_title}}</td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->start_time }}
                    </td>
                    <td>{{$item->end_time }}
                    </td>
                    <td>{{$item->url }}
                    </td>
                    <td>
                        <div class="kanban-menu">
                            <div class="dropdown">
                                <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button" id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                <div class="dropdown-menu dropdown-menu-right action-btn" aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                <a class="dropdown-item" href="{{ route('edit-live-class', $item->id) }}">
                                        <i class="feather icon-edit-2 mr-2"></i>
                                        @translate(Edit)</a>
                                <a class="dropdown-item"
                                           onclick="confirm_modal('{{ route('delete-live-class', $item->id) }}')"
                                           href="#!">
                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                  
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr></tr>
                    <tr></tr>
                <tr>
                    <td><h3 class="text-center">No Data Found</h3></td>
                </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                @endforelse
            </tbody>
            <div class="float-left">
                {{ $instructors->links() }}
            </div>
        </table>
    </div>
</div>

@endsection
