<div class="row">
@php
    $pcategory_val = explode(",",$school_pcategory->value);
@endphp
    @foreach($pcategory_val as $coursesval)
@php 
$category = \App\Model\Category::select('*')->where('id', '=', $coursesval)->first();
@endphp 
        <div class="form-group col-md-12">
            <div class="form-check">
                <label class="form-check-label font-weight-bold" for="defaultCheck{{$category->id}}">{{$category->name}}</label>
                <input  @if(\App\Category_permission::where('school_id', $school_id)->where('type', 'p_category')->where('category_id', $category->id)->exists()) checked @endif onclick="workonMessage11(this.value);" style="margin-left:20px;" class="form-check-input checkBoxClass" type="checkbox" value="{{$category->id}}" id="defaultCheck{{$category->id}}" name="p_category[]">   
            </div>
        </div>
@php 
    $sub_category = \App\Model\Category::select('*')->where('parent_category_id', '=', $coursesval)->get();
@endphp 
        @foreach($sub_category as $sub_category_val)
            <div class="form-group col-md-3">
                <div class="form-check">
                    <label class="form-check-label" for="defaultCheck{{$sub_category_val->id}}">{{$sub_category_val->name}}</label>
                    <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 's_category')->where('category_id', $sub_category_val->id)->exists()) checked @endif style="margin-left:20px;" class="form-check-input checkBoxClass-{{$coursesval}}" type="checkbox" value="{{$sub_category_val->id}}" id="defaultCheck{{$sub_category_val->id}}" name="s_category[]">   
                </div>
            </div>
        @endforeach
@endforeach


<div class="form-group col-md-12">
    <div class="form-check">
        <label class="form-check-label font-weight-bold" for="defaultCheckDocumentry">Documentry</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 'p_category')->where('category_id','Documentry')->exists()) checked @endif style="margin-left:20px;" class="form-check-input" type="checkbox" value="Documentry" id="defaultCheckDocumentry" name="p_category[]">   
    </div>
</div>

<div class="form-group col-md-12">
    <div class="form-check">
        <label class="form-check-label font-weight-bold" for="defaultCheckProject-Report">Project Report</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 'p_category')->where('category_id','Project-Report')->exists()) checked @endif style="margin-left:20px;" class="form-check-input" type="checkbox" value="Project-Report" id="defaultCheckProject-Report" name="p_category[]">   
    </div>
</div>

<div class="form-group col-md-12">
    <div class="form-check">
        <label class="form-check-label font-weight-bold" for="defaultCheckEDP-courses">EDP Courses</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 'p_category')->where('category_id','EDP-courses')->exists()) checked @endif style="margin-left:20px;" class="form-check-input" type="checkbox" value="EDP-courses" id="defaultCheckEDP-courses" name="p_category[]">   
    </div>
</div>
