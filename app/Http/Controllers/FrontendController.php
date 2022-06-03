<?php

namespace App\Http\Controllers;


use App\Blog;
use App\Http\Middleware\Affiliate;
use App\Model\AdminEarning;
use App\Model\AffiliateHistory;
use App\Model\AffiliatePayment;
use App\Model\Cart;
use App\Model\Category;
use App\Model\ClassContent;
use App\Model\Classes;
use App\Model\Course;
use App\Model\MindMap;
use App\Notification;

use App\Model\CourseComment;
use App\Model\CoursePurchaseHistory;
use App\Model\Demo;
use App\Model\Enrollment;
use App\Model\Instructor;
use App\Model\InstructorEarning;
use App\Model\Language;
use App\Model\MobileOtp;
use App\Model\Massage;
use App\Model\Package;
use App\Model\PackagePurchaseHistory;
use App\Model\SeenContent;
use App\StudentTestQuestion;
use App\MockTestMaster;
//use App\Model\Slider;
use App\Slider;
use App\InstructorAssessment;
use App\Model\Testimonial;
use App\Model\Student;
use App\Model\StudentAccount;
use App\Model\VerifyUser;
use App\Model\Wishlist;
use App\Notifications\AffiliateCommission;
use App\Notifications\EnrolmentCourse;
use App\Notifications\InstructorRegister;
use App\Notifications\StudentRegister;
use App\Notifications\VerifyNotifications;
use App\OrderDetail;
use App\Coupon;
use App\NotificationUser;
use App\Page;
use App\Quiz;
use App\QuizScore;
use App\Subscription;
use App\SubscriptionCart;
use App\SubscriptionEnrollment;
use App\InstructorLiveClass;
use App\User;
use App\UserAddtocartPackage;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Hash;
use Alert;
use App\BookFreeClass;
use App\QuizTracking;
use App\Service;
use App\MockTestEnrollment;
use App\JobNotification;
use App\Agent;
use App\PackageSetting;
use App\JobsData;
use Symfony\Component\HttpFoundation\Cookie;
use Validator;
use \Cache;
use App\B2bconfiguration;
use App\Category_permission;

class FrontendController extends Controller
{

    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
    }

    function userNotify($user_id,$details)
    {
        $notify = new NotificationUser();
        $notify->user_id = $user_id;
        $notify->data = $details;
        $notify->save();
    }


    /*Search the courses*/
    public function searchCourses(Request $request)
    {
        //print_r($request);die;
        if ($request->key == null) {
            $courses = null;
        } else {
            $courses = Course::Published()->where('content_type','project-works')->where('title', 'LIKE', "%{$request->key}%")->get();
        }


        $search = collect();

       
        if ($courses == null) {
            return response(['data' => $search], 200);
        } else {
            if ($courses->count() > 0) {
                foreach ($courses as $item) {
                    //$categories = Category::where('id', $item->category_id)->Published()->get();
                  //  $categories = Category::Published()->where('id', $item->category_id)->first()->name;
                    $demo = new Demo();
                    $demo->title = Str::limit($item->title, 58);
                   // $demo->catName = $categories[0]->name;
                    $demo->image = filePath($item->image);
                    $demo->link = route('course.single', $item->slug);
                    $search->push($demo);
                }

            } else {
                $demo = new Demo();
                $demo->title = translate('No Course Found');
                $demo->image = null;
               // $demo->catName = null;
                $demo->link = null;
                $search->push($demo);
            }
        }
        return response(['data' => $search], 200);

    }


/*Search the courses*/
public function coursesSearch(Request $request)
{
//echo 1;die;

if ($request->key == null) {
        $courses = null;
    } else {
        $courses = Course::Published()->where('content_type','project-works')->where('title', 'LIKE', "%{$request->key}%")->get();
    }


    $search = collect();
    

    if ($courses == null) {
        return response(['data' => $search], 200);
    } else {
        if ($courses->count() > 0) {
            
            foreach ($courses as $item) {
                //$categories = Category::Published()->where('id', $item->category_id)->first()->name;
               
                $demo = new Demo();
               // $demo->catName = $categories[0]->name;
                $demo->title = Str::limit($item->title, 58);
                $demo->image = filePath($item->image);
                $demo->link = route('course.single', $item->slug);
                $search->push($demo);
            }

        } else {
            $demo = new Demo();
            $demo->title = translate('No Course Found');
            $demo->image = null;
            //$demo->catName = null;
            $demo->link = null;
            $search->push($demo);
        }
    }
   
    return response(['data' => $search], 200);

}



    /*filer courses and show all course*/
    public function courseFilter(Request $request)
    {
        
        // if ($request->input('categories')) {
        //     $categoryDetail = Category::where('id',$request->input('categories'))->first();
        //     if($categoryDetail->parent_category_id!=0){
        //         $categoryDetail2 = Category::where('id',$categoryDetail->parent_category_id)->first();
        //         if($categoryDetail2->parent_category_id!=0){
        //         }else{
        //             $category2 = Category::where('parent_category_id',$categoryDetail2->id)->pluck('id');
        //             $category2Child = Category::where('parent_category_id',$categoryDetail->id)->pluck('id');
        //             //echo "<pre>";print_r($category2->toArray());
        //             if($category2Child){
        //                 //echo "<pre>";print_r($category2Child->toArray());exit;
        //             }                   
        //         }
        //     }else{
        //         $category1 = Category::where('parent_category_id',$categoryDetail->id)->pluck('id');
        //         //echo "<pre>";print_r($category1);exit;
        //     }
        // }


        $breadcrumb = null;

        $conditions = [];
        /*single instructor*/
        if ($request->input('instructor')) {
            $conditions = array_merge($conditions, ['user_id' => $request->input('instructor')]);
        }
        /*free paid check here*/
        if ($request->input('cost')) {
            $cost = $request->cost;
            if ($cost == 'paid') {
                $conditions = array_merge($conditions, ['is_free' => false]);
            } elseif ($cost == "free") {
                $conditions = array_merge($conditions, ['is_free' => true]);
            } else {

            }

        }
        /*single language*/
        if ($request->input('language')) {
            $conditions = array_merge($conditions, ['language' => $request->input('language')]);
        }

        /*level */

        if ($request->input('level')) {
            if ($request->level == "All Levels") {
                $breadcrumb = translate('All Levels');
            } else {
                $conditions = array_merge($conditions, ['level' => $request->input('level')]);
                $breadcrumb = $request->input('level');
            }


        }
        /*categories*/
        $childArr = array();
        if ($request->input('categories')) {
            //$conditions = array_merge($conditions, ['category_id' => $request->input('categories')]);
            $childCategories =  \App\Model\Category::Published()->select('id')->where('parent_category_id',$request->input('categories'))->get();            
            $childArr = array($request->input('categories'));
            $parentId = array();
            if(count($childCategories) > 0){
                foreach($childCategories as $child){
                    $childArr[] = $child->id; 
                    // if($child->parent_category_id!=0){
                    //     $parentId[] =  $child->id;                   
                    // }                              
                }
                
                    $childCategories2 =  \App\Model\Category::Published()->select('id')->whereIn('parent_category_id',$childArr)->get();
                    if(count($childCategories2)>0){
                        foreach($childCategories2 as $child){
                            $childArr[] = $child->id;
                        }
                        //$childArr = array_merge($childArr,$childCategories2->toArray());
                    }
                
            }            
            //$courses = Course::Published()->whereIn('category_id',$childArr)->latest()->paginate(8);
            //echo "<pre>";print_r($childArr);
            
            $breadcrumb = Category::Published()->where('id', $request->input('categories'))->first()->name;

        }
        $courses = Course::Published()->where($conditions);
        if(!empty($childArr)){
            $courses =  $courses->whereIn('category_id',$childArr);
        }
        $courses =  $courses->orderBy('category_id','desc')->paginate(10);
        $languages = Language::all();

        //check the category in parent for chide
        if ($request->slug == null) {
            $categories = Category::where('parent_category_id', 0)->Published()->get();
        } else {
            
            $cat = Category::where('slug', $request->slug)->Published()->first();

            if ($cat->parent_category_id == 0) {
                //this is parent category
                $categories = Category::where('parent_category_id', $cat->id)->Published()->get();

            } else {
                //this is child category
                $categories = Category::where('parent_category_id', $cat->id)->Published()->get();
                
            }
        }
        $catId = $cat->parent_category_id ?? 0;
        $slug = $cat->slug ?? 'Course';
        $name =  $cat->name ?? 'Course'; 
        $catD = $cat->is_compitative ?? 0;
        $catF = $cat->is_free_study ?? 0;
        if($catD == 1){
            $type =  'Competitive'; 
        } else if($catF == 1){
            $type =  'Study Material'; 
        } else {
            $type =  'Courses'; 
        }
        return view($this->theme.'.course.course_grid',
            compact('categories', 'courses', 'languages', 'breadcrumb','catId','slug','name', 'type'));

    }

    /*this is the home page*/
    public function homepage()
    {  
        //slider
        /*$popular_cat = Category::Published()->where('is_popular', 1)->get();
        $enroll_courser_count = DB::table('enrollments')->select('enrollments.course_id',
            DB::raw('count(enrollments.course_id) as total_course'))
            ->orderByDesc('total_course')
            ->groupBy('course_id')->get();
        $packages = Package::where('is_published', true)->get();
        $latestCourses = Course::Published()->with('relationBetweenInstructorUser')->latest()->take(10)->get();
        $subscriptions = Subscription::Published()->get();
        // forjobs
        $govjobs =  JobsData::where('status','=','0')->take(5)->get();*/
       
        // school **********************************

       $school_id = Session::get('school_id');
       
       $permission['school'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'school')->where('category_id', 'school')->exists();
       $permission['collage'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'collage')->where('category_id', 'collage')->exists();
       $permission['competitive'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'competitive')->where('category_id', 'competitive')->exists();
       $permission['entrepreneur'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'entrepreneur')->where('category_id', 'entrepreneur')->exists();
       $permission['folk-programme'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'folk-programme')->where('category_id', 'folk-programme')->exists();

    //    print_r($permission); die;

       $b2b_configration = B2bconfiguration::where('universities_id', $school_id)->first();
       if(!$b2b_configration){
           die('This Site Not Configuration');
       }
       $b2bconfigrationpermition = DB::table('b2bconfigration_permissions')->where('slug',$b2b_configration->slug)->first();
       $rumbokSliders = Slider::where('type', 'slider')->where('school_id', $school_id)->limit(3)->get();

        $testimonials = Testimonial::orderby('id', 'desc')->where('school_id', $school_id)->get();

        $pageMeta['meta_title'] = $b2b_configration->meta_title;
        $pageMeta['meta_description'] = $b2b_configration->meta_description;
        $pageMeta['tag'] = $b2b_configration->tag; 
        

        /* school **********************************
                ************************************ */

        if($b2b_configration->primary_dashboard=="school"){
            $categories = \App\Model\Category::with('child')->where('is_free_study', 1)->Published()->get();
            $catId = array();
            if($categories->count()>0)
            {
                foreach ($categories as $item) {
                    $catId = array_merge($catId, [$item->id]);
                    if($item->child->count()>0){
                        foreach ($item->child as $child) {
                            $catId = array_merge($catId, [$child->id]);
                        }
                    }
                }
            }
            // print_r($catId); die;
            $courses = \App\Model\Course::Published()->whereIn('category_id', $catId)->latest()->take(3)->get();

            $p_category_school = Category_permission::where('school_id', $school_id)->where('type', 'p_category')
             ->where('main_category', 'school')
             ->whereNull('p_category')              
             ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
             ->select('cate.id','cate.name','cate.slug','cate.banner')
             ->get();
            
            $permission['STUDY_MATERIAL'] = \App\Category_permission::select('category_id')
                                            ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'STUDY-MATERIAL')
                                            ->where('category_id', 'STUDY-MATERIAL')->where('main_category', 'school')->exists();
            $permission['project-work'] = \App\Category_permission::select('category_id')
                                            ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'project-work')
                                            ->where('category_id', 'project-work')->where('main_category', 'school')->exists();

            return view($this->theme.'.homepage-b2b.school-index', compact('rumbokSliders','pageMeta','testimonials','school_id','courses','p_category_school','permission'));
        }
        
        /* collage **********************************
                ************************************ */

        if($b2b_configration->primary_dashboard=="collage"){
            $p_category_collage = Category_permission::where('school_id', $school_id)->where('type', 'p_category')
                ->where('main_category', 'collage')  
                ->whereNull('p_category')            
                ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
                ->select('cate.id','cate.name','cate.slug','cate.banner')
                ->get();
            $permission['Documentry'] = \App\Category_permission::select('category_id')
                ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'Documentry')
                ->where('category_id', 'Documentry')->where('main_category', 'collage')->exists();
            $permission['Project-Report'] = \App\Category_permission::select('category_id')
                ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'Project-Report')
                ->where('category_id', 'Project-Report')->where('main_category', 'collage')->exists();

            
        
        $permission['EDP-courses'] = \App\Category_permission::select('category_id')
        ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'EDP-courses')
        ->where('category_id', 'EDP-courses')->where('main_category', 'collage')->exists();

            return view($this->theme.'.homepage-b2b.collage-index', compact('rumbokSliders','pageMeta','testimonials','school_id','p_category_collage','permission'));            
        }     

        /* competitive **********************************
                ************************************ */

        if($b2b_configration->primary_dashboard=="competitive"){
            $p_category_competitive = Category_permission::where('school_id', $school_id)->where('type', 'p_category')
            ->where('main_category', 'competitive')  
            ->whereNull('p_category')            
            ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
            ->select('cate.id','cate.name','cate.slug','cate.banner')
            ->get();

            return view($this->theme.'.homepage-b2b.competitive-index', compact('rumbokSliders','pageMeta','testimonials','school_id','p_category_competitive','permission'));             
        }

        /* entrepreneur **********************************
                ************************************ */
               
        if($b2b_configration->primary_dashboard=="entrepreneur"){
            $p_category_entrepreneur = Category_permission::where('school_id', $school_id)->where('type', 'p_category')
                    ->where('main_category', 'entrepreneur')  
                    ->whereNull('p_category')            
                    ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
                    ->select('cate.id','cate.name','cate.slug','cate.banner')
                    ->get();
                    
        
                $permission['Documentry'] = \App\Category_permission::select('category_id')
                    ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'Documentry')
                    ->where('category_id', 'Documentry')->where('main_category', 'entrepreneur')->exists();
                
                $permission['Project-Report'] = \App\Category_permission::select('category_id')
                    ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'Project-Report')
                    ->where('category_id', 'Project-Report')->where('main_category', 'entrepreneur')->exists();
                
                $permission['EDP-courses'] = \App\Category_permission::select('category_id')
                    ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'EDP-courses')
                    ->where('category_id', 'EDP-courses')->where('main_category', 'entrepreneur')->exists();
                
                $permission['expert-episote'] = \App\Category_permission::select('category_id')
                    ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'expert-episote')
                    ->where('category_id', 'expert-episote')->where('main_category', 'entrepreneur')->exists();
                
                $permission['government-scheme'] = \App\Category_permission::select('category_id')
                    ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'government-scheme')
                    ->where('category_id', 'government-scheme')->where('main_category', 'entrepreneur')->exists();

            return view($this->theme.'.homepage-b2b.entrepreneur-index', compact('rumbokSliders','pageMeta','testimonials','school_id','p_category_entrepreneur','permission'));             
        }
    }
    public function school(Request $request){
        $school_id = Session::get('school_id');
       
        $b2b_configration = B2bconfiguration::where('universities_id', $school_id)->first();
        if(!$b2b_configration){
            die('This Site Not Configuration');
        }
        if($b2b_configration->primary_dashboard=='school'){
            return redirect('/');
        }
       $permission['school'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'school')->where('category_id', 'school')->exists();
       $permission['collage'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'collage')->where('category_id', 'collage')->exists();
       $permission['competitive'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'competitive')->where('category_id', 'competitive')->exists();
       $permission['entrepreneur'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'entrepreneur')->where('category_id', 'entrepreneur')->exists();
       $permission['folk-programme'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'folk-programme')->where('category_id', 'folk-programme')->exists();

        $pageMeta['meta_title'] = $b2b_configration->meta_title;
        $pageMeta['meta_description'] = $b2b_configration->meta_description;
        $pageMeta['tag'] = $b2b_configration->tag; 
        
        $courses = Course::Published()->take(6)->get();

        $p_category_school = Category_permission::where('school_id', $school_id)->where('type', 'p_category')
         ->where('main_category', 'school') 
         ->whereNull('p_category')                
         ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
         ->select('cate.id','cate.name','cate.slug','cate.banner')
         ->get();

        $permission['STUDY_MATERIAL'] = \App\Category_permission::select('category_id')
         ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'STUDY-MATERIAL')
         ->where('category_id', 'STUDY-MATERIAL')->where('main_category', 'school')->exists();
        $permission['project-work'] = \App\Category_permission::select('category_id')
         ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'project-work')
         ->where('category_id', 'project-work')->where('main_category', 'school')->exists();

        return view($this->theme.'.homepage-b2b.school-index', compact('pageMeta','school_id','courses','p_category_school','permission'));
    
    }
    public function collage(Request $request){
        $school_id = Session::get('school_id');
        $b2b_configration = B2bconfiguration::where('universities_id', $school_id)->first();
        if(!$b2b_configration){
            die('This Site Not Configuration');
        }
        if($b2b_configration->primary_dashboard=='collage'){
            return redirect('/');
        }
        $permission['school'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'school')->where('category_id', 'school')->exists();
        $permission['collage'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'collage')->where('category_id', 'collage')->exists();
        $permission['competitive'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'competitive')->where('category_id', 'competitive')->exists();
        $permission['entrepreneur'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'entrepreneur')->where('category_id', 'entrepreneur')->exists();
        $permission['folk-programme'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'folk-programme')->where('category_id', 'folk-programme')->exists();
        
        $permission['Documentry'] = \App\Category_permission::select('category_id')
        ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'Documentry')
        ->where('category_id', 'Documentry')->where('main_category', 'collage')->exists();
        
        $permission['Project-Report'] = \App\Category_permission::select('category_id')
        ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'Project-Report')
        ->where('category_id', 'Project-Report')->where('main_category', 'collage')->exists();
        
        $permission['EDP-courses'] = \App\Category_permission::select('category_id')
        ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'EDP-courses')
        ->where('category_id', 'EDP-courses')->where('main_category', 'collage')->exists();
 
         $pageMeta['meta_title'] = $b2b_configration->meta_title;
         $pageMeta['meta_description'] = $b2b_configration->meta_description;
         $pageMeta['tag'] = $b2b_configration->tag; 
        $p_category_collage = Category_permission::where('school_id', $school_id)->where('type', 'p_category')
        ->where('main_category', 'collage')  
        ->whereNull('p_category')               
        ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
        ->select('cate.id','cate.name','cate.slug','cate.banner')
        ->get();

        return view($this->theme.'.homepage-b2b.collage-index', compact('pageMeta','school_id','p_category_collage','permission')); 
    }
    public function competitive(Request $request){
        $school_id = Session::get('school_id');
       
        $b2b_configration = B2bconfiguration::where('universities_id', $school_id)->first();
        if(!$b2b_configration){
            die('This Site Not Configuration');
        }
        if($b2b_configration->primary_dashboard=='competitive'){
            return redirect('/');
        }
       
        $permission['school'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'school')->where('category_id', 'school')->exists();
        $permission['collage'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'collage')->where('category_id', 'collage')->exists();
        $permission['competitive'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'competitive')->where('category_id', 'competitive')->exists();
        $permission['entrepreneur'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'entrepreneur')->where('category_id', 'entrepreneur')->exists();
        $permission['folk-programme'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'folk-programme')->where('category_id', 'folk-programme')->exists();
 
         $pageMeta['meta_title'] = $b2b_configration->meta_title;
         $pageMeta['meta_description'] = $b2b_configration->meta_description;
         $pageMeta['tag'] = $b2b_configration->tag; 
        $p_category_competitive = Category_permission::where('school_id', $school_id)->where('type', 'p_category')
        ->where('main_category', 'competitive')              
        ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
        ->select('cate.id','cate.name','cate.slug','cate.banner')
        ->get();

        return view($this->theme.'.homepage-b2b.competitive-index', compact('pageMeta','school_id','p_category_competitive','permission'));
    }
    public function entrepreneur(Request $request){
        $school_id = Session::get('school_id');
       
        $b2b_configration = B2bconfiguration::where('universities_id', $school_id)->first();
        if(!$b2b_configration){
            die('This Site Not Configuration');
        }
        if($b2b_configration->primary_dashboard=='entrepreneur'){
            return redirect('/');
        }
       
        $permission['school'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'school')->where('category_id', 'school')->exists();
        $permission['collage'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'collage')->where('category_id', 'collage')->exists();
        $permission['competitive'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'competitive')->where('category_id', 'competitive')->exists();
        $permission['entrepreneur'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'entrepreneur')->where('category_id', 'entrepreneur')->exists();
        $permission['folk-programme'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'folk-programme')->where('category_id', 'folk-programme')->exists();
                    
        
        $permission['Documentry'] = \App\Category_permission::select('category_id')
            ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'Documentry')
            ->where('category_id', 'Documentry')->where('main_category', 'entrepreneur')->exists();
    
        $permission['Project-Report'] = \App\Category_permission::select('category_id')
            ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'Project-Report')
            ->where('category_id', 'Project-Report')->where('main_category', 'entrepreneur')->exists();
        
        $permission['EDP-courses'] = \App\Category_permission::select('category_id')
            ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'EDP-courses')
            ->where('category_id', 'EDP-courses')->where('main_category', 'entrepreneur')->exists();
        
        $permission['expert-episote'] = \App\Category_permission::select('category_id')
            ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'expert-episote')
            ->where('category_id', 'expert-episote')->where('main_category', 'entrepreneur')->exists();
        
        $permission['government-scheme'] = \App\Category_permission::select('category_id')
            ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'government-scheme')
            ->where('category_id', 'government-scheme')->where('main_category', 'entrepreneur')->exists();

         $pageMeta['meta_title'] = $b2b_configration->meta_title;
         $pageMeta['meta_description'] = $b2b_configration->meta_description;
         $pageMeta['tag'] = $b2b_configration->tag; 
        $p_category_entrepreneur = Category_permission::where('school_id', $school_id)->where('type', 'p_category')
        ->where('main_category', 'entrepreneur')              
        ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
        ->select('cate.id','cate.name','cate.slug','cate.banner')
        ->get();

        return view($this->theme.'.homepage-b2b.entrepreneur-index', compact('pageMeta','school_id','p_category_entrepreneur','permission'));  
    }
    public function folkProgramme(Request $request){
        $school_id = Session::get('school_id');
       
        $b2b_configration = B2bconfiguration::where('universities_id', $school_id)->first();
        if(!$b2b_configration){
            die('This Site Not Configuration');
        }
        if($b2b_configration->primary_dashboard=='folk-programme'){
            return redirect('/');
        }
       
        $permission['school'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'school')->where('category_id', 'school')->exists();
        $permission['collage'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'collage')->where('category_id', 'collage')->exists();
        $permission['competitive'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'competitive')->where('category_id', 'competitive')->exists();
        $permission['entrepreneur'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'entrepreneur')->where('category_id', 'entrepreneur')->exists();
        $permission['folk-programme'] = \App\Category_permission::select('category_id')->where('school_id', $school_id)->where('type', 'folk-programme')->where('category_id', 'folk-programme')->exists();

         $pageMeta['meta_title'] = $b2b_configration->meta_title;
         $pageMeta['meta_description'] = $b2b_configration->meta_description;
         $pageMeta['tag'] = $b2b_configration->tag; 
        // $p_category_entrepreneur = Category_permission::where('school_id', $school_id)->where('type', 'p_category')
        // ->where('main_category', 'entrepreneur')              
        // ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
        // ->select('cate.id','cate.name','cate.slug','cate.banner')
        // ->get();

        return view($this->theme.'.homepage-b2b.folkProgramme-index', compact('pageMeta','school_id','permission'));  
    }


    public function currentAffaire(Request $request){

//reportrange
    $breadcrumb = null;
    //check the category in parent for chide
    $cat = Category::where('slug', $request->slug)->first();
    $catId = array();
    $catId = array_merge($catId, [$cat->id]);
    if ($cat->parent_category_id == 0) {
        //this is parent category
        $categories = Category::where('parent_category_id', $cat->id)->Published()->get();
        //all child category id
        foreach ($categories as $item) {
            $catId = array_merge($catId, [$item->id]);
        }

    } else {
        //this is child category
        $categories = Category::where('parent_category_id', $cat->id)->Published()->get();
        //echo $cat->parent_category_id;exit;
        if(count($categories)){
            foreach ($categories as $item) {
                $catId = array_merge($catId, [$item->id]);
            }
        }            
        $catId = array_merge($catId, [$cat->id]);
    }



    //category ways course
    if(isset($_GET['reportrange']) && $_GET['reportrange']!=''){
        //Date Range Filter
        $splitDate      = explode('-',trim($_GET['reportrange']));
        $splitStartDate = explode('/',trim($splitDate[0]));
        $splitEndDate   = explode('/',trim($splitDate[1]));

         $startDate      = $splitStartDate[2]."-".$splitStartDate[0]."-".$splitStartDate[1];        
         $endDate        = $splitEndDate[2]."-".$splitEndDate[0]."-".$splitEndDate[1];

        $courses        = Course::Published()->whereIn('category_id', $catId)->whereBetween('created_at', array($startDate, $endDate))->orderBy('category_id','desc')->paginate(60);
    }else{
        $courses        = Course::Published()->whereIn('category_id', $catId)->orderBy('category_id','desc')->paginate(60);
    }
    $languages = Language::all();

    //rating collect
    $rating = collect();
    for ($i = 1; $i <= 5; $i++) {
        $demo = new Demo();
        $demo->index = $i;
        $demo->total_course = $courses->where('rating', $i)->count();
        $rating->push($demo);
    }

    $insId = array();
    //instructors
    foreach ($courses as $c) {
        $insId = array_merge($insId, [$c->user_id]);
    }
    $catId = $cat->parent_category_id;
    $name =  $cat->name;
    $slug = $request->slug;
    if($cat->is_compitative == 1){
        $type =  'Compitative'; 
    } else if($cat->is_free_study == 1){
        $type =  'Free Study'; 
    } else {
        $type =  'Courses'; 
    }
    return view($this->theme.'.current_affaire.current_affaire',
        compact('categories', 'courses', 'languages', 'rating', 'breadcrumb','catId','slug','name','type'));


}

