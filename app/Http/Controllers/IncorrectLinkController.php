<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use Illuminate\Support\Facades\DB;
use App\Model\Course;
use App\Model\Classes;
use App\Model\Category;
use App\Model\ClassContent;
use App\Question;
use App\QuestionCategorie;
use App\StudentTestQuestion;
use App\Option;

class IncorrectLinkController extends Controller
{
    public function incorrectVideoLink(Request $request)
    {
        $queCat = QuestionCategorie::where('category_type', '!=', 'Competitive')->get();
        if (isset($request)) {
            $board_name = $request->sel_board_name;
            $class_name = $request->sel_class_name;
            if ($request->item_id!='') {

                    // $courses = Course::select('id','title')->whereIn('id', $request->item_id)
                // ->latest()->paginate(50)->withQueryString();

                $videoUrl = DB::table('class_contents')
                        ->select('class_contents.id', 'class_contents.title as content_title', 'class_contents.video_url', 'courses.title as course_title', 'courses.is_demo', 'courses.id as coursesid')
                        ->join('classes', 'class_contents.class_id', '=', 'classes.id')
                        ->join('courses', 'classes.course_id', '=', 'courses.id')
                        ->whereNull('classes.deleted_at')
                        ->whereNull('class_contents.deleted_at')
                        ->where('class_contents.content_type', '=', 'video')
                        ->whereIn('courses.id', $request->item_id)   // Change
                        ->get();
                        
                $pattern = '#(.*?)(embed)(.*?)#';
                
                $courses = array();
                foreach ($videoUrl as $item) {
                    if (!preg_match($pattern, $item->video_url) || ($item->video_url=='')) {
                        array_push($courses, $item);
                    }
                }
            } else {
                $courses = array();
            }
            return view('incorrect_report.incorrectvideo', compact('queCat', 'courses', 'board_name', 'class_name'));
        } else {
            return view('incorrect_report.incorrectvideo', compact('queCat'));
        }
    }

    public function incorrectPdfLink(Request $request)
    {
        $queCat = QuestionCategorie::where('category_type', '!=', 'Competitive')->get();
        if (isset($request)) {
            $board_name = $request->sel_board_name;
            $class_name = $request->sel_class_name;
            if ($request->item_id!='') {
                //  $courses = Course::select('id', 'title')->whereIn('id', $request->item_id)
                //      ->latest()->paginate(50)->withQueryString();

                $courses =   DB::table('class_contents')
                        ->select('class_contents.id', 'class_contents.title as content_title', 'class_contents.file', 'courses.title', 'courses.is_demo', 'categories.name as cat_name')
                        ->join('classes', 'class_contents.class_id', '=', 'classes.id')
                        ->join('courses', 'classes.course_id', '=', 'courses.id')
                        ->join('categories', 'courses.category_id', '=', 'categories.id')
                        
                        ->whereNull('classes.deleted_at')
                        ->whereNull('class_contents.deleted_at')
                        ->where('class_contents.content_type', '=', 'Document')
                        ->whereIn('courses.id', $request->item_id)   // Change
                        ->get();
            } else {
                $courses = array();
            }
             
            return view('incorrect_report.incorrectpdf', compact('queCat', 'courses', 'board_name', 'class_name'));
        } else {
            return view('incorrect_report.incorrectpdf', compact('queCat'));
        }
    }
      
    public function updateVideoLink(Request $request)
    {
        $id = $request->input('id');
        // print_r($request->all()); exit;
        $data['video_url'] = $request->input('linkId');
        $pattern = "/embed/i";
        if (preg_match($pattern, $request->input('linkId'))) {
            $result = DB::table('class_contents')
            ->where('id', $id)
            ->update($data);
            if ($result) {
                // return redirect()->back()->with('success', 'Video Link Updated Successfully!');

                echo "<script>";
                echo "javascript:window.history.back();";
                echo "</script>";
            } else {
                return redirect()->back();
            }
        } else {
            // return redirect()->back()->with('error', 'Please Update YouTube Embedded URL Only!');
        
            echo "<script>";
            echo "javascript:window.history.back();";
            echo "</script>";
        }
    }

    public function updatePdfLink(Request $request)
    {
        $id = $request->input('id');

        $request->validate([
                'pdf'=>'required|mimes:pdf',
            ]);

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf') ;
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/class_contents/' ;
            $file->move($destinationPath, $fileName);
            $data['file'] = '/uploads/class_contents/'.$fileName;
        }

