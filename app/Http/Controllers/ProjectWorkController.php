<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Model\PwCategory;
use App\Model\PwCourse;
use App\Model\PwWebinar;
use App\Model\PwClassContent;
use App\Model\PwClasses;
use App\Model\PwSeenContent;
use App\Model\Demo;
use App\Model\PwEnrollment;
use App\MockTestMaster;
use App\MockTestEnrollment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Auth;
class ProjectWorkController extends Controller
{


     /**
     * Display a Theme.
     *
     * @return \Illuminate\Http\Response
     */

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
        if(!\App\Category_permission::select('category_id')->where('school_id', \Session::get('school_id'))->where('type', 'content')->where('category_id', 'project-works')->exists()){
            return redirect('/')->with('msgpermisiondenie', 'The Message');
        }
        $pwCategory = PwCategory::where(['parent_category_id'=>0,'status'=>1])->get();
        return view($this->theme.'.project_work.index',compact('pwCategory'));
    }

    public function show_pw_courses(Request $request)
    {
        
        $category = PwCategory::where('slug',$request->slug)->first();
        $pwCategory = PwCategory::where(['parent_category_id'=>0,'status'=>1])->get();
        $courses = PwCourse::where(['category_id'=>$category->id])->Published()->latest()->paginate(12);
        return view($this->theme.'.project_work.pw_course_list',compact('category','courses','pwCategory'));
    }

    public function projectWorkSearch(Request $request)
    {
        if ($request->key == null) {
            $courses = null;
        } else {
            $courses = PwCourse::Published()->where('title', 'LIKE', "%{$request->key}%")->get();
        }
        $search = collect();
        if ($courses == null) {
            return response(['data' => $search], 200);
        } else {
            if ($courses->count() > 0) {
                foreach ($courses as $item) {
                    $demo = new Demo();
                    $demo->title = Str::limit($item->title, 58);
                    $demo->image = null;//filePath($item->image);
                    $demo->link = route('project_work.pw_course_detail', $item->slug);
                    $search->push($demo);
                }
            } else {
                $demo = new Demo();
                $demo->title = translate('No Course Found');
                $demo->image = null;
                $demo->link = null;
                $search->push($demo);
            }
        }
        return response(['data' => $search], 200);
    }

    public function pw_course_details(Request $request)
    {
        $pw_single_course = PwCourse::where(['slug'=>$request->slug])->first();
        $enroll = array();
        if(Auth::user() && Auth::user()->user_type == 'Student'){
            $enroll = PwEnrollment::where('project_work_id', $pw_single_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
        }
        return view($this->theme.'.project_work.pw_course_detail',compact('pw_single_course','enroll'));
    }

    public function my_projectwork()
    {
        $enrolls = PwEnrollment::with('enrollCourse')->where(['user_id'=>Auth::id()])->orderBy('id','desc')->paginate(6);
        return view($this->theme.'.project_work.my_projectwork', compact('enrolls'));
    }

    public function project_work_lesson_details(Request $request)
    {
        $pw_single_course = PwCourse::with('mentor')->Published()->where('slug', $request->slug)->with('classes')->first();
        $enroll = PwEnrollment::where('project_work_id', $pw_single_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
        
        if ($enroll->count() == 0) {
            return back();
        }
        Session::put('location_path', $request->slug);
        $totalAttend = MockTestEnrollment::where(['test_type' => 'subject','test_status' => 'finish','user_id' => Auth::id() ,'package_id' => $pw_single_course->id])->count();
        $mockTests = MockTestMaster::with('mockTestSection')->where(['pw_course_id' => $pw_single_course->id])->where('status', 1)->get();
        //echo "<pre>";print_r($mockTests);exit;
        return view($this->theme.'.project_work.lesson.project_lesson_details', compact('enroll','pw_single_course','mockTests','totalAttend'));
    }

    /*single content*/
    public function singleContent($id)
    {
        $content = PwClassContent::find($id);
        //return response()->json($content);
        $demo = new Demo();
        if($content->content_type == 'Video'){
            $demo->provider = $content->provider;
            $demo->description = $content->description;
            if ($content->provider == "Youtube") {
                $demo->url = Str::after($content->video_url, 'https://youtu.be/');
            } elseif ($content->provider == "Vimeo") {
                $demo->url = Str::after($content->video_url, 'https://vimeo.com/');
            } elseif ($content->provider == "File") {
                $demo->url = asset($content->video_url);
            } elseif ($content->provider == "Live") {
                $demo->url = $content->video_url;
            } else{
                $demo->provider = "HTML5";
                $demo->url = $content->video_url;
            }
        }elseif ($content->content_type == 'Quiz'){
            /*if quiz is done then show the score*/
            $scores = QuizScore::where('quiz_id',$content->quiz_id)
                ->where('content_id',$content->id)
                ->where('user_id',Auth::id())->first();

            if ($scores != null){
                $demo->provider = $content->content_type;
                $demo->url = route('quiz.score.show',$scores->id);
            }else{
                $demo->provider = $content->content_type;
                $demo->url = route('start',[$content->quiz_id,$content->id]);
            }
        }
        else{
            if($content->file!='' || $content->video_url){
                $demo->provider = $content->content_type;
                $demo->description = $content->description;
                $demo->item1 = translate('Content document');
                $demo->item2 = translate('Download');
                $demo->url = filePath($content->file);
            }else{
                $demo->provider = '';
                $demo->description = '';
                $demo->item1 = translate('Content document');
                $demo->item2 = '';
                $demo->url = '';
            }
            
        }

        
        $course_id = PwClasses::where('id', $content->class_id)->first()->course_id;


        

        $isEnroll = PwEnrollment::where('project_work_id', $course_id)->where('user_id', Auth::id())->first();
        $enroll_id = $isEnroll->id;

        $seens = PwSeenContent::where('class_id', $content->class_id)
            ->where('content_id', $content->id)
            ->where('course_id', $course_id)->where('enroll_id', $enroll_id)->where('user_id', Auth::id())->get();
        if ($seens->count() == 0) {
            $seen = new PwSeenContent();
            $seen->class_id = $content->class_id;
            $seen->content_id = $content->id;
            $seen->course_id = $course_id;
            $seen->enroll_id = $enroll_id;
            $seen->user_id = Auth::id();
            $seen->saveOrFail();
        }
        
        return response()->json($demo);
        
    }

    /*Calculate the seen course percentage enroll course*/
    public static function seenCourse($id, $course_id)
    {
        $seen_content = PwSeenContent::where('user_id', Auth::id())->where('enroll_id', $id)->get()->count();
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


    public function fileStoreProjectWork(Request $request)
    {
        $request->validate([
            'file_name' => 'required|file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:204800',
        ]);
       
       

        $fileName = time().'.'.$request->file_name->getClientOriginalExtension();  

        
        $request->file_name->move(public_path('project_work'), $fileName);

        $pwEnroll = PwEnrollment::where(['project_work_id'=>$request->projectWorkId,'user_id'=>Auth::user()->id])->update(['submitted_report_file'=>$fileName,'submitted_on_date'=>date("Y-m-d H:i:s"),"status"=>1]);
        return back()
            ->with('message','You have successfully uploaded project report.')
            ->with('file',$fileName);

    }

}