public function courseCatsushil(Request $request)
{
    echo request()->segment(1);
    die('=====');
}



   /*Show category ways course*/
   public function courseCat(Request $request)
   {
       $breadcrumb = null;
       //check the category in parent for chide
       $cat = Category::where('slug', $request->slug1)->first(); 
       $s_cat = Category::where('parent_category_id', $cat->id)->where('slug', $request->slug2)->first();  
       $catId = array();
       $catId = array_merge($catId, [$cat->id]);
       $boardClasses = Category::Published()->where('parent_category_id', $cat->id)->get();
       $packageDataBoards = \App\PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
       ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
       ->leftjoin('courses as c','c.ole_refference_id','=','package_settings.course_id')
       ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title')
       ->where(['package_settings.sub_category_id'=>$s_cat->id])
       ->where(['package_settings.category_id'=>$cat->id]);
       if(isset($request->classes) && $request->classes!='')
       {
           $packageDataBoards = $packageDataBoards->where('package_settings.sub_category_id',$request->classes);
       }
       $packageDataBoards = $packageDataBoards->orderBy('id', 'DESC')->paginate(24);
       $pageMeta['meta_title'] = $cat->meta_title;
       $pageMeta['meta_description'] = $cat->meta_description;
       $pageMeta['tag'] = $cat->tag; 
       // echo "<pre>"; print_r($packageDataBoards); die('=========');
       return view($this->theme.'.course.course_grid',
           compact('packageDataBoards', 'cat','boardClasses','pageMeta'));
   }

     /*Single course details*/
     public function singleCourse($slug)
     {
         
         $l_courses = Course::Published()->latest()->take(3)->get(); // single course details
         $sug_courses = Course::Published()->take(8)->get()->shuffle(); // suggession courses
         $s_course = Course::Published()->where('slug', $slug)->with('classes')->first(); // single course details
         $cat = Category::find($s_course->category_id);
         $pageMeta =[];  
         $setValues= '';           
         if($s_course->meta_title) {
 
            $getCodes = json_decode($s_course->meta_title);
            $setValues = implode(', ', $getCodes); 
         } 
         $setTags ='';
         if($s_course->tag)  {
             $getTag = json_decode($s_course->tag);
             $setTags = implode(', ', $getTag); 
         }                       
         $pageMeta['meta_title'] = $setValues;
         $pageMeta['meta_description'] = $s_course->meta_description;
         $pageMeta['tag'] = $setTags;
 
 
         return view($this->theme.'.course.course_details', compact('s_course', 'l_courses', 'sug_courses','pageMeta','cat'));
 
     }

    public function demoCourses(Request $request){
        $cat = Category::Published()->where('slug', $request->slug)->first();
        //Get all catgories having parent_category_id as above
        $categories = Category::Published()->where('parent_category_id', $cat->id)->pluck('id');
        $courses = Course::with('classes')->Published()->whereIn('category_id', $categories->toArray())->get();
        $data = array();
        foreach($courses as $course)
        {
            if(isset($course->classes) && !empty($course->classes))
            {
                
                foreach($course->classes as $item)
                {
                    if(!empty($item->contents))
                    {
                        foreach($item->contents as $item_content)
                        {
                            if(!empty($item_content->demo_url))
                            {
                                $data[$course->category->name][] = array('category_id'=>$course->category->id,'category_name'=>$course->category->name,'demo_url'=>$item_content->demo_url,'demo_type'=>$item_content->demo_type,'chapter_name'=>$item_content->title,'subject_name'=>$course->title,'course_image'=>$course->image);
                            }
                        }
                    }
                    
                }
            }
        }
        //echo "<pre>".count($data);print_r($data);exit;
        return view($this->theme.'.course.demo_courses', compact('cat','data'));
    }

    /*Content preview*/
    public function contentPreview($id)
    {
        $content = ClassContent::findOrFail($id);
        return view($this->theme.'.course.preview', compact('content'));
    }


    /*currencies change*/
    public function currenciesChange(Request $request)
    {
        session(['currency' => $request->id]);
        // Artisan::call('optimize:clear');
        return back();
    }

    /*languages change*/
    public function languagesChange(Request $request)
    {
        session(['locale' => $request->code]);
        // Artisan::call('optimize:clear');
        return back();
    }

     //lesson_details
     public function package_details($slug,$enrollId)
    {
        Session::put('location_path', $slug);
        Session::put('location_path1', $enrollId);
        

        
        if (zoomActive()){
            $s_course = Course::Published()->where('slug', $slug)->with('classes')->with('meeting')->first();
        }else{            
            $s_course = Course::Published()->where('slug', $slug)->with('classes')->first(); // single course details
        }

        $enroll = Enrollment::where('id', $enrollId)->where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
        
        if ($enroll->count() == 0) {
            return back();
        }
        $getChapter = '';
        $pkgId = '';
        $package_type = 3;
        if(isset($enroll) && count($enroll)>0){
            $cart_details = UserAddtocartPackage::where('enrollment_id','=',$enroll[0]->id)->first();
            $package_type = $cart_details->package_type;
            $getChapter = $cart_details->course_id;
            $pkgId = $enroll[0]->package_id;
        }
        $comments = CourseComment::latest()->with('user')->get();
        $time_left = 1;
        $seens = 1;
        // check whether course content seen or not
        if(!empty($s_course->min_course_time)){
            $seens = SeenContent::where('course_id', $s_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->count();
            $lesson_track = QuizTracking::where('course_id', $s_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->where('enroll_id', $enroll->first()->id)->first();
            if ($lesson_track) {
                $time_left = $lesson_track->time_left;
            } else {
                $time_left = $s_course->min_course_time;
            }
        }
        

        $quiz = Quiz::where('course_id',$s_course->id)->where('status','1')->first();
        
        if($quiz) {
            $quiz_status = $quiz->status;
        } else {
            $quiz_status = 0;
        }
        $PackageDetail ='';
        $totalAttend = 0;
        $totalUnitAttend = 0;
        $totalChapterAttend = 0;
        $subjectTests =0;
        $mockTests = [];
        if($enroll[0]['type'] =='1') {
            $PackageDetail = PackageSetting::where('id', $enroll[0]['package_id'])->first();
            $totalAttend = MockTestEnrollment::where(['test_type' => 'subject','test_status' => 'finish','user_id' => Auth::id() ,'package_id' => $enroll[0]['package_id']])->count(); 
            $totalUnitAttend = MockTestEnrollment::where(['test_type' => 'unit','test_status' => 'finish','user_id' => Auth::id() ,'package_id' => $enroll[0]['package_id']])->count();
            $totalChapterAttend =MockTestEnrollment::where(['test_type' => 'chapter','test_status' => 'finish','user_id' => Auth::id() ,'package_id' => $enroll[0]['package_id']])->count();
           /// print_r($enroll[0]['package_id']); die;
            $subjectTests = StudentTestQuestion::where(['q_cat_id' => $PackageDetail->category_id, 'sub_cat_id' => $PackageDetail->sub_category_id ,'course_id' => $PackageDetail->course_id])->count();
            $mockTests = MockTestMaster::with('mockTestSection')->where(['category_id' => $PackageDetail->sub_category_id, 'test_type' => 'Mock'])->where('status', 1)->get();

            //Added by ashish on 27th Jan 2022
            //all subject k case me customization nahi karna hota hai aur package k sabhi units access ho jaate hai
            //matlab package_type can be anything course_id == null
            if($PackageDetail->is_all_subject==1){
                $package_type = 1;
            }
        }
        $getCatParentName = Category::where('id',$s_course->category->parent_category_id)->first();
        $boardName = $getCatParentName->name;
        return view($this->theme.'.course.lesson.package_details', compact('boardName','pkgId','getChapter','mockTests','s_course', 'comments', 'enroll', 'seens', 'time_left', 'quiz_status','PackageDetail','totalAttend','totalUnitAttend', 'totalChapterAttend','subjectTests','package_type'));
      }

    //lesson_details
     public function lesson_details($slug)
    {
        Session::put('location_path', $slug);
        

        
        if (zoomActive()){
            $s_course = Course::Published()->where('slug', $slug)->with('classes')->with('meeting')->first();
        }else{            
            $s_course = Course::Published()->where('slug', $slug)->with('classes')->first(); // single course details
        }

        $enroll = Enrollment::where('course_id', $s_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
        //$pkgId = '';
        
        if ($enroll->count() == 0) {
            return back();
        }
        $getChapter = '';
        $pkgId = '';
        if(isset($enroll) && count($enroll)>0 && $enroll[0]->type=='1'){
            $getChapter = UserAddtocartPackage::where('enrollment_id','=',$enroll[0]->id)->first();
            $getChapter = $getChapter->course_id;
            $pkgId = $enroll[0]->package_id;
        }
        $comments = CourseComment::latest()->with('user')->get();
        $time_left = 1;
        $seens = 1;
        // check whether course content seen or not
        if(!empty($s_course->min_course_time)){
            $seens = SeenContent::where('course_id', $s_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->count();
            $lesson_track = QuizTracking::where('course_id', $s_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->where('enroll_id', $enroll->first()->id)->first();
            if ($lesson_track) {
                $time_left = $lesson_track->time_left;
            } else {
                $time_left = $s_course->min_course_time;
            }
        }
        

        $quiz = Quiz::where('course_id',$s_course->id)->where('status','1')->first();
        
        if($quiz) {
            $quiz_status = $quiz->status;
        } else {
            $quiz_status = 0;
        }
        $PackageDetail ='';
        $totalAttend = 0;
        $totalUnitAttend = 0;
        $totalChapterAttend = 0;
        $subjectTests =0;
        $mockTests = [];
        if($enroll[0]['type'] =='1') {
            $PackageDetail = PackageSetting::where('id', $enroll[0]['package_id'])->first();
            $totalAttend = MockTestEnrollment::where(['test_type' => 'subject','user_id' => Auth::id() ,'package_id' => $enroll[0]['package_id']])->count(); 
            $totalUnitAttend = mockTestEnrollment::where(['test_type' => 'unit','user_id' => Auth::id() ,'package_id' => $enroll[0]['package_id']])->count();
            $totalChapterAttend =mockTestEnrollment::where(['test_type' => 'chapter','user_id' => Auth::id() ,'package_id' => $enroll[0]['package_id']])->count();
            $subjectTests = StudentTestQuestion::where(['q_cat_id' => $PackageDetail->category_id, 'sub_cat_id' => $PackageDetail->sub_category_id ,'course_id' => $PackageDetail->course_id])->count();
            $mockTests = MockTestMaster::with('mockTestSection')->where(['category_id' => $PackageDetail->category_id, 'test_type' => 'Mock'])->where('status', 1)->get();
        }
       // return $s_course;
        $getCatParentName = Category::where('id',$s_course->category->parent_category_id)->first();

        //$s_course->content_type;//free-study-material
        if($s_course->content_type=='free-study-material'){
            $boardName = 'Study Material';
        }else if($s_course->content_type=='project-works'){
            $boardName = 'Our Elite Courses';
        }else{
        $boardName = $getCatParentName->name;
        }
        return view($this->theme.'.course.lesson.lesson_details', compact('boardName','pkgId','getChapter','mockTests','s_course', 'comments', 'enroll', 'seens', 'time_left', 'quiz_status','PackageDetail','totalAttend','totalUnitAttend', 'totalChapterAttend','subjectTests'));
      }


    //cart
    public function cart()
    {
        return view($this->theme.'.cart.index');
    }

    //dashboard
    public function dashboard()
    {
       // $notifications = NotificationUser::latest()->where('user_id', Auth::user()->id)->get();
        $notifications = Notification::latest()->where(['user_id'=> Auth::user()->id  , 'user_id' => '0'])->get();

        return view($this->theme.'.dashboard.index', compact('notifications'));
    }

    //my_profile
    public function my_profile()
    {

        $student = User::where('id', Auth::user()->id)->with('student')->first();

        $k12CourseCount         = 0;
            $competitiveCount       = 0;
            $freeStudyCount         = 0;
            $currentAffairCount     = 0;
            $projectWorksCount      = 0;

            $board_detail = Enrollment::select('enrollments.id')
                                        ->join('courses','courses.id','=','enrollments.course_id')
                                        ->where('enrollments.user_id', Auth::user()->id)
                                        ->where('courses.content_type','board')
                                       ->get();
            $k12CourseCount = $board_detail->count();

            $competitive = Enrollment::select('enrollments.id')
                                            ->join('courses','courses.id','=','enrollments.course_id')
                                            ->where('enrollments.user_id', Auth::user()->id)
                                            ->where('courses.content_type','competitive-courses')
                                            ->get();
            $competitiveCount = $competitive->count();
            $freeStudy = Enrollment::select('enrollments.id')
                                            ->join('courses','courses.id','=','enrollments.course_id')
                                            ->where('enrollments.user_id', Auth::user()->id)
                                            ->where('courses.content_type','free-study-material')
                                            ->get();
            $freeStudyCount = $freeStudy->count();
            $currentAffair = Enrollment::select('enrollments.id')
                                            ->join('courses','courses.id','=','enrollments.course_id')
                                            ->where('enrollments.user_id', Auth::user()->id)
                                            ->where('courses.content_type','current-affairs')
                                            ->get();
            $currentAffairCount = $currentAffair->count();
            $projectWorks = \App\Model\PwEnrollment::select('pw_enrollments.id')
                                        ->join('pw_courses','pw_courses.id','=','pw_enrollments.project_work_id')
                                        ->where('pw_enrollments.user_id', Auth::user()->id)
                                        ->get();
            $projectWorksCount = $projectWorks->count();
                
        return view($this->theme.'.profile.index', compact('student','k12CourseCount','competitiveCount','freeStudyCount','currentAffairCount','projectWorksCount'));

    }

    //enrolled_course
    public function enrolled_course()
    {
        return view($this->theme.'.enrolled.index');
    }


    //purchase_history
    public function purchase_history()
    {
        $orderedData = OrderDetail::where('user_id', Auth::user()->id)->orderby('transaction_date','desc')->get();
        //$p_histories = Enrollment::where('user_id', Auth::user()->id)->with('history')->get();
        return view($this->theme.'.purchase_history.index', compact('orderedData'));

    }


    //login
    public function login()
    {
        return view($this->theme.'.auth.login');
    }

    //register
    public function signup()
    {
        if(Auth::user()){
            return redirect('/');
        }
        return view('auth.signup');
    }

    //register
    public function create(Request $request)
    {
        if(Auth::user()){
            return redirect('/');
        }

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // registration validation
        $request->validate(
            [
                'name' => 'required',
                'email' => ['required', 'numeric', 'min:10', 'unique:users'],
                'alt_email' => ['nullable', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
                'confirmed' => 'required|required_with:password|same:password',
            ],
            [
                'name.required' => translate('Name is required'),
                'email.required' => translate('Mobile number is required'),
                'email.unique' => translate('Mobile number is already register'),
                'email.numeric' => translate('Mobile number should be numeric'),
                'alt_email.email' => translate('Email is not valid'),
                'password.required' => translate('Password is required'),
                'password.min' => translate('Password  must be 8 character '),
                'password.string' => translate('Password is required'),
                'confirmed.required' => translate('Please confirm your password'),
                'confirmed.same' => translate('Password did not match'),
            ]

        );

        //create user for login
        $user = new User();
        $user->name = $request->name;
        $user->slug = Str::slug($request->name);
        $user->email = $request->email;
        $user->alternate_email_user = $request->alt_email;
        $user->password = Hash::make($request->password);
        $user->user_type = 'Student';
        $user->verified = 1;
        $user->save();

        //create student
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->alternate_email_user = $request->alt_email;
        $student->phone = $request->email;
        $student->user_id = $user->id;
        $student->save();

        /*here is the student */
        try {
            $user->notify(new StudentRegister());

            VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            
            

            // send verify mail
            $user->notify(new VerifyNotifications($user));

        } catch (\Exception $exception) {
        }

        Session::flash('message', translate("Registration done successfully. Please login."));
        Auth::login($user);
        return redirect()->to('/');
        //return redirect()->route('login');


    }

    /*page with content*/
    public function page($slug)
    {
        $page = Page::with('content')->where('slug', $slug)->firstOrFail();
        return view($this->theme.'.page.index', compact('page'));
    }

   

    // password reset
    public function password_reset()
    {
        if(Auth::user()){
            return redirect('/');
        }
        return view($this->theme.'.auth.email');
    }

    public function password_otp($mobile)
    {
        if(Auth::user()){
            return redirect('/');
        }
        return view($this->theme.'.auth.passwordReset', compact('mobile'));
    }
    
    public function reset_password_otp(Request $request)
    {
        if(Auth::user()){
            return redirect('/');
        }
        $request->validate(
            [
                'mobile' => ['required', 'numeric', 'min:10']
            ],
            [
                'mobile.required' => translate('Mobile number is required'),
                'mobile.numeric' => translate('Mobile number should be numeric')
            ]
        );
        
        $mobile = $request->mobile;
        
        $user = User::where('email', '=', $mobile)->first();
        
        if ($user) {
            $otp = new MobileOtp();
            $otp->country_code = '91';
            $otp->mobile = $mobile;
            $otp->otp = mt_rand(1111, 9999);
            $otp->save();
            $message = $otp->otp . " is the OTP for Login. This OTP is valid for 5 min";
            sendSMS($message, $mobile);
            
            Session::flash('status', translate("OTP send to your mobile number."));
            return redirect()->route('password.otp', $mobile);
        } else {
            Session::flash('status', translate("This mobile number is not registered."));
            return back();
        }
    }
    
    public function mobile_check_otp(Request $request)
    {
       
        $rules = array(
            'email' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        );    
        $messages = array(
            'email.required' => 'The mobile field is required.',
            'email.min' => 'The mobile length should be atleast 10 digit.',
            'email.regex' => 'The mobile number is invalid.'
      );
        $validator = Validator::make( $request->all(), $rules, $messages );
        
        if ( $validator->fails() ) 
        {
           return Response::json(['errors' => $validator->errors()], 422);
        }

        $mobile = $request->email;
        
        $user = User::where('email', '=', $mobile)->first();
        
        if ($user) {
            $errors = (object) [
                'email' => ['This mobile number is already registered with us, try with other mobile number']
              ];
            return Response::json(['errors' => $errors], 422);
        } else {
            
            $otp = new MobileOtp();
            $otp->country_code = '91';
            $otp->mobile = $mobile;
            $otp->otp = mt_rand(1111, 9999);
            $otp->save();
            $message = $otp->otp . " is the OTP for Login. This OTP is valid for 5 min";
            sendSMS($message, $mobile);
            
            return Response::json(['message' => 'OTP successfully sent on your mobile number. This OTP is valid for 5 min'],200);
        }
    }
    
    public function mobile_otp_verify (Request $request)
    {
        $otp = $request->otp;
        $mobile = $request->email;
        
        $otpData = MobileOtp::where(['mobile' => $mobile, 'verified' => '0'])->orderByDesc('id')->first();
        
        if ($otpData['otp'] == $otp) {
            MobileOtp::where('mobile', $mobile)->update([
                'verified' => '1'
            ]);
            return Response::json(['message' => 'OTP verified successfully'],200);
        } else {
            $errors = (object) [
                'otp' => ['Otp did not match']
              ];
            return Response::json(['errors' => $errors], 422);
        }
    }
    
      
    public function user_login(Request $request){
        $rules = array(
            'email' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'name' => 'required',
            'password' => 'required|confirmed|min:8',
            'class_type' => 'required'
        );    
        $messages = array(
            'email.required' => 'The mobile field is required.',
            'email.min' => 'The mobile length should be atleast 10 digit.',
            'email.regex' => 'The mobile number is invalid.',
            'name.required' => 'The name field is required.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The password does not match.',
            'password.min' => 'The password length should be atleast 8 character.',
            'class_type.required' => 'Provide your learning preference'
        );
        $validator = Validator::make( $request->all(), $rules, $messages );
        
        if ( $validator->fails() ) 
        {
            return Response::json(['errors' => $validator->errors()], 422);
        }
        
        //create user for login
        $user = new User();
        $user->name = $request->name;
        $user->school_id = Session::get('school_id');
        $user->slug = Str::slug($request->name);
        $user->email = $request->email;

        /*$user->class_type = $request->class_type;
        $user->class_name = $request->class_name;
        $user->board = $request->board;
        $user->competitive = $request->competitive;
        */
        $user->alternate_email_user = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 'Student';
        $user->verified = 1;
        

        if(isMobileDevice()){
            //echo "Mobile Browser Detected";
            $deviceType = 'Android';
            $userAgent = $_SERVER["HTTP_USER_AGENT"];
            $user->device = $deviceType;
            $user->user_agent = serialize($userAgent);
        }
        else {
            //echo "Mobile Browser Not Detected";
            $deviceType = 'Desktop';
            $userAgent = $_SERVER["HTTP_USER_AGENT"];
            $user->device = $deviceType;
            $user->user_agent = serialize($userAgent);
           
        }

        $user->save();

        //create student
        $student = new Student();
        $student->name = $request->name;
        $student->school_id = Session::get('school_id');
        $student->email = $request->email;

         $student->class_type = $request->class_type;
         $student->class_name = $request->class_name;
         $student->board = $request->board;
         $student->competitive = $request->competitive;

        $student->alternate_email_user = $request->email;
        $student->phone = $request->email;
        $student->user_id = $user->id;
        $student->save();

        /*here is the student */
        try {
            $user->notify(new StudentRegister());
            VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->notify(new VerifyNotifications($user));
        } catch (\Exception $exception) {
        }

        if ($user) {
            Auth::login($user);
            $user = Auth::user();
            if($user->student->image ){
                $image = asset($user->student->image);
            } else {
                $image = asset('public/uploads/user/user.png');
            }
            $userInfo =
            array(
                //'name' => $user->name,
                //'email' => $user->alternate_email_user,
                'phone' => $user->email,
                //'picture' => $image ? $image : $image ,
            );
            $Data =  ['status' => 'true', 'msg' => '', 'user_info' => $userInfo];
            setcookie('eg_user', json_encode($Data), time()+3600,'/' ,'.olexpert.org.in');
        
            return Response::json(['status'=>'done','message' => 'Registration completed','user'=>$user]);
        }else{
            return Response::json(['message' => 'Something went wrong'], 400);
        }
    }
    
    
    public function password_reset_otp(Request $request)
    {
        $request->validate(
            [
                'otp' => ['required', 'numeric', 'min:4'],
                'password' => ['required', 'string', 'min:8'],
                'confirmed' => 'required|required_with:password|same:password',
            ],
            [
                'otp.required' => translate('OTP is required'),
                'otp.numeric' => translate('OTP should be numeric'),
                'password.required' => translate('Password is required'),
                'password.min' => translate('Password  must be 8 character '),
                'password.string' => translate('Password is required'),
                'confirmed.required' => translate('Please confirm your password'),
                'confirmed.same' => translate('Password did not match'),
            ]
        );
        
        $mobile = $request->mobile;
        
        $otpData = MobileOtp::where(['mobile' => $mobile, 'verified' => '0'])->orderByDesc('id')->first();
        
        if ($otpData['otp'] == $request->otp) {
            User::where('email', $mobile)->update([
                'password' => Hash::make($request->password)
            ]);
            MobileOtp::where('mobile', $mobile)->update([
                'verified' => '1'
            ]);
            Session::flash('message', translate("Your password is reset successfully. You can now login."));
            return redirect()->route('login');
        } else {
            Session::flash('message', translate(""));
            Session::flash('error', translate("OTP did not matched."));
            return view($this->theme.'.auth.passwordReset', compact('mobile'));
        }
    }

    // student_edit
    public function student_edit()
    {
        $student = User::where('id', Auth::user()->id)->first();
        
        return view($this->theme.'.profile.update', compact('student'));
    }

    // update
    public function update(Request $request, $std_id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // registration validation
        $request->validate(
            [
                'name' => 'required',

            ],
            [
                'name.required' => translate('Name is required'),

            ]
        );


        //create student
        $student = Student::where('user_id', Auth::id())->firstOrFail();
        $student->name = $request->name;
        $student->father_name = $request->father_name;

        $student->alternate_email_user = $request->email;
        $student->address = $request->address;
    //    $student->fb = $request->fb;
    //    $student->tw = $request->tw;
    //    $student->linked = $request->linked;
        $student->about = $request->about;

        if ($request->file('image')) {
            $student->image = fileUpload($request->file('image'), 'student');
        } else {
            $student->image = $request->oldImage;
        }

        $student->save();

        //create user for login
        $user = User::where('id', Auth::id())->firstOrFail();
        $user->name = $request->name;
        $user->alternate_email_user = $request->email;
        $user->image = $student->image;
        $user->save();

        return back();

    }

    public function student_password_update(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|min:8|confirmed',

            ],
            [
                'password.required' => translate('Password is required'),
                'password.min' => translate('Minimum 8 character is required'),
                'password.confirmed' => translate('Password does not match')

            ]            
        );
       Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);
        return back();
    }
    // mark_as_all_read
    public function mark_as_all_read()
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $all_read = NotificationUser::where('user_id', Auth::user()->id)->get();

        foreach ($all_read as $read) {
            NotificationUser::where('user_id', Auth::user()->id)->update([
                'is_read' => true
            ]);
        }

        return back();
    }


    // END


    /*check out*/
    public function enrollCourses(Request $request)
    {
        //return "jjjjjjj";
        if (Auth::user()->user_type != "Student") {
            \auth()->logout();
            return response('Your credentials does not match.', 403);
        }
        $enrollCollection = collect();

        if(isset($request->pkgType) && $request->pkgType!=''){
            $enrolls = Enrollment::where(['user_id'=> Auth::id(),'package_id'=>$request->course_id])->get();
            foreach ($enrolls as $item) {
                $demo = new Demo();
                $demo->course_id = $item->package_id;
                $demo->id = $item->id;
                $demo->link = route('packages.preview_board', $item->package_id);
                $demo->message = translate('Go to Lesson');
                $enrollCollection->push($demo);
            }

        }else{
            $enrolls = Enrollment::where('user_id', Auth::id())->get();
            foreach ($enrolls as $item) {
                if(isset(Course::find($item->course_id)->slug) && Course::find($item->course_id)->slug!=''){
                $demo = new Demo();
                $demo->course_id = $item->course_id;
                $demo->id = $item->id;
                $demo->link = route('lesson_details', Course::find($item->course_id)->slug);
                $demo->message = translate('Go to Lesson');
                $enrollCollection->push($demo);
                }
            }
        }
        return response(['data' => $enrollCollection], 200);
    }

    /*all wishlist*/
    public function wishList()
    {
        if (Auth::user()->user_type != "Student") {
            \auth()->logout();
            return response('Your credentials does not match.', 403);
        }
        $items = Wishlist::with('course')->where('user_id', Auth::id())->get();

        //there are create wish  list
        $wishList = collect();
        foreach ($items as $item) {
            $carts = new Demo();
            $carts->id = $item->id;
            $carts->course_id = $item->course->id;
            $carts->title = Str::limit($item->course->title, 30);
            if ($item->course->is_free == true) {
                $carts->price = formatPrice(0);
            } else {
                if ($item->course->is_discount == true) {
                    $carts->price = formatPrice($item->course->discount_price);
                } else {
                    $carts->price = formatPrice($item->course->price == null ? 0 : $item->course->price);
                }
            }
            $carts->image = filePath($item->course->image);
            $carts->link = route('course.single', $item->course->slug);
            $wishList->push($carts);
        }
        $link = route('my.packages');
        $message = translate('Add to Cart');
        return response(['data' => $wishList, 'link' => $link, 'message' => $message], 200);
    }

    /*add to wishlist*/
    public function addToWishlist(Request $request)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->where('course_id', $request->cart)->first();
        if ($wishlist != null) {
            /*remove wishlist*/
            $wishlist->delete();
            $delete = $request->cart;
        } else {
            $wishlist = new Wishlist();
            $wishlist->user_id = Auth::id();
            $wishlist->course_id = $request->cart;
            $wishlist->save();
            $delete = null;
        }
        /*remove from cart*/
        $cart = Cart::where('user_id', $wishlist->user_id)->where('course_id', $wishlist->course_id)->first();
        if ($cart != null) {
            $cart->delete();
        }
        return response(['id_is' => $delete], 200);
    }

    /*all cart list*/
    public function cartList(Request $request)
    {
        $school_id = Session::get('school_id');

        $b2bpricing_mechanisms = DB::table('b2bpricing_mechanisms')->where('school_id', $school_id)->first();
        if (Auth::user()->user_type != "Student") {
            \auth()->logout();
            return response('Your credentials does not match.', 403);
        }
        $cartList = collect();
        $items = Cart::with('course')->where('user_id', Auth::id())->whereNotNull('course_id')->whereNull('package_id')->get();
        foreach ($items as $cart) {
            $carts = new Demo();
            $carts->id = $cart->id;
            $carts->course_id = $cart->course->ole_refference_id;
            $carts->title = Str::limit($cart->course->title, 30);
            if ($cart->course->is_free == true) {
                $carts->price = formatPrice(0);
            } else {
                if($b2bpricing_mechanisms){
                    if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
                        $cartListValprice = round($cart->course->price + ($cart->course->price * ($b2bpricing_mechanisms->value/100)), 0);            
                    }
                    if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
                        $cartListValprice = round($cart->course->price - ($cart->course->price * ($b2bpricing_mechanisms->value/100)), 0);           
                    } 
                }else{
                    $cartListValprice = round($cart->course->price, 0);
                } 
                $carts->price = formatPrice($cartListValprice);
            }
            // dd($cart->course->ole_refference_id);

            if($cart->course->lms_refference_id == 0 && $cart->course->ole_refference_id > 0){
                $carts->image = "https://olexpert.org.in/public/".$cart->course->image;
            }
            if($cart->course->lms_refference_id > 0 && $cart->course->ole_refference_id > 0){
                $carts->image = "https://courses.iid.org.in/public/".$cart->course->image;
            }
            if($cart->course->ole_refference_id == 0 && $cart->course->lms_refference_id == 0){
                $carts->image = "http://entrepreneurindia.tv/public/".$cart->course->image;
            }


            // $carts->image = filePath($cart->course->image);

            $carts->link = route('course.single', $cart->course->slug);
            $cartList->push($carts);
        }
        $items2 = Cart::leftjoin('package_settings','carts.package_id','package_settings.id')
                        ->select('carts.id as cId','carts.course_price as price','carts.package_id','package_settings.pkg_name','package_settings.pkg_image')
                        ->where('carts.user_id', Auth::id())->whereNull('carts.course_id')->whereNotNull('carts.package_id')->get();
                        
        foreach ($items2 as $cart) 
        {
            $carts = new Demo();
            $carts->id = $cart->cId;
            $carts->course_id = $cart->package_id;
            $carts->title = Str::limit($cart->pkg_name, 30);
            if ($cart->price == 0)
            {
                $carts->price = formatPrice(0);
            }
            else
            {
                if($b2bpricing_mechanisms){
                    if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
                        $cartListValprice = round($cart->price + ($cart->price * ($b2bpricing_mechanisms->value/100)), 0);            
                    }
                    if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
                        $cartListValprice = round($cart->price - ($cart->price * ($b2bpricing_mechanisms->value/100)), 0);           
                    } 
                }else{
                    $cartListValprice = round($cart->price, 0);
                } 
                $carts->price = formatPrice($cartListValprice);
            }
            $carts->image = filePath($cart->pkg_image);
            $carts->link = route('packages.preview_board',$cart->package_id);
            $cartList->push($carts);
        }
        $message = translate('Go to Checkout');
        $link = route('shopping.cart');
 
        // foreach($cartList as $key=>$cartListVal){
            // $cartListValprice = str_replace("₹","",$cartListVal->price);
            // $cartListValprice = str_replace(",","",$cartListValprice);
            // if($b2bpricing_mechanisms){
            //     if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
            //         $cartList[$key]->price = "₹".round($cartListValprice + ($cartListValprice * ($b2bpricing_mechanisms->value/100)), 0);            
            //     }
            //     if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
            //         $cartList[$key]->price = "₹".round($cartListValprice - ($cartListValprice * ($b2bpricing_mechanisms->value/100)), 0);           
            //     } 
            // }else{
            //     $cartList[$key]->price = "₹".round($cartListValprice, 0);
            // } 
        // }
        return response(['data' => $cartList, 'message' => $message, 'link' => $link], 200);
    }

    /*cart the course*/
