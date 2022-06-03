@extends('rumbok.app')

@section('content')
<section class="clearfix">
<img src="{{asset('asset_rumbok/new/images/white-label-banner.jpg')}}" class="img-fluid"/>
</section>
<section class="clearfix my-4">
    <div class="container">
        <div class="col-md-12 text-center">
			<h2 class="sec-title mb-3">Our key Features</h2>
		</div>
        <div class="keyhighlight-alignment">
            <div class="row no-gutter">
                <div class="col-md-6">
                    <img src="{{asset('asset_rumbok/new/images/video-content.jpg')}}" class="img-fluid"/>
                </div>
                <div class="col-md-6 bg-color1 keyhighlight-text">
                        <div>
                        <h2 class="highlight-card-title margin-alignment">Video Content Support</h2>
                        <p>4000+ lectures (CBSE/ICSE/ISC)</p>
                        <p>700+ Mind Maps Chapterwise</p>
                        <p>20 Cr + MCQs for various examinations</p>
                        <p>900+ PDF based on NCERT Solutions</p>
                        </div>                    
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="keyhighlight-alignment">
                        <div class="keyhighlight-image">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/lead-generation.jpg" alt-text="key-highlightsection-image" class="highlight-image ">
                        </div>
                        <div class="keyhighlight-text">
                            <div>
                                <h2 class="highlight-card-title-2 margin-alignment">Video Content Support</h2>
            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="keyhighlight-alignment">
                        <div class="keyhighlight-image">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/amc.jpg" alt-text="key-highlightsection-image" class="highlight-image ">
                        </div>
                        <div class="keyhighlight-text">
                            <div>
                                <h2 class="highlight-card-title-2 margin-alignment">No Hidden AMC cost</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="keyhighlight-alignment">
                        <div class="keyhighlight-image">
                        <img src="https://olexpert.org.in/public/asset_rumbok/new/images/hd-video.jpg" alt-text="key-highlightsection-image" class="highlight-image ">
                        </div>
                        <div class="keyhighlight-text">
                            <div>
                                <h2 class="highlight-card-title-2 margin-alignment">Get High Definition Video Support</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>

<section class="clearfix">
    <div class="container">
    <div class="pricing-table">
        <div class="row">
            <div class="col-md-6">
                <div class="plan basic">
                    <h3 class="name">Basic Plan</h3>
                    <h4 class="price"><span>Validity 1 year</span></h4>

                    <ul class="details">
                        <li>Complete access for all video courses for <strong>1</strong> year</li>
                        <li><strong>Video</strong> content</li>
                        <li><strong>Test</strong> series</li>
                        <li><strong>PDF/NCERT</strong> solutions</li>
                        <li><strong>Competitive</strong> Courses</li>
                        <li><strong>Career</strong> Counselling</li>
                        <li><strong>Project</strong> based learning</li>
                        <li><strong>Expert</strong> talk</li>
                        <li><strong>Industrial</strong> Tour</li>
                        <li><strong>Orientation</strong> Courses</li>
                    </ul>

                    <h5 class="order"><a href="#">Order Now</a></h5>
                </div><!--.plan-->
            </div>
            <div class="col-md-6">
                <div class="plan premium">
                    <h3 class="name">Premium Plan</h3>
                    <h4 class="price"><span>Validity 3 year</span></h4>

                    <ul class="details">
                        <li>Complete access for all video courses for <strong>3</strong> years</li>
                        <li><strong>Video</strong> content</li>
                        <li><strong>Test</strong> series</li>
                        <li><strong>PDF/NCERT</strong> solutions</li>
                        <li><strong>Competitive</strong> Courses</li>
                        <li><strong>Career</strong> Counselling</li>
                        <li><strong>Project</strong> based learning</li>
                        <li><strong>Expert</strong> talk</li>
                        <li><strong>Industrial</strong> Tour</li>
                        <li><strong>Orientation</strong> Courses</li>
                    </ul>

                    <h5 class="order"><a href="#">Order Now</a></h5>
                </div><!--.plan-->
            </div>
        </div>		
	</div><!--.pricing-table-->
    </div>
</section>
@endsection