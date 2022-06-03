<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PackageSetting;
use App\PackageAddonService;
use App\UserAddtocartPackage;
use App\Model\Category;
use App\Model\Course;
use Illuminate\Support\Facades\Auth;
use App\Model\Enrollment;
use DB;

class BoardPackageController extends Controller
{
    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
    }
    //
    public function board()
    {
        //package_settings package_addon_services categories courses

        $getData = PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
                                    ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
                                    ->leftjoin('courses as c','c.ole_refference_id','=','package_settings.course_id')
                                    ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title','c.big_description')
                                    ->where('package_settings.package_type','!=','competitive-courses')
                                    ->orderBy('id', 'DESC')->paginate(21);

        return view($this->theme.'.packages.board_grid',compact('getData'))
                        ->with('i',(request()->input('page', 1) - 1) * 100);

    }


    public function preview_board(Request $request)
    {
        $school_id = \Session::get('school_id');
        // echo $request->id; die('====');
        if(intval($request->id) && $request->id>0){
            $packageDetailFetch = PackageSetting::where('id',$request->id)->first();
        }else{
            $packageDetailFetch = PackageSetting::where('slug',$request->id)->first();
        }
        
        $id = $packageDetailFetch->id;
        $enroll_id= (isset($request->enroll_id))?$request->enroll_id:NULL;
        $getAddToCartData = '';
        //      return $enroll_id;
        $enrollCourses = array();
        if(!empty($enroll_id)){
        
        $idGet = explode('_',$id);
        $cGetId = 'qtr';

        $getAddon   = PackageAddonService::join('services','services.id','=','package_addon_services.addon_service_id')
                                        ->where('package_addon_services.package_id','=',$id)
                                        ->where('package_addon_services.status','=','1')
                                        ->select('package_addon_services.*','services.service_name')
                                        ->get(); 
        
        $getData    = PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
                                    ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
                                    ->leftjoin('courses as c','c.ole_refference_id','=','package_settings.course_id')
                                    ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title','c.big_description','c.short_description','c.meta_title','c.meta_description','c.tag')
                                    ->where('package_settings.id','=',$id)
                                    ->orderBy('id', 'DESC')->first();

        

        $getFreeCourses=array();
        $chapterCount=0;
        $countLecture=0;
        if(isset($getData->free_subject)){

            $free_subject = explode(',',$getData->free_subject);
            $getFreeCourses = Course::Published()
                                        ->whereIn('ole_refference_id', $free_subject)
                                        ->with('classes')
                                        ->orderBy('title', 'ASC')->get();

        
            
                if(isset($getFreeCourses)){
                    foreach($getFreeCourses as $val){
                        $chapterCount+=count($val->classes);
                        foreach($val->classes as $valLect){
                            $countLecture+=$valLect->contents->count();
                        }
                    
                    }
                } 
                $chapterCount = $chapterCount; 
                $countLecture = $countLecture;                   
                                

        }
        $courseId = $getData->course_id;
        if($getData->course_id == 0 && !empty($getData->free_subject))
        {
            $free_subject = explode(',',$getData->free_subject);
            if(!empty($free_subject)){
                $courseId = $free_subject[0];
            }
            
        }
        
        $l_courses      = Course::Published()->latest()->take(3)->get(); // single course details
        $sug_courses    = Course::Published()->take(8)->get()->shuffle(); // suggession courses
        $s_course       = Course::Published()->where('ole_refference_id', $courseId)->with('classes')
                                ->orderBy('title', 'ASC')->first(); // single course details
        $count=0;
        if(isset($s_course)){
            foreach($s_course->classes as $val){
                $count+=$val->contents->count();
            }
        } 
        $count = $count;    
        
        
        // $tt = \Illuminate\Support\Facades\Auth::id();
        $getAddToCartData = UserAddtocartPackage::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                                    ->where('package_id','=',$id)
                                                    ->where('enrollment_id','=',$enroll_id)
                                                    ->where('status','=',1)
                                                    ->first();
        //echo "<pre>";print_r($getAddToCartData);exit;

        }else{
            $idGet = explode('_',$id);
            $cGetId = 'qtr';

            $getAddon   = PackageAddonService::join('services','services.id','=','package_addon_services.addon_service_id')
                                            ->where('package_addon_services.package_id','=',$id)
                                            ->where('package_addon_services.status','=','1')
                                            ->select('package_addon_services.*','services.service_name')
                                            ->get(); 
            
            $getData    = PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
                                        ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
                                        ->leftjoin('courses as c','c.ole_refference_id','=','package_settings.course_id')
                                        ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title','c.big_description','c.short_description','c.meta_title','c.meta_description','c.tag')
                                        ->where('package_settings.id','=',$id)
                                        ->orderBy('id', 'DESC')->first();
                                    // echo '<pre>'; print_r($getData); die;
            //print_r($getData); 
            
            $b2bpricing_mechanisms = DB::table('b2bpricing_mechanisms')->where('school_id', $school_id)->first();

            if($b2bpricing_mechanisms){
                if($b2bpricing_mechanisms->mechanisms_type == "Hike"){
                    $getData->annually_coverage_price = round($getData->annually_coverage_price + ($getData->annually_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                    $getData->halfyrly_coverage_price = round($getData->halfyrly_coverage_price + ($getData->halfyrly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                    $getData->quarterly_coverage_price = round($getData->quarterly_coverage_price + ($getData->quarterly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);              
                }
                if($b2bpricing_mechanisms->mechanisms_type == "Discount"){
                    $getData->annually_coverage_price = round($getData->annually_coverage_price - ($getData->annually_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                    $getData->halfyrly_coverage_price = round($getData->halfyrly_coverage_price - ($getData->halfyrly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);
                    $getData->quarterly_coverage_price = round($getData->quarterly_coverage_price - ($getData->quarterly_coverage_price * ($b2bpricing_mechanisms->value/100)), 0);             
                }
            }else{
                $getData->annually_coverage_price = round($getData->annually_coverage_price, 0);
                $getData->halfyrly_coverage_price = round($getData->halfyrly_coverage_price, 0);
                $getData->quarterly_coverage_price = round($getData->quarterly_coverage_price, 0);
            }
            
            if(Auth::user()){
                if(Auth::user()->user_type == 'Student'){//echo "HERE";exit;
                    $enrollCourses = Enrollment::where(['user_id'=>Auth::user()->id,'type'=>1,'package_id'=>$id])->first();

                    $getAddToCartData = UserAddtocartPackage::where('user_id', \Illuminate\Support\Facades\Auth::id())
                    ->where('package_id','=',$id)
                    ->where('enrollment_id','=',$enrollCourses->id??null)
                    ->where('status','=',1)
                    ->first();
                }
            }
            
            $getFreeCourses=array();
            $chapterCount=0;
            $countLecture=0;
            if(isset($getData->free_subject)){

                $free_subject = explode(',',$getData->free_subject);
                $getFreeCourses = Course::Published()
                                            ->whereIn('ole_refference_id', $free_subject)
                                            ->with('classes')
                                            ->orderBy('title', 'ASC')->get();
                    if(isset($getFreeCourses)){
                        foreach($getFreeCourses as $val){
                            $chapterCount+=count($val->classes);
                            
                            foreach($val->classes as $valLect){
                                $countLecture+=$valLect->contents->count();
                                
                            }
                        
                        }
                    } 
                    $chapterCount = $chapterCount; 
                    $countLecture = $countLecture;                   
            }
            $l_courses      = Course::Published()->latest()->take(3)->get(); // single course details
            $sug_courses    = Course::Published()->take(8)->get()->shuffle(); // suggession courses
            $s_course       = Course::Published()->where('ole_refference_id', $getData->course_id)->with('classes')
                                    ->orderBy('title', 'ASC')->first(); // single course details
            $count=0;
            if(isset($s_course)){
                foreach($s_course->classes as $val){
                    $count+=$val->contents->count();

                }
            } 
            $count = $count;    
        }     
        $pageMeta =[];  
        $setValues= '';           
        if($getData->meta_title) {

           $getCodes = json_decode($getData->meta_title);
           $meta_titles = array();
           if(!empty($getCodes)){
            foreach($getCodes as $code){
                $meta_titles[] = trim($code);
            }
           }
          //print_r(trim($getCodes )) ; die;
           $setValues = implode(', ', $meta_titles); 
        } 
        $setTags ='';
        // echo "<pre>";
        // print_r($getData->tag); die();
        if($getData->tag)  {
            $getTag = json_decode($getData->tag);
            $meta_Tag = array();
            if(!empty($getTag)){
              foreach($getTag as $codegetTag){
                  $meta_Tag[] = trim($codegetTag);
              }
             }
            $setTags = implode(', ', $meta_Tag); 
        }                       
        $pageMeta['meta_title'] = $setValues;
        $pageMeta['meta_description'] = $getData->meta_description;
        $pageMeta['tag'] = $setTags;
        return view($this->theme.'.packages.preview_board',compact('enrollCourses','getAddToCartData','countLecture','chapterCount','getFreeCourses','count','getData','cGetId','getAddon','s_course', 'l_courses', 'sug_courses','pageMeta'));
    }
}