public function addToCart(Request $request)
{    
    $school_id = \Session::get('school_id');
    $b2bpricing_mechanisms = DB::table('b2bpricing_mechanisms')->where('school_id', $school_id)->first();
    if($b2bpricing_mechanisms){
        if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
            $Mprice = round($request->price + ($request->price * ($b2bpricing_mechanisms->value/100)), 0);            
        }
        if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
            $Mprice = round($request->price - ($request->price * ($b2bpricing_mechanisms->value/100)), 0);           
        } 
    }else{
        $Mprice = round($request->price, 0);
    } 
    
       // return $request->all();
        $cart = null;
        if (Auth::user()->user_type != "Student") {
            \auth()->logout();
            return response('Your credentials does not match.', 403);
        }
        if($request->pkgtype=='pkg'){

                //get course details
                $course = PackageSetting::where('id', $request->cart)->first();
                /*check this have in cart*/
                $p = Cart::where('user_id', Auth::id())->where('package_id', $course->id)->first();

                if ($p != null) 
                {
                    /*nothing is save*/
                } 
                else 
                {
                    //add to cart package_type,service_id,course_id,discount_price
                    $userId             = \Illuminate\Support\Facades\Auth::id();
                    $cart               = new Cart();
                    $cart->user_id      = $userId;
                    $cart->package_id   = $course->id;
                    $cart->course_price = $Mprice;
                    $cart->save();

                    
                    UserAddtocartPackage::create([
                                                    'user_id'       => $userId,
                                                    'package_id'    => $course->id,
                                                    'package_type'  => $request->pkgselectType,
                                                    'discount_price'=> $request->discount_price,
                                                    'total_amount'  => $Mprice,  
                                                    'service_id'    => $request->service_id,
                                                    'course_id'     => $request->course_id,
                                                    'status'        => '0',
                                                ]);

                }
                /*remove from wishlist*/
                $wishlist = Wishlist::where('user_id', Auth::id())->where('package_id', $course->id)->first();
                if ($wishlist != null) {
                    $wishlist->delete();
                }

    }else{


                //get course details
                $course = Course::where('ole_refference_id', $request->cart)->first();

                /*check this have in cart*/
                $p = Cart::where('user_id', Auth::id())->where('course_id', $course->id)->first();

                if ($p != null) {
                    /*nothing is save*/
                } else {
                    //add to cart
                    $cart = new Cart();
                    $cart->user_id = \Illuminate\Support\Facades\Auth::id();
                    $cart->course_id = $course->id;
                    if ($course->is_free == true) {
                        $cart->course_price = 0;
                    } else {
                        if ($course->is_discount == true) {
                            $cart->course_price = $course->discount_price;
                        } else {
                            $cart->course_price = $course->price == null ? 0 : $course->price;
                        }

                    }
                    $cart->save();
                }
                /*remove from wishlist*/
               /* $wishlist = Wishlist::where('user_id', Auth::id())->where('course_id', $course->id)->first();
                if ($wishlist != null) {
                    $wishlist->delete();
                }
                */

    }
        return $cart;
}




    
    /*add to cart remove*/
    public function removeCart($id)
    {
        session()->forget('coupon');
        session()->forget('FIRST_COURSE_FREE');
        $carts = Cart::where('user_id', Auth::id())->where('id', $id)->delete();
        return back();
    }

    /*add to cart remove*/
    public function removePKGCart($id)
    {
        session()->forget('coupon');
        session()->forget('FIRST_COURSE_FREE');
        $packageId = Cart::where('user_id', Auth::id())
                        ->where('id', $id)
                        ->first();
        if($packageId){
        UserAddtocartPackage::where('user_id', Auth::id())
                            ->where('package_id', $packageId->package_id)
                            ->delete();
        $carts = Cart::where('user_id', Auth::id())
                        ->where('id', $id)
                        ->delete();
        }
        
                        //echo "HERE";exit;
        return back();
    }

    public function removePackageCart(Request $request)
    {
        $packageId = Cart::where('user_id', $request->user_id)
                        ->where('package_id', $request->package_id)
                        ->first();
        if($packageId){
            UserAddtocartPackage::where('user_id', $request->user_id)
                            ->where('package_id', $packageId->package_id)
                            ->delete();
            $carts = Cart::where('user_id', Auth::id())
                        ->where('id', $packageId->id)
                        ->delete();
            return response(['message' => 'success'], 200);
        }
        
        return response(['message' => 'not found'], 200);
    }

    /*Shopping car View page*/
  public function shoppingCart(Request $request)
    {

        //return $request->courses;
        if ($request->courses != null){
            if(session()->has('FIRST_COURSE_FREE')){
                $firstCourseFree = true;
            }else{
                $firstCourseFree = false;
            }
            $cartList = collect();
            
            $items = Cart::with('course')->where('user_id', Auth::id())->whereNotNull('course_id')->whereNull('package_id')->get();
            foreach ($items as $cart) {
                $catDetail = Category::where('id',$cart->course->category_id)->first();
                $parentcatDetail = Category::where('id',$catDetail->parent_category_detail)->first();
                $carts = new Demo();
                $carts->id = $cart->id;
                $carts->course_id = $cart->course->id;
                $carts->title = Str::limit($cart->course->title, 30);
                if ($cart->course->is_free == true) {
                    $carts->price = 0;
                } else {
                    if ($cart->course->is_discount == true) {
                        $carts->price = $cart->course->discount_price;
                    } else {
                        $carts->price = $cart->course->price == null ? 0 : $cart->course->price;
                    }

                }
                if($carts->price>0 && $firstCourseFree)
                {
                    $carts->price = 0;
                    $firstCourseFree = false;
                    // $cartDetail = Cart::find($cart->id);
                    // $cartDetail->course_price = 0;
                    // $cartDetail->save();
                }
                // $carts->image = filePath($cart->course->image);

                
                // dd($cart->course);
                
                // if($cart->course->lms_refference_id == 0 && $cart->course->ole_refference_id > 0){
                //     $carts->image = "https://olexpert.org.in/public/".$cart->course->image;
                // }
                // if($cart->course->lms_refference_id > 0 && $cart->course->ole_refference_id > 0){
                //     $carts->image = "https://courses.iid.org.in/public/".$cart->course->image;
                // }
                // if($cart->course->ole_refference_id == 0 && $cart->course->lms_refference_id == 0){
                //     $carts->image = "http://entrepreneurindia.tv/public/".$cart->course->image;
                // } 

                $carts->link = route('course.single', $cart->course->slug);
                $carts->item_type = 'course';
                $carts->course = $cart->course;
                $carts->package_type = ($cart->course->content_type=='free-study-material')?'Free Study Material':$cart->course->content_type;
                $carts->parent_category_name = $parentcatDetail?$parentcatDetail->name:'';
                $carts->category_name = $catDetail->name;
                $cartList->push($carts);
            }
            $items2 = Cart::leftjoin('package_settings','carts.package_id','package_settings.id')
                            ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
                            ->select('carts.id as cId','carts.course_price as price','carts.package_id','package_settings.pkg_name','package_settings.pkg_image','package_settings.package_type','subCat.name as subName','package_settings.category_id')
                            ->where('carts.user_id', Auth::id())->whereNull('carts.course_id')->whereNotNull('carts.package_id')->get();
            foreach ($items2 as $cart) 
            {
                $parentcatDetail = Category::where('id',$cart->category_id)->first();
                $carts = new Demo();
                $carts->id = $cart->cId;
                $carts->course_id = $cart->package_id;
                $carts->title = Str::limit($cart->pkg_name, 30);
                if ($cart->price == 0)
                {
                    $carts->price = 0;
                }
                else
                {
                    $carts->price = $cart->price;
                }
                if($carts->price>0 && $firstCourseFree)
                {
                    $carts->price = 0;
                    $firstCourseFree = false;
                    // $cartDetail = Cart::find($cart->cId);
                    // $cartDetail->course_price = 0;
                    // $cartDetail->save();
                }
                // dd($cart);
                $carts->image = filePath($cart->pkg_image);
                $carts->link = route('packages.preview_board',$cart->package_id);
                $carts->item_type = 'package';
                $carts->package_type = $cart->package_type;
                $carts->category_name = $cart->subName;
                $carts->parent_category_name = $parentcatDetail?$parentcatDetail->name:'';
                $cartList->push($carts);
            }
            
            $school_id = Session::get('school_id');

            $b2bpricing_mechanisms = DB::table('b2bpricing_mechanisms')->where('school_id', $school_id)->first();

            if ($cartList->count() > 0) {
                return view($this->theme.'.cart.index', compact('cartList','b2bpricing_mechanisms'));
            }else{
                return view($this->theme.'.cart.index');
            }            
        }else{
            return  redirect()->route('shopping.cart',['courses'=>'ok']);
        }

    }


    /*remove from wishlist*/
    public function removeWishlist($id)
    {
        Wishlist::destroy($id);
        return response('', 200);
    }

    /*checkout this is common feature*/
    public function checkout(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

      

        $amount = 0;
        /*check this have session data, if not user logout*/
        $value = $request->session()->get('payment');
        $payment_type = $request->session()->get(walletName());
        if ($value != null) {

            /*get data from cart and delete from cart Add in,
                   Enrollment and save purchase history*/
            $carts = Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
            if ($carts->count() > 0) {
                foreach ($carts as $cart) {

                    /*if this course in wishlist delete it*/
                    Wishlist::where('user_id', Auth::id())->where('course_id', $cart->course_id)->delete();

                    //todo::there are calculate the Instructor balance Calculate the admin or Instructor commission
                   
                    if($cart->course_id!=''){
                        $course = Course::findOrFail($cart->course_id);
                        $instructor = Instructor::where('user_id', $course->user_id)->first(); //get instructor
                        $package = array();
                        if(isset($instructor->package_id)){
                            $package = Package::findOrFail($instructor->package_id);//get instructor package commission
                        }
                   
                        $admin_get = 0;
                        $instructor_get = 0;
                        if ($cart->course_price != 0 && $cart->course_price != null) {
                            $admin_get = ($cart->course_price * $package->commission) / 100; //$admin commission
                            $instructor_get = ($cart->course_price - $admin_get); //instructor amount
                            /*todo::refer calculate*/
                            $amount += ($cart->course_price * commission()) / 100; //
                        }


                        //admin earning
                        //Todo::Admin Earning calculation
                        $admin = new AdminEarning();
                        $admin->amount = $admin_get;
                        $admin->purposes = "Commission from enrolment";
                        $admin->save();

                        // instructor get notification
                        $details = [
                            'body' => translate($course->title . ' this course enrolled by ' . Auth::user()->name),
                        ];
                        $this->userNotify($course->user_id, $details);

                         //save in enrolments table
                         $enrollment = new Enrollment();
                         $enrollment->user_id = $cart->user_id; //this is student id
                         $enrollment->course_id = $cart->course_id;
                         $enrollment->save();

                        //todo::Instructor Earning history
                        //instructor Earning
                        $instructorEarning = new InstructorEarning();
                        $instructorEarning->enrollment_id = isset($enrollment->id)?$enrollment->id:0;
                        $instructorEarning->package_id = isset($package->id)?$package->id:0;
                        $instructorEarning->user_id = isset($instructor->user_id)?$instructor->user_id:0; //instructor user_id
                        $instructorEarning->course_price = $cart->course_price == null ? 0 : $cart->course_price;
                        $instructorEarning->will_get = $instructor_get;
                        $instructorEarning->save();

                        //todo::update the instructor balance
                        //$instructor->balance += $instructor_get;
                        //$instructor->save();

                        //save in purchase history
                        $history = new CoursePurchaseHistory();
                        $history->enrollment_id = isset($enrollment->id)?$enrollment->id:0;
                        if(session()->has('FIRST_COURSE_FREE')){
                            $history->amount = 0;
                            session()->forget('FIRST_COURSE_FREE');
                        }else{
                            $history->amount = $cart->course_price == null ? 0 : $cart->course_price;
                        }
                        
                        $history->payment_method = $request->session()->get('payment'); //todo::must be change here
                        $history->save();
                    }

                   
                    if($cart->package_id!=''){
                        $packageDetail = PackageSetting::find($cart->package_id);
                        $chkType = UserAddtocartPackage::where('user_id','=',$cart->user_id)
                            ->where('package_id','=',$cart->package_id)
                            ->where('status','=','0')->latest()->first();
                            $startDate =  Carbon::now();
                            $couponName = '';
                            if(Session::has('coupon')){
                                $couponName = session()->get('coupon')['name'];
                                $getCouponDetailes  = Session::get('coupon');
                                $couponCode         = $getCouponDetailes['name'];
                                $couponDetailes     = Coupon::where('code','=',$couponCode)->first();
                                if($couponDetailes->discount_type=='F'){
                                    $couponPriceValue   = $couponDetailes->rate;
                                }elseif($couponDetailes->discount_type=='P'){
                                    $couponPriceValue = ($getCouponDetailes['total']*$couponDetailes->rate)/100;
                                }
                                $coupon_id          = $couponDetailes->id;
                                $orderTotal         = $getCouponDetailes['total'];
                            }else{
                                $couponCode         = null;
                                $coupon_id          = null;
                                $couponPriceValue   = null;
                                $orderTotal         = 0;
                            }
                            $transaction_date =  Carbon::now();
                            $orderDetails = new OrderDetail();
                            $orderDetails->user_id = Auth::id(); //this is student id
                            $orderDetails->order_total = $orderTotal;
                            $orderDetails->discount_amount = $couponPriceValue;
                            $orderDetails->coupon_id = $coupon_id;
                            $orderDetails->coupon_code = $couponCode;
                            $orderDetails->is_refund = '';
                            $orderDetails->refund_amount = '';
                            $orderDetails->transaction_id = 'NO TRANSACTION';
                            $orderDetails->transaction_amount = 0;
                            $orderDetails->transaction_status = 'FREE';//$transaction->response('txnStatus');
                            $orderDetails->transaction_date = $transaction_date;
                            $orderDetails->transaction_type = 'COUPON APPLIED';
                            $orderDetails->transaction_mode = 'ONLINE';
                            $orderDetails->save();

                            if($couponName=='LAUNCH100'){
                                $future_timestamp = strtotime("+3 month");
                                $enddata = date('Y-m-d', $future_timestamp);
                                session()->forget('coupon');
                            }else{
                                if($chkType->package_type==3){
                                    $future_timestamp = strtotime("+3 month");
                                    $enddata = date('Y-m-d', $future_timestamp);
                                // strtotime('-1 day', strtotime($date)
                                    $enddata = date("Y-m-d", strtotime('-1 day', strtotime($enddata)));

                                }else if($chkType->package_type==2){
                                    $future_timestamp = strtotime("+6 month");
                                    $enddata = date('Y-m-d', $future_timestamp);
                                    $enddata = date("Y-m-d", strtotime('-1 day', strtotime($enddata)));
                                }else{
                                    if(Session::has('coupon')){
                                        $coupon = session()->get('coupon')['name'];
                                    }
                                    $future_timestamp = strtotime("+12 month");
                                    $enddata = date('Y-m-d', $future_timestamp);
                                    $enddata = date("Y-m-d", strtotime('-1 day', strtotime($enddata)));
                                }
                            }

                            $enrollment = new Enrollment();
                            $enrollment->user_id = $cart->user_id; //this is student id
                            $enrollment->course_id = $cart->course_id;
                            $enrollment->package_id = $cart->package_id;
                            $enrollment->order_detail_id = $orderDetails->id;
                            $enrollment->type = 1;
                            $enrollment->start_date = $startDate;
                            $enrollment->end_date = $enddata;
                            $enrollment->save();

                            
                            UserAddtocartPackage::where('user_id','=',$cart->user_id)
                            ->where('package_id','=',$cart->package_id)
                            ->update(['enrollment_id'=>$enrollment->id,
                            'status'=>'1']);

                            $history = new CoursePurchaseHistory();
                            $history->enrollment_id = $enrollment->id;
                            if(session()->has('FIRST_COURSE_FREE')){
                                $history->amount = 0;
                                session()->forget('FIRST_COURSE_FREE');
                            }else{
                                $history->amount = $cart->course_price == null ? 0 : $cart->course_price;
                            }
                            
                            $history->payment_method = $request->session()->get('payment'); //todo::must be change here
                            $history->save();
                    
                    }

                    // student get notification
                    if(isset($course) && $course->title!=''){
                        $details = [
                            'body' => translate('You enrolled new course  ' . $course->title),
                        ];
                        $this->userNotify($enrollment->user_id, $details);
                    }else{
                        $details = [
                            'body' => translate('You enrolled for package  ' . $packageDetail->pkg_name),
                        ];
                        $this->userNotify($enrollment->user_id, $details);
                    }
                   

                    


                    //todo::mail Admin, Instructor, Student
                    try {
                        //teacher
                        //$user = User::find($instructorEarning->user_id);
                        //$user->notify(new EnrolmentCourse());
                        //student
                        $user = User::find($enrollment->user_id);
                        $user->notify(new EnrolmentCourse());

                    } catch (\Exception $exception) {
                    }

                    //delete from cart
                    $cart->delete();


                }

                /*todo::affiliate commission calculate*/
                $req = $request->cookie('ref');
                if ($req != null && affiliateStatus()) {
                    $affiliate = Affiliate::where('refer_id', $req)->first();
                    $affiliate->balance += $amount;
                    $affiliate->save();

                    /*save affiliate history*/
                    $history = new AffiliateHistory();
                    $history->affiliate_id = $affiliate->id;
                    $history->user_id = \Illuminate\Support\Facades\Auth::id();
                    $history->refer_id = $req;
                    $history->amount = $amount;
                    $history->save();

                    /*send affiliate commission*/
                    try {
                        $user = User::where('id', $affiliate->user_id)->first();
                        $user->notify(new AffiliateCommission());
                    }catch (\Exception $exception){}
                }
            } else {
                /*empty the session*/
                $request->session()->forget('payment');


                if(subscriptionActive())
                {

                    $subscriptionCarts = SubscriptionCart::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();

                    $subscriptionEnroll = SubscriptionEnrollment::where('subscription_package', $subscriptionCarts->subscription_package)
                        ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                        ->first();

                    if ($subscriptionEnroll != null) {
                        $subscriptionEnroll->delete();
                    }

                    //save in enrolments table
                    $subscriptionEnrollment = new SubscriptionEnrollment();
                    $subscriptionEnrollment->user_id = $subscriptionCarts->user_id; //this is student id
                    $subscriptionEnrollment->subscription_package = $subscriptionCarts->subscription_package;
                    $subscriptionEnrollment->subscription_price = $subscriptionCarts->subscription_price;
                    $subscriptionEnrollment->start_at = Carbon::now();
                    $subscriptionEnrollment->end_at = $subscriptionCarts->end_at;
                    $subscriptionEnrollment->save();

                    SubscriptionCart::where('user_id', \Illuminate\Support\Facades\Auth::id())->delete();

                    //admin earning
                    //Todo::Admin Earning calculation
                    $admin = new AdminEarning();
                    $admin->amount = $subscriptionCarts->subscription_price;
                    $admin->purposes = "Subscription Payment";
                    $admin->save();

                    // student get notification
                    $details = [
                        'body' => translate('You enrolled package'),
                    ];
                    $this->userNotify($subscriptionEnrollment->user_id, $details);

                    // instructor get notification
                    $details = [
                        'body' => translate(' this Package enrolled by ' . Auth::user()->name),
                    ];

                    try {
                        $this->userNotify($subscriptionEnrollment->user_id, $details);
                    }catch (\Exception $exception){}

                    Session::flash('message', translate('Congratulations, Your subscription is done successfully.'));
                    return redirect()->route('my.subscription.package.course', $subscriptionEnrollment->subscription_package);
                }

                return redirect()->to('/');
            }

            /*empty the session*/

        if($payment_type)
        {

            try {
                 if (walletActive()) {
                // Paid Course Point
                $request->session()->forget(walletName());
                addWallet(paidPoint(), translate('Paid Course Enroll point'));
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

        }

            
            
           
            session()->forget('FIRST_COURSE_FREE');
            $request->session()->forget('payment');
        } else {
            \auth()->logout();
        }
        Session::flash('message', translate('Congratulations, Your enrollment is done successfully.'));
        return redirect()->route('student.profile');


    }



    /*affiliate this is common feature*/
    /*affiliate page view*/
    public function affiliateCreate(){

        
        /*here show affiliate history table*/
        $history =null;
        $payment =null;
        $affiliate= \App\Model\Affiliate::where('user_id',Auth::id())->first();
        if ($affiliate){
            $history = AffiliateHistory::where('refer_id',$affiliate->refer_id)->with('user')->paginate(5);//there student id is user id
            $payment =AffiliatePayment::where('status','Confirm')->where('user_id',Auth::id())->paginate(5);
        }
        return view($this->theme.'.homepage.affiliate.index',compact('affiliate','history','payment'));
    }

    /*affiliate request modal screen*/
    public function affiliateRequest(){
        $account = StudentAccount::where('user_id', Auth::id())->first();
        if ($account == null) {
            return view($this->theme.'.homepage.affiliate.request', compact('account'));
        }
        return view($this->theme.'.homepage.affiliate.request', compact('account'));
    }

    /*account save */
    public function affiliateStore(Request $request){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        if ($request->has('id')) {
            $account = StudentAccount::where('id', $request->id)->where('user_id', Auth::id())->first();
            $account->bank_name = $request->bank_name;
            $account->account_name = $request->account_name;
            $account->account_number = $request->account_number;
            $account->routing_number = $request->routing_number;
            $account->paypal_acc_name = $request->paypal_acc_name;
            $account->paypal_acc_email = $request->paypal_acc_email;
            $account->stripe_acc_name = $request->stripe_acc_name;
            $account->stripe_acc_email = $request->stripe_acc_email;
            $account->stripe_card_holder_name = $request->stripe_card_holder_name;
            $account->stripe_card_number = $request->stripe_card_number;
            $account->save();

        } else {
            $account = new StudentAccount();
            $account->bank_name = $request->bank_name;
            $account->account_name = $request->account_name;
            $account->account_number = $request->account_number;
            $account->routing_number = $request->routing_number;
            $account->paypal_acc_name = $request->paypal_acc_name;
            $account->paypal_acc_email = $request->paypal_acc_email;
            $account->stripe_acc_name = $request->stripe_acc_name;
            $account->stripe_acc_email = $request->stripe_acc_email;
            $account->stripe_card_holder_name = $request->stripe_card_holder_name;
            $account->stripe_card_number = $request->stripe_card_number;
            $account->user_id = Auth::id();
            $account->save();
            /*create affiliate details*/
            $af = new \App\Model\Affiliate();
            $af->user_id = Auth::id();
            $af->student_account_id = $account->id;
            $af->note = $request->note;
            $af->save();
        }

        alert(translate('Success'),translate('Wait for confirmation'),'success');
        return back();
    }

    /*affiliatePaymentRequest*/
    public function affiliatePaymentRequest(){

        $affiliate = \App\Model\Affiliate::where('user_id', Auth::id())->firstOrFail();
        return view($this->theme.'.homepage.affiliate.create',compact('affiliate'));
    }

    /*affiliate payment store*/
    public function affiliatePaymentStore(Request $request){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }


        if (!$request->has('amount')){
            alert(translate('warning'),translate('Amount must be required'),'info');
            return back();
        }

        if ($request->amount < withdrawLimit()) {
            alert(translate('warning'),translate('You minimum Withdrawal is').withdrawLimit(),'info');
            return back();
        }

        $account = StudentAccount::where('user_id', Auth::id())->first();
        if ($account == null) {
            alert(translate('warning'),translate('Please Insert the withdrawal method '),'info');
            return back();
        }
        $ins = \App\Model\Affiliate::where('user_id', Auth::id())->first();
        if ($ins->balance < $request->amount) {
            alert(translate('warning'),translate('Please insert the valid withdrawal amount '),'info');
            return back();
        }

        /*minus from */
        $ins->balance -=(int)$request->amount;
        $ins->save();

        $payment = new AffiliatePayment();
        $payment->amount = $request->amount;
        $payment->process = $request->process;
        $payment->description = $request->description;
        $payment->status = $request->status;
        $payment->status_change_date = Carbon::now();
        $payment->user_id = Auth::id();
        $payment->affiliate_id = $ins->id;
        $payment->student_account_id = $account->id;
        $payment->saveOrFail();

        $details = [
            'body' => translate('Your payment request is successfully done.'),
        ];

        /* sending instructor notification */
        $this->userNotify(Auth::id(), $details);
        \alert(translate('success'),translate('Payment request sent successfully'),'success');
        return back();
    }



    /*instructor traits*/
    // Instructor details
    public function instructorDetails($slug)
    {
        $user = User::where('slug', $slug)->where('user_type', 'Instructor')->first();

        if ($user == null) {
            Session::flash('message', translate('404 Not Found'));
            return back();
        }
        $courses = Course::Published()->where('user_id', $user->id)->paginate(9);
        $instructor = Instructor::where('user_id', $user->id)->first();
        return view($this->theme.'.instructor.index', compact('instructor', 'courses'));
    }

    /*register view*/
    public function registerView()
    {
        $packages = Package::where('is_published', true)->first();
        return view($this->theme.'.instructor.register', compact('packages'));
    }

    /*register create*/
    public function registerCreate(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'package_id' => 'required',
            'name' => 'required',
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'min:8'],
            'confirm_password' => 'required|required_with:password|same:password',
        ], [
            'package_id.required' => translate('Please select a package'),
            'name.required' => translate('Name is required'),
            'email.required' => translate('Email is required'),
            'email.unique' => translate('Email is already exist.'),
            'password.required' => translate('Password is required'),
            'password.min' => translate('Password must be minimum 8 characters'),
            'confirm_password.required' => translate('Please confirm your password'),
            'confirm_password.same' => translate('Password did not match'),
        ]);
        /*get package value*/
        $package = Package::where('id', $request->package_id)->firstOrFail();
        //create user for login

        $slug_name = Str::slug($request->name);
        /*check the sulg */
        $users = User::where('slug', $slug_name)->get();
        if ($users->count() > 0) {
            $slug_name = $slug_name.($users->count() + 1);
        }
        $user = new User();
        $user->slug = $slug_name;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->user_type = 'Instructor';
        $user->is_external = $request->is_external;
        $user->save();

        //save data in instructor
        $instructor = new Instructor();
        $instructor->name = $request->name;
        $instructor->email = $request->email;
        $instructor->package_id = $request->package_id;
        $instructor->user_id = $user->id;
        $instructor->is_external = $request->is_external;
        $instructor->save();

        /*get package payment*/
        if ($package->price > 0) {

            return redirect()->route('instructor.payment', $user->slug);
        } else {
            /**/

            //add purchase history
            $purchase = new PackagePurchaseHistory();
            $purchase->amount = $package->price;
            $purchase->payment_method = $request->payment_method;
            $purchase->package_id = $request->package_id;
            $purchase->user_id = $user->id;
            $purchase->save();


            //todo::admin Earning calculation
            $admin = new AdminEarning();
            $admin->amount = $package->price;
            $admin->purposes = "Sale Package";
            $admin->save();

            try {

                $user->notify(new InstructorRegister());

                VerifyUser::create([
                    'user_id' => $user->id,
                    'token' => sha1(time())
                ]);
                //send verify mail
                $user->notify(new VerifyNotifications($user));
            } catch (\Exception $exception) {

            }
        }

        Session::flash('message', translate("Registration done successfully. Please verify your email before login."));
        return redirect()->route('login');
    }

    /*payment screen view*/
    public function insPayment($slug)
    {
        $userI = User::where('slug', $slug)->where('user_type', 'Instructor')->first();
        if ($userI == null) {
            Session::flash('message', translate('You are wrong user'));
            return back();
        }
        $user = Instructor::with('relationBetweenPackage')->where('user_id', $userI->id)->first();

        //check package payment history
        $history = PackagePurchaseHistory::where('user_id', $user->id)->where('package_id', $user->package_id)->first();
        if ($history != null) {
            return redirect()->route('login');
        } else {
            return view($this->theme.'.instructor.payment', compact('user'));
        }
    }



    /*student trait*/
    public function my_courses()
    {
        //enroll courses
        $enrolls = Enrollment::with('enrollCourse')->where(['user_id'=>Auth::id(),'type'=>'0'])->orderBy('id','desc')->paginate(6);
        return view($this->theme.'.course.my_courses', compact('enrolls'));
    }

    public function my_wishlist(){
        //wishlist courses
        $wishlists = Wishlist::with('course')->where('user_id', Auth::id())->paginate(6);
        return view($this->theme.'.course.wishlist', compact( 'wishlists'));
    }

    public function my_packages()
    {
        //enroll packages        
        $enrolls = Enrollment::with(['enrollPackage','enrollCartPackage'])->where(['user_id'=>Auth::id(),'type'=>'1'])->orderBy('created_at','desc')->paginate(21);
      // echo '<pre>';  print_r($enrolls); die;
        // $getData    = PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
        //                             ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
        //                             ->join('courses as c','c.id','=','package_settings.course_id')
        //                             ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title','c.big_description','c.short_description')
        //                             ->where('package_settings.id','=',$id)
        //                             ->orderBy('id', 'DESC')->first();

        return view($this->theme.'.course.my_packages', compact('enrolls'));
    }


    public function package_detail($enrollId)
    {
         $getEnrollData = UserAddtocartPackage::where('enrollment_id','=',$enrollId)->first();
        //echo "<pre>";print_r($getEnrollData);die;


  
        //$idGet = explode('_',$id);
        //$cGetId = 'qtr';
        $service_id     = explode(',',$getEnrollData->service_id);
        $getService     = Service::whereIn('id',$service_id)
                                         ->where('status','=','1')
                                         ->get(); 
        
        $getData    = PackageSetting::where('id','=',$getEnrollData->package_id)
                                    ->first();
        $course_id  = explode(',',$getEnrollData->course_id);
        //$$s_course  = Course::whereIn()

        //$l_courses      = Course::Published()->latest()->take(3)->get(); // single course details
        //$sug_courses    = Course::Published()->take(8)->get()->shuffle(); // suggession courses
        $s_course       = Course::Published()->whereIn('id', $course_id)->with('classes')
                                ->orderBy('title', 'ASC')->first(); // single course details
       // return $s_course->classes;
        $count=0;
       // return $s_course;
        if(isset($s_course)){
            foreach($s_course->classes as $val){
                $count+=$val->contents->count();

            }
        } 
        $count = $count;                   

        return view($this->theme.'.packages.preview_board',compact('count','getData','cGetId','getAddon','s_course', 'l_courses', 'sug_courses'));




        return $getData;
        
    }

    /*Calculate the seen course percentage enroll course*/
    public static function seenCourse($id, $course_id)
    {
        $seen_content = SeenContent::where('user_id', Auth::id())->where('enroll_id', $id)->get()->count();
        $course = Course::where('id', $course_id)->with('classes')->first();

        $total_content = 0;
        foreach ($course->classes as $item) {
            $total_content += $item->contents->count();
        }


        // calculate the % done this enroll course
        if ($seen_content > 0 && $total_content!= 0) {
            $percentage = ($seen_content / $total_content) * 100;
            $percentage = $percentage > 100 ? 100 : $percentage;
        } else {
            $percentage = 0;
        }

        return number_format($percentage);
    }

    /*Course Commenting authenticated */
    public function comments(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        if ($request->comment_id != null) {
            $comment = new CourseComment();
            $comment->course_id = $request->course_id;
            $comment->user_id = Auth::id();
            $comment->comment = $request->comment;
            $comment->replay = $request->comment_id;
            $comment->save();
        } elseif ($request->comment != null) {
            $comment = new CourseComment();
            $comment->course_id = $request->course_id;
            $comment->user_id = Auth::id();
            $comment->comment = $request->comment;
            $comment->save();
        } else {
        }
        $c = CourseComment::where('course_id', $request->course_id)
            ->with('user')->get();

        $comments = collect();
        foreach ($c as $item) {
            $demo = new Demo();
            $demo->name = $item->user->name;
            $demo->image = $item->user->image != null ? filePath($item->user->image) : asset('uploads/user/user.png');
            $demo->comment = $item->comment;
            $demo->time = $item->created_at->diffForHumans();
            $comments->push($demo);
        }
        return response(['data' => $comments], 200);
    }


    /*message modal view this function need enroll id*/
    public function messageCreate($id)
    {
        $enroll = Enrollment::where('course_id', $id)->where('user_id', Auth::id())->first();
        return view($this->theme.'.message.create', compact('enroll'));
    }

    /*Send message to instructor inbox*/
    public function sendMessage(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $message = new Massage();
        $message->enroll_id = $request->enroll_id;
        $message->user_id = Auth::id();
        $message->content = $request->message;
        $message->save();

        return back();
    }

    /*Enroll Course ways messages List*/
    public function inboxMessage()
    {
        $enrolls = Enrollment::where('user_id', Auth::id())->with('messages')->get();
        $ids = array();
        foreach ($enrolls as $item) {
            if ($item->messages->count() > 0) {
                $ids = array_merge($ids, [$item->id]);

            }
        }
        $messages = Enrollment::whereIn('id', $ids)->with('enrollCourse')
            ->with('messages')->get();
        return view($this->theme.'.message.index', compact('messages'));
    }


    /*single content*/
    public function singleContent($id)
    {
        $content = ClassContent::find($id);
        $demo = new Demo();
        if($content->content_type == 'Video'){
            $demo->provider = $content->provider;
            $demo->description = $content->description;
            if ($content->provider == "Youtube") {
                $demo->url = Str::after($content->video_url, 'https://youtu.be/');
            } elseif ($content->provider == "Vimeo") {
                $demo->url = Str::after($content->video_url, 'https://vimeo.com/');
            } elseif ($content->provider == "File") {
                $demo->url = asset($content->video_url);
            } elseif ($content->provider == "Live") {
                $demo->url = $content->video_url;
            } else{
                $demo->provider = "HTML5";
                $demo->url = $content->video_url;
            }
        }elseif ($content->content_type == 'Quiz'){
            /*if quiz is done then show the score*/
            $scores = QuizScore::where('quiz_id',$content->quiz_id)
                ->where('content_id',$content->id)
                ->where('user_id',Auth::id())->first();

            if ($scores != null){
                $demo->provider = $content->content_type;
                $demo->url = route('quiz.score.show',$scores->id);
            }else{
                $demo->provider = $content->content_type;
                $demo->url = route('start',[$content->quiz_id,$content->id]);
            }
        }
        else{
            if($content->file!='' || $content->video_url){
                $demo->provider = $content->content_type;
                $demo->description = $content->description;
                $demo->item1 = translate('Content document');
                $demo->item2 = translate('Download');
                $demo->url = filePath($content->file);
            }else{
                $demo->provider = '';
                $demo->description = '';
                $demo->item1 = translate('Content document');
                $demo->item2 = '';
                $demo->url = '';
            }
            
        }


        $course_id = Classes::where('id', $content->class_id)->first()->course_id;


        if(!request()->is('subscription/*')){
            $isEnroll = Enrollment::where('course_id', $course_id)->where('user_id', Auth::id())->first();
            if($isEnroll){
                $enroll_id = $isEnroll->id;
            }else{
                $enroll_id = 0;
            }
        }else{
            $enroll_id = SubscriptionEnrollment::where('user_id', Auth::id())->first()->id;
        }

        $seens = SeenContent::where('class_id', $content->class_id)
            ->where('content_id', $content->id)
            ->where('course_id', $course_id)->where('enroll_id', $enroll_id)->where('user_id', Auth::id())->get();
        if ($seens->count() == 0) {
            $seen = new SeenContent();
            $seen->class_id = $content->class_id;
            $seen->content_id = $content->id;
            $seen->course_id = $course_id;
            $seen->enroll_id = $enroll_id;
            $seen->user_id = Auth::id();
            $seen->saveOrFail();
        }
        return response()->json($demo);
    }


    /*seen list*/
    public function seenList($id){
        $seen = SeenContent::where('course_id',$id)->where('user_id',Auth::id())->get();
        return response()->json($seen);
    }

    /*delete seen by content id*/
    public function seenRemove($id){
        $seen = SeenContent::where('content_id',$id)->where('user_id',Auth::id())->first();
        if ($seen){
            $seen->delete();
        }
        return response('ok done',200);
    }

    /*single blog*/
    public function singleBlog($id)
    {
        
        $blog = Blog::where('blog_slug',$id)->first();
        $blogs = Blog::where('is_active',1)->where('category_id',$blog->category_id)->orderBy('created_at','desc')->get();
        $categories = Category::where('is_published', 1)->get();
       
        $pageMeta =[];           
        $setTags ='';
        if($blog->tags)  {
            $getTag = json_decode($blog->tags);
            $setTags = implode(', ', $getTag); 
        }                       
        $pageMeta['meta_title'] = $blog->title;
      
        $pageMeta['meta_description'] = Str::limit(strip_tags($blog->body) , 70);
        $pageMeta['tag'] = $setTags;
        
        return view($this->theme . '.blog.details', compact('blog','categories','blogs','pageMeta'));
    }

    /*all posts*/
    public function blogPosts(Request $request)
    {
        $categories = Category::where('is_published', 1)->get();
        $blogs = null;
        if ($request->get('search')) {
            $search = $request->search;
            $blogs = Blog::where('is_active',1)->where('name', 'like', '%' . $search . '%')->orderBy('id','desc')->get();
        } else {
            $blogs = Blog::where('is_active',1)->orderBy('id','desc')->paginate(16);
        }
        
      
        return view($this->theme . '.blog.posts', compact('blogs', 'categories'));
    }

    /*categoryBlog*/
    public function categoryBlog($id)
    {
        $categories = Category::where('is_published', 1)->get();
        $blogs = Blog::where('is_active',1)->where('category_id', $id)->paginate(5);
        return view($this->theme . '.blog.posts', compact('blogs', 'categories'));
    }


    public function tagBlog($tag)
    {
        $categories = Category::where('is_published', 1)->get();
        $blogs = Blog::where('is_active',1)->where('tags', 'like', '%' . $tag . '%')->paginate(5);
        return view($this->theme . '.blog.posts', compact('blogs', 'categories'));
    }

    public function bookfreeclass()
    {       
       return view($this->theme . '.book-free-class.index');
    }

    public function bookfreeclassStore(Request $request)
    {
        $request->validate(
            [
                'student_name' => 'required',
                'parent_name' => 'required',
                'class' => 'required',
                'parent_mobile'=>'required|digits:10',
                
            ],
           [
               'student_name.required' => 'Student Name is required',
               'parent_name.required' => 'Parent Name is required',
               'class.required' => 'Class is required',
               'parent_mobile.required' => 'Parent Mobile is required',
               'parent_mobile.digits' => 'Mobile no. is only 10 digit',
               ]
        );

      $bookfreeclass=  new BookFreeClass();
      $bookfreeclass->parent_mobile=$request->parent_mobile;
      $bookfreeclass->parent_name=$request->parent_name;
      $bookfreeclass->student_name=$request->student_name;
      $bookfreeclass->class=$request->class;
      $bookfreeclass->save();
      Session::flash('message',  $bookfreeclass->parent_name.' has booked Free class successfully.');
      return back();
    }
    public function getIIDCoursesData(){
        //echo "HERE";exit;
        $ch = curl_init('https://courses.iid.org.in/api/category/industrial-courses?limit=10'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0',
            'Access-Control-Allow-Origin: *'
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch); 
        $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);      
        curl_close($ch);
        $all_courses = array(); 
        if($status==200){
            $courses_data = json_decode($data);
            $all_courses = $courses_data->data;
        }
        $courses = array(); 
        foreach($all_courses as $course) {
            $courses = $course;
        }         
        return view($this->theme.'.course.course_iid',
            compact('courses'));
    }

    public function payuPayment(Request $request) 
    {
        //return $request->all();

        if ($request->txnStatus == "SUCCESS") {

            //$carts = Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
            $carts = Cart::with('course')->where('user_id', Auth::id())->whereNotNull('course_id')->whereNull('package_id')->get();
           //Coupon Details
            if(Session::has('coupon'))
            {
                $getCouponDetailes  = Session::get('coupon');
                $couponCode         = $getCouponDetailes['name'];
                $couponDetailes     = Coupon::where('code','=',$couponCode)->first();

                if($couponDetailes->discount_type=='F'){
                    $couponPriceValue   = $couponDetailes->rate;
                }elseif($couponDetailes->discount_type=='P'){
                    $couponPriceValue = $getCouponDetailes['total'] - ($getCouponDetailes['total']*($couponDetailes->rate/100));
                }

                
                $coupon_id          = $couponDetailes->id;
                $orderTotal         = $getCouponDetailes['total'];
            }
            else
            {
                $couponPriceValue = 0;
                $couponCode         = null;
                $coupon_id          = null;
                $orderTotal         = $request->net_amount_debit;

            }
            $transaction_date =  Carbon::now();
            
            $orderDetails = new OrderDetail();
            $orderDetails->user_id = Auth::id(); //this is student id
            $orderDetails->order_total = $orderTotal;
            $orderDetails->discount_amount = $couponPriceValue;
            $orderDetails->coupon_id = $coupon_id;
            $orderDetails->coupon_code = $couponCode;
            $orderDetails->is_refund = '';
            $orderDetails->refund_amount = '';
            $orderDetails->transaction_id = $request->txnid;
            $orderDetails->transaction_amount = $request->net_amount_debit;
            $orderDetails->transaction_status = $request->txnStatus;
            $orderDetails->transaction_date = $transaction_date;
            $orderDetails->transaction_type = 'On Line';
            $orderDetails->transaction_mode = $request->mode;
            $orderDetails->save();
           
           
           
            if ($carts->count() > 0) {
                foreach ($carts as $cart) {

                    /*if this course in wishlist delete it*/
                    Wishlist::where('user_id', Auth::id())->where('course_id', $cart->course_id)->delete();

                    //todo::there are calculate the Instructor balance Calculate the admin or Instructor commission
                    $course = Course::findOrFail($cart->course_id); //get course
                    $instructor = Instructor::where('user_id', $course->user_id)->first(); //get instructor
                    $package = Package::findOrFail($instructor->package_id);//get instructor package commission
                    $admin_get = 0;
                    $instructor_get = 0;
                    $amount = 0;
                    if ($cart->course_price != 0 && $cart->course_price != null) {
                        $admin_get = ($cart->course_price * $package->commission) / 100; //$admin commission
                        $instructor_get = ($cart->course_price - $admin_get); //instructor amount
                        /*todo::refer calculate*/
                        $amount += ($cart->course_price * commission()) / 100; //
                    }


                    //admin earning
                    //Todo::Admin Earning calculation
                    $admin = new AdminEarning();
                    $admin->amount = $admin_get;
                    $admin->purposes = "Commission from enrolment";
                    $admin->save();

                    //save in enrolments table
                    $enrollment = new Enrollment();
                    $enrollment->user_id = $cart->user_id; //this is student id
                    $enrollment->course_id = $cart->course_id;
                    $enrollment->order_detail_id = $orderDetails->id;
                    $enrollment->save();

                    // student get notification
                    $details = [
                        'body' => translate('You enrolled new course  ' . $course->title),
                    ];
                    $this->userNotify($enrollment->user_id, $details);

                    // instructor get notification
                    $details = [
                        'body' => translate($course->title . ' this course enrolled by ' . Auth::user()->name),
                    ];
                    $this->userNotify($course->user_id, $details);

                    //todo::Instructor Earning history
                    //instructor Earning
                    $instructorEarning = new InstructorEarning();
                    $instructorEarning->enrollment_id = $enrollment->id;
                    $instructorEarning->package_id = $package->id;
                    $instructorEarning->user_id = $instructor->user_id; //instructor user_id
                    $instructorEarning->course_price = $cart->course_price == null ? 0 : $cart->course_price;
                    $instructorEarning->will_get = $instructor_get;
                    $instructorEarning->save();

                    //todo::update the instructor balance
                    $instructor->balance += $instructor_get;
                    $instructor->save();

                    //save in purchase history
                    $history = new CoursePurchaseHistory();
                    $history->enrollment_id = $enrollment->id;
                    $history->amount = $cart->course_price == null ? 0 : $cart->course_price;
                    $history->payment_method = $request->session()->get('payment') ? $request->session()->get('payment') : 'payu'; //todo::must be change here
                    $history->save();


                    //todo::mail Admin, Instructor, Student
                    try {
                        //teacher
                        $user = User::find($instructorEarning->user_id);
                        $user->notify(new EnrolmentCourse());
                        //student
                        $user = User::find($enrollment->user_id);
                        $user->notify(new EnrolmentCourse());

                    } catch (\Exception $exception) {
                    }


                    //delete from cart
                    $cart->delete();
                }
            }

            $carts = Cart::leftjoin('package_settings','carts.package_id','package_settings.id')
                        ->select('carts.id as cId','carts.course_price','carts.package_id','carts.user_id','carts.user_id','package_settings.pkg_name as title','package_settings.pkg_image','package_settings.course_id','package_settings.free_subject')
                        ->where('carts.user_id', Auth::id())->whereNull('carts.course_id')->whereNotNull('carts.package_id')->get();


            if ($carts->count() > 0)
            {
                foreach ($carts as $cart)
                {
                    $chkType = UserAddtocartPackage::where('user_id','=',$cart->user_id)
                    ->where('package_id','=',$cart->package_id)
                    ->where('status','=','0')->first();
                    $startDate =  Carbon::now();
                    if($chkType->package_type==3){
                        $future_timestamp = strtotime("+3 month");
                        $enddata = date('Y-m-d', $future_timestamp);
                       // strtotime('-1 day', strtotime($date)
                        $enddata = date("Y-m-d", strtotime('-1 day', strtotime($enddata)));

                    }else if($chkType->package_type==2){
                        $future_timestamp = strtotime("+6 month");
                        $enddata = date('Y-m-d', $future_timestamp);
                        $enddata = date("Y-m-d", strtotime('-1 day', strtotime($enddata)));
                    }else{
                        $future_timestamp = strtotime("+12 month");
                        $enddata = date('Y-m-d', $future_timestamp);
                        $enddata = date("Y-m-d", strtotime('-1 day', strtotime($enddata)));
                    }

                    //save in enrolments table
                    $enrollment = new Enrollment();
                    $enrollment->user_id = $cart->user_id; //this is student id
                    $enrollment->course_id = $cart->course_id;
                    $enrollment->package_id = $cart->package_id;
                    $enrollment->order_detail_id = $orderDetails->id;
                    $enrollment->type = 1;
                    $enrollment->start_date = $startDate;
                    $enrollment->end_date = $enddata;
                    $enrollment->save();

                     
                     UserAddtocartPackage::where('user_id','=',$cart->user_id)
                     ->where('package_id','=',$cart->package_id)
                     ->update(['enrollment_id'=>$enrollment->id,
                     'status'=>'1']);
                     // student get notification
                     $details = [
                         'body' => translate('You enrolled new package  ' . $cart->title),
                     ];
                     $this->userNotify($enrollment->user_id, $details);
 
                     // instructor get notification
                     $details = [
                         'body' => translate($cart->title . ' this package enrolled by ' . Auth::user()->name),
                     ];
                     $this->userNotify($cart->user_id, $details);

                      //save in purchase history
                    $history = new CoursePurchaseHistory();
                    $history->enrollment_id = $enrollment->id;
                    $history->amount = $cart->course_price == null ? 0 : $cart->course_price;
                    $history->payment_method = $request->session()->get('payment') ? $request->session()->get('payment') : 'payu'; //todo::must be change here
                    $history->save();

                    if(!empty($cart->free_subject))
                     {
                        $free_subject = explode(',',$cart->free_subject);
                        $getFreeCourses = Course::Published()
                                        ->whereIn('id', $free_subject)
                                        ->with('classes')
                                        ->orderBy('title', 'ASC')->get();
                        // Adding package's free courses
                        foreach($getFreeCourses as $course_free){
                            $enrollment = new Enrollment();
                            $enrollment->user_id = $cart->user_id; //this is student id
                            $enrollment->course_id = $course_free->id;
                            $enrollment->type = 0;
                            $enrollment->save();
                            //add course purchase history
                            $history = new CoursePurchaseHistory();
                            $history->enrollment_id = $enrollment->id;
                            $history->amount = 0;
                            $history->payment_method = $request->session()->get('payment') ? $request->session()->get('payment') : 'payu'; //todo::must be change here
                            $history->save();
                        }
                     }

                    
                    //$userInfo->delete();

                    $cartDetail = Cart::find($cart->cId);
                    $cartDetail->delete();

 
                }

            }
            session()->forget('FIRST_COURSE_FREE');
            Session::flash('message', translate('Congratulations, Your enrollment is done successfully.'));
            return redirect()->route('my.packages');
        } else {
            Alert::error('error', 'Payment not proceed. Please try again!');
            return back();
        }
    }
    public function allInstructors(Request $request)
    {
        $instructors = Instructor::whereNotIn('id',[20,3])->where('is_display','=','1')
        ->where('is_external','=','0')
        ->latest()->paginate(50);
        return view($this->theme.'.instructor.list', compact('instructors'));
    }

    public function getLiveClass() {

        $today = date("Y-m-d");
        $currentTime = date("H:i:00");
        //$instructors = InstructorLiveClass::with('instructorDetail')->where('date','>=',$today)->where('start_time','>=',$currentTime)->where('status', 'Publish')->orderBy('date')->orderBy('start_time')->get();

        $instructors = InstructorLiveClass::with('instructorDetail')->where(function($q) use($today,$currentTime){
            $q->where('date','>=',$today);
            $q->where(function($sub) use($currentTime){
                $sub->where('start_time','>=',$currentTime)->orWhere('end_time','>',$currentTime);
            });
        })->orWhere('date','>',$today)->where('status', 'Publish')->orderBy('date')->orderBy('start_time')->get();


        //$instructors = InstructorLiveClass::with(['instructorDetail','instructorSubjectDetail'])->where('status', 'Publish')->orderBy('date')->orderBy('start_time')->get();
       
        return view($this->theme.'.homepage.live-class', compact('instructors'));
    }
    public function getClassTimeTable($id) {

        $instructor =  InstructorLiveClass::where('id' , $id)->first();
        //$getTimeTables  = InstructorAssessment::with('instructorsubject')->where('instructor_id', $instructor->instructor_id)->get();
        $getTimeTables  =   \App\InstructorAssessment::leftjoin('categories as cat','cat.id','=','instructor_subjects.course_id')
        ->leftjoin('categories as subCat','subCat.id','=','instructor_subjects.class_id')
       ->leftjoin('courses as c','c.id','=','instructor_subjects.subject_id')
       ->leftjoin('question_tags as d','d.id','=','instructor_subjects.subject_id')
       ->select('subCat.name as subCat','cat.name','c.title','d.tag_name','instructor_subjects.*')
      ->orderBy('id', 'DESC')->where('instructor_id',$instructor->instructor_id)->get();
        //print_r($getTimeTables); die;
        return view($this->theme.'.homepage.time-table-class',compact('getTimeTables','instructor'));
   
    }


