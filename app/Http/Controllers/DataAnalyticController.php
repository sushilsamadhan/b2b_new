<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use App\Model\Course;
use Auth;
use Alert;
use App\Model\Category;
use App\Model\Classes;
use App\Model\ClassContent;
use App\Model\MindMap;
use App\QuestionCategorie;
use App\Model\Language;
use App\NotificationUser;
use DB;

class DataAnalyticController extends Controller
{
    /**
     * Display a listing of the resource. question_tags
     *
     * @return \Illuminate\Http\Response
     */
    public function board(Request $request)
    {  
        $queCat = QuestionCategorie::where('category_type','!=','Competitive')->get();
        if(isset($request)){ 
            $board_name = $request->sel_board_name;
            $class_name = $request->sel_class_name;
            if($request->item_id!='') {
                $courses = Course::select('id','title')->whereIn('id', $request->item_id)
                ->latest()->paginate(50)->withQueryString();
            }else{
                $courses = array();
            }
            return view('dataanalytic.board',compact('queCat','courses','board_name','class_name'));
        } else{
            
            return view('dataanalytic.board',compact('queCat'));
        }                 
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getAnalyticalCount($course_id)
    {
        if($course_id>0){
            $totmindMaps = MindMap::where('course_id', $course_id)->count();

            $classes = Classes::select('id')->where('course_id', $course_id)
            ->where('is_published', '1')
            ->where('deleted_at', NULL)
            ->get();

            $unitCounts =  $classes->count();

            $classIds = array();
            foreach($classes as $item){
                $classIds = array_merge($classIds,[$item->id]);
            }
            
            $classContents = ClassContent::select(
                "id", 
                DB::raw("SUM(case when content_type = 'Video' then 1 else 0 end) as Video"),
                DB::raw("SUM(case when content_type = 'Document' then 1 else 0 end) as Document")
            )
            ->whereIN('class_id',$classIds)->get();

            foreach($classContents as $data){
                $totalVideo = $data->Video;
                $totalDocuments = $data->Document;
            }
            $totChapters = $totalVideo+$totalDocuments;
        } else {
            $unitCounts = 0;
            $totChapters = 0;
            $totalVideo = 0;
            $totalDocuments =0;
            $totmindMaps = 0;
        }

        return $unitCounts.'|'.$totChapters.'|'.$totalVideo.'|'.$totalDocuments.'|'.$totmindMaps;
    }

    

    public function competitive(Request $request)
    {  
        $courses_detail = DB::table('categories as t1')
        ->select('t2.*')
        ->join('categories as t2','t2.parent_category_id', '=', 't1.id')
        ->where('t1.parent_category_id','=', 0)
        ->where('t1.is_item','=','0')
        ->where('t1.is_compitative','=','1')
        ->get();
        $courses = $courses_detail;
        $queCat = QuestionCategorie::get();  

        return view('dataanalytic.competitive',compact('courses'),compact('queCat'));          
    }

}
