<?php

namespace App\Http\Controllers\PwCourse;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use App\Model\PwCourse;
use Auth;
use Alert;
use App\Model\PwCategory;
use App\Model\PwClasses;
use App\Model\Language;
use App\Model\PwEnrollment;
use App\Model\PwWebinar;
use App\Model\Webinar;
use App\NotificationUser;
use App\MockTestMaster;
use App\Model\Mentor;
class PwCourseController extends Controller
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

    /*only instructor show only his/her course
     Admin can show all Course
    */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            if (Auth::user()->user_type == "Admin") {
                $pwcourses = PwCourse::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('tag', 'like', '%' . $request->search . '%')                   
                ->latest()->paginate(10)->withQueryString();
            } else {
                $pwcourses = PwCourse::where("user_id", Auth::id())
                ->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('tag', 'like', '%' . $request->search . '%')
                ->latest()->paginate(10)->withQueryString();
            }
        } else {
            if (Auth::user()->user_type == "Admin") { 
                $pwcourses = PwCourse::latest()->paginate(10)->withQueryString();
            //    $pwcourses = PwCourse::latest()->where('content_type1' ,'!=' , 'current_affairs')->paginate(10)->withQueryString();
            } else { 
                $pwcourses = PwCourse::where("user_id", Auth::id())->latest()->paginate(10)->withQueryString();
            }
        }
        return view('pwcourse.index', compact('pwcourses'));
    }

    // course.create
    public function create()
    {
        //Todo::There have twist only Register instructor can show his/her course
        $categories = PwCategory::where('parent_category_id','=','0')->get();  
        $languages = Language::all();
        $mentors = Mentor::where('status','=','0')->get();
        return view('pwcourse.create', compact('categories', 'languages','mentors'));
    }

    public function pwcategoriesById(Request $request)
    {
        $subcat_detail = PwCategory::where('parent_category_id', $request->catId)->where('status','=','1')->get();
        return response(['message' => 'success','data' => $subcat_detail], 200);
    }

    // course.store
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:pw_courses',
            'image' => 'required',
            'overview_url' => 'required',
            'provider' => 'required',
            'requirement' => 'required',
            'outcome' => 'required',
            'tag' => 'required',
            'category_id' => 'required',
        ], [
            'title.required' => translate('Title is required'),
            'level.required' => translate('Course Level is required'),
            'slug.unique' => translate('Slug must be unique'),
            'slug.required' => translate('Slug must be Required'),
            'overview_url.required' => translate('Overview Url is required'),
            'provider.required' => translate('Provider is required'),
            'requirement.required' => translate('Requirement is required'),
            'outcome.required' => translate('Outcome is required'),
            'tag.required' => translate('Tag is required'),
            'language.required' => translate('Language is required'),
            'category_id.required' => translate('You must choose a category'),
            'image.required' => translate('Course thumbnail is required'),
        ]);

        $pwcourses = new PwCourse();
        $pwcourses->title = $request->title;
        $pwcourses->slug = Str::slug($request->slug);
        $pwcourses->short_description = $request->short_description;
        $pwcourses->big_description = $request->big_description;
        $pwcourses->content_type = $request->content_type??$request->content_type;
        if ($request->has('image')) {
            $pwcourses->image = $request->image;
        }
        $pwcourses->overview_url = $request->overview_url;
        $pwcourses->provider = $request->provider;

        //Demo
        $req = explode(',',$request->requirement);
        $reqC = array();
        foreach ($req as $item){
            array_push($reqC,$item);
        }
        $pwcourses->requirement = json_encode($reqC);

        $out = explode(',',$request->outcome);
        $outC = array();
        foreach ($out as $itemo){
            array_push($outC,$itemo);
        }
        $pwcourses->outcome = json_encode($outC);

        $tag = explode(',',$request->tag);
        $tagC = array();
        foreach ($tag as $itemt){
            array_push($tagC,$itemt);
        }
        $pwcourses->tag = json_encode($tagC);
        $pwcourses->is_free = $request->is_free == "on" ? true : false;
        if($request->content_type == 'free-study-material'){
            $pwcourses->is_free = true; 
        }
        if (!$pwcourses->is_free) {
            $pwcourses->price = $request->price;
        }

        $pwcourses->is_discount = $request->is_discount == "on" ? true : false;

        if ($pwcourses->is_discount) {
            $pwcourses->discount_price = $request->discount_price;
        }

        $pwcourses->language = $request->language?$request->language:'English';

        $meta = explode(',',$request->meta_title);
        $metaC = array();
        foreach ($meta as $itemm){
            array_push($metaC,$itemm);
        }
        $pwcourses->meta_title = json_encode($metaC);
        $pwcourses->meta_description = $request->meta_description;
        if(isset($request->sub_category_id) && $request->sub_category_id!='0'){
            $pwcourses->category_id = $request->sub_category_id; 
        }else{
            $pwcourses->category_id = $request->category_id;
        }
        
        $pwcourses->is_published = $request->is_published == "on" ? true : false;
        $pwcourses->user_id = Auth::user()->id;
        $pwcourses->save();

        $lastInsertId = $pwcourses->id;
        if($lastInsertId) {
            $classList = array(
                'Recorded Lectures',
                'Study Material',
                'Prototype Sample Report'              
            );

            $sequence = 0;
            for($i=0;$i<count($classList);$i++){
                $sequence++;
                $pwclasses = new PwClasses();
                $pwclasses->course_id = $lastInsertId;
                $pwclasses->is_published = true;
                $pwclasses->title = $classList[$i];
                $pwclasses->priority = $sequence;
                $pwclasses->save();  
            }
        }

        //todo::Project Work course create notify
        $details = [
            'body' => translate($request->title . ' new project work uploaded by ' . Auth::user()->name),
        ];

        /* sending instructor notification */
        $notify = $this->userNotify(Auth::user()->id,$details);

        notify()->success(translate($request->title . ' created successfully'));
        return redirect()->route('pwcourse.show',[$pwcourses->id,$pwcourses->slug]);

    }

    /*Check all slug*/
    public function check(Request $request)
    {
        $slug = $request->slug;
        if ($slug) {
            $data = PwCourse::where('slug', $slug)->count();

            if ($data > 0) {
                return 'not_unique';
            } else {
                return 'unique';
            }
        }
    }

    // course.show
    public function show($course_id)
    { 
        $pwcourse = PwCourse::with('classesAll')->findOrFail($course_id);
        $webinar = Webinar::select('webinars.*')
        ->join('pw_webinars','pw_webinars.webinar_id','=','webinars.id')
        ->where('pw_webinars.project_work_id', '=', $course_id)
        ->where('pw_webinars.deleted_at', '=', NULL)
        ->where('webinars.status', '=', '1')->where('pw_webinars.status', '=', '1')
        ->get();
        return view('pwcourse.show', compact('pwcourse', 'course_id','webinar'));
    }

    // course.destroy
    public function destroy($course_id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        Course::findOrFail($course_id)->delete();
        notify()->success(translate('Project work deleted successfully'));
        return back();
    }

    // course.edit
    public function edit($course_id)
    {
        $each_course = PwCourse::findOrFail($course_id);
        $categories = PwCategory::all();
        $languages = Language::all();
        $mentors = Mentor::where('status','=','0')->get();
        return view('pwcourse.edit', compact('each_course', 'categories', 'languages','mentors'));
    }

    // course.store
    public function update(Request $request)
    {
        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'overview_url' => 'required',
            'provider' => 'required',
            'requirement' => 'required',
            'outcome' => 'required',
            'tag' => 'required',
            'category_id' => 'required',
            'mentor_id' => 'required',
        ], [
            'title.required' => translate('Title is required'),
            'level.required' => translate('Level is required'),
            'slug.required' => translate('Slug is required'),
            'overview_url.required' => translate('Overview Url is required'),
            'provider.required' => translate('Provider is required'),
            'requirement.required' => translate('Requirement is required'),
            'outcome.required' => translate('Outcome is required'),
            'tag.required' => translate('Tag is required'),
            'language.required' => translate('Language is required'),
            'category_id.required' => translate('You must choose a category'),
            'mentor_id.required' => translate('You must choose a mentor')

        ]);


        $courses = PwCourse::where('id', $request->id)->firstOrFail();
        $courses->title = $request->title;
        $courses->slug = Str::slug($request->slug);
        $courses->short_description =$request->short_description;
        $courses->big_description = $request->big_description;
        $courses->content_type = $request->content_type??$request->content_type;
        if ($request->has('image')) {
            $courses->image = $request->image;
        }
        $courses->overview_url = $request->overview_url;
        $courses->provider = $request->provider;
        $courses->mentor_id = $request->mentor_id;
        $req = explode(',',$request->requirement);
        $reqC = array();
        foreach ($req as $item){
            array_push($reqC,$item);
        }
        $courses->requirement = json_encode($reqC);

        $out = explode(',',$request->outcome);
        $outC = array();
        foreach ($out as $itemo){
            array_push($outC,$itemo);
        }
        $courses->outcome = json_encode($outC);

        $tag = explode(',',$request->tag);
        $tagC = array();
        foreach ($tag as $itemt){
            array_push($tagC,$itemt);
        }
        $courses->tag = json_encode($tagC);
        //return $request->tag;
        $courses->is_free = $request->is_free == "on" ? true : false;
        if (!$courses->is_free) {
            $courses->price = $request->price;
        }
        $courses->is_discount = $request->is_discount == "on" ? true : false;

        if ($courses->is_discount) {
            $courses->discount_price = $request->discount_price;
        }

        $courses->language = $request->language?$request->language:'English';

        $meta = explode(',',$request->meta_title);
        $metaC = array();
        foreach ($meta as $itemm){
            array_push($metaC,$itemm);
        }
        $courses->meta_title = json_encode($metaC);
        $courses->meta_description = $request->meta_description;
        if(isset($request->sub_category_id) && $request->sub_category_id!=''){
            $courses->category_id = $request->sub_category_id; 
        }else{
            $courses->category_id = $request->category_id;
        }
        if($courses->is_published){
            $courses->is_published = true;
        }else{
            $courses->is_published = false;
        }
        $courses->user_id = Auth::user()->id;
       // return $courses;
        $courses->save();

        notify()->success(translate('Project Work Updated'));
        return back();

    }

    //published
    public function published(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $course = PwCourse::where('id', $request->id)->first();
        if ($course->is_published == 1) {
            $course->is_published = 0;
            $course->save();
        } else {
            $course->is_published = 1;
            $course->save();
        }
        return response(['message' => translate('Project Work Published  Status is Changed')], 200);
    }



    //course rating
    public function rating(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $course = PwCourse::where('id', $request->id)->first();
        $course->rating = $request->rating;
        $course->save();
        return response(['message' => translate('Project Work Rating is Changed ')], 200);
    }
    //END

    public function categoriesByCourseType(Request $request)
    {
        $courses = array();
        switch ($request->course_type) {
            case 'board':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->where('is_current_affairs','0')->where('is_project_works','0')->Published()->get();
                $courses = $courses_detail;
                break;
            case 'competitive-courses':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','1')->Published()->get();
                $courses = $courses_detail;
                break;
            case 'free-study-material':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_free_study','1')->Published()->get();
                $courses = $courses_detail;
                break;
            case 'current-affairs':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_current_affairs','1')->Published()->get();
                $courses = $courses_detail;
                break;
            case 'project-works':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_project_works','1')->Published()->get();
                $courses = $courses_detail;
                break;
            default:
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->Published()->get();
                $courses = $courses_detail;
                break;
        }
        return response(['message' => 'success','data' => $courses], 200);
    }
    
    public function categoriesById(Request $request)
    {
        $courses_detail = Category::Published()->where('parent_category_id', $request->catId)->get();
        return response(['message' => 'success','data' => $courses_detail], 200);
    }

    public function coursesByCategoryId(Request $request)
    {
        $courses = Course::Published()->where(['category_id'=>$request->catId])->get();
        return response(['message' => 'success','data' => $courses], 200);
    }

    public function lesson_details($slug)
    {
       
        if (zoomActive()){
            $s_course = PwCourse::Published()->where('slug', $slug)->with('classes')->with('meeting')->first(); // single course details
        }else{
            $s_course = PwCourse::Published()->where('slug', $slug)->with('classes')->first(); // single course details
        }
        /*check enroll this course*/
       
        
        $getChapter ='';
        $pkgId = '';

        $comments = CourseComment::latest()->with('user')->get();
        $time_left = 1;
        $seens = 1;
        if(!empty($s_course->min_course_time)){
            $seens = SeenContent::where('course_id', $s_course->id)->count();
            $lesson_track = QuizTracking::where('course_id', $s_course->id)->first();
            if ($lesson_track) {
                $time_left = $lesson_track->time_left;
            } else {
                $time_left = $s_course->min_course_time;
            }
        }
        $quiz = Quiz::where('course_id',$s_course->id)->where('status','1')->first();
        
        if($quiz) {
            $quiz_status = $quiz->status;
        } else {
            $quiz_status = 0;
        }
        $PackageDetail ='';
        $totalAttend = 0;
        $totalUnitAttend = 0;
        $totalChapterAttend = 0;
        $subjectTests =0;
        $mockTests = [];
        
        return view('rumbok.course.lesson.admin_lesson_details', compact('pkgId','getChapter','mockTests','s_course', 'comments', 'seens', 'time_left', 'quiz_status','PackageDetail','totalAttend','totalUnitAttend', 'totalChapterAttend','subjectTests'));
    }

     // webinar association destroy
     public function destroyAssociation($project_work_id)
     { 
         if (env('DEMO') === "YES") {
         Alert::warning('warning', 'This is demo purpose only');
         return back();
       }
 
         PwWebinar::findOrFail($project_work_id)->delete();
         notify()->success(translate('Association of Webinar deleted successfully'));
         return back();
     }
     public function pwCreateAssesment($slug)
    {
        $s_course = PwCourse::where('slug', $slug)->first();
        $moctestDetail    = MockTestMaster::where('pw_course_id','=',$s_course->id)->where('course_type','project_work')->first();
        if(!$moctestDetail){
            $mockTestMasterId = MockTestMaster::insertGetId([
                'pw_course_id'=>$s_course->id,
                'test_type'=>'Mock',
                'test'=>'Full',
                'name'=>$s_course->title,
                'course_type'=>'project_work',
                'category_id'=>$s_course->category_id,
                'total_no_of_question' =>null,
                'total_time'=>null,
                'available_on'=>0,
                'status'=>1,  
            ]);
            $moctestDetail = MockTestMaster::where('id','=',$mockTestMasterId)->first();
        }
        return view('pwcourse.assesment.create',compact('moctestDetail'));
        
    }
     
}
