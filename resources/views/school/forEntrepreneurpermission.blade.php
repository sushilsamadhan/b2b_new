<div class="row">


<div class="form-group col-md-12">
    <div class="form-check">
        <label class="form-check-label font-weight-bold" for="defaultCheckDocumentry">Documentry</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('main_category', 'entrepreneur')->where('type', 'p_category')->where('category_id','Documentry')->exists()) checked @endif style="margin-left:20px;" class="form-check-input" type="checkbox" value="Documentry" id="defaultCheckDocumentry" name="p_category[]">   
    </div>
</div>

<div class="form-group col-md-12">
    <div class="form-check">
        <label class="form-check-label font-weight-bold" for="defaultCheckProject-Report">Project Report</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('main_category', 'entrepreneur')->where('type', 'p_category')->where('category_id','Project-Report')->exists()) checked @endif style="margin-left:20px;" class="form-check-input" type="checkbox" value="Project-Report" id="defaultCheckProject-Report" name="p_category[]">   
    </div>
</div>

<div class="form-group col-md-12">
    <div class="form-check">
        <label class="form-check-label font-weight-bold" for="defaultCheckEDP-courses">EDP Courses</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('main_category', 'entrepreneur')->where('type', 'p_category')->where('category_id','EDP-courses')->exists()) checked @endif style="margin-left:20px;" class="form-check-input" type="checkbox" value="EDP-courses" id="defaultCheckEDP-courses" name="p_category[]">   
    </div>
</div>

<div class="form-group col-md-12">
    <div class="form-check">
        <label class="form-check-label font-weight-bold" for="defaultCheckexpert-episote">Expert Episote</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('main_category', 'entrepreneur')->where('type', 'p_category')->where('category_id','expert-episote')->exists()) checked @endif style="margin-left:20px;" class="form-check-input" type="checkbox" value="expert-episote" id="defaultCheckexpert-episote" name="p_category[]">   
    </div>
</div>

<div class="form-group col-md-12">
    <div class="form-check">
        <label class="form-check-label font-weight-bold" for="defaultCheckgovernment-scheme">Government Scheme</label>
        <input @if(\App\Category_permission::where('school_id', $school_id)->where('main_category', 'entrepreneur')->where('type', 'p_category')->where('category_id','government-scheme')->exists()) checked @endif style="margin-left:20px;" class="form-check-input" type="checkbox" value="government-scheme" id="defaultCheckgovernment-scheme" name="p_category[]">   
    </div>
</div>
