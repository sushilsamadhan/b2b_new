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
use App\JobNotification;
use Illuminate\Http\Request;

class JobNotificationController extends Controller
{

    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alldataJobNotification = JobNotification::orderBy('job_publish_date', 'DESC')->get(); 
        return view($this->theme.'.homepage.job_notification',compact('alldataJobNotification'));
    }
    public function getAllJobsfromXml(){
       
        $xml = file_get_contents('https://services.india.gov.in/feed/rss?cat_id=2&ln=en');
        $xml = preg_replace('~\s*(<([^>]*)>[^<]*</\2>|<[^>]*>)\s*~','$1',$xml);
        $xml = simplexml_load_string($xml,'SimpleXMLElement', LIBXML_NOCDATA);
        $phpArray= json_encode($xml);
        $phpArray2= json_decode($phpArray,TRUE); 
        $job=    $phpArray2['channel'];
        $joblatestStrip=[];
        $joblatest= $job['item'];
            foreach ($joblatest as $key ) {
                $description = '';
              if(empty($key['description'])){

              } 
           $joblatestStrip[] = array('title'=>$key['title'],'link'=>$key['link'],'description'=>empty($key['description'])?null:$key['description'],'pubDate'=>$key['pubDate'],'category'=>$key['category']);
            }
              foreach($joblatestStrip as $value){
                $job_count = DB::table('job_notifications')->select()->where('job_tittle',$value['title'])->count();
                if($job_count <= 0){
                            $JobNotification = new JobNotification();
                            $JobNotification->job_tittle = $value['title'];
                            $JobNotification->job_link = $value['link'];
                            $JobNotification->Job_description = $value['description'];
                            $JobNotification->job_publish_date = $value['pubDate'];
                            $JobNotification->job_category = $value['category'];
                            $JobNotification->save();  
                    }            
                }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function job_notification_details($id,$tittle)
    {
       // die('=====');
       $singledataJobNotification = DB::table('job_notifications')->select()->where('id',$id)->first();
       return view($this->theme.'.homepage.job_notification_details',compact('singledataJobNotification')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobNotification  $jobNotification
     * @return \Illuminate\Http\Response
     */
    public function show(JobNotification $jobNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobNotification  $jobNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(JobNotification $jobNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobNotification  $jobNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobNotification $jobNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobNotification  $jobNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobNotification $jobNotification)
    {
        //
    }
}
