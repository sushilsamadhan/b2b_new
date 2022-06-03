<?php


use App\Helper\Helper;
use App\Model\Category;
use App\Coupon;
use App\Forum;
use App\PostReply;
use App\ForumPostView;
use App\HelpfulAnswer;
use App\Blog;
use App\Wallet;
use App\User;
use App\MockTestSectionQuestion;
use App\RedeemCoursePoint;
use App\Model\Course;
use Carbon\Carbon;
use App\PackageAddonService;
use App\Model\Enrollment;
use App\MockTestEnrollmentAnswer;
use App\Option;
use App\Model\PwCategory;
use App\PackageSetting;
use App\UserAddtocartPackage;
use App\Model\ClassContent;
use App\Model\Classes;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\Model\PwWebinar;
use App\Model\PwEnrollment;
use App\Http\Controllers\API\V1\AES128EncDrcController;
use App\Model\IidSector;



function getTotalSectionwiseQuestion($id=NULL){


    return $mtQuestionData = MockTestSectionQuestion::with(['comprehensionq'])->where('mock_test_section_id','=',$id)->get();
}
//this function for open Json file to read language json file
function openJSONFile($code)
{
    $jsonString = [];
    if (File::exists(base_path('resources/lang/' . $code . '.json'))) {
        $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}

//save the new language json file
function saveJSONFile($code, $data)
{
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
}

//translate the key with json
function translate($key)
{
    $key = ucfirst(str_replace('_', ' ', $key));
    if (File::exists(base_path('resources/lang/en.json'))) {
        $jsonString = file_get_contents(base_path('resources/lang/en.json'));
        $jsonString = json_decode($jsonString, true);
        if (!isset($jsonString[$key])) {
            $jsonString[$key] = $key;
            saveJSONFile('en', $jsonString);
        }
    }
    return __($key);
}


//scan directory for load flag
function readFlag()
{
    $dir = base_path('public/uploads/lang');
    $file = scandir($dir);
    return $file;
}


//auto Rename Flag
function flagRenameAuto($name)
{
    $nameSubStr = substr($name, 8);
    $nameReplace = ucfirst(str_replace('_', ' ', $nameSubStr));
    $nameReplace2 = ucfirst(str_replace('.png', '', $nameReplace));
    return $nameReplace2;
}


function defaultCurrency()
{
    $sc = session('currency');
    if ($sc != null) {
        $id = $sc;
    } else {
        $id = (int)getSystemSetting('default_currencies')->value;
    }
    $currency = \App\Model\Currency::find($id);
    return $currency->code;
}

//format the Price
function formatPrice($price)
{
    $sc = session('currency');
    if ($sc != null) {
        $id = $sc;
    } else {
        $id = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = \App\Model\Currency::find($id);
    $p = $price * $currency->rate;
    return $currency->align == 0 ? number_format($p, 2) . $currency->symbol : $currency->symbol . number_format($p, 2);
}

//format the Price
function noFormatPrice($huh)
{
    $x = session('currency');
    if ($x != null) {
        $ids = $x;
    } else {
        $ids = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = \App\Model\Currency::find($ids);
    $p = $huh * $currency->rate;

    return $p;
}

//format the Price Code
function formatPriceCode()
{
    $priceCode = session('currency');
    $currency = \App\Model\Currency::find($priceCode);
    return $currency->code;
}

function getPriceRate($code)
{
    $getPriceCode = \App\Model\Currency::where('code', $code)->first();
    return $getPriceCode->rate ?? 0;
}

/*only price for payment*/
function onlyPrice($price)
{
    $sc = session('currency');
    if ($sc != null) {
        $id = $sc;
    } else {
        $id = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = \App\Model\Currency::find($id);
    $p = $price * $currency->rate;
    return $p;

}


function PaytmPrice($price)
{

    switch (activeCurrency()) {
        case 'USD':
            return noFormatPrice($price) * getPriceRate('INR');
            break;

        case 'BDT':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        case 'INR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        case 'LKR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        case 'PKR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        case 'NPR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        case 'ZAR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        case 'JPY':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        case 'KRW':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        case 'IDR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        case 'AED':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        case 'TRY':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        default:
            # code...
            break;
    }
}

function StripePrice($stripePrice)
{

    switch (activeCurrency()) {
        case 'USD':
            //echo "hhhh";die;
            return noFormatPrice($stripePrice);
            break;
        case 'BDT':
            //echo "ffff";die;
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'INR':
            //echo "kkkk";die;
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'LKR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'PKR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'NPR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'ZAR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'JPY':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'KRW':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'IDR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'AED':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'TRY':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;

        default:
            # code...
            break;
    }
}

function PaypalPrice($PaypalPrice)
{

    switch (activeCurrency()) {
        case 'USD':
            return noFormatPrice($PaypalPrice);
            break;
        case 'BDT':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'INR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'LKR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'PKR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'NPR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'ZAR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'JPY':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'KRW':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'AED':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'IDR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'TRY':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;

        default:
            # code...
            break;
    }
}

/*Active Currency*/
function activeCurrency()
{
    $sc = session('currency');
    if ($sc != null) {
        $id = $sc;
    } else {
        $id = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = \App\Model\Currency::find($id);
    return $currency->code;
}

/*Active Currency*/
function activeCurrencySymbol()
{
    $sc = session('currency');
    if ($sc != null) {
        $id = $sc;
    } else {
        $id = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = \App\Model\Currency::find($id);
    return $currency->symbol;
}

//override or add env file or key
function overWriteEnvFile($type, $val)
{
    $path = base_path('.env');
    if (file_exists($path)) {
        $val = '"' . trim($val) . '"';
        if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
            file_put_contents($path, str_replace($type . '="' . env($type) . '"', $type . '=' . $val, file_get_contents($path)));
        } else {
            file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
        }
    }
}


//get system setting data
function getSystemSetting($key)
{
    return \App\Model\SystemSetting::where('type', $key)->first();
}

//get Subscription setting data
function getSubscriptionSetting($key)
{
    return \App\SubscriptionSettings::where('type', $key)->first();
}

//get Subscription setting data
function enableCourse()
{
    $enableCourse = \App\SubscriptionSettings::where('type', 'enable_all_course')->first();

    if ($enableCourse != null && $enableCourse->value == true) {
        return true;
    } else {

        return false;
    }
}

//get Subscription setting data
function enableInstructorRequest()
{
    $enableInstructorRequest = \App\SubscriptionSettings::where('type', 'enable_instructor_request')->first();
    if ($enableInstructorRequest != null && $enableInstructorRequest->value == true) {
        return true;
    } else {

        return false;
    }
}

//get Subscription setting data
function enableFreeTrial()
{
    $enableFreeTrial = \App\SubscriptionSettings::where('type', 'enable_free_trial')->first()->value;
    if ($enableFreeTrial == true) {
        return true;
    } else {

        return false;
    }
}

//Get file path
//path is storage/app/
function filePath($file)
{
    return asset($file);
}


function course()
{
    return \App\Model\Course::Published()->get();
}

//delete file
function fileDelete($file)
{
    if ($file != null) {
        if (file_exists(public_path($file))) {
            unlink(public_path($file));
        }
    }
}

//uploads file
// uploads/folder
function fileUpload($file, $folder)
{
    return $file->store('uploads/' . $folder);
}


//get instructor
function instructorDetails($id)
{
    return \App\Model\Instructor::where('user_id', $id)->first();
}

function studentDetails($id)
{
    return \App\Model\Student::where('user_id', $id)->first();
}


/*categories*/
function categories()
{

    return Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->orderBy('sequence','asc')->Published()->get();
}
//Free Study Material 
function freeStudyMaterial()
{

    return Category::where('parent_category_id', 0)->with('child')->where('is_free_study','1')->Published()->get();
}

//compitative 
function compitative()
{

    return Category::where('parent_category_id', 0)->with('child')->where('is_compitative','1')->Published()->get();
}


/*duration*/
function duration($value)
{
    $init = $value;
    $hours = floor($init / 60);
    $minutes = floor($init % 60);
    $seconds = floor(($init / 60) % 60);
    $single_sec = mb_strlen((string)$seconds);
    $duration = $hours . ':' . $minutes . ':' . ($single_sec === 1 ? '0' . $seconds : $seconds);
    return date('H:i:s', strtotime($duration));
}


/*best selling tags*/
function bestSellingTags($id)
{
    $start = \Carbon\Carbon::parse(date('y-m-d'))
        ->startOfMonth()
        ->toDateTimeString();
    $end = \Carbon\Carbon::parse(date('y-m-d'))
        ->endOfMonth()
        ->toDateTimeString();

    $enroll = \App\Model\Enrollment::where('course_id', $id)->whereBetween('created_at', [$start, $end])->get();

    if ($enroll->count() > 5) {
        return true;
    }
    return false;
}


/*affiliate status*/
function affiliateStatus()
{
    try {
        $affiliate = getSystemSetting('affiliate')->value;
        if ($affiliate == 'Active') {
            return true;
        } else {
            return false;
        }
    } catch (Exception $exception) {
        return false;
    }

}

/*affiliate commission*/
function commission()
{
    $commission = (int)getSystemSetting('commission')->value;
    return $commission;
}

//cookie time day
function cookiesLimit()
{
    $days = (int)getSystemSetting('cookies_limit')->value;
    /*return day*/

    return ($days * 1440);
}

/*cashout*/
function withdrawLimit()
{
    $amount = (int)getSystemSetting('withdraw_limit')->value;
    return $amount;
}

//CHECK MEDIA MANAGER ACTIVATION
function MediaActive()
{
    if (env('MEDIA_MANAGER') === "YES") {
        return true;
    } else {
        return false;
    }
}


/*Certificate addons activations */
function certificate()
{
    if (env('CERTIFICATE_ACTIVE') === "YES") {
        return true;
    } else {
        return false;
    }
}


// check Paytm route for Mapping

function paytmRoute()
{
    if (file_exists(base_path('routes/paytm.php'))) {
        return true;
    } else {
        return false;
    }
}

// check Paytm route for blade
function paytmRouteForBlade()
{
    if (file_exists(base_path('routes/paytm.php'))) {
        return true;
    } else {
        return false;
    }
}

// check Paytm route for blade
function paytmActive()
{
    if (env('PAYTM_ACTIVE') == 'YES') {
        return true;
    }
    return false;
}

/*quiz*/
function quizActive()
{
    if (env('QUIZ_ACTIVE') == 'YES') {
        return true;
    }
    return false;
}

// check quiz route for Mapping

function quizRoute()
{
    if (file_exists(base_path('routes/quiz.php'))) {
        return true;
    } else {
        return false;
    }
}

// check quiz route for blade
function quizRouteForBlade()
{
    if (file_exists(base_path('routes/quiz.php'))) {
        return true;
    } else {
        return false;
    }
}

// check quiz route for blade
function couponRouteForBlade()
{
    if (file_exists(base_path('routes/coupon.php'))) {
        return true;
    } else {
        return false;
    }
}


// check certificate route for blade
function certificateForRoute()
{
    if (file_exists(base_path('routes/certificate.php'))) {
        return true;
    } else {
        return false;
    }
}


// check Paytm route for Mapping

function zoomRoute()
{
    if (file_exists(base_path('routes/zoom.php'))) {
        return true;
    } else {
        return false;
    }
}

// check Paytm route for blade
function zoomRouteForBlade()
{
    if (file_exists(base_path('routes/zoom.php'))) {
        return true;
    } else {
        return false;
    }
}

// check Paytm route for blade
function zoomActive()
{
    if (env('ZOOM_ACTIVE') == 'YES') {
        return true;
    }
    return false;
}

// check Paytm route for blade
function couponActive()
{
    if (env('COUPON_ACTIVE') == 'YES') {
        return true;
    }
    return false;
}


// Forum


// check forum route for Mapping

function forumRoute()
{
    if (file_exists(base_path('routes/forum.php'))) {
        return true;
    } else {
        return false;
    }
}

// check forum route for blade
function forumRouteForBlade()
{
    if (file_exists(base_path('routes/forum.php'))) {
        return true;
    } else {
        return false;
    }
}

// check forum route for blade
function forumActive()
{
    if (env('FORUM_PANEL') == 'YES') {
        return true;
    }
    return false;
}


// subscription

// check forum route for Mapping

function subscriptionRoute()
{
    if (file_exists(base_path('routes/subscription.php'))) {
        return true;
    } else {
        return false;
    }
}

// check forum route for blade
function subscriptionRouteForBlade()
{
    if (file_exists(base_path('routes/subscription.php'))) {
        return true;
    } else {
        return false;
    }
}

// check forum route for blade
function subscriptionActive()
{
    if (env('SUBSCRIPTION_ACTIVE') == 'YES') {
        return true;
    }
    return false;
}


/*active theme*/
function themeManager()
{
    try {
        if (env('THEME_MANAGER') === "YES") {
//            $t = new \App\Themes();
//            $themes = \App\Themes::all();
//            foreach ($themes as $theme) {
//                if ($theme->activated) {
//                    $t = $theme;
//                }else{
//                    $t = null;
//                }
//            }
            if (env('ACTIVE_THEME') === 'rumbok') {
                return 'rumbok';
            } else {
                return 'rumbok';
            }
        } else {
            return 'rumbok';
        }
    } catch (Exception $exception) {
        return 'rumbok';
    }

}


function adminPower()
{
    return Auth::user()->user_type === "Admin";
}

function instructorPower()
{
    return Auth::user()->user_type === "Instructor";
}

function studentPower()
{
    return Auth::user()->user_type === "Student";
}

/**
 * EXPIRE
 */

function expire($duration)
{

    if ($duration == 'Monthly') {
        return App\SubscriptionEnrollment::where('subscription_package', $duration)->where('end_at', '>', Carbon\Carbon::now())->count();
    }


    if ($duration == 'Weekly') {
        return App\SubscriptionEnrollment::where('subscription_package', $duration)->where('end_at', '>', Carbon\Carbon::now())->count();
    }


    if ($duration == 'Daily') {
        return App\SubscriptionEnrollment::where('subscription_package', $duration)->where('end_at', '>', Carbon\Carbon::now())->count();
    }


    if ($duration == 'Yearly') {
        return App\SubscriptionEnrollment::where('subscription_package', $duration)->where('end_at', '>', Carbon\Carbon::now())->count();
    }


}


function enrolmentStare($count)
{


    switch ($count) {
        case $count > 50:
            return 5;
            break;
        case $count < 45 && $count > 35:
            return 4;
            break;
        case $count < 35 && $count > 25:
            return 3;
            break;
        default:
            return 2;
    }


}


function allBlogTags()
{
    $tags = array();
    $blogs = \App\Blog::all();

    foreach ($blogs as $blog) {
        $blogPost = json_decode($blog->tags);

        foreach ($blogPost as $tag) {
            array_push($tags, $tag);
        }

    }

    $data = array_unique($tags, false);
    return $data;

}

/**
 * couponRoute
 */

 function couponRoute()
{
    if (file_exists(base_path('routes/coupon.php'))) {
        return true;
    } else {
        return false;
    }
}

/**
 * COUPON SESSION
 */

 function couponDiscount($code)
 {
     $rate = Coupon::where('code', $code)->select('rate','discount_type')->first();
     $discountAmt =  $rate->rate;
     if($rate){
        if(Session::has('coupon')){
            $cartTotal = session()->get('coupon')['total'];
            if($cartTotal>0 && $rate->discount_type=='P'){
                $discountAmt = $cartTotal*($rate->rate/100);
            }
        }
     }
     return formatPrice($discountAmt);
 }

 function couponDiscountPrice($code)
 {
     $rate = Coupon::where('code', $code)->select('rate','discount_type')->first();
     $discountAmt =  $rate->rate;
     if($rate){
        if(Session::has('coupon')){
            $cartTotal = session()->get('coupon')['total'];
            if($cartTotal>0 && $rate->discount_type=='P'){
                $discountAmt = $cartTotal*($rate->rate/100);
            }
        }
     }
     return $discountAmt;
 }

 /**
  * FORUMLY
  */

  function forumComp($blade)
  {
    return 'forum.forumly.components.' . $blade;
  }

  function forumPostCount()
  {
      return Forum::count();
  }

  function forumCategoryCount($category)
  {
      return Forum::where('category', $category)->count();
  }

  function forumCategory($category)
  {
      return Forum::where('category', $category)->get();
  }

  function forumPostReplyCount()
  {
      return PostReply::count();
  }

  function latestForumPostCount()
  {
      return Forum::whereDate('created_at', Carbon::today())->count();
  }

  function latestFostReplyCount()
  {
      return PostReply::whereDate('created_at', Carbon::today())->count();
  }

  function blogCount()
  {
      return Blog::count();
  }

  function post_replies_count($id)
  {
    return $post_replies_count = PostReply::where('post_id', $id)->count();
  }

  function post_views_count($id)
  {
    return $post_views_count = ForumPostView::where('post_id', $id)->count();
  }

  function helpful_count($id)
  {
    return $helpful_count = HelpfulAnswer::where('post_id', $id)->count();
  }

  function popularQuestion()
  {
      return ForumPostView::select('post_id')
	    ->groupBy('post_id')
	    ->orderByRaw('COUNT(*) DESC')
	    ->get();
  }

  function popularQuestions($id)
  {
        return Forum::where('id', $id)->select('id', 'title', 'user_id')->latest()->take(10)->get();
  }



  function helpfulReplyId()
  {
      return HelpfulAnswer::select('post_reply_id')
			    ->groupBy('post_reply_id')
			    ->orderByRaw('COUNT(*) DESC')
			    ->take(1)
			    ->first()->post_reply_id ?? null;
  }


  /**
   * Enroll Check
   */

   function checkStudentEnroll($id)
   {
        $check = Course::where('id', $id)->exists();

        if ($check) {
            return true;
        }else{
            return false;
        }
   }


  /**
   * WALLET
   */

   // check wallet route for Mapping

function walletRoute()
{
    if (file_exists(base_path('routes/wallet.php'))) {
        return true;
    } else {
        return false;
    }
}

// check wallet route for blade
function walletRouteForBlade()
{
    if (file_exists(base_path('routes/wallet.php'))) {
        return true;
    } else {
        return false;
    }
}

// check wallet route for blade
function walletActive()
{
    if (env('WALLET_ACTIVE') == 'YES') {
        return true;
    }
    return false;
}


//get wallet setting data
function getWalletSetting($key)
{
    return Wallet::select($key)->first()->$key ?? null;
}

/**
 * POINT LIST
 */

 function walletName()
 {
     return getWalletSetting('wallet_name') ?? 'coint';
 }

 function walletRateLimit()
 {
     return getWalletSetting('redeem_limit') ?? 1000;
 }

 function walletRate()
 {
     return getWalletSetting('wallet_rate') ?? 1000;
 }

 function registrationPoint()
 {
     return getWalletSetting('registration_point') ?? 500;
 }

 function freePoint()
 {
     return getWalletSetting('free_course_point') ?? 50;
 }

 function paidPoint()
 {
     return getWalletSetting('paid_course_point') ?? 100;
 }

 function courseCompletePoint()
 {
     return getWalletSetting('course_complete_point') ?? 200;
 }


/**
 * POINT LIST::END
 */


function addWallet($point, $message)
{
    if (env('WALLET_ACTIVE') == "YES") {
        $user = User::where('id', Auth::user()->id)->first();
        $amount = $point; // (Double) Can be a negative value
        $message = $message; //The reason for this transaction

        //Optional (if you modify the point_transaction table)
        $data = [
            'ref_id' => 'someReferId',
        ];

        $transaction = $user->addPoints($amount,$message,$data);
    }
}


function subWallet($point, $message)
{
    if (env('WALLET_ACTIVE') == "YES") {
        $user = User::where('id', Auth::user()->id)->first();
        $amount = $point; // (Double) Can be a negative value
        $message = $message; //The reason for this transaction

        //Optional (if you modify the point_transaction table)
        $data = [
            'ref_id' => 'someReferId',
        ];

        $transaction = $user->subPoints($amount,$message,$data);
    }
}


function walletBalance()
{
    $user = User::where('id', Auth::user()->id)->where('user_type', 'Student')->first();
    return $points = $user->currentPoints();
}


function checkRedeem($course_id)
{
    $checkRedeem = RedeemCoursePoint::where('course_id', $course_id)->where('user_id', Auth::user()->id)->exists();

    if ($checkRedeem) {
        return true;
    }else{
        return false;
    }
}

/**
 * POINT CONVERT
 */

 function WalletPrice($price)
{

    switch (activeCurrency()) {
        case 'USD':
            return noFormatPrice($price) * walletRate();
            break;

        case 'BDT':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        case 'INR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        case 'LKR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        case 'PKR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        case 'NPR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        case 'ZAR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        case 'JPY':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        case 'KRW':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        case 'IDR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        case 'AED':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        case 'TRY':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * walletRate();
            break;

        default:
            # code...
            break;
    }
}


function buyWallet($price)
{

    switch (activeCurrency()) {
        case 'USD':
            return noFormatPrice($price) / walletRate();
            break;

        case 'BDT':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        case 'INR':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        case 'LKR':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        case 'PKR':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        case 'NPR':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        case 'ZAR':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        case 'JPY':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        case 'KRW':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        case 'IDR':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        case 'AED':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        case 'TRY':
            return noFormatPrice($price) * getPriceRate(activeCurrency()) / walletRate();
            break;

        default:
            # code...
            break;
    }
}

function payWithCoin()
{
    if (walletRateLimit() <= walletBalance()) {
        return true;
    } else {
        return false;
    }
}

function checkWallerBalanceForPurchase($total_price)
{
    if ($total_price <= walletBalance()) {
        return true;
    } else {
        return false;
    }
}

function generateToken()
{
    return md5(rand(1, 10) . microtime());
}

//get MTestQuestion Checked Data
function getCheckedMtestData($mock_test_master_id,$mock_test_section_id,$student_test_question_id)
{
   // return $mock_test_master_id.",".$mock_test_section_id.",".$student_test_question_id;
    $MockTestSectionQuestion =  MockTestSectionQuestion::where('mock_test_master_id', $mock_test_master_id)
                             ->where('mock_test_section_id', $mock_test_section_id)
                             ->where('student_test_question_id', $student_test_question_id)
                             ->count();


    return $MockTestSectionQuestion;
}

function getSelected($pkjId,$service_id)
{
   
    $getSelected =  PackageAddonService::where('package_id', $pkjId)
                             ->where('addon_service_id', $service_id)
                             ->where('status','=','1')
                             ->exists();
                             
    if($getSelected){
        return true;
    }else{
        return false;
    }
}

//Get Parent Project Cat Name

function getParentCatName($id=NULL)
{
     $ProjectWorkCategory = PwCategory::select('category_name')
                                                    ->where('id', $id)
                                                    ->where('parent_category_id','=','0')
                                                    ->first();   
     return $category_name = (isset($ProjectWorkCategory->category_name)) ? $ProjectWorkCategory->category_name : null;
    
}

//Get Project Sub Cat Name

function getSubCat($id=NULL)
{
     $PwSubCategory = PwCategory::select('id','category_name','status')
                        ->where('parent_category_id', $id)->get();
     return $PwSubCategory;
    
}

function getAddOnPrice($pkjId=NULL)
{
   
    $getSelected =  PackageAddonService::where('package_id', $pkjId)
                             ->where('status','=','1')
                             ->get();
                             
    if($getSelected){
        return $getSelected;
    }else{
        return false;
    }
}




function getCountData($cId=NULL,$free_subject=NULL)
{

    //return $cId."-----".$free_subject;
    $chapterCount=0;
    $countLecture=0;
    if(!empty($free_subject)){

        //$free_subjects = explode(',',$free_subject);
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

    $courseId = $cId;
    if($cId == 0 && !empty($free_subject))
    {
        //$free_subject = explode(',',$free_subject);
        if(!empty($free_subject)){
            $courseId = $free_subject[0];
        }
        
    }
    $s_course       = Course::Published()->where('ole_refference_id', $courseId)
                                        ->with('classes')
                                        ->orderBy('title', 'ASC')
                                        ->first(); // single course details
    $count=0;
    $scourseCount = 0;
    if(isset($s_course)){
        foreach($s_course->classes as $val){
            $count+=$val->contents->count();
        }
        $scourseCount = count($s_course->classes);
    } 

    $chptr = $scourseCount+$chapterCount;
    $lectur = $countLecture+$count;
//0->Chapter Count,1->Lecture Count
    $course_chapter_count=array($chptr,$lectur);

    //$mergeTotal = $chptr."-".$lectur;
    return $course_chapter_count; 
}

function getCountQuestion($totalCount, $totalQuestion) {
  
    if($totalCount < $totalQuestion) {
        $total = $totalCount/2;
    } else {
        $total =  $totalQuestion;
    }
    
    return $total;
    }

 function getCreatedAtAttribute($date)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d F Y');
}

function dateForUserView($date)
{
    if(!empty($date)){
        return Carbon::createFromFormat('Y-m-d', $date)->format('d M, Y');
    }
    return;    
}
function checkIsCourseEnrolled($course_id,$user_id)
{
    return Enrollment::where(['course_id'=>$course_id,'user_id'=>$user_id])->exists();
}

function checkProjectWorkEnrolled($project_work_id, $user_id){
    return PwEnrollment::where(['project_work_id'=>$project_work_id,'user_id'=>$user_id])->exists();
}

function getTotalMarks($reportId ,$packageId) {

    $testReportsTotalMarks =  MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $reportId,'package_id' => $packageId])->Where('answer_id' ,'!=', null)->get();
    $testReportsTotals = 0;

    foreach($testReportsTotalMarks as $testReportsTotalMark)
        {
            $answerId = $testReportsTotalMark->answer_id;
            $testReportsTotal = Option::where(['id'=> $answerId , 'flag_correct' =>1])->count();
            //print_r($testReportsTotal); 
            if($testReportsTotal == 1) {
               // print_r($testReportsTotal); die;
                 $testReportsTotals++;
            }

        }    
       // die;
        return $testReportsTotals;     
    }

    
    function getPackageName($package_id) {
        $packageName = PackageSetting::select('id','pkg_name')->where('id', $package_id)->first();
        return $packageName['pkg_name'];
    }

    function getCourseName($course_id) {
        $courseName = Course::select('id','title')->where('id', $course_id)->first();
        return $courseName['title'];
    }

    function getPackageDetails($pkg_id) {
       
        if(!empty($pkg_id)){
            $userPackagesdetails = PackageSetting::select('pkg_name','package_type','course_id',
                            'pkg_image','free_subject','no_of_test','no_of_practice_test',
                            'no_of_sectional_test','no_of_test_questions','status')
                            ->where('id', $pkg_id)->get();
 
            $userCourseIdsArr = array();
            $userfreeSubjsArr = array();                
            $courseIds = '';
            $freeSubjs = '';

            foreach($userPackagesdetails as $packageDetails) {
                $courseIds = $packageDetails->course_id;
                $freeSubjs = $packageDetails->free_subject;
            } 

            // if course_id col has comma separated values 
            if($courseIds!='') {
                if (str_contains($courseIds, ',')){
                    $userCourseIdsArr = explode(",",$courseIds);
                }
            }
            // if free_subject col has comma separated values
            if($freeSubjs!='') {        
                if (str_contains($freeSubjs, ',')){
                    $userfreeSubjsArr = explode(",",$freeSubjs);
                } 
            }
                    
            if(count($userCourseIdsArr)>0 && count($userfreeSubjsArr)>0){
                $finalCourseID =  array_unique(array_merge($userCourseIdsArr,$userfreeSubjsArr)); 
            } else { 
                if($courseIds!='' && $freeSubjs!='' && $courseIds!=$freeSubjs){
                    $finalCourseID = array($courseIds, $freeSubjs);
                } else {
                    if($freeSubjs!='') {
                        $finalCourseID = $freeSubjs;
                    } else{
                        $finalCourseID = $courseIds;
                    }
                }
            }
            
            return array('userPackagesdetails'=>$userPackagesdetails,'finalCourseID'=>$finalCourseID);
            //$name['userPackagesdetails'];
            //return $userPackagesdetails.'|'.$finalCourseID;
        }
    } 

    // function getCourseContentDetails($course_id){
    //     $courseDetails = Course::select('title')->where('id',$course_id)->get();
    //  //   echo 'Course name'.$courseDetails['title'];exit;
    //     return $courseDetails;
    // } 


    function getChapterIds($pkg_id, $enroll_id, $user_id) {
        $userChapters = UserAddtocartPackage::select('course_id','package_type')
                        ->where('package_id', $pkg_id)
                        ->where('enrollment_id', $enroll_id)
                        ->where('user_id', $user_id)
                        ->first();
           
        return $userChapters['course_id'].'|'.$userChapters['package_type'];
    }

    function getCourseContents($courseIds) {
           $courseContent = Course::where('id', $courseIds)->get(); 
           return $courseContent;
       }

    function getClassContents($courseIds) {
        $classContent = Classes::join('class_contents','classes.id','class_contents.class_id')
        ->select('classes.id','classes.title','classes.unit')
        ->where('classes.course_id', $courseIds)->groupBy('classes.id')->get();
        return $classContent;
    }

    function getUserPackageServices($package_id, $enroll_id, $user_id){
        if(!empty($package_id)) {      
              $userAddtocart = UserAddtocartPackage::where('package_id', $package_id)
              ->where('enrollment_id', $enroll_id)->where('user_id', $user_id)->get();
          
            $serviceIds = '';
            foreach($userAddtocart as $cart) {
                $serviceIds .= $cart->service_id.',';
            } 
            //  Service Ids
            $serviceIds = rtrim($serviceIds, ", ");
            $userServiceId = explode(",",$serviceIds);
            $userServiceId = array_unique($userServiceId);
            $userServiceId = array_values($userServiceId);
            $userPackageServices = Service::whereIn('id', $userServiceId) ->get(); 

            return $userPackageServices;
        } else {
            return $userPackageServices = array();
        }
    }

    function getUserCourseServices($course_id, $enroll_id, $user_id){
        if(!empty($course_id)) {      
              $userAddtocart = UserAddtocartPackage::where('course_id', $course_id)
              ->where('enrollment_id', $enroll_id)->where('user_id', $user_id)->get();
          
            $serviceIds = '';
            foreach($userAddtocart as $cart) {
                $serviceIds .= $cart->service_id.',';
            } 
            //  Service Ids
            $serviceIds = rtrim($serviceIds, ", ");
            $userServiceId = explode(",",$serviceIds);
            $userServiceId = array_unique($userServiceId);
            $userServiceId = array_values($userServiceId);
            $userCourseServices = Service::whereIn('id', $userServiceId) ->get(); 

            return $userCourseServices;
        } else {
            return $userCourseServices = array();
        }
    }

    function getProjectWebinarId($pw_id, $webinar_id){
        $data = PwWebinar::where('project_work_id' , $pw_id)
                ->where('webinar_id' , $webinar_id)->get(); 
        foreach($data as $item){
            $pwId = $item->id;
        }          
        return $pwId;
    }

    function getTemplateId($message)
    {
        $template_id = "";
        
        switch ($message) {
            case (strpos($message, 'Dear User One Time Password(OTP) for your request is') !== false):
                $template_id = "1707160101169220537";
                break;
            case (strpos($message, 'is the OTP for Login.') !== false):
                $template_id = "1707160101171549248";
                break;
            default:
                $template_id = "";
        }
        
        return $template_id;
    }
    function sendSMS($message, $mobile): void
    {

        $template_id = getTemplateId($message);
    
    	$username=urlencode('info@icir.in');
    	$password=urlencode('samadhan@123');
    	$sender=urlencode('IIDSAM');
    
    	$parameters="username=".$username."&password=".$password."&mobile=".$mobile."&sendername=".$sender."&message=".$message."&templateid=".$template_id;
    
    	$url="http://priority.muzztech.in/sms_api/sendsms.php";
    
    	$ch = curl_init($url);
    
    	curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
    
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
    	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
    	$return_val = curl_exec($ch);
    	
    	curl_close($ch);
    }

    function isMobileDevice() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
    |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
    , $_SERVER["HTTP_USER_AGENT"]);
    }

    function converNumberToString($number)
    {
        $ones = array( 
            1 => "once", 
            2 => "twice", 
            3 => "thrice", 
            4 => "four times", 
            5 => "five times", 
            6 => "six times", 
            7 => "seven times", 
            8 => "eight times", 
            9 => "nine times", 
            10 => "ten times", 
            11 => "eleven times", 
            12 => "twelve times", 
            13 => "thirteen times", 
            14 => "fourteen times", 
            15 => "fifteen times", 
            16 => "sixteen times", 
            17 => "seventeen times", 
            18 => "eighteen times", 
            19 => "nineteen times" 
        );
        if (array_key_exists($number, $ones))
        {
            return $ones[$number];
        }else{
            return $number;
        }
    }
   


   
    function getBookingSchedule($conn){
        $ifbooked = DB::table('live_daily_class_booking')->where($conn)->get();
        $ifbookedCount = $ifbooked->count();
        if ($ifbookedCount>=1) {
            return 1;
        }else{
            return 0;
        }
    }
   
    function getTutitionBookingSchedule($conn,$conn1){
        $ifbooked = DB::table('tuition_booking')->where($conn)->get();
        $ifbookedCount = $ifbooked->count();
        $ifbooked1 = DB::table('tuition_booking')->where($conn1)->get();
        $ifbookedCount = $ifbooked->count();
        $ifbookedCount1 = $ifbooked1->count();
        if ($ifbookedCount>=1) {
            return 1;
        }
        elseif ($ifbookedCount1>=1) {
            return 2;
        }else{
            return 0;
        }
    }
   
    function getTutitionScheduletime($conn){
       // die('--------');
        $ifbooked = DB::table('tutitionschedules')->where($conn)->first();
        if ($ifbooked) {
            return $ifbooked->id;
        }else{
            return 0;
        }
    }

    function getTutitionScheduletimepart($conn1)
    {
        $ifbooked = DB::table('tutitionschedules')->where($conn1)->first();
        if ($ifbooked) {
            return $ifbooked->id;
        }else{
            return 0;
        }
    }

    // function to check column is unique or not
   function checkColumnIsUnique($fieldName, $value, $id=NULL)
   {
       if($id){
            $result = PwCategory::select('slug')->where($fieldName,'=',$value)
                ->where('id','!=',$id)->count();
       } else {
            $result = PwCategory::select('slug')->where($fieldName,'=',$value)->count();
       }     
        return $result;
   } 

   
    function getTutitionScheduletimeBooking($conn1)
    {
        $ifbooked = DB::table('tuition_booking')->where($conn1)->first();
        if ($ifbooked) {
            return $ifbooked->unic_jitsi_code;
        }else{
            return 0;
        }
    }

    function frontendDateShow($date)
    {
        if($date){
            return date("d M Y", strtotime($date));
        }
        return;

    }

    function getCouponUsersId($coupon_code){
        return \App\OrderDetail::where('coupon_code',$coupon_code)
                   ->groupBy('user_id')->get(['user_id']);   
    }

    function getEnrollCoures($user_id){
    return Enrollment::where('user_id',$user_id)->get(['course_id','package_id']);   
    }

    function getCourseDetail($course_id){
        $course = Course::where('id',$course_id)->get() ;
        return $course;
    }

    function getUsername($id){
        return User::where('id',$id)->value('name');
    }

    function userTransDetails($user_id,$coupon_code){
        return \App\OrderDetail::where('user_id',$user_id)
                ->where('coupon_code',$coupon_code)->first();   
    }
    
    function getUrlAccessPermission($userid){
        $permission = \App\UrlPermission::where('user_id',$userid)->first();
        return $permission;
    }

    function permission_denied(){
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        $method = explode('@', Route::getCurrentRoute()->getActionName());
        $live_url = $controller.'@'.$method[1];
        return $live_url;
    }
    
    function filesexitsCheck($url){
        // $url = "http://www.tutorialspoint.com/php/php_tutorial.pdf";
        $header_response = get_headers($url);
            if ($header_response) {
                if ( strpos( $header_response[0], "404" ) !== false ){
                    return 0;
                }else{
                    return 1;
                }
            }else {
                return 0;
        }
        // if (file_exists($path)) {
        //     return 'Yes';
        // } else {
        //     return 'No';
        // }
    }





    function aes128encrypt($array){
       return ['body' => (new AES128EncDrcController())->encrypt128($array)];
    }

    function aes128decrypt($request){
        $data = (array)(new AES128EncDrcController())->decrypt128($request->body);
        return $request->replace($data);
    }

    
    function sectors(){
        $sectors = IidSector::where('status',1)->get();
        return $sectors;
    }

    function bCartExistUser($work, $BcartId){
        if(DB::table('bcarts')->where('user_id',Auth::user()->id)->where('course_id',$BcartId)->select('id')->exists()){
            return true;
        }else{
            return false;
        }
    }