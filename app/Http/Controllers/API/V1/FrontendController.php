<?php

namespace App\Http\Controllers\API\V1;


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
use App\PackageAddonService;

use Illuminate\Validation\ValidationException;

class FrontendController extends Controller
{
    public function getSchoolData(Request $request)
    {
        // die('============');
        try { 


            $primary_dashboard = DB::table('b2bconfigurations')->where('universities_id',$request->school_id)
                            ->select('primary_dashboard')->first();

            // echo $primary_dashboard->primary_dashboard; die;
            $permission_vertical['primary_dashboard'] = $primary_dashboard->primary_dashboard;

            // $secondary_dashboard = array();

            if(\App\Category_permission::select('category_id')->where('school_id', $request->school_id)->where('type', 'school')->where('category_id', 'school')->exists()){
                $secondary_dashboard['school'] = 1;
            }else{
                $secondary_dashboard['school'] = 0;
            }
            if(\App\Category_permission::select('category_id')->where('school_id', $request->school_id)->where('type', 'collage')->where('category_id', 'collage')->exists()){
                $secondary_dashboard['collage'] = 1;
            }else{
                $secondary_dashboard['collage'] = 0;
            }
            if(\App\Category_permission::select('category_id')->where('school_id', $request->school_id)->where('type', 'competitive')->where('category_id', 'competitive')->exists()){
                $secondary_dashboard['competitive'] = 1;
            }else{
                $secondary_dashboard['competitive'] = 0;
            }
            if(\App\Category_permission::select('category_id')->where('school_id', $request->school_id)->where('type', 'entrepreneur')->where('category_id', 'entrepreneur')->exists()){
                $secondary_dashboard['entrepreneur'] = 1;
            }else{
                $secondary_dashboard['entrepreneur'] = 0;
            }
            

            $schooldata = DB::table('b2bconfigurations')
            ->leftjoin('universities','universities.id','=','b2bconfigurations.universities_id')
            ->where('b2bconfigurations.status',1)->where('b2bconfigurations.universities_id',$request->school_id)
            ->select('b2bconfigurations.universities_id','b2bconfigurations.slug','b2bconfigurations.meta_title','b2bconfigurations.logo','b2bconfigurations.m_number','b2bconfigurations.theme_configration_mobile','b2bconfigurations.language','b2bconfigurations.fav_icon','universities.address','b2bconfigurations.primary_dashboard','b2bconfigurations.text_color_mobile','b2bconfigurations.brand_logo')->first();
            

            // return Response::json(aes128encrypt(['status' => 1, 'message' => 'Success', 'schooldata' => $schooldata, 'permission_vertical' => $permission_vertical, 'secondary_dashboard' => $secondary_dashboard]),200);

            return Response::json(compact('schooldata','permission_vertical','secondary_dashboard'), 200);

        } 
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }
    public function perMissionForVertical(Request $request)
    {
        die('=====');
        try {

            $primary_dashboard = DB::table('b2bconfigurations')->where('universities_id',$request->school_id)
                            ->select('primary_dashboard')->first();

            // echo $primary_dashboard->primary_dashboard; die;
            $permission_vertical['primary_dashboard'] = $primary_dashboard->primary_dashboard;


            if(\App\Category_permission::select('category_id')->where('school_id', $request->school_id)->where('type', 'school')->where('category_id', 'school')->exists()){
                $permission_vertical['secondary_dashboard'][0] = 'school';
            }
            if(\App\Category_permission::select('category_id')->where('school_id', $request->school_id)->where('type', 'collage')->where('category_id', 'collage')->exists()){
                $permission_vertical['secondary_dashboard'][1] = 'collage';
            }
            if(\App\Category_permission::select('category_id')->where('school_id', $request->school_id)->where('type', 'competitive')->where('category_id', 'competitive')->exists()){
                $permission_vertical['secondary_dashboard'][2] = 'competitive';
            }
            if(\App\Category_permission::select('category_id')->where('school_id', $request->school_id)->where('type', 'entrepreneur')->where('category_id', 'entrepreneur')->exists()){
                $permission_vertical['secondary_dashboard'][3] = 'entrepreneur';
            }
            
            return Response::json(compact('permission_vertical'), 200);
        }
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }
    public function rumbokSliders(Request $request)
    {
        try {
            $sliders = Slider::where('type', 'slider')->select('type','name','image','url')->where('school_id', $request->school_id)->limit(3)->get();

            return Response::json(aes128encrypt(['status' => 1, 'message' => 'Success', 'sliders' => $sliders]),200);

            // return Response::json(compact('sliders'), 200);
        }
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }
    public function pCategoryBoard(Request $request)
    {
        try {
            $p_category_board = Category_permission::where('school_id', $request->school_id)
            ->where('type', 'p_category')->where('main_category', 'school')   
            ->whereNull('p_category')       
            ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
            ->select('cate.id','cate.name','cate.slug')
            ->get();
            // return Response::json(aes128encrypt(['status' => 1, 'message' => 'Success', 'p_category_board' => $p_category_board]),200);
            return Response::json(compact('p_category_board'), 200);
        }
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }
    public function pCategoryCollage(Request $request)
    {
        try {
            $p_category_board = Category_permission::where('school_id', $request->school_id)
            ->where('type', 'p_category')->where('main_category', 'collage')      
            ->whereNull('p_category')            
            ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
            ->select('cate.id','cate.name','cate.slug')
            ->get();
            // return Response::json(aes128encrypt(['status' => 1, 'message' => 'Success', 'p_category_board' => $p_category_board]),200);
            return Response::json(compact('p_category_board'), 200);
        }
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }
    public function pCategoryCompetitive(Request $request)
    {
        try {
            $p_category_board = Category_permission::where('school_id', $request->school_id)
            ->where('type', 'p_category')->where('main_category', 'competitive')   
            ->whereNull('p_category')               
            ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
            ->select('cate.id','cate.name','cate.slug')
            ->get();
            // return Response::json(aes128encrypt(['status' => 1, 'message' => 'Success', 'p_category_board' => $p_category_board]),200);
            return Response::json(compact('p_category_board'), 200);
        }
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }












