@extends('layouts.master')
@section('title','Course Create')
@section('parentPageTitle', 'Course')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')

    <!-- BEGIN:content -->
    <div class="card m-b-30">
        
        
        <div class="row">
                <div class="col-md-9">
                    <h4 class="card-header">@translate(Edit Question)</h4>
                </div>
                <div class="col-md-3 text-right m-t-20 p-3">
                    <a href="javascript:window.history.back();" class="btn btn-outline-success" type="button"> @translate(Back)</a>
                </div>
        </div>
        <div class="card-body mx-3">
        <form action="{{route('questions.update')}}" method="post"  enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{$question->id}}" >
    <input type="hidden" name="status" value="{{$question->status}}" >
    @csrf
    <div class="row">
        {{--
        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Questions Title) <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" required
                       value="{{ $question->question }}"
                       class="form-control @error('title') is-invalid @enderror"
                       name="title" placeholder="@translate(Enter Questions Title)" aria-required="true"
                       autofocus>
                @error('title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>
        </div> --}}

        <div class="form-group col-md-6 p-3">
            <label class="" for="questitle1">
                @translate(Questions Title) <span class="text-danger">*</span></label>
            <div class="">
                <textarea
                        id="questitle1"
                        class="form-control ques-class @error('title') is-invalid @enderror"
                        name="title" placeholder="@translate(Enter Questions Title)" aria-required="true"
                        >{{ $question->question }}</textarea>
                @error('title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Correct Answer Mark)</label>
            <div class="">
                <input type="number" required
                       value="{{ $question->grade }}"
                       class="form-control"
                       name="grade" placeholder="@translate(Correct Answer Mark)" aria-required="true"
                       autofocus>
            </div>
        </div>
    </div>

    {{--here the question answer field--}}
    <hr>

    <div class="row">
        <table class="table table-bordered answer-form-table">
            <tbody class="input-append">
            @foreach(json_decode($question->options,true) as $ns)
            <tr class="border border-primary">
                <input type="hidden" required value="{{$ns['index']}}" name="index[]">

                <td>
                    <div class="form-group">
                        <label>@translate(Question Answer)</label>
                        <input type="text" required
                               class="form-control" value="{{$ns['answer']}}" name="answer[]" placeholder="@translate(Write Answer)">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label>@translate(Image)</label>
                        <input type="file" class="form-control-file" placeholder="Select Image"
                               name="image[]">
                        @if($ns['image'] != null)
                            <a target="_blank" href="{{filePath($ns['image'])}}">@translate(click to see image)</a>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label>@translate(Correct)</label>
                        <select class="form-control" name="correct[]" required>
                            <option value="false" {{$ns['correct'] == "false" ? 'selected' : null}}>@translate(False)</option>
                            <option value="true" {{$ns['correct'] == "true" ? 'selected' : null}}>@translate(True)</option>
                        </select>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <button class="btn btn-outline-success" type="submit"> @translate(Submit)</button>
</form>

        </div>
    </div>
    
@endsection
@section('js-link')
    @include('layouts.include.form.form_js')
@stop
@section('page-script')
<script type="text/javascript" src="{{ asset('assets/js/custom/course.js') }}"></script>
<script>var bootstrapButton = $.fn.button.noConflict()</script>
<script src="{{asset('assets/plugins/tinymce/tinymce4/tinymce.min.js')}}"></script>
<script src="{{asset('assets/plugins/tinymce/tinymce4/plugins/tiny_mce_wiris/integration/WIRISplugins.js')}}"></script>
<script type="text/javascript">
var dir = 'ltr';
tinymce.init({
            selector: "#questitle1",            
            height : 300,
            auto_focus:true,
            directionality : dir,
            menubar:'table',
            plugins: 'table,tiny_mce_wiris',
            toolbar: 'code,|,bold,italic,underline,|,cut,copy,paste,|,search,|,undo,redo,|,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,|,tiny_mce_wiris_formulaEditor,tiny_mce_wiris_formulaEditorChemistry,|,fullscreen',
            wirisimagebgcolor: '#FFFFFF',
            wirisimagesymbolcolor: '#000000',
            wiristransparency: 'true',
            wirisimagefontsize: '16',
            wirisimagenumbercolor: '#000000',
            wirisimageidentcolor: '#000000',            
            setup : function(ed)
            {
                ed.on('init', function()
                {
                    this.getDoc().body.style.fontSize = '16px';
                    this.getDoc().body.style.fontFamily = 'Arial, "Helvetica Neue", Helvetica, sans-serif';
                });
            },
        });
</script>
<script type="text/javascript" src="{{asset('assets/plugins/tinymce/js/prism.js')}}"></script>
    <script>
        "use strict"
        var count = 0;
        $('#add-answer').on('click', function () {
            count++;
            var clone = $(".answer-form-table tbody tr:first").clone();
            clone.attr({
                id: "emlRow_" + count,
            });
            clone.find(".remove").each(function () {
                $(this).attr({
                    id: $(this).attr("id") + count,
                });
            });

            $(".answer-form-table  tbody").append(clone);
        });

        function deleteTr(id) {
            $('#emlRow_' + id).remove();
        }
    </script>
@stop
