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
    border-radius: 10px;
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
.bg-6 {
    /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#e570e7+0,c85ec7+47,a849a3+100;Pink+3D+%233 */
background: #e570e7; /* Old browsers */
background: -moz-linear-gradient(top,  #e570e7 0%, #c85ec7 47%, #a849a3 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  #e570e7 0%,#c85ec7 47%,#a849a3 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  #e570e7 0%,#c85ec7 47%,#a849a3 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e570e7', endColorstr='#a849a3',GradientType=0 ); /* IE6-9 */
}
.card-dashboard.bg-6 {
    border: 1px solid #e570e7;
}
.card-dashboard.bg-6 h3 {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}
.card-dashboard.bg-6 h2 {
    color: #fff;
}
.card-dashboard.bg-6 h2 a {
    border: 1px solid #fff;
    padding: 3px 20px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
    font-weight: normal;
}
.card-dashboard.bg-5 h2 a:hover, .card-dashboard.bg-1 h2 a:hover, .card-dashboard.bg-2 h2 a:hover, .card-dashboard.bg-3 h2 a:hover, .card-dashboard.bg-4 h2 a:hover, .card-dashboard.bg-6 h2 a:hover {
    background:#fff;
    color:#000;
}
.icon-img {
    width: 45px;
    height: 45px;
    margin: 0 auto;
    margin-bottom: 10px;
}
.icon-img img {
    width:100%;
}
</style>
<section class="heading-n-breadcrub-part mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                    <div class="d-flex align-items-center">
                            <button onclick="goBack()" class="d-md-none d-lg-none d-sm-block mr-2"><i class="ti-arrow-left"></i></button>
                            <div class="title-page">
                            <h1>Help & Support</h1>
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
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-1 h-100">
                                <div class="card-body text-center">
                                    <div class="icon-img"><img src="{{ url('public/asset_rumbok/images/about.png') }}" /></div>
                                    <h3>About Us</h3>
                                    <h2><a href="https://ole.org.in/page/about-us" class="">View</a></h2>                
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-2 h-100">
                                <div class="card-body text-center">
                                <div class="icon-img"><img src="{{ url('public/asset_rumbok/images/blog.png') }}" /></div>
                                    <h3>Blog</h3>
                                    <h2><a href="https://ole.org.in/blog/posts" class="">View</a></h2>                  
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-3 h-100">
                                <div class="card-body text-center">
                                <div class="icon-img"><img src="{{ url('public/asset_rumbok/images/privacy.png') }}" /></div>
                                    <h3>Privacy Policy</h3>
                                    <h2><a href="https://ole.org.in/page/privacy-policy" class="">View</a></h2>                  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-4 h-100">
                                <div class="card-body text-center">
                                <div class="icon-img"><img src="{{ url('public/asset_rumbok/images/terms.png') }}" /></div>
                                    <h3>terms and Conditions</h3>
                                    <h2><a href="https://ole.org.in/page/terms-condition" class="">View</a></h2>                 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-5 h-100">
                                <div class="card-body text-center">
                                <div class="icon-img"><img src="{{ url('public/asset_rumbok/images/refund.png') }}" /></div>
                                    <h3>Refund & Cancellation</h3>
                                    <h2><a href="https://ole.org.in/page/refund-cancellation" class="">View</a></h2>              
                                </div>
                            </div>
                        </div>         
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-3">
                            <div class="card-dashboard bg-6 h-100">
                                <div class="card-body text-center">
                                <div class="icon-img"><img src="{{ url('public/asset_rumbok/images/chat.png') }}" /></div>
                                    <h3>Talk to us</h3>
                                    <h2><a href="https://tawk.to/chat/61812f0d6885f60a50b9f614/1fjg9vjqi" class="">View</a></h2>              
                                </div>
                            </div>
                        </div>   
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 offset-md-4 offset-lg-4">
                            <div class="card-dashboard bg-1 h-100">
                                <div class="card-body text-center">
                                <div class="icon-img"><img src="{{ url('public/asset_rumbok/new/images/contact-us.png') }}" /></div>
                                    <h3>Contact us</h3>
                                    <h2><a href="https://olexpert.org.in/page/contact-us" class="">View</a></h2>              
                                </div>
                            </div>
                        </div>          
            </div>
      </div>
  </section>

 
@endsection
