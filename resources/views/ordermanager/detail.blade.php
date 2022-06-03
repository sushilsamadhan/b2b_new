@extends('layouts.master')

@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Order Details</h3>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Transaction Id</th>
                    <th>Order Total</th>
                    <th>Discount</th>
                    <th>Transaction Amount</th>
                    <th>Transaction Date</th>
                    <th>Transaction Status</th>
                    <th>Transaction Type</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @foreach($userOrderDetails as $item)                                
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{$item->transaction_id}}</td>
                            <td>{{$item->order_total}}</td>
                            <td>{{($item->discount_amount) ? $item->discount_amount : 0}}</td>
                            <td>{{$item->transaction_amount}}</td>
                            <td>{{date('Y-m-d', strtotime($item->transaction_date))}}</td>
                            <td>{{$item->transaction_status}}</td>
                            <td>{{$item->transaction_type}}</td>
                        <!--  
                            <td>
                                <div class="kanban-menu">
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                        <div class="dropdown-menu dropdown-menu-right action-btn"
                                                aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                            <a class="dropdown-item" href="{{ route('orders.detail',$item->id) }}">
                                                <i class="feather icon-edit-2 mr-2"></i>@translate(Details)</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        -->
                        </tr>
                    @endforeach       
                </tbody>
            </table>
        </div>

<!-- Second Section Packages-->
        <div class="card-header">
            <div class="float-left">
                <h3>Package Details</h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                    <th>Sr.No</th>
                    <th>Package Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; $packageStatus = 0; @endphp
                    @foreach($enrollmentDetails as $userPackages) 
                        @php 
                            $packageId = $userPackages->package_id;
                            $enrollId = $userPackages->id;
                            $userId = $userPackages->user_id;
                            if($packageId>0) {
                                $packageStatus++;
                                $packageName = getPackageName($packageId);
                        @endphp
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{$packageName}}</td>
                                <td>{{$userPackages->start_date}}</td>
                                <td>{{$userPackages->end_date}}</td>
                            </tr>
                        @php 
                            //$packageDetails = getPackageDetails($userPackages->package_id);
                            //$packageStr = explode('|', $packageDetails);
                            //$packageDetails = $packageStr[0];
                            //$courseIds = $packageStr[1];

                             $packageDetailsHelp = getPackageDetails($userPackages->package_id);
                             $packageDetails = $packageDetailsHelp['userPackagesdetails'];
                            $courseIds = $packageDetailsHelp['finalCourseID'];
                    
                            $chapterDetail = getChapterIds($userPackages->package_id, $userPackages->id, $userPackages->user_id);          
                            $chapterStr = explode('|', $chapterDetail);
                            $chapterIds = $chapterStr[0]; 
                            $packageType = $chapterStr[1];

                            if($packageType==1) {
                                $package_type = 'Yearly';
                                $access_type = 'View All';
                            } else if ($packageType==2) { 
                                $package_type = 'Half Yearly';
                                $access_type = 'View';
                            } else if ($packageType==3) { 
                                $package_type = 'Quaterly';
                                $access_type = 'View';
                            }
                            $courseContents = getCourseContents($courseIds);
                            if($courseIds){ 
                        @endphp
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="3">
                                    <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Course Name</th>
                                                <th>Type</th>
                                                <th>Access</th>
                                            </tr>
                                        </thead>
                                        @php 
                                            $j = 0;  
                                            $courseStatus = 0;
                                        @endphp
                                        @foreach($courseContents as $value)
                                         @php  $courseStatus++; @endphp
                                            <tbody>
                                                <td>{{ ++$j}}</td>
                                                <td>{{$value->title}}</td>
                                                <td>{{$package_type}}</td>
                                                <td>
                                                <a href="javascript:void(0);" onclick="forModal('{{ route('orders.chapterdetail',[$value->id,$packageType,$chapterIds]) }}', '@translate(Chapter Details)')"><i class="feather icon-edit-2 mr-2"></i>{{$access_type}}</a>   
                                                </td>  
                                            </tbody>
                                        @endforeach
                                        @php  
                                        if($courseStatus==0) {
                                        @endphp
                                        <tbody>
                                            <td colspan="4">@translate(Courses not available.)</td>    
                                        </tbody>
                                        @php } @endphp  
                                    </table>
                                </td>        
                            </tr>
                        @php  
                            } 
                        @endphp
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="3"><h5>Package Service Details</h5></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan='3'>
                                <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Service Name</th>
                                            <th>Price</th>
                                            <th>Is Availed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $k = 0; 
                                            $userServices = getUserPackageServices($packageId, $enrollId, $userId);
                                       
                                            if(count($userServices)>0) {
                                        @endphp
                                        @foreach($userServices as $services)                                
                                            <tr>
                                                <td>{{ ++$k }}</td>
                                                <td>{{ $services->service_name }}</td>
                                                <td>{{$services->price}}</td>
                                                <td>{{'N/A'}}</td>
                                            </tr>
                                        @endforeach 
                                        @php
                                         }  else { @endphp 
                                            <tr>
                                                <td colspan="4">Package services not available.</td>
                                            </tr>        
                                        @php   } 
                                    } // if package id null
                                    @endphp      
                                    <tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach       
                <tbody>
            </table>
                @php  
                 if($packageStatus==0) {
                @endphp
                <tr>
                    <td colspan="4">@translate(Packages not available.)</td>    
                </tr>
                @php } @endphp    
                <tbody>
            </table>
        </div>

<!-- Third Section for Courses-->
        <div class="card-header">
            <div class="float-left">
                <h3>Course Details</h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                    <th>Sr.No</th>
                    <th>Course Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @foreach($enrollmentDetails as $userCourses)
                    @php 
                        $packageId = $userCourses->package_id;
                        $courseId  = $userCourses->course_id;
                        $courseStatus = 0;   
                        if($courseId>0) {
                            $courseStatus++;
                            $courseName = getCourseName($courseId);
                    @endphp
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{$courseName}}</td>
                            <td>{{$userCourses->start_date}}</td>
                            <td>{{$userCourses->end_date}}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="3"><h5>Course Service Details</h5></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="3">
                                <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Service Name</th>
                                            <th>Price</th>
                                            <th>Is Availed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $k = 0; 
                                            $userCourseServices = getUserCourseServices($courseId, $enrollId, $userId);
                                       
                                            if(count($userCourseServices)>0) {
                                        @endphp
                                        @foreach($userCourseServices as $services)                                
                                            <tr>
                                                <td>{{ ++$k }}</td>
                                                <td>{{ $services->service_name }}</td>
                                                <td>{{$services->price}}</td>
                                                <td>{{'N/A'}}</td>
                                            </tr>
                                        @endforeach 
                                        @php
                                         }  else { @endphp 
                                            <tr>
                                                <td colspan="4">Course services not available.</td>
                                            </tr>        
                                        @php   } @endphp 
                                        <tbody>
                                @php    } // if course id null
                                    @endphp      
                                    
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    @php  
                    if($courseStatus==0) {
                    @endphp
                    <tr>
                        <td colspan="4">@translate(Courses not available.)</td>    
                    </tr>
                    @php } @endphp    
                <tbody>
            </table>
        </div>       
<!-- Fourth Section for Services -->
    <!--    <div class="card-header">
            <div class="float-left">
                <h3>Service Details</h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Is Availed</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @foreach($userServices as $userServices)                                
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $userServices->service_name }}</td>
                            <td>{{$userServices->price}}</td>
                            <td>{{'N/A'}}</td>
                        </tr>
                    @endforeach       
                <tbody>
            </table>
        </div> 
        -->
    </div>
@endsection
