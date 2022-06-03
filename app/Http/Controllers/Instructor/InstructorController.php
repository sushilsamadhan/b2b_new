<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Model\Instructor;
use App\User;
use App\InstructorDaySchedules;
use App\InstructorAssessment;
use App\InstructorLiveClass;
use App\QuestionTag;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\NotificationUser;
use App\Model\Course;
use phpseclib\Crypt\Hash;
use DB;

class InstructorController extends Controller
{

    function userNotify($user_id,$details)
    {
        $notify = new NotificationUser();
        $notify->user_id = $user_id;
        $notify->data = $details;
        $notify->save();
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //there are the check the admin or
        if (Auth::user()->user_type == "Admin") {
            if ($request->has('search')) {
                $instructors = Instructor::where("name", 'LIKE', '%'. $request->search.'%')
                    ->paginate(10);
            } else {
                $instructors = Instructor::latest()->paginate(10);
            }
        } else {
            //$instructors = Instructor::where('user_id', Auth::id())->paginate(10);
            if ($request->has('search')) {
                $instructors = Instructor::where("name", 'LIKE', '%'. $request->search.'%')
                    ->paginate(10);
            } else {
                $instructors = Instructor::latest()->paginate(10);
            }
        }
        return view('instructor.index', compact('instructors'));
    }




    /*This function show all instructor related history
    like Package, Course , Enrolment Student list Get Payment History*/
    public function show($id)
    {
        if(Auth::user()->user_type == "Instructor"){
            $instructor = Instructor::where('user_id', Auth::id())
                ->with('purchaseHistory')
                ->with('courses')
                ->first();
        }else{
            $instructor = Instructor::where('user_id', $id)
                ->with('purchaseHistory')
                ->with('courses')
                ->first();
        }


        return view('instructor.show', compact('instructor'));
    }

    /*Update profile */
    public function edit($id)
    {
        //return Auth::user()->id;
        if(Auth::user()->user_type=='Admin' || Auth::user()->user_type=='Instructor' &&  Auth::user()->id==5){
            $each_user = Instructor::where('user_id', $id)->firstOrFail();
        }else{
            $each_user = Instructor::where('user_id', Auth::id())->firstOrFail();

        }

       // return $each_user;
        return view('instructor.profile', compact('each_user'));
    }

