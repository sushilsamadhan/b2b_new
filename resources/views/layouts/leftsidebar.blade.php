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
@php
    $school = 1;
@endphp
@if(Auth::user()->id != "5")
                    <li><a href="{{route('dashboard')}}">
                            <i class="fa fa-tachometer"
                                aria-hidden="true"></i><span> @translate(Dashboard)</span></a>
                    </li>

                    <li class="{{request()->is('student*') ? 'active' : null}}">
                        <a href="javaScript:void();">
                            <i class="fa fa-users"></i>
                            <span>@translate(User Management)</span><i class="feather icon-chevron-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li><a href="{{route('students.index')}}"
                                class="{{request()->is('student*')  ?'active':null}}">@translate(Students)</a>
                            </li>
                        </ul>
                    </li>
 
                    <li class="{{request()->is('media/manager*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>@translate(Media Manager)</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li>
                                        <a href="{{route('slider.index')}}"
                                           class="{{request()->is('slider*')
                                                ?'active':null}}">
                                            @translate(Slider List)
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="{{request()->is('dashboard/course*')
                                   ||request()->is('dashboard/category*')
                                   || request()->is('dashboard/category*') ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-book"></i>
                                <span>@translate(Courses)
                                <sup class="badge badge-info">{{\App\Model\Course::where('is_published',false)->count() > 0 ? "@translate(Unpublished)":null}}</sup>
                                </span>
                                    <i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    {{--<li>
                                        <a href="{{route('categories.index')}}" class="{{request()->is('dashboard/category*') ?'active':null}}">
                                            @translate(Categories)
                                        </a>
                                    </li>--}}
                                    <li>
                                        <a href="{{route('course.create')}}" class="{{request()->is('dashboard/course/create*') ?'active':null}}">Add New Content</a>
                                    </li>
                                    <li>
                                        <a href="{{route('course.index')}}" class="{{request()->is('dashboard/course/index*') ?'active':null}}">All Content
                                            <sup class="badge badge-info">
                                    {{\App\Model\Course::where('is_published',false)->count() > 0 ? \App\Model\Course::where('is_published',false)->count():null}}
                                            </sup>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="{{request()->is('smtp*') ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-gear"></i>
                                    <span>@translate(Settings)</span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                        <li>
                                            <a href="{{route('pages.index')}}"
                                               class="{{request()->is('pages*') ?'active':null}}">@translate(Pages)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('school.index')}}"
                                               class="{{request()->is('school*') ?'active':null}}">@translate(School Config Settings)
                                            </a>
                                        </li>
                                </ul>
                            </li>


