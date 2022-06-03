@extends('rumbok.app')
@section('content')
    <!-- ================================
      START DASHBOARD AREA
  ================================= -->
  <section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="title-page">
                <h1>Notifications</h1>
              </div>              
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                          <a href="https://ole.org.in">Home</a>
                      </li>
                      <li>
                          <span>Notifications</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
    <section class="dashboard-area">
       {{-- @include('rumbok.dashboard.sidebar') --}} 
        <div class="clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 column-lmd-2-half column-md-full">
                        <div class="dashboard-shared">
                        <h4 class="widget-title font-size-18 d-flex align-items-center font-weight-normal">
                                        @translate(Notifications)
                                        <!-- <a href="{{ route('mark_as_all_read', Auth::user()->id) }}" class="bisylms-btn-5 ml-auto font-size-13">@translate(Mark all as read)</a> -->
                                    </h4>
                            <div class="mess-dropdown row">
                                <div class="dashboard-title margin-bottom-20px">
                                   
                                </div><!-- end dashboard-title -->
                    
                                @forelse ($notifications  as $notification)
                                   <div class="col-md-6">
                                    <div class="{{ $notification->is_read === 0 ? 'bg-ecf0f1' : '' }}">
                                        <div class="mess__item alert alert-success">
                                            <div class="icon-element bg-color-1">
                                                <i class="fa fa-bolt"></i>
                                            </div>
                                        
                                                <div class="content">
                                                    <span class="time font-weight-normal badge badge-success">{{ $notification->created_at->diffForHumans() }}</span>
                                                    <p class="text mb-0 h5 my-2">{{ @translate($notification->title) }} </p>
                                                      <p class="text my-1"><?php echo html_entity_decode( @translate($notification->description)); ?></p>
                                                      <div class="noti-img">
                                                      @if($notification->image)
                                                                <img class="" src="{{ asset('storage/'.$notification->image) }}" alt="images" style="width:100%;">
                                                                @endif
</div>
                                                    </div>
                                          
                                        </div><!-- end mess__item -->
                                    </div><!-- end mess__item -->
                                   </div>
                                @empty
                                    <div class="mess__body col-md-12">
                                        <div>
                                            <div class="icon-element bg-color-1">
                                                <i class="fa fa-bolt"></i>
                                            </div>
                                            <div class="content small">
                                                <p class="text mb-0">@translate(No new notification.)</p>
                                            </div>
                                        </div><!-- end mess__item -->
                                    </div>
                                @endforelse
                            </div><!-- end mess-dropdown -->
                        </div><!-- end dashboard-shared -->
                    </div><!-- end col-lg-5 -->
                </div><!-- end row -->

                @include('rumbok.dashboard.footer')

            </div><!-- end container-fluid -->
        </div><!-- end dashboard-content-wrap -->
    </section><!-- end dashboard-area -->
    <!-- ================================
        END DASHBOARD AREA
    ================================= -->
@endsection
