<?php

namespace App\Http\Controllers\UserManager;


use App\Http\Controllers\Controller;
use App\Model\VerifyUser;
use App\Notifications\VerifyNotifications;
use Illuminate\Support\Str;

use App\User;
use Auth;
use Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*user list*/
    public function index(Request $request)
    {
        $users = User::where('user_type', 'Admin')->get();
        return view('userManager.user.index')->with('users', $users);
    }

    /*user create form*/
    public function create()
    {

        return view('userManager.user.create');
    }

    /*new user store done*/
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
            [
                'name.required' => translate('Name is required'),
                'email.required' => translate('Email is required'),
                'email.email' => translate('This is not an email format'),
                'email.unique' => translate('Email must be unique'),
                'password.required' => translate('Password is required'),
                'password.confirmed' => translate('Password must be matched'),
            ]);

        $user = new User();
        $user->name = $request->name;
        $slug = Str::slug($request->name);
        $user_s = User::where('slug',$slug)->get();
        if ($user_s->count() > 0){
            $slug =$slug.($user_s->count()+1);
        }
        $user->slug = $slug;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = "Admin";
        if ($user->save()) {
            //verify email

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);

            $details = [
                'name' => $request->name,
                'user_id' => $user->id,
                'body' => 'New user registered named ',
            ];
            try {
                $user->notify(new VerifyNotifications($user));
            }catch (\Exception $exception){}
            notify()->success($request->name . ' ' . translate('User Create Successfully'));
            return back();
        } else {
            notify()->error(translate('There are Some Problem Try again'));
            return back();
        }
    }

    /*User show */
    public function show($id)
    {
        $user = User::where('id', $id)->where('user_type', 'Admin')->firstOrFail();
        return view('userManager.user.show')->with('user', $user);
    }

    /*user edit form*/
    public function edit($id)
    {
        $user = User::where('id', Auth::id())->first();
        return view('userManager.user.edit')->with('user', $user);
    }

    /*user update*/
    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'id' => 'required',
        ]);
        if ($request->hasFile('newImage')) {
            fileDelete($request->image);
            $image = fileUpload($request->newImage, 'user');
        } else {
            $image = $request->image;
        }
        $slug = Str::slug($request->name);
        $user_s = User::where('slug',$slug)->get();
        if ($user_s->count() > 0){
            $slug =$slug.($user_s->count()+1);
        }
        $user =User::where('id', Auth::id())->first();
        $user->name = $request->name;
        $user->image = $image;
        $user->slug = $slug;
        $user->user_type = 'Admin';
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        if ($user) {
            notify()->success($request->name . ' ' . translate('User Update Successfully'));
            return back();
        } else {
            notify()->error($request->name . ' ' . translate('There are Some Problem Try again'));
            return back();
        }

    }


    /*Delete the user*/
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        if (Auth::id() == $id) {
            notify()->error(translate('You are login,'));
        } else {
            if (User::where('id', $id)->where('user_type', 'Admin')->delete()) {
                notify()->success(translate('User Delete Successfully'));
                return back();
            } else {
                notify()->error(translate('There are Some Problem Try again'));
                return back();
            }
        }

    }
    public function testSeriesLogin() {

if(Auth::id()){//echo "HERE";exit;
    $user = User::where('id', Auth::id())->first();
       
    if(isset($user->student) && $user->student->image ){
        $image = asset($user->student->image);
    } else {
        $image = asset('public/uploads/user/user.png');
    }
        $userInfo =
            array(
           // 'name' => $user->name,
           // 'email' => $user->alternate_email_user,
            'phone' => $user->email,
           // 'picture' => $image ? $image : $image ,
        );
    
       
        $Data =  ['status' => 'true', 'msg' => '', 'user_info' => $userInfo];
        setcookie('eg_ole_user', $user->email, time()+3600,'/' ,'.olexpert.org.in');
        return  redirect('https://test.olexpert.org.in/');
        // return response()->json(['status' => 'true', 'msg' => '', 'user_info' => $userInfo]);        

        } else {
            $Data =  ['status' => 'false', 'msg' => '', 'user_info' => array()];
            setcookie('oleExpert', json_encode($Data), time()+3600);
            return redirect('/');

        }
       
    }

    // public function testSeriesAuth() { 
    //     if(Get cookie::id()){
    //         $user = User::where('email', '555555')->first();
        
    //         if($user->student->image ){
    //             $image = asset($user->student->image);
    //         } else {
    //             $image = asset('public/uploads/user/user.png');
    //         }
    //             $userInfo =
    //                 array(
    //                 'name' => $user->name,
    //                 'email' => $user->alternate_email_user,
    //                 'phone' => $user->email,
    //                 'picture' => $image ? $image : $image ,
    //             );
    //             return response()->json(['status' => 'true', 'msg' => '', 'user_info' => $userInfo]);        
        
    //     } else {

    //         return response()->json(['status' => 'false', 'msg' => '', 'user_info' => array()]);        
        
    //     }

    // }    



//     public function testSeriesLogin() {

//         $user = User::where('id', Auth::id())->first();
       
//         if($user->student->image ){
//             $image = asset($user->student->image);
//         } else {
//             $image = asset('public/uploads/user/user.png');
//         }
//             $userInfo =
//                 array(
//                 'name' => $user->name,
//                 'email' => $user->alternate_email_user,
//                 'phone' => $user->email,
//                 'picture' => $image ? $image : $image ,
//             );
        
//             // return    Curl::to('http://www.foo.com/bar')
//             // ->withData(['status' => 'true', 'msg' => '', 'user_info' => $userInfo] )
//             // ->asJson()
//             // ->post();
//             $Data =  ['status' => 'true', 'msg' => '', 'user_info' => $userInfo];
//             $minutes = 1;
//             $response = new Response($Data);
//             $num_of_minutes_until_expire = 60 * 24 * 7; // one week
//            // $response->withCookie(cookie($cookiename,$sessid, $subdomain.'.'.$domain['name'],'/', $expires));
//   //Cookie::queue('shared_cookie', 'my_shared_value', $num_of_minutes_until_expire, null, '.example.com');
//            // $setCookies = Cookie::make('eg_user', '.olexpert.org.in', $minutes,'/' , env('DOMAIN'));
//              $response->withCookie(cookie('eg_user', '1', $num_of_minutes_until_expire , '.olexpert.org.in'));
         
//          //  $url = 'https://test.olexpert.org.in/sso_client/user_details_from_cookie';

//           // return $response->setDefaultPathAndDomain('domain',  ['domain' => '.mywebsite.com']);
//             return  $response;
//            // return  redirect('https://test.olexpert.org.in');

            
//             //Cookie.set('key', 'value', { domain: '.olexpert.org.in' }

//             //  $cURLConnection = curl_init('https://test.olexpert.org.in/');
//             //  curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $Data);
//             //  curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
//             //  $apiResponse = curl_exec($cURLConnection);
//             //  curl_close($cURLConnection);
           
//             // $apiResponse - available data from the API request
//             // $jsonArrayResponse = json_decode($apiResponse);
//             // $returnResponse  = response()->json(['status' => 'true']);
//            // return $jsonArrayResponse;
//         //     if($returnResponse == true) {
//         //    // header('location:https://test.olexpert.org.in');
//         //     redirect('https://test.olexpert.org.in');
//         //     }
//             //return response()->json(['status' => 'true', 'msg' => '', 'user_info' => $userInfo]);        
//            // return $jsonArrayResponse;
//     }

}
