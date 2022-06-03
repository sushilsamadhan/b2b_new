<table class="table table-bordered table-hover text-center">
    <thead>
    <tr>
        <th>S/L</th>
        <th>@translate(Package / Course Name)</th>
        <th>@translate(Actual Price)</th>
        <th>@translate(Discount Price)</th>
    </tr>
    </thead>
    <tbody>
		@php $i=1;@endphp
		@forelse($userDetails as $item) 
			@php
             if($item->course_id == NULL || $item->package_id == NULL) {
                if($item->course_id == NULL) {
					$string = \App\Http\Controllers\ReportManager\CouponController::getPackageDetails($item->package_id);
				}else if($item->package_id == NULL) {

					$string =	\App\Http\Controllers\ReportManager\CouponController::getCourseDetails($item->course_id);
				}
			 }
			 $result = explode('|',$string);	
			@endphp
			<tr>
				<td>{{$i++}}</td>
				<td>{{$result[0]}}</td>
				<td>{{$result[1]}}</td>
				<td>{{$result[2]}}</td>
			</tr>
    	@empty
			<tr>
				<td colspan="5">No Records</td>
			</tr>
    	@endforelse
    </tbody>
</table>