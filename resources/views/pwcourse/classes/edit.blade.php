<form action="{{ route('pwcourse.classes.update') }}" method="post">
    @csrf
    {{-- Class Title --}}
    <input type="hidden" name="project_work_id" value="{{$id}}">
    <div class="form-group row is-invalid">
        <label class="col-lg-3 col-form-label" for="val-title">
            @translate(Class Title) <span class="text-danger">*</span></label>
        <div class="col-lg-6">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="val-title"
                   value="{{ $each_class->title }}" name="title" placeholder="@translate(Enter Title)"
                   required>
                   @error('title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
        </div>
    </div>
    <div class="form-group row is-invalid">
        <label class="col-lg-3 col-form-label" for="val-title">
            @translate(Unit)</label>
        <div class="col-lg-6">
            <input type="text" class="form-control @error('unit') is-invalid @enderror" id="val-title"
                   value="{{ $each_class->unit }}" name="unit" placeholder="@translate(Enter Unit)"
                   required>
                   @error('unit') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
        </div>
    </div>
    <div class="form-group row is-invalid">
        <label class="col-lg-3 col-form-label" for="val-sequence">
            @translate(Sequence) </label>
        <div class="col-lg-6">
            <select class="form-control @error('sequence') is-invalid @enderror" id="val-sequence" name="sequence"
                   placeholder="@translate(Enter sequence)"
                   required>
                   @for($i=0;$i<=50;$i++)
                    <option value="{{$i}}" {{($each_class->priority==$i)?'selected':''}}>{{$i}}</option>
                   @endfor                    
            </select>
                   @error('sequence') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary float-left">
        @translate(Submit)</button>
</form>
