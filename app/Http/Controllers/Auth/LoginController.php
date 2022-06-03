<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Instructor;
use App\Model\PackagePurchaseHistory;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {

        if ($user->school_id != Session::get('school_id') && $user->id != 5) {
            auth()->logout();
            throw ValidationException::withMessages([
                $this->username() => [trans('Sorry, your are not register this school.')],
            ]);
        }
        //Auth::logoutOtherDevices($request->password);
        /*check  the user is payment clear*/
        if ($user->user_type == "Instructor") {
            /*check the payment */
            $ins = Instructor::where('user_id',$user->id)->first();
            $pa = PackagePurchaseHistory::where('user_id',$user->id)->where('package_id',$ins->package_id)->first();
            if($pa == null){
                auth()->logout();
                return redirect()->route('instructor.payment',$user->slug);
            }
        }


        if (!$user->verified) {
            $id = $user->id;
            auth()->logout();
            return view('auth.verify', compact('id'));
        }

        if ($user->banned == true && $user->user_type == "Instructor") {
            auth()->logout();
            return back()->with('warning', translate('You are banned By The Admin, Please Contact with admin'));
        }

        if ($user->user_type == "Student") {
            Auth::logoutOtherDevices($request->password);
            if(Session::get('test-series') != '') {
                return redirect()->to('/test-series');
            }
            if(Session::get('remember_url') != '') {
                return redirect()->to(Session::get('remember_url'));
            }
            if(!empty($request->referral_url) && basename($request->referral_url)!='signup'){
                return redirect()->to($request->referral_url);
            }else{
                return redirect()->to('/');
            }
            
        }

        /*check the instructor paid the package payment*/
      /*  if($user->user_type == "Instructor"){
            $ins = Instructor::with('purchaseHistory')->where('user_id',$user->id)->first();
            if($ins->purchaseHistory == null){
                return redirect()->route('instructor.payment',$user->slug);
            }
        }*/


    }


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('Sorry, your password or email was incorrect.')],
        ]);
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
