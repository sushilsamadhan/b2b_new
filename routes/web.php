<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'install.check', 'prefix' => 'install'], function () {
    Route::get('/', 'InstallerController@welcome')->name('install');
    Route::get('server/permission', 'InstallerController@permission')->name('permission');
    Route::get('database/create', 'InstallerController@create')->name('create');
    Route::get('database/check', 'InstallerController@checkDbConnection')->name('check.db');
    Route::post('setup/database', 'InstallerController@dbStore')->name('db.setup');
    Route::get('setup/import/sql', 'InstallerController@importSql')->name('sql.setup');
    Route::get('setup/instructor/create', 'InstallerController@importDemoSql')->name('sql.demo.setup'); // upload demo data
    Route::post('setup/instructor/setup', 'InstallerController@instructorStore')->name('setup.instructor'); // insert the instructor
    Route::get('setup/org/create', 'InstallerController@orgCreate')->name('org.create');
    Route::post('setup/org/store', 'InstallerController@orgSetup')->name('org.setup');
    Route::get('setup/admin', 'InstallerController@adminCreate')->name('admin.create');
    Route::post('setup/admin/store', 'InstallerController@adminStore')->name('admin.store');
});


Route::group(['middleware' => 'installed'], function () {
    //all user login
    Auth::routes(['register' => false]);
    //app routes
    Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('/callback/{provider}', 'SocialController@callback');

    Route::get('user/verify/{token}', 'Auth\RegisterController@verifyUser')->name('user.verify');
    Route::post('send/verify/code', 'Auth\RegisterController@sendToken')->name('send.verify.token');
    Route::get('verify/user', 'Auth\RegisterController@verifyForm');
});