    public function sCategoryBoard(Request $request)
    {
        try {
            $s_category_board = \App\Category_permission::where('school_id', $request->school_id)
            ->where('type', 's_category')->where('main_category', 'school')                
            ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
            ->select('cate.id','cate.name','cate.slug')
            ->where('cate.parent_category_id','=', $request->p_category_id)
            ->get();
            // return Response::json(aes128encrypt(['status' => 1, 'message' => 'Success', 's_category_board' => $s_category_board]),200);
            return Response::json(compact('s_category_board'), 200);
        }
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }
    public function sCategoryCollage(Request $request)
    {
        try {
            $s_category_board = \App\Category_permission::where('school_id', $request->school_id)
            ->where('type', 's_category')->where('main_category', 'collage')                
            ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
            ->select('cate.id','cate.name','cate.slug')
            ->where('cate.parent_category_id','=', $request->p_category_id)
            ->get();
            // return Response::json(aes128encrypt(['status' => 1, 'message' => 'Success', 's_category_board' => $s_category_board]),200);
            return Response::json(compact('s_category_board'), 200);
        }
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }
    public function sCategoryCompetitive(Request $request)
    {
        try {
            $s_category_board = \App\Category_permission::where('school_id', $request->school_id)
            ->where('type', 's_category')->where('main_category', 'competitive')               
            ->leftjoin('categories as cate','cate.id','=','category_permissions.category_id')
            ->select('cate.id','cate.name','cate.slug')
            ->where('cate.parent_category_id','=', $request->p_category_id)
            ->get();
            // return Response::json(aes128encrypt(['status' => 1, 'message' => 'Success', 's_category_board' => $s_category_board]),200);
            return Response::json(compact('s_category_board'), 200);
        }
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }

    public function staticDataForSchool()
    {
        try {
            $staticData = DB::table('system_settings')->select('value')->where('type','static_data_for_mobile_school')->get();
            // return Response::json(aes128encrypt(['status' => 1, 'message' => 'Success', 'staticData' => $staticData]),200);
            return Response::json(compact('staticData'), 200);
        }
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }







