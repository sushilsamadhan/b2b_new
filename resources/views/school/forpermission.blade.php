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
                <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 'p_category')->where('category_id', $category->id)->exists()) checked @endif onclick="workonMessage11(this.value);" style="margin-left:20px;" class="form-check-input checkBoxClass" type="checkbox" value="{{$category->id}}" id="defaultCheck{{$category->id}}" name="p_category[]">   
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


<!-- STUDY MATERIAL -->
<div class="form-group col-md-12">
    <div class="form-check">
        <label class="form-check-label font-weight-bold" for="defaultCheckSTUDY-MATERIAL"> STUDY MATERIAL </label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 'p_category')->where('category_id', 'STUDY-MATERIAL')->exists()) checked @endif onclick="workonMessage11(this.value);" style="margin-left:20px;" class="form-check-input checkBoxClass" type="checkbox" value="STUDY-MATERIAL" id="defaultCheckSTUDY-MATERIAL" name="p_category[]">   
    </div>
</div>
<div class="form-group col-md-3">
    <div class="form-check">
        <label class="form-check-label" for="defaultCheck-class-6-to-8">Class 6 to 8</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 's_category')->where('category_id', 62)->exists()) checked @endif style="margin-left:20px;" class="form-check-input checkBoxClass-STUDY-MATERIAL" type="checkbox" value="62" id="defaultCheck-class-6-to-8" name="s_category[]">   
    </div>
</div>
<div class="form-group col-md-3">
    <div class="form-check">
        <label class="form-check-label" for="defaultCheck-class-9-to-12">Class 9 to 12</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 's_category')->where('category_id', 65)->exists()) checked @endif style="margin-left:20px;" class="form-check-input checkBoxClass-STUDY-MATERIAL" type="checkbox" value="65" id="defaultCheck-class-9-to-12" name="s_category[]">   
    </div>
</div>

<!-- Project Work -->
<div class="form-group col-md-12">
    <div class="form-check">
        <label class="form-check-label font-weight-bold" for="defaultCheckproject-work"> Project Work </label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 'p_category')->where('category_id', 'project-work')->exists()) checked @endif onclick="workonMessage11(this.value);" style="margin-left:20px;" class="form-check-input checkBoxClass" type="checkbox" value="project-work" id="defaultCheckproject-work" name="p_category[]">   
    </div>
</div>
<div class="form-group col-md-3">
    <div class="form-check">
        <label class="form-check-label" for="defaultCheck-college-level">College Level</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 's_category')->where('category_id', 'college-level')->exists()) checked @endif style="margin-left:20px;" class="form-check-input checkBoxClass-project-work" type="checkbox" value="college-level" id="defaultCheck-college-level" name="s_category[]">   
    </div>
</div>
<div class="form-group col-md-3">
    <div class="form-check">
        <label class="form-check-label" for="defaultCheck-school-level">School Level</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('type', 's_category')->where('category_id', 'school-level')->exists()) checked @endif style="margin-left:20px;" class="form-check-input checkBoxClass-project-work" type="checkbox" value="school-level" id="defaultCheck-school-level" name="s_category[]">   
    </div>
</div>
