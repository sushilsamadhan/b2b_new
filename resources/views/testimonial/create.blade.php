@extends('layouts.master')

@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Testimonial</h3>
            </div>
            
        </div>

        <div class="card-body">
        <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Title<span class="validType">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="title" name="title" placeholder="Title" class="form-control @error('title') is-invalid @enderror">
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
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Hindi Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="title_hi" name="title_hi" placeholder="Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">User Type<span class="validType">*</span></label>
                                        <div class="col-sm-9">
                                        <select class="form-control  @error('type') is-invalid @enderror" name="type" id="type">
                                            <option value="Student">Student</option>
                                            <option value="Instructor">instructor</option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                            <!-- <input type="text" class="form-control" id="type" name="type" placeholder="type">
                                        </div> -->
                                        </div>
                                    </div> 
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Rating</label>
                                        <div class="col-sm-9">
                                        <!-- <input type="number" class="form-control" id="rating" name="rating" min="10" max="100" value="10" placeholder="rating"> -->
                                        <select class="form-control  @error('rating') is-invalid @enderror" name="rating" id="rating">
                                            <option value="">Select Rating</option>
                                            <option value="20">1</option>
                                            <option value="25">1.5</option>
                                            <option value="40">2</option>
                                            <option value="45">2.5</option>
                                            <option value="60">3</option>
                                            <option value="65">3.5</option>
                                            <option value="80">4</option>
                                            <option value="85">4.5</option>
                                            <option value="100">5</option>
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
                                            <textarea   name="description" rows="10" cols="50" style="width: 361px;" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label">Hindi Description</label>
                                        <div class="col-sm-9">
                                            <textarea  name="description_hi" rows="10" cols="50" style="width: 361px;" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label">Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control"  name="image">
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
                                </div>
                            </form>
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