    public function industrialDocumentrygetsidebar()
    {
        /*$url="https://admin.iid.org.in/forcourses/sidebar";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result=curl_exec($ch);
        curl_close($ch);
        $someArray = json_decode($result, true);
        foreach ($someArray['sidebar'] as $value){
            $categories = DB::table('documentry_categories')->select('id')->where('slug',$value['slug'])->exists();
            if(!$categories){
                $values = array('name' => $value['name'],'title' => $value['title'],'slug' => $value['slug']);
                DB::table('documentry_categories')->insert($values);  
            }
        }*/
    } 

    public function industrialDocumentrygetdatamain(Request $request)
    {    
        die('===========');    
        $categories = DB::table('documentry_categories')->select('slug','id')->whereNull('deleted_at')->get();
        foreach($categories as $catgory){
            $url="https://iid.org.in/api/project-report-view/".$catgory->slug."/undefined?limit=50000";  
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL,$url);
                $result=curl_exec($ch);
                curl_close($ch);
                $someArray = json_decode($result, true);
                if(isset($someArray['project_reports'])){
                    $project_reports = $someArray['project_reports']; 
                    foreach($project_reports as $someArrayVal){
                        if(isset($someArrayVal['name'])){
                            $values = array('documentry_categories_id' => $catgory->id,'title' => $someArrayVal['name'],'slug' => $someArrayVal['slug'],'is_project_report' => 1);
                            $contents_id=DB::table('documentry_contents')->insertGetId($values); 
                            foreach($someArrayVal['projectreport'] as $projectreportVal){
                                $values = array(
                                    'documentry_categories_id' => $catgory->id,
                                    'contents_id' => $contents_id,
                                    'title' => $projectreportVal['title'],
                                    'project_value' => $projectreportVal['project_value'],
                                    'slug' => $projectreportVal['slug'],
                                    'file' => $projectreportVal['file'],
                                    'type' => $projectreportVal['type'],
                                    'price' => $projectreportVal['price'],
                                    'associate_amount' => $projectreportVal['associate_amount'],
                                    'short_description' => $projectreportVal['short_description'],
                                    'thumbnail' => $projectreportVal['thumbnail']
                            );
                                
                                DB::table('project_reports_data')->insert($values); 
                            }
                        }
                    }
                }
            }
        // if($request->slugurl){
        /*$categories = DB::table('documentry_categories')->select('slug','id')->whereNull('deleted_at')->get();
        foreach($categories as $catgory){
            $url="https://admin.iid.org.in/forcourses/main-IndustrialDocumentry/".$catgory->slug."?page=".$request->page."&search=".$request->search."&limit=50000";  
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,$url);
            $result=curl_exec($ch);
            curl_close($ch);
            $someArray = json_decode($result, true);
            // print_r($someArray['contents']); die;
            foreach ($someArray['contents'] as $value){
                    $values = array('documentry_categories_id' => $catgory->id,'title' => $value['title'],'url' => $value['url']);
                    DB::table('documentry_contents')->insert($values);  
            }
        }*/
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
       ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title','c.ole_refference_id','c.lms_refference_id')
       ->where(['package_settings.sub_category_id'=>$s_cat->id])
       ->where(['package_settings.category_id'=>$cat->id]);
       if(isset($request->classes) && $request->classes!='')
       {
           $packageDataBoards = $packageDataBoards->where('package_settings.sub_category_id',$request->classes);
       }
       $packageDataBoards = $packageDataBoards->orderBy('id', 'DESC')->get();

