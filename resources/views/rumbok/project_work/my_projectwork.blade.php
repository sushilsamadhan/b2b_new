@extends('rumbok.app')
@section('content')

<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                        <h1>@translate(My Project Work)</h1>
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
                        <span> @translate(My Project Work)</span>
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
                @if(count($enrolls) > 0) 
                    @foreach($enrolls as $item)
                    @if(!empty($item->enrollCourse))
                    <div class="col-lg-4 col-sm-6">
                        <div class="schedule-thumb-summary">
                    
                            <div class="schedule-thumb">
                                    <div class="badge-minheight">
                                        <span class="badge"><i class="social_youtube"></i> {{$item->enrollCourse->enrollClasses->count()}} Lectures</span> 
                                        <span class="offer-badge-one">
                                                            @php
                                                                $total_duration = 0;
                                                                foreach ($item->enrollCourse->enrollClasses as $item1){
                                                                    $total_duration +=$item1->contents->sum('duration');
                                                                }
                                                            @endphp
                                                            {{duration($total_duration)}}

                                                            Duration
                                        </span>
                                    </div>
                                    <div class="detailed-content">
                                        <div class="schedule-detail-summary">
                                            <div class="schedule-date">
                                            <div class="media">
                                                <a href="{{route('project_work.pw_course_detail',$item->enrollCourse->slug)}}">{{Str::limit($item->enrollCourse->title,58)}}</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-cost-summary">
                                        <div class="media">
                                        </div>
                                    </div>
                                    <a class="course-enroll enroll loader " href="{{ route('project_work_lesson_details',$item->enrollCourse->slug) }}">@translate(Start lesson)</a>                                                   
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