    /*Update the Profile*/
    public function update(Request $request)
    {
        //return $request->all();

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

      if(Auth::user()->user_type=='Admin'){
        $instructor = Instructor::where('user_id', $request->user_id)->firstOrFail();
      }elseif(Auth::user()->user_type=='Instructor' &&  Auth::user()->id==5){

        $instructor = Instructor::where('user_id', $request->user_id)->firstOrFail();

      }else{

        $instructor = Instructor::where('user_id', Auth::id())->firstOrFail();

      }
       $instructor->name = $request->name;
        $instructor->phone = $request->phone;
        if ($request->hasFile('newImage')) {
            fileDelete($request->image);
            $instructor->image = fileUpload($request->newImage, 'instructor');
        } else {
            $instructor->image = $request->image;
        }
        $instructor->address = $request->address;
        $instructor->linked = $request->linked;
        $instructor->heighst_qualification = $request->heighst_qualification;
        $instructor->total_experience = $request->total_experience;
        $instructor->tw = $request->tw;
        $instructor->fb = $request->fb;
        $instructor->skype = $request->skype;
        $instructor->about = $request->about;

        if ($request->hasFile('signature')){
            $instructor->signature = fileUpload($request->signature,'instructor') ;
        }
        $instructor->save();

        /*User*/
        $user = User::findOrFail($request->user_id);
        $user->image = $instructor->image;
        if ($request->password != null){
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->save();

        $details = [
            'body' => $instructor->name . translate(' profile updated '),
        ];

        /* sending instructor notification */
        if(Auth::user()->user_type=='Admin' || Auth::user()->user_type=='Instructor' &&  Auth::user()->id==5){
            // notify()->success(translate('Profile updated successfully'));
             return redirect()->route('instructors.index')
             ->with('success', 'Profile updated successfully');
         }else{   
         $notify = $this->userNotify(Auth::user()->id,$details);
 
         notify()->success(translate('Profile updated successfully'));
         return back();
         }
    }

    /*banned the instructor*/
    public function banned(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $user = User::findOrFail($request->id);
        if ($user->user_type == "Instructor" && $user->banned == true) {
            $user->banned = false;
            notify()->success(translate('This user is Active'));

        } elseif ($user->user_type == "Instructor" && $user->banned == false) {
            $user->banned = true;
            notify()->success(translate('This user is Banned'));
        } else {
            notify()->warning(translate('Please there are problem try again'));
        }
        $user->save();
        return back();
    }
    //END

    public function instructorAssessment($id) {
      // $instructorAssessments =  InstructorAssessment::get();
         
       $instructorAssessments = InstructorAssessment::leftjoin('categories as cat','cat.id','=','instructor_subjects.course_id')
       ->leftjoin('categories as subCat','subCat.id','=','instructor_subjects.class_id')
       ->leftjoin('courses as c','c.id','=','instructor_subjects.subject_id')
       ->select('subCat.name as subCat','cat.name','c.title','instructor_subjects.*')
       ->orderBy('id', 'DESC')->where('instructor_id' , $id)->get();

   
       $competitiveSubjects = QuestionTag::where('ques_cat_id', 1)->get();

      // echo '<pre>'; print_r($instructorAssessments); die;

        return view('instructor.instructor-assessment', compact('instructorAssessments','competitiveSubjects'));

  
    }

    
    public function saveInstructorAssessment(Request $request) {
        if($request->package_type ==  'competitive-courses'){
            $request->course_id = $request->subject_id;  
        }
        InstructorAssessment::create(['instructor_id' => $request->id ,'course_type'=> $request->package_type, 'course_id' => $request->category_id, 'class_id' => $request->sub_category_id,'subject_id' => $request->course_id ]);
        
        return redirect()->back()->with('success', 'Instructor subject updated successfully');
    }

    public function InstructorSchedule($id) {
      
       $instructorDaySchedules = InstructorDaySchedules::where('instructor_subject_id' , $id)->get();
//print_r($instructorDaySchedules); die;
       return view('instructor.instructor-schedule',compact('instructorDaySchedules'));
    }


   public function saveInstructorSchedule(Request $request) {
       

    InstructorDaySchedules::create(['instructor_subject_id' => $request->id , 'day' => $request->day ,'start_time' => $request->start_time, 'end_time' =>  $request->end_time]);
    
    return redirect()->back()->with('success', 'Instructor schedule updated successfully');
   
}
public function deleteInstructorSchedule($id) {
    InstructorDaySchedules::where('id', '=', $id)->update(['deleted_at' => Carbon::now()]);
        return redirect()->back()
                ->with('success','Instructor schedule deleted successfully');  


}

public function deleteInstructorSubject($id) {
    InstructorAssessment::where('id', '=', $id)->update(['deleted_at' => Carbon::now()]);
        return redirect()->back()
                ->with('success','Instructor subject deleted successfully');  


}

public function liveClass(Request $request) {
  
    if ($request->has('search')) {
    
        $instructors = InstructorliveClass::with('instructorDetail')->where("live_class_title", 'LIKE', '%'. $request->search.'%')->paginate(10);
    } else {
        $instructors = InstructorliveClass::with('instructorDetail')->latest()->paginate(10);
    }
    
    return view('instructor.live-class', compact('instructors'));
    }
    
 
 public function liveClassjoinStudent(Request $request) {
  
    if ($request->has('search')) {
            $instructors = DB::table('live_class_attendance')
                ->join('instructor_live_classes', 'instructor_live_classes.id', '=', 'live_class_attendance.live_class_booking_id')
                ->join('users', 'users.id', '=', 'live_class_attendance.user_id')
                ->join('instructors', 'instructors.id', '=', 'instructor_live_classes.instructor_id')
                ->where("instructor_live_classes.live_class_title", 'LIKE', '%'. $request->search.'%')
                ->select('instructor_live_classes.*', 'users.name as sname', 'live_class_attendance.time_of_join', 'live_class_attendance.time_of_left','instructors.name as iname')
                ->paginate(10);
    } else {

        $instructors = DB::table('live_class_attendance')
                ->join('instructor_live_classes', 'instructor_live_classes.id', '=', 'live_class_attendance.live_class_booking_id')
                ->join('users', 'users.id', '=', 'live_class_attendance.user_id')
                ->join('instructors', 'instructors.id', '=', 'instructor_live_classes.instructor_id')
                ->select('instructor_live_classes.*', 'users.name as sname', 'live_class_attendance.time_of_join', 'live_class_attendance.time_of_left','instructors.name as iname')
                ->paginate(10);
    }
    return view('instructor.live-class-join-students', compact('instructors'));
} 

    
public function addLiveClass() {

    $instructors = Instructor::latest()->get();
    
    return view('instructor.add-live-class', compact('instructors'));
    }
    
    public function instructByCourseType(Request $request)
    {
        $courses = array();
        if($request->instructor) {
                $courses_detail =  $instructorAssessments = InstructorAssessment::leftjoin('categories as cat','cat.id','=','instructor_subjects.course_id')
                ->leftjoin('categories as subCat','subCat.id','=','instructor_subjects.class_id')
                ->leftjoin('courses as c','c.id','=','instructor_subjects.subject_id')
            //    ->leftjoin('question_tags as d','d.id','=','instructor_subjects.subject_id')
                ->select('subCat.name as subCat','cat.name','c.title','c.content_type','instructor_subjects.*')
                ->orderBy('id', 'DESC')->where('instructor_id',$request->instructor)->get();
               
                $courses = $courses_detail;
        }
        return response(['message' => 'success','data' => $courses], 200);
    }
    
    public function saveLiveClass(Request $request) {


        $request->validate(
            [
                'instructor' => 'required',
                'live_class_title'=>'required',
                'live_url' =>'required',
            ],
        );  
        if(!empty($request->instructor_subject)){
            $instructor_subject_s = $request->instructor_subject;
        }else{
            $instructor_subject_s = $request->instructor_subject_board;
        }

        InstructorliveClass::create(['instructor_id' => $request->instructor , 'instructor_subject_id' => $instructor_subject_s ,'live_class_title' => $request->live_class_title ,'date' => $request->date , 'start_time' => $request->start_time ,'end_time' => $request->end_time, 'status' => $request->status ,'url' => $request->live_url]);
    
        return redirect()->route('live-class')->with('success','Instructor Live Class added successfully');   
    
    }
    
    public function editLiveClass($id) {
    
        $instructors = Instructor::latest()->get();
    
        $instructorliveClass = InstructorliveClass::where('id',$id)->latest()->first();
    
        return view('instructor.edit-live-class', compact('instructors','instructorliveClass'));
    }
    
    public function deleteLiveClass($id) {
    
        InstructorliveClass::where('id', '=', $id)->update(['deleted_at' => Carbon::now()]);
    
         return redirect()->back()->with('success','Instructor live class deleted successfully');  
    }
    
    public function updateLiveClass(Request $request) {

 
        $request->validate(
            [
                'instructor' => 'required',
                'live_class_title'=>'required',
                'live_url' =>'required',
            ],
        );
        if(!empty($request->instructor_subject)){
            $instructor_subject_s = $request->instructor_subject;
        }else{
            $instructor_subject_s = $request->instructor_subject_board;
        }
        
        InstructorliveClass::where('id', $request->id)->update(['instructor_id' => $request->instructor , 'instructor_subject_id' => $instructor_subject_s ,'live_class_title' => $request->live_class_title ,'date' => $request->date , 'start_time' => $request->start_time ,'end_time' => $request->end_time, 'status' => $request->status ,'url' => $request->live_url]);
    
        return redirect()->route('live-class')->with('success','Instructor Live Class updated successfully.');  
    
    }

    public function instructorAccess()
    {
        $instructors = Instructor::latest()->get();
        $courses = Course::where('content_type','board')->orWhere('content_type','competitive-courses')->get();
        return view('instructor.instructor_access', compact('courses','instructors'));
    }

    public function instructorAccessUpdate(Request $request){
        $course = Course::find($request->course);
        $course->user_id = $request->instructor;
        $course->save();
        return redirect()->back()->with('success','Instructor access for course updated successfully');
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        if($data->verified == 1){
            $data1['verified'] = 0;
            $message = "Instructor unverified successfully";
        }else{
            $data1['verified'] = 1;
            $message = "Instructor verified successfully";
        }

        $result = User::where('id',$id)->update($data1);
        return response(['message' => translate($message)], 200);
    }

    public static function isInstructorVerified($user_id) {
        $data = User::find($user_id);
        return $data->verified;
    }


}
