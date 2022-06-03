@extends('layouts.master')
@section('content')

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">OLE</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('service.index') }}">Service</a></li>
                                <li class="breadcrumb-item active">Edit Service</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Service</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <h4 class="header-title">Edit Service</h4>

                                        {!! Form::model($service, ['method' => 'PATCH','files' => 'true','enctype'=>'multipart/form-data','route' => ['service.update', $service->id]]) !!}
                                      
                                        <div class="form-group col-sm-8">
                                        
                                            <label for="staticEmail" class="col-sm-3 col-form-label">Service Name<span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="text" class="form-control @error('service_name') is-invalid @enderror"  value="{{ $service->service_name }}" id="c" name="service_name" placeholder="Title">
                                                @error('service_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-md-8 p-3">
                                            <label class="" for="price">@translate(Price) <span class="text-danger"></span></label>
                                            <div class="">
                                                <input type="number"  class="form-control langr" placeholder="@translate(Enter Price)"  id="price" name="price" value="{{$service->price}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6"> 
                                        
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="">Select Status </option>
                                                    <option value="1" {{ $service->status == '1'? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $service->status == '0'? 'selected' : '' }}>Deactive</option>
                                                </select>
                                                    @error('status')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 p-3">
                                            <label class="" for="description">
                                                @translate(Service Desc) <span class="text-danger"></span></label>
                                                <div class="bootstrap-tagsinput">
                                                    <textarea class="form-control langr" placeholder="@translate(Enter Service Desc)"  id="description" name="description">{{$service->description}}</textarea>
                                                </div>
                                        </div>  
                                
                                    <div class="col-sm-12 text-center" >
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/plugins/tinymce/tinymce4/tinymce.min.js')}}"></script>
<script async="" type="text/javascript" src="https://latex.codecogs.com/editor3.js"></script>
  <script src="{{asset('assets/plugins/tinymce/tinymce4/plugins/tiny_mce_wiris/integration/WIRISplugins.js')}}"></script>
<script type="text/javascript">
var dir = 'ltr';
tinymce.init({
            selector: "#description",            
            height : 100,
            auto_focus:true,
            directionality : dir,
            menubar : 'table',
            plugins: 'image , media, table,codesample',   
            file_picker_types: 'image',        
            toolbar: 'code,|,bold,italic,u code imagenderline,|,cut,copy,paste,|,search,|,undo,redo,|,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,|,tiny_mce_wiris_formulaEditor,tiny_mce_wiris_formulaEditorChemistry,|,fullscreen,|,codesample',
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
@endsection
@section('scripts')


@endsection


