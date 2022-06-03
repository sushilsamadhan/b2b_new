<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\QuizScore;
use App\Model\Course;
use App\Model\Enrollment;
use App\Model\Student;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /*All students with search option */
    public function index(Request $request)
    {
        // echo Auth::user()->school_id; die('=========------ppppp');
        if (Auth::user()->user_type == "Instructor") {
            /*if Authenticated  user is admin , admin can show all students */
            if ($request->get('search') && $request->get('startdate') && $request->get('enddate')) {
                $students = Student::whereBetween('created_at', [$request->get('startdate'), $request->get('enddate')])
                    ->where('name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('email', 'like', '%' . $request->get('search') . '%')
                    ->where('school_id', '=', Auth::user()->school_id)
                    ->orderBydesc('id')->paginate(10);

            }elseif ($request->get('search')) {
                $students = Student::where('name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('email', 'like', '%' . $request->get('search') . '%')
                    ->where('school_id', '=', Auth::user()->school_id)
                    ->orderBydesc('id')->paginate(10);

            }elseif ($request->get('startdate') && $request->get('enddate')) {
                $students = Student::where('created_at','>=', $request->get('startdate'))
                    ->where('created_at','<=', $request->get('enddate'))
                    ->where('school_id', '=', Auth::user()->school_id)
                    ->orderBydesc('id')->paginate(10);
               
            }
            elseif ($request->get('startdate')) {
                $start_day = Carbon::parse(date($request->get('startdate')))->startOfDay()->toDateTimeString();
                $students = Student::where('created_at','>=', $start_day)
                ->where('school_id', '=', Auth::user()->school_id)
                    ->orderBydesc('id')->paginate(10);

            }elseif ($request->get('enddate')) {
                $end_day  = Carbon::parse(date($request->get('enddate')))->endOfDay()->toDateTimeString();
                $students = Student::where('created_at','<=', $end_day)
                ->where('school_id', '=', Auth::user()->school_id)
                    ->orderBydesc('id')->paginate(10);
               
            }



            else {
                $students = Student::orderBydesc('id')->where('school_id', '=', Auth::user()->school_id)->paginate(10);
            }


        } 
        /*else {
            //There are the Instructor show only his/her register Students list
            $courses = Course::where('user_id', Auth::id())->get();
            $course_id_array = array();
            foreach ($courses as $i) {
                array_push($course_id_array, $i->id);
            }
            $enroll_student_id = array();
            $enroll = Enrollment::whereIn('course_id', $course_id_array)->get();
            foreach ($enroll as $i) {
                array_push($enroll_student_id, $i->user_id);
            }

            if ($request->get('search')) {
                $students = Student::where('name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('email', 'like', '%' . $request->get('search') . '%')
                    ->whereIn('user_id', $enroll_student_id)->orderBydesc('id')->paginate(10);
            } else {
                $students = Student::whereIn('user_id', $enroll_student_id)->orderBydesc('id')->paginate(10);
            }
        }*/
        return view('module.students.index', compact('students'));
    }

    /*This function show all instructor related history
    like Package, Course , Enrolment Student list Get Payment History*/
    public function show($id)
    {
        $each_student = Student::where('user_id', $id)->where('school_id', '=', Auth::user()->school_id)->first();

        return view('module.students.show', compact('each_student'));
    }

    public function enrolled_list(Request $request)
    {
        $enroll = Enrollment::leftJoin('courses','enrollments.course_id','courses.id')
            ->leftJoin('students','enrollments.user_id','students.user_id')
            ->leftJoin('course_purchase_histories', 'enrollments.id','course_purchase_histories.enrollment_id');

        if($request->search!=''){
            $enroll =  $enroll->where('students.name', 'like', '%'.$request->search.'%')
            ->orWhere('courses.title', 'like', '%'.$request->search.'%')
            ->orWhere('students.email', '=', $request->search);
        }
        // if($request->search!=''){
        //     $enroll =  $enroll->orWhere('courses.title', 'like', '%'.$request->search.'%');
        //     }
        $enroll = $enroll->orderBydesc('enrollments.id')->paginate(50)->withQueryString();
                
        foreach($enroll as $item) {
            $assessment_result = QuizScore::where('user_id', $item->user_id)->where('course_id', $item->course_id)->orderBydesc('id')->first();
            $item->assessment_status = $assessment_result ? $assessment_result->status : '';
        }
        
        return view('module.students.enrolled', compact('enroll'));
    }

    //END
}
