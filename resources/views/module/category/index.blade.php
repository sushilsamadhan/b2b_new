@extends('layouts.master')
@section('title','Categories')
@section('parentPageTitle', 'All Category')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(All Categories)</h3>
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
                           onclick="forModal('{{ route("categories.create") }}', '@translate(Category Create)')"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            @translate(Add New Category)
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
                    <th>@translate(Type)</th>
                    <th>@translate(Category)</th>
                    {{-- <th>@translate(Parent Category)</th>--}}
                    <th>@translate(Popular)</th>
                    <th>@translate(Top)</th> 
                    <th>@translate(Publish)</th>
                    {{--<th>Is Compitative</th>
                    <th>@translate(Is Free Study Material)</th>
                    <th>@translate(Is Current Affairs)</th>
                    <th>@translate(Is Project Works)</th>  --}}                  
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as  $item)
                    <tr>
                        <td>{{ ($loop->index+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                        <td>
                            @if($item->icon != null)
                                <img src="{{filePath($item->icon)}}"
                                     class="img-thumbnail rounded-circle avatar-lg" alt="{{$item->name}}">
                            @endif
                        </td>
                         <td>
                           @php
                            $categoryName = '';
                            if($item->is_compitative=='1'){
                                $categoryName = 'Competitive';
                            }elseif($item->is_free_study=='1'){
                                $categoryName = 'Free Study Material';
                            }elseif($item->is_current_affairs=='1'){
                                $categoryName = 'Current Affairs';
                            }elseif($item->is_project_works=='1'){
                                $categoryName = 'Project Works';
                            }elseif($item->is_traditional_course=='1'){
                                $categoryName = 'Traditional Course';
                            }else{
                                $categoryName = 'Board'; 
                            }
                           @endphp
                           {{($item->is_item==1)?'Other':$categoryName}}
                        </td>
                        <td><a href="{{!$item->child->count()?'javascript:void(0)':(route('categories.class',$item->id))}}">{{$item->name}}</a></td>
                        {{-- <td>
                            {{$item->parent->name ?? 'N/A'}}
                        </td>--}}
                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('categories.popular')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-secondary"
                                       id="category-switch" {{$item->is_popular == true ? 'checked' : null}} />
                            </div>
                        </td>
                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('categories.top')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-primary"
                                       id="category-switch" {{$item->top == true ? 'checked' : null}} />
                            </div>
                        </td> 


                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('categories.published')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-success"
                                       id="category-switch" {{$item->is_published == true ? 'checked' : null}} />
                            </div>
                        </td>
                        {{--<td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('categories.compitative')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-success"
                                       id="category-switch" {{$item->is_compitative == true ? 'checked' : null}} />
                            </div>
                        </td>
                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('categories.isfreestudy')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-success"
                                       id="category-switch" {{$item->is_free_study == true ? 'checked' : null}} />
                            </div>
                        </td>
                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('categories.isCurrentAffairs')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-success"
                                       id="category-switch" {{$item->is_current_affairs == true ? 'checked' : null}} />
                            </div>
                        </td>
                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('categories.isProjectWorks')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-success"
                                       id="category-switch" {{$item->is_project_works == true ? 'checked' : null}} />
                            </div>
                        </td>--}}
                        <td>
                            <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="#!"
                                           onclick="forModal('{{ route('categories.edit', $item->id) }}', '@translate(Category Edit)')">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        <!-- <a class="dropdown-item"
                                           onclick="confirm_modal('{{ route('categories.destroy', $item->id) }}')"
                                           href="#!">
                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a> -->
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    {{--<tr></tr>
                    <tr></tr>
                    <tr></tr>--}}
                    <tr>
                        <td colspan="8"><h3 class="text-center">@translate(No Data Found)</h3></td>
                    </tr>
                    {{--<tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>--}}
                @endforelse
                </tbody>
                <div class="float-left">
                    {{ $categories->links() }}
                </div>
            </table>
        </div>
    </div>

@endsection
