@extends('layouts.master')
@section('title','Webinar Create')
@section('parentPageTitle', 'Webinar')
@section('css-link')
@include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
<!-- BEGIN:content -->
<div class="card m-b-30">
    <h4 class="card-header">@translate(Add New Webinar)</h4>
    <div class="card-body mx-3">
        <form action="{{ route('webinar.store') }}" method="post"  enctype="multipart/form-data">
            @csrf    
            {{-- Webinar Topic --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-tpoic">
                    @translate(Webinar Topic) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="text" required
                           value="{{ old('topic') }}" 
                           class="form-control @error('topic') is-invalid @enderror"
                           id="val-topic" name="topic" placeholder="@translate(Enter Webinar Topic)" aria-required="true" autofocus>
                      @error('topic') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
            </div>

            {{-- Start Date --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-start_date">
                    @translate(Webinar Start Date) <span class="text-danger">*</span></label>
                <div class="col-lg-3">
                <input type="datetime-local" value="{{ old('start_date') }}" id="start_date" class="form-control" name="start_date" 
                                placeholder="@translate(Webinar Start Date)" aria-required="true" autofocus required>
                      @error('start_date') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
            </div>

            {{-- End Date --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-end_date">
                    @translate(Webinar End Date) <span class="text-danger">*</span></label>
                <div class="col-lg-3">
                <input type="datetime-local" value="{{ old('end_date') }}" id="end_date" class="form-control" name="end_date" 
                                placeholder="@translate(Webinar End Date)" aria-required="true" autofocus required>
                      @error('end_date') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
                <span id="end_date_error" class="text-danger">End date should be greater than Start date.</span>
            </div>

            {{-- Topic Description --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-suggestions">
                    @translate(Topic Description)<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <textarea required="required" class="form-control summernote @error('topic_description') is-invalid @enderror" name="topic_description" rows="5" aria-required="true">{!! old('topic_description') !!}</textarea>
                      @error('topic_description') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
            </div>

            {{-- Webinar Thumbnail --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-img">
                    @translate(Webinar Thumbnail) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="hidden" required value="{{ old('image') }}" class="form-control course_image @error('image') is-invalid @enderror" id="val-img" name="image">
                    <img class="w-50 course_thumb_preview rounded shadow-sm d-none" src="" alt="#Course thumbnail">
                    @error('image') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                      <input type="hidden" name="webinar_thumb_url" class="course_thumb_url" value="">
                    <br>
                      @if (MediaActive())
                       {{-- media --}}
                      <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'thumbnail')" class="btn btn-primary media-btn mt-2 p-2">Upload From Media <i class="fa fa-cloud-upload ml-2" aria-hidden="true"></i> </a>
                      @endif
                </div>
            </div>

            {{-- Recorded Video URL --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-website">
                    @translate(Recorded Video URL) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="url" required value="{{ old('recorded_video_url') }}" class="form-control @error('overview_url') is-invalid @enderror" id="val-website" name="recorded_video_url" placeholder="Recorded Video URL" aria-required="true">
                      @error('recorded_video_url') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
            </div>

            {{-- Type --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-type">
                    @translate(Type) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select class="form-control lang @error('type') is-invalid @enderror" id="val-type" name="type" required>
                        <option value="">
                            @translate(Select Type)</option>
                        <option value="Industrial">
                            @translate(Industrial)</option>
                        <option value="Professional">
                            @translate(Professional)</option>
                        <option value="Technical">
                            @translate(Technical)</option>
                    </select>
                </div>
                @error('type') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>

            {{-- Is Live--}}
            <div class="form-group row free-hide">
                <label class="col-lg-3 col-form-label" for="">
                    @translate(Is Live)</label>
                <div class="col-lg-9">
                  <div class="switchery-list">
                      <input type="checkbox" name="is_live" class="js-switch-success" id="val-is_live"/>
                      @error('is_live') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                  </div>
                </div>
            </div>

            {{-- Live URL --}}
            <div class="form-group row" id="val-live_url">
                <label class="col-lg-3 col-form-label">
                    @translate(Live URL)</label>
                <div class="col-lg-9">
                    <div class="bootstrap-tagsinput">
                        <input type="text"  value="{{old('live_url')}}" class="@error('live_url') is-invalid @enderror" placeholder="@translate(Enter Live URL)"  name="live_url" data-role="tagsinput">
                          @error('live_url') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>
            </div>

            {{-- Presented By --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-presented_by">
                    @translate(Presented By) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <div class="bootstrap-tagsinput">
                        <input type="text"  value="{{old('presented_by')}}" class="@error('presented_by') is-invalid @enderror" placeholder="@translate(Enter Presented By)" required  id="val-presented_by" name="presented_by" data-role="tagsinput">
                          @error('presented_by') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>
            </div>
         
            {{-- Submit --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label"></label>
                <div class="col-lg-8">
                    <button type="submit" class="btn btn-primary">
                        @translate(Submit)</button>
                </div>
            </div>
        </form>
       
    </div>


    </div>
</div>


<!-- END:content -->
@endsection
@section('js-link')
@include('layouts.include.form.form_js')
@stop
@section('page-script')
<script type="text/javascript" src="{{ asset('assets/js/custom/course.js') }}"></script>
<script type="text/javascript">
    $( document ).ready(function() { 
        $("#end_date_error").hide();
        $("#end_date").change(function () {
            var startDate = document.getElementById("start_date").value;
            var endDate = document.getElementById("end_date").value;
            
            if ((Date.parse(endDate) <= Date.parse(startDate))) {
                document.getElementById("end_date").value = "";
                $("#end_date_error").show();
            } else {
                $("#end_date_error").hide(); 
                document.getElementById("end_date_error").text = "";
            }
        });
    });
    
    $(function () {
        $("#val-is_live").ready(function () {
            var att = $('#val-is_live').is(":checked");
            if (!att) {
                $("#val-live_url").hide();
            } else {
                $("#val-live_url").show();
            }

        });

        $("#val-is_live").change(function () {
            if ($(this).is(":checked")) {
                $("#val-live_url").show();
            } else {
                $("#val-live_url").hide();
            }
        });
    });
</script>
@stop

