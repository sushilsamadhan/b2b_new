<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use App\Model\Course;
use Auth;
use Alert;
use App\Model\Category;
use App\Model\PwCategory;
use App\Model\Classes;
use App\Model\ClassContent;
use App\Model\Language;
use App\Model\Enrollment;
use App\Model\CourseComment;
use App\Quiz;
use Carbon\Carbon;
use App\NotificationUser;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
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
            if (Auth::user()->user_type == "Admin" || Auth::user()->id == '1300') {
                // $courses = Course::where('title', 'like', '%' . $request->search . '%')
                // ->orWhere('tag', 'like', '%' . $request->search . '%')->where('content_type' ,'!=' , 'current_affairs')                    
                // ->where('is_demo','=', '0')->latest()->paginate(10)->withQueryString();
                $courses = Course::where([
                        [DB::raw('lower(title)'), 'like', '%' . strtolower($request->search) . '%'],
                        [DB::raw('lower(tag)'), 'like', '%' . strtolower($request->search) . '%'],
                    	])->orWhere('slug', 'like', '%' . $request->search . '%')
			->where('content_type' ,'!=' , 'current_affairs')
                    ->where('is_demo' ,'=' , '0')->latest()->paginate(10)->withQueryString();
            } else {
                // $courses = Course::where("user_id", Auth::id())
                // ->where('title', 'like', '%' . $request->search . '%')
                // ->orWhere('tag', 'like', '%' . $request->search . '%')->where('content_type' ,'!=' , 'current_affairs')
                // ->where('is_demo','=', '0')->latest()->paginate(10)->withQueryString();

                $courses = Course::where([
                        [DB::raw('lower(title)'), 'like', '%' . strtolower($request->search) . '%'],
                        [DB::raw('lower(tag)'), 'like', '%' . strtolower($request->search) . '%'],
			[DB::raw('lower(slug)'), 'like', '%' . strtolower($request->search) . '%']
                    ])->orWhere('slug', 'like', '%' . $request->search . '%')
			->where('content_type' ,'!=' , 'current_affairs')->where('user_id', Auth::id())
                    	->where('is_demo' ,'=' , '0')->latest()->paginate(10)->withQueryString();
            }
        } else {
            if (Auth::user()->user_type == "Admin" || Auth::user()->id == '1300') {
                $courses = Course::latest()->where('content_type' ,'!=' , 'current_affairs')
                ->where('is_demo','=', '0')->paginate(10)->withQueryString();
            } else {
                $courses = Course::where("user_id", Auth::id())->where('content_type' ,'!=' , 'current_affairs')
                ->where('is_demo','=', '0')->latest()->paginate(10)->withQueryString();
            }
        }
//echo '<pre>'; print_R($courses); die;
        return view('course.index', compact('courses'));
    }

    // course.create
    public function create()
    {
        //Todo::There have twist only Register instructor can show his/her course
        $categories = Category::all();
        $languages = Language::all();
        return view('course.create', compact('categories', 'languages'));
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
            'slug' => 'required|unique:courses',
            'image' => 'required',
            'overview_url' => 'required',
            'provider' => 'required',
            'requirement' => 'required',
            'outcome' => 'required',
            'tag' => 'required',
            //'language' => 'required',
            'category_id' => 'required',
            //'level' => 'required',
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

        $courses = new Course();
        $courses->title = $request->title;
        $courses->slug = Str::slug($request->slug);
        $courses->short_description = $request->short_description;
        $courses->big_description = $request->big_description;
        $courses->content_type = $request->content_type??$request->content_type;
        if ($request->has('image')) {
            $courses->image = $request->image;
        }
        $courses->overview_url = $request->overview_url;
        $courses->provider = $request->provider;
        //$courses->level = $request->level;

        //Demo


//-----

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
        $courses->is_free = $request->is_free == "on" ? true : false;
        if($request->content_type == 'free-study-material'){
            $courses->is_free = true; 
        }
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
        if(isset($request->sub_category_id) && $request->sub_category_id!='0'){
            $courses->category_id = $request->sub_category_id; 
        }else{
            $courses->category_id = $request->category_id;
        }
        
        $courses->is_published = $request->is_published == "on" ? true : false;
        $courses->user_id = Auth::user()->id;
        $courses->save();

        //todo::course create notify
        $details = [
            'body' => translate($request->title . ' new course uploaded by ' . Auth::user()->name),
        ];

        /* sending instructor notification */
        $notify = $this->userNotify(Auth::user()->id,$details);

        notify()->success(translate($request->title . ' created successfully'));
        return redirect()->route('course.show',[$courses->id,$courses->slug]);

    }

    /*Check all slug*/
    public function check(Request $request)
    {
        $slug = $request->slug;
        if ($slug) {
            $data = Course::where('slug', $slug)->count();

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
        $course = Course::with('classesAll')->findOrFail($course_id);
        return view('course.show', compact('course', 'course_id'));
    }

    // course.destroy
    public function destroy($course_id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        Course::findOrFail($course_id)->delete();
        notify()->success(translate('Course deleted successfully'));
        return back();
    }

    // course.edit
    public function edit($course_id)
    {
        $each_course = Course::findOrFail($course_id);
        $categories = Category::all();
        $languages = Language::all();
        return view('course.edit', compact('each_course', 'categories', 'languages'));
    }

    // course.store
    public function update(Request $request)
    {
        //echo "<pre>";print_r($request->all());exit;

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
            //'language' => 'required',
            'category_id' => 'required',
            //'level' => 'required',
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

        ]);


        $courses = Course::where('id', $request->id)->firstOrFail();
        $courses->title = $request->title;
        $courses->slug = Str::slug($request->slug);
        $courses->short_description =$request->short_description;
        $courses->big_description = $request->big_description;
        $courses->content_type = $request->content_type??$request->content_type;
        if ($request->has('image')) {
            $courses->image = $request->image;
        }
        $courses->overview_url = $request->overview_url;
        //$courses->level = $request->level;
        $courses->provider = $request->provider;

        //Demo


