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
use App\Model\IidSector;

class CollageController extends Controller
{
    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
    }
    /*Search the courses*/
    public function industrialDocumentry(Request $request)
    {
        $school_id = Session::get('school_id');
        $permission = \App\Category_permission::select('category_id')
        ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'Documentry')
        ->where('category_id', 'Documentry')->where('main_category', 'collage')->exists();
        if(!$permission){
            return redirect('/');
        }
        $docCategories = DB::table('documentry_categories')->whereNull('deleted_at')->select('id','name','slug')->get();
        $docContents = DB::table('documentry_contents')->where('is_project_report',0)->whereNull('deleted_at')
                        ->select('id','title','url')->orderBy('title', 'ASC')->paginate(50);
        return view($this->theme.'.collage.industrial-documentry',compact('docCategories','docContents'));
    }
    public function industrialDocumentrySlug(Request $request)
    {
        $school_id = Session::get('school_id');
        $permission = \App\Category_permission::select('category_id')
        ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'Documentry')
        ->where('category_id', 'Documentry')->where('main_category', 'collage')->exists();
        if(!$permission){
            return redirect('/');
        }
        $docCategories = DB::table('documentry_categories')->where('slug',$request->slug)->whereNull('deleted_at')->select('id')->first();
        $docContents = DB::table('documentry_contents')->where('is_project_report',0)->where('documentry_categories_id',$docCategories->id)->whereNull('deleted_at')
                        ->select('id','title','url')->orderBy('title', 'ASC')->paginate(50);
        $docCategories = DB::table('documentry_categories')->whereNull('deleted_at')->select('id','name','slug')->get();      
        if(isset($request->work)){
            return view($this->theme.'.collage.getDataUsinSlug',compact('docContents'));
        }
        return view($this->theme.'.collage.industrial-documentry',compact('docCategories','docContents'));
    }
    public function industrialDocumentrySearch(Request $request)
    {
        $docContents = DB::table('documentry_contents')->where('is_project_report',0)->where('title', 'like', '%' . $request->searchdata . '%')->whereNull('deleted_at')
                        ->select('id','title','url')->get();
        foreach($docContents as $docContents_val){
            echo '<div style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal" 
            onclick="openYoutobeurl('."'".$docContents_val->url."'".','."'".$docContents_val->title."'".')" class="col-md-4 col-6 mb-3">
            <div class="product-grid3 mt-3 h-100 shadow-lg rounded">
                <div class="product-image3">';
                    
                        $video_id = explode("?v=", $docContents_val->url);
                        $video_id = $video_id[1];
                    
            echo '<img class="img-fluid" alt="'.$docContents_val->title.'" 
                    src="http://img.youtube.com/vi/'.$video_id.'/maxresdefault.jpg">
                    <span class="position-absolute video-link cursor-pointer">
                    <svg style="margin-left: 2px;" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" size="40" height="25" width="40" xmlns="http://www.w3.org/2000/svg">
                        <path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path>
                    </svg>
                    </span>
                </div>
                <div class="product-content pb-0"><b class="title cursor-pointer mb-0 pb-0" title="'.$docContents_val->title.'">'.$docContents_val->title.'</b></div>
            </div>
        </div>';
        }
    }


    public function edpCourses(Request $request){
        $school_id = Session::get('school_id');
        $permission = \App\Category_permission::select('category_id')
        ->where('school_id', $school_id)->where('type', 'p_category')->where('p_category', 'EDP-courses')
        ->where('category_id', 'EDP-courses')->where('main_category', 'collage')->exists();
        if(!$permission){
            return redirect('/');
        }

        
        $cat = Category::where('slug', 'edp-courses')->first();
        $boardClasses = Category::where('parent_category_id', $cat->id)->get();
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
            $categories = Category::where('parent_category_id', $cat->parent_category_id)->Published()->get();
            $catId = array_merge($catId, [$cat->id]);
        }
        $courses = Course::Published()->whereIn('category_id',$catId)->latest()->paginate(60)->withQueryString();
     
        $catnew= Category::where('parent_category_id', $cat->id)->get();
        $catIdArr = array();
        foreach($catnew as $value){
            array_push($catIdArr,$value['id']);
        }
        $coursesdata = Course::with('classes')->Published()->whereIn('category_id',$catIdArr)->get();    
        $data = array();        
        foreach($coursesdata as $course)
        {
            if(isset($course->classes) && !empty($course->classes))
            {                
                foreach($course->classes as $item)
                {
                    if(!empty($item->contents))
                    {
                        foreach($item->contents as $item_content)
                        {
                            if(!empty($item_content->video_url))
                            {
                                $data[$course->category->name][] = array('category_id'=>$course->category->id,'category_name'=>$course->category->name,'demo_url'=>$item_content->video_url,'demo_type'=>$item_content->demo_type,'chapter_name'=>$item_content->title,'subject_name'=>$course->title,'course_image'=>$course->image);
                            }
                        }
                    }                    
                }
            }                           
        } 
        
        $pageMeta['meta_title'] = $cat->meta_title;
        $pageMeta['meta_description'] = $cat->meta_description;
        $pageMeta['tag'] = $cat->tag;  

        return view($this->theme.'.collage.course_grid',compact('catnew','data','courses', 'cat','boardClasses','pageMeta'));

    }

    public function previewEdpCourse($slug){ 
        $school_id = Session::get('school_id');
        $l_courses = Course::Published()->latest()->take(3)->get(); // single course details
        $sug_courses = Course::Published()->take(8)->get()->shuffle(); // suggession courses
        $s_course = Course::Published()->where('slug', $slug)->with('classes')->first(); // single course details

        $b2bpricing_mechanisms = DB::table('b2bpricing_mechanisms')->where('school_id', $school_id)->first();

        if($b2bpricing_mechanisms){
            if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
                $s_course->price = round($s_course->price + ($s_course->price * ($b2bpricing_mechanisms->value/100)), 0);            
            }
            if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
                $s_course->price = round($s_course->price - ($s_course->price * ($b2bpricing_mechanisms->value/100)), 0);           
            }
        }else{
            $s_course->price = round($s_course->price, 0);
        }

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


        return view($this->theme.'.collage.course_details', compact('s_course', 'l_courses', 'sug_courses','pageMeta','cat'));
    }



    public function industrialCourses(Request $request)
    {
        $school_id = Session::get('school_id');
        $sector_id = ''; 
        if(isset($request->sector_slug) && !empty($request->sector_slug)){
            $sector = IidSector::where('slug', $request->sector_slug)->first(); 
            $sector_id = $sector->id;  
        }
        $cat = Category::where('slug', 'industrial-courses')->first();
        $boardClasses = Category::where('parent_category_id', $cat->id)->get();
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
            $categories = Category::where('parent_category_id', $cat->parent_category_id)->Published()->get();
            $catId = array_merge($catId, [$cat->id]);
        }
        $courses = Course::Published()->whereIn('category_id',$catId)
                    ->when($sector_id!='',function($q) use($sector_id){
                        $q->where('iid_sector_id',$sector_id);
                    })->latest()->paginate(60)->withQueryString();
     
                $b2bpricing_mechanisms = DB::table('b2bpricing_mechanisms')->where('school_id', $school_id)->first();
                // dd($b2bpricing_mechanisms);
                foreach($courses as $key=>$coursesval){
                    if($b2bpricing_mechanisms){
                        if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
                            $courses[$key]->price = round($coursesval->price + ($coursesval->price * ($b2bpricing_mechanisms->value/100)), 0);            
                        }
                        if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
                            $courses[$key]->price = round($coursesval->price - ($coursesval->price * ($b2bpricing_mechanisms->value/100)), 0);           
                        } 
                    }else{
                        $courses[$key]->price = round($coursesval->price, 0);
                    } 
                }
        // dd($courses);            
        $catnew= Category::where('parent_category_id', $cat->id)->get();
        $catIdArr = array();
        foreach($catnew as $value){
            array_push($catIdArr,$value['id']);
        }
        $coursesdata = Course::with('classes')->Published()->whereIn('category_id',$catIdArr)->get();    
        $data = array();        
        foreach($coursesdata as $course)
        {
            if(isset($course->classes) && !empty($course->classes))
            {                
                foreach($course->classes as $item)
                {
                    if(!empty($item->contents))
                    {
                        foreach($item->contents as $item_content)
                        {
                            if(!empty($item_content->video_url))
                            {
                                $data[$course->category->name][] = array('category_id'=>$course->category->id,'category_name'=>$course->category->name,'demo_url'=>$item_content->video_url,'demo_type'=>$item_content->demo_type,'chapter_name'=>$item_content->title,'subject_name'=>$course->title,'course_image'=>$course->image);
                            }
                        }
                    }                    
                }
            }                           
        } 
        
        $pageMeta['meta_title'] = $cat->meta_title;
        $pageMeta['meta_description'] = $cat->meta_description;
        $pageMeta['tag'] = $cat->tag;  

        return view($this->theme.'.collage.industrial_courses', compact('catnew','data','courses', 'cat','boardClasses','pageMeta'));

        // return view($this->theme.'.homepage.industrial_courses',compact('catnew','data','courses', 'cat','boardClasses','pageMeta'));
    }

    public function projectReport(Request $request){
        $projectCategories = DB::table('documentry_categories')->whereNull('deleted_at')->select('id','name','slug')->get();
        if($request->cat_slug!=''){
            $pCategorie = DB::table('documentry_categories')->where('slug',$request->cat_slug)->whereNull('deleted_at')->select('id')->first();
            $projectContents = DB::table('documentry_contents as dc')->where('dc.documentry_categories_id',$pCategorie->id)
            ->join('project_reports_data as prd', 'prd.contents_id','=','dc.id')
            ->join('documentry_categories as doccate', 'doccate.id','=','prd.documentry_categories_id')
            ->where('dc.is_project_report',1)
            ->whereNull('dc.deleted_at')->whereNull('prd.deleted_at')
            ->select('prd.id','prd.title','prd.project_value','dc.slug','doccate.slug as cateSlug','prd.price','prd.short_description','prd.thumbnail')
            ->paginate(50);
        }else{
            $projectContents = DB::table('documentry_contents as dc')
            ->join('project_reports_data as prd', 'prd.contents_id','=','dc.id')
            ->join('documentry_categories as doccate', 'doccate.id','=','prd.documentry_categories_id')
            ->where('dc.is_project_report',1)
            ->whereNull('dc.deleted_at')->whereNull('prd.deleted_at')
            ->select('prd.id','prd.title','prd.project_value','dc.slug','doccate.slug as cateSlug','prd.price','prd.short_description','prd.thumbnail')
            ->paginate(50);
        }
        $school_id = \Session::get('school_id');
        $b2bpricing_mechanisms = DB::table('b2bpricing_mechanisms')->where('school_id', $school_id)->first();
        // dd($projectContents); die;
        // 'prd.documentry_categories_id', '=', 'dc.documentry_categories_id'
        return view($this->theme.'.collage.project_report',compact('projectCategories','projectContents','b2bpricing_mechanisms'));

    }

    public function projectReportCateSubcate(Request $request){
        $pCategorie = DB::table('documentry_categories')->where('slug',$request->cat_slug)->whereNull('deleted_at')->select('id')->first();
        $sub_pCategorie = DB::table('documentry_contents')->where('documentry_categories_id',$pCategorie->id)->where('slug',$request->sub_cat_slug)->whereNull('deleted_at')->select('id')->first();

        $projectContents = DB::table('project_reports_data as prd')->where('documentry_categories_id',$pCategorie->id)->where('contents_id',$sub_pCategorie->id)->whereNull('deleted_at')->select('prd.id','prd.title','prd.project_value','prd.slug','prd.price','prd.short_description','prd.thumbnail')->paginate(10);

        $school_id = \Session::get('school_id');
        $b2bpricing_mechanisms = DB::table('b2bpricing_mechanisms')->where('school_id', $school_id)->first();

        return view($this->theme.'.collage.viewsubcategorydata',compact('projectContents','b2bpricing_mechanisms'));

    }

    public function folkwareSingleCourse(Request $request)
    {
        
        $course = Course::with('classes')->Published()->where('slug',$request->slug)->first();  
        $cat = Category::where('id', $course->category_id)->first();  
        $data = array();        
        if(isset($course->classes) && !empty($course->classes))
        {            
            foreach($course->classes as $item)
            {
                if(!empty($item->contents))
                {
                    foreach($item->contents as $item_content)
                    {
                        if(!empty($item_content->video_url))
                        {
                            $data[] = array('category_id'=>$course->category->id,'category_name'=>$course->category->name,'demo_url'=>$item_content->video_url,'demo_type'=>$item_content->demo_type,'chapter_name'=>$item_content->title,'subject_name'=>$course->title,'course_image'=>$course->image);
                        }
                    }
                }                    
            }
        }
        return view($this->theme.'.homepage-b2b.folklore-courses',compact('cat','course','data'));
    }

    // folklore-courses

}