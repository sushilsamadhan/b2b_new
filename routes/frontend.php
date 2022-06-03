<?php

/*all front end route here
 *
 * */

 Route::get('x', function () {
    return checkRedeem(9);//,'cache.headers:private;max_age=2592000'
 });

 Route::get('clear_cache', function () {

    \Artisan::call('optimize:clear');    
    \Artisan::call('config:clear');
    \Artisan::call('config:cache');

    dd("Cache is cleared");

});

Route::get('/getSchoolData', 'SchoolController@getSchoolData');
// if($_SERVER['SERVER_NAME'] == "entrepreneurindia.tv"){
//     return Redirect::to('http://heera.it');
// }
Route::group(['middleware' => ['b2bconfig', 'check.frontend','demo', 'activity']], function () {
    // homepage
    Route::get('/', 'FrontendController@homepage')->name('homepage');

    Route::get('/school', 'FrontendController@school')->name('school');
    Route::get('/collage', 'FrontendController@collage')->name('collage');
    Route::get('/competitive', 'FrontendController@competitive')->name('competitive');
    Route::get('/entrepreneur', 'FrontendController@entrepreneur')->name('entrepreneur');
    Route::get('/folk-programme', 'FrontendController@folkProgramme')->name('folk-programme');

    Route::get('/industrial-documentry', 'CollageController@industrialDocumentry')->name('industrial-documentry');
    Route::get('/industrial-documentry/{slug?}', 'CollageController@industrialDocumentrySlug')->name('get-industrial-documentry-slug');
    Route::get('/industrial-documentry-search/{searchdata}', 'CollageController@industrialDocumentrySearch')->name('industrial-documentry-search');

    Route::get('/edp-courses', 'CollageController@edpCourses')->name('edp-courses');
    Route::get('/edp-courses-{slug}', 'CollageController@previewEdpCourse')->name('edp.preview');
    Route::get('/industry-course-{slug}', 'CollageController@previewEdpCourse')->name('industry.course.preview');

    Route::get('industries-courses/{sector_slug?}', 'CollageController@industrialCourses')
    ->name('industrial.courses');
    Route::get('industries-courses-search/{sector_slug?}', 'LandingPageController@industrialCoursesSearch')
    ->name('industrial.courses.search');

    Route::get('project-report/{cat_slug?}', 'CollageController@projectReport')
    ->name('project.report');
    Route::get('project-report-search/{cat_slug?}', 'LandingPageController@projectReportSearch')
    ->name('project.report.search');

    Route::get('project-report/{cat_slug?}/{sub_cat_slug?}', 'CollageController@projectReportCateSubcate')
    ->name('project.report.cateSubcate');


    Route::post('add/to/bcart', 'BcartController@addToBcart')
    ->name('add.to.bcart');

    Route::get('shopping/bcart', 'BcartController@shoppingBcart')
    ->name('shopping.bcart');

    Route::get('remove/bcart/{id}', 'BcartController@removeBcart')
    ->name('bcart.remove');

    Route::get('folklore-course/{slug}', 'CollageController@folkwareSingleCourse')
    ->name('folkware.single.course');


    // test-login    
    Route::get('test-series-login', 'FrontendController@checkTestSeriesLogin')->name('test-series-login');
  	  Route::match(['GET','POST'], 'test-series-auth', 'EdugorillaController@testSeriesAuth')->name('test-series-auth');
	
    // if (env('BLOG_ACTIVE') == "YES"){
        /*for frontend blog*/
        Route::get('blog/posts','FrontendController@blogPosts')->name('blog.all');
        Route::get('blog/details/{id}','FrontendController@singleBlog')->name('blog.details');
        Route::get('blog/category/{id}','FrontendController@categoryBlog')->name('blog.category');
        Route::get('blog/tag/{tag}','FrontendController@tagBlog')->name('blog.tag');
    // }

    /*search courses*/
    Route::get('search', 'FrontendController@searchCourses')->name('search.courses');

    Route::get('searchCourse', 'FrontendController@coursesSearch')->name('courses.search');
    //password_reset
    Route::get('password/reset', 'FrontendController@password_reset')
        ->name('student.password.reset');

    Route::get('password/otp/{mobile}', 'FrontendController@password_otp')
        ->name('password.otp');
        
    Route::post('password/reset-otp', 'FrontendController@reset_password_otp')
        ->name('password.reset-otp');
        
    Route::post('password/passwordReset', 'FrontendController@password_reset_otp')
        ->name('password.passwordReset');
        
    Route::post('password/mobile-check-otp', 'FrontendController@mobile_check_otp')
        ->name('password.mobile_check_otp');
        
    Route::post('password/mobile-otp-verify', 'FrontendController@mobile_otp_verify')
        ->name('password.mobile_otp_verify');
        
    
        
    Route::post('password/check-mobile-verified', 'FrontendController@check_mobile_verified')
        ->name('password.check_mobile_verified');

    Route::post('password/user-login', 'FrontendController@user_login')
        ->name('password.user_login');


    /*Course Category*/

    Route::get('boardsushil-{is}', 'FrontendController@courseCatsushil');

    Route::get('board-{slug1}-{slug2}', 'FrontendController@courseCat')
        ->name('course.category');
    Route::get('competitive-curriculum-{slug}', 'CompetitiveController@index')
        ->name('competitive.curriculum');
    Route::get('demo-courses/{slug}', 'FrontendController@demoCourses')
    ->name('demo.courses');

    /*single course details*/
    Route::get('course/{slug}', 'FrontendController@singleCourse')
        ->name('course.single');	
    Route::get('freestudy-courses/{slug}', 'FreeStudyController@listFreestudyCourses')
        ->name('list_freestudy_courses');
    Route::get('elite-courses-{slug}', 'EliteController@index')
        ->name('course.elite');
    Route::get('course-trial/{slug}/{cat_name}/{uri1}/{uri2}', 'CourseTrialController@lesson_details')->name('course.trial');

  Route::get('lesson/view_mind_map_demo/{id}/{otherMindMap?}', 'CourseTrialController@view_mind_map_demo')
       ->name('lesson.view_mind_map_demo'); 

    Route::get('trial/class/content/{id}', 'CourseTrialController@singleContent')
    ->name('trial.class.content');
/*Board Package*/
Route::get('packages/{slug}', 'BoardPackageController@board')->name('packages.board');
//Route::get('packages/preview_board/{id}/{enroll_id?}', 'BoardPackageController@preview_board')->name('packages.preview_board');
//Route::get('curriculum/{id}/{uri1?}/{uri2?}/{enroll_id?}', 'BoardPackageController@preview_board')->name('packages.preview_board');
Route::get('curriculum-{id}/{enroll_id?}', 'BoardPackageController@preview_board')->name('packages.preview_board');

/*Competitive Package*/
Route::get('competitive/competitive', 'CompetitivePackageController@competitive')->name('competitive.competitive');
Route::get('competitive/preview_competitive/{id}', 'CompetitivePackageController@preview_competitive')->name('competitive.preview_competitive');



 /*Current Affaire*/
 Route::get('current_affaire/{slug}', 'FrontendController@currentAffaire')
 ->name('current_affaire.category');

Route::resource('current-affairs','CurrentAffairController');
Route::get('current-affairs-detail/{slug}','CurrentAffairController@detail')->name('show.current_affairs.detail');
Route::get('project-work','ProjectWorkController@index')->name('project_work');
Route::get('project-work/list/{slug}','ProjectWorkController@show_pw_courses')->name('project_work.pw_course_list');
Route::get('project-work/detail/{slug}','ProjectWorkController@pw_course_details')->name('project_work.pw_course_detail');
Route::get('project-work-search', 'ProjectWorkController@projectWorkSearch')->name('projectwork.search');
Route::post('store-project-work', 'ProjectWorkController@fileStoreProjectWork')->name('projectwork.store');
    /*currencies.change*/
    Route::post('currencies/change', 'FrontendController@currenciesChange')
        ->name('frontend.currencies.change')->middleware('demo');

    /*language change*/
    Route::post('languages/change', 'FrontendController@languagesChange')
        ->name('frontend.languages.change')->middleware('demo');

    /*teacher profile*/
    Route::get('instructor/details/{slug}', 'FrontendController@instructorDetails')
        ->name('single.instructor');

    Route::get('all-instructors', 'FrontendController@allInstructors')
    ->name('all.instructors');

    Route::get('/courses', 'FrontendController@courseFilter')
        ->name('course.filter');

    /*Content preview*/
    Route::get('content/preview/{id}', 'FrontendController@contentPreview')
        ->name('content.video.preview');

    /*instructor register*/
    Route::get('instructor/register', 'FrontendController@registerView')
        ->name('instructor.register');

    /*instructor create*/
    Route::post('instructor/create', 'FrontendController@registerCreate')
        ->name('instructor.create')->middleware('demo');

    /*instructor payment*/
    Route::get('instructor/payment/{slug}', 'FrontendController@insPayment')
        ->name('instructor.payment');

    /*pages*/

    // Route::get('page/{slug}', 'FrontendController@page')->name('pages');
    


    /*instructor strip payment*/
    Route::post('instructor/stripe/payment', 'PaymentController@instructorStripe')
        ->name('instructor.stripe.payment')->middleware('demo')->middleware('demo');

    /*instructor strip payment*/
    Route::post('instructor/paypal/payment', 'PaymentController@instructorPaypal')
        ->name('instructor.paypal.payment')->middleware('demo');

    //login
    Route::get('student/login', 'FrontendController@login')
        ->name('student.login');

    //Sitemap
    Route::get('sitemap', 'FrontendController@sitemap')
        ->name('sitemap');

    //student_create
    Route::post('student/create', 'FrontendController@create')
        ->name('student.create')->middleware('demo');

    //signup
    Route::get('signup', 'FrontendController@signup')
        ->name('student.register');

        Route::get('book-free-class','FrontendController@bookfreeclass')->name('frontend.book-free-class.index');    
        Route::post('book-free-class/save','FrontendController@bookfreeclassStore')->name('frontend.book-free-class.store');
        Route::get('get-live-class','FrontendController@getLiveClass')->name('get-live-class');   
        Route::get('class-time-table/{id}','FrontendController@getClassTimeTable')->name('class-time-table');   
       
        
             
       
        Route::get('daily-class-schedule','FrontendController@classSchedule')->name('class-schedule');   
        Route::get('get-board','FrontendController@get_board')->name('get-board');   
        Route::get('get-board-classes/{id}','FrontendController@get_board_classes')->name('get-board-classes');   
        Route::get('get-competitive-courses','FrontendController@get_competitive_courses')->name('get-competitive-courses');    
        Route::get('get-board-classes-subjects','FrontendController@get_board_classes_subjects')->name('get-board-classes-subjects');   
        
        Route::get('store-board-class-schedule','FrontendController@store_board_class_schedule')->name('store-board-class-schedule');   
       
        Route::get('live-tuition','LiveTuitionController@classSchedule')->name('class-schedule');   
       
        Route::get('tuition-get-board','LiveTuitionController@get_board')->name('get-board');   
        Route::get('tuition-get-board-classes/{id}','LiveTuitionController@get_board_classes')->name('get-board-classes'); 

        Route::get('tuition-get-competitive-courses','LiveTuitionController@get_competitive_courses')->name('tuition-get-competitive-courses'); 

        Route::get('tuition-get-board-classes-subjects/{id}','LiveTuitionController@get_board_classes_subjects')->name('tuition-get-board-classes-subjects'); 

        Route::get('store-student-board-classes-subjects','LiveTuitionController@store_student_board_classes_subjects')->name('store-student-board-classes-subjects'); 
        
        Route::get('tuition-get-instructor-schedule/{id}/{ids}','LiveTuitionController@tuition_get_instructor_schedule')->name('tuition_get_instructor_schedule');
        Route::get('tuition-get-instructor-schedule-time/{id}/{ids}','LiveTuitionController@tuition_get_instructor_schedule_time')->name('tuition_get_instructor_schedule_time'); 

        Route::get('tution-store-board-class-schedule','LiveTuitionController@store_board_class_schedule')->name('store-board-class-schedule'); 
       
        //Route::get('job-notification','JobNotificationController@index')->name('homepage.job_notification');     
        //Route::get('job-notification-details/{id}/{tittle}','JobNotificationController@job_notification_details')->name('homepage.job_notification_details');     
        
        Route::get('job-notification', 'JobsController@listjobIndex')->name('homepage.job_notification');
        Route::get('job-notification-details/{id}','JobsController@job_notification_details')->name('homepage.job_notification_details'); 
        
        Route::get('get-all-jobs','JobNotificationController@getAllJobsfromXml'); 
        
        
          
    
        // this group for authorize user
    Route::group(['middleware' => 'auth'], function () {
        
        Route::match(['GET','POST'], 'test-series', 'UserManager\UserController@testSeriesLogin')->name('test-series');
        Route::get('live-class/{instructor_live_class_id}','LiveClassSubscriptionController@viewLiveClass')->name('live.class');
        //mock test end
        Route::get('mock-test', 'TestController@mockTest')->name('mock-test');
		Route::get('mock-test-detail/{id}/{packageId}', 'TestController@mockTestDetail')->name('mock-test-detail');
		Route::get('mock-test-start/{id}/{packageId}', 'TestController@mockTestStart')->name('mock-test-start');
		Route::get('report-detail/{id}/{reportId}', 'TestController@reportDetail')->name('report-detail');
        Route::get('mock-report-detail/{id}/{reportId}', 'TestController@mockReportDetail')->name('mock-report-detail');

        Route::get('pw-mock-test-detail/{courseId}/{id}', 'PwTestController@pwMockTestDetail')->name('pw-mock-test-detail');
        Route::get('pw-mock-test-start/{courseId}/{id}', 'PwTestController@pwMockTestStart')->name('pw-mock-test-start');
        Route::get('mock-analytical-report/{id}/{mockId}', 'PwTestController@pwMockAnalyticalReport')->name('pw-mock-analytical-report');
        Route::get('pw-mock-report-detail/{id}/{reportId}', 'PwTestController@pwMockReportDetail')->name('pw-mock-report-detail');
        Route::post('pw-get-final-report' ,'PwTestController@pwGetFinalReport')->name('pw-get-final-report');
        Route::get('pw-mock-test-report/{id}/{mockId}', 'PwTestController@pwMockTestPackageDetail')->name('pw-mock-test-package');
        Route::post('get_select_mocktest', 'TestController@getMockTest')->name('get_select_mocktest');

		Route::post('question-update', 'TestController@questionUpdate')->name('question-update');

        Route::get('subject-test-detail/{id}/{course_id?}', 'TestController@subjectTestDetail')->name('subject-test-detail');
        Route::get('subject-test-start/{id}/{course_id?}', 'TestController@subjectTestStart')->name('subject-test-start');
        
        Route::get('unit-test-detail/{id}/{unitId?}', 'TestController@unitTestDetail')->name('unit-test-detail');
        
        Route::get('unit-test-start/{id}/{unitId?}', 'TestController@unitTestStart')->name('unit-test-start');
        
        Route::post('question-subject-update' ,'TestController@questionSubjectUpdate')->name('question-subject-update');

        Route::get('packages/test/{id}', 'TestController@testPacakge')->name('test');

        Route::get('mock-test-package/{id}/{mockId}', 'TestController@mockTestPackageDetail')->name('mock-test-package');
       
        Route::get('subject-test-package/{id}', 'TestController@testPackageDetail')->name('subject-test-package');
        Route::get('unit-test-package/{id}', 'TestController@unitTestPackageDetail')->name('unit-test-package');
        Route::get('chapter-test-package/{id}', 'TestController@chapterTestPackageDetail')->name('chapter-test-package');
       
        Route::get('mock_analytical_report/{id}/{mockId}', 'TestController@mockAnalyticalReport')->name('mock_analytical_report');

        Route::post('get-final-report' ,'TestController@getFinalReport')->name('get-final-report');
        Route::post('update-error-report' ,'TestController@updateErrorReport')->name('update-error-report');
        
        Route::get('chapter-test-detail/{id}/{chapterId?}', 'TestController@chapterTestDetail')->name('chapter-test-detail');
        
        Route::get('chapter-test-start/{id}/{chapterId?}', 'TestController@chapterTestStart')->name('chapter-test-start');
        
        Route::get('section-value', 'TestController@sectionValue')->name('section-value');
        
        
        //Mock test end
        Route::get('/mark-as-all-read', 'FrontendController@mark_as_all_read')->name('mark_as_all_read');

        /*paypal payment*/
        Route::post('paypal/payment', 'PaymentController@paypalPayment')
            ->name('paypal.paymnet')->middleware('demo');

        // stripe
        Route::post('stripe', 'PaymentController@stripePost')
            ->name('stripe.post')->middleware('demo');

        /*if free amount is zero*/
        Route::get('free/payment', 'PaymentController@freePayment')
            ->name('free.payment');

        /*get content details*/
        Route::get('class/content/{id}', 'FrontendController@singleContent')
            ->name('class.content');
            
        /*get project work class content details*/   
        Route::get('project-wrok/class/content/{id}', 'ProjectWorkController@singleContent')
            ->name('project_work.class.content');

        /*create message*/
        Route::get('message/create/{id}', 'FrontendController@messageCreate')
            ->name('message.create');
        Route::post('message/send', 'FrontendController@sendMessage')
            ->name('message.sent')->middleware('demo');

        /*all enroll courses and wishlist*/
        Route::get('my/courses', 'FrontendController@my_courses')
            ->name('my.courses');
        /*all my tuition*/
        Route::get('my/tuition', 'FrontendController@my_tuition')
            ->name('my.tuition');

        Route::get('my/wishlist', 'FrontendController@my_wishlist')
            ->name('my.wishlist');

        // packages routes
        Route::get('my/packages', 'FrontendController@my_packages')
        ->name('my.packages');
        //
        Route::get('my/projectwork', 'ProjectWorkController@my_projectwork')
        ->name('my.projectwork');
        Route::get('project_work_lesson_details/{slug}', 'ProjectWorkController@project_work_lesson_details')
        ->name('project_work_lesson_details');

        Route::get('help-and-support','FrontendController@helpAndSupport')->name('help-and-support');
         // Packages Detailes
         //Route::get('packages/package_details/{enrollment_id}', 'FrontendController@package_detail')
         //->name('packages.package_details');

        /*all enroll course ajax*/
        Route::get('enroll/courses', 'FrontendController@enrollCourses')
            ->name('enroll.courses');
        /*cart list*/
        Route::get('cart/list', 'FrontendController@cartList')
            ->name('cart.list');
        /*add to cart*/

        Route::get('add/to/cart', 'FrontendController@addToCart')
            ->name('add.to.cart');


            
        /*remove the cart*/
        Route::get('remove/cart/{id}', 'FrontendController@removeCart')
            ->name('cart.remove');

         /*remove the Package cart*/
         Route::get('remove/packages/{id}', 'FrontendController@removePKGCart')
         ->name('packages.remove');

         Route::get('remove/packages', 'FrontendController@removePackageCart')
         ->name('packages.remove.aks');    

        /*wishlist*/
        Route::get('wish/list', 'FrontendController@wishList')
            ->name('wish.list');

        /*add to wishlist*/
        Route::get('add/to/wishlist', 'FrontendController@addToWishlist')
            ->name('add.to.wishlist');

        /*remove wishlist*/
        Route::get('remove/wishlist/{id}', 'FrontendController@removeWishlist')
            ->name('remove.wishlist');

        /*Shopping cart list with pages*/
        Route::get('shopping/cart', 'FrontendController@shoppingCart')
            ->name('shopping.cart');

        /*checkout*/
        Route::get('cart/checkout', 'FrontendController@checkout')
            ->name('checkout');
        /*payumoney payment*/
        Route::post('payumoney/payment', 'FrontendController@payuPayment')
            ->name('payumoney.payment');
            Route::post('initiate/payment', 'PayUMoneyController@index')
                    ->name('initiate.payment');

            Route::post('initiate/direct-payment', 'PayUMoneyController@directCheckout')
                    ->name('initiate.direct-payment');

                
        Route::get('response/payu', 'PayUMoneyController@response')
            ->name('payu.response');

        // ============================== student route ===========================


        //dashboard
        Route::get('student/dashboard', 'FrontendController@dashboard')
            ->name('student.dashboard');

        //my_profile
        Route::get('student/profile', 'FrontendController@my_profile')
            ->name('student.profile');
        //student_edit
        Route::get('student/profile/edit', 'FrontendController@student_edit')
            ->name('student.edit');

        //student_update
        Route::post('student/profile/update/{std_id}', 'FrontendController@update')
            ->name('student.update')->middleware('demo');
	
	    Route::post('student/password/update', 'FrontendController@student_password_update')
            ->name('student.password.update');

        //enrolled_course
        Route::get('student/enrolled/course', 'FrontendController@enrolled_course')
            ->name('student.enrolled.course');

        //message
        Route::get('student/message', 'FrontendController@inboxMessage')
            ->name('student.message');

        //purchase_history
        Route::get('student/purchase/history', 'FrontendController@purchase_history')
            ->name('student.purchase.history');

        //lesson_details
        Route::get('lesson/{slug}', 'FrontendController@lesson_details')
            ->name('lesson_details');
		//	package_details
            Route::get('package/{slug}/{id}', 'FrontendController@package_details')
            ->name('package_details');

		 //lesson_complete
        Route::post('lesson-complete', 'FrontendController@lesson_complete')
            ->name('lesson_complete');

         //quiz_start
         Route::post('lesson-quiz-start', 'FrontendController@quiz_start')
         ->name('quiz_start');
       
       //Mind Map view_mind_map
        
        Route::get('lesson/view_mind_map/{id}/{otherMindMap?}', 'FrontendController@view_mind_map')
       ->name('lesson.view_mind_map');  



     //quiz_update
     Route::post('lesson-quiz-update', 'FrontendController@quiz_update')
         ->name('quiz_update');
            
        //quiz_start
        Route::post('lesson-quiz-start', 'FrontendController@quiz_start')
            ->name('quiz_start');
            
        //quiz_update
        Route::post('lesson-quiz-update', 'FrontendController@quiz_update')
            ->name('quiz_update');
			
        //commenting
        Route::post('comment', 'FrontendController@comments')
            ->name('comments')->middleware('demo');
			

        /*seen content delete*/
        Route::get('seen/content/remove/{id}','FrontendController@seenRemove')->name('seen.remove');

        /*all seen content list*/
        Route::get('seen/list/{id}','FrontendController@seenList')->name('seen.list');
        /*affiliate area*/
        if (affiliateStatus()){
            Route::get('student/affiliate/area','FrontendController@affiliateCreate')->name('affiliate.area');
            Route::get('student/affiliate/request','FrontendController@affiliateRequest')->name('student.affiliate.request');
            Route::post('student/affiliate/update','FrontendController@affiliateStore')->name('student.account.update');
            Route::get('student/payment/request','FrontendController@affiliatePaymentRequest')->name('student.payment.request');
            Route::post('student/payment/store','FrontendController@affiliatePaymentStore')->name('student.payments.store');
        }

    });
    Route::get('industrial-courses','FrontendController@getIIDCoursesData')->name('iid.courses.list');

    /*Enroll Demo course*/
    Route::get('enroll-demo-course/{demo_course_id}', 'FrontendController@enrollDemoCourse')
        ->name('enroll.demoCourse');
    /*live classes subscription*/
    Route::post('liveclass-sendOtp', 'LiveClassSubscriptionController@sendOtp')
        ->name('liveClass.sendOtp');
    Route::post('liveclass-verify-otp', 'LiveClassSubscriptionController@verifyOtp')
        ->name('liveClass.verifyOtp');
    //Route::get('live-class-subscription/{instructor_live_class_id?}', 'LiveClassSubscriptionController@createSubscription')
        //->name('liveclasssubscription.index');
     Route::get('free-live-class/{instructor_live_class_id?}', 'LiveClassSubscriptionController@createSubscription')
        ->name('liveclasssubscription.index');    
    Route::get('live-class-thankyou/{message?}', 'LiveClassSubscriptionController@thankyou')
    ->name('liveclass.thankyou');
    Route::post('live-class-subscription/store', 'LiveClassSubscriptionController@storeSubscription')
        ->name('liveclasssubscription.store');
    Route::get('live-competitive-classes/{instructor_live_class_id?}', 'LiveClassSubscriptionController@liveCompetitiveClass')
        ->name('liveCompetitiveClass.index');
        
    /*B2B business*/
    Route::get('b2b', 'B2BController@index')->name('B2B.index');
    Route::post('store-Live-Competitive-Subscription', 'LiveClassSubscriptionController@storeLiveCompetitiveSubscription')
        ->name('store-Live-Competitive-Subscription');
    Route::get('subscribe-thanks/{message?}', 'LiveClassSubscriptionController@subscribe_thanks')
    ->name('subscribe-thanks');

    /* Agent Student Regististraton Code Start here*/
    
    Route::get('user-register', 'FrontendController@userRegister')->name('user.register');
    Route::post('user-register', 'FrontendController@checkAgent')->name('add.user.register');
    Route::post('user-register/addboard', 'FrontendController@registerUserboard')->name('create.agent.userboard');    
    Route::post('user-register/addcomptitive', 'FrontendController@registerUsercomptitive')->name('create.agent.usercomptitive');
    Route::get('user-register/check-mobile', 'FrontendController@checkMobile')->name('user.register.checkmobile');    
    Route::get('user-register/deleteSession', 'FrontendController@deleteAgentSession')->name('user.deleteAgentSession');
    Route::post('user-register/addData', 'FrontendController@RegisterWithExcel')->name('add.user.register.excel');

    // Become Tutor 
    Route::get('/become-tutor', 'EnquiryController@connecteachers')->name('connect_teacher');          
    Route::post('become-tutor/send', 'EnquiryController@connecteachers_validate_us')->name('connect_teacher_uspost');
});
Route::get('getCoursesForPermision', 'SchoolController@getCoursesForPermision')->name('getCoursesForPermision');

Route::get('/{slug}', 'FrontendController@page')->name('pages');