        $result = DB::table('class_contents')->where('id', $id)->update($data);
        if ($result) {
            echo "<script>";
            echo "javascript:window.history.back();";
            echo "</script>";
        } else {
            return redirect()->back();
        }
    }

    public function questionValidation(Request $request)
    {
        if (isset($request)) {

         if ($request->ques_cat_id && $request->q_cat_id && $request->sub_cat_id && $request->course_id) {

            $ques_cat_id = $request->ques_cat_id; echo "<br>"; // Course Type 
            $q_cat_id = $request->q_cat_id; echo "<br>";       // Board/Exam 
            $sub_cat_id = $request->sub_cat_id; echo "<br>";  // Class 
            $course_id = $request->course_id;               // Subject 
            $board = Category::select('name')->where('id', '=', $q_cat_id)->first(); 
            $class = Category::select('name')->where('id', '=', $sub_cat_id)->first();
            $course = Course::select('title')->where('id', '=', $course_id)->first();
            $slash = '/';
            $queCat = QuestionCategorie::where('id', '2')->get();   
             $testquestions = StudentTestQuestion::leftjoin('question_categories', 'question_categories.id', '=', 'student_test_questions.question_categorie_id')
                    ->leftjoin('question_tags', 'question_tags.id', '=', 'student_test_questions.question_tag_id')
                    ->leftjoin('courses', 'courses.id', '=', 'student_test_questions.course_id')

                    ->select('courses.title as coursesTitle', 'question_categories.category_type', 'question_tags.tag_name', 'student_test_questions.q_tag', 'student_test_questions.body', 'student_test_questions.id', 'student_test_questions.updated_at')
                    ->where('question_categories.id', '=', $ques_cat_id)  //add
                    ->where('student_test_questions.q_cat_id', '=',  $q_cat_id)   //add
                    ->where('student_test_questions.sub_cat_id', $sub_cat_id)   //add
                    ->where('student_test_questions.course_id', '=',  $course_id);   //add

             $testquestions =  $testquestions->where('student_test_questions.parent_id', 0)->orderBy('student_test_questions.id', 'DESC')->get();//->paginate(200)->withQueryString();
             return view('incorrect_report.questionvalidation', compact('testquestions', 'queCat', 'board', 'class', 'course', 'slash'));
         }
          
            $courses_detail = DB::table('categories as t1')
                    ->select('t2.*')
                    ->join('categories as t2','t2.parent_category_id', '=', 't1.id')
                    ->where('t1.parent_category_id','=', 0)
                    ->where('t1.is_item','=','0')
                    ->where('t1.is_compitative','=','1')
                    ->get();
            $testquestions = array();
            $courses = $courses_detail;
            $queCat = QuestionCategorie::where('id', '2')->get();  
         return view('incorrect_report.questionvalidation', compact('courses','queCat', 'testquestions'));
        } 
    }

    public static function getInvalidData($question_id)
    {
        $count_data = Option::select('flag_correct')->where('question_id', $question_id)->where('flag_correct', '1')->count();
        return $count_data;
    }

    public function categoriesByCourseData(Request $request)
    {
        $courses = array();
        switch ($request->course_type) {
            case 'board':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item', '0')->with('child')->where('is_compitative', '0')->where('is_free_study', '0')->where('is_current_affairs', '0')->where('is_project_works', '0')->Published()->get();
                $courses = $courses_detail;
                break;
            case 'competitive-courses':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item', '0')->with('child')->where('is_compitative', '1')->Published()->get();
                $courses = $courses_detail;
                break;
            case 'free-study-material':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item', '0')->with('child')->where('is_free_study', '1')->Published()->get();
                $courses = $courses_detail;
                break;
            case 'current-affairs':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item', '0')->with('child')->where('is_current_affairs', '1')->Published()->get();
                $courses = $courses_detail;
                break;
            case 'project-works':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item', '0')->with('child')->where('is_project_works', '1')->Published()->get();
                $courses = $courses_detail;
                break;
            default:
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item', '0')->with('child')->where('is_compitative', '0')->where('is_free_study', '0')->Published()->get();
                $courses = $courses_detail;
                break;
        }
         
        return response(['message' => 'success','data' => $courses], 200);
    }

    public function board(Request $request)
    {
        $queCat = QuestionCategorie::where('category_type', '!=', 'Competitive')->get();
        // $queCat = QuestionCategorie::get(); // Wthout Competitive
        if (isset($request)) {
            $board_name = $request->sel_board_name;
            $class_name = $request->sel_class_name;
            if ($request->item_id!='') {
                $courses = Course::select('id', 'title')->whereIn('id', $request->item_id)
                    ->latest()->paginate(50)->withQueryString();
            } else {
                $courses = array();
            }
            return view('incorrect_report.contentsummary', compact('queCat', 'courses', 'board_name', 'class_name'));
        } else {
            return view('incorrect_report.contentsummary', compact('queCat'));
        }
    }


    public function categoriesById($id)
    {
        $courses_detail = Category::where("parent_category_id", $id)
                                    ->where('is_published', '1')
                                    ->pluck('name', 'id');
        return response()->json($courses_detail);
    }


    /**
         * Get the specified resource from storage.
         *
         * @param  \App\categoriesByCourseId  $id
         * @return \Illuminate\Http\Response
         */

    public function categoriesByQuestionCourseId($id)
    {
        $courses_detail = Course::where("category_id", $id)
                    ->where('is_demo', '=', '0')
                    ->pluck('title', 'id');
        return response()->json($courses_detail);
    }
}