        foreach($packageDataBoards as $key=>$packageDataBoardsval){
            $freeData = explode(',',$packageDataBoardsval->free_subject);
            $course_chapter_count =  getCountData($packageDataBoardsval->course_id,$freeData);
            $subjectCount =0;
            $freeData = count($freeData); 

            if($packageDataBoardsval->course_id == 0){
                $packageDataBoards[$key]->pkg_subchaps = $freeData; 
            }else{
                $packageDataBoards[$key]->pkg_subchaps = $course_chapter_count[0];
            }
            if($packageDataBoardsval->course_id == 0){
                $packageDataBoards[$key]->pkg_subchaps_text = 'Subjects'; 
            }else{
                $packageDataBoards[$key]->pkg_subchaps_text = 'Chapters'; 
            }

            $packageDataBoards[$key]->pkg_lectures =  $course_chapter_count[1];
            $packageDataBoards[$key]->pkg_lectures_text =  'Lectures';

            if($packageDataBoardsval->lms_refference_id == 0 && $packageDataBoardsval->ole_refference_id > 0){
                $packageDataBoards[$key]->pkg_image = "https://olexpert.org.in/public/".$packageDataBoardsval->pkg_image;
            }
            if($packageDataBoardsval->lms_refference_id > 0 && $packageDataBoardsval->ole_refference_id > 0){
                $packageDataBoards[$key]->pkg_image = "https://courses.iid.org.in/public/".$packageDataBoardsval->pkg_image;
            }
            if($packageDataBoardsval->ole_refference_id == 0 && $packageDataBoardsval->lms_refference_id == 0){
                $packageDataBoards[$key]->pkg_image = "http://entrepreneurindia.tv/public/".$packageDataBoardsval->pkg_image;
            }
        }
        // print_r($packageDataBoards);
        // die;
        // $packageDataBoards = (object) $packageDataBoards;
        // var_dump($packageDataBoards); 
        $pageMeta['meta_title'] = $cat->meta_title;
        $pageMeta['meta_description'] = $cat->meta_description;
        $pageMeta['tag'] = $cat->tag; 
        //   echo "<pre>"; dd($packageDataBoards); die('=========');

