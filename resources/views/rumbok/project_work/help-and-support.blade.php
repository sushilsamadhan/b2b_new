@extends('rumbok.app')
@section('content')
<style>
.bg-1 {
    background: #ff3019;
    background: -moz-linear-gradient(top, #ff3019 0%, #cf0404 100%);
    background: -webkit-linear-gradient(top, #ff3019 0%,#cf0404 100%);
    background: linear-gradient(to bottom, #ff3019 0%,#cf0404 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff3019', endColorstr='#cf0404',GradientType=0 );
}
.card-dashboard.bg-1 {
    border: 1px solid #ff3019;
}
.card-dashboard {
    box-shadow: 2px 1px 17px 4px rgb(0 0 0 / 12%);
    margin-bottom:20px;
}
.card-dashboard.bg-1 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-1 h2 {
    color: #fff;
}
.card-dashboard.bg-1 h2 a {
    border: 1px solid #fff;
    padding: 3px 20px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
    font-weight: normal;
}
.bg-2 {
    background: #7abcff;
    background: -moz-linear-gradient(top, #7abcff 0%, #60abf8 44%, #4096ee 100%);
    background: -webkit-linear-gradient(top, #7abcff 0%,#60abf8 44%,#4096ee 100%);
    background: linear-gradient(to bottom, #7abcff 0%,#60abf8 44%,#4096ee 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7abcff', endColorstr='#4096ee',GradientType=0 );
}
.card-dashboard.bg-2 {
    border: 1px solid #7abcff;
}
.card-dashboard.bg-2 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-2 h2 {
    color: #fff;
}
.card-dashboard.bg-2 h2 a {
    border: 1px solid #fff;
    padding: 3px 20px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
    font-weight: normal;
}
.bg-3 {
    background: #87e0fd;
    background: -moz-linear-gradient(top, #87e0fd 0%, #53cbf1 40%, #05abe0 100%);
    background: -webkit-linear-gradient(top, #87e0fd 0%,#53cbf1 40%,#05abe0 100%);
    background: linear-gradient(to bottom, #87e0fd 0%,#53cbf1 40%,#05abe0 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#05abe0',GradientType=0 );
}
.card-dashboard.bg-3 {
    border: 1px solid #87e0fd;
}
.card-dashboard.bg-3 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-3 h2 {
    color: #fff;
}
.card-dashboard.bg-3 h2 a {
    border: 1px solid #fff;
    padding: 3px 20px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
    font-weight: normal;
}
.bg-4 {
    background: #8fc400;
    background: -moz-linear-gradient(top, #8fc400 0%, #8fc400 100%);
    background: -webkit-linear-gradient(top, #8fc400 0%,#8fc400 100%);
    background: linear-gradient(to bottom, #8fc400 0%,#8fc400 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8fc400', endColorstr='#8fc400',GradientType=0 );
}
.card-dashboard.bg-4 {
    border: 1px solid #8fc400;
}
.card-dashboard.bg-4 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-4 h2 {
    color: #fff;
}
.card-dashboard.bg-4 h2 a {
    border: 1px solid #fff;
    padding: 3px 20px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
    font-weight: normal;
}
.bg-5 {
    background: #ff0084;
    background: -moz-linear-gradient(top, #ff0084 0%, #ff0084 100%);
    background: -webkit-linear-gradient(top, #ff0084 0%,#ff0084 100%);
    background: linear-gradient(to bottom, #ff0084 0%,#ff0084 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0084', endColorstr='#ff0084',GradientType=0 );
}
.card-dashboard.bg-5 {
    border: 1px solid #ff0084;
}
.card-dashboard.bg-5 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-5 h2 {
    color: #fff;
}
.card-dashboard.bg-5 h2 a {
    border: 1px solid #fff;
    padding: 3px 20px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
    font-weight: normal;
}
.card-dashboard.bg-5 h2 a:hover, .card-dashboard.bg-1 h2 a:hover, .card-dashboard.bg-2 h2 a:hover, .card-dashboard.bg-3 h2 a:hover, .card-dashboard.bg-4 h2 a:hover {
    background:#fff;
    color:#000;
}

</style>
<section class="heading-n-breadcrub-part mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="title-page">
                          <h1>Help & Support</h1>
                        </div>              
                    </div>
                    <div class="col-lg-6">
                        <div class="bread-crumb-part">
                            <ul class="bread-crumb-part-list">
                                <li>
                                <a href="{{route('homepage')}}">@translate(home)</a>
                                </li>
                                <li>
                                  <span> {{'Help & Support'}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          </section>
  <!--======================================
          END breadcrumb AREA
  ======================================-->

  <section class="welcome-content">
      <div class="container">
          <div class="section-heading">
             
          </div><!-- end section-heading -->
          <div class="row mt-3">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-1 h-100">
                                <div class="card-body text-center">
                                    <h3>About Us</h3>
                                    <h2><a href="https://ole.org.in/page/about-us" class="">View</a></h2>                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-2 h-100">
                                <div class="card-body text-center">
                                    <h3>Blog</h3>
                                    <h2><a href="https://ole.org.in/blog/posts" class="">View</a></h2>                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-3 h-100">
                                <div class="card-body text-center">
                                    <h3>Privacy Policy</h3>
                                    <h2><a href="https://ole.org.in/page/privacy-policy" class="">View</a></h2>                  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-4 h-100">
                                <div class="card-body text-center">
                                    <h3>terms and Conditions</h3>
                                    <h2><a href="https://ole.org.in/page/terms-condition" class="">View</a></h2>                 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-5 h-100">
                                <div class="card-body text-center">
                                    <h3>Refund & Cancellation</h3>
                                    <h2><a href="https://ole.org.in/page/refund-cancellation" class="">View</a></h2>              
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
  </section>

 
@endsection
