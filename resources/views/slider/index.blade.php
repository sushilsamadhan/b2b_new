@extends('layouts.master')

@section('content')
<style>
    .pagination{
        margin-right: 21px;
        float: right;
    }
    .circular--square {
        border-radius: 50%;
    }
</style>
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Media</a></li>
                                <li class="breadcrumb-item active">Media list</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Media Management</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                        
                            <h4 class="header-title">Media</h4>
                            <span class="header-title right-btn">
                            <!-- <a class="btn btn-primary" href="javascript:void(0)" id="createNewCustomer"><i class="fe-plus-circle"></i>image size</a>
                                -->
                                    <a class="btn btn-primary" href="{{ route('slider.create') }}"><i class="fe-plus-circle"> Create Media </i></a>
                             
                            </span>
                            <p class="sub-header">
                            </p>
                            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                <th>No</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($sliders as $key => $slider)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ ucwords($slider->type) }}</td>
                                    <td>{{ $slider->name }}</td>
                                    <td>
                                    @if($slider->image)
                                    <img class="circular--square" src="{{ asset('storage/'.$slider->image) }}" alt="images" height="50" width="50">
                                    @endif
                                     </td>
                                    <td>
                                    <!-- <a class="btn btn-info btn-sm" href="#"><i class="fe-eye"></i></a> -->
                                    <!-- <a href="{{ route('slider.edit',$slider->id) }}"class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>     
                                    <a href="javascript: void(0);"  class="btn btn-danger btn-sm sa-params11"    data-user-id="{{ $slider->id }}" data-skin="dark" data-placement="top" data-toggle="kt-tooltip" data-target="#delete_step_modal"  data-original-title="{{__('Delete this Slider') }}">
                                    <i class="fe-trash delete"></i> </a> -->
                                    <div class="kanban-menu">
                                            <div class="dropdown">
                                                <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                        id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                                <div class="dropdown-menu dropdown-menu-right action-btn"
                                                    aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                    <a class="dropdown-item" href="{{ route('slider.edit',$slider->id) }}">
                                                        <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                                    <a class="dropdown-item"  onclick="confirm_modal('{{ route('slider-destroy', $slider->id) }}')">
                                                        <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            <tbody>
                            </table>
                        </div>
                        {{-- <div class="aa" style="margin-right: 21px; float-right:10px">{!! $data->render() !!} </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sa-params" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">{{ __('Delete this user') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> </button>
			</div>
			<form action="{{ route('slider-delete') }}" method="POST" id="delete_step_form">
					@csrf
					<div class="modal-body">
						<p>{{__('Please confirm that you want to delete this user permanently:')}} <strong></strong></p>
						<input type="hidden" name="step_id">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
						<button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
					</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="CustomerForm" name="CustomerForm" class="form-horizontal">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="line-height: 0.5;">Slider</label>
                    <div class="col-sm-6">
                     <strong>  ( 1920 * 500 PX ) </strong>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="line-height: 0.5;">Offer</label>
                    <div class="col-sm-6">
                    <strong>   ( 1280 * 320 PX )</strong>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="line-height: 0.5;">Partner</label>
                    <div class="col-sm-6">
                    <strong>  ( 110 * 30 PX ) </strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <!-- <button type="submit"  id="saveBtn" value="create" class="btn btn-primary waves-effect waves-light">Save changes</button> -->
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#createNewCustomer').click(function () {
          $('#saveBtn').val("create-Customer");
          $('#Customer_id').val('');
          $('#CustomerForm').trigger("reset");
          $('#modelHeading').html("Image Size");
          $('#ajaxModel').modal('show');
      });
        $(".sa-params11").click(function(e) {
            e.preventDefault();
            var role_id = $(this).data('user-id');
            if(role_id !== "") {
                $('#delete_step_form input[name="step_id"]').val(role_id);
                $("#sa-params").modal('show');
            }
        });
    })
</script>
@endsection



