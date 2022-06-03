@extends('rumbok.app')
@section('content')
  <!-- ================================
      START DASHBOARD AREA
  ================================= -->

<style>
.card-box-shared {
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
}
.user-pro-img {
    max-width: 100px;
    margin-right: 10px;
}
.section-tab .nav-tabs a {
    padding: 10px 20px;
    border: 1px solid #ddd;
    margin-right: -1px;
}
.section-tab .nav-tabs {
    border-bottom: none;
}
.section-tab .nav-tabs a.active {
    background: #e86a2f;
    color: #fff;
}
.section-tab .nav-tabs a:hover {
    background: #e86a2f;
    color: #fff;
}
.card-box-shared-title {
    background: #253a73;
    padding: 10px 15px;
    margin-top: -1px;
}
.card-box-shared-title h3.widget-title {
    font-size: 23px;
}
.card-box-shared-body {
    padding: 15px;
}
.user-profile-action {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 5px 5px 5px rgb(0 0 0 / 16%);
}
.user-pro-img {
    max-width: 100px;
    width: 100px;
    height: 100px;
    margin: 0 auto;
    margin-bottom: 20px;
}
</style>
  <section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
                <div class="d-flex align-items-center">
                    <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                    <div class="title-page">
                    <h1>Edit Profile</h1>
                    </div>
               </div>  
          </div>
          <div class="col-lg-6">
              
          </div>
      </div>
  </div>
