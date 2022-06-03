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

class BcartController extends Controller
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

/*cart the course*/
public function addToBcart(Request $request)
{
    $cart = null;
    if (Auth::user()->user_type != "Student") {
        \auth()->logout();
        return response('Your credentials does not match.', 403);
    }
    if($request->work=='project_report' && $request->id!=''){
        $bCartData = DB::table('project_reports_data')->where('id',$request->id)->whereNull('deleted_at')->select('id','price')->first();
        $school_id = \Session::get('school_id');
        $b2bpricing_mechanisms = DB::table('b2bpricing_mechanisms')->where('school_id', $school_id)->first();
        if($b2bpricing_mechanisms){
            if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
                $getDataPrice = round($bCartData->price + ($bCartData->price * ($b2bpricing_mechanisms->value/100)), 0);             
            }
            if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
                $getDataPrice = round($bCartData->price - ($bCartData->price * ($b2bpricing_mechanisms->value/100)), 0);     
            }
        }else{
            $getDataPrice = round($bCartData->price, 0);
        }
        $values = [
            'user_id' => Auth::user()->id,
            'course_price' => $getDataPrice,
            'course_id' => $bCartData->id,
            'type' => $request->work,
        ];
        $bcarts = DB::table('bcarts')->insert($values);    
        if($bcarts){
            return true;
        }else{
            return false;
        }
    }
}





/*add to cart remove*/
public function removeBcart($id)
{
    session()->forget('coupon');
    session()->forget('FIRST_COURSE_FREE');
    $carts = DB::table('bcarts')->where('user_id', Auth::id())->where('id', $id)->delete();
    return back();
}

/*add to cart remove*/

   
public function shoppingBcart(Request $request)
{
    $cartList = DB::table('bcarts')
                    ->join('project_reports_data as prd', 'prd.id','=','bcarts.course_id')
                    ->where('user_id', Auth::id())->select('bcarts.id as cartId','prd.title','prd.thumbnail','bcarts.course_price as price')->get();   
    return view($this->theme.'.cart.bCart-index',compact('cartList'));              
}




}
