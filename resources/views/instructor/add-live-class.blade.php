@extends('layouts.master')

@section('content')
<style>
    .validType{
        color:red;
    }
</style>
    
<div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Add Live Class</h3>
            </div>
            
        </div>

        <div class="card-body">
        <form action="{{ route('save-live-class') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                        <label for="instructor" class="col-sm-3 col-form-label">Instructor<span class="validType">*</span></label>
                                            <div class="col-sm-9">
                                            <select required class="form-control langr stpicker @error('instructor') is-invalid @enderror" name="instructor" id="instructor">
                                                <option value="">Select Instructor</option>
                                                @foreach($instructors as $instructor)
                                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('instructor')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group row">                                            
                                                <label class="col-sm-3 col-form-label" for="package_type"> @translate(Course Type) <span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                <select class="form-control langr stpicker" id="package_type" name="package_type">
                                                    <option value=""> @translate(Please Select Course Type)</option>
                                                    <option value="board" {{ (old('package_type') == 'board')?'selected':'' }}>Board</option>
                                                    <option value="competitive-courses" {{ (old('package_type') == 'competitive-courses')?'selected':'' }}>Competitive Courses</option>
                                                </select>       
                                            </div>                                                           
                                          </div>
                                    </div>
                                    <div class="col-sm-6" id="board" >
                                        <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Instructor Subject<span class="validType">*</span></label>
                                            <div class="col-sm-9">
                                            <!-- <select class="form-control  @error('instructor_subject') is-invalid @enderror" name="instructor_subject" id="instructor_subject">
                                                <option value="">Select Instructor</option>
                                                @foreach($instructors as $instructor)///
                                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                                @endforeach
                                            </select> -->
                                            
                                            <select class="form-control langr @error('instructor_subject') is-invalid @enderror"
                                        id="val-category_id"  name="instructor_subject_board">
                                        <option value=""> @translate(Please Select)</option>
                                        </select>
                                    
                                            @error('instructor_subject')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="competitive-courses">
                                        <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Instructor Subject<span class="validType">*</span></label>
                                            <div class="col-sm-9">
                                            <!-- <select class="form-control  @error('instructor_subject') is-invalid @enderror" name="instructor_subject" id="instructor_subject">
                                                <option value="">Select Instructor</option>
                                                @foreach($instructors as $instructor)///
                                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                                @endforeach
                                            </select> -->
                                            
                                            <input type="text" name="instructor_subject" class="form-control langr @error('instructor_subject') is-invalid @enderror"
                                        id="val-category_id" >
                                        @error('instructor_subject')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Live Class Title<span class="validType">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" required id="live_class_title" name="live_class_title" placeholder="Live Class Title" class="form-control @error('live_class_title') is-invalid @enderror">
                                                @error('live_class_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Date<span class="validType">*</span></label>
                                            <div class="col-sm-9">
                                            <input type="date" required id="date" name="date" placeholder="date" class="form-control @error('date') is-invalid @enderror">
                                            @error('date')
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
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Start Time<span class="validType">*</span></label>
                                            <div class="col-sm-9">
                                            <input type="time" required id="start_time" name="start_time" placeholder="Start Time" class="form-control @error('start_time') is-invalid @enderror">
                                            @error('start_time')
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
                                            <label for="staticEmail" class="col-sm-3 col-form-label">End Time<span class="validType">*</span></label>
                                            <div class="col-sm-9">
                                            <input type="time" required id="end_time" name="end_time" placeholder="End Date" class="form-control @error('end_time') is-invalid @enderror">
                                            @error('end_time')
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
                                            <label for="staticEmail" class="col-sm-3 col-form-label">live URL<span class="validType">*</span></label>
                                            <div class="col-sm-9">
                                            <input type="text" required id="live_url" name="live_url" placeholder="Live url" class="form-control @error('live_url') is-invalid @enderror">
                                            @error('live_url')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Status<span class="validType">*</span></label>
                                            <div class="col-sm-9">
                                            <select required class="form-control  @error('status') is-invalid @enderror" name="status" id="status">
                                                <option value="">Select status</option>
                                                    <option value="draft">Draft</option>
                                                    <option value="publish">Publish</option>
                                                    <option value="unplblish">Unpublish</option>
    
                                            </select>
                                             @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                                </div>
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
@section('page-script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type='text/javascript'>
    $(document).on('change', '#instructor', function(){    
    var instructor = $(this).val();
            $.ajax({
                type:'POST',
                url:'{{ route("instructByCourseType") }}',
                headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{'instructor':instructor},
                success: function (response) {  
                    console.log(response)                  
                    var optstring = '<option value="">Please Select</option>'+"\r\n";
                    $(response.data).each(function(key,val){
                        if(val.tag_name){
                            optstring += '<option value="'+val.subject_id+'">'+val.tag_name+'</option>'+"\r\n";
                        } else if(val.content_type=='board'){
                            optstring += '<option value="'+val.subject_id+'">'+val.name+' '+val.subCat+' - '+val.title+'</option>'+"\r\n";
                        } else {
                            optstring += '<option value="'+val.subject_id+'">'+val.name+'</option>'+"\r\n";
                        }   
                    });
                    $('#val-category_id').html(optstring);           
                }
            });
        });

      
    $('#competitive-courses').hide();

    $(function () {

$("#package_type").change(function () {
    if ($(this).val() == "competitive-courses") {
        $("#competitive-courses").show();
        $("#board").hide();
    }
    else if ($(this).val() == "board") {
        $("#board").show();
        $("#competitive-courses").hide();
    }

});
});
</script>
@endsection