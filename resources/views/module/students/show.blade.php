@extends('layouts.master')
@section('title','Profile')
@section('parentPageTitle', 'view')

@section('css-link')
@include('layouts.include.form.form_css')
@stop

@section('page-style')

@stop

@section('content')
<!-- BEGIN:content -->
<div class="card mb-3">
    <div class="py-2 px-3">
        <div class="float-left">
            <h3>@translate(Student Details)</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="row flex-row">
            <div class="col-xl-3">
                <!-- Begin Widget -->
                <div class="widget has-shadow">
                    <div class="widget-body">
                        <div class="text-center">

                            @if($each_student->image != null)
                                <img src="{{filePath($each_student->image)}}" alt="avatar" class="img-fluid rounded-circle avatar-xl">
                            @else
                                <img src="{{url('public/uploads/media_manager/33.png')}}" class="img-fluid rounded-circle avatar-xl" alt="avatar-xl">
                            @endif
                            
                        </div>
                        <h3 class="text-center mt-3 mb-1">{{ $each_student->name }}</h3>
                        <div class="em-separator separator-dashed"></div>
                    </div>
                </div>
                <!-- End Widget -->
            </div>
            <div class="col-xl-9">
                <div class="widget has-shadow">
                    <div class="widget-header bordered no-actions d-flex align-items-center">
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                            <div class="widget-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>

                                    <tr class="text-center">
                                        <td>@translate(Phone)</td>
                                        <td>{{ $each_student->email }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Email)</td>
                                        <td>{{ $each_student->alternate_email_user }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Address)</td>
                                        <td>{{ $each_student->address }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Linked In)</td>
                                        <td><a href={{ $each_student->linked }} target="_blank">{{ $each_student->linked }}</a></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Facebook)</td>
                                        <td><a href={{ $each_student->fb }} target="_blank">{{ $each_student->fb }}</a></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Twitter)</td>
                                        <td><a href={{ $each_student->tw }} target="_blank">{{ $each_student->tw }}</a></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Skype)</td>
                                        <td><a href={{ $each_student->skype }} target="_blank">{{ $each_student->skype }}</a></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>
</div>
<!-- END:content -->
@endsection

@section('js-link')
@include('layouts.include.form.form_js')
@stop

@section('page-script')

@stop
