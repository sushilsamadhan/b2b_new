<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\CurrentAffair;
use App\Model\Course;
use Illuminate\Http\Request;

class EliteController extends Controller
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
    public function index(Request $request)
    {
        $cat = Category::where('slug', $request->slug)->first();
        $boardClasses = Category::where('parent_category_id', $cat->id)->get();
        $catId = array();
        $catId = array_merge($catId, [$cat->id]);
        if ($cat->parent_category_id == 0) {
            //this is parent category
            $categories = Category::where('parent_category_id', $cat->id)->Published()->get();
            //all child category id
            foreach ($categories as $item) {
                $catId = array_merge($catId, [$item->id]);
            }

        } else {
            //this is child category
            $categories = Category::where('parent_category_id', $cat->parent_category_id)->Published()->get();
            $catId = array_merge($catId, [$cat->id]);
        }
        $courses = Course::Published()->whereIn('category_id',$catId)->latest()->paginate(60)->withQueryString();
     
        $catnew= Category::where('parent_category_id', $cat->id)->get();
        $catIdArr = array();
        foreach($catnew as $value){
            array_push($catIdArr,$value['id']);
        }
        $coursesdata = Course::with('classes')->Published()->whereIn('category_id',$catIdArr)->get();    
        $data = array();        
        foreach($coursesdata as $course)
        {
            if(isset($course->classes) && !empty($course->classes))
            {                
                foreach($course->classes as $item)
                {
                    if(!empty($item->contents))
                    {
                        foreach($item->contents as $item_content)
                        {
                            if(!empty($item_content->video_url))
                            {
                                $data[$course->category->name][] = array('category_id'=>$course->category->id,'category_name'=>$course->category->name,'demo_url'=>$item_content->video_url,'demo_type'=>$item_content->demo_type,'chapter_name'=>$item_content->title,'subject_name'=>$course->title,'course_image'=>$course->image);
                            }
                        }
                    }                    
                }
            }                           
        } 
        
        $pageMeta['meta_title'] = $cat->meta_title;
        $pageMeta['meta_description'] = $cat->meta_description;
        $pageMeta['tag'] = $cat->tag;      
         return view($this->theme.'.course.freecourse.course_grid',compact('catnew','data','courses', 'cat','boardClasses','pageMeta'));
    }

    public function detail(Request $request)
    {
        $course = Course::where(['content_type'=>'current_affairs','slug'=>$request->slug])->first();
        return view($this->theme.'.currentaffair.detail',compact('course'));
    }
}