//Get Mind Map 

public function view_mind_map(Request $request){

    $contentId = request()->segment(3);

     $getMinMaps = MindMap::where('class_content_id',$contentId)->get();
     $lesson_page_url = route('package_details',[Session::get('location_path'),Session::get('location_path1')]);
     $otherMindMapArr = array();
     $freshOtherMindMapArr = array();
     if(isset($request->otherMindMap) && !empty($request->otherMindMap))
     {
        $otherMindMapString = base64_decode($request->otherMindMap);
        $otherMindMapArr = explode(',',$otherMindMapString);
        $freshOtherMindMapArr = explode(',',$otherMindMapString);
        if (($key = array_search($contentId, $otherMindMapArr)) !== false) {
            unset($otherMindMapArr[$key]);
        }
     }
     $otherMinMaps = MindMap::whereIn('class_content_id',$otherMindMapArr)->get();
    return view($this->theme.'.course.lesson.view_mind_map',compact('getMinMaps','otherMinMaps','freshOtherMindMapArr','lesson_page_url'));

}

    public function helpAndSupport() {

        return view($this->theme.'.page.help-and-support');  
    }

     //check login test series
     public function checkTestSeriesLogin(){
       
        Session::put('test-series', 'testSeries');

        return redirect('/login');
      
    }

    public function testSeriesAuth(Request $request) { 


       $coke = '';
       $aa = $request->header();
	   //var_dump($aa['cookie']); 
		$coke = $aa['cookie'][0];
        
        if(!empty($coke)) {
			$email = '';
			$substrArr = explode(";",$coke);
			if(!empty($substrArr)){
				foreach($substrArr as $k=>$val)
					//preg_match("/eg_user/i", $val);
					if(preg_match("/eg_user/i", $val)){
						$getuserDetail = explode('=',$val);
						$email = $getuserDetail[1]; exit; 
					}	
						
			}	
			
            $user = User::where('email',$email)->first();
        if($user){
            if($user->student->image ){
                $image = asset($user->student->image);
            } else {
                $image = asset('public/uploads/user/user.png');
            }
                $userInfo =
                    array(
                    'name' => $user->name,
                    'email' => '',
                    'phone' => $user->email,
                    'picture' => $image ? $image : $image ,
                );
                return response()->json(['status' => true, 'msg' => '', 'user_info' => $userInfo]);        
            }
        } else {

            return response()->json(['status' => false, 'msg' => 'Invalid cookie data', 'user_info' => array()]);        
        
        }

    }
    
    public function enrollDemoCourse(Request $request)
    {
        if(Auth::user() && Auth::user()->user_type === "Student"){
            $enrollment = new Enrollment;
            $enrollment->user_id = Auth::user()->id; //this is student id
            $enrollment->course_id = base64_decode($request->demo_course_id);
            $enrollment->save();
            $history = new CoursePurchaseHistory();
            $history->enrollment_id = $enrollment->id;
            $history->amount = 0;
            $history->payment_method = 'Free'; //todo::must be change here
            $history->save();
            return redirect()->route('my.courses');
            //echo base64_decode($request->demo_course_id);exit;
        }else{
            $url = route('enroll.demoCourse',$request->demo_course_id);
            Session::put('remember_url', $url);
            return redirect('/login');
        }
        
    }
    
    public function classSchedule(){
        return view($this->theme.'.homepage.class-schedule');
    }
    public function get_board(){
        $boards = \App\Model\Category::where('parent_category_id',83)->get();
        echo '<option value="">Select</option>';
            foreach($boards as $boardsval){
        echo '<option value="'.$boardsval->id.'">'.$boardsval->name.'</option>';
        }
        //return view($this->theme.'.homepage.class-schedule');
    }
    public function get_competitive_courses(){
        $con = ['is_compitative' => '1', 'parent_category_id' => '0'];
        $Competitive = \App\Model\Category::where($con)->get();
            echo '<option value="">Select</option>';
        foreach($Competitive as $Competitiveval){
            echo '<option value="'.$Competitiveval->id.'">'.$Competitiveval->name.'</option>';
        }
    }
    public function get_board_classes(Request $request){
        $classes = \App\Model\Category::where('parent_category_id',$request->id)->get();
            foreach($classes as $classesval){
              $classnametext =  "'".$classesval->name."'";
        echo ' <li>
             <input onclick="getinstructor_subjectsClasses(this.value,'.$classnametext.');" id="class_name_'.$classesval->id.'" type="radio" name="class_name" value="'.$classesval->id.'" class="for_class_name_type">
        <label for="class_name_'.$classesval->id.'"><span class="d-block border border-dark rounded py-1 px-2">'.$classesval->name.'</span></label>
             </li>';
        }
    }
    public function get_board_classes_subjects(Request $request){

$course_type = $request->course_type;
$course_id = $request->course_id;
$class_id = $request->class_id;

$conn = array(
    'course_type' => $course_type,
    'course_id' => $course_id,
    'class_id' => $class_id,
 );
$getTimeTables = DB::select(DB::raw("SELECT isub.*,ids.*, 
case when ids.day = 'Monday' then 1 
when ids.day = 'Tuesday' then 2 
when ids.day = 'Wednesday' then 3 
when ids.day = 'Thursday' then 4 
when ids.day = 'Friday' then 5 
when ids.day = 'Saturday' then 6 
when ids.day = 'Sunday' then 7 end as d 
FROM `instructor_subjects` as isub 
INNER JOIN instructor_day_schedules ids ON isub.id = ids.instructor_subject_id 
 WHERE `course_type` LIKE '$course_type' AND `course_id` = $course_id AND `class_id` = $class_id AND DAY IS NOT NULL AND ids.deleted_at is null
group by instructor_id ORDER BY d asc,start_time asc"));

// return $getTimeTables;

    // $getTimeTables  =   \App\InstructorAssessment::leftjoin('categories as cat','cat.id','=','instructor_subjects.course_id')
    //     ->leftjoin('categories as subCat','subCat.id','=','instructor_subjects.class_id')
    //     ->leftjoin('courses as c','c.id','=','instructor_subjects.subject_id')
    //     ->leftjoin('question_tags as d','d.id','=','instructor_subjects.subject_id')
    //     ->leftjoin('instructors as ins','ins.id','=','instructor_subjects.instructor_id')
    //     ->select('subCat.name as subCat','cat.name','c.title','d.tag_name','instructor_subjects.*','ins.name','ins.image')
    //     ->orderBy('id', 'DESC')->where($_GET)->get();

        return view('rumbok.homepage.show-daily-class-schedule',compact('getTimeTables'));

    }
    public function store_board_class_schedule(Request $request){
        $insertbooking = DB::table('live_daily_class_booking')->insert($_GET);
        if ($insertbooking) {
            return 1;
        }
    }


    public function my_tuition(){
    $dataBooking = DB::table('tuition_booking as tuibook')
        ->join('instructor_subjects as inssub','inssub.id','=','tuibook.instructor_subjects_id')
        ->join('users','users.id','=','tuibook.user_id')
        ->join('instructors','instructors.id','=','inssub.instructor_id')
        ->leftjoin('courses as c','c.id','=','inssub.subject_id')
        ->leftjoin('categories as cat','cat.id','=','inssub.class_id')
        ->leftjoin('categories as cat2','cat2.id','=','inssub.course_id')
        ->where('tuibook.user_id',Auth::id())
        ->where('inssub.live_classes_type','tutition')
        ->select('tuibook.start_time','tuibook.end_time','tuibook.date_of_booking','tuibook.unic_jitsi_code','c.title','tuibook.time_of_booking','users.name as uname','instructors.name as insname','instructors.image','cat.name as classname','cat2.name as boardname')
        ->orderBy('cat.name','asc')
        ->orderBy('date_of_booking')
        ->paginate(6);
        // echo "<pre>";
        // print_r($dataBooking);
        return view($this->theme.'.tuition.my_tuition', compact('dataBooking'));
    }

     // Agent Login

     public function userRegister(Request $request)
     {
         $school = DB::table('universities')->where('status','1')->get(['id','university_name']);
         return view($this->theme.'.agent.index',compact('school'));
     }

     public function sitemap()
     {
         
         return view($this->theme.'.page.sitemap');
     }
 
     public function checkAgent(Request $request)
     {
         $request->validate([
             'agent_code' =>'required',
             'access_key' => 'required',
             'university_name' => 'required',
         ],
             [
             'agent_code.required' =>'Agent Code must fill',
             'access_key.required' =>'Agent Access key must fill',
             'university_name.required' =>'Agent Access key must fill',
         ]);
 
         $agent_code = $request->input('agent_code');
         $access_key = $request->input('access_key');
         $university_id = $request->input('university_name');
 
         $agent = Agent::where(['agent_code'=>$agent_code,'access_key'=>$access_key,'status'=>'1'])->first();
 
         if($agent){
             $request->session()->put('agent_code',$agent->agent_code);
             $request->session()->put('university_id',$university_id);
             return view($this->theme.'.agent.index');
             
         }else{
             return redirect()->route('user.register')->with('error','Invalid Access Credentials');
         }
     }
  
     public function registerUserboard(Request $request){
         $message = [
         'name' =>'required|string',
         'phone' => 'required|digits:10|numeric',
     ];
 
     $custome_m = [
         'name.required' =>'Name must be fill',
         'phone.required' =>'Phone must be fill',
         'phone.digits' =>'Phone number must be 10 digits',
         'phone.numeric' =>'Phone number must benumeric',
     ];
         
         $validator = Validator::make($request->all(),$message,$custome_m);
 
         if($validator->fails()){
             return response()->json(['status'=>0,'errors'=>$validator->messages()]);
 
         }else{
                 $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->input('name')));
                 $data1 = [
                 'name' => $request->input('name'),
                 'email' => $request->input('phone'),
                 'slug' => $slug,
                 'user_type' => 'Student',
                 'verified' => '1',
                 'class_type' => $request->input('class_type'),
                 'class_name' => $request->input('class_name'),
                 'board' => $request->input('board'),
                 'password' => Hash::make($request->input('phone')),
                 ];
                 
                 $user = DB::table('users')->insertGetId($data1);
 
                 if($user){
                     $data2 = [
                     'name' => $request->input('name'),
                     'email' => $request->input('phone'),
                     'class_type' => $request->input('class_type'),
                     'class_name' => $request->input('class_name'),
                     'board' => $request->input('board')
                 ];
                     $data2['user_id'] = $user;
                     $data2['agent_code'] = session('agent_code');
                     $data2['university_id'] = session('university_id');
                     DB::table('students')->insert($data2);
                 }
             return response()->json(['status'=>1,'success'=>'Student Created Successfully!']);
         }
     }
 
     public function registerUsercomptitive(Request $request){
         $message = [
         'name' =>'required',
         'phone' => 'required|digits:10|numeric',
     ];
 
     $custome_m = [
         'name.required' =>'Name must be fill.It is string type',
         'phone.required' =>'Phone must be fill',
         'phone.digits' =>'Phone number must be 10 digits',
         'phone.numeric' =>'Phone number must benumeric',
     ];
         
         $validator = Validator::make($request->all(),$message,$custome_m);
 
         if($validator->fails()){
             return response()->json(['status'=>0,'errors'=>$validator->messages()]);
 
         }else{
                 $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->input('name')));
                 $data1 = [
                 'name' => $request->input('name'),
                 'email' => $request->input('phone'),
                 'slug' => $slug,
                 'user_type' => 'Student',
                 'verified' => '1',
                 'class_type' => $request->input('class_type'),
                 'competitive' => $request->input('competitive'),
                 'password' => Hash::make($request->input('phone')),
                 ];
                 
                 $user = DB::table('users')->insertGetId($data1);
 
                 if($user){
                     $data2 = [
                     'name' => $request->input('name'),
                     'email' => $request->input('phone'),
                     'class_type' => $request->input('class_type'),
                     'competitive' => $request->input('competitive')
                 ];
                     $data2['user_id'] = $user;
                     $data2['agent_code'] = session('agent_code');
                     $data2['university_id'] = session('university_id');
                     DB::table('students')->insert($data2);
                 }
             return response()->json(['status'=>1,'success'=>'Student Created Successfully!']);
         }       
     }
  
    public function checkMobile(Request $request){
        $mobile = $request->phone;
        $user = DB::table('users')->where('email',$mobile)->first();
        if($user){
            return response()->json(['status'=>0,'error'=>'This number already exists!']);
        }else{
            return response()->json(['status'=>1,'success'=>'This number is available!']);
        }

    }

    public function deleteAgentSession(Request $request){
        $request->session()->forget('agent_code');
        $request->session()->forget('university_id');
        return redirect()->route('user.register');
    }

    public function RegisterWithExcel(Request $request){

        $request->validate([
             'select_file' => 'required|mimes:csv,txt',
         ],[
             'select_file.required'=>'File must be required',
             'select_file.mimes'=>'File must be csv type',
         ]);
 
         $duplicate_phone = array();
         $total_insertion = 0;
         $missing_fileds = array();
         if(!empty($request->file('select_file'))) {
 
             if (($handle = fopen($request->file('select_file'), 'r')) !== FALSE) { 
                 fgetcsv($handle); //discard first line(heading) of the excel file
                 while (($data = fgetcsv($handle)) !== FALSE) {
                     if (!empty($data)){
 
                         $class_name_data =  $data[6];
                         $class_name = '';
                         $borad_data = $data[5];
                         $borad = '';
                         $class_type_data = $data[4];
                         $class_type = '';
 
                         switch(strtolower($class_name_data)){
                             case 'class 6':
                                 $class_name = 12;
                             break;
                             case 'class 7':
                                 $class_name = 13;
                             break;
                             case 'class 8':
                                 $class_name = 14;
                             break;
                             case 'class 9':
                                 $class_name = 15;
                             break;
                             case 'class 10':
                                 $class_name = 16;
                             break;
                             case 'class 11':
                                 $class_name = 17;
                             break;
                             case 'class 12':
                                 $class_name = 76;
                             break;
                             default:
                             $class_name = NULL;
                         }
 
                         switch(strtolower($borad_data)){
                             case 'cbse':
                                 $borad = 9;
                             break;
                             case 'isc':
                                 $borad = 10;
                             break;
                             case 'icse':
                                 $borad = 11;
                             break;
                             default:
                             $borad = NULL;
                         }
 
                         if(strtolower($class_type_data) == 'academic'){
                             $class_type = "k12";
                         }else{
                              $class_type = "18+";
                         }
 
                         $usersMobileCheck = User::where('email',$data[2])->count();
                         if($usersMobileCheck){
                             array_push($duplicate_phone, $data[2]);
                         }else{
 
                             if($class_name_data !='' && $class_type_data !='' && $borad_data !=''){
 
                             $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $data[0]));
 
                             $userdata = [
                             'name' => $data[0],
                             'slug' => $slug,
                             'email' => $data[2],
                             'user_type' => 'Student',
                             'verified' => '1',
                             'class_type' => $class_type,
                             'class_name' => $class_name,
                             'board' => $borad,
                             'alternate_email_user' => $data[3] ? $data[3] : NULL,
                             'password' => Hash::make($data[2]),
                             ];
                     
                             $user = DB::table('users')->insertGetId($userdata);
 
                              $total_insertion = $total_insertion+1;
 
                             if($user){
 
                                 $data2 = [
                                 'name' =>  $data[0],
                                 'father_name' => $data[1],
                                 'email' => $data[2],
                                 'phone' => $data[2],
                                 'class_type' => $class_type,
                                 'class_name' => $class_name,
                                 'alternate_email_user' => $data[3] ? $data[3] : NULL,
                                 'board' => $borad,
                                // 'competitive' => $data[7],
                              ];
                                 $data2['user_id'] = $user;
                                 $data2['agent_code'] = session('agent_code');
                                 $data2['university_id'] = session('university_id');
 
                                  DB::table('students')->insert($data2);
                            }
                         }else{
                             array_push($missing_fileds,$data[2]);
                             }
                         }
                         
                     }
                 }
                 fclose($handle);
             }
         }
 
         $request->session()->put('total_insertion',$total_insertion);
 
         $newdata = '';
         $newmissingdata = '';
          if(count($missing_fileds)>0){
             for($i=0;$i<count($missing_fileds);$i++){
                 $newmissingdata .= $missing_fileds[$i].' ,';
             }
             
             $newmissingdata = rtrim($newmissingdata,' ,');
         }
 
 
         if(count($duplicate_phone)>0){
             $total_number = count($duplicate_phone);
             for($i=0;$i<$total_number;$i++){
                 $newdata .= $duplicate_phone[$i].' ,';
             }
              $msg = '';
             $invalid_data = rtrim($newdata,' ,');
             return view($this->theme.'.agent.message',compact('invalid_data','total_number','msg','total_insertion','newmissingdata'));
         }else{
 
             $invalid_data = '';
             $total_number = '';
             $msg = '1';
             return view($this->theme.'.agent.message',compact('invalid_data','total_number','msg','total_insertion','newmissingdata'));
         }
     }
      // END


     
}
