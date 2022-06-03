@extends('rumbok.app')
@section('content')

    <!-- Breadcrumb Section Starts -->
    <!-- <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
                 class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>@translate(my course)</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a> / @translate(my course)</span>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
               <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                        <h1>Packages</h1>
                    </div>
               </div>            
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                      <a href="{{route('homepage')}}">@translate(home)</a>
                      </li>
                      <li>
                        <span> @translate(my packages)</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
    @if (Session::has('message'))
        <div class="alert alert-info text-center">{{ Session::get('message') }}</div>
    @endif
    <!-- Course Section Starts -->
    <div class="course-page-content padding-120">
        <div class="container">
            <?php /*?>
            <div class="page-content-top margin-bottom-40">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="course-tab">
                            <ul class="list-inline">
                                {{--
                                    <li class="active list-inline-item">
                                    <a href="{{route('my.courses')}}" class="pointer text-info small">@translate(All Courses)</a>
                                </li>
                                --}}
                                <li class="list-inline-item">
                                    <a href="{{route('my.packages')}}" class="active pointer  text-info small">@translate(Home) / @translate(All Packages)</a>
                                </li>
                               {{-- <li class="list-inline-item">
                                    <a href="{{route('my.wishlist')}}" class="pointer  text-info small">/ @translate(Wishlist)</a>
                                </li>

                                --}}
                                
                                @if(env('SUBSCRIPTION_ACTIVE') == "YES")
                                    <li class="list-inline-item">
                                        <a href="{{route('my.subscription')}}" class="pointer">
                                            @translate(Subscription Courses)
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div> 
            <?php */?>

            <div class="row">
                <input type="hidden" id="myCourseCount" value="{{$enrolls->count()}}">
                @forelse($enrolls as $item)
               
                @php  $packageDataBoards = \App\PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
        ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
        ->leftjoin('courses as c','c.id','=','package_settings.course_id')
        ->select('package_settings.*','Cat.name as catName','Cat.slug as slug','subCat.name as subName','c.title')
        ->where(['package_settings.id'=> $item->package_id])
        ->orderBy('id', 'DESC')->first() @endphp
   
        @php
        $course_chapter_count[0] = 0;
        $course_chapter_count[1] = 0;
        $freeData =0;
        if($packageDataBoards){
            $freeData = explode(',',$packageDataBoards->free_subject);
            $course_chapter_count =  getCountData($packageDataBoards->course_id,$freeData);
        
        }
            
        @endphp
                 @if(!empty($item->enrollPackage) && !empty($item->enrollCartPackage))
                    <div class="col-lg-4 col-sm-6">
                    <div class="pricing-item w-100">
                                 <div class="thumbnail-image">
                                    @if($item->enrollPackage)
                                    <img src="{{filePath($item->enrollPackage->pkg_image)}}" alt="{{$item->enrollPackage->pkg_image}}" class="img-fluid">
                                    <span class="position-absolute classs-block">{{(isset($item->enrollPackage->enrollSubCategory))?$item->enrollPackage->enrollSubCategory->name:''}}</span>
                                @endif		
                                <div class="hover-details">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                        <span class="l-c-count">
                                         
                                        {{$course_chapter_count[0]}}
                                            </span>
                                            <span class="l-c-text">
                                           
                                                Chapters
                                         
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
                            <h3 class="page-title">{{Str::limit($item->enrollPackage->pkg_name,58)}}</h3>
                              <div class="available-in">
                                <p>
                                    {{Str::limit($item->enrollPackage->short_desc,58)}}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-success small  d-block">Purchased On</span>
                                     <span class="text-dark h6 font-weight-bold line-height-1 d-block">{{dateForUserView($item->start_date)}}</span>
                                </div>
                                <div>
                                    <span class="text-danger small d-block">Expiring On</span>
                                     <span class="text-dark h6 font-weight-bold line-height-1 d-block">{{dateForUserView($item->end_date)}}</span>
                                </div>
                            </div>
                            <div class="align-items-center justify-content-between border-top pt-2">
                            <?php
                            if($packageDataBoards){
                                $subUri1 = $packageDataBoards->slug.'-'.str_replace(" ","-",strtolower($item->enrollPackage->enrollSubCategory->name));
                                $rString = str_replace(' ', '-', strtolower($item->enrollPackage->pkg_name));
                                $subUri2 = preg_replace('/[^A-Z0-9]+/i', "-",$rString);
                                $slug = '';
                                if($item->enrollPackage->slug!=''){
                                    $slug = $item->enrollPackage->slug;
                                }else{
                                    $slug = $item->enrollPackage->id;
                                }
                            ?>
                                <div class="d-block">
                                <a href="{{ route('packages.preview_board',[$slug,$item->enrollCartPackage->enrollment_id]) }}"
                                           class="btn btn-success mt-2 pointer d-block">@translate(Start Learning)</a>
                                </div>
                            <?php }?>
                            </div>
                        </div>
                        
                    </div>
                    @endif
                    @empty
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-3"><a href="{{url('/')}}"> <img src="{{asset('no-package-found.gif')}}" class="w-100 img-fluid"></a></div>
                    </div>
                </div>
                @endforelse
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="template-pagination margin-top-20">
                        {{ $enrolls->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
