<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Model\Cart;
use App\Model\Wishlist;
use App\Model\Enrollment;
use App\Model\Instructor;
use App\Model\Package;
use App\Model\Course;
use App\Model\AdminEarning;
use App\Model\InstructorEarning;
use App\Model\CoursePurchaseHistory;
use App\OrderDetail;
use App\Coupon;
use App\User;
use App\NotificationUser;
use App\UserAddtocartPackage;
use App\Notifications\AffiliateCommission;
use App\Notifications\EnrolmentCourse;
use App\Notifications\InstructorRegister;
use App\Notifications\StudentRegister;
use App\Notifications\VerifyNotifications;
use Tzsk\Payu\Concerns\Attributes;
use Tzsk\Payu\Concerns\Customer;
use Tzsk\Payu\Concerns\Transaction;
use Tzsk\Payu\Facades\Payu;
use Alert;
use App\Model\PwEnrollment;
class PayUMoneyController extends Controller
{


    public function directCheckout(Request $request)
    {
        $customer = Customer::make()
            ->firstName($request->fname)
            ->email($request->alternate_email_user?$request->alternate_email_user:'info@ole.org.in')
            ->phone($request->mobile);
        $attributes = Attributes::make()
            ->udf1($request->udf1?$request->udf1:'')
            ->udf2($request->udf2?$request->udf2:'');
        $transaction = Transaction::make()
            ->charge($request->amount)
            ->for($request->pinfo)
            ->with($attributes) // Only when using any custom attributes
            ->to($customer);

    return Payu::initiate($transaction)->via('money')->redirect(route('payu.response'));
        die('=========');
    }


        public function index(Request $request)
        {
    
    //   $attributes = [
    //     'txnid' => strtoupper(Str::random()).Auth::id(), # Transaction ID.
    //     'amount' => 1, # Amount to be charged.
    //     'productinfo' => "Product Information",
    //     'firstname' => Auth::user()->name, # Payee Name.
    //     'email' => 'helpdesk@udyami.org.in', # Payee Email Address.
    //     'phone' => Auth::user()->email, # Payee Phone Number.
    //     'lastname' => $request->id,
        
    //   ];

    $customer = Customer::make()
        ->firstName($request->fname)
        ->email($request->alternate_email_user?$request->alternate_email_user:'info@ole.org.in')
        ->phone($request->mobile);

    // This is entirely optional custom attributes
    $attributes = Attributes::make()
        ->udf1($request->udf1?$request->udf1:'')
        ->udf2($request->udf2?$request->udf2:'');

    $transaction = Transaction::make()
        ->charge($request->amount)
        ->for($request->pinfo)
        ->with($attributes) // Only when using any custom attributes
        ->to($customer);

    return Payu::initiate($transaction)->via('money')->redirect(route('payu.response'));

    //   return Payment::make($attributes, function ($then) {
    //     $then->redirectTo('payment/success');
    //   });
    
      //return Redirect::to('/dashboard?payment=false');
    
  }

  public function response(Request $request)
  {
    $transaction = Payu::capture();
    if ($transaction->successful()) {
      if($transaction->response('udf1')=='project_work')
      {
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
            $couponCode         = null;
            $coupon_id          = null;
            $couponPriceValue = null;
            $orderTotal         = $transaction->response('net_amount_debit');

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
        $orderDetails->transaction_id = $transaction->response('txnid');
        $orderDetails->transaction_amount = $transaction->response('net_amount_debit');
        $orderDetails->transaction_status = 'SUCCESS';//$transaction->response('txnStatus');
        $orderDetails->transaction_date = $transaction_date;
        $orderDetails->transaction_type = 'On Line';
        $orderDetails->transaction_mode = $transaction->response('mode');
        $orderDetails->save();

        $projectWorkEnroll = new PwEnrollment;
        $projectWorkEnroll->project_work_id = $transaction->response('udf2');
        $projectWorkEnroll->user_id = Auth::id();
        $projectWorkEnroll->project_work_enrollment_date = date("Y-m-d H:i:s");
        $projectWorkEnroll->order_detail_id = $orderDetails->id;
        $projectWorkEnroll->save();
        Session::flash('message', translate('Congratulations, Your enrollment is done successfully.'));
        return redirect()->route('my.projectwork');
      }
      $carts = Cart::with('course')->where('user_id', Auth::id())->whereNotNull('course_id')->whereNull('package_id')->get();
     
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
          $couponCode         = null;
          $coupon_id          = null;
          $couponPriceValue = null;
          $orderTotal         = $transaction->response('net_amount_debit');

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
      $orderDetails->transaction_id = $transaction->response('txnid');
      $orderDetails->transaction_amount = $transaction->response('net_amount_debit');
      $orderDetails->transaction_status = 'SUCCESS';//$transaction->response('txnStatus');
      $orderDetails->transaction_date = $transaction_date;
      $orderDetails->transaction_type = 'On Line';
      $orderDetails->transaction_mode = $transaction->response('mode');
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
      session()->forget('coupon');
      session()->forget('FIRST_COURSE_FREE');
      Session::flash('message', translate('Congratulations, Your enrollment is done successfully.'));
      return redirect()->route('my.packages');
  } else {
      Alert::error('error', 'Payment not proceed. Please try again!');
      return redirect()->route('homepage');
  }
  }
  function userNotify($user_id,$details)
  {
      $notify = new NotificationUser();
      $notify->user_id = $user_id;
      $notify->data = $details;
      $notify->save();
  }
 
}
