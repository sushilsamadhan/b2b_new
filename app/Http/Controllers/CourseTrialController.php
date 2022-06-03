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

use App\PackageSetting;
use Symfony\Component\HttpFoundation\Cookie;
use Validator;

class CourseTrialController extends Controller
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

    //lesson_details
    public function lesson_details($slug,$cat_name,$uri1,$uri2)
    {
        //Session::put('location_path', $slug);
        

        
        if (zoomActive()){
            $s_course = Course::Published()->where('slug', $slug)->with('classes')->with('meeting')->first();
        }else{            
            $s_course = Course::Published()->where('slug', $slug)->with('classes')->first(); // single course details
        }

        $returnUrl = route('packages.preview_board',[$cat_name,$uri1,$uri2]);

        //$enroll = Enrollment::where('course_id', $s_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
        //$pkgId = '';
        
        // if ($enroll->count() == 0) {
        //     return back();
        // }
        $getChapter = '';
        $pkgId = '';
        $enroll = array();
        // if(isset($enroll) && count($enroll)>0 && $enroll[0]->type=='1'){
        //     $getChapter = UserAddtocartPackage::where('enrollment_id','=',$enroll[0]->id)->first();
        //     $getChapter = $getChapter->course_id;
        //     $pkgId = $enroll[0]->package_id;
        // }
        $comments = CourseComment::latest()->with('user')->get();
        $time_left = 1;
        $seens = 1;
        // check whether course content seen or not
        // if(!empty($s_course->min_course_time)){
        //     $seens = SeenContent::where('course_id', $s_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->count();
        //     $lesson_track = QuizTracking::where('course_id', $s_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->where('enroll_id', $enroll->first()->id)->first();
        //     if ($lesson_track) {
        //         $time_left = $lesson_track->time_left;
        //     } else {
        //         $time_left = $s_course->min_course_time;
        //     }
        // }
        

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
        if(!empty($enroll) && $enroll[0]['type'] =='1') {
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
        return view($this->theme.'.course.lesson.trial_lesson_details', compact('boardName','pkgId','getChapter','mockTests','s_course', 'comments', 'enroll', 'seens', 'time_left', 'quiz_status','PackageDetail','totalAttend','totalUnitAttend', 'totalChapterAttend','subjectTests','returnUrl'));
      }

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
        //   if ($seens->count() == 0) {
        //       $seen = new SeenContent();
        //       $seen->class_id = $content->class_id;
        //       $seen->content_id = $content->id;
        //       $seen->course_id = $course_id;
        //       $seen->enroll_id = $enroll_id;
        //       $seen->user_id = Auth::id();
        //       $seen->saveOrFail();
        //   }
          return response()->json($demo);
      }



    public function view_mind_map_demo(Request $request){

        $contentId = request()->segment(3);
        // return $contentId;
         $getMinMaps = MindMap::where('class_content_id',$contentId)->get();
       
         // /course-trial/biology-class11-cbse-demo/206/cbse-class-11/all-subjects-pcb
         
         // $lesson_page_url = route('course-trial',[Session::get('location_path'),Session::get('location_path1')]);
         $lesson_page_url = '';
        // print_r($lesson_page_url); die();
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
        return view($this->theme.'.course.lesson.view_mind_map_demo',compact('getMinMaps','otherMinMaps','freshOtherMindMapArr','lesson_page_url'));

    }
   
}
