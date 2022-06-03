<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\MobileOtp;
use App\LiveClassSubscription;
use App\Model\Testimonial;
use App\Model\StateList;
use App\InstructorLiveClass;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Validator;

class LiveClassSubscriptionController extends Controller
{
    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
    }

    // create subscriber
    public function createSubscription(Request $request) {
        $instructor_live_class_id = $request->instructor_live_class_id?base64_decode($request->instructor_live_class_id):'';
        $states = StateList::get();
        $testimonials = Testimonial::orderby('id', 'desc')->get();
        if(Auth::user() && Auth::user()->user_type == 'Student' && $instructor_live_class_id!=''){
            $liveClass = new LiveClassSubscription();
            $liveClass->name        = Auth::user()->student->name; 
            $liveClass->phone       = Auth::user()->student->phone; 
            $liveClass->email       = Auth::user()->student->email; 
            $liveClass->state       = '0'; 
            $liveClass->class       = ''; 
            $liveClass->stream      = ''; 
            $liveClass->instructor_live_class_id = $instructor_live_class_id; 
            $liveClass->save();

            $instructor = InstructorLiveClass::with('instructorDetail')->where('status', 'Publish')->where('id',$instructor_live_class_id)->first();
            if(isset($instructor) && !empty($instructor)){
                if( strtotime(\Carbon\Carbon::today() ) == strtotime($instructor->date)  && strtotime(\Carbon\Carbon::now()->format('H:i:00')) >= strtotime($instructor->start_time) && strtotime(\Carbon\Carbon::now()->format('H:i:00')) <= strtotime($instructor->end_time) ){
                    $instructor_live_class_id = base64_encode($instructor->id);
                    $rUrl= url("live-class/".$instructor_live_class_id);
                    return redirect($rUrl);
                }else
                    $instructor_live_class_id = base64_encode($instructor->id);
                    $rUrl= url("get-live-class");
                    return redirect($rUrl);
            }
            return view($this->theme.'.liveclasssubscription.index', compact('states','instructor_live_class_id','testimonials'));
            // $message = ' <h3 class="text-success ">Thank you!</h3>
            // <p>You have successfully subscribed for <br><span class="text-uppercase h4 text-success">FREE</span><br> Live Class on<br>
            // <span class="text-info">"'.$instructors->live_class_title.'"</span><br> scheduled on </p>
            // <span class="bg-success text-white font-weight-bold border-success py-2 px-3 rounded">'.date('g:i A', strtotime($instructors->start_time)).','. date('D d M', strtotime($instructors->date)).'</span>';

        }else{
            return view($this->theme.'.liveclasssubscription.index', compact('states','instructor_live_class_id','testimonials'));
        }
    }

    // store subscriber details
    public function storeSubscription(Request $request) {
        $states = StateList::get();
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|min:10',
            'state' => 'required',
            'class_name' => 'required',
            
        ], [
            'name.required' => translate('student name is required'),
            'phone.required' => translate('Phone number is required'),
            'phone.numeric' => translate('Phone number must be numeric'),
            'phone.min' => translate('Phone number must be at least 10 digit'),
            'state.required' => translate('State must be Required'),
            'class_name.required' => translate('Class must be Required')
        ]);

        
            $instructor_live_class_id = (isset($request->instructor_live_class_id))?base64_encode($request->instructor_live_class_id):'';
            
            $liveClass = new LiveClassSubscription();
            $liveClass->name        = $request->name; 
            $liveClass->phone       = $request->phone; 
            $liveClass->email       = $request->email; 
            $liveClass->state       = $request->state; 
            $liveClass->class       = $request->class_name; 
            $liveClass->stream      = isset($request->stream)?$request->stream:''; 
            $liveClass->instructor_live_class_id = $request->instructor_live_class_id; 
            $liveClass->save(); 
            
            if(isset($request->instructor_live_class_id)){
                $instructors = InstructorLiveClass::with('instructorDetail')->where('status', 'Publish')->where('id',$request->instructor_live_class_id)->first();
                $message = ' <h3 class="text-success ">Thank you!</h3>
                <p>You have successfully subscribed for <br><span class="text-uppercase h4 text-success">FREE</span><br> Live Class on<br>
                <span class="text-info">"'.$instructors->live_class_title.'"</span><br> scheduled on </p>
                <span class="bg-success text-white font-weight-bold border-success py-2 px-3 rounded">'.date('g:i A', strtotime($instructors->start_time)).','. date('D d M', strtotime($instructors->date)).'</span>';
            }else{
                $instructors = array();
                $message = '<h3 class="text-success ">Thank you!</h3>
                <p>You have successfully subscribed for <br><span class="text-uppercase h4 text-success">FREE</span><br> Live Class on<br>
                <span class="text-info">"'.$request->class_name.' - '.$request->stream.'"</span><br> Kindly be patience, we will notify you about the live class schedule via Inbox message and email soon.</p>';
            }
            //echo "<pre>";print_r($instructors);exit;
            Session::flash('message',$message);
            return redirect()->route('liveclass.thankyou')->with(['instructor' => $instructors]);
        
    }

    public function sendOtp(Request $request)
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

        $otp = new MobileOtp();
        $otp->country_code = '91';
        $otp->mobile = $mobile;
        $otp->otp = mt_rand(1111, 9999);
        $otp->save();
        $message = $otp->otp . " is the OTP for Login. This OTP is valid for 5 min";
        sendSMS($message, $mobile);

        return Response::json(['message' => 'OTP successfully sent on your verified mobile number. This OTP is valid for 5 min'],200);
        
    }
    
    public function verifyOtp(Request $request)
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

    public function thankyou()
    {
        return view($this->theme.'.liveclasssubscription.thankyou');
    }

    public function liveCompetitiveClass(Request $request)
    {
        $instructor_live_class_id = $request->instructor_live_class_id?base64_decode($request->instructor_live_class_id):'';
        $states = StateList::get();
        $testimonials = Testimonial::orderby('id', 'desc')->get();
        return view($this->theme.'.liveclasssubscription.live_competitive_class', compact('states','instructor_live_class_id','testimonials'));
    } 

    // store subscriber details
    public function storeLiveCompetitiveSubscription(Request $request) {
       // die('============');
        $states = StateList::get();
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|min:10',
            'state' => 'required',
            'exam_name' => 'required',
            
        ], [
            'name.required' => translate('student name is required'),
            'phone.required' => translate('Phone number is required'),
            'phone.numeric' => translate('Phone number must be numeric'),
            'phone.min' => translate('Phone number must be at least 10 digit'),
            'state.required' => translate('State must be Required'),
            'exam_name.required' => translate('Exam must be Required')
        ]);

        
            $instructor_live_class_id = (isset($request->instructor_live_class_id))?base64_encode($request->instructor_live_class_id):'';
            
            $liveClass = new LiveClassSubscription();
            $liveClass->name        = $request->name; 
            $liveClass->phone       = $request->phone; 
            $liveClass->email       = $request->email; 
            $liveClass->state       = $request->state; 
            $liveClass->class       = ''; 
            $liveClass->stream      = $request->exam_name; 
            $liveClass->instructor_live_class_id = $request->instructor_live_class_id; 
            $liveClass->save(); 
            
            if(isset($request->instructor_live_class_id)){
                $instructors = InstructorLiveClass::with('instructorDetail')->where('status', 'Publish')->where('id',$request->instructor_live_class_id)->first();
                $message = ' <h3 class="text-success ">Thank you!</h3>
                <p>You have successfully subscribed for <br><span class="text-uppercase h4 text-success">FREE</span><br> Live Class on<br>
                <span class="text-info">"'.$instructors->live_class_title.'"</span><br> scheduled on </p>
                <span class="bg-success text-white font-weight-bold border-success py-2 px-3 rounded">'.date('g:i A', strtotime($instructors->start_time)).','. date('D d M', strtotime($instructors->date)).'</span>';
            }else{
                $message = '<h3 class="text-success ">Thank you!</h3>
                <p>You have successfully subscribed for <br><span class="text-uppercase h4 text-success">FREE</span><br> Live Class on<br>
                <span class="text-info">"'.$request->exam_name.'"</span><br> Kindly be patience, we will notify you about the live class schedule via Inbox message and email soon.</p>';
            }
            Session::flash('message',$message);
            return redirect()->route('subscribe-thanks')->with('');
        
    }

    public function subscribe_thanks()
    {
        return view($this->theme.'.liveclasssubscription.subscribe-thanks');
    }

    public function viewLiveClass(Request $request)
    {
        $instructor_live_class_id = (isset($request->instructor_live_class_id))?base64_decode($request->instructor_live_class_id):'';
        $instructor = InstructorLiveClass::with('instructorDetail')->where('status', 'Publish')->where('id',$instructor_live_class_id)->first();
        //echo "<pre>";print_r($instructor);exit;
        return view($this->theme.'.liveclasssubscription.view_live_class',compact('instructor'));
    }

 
}