       return Response::json(compact('packageDataBoards', 'cat','boardClasses','pageMeta'), 200);
       //   compact('packageDataBoards', 'cat','boardClasses','pageMeta'));
   }

   
   public function preview_board(Request $request)
   {
        $school_id = $request->school_id;
        $b2bpricing_mechanisms = DB::table('b2bpricing_mechanisms')->where('school_id', $school_id)->first();
        // echo $request->id; die('====');
        if(intval($request->id) && $request->id>0){
            $packageDetailFetch = PackageSetting::where('id',$request->id)->first();
        }else{
            $packageDetailFetch = PackageSetting::where('slug',$request->id)->first();
        }
        // dd($packageDetailFetch);
        $id = $packageDetailFetch->id;
        $enroll_id= (isset($request->enroll_id))?$request->enroll_id:NULL;
        $getAddToCartData = '';
        //      return $enroll_id;
        $enrollCourses = array();
        if(!empty($enroll_id)){
            $idGet = explode('_',$id);
            $cGetId = 'qtr';
            $getAddon   = PackageAddonService::join('services','services.id','=','package_addon_services.addon_service_id')
                                        ->where('package_addon_services.package_id','=',$id)
                                        ->where('package_addon_services.status','=','1')
                                        ->select('package_addon_services.*','services.service_name')
                                        ->get(); 
            $getData    = PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
                                    ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
                                    ->leftjoin('courses as c','c.ole_refference_id','=','package_settings.course_id')
                                    ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title','c.big_description','c.short_description','c.meta_title','c.meta_description','c.tag','c.ole_refference_id','c.lms_refference_id')
                                    ->where('package_settings.id','=',$id)
                                    ->orderBy('id', 'DESC')->first();

            if($b2bpricing_mechanisms){
                if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
                    $getData->annually_coverage_price = round($getData->annually_coverage_price + ($getData->annually_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                    $getData->halfyrly_coverage_price = round($getData->halfyrly_coverage_price + ($getData->halfyrly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                    $getData->quarterly_coverage_price = round($getData->quarterly_coverage_price + ($getData->quarterly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);              
                }
                if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
                    $getData->annually_coverage_price = round($getData->annually_coverage_price - ($getData->annually_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                    $getData->halfyrly_coverage_price = round($getData->halfyrly_coverage_price - ($getData->halfyrly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                    $getData->quarterly_coverage_price = round($getData->quarterly_coverage_price - ($getData->quarterly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);             
                }
            }else{
                $getData->annually_coverage_price = round($getData->annually_coverage_price, 0);
                $getData->halfyrly_coverage_price = round($getData->halfyrly_coverage_price, 0);
                $getData->quarterly_coverage_price = round($getData->quarterly_coverage_price, 0);
            }
    
            
                if($getData->lms_refference_id == 0 && $getData->ole_refference_id > 0){
                    $getData->pkg_image = "https://olexpert.org.in/public/".$getData->pkg_image;
                }
                if($getData->lms_refference_id > 0 && $getData->ole_refference_id > 0){
                    $getData->pkg_image = "https://courses.iid.org.in/public/".$getData->pkg_image;
                }
                if($getData->ole_refference_id == 0 && $getData->lms_refference_id == 0){
                    $getData->pkg_image = "http://entrepreneurindia.tv/public/".$getData->pkg_image;
                }

            $getFreeCourses=array();
            $chapterCount=0;
            $countLecture=0;
            if(isset($getData->free_subject)){
                $free_subject = explode(',',$getData->free_subject);
                $getFreeCourses = Course::Published()
                                            ->whereIn('ole_refference_id', $free_subject)
                                            ->with('classes')
                                            ->orderBy('title', 'ASC')->get();
                    if(isset($getFreeCourses)){
                        foreach($getFreeCourses as $val){
                            $chapterCount+=count($val->classes);
                            foreach($val->classes as $valLect){
                                $countLecture+=$valLect->contents->count();
                            }
                        
                        }
                    } 
                    $chapterCount = $chapterCount; 
                    $countLecture = $countLecture;                   
            }
            $courseId = $getData->course_id;
            if($getData->course_id == 0 && !empty($getData->free_subject))
            {
                $free_subject = explode(',',$getData->free_subject);
                if(!empty($free_subject)){
                    $courseId = $free_subject[0];
                }
                
            }
            
            $l_courses      = Course::Published()->latest()->take(3)->get(); // single course details
            foreach($l_courses as $key=>$l_coursesval){
                if($l_coursesval->lms_refference_id == 0 && $l_coursesval->ole_refference_id > 0){
                    $l_courses[$key]->image = "https://olexpert.org.in/public/".$l_coursesval->image;
                }
                if($l_coursesval->lms_refference_id > 0 && $l_coursesval->ole_refference_id > 0){
                    $l_courses[$key]->image = "https://courses.iid.org.in/public/".$l_coursesval->image;
                }
                if($l_coursesval->ole_refference_id == 0 && $l_coursesval->lms_refference_id == 0){
                    $l_courses[$key]->image = "http://entrepreneurindia.tv/public/".$l_coursesval->image;
                }
            }
            $sug_courses    = Course::Published()->take(8)->get()->shuffle(); // suggession courses
            foreach($sug_courses as $key=>$sug_coursesval){
                if($sug_coursesval->lms_refference_id == 0 && $sug_coursesval->ole_refference_id > 0){
                    $sug_courses[$key]->image = "https://olexpert.org.in/public/".$sug_coursesval->image;
                }
                if($sug_coursesval->lms_refference_id > 0 && $sug_coursesval->ole_refference_id > 0){
                    $sug_courses[$key]->image = "https://courses.iid.org.in/public/".$sug_coursesval->image;
                }
                if($sug_coursesval->ole_refference_id == 0 && $sug_coursesval->lms_refference_id == 0){
                    $sug_courses[$key]->image = "http://entrepreneurindia.tv/public/".$sug_coursesval->image;
                }
            }
            $s_course       = Course::Published()->where('ole_refference_id', $courseId)->with('classes')
                                    ->orderBy('title', 'ASC')->first(); // single course details
            if($s_course->lms_refference_id == 0 && $s_course->ole_refference_id > 0){
                $s_course->image = "https://olexpert.org.in/public/".$s_course->image;
            }
            if($s_course->lms_refference_id > 0 && $s_course->ole_refference_id > 0){
                $s_course->image = "https://courses.iid.org.in/public/".$s_course->image;
            }
            if($s_course->ole_refference_id == 0 && $s_course->lms_refference_id == 0){
                $s_course->image = "http://entrepreneurindia.tv/public/".$s_course->image;
            }

            foreach($s_course->classes as $s_courseClassval){
                foreach($s_courseClassval->contents as $key=>$s_coursecontentsval){
                    // print_r($s_coursecontentsval->ole_reff_content_id); die;
                    if($s_coursecontentsval->lms_reff_content_id == 0 && $s_coursecontentsval->ole_reff_content_id > 0){
                        $s_courseClassval->contents[$key]->file = "https://olexpert.org.in/public/".$s_coursecontentsval->file;
                    }
                    if($s_coursecontentsval->lms_reff_content_id > 0 && $s_coursecontentsval->ole_reff_content_id > 0){
                        $s_courseClassval->contents[$key]->file = "https://courses.iid.org.in/public/".$s_coursecontentsval->file;
                    }
                    if($s_coursecontentsval->ole_reff_content_id == 0 && $s_coursecontentsval->lms_reff_content_id == 0){
                        $s_courseClassval->contents[$key]->file = "http://entrepreneurindia.tv/public/".$s_coursecontentsval->file;
                    } 
                }
            }
            $count=0;
            if(isset($s_course)){
                foreach($s_course->classes as $val){
                    $count+=$val->contents->count();
                }
            } 
            $count = $count;    
            
            
            // $tt = \Illuminate\Support\Facades\Auth::id();
            $getAddToCartData = UserAddtocartPackage::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                                        ->where('package_id','=',$id)
                                                        ->where('enrollment_id','=',$enroll_id)
                                                        ->where('status','=',1)
                                                        ->first();
            //echo "<pre>";print_r($getAddToCartData);exit;

        }else{
           $idGet = explode('_',$id);
           $cGetId = 'qtr';

           $getAddon   = PackageAddonService::join('services','services.id','=','package_addon_services.addon_service_id')
                                           ->where('package_addon_services.package_id','=',$id)
                                           ->where('package_addon_services.status','=','1')
                                           ->select('package_addon_services.*','services.service_name')
                                           ->get(); 
           
           $getData    = PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
                                       ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
                                       ->leftjoin('courses as c','c.ole_refference_id','=','package_settings.course_id')
                                       ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title','c.big_description','c.short_description','c.meta_title','c.meta_description','c.tag','c.ole_refference_id','c.lms_refference_id')
                                       ->where('package_settings.id','=',$id)
                                       ->orderBy('id', 'DESC')->first();
                                   // echo '<pre>'; print_r($getData); die;
           //print_r($getData); 
           
           if($b2bpricing_mechanisms){
               if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
                   $getData->annually_coverage_price = round($getData->annually_coverage_price + ($getData->annually_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                   $getData->halfyrly_coverage_price = round($getData->halfyrly_coverage_price + ($getData->halfyrly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                   $getData->quarterly_coverage_price = round($getData->quarterly_coverage_price + ($getData->quarterly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);              
               }
               if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
                   $getData->annually_coverage_price = round($getData->annually_coverage_price - ($getData->annually_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                   $getData->halfyrly_coverage_price = round($getData->halfyrly_coverage_price - ($getData->halfyrly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                   $getData->quarterly_coverage_price = round($getData->quarterly_coverage_price - ($getData->quarterly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);             
               }
           }else{
               $getData->annually_coverage_price = round($getData->annually_coverage_price, 0);
               $getData->halfyrly_coverage_price = round($getData->halfyrly_coverage_price, 0);
               $getData->quarterly_coverage_price = round($getData->quarterly_coverage_price, 0);
           }

           
            if($getData->lms_refference_id == 0 && $getData->ole_refference_id > 0){
                $getData->pkg_image = "https://olexpert.org.in/public/".$getData->pkg_image;
            }
            if($getData->lms_refference_id > 0 && $getData->ole_refference_id > 0){
                $getData->pkg_image = "https://courses.iid.org.in/public/".$getData->pkg_image;
            }
            if($getData->ole_refference_id == 0 && $getData->lms_refference_id == 0){
                $getData->pkg_image = "http://entrepreneurindia.tv/public/".$getData->pkg_image;
            }
           
            if(Auth::user()){
                if(Auth::user()->user_type == 'Student'){//echo "HERE";exit;
                   $enrollCourses = Enrollment::where(['user_id'=>Auth::user()->id,'type'=>1,'package_id'=>$id])->first();

                   $getAddToCartData = UserAddtocartPackage::where('user_id', \Illuminate\Support\Facades\Auth::id())
                   ->where('package_id','=',$id)
                   ->where('enrollment_id','=',$enrollCourses->id??null)
                   ->where('status','=',1)
                   ->first();
                }
            }
        //    dd($getData); die;
            $getFreeCourses=array();
            $chapterCount=0;
            $countLecture=0;
            if(isset($getData->free_subject)){

               $free_subject = explode(',',$getData->free_subject);
               $getFreeCourses = Course::Published()
                                           ->whereIn('ole_refference_id', $free_subject)
                                           ->with('classes')
                                           ->orderBy('title', 'ASC')->get();
                   if(isset($getFreeCourses)){
                       foreach($getFreeCourses as $val){
                           $chapterCount+=count($val->classes);
                           
                           foreach($val->classes as $valLect){
                               $countLecture+=$valLect->contents->count();
                               
                           }
                       
                       }
                   } 
                   $chapterCount = $chapterCount; 
                   $countLecture = $countLecture;                   
            }
            $l_courses      = Course::Published()->latest()->take(3)->get(); // single course details
            foreach($l_courses as $key=>$l_coursesval){
                if($l_coursesval->lms_refference_id == 0 && $l_coursesval->ole_refference_id > 0){
                    $l_courses[$key]->image = "https://olexpert.org.in/public/".$l_coursesval->image;
                }
                if($l_coursesval->lms_refference_id > 0 && $l_coursesval->ole_refference_id > 0){
                    $l_courses[$key]->image = "https://courses.iid.org.in/public/".$l_coursesval->image;
                }
                if($l_coursesval->ole_refference_id == 0 && $l_coursesval->lms_refference_id == 0){
                    $l_courses[$key]->image = "http://entrepreneurindia.tv/public/".$l_coursesval->image;
                }
            }
            $sug_courses    = Course::Published()->take(8)->get()->shuffle(); // suggession courses
            foreach($sug_courses as $key=>$sug_coursesval){
                if($sug_coursesval->lms_refference_id == 0 && $sug_coursesval->ole_refference_id > 0){
                    $sug_courses[$key]->image = "https://olexpert.org.in/public/".$sug_coursesval->image;
                }
                if($sug_coursesval->lms_refference_id > 0 && $sug_coursesval->ole_refference_id > 0){
                    $sug_courses[$key]->image = "https://courses.iid.org.in/public/".$sug_coursesval->image;
                }
                if($sug_coursesval->ole_refference_id == 0 && $sug_coursesval->lms_refference_id == 0){
                    $sug_courses[$key]->image = "http://entrepreneurindia.tv/public/".$sug_coursesval->image;
                }
            }
            $s_course = Course::Published()->where('ole_refference_id', $getData->course_id)->with('classes')
                                   ->orderBy('title', 'ASC')->first(); // single course details
            

            if($s_course->lms_refference_id == 0 && $s_course->ole_refference_id > 0){
                $s_course->image = "https://olexpert.org.in/public/".$s_course->image;
            }
            if($s_course->lms_refference_id > 0 && $s_course->ole_refference_id > 0){
                $s_course->image = "https://courses.iid.org.in/public/".$s_course->image;
            }
            if($s_course->ole_refference_id == 0 && $s_course->lms_refference_id == 0){
                $s_course->image = "http://entrepreneurindia.tv/public/".$s_course->image;
            }

            foreach($s_course->classes as $s_courseClassval){
                foreach($s_courseClassval->contents as $key=>$s_coursecontentsval){
                    // print_r($s_coursecontentsval->ole_reff_content_id); die;
                    if($s_coursecontentsval->lms_reff_content_id == 0 && $s_coursecontentsval->ole_reff_content_id > 0){
                        $s_courseClassval->contents[$key]->file = "https://olexpert.org.in/public/".$s_coursecontentsval->file;
                    }
                    if($s_coursecontentsval->lms_reff_content_id > 0 && $s_coursecontentsval->ole_reff_content_id > 0){
                        $s_courseClassval->contents[$key]->file = "https://courses.iid.org.in/public/".$s_coursecontentsval->file;
                    }
                    if($s_coursecontentsval->ole_reff_content_id == 0 && $s_coursecontentsval->lms_reff_content_id == 0){
                        $s_courseClassval->contents[$key]->file = "http://entrepreneurindia.tv/public/".$s_coursecontentsval->file;
                    } 
                }
            }

            // print_r(); die;

           $count=0;
           if(isset($s_course)){
               foreach($s_course->classes as $val){
                   $count+=$val->contents->count();

               }
           } 
           $count = $count;    
       }     
       $pageMeta =[];  
       $setValues= '';           
       if($getData->meta_title) {

          $getCodes = json_decode($getData->meta_title);
          $meta_titles = array();
          if(!empty($getCodes)){
           foreach($getCodes as $code){
               $meta_titles[] = trim($code);
           }
          }
         //print_r(trim($getCodes )) ; die;
          $setValues = implode(', ', $meta_titles); 
       } 
       $setTags ='';
       // echo "<pre>";
       // print_r($getData->tag); die();
       if($getData->tag)  {
           $getTag = json_decode($getData->tag);
           $meta_Tag = array();
           if(!empty($getTag)){
             foreach($getTag as $codegetTag){
                 $meta_Tag[] = trim($codegetTag);
             }
            }
           $setTags = implode(', ', $meta_Tag); 
       }                       
       $pageMeta['meta_title'] = $setValues;
       $pageMeta['meta_description'] = $getData->meta_description;
       $pageMeta['tag'] = $setTags;

    // return view($this->theme.'.packages.preview_board',compact('enrollCourses','getAddToCartData','countLecture','chapterCount','getFreeCourses','count','getData','cGetId','getAddon','s_course', 'l_courses', 'sug_courses','pageMeta'));

    return Response::json(compact('enrollCourses','getAddToCartData','countLecture','chapterCount','getFreeCourses','count','getData','cGetId','getAddon','s_course', 'l_courses', 'sug_courses','pageMeta'), 200);

   }


    public function demoCourses(Request $request){
        try {
            if(isset($request->limit)){
                $cat = Category::Published()->where('slug', $request->slug)->first();
                $categoriesName = Category::Published()->where('parent_category_id', $cat->id)->select('id','name')->get();
                $categories = Category::Published()->where('parent_category_id', $cat->id)->pluck('id');
                $courses = Course::with('classes')->Published()->whereIn('category_id', $categories->toArray())->limit(3)->get();
                $data = array();
                $x=0;
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
                                    if(!empty($item_content->demo_url) && $x <= $request->limit)
                                    {
                                        $data[] = array('category_id'=>$course->category->id,'category_name'=>$course->category->name,'demo_url'=>$item_content->demo_url,'demo_type'=>$item_content->demo_type,'chapter_name'=>$item_content->title,'subject_name'=>$course->title,'course_image'=>$course->image);
                                    $x++;
                                    }
                                }
                            }
                                
                        }
                    }
                }
                return Response::json(compact('data'), 200);
            }
            if($request->cat_id){
                $courses = Course::with('classes')->Published()->where('category_id', $request->cat_id)->get();
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
                                        $data[] = array('category_id'=>$course->category->id,'category_name'=>$course->category->name,'demo_url'=>$item_content->demo_url,'demo_type'=>$item_content->demo_type,'chapter_name'=>$item_content->title,'subject_name'=>$course->title,'course_image'=>$course->image);
                                    }
                                }
                            }
                                
                        }
                    }
                }
                return Response::json(compact('data'), 200);
            }
            $cat = Category::Published()->where('slug', $request->slug)->first();
            $categoriesName = Category::Published()->where('parent_category_id', $cat->id)->select('id','name')->get();
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
                                    $data[] = array('category_id'=>$course->category->id,'category_name'=>$course->category->name,'demo_url'=>$item_content->demo_url,'demo_type'=>$item_content->demo_type,'chapter_name'=>$item_content->title,'subject_name'=>$course->title,'course_image'=>$course->image);
                                }
                            }
                        }
                            
                    }
                }
            }
            return Response::json(compact('categoriesName','data'), 200);
        }
        catch (\Exception $e) {
            return Response::json(["message" => "something went wrong" . $e->getMessage()], 400);
        }
    }


}