//-----
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

        notify()->success(translate('Course Updated'));
        return back();

    }

    //published
    public function published(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $course = Course::where('id', $request->id)->first();
        if ($course->is_published == 1) {
            $course->is_published = 0;
            $course->save();
        } else {
            $course->is_published = 1;
            $course->save();
        }
        return response(['message' => translate('Course Published  Status is Change ')], 200);
    }



    //course rating
    public function rating(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $course = Course::where('id', $request->id)->first();
        $course->rating = $request->rating;
        $course->save();
        return response(['message' => translate('Course Rating is Changed ')], 200);
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
            case 'project_work':
                $courses_detail = PwCategory::with('child')->where('parent_category_id', 0)->get();
                $courses = $courses_detail;
                break;
            default:
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->Published()->get();
                $courses = $courses_detail;
                break;
        }
        return response(['message' => 'success','data' => $courses], 200);
    }

    public function b2bcategoriesByCourseType(Request $request)
    {
        $courses = array();
        switch ($request->course_type) {
            case 'board':
                $courses_detail = Category::where('parent_category_id', '83')->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->where('is_current_affairs','0')->where('is_project_works','0')->Published()->get();
                $courses = $courses_detail;
                // dd($courses);
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
            case 'project_work':
                $courses_detail = PwCategory::with('child')->where('parent_category_id', 0)->get();
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
            $s_course = Course::Published()->where('slug', $slug)->with('classes')->with('meeting')->first(); // single course details
        }else{
            $s_course = Course::Published()->where('slug', $slug)->with('classes')->first(); // single course details
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

    public static function getCourseDemoIsExist($course_id){ 
        $courses = Course::where('demo_for_cid' ,'=' , $course_id)->first();
        if(isset($courses)){
            $demoCorseId = $courses->id;
            $demoCorseSlug = $courses->slug;
        } else {
            $demoCorseId = 0;
            $demoCorseSlug = '';
        }
    return  $demoCorseId.'|'.$demoCorseSlug;      
    }

    // Create Demo Course 
    public function createDemoCourse($course_id){
        $getCourse = Course::latest()->where('id' ,'=' , $course_id)->get();
        if(count($getCourse)>0){
            $courses = new Course();
            foreach($getCourse as $item) {
                $courses->title = $item->title;
                $courses->slug = Str::slug($item->slug).'-demo';
                $courses->level = $item->level;
                $courses->rating = $item->rating;
                $courses->min_course_time = $item->min_course_time;
                $courses->is_certificate_download = $item->is_certificate_download;
                $courses->short_description = $item->short_description;
                $courses->big_description = $item->big_description;
                $courses->image = $item->image;
                $courses->overview_url = $item->overview_url;
                $courses->provider = $item->provider;
                $courses->requirement = $item->requirement;
                $courses->outcome = $item->outcome;
                $courses->tag = $item->tag;
                $courses->is_free = 1;
                $courses->price = NULL;
                $courses->is_discount = 0;
                $courses->discount_price = NULL;
                $courses->language = $item->language?$item->language:'English';
                $courses->meta_title = $item->meta_title;
                $courses->meta_description = $item->meta_description;
                $courses->is_published = $item->is_published;
                $courses->user_id = $item->user_id;
                $courses->category_id = $item->category_id;
                $courses->content_type = $item->content_type;
                $courses->course_date = $item->course_date;
                $courses->file = $item->file;
                $courses->is_demo = true;
                $courses->demo_for_cid = $course_id;
                $courses->save();
            }

            if($courses->id) {
                $getClass = Classes::where('course_id','=',$course_id)
                ->where('deleted_at','=',NULL)
                ->orderBy('priority','ASC')
                ->orderBy('id','ASC')->first();              
                $classes = new Classes;
                $classes->title         = $getClass->title;
                $classes->course_id     = $courses->id; // last inserted course id
                $classes->unit          = $getClass->unit;
                $classes->priority      = 1;
                $classes->is_published  = $getClass->is_published;
                $classes->save();

                $class_id = $getClass->id;  
                if($classes->id) { 
                    $getClassContent = ClassContent::where('class_id','=',$class_id)
                        ->where('deleted_at','=',NULL)
                        ->orderBy('priority','ASC')
                        ->orderBy('id','ASC')->limit(2)->get();
                    $priority = 1;
                    foreach($getClassContent as $content){
                        $classContent = new ClassContent();
                        $classContent->title        = $content->title;
                        $classContent->content_type = $content->content_type;
                        $classContent->provider    = $content->provider;
                        $classContent->video_url    = $content->video_url;
                        $classContent->duration     = $content->duration;
                        $classContent->file         = $content->file;
                        $classContent->description  = $content->description;
                        $classContent->class_id     = $classes->id; // last inserted id of class
                        $classContent->priority     = $priority++;
                        $classContent->is_published = $content->is_published;
                        $classContent->is_preview   = $content->is_preview;
                        $classContent->source_code  = $content->source_code;
                        $classContent->demo_type    = $content->demo_type;
                        $classContent->demo_url     = $content->demo_url;
                        $classContent->demo_duration = $content->demo_duration;
                        $classContent->meeting_id   = $content->meeting_id;
                        $classContent->quiz_id      = $content->quiz_id;
                        $classContent->user_id      = $content->user_id;
                        $classContent->save();
                    }
                }        
            }
            notify()->success(translate('Course has been copied successfully.'));
            return redirect()->route('course.show',[$courses->id,$courses->slug]);
        }
    }
}
