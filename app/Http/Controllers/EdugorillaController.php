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

class EdugorillaController extends Controller
{

    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
    }

    /*public function testSeriesAuth(Request $request) { 


        
        $aa = $request->header();
       // print_r($aa); die('=======');
      /// $request->header($_COOKIE["eg_ole_user"]);
    //   print_r($aa['cookie'][0]);
    //    die;
        //print_r($aa); die;
         if(!empty($aa['cookie'][0])) {
              
             $getuserDetail = explode('=',$aa['cookie'][0]);
             //print_R($getuserDetail); die;
             
             $user = User::where('email',$getuserDetail[1])->first();
             //print_r($user); die('------');
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
 
     }*/


    public function testSeriesAuth(Request $request) {
       // echo "HETE";exit;
        $coke = '';
        $aa = $request->header();
        //var_dump($aa['cookie']); 
        $coke = $aa['cookie'][0];

       /* if(!empty($aa['cookie'][0])) {
              
            $getuserDetail = explode('=',$aa['cookie'][0]);
            $substrArr = explode(";",$getuserDetail[2]);
           //  print_r($substrArr[0]); die;
            $user = User::where('email',$substrArr[0])->first();

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
        }    

         
         else */ if(!empty($coke)) {
             $email = '';
             $substrArr = explode(";",$coke);
             if(!empty($substrArr)){
                 foreach($substrArr as $k=>$val)
                     //preg_match("/eg_user/i", $val);
                     if(preg_match("/eg_ole_user/i", $val)){
                         $getuserDetail = explode('=',$val);
                         $email = $getuserDetail[1]; 
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
}