@else
                            @if(Auth::user()->is_external == "2")
                            <li class="{{request()->is('dashboard/my/live-tuition')
                                    ? 'active' : null}}">
                                <a href="{{route('live-tuition-instructor')}}">
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span>@translate(Live Tuition)</span>
                                </a>
                            </li>
                            <li class="{{request()->is('dashboard/my/live-tuition-data')
                                    ? 'active' : null}}">
                                <a href="{{route('live-tuition-data')}}">
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span>@translate(Tuition Booking Details)</span>
                                </a>
                            </li>
                            @else
                            
                            <li><a href="{{route('dashboard')}}">
                                    <i class="fa fa-tachometer"
                                       aria-hidden="true"></i><span> @translate(Dashboard)</span></a>
                            </li>

                            {{-- Admin's Nav --}}
                            @if(Auth::user()->id == "5")
                            <li class="{{request()->is('dashboard/instructor/instructor-access*')
                                    ? 'active' : null}}">
                                    <a href="{{route('instructor.access')}}">
                                        <i class="fa fa-users"></i>
                                        <span>@translate(Instructor Access)</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                            </li>
                            @endif
                       
                                <li class="{{request()->is('dashboard/user*')
                                   || request()->is('dashboard/student*')
                                   || request()->is('dashboard/instructor*')
                                    ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-users"></i>
                                        <span>@translate(User Management)</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                        <li><a href="{{route('users.index')}}"
                                               class="{{request()->is('dashboard/user*')  ?'active':null}}">@translate(Admins)</a>
                                        </li>
                                    @endif
                                        <li><a href="{{route('instructors.index')}}"
                                               class="{{request()->is('dashboard/instructor*') ?'active':null}}">@translate(Instructors)</a>
                                        </li>
                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                     
                                        <li><a href="{{route('students.index')}}"
                                               class="{{request()->is('dashboard/student*')  ?'active':null}}">@translate(Students)</a>
                                        </li>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin" || Auth::user()->id == "5")
                                        <li><a href="{{route('school.index')}}"
                                           class="{{request()->is('dashboard/school/index')
                                                ?'active':null}}">
                                                 Institute / School List
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('agent.index')}}"
                                            class="{{request()->is('dashboard/agent/index')
                                                    ?'active':null}}">
                                                    Agent List
                                            </a>
                                        </li>
                                    @endif
                                    </ul>
                                </li>

                                @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin" || Auth::user()->id == "5")
                                <li class="{{request()->is('dashboard/registered-user*')
                                    || request()->is('dashboard/summary-coupon/index')
                                    || request()->is('dashboard/academic-revenue')
                                    || request()->is('dashboard/competetive-revenue')
                                    ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-users"></i>
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
                                {{-- Data Validation Report --}}                    
                                <li class="{{request()->is('dashboard/media/manager*')
                                        ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-picture-o"></i>
                                        <span>Data Validation Report</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                    {{-- Video Link Validation --}}
                                        <li>
                                            <a href="{{route('incorrect_report/incorrectvideo')}}"
                                            class="{{request()->is('dashboard/incorrect_report/incorrectvideo')
                                                    ?'active':null}}">
                                                    Video Link Validation
                                            </a>
                                        </li>
                                    {{-- Pdf Link Validation --}}
                                        <li>
                                            <a href="{{route('incorrect_report/incorrectpdf')}}"
                                                class="{{request()->is('dashboard/course/incorrectpdf') ?'active':null}}">@translate(Pdf Link Validation)
                                            </a>
                                        </li>
                                    {{-- Course Assessment Discrepancy  --}}
                                        <!-- <li>
                                            <a href="{{--route('incorrect_report.assesment')--}}"
                                                class="{{--request()->is('dashboard/incorrect_report/assesment') ?'active':null --}}">@translate(Course Validation)
                                            </a>
                                        </li> -->
                                    {{-- Content Summary  --}}
                                        <!-- <li>
                                            <a href="{{--route('incorrect_report.contentsummary')--}}"
                                                class="{{--request()->is('dashboard/incorrect_report/contentsummary') ?'active':null --}}">@translate(Content Summary)
                                            </a>
                                        </li> -->
                                    {{-- Question Validation --}}
                                    <li>
                                        <a href="{{route('incorrect_report.questionvalidation')}}"
                                                class="{{request()->is('dashboard/incorrect_report/questionvalidation') ?'active':null}}">@translate(Question Validation)
                                        </a>
                                    </li>
                                    </ul>
                                </li>     
                                {{-- End Data Validation Report --}}        
                                {{-- Url Access Permission --}}                        
                               <li class="{{request()->is('dashboard/access*')
                                    || request()->is('dashboard/url-access/index')
                                    || request()->is('dashboard/url-access/add')
                                    || request()->is('dashboard/url-access/update')
                                    ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-lock"></i>
                                        <span>@translate(URL Permission)</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        <li><a href="{{route('url_access.index')}}"
                                            class="{{request()->is('dashboard/url-access/index')  ?'active':null}}">@translate(Add Permissions)</a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- End Url Access Permission --}} 
                                
                                @endif                

                           {{-- dashboard/live-class* --}}
                                <li class="{{request()->is('')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>Live Class</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li>
                                        <a href="{{route('add-live-class')}}"
                                           class="{{request()->is('dashboard/add-live-class*')
                                                ?'active':null}}">
                                                Create Live Class
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('live-class')}}"
                                           class="{{request()->is('dashboard/live-class*')
                                                ?'active':null}}">
                                                 Live Class List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('live-class-join-students')}}"
                                           class="{{request()->is('dashboard/live-class-join-students*')
                                                ?'active':null}}">
                                                 Live Class Joining Data
                                        </a>
                                    </li>
                                </ul>
                            </li>
                           
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")


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


                            <li class="{{request()->is('dashboard/competitive-subscription*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>@translate(One To One Tuition)</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li>
                                        <a href="{{route('instructors.onetoone_instructors')}}"
                                           class="{{request()->is('dashboard/one-to-one-instructor/index')
                                                ?'active':null}}">
                                                @translate(Schedule Tuition)
                                        </a>
                                    </li>
                                    {{--<li>
                                        <a href="{{route('competitive-subscription')}}"
                                           class="{{request()->is('dashboard/competitive-subscription*')
                                                ?'active':null}}">
                                                @translate(Schedule Tuition)
                                        </a>
                                    </li>--}}
                                </ul>
                            </li>

{{-- daily class schedule --}}

                                {{--<li class="{{request()->is('dashboard/')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>@translate(Daily Class Schedule)</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li>
                                        <a href="{{route('academic-courses-subscription')}}"
                                           class="{{request()->is('dashboard/academic-courses-subscription')
                                                ?'active':null}}">
                                                @translate(Academic Courses)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('competitive-courses-subscription')}}"
                                           class="{{request()->is('dashboard/competitive-courses-subscription')
                                                ?'active':null}}">
                                                @translate(Competitive Courses)
                                        </a>
                                    </li>
                                </ul>
                            </li>--}}

