<?php

namespace App\Http\Controllers;

use App\MockTestSectionQuestion;
use App\MockTestSection;
use App\MockTestMaster;
use App\QuestionTag;
use App\Model\Category;
use App\Model\Course;
use App\StudentTestQuestion;
use App\ComprehensionQuestion;
use Illuminate\Http\Request;
use DB;

class MockTestSectionQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('mtestquestions.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,MockTestSectionQuestion $mockTestSectionQuestion,$id)
    {
       // return $request->all();
       $subCatdetail       = [];
       $courses_detail     = [];
       $chapter_detail     = [];
       $categories         = [];
       $questionTag        = '';
       $questionTagType    = '';
       $catId              = '';
       $q_tag_type_id      = '';
       $quesCat_id         = '';
       $q_cat_id           = '';
       $sub_cat_id         = '';
       $course_id          = '';
       if(isset($request) && !empty($request->ques_cat_id) || !empty($request->tag_id))
       {
           if($request->ques_cat_id=='1')
           {
                $questionTag    = QuestionTag::where('ques_cat_id','=',$request->ques_cat_id)->get();
                $questionTagType= QuestionTag::where('parent_tag_id','=',$request->ques_cat_id)->get();
                $catId          = $request->tag_id;
                $quesCat_id     = $request->ques_cat_id;
                $q_tag_type_id  = $request->q_tag_type_id;
                $studentestquestions = StudentTestQuestion::leftjoin('question_categories','question_categories.id','=','student_test_questions.question_categorie_id')
                            ->leftjoin('question_tags','question_tags.id','=','student_test_questions.question_tag_id')
                            ->leftjoin('question_tags as tagType','tagType.id','=','student_test_questions.q_tag_type_id')
                            ->select('question_categories.category_type','question_tags.tag_name','student_test_questions.*')
                            ->orderBy('id', 'DESC');

                if(!empty($request->ques_cat_id))
                {
                    $studentestquestions =$studentestquestions->where('student_test_questions.question_categorie_id','=',$request->ques_cat_id);
                }
                if(!empty($request->tag_id))
                {
                         $studentestquestions = $studentestquestions->where('student_test_questions.question_tag_id','=',$request->tag_id);
                }
                if(!empty($request->q_tag_type_id))
                {
                    $studentestquestions = $studentestquestions->where('student_test_questions.q_tag_type_id','=',$request->q_tag_type_id);
                }
                $studentestquestions = $studentestquestions->where('student_test_questions.q_tag','!=','null');
                $studentestquestions = $studentestquestions->paginate(50)->withQueryString();

            }else{

                $questionTag    = '';
                $questionTagType = '';
                $catId          = '';
                $q_tag_type_id = '';
                $quesCat_id     = $request->ques_cat_id;
                $q_cat_id = $request->q_cat_id;
                $sub_cat_id = $request->sub_cat_id;
                $course_id =  $request->course_id;
                $categories = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->where('is_current_affairs','0')->where('is_project_works','0')->Published()->get();
               // $categories = $categories_detail;
                $subCatdetail = Category::where("parent_category_id","=",$request->q_cat_id)
                                        ->select('name','id')
                                        ->get();

                $courses_detail = Course::where("category_id",'=',$request->sub_cat_id)
                                        ->select('title','id')
                                        ->get();                
                $studentestquestions = StudentTestQuestion::orderBy('id', 'DESC');
                if(!empty($request->ques_cat_id))
                {
                    $studentestquestions = $studentestquestions->where('student_test_questions.question_categorie_id','=',$request->ques_cat_id);
                   
                    
                }
                if(!empty($request->q_cat_id))
                {    
                    $studentestquestions = $studentestquestions->where('student_test_questions.q_cat_id','=',$request->q_cat_id);
                    
                }
                if(!empty($request->sub_cat_id))
                {
                    $studentestquestions = $studentestquestions->where('student_test_questions.sub_cat_id','=',$request->sub_cat_id);
                }
                if(!empty($request->course_id))
                {
                    $studentestquestions = $studentestquestions->where('student_test_questions.course_id','=',$request->course_id);
                   // echo "<pre>";print_r($studentestquestions->get());exit;
                }
                $studentestquestions = $studentestquestions->paginate(50)->withQueryString();

            }      
      
        }
       else
       {
        $studentestquestions = StudentTestQuestion::leftjoin('question_categories','question_categories.id','=','student_test_questions.question_categorie_id')
                                                            ->leftjoin('question_tags','question_tags.id','=','student_test_questions.question_tag_id')
                                                            ->select('question_categories.category_type','question_tags.tag_name','student_test_questions.*')
                                                            ->orderBy('id', 'DESC')
                                                            ->where('student_test_questions.q_tag','!=','null')
                                                            ->paginate(50)->withQueryString();
       }
        $mocktestsection = MockTestSection::join('mock_test_masters','mock_test_masters.id','=','mock_test_sections.mock_test_master_id')
                                                        ->where('mock_test_sections.id','=',$id)
                                                        ->select('mock_test_masters.name','mock_test_sections.*')
                                                        ->first();

        $mtQuestionData = MockTestSectionQuestion::with(['comprehensionq'])->where('mock_test_section_id','=',$id)->get(); 
        $mtQuestionInArrayData = MockTestSectionQuestion::select(DB::raw('group_concat(student_test_question_id) as student_test_question_id'))
       ->where('mock_test_section_id', $id)
       ->get();
       
       
       $mtQuestionInArrayData = explode(',',$mtQuestionInArrayData[0]->student_test_question_id);
       
        
         $mtQuestion     = $mtQuestionData->count();

         $totalPassageCount = 0;
         if($mtQuestion>0){

         foreach($mtQuestionData as $val){
             $totalPassageCount +=$val->comprehensionq->count();
         }
     }

        $mtQuestion     = $mtQuestion + $totalPassageCount; 
        
        
      //  return $studentestquestions;


        return view('mtestquestions.create',compact('mtQuestionInArrayData','course_id','q_cat_id','sub_cat_id','categories','subCatdetail','courses_detail','q_tag_type_id','questionTagType','studentestquestions','mocktestsection','mtQuestion','questionTag','catId','quesCat_id'))
                        ->with('i',(request()->input('page', 1) - 1) * 50);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if(isset($request->student_test_question_id))
        {
            $i=0;
            foreach($request->student_test_question_id as $val)
            {    
                $chkValidate = MockTestSectionQuestion::where('mock_test_master_id','=',$request->mock_test_master_id)
                                                        ->where('mock_test_section_id','=',$request->mock_test_section_id)
                                                        ->where('student_test_question_id','=',$val)->count();       
                
               // echo $chkValidate;die;
                if($chkValidate==0 || $chkValidate=='')
                {
                    $getQuestionInfo = StudentTestQuestion::where('id' , $val)->first();
                   
                    if($getQuestionInfo->parent_id == 0 && $getQuestionInfo->question_type == 3 ){
                        $getQuestions = StudentTestQuestion::where(['parent_id' => $getQuestionInfo->id ,'status' => '1'])->get();
                        foreach($getQuestions as $getQuestion){

                            MockTestSectionQuestion::create([
                                'mock_test_master_id'=>$request->mock_test_master_id,
                                'mock_test_section_id'=>$request->mock_test_section_id,
                                'student_test_question_id'=>$getQuestion->id,
                                'question_type'=>3,
                                'status'=>1,  
                                ]);
                        }
                        
                    } else {
                        MockTestSectionQuestion::create([
                            'mock_test_master_id'=>$request->mock_test_master_id,
                            'mock_test_section_id'=>$request->mock_test_section_id,
                            'student_test_question_id'=>$val,
                            'question_type'=>$request->question_type[$i],
                            'status'=>$request->status[$i],  
                            ]);

                    }
                   
                                                    $i++;                                   
                }                                
                                    
            }
        }
                        return redirect(route('mtestmasters.edit',$request->mock_test_master_id))
                        ->with('success', 'Mock test question created successfully');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MockTestSectionQuestion  $mockTestSectionQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(MockTestSectionQuestion $mockTestSectionQuestion)
    {
        //
        $mtestquestion = MockTestSectionQuestion::find($id);
        return view('mtestquestions.edit', compact('mtestquestion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MockTestSectionQuestion  $mockTestSectionQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(MockTestSectionQuestion $mockTestSectionQuestion)
    {
        //
        $mtestquestion   = MockTestSectionQuestion::where('id','=',$id)->first();                                    
        $mocktestmaster = MockTestMaster::get();
        return view('mtestquestions.edit',compact('mocktestmaster','mtestquestion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MockTestSectionQuestion  $mockTestSectionQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MockTestSectionQuestion $mockTestSectionQuestion)
    {
        //


        $rules = [
                    'mock_test_master_id'=>'required',
                    'mock_test_section_id'=>'required',
                    'student_test_question_id' =>'required',
                    'status'=>'required',
                ];

        $customMessages = [
                            'required' => 'The :attribute field is required.'
                        ];

        $this->validate($request, $rules, $customMessages);

        MockTestSection::where('id', $request->id)->update([
                                                    'mock_test_master_id'=>$request->mock_test_master_id,
                                                    'mock_test_section_id'=>$request->mock_test_section_id,
                                                    'student_test_question_id'=>$request->student_test_question_id,
                                                    'status'=>$request->status,  
                                                ]);

        return redirect()->route('mtestquestions.index')
        ->with('success', 'Mock test question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MockTestSectionQuestion  $mockTestSectionQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(MockTestSectionQuestion $mockTestSectionQuestion,$id)
    {
        //

        $MockTestSectionQuestion = MockTestSectionQuestion::where('id', $id)->first();
        $MockTestSectionQuestion->delete();
        
        return redirect()->route('mtestquestions.index')
                         ->with('success', 'Mock Test Question deleted successfully!');
    }
}
