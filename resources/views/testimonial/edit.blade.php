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
 
        {!! Form::model($testimonial, ['method' => 'PATCH','files' => 'true','enctype'=>'multipart/form-data','route' => ['testimonial.update', $testimonial->id]]) !!}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Title<span class="validType">*</span></label>
                                                    <div class="col-sm-9">
                                                            <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title" value="{{ $testimonial->name }}" placeholder="Title">
                                                            @error('title')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Hindi Title<span class="validType">*</span></label>
                                                    <div class="col-sm-9">
                                                            <input type="text" class="form-control @error('title_hi') is-invalid @enderror" id="title_hi" name="title_hi" placeholder="Title" value="{{ $testimonial->name_hi }}">
                                                            @error('title_hi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-sm-6"> 
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-3 col-form-label @error('type') is-invalid @enderror">User Type<span class="validType">*</span></label>
                                                    <div class="col-sm-9">
                                                    <select class="form-control" name="type" id="type">
                                                        <option value="Student" {{ $testimonial->type == 'Student' ? 'selected' : ''}}>Student</option>
                                                        <option value="Instructor" {{ $testimonial->type == 'Instructor' ? 'selected' : ''}}>Instructor</option>
                                                    </select>
                                                </div>
                                                </div>
                                            </div>    
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-3 col-form-label">Rating<span class="validType">*</span></label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control  @error('rating') is-invalid @enderror" name="rating" id="rating">
                                                            <option value="">Select Rating</option>
                                                            <option {{ $testimonial->rating == 20 ? 'selected' : ''}} value="20">1</option>
                                                            <option {{ $testimonial->rating == 25 ? 'selected' : ''}} value="25">1.5</option>
                                                            <option {{ $testimonial->rating == 40 ? 'selected' : ''}} value="40">2</option>
                                                            <option {{ $testimonial->rating == 45 ? 'selected' : ''}} value="45">2.5</option>
                                                            <option {{ $testimonial->rating == 60 ? 'selected' : ''}} value="60">3</option>
                                                            <option {{ $testimonial->rating == 65 ? 'selected' : ''}} value="65">3.5</option>
                                                            <option {{ $testimonial->rating == 80 ? 'selected' : ''}} value="80">4</option>
                                                            <option {{ $testimonial->rating == 85 ? 'selected' : ''}} value="85">4.5</option>
                                                            <option {{ $testimonial->rating == 100 ? 'selected' : ''}} value="100">5</option>
                                                        </select>
                                                        @error('rating')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div> 
                                             </div>
                                       
                                        <div class="col-sm-6"> 
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Description</label>
                                                <div class="col-sm-9">
                                                    <textarea  class="form-control" rows="10" cols="50" name="description" style="width: 361px;" >{{ $testimonial->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Hindi Description</label>
                                                <div class="col-sm-9">
                                                    <textarea  rows="10" cols="50"  name="description_hi" style="width: 361px;" >{{ $testimonial->description_hi }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @if($testimonial->image)
                                        <div class="col-sm-12">
                                            <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                                        
                                            <img src="{{ asset('storage/'.$testimonial->image) }}" alt="images" height="100" width="100">
                                        </div>
                                        @endif
                                        <div class="col-sm-6">       
                                            <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Image(60*60 Px)</label>
                                           
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" id="" name="image" value="{{ $testimonial->image }}">
                                            </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12 text-center"> 
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="example"></label>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        </div>
                                       
                                        {!! Form::close() !!}
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
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ],
        });
    });
</script>
@endsection