{{-- end daily class schedule --}}

                            @endif 

                            {{-- Admin's Nav --}}
                            @if(Auth::user()->id == "5")

                        <li class="{{request()->is('dashboard/competitive-subscription*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>@translate(One To One Tuition)</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li>
                                        <a href="{{route('instructors.onetoone_instructors')}}"
                                           class="{{request()->is('dashboard/one-to-one-instructor/index')
                                                ?'active':null}}">
                                                @translate(Schedule Tuition)
                                        </a>
                                    </li>
                                    {{--<li>
                                        <a href="{{route('competitive-subscription')}}"
                                           class="{{request()->is('dashboard/competitive-subscription*')
                                                ?'active':null}}">
                                                @translate(Schedule Tuition)
                                        </a>
                                    </li>--}}
                                </ul>
                            </li>


                           {{-- <li class="{{request()->is('dashboard/')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>@translate(Daily Class Schedule)</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li>
                                        <a href="{{route('academic-courses-subscription')}}"
                                           class="{{request()->is('dashboard/academic-courses-subscription')
                                                ?'active':null}}">
                                                @translate(Academic Courses)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('competitive-courses-subscription')}}"
                                           class="{{request()->is('dashboard/competitive-courses-subscription')
                                                ?'active':null}}">
                                                @translate(Competitive Courses)
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}


{{-- daily class schedule --}}

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