</section>
  <section class="dashboard-area">
     {{-- @include('rumbok.dashboard.sidebar') --}} 
      <div class="dashboard-content-wrap">
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card rounded shadow-sm mb-2 overflow-hidden">
                        <div class="card-box-shared-title mb-2">
                            <h3 class="widget-title mb-0 font-weight-normal text-white">@translate(Settings info)</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="section-tab section-tab-2">
                                <ul class="nav nav-tabs" role="tablist" id="review">
                                    <li role="presentation">
                                        <a href="#profile" role="tab" data-toggle="tab" class="active" aria-selected="true">
                                            @translate(Profile)
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#password" role="tab" data-toggle="tab" aria-selected="false">
                                             @translate(Password)
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dashboard-tab-content mt-4">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active show" id="profile">
                                      <form method="post" action="{{ route('student.update', Auth::user()->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="user-form row">
                                            <div class="user-profile-action-wrap mb-5 col-md-3">
                                                <h3 class="widget-title font-weight-normal font-size-18 padding-bottom-40px">@translate(Profile Settings)</h3>
                                                <div class="user-profile-action">
                                                    <div class="user-pro-img">
                                                        <img src="{{ filePath($student->image) }}" alt="{{ $student->name }}" class="img-fluid radius-round">
                                                    </div>
                                                    <div class="upload-btn-box course-photo-btn">
                                                        <input type="hidden" name="oldImage" value="{{ $student->image }}">
                                                        <input type="file" name="image" value="">
                                                    </div>
                                                </div><!-- end user-profile-action -->
                                            </div><!-- end user-profile-action-wrap -->
                                            <div class="contact-form-action col-md-9">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text font-weight-bold small">@translate(Full Name)<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control form-control-sm" type="text" name="name" value="{{ $student->name }}">
                                                                    <span class="la la-user input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->

                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text font-weight-bold small">@translate(Father Name)</label>
                                                                <div class="form-group">
                                                                    <input class="form-control form-control-sm" type="text" name="father_name" value="{{ $student->student->father_name ?? '' }}">
                                                                    <span class="la la-user input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->

                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text font-weight-bold small">@translate(Email Address)<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control form-control-sm" type="email" name="email" value="{{ $student->alternate_email_user }}">
                                                                    <span class="la la-envelope input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text font-weight-bold small">@translate(Phone Number)</label>
                                                                <div class="form-group">
                                                                    <input class="form-control form-control-sm" type="number" readonly name="phone" value="{{ $student->student->phone  ?? '' }}">
                                                                    <span class="la la-phone input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                {{-- <div class="section-block">    
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text font-weight-bold small">@translate(Facebook)</label>
                                                                <div class="form-group">
                                                                    <input class="form-control form-control-sm" type="text" name="fb" value="{{ $student->student->fb ?? '' }}">
                                                                    <span class="la la-phone input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text font-weight-bold small">@translate(Twitter)</label>
                                                                <div class="form-group">
                                                                    <input class="form-control form-control-sm" type="text" name="tw" value="{{ $student->student->tw ?? '' }}">
                                                                    <span class="la la-phone input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text font-weight-bold small">@translate(Linked In)</label>
                                                                <div class="form-group">
                                                                    <input class="form-control form-control-sm" type="text" name="linked" value="{{ $student->student->linked ?? '' }}">
                                                                    <span class="la la-phone input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                --}}         
                                                        <!-- end col-lg-6 -->
                                                        <div class="col-lg-12">
                                                            <div class="input-box">
                                                                <label class="label-text font-weight-bold small">@translate(About)</label>
                                                                <div class="form-group">
                                                                    <textarea class="message-control form-control form-control-sm" name="about">{!! $student->student->about !!}</textarea>
                                                                    <span class="la la-pencil input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->


                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="btn btn-primary" type="submit">@translate(Save Changes)</button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div><!-- end row -->
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- end tab-pane-->
                                    <div role="tabpanel" class="tab-pane fade" id="password">
                                        <div class="user-form padding-bottom-60px">
                                            <div class="user-profile-action-wrap">
                                                <h3 class="widget-title font-weight-normal font-size-18 pb-4">@translate(Change Password)</h3>
                                            </div><!-- end user-profile-action-wrap -->
                                            <div class="contact-form-action">
                                              <form method="POST" action="{{ route('student.password.update') }}">
                                                  @csrf
                                                    <div class="row">
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text font-weight-bold small">@translate(New Password)<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                  <input id="password" type="password"
                                                                         class="form-control  form-control-sm @error('password') is-invalid @enderror"
                                                                         name="password" required autocomplete="new-password" placeholder="New password">

                                                                         <span class="la la-lock input-icon"></span>
                                                                  @error('password')
                                                                  <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                          </span>
                                                                  @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text font-weight-bold small">@translate(Confirm New Password)<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                  <input id="password-confirm" type="password" class="form-control form-control-sm"
                                                                         name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                                                                    <span class="la la-lock input-icon"></span>

                                                                    @error('password_confirmation')
                                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                    @enderror

                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn btn btn-primary" type="submit">@translate(Change password)</button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div><!-- end row -->
                                                </form>
                                            </div>
                                        </div>
                                        {{-- <div class="section-block">
                                            <hr>
                                        </div>
                                        <div class="user-form mt-3">
                                            <div class="user-profile-action-wrap padding-bottom-20px">
                                                <h3 class="widget-title font-weight-normal font-size-18 pb-2">@translate(Forgot Password then Recover Password)</h3>
                                                <p class="line-height-26">@translate(Enter the email of your account to reset password. Then you will receive a link to email)
                                                    <br> @translate(to reset the password.If you have any issue about reset password)</p>
                                            </div><!-- end user-profile-action-wrap -->
                                            <div class="contact-form-action">

                                              @if (session('status'))
                                                  <div class="alert alert-success" role="alert">
                                                      {{ session('status') }}
                                                  </div>
                                              @endif

                                                <form method="post" action="{{ route('password.email') }}">
                                                  @csrf
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="input-box">
                                                                <label class="label-text">@translate(Email Address)<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="@translate(Enter email address)" required autocomplete="email">
                                                                    <span class="la la-lock input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="btn btn-primary" type="submit">@translate(recover password)</button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div><!-- end row -->
                                                </form>
                                            </div>
                                        </div> --}}
                                    </div><!-- end tab-pane-->

                                </div><!-- end tab-content -->
                            </div><!-- end dashboard-tab-content -->
                        </div>
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            @include('rumbok.dashboard.footer')

        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->

  </section><!-- end dashboard-area -->
  <!-- ================================
      END DASHBOARD AREA
  ================================= -->
@endsection
