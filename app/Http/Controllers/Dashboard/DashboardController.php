<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminEarning;
use App\Model\Course;
use App\Model\Enrollment;
use App\Model\Instructor;
use App\Model\InstructorEarning;
use App\Model\CoursePurchaseHistory;
use App\Model\Student;
use App\User;
use Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Quiz;
use App\Question;
use App\Model\ClassContent;
use App\Model\Classes;
use App\Model\Category;
use App\Model\MindMap;
use App\OrderDetail;
use App\StudentTestQuestion;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function __construct()
    {
      //  Artisan::call('view:clear');
    }

    // dashboard
    public function index()
    {
        // if(Auth::user()->is_external == "2"){
        //     return Redirect::to('dashboard/my/live-tuition');
        // }

        //this month
        $this_start = Carbon::parse(date('d-M-y'))->startOfMonth()->toDateTimeString();
        $this_end = Carbon::parse(date('d-M-y'))->endOfMonth()->toDateTimeString();

        //today
        $start_day  = Carbon::parse(date('d-M-y'))->startOfDay()->toDateTimeString();
        $end_day    = Carbon::parse(date('d-M-y'))->endOfDay()->toDateTimeString(); 

        //prev month
        $prev_start = Carbon::parse(date('d-M-y'))->startOfMonth()->subMonth()->toDateTimeString();
        $prev_end = Carbon::parse(date('d-M-y'))->endOfMonth()->subMonth()->toDateTimeString();

        if (Auth::user()->user_type == "Admin") {
            
            $course = Course::select()->get();
            $c_id = array();
            foreach ($course as $c) {
                array_push($c_id, $c->id);
            }
            $enroll = Enrollment::whereIn('course_id', array_unique($c_id))->get();

            //get student id
            $s_id = array();
            foreach ($enroll as $e) {
                array_push($s_id, $e->user_id);
            }
            $total_students = Student::whereIn('user_id', array_unique($s_id))->get();
            $todays_student = Student::whereBetween('created_at', [$start_day, $end_day])
                                        ->orderBy('id', 'DESC')->get();

            //all instructor
            /*Top instructor get bay most enroll courses*/
            $enroll_courses_count = DB::table('enrollments')->select('enrollments.course_id',
                DB::raw('count(enrollments.course_id) as total_course'))
                ->orderByDesc('total_course')
                ->groupBy('course_id')->get();

            $i_id = array();

            foreach ($enroll_courses_count as $e) {
                $c = Course::find($e->course_id);
                if ($c != null && $c->user_id != null){
                    array_push($i_id, $c->user_id);
                }
            }
            /*Top Selling courses Instructor*/
            $top_instructor = Instructor::whereIn('user_id', array_unique($i_id))->take(10)->get()->shuffle();

            //
            $total_instructor = User::where('user_type', 'Instructor')->count();
        //  $total_students = User::where('user_type', 'Student')->count();
            $total_course = Course::all()->count();
            $total_enrollments = Enrollment::all()->count();

            //Admin Earning
            //this mount earning =>AdminEarning
            $this_earning = OrderDetail::whereBetween('created_at', [$this_start, $this_end])
            ->where('transaction_status', 'SUCCESS')->sum('transaction_amount');
            //previous mount earning
            $prev_earning = OrderDetail::whereBetween('created_at', [$prev_start, $prev_end])
            ->where('transaction_status', 'SUCCESS')->sum('transaction_amount');
            //total earning
            $total_earning = OrderDetail::all()->where('transaction_status', 'SUCCESS')->sum('transaction_amount');
            $today_earning = OrderDetail::whereBetween('created_at', [$start_day, $end_day])->where('transaction_status', 'SUCCESS')->sum('transaction_amount');
           
            //month or labels
            $months = array();
            $admin_earning = array();
        //    $instructor_earning = array();
            $t_earning = array();
            for ($i = 1; $i <= 12; $i++) {
                $m = date("M", mktime(0, 0, 0, $i, 1, date("Y")));
                array_push($months, $m);
                //this month
                $start = Carbon::parse($m)->startOfMonth()->toDateTimeString();
                $end = Carbon::parse($m)->endOfMonth()->toDateTimeString();
            //    $per_earning = InstructorEarning::whereBetween('created_at', [$start, $end])->sum('will_get');
            //    array_push($instructor_earning, $per_earning);
                $a_earning = OrderDetail::whereBetween('created_at',[$start,$end])
                ->where('transaction_status', 'SUCCESS')->sum('transaction_amount');
                array_push($admin_earning, $a_earning);
            //    array_push($t_earning,$a_earning+$per_earning);
                array_push($t_earning,$a_earning);
                if (date('M') == $m) {
                    break;
                }
            }

        //    $totActAssessment = Quiz::where('status', '1' )->count();  
            $totMindMaps = MindMap::select()->count();
            $totVideos = ClassContent::where('content_type', 'Video')->count();
            $totPdfs = ClassContent::where('content_type', 'Document')->count();
            $totQuestions = StudentTestQuestion::where('status','1')->count();
            $s_course = Course::Published()->with('classes')->get(); // single course details

            $totLectures=0;
            if(isset($s_course)){
                foreach($s_course as $val){
                    foreach($val->classes as $item){
                        $totLectures+=$item->contents->count();
                    }
                }
            } 
            return view('dashboard.index',
                compact('top_instructor','total_instructor','total_students',
                    'months','t_earning','total_earning','today_earning',
                    'admin_earning','prev_earning','this_earning','total_course',
                    'total_enrollments','totMindMaps',
                    'totVideos','totPdfs','totQuestions','totLectures','todays_student' 
                ));
        } else {
        /*    
            $course = Course::where('user_id', Auth::id())->get();
            $c_id = array();
            foreach ($course as $c) {
                array_push($c_id, $c->id);
            }
            $enroll = Enrollment::whereIn('course_id', array_unique($c_id))->get();

            //get student id
            $s_id = array();
            foreach ($enroll as $e) {
                array_push($s_id, $e->user_id);
            }
            $total_students = Student::whereIn('user_id', array_unique($s_id))->take(10)->get()->shuffle();

            //Instructor Earning
            //this mount earning
            $this_earning = InstructorEarning::whereBetween('created_at', [$this_start, $this_end])->sum('will_get');
            //previous mount earning
            $prev_earning = InstructorEarning::whereBetween('created_at', [$prev_start, $prev_end])->sum('will_get');
            //total earning
            $total_earning = InstructorEarning::all()->sum('will_get');


            //month or labels
            $months = array();
            $data = array();
            for ($i = 1; $i <= 12; $i++) {
                $m = date("M", mktime(0, 0, 0, $i, 1, date("Y")));
                array_push($months, $m);
                //this month
                $start = Carbon::parse($m)->startOfMonth()->toDateTimeString();
                $end = Carbon::parse($m)->endOfMonth()->toDateTimeString();
                $per_earning = InstructorEarning::whereBetween('created_at', [$start, $end])->sum('will_get');
                array_push($data, $per_earning);
                if (date('M') == $m) {
                    break;
                }
            }
        */    
        $course = Course::select()->get();
        $c_id = array();
        foreach ($course as $c) {
            array_push($c_id, $c->id);
        }
        $enroll = Enrollment::whereIn('course_id', array_unique($c_id))->get();

        //get student id
        $s_id = array();
        foreach ($enroll as $e) {
            array_push($s_id, $e->user_id);
        }
        $total_students = Student::whereIn('user_id', array_unique($s_id))->get();
        $todays_student = Student::whereIn('user_id', array_unique($s_id))
                                ->whereBetween('created_at', [$start_day, $end_day])
                                ->orderBy('id', 'DESC')->get();

        //this month earning
        $this_earning = OrderDetail::whereBetween('created_at', [$this_start, $this_end])
        ->where('transaction_status', 'SUCCESS')->sum('transaction_amount');
        //previous month earning
        $prev_earning = OrderDetail::whereBetween('created_at', [$prev_start, $prev_end])
        ->where('transaction_status', 'SUCCESS')->sum('transaction_amount');
        //total earning
        $total_earning = OrderDetail::all()->where('transaction_status', 'SUCCESS')->sum('transaction_amount');
        $today_earning = OrderDetail::whereBetween('created_at', [$start_day, $end_day])->where('transaction_status', 'SUCCESS')->sum('transaction_amount');
        
        //month or labels
        $months = array();
        $data = array();
        for ($i = 1; $i <= 12; $i++) {
            $m = date("M", mktime(0, 0, 0, $i, 1, date("Y")));
            array_push($months, $m);
            //this month
            $start = Carbon::parse($m)->startOfMonth()->toDateTimeString();
            $end = Carbon::parse($m)->endOfMonth()->toDateTimeString();
            $per_earning = OrderDetail::whereBetween('created_at', [$start, $end])
            ->where('transaction_status', 'SUCCESS')->sum('transaction_amount');
            array_push($data, $per_earning);
            if (date('M') == $m) {
                break;
            }
        } 

    //    $totActAssessment = Quiz::where('status', '1' )->count();  
        $totMindMaps = MindMap::select()->count();
        $totVideos = ClassContent::where('content_type', 'Video')->count();
        $totPdfs = ClassContent::where('content_type', 'Document')->count();
        $totQuestions = StudentTestQuestion::where('status','1')->count();

        $s_course = Course::Published()->with('classes')->get(); // single course details
        $instructors = User::where('user_type', 'Instructor')->where('verified','1')->where('banned','0')->get();
        
        $totLectures=0;
        if(isset($s_course)){
            foreach($s_course as $val){
                foreach($val->classes as $item){
                    $totLectures+=$item->contents->count();
                }
            }
        } 
        return view('dashboard.instructor',
                compact('enroll', 'months','data','course', 'total_students','today_earning',
                'this_earning', 'prev_earning', 'total_earning','instructors',
                'totMindMaps', 'totVideos', 'totPdfs', 'totQuestions', 'totLectures', 'todays_student'
            ));    
        }
    }

    //Search Statistics values between dates on dashboard
    public function getStatisticsByDate(Request $request)
    { 
        $start = $request->start_date;
        $end = $request->end_date;
        $inst_id = $request->inst_id;
        if(isset($request->date_at) && $request->date_at!=''){
            $search_with = $request->date_at;
        }
    //    return response()->json($search_with); 

        if(isset($start) && $start!='' && isset($end) && $end!=''){
            $start = $request->start_date.' '.'00:00:00';
            $end = $request->end_date.' '.'23:59:59';
            if($inst_id!='' && $inst_id!='all') {
                $totCourse = Course::where('user_id', $inst_id)->whereBetween($search_with, [$start, $end])->count();
                $s_course = Course::Published()->with('classes')->where('user_id', $inst_id)->whereBetween($search_with, [$start, $end])->get(); 
                $totQuestions = StudentTestQuestion::where('user_id', $inst_id)->whereBetween($search_with, [$start, $end])->where('status','1')->count();
                $totMindMaps = MindMap::where('user_id', $inst_id)->whereBetween($search_with, [$start, $end])->count();
                $totVideos = ClassContent::where('user_id', $inst_id)->whereBetween($search_with, [$start, $end])->where('content_type', 'Video')->count();
                $totPdfs = ClassContent::where('user_id', $inst_id)->whereBetween($search_with, [$start, $end])->where('content_type', 'Document')->count();
            }else {
                $totCourse = Course::whereBetween($search_with, [$start, $end])->count();
                $s_course = Course::Published()->with('classes')->whereBetween($search_with, [$start, $end])->get(); 
                $totQuestions = StudentTestQuestion::whereBetween($search_with, [$start, $end])->where('status','1')->count(); 
                $totMindMaps = MindMap::whereBetween($search_with, [$start, $end])->count();
                $totVideos = ClassContent::whereBetween($search_with, [$start, $end])->where('content_type', 'Video')->count();
                $totPdfs = ClassContent::whereBetween($search_with, [$start, $end])->where('content_type', 'Document')->count();
            }
        } else {
            $totCourse = Course::select()->count();
        //    $totActAssessment = Quiz::where('status', '1' )->count();  
            $totMindMaps = MindMap::select()->count();
            $totVideos = ClassContent::where('content_type', 'Video')->count();
            $totPdfs = ClassContent::where('content_type', 'Document')->count();
            $totQuestions = StudentTestQuestion::where('status','1')->count();
            $s_course = Course::Published()->with('classes')->get(); // single course details
        }

        $totLectures=0;
        if(isset($s_course)){
            foreach($s_course as $val){
                foreach($val->classes as $item){
                    $totLectures+=$item->contents->count();
                }
            }
        } 
        return response()->json(
            ['totCourse'=>$totCourse,
            'totMindMaps' =>$totMindMaps,
            'totVideos' => $totVideos,
            'totPdfs' => $totPdfs,
            'totQuestions' => $totQuestions,
            'totLectures' => $totLectures    
        ]);
    } 
}
