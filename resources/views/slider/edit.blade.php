@extends('layouts.master')

@section('content')

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">OLE</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Media</a></li>
                                <li class="breadcrumb-item active">Edit Media list</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Media Management</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <h4 class="header-title">Edit Media</h4>

                                        {!! Form::model($slider, ['method' => 'PATCH','files' => 'true','enctype'=>'multipart/form-data','route' => ['slider.update', $slider->id]]) !!}

                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label">Title  <span class="validType">*</span></label>
                                          <div class="col-sm-6">
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $slider->name }}" placeholder="Title">
                                             @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Type <span class="validType">*</span></label>
                                            <div class="col-sm-6">
                                                <select class="form-control @error('type') is-invalid @enderror" name="type">
                                                    <option value="">Select Type</option>
                                                    <option value="slider" {{ $slider->type  == 'slider' ? 'selected' : ''}}>Slider</option>
                                                    <option value="offer" {{ $slider->type  == 'offer' ? 'selected' : ''}} >Offer</option>
                                                    <option value="middle_slider" {{ $slider->type  == 'middle_slider' ? 'selected' : ''}}>Middle Slider</option>
                                                    <option value="banner" {{ $slider->type  == 'banner' ? 'selected' : ''}}>Banner</option>
                                                    <option value="career_promo" {{ $slider->type  == 'career_promo' ? 'selected' : ''}}>Career Promo</option>
                                            <option value="curriculum_promo" {{ $slider->type  == 'curriculum_promo' ? 'selected' : ''}}>Curriculum Promo</option>
                                                </select>
                                                @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="url" name="url" placeholder="URL" value="{{ $slider->url }}">
                                    </div>
                                    </div>
                                        <div class="form-group row">
                                          <label for="inputPassword" class="col-sm-2 col-form-label">Image <span class="validType">*</span></label>
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                          <div class="col-sm-6">
                                                <input type="file" class="form-control" id="" name="image" value="{{ $slider->image }}">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="example"></label>
                                            <div class="col-sm-6">
                                                <img src="{{ asset('storage/'.$slider->image) }}" class="@error('image') is-invalid @enderror" alt="images" height="200" width="500">
                                            </div>
                                        </div>   
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="example"></label>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                             
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('textarea#summernote').summernote({
            placeholder: 'Enter Your description..',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                //['font', ['bold', 'italic', 'underline', 'clear']],
                 ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                //['fontname', ['fontname']],
            // ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                //['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ],
        });
    });
</script>
@endsection


