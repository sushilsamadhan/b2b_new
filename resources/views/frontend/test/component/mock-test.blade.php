@extends('rumbok.course.lesson.app')
@section('content')
<style>
p {
 text-transform: capitalize; 
}
.btn-vsm {
    padding: 2px 5px !important;
    line-height: 1;
    color: #fff !important;
    font-size: 12px;
}
</style>
    <!--======================================
          START breadcrumb AREA
  ======================================-->

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">

                        <div class="section-heading">
                            <h2 class="section__title">
                            {{ $packageDetail->pkg_name }} Practice Test 
                            </h2>
                        </div>
                       
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    <!--======================================
            END breadcrumb AREA
    ======================================-->


    <!--======================================
            START COURSE AREA
    ======================================-->
    <section class="course-area padding-top-80px padding-bottom-120px">
        <div class="course-wrapper">
            <div class="container">                
                <div class="course-content-wrapper mt-4">
                    <div class="row">
                        {{-- sidebar --}}
                        <div class="col-lg-12">
                            <div class="sidebar">
                                    <!--Category -->
                                    <div class="sidebar-widget">                                        
                                    <div class="filter-bar d-block mb-5">
                                    <div class="row">
                                            <div class="col-md-6">Subject Test</div>
                                            <div class="col-md-6 text-right">
                                                @if($totalAttend != 0)
                                                    @if($totalAttend < $packageDetail->no_of_sectional_test )
                                                    <span class="badge bg-warning text-dark"> {{ $totalAttend }}/{{ $packageDetail->no_of_sectional_test }}</span>      
                                                    <a href="{{ route('subject-test-detail',$packageDetail->id) }}" class="btn btn-success btn-vsm">Re-attempt</a> 
                                                    @else
                                                    <span class="badge bg-warning text-dark"> {{ $totalAttend }}/{{ $packageDetail->no_of_sectional_test }}</span>
                                                    <p class="btn btn-success btn-vsm">Completed</p> 
                                                    @endif
                                                @else
                                                <span class="badge bg-warning text-dark"> 0/{{ $packageDetail->no_of_sectional_test }}</span>      
                                                                             
                                                <a href="{{ route('subject-test-detail',$packageDetail->id) }}" class="btn btn-primary btn-vsm">Attempt</a> 
                                                @endif
                                            </div> 
                                    </div>
                                    </div>   
                                    <div class="filter-bar d-block mb-5">
                                        <div class="row">
                                            <div class="col-md-6">Unit Test </div>
                                            <div class="col-md-6 text-right"> 
                                            @if($totalUnitAttend != 0)
                                                @if($totalUnitAttend < $packageDetail->no_of_practice_test )
                                                <span class="badge bg-warning text-dark"> {{ $totalUnitAttend }}/{{ $packageDetail->no_of_practice_test }}</span>      
                                                <a href="{{ route('unit-test-detail',$packageDetail->id) }}" class="btn btn-success btn-vsm">Re-attempt</a> 
                                                @else
                                                    <span class="badge bg-warning text-dark"> {{ $totalUnitAttend }}/{{ $packageDetail->no_of_practice_test }}</span>
                                                    <p class="btn btn-success btn-vsm">Completed</p> 
                                                @endif
                                                @else
                                                <span class="badge bg-warning text-dark"> 0/{{ $packageDetail->no_of_practice_test }}</span>      
                                                                             
                                                <a href="{{ route('unit-test-detail',$packageDetail->id) }}" class="btn btn-primary btn-vsm">Attempt</a> 
                                                @endif</div> 
                                            <p></p>   
                                        </div>
                                    </div>
                                    <div class="col-md-12 filter-bar d-block mb-5">
                                    <div class="row">
                                        <div class="col-md-6"> <a href="">Chapter Test</a>                                    
                                        </div>
                                        <div class="col-md-6 text-right">   
                                            @if($totalChapterAttend != 0)
                                                @if($totalChapterAttend < $packageDetail->no_of_test )
                                                    
                                                    <span class="badge bg-warning text-dark"> {{ $totalChapterAttend }}/{{ $packageDetail->no_of_test }}</span>      
                                                    <a href="{{ route('chapter-test-detail',$packageDetail->id) }}" class="btn btn-success btn-vsm">Re-attempt</a> 
                                                @else
                                                    <span class="badge bg-warning text-dark"> {{ $totalChapterAttend }}/{{ $packageDetail->no_of_test }}</span>
                                                    <p class="btn btn-success btn-vsm">Completed</p> 
                                                @endif
                                            @else
                                                <span class="badge bg-warning text-dark"> 0/{{ $packageDetail->no_of_test }}</span>      
                                                <a href="{{ route('chapter-test-detail',$packageDetail->id) }}" class="btn btn-primary btn-vsm">Attempt</a> 
                                            @endif
                                        </div> 
</div>
                                    </div>
                                    </div>
                                    
                                    </div>
                                    
                                    
                           
                     <!-- end col-lg-8 -->
                    </div><!-- end row -->
     
                </div><!-- end card-content-wrapper -->
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section><!-- end courses-area -->
    <!--======================================
            END COURSE AREA
    ======================================-->
@endsection
