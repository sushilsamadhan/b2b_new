@extends('layouts.master')
@section('title','Subscriber List')
@section('parentPageTitle', 'All Subscribers')
@section('content')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<style>

    #discription{
        height: 100px ;
    }
    #submit{
        width: 10%;
        margin-left: 45%;
        margin-top: 2%;
    }
    form{
      padding-left: 5%;
      padding-right: 5%;
      border-color: black;
      
    }
    
   
</style>
<section class="py-3">
            <div class="container">
            <h3>Edit Notification</h3>
            <div class="text-right"><a href="{{route('job.job_list')}}" class="btn btn-primary">Back</a></div>
              <div class="row ">
                <div class="col-md-12">
                            <form class="needs-validation" enctype="multipart/form-data" method="post" id="add_jobs" action="{{ url('job_upload',['id' => $item->id]) }}" novalidate>
                                        <div class=" my-2">
                                            @csrf
                                       
                                            
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group mb-2">
                                                  <label class="text-inverse font-weight-bold small" for="title">Title<span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control form-control-sm" id="title" placeholder="Title" name="title" value = '<?php echo $item->title; ?>' required>
                                                 <div class="invalid-feedback">
                                                   Title required
                                                 </div>
                                              </div>
                                              <div class="form-group mb-2">
                                                  <label class="text-inverse font-weight-bold small" for="short_discription" >Short Discription<span class="text-danger">*</span></label>
                                                  <textarea type="text" class="form-control form-control-sm " id="short_discription" placeholder="Discription in Short" name="short_discription"  required >{{ $item->short_discription }}</textarea>
                                                  <div class="invalid-feedback">
                                                  Short Discription required
                                                 </div>
                                              </div>
                                              <div class="form-group mb-2">
                                                  <label class="text-inverse font-weight-bold small" for="source_url" >Source URL</label>
                                                  <input type="text" class="form-control form-control-sm" value = '<?php echo$item->source_url; ?>' id="source_url" placeholder="Enter URL" name="source_url"  >
                                              </div>
                                              <div class="row"> 
                                                <div class="col-md-6">
                                                    <div class="form-group mb-2">
                                                        <label class="text-inverse font-weight-bold small" for="image" >Upload Image</label>
                                                        <input type="file" class="form-control form-control-sm" value = '<?php echo$item->image; ?>' id="image" placeholder="Discription in Short" name="image" >                                                       
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label class="text-inverse font-weight-bold small" for="catagry_ids" >Catagry Ids<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"  value = '<?php echo$item->catagry_ids; ?>'  id="catagry_ids" placeholder="catagry ids" name="catagry_ids"  required >
                                                            <div class="invalid-feedback">
                                                            Catagry Ids required
                                                            </div>
                                                        </div>
                                                </div>
                                              </div>
                                              <div class="form-group mb-2">
                                                  <label class="text-inverse font-weight-bold small" for="discription" >Full Discription<span class="text-danger">*</span></label>
                                                  <textarea type="text" id="discription"  value = '<?php echo$item->discription; ?>'  class="form-control form-control-sm summernote"  placeholder="Full Discription" name="discription"  required>{{ $item->discription }}</textarea>
                                                  <div class="invalid-feedback">
                                                  Full Discription required
                                                 </div>
                                              </div>
                                          </div>
                                        </div>
                                        
                                        <div class="row ">
                                          <div class="col-md-12">

                                          <input id="submit" type="submit" class="btn btn-info btn-block" value="Update" >   
                                          </div>
                                          
                                        </div> 
                                </form>
                 
                </div>
              </div>
            </div>

         </section>

@endsection


@section('page-script')

<script type="text/javascript">
        $(document).ready(function() {
          $('.summernote').summernote();
        });
    </script>
<script>
(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

@stop