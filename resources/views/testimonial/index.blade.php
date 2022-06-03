@extends('layouts.master')

@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Testimonial</h3>
            </div>
            <div class="float-right">
           
                <div class="row">
                 <!--   <div class="col">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control col-12"
                                       placeholder="@translate(Blog Title)" value="{{Request::get('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
                            </div>
                        </form>
                    </div> -->
                    <div class="col">
                    <a href="{{route('testimonial.create')}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            Create Testimonial
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
                                <th>Name</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($testimonials as $key => $testimonial)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->type }}</td>
                                    <td> 
                                    @if($testimonial->image)
                                    <img class="circular--square" src="{{ asset('storage/'.$testimonial->image) }}" alt="images" height="50" width="50">
                                    @endif
                                    <td>{{ strip_tags($testimonial->description) }}</td>
                                    <td>
                                    <!-- <a class="btn btn-info btn-sm" href="#"><i class="fe-eye"></i></a> -->
                                   <!-- <a href="{{ route('testimonial.edit',$testimonial->id) }}"class="btn btn-success btn-sm"><i class="far fa-edit"></i>
                                    <a href="javascript: void(0);"  class="btn btn-danger btn-sm sa-params11"    data-user-id="{{ $testimonial->id }}" data-skin="dark" data-placement="top" data-toggle="kt-tooltip" data-target="#delete_step_modal"  data-original-title="{{__('Delete this Testimonial') }}">
                                    <i class="fe-trash delete"></i>
                                    </a> -->

                                    <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="{{ route('testimonial.edit',$testimonial->id) }}">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        
                                        <a class="dropdown-item"  onclick="confirm_modal('{{ route('testimonial.destroy', $testimonial->id) }}')">
                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                    </div>
                                </div>
                            </div>

                                    </td>
                                </tr>
                                @endforeach
                            <tbody>
                            </table>
        </div>
    </div>

@endsection
