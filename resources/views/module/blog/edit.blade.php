@extends('layouts.master')
@section('title','blog')
@section('parentPageTitle', 'Edit Blog')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(Edit Blog)</h3>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <a href="{{route('blog.create')}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            @translate(Create Blog)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{route('blog.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$blog->id}}">
                <div class="form-group">
                    <label>@translate(Title) <span class="text-danger">*</span></label>
                    <input type="text" required value="{{ $blog->title}}"
                               class="form-control @error('title') is-invalid @enderror" id="val-title" name="title"
                                aria-required="true" autofocus >
                        @error('title') <span class="invalid-feedback"
                                              role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
 {{-- Slug --}}
                <div class="form-group">
                    <label class="col-lg-3 col-form-label" for="val-slug">
                        @translate(Slug) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text"
                               required value="{{ $blog->blog_slug}}"
                               class="form-control @error('slug') is-invalid @enderror" id="val-slug" name="slug"
                               placeholder="Enter Slug"
                               aria-required="true" {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                        <span id="error_email"></span>
                        @error('slug') <span class="invalid-feedback"
                                             role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label>@translate(Select Category)</label>
                    <select class="form-control select2 w-100" name="category_id" required>
                        <option value="">@translate(Category Select)</option>
                        @foreach($categories as $item)
                            <option value="{{$item->id}}" {{$blog->category_id == $item->id ? 'selected': null}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group">
                    <label>@translate(Select Category)</label>
                    <select class="form-control select2 w-100" name="category_id" required>
                        <option value="">@translate(Category Select)</option>
                    @foreach(categories() as $item)
                        @if($item->child->count() != 0)
                        <optgroup Label="{{$item->name}}">
                        @else
                        <option value="{{$item->id}}" {{$blog->category_id == $item->id ? 'selected': null}}>{{$item->name}}</option>
                        @endif
                            @if($item->child->count() != 0)
                                @foreach($item->child as $child)
                                    <option value="{{$child->id}}" {{$blog->category_id == $child->id ? 'selected': null}}>{{$child->name}}</option>
                                @endforeach
                            </optgroup>
                            @endif                        
                    @endforeach
                    </select>
                </div>
                <div>
                    <img src="{{filePath($blog->img)}}" width="100" height="100">
                </div>
                <div class="form-group">
                    <label class="col-form-label text-md-right">@translate(Primary Image)</label>
                    <div class="custom-file">

                        <input name="icon" class="icon" type="hidden" value="{{$blog->img}}">
                        @error('icon') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        <img class="category_preview rounded shadow-sm d-none" width="55" src="" alt="#Category icon">

                        <br>

                        <input type="hidden" name="category_url" class="category_url" value="{{$blog->img}}">
                        @if (MediaActive())
                            {{-- media --}}
                            <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'category')" class="btn btn-primary media-btn mt-2 p-2">Upload From Media <i class="fa fa-cloud-upload ml-2" aria-hidden="true"></i> </a>
                        @endif

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-tag">
                        @translate(Tags) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="bootstrap-tagsinput">

                            <input type="text"  class="@error('tag') is-invalid @enderror" value="@foreach(json_decode($blog->tags) as $tag){{$tag}},@endforeach"  id="val-tag" name="tag" data-role="tagsinput">
                            @error('tag') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Big description --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-suggestions">
                        @translate(Body)</label>
                    <div class="col-lg-9">
                        <textarea required="required" class="form-control summernote @error('desc') is-invalid @enderror" name="desc" rows="5">{{ $blog->body }}</textarea>
                        @error('desc') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>

                <div class="float-right">
                    <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
                </div>

            </form>
        </div>
    </div>

@endsection


@section('js-link')
    @include('layouts.include.form.form_js')
@stop
@section('page-script')
    <script type="text/javascript" src="{{ asset('assets/js/custom/course.js') }}"></script>
@stop


