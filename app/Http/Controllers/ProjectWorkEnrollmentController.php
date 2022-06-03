<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Model\PwCourse;
use App\Model\PwSeenContent;
use App\Model\PwEnrollment;
use App\MockTestMaster;
use App\MockTestEnrollment;
use App\Model\Mentor;
use App\Model\Webinar;
use Illuminate\Http\Request;
use App\MockTestEnrollmentAnswer;
use App\StudentTestQuestion;


class ProjectWorkEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $enrolls = PwEnrollment::with(['getcatname','getclassname'])
        ->select('pw_enrollments.user_id as pwenruser_id','pw_enrollments.*','students.*','pw_courses.*','pw_courses.*','pw_categories.category_name',)
        ->leftJoin('students','pw_enrollments.user_id','students.user_id')
        ->leftJoin('pw_courses','pw_courses.id','pw_enrollments.project_work_id')
        ->leftJoin('pw_categories','pw_courses.category_id','pw_categories.id');

        
        //getcatname getclassname
       
        $enrolls = $enrolls->orderBydesc('pw_enrollments.id')->paginate(50)->withQueryString();
         return view('projectworkenroll.index', compact('enrolls'))
                    ->with('i',(request()->input('page', 1) - 1) * 50);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public static function seenCoursePer($id,$usereid, $course_id)
    {
       
        $seen_content = PwSeenContent::where('user_id', $usereid)->where('enroll_id', $id)->get()->count();
        $course = PwCourse::where('id', $course_id)->with('classes')->first();


        $total_content = 0;
        foreach ($course->classes as $item) {
            $total_content += $item->contents->count();
        }


        // calculate the % done this enroll course
        if ($seen_content > 0 && $total_content!= 0) {
            $percentage = ($seen_content / $total_content) * 100;
            $percentage = $percentage > 100 ? 100 : $percentage;
        } else {
            $percentage = 0;
        }


        return number_format($percentage);
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
     * @param  \App\ProjectWorkEnrollment  $projectWorkEnrollment
     * @return \Illuminate\Http\Response
     */
    public function showprojectworkenroll(Request $request)
    {
        $user_id = $request->id;
        $pw_single_course = PwCourse::with('mentor')->where('slug', $request->slug)->with('classes')->first();

        $enroll = PwEnrollment::where('project_work_id', $pw_single_course->id)->where('user_id', $user_id)->first();
        $mentordata = Mentor::where('id',$enroll->mentor_id)->first();
        $seen_content = PwSeenContent::select('content_id')->where('user_id', $user_id)->where('course_id',$pw_single_course->id)->where('enroll_id',$enroll->id)->first();

        if ($enroll->count() == 0) {
            return back();
        }
        Session::put('location_path', $request->slug);
       
        $totalAttend = MockTestEnrollment::where(['test_type' => 'subject','test_status' => 'finish','user_id' => $user_id ,'package_id' => $pw_single_course->id])->count();
        $mockTests = MockTestMaster::with('mockTestSection')->where(['pw_course_id' => $pw_single_course->id])->where('status', 1)->get();
      
       
        return view('projectworkenroll.show', compact('enroll','pw_single_course','mockTests','mentordata','totalAttend','seen_content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectWorkEnrollment  $projectWorkEnrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(PwEnrollment $projectWorkEnrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectWorkEnrollment  $projectWorkEnrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PwEnrollment $projectWorkEnrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectWorkEnrollment  $projectWorkEnrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PwEnrollment $projectWorkEnrollment,$id)
    {
        $projectWorkEnrollments = PwEnrollment::where('id','=',$id)->first();
        $projectWorkEnrollments->delete();
        return redirect()->route('projectworkenroll.index')
                         ->with('success', 'Project Work Enrollment deleted successfully !');
    }

   
}
