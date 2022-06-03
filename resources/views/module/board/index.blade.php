@extends('layouts.master')
@section('title','Boards')
@section('parentPageTitle', 'All Boards')
@section('content')

<div class="card m-2">
        <div class="card-header">
            <div class="float-left">
            <h3>@translate(All Boards)</h3>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control col-12"
                                       placeholder="@translate(Board Name)" value="{{Request::get('search')}}" >
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <a href="#!"
                        onclick="forModal('{{ route("boards.create") }}', '@translate(Board Create)')"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            @translate(Add New Board)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped- table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>S/L</th>
                    <!-- <th>Icon</th> -->
                    <th>Board Name</th>
                    <th>Board State</th>
                    <th>Description</th>
                    
                    <th>Publish</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($boards as  $item)
                    <tr>
                    <td>{{ ($loop->index+1) + ($boards->currentPage() - 1)*$boards->perPage() }}</td>
                        <!-- <td>
                           
                                <img src=""
                                     class="img-thumbnail rounded-circle avatar-lg" alt="">
                            
                        </td> -->
                        <td>{{$item->name}}</td>
                        <td>{{$item->board_state}}</td>
                        <td>
                        {{$item->description}}
                        </td>
                       


                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('boards.published')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-success"
                                       id="category-switch" {{$item->is_published == true ? 'checked' : null}} />
                            </div>
                        </td>
                        <td>
                        <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="#!"
                                           onclick="forModal('{{ route('boards.edit', $item->id) }}', '@translate(Board Edit)')">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        <a class="dropdown-item"
                                           onclick="confirm_modal('{{ route('boards.destroy', $item->id) }}')"
                                           href="#!">
                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                    </div>
                                </div>
                            </div> 
                        </td>
                    </tr>
               
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td><h3 class="text-center"></h3></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    @endforeach
                </tbody>
                <div class="float-left">
                {{ $boards->links() }}
                </div>
            </table>
        </div>
    </div>
@endsection