Route::group(['middleware' => ['b2bconfig','installed', 'checkBackend', 'auth', 'activity'], 'prefix' => 'dashboard'], function () {

    Route::get('/mark-as-read/{id}', 'Module\UserNotificationController@mark_as_read')->name('mark_as_read');
    Route::get('/mark-as-all-read', 'Module\UserNotificationController@mark_as_all_read')->name('mark_all_read');
    Route::get('/notifications/{user}', 'Module\UserNotificationController@see_all_notifications')->name('see_all_notifications');
    Route::get('post-sortable', 'Course\ContentController@update')->name('content.short');

    Route::get('/home', 'Dashboard\DashboardController@index')->name('dashboard');
    Route::get('/get-statistics-by-date', 'Dashboard\DashboardController@getStatisticsByDate')->name('statistics.data');
    
    Route::get('school/B2B-category-permissions/{id?}', 'SchoolController@B2BCategoryPermissions')->name('school.B2B.category.permissions');
    Route::post('school/B2B-category-permissions/{id?}', 'SchoolController@B2BCategoryPermissionsAdd')->name('school.B2B.category.permissions');
    
    Route::get('school/B2B-course-permissions/{id?}', 'SchoolController@B2BCoursePermissions')->name('school.B2B.course.permissions');
    Route::post('school/B2B-course-permissions/{id?}', 'SchoolController@B2BCoursePermissionsAdd')->name('school.B2B.course.permissions.store');
    
    Route::post('b2bcategoriesByCourseType', 'Course\CourseController@b2bcategoriesByCourseType')->name('b2bcategoriesByCourseType');
    
    Route::get('getForPermission','SchoolController@getForPermission');
    
    //Free Study Material
    Route::get('free-study-material/create', 'FreeStudyMaterialController@create')->name('free-study-material.create');
    Route::post('free-study-material/store', 'FreeStudyMaterialController@store')->name('free-study-material.store');
    Route::get('free-study-material/index', 'FreeStudyMaterialController@index')->name('free-study-material.index');
    Route::get('free-study-material/edit/{id}', 'FreeStudyMaterialController@edit')->name('free-study-material.edit');
    Route::post('free-study-material/update', 'FreeStudyMaterialController@update')->name('free-study-material.update')->middleware('demo');
    Route::get('free-study-material/destroy/{id}', 'FreeStudyMaterialController@destroy')->name('free-study-material.destroy');


    //this route for published or unpublished
    Route::get('free-study-material/published', 'FreeStudyMaterialController@published')->name('free-study-material.published');
    Route::get('free-study-material/popular', 'FreeStudyMaterialController@popular')->name('free-study-material.popular');
    Route::get('free-study-material/top', 'FreeStudyMaterialController@top')->name('free-study-material.top');
    Route::get('free-study-material/compitative', 'FreeStudyMaterialController@compitative')->name('free-study-material.compitative');

    //Board
    Route::get('board/create', 'BoardController@create')->name('boards.create');
    Route::post('board/store', 'BoardController@store')->name('boards.store');
    Route::get('board/edit/{id}', 'BoardController@edit')->name('boards.edit');
    Route::post('board/update', 'BoardController@update')->name('boards.update');
    Route::get('board/destroy/{id}', 'BoardController@destroy')->name('boards.destroy');
    Route::get('board/index', 'BoardController@index')->name('boards.index');

    //Published or unpublished

    Route::get('board/published', 'boardcontroller@published')->name('boards.published');
    
    //Current Affairs

    Route::get('current-affairs', 'CurrentAffairsController@index')->name('current_affairs.list');
    Route::get('current-affairs/add', 'CurrentAffairsController@create')->name('current_affairs.add');
    Route::post('current-affairs/store', 'CurrentAffairsController@store')->name('current_affairs.store');
    Route::match(array('GET','POST'),'current-affairs-edit/{course_id}/{slug}', 'CurrentAffairsController@edit')->name('currentaffairs.edit');
    Route::get('current-affairs-destroy/{course_id}/{slug}', 'CurrentAffairsController@destroy')->name('currentaffairs.destroy');

    //course
    Route::get('course/create', 'Course\CourseController@create')->name('course.create');
    Route::post('course/store', 'Course\CourseController@store')->name('course.store')->middleware('demo');
    Route::get('course/index', 'Course\CourseController@index')->name('course.index');
    Route::get('course/index/{course_id}/{slug}', 'Course\CourseController@show')->name('course.show');
    Route::get('course/edit/{course_id}/{slug}', 'Course\CourseController@edit')->name('course.edit');
    Route::post('course/update', 'Course\CourseController@update')->name('course.update')->middleware('demo');
    Route::get('course/trash/{course_id}/{slug}', 'Course\CourseController@destroy')->name('course.destroy');
    Route::get('course/published', 'Course\CourseController@published')->name('course.publish');
    Route::get('course/rating', 'Course\CourseController@rating')->name('course.rating');
    Route::post('categoriesByCourseType', 'Course\CourseController@categoriesByCourseType')->name('categoriesByCourseType');
    Route::post('categoriesById', 'Course\CourseController@categoriesById')->name('categoriesById');
    Route::post('coursesByCategoryId', 'Course\CourseController@coursesByCategoryId')->name('coursesByCategoryId');
    Route::get('course_lesson/{slug}', 'Course\CourseController@lesson_details')->name('course.lesson_details');
    Route::get('course/{course_id}', 'Course\CourseController@createDemoCourse')->name('course.demo_course');

    // class
    Route::get('class/create/{id}', 'Course\ClassController@create')->name('classes.create');
    Route::post('class/store', 'Course\ClassController@store')->name('classes.store')->middleware('demo');
    Route::get('class/edit/{id}', 'Course\ClassController@edit')->name('classes.edit');
    Route::post('class/update', 'Course\ClassController@update')->name('classes.update')->middleware('demo');
    Route::get('class/trash/{id}', 'Course\ClassController@destroy')->name('classes.destroy');
    //class content
    Route::get('class/content/create/{id}', 'Course\ContentController@create')->name('classes.contents.create');
    Route::post('class/content/store', 'Course\ContentController@store')->name('classes.contents.store')->middleware('demo');
    Route::get('class/content/trash/{id}', 'Course\ContentController@destroy')->name('classes.contents.destroy');
    Route::get('class/content/show/{id}', 'Course\ContentController@show')->name('classes.contents.show');
    Route::get('class/content/source/code/{id}', 'Course\ContentController@code')->name('classes.contents.code');
    Route::post('course/slug/check', 'Course\CourseController@check')->name('slug.check')->middleware('demo');
    Route::get('content/published', 'Course\ContentController@published')->name('class.content.published');
    Route::get('content/preview', 'Course\ContentController@preview')->name('class.content.preview');

    Route::get('class/content/updateTitle', 'Course\ContentController@updateTitle')->name('classes.contents.updateTitle');

    Route::get('class/content/edit/{id}/{course_id}', 'Course\ContentController@edit')->name('classes.contents.edit');
    Route::post('class/content/contentUpdate', 'Course\ContentController@contentUpdate')->name('classes.contents.contentUpdate');
   
    //mind Map 
    Route::get('mindmaps/create/{id}', 'Course\MindMapController@create')->name('mindmaps.create');
    Route::post('mindmaps/store', 'Course\MindMapController@store')->name('mindmaps.store');
    Route::get('mindmaps/edit/{id}', 'Course\MindMapController@edit')->name('mindmaps.edit');
    Route::post('mindmaps/update', 'Course\MindMapController@update')->name('mindmaps.update');
    Route::get('mindmaps/getContentList/{id}', 'Course\MindMapController@getContentList')->name('mindmaps.getContentList');


    //Instructor Earning
    Route::get('instructor/earning', 'Module\EarningController@instructorEarning')->name('instructor.earning');

    //all payment
    Route::get('payment/request', 'Module\PaymentController@paymentRequest')->name('payments.request');

    //instructor
Route::get('one-to-one-instructor/index', 'OnetooneInstructorController@index')->name('instructors.onetoone_instructors');
    Route::get('/tutition-assessment/{id}', 'OnetooneInstructorController@tutitionAssessment')->name('tutition-assessment');
    Route::post('/save-tutition-assessment', 'OnetooneInstructorController@saveTutitionAssessment')->name('save-tutition-assessment');
    Route::get('/check-tutition-available', 'OnetooneInstructorController@checkTutitioAavailable')->name('check-tutition-available');

    Route::get('one-to-one-instructor/view-booking', 'OnetooneInstructorController@view_booking')->name('instructors.view_booking');
    Route::get('one-to-one-instructor/get-view-booking/{id}', 'OnetooneInstructorController@get_view_booking')->name('instructors.get-view-booking');




    Route::get('/tutition-schedule/{id}', 'OnetooneInstructorController@TutitionSchedule')->name('tutition-schedule');

    Route::post('/save-schedule-time', 'OnetooneInstructorController@saveScheduletime')->name('save-schedule-time');

    Route::post('/save-tutition-schedule', 'OnetooneInstructorController@savetuTitionSchedule')->name('save-tutition-schedule');

    Route::get('/delete-tutition-schedule', 'OnetooneInstructorController@deleteTutitionSchedule')->name('delete-tutition-schedule');

Route::get('/my/live-tuition', 'OnetooneInstructorController@live_tuition_instructor')->name('live-tuition-instructor');
Route::get('/my/live-tuition-data', 'OnetooneInstructorController@view_one_instructor_all_data_tuition')->name('live-tuition-data');
Route::get('show-tuition-booking-student', 'OnetooneInstructorController@show_tuition_booking_student')->name('show-tuition-booking-student');


    Route::get('instructor/index', 'Instructor\InstructorController@index')->name('instructors.index');
    Route::get('instructor/show/{id}', 'Instructor\InstructorController@show')->name('instructors.show');
    Route::get('instructor/status', 'Instructor\InstructorController@statusUpdate')->name('instructors.status.update');
    Route::get('/profile/{id}', 'Instructor\InstructorController@edit')->name('instructors.edit');
    Route::get('instructor/instructor-access', 'Instructor\InstructorController@instructorAccess')->name('instructor.access');
    Route::post('instructor/instructor-course-update', 'Instructor\InstructorController@instructorAccessUpdate')->name('instructor.course.update');
    Route::post('/profile/update', 'Instructor\InstructorController@update')->name('instructors.update')->middleware('demo');
    Route::post('/users/banned', 'Instructor\InstructorController@banned')->name('users.banned')->middleware('demo');
    Route::get('/instructor-assessment/{id}', 'Instructor\InstructorController@instructorAssessment')->name('instructor-assessment');
    Route::post('/save-instructor-assessment', 'Instructor\InstructorController@saveInstructorAssessment')->name('save-instructor-assessment');
    Route::get('/instructor-schedule/{id}', 'Instructor\InstructorController@InstructorSchedule')->name('instructor-schedule');
    Route::post('/save-instructor-schedule', 'Instructor\InstructorController@saveInstructorSchedule')->name('save-instructor-schedule');
    Route::get('/delete-instructor-schedule/{id}', 'Instructor\InstructorController@deleteInstructorSchedule')->name('delete-instructor-schedule');
    Route::get('/delete-instructor-subject/{id}', 'Instructor\InstructorController@deleteInstructorSubject')->name('delete-instructor-subject');
    Route::get('/live-class', 'Instructor\InstructorController@liveClass')->name('live-class');
    


    Route::get('/live-class-join-students', 'Instructor\InstructorController@liveClassjoinStudent')->name('live-class-join-students');
    



    Route::get('/add-live-class', 'Instructor\InstructorController@addLiveClass')->name('add-live-class');
    Route::post('/save-live-class', 'Instructor\InstructorController@saveLiveClass')->name('save-live-class');
    Route::post('instructByCourseType', 'Instructor\InstructorController@instructByCourseType')->name('instructByCourseType');
    Route::get('/edit-live-class/{id}', 'Instructor\InstructorController@editLiveClass')->name('edit-live-class');
    Route::get('/delete-live-class/{id}', 'Instructor\InstructorController@deleteLiveClass')->name('delete-live-class');
    Route::post('/update-live-class', 'Instructor\InstructorController@updateLiveClass')->name('update-live-class');
   
    //messages with student
    Route::get('message/inbox', 'Module\MessageController@index')->name('messages.index');
    Route::get('message/show/{id}', 'Module\MessageController@show')->name('messages.show');
    Route::post('message/send', 'Module\MessageController@send')->name('messages.replay')->middleware('demo');
    Route::get('comments/index', 'Module\MessageController@allCommenting')->name('comments.index');
    Route::get('comments/show/{id}', 'Module\MessageController@commentShow')->name('comments.show');
    Route::get('comments/delete/{id}', 'Module\MessageController@commentDestroy')->name('comments.delete');
    Route::post('comments/replay', 'Module\MessageController@commentReplay')->name('comments.replay')->middleware('demo');

    //account setup
    Route::get('account/setup', 'Module\PaymentController@accountSetup')->name('account.create');
    Route::post('account/update', 'Module\PaymentController@accountUpdate')->name('account.update')->middleware('demo');
    Route::get('account/details/{id}/{userId}/{method}/{payId}', 'Module\PaymentController@accountDetails')
        ->name('account.details');


    //Todo:there are the user Manager section
    Route::get('user/destroy/{id}', 'UserManager\UserController@destroy')->name('users.destroy');
    Route::get('user/create', 'UserManager\UserController@create')->name('users.create');
    Route::post('user/store', 'UserManager\UserController@store')->name('users.store')->middleware('demo');
    Route::get('user/edit/{id}', 'UserManager\UserController@edit')->name('users.edit');
    Route::post('user/update', 'UserManager\UserController@update')->name('users.update')->middleware('demo');
    Route::get('user/show/{id}', 'UserManager\UserController@show')->name('users.show');
    Route::get('user/index', 'UserManager\UserController@index')->name('users.index');


    Route::resource('/admin-notification', 'NotificationController');
    Route::get('notification-destroy/{id}','NotificationController@destroy')->name('notification-destroy');
    /**
     * MEDIA MANAGER
     */

    Route::get('media/manager', 'MediaManagerController@index')->name('media.index');
    Route::post('media/index', 'MediaManagerController@main')->name('media.main')->middleware('demo');
    Route::get('media/manager/create', 'MediaManagerController@create')->name('media.create');
    Route::post('media/manager/store', 'MediaManagerController@store')->name('media.store')->middleware('demo');
    Route::get('media/manager/show', 'MediaManagerController@show')->name('media.show');
    Route::get('media/manager/edit/{id}', 'MediaManagerController@edit')->name('media.edit');
    Route::post('media/manager/update/{id}', 'MediaManagerController@update')->name('media.update')->middleware('demo');
    Route::post('media/manager/slide', 'MediaManagerController@slide')->name('media.slide')->middleware('demo');
    Route::post('media/manager/filter/{type}', 'MediaManagerController@filter')->name('media.filter')->middleware('demo');
    Route::get('media/manager/trash/{item}', 'MediaManagerController@destroy')->name('media.delete');


    Route::get('email', 'Dashboard\DashboardController@template');

    //SMTP Setting
    Route::get('smtp/create', 'Setting\SettingController@smtpCreate')->name('smtp.create');
    Route::post('smtp/store', 'Setting\SettingController@smtpStore')->name('smtp.store')->middleware('demo');

    //site setting
    Route::get('site/setting', 'Setting\SettingController@siteSetting')->name('site.setting');
    Route::post('site/setting/update', 'Setting\SettingController@siteSettingUpdate')->name('site.update')->middleware('demo');

    //app site setting
    Route::get('app/setting', 'Setting\SettingController@appSetting')->name('app.setting');
    Route::post('app/setting/update', 'Setting\SettingController@appSettingUpdate')->name('app.update')->middleware('demo');

    /*other settings here*/
    Route::get('other/settings','Setting\SettingController@otherSetting')->name('other.setting');
    Route::post('other/setting','Setting\SettingController@otherSettingUpdate')->name('other.update');

    //Language Setting
    Route::get('language/index', 'Setting\LanguageController@index')
        ->name('language.index');
    Route::post('language/store', 'Setting\LanguageController@store')
        ->name('language.store')->middleware('demo');
    Route::get('language/destroy/{id}', 'Setting\LanguageController@destroy')
        ->name('language.destroy');
    Route::get('language/translate/{id}', 'Setting\LanguageController@translate_create')
        ->name('language.translate');
    Route::post('language/translate/store', 'Setting\LanguageController@translate_store')
        ->name('language.translate.store')->middleware('demo');
    Route::post('language/change', 'Setting\LanguageController@changeLanguage')
        ->name('language.change')->middleware('demo');
    Route::get('language/default/{id}', 'Setting\LanguageController@defaultLanguage')
        ->name('language.default');

    //Currency Setting
    Route::get('currency/index', 'Setting\CurrencyController@index')->name('currencies.index');
    Route::get('currency/create', 'Setting\CurrencyController@create')->name('currencies.create');
    Route::post('currency/store', 'Setting\CurrencyController@store')->name('currencies.store')->middleware('demo');
    Route::get('currency/delete/{id}', 'Setting\CurrencyController@destroy')->name('currencies.destroy');
    Route::get('currency/edit/{id}', 'Setting\CurrencyController@edit')->name('currencies.edit');
    Route::post('currency/update', 'Setting\CurrencyController@update')->name('currencies.update')->middleware('demo');
    Route::post('currency/default', 'Setting\CurrencyController@default')->name('currencies.default')->middleware('demo');
    Route::get('currency/published', 'Setting\CurrencyController@published')->name('currencies.published');
    Route::get('currency/align', 'Setting\CurrencyController@alignment')->name('currencies.align');
    Route::post('currency/change', 'Setting\CurrencyController@change')->name('currencies.change')->middleware('demo');

    //support
    Route::get('ticket/index', 'Module\SupportTicketController@index')->name('tickets.index');
    Route::get('ticket/create', 'Module\SupportTicketController@create')->name('tickets.create');
    Route::post('ticket/store', 'Module\SupportTicketController@store')->name('tickets.store')->middleware('demo');
    Route::get('ticket/show/{id}', 'Module\SupportTicketController@show')->name('tickets.show');
    Route::post('ticket/replay', 'Module\SupportTicketController@replay')->name('tickets.replay')->middleware('demo');

    //payment
    Route::get('payments/index', 'Module\PaymentController@index')->name('payments.index');
    Route::get('payments/create', 'Module\PaymentController@create')->name('payments.create');
    Route::post('payments/store', 'Module\PaymentController@store')->name('payments.store')->middleware('demo');
    Route::get('payments/destroy/{id}', 'Module\PaymentController@destroy')->name('payments.destroy');
    Route::get('payments/status/{id}', 'Module\PaymentController@status')->name('payments.status');

    //Category
    Route::get('category/create', 'Module\CategoryController@create')->name('categories.create');
    Route::post('category/store', 'Module\CategoryController@store')->name('categories.store')->middleware('demo');
    Route::get('category/edit/{id}', 'Module\CategoryController@edit')->name('categories.edit');
    Route::post('category/update', 'Module\CategoryController@update')->name('categories.update')->middleware('demo');
    Route::get('category/destroy/{id}', 'Module\CategoryController@destroy')->name('categories.destroy');
    Route::get('category/index', 'Module\CategoryController@index')->name('categories.index');
    Route::get('category/index/{id?}', 'Module\CategoryController@classes')->name('categories.class');

    //this route for published or unpublished
    Route::get('category/published', 'Module\CategoryController@published')->name('categories.published');
    Route::get('category/popular', 'Module\CategoryController@popular')->name('categories.popular');
    Route::get('category/top', 'Module\CategoryController@top')->name('categories.top');
    Route::get('category/compitative', 'Module\CategoryController@compitative')->name('categories.compitative');
    Route::get('category/isfreestudy', 'Module\CategoryController@isFreeStudy')->name('categories.isfreestudy'); 
    Route::get('category/isCurrentAffairs', 'Module\CategoryController@isCurrentAffairs')->name('categories.isCurrentAffairs');
    Route::get('category/isProjectWorks', 'Module\CategoryController@isProjectWorks')->name('categories.isProjectWorks');
    
    //package
    Route::get('packages/index', 'Module\PackageController@index')->name('packages.index');
    Route::get('packages/create', 'Module\PackageController@create')->name('packages.create');
    Route::get('packages/edit/{id}', 'Module\PackageController@edit')->name('packages.edit');
    Route::get('packages/destroy/{id}', 'Module\PackageController@destroy')->name('packages.destroy');
    Route::post('packages/store', 'Module\PackageController@store')->name('packages.store')->middleware('demo');
    Route::post('packages/update', 'Module\PackageController@update')->name('packages.update')->middleware('demo');

    //slider
    Route::get('slider/index', 'Module\SliderController@index')->name('sliders.index');
    Route::get('slider/create', 'Module\SliderController@create')->name('sliders.create');
    Route::post('slider/store', 'Module\SliderController@store')->name('sliders.store')->middleware('demo');
    Route::get('slider/destroy/{id}', 'Module\SliderController@destroy')->name('sliders.destroy');
    Route::get('slider/edit/{id}', 'Module\SliderController@edit')->name('sliders.edit');
    Route::post('slider/update', 'Module\SliderController@update')->name('sliders.update')->middleware('demo');
    Route::get('slider/published', 'Module\SliderController@published')->name('sliders.published');

    //Earning
    Route::get('admin/earning', 'Module\EarningController@adminEarning')->name('admin.earning.index');

    //student
    Route::get('student/index', 'Module\StudentController@index')->name('students.index');
    Route::get('student/show/{id}', 'Module\StudentController@show')->name('students.show');
    Route::get('student/enrolled-list', 'Module\StudentController@enrolled_list')->name('students.enrolled-list');

    //all pages
    Route::get('pages/index', 'Module\PageController@index')->name('pages.index');
    Route::get('pages/create', 'Module\PageController@create')->name('pages.create');
    Route::get('pages/delete/{id}', 'Module\PageController@destroy')->name('pages.destroy');
    Route::post('pages/store', 'Module\PageController@store')->name('pages.store')->middleware('demo');
    Route::get('pages/edit/{id}', 'Module\PageController@edit')->name('pages.edit');
    Route::post('pages/update', 'Module\PageController@update')->name('pages.update')->middleware('demo');
    Route::get('pages/active', 'Module\PageController@pageActive')->name('pages.active');
    Route::get('pages/content/index/{id}', 'Module\PageController@contentIndex')->name('pages.content.index');
    Route::get('pages/content/create/{id}', 'Module\PageController@contentCreate')->name('pages.content.create');
    Route::post('pages/content/store', 'Module\PageController@contentStore')->name('pages.content.store')->middleware('demo');
    Route::get('pages/content/active', 'Module\PageController@contentActive')->name('pages.content.active');
    Route::get('pages/content/edit/{id}', 'Module\PageController@contentEdit')->name('pages.content.edit');
    Route::post('pages/content/update', 'Module\PageController@contentUpdate')->name('pages.content.update')->middleware('demo');
    Route::get('pages/content/delete/{id}', 'Module\PageController@contentDestroy')->name('pages.content.destroy');

    /*theme settings*/
    Route::get('theme/setting', 'Module\ThemesController@create')->name('themes.setting');
    Route::post('theme/store', 'Module\ThemesController@store')->name('themes.store')->middleware('demo');


    //Project Work Class
    Route::resource('projectworkclasses', 'ProjectWorkClassController');
    Route::get('projectworkclasses/','ProjectWorkClassController@index')->name('projectworkclasses.index');
    Route::get('projectworkclasses/create','ProjectWorkClassController@create')->name('projectworkclasses.create');
    Route::post('projectworkclasses/store', 'ProjectWorkClassController@store')->name('projectworkclasses.store');
    Route::get('projectworkclasses/{id}/edit','ProjectWorkClassController@edit')->name('projectworkclasses.edit');
    Route::post('projectworkclasses/update', 'ProjectWorkClassController@update')->name('projectworkclasses.update');
    Route::get('projectworkclasses/destroy/{id}','ProjectWorkClassController@destroy')->name('projectworkclasses.destroy');

    //Project Work Category
    Route::resource('projectworkcat', 'ProjectWorkCategoryController');
    Route::get('projectworkcat/','ProjectWorkCategoryController@index')->name('projectworkcat.index');
    Route::get('projectworkcat/create','ProjectWorkCategoryController@create')->name('projectworkcat.create');
    Route::post('projectworkcat/store', 'ProjectWorkCategoryController@store')->name('projectworkcat.store');
    Route::get('projectworkcat/{id}/edit','ProjectWorkCategoryController@edit')->name('projectworkcat.edit');
    Route::post('projectworkcat/update', 'ProjectWorkCategoryController@update')->name('projectworkcat.update');
    Route::get('projectworkcat/destroy/{id}','ProjectWorkCategoryController@destroy')->name('projectworkcat.destroy');
    Route::get('projectworkcat/getProjectCat/{id}','ProjectWorkCategoryController@getProjectCat')->name('projectworkcat.getProjectCat');

    //project work enrollment
    Route::get('projectworkenroll/','ProjectWorkEnrollmentController@index')->name('projectworkenroll.index');
    Route::get('projectworkenroll/destroy/{id}','ProjectWorkEnrollmentController@destroy')->name('projectworkenroll.destroy');
    Route::get('projectworkenroll-details/{slug}/{id}', 'ProjectWorkEnrollmentController@showprojectworkenroll');
    // Project Work Course
    Route::get('pwcourse/create', 'PwCourse\PwCourseController@create')->name('pwcourse.create');
    Route::post('pwcourse/store', 'PwCourse\PwCourseController@store')->name('pwcourse.store')->middleware('demo');
    Route::get('pwcourse/index', 'PwCourse\PwCourseController@index')->name('pwcourse.index');
    Route::get('pwcourse/index/{course_id}/{slug}', 'PwCourse\PwCourseController@show')->name('pwcourse.show');
    Route::get('pwcourse/edit/{course_id}/{slug}', 'PwCourse\PwCourseController@edit')->name('pwcourse.edit');
    Route::post('pwcourse/update', 'PwCourse\PwCourseController@update')->name('pwcourse.update')->middleware('demo');
    Route::get('pwcourse/published', 'PwCourse\PwCourseController@published')->name('pwcourse.publish');
    Route::post('pwcategoriesById', 'PwCourse\PwCourseController@pwcategoriesById')->name('pwcategoriesById');
    Route::get('pwcourse/trash/{pw_id}', 'PwCourse\PwCourseController@destroyAssociation')->name('pwcourse.destroyAssociation');
    Route::get('pwcourse/assesment/{slug}', 'PwCourse\PwCourseController@pwCreateAssesment')->name('pwcourse.create.assesment');

    // Project Work Class on index
    Route::get('pwclass/create/{id}', 'PwCourse\PwClassController@create')->name('pwcourse.classes.create');
    Route::post('pwclass/store', 'PwCourse\PwClassController@store')->name('pwcourse.classes.store')->middleware('demo');
    Route::get('pwclass/edit/{id}', 'PwCourse\PwClassController@edit')->name('pwcourse.classes.edit');
    Route::post('pwclass/update', 'PwCourse\PwClassController@update')->name('pwcourse.classes.update')->middleware('demo');
    Route::get('pwclass/trash/{id}', 'PwCourse\PwClassController@destroy')->name('pwcourse.classes.destroy');

    // Project Work Class Content on index
    Route::get('pwcontent/create/{id}', 'PwCourse\PwContentController@create')->name('pwcourse.contents.create');
    Route::post('pwcontent/content/store', 'PwCourse\PwContentController@store')->name('pwcourse.contents.store')->middleware('demo');
    Route::get('pwcontent/content/trash/{id}', 'PwCourse\PwContentController@destroy')->name('pwclasses.contents.destroy');
    Route::get('pwclass/content/show/{id}', 'PwCourse\PwContentController@show')->name('pwclasses.contents.show');
    Route::get('pwclass/content/source/code/{id}', 'PwCourse\PwContentController@code')->name('pwclasses.contents.code');
    Route::post('pwcourse/slug/check', 'PwCourse\PwContentController@check')->name('slug.check')->middleware('demo');
    Route::get('pwcontent/published', 'PwCourse\PwContentController@published')->name('pwclass.content.published');
    Route::get('pwcontent/preview', 'PwCourse\PwContentController@preview')->name('pwclass.content.preview');
    Route::get('pwclass/content/updateTitle', 'PwCourse\PwContentController@updateTitle')->name('pwclasses.contents.updateTitle');
    Route::get('pwcontent/content/edit/{id}/{course_id}', 'PwCourse\PwContentController@edit')->name('pwclasses.contents.edit');
    Route::post('pwcontent/content/contentUpdate', 'PwCourse\PwContentController@contentUpdate')->name('pwclasses.contents.contentUpdate');

    // Manage Webinar
    Route::get('webinar/index', 'Webinar\WebinarController@index')->name('webinar.index');
    Route::get('webinar/create', 'Webinar\WebinarController@create')->name('webinar.create');
    Route::post('webinar/store', 'Webinar\WebinarController@store')->name('webinar.store')->middleware('demo');
    Route::get('webinar/edit/{webinar_id}', 'Webinar\WebinarController@edit')->name('webinar.edit');
    Route::post('webinar/update', 'Webinar\WebinarController@update')->name('webinar.update')->middleware('demo');
    Route::get('webinar/destroy/{id}','Webinar\WebinarController@destroy')->name('webinar.destroy');
    Route::get('webinar/create/{id}/{slug}', 'Webinar\WebinarController@createAssociation')->name('webinar.contents.create');
    Route::post('webinar/content/store', 'Webinar\WebinarController@storeAssociation')->name('webinar.contents.store');

 //Testimonial--------------
    Route::resource('testimonial','TestimonialController');
    Route::match(array('GET','POST'),'/testimonial-delete', 'TestimonialController@destroy')->name('testimonial-delete');
    Route::get('testimonial/delete/{id}','TestimonialController@destroy')->name('testimonial.destroy');

    //--Mock Single Test
    Route::resource('testquestions', 'StudentTestQuestionController');
    Route::get('testquestions/catesByCourseType/{slug}', 'StudentTestQuestionController@catesByCourseType');
    // Route::get('testquestions/{id}/edit','StudentTestQuestionController@edit')->name('testquestions.edit');

    Route::get('testquestions/delete/{id}','StudentTestQuestionController@delete')->name('testquestions.delete');
    Route::get('testquestions/viewQuestion/{id}','StudentTestQuestionController@viewQuestion')->name('testquestions.viewQuestion');
    Route::get('testquestions/getTagData/{id}', 'StudentTestQuestionController@getTagData');
    Route::get('testquestions/viewParaQuestion/{id}','StudentTestQuestionController@viewParaQuestion')->name('testquestions.viewParaQuestion');
    Route::get('testquestions/getQuestionTag/{id}', 'StudentTestQuestionController@getQuestionTag');

    Route::get('questiontag/create','StudentTestQuestionController@createTag')->name('questiontag.createTag');
    Route::get('forGetsubjectcate','StudentTestQuestionController@forGetsubjectcate');    
    Route::post('questiontag/storeQuestion','StudentTestQuestionController@storeTag')->name('questiontag.storeQuestion');


    //Passage
    Route::get('testpassages/createpassage', 'StudentTestQuestionController@createpassage')->name('testpassages.createpassage');
    Route::post('testpassages/storepassage', 'StudentTestQuestionController@storepassage')->name('testpassages.storepassage');
    Route::get('testpassages/{id}/editpassage/', 'StudentTestQuestionController@editpassage')->name('testpassages.editpassage');
    Route::post('testpassages/updatepassage', 'StudentTestQuestionController@updatepassage')->name('testpassages.updatepassage');
    Route::get('testpassages/passagedelete/{id}','StudentTestQuestionController@passagedelete')->name('testpassages.passagedelete');
    
    Route::get('testpassages/{id}/editquestion','StudentTestQuestionController@editquestion')->name('testpassages.editquestion');
    Route::post('testpassages/updatequestion', 'StudentTestQuestionController@updatequestion')->name('testpassages.updatequestion');

   // Route::resource('testpassages/createpassage', 'StudentTestQuestionController');

    //Mock Test Master
    Route::resource('mtestmasters', 'MockTestMasterController');
    Route::get('mtestmasters/destroy/{id}','MockTestMasterController@destroy')->name('mtestmasters.destroy');
    Route::get('mtestmasters/viewMTSection/{id}','MockTestMasterController@viewMTSection')->name('mtestmasters.viewMTSection');
    Route::get('mtestmasters/viewAddedQuestion/{id}','MockTestMasterController@viewAddedQuestion')->name('mtestmasters.viewAddedQuestion');


    //Mock Test Section
    Route::resource('mtestsections', 'MockTestSectionController');
    Route::get('mtestsections/destroy/{id}','MockTestSectionController@destroy')->name('mtestsections.destroy');

    //Mock Test Question
    Route::resource('mtestquestions', 'MockTestSectionQuestionController');
    Route::get('mtestquestions/{id}/create','MockTestSectionQuestionController@create')->name('mtestquestions.create');
    Route::post('mtestquestions/store', 'MockTestSectionQuestionController@store')->name('mtestquestions.store');
    Route::get('testquestions/courseById/{id}','StudentTestQuestionController@courseById')->name('testquestions.courseById');

    
    //Package Settings
    Route::resource('packagesettings','PackageSettingController');
    Route::get('packagesettings/destroy/{id}','PackageSettingController@destroy')->name('packagesettings.destroy');
    Route::get('packagesettings/categoriesById/{id}', 'PackageSettingController@categoriesById')->name('packagesettings.categoriesById');
    Route::get('packagesettings/categoriesByCourseId/{id}','PackageSettingController@categoriesByCourseId')->name('packagesettings.categoriesByCourseId');
    Route::get('packagesettings/categoriesByCourseParentType/{id}','PackageSettingController@categoriesByCourseParentType')->name('packagesettings.categoriesByCourseParentType');

    Route::get('packagesettings/categoriesByFreeCourseId/{id}','PackageSettingController@categoriesByFreeCourseId')->name('packagesettings.categoriesByFreeCourseId');
    Route::get('packagesettings/categoriesByQuestionCourseId/{id}','PackageSettingController@categoriesByQuestionCourseId')->name('packagesettings.categoriesByQuestionCourseId');


    //Package Services 
    Route::resource('service','ServiceController');
    Route::get('service/destroy/{id}','ServiceController@destroy')->name('service.destroy');



    Route::resource('slider','SliderController');
    Route::post('/slider-delete', 'SliderController@destroy')->name('slider-delete');

    Route::get('slider-destroy/{id}','SliderController@destroy')->name('slider-destroy');


    // What's app message

    Route::get('send-whats-app-message','WhatsappController@rightmessage')->name('send-whats-app-message');
    Route::get('getAfterselectUsertype','WhatsappController@getAfterselectUsertype');
    Route::get('getBoardOrCompetitive','WhatsappController@getBoardOrCompetitive');
    Route::get('get-board-comptitive-classes','WhatsappController@get_board_comptitive_classes');
    Route::post('send-whats-app-msg','WhatsappController@send_whats_app_msg')->name('send-whats-app-msg');

    Route::get('send-whats-app-message-using-excel','WhatsappController@rightmessage_using_excel')->name('send-whats-app-message-using-excel');
    Route::post('send-whats-app-msg-using-excel','WhatsappController@send_whats_app_msg_using_excel')->name('send-whats-app-msg-using-excel');
    Route::get('show-excel-files','WhatsappController@show_excel_files')->name('show-excel-files');

    Route::post('upload-files-send-whats-app-msg','WhatsappController@upload_files_send_whats_app_msg')->name('upload-files-send-whats-app-msg');


    /*affiliate setup*/
    if (affiliateStatus()){
        Route::get('affiliate/setting','Module\AffiliateController@settingCreate')->name('affiliate.setting.create');
        Route::post('affiliate/setting/update','Module\AffiliateController@settingStore')->name('affiliate.setting.update');
        Route::get('affiliate/index','Module\AffiliateController@requestList')->name('affiliate.request.list');
        Route::get('affiliate/reject/{id}','Module\AffiliateController@reject')->name('affiliate.reject');
        Route::get('affiliate/active/{id}','Module\AffiliateController@active')->name('affiliate.active');
        Route::get('affiliate/payment/request','Module\AffiliateController@paymentRequest')->name('affiliate.payment.request');
        Route::get('affiliate/student/account/{id}/{userId}/{method}/{payId}', 'Module\AffiliateController@accountDetails')
            ->name('student.account.details');
        Route::get('affiliate/payments/status/{id}', 'Module\AffiliateController@affiliateStatus')->name('affiliate.payments.status');
        Route::get('affiliate/payments/cancel/{id}', 'Module\AffiliateController@affiliatePaymentCancel')->name('affiliate.payment.request.cancel');
    }


    if (themeManager() == "rumbok"){

        /*know about module*/
        Route::get('know/index','KnowAboutController@index')->name('know.index');
        Route::get('know/create','KnowAboutController@create')->name('know.create');
        Route::post('know/store','KnowAboutController@store')->name('know.store');
        Route::get('know/edit/{id}','KnowAboutController@edit')->name('know.edit');
        Route::post('know/update','KnowAboutController@update')->name('know.update');
        Route::get('know/delete/{id}','KnowAboutController@destroy')->name('know.destroy');

        /*blog*/
        Route::get('blog/posts','FrontendController@blogPosts')->name('blog.all');
        Route::get('blog/index','BlogController@index')->name('blog.index');
        Route::get('blog/create','BlogController@create')->name('blog.create');
        Route::post('blog/store','BlogController@store')->name('blog.store');
        Route::get('blog/edit/{id}','BlogController@edit')->name('blog.edit');
        Route::post('blog/update','BlogController@update')->name('blog.update');
        Route::get('blog/delete/{id}','BlogController@destroy')->name('blog.destroy');
        Route::get('blog/publish','BlogController@isActive')->name('blog.active');
    }
     //The Order Manager section
     Route::get('order/index', 'OrdermanagerController@index')->name('orders.index');
     Route::get('order/detail/{id}', 'OrdermanagerController@orderDetail')->name('orders.detail');
     Route::get('order/chapterdetail/{id}/{packagetype}/{chapterId?}', 'OrdermanagerController@chapterDetail')->name('orders.chapterdetail');
   
     // Data Analytics
     Route::get('data-analytics/board', 'DataAnalyticController@board')->name('dataanalytic.board');
     Route::post('data-analytics/board', 'DataAnalyticController@board')->name('dataanalytic.board');
     Route::get('data-analytics/competitive', 'DataAnalyticController@competitive')->name('dataanalytic.competitive');
    
     /*live classes subscription*/

    Route::get('live-class-subscription', 'Module\LiveClassSubscriptionController@index')
        ->name('liveclasssubscription.list');

    Route::get('competitive-subscription', 'Module\LiveClassSubscriptionController@exam_live_class_subscription')
        ->name('competitive-subscription');

    Route::get('academic-courses-subscription', 'Module\LiveClassSubscriptionController@academic_courses_subscription')
        ->name('academic-courses-subscription');
    Route::get('competitive-courses-subscription', 'Module\LiveClassSubscriptionController@competitive_courses_subscription')
        ->name('competitive-courses-subscription');


    Route::get('get-board', 'Module\LiveClassSubscriptionController@get_board')
        ->name('get-board');
    Route::get('get-competitive-courses', 'Module\LiveClassSubscriptionController@get_competitive_courses')
        ->name('get-competitive-courses');
    Route::get('get-board-classes/{id}', 'Module\LiveClassSubscriptionController@get_board_classes')
        ->name('get-board-classes');

    //School Code 
    Route::get('school/index', 'SchoolController@index')->name('school.index');
    Route::get('school/create', 'SchoolController@create')->name('school.create');
    Route::post('school/add', 'SchoolController@add')->name('school.add');
    Route::get('school/destroy/{id?}', 'SchoolController@destroy')->name('school.destroy');
    Route::get('school/edit/{id?}', 'SchoolController@edit')->name('school.edit');
    Route::post('school/update', 'SchoolController@update')->name('school.update');
    
    Route::get('school/b2bpricing_mechanism/{id?}', 'SchoolController@b2bpricing_mechanism')->name('school.b2bpricing_mechanism');
    Route::post('school/b2bpricing_mechanism-add', 'SchoolController@b2bpricing_mechanismAdd')->name('b2bpricing_mechanism.add'); 
    
    Route::get('school/b2bmeta_configration/{id?}', 'SchoolController@b2bmeta_configration')->name('school.b2bmeta_configration');
    Route::post('school/b2bmeta_configration-add', 'SchoolController@b2bmeta_configrationAdd')->name('b2bmeta_configration.add'); 
    
    Route::get('school/b2bconfigurations/{id?}', 'SchoolController@b2bconfigurations')->name('school.b2bconfigurations');
    Route::post('school/b2bconfigurations-add', 'SchoolController@b2bconfigurationsAdd')->name('b2bconfigurations.add'); 
    
    Route::post('school/b2bconfigurations-addpermition', 'SchoolController@b2bconfigurationsAddpermition')->name('b2bconfigurations.addpermition'); 
    Route::post('school/checkslug', 'SchoolController@checkslug')->name('b2bconfigurations.checkslug');
 
    //Agent Code 
    Route::get('agent/index', 'AgentController@index')->name('agent.index');
    Route::get('agent/create', 'AgentController@create')->name('agent.create');
    Route::post('agent/add', 'AgentController@add')->name('agent.add');
    Route::get('agent/destroy/{id?}', 'AgentController@destroy')->name('agent.destroy');
    Route::get('agent/edit/{id?}', 'AgentController@edit')->name('agent.edit');
    Route::post('agent/update', 'AgentController@update')->name('agent.update');
    Route::get('agent/getUsers/{code}', 'AgentController@getagentusers')->name('agent.agent_register_users');

    // Report Manager
    Route::get('registered-user/index', 'ReportManager\UserRegistrationController@index')->name('reportmanager.index');
    Route::get('academic-revenue', 'ReportManager\UserRegistrationController@academicRevenue')->name('reportmanager.academic_revenue');
    Route::get('competetive-revenue', 'ReportManager\UserRegistrationController@competetiveRevenue')->name('reportmanager.competitive_revenue');

    //Coupon Usage summary
    Route::get('summary-coupon/index', 'ReportManager\CouponController@index')->name('coupon_usage_summary.index');
    Route::get('summary-coupon/{code}', 'ReportManager\CouponController@couponCode')->name('coupon_detail.index');
    Route::get('summary-coupon/course/{id?}/{code?}', 'ReportManager\CouponController@getCourse')->name('coupon_detail.getcourse');

    //Url Access Permission
    Route::get('url-access/index', 'UrlPermissionController@index')->name('url_access.index');
    Route::post('url-access/add', 'UrlPermissionController@add')->name('url_access.add');
    Route::post('url-access/update', 'UrlPermissionController@update')->name('url_access.update');
    Route::get('access-denied', 'UrlPermissionController@redirect')->name('url_access.redirect');

    //Tutor Enquiry
    Route::get('tutor', 'EnquiryController@enquiry_data_index')->name('enquiry.index');

    // Course without Assesment
    //  Route::get('course/assesment', 'IncorrectLinkController@withoutAssesment')->name('incorrect_report.assesment');
    
    // Incorrect Videos Links
    Route::get('incorrect_report/incorrectvideo', 'IncorrectLinkController@incorrectVideoLink')->name('incorrect_report/incorrectvideo');
    Route::post('incorrect_report/incorrectvideo', 'IncorrectLinkController@incorrectVideoLink')->name('incorrect_report.incorrectvideo');
    Route::post('incorrect_report/update/link', 'IncorrectLinkController@updateVideoLink')->name('incorrect_report.update.link');
    
    // Incorrect Pdf Links
    Route::get('incorrect_report/incorrectpdf', 'IncorrectLinkController@incorrectPdfLink')->name('incorrect_report/incorrectpdf');
    Route::post('incorrect_report/incorrectpdf', 'IncorrectLinkController@incorrectPdfLink')->name('incorrect_report.incorrectpdf');
    Route::post('incorrect_report/update/pdf', 'IncorrectLinkController@updatePdfLink')->name('incorrect_report.update.pdf');

    // Content Summary
    //  Route::get('incorrect_report/contentsummary', 'IncorrectLinkController@board')->name('incorrect_report.contentsummary');
        Route::post('categoriesByCourseData', 'IncorrectLinkController@categoriesByCourseData')->name('categoriesByCourseData');
    //  Route::post('incorrect_report/contentsummary', 'IncorrectLinkController@board')->name('incorrect_report.contentsummary');

   // Question Validation
   Route::get('incorrect_report/questionvalidation', 'IncorrectLinkController@questionValidation')->name('incorrect_report.questionvalidation');
   Route::post('incorrect_report/questionvalidation', 'IncorrectLinkController@questionValidation')->name('incorrect_report.questionvalidation');

    
});
    Route::get('create-package','PackageTestController@createPackages')->name('package.process.create');
    Route::get('create-competitive-package','PackageTestController@createCompetitivePackage')->name('package.competitive.create');
    Route::post('imageUpload', 'StudentTestQuestionController@imageUpload')->name('imageUpload');
    
    Route::get('/my/demojitsi/{id}', 'OnetooneInstructorController@demo_jitsi')->name('demo');
    
    Route::get('/my/tuition/{id}', 'OnetooneInstructorController@demo_jitsi')->name('demo');
    Route::get('/my/tuition-close/{id}', 'OnetooneInstructorController@my_tuition_close')->name('close');

    Route::get('demo-work-whatsapp', 'OnetooneInstructorController@demo_work_whatsapp')->name('demo_work_whatsapp');
    Route::get('add_new_jobs', 'JobsController@jobsIndex')->name('job.add_job');
    Route::post('upload', 'JobsController@jobValidation');
    Route::get('job_list', 'JobsController@listIndex')->name('job.job_list');
    Route::get('job_full_info/{id}', 'JobsController@jobsfullIndex')->name('job.job_index');
    Route::get('job_Edit/{id}', 'JobsController@jobEdit')->name('job.job_edit');
    Route::post('job_upload/{id}', 'JobsController@jobUpdate')->name('job.job_edit');
    Route::get('job_upload', 'JobsController@statusUpdate')->name('job.job_edit');
    //Mentor
    Route::get('add-mentor', 'MentorController@index')->name('mentor.index');
    Route::post('upload-mentor', 'MentorController@mentorValidation')->name('mentor.upload');
    Route::get('list-mentor','MentorController@mentorView')->name('mentor.list_mentor');
    Route::get('list-status', 'MentorController@statusUpdate')->name('mentor.list_mentorlist');
    Route::get('list-detail/{id}' ,'MentorController@listDetail')->name('mentor.detail');
    Route::get('list-edit/{id}','MentorController@edit')->name('mentor.edit');
    Route::post('list-edit-update/{id}','MentorController@update')->name('mentor.editId');
