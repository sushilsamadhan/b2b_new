<?php

namespace App\Http\Controllers;

use App\CurrentAffair;
use App\Model\Course;
use Illuminate\Http\Request;

class CurrentAffairController extends Controller
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
        if(!\App\Category_permission::select('category_id')->where('school_id', \Session::get('school_id'))->where('type', 'content')->where('category_id', 'current-affairs')->exists()){
            return redirect('/')->with('msgpermisiondenie', 'The Message');
        }
        //
        // $courses = Course::where('content_type','current_affairs')->latest()->paginate(60)->withQueryString();
        $courses = Course::groupBy('course_date')->where('content_type','current_affairs')->whereNull('deleted_at')->select('course_date','title','slug')->orderBy('course_date','desc')->paginate(60)->withQueryString();
        return view($this->theme.'.currentaffair.index',compact('courses'));
    }

    public function detail(Request $request)
    {
        if(!\App\Category_permission::select('category_id')->where('school_id', \Session::get('school_id'))->where('type', 'content')->where('category_id', 'current-affairs')->exists()){
            return redirect('/')->with('msgpermisiondenie', 'The Message');
        }
        $course = Course::where(['content_type'=>'current_affairs','slug'=>$request->slug])->first();

        $pageMeta =[];  
        $setValues= '';           
        if($course->meta_title) {

           $getCodes = json_decode($course->meta_title);
           $setValues = implode(', ', $getCodes); 
        } 
        $setTags ='';
        if($course->tag)  {
            $getTag = json_decode($course->tag);
            $setTags = implode(', ', $getTag); 
        }                       
        $pageMeta['meta_title'] = $setValues;
        $pageMeta['meta_description'] = $course->meta_description;
        $pageMeta['tag'] = $setTags;
        return view($this->theme.'.currentaffair.detail',compact('course','pageMeta'));
    }
}
