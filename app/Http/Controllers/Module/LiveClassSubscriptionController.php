<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\User;
use App\LiveClassSubscription;
use Alert;
// use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Str;


class LiveClassSubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // listing of all subscribers in admin
    public function index(Request $request){
        if (Auth::user()->user_type == "Admin") {
            if ($request->has('search')) {
                $subscribers = LiveClassSubscription::select('live_class_subscriptions.*','state_lists.state')
                    ->join('state_lists','state_lists.id','=','live_class_subscriptions.state')
                    ->where('live_class_subscriptions.name', 'LIKE', '%'. $request->search.'%')
                    ->where('live_class_subscriptions.class', '!=', '')->paginate(50);
            } else {
                $subscribers = LiveClassSubscription::select('live_class_subscriptions.*','state_lists.state')
                    ->join('state_lists','state_lists.id','=','live_class_subscriptions.state')
                    ->where('live_class_subscriptions.class', '!=', '')->latest()->paginate(50);
            }
        } else {
            if ($request->has('search')) {
                $subscribers = LiveClassSubscription::select('live_class_subscriptions.*','state_lists.state')
                    ->join('state_lists','state_lists.id','=','live_class_subscriptions.state')
                    ->where("live_class_subscriptions.name", 'LIKE', '%'. $request->search.'%')
                    ->where('live_class_subscriptions.class', '!=', '')->paginate(50);
            } else {
                $subscribers = LiveClassSubscription::select('live_class_subscriptions.*','state_lists.state')
                    ->join('state_lists','state_lists.id','=','live_class_subscriptions.state')
                    ->where('live_class_subscriptions.class', '!=', '')->latest()->paginate(50);
            }
        }
        return view('liveclasssubscription.index',compact('subscribers'));
    }
    public function exam_live_class_subscription(Request $request){
        if (Auth::user()->user_type == "Admin") {
            if ($request->has('search')) {
                $subscribers = LiveClassSubscription::select('live_class_subscriptions.*','state_lists.state')
                    ->join('state_lists','state_lists.id','=','live_class_subscriptions.state')
                    ->where('live_class_subscriptions.name', 'LIKE', '%'. $request->search.'%')
                    ->where('live_class_subscriptions.class', '=', '')->paginate(50);
            } else {
                $subscribers = LiveClassSubscription::select('live_class_subscriptions.*','state_lists.state')
                    ->join('state_lists','state_lists.id','=','live_class_subscriptions.state')
                    ->where('live_class_subscriptions.class', '=', '')->latest()->paginate(50);
            }
        } else {
            if ($request->has('search')) {
                $subscribers = LiveClassSubscription::select('live_class_subscriptions.*','state_lists.state')
                    ->join('state_lists','state_lists.id','=','live_class_subscriptions.state')
                    ->where("live_class_subscriptions.name", 'LIKE', '%'. $request->search.'%')
                    ->where('live_class_subscriptions.class', '=', '')->paginate(50);
            } else {
                $subscribers = LiveClassSubscription::select('live_class_subscriptions.*','state_lists.state')
                    ->join('state_lists','state_lists.id','=','live_class_subscriptions.state')
                    ->where('live_class_subscriptions.class', '=', '')->latest()->paginate(50);
            }
        }
        return view('liveclasssubscription.competitive_subscription',compact('subscribers'));
    }

    public function academic_courses_subscription(Request $request){
 
        // if(isset($request->category_id)){
        //     $category_id = $request->category_id;
        // }
        // if(isset($request->class_id)){
        //     $class_id = $request->class_id;
        // }
        // if(isset($request->search)){
        //     $search = $request->search;
        // }

        if (Auth::user()->user_type == "Admin") {
            if ($request->has('search')) {
                $subscribers = DB::table('live_daily_class_booking as isub')
                    ->leftjoin('students as stu', 'stu.user_id', '=', 'isub.user_id')
                    ->leftjoin('instructors as ins','ins.id', '=', 'isub.instructor_id') 
                    ->leftjoin('courses as c','c.id','=','isub.subject_id')
                    ->leftjoin('categories as cat','cat.id','=','isub.course_id')
                    ->leftjoin('categories as cat2','cat2.id','=','isub.class_id')
                    ->where('isub.course_type' ,'=', 'board')
                    ->select('isub.*','stu.name as stuname','stu.email','ins.name as instname','c.title','cat.name as catname','cat2.name as cat2name')
                    ->paginate(50);
            } else {

                $subscribers = DB::table('live_daily_class_booking as isub')
                    ->leftjoin('students as stu', 'stu.user_id', '=', 'isub.user_id')
                    ->leftjoin('instructors as ins','ins.id', '=', 'isub.instructor_id') 
                    ->leftjoin('courses as c','c.id','=','isub.subject_id')
                    ->leftjoin('categories as cat','cat.id','=','isub.course_id')
                    ->leftjoin('categories as cat2','cat2.id','=','isub.class_id')
                    ->where('isub.course_type' ,'=', 'board')
                    ->select('isub.*','stu.name as stuname','stu.email','ins.name as instname','c.title','cat.name as catname','cat2.name as cat2name')
                    ->latest()->paginate(50);

            }
        } else {
            if ($request->has('search')) {
                $subscribers = DB::table('live_daily_class_booking as isub')
                    ->leftjoin('students as stu', 'stu.user_id', '=', 'isub.user_id')
                    ->leftjoin('instructors as ins','ins.id', '=', 'isub.instructor_id') 
                    ->leftjoin('courses as c','c.id','=','isub.subject_id')
                    ->leftjoin('categories as cat','cat.id','=','isub.course_id')
                    ->leftjoin('categories as cat2','cat2.id','=','isub.class_id')
                    ->where('isub.course_type' ,'=', 'board')
                    ->select('isub.*','stu.name as stuname','stu.email','ins.name as instname','c.title','cat.name as catname','cat2.name as cat2name')
                    ->paginate(50);
            } else {
                $subscribers = DB::table('live_daily_class_booking as isub')
                    ->leftjoin('students as stu', 'stu.user_id', '=', 'isub.user_id')
                    ->leftjoin('instructors as ins','ins.id', '=', 'isub.instructor_id') 
                    ->leftjoin('courses as c','c.id','=','isub.subject_id')
                    ->leftjoin('categories as cat','cat.id','=','isub.course_id')
                    ->leftjoin('categories as cat2','cat2.id','=','isub.class_id')
                    ->where('isub.course_type' ,'=', 'board')
                    ->select('isub.*','stu.name as stuname','stu.email','ins.name as instname','c.title','cat.name as catname','cat2.name as cat2name')
                    ->latest()->paginate(50);
            }
        }
        $headingforsubscription='Academic Courses Subscription';
        return view('liveclasssubscription.daily_class_subscription',compact('subscribers','headingforsubscription'));
    }
 

    public function competitive_courses_subscription(Request $request){
 
        if (Auth::user()->user_type == "Admin") {
            if ($request->has('search')) {
                $subscribers = DB::table('live_daily_class_booking as isub')
                    ->leftjoin('students as stu', 'stu.user_id', '=', 'isub.user_id')
                    ->leftjoin('instructors as ins','ins.id', '=', 'isub.instructor_id') 
                    ->leftjoin('courses as c','c.id','=','isub.subject_id')
                    ->leftjoin('categories as cat','cat.id','=','isub.course_id')
                    ->leftjoin('categories as cat2','cat2.id','=','isub.class_id')
                    ->where('isub.course_type' ,'=', 'competitive-courses')
                    ->select('isub.*','stu.name as stuname','stu.email','ins.name as instname','c.title','cat.name as catname','cat2.name as cat2name')
                    ->paginate(50);
            } else {

                $subscribers = DB::table('live_daily_class_booking as isub')
                    ->leftjoin('students as stu', 'stu.user_id', '=', 'isub.user_id')
                    ->leftjoin('instructors as ins','ins.id', '=', 'isub.instructor_id') 
                    ->leftjoin('courses as c','c.id','=','isub.subject_id')
                    ->leftjoin('categories as cat','cat.id','=','isub.course_id')
                    ->leftjoin('categories as cat2','cat2.id','=','isub.class_id')
                    ->where('isub.course_type' ,'=', 'competitive-courses')
                    ->select('isub.*','stu.name as stuname','stu.email','ins.name as instname','c.title','cat.name as catname','cat2.name as cat2name')
                    ->latest()->paginate(50);

            }
        } else {
            if ($request->has('search')) {
                $subscribers = DB::table('live_daily_class_booking as isub')
                    ->leftjoin('students as stu', 'stu.user_id', '=', 'isub.user_id')
                    ->leftjoin('instructors as ins','ins.id', '=', 'isub.instructor_id') 
                    ->leftjoin('courses as c','c.id','=','isub.subject_id')
                    ->leftjoin('categories as cat','cat.id','=','isub.course_id')
                    ->leftjoin('categories as cat2','cat2.id','=','isub.class_id')
                    ->where('isub.course_type' ,'=', 'competitive-courses')
                    ->select('isub.*','stu.name as stuname','stu.email','ins.name as instname','c.title','cat.name as catname','cat2.name as cat2name')
                    ->paginate(50);
            } else {
                $subscribers = DB::table('live_daily_class_booking as isub')
                    ->leftjoin('students as stu', 'stu.user_id', '=', 'isub.user_id')
                    ->leftjoin('instructors as ins','ins.id', '=', 'isub.instructor_id') 
                    ->leftjoin('courses as c','c.id','=','isub.subject_id')
                    ->leftjoin('categories as cat','cat.id','=','isub.course_id')
                    ->leftjoin('categories as cat2','cat2.id','=','isub.class_id')
                    ->where('isub.course_type' ,'=', 'competitive-courses')
                    ->select('isub.*','stu.name as stuname','stu.email','ins.name as instname','c.title','cat.name as catname','cat2.name as cat2name')
                    ->latest()->paginate(50);
            }
        }
        $headingforsubscription='Competitive Courses Subscription';
        return view('liveclasssubscription.daily_class_subscription',compact('subscribers','headingforsubscription'));
    }

    public function get_board(){
        $boards = \App\Model\Category::where('parent_category_id',83)->get();
        echo '<option value="">Select Board/Preparation</option>';
            foreach($boards as $boardsval){
        echo '<option value="'.$boardsval->id.'">'.$boardsval->name.'</option>';
        }
        //return view($this->theme.'.homepage.class-schedule');
    }
    public function get_competitive_courses(){
        $con = ['is_compitative' => '1', 'parent_category_id' => '0'];
        $Competitive = \App\Model\Category::where($con)->get();
            echo '<option value="">Select Board/Preparation</option>';
        foreach($Competitive as $Competitiveval){
            echo '<option value="'.$Competitiveval->id.'">'.$Competitiveval->name.'</option>';
        }
    }
    public function get_board_classes(Request $request){
        $classes = \App\Model\Category::where('parent_category_id',$request->id)->get();
        echo '<option value="">Select Class/Exam</option>';
        foreach($classes as $classesval){
             echo '<option value="'.$classesval->id.'">'.$classesval->name.'</option>';
        }
    }
}


