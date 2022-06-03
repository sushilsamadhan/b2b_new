<?php

namespace App\Http\Controllers;

use App\OnetooneInstructor;

//namespace App\Http\Controllers\Instructor;

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



class OnetooneInstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (Auth::user()->user_type == "Admin") {
            if ($request->has('search')) {
                $instructors = Instructor::where("name", 'LIKE', '%'. $request->search.'%')
                    ->paginate(10);
            } else {
                $instructors = Instructor::select('instructors.*')
                ->join('users','users.id','=','instructors.user_id')
                ->where('users.is_external','=','2')
                ->where('users.verified','=','1')
                ->orderBy('instructors.created_at','desc')
                ->latest()->paginate(10);
            }
        // } else {
        //     //$instructors = Instructor::where('user_id', Auth::id())->paginate(10);
        //     if ($request->has('search')) {
        //         $instructors = Instructor::where("name", 'LIKE', '%'. $request->search.'%')
        //             ->paginate(10);
        //     } else {
        //         $instructors = Instructor::latest()->paginate(10);
        //     }
        // }

        return view('instructor.onetoone_instructors', compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tutitionAssessment($id)
    {
        $instructorAssessments = InstructorAssessment::leftjoin('categories as cat','cat.id','=','instructor_subjects.course_id')
       ->leftjoin('categories as subCat','subCat.id','=','instructor_subjects.class_id')
       ->leftjoin('courses as c','c.id','=','instructor_subjects.subject_id')
       ->select('subCat.name as subCat','cat.name','c.title','instructor_subjects.*')
       ->orderBy('id', 'DESC')->where('instructor_id' , $id)->where('instructor_type' , '2')->get();

   
       $competitiveSubjects = QuestionTag::where('ques_cat_id', 1)->get();

      // echo '<pre>'; print_r($instructorAssessments); die;

        return view('instructor.tutition_assessment', compact('instructorAssessments','competitiveSubjects'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveTutitionAssessment(Request $request) {
        if($request->package_type ==  'competitive-courses'){
            $request->course_id = $request->subject_id;  
        }
        $values = array(
            'instructor_id' => $request->id ,
            'course_type'=> $request->package_type, 
            'course_id' => $request->category_id, 
            'class_id' => $request->sub_category_id,
            'subject_id' => $request->course_id ,
            'instructor_type' => '2',
            'live_classes_type' => 'tutition'
        );
        DB::table('instructor_subjects')->insert($values);
        return redirect()->back()->with('success', 'Tutition subject updated successfully');
    }
    public function checkTutitioAavailable(Request $request)
    {
        $users = DB::table('instructor_subjects')->select('*')->where($_GET)->count();
        echo $users; die();
        if($users >= 1){
            echo 0;
        }else{
            echo 1;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\OnetooneInstructor  $onetooneInstructor
     * @return \Illuminate\Http\Response
     */
    

    public function TutitionSchedule($id) {
       $instructorDaySchedules = DB::table('instructor_subjects as isub')
       ->leftjoin('categories as cate','cate.id','=','isub.class_id')
       ->where('instructor_id' , $id)->where('live_classes_type' , 'tutition')
       ->where('isub.deleted_at' , NULL)
       ->select('cate.name','cate.id','isub.id as inssubject')->get();



       $instructorName = DB::table('instructor_subjects as isub')
       ->leftjoin('categories as cate','cate.id','=','isub.class_id')
       ->leftjoin('instructors as ins','ins.id','=','isub.instructor_id')
       ->leftjoin('courses as c','c.id','=','isub.subject_id')
       ->where('instructor_id' , $id)->where('live_classes_type' , 'tutition')
       ->where('isub.deleted_at' , NULL)
       ->select('ins.name as insname')->first();

       $instructorDetails = DB::table('instructor_subjects as isub')
       ->leftjoin('categories as cate','cate.id','=','isub.class_id')
       ->leftjoin('categories as catea','catea.id','=','isub.course_id')
       ->leftjoin('instructors as ins','ins.id','=','isub.instructor_id')
       ->leftjoin('courses as c','c.id','=','isub.subject_id')
       ->where('instructor_id' , $id)->where('live_classes_type' , 'tutition')
       ->where('isub.deleted_at' , NULL)
       ->select('catea.name as bname','cate.name','cate.id','isub.id as inssubject','isub.subject_id','c.title as subjectname')->get();

        // echo "<pre>";
        // print_r($instructorDetails); die;
       return view('instructor.tutition-schedule',compact('instructorDaySchedules','instructorName','instructorDetails'));
    }

   
   public function savetuTitionSchedule(Request $request) {
    $values = array(
        'instructor_id' => $request->instructor_id,
        'instructor_subject_id' => $request->instructor_subject_id ,
        'day' => $request->day ,
        'timing' => $request->timing,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time
    );
    DB::table('tutitionschedules')->insert($values);
    return 1;
    // redirect()->back()->with('success', 'Instructor schedule updated successfully');
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OnetooneInstructor  $onetooneInstructor
     * @return \Illuminate\Http\Response
     */
    
    public function deleteTutitionSchedule() {
        DB::table('tutitionschedules')->where('id', $_GET['id'])->delete();
        return redirect()->back()->with('success','Instructor schedule deleted successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OnetooneInstructor  $onetooneInstructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(OnetooneInstructor $onetooneInstructor)
    {
        //
    }

    public function saveScheduletime(Request $request){
        $inst_id = $request->inst_id;
        $data = array( 
            'available_start_time' => $request->stime, 
            'available_end_time' => $request->etime, 
            'teach_time_minutes' => $request->timetotech, 
            'break_time_minutes' => $request->timetobreak 
        );
        DB::table('instructors')->where('id', $inst_id)->update($data);
        return redirect('/dashboard/tutition-schedule/'.$inst_id); 
    }

    public function view_booking(){
        $instructors = Instructor::select('instructors.*')
                ->join('users','users.id','=','instructors.user_id')
                ->where('users.is_external','=','2')
                ->orderBy('instructors.created_at','desc')
                ->latest()->paginate(10);

                return view('instructor.view_booking', compact('instructors'));       
    }

    public function get_view_booking($id){
        $dataBooking = DB::table('tuition_booking as tuibook')
        ->join('instructor_subjects as inssub','inssub.id','=','tuibook.instructor_subjects_id')
        ->join('users','users.id','=','tuibook.user_id')
        ->join('instructors','instructors.id','=','inssub.instructor_id')
        ->leftjoin('courses as c','c.id','=','inssub.subject_id')
        ->where('inssub.instructor_id',$id)
        ->where('inssub.live_classes_type','tutition')
        ->select('tuibook.date_of_booking','c.title','tuibook.time_of_booking','users.name as uname','instructors.name as insname')
        ->get();
    if (count($dataBooking)>=1) {
     foreach($dataBooking as $val){   
        echo '
        <tr>
            <td class="text-center">'.$val->insname.'</td>
            <td>'.$val->title.'</td>
            <td>'.$val->uname.'</td>
            <td>'.$val->date_of_booking.'</td>
            <td>'.$val->time_of_booking.'</td>
        </tr>
        ';
    }
}else{
echo '<tr>
    <td><h3 class="text-center">No Data Found</h3></td>
</tr>';
}
                
    }
    public function live_tuition_instructor()
    {
        $id = DB::table('instructors')->where('user_id',Auth::user()->id)->first();
        $id= $id->id;

        $instructorId = $id;

       $instructorDaySchedules = DB::table('instructor_subjects as isub')
       ->leftjoin('categories as cate','cate.id','=','isub.class_id')
       ->where('instructor_id' , $id)->where('live_classes_type' , 'tutition')
       ->where('isub.deleted_at' , NULL)
       ->select('cate.name','cate.id','isub.id as inssubject')->get();



       $instructorName = DB::table('instructor_subjects as isub')
       ->leftjoin('categories as cate','cate.id','=','isub.class_id')
       ->leftjoin('instructors as ins','ins.id','=','isub.instructor_id')
       ->leftjoin('courses as c','c.id','=','isub.subject_id')
       ->where('instructor_id' , $id)->where('live_classes_type' , 'tutition')
       ->where('isub.deleted_at' , NULL)
       ->select('ins.name as insname')->first();

       $instructorDetails = DB::table('instructor_subjects as isub')
       ->leftjoin('categories as cate','cate.id','=','isub.class_id')
       ->leftjoin('categories as catea','catea.id','=','isub.course_id')
       ->leftjoin('instructors as ins','ins.id','=','isub.instructor_id')
       ->leftjoin('courses as c','c.id','=','isub.subject_id')
       ->where('instructor_id' , $id)->where('live_classes_type' , 'tutition')
       ->where('isub.deleted_at' , NULL)
       ->select('catea.name as bname','cate.name','cate.id','isub.id as inssubject','isub.subject_id','c.title as subjectname')->get();

        // echo "<pre>"; 
        // print_r($instructorDetails); die;
       return view('instructor.live-tuition',compact('instructorDaySchedules','instructorName','instructorDetails','instructorId'));
    }

    public function view_one_instructor_all_data_tuition(){
        $id = DB::table('instructors')->where('user_id',Auth::user()->id)->first();
        $id= $id->id;

    $dataBooking  = DB::table('tuition_booking as tuibook')
        ->join('instructor_subjects as inssub','inssub.id','=','tuibook.instructor_subjects_id')
        ->join('users','users.id','=','tuibook.user_id')
        ->join('instructors','instructors.id','=','inssub.instructor_id')
        ->leftjoin('courses as c','c.id','=','inssub.subject_id')
       ->leftjoin('categories as cate','cate.id','=','inssub.class_id')
        ->where('inssub.instructor_id',$id)
        ->where('inssub.live_classes_type','tutition')
        ->select('cate.name as cname','tuibook.date_of_booking','c.title','tuibook.time_of_booking','users.name as uname','instructors.name as insname')
        ->get();

       return view('instructor.live-tuition-data',compact('dataBooking'));
// print_r($dataBooking); die('=========');

//     if (count($dataBooking)>=1) {
//      foreach($dataBooking as $val){   
//         echo '
//         <tr>
//             <td class="text-center">'.$val->insname.'</td>
//             <td>'.$val->title.'</td>
//             <td>'.$val->uname.'</td>
//             <td>'.$val->date_of_booking.'</td>
//             <td>'.$val->time_of_booking.'</td>
//         </tr>
//         ';
//     }
// }else{
// echo '<tr>
//     <td><h3 class="text-center">No Data Found</h3></td>
// </tr>';
// }
    
    }

    public function show_tuition_booking_student(){
        $id = DB::table('instructors')->where('user_id',Auth::user()->id)->first();
        $id= $id->id;
        $dataBooking  = DB::table('tuition_booking as tuibook')
            ->join('instructor_subjects as inssub','inssub.id','=','tuibook.instructor_subjects_id')
            ->join('users','users.id','=','tuibook.user_id')
            ->join('instructors','instructors.id','=','inssub.instructor_id')
            ->leftjoin('courses as c','c.id','=','inssub.subject_id')
       ->leftjoin('categories as cate','cate.id','=','inssub.class_id')
            ->where('inssub.instructor_id',$id)
            ->where('tuibook.unic_jitsi_code',$_GET['id'])
            ->where('inssub.live_classes_type','tutition')
            ->select('cate.name as cname','tuibook.date_of_booking','tuibook.unic_jitsi_code','c.title','tuibook.time_of_booking','users.name as uname','instructors.name as insname')
            ->first();


if($dataBooking){        
    echo json_encode($dataBooking);
}else{
    echo "0";
}


// if($dataBooking){        
// echo "Your are going to start tuition period with <b>".$dataBooking->uname." ".$dataBooking->cname." ".$dataBooking->title." ".$dataBooking->unic_jitsi_code."</b>" ; 
// }else{
//     echo "5";
// }


    }



    public function demo_jitsi($id){
       date_default_timezone_set('Asia/Calcutta'); 
        if (Auth::user()) {
            $booking_id = DB::table('tuition_booking')->select('id')->where('unic_jitsi_code',$id)->first();

            $booking_id_exist = DB::table('live_tuition_joining_details')->select('id')->where('tuition_booking_id',$booking_id->id)->first();
            if (empty($booking_id_exist)) {
                $values = array(
                    'tuition_booking_id' => $booking_id->id,
                    'joining_time' => date('H:i', time())
                );
                DB::table('live_tuition_joining_details')->insert($values);   
            }
            return view('instructor.demojitsi');
        }else{
            return redirect('login'); 
        }
    }
    public function my_tuition_close($id){
       date_default_timezone_set('Asia/Calcutta'); 
        if (Auth::user()) {
            $booking_id = DB::table('tuition_booking')->select('id')->where('unic_jitsi_code',$id)->first();

            $booking_id_exist = DB::table('live_tuition_joining_details')->select('id')->where('tuition_booking_id',$booking_id->id)->first();
            if (!empty($booking_id_exist)) {
                $values = array(
                    'exit_time' => date('H:i', time())
                );
                DB::table('live_tuition_joining_details')
                            ->where('tuition_booking_id', $booking_id->id)
                            ->update($values);
            }
            return redirect('/'); 
        }else{
            return redirect('login'); 
        }
    }



}
