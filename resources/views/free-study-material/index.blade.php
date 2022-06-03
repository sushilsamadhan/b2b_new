@extends('layouts.master')
@section('title','Course Index')
@section('parentPageTitle', 'All Course')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>All Free Study Material</h3>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control col-12"
                                       placeholder="@translate(Category Name)" value="{{Request::get('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <a href="#!"
                           onclick="forModal('{{ route("free-study-material.create") }}', 'Create Free Study Material')"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            Add New Study Material
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
                    <th>@translate(Icon)</th>
                    <th>Study Material</th>
                    <th>Parent Study Material</th>
                    {{-- <th>@translate(Popular)</th>
                    <th>@translate(Top)</th> --}}
                    <th>@translate(Publish)</th>
                    {{-- <th>Is Compitative</th> --}}
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($freeStudyMaterial as  $item)
                    <tr>
                        <td>{{ ($loop->index+1) + ($freeStudyMaterial->currentPage() - 1)*$freeStudyMaterial->perPage() }}</td>
                        <td>
                            @if($item->icon != null)
                                <img src="{{filePath($item->icon)}}"
                                     class="img-thumbnail rounded-circle avatar-lg" alt="{{$item->name}}">
                            @endif
                        </td>
                        <td>{{$item->name}}</td>
                        <td>
                            {{$item->parent->name ?? 'N/A'}}
                        </td>
                        {{-- <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('free-study-material.popular')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-secondary"
                                       id="category-switch" {{$item->is_popular == true ? 'checked' : null}} />
                            </div>
                        </td>
                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('free-study-material.top')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-primary"
                                       id="category-switch" {{$item->top == true ? 'checked' : null}} />
                            </div>
                        </td> --}}


                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('free-study-material.published')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-success"
                                       id="category-switch" {{$item->is_published == true ? 'checked' : null}} />
                            </div>
                        </td>
                        {{-- <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('free-study-material.compitative')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-success"
                                       id="category-switch" {{$item->is_compitative == true ? 'checked' : null}} />
                            </div>
                        </td> --}}
                        <td>
                            <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="#!"
                                           onclick="forModal('{{ route('free-study-material.edit', $item->id) }}', '@translate(Category Edit)')">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        <a class="dropdown-item"
                                           onclick="confirm_modal('{{ route('free-study-material.destroy', $item->id) }}')"
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
                    <tr></tr>
                    <tr>
                        <td><h3 class="text-center">@translate(No Data Found)</h3></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                @endforelse
                </tbody>
                <div class="float-left">
                    {{ $freeStudyMaterial->links() }}
                </div>
            </table>
        </div>
    </div>

    @endsection
    @section('js-link')
    
    @stop
    @section('page-script')
    @stop
