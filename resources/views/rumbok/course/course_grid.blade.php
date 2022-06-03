@extends('rumbok.app')

@section('content')

<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="d-flex align-items-center">
              <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
              <div class="title-page">
                <h1>{{$cat->name}}</h1>
              </div>
              </div>          
                            
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                          <a href="{{url('/')}}">Home</a>
                      </li>
                      <li>
                      @if(Request::segment(2)=='cbse' || Request::segment(2)=='isc' || Request::segment(2)=='icse11')
                        <?php
                            $name = '';
                            if(Request::segment(2)=='cbse'){
                                $name = "Board";
                            }elseif(Request::segment(2)=='isc'){
                                $name = "Board";
                            }elseif(Request::segment(2)=='icse11'){
                                $name = "Board";
                            }
                        ?>
                            <span>{{$name}}</span>
                        @else
                        <?php 
                            $name = 'Courses';
                        ?>
                        <span>{{$name}}</span>
                      @endif
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
<section class="">
  <div class="container">
      <div class="row">
            <div class="heading-row clearfix">
                <form name="filterForm" id="filterForm" action="">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <a href="{{url('')}}/demo-courses/{{$cat->name}}"><img src="https://olexpert.org.in/public/watch-demo.jpg" alt="" class="img-fluid d-md-block d-lg-block d-none"></a>
                            <a href="{{url('')}}/demo-courses/{{$cat->name}}"><img src="https://olexpert.org.in/public/watch-demo-mobile.jpg" alt="" class="img-fluid d-md-none d-lg-none d-sm-block"></a>
                            <div class="card-rdp">
                                <div class="cardinner">
                                </div>
                            </div>              
                        </div>
                        {{--<div class="col-lg-4 col-md-4 col-sm-6 col-2">
                            <button type="button" class="btn btn-sm btn-warning d-md-none d-lg-none d-sm-block" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="ti-search"></i></button>
                            <div class="clearfix d-md-block d-lg-block d-none">
                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label>Board </label>
                                            <select class="form-control custom-form-control" id="board" name="board">
                                                    <option value="cbse" selected="">CBSE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label>Class</label>
                                            <select class="form-control custom-form-control" name="classes" id="classes">
                                                <option value="">All Classes</option>
                                                    <option value="12">Class 6</option>
                                                    <option value="13">Class 7</option>
                                                    <option value="14">Class 8</option>
                                                    <option value="15">Class 9</option>
                                                    <option value="16">Class 10</option>
                                                    <option value="17">Class 11</option>
                                                    <option value="76">Class 12</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </form>
                <form name="filterForm" id="filterFormm" action="">
                    <div class="row d-md-none d-lg-none d-sm-block collapse" id="collapseExample">
                        <div class="col-lg-6 col-6">
                            <div class="form-group">
                                <label>Board </label>
                                <select class="form-control custom-form-control" id="boardm" name="board">
                                                                            <option value="cbse" selected="">CBSE</option>
                                                                    </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="form-group">
                                <label>Class</label>
                                <select class="form-control custom-form-control" name="classes" id="classesm">
                                    <option value="">All Classes</option>
                                    <option value="12">Class 6</option>
                                    <option value="13">Class 7</option>
                                    <option value="14">Class 8</option>
                                    <option value="15">Class 9</option>
                                    <option value="16">Class 10</option>
                                    <option value="17">Class 11</option>
                                    <option value="76">Class 12</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
      </div>
  </div>
</section>
<section class="product-category">
    <div class="container">
        <div class="heading-row clearfix">
        <form name="filterForm" id="filterForm" action="">
            @if(Request::segment(2)=='cbse' || Request::segment(2)=='isc' || Request::segment(2)=='icse11')
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6 col-10">
                <a href="{{url('demo-courses/'.$cat->slug)}}"><img src="{{ asset('watch-demo.jpg') }}" alt="" class="img-fluid d-md-block d-lg-block d-none"></a>
                <a href="{{url('demo-courses/'.$cat->slug)}}"><img src="{{ asset('watch-demo-mobile.jpg') }}" alt="" class="img-fluid d-md-none d-lg-none d-sm-block"></a>
                 <div class="card-rdp">
                
                        <div class="cardinner">
                        
                        {{-- <div class="cardcontainer">
                        <div class="Icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#657789" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        <div class="inputcontainer">
                            <input placeholder="Type here to search"/>
                        </div>
                        </div> --}}
                    </div>
                    </div>              
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-2">
                    <button type="button" class="btn btn-sm btn-warning d-md-none d-lg-none d-sm-block" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="ti-search"></i></button>
                    <div class="clearfix d-md-block d-lg-block d-none">
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label>Board </label>
                                    <select class="form-control custom-form-control" id="board" name="board">
                                        @foreach(\App\Model\Category::Published()->where('parent_category_id', '83')->get() as $category)
                                            <option value="{{$category->slug}}" {{($cat->slug == $category->slug)?'selected':''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label>Class</label>
                                    <select class="form-control custom-form-control" name="classes" id="classes">
                                        <option value="">All Classes</option>
                                        @foreach($boardClasses as $classes)
                                            <option value="{{$classes->id}}" {{(Request()->classes == $classes->id)?'selected':''}}>{{$classes->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            </form>
            <form name="filterForm" id="filterFormm" action="">
            @if(Request::segment(2)=='cbse' || Request::segment(2)=='isc' || Request::segment(2)=='icse11')
            <div class="row d-md-none d-lg-none d-sm-block collapse" id="collapseExample">
                        <div class="col-lg-6 col-6">
                            <div class="form-group">
                                <label>Board </label>
                                <select class="form-control custom-form-control" id="boardm" name="board">
                                    @foreach(\App\Model\Category::Published()->where('parent_category_id', '83')->get() as $category)
                                        <option value="{{$category->slug}}" {{($cat->slug == $category->slug)?'selected':''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="form-group">
                                <label>Class</label>
                                <select class="form-control custom-form-control" name="classes" id="classesm">
                                    <option value="">All Classes</option>
                                    @foreach($boardClasses as $classes)
                                        <option value="{{$classes->id}}" {{(Request()->classes == $classes->id)?'selected':''}}>{{$classes->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
            @endif
        </form>
        </div>
        <div class="row">
            <div class="col-md-12">
            <label class="mb-0">Total {{ $packageDataBoards->total() }} records found</label>    
            </div>
        </div>
        <div class="row">

            @forelse($packageDataBoards as $data)
                <div class="col-md-4">
                <div class="pricing-item w-100">
                            @php
                                $freeData = explode(',',$data->free_subject);
                                $course_chapter_count =  getCountData($data->course_id,$freeData);
                                $subjectCount =0;
                                $freeData = count($freeData);       
                                @endphp
                            <div class="thumbnail-image">
                                <img src="{{ filePath($data->pkg_image) }}" alt="{{ $data->pkg_name }}"/>
                                <span class="position-absolute classs-block">{{ $data->subName }}</span>		
                                <div class="hover-details">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                       
                                        <span class="l-c-count">
                                            @if($data->course_id == 0)
                                                {{ $freeData }}
                                            @else
                                            {{$course_chapter_count[0]}}
                                            @endif    
                                            </span>
                                           
                                            
                                            
                                            <span class="l-c-text">
                                            @if($data->course_id == 0)
                                                Subjects
                                            @else
                                                Chapters
                                            @endif    
                                            </span>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                        <span class="l-c-count">
                                            {{$course_chapter_count[1]}}
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>
                                        </div>
                                    </div>
                                    </div>									
                                </div>
                            </div>	
                            <h3 class="page-title">{{$data->pkg_name}}</h3>
                            <?php $short_desc = explode("\n",$data->short_desc);?>
                            @if(count($short_desc)>0)
                            <ul>
                            <?php
                            if(isset($short_desc) && count($short_desc)!=1){
                                $i=0;
                                foreach($short_desc as $shortDesc){
                            ?>            
                                <li><i class="icon_check"></i><?php echo $shortDesc;?></li>
                            <?php $i++;
                            //<li class="disable"><i class="icon_check"></i>Certificate after completion</li>
                                } 

                            } 
                            ?>
                            </ul>
                            @endif
                            <div class="available-in">
                                <ul class="list-inline">									
                                    <li class="list-inline-item">Available in :</li>
                                    @if(($data->quarterly_course_coverage!=null && $data->quarterly_course_coverage!='0.00') && ($data->halfyrly_course_coverage!=null && $data->halfyrly_course_coverage!='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item"> <span class="badge badge-warning">3 Months </span></li>
                                    <li class="list-inline-item"> <span class="badge badge-success" >6 Months </span></li>
                                    <li class="list-inline-item">  <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage=='0.00' && $data->quarterly_course_coverage==null) && ($data->halfyrly_course_coverage!=null && $data->halfyrly_course_coverage!='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item"> <span class="badge badge-success">6 Months </span></li>
                                    <li class="list-inline-item"> <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage!=null && $data->quarterly_course_coverage!='0.00') && ($data->halfyrly_course_coverage==null && $data->halfyrly_course_coverage=='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item">   <span class="badge badge-warning">3 Months </span></li>
                                    <li class="list-inline-item">  <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage=='0.00' && $data->quarterly_course_coverage==null) && ($data->halfyrly_course_coverage==null && $data->halfyrly_course_coverage=='0.00') && ($data->annually_course_coverage!=null && $data->annually_course_coverage!='0.00'))
                                    <li class="list-inline-item">  <span class="badge badge-info" >Yearly</span></li>
                                    @elseif(($data->quarterly_course_coverage!=null && $data->quarterly_course_coverage!='0.00') && ($data->halfyrly_course_coverage!=null && $data->halfyrly_course_coverage!='0.00') && ($data->annually_course_coverage==null && $data->annually_course_coverage=='0.00'))
                                    <li class="list-inline-item">  <span class="badge badge-warning">3 Months </span></li>
                                    <li class="list-inline-item">   <span class="badge badge-success">6 Months </span></li>
                                    @else
                                    <li class="list-inline-item"><span class="badge badge-warning">Free </span></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-top pt-2">
                                <div class="d-block">
                                    <?php
                                        $subUri1 = $cat->slug.'-'.str_replace(" ","-",strtolower($data->subName));
                                        $rString = str_replace(' ', '-', strtolower($data->pkg_name));
                                        $subUri2 = preg_replace('/[^A-Z0-9]+/i', "-",$rString);
                                        if($data->slug!=''){
                                            $slug = $data->slug;
                                        }else{
                                            $slug = $data->id;
                                        }
                                    ?>
                                    <a href="{{route('packages.preview_board',[$slug])}}" class="bisylms-btn-2 d-block">View Details</a>
                                </div>
                                {{--@if(isset($data->demo_course_id) && $data->demo_course_id>0)
                                    
                                    <?php
                                        $courseDetail = \App\Model\Course::find($data->demo_course_id);
                                        $url = route('course.trial',[$courseDetail->slug,$data->id,$subUri1,$subUri2]);
                                    ?>
                                    <a href="{{$url}}" class="btn btn-link d-block btn-sm">Try for free</a>
                                @endif--}}
                            </div>
                        </div>
                </div>
            @empty
                <div class="col-12 m-5">
                    <img src="{{asset('no_data.png')}}" class="w-100 img-fluid">
                </div>
            @endforelse
            <div class="col-12">
                {{ $packageDataBoards->links() }}
            </div>

        </div>
    </div>
</section>

<div class="modal hide fade" id="demo_course_popup">
        <div class="modal-dialog">
            <div class="modal-content overflow-hidden">
                
                <div class="modal-body shadow p-0  position-relative">
                <img src="https://static.rfstat.com/bloggers_folders/95265da4-100f-4135-8bc4-283853d33c72.jpg" class="img-fluid" style="position: relative;height: 100%; width: 100%;">
                    <div class="pop-up-div-congrats ">
                        <div class="congrats-content position-absolute pt-4" style="z-index: 99999;top: 0;right: 0;width: 100%;height: 100%;background-color: rgba(256, 256, 256, 0.9);">
                           <h5>LIMITED CONTENT AVAILABLE IN <br>"CBSE CLASS - 12 Mathematics"</h5>
                            <h3>Trial Course</h3>
                           <h5>TO GET FULL ACCESS of  COURSE CURRICULUM, PRACTICE TEST, MIND MAPS <br><span class="text-success text-uppercase">buy our Premium Package</span></h5>
                            <p>
                                <a href="javascript:void(0);" class="btn btn-info mr-3" id="want_try_demo">Yes, I want to try.</a>
                                <a href="javascript:void(0);" class="btn btn-success"  data-dismiss="modal" aria-label="Close">Buy Premium Package</a>
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
@section('js')
<script>
    $(document).on('click', '[data-id]', function(e){
        var demo_course_id = $(this).attr('data-id');
        $('#want_try_demo').prop('href', demo_course_id);
        $('#demo_course_popup').modal('show');
    });
    $(document).on('change', '#classes', function(e){
        e.preventDefault();
        //var url = '{{url("courses")}}'+'/'+$('#board').val();
        //$('#filterForm').prop('action', url);
        $('#filterForm').submit();
    });
    $(document).on('change', '#board', function(e){
        e.preventDefault();
        $("#classes").val('');
        var url = '{{url("courses")}}'+'/'+$('#board').val();
        $('#filterForm').prop('action', url);
        $('#filterForm').submit();
    });

    $(document).on('change', '#classesm', function(e){
        e.preventDefault();
        //var url = '{{url("courses")}}'+'/'+$('#board').val();
        //$('#filterForm').prop('action', url);
        $('#filterFormm').submit();
    });
    $(document).on('change', '#boardm', function(e){
        e.preventDefault();
        $("#classesm").val('');
        var url = '{{url("courses")}}'+'/'+$('#boardm').val();
        $('#filterFormm').prop('action', url);
        $('#filterFormm').submit();
    });
   
</script>
@endsection