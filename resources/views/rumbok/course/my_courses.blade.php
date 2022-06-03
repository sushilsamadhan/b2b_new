@extends('rumbok.app')
@section('content')

<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                        <h1>@translate(my courses)</h1>
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
                        <span> @translate(my courses)</span>
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

            <div class="row">
                <input type="hidden" id="myCourseCount" value="{{$enrolls->count()}}">
            @if (count($enrolls) > 0 )    
                @foreach($enrolls as $item)
                 @if(!empty($item->enrollCourse))
                 <div class="col-lg-4 col-sm-6">
                    <div class="pricing-item w-100">
                        <div class="thumbnail-image">
                                @if($item->enrollCourse)
                                <img src="{{filePath($item->enrollCourse->image)}}" alt="image">
                                <span class="position-absolute classs-block">{{$item->enrollCourse->category->name}}</span>
                                @endif
                                <div class="hover-details">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                        <span class="l-c-count">
                                        {{$item->enrollCourse->enrollClasses->count()}}
                                            </span>
                                            <span class="l-c-text">
                                                Lectures
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="lectures-n-chapters">
                                        <div class="d-flex justify-content-between align-items-center">
                                        <span class="l-c-count">
                                                @php
                                                    $total_duration = 0;
                                                    foreach ($item->enrollCourse->enrollClasses as $item1){
                                                        $total_duration +=$item1->contents->sum('duration');
                                                    }
                                                @endphp
                                                {{duration($total_duration)}}
                                            </span>
                                            <span class="l-c-text">
                                                Duration
                                            </span>
                                        </div>
                                    </div>
                                    </div>									
                                </div>
                            </div>

                            <h3 class="page-title">{{Str::limit($item->enrollCourse->title,58)}}</h3>  
                            
                            <div class="align-items-center justify-content-between border-top pt-2">
                                <div class="row">
                                    <div class="col-6">
                                         <a href="{{route('course.single',$item->enrollCourse->slug) }}"
                                           class="bisylms-btn-2 mt-2 pointer d-block">@translate(Course details)</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('lesson_details',$item->enrollCourse->slug) }}"
                                           class="bisylms-btn-5 mt-2 pointer d-block">@translate(Start lesson)</a>
                                    </div>
                                
                                </div>
                            </div>
                           
                            
                        </div>
                    </div>
                    @endif
                @endforeach
            @else
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 offset-md-3"><a href="{{url('/')}}"> <img src="{{asset('no-history-found.gif')}}" class="w-100 img-fluid"></a></div>
                </div>
            </div>
            @endif
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
