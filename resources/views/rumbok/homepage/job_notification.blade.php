@extends('rumbok.app')
@section('content')
<style>
    .job-listing-btn .job-listing-seemore a {
        color:#fff;
    }
</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
            <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                        <h1>@translate(Job Notification)</h1>
                    </div>
                             
            </div>             
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                          <a href="{{url('/')}}">@translate(home)</a>
                      </li>
                      <li>
                        <span>@translate(Job Notification)</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>

    <!-- Blog Content Section -->
<section class="blog-content-section padding-120">
    <div class="container">
            <div class="row d-md-none d-lg-none d-sm-block">
                
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">More <i class="fal fa-bars"></i></button>                    
                </div>
            </div>
    
    <div class="row job-post-listing">
            @if(count($jobsdata) > 0)
               @foreach($jobsdata as $getjob)
                <div class="col-md-4 mb-3">
                                @php 
                                  $finaltitle = preg_replace('#[ -]+#', '-', $getjob->title);
                                  $job_id = base64_encode($getjob->id);
                                @endphp
                   
                        <div class="job-block-listing">
                            <div class="job-list-inner-block">
                                @php 
                                  $finaltitle = preg_replace('#[ -]+#', '-', $getjob->title);
                                @endphp
                                <div class="job-listing-title text-left" title="{{ $getjob->title }}"><h3> <a href="{{url('job-notification-details')}}/{{ $job_id }}" class="d-block">{{ $getjob->title }}</a></h3></div>
                                <div class="job-listing-date-time">
                                    <span class="job-listing-date"><i class="icon_calendar"></i> {{ $getjob->created_at }}</span>
                                </div>
                                <div class="job-listing-content">
                                    <p>{{ $getjob->short_discription }}</p>
                                </div>
                                <div class="job-listing-btn">
                                    <div class="job-listing-seemore"><a href="{{ route('homepage.job_notification_details',['id' => $job_id]) }}">SEE MORE</a></div>
                                </div>
                            </div>
                        </div>
                    
                </div>
                @endforeach
                <div class="col-lg-12">
                  <div class="template-pagination">
                  {{ $jobsdata->links() }}
                    </div>
                </div>
                @else
                  <div class="col-lg-12">
                    <div class="template-pagination">
                        No record found
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection

    