{{-- end daily class schedule --}}

                            @endif

                            <li class="{{request()->is('dashboard/media/manager*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>@translate(Media Manager)</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li>
                                        <a href="{{route('media.index')}}"
                                           class="{{request()->is('dashboard/media/manager*')
                                                ?'active':null}}">
                                            @translate(Add Media)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('slider.index')}}"
                                           class="{{request()->is('dashboard/slider*')
                                                ?'active':null}}">
                                            @translate(Slider List)
                                        </a>
                                    </li>
                                </ul>
                            </li>

                           <li class="{{request()->is('dashboard/media/manager*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>Testimonial</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li>
                                        <a href="{{route('testimonial.create')}}"
                                           class="{{request()->is('dashboard/testimonialia*')
                                                ?'active':null}}">
                                                Create Testimonial
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('testimonial.index')}}"
                                           class="{{request()->is('dashboard/testimonialia*')
                                                ?'active':null}}">
                                                 Testimonial List
                                        </a>
                                    </li>
                                </ul>
                            </li>

 					
                            <li class="{{request()->is('dashboard/course*')
                                   ||request()->is('dashboard/category*')
                                   || request()->is('dashboard/category*') ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-book"></i>
                                    <span>@translate(Courses) @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                            <sup
                                                class="badge badge-info">{{\App\Model\Course::where('is_published',false)->count() > 0 ? "@translate(Unpublished)":null}}</sup>
                                        @endif</span>

                                    <i class="feather icon-chevron-right"></i>

                                </a>
                                <ul class="vertical-submenu">
                                    {{-- @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin") --}}
                                        {{-- instructor's Nav --}}
                                        <li><a href="{{route('categories.index')}}"
                                            class="{{request()->is('dashboard/category*') ?'active':null}}">@translate(Categories)</a>
                                     </li>
                                        <li><a href="{{route('course.create')}}"
                                               class="{{request()->is('dashboard/course/create*') ?'active':null}}">Add New Content</a></li>
                                    {{-- @else --}}
                                        {{-- admin's Nav --}}
                                        
                                    {{-- @endif --}}

                                    <li><a href="{{route('course.index')}}"
                                           class="{{request()->is('dashboard/course/index*') ?'active':null}}">All Content
                                             {{-- @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin") --}}
                                                <sup
                                                    class="badge badge-info">{{\App\Model\Course::where('is_published',false)->count() > 0 ? \App\Model\Course::where('is_published',false)->count():null}}</sup>
                                            {{-- @endif --}}
                                        </a></li>

                                </ul>
                            </li>
                            <li class="{{request()->is('dashboard/data-analytics*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>Data Analytics</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li>
                                        <a href="{{route('dataanalytic.board')}}"
                                           class="{{request()->is('dashboard/data-analytics*')
                                                ?'active':null}}">
                                               Board
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a href="{{route('dataanalytic.competitive')}}"
                                           class="{{request()->is('dashboard/data-analytics*')
                                                ?'active':null}}">
                                                 Competitive
                                        </a>
                                    </li> -->
                                </ul>
                            </li>

                            <li class="{{request()->is('dashboard/current-affairs*') ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-book"></i>
                                    <span>@translate(Manage Current Affairs)</span>
                                    <i class="feather icon-chevron-right"></i>
                                </a>

                                <ul class="vertical-submenu">
                                        <li><a href="{{route('current_affairs.add')}}"
                                            class="{{request()->is('dashboard/current-affairs/create') ?'active':null}}">@translate(Add Current Affairs)</a>
                                        </li>
                                        <li><a href="{{route('current_affairs.list')}}"
                                            class="{{request()->is('dashboard/current-affairs') ?'active':null}}">@translate(List Current Affairs)</a>
                                        </li>
                                </ul>
                            </li>

                        {{-- Coupon manager --}}
                            @if (couponActive() && \Illuminate\Support\Facades\Auth::user()->user_type == "Admin")

                                <li class="{{request()->is('dashboard/coupon*')
                                    ? 'active' : null}}">
                                    <a href="javascript:;">
                                        <i class="fa fa-bullhorn"></i>
                                        <span>@translate(Coupon Manager)</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        <li>
                                            <a href="{{route('coupon.index')}}"
                                               class="{{request()->is('dashboard/coupon/new')
                                                    ?'active':null}}">
                                                @translate(New Coupon)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('coupon.all')}}"
                                               class="{{request()->is('dashboard/coupons')
                                                    ?'active':null}}">
                                                @translate(All Coupons)
                                            </a>
                                        </li>
                                    
                                    </ul>
                                </li>
                            @endif
                            {{-- Coupon manager::END --}}




                            {{-- Zoom manager --}}
                            @if (zoomActive() && \Illuminate\Support\Facades\Auth::user()->user_type != "Admin")

                                <li class="{{request()->is('dashboard/zoom*')
                                    ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-television"></i>
                                        <span>@translate(Zoom Meeting)</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        <li>
                                            <a href="{{route('zoom.setting')}}"
                                               class="{{request()->is('dashboard/zoom/setting*')
                                                    ?'active':null}}">
                                                @translate(Zoom Setup)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('zoom.index')}}"
                                               class="{{request()->is('dashboard/zoom/board*')
                                                    ?'active':null}}">
                                                @translate(Zoom Dashboard)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('meeting.create')}}"
                                               class="{{request()->is('dashboard/zoom/create/meeting*')
                                                    ?'active':null}}">
                                                @translate(Create Meeting)
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            {{-- Zoom manager::END --}}

                            {{--quiz start--}}
                            @php $forhide=1; @endphp
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin" && env('QUIZ_ACTIVE') == 'YES' && $forhide==0)
                                <li class="{{request()->is('dashboard/quiz*') ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-question-circle"></i>
                                        <span>@translate(Assessment)</span>
                                        <i class="feather icon-chevron-right"></i>

                                    </a>
                                    <ul class="vertical-submenu">
                                        {{-- instructor's Nav --}}
                                        <li><a href="{{route('quiz.create')}}"
                                               class="{{request()->is('dashboard/quiz/create*') ?'active':null}}">@translate(Assessment
                                                Create)</a></li>
                                        <li><a href="{{route('quiz.list')}}"
                                               class="{{request()->is('dashboard/quiz/list*') || request()->is('dashboard/quiz/questions*')  ?'active':null}}">@translate(Assessment
                                                List)</a></li>
                                    </ul>
                                </li>
                            @endif
                            {{--quiz end--}}
                        <li class="{{request()->is('dashboard/media/manager*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>Mock Test</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    
                                    <li>
                                        <a href="{{route('testquestions.index')}}"
                                           class="{{request()->is('dashboard/testquestions*')
                                                ?'active':null}}">
                                                 Manage Questions
                                        </a>
                                    </li>
                                </ul>

                                <ul class="vertical-submenu">
                                {{-- Mock Test Question tag --}}
                                    <li>
                                        <a href="{{route('questiontag.createTag')}}"
                                            class="{{request()->is('dashboard/createQuestion') ?'active':null}}">@translate(Create Question Tag)
                                        </a>
                                    </li>
                                </ul>

                                <ul class="vertical-submenu">
                                    {{-- Mock Test Master --}}
                                        <li>
                                            <a href="{{route('mtestmasters.index')}}"
                                               class="{{request()->is('dashboard/mtestmasters/index') ?'active':null}}">@translate(Manage Mock Test)
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="vertical-submenu">
                                    {{-- Package Services --}}
                                        <li>
                                            <a href="{{route('service.index')}}"
                                               class="{{request()->is('dashboard/service/index') ?'active':null}}">@translate(Manage Package Services)
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="vertical-submenu">
                                    {{-- Package Setting --}}
                                        <li>
                                            <a href="{{route('packagesettings.index')}}"
                                               class="{{request()->is('dashboard/packagesettings/index') ?'active':null}}">@translate(Manage Package Settings)
                                            </a>
                                        </li>
                                    </ul>
    
                            </li>  


                            <li class="{{request()->is('dashboard/media/manager*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>Project Work</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                             <!--  <ul class="vertical-submenu">
                               {{--  Manage Project Work Classes --}}
                                    <li>
                                        <a href="{{route('projectworkclasses.index')}}"
                                           class="{{request()->is('dashboard/projectworkclasses*')
                                                ?'active':null}}">
                                                 PW Classes
                                        </a>
                                    </li>
                                </ul>
				-->


                                <ul class="vertical-submenu">
                                    {{-- Manage Project Work Category --}}
                                        <li>
                                            <a href="{{route('projectworkcat.index')}}"
                                               class="{{request()->is('dashboard/projectworkcat/index') ?'active':null}}">@translate(PW Category)
                                            </a>
                                        </li>
                                    </ul>
                            
                                    <ul class="vertical-submenu">
                                    {{-- Create Project Work --}}
                                        <li>
                                            <a href="{{route('pwcourse.create')}}"
                                               class="{{request()->is('dashboard/pwcourse/create') ?'active':null}}">@translate(Create Project Work)
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="vertical-submenu">
                                    {{-- All Project Work --}}
                                        <li>
                                            <a href="{{route('pwcourse.index')}}"
                                               class="{{request()->is('dashboard/pwcourse/index') ?'active':null}}">@translate(All Project Work)
                                            </a>
                                        </li>
                                    </ul>                                    
                                    <ul class="vertical-submenu">
                                    {{-- Manage Project Work Enrollment --}}
                                        <li>
                                            <a href="{{route('projectworkenroll.index')}}"
                                               class="{{request()->is('dashboard/projectworkenroll/index') ?'active':null}}">@translate(PW Enrollment)
                                            </a>
                                        </li>
                                    </ul>                                
                                </li> 
                                
                                @if(Auth::user()->user_type === "Admin" || Auth::user()->user_type === "Instructor")
                                <li class="{{request()->is('dashboard/media/manager*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>Mentor</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    
                                    <li>
                                        <a href="{{route('mentor.index')}}"
                                           class="{{request()->is('add-mentor*')
                                                ?'active':null}}">
                                                Add Mentor
                                        </a>
                                    </li>
                                </ul>

                                <ul class="vertical-submenu">                                   
                                        <li>
                                            <a href="{{route('mentor.list_mentor')}}"
                                               class="{{request()->is('list-mentor') ?'active':null}}">@translate(Mentor List)
                                            </a>
                                        </li>
                                </ul>
                            <li>
                                @endif

                            {{-- Webinar --}}                    
                            <li class="{{request()->is('dashboard/media/manager*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>Webinars</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                {{-- Create Webinar --}}
                                    <li>
                                        <a href="{{route('webinar.create')}}"
                                           class="{{request()->is('dashboard/webinar/create')
                                                ?'active':null}}">
                                                Create Webinar
                                        </a>
                                    </li>
                                </ul>
                                <ul class="vertical-submenu">
                                {{-- All Webinar --}}
                                    <li>
                                        <a href="{{route('webinar.index')}}"
                                            class="{{request()->is('dashboard/webinar/index') ?'active':null}}">@translate(All Webinars)
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{--Certificate start--}}
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin" && certificate())
                                <li><a href="{{route('certificate.setup')}}"
                                       class="{{request()->is('dashboard/certificate*') ?'active':null}}">
                                        <i class="fa fa-certificate"></i> <span>@translate(Certificate Setting)</span>
                                    </a>
                                </li>
                            @endif
                            {{--Certificate end--}}


                            {{-- Package area --}}
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                
                                <li><a href="{{route('packages.index')}}"
                                       class="{{request()->is('dashboard/package*') ?'active':null}}">
                                        <i class="fa fa-briefcase"></i> <span>@translate(Instructor Package)</span></a>
                                </li>

                                <li><a href="{{route('payments.index')}}"
                                       class="{{request()->is('dashboard/payment*') ?'active':null}}">
                                        <i class="fa fa-money"></i>
                                        <span>@translate(Instructor's Payment)
                                            @if(\App\Model\Payment::where('status','Request')->count() > 0)
                                                <sup
                                                    class="badge badge-info">{{\App\Model\Payment::where('status','Request')->count()}}
                                                </sup>

                                            @endif
                                        </span>
                                    </a>
                                </li>

                            @endif
                            @if(Auth::user()->user_type === "Admin" || Auth::user()->id == "5")
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

                            @if(Auth::user()->user_type === "Admin" || Auth::user()->user_type === "Instructor")
                                <li class="{{request()->is('dashboard/forum*') ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-bus"></i>
                                        <span>@translate(Jobs)</span>
                                        <i class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        <li><a href="{{ url('/add_new_jobs') }}"
                                                class="{{request()->is('/add_new_jobs*') ?'active':null}}">@translate(Add Jobs Notification)</a>
                                        </li>
                                    </ul>
                                    <ul class="vertical-submenu">
                                        <li><a href="{{ url('/job_list') }}"
                                                class="{{request()->is('/job_list*') ?'active':null}}">@translate(Job Notification List)</a>
                                        </li>
                                    </ul>                                
                                </li>
                            @endif 

                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")

                                <li><a href="{{route('students.index')}}"
                                       class="{{request()->is('dashboard/students*')  || request()->is('student*')?'active':null}}">
                                        <i class="fa fa-users"></i> <span>@translate(Students)</span></a>
                                </li>
                                <li><a href="{{route('students.enrolled-list')}}"
                                       class="{{request()->is('dashboard/students*')  || request()->is('student*')?'active':null}}">
                                        <i class="fa fa-user"></i> <span>@translate(Course Enrollments)</span></a>
                                </li>
                                {{-- Message with student --}}
                                <li><a href="{{route('messages.index')}}"
                                       class="{{request()->is('dashboard/message*') ?'active':null}}">
                                        <i class="fa fa-envelope-o"></i> <span>@translate(Messages)</span>
                                    </a>
                                </li>
                                <li><a href="{{route('admin-notification.index')}}"
                                       class="{{request()->is('dashboard/admin-notification*') ?'active':null}}">
                                        <i class="fa fa-envelope-o"></i> <span>@translate(Notification)</span>
                                    </a>
                                </li>
                                {{-- Comment in Course --}}
                                <li><a href="{{route('comments.index')}}"
                                       class="{{request()->is('dashboard/comments*') ?'active':null}}">
                                        <i class="fa fa-comments-o"></i> <span>@translate(Comments)</span>
                                    </a>
                                </li>
                                {{-- Payment request area --}}
                                {{-- <li><a href="{{route('payments.index')}}"
                                       class="{{request()->is('dashboard/payment*') ?'active':null}}">
                                        <i class="fa fa-money"></i> <span>@translate(Request Payment)</span>

                                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                            <sup
                                                class="badge badge-info">{{\App\Model\Payment::where('status','Request')->count()}}</sup>
                                        @endif
                                    </a>
                                </li> --}}

                                {{-- Instructor Earning area 
                                <li><a href="{{route('instructor.earning')}}"
                                       class="{{request()->is('dashboard/instructor*') ?'active':null}}">
                                        <i class="fa fa-history"></i> <span>@translate(Earning History)</span>
                                    </a>
                                </li> --}}

                            @endif


                            {{-- affiliate --}}

                            @if(affiliateStatus() && \Illuminate\Support\Facades\Auth::user()->user_type == 'Admin') 
                                 {{-- <li class="{{request()->is('dashboard/affiliate*') ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="la la-adn"></i>
                                        <span>@translate(Affiliate Area)</span>
                                        @if(\App\Model\Affiliate::where('is_confirm',false)->where('is_cancel',false)->count() >0 || \App\Model\AffiliatePayment::where('status','Request')->count() > 0)
                                            <sup
                                                class="badge badge-info">{{(int)\App\Model\Affiliate::where('is_confirm',false)->where('is_cancel',false)->count() + (int)\App\Model\AffiliatePayment::where('status','Request')->count()}}</sup>
                                        @endif
                                    </a> --}}
                                    <ul class="vertical-submenu">
                                        {{--settings --}}
                                        <li><a href="{{route('affiliate.setting.create')}}"
                                               class="{{request()->is('dashboard/affiliate/setting*') ?'active':null}}">@translate(Settings)</a>
                                        </li>


                                        <li><a href="{{route('affiliate.request.list')}}"
                                               class="{{request()->is('dashboard/affiliate/index') ?'active':null}}">@translate(Requests)
                                                @if(\App\Model\Affiliate::where('is_confirm',false)->where('is_cancel',false)->count() >0)
                                                    <sup
                                                        class="badge badge-info">{{\App\Model\Affiliate::where('is_confirm',false)->where('is_cancel',false)->count()}}</sup>
                                                @endif
                                            </a>
                                        </li>


                                        <li><a href="{{route('affiliate.payment.request')}}"
                                               class="{{request()->is('dashboard/affiliate/payment*') ?'active':null}}">@translate(Payment
                                                request)
                                                @if(\App\Model\AffiliatePayment::where('status','Request')->count() > 0)
                                                    <sup
                                                        class="badge badge-info">{{\App\Model\AffiliatePayment::where('status','Request')->count()}}</sup>
                                                @endif
                                            </a>
                                        </li>


                                    </ul>
                                </li> 
                             @endif 
                            

@if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin" || Auth::user()->id == "5")
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

                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin" )
                                {{-- Admin Earning area 
                                <li><a href="{{route('admin.earning.index')}}"
                                       class="{{request()->is('dashboard/admin*') ?'active':null}}">
                                        <i class="fa fa-history"></i> <span>@translate(Admin's Earning)</span>
                                    </a>
                                </li> --}}

                                @if(themeManager() == 'rumbok')
                                    <li><a href="{{route('know.index')}}"
                                           class="{{request()->is('dashboard/know*') ?'active':null}}">
                                            <i class="fa fa-sticky-note"></i> <span>@translate(Home Page Content)</span>
                                        </a>
                                    </li>
                                   
                                @endif
                            @endif
                            @if(env('BLOG_ACTIVE') == "YES")
                                <li><a href="{{route('blog.index')}}"
                                        class="{{request()->is('dashboard/blog*') ?'active':null}}">
                                        <i class="fa fa-contao"></i> <span>@translate(Blog)</span>
                                    </a>
                                </li>
                            @endif
                         @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                            {{-- Support Ticket --}}
                            <li><a href="{{route('tickets.index')}}"
                                   class="{{request()->is('dashboard/ticket*') ?'active':null}}">
                                    <i class="fa fa-envelope-open-o"></i> <span>@translate(Support Ticket)</span>
                                </a>
                            </li>
                            @endif

                            {{-- ORDER Management --}}
                            <li class="{{request()->is('order/index') ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-users"></i>
                                    <span>@translate(Order Management)</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="{{route('orders.index')}}"
                                            class="{{request()->is('order/index')  ?'active':null}}">@translate(Order List)</a>
                                    </li>
                                </ul>
                            </li>    

                            {{-- Settings Area --}}
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                            <li class="{{request()->is('dashboard/smtp*')
                                   || request()->is('dashboard/language*')
                                   || request()->is('dashboard/slider*')
                                   || request()->is('dashboard/site*')
                                   || request()->is('dashboard/pages*')
                                   || request()->is('dashboard/app*')
                                   || request()->is('dashboard/themes*')
                                   || request()->is('dashboard/currencies*') ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-gear"></i>
                                    <span>@translate(Settings)</span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    
                                        <li><a href="{{route('app.setting')}}"
                                               class="{{request()->is('dashboard/app*') ?'active':null}}">@translate(Gateway
                                                Settings)</a></li>
                                        <li><a href="{{route('currencies.index')}}"
                                               class="{{request()->is('dashboard/currency*') ?'active':null}}">@translate(Currency
                                                Settings)</a>
                                        </li>
                                        <li><a href="{{route('language.index')}}"
                                               class="{{request()->is('dashboard/language*') ?'active':null}}">@translate(Language
                                                Settings)</a></li>
                                        <li><a href="{{route('smtp.create')}}"
                                               class="{{request()->is('dashboard/smtp*') ?'active':null}}">@translate(SMTP
                                                Settings)</a></li>

                                        <li><a href="{{route('sliders.index')}}"
                                               class="{{request()->is('dashboard/slider*') ?'active':null}}">@translate(Slider
                                                Settings)</a></li>

                                        <li><a href="{{route('pages.index')}}"
                                               class="{{request()->is('dashboard/pages*') ?'active':null}}">@translate(Pages)</a>
                                        </li>


                                        <li><a href="{{route('site.setting')}}"
                                               class="{{request()->is('dashboard/site*') ?'active':null}}">@translate(Organization
                                                Settings)</a></li>

                                        <li><a href="{{route('other.setting')}}"
                                               class="{{request()->is('dashboard/other*') ?'active':null}}">@translate(Other
                                                Settings)</a></li>


                                                {{-- @else
                                         Instructor Earning area 
                                        <li><a href="{{route('account.create')}}"
                                               class="{{request()->is('dashboard/account*') ?'active':null}}">@translate(Payment
                                                Account Setup)
                                            </a>
                                        </li>--}}
                                    @endif
                                </ul>
                            </li>

                            @if(env('FORUM_PANEL') == "YES")
                                {{-- Forum manager --}}
                                @if(Auth::user()->user_type === "Admin")
                                    <li class="{{request()->is('dashboard/forum*') ? 'active' : null}}">
                                        <a href="javaScript:void();">
                                            <i class="fa fa-question-circle"></i>
                                            <span>@translate(Forum Manager)</span>
                                            <i class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">
                                            <li><a href="{{route('forum.panel')}}"
                                                   class="{{request()->is('dashboard/forum/panel*') ?'active':null}}">@translate(Forum
                                                    Posts)</a></li>

                                            <li><a href="{{route('forum.replies')}}"
                                                   class="{{request()->is('dashboard/forum/replies*') ?'active':null}}">@translate(Forum
                                                    Replies)</a></li>

                                            <li><a href="{{route('forum.index')}}" target="_blank">@translate(Browse
                                                    Forum)</a></li>
                                        </ul>
                                    </li>
                                @endif
                            @endif



                            @if(env('SUBSCRIPTION_ACTIVE') == "YES")
                                {{-- Zoom manager --}}
                                @if(Auth::user()->user_type === "Admin" || Auth::user()->user_type === "Instructor")
                                    <li class="{{request()->is('dashboard/subscription*') ? 'active' : null}}">
                                        <a href="javaScript:void();">
                                            <i class="fa fa-th-list"></i>
                                            <span>@translate(Subscription Manager)</span>
                                            <i class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">

                                            @if(adminPower())

                                                <li>
                                                    <a href="{{route('subscription.index')}}"
                                                       class="{{request()->is('dashboard/subscription') || request()->is('dashboard/subscription/package/courses*') ? 'active':null}}">
                                                        @translate(Packages)
                                                    </a>
                                                </li>

                                                @if(enableCourse())
                                                    <li>
                                                        <a href="{{route('subscription.courses')}}"
                                                           class="{{request()->is('dashboard/subscription/courses') ?'active':null}}">
                                                            @translate(Courses)
                                                        </a>
                                                    </li>
                                                @endif


                                                <li>
                                                    <a href="{{route('subscription.members')}}"
                                                       class="{{request()->is('dashboard/members') ?'active':null}}">
                                                        @translate(Members)
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{route('subscription.payments')}}"
                                                       class="{{request()->is('dashboard/payments') ?'active':null}}">
                                                        @translate(Payments)
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{route('subscription.instructor.earning')}}"
                                                       class="{{request()->is('dashboard/instructor/earning*') ?'active':null}}">
                                                        @translate(Earnings)
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{route('subscription.settings')}}"
                                                       class="{{request()->is('dashboard/subscription/settings') ?'active':null}}">
                                                        @translate(Settings)
                                                    </a>
                                                </li>

                                            @endif

                                            @if(enableInstructorRequest())

                                                <li>
                                                    <a href="{{route('subscription.requests')}}"
                                                       class="{{request()->is('dashboard/subscription/requests') ?'active':null}}">
                                                        @translate(Requests)
                                                    </a>
                                                </li>
                                            @endif

                                            @if(instructorPower())

                                                <li>
                                                    <a href="{{route('subscription.payments')}}"
                                                       class="{{request()->is('subscription.payments') ?'active':null}}">
                                                        @translate(Payment)
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{route('subscription.instructor.earning')}}"
                                                       class="{{request()->is('dashboard/instructor/earning*') ?'active':null}}">
                                                        @translate(Earnings)
                                                    </a>
                                                </li>

                                            @endif


                                        </ul>
                                    </li>
                                @endif
                            @endif

                            @if(env('ADDONS_MANAGER') == "YES")
                                {{-- Zoom manager --}}
                                @if(Auth::user()->user_type === "Admin")


                                    {{-- Addons manager --}}
                                    <li><a href="{{route('addons.manager.index')}}"
                                           class="{{request()->is('dashboard/addon*') ?'active':null}}">
                                            <i class="fa fa-puzzle-piece"></i> <span>@translate(Addon Manager)</span>
                                        </a>
                                    </li>
                                @endif
                            @endif

                            @if(env('WALLET_ACTIVE') == "YES")
                                {{-- Forum manager --}}
                                @if(Auth::user()->user_type === "Admin")
                                    <li class="{{request()->is('dashboard/wallet*') ? 'active' : null}}">
                                        <a href="javaScript:void();">
                                            <i class="fa fa-question-circle"></i>
                                            <span>@translate(Wallet Settings)</span>
                                            <i class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">
                                            <li>
                                                <a href="{{route('dashboard.wallet')}}"
                                                   class="{{request()->is('dashboard/wallet') ?'active':null}}">
                                                   @translate(Wallet Options)
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @endif


                            @if(env('THEME_MANAGER') == "YES")
                                @if(Auth::user()->user_type === "Admin")
                                    {{-- THEME manager --}}
                                    <li><a href="{{route('theme.manager.index')}}"
                                           class="{{request()->is('dashboard/theme*') ?'active':null}}">
                                            <i class="fa  fa-pie-chart"></i> <span>@translate(Theme Manager)</span>
                                        </a>
                                    </li>
                                @endif
                            @endif




                            {{-- Activity Log Manager --}}
                          {{--  @if(Auth::user()->user_type === "Admin" || Auth::user()->user_type === "Instructor")
                                <li class="{{request()->is('dashboard/forum*') ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-bus"></i>
                                        <span>@translate(Activity Log Manager)</span>
                                        <i class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        <li><a href="{{ url('/activity') }}"
                                               class="{{request()->is('/activity*') ?'active':null}}">@translate(Logs)</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif --}}
@endif
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
