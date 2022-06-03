<?php

namespace App\Http\Controllers;



use App\Model\Category;
use App\Model\ClassContent;
use App\Model\Classes;
use App\Model\Course;
use App\Model\Language;
use App\Model\Demo;
use App\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;

class FreeStudyController extends Controller
{

    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
    }

    public function listFreestudyCourses(Request $request)
    {

        $breadcrumb = null;
        //check the category in parent for chide
        $cat = Category::where('slug', $request->slug)->first();
if(!\App\Category_permission::select('category_id')->where('school_id', \Session::get('school_id'))->where('type', 'category')->where('category_id', $cat->id)->exists()){
    return redirect('/')->with('msgpermisiondenie', 'The Message');
}

        $school_user_id =  User::select('id')->where('school_id', \Session::get('school_id'))->where('user_type','Instructor')->first();

        if($school_user_id){
            $user_id_school = $school_user_id->id;
        }else{
            $user_id_school = 0;
        }

        $boardClasses = Category::Published()->where('parent_category_id', $cat->id)->get();
        $catId = array();
        $catId = array_merge($catId, [$cat->id]);
        if ($cat->parent_category_id == 0) {
            //this is parent category
            $categories = Category::where('parent_category_id', $cat->id)->Published()->get();
            //all child category id
            foreach ($categories as $item) {
                $catId = array_merge($catId, [$item->id]);
            }
            $courses = Course::Published()->whereIn('category_id', $catId)->whereIn('user_id', ['5', $user_id_school])->orderBy('category_id','desc')->paginate(10);
        }
        if($request->classes!='') {
            $courses = Course::Published()->where('category_id', $request->classes)->whereIn('user_id', ['5', $user_id_school])->orderBy('user_id','desc')->paginate(10);
        }

        //category ways course
        

        $languages = Language::all();

        //rating collect
        $rating = collect();
        for ($i = 1; $i <= 5; $i++) {
            $demo = new Demo();
            $demo->index = $i;
            $demo->total_course = $courses->where('rating', $i)->count();
            $rating->push($demo);
        }

        $insId = array();
        //instructors
        foreach ($courses as $c) {
            $insId = array_merge($insId, [$c->user_id]);
        }
		$catId = $cat->parent_category_id;
        $name =  $cat->name;
        $slug = $request->slug;
        if($cat->is_compitative == 1){
            $type =  'Compitative'; 
        } else if($cat->is_free_study == 1){
            $type =  'Free Study'; 
        } else {
            $type =  'Courses'; 
        }
        $pageMeta['meta_title'] = $cat->meta_title;
        $pageMeta['meta_description'] = $cat->meta_description;
        $pageMeta['tag'] = $cat->tag;
        return view($this->theme.'.course.freecourse.course_grid',
            compact('categories', 'courses', 'languages', 'rating', 'breadcrumb','catId','slug','name','type','cat','boardClasses','pageMeta'));
    }


}
