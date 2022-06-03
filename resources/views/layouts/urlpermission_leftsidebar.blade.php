<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">
        <!-- Start Navigationbar -->
        <div class="navigationbar">
            <div class="vertical-menu-detail">
                <div class="logobar">
                    <a href="{{route('dashboard')}}" class="logo"><img
                            src="{{filePath(getSystemSetting('type_logo')->value)}}" class="img-fluid" alt="logo"></a>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-crm" role="tabpanel"
                         aria-labelledby="v-pills-crm-tab">
                        <ul class="vertical-menu">
                                @if(Auth::user()->id != '1403')
                                    <li>
                                        <a href="{{route('dashboard')}}">
                                            <i class="fa fa-tachometer"
                                            aria-hidden="true"></i>
                                            <span> @translate(Dashboard)</span>
                                        </a>
                                    </li>
                                @endif 
            <!-- Marketing Team : 1247, Social Meadia : 1300, Promotions : 1403 -->
                                @if(Auth::user()->id == '1247' || Auth::user()->id == '1300')
                                <li class="{{request()->is('dashboard/registered-user*')
                                    || request()->is('dashboard/summary-coupon/index')
                                    || request()->is('dashboard/academic-revenue')
                                    || request()->is('dashboard/competetive-revenue')
                                    ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-server"></i>
                                        <span>@translate(Reporting Manager)</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        <li><a href="{{route('reportmanager.index')}}"
                                            class="{{request()->is('dashboard/registered-user/index')  ?'active':null}}">@translate(User Registration)</a>
                                        </li>
                                        <li><a href="{{route('coupon_usage_summary.index')}}"
                                            class="{{request()->is('dashboard/summary-coupon/index')  ?'active':null}}">@translate(Coupon Usage Summary)</a>
                                        </li>
                                        <li><a href="{{route('reportmanager.academic_revenue')}}"
                                            class="{{request()->is('dashboard/academic-revenue')  ?'active':null}}">@translate(Revenue for Academic)</a>
                                        </li>
                                        <li><a href="{{route('reportmanager.competitive_revenue')}}"
                                            class="{{request()->is('dashboard/competetive-revenue')  ?'active':null}}">@translate(Revenue for Competitive)</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{request()->is('dashboard/competitive-subscription*')
                                            ? 'active' : null}}">
                                        <a href="javaScript:void();">
                                            <i class="fa fa-picture-o"></i>
                                            <span>@translate(Landing Page Analysis)</span><i
                                                class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">
                                            <li>
                                                <a href="{{route('liveclasssubscription.list')}}"
                                                class="{{request()->is('dashboard/live-class-subscription')
                                                        ?'active':null}}">
                                                        @translate(K12 Analysis)
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('competitive-subscription')}}"
                                                class="{{request()->is('dashboard/competitive-subscription*')
                                                        ?'active':null}}">
                                                        @translate(Competitive Analysis)
                                                </a>
                                            </li>
                                        </ul>
                                    </li>    
                                @endif
                                @if(Auth::user()->id == '1300')
                                    @if(env('BLOG_ACTIVE') == "YES")
                                            <li><a href="{{route('blog.index')}}"
                                                   class="{{request()->is('dashboard/blog*') ?'active':null}}">
                                                    <i class="fa fa-contao"></i> <span>@translate(Blog)</span>
                                                </a>
                                            </li>
                                        @endif
                                  	 <li>
                                            <a href="{{route('course.index')}}"
                                                   class="{{request()->is('dashboard/course*') ?'active':null}}">
                                                    <i class="fa fa-contao"></i> <span>@translate(Courses)</span>
                                            </a>
                                        </li>           
                                @endif

                                @if(Auth::user()->id == '1403')
                                <li class="{{request()->is('dashboard/send-whats-app-message*') ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                        <span>@translate(Promotion)</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        <li>
                                            <a href="{{route('send-whats-app-message')}}"
                                            class="{{request()->is('dashboard/send-whats-app-message')
                                                    ?'active':null}}">
                                                    @translate(What's App Message)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('send-whats-app-message-using-excel')}}"
                                            class="{{request()->is('dashboard/send-whats-app-message-using-excel')
                                                    ?'active':null}}">
                                                    @translate(Message Using Excel)
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif

                                @if(Auth::user()->id == '1247') 
                                    <li class="{{request()->is('dashboard/tutor*') ? 'active' : null}}">
                                        <a href="javaScript:void();">
                                            <i class="fa fa-bus"></i>
                                            <span>@translate(Enquiry)</span>
                                            <i class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">
                                            <li><a href="{{route('enquiry.index')}}"
                                                class="{{request()->is('/tutor*') ?'active':null}}">@translate(Tutor Request)</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Navigation bar -->
    </div>
    <!-- End Sidebar -->
</div>
