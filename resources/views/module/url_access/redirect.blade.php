<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Permission Denied</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container mt-5">
		<div class="card">
			<div class="card-body">
				<h2 class="text-center text-danger">Dear User, <br/>
					You are not authorized to view the pages.</h2>
				<h2 class="text-center text-primary">Please contact website admin.</h2>
				<a href="{{route('logout')}}"
					onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
					class="btn btn-primary" style="float: right;">
					@translate(Logout)
					<form id="logout-form" action="{{route('logout')}}" method="POST">
						@csrf
					</form>
				</a>
			</div>
		</div>
	</div>
</body>
</html>
