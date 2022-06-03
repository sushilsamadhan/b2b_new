@extends('layouts.master')
@section('title','Add Permission')
@section('parentPageTitle', 'Access')
@section('content')
<div class="card m-2">
	<div class="card-header">
		<div class="float-left">
			<h3>Add Permission</h3>
		</div>
	</div>
	<div class="card-body">
		<form action="{{ route('url_access.add') }}" method="POST" class="needs-validation">
			@csrf
			<div class="form-group row">
				<label for="user_id" class="col-sm-3 col-form-label">Choose User<span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<select name="user_id" id="user_id" class="form-control" required>
						<option value="">Select User</option>
						@foreach($users as $user)
						<option value="{{ $user->user_id }}">{{ $user->name }}</option>
						@endforeach
					</select>
					<div class="invalid-feedback">
						Select User
					</div>
				</div>
			</div>
			
			<div class="form-group row">
				<label for="url" class="col-sm-3 col-form-label">URL Name<span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<textarea name="site_url" id="url" class="form-control" required>{{ old('site_url') }}</textarea>
					<span class="text-danger">Note: Please write only comma(,) separated url without space. (eg: ControllerName@MethodName).</span>
					<div class="invalid-feedback">
						Select Links
					</div>
				</div>
			</div>
			<div class="col-sm-12 text-center">
				<div class="form-group row">
					<label class="col-md-2 col-form-label" for="example"></label>
					<div class="col-md-3">
						<button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</form>

		<div class="card-body table-responsive">
			<table class="table table-bordered table-hover text-center">
				<thead>
					<tr>
						<th>S/L</th>
						<th>@translate(Instructor Name)</th>
						<th>@translate(Site Url)</th>
						<th>@translate(Action)</th>
					</tr>
				</thead>
				<tbody>
					@forelse($url_permissions as  $url_permission)
					<tr>
						<td>
							{{ ($loop->index+1) + ($url_permissions->currentPage() - 1)*$url_permissions->perPage() }}
						</td>
						<td>{{ $url_permission->name }}</td>
						<td style="word-break:break-all">{{ $url_permission->site_url }}</td>
						<td>
							<div class="kanban-menu">
								<div class="dropdown">
									<button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
									id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
									<div class="dropdown-menu dropdown-menu-right action-btn"
										aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
										<a href="#!" class="dropdown-item accessdata" data-id="{{ $url_permission->id }}" data-siteurl="{{ $url_permission->site_url }}" data-user="{{ $url_permission->user_id }}" data-toggle="modal" data-target="#access">
										<i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
									</div>
								</div>
							</div>
						</td>
						@empty
						<tr>
							<td colspan="4"><h3 class="text-center">No Data Found</h3></td>
						</tr>
						@endforelse
					</tbody>
					<div class="float-left">
						{{ $url_permissions->links() }}
					</div>
				</table>
			</div>
		</div>
		<div class="modal fade" id="access" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Upadte Site Url</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ route('url_access.update') }}" method="post">
							@csrf
							<div class="form-group">
								<input type="hidden" name="id" id="id">
								<label for="message-text" class="col-form-label">Message:<span class="text-danger">*</span></label>
								<textarea name="site_url" id="site_url" class="form-control" required></textarea>
								<span class="text-muted font-16 font-italic"><span class="text-danger">*</span>Note: Please write every url name seperated by commas</span>
								<input type="hidden" name="userid" id="userid">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection

	@section('page-script')
	<script>
		$(document).ready(function(){
			$('.accessdata').on('click',function(){
				let id = $(this).data('id');
				let user = $(this).data('user');
				let siteurl = $(this).data('siteurl');
				$('#id').val(id);
				$('#userid').val(user);
				$('#site_url').val(siteurl);
			});
		});
	</script>
	@stop