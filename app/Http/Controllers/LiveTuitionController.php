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

class LiveTuitionController extends Controller
{
    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
    }
    // function userNotify($user_id,$details)
    // {
    //     $notify = new NotificationUser();
    //     $notify->user_id = $user_id;
    //     $notify->data = $details;
    //     $notify->save();
    // }
    public function classSchedule(){
    if(Auth::user()){  
date_default_timezone_set("Asia/Calcutta");
$currentdate = date('H:i', time());
// $startTime = date("H:i", strtotime('- 10 minutes', strtotime($currentdate)));
    $dataBooking = DB::table('tuition_booking as tuibook')
        ->join('instructor_subjects as inssub','inssub.id','=','tuibook.instructor_subjects_id')
        ->join('users','users.id','=','tuibook.user_id')
        ->join('instructors','instructors.id','=','inssub.instructor_id')
        ->leftjoin('courses as c','c.id','=','inssub.subject_id')
        ->leftjoin('categories as cat','cat.id','=','inssub.class_id')
        ->leftjoin('categories as cat2','cat2.id','=','inssub.course_id')
        ->where('tuibook.user_id',Auth::id())
        ->where('tuibook.date_of_booking', '>=', date('Y-m-d'))
        ->where('tuibook.start_time', '>', $currentdate)
        ->where('inssub.live_classes_type','tutition')
        ->select('tuibook.start_time','tuibook.end_time','tuibook.date_of_booking','tuibook.unic_jitsi_code','c.title','tuibook.time_of_booking','users.name as uname','instructors.name as insname','instructors.image','cat.name as classname','cat2.name as boardname')
        ->orderBy('cat.name','asc')
        ->orderBy('date_of_booking')
        ->paginate(4);


        $student = \App\Model\Student::where('user_id','=',Auth::user()->id)->first();
            return view($this->theme.'.homepage.live-tuition',compact('student','dataBooking'));
    }else{
        $student = array();
        $dataBooking=array();
       return view($this->theme.'.homepage.live-tuition',compact('student','dataBooking'));
    }
        
    }
    public function get_board(){
        $boards = \App\Model\Category::where('parent_category_id',83)->get();
        echo '<option value="">Select</option>';
            foreach($boards as $boardsval){
        echo '<option value="'.$boardsval->id.'">'.$boardsval->name.'</option>';
        }
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

           echo '<option value="">Select</option>';
            foreach($classes as $classesval){
                echo '<option value="'.$classesval->id.'">'.$classesval->name.'</option>';
        }
    }
    public function get_board_classes_subjects($id){



        $courses_detail = Course::where("category_id",$id)->where('is_free','=','0')->pluck('title','id');
        if($courses_detail){
            return response()->json($courses_detail);
        }else{
            echo 1;
        }
    }


public function tuition_get_instructor_schedule($subject_id,$class_id){
            $getTimeTables  =   \App\InstructorAssessment::leftjoin('categories as cat','cat.id','=','instructor_subjects.course_id')
            ->leftjoin('categories as subCat','subCat.id','=','instructor_subjects.class_id')
            ->leftjoin('courses as c','c.id','=','instructor_subjects.subject_id')
            ->leftjoin('question_tags as d','d.id','=','instructor_subjects.subject_id')
            ->leftjoin('instructors as ins','ins.id','=','instructor_subjects.instructor_id')
            ->select('subCat.name as subCat','cat.name','c.title','d.tag_name','instructor_subjects.*','ins.name','ins.image')
            ->orderBy('id', 'DESC')
            ->where('instructor_subjects.subject_id','=',$subject_id)
            ->where('instructor_subjects.instructor_type','=','2')
            ->where('instructor_subjects.class_id','=',$class_id)
            ->get();
        $formatedate = '';
        if (isset($_GET['date'])) {
            $formatedate = $_GET['date'];
            $todayname = date('l', strtotime($_GET['date']));
        }else{
            $todayname = date('l', strtotime(date('Y-m-d')));
            $formatedate = date('Y-m-d');
        }

        return view('rumbok.homepage.show-live-tuition',compact('getTimeTables','todayname','formatedate'));
}

public function store_student_board_classes_subjects(){

      $updatestudent = DB::table('students')
            ->where('user_id', Auth::user()->id)
            ->update($_GET);
    if ($updatestudent) {
        echo 1;
    }
}



public function tuition_get_instructor_schedule_time($subject_id,$class_id){
            $getTimeTables  =   \App\InstructorAssessment::leftjoin('categories as cat','cat.id','=','instructor_subjects.course_id')
            ->leftjoin('categories as subCat','subCat.id','=','instructor_subjects.class_id')
            ->leftjoin('courses as c','c.id','=','instructor_subjects.subject_id')
            ->leftjoin('question_tags as d','d.id','=','instructor_subjects.subject_id')
            ->leftjoin('instructors as ins','ins.id','=','instructor_subjects.instructor_id')
            ->select('subCat.name as subCat','cat.name','c.title','d.tag_name','instructor_subjects.*','ins.name','ins.image')
            ->orderBy('id', 'DESC')
            ->where('instructor_subjects.subject_id','=',$subject_id)
            ->where('instructor_subjects.instructor_type','=','2')
            ->where('instructor_subjects.class_id','=',$class_id)
            ->get();
        $formatedate = ''; 
        if (isset($_GET['date'])) {
            $formatedate = $_GET['date'];
            $todayname = date('l', strtotime($_GET['date']));
        }else{
            $todayname = date('l', strtotime(date('Y-m-d')));
            $formatedate = date('Y-m-d');
        }
        return view('rumbok.homepage.show-live-tuition-time',compact('getTimeTables','todayname','formatedate'));
}


public function store_board_class_schedule(Request $request){
    $n=12;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  

    $startend = (explode("-",$request->time_of_booking));
    $st = date('H:i', strtotime($startend[0]));
    $et = date('H:i', strtotime($startend[1]));
        $arrayName = array(
            'user_id' => $request->user_id, 
            'instructor_subjects_id' => $request->instructor_subjects_id, 
            'date_of_booking' => $request->date_of_booking, 
            'time_of_booking' => $request->time_of_booking , 
            'start_time' => $st, 
            'end_time' => $et, 
            'tutitionschedules_id' => $request->tutitionschedules_id, 
            'unic_jitsi_code' => $randomString
        );
        $insertbooking = DB::table('tuition_booking')->insert($arrayName);
        if ($insertbooking) {
            return 1;
        }
    }
}
