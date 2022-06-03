@extends('layouts.master')

@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">OLE</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Media</a></li>
                                <li class="breadcrumb-item active">Media Create</li>
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
                            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                  <label for="staticEmail" class="col-sm-2 col-form-label">Title<span class="validType">*</span></label>
                                  <div class="col-sm-6">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title">
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
                                            <option value="slider">Slider</option>
                                            <option value="middle_slider">Middle Slider</option>
                                            <option value="banner">Banner</option>
                                            <option value="offer">Offer</option>
                                            <option value="career_promo">Career Promo</option>
                                            <option value="curriculum_promo">Curriculum Promo</option>
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
                                        <input type="text" class="form-control" id="url" name="url" placeholder="URL">
                                       
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputPassword" class="col-sm-2 col-form-label">Image <span class="validType">*</span></label>
                                  <div class="col-sm-6">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="" name="image">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                  </div>
                                </div>                               
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="example"></label>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
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
