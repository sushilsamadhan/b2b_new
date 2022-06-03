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
use App\Model\Language;
use App\Model\Enrollment;
use Carbon\Carbon;
use App\NotificationUser;
use DB;
use App\StudentTestQuestion;
use App\QuestionCategorie;
use App\QuestionTag;
use App\Option;
use App\ComprehensionQuestion;

class StudentTestQuestionController extends Controller
{
    /**
     * Display a listing of the resource. question_tags
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
           $testquestions = StudentTestQuestion::leftjoin('question_categories','question_categories.id','=','student_test_questions.question_categorie_id')
                    ->leftjoin('question_tags','question_tags.id','=','student_test_questions.question_tag_id')
                    ->leftjoin('courses','courses.id','=','student_test_questions.course_id')
                    ->select('courses.title as coursesTitle','question_categories.category_type','question_tags.tag_name','student_test_questions.*');

            if(isset($request->q_tag) && $request->q_tag!='') 
            {          
                $q_tag = $request->q_tag;                                     
                $testquestions = $testquestions->where('courses.title', 'LIKE', '%' . $q_tag . '%')->orwhere('student_test_questions.q_tag', 'LIKE', '%' . $q_tag . '%');              
            } 
            $testquestions =    $testquestions->where('parent_id', 0)->orderBy('id', 'DESC')->paginate(100)->withQueryString();                                    

            return view('testquestions.index', compact('testquestions'))
            ->with('i',(request()->input('page', 1) - 1) * 100);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
      
        $courses_detail = DB::table('categories as t1')
        ->select('t2.*')
        ->join('categories as t2','t2.parent_category_id', '=', 't1.id')
        ->where('t1.parent_category_id','=', 0)
        ->where('t1.is_item','=','0')
        ->where('t1.is_compitative','=','1')
        ->get();
        $courses = $courses_detail;
        $queCat = QuestionCategorie::get();  

        return view('testquestions.create',compact('courses'),compact('queCat'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	//echo "<pre>";print_r($request->all());exit;
    // return $request->all();  
    if($request->ques_cat_id=='1' && $request->ques_cat_id!='null')
    {
            $request->validate([
            // 'content_type'=>'required',
                'question_type'=>'int|nullable',
                'level_id'=>'required',
                'ques_cat_id'=>'required',
                'tag_id'=>'required',
                'q_tag' =>'required',
            ]);
    }else if($request->ques_cat_id=='2' && $request->ques_cat_id!='null')
    {
         $request->validate([
            // 'content_type'=>'required',
                'question_type'=>'required',
                'level_id'=>'required',
                'ques_cat_id'=>'required',
                'q_cat_id'=>'required',
                'q_tag' =>'required',
                'sub_cat_id'=>'required',
                'course_id'=>'required',
                'unit_id'=>'required',
            ]);
    }else{
        $request->validate([
           
                'ques_cat_id'=>'required',
                
            ]);

    }

        $q_tag  = explode(',',$request->q_tag);
        $reqC   = array();
        foreach ($q_tag as $item)
        {
            array_push($reqC,$item);
        }

        $q_tagData = json_encode($reqC);
        $unit = '';
        $chapter = '';
        if(!empty($request->unit_id)){

            $splitData = explode('-',$request->unit_id);

            $unit = $splitData[1];
            $chapter = $splitData[0];

        }
       //return  $request->ques_cat_id;
       if($request->ques_cat_id=='2'){
        $lastInsertId   = StudentTestQuestion::create([
                                                            'question_type'         =>  $request->question_type,
                                                            'level_id'              =>  $request->level_id,
                                                            'question_categorie_id' =>  $request->ques_cat_id ?$request->ques_cat_id :0,
                                                            'question_tag_id'       =>  intval($request->tag_id)??null,
                                                            'q_tag_type_id'         =>  intval($request->q_tag_type_id)??null,
                                                            'q_cat_id'              =>  $request->q_cat_id,
                                                            'sub_cat_id'            =>  $request->sub_cat_id,
                                                            'course_id'             =>  $request->course_id,
                                                            'unit_id'               =>  $unit,
                                                            'chapter_id'            =>  $chapter,
                                                            'q_tag'                 =>  $q_tagData, 
                                                            'body'                  =>  $request->title,  
                                                            'solution'              =>  $request->solution,
                                                            'user_id' => Auth::id(),
                                                    ]);
        } else {
            
//PRINT_R($request->all()); DIE;
            $lastInsertId   = StudentTestQuestion::create([
                'question_type'         =>  $request->question_type,
                'level_id'              =>  $request->level_id,
                'question_categorie_id' =>  $request->ques_cat_id ?  $request->ques_cat_id :0 ,
                'question_tag_id'       =>  intval($request->tag_id)??null,
                'q_tag_type_id'         =>  intval($request->q_tag_type_id)??null,
                'q_cat_id'              =>  $request->q_cat_id,
                'sub_cat_id'            =>  $request->sub_cat_id,
                'course_id'             =>  $request->course_id,
                'q_tag'                 =>  $q_tagData, 
                'body'                  =>  $request->title,  
                'solution'              =>  $request->solution, 
                'user_id' => Auth::id(),
        ]);

        }

   //   return $lastInsertId->id;                                                
      if(!empty($lastInsertId->id))
       {
          
            $i=0;
            foreach($request->option as $opt)
            {

                if($opt!=NULL && $opt!=null && $opt!='null')
                {
                   
                    $data=array('question_id'=>$lastInsertId->id,'option_title'=>$opt,
                                'flag_correct'=>$request->optionstatus[$i]);
                        Option::insert($data);
                }
                $i++;
            }
        }

     
        return redirect()->route('testquestions.index')
        ->with('success', 'Question created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentTestQuestion  $studentTestQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(StudentTestQuestion $studentTestQuestion,$id)
    {
        //

        $testquestion = StudentTestQuestion::find($id);

        return view('testquestions.edit', compact('testquestion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentTestQuestion  $studentTestQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentTestQuestion $studentTestQuestion,$id)
    {


        $option = DB::table('options as op')
                            ->join('student_test_questions as stq','op.question_id','=','stq.id')
                            ->where('op.question_id','=',$id)
                            ->select('op.id as opId','op.question_id','op.option_title','op.flag_correct')
                            ->get();
                                           // return $option;
        $testquestion = StudentTestQuestion::where('id','=',$id)->first();                                    
        
        if($testquestion->question_categorie_id=='2')
        {
            $testquestionCategorie_id = 'board';
       
            $categories = array();
            switch ($testquestionCategorie_id)
            {
                case $testquestionCategorie_id:
                    $categories_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->where('is_current_affairs','0')->where('is_project_works','0')->Published()->get();
                    $categories = $categories_detail;
                    break;
                default:
                    $categories_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->Published()->get();
                    $categories = $categories_detail;
                    break;       
            }
            
            $subCatdetail = Category::where("parent_category_id","=",$testquestion->q_cat_id)
                                            ->select('name','id')
                                            ->get();

            $courses_detail = Course::where("category_id",'=',$testquestion->sub_cat_id)
                                            ->select('title','id')
                                            ->get();

            $chapter_detail = Classes::with(['contents'])->where("course_id",'=',$testquestion->course_id)
                                            ->get();
            
        }else{
            $subCatdetail = array();
            $courses_detail = array();
            $chapter_detail = array();
            $categories = array();

        }



        $queCat       = QuestionCategorie::get();
       
        if($testquestion->question_categorie_id!='')
        {
            $queCatTag      = QuestionTag::where('ques_cat_id','=',$testquestion->question_categorie_id)->where('parent_tag_id','0')->get();

        }
        else
        {
            $queCatTag      = QuestionTag::where('parent_tag_id','0')->get();
        }
        if($testquestion->question_tag_id)
        {
             $queTypeTag   = QuestionTag::where('parent_tag_id','=',$testquestion->question_tag_id)->get();
        }else{

            $queTypeTag = array();
        }


        return view('testquestions.edit',compact('queTypeTag','option','queCatTag','queCat','testquestion','categories','subCatdetail','courses_detail','chapter_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentTestQuestion  $studentTestQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentTestQuestion $studentTestQuestion)
    {
       

           //return $request->all();  
    if($request->ques_cat_id=='1' && $request->ques_cat_id!='null')
    {
            $request->validate([
            // 'content_type'=>'required',
                'question_type'=>'int|nullable',
                'level_id'=>'required',
                'ques_cat_id'=>'required',
                'tag_id'=>'required',
                'q_tag' =>'required',
            ]);
    }else if($request->ques_cat_id=='2' && $request->ques_cat_id!='null')
    {
         $request->validate([
            // 'content_type'=>'required',
                'question_type'=>'required',
                'level_id'=>'required',
                'ques_cat_id'=>'required',
                'q_cat_id'=>'required',
                'q_tag' =>'required',
                'sub_cat_id'=>'required',
                'course_id'=>'required',
                'unit_id'=>'required',
            ]);
    }else{
        $request->validate([
           
                'ques_cat_id'=>'required',
                
            ]);

    }

        $q_tag  = explode(',',$request->q_tag);
        $reqC   = array();
        foreach ($q_tag as $item)
        {
            array_push($reqC,$item);
        }

        $q_tagData     = json_encode($reqC);
        $unit = '';
        $chapter = '';
        if(!empty($request->unit_id)){

            $splitData = explode('-',$request->unit_id);

            $unit = $splitData[1];
            $chapter = $splitData[0];

        }

        if($request->ques_cat_id=='2'){
                StudentTestQuestion::where('id', $request->id)->update([
                                            'question_type'            =>  $request->question_type,
                                            'question_categorie_id'    =>  $request->ques_cat_id ? $request->ques_cat_id:0,
                                            'question_tag_id'          =>  $request->tag_id,
                                            'q_tag_type_id'            =>  $request->q_tag_type_id,
                                            'q_cat_id'                 =>  $request->q_cat_id,
                                            'sub_cat_id'               =>  $request->sub_cat_id,
                                            'course_id'                =>  $request->course_id,
                                            'unit_id'                  =>  $unit,
                                            'chapter_id'               =>  $chapter,
                                            'q_tag'                    =>  $q_tagData,
                                            'level_id'                 =>  $request->level_id,
                                            'body'                     =>  $request->title,  
                                            'solution'                 =>  $request->solution,
                                            'user_id' => Auth::id(), 
                                        ]);

                }else{

                    StudentTestQuestion::where('id', $request->id)->update([
                        'question_type'            =>  $request->question_type,
                        'question_categorie_id'    =>  $request->ques_cat_id ?$request->ques_cat_id :0,
                        'question_tag_id'          =>  $request->tag_id,
                        'q_tag_type_id'         =>  $request->q_tag_type_id,
                        'q_cat_id'                 =>  $request->q_cat_id,
                        'sub_cat_id'               =>  $request->sub_cat_id,
                        'course_id'                =>  $request->course_id,
                        'q_tag'                    =>  $q_tagData,
                        'level_id'                 =>  $request->level_id,
                        'body'                     =>  $request->title,  
                        'solution'                 =>  $request->solution, 
                        'user_id' => Auth::id(),
                ]);


                }

       if(isset($request->id))
       {
           Option::where('question_id','=',$request->id)->delete();
            $i=0;
            foreach($request->option as $opt)
            {
                 //echo $opt[$i];
                 if($opt!=NULL && $opt!=null && $opt!='null'){
                        $data=array('question_id'=>$request->id,'option_title'=>$opt,'flag_correct'=>$request->optionstatus[$i]);
                        Option::insert($data);
                 }
                 $i++;
            }
     }

     
        return redirect()->route('testquestions.index')
        ->with('success', 'Question updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentTestQuestion  $studentTestQuestion
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //         
         
         DB::table('options')->where('question_id','=',$request->id)->delete();
         $StudentTestQuestion = StudentTestQuestion::where('id', $request->id)->first();
         $StudentTestQuestion->delete();
         return redirect()->route('testquestions.index')
                        ->with('success', 'Question Test deleted successfully !');

    }


    function viewParaQuestion($id)
    {
            $testSplit = explode('_',$id);
            $stdGetData = StudentTestQuestion::where('id','=',$testSplit[0])->first();
            $compQData = ComprehensionQuestion::where('student_test_question_id','=',$testSplit[0])->get();
            $str  = '';
            $str .= '<div class="container">';
            $strQ = ''; 
            $k = 1;           
            $str .='<div class="question pt-2" style="height:600px;overflow-y: scroll;">';     
                foreach($compQData as $val){  
                    $optionTest = DB::table('options as op')
                                        ->join('comprehension_questions as cq','op.passage_question_id','=','cq.id')
                                        ->where('op.passage_question_id','=',$val->id)
                                        ->select('op.id as opId','op.question_id','op.option_title','op.flag_correct','cq.question_title','cq.question_solution','cq.id')
                                        ->get(); 
                                $strQ .= '<div class="question pt-2 ">
                                                <div class="py-2 h5"><div class="question-part">
                                                    <b class="d-inline text-danger">Question
                                                    '.$k.'- 
                                                    </b>
                                                    '.html_entity_decode($val->question_title).'
                                                </div>
                                            </div>';   
                            
                                $strQ .='<div class="pt-sm-0 pt-3" id="options">';    
                                        $strOpt = ''; 
                                        $i = 65;  
                                        foreach($optionTest as $testVal)
                                        {  
                                            if($testVal->option_title!=null)
                                            {
                                                if($testVal->flag_correct!=0){
                                                    $strOpt .= '<label class="options alert-success border p-2 d-flex align-items-center text-dark"><strong>('.lcfirst(chr($i)).') </strong>'.$testVal->option_title.' </label>';
                                                } else {
                                                    $strOpt .= '<label class="options border p-2 d-flex align-items-center text-dark"><strong>('.lcfirst(chr($i)).') </strong>'.$testVal->option_title.' </label>'; 
                                                }
                                                $i++;
                                            }
                                        } 
                                        
                                        $strQ .=$strOpt;


                                $strQ .= '</div>
                                <div class="question pt-2  alert alert-success">
                                    <div class="py-2 h5 text-center">
                                        <b>Answer</b>
                                    </div>
                                    <div class="pt-sm-0 pt-3"> 
                                        <label class="">'.$val->question_solution.'</label> 
                                    </div> 
                                </div>'; 
                    $k++;                   
                    }
                
            $str .=  $strQ;
            $str .= '</div>'; 
            
            
            $str .='<div class="question pt-2 alert alert-success">
                        <div class="py-2 h5 text-center">
                            <b>Passages-'.$testSplit[1].'</b>
                        </div>
                        <div class="pt-sm-0 pt-3"> 
                            <label class="">'.$stdGetData->body.'</label> 
                        </div>
                    </div>'; 
            $str .='</div>';
           
            return $str;
        }

    function viewQuestion($id)
    {
         
        $testSplit = explode('_',$id);
        $optionTest = DB::table('options as op')
                        ->join('student_test_questions as stq','op.question_id','=','stq.id')
                        ->where('op.question_id','=',$testSplit[0])
                        ->select('op.id as opId','op.question_id','op.option_title','op.flag_correct','stq.*')
                        ->get();
                        //$testSplit[1] = $testSplit[1]+1;
            $str  = '';
            $str .= ' <div class="container">';
            $str .= ' <div class="question pt-2">
                <div class="py-2 h5"><div class="question-part"><b class="d-inline text-danger">Question '.$testSplit[1].'- </b> '.html_entity_decode($optionTest[0]->body).'</div></div>
                <div class="pt-sm-0 pt-3" id="options">'; 
                $strOpt = ''; 
                $i = 65;  
              foreach($optionTest as $testVal){  
                    if($testVal->option_title!=null)
                    {
                        if($testVal->flag_correct!=0){
                            $strOpt .= '<label class="options alert-success border p-2 d-flex align-items-center text-dark"><strong>('.lcfirst(chr($i)).') </strong>'.$testVal->option_title.' </label>'; 
                        } else {
                            $strOpt .= '<label class="options border p-2 d-flex align-items-center text-dark"><strong>('.lcfirst(chr($i)).') </strong>'.$testVal->option_title.' </label>';
                        }
                        $i++;
                    }
              } 
              
              $str .=$strOpt;
            $str .= '</div>
            </div>
            <div class="question pt-2 alert alert-success">
                <div class="py-2 h5 text-center"><b>Answer</b></div>
                <div class="pt-sm-0 pt-3"> 
                    <label class="">'.$optionTest[0]->solution.'</label> 
                </div>
            </div>';

       return $str; 
    }



public function catesByCourseType(Request $request,$slug)
    {
       
        $courses = array();
        switch ($slug) {
            case 'board':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->where('is_current_affairs','0')->where('is_project_works','0')->Published()->get();
                $courses = $courses_detail;
                break;
            case 'competitive-courses':
                $courses_detail = Category::where('parent_category_id1', 0)->where('is_item','0')->with('child')->where('is_compitative','1')->Published()->get();
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



    public function getTagData($id)
    {
      $getTagDatas = QuestionTag::where("ques_cat_id",$id)->where('parent_tag_id','=','0')
                  ->pluck('tag_name','id');
      return response()->json($getTagDatas); 
    }

    public function getQuestionTag($id)
    {
      $getTagDatas = QuestionTag::where("parent_tag_id",$id)
                  ->pluck('tag_name','id');
      return response()->json($getTagDatas); 
    }

//------------------------------------------------------Passages------------------------------

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createpassage()
    {
        //
        
        $queCat = QuestionCategorie::get();  

        return view('testpassages.create',compact('queCat'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storepassage(Request $request)
    {
     
    if($request->ques_cat_id=='1' && $request->ques_cat_id!='null')
    {
            $request->validate([
            // 'content_type'=>'required',
                'question_type'=>'int|nullable',
                'level_id'=>'required',
                'ques_cat_id'=>'required',
                'tag_id'=>'required',
                'q_tag' =>'required',
            ]);
    }else if($request->ques_cat_id=='2' && $request->ques_cat_id!='null')
    {
        // echo '<pre>';print_r($request->all())
        // ; die;
         $request->validate([
            // 'content_type'=>'required',
                'question_type'=>'required',
                'level_id'=>'required',
                'ques_cat_id'=>'required',
                'q_cat_id'=>'required',
                'q_tag' =>'required',
                'sub_cat_id'=>'required',
                'course_id'=>'required',
               // 'unit_id'=>'required',
            ]);
    }else{
        $request->validate([
           
                'ques_cat_id'=>'required',
                
            ]);

    }
        $q_tag  = explode(',',$request->q_tag);
        $reqC   = array();
        foreach ($q_tag as $item)
        {
            array_push($reqC,$item);
        }

        $q_tagData     = json_encode($reqC);

      

      $unit = '';
      $chapter = '';
      if(!empty($request->unit_id)){

          $splitData = explode('-',$request->unit_id);

          $unit = $splitData[1];
          $chapter = $splitData[0];

      }else{
        $unit =  $request->unit_id;
        $chapter = $request->unit_id;
      }


       StudentTestQuestion::insert([
                                                            'question_categorie_id' => $request->ques_cat_id,
                                                            'question_tag_id'       => $request->tag_id ? $request->tag_id : 0,
                                                            'level_id'              => $request->level_id,
                                                            'question_type'         => $request->question_type,
                                                            'q_tag_type_id'         =>  $request->q_tag_type_id ? $request->tag_id: 0,
                                                            'q_cat_id'              =>  $request->q_cat_id,
                                                            'sub_cat_id'            =>  $request->sub_cat_id,
                                                            'course_id'             =>  $request->course_id,
                                                            'unit_id'               =>  $unit,
                                                            'chapter_id'            =>  $chapter,
                                                            'q_tag'                 => $q_tagData, 
                                                            'body'                  => $request->title,  
                                                            'user_id' => Auth::id(),
                                                           ]);

       
     
        return redirect()->route('testquestions.index')
        ->with('success', 'Passage created successfully');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentTestQuestion  $studentTestQuestion
     * @return \Illuminate\Http\Response
     */
    public function editpassage(StudentTestQuestion $studentTestQuestion,$id)
    {
        //return $studentTestQuestion;

        // $getData = DB::table('comprehension_questions as cq')
        //                 ->join('student_test_questions as stq','cq.student_test_question_id','=','stq.id')
        //                 ->where('cq.student_test_question_id','=',$id)
        //                 ->select('cq.id as cqId','cq.question_title','cq.question_solution','cq.status')
        //                 ->get();
        $getData = StudentTestQuestion::where('id' ,'=',$id)->Orwhere('parent_id','=', $id)->get();
            //print_r($getData); die;          
        $testquestion = StudentTestQuestion::where('id','=',$id)->first(); 
        
        
        if($testquestion->question_categorie_id=='2')
        {
            $testquestionCategorie_id = 'board';
       
            $categories = array();
            switch ($testquestionCategorie_id)
            {
                case $testquestionCategorie_id:
                    $categories_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->where('is_current_affairs','0')->where('is_project_works','0')->Published()->get();
                    $categories = $categories_detail;
                    break;
                default:
                    $categories_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->Published()->get();
                    $categories = $categories_detail;
                    break;       
            }
            
            $subCatdetail = Category::where("parent_category_id","=",$testquestion->q_cat_id)
                                            ->select('name','id')
                                            ->get();

            $courses_detail = Course::where("category_id",'=',$testquestion->sub_cat_id)
                                            ->select('title','id')
                                            ->get();

            $chapter_detail = Classes::with(['contents'])->where("course_id",'=',$testquestion->course_id)
                                            ->select('title','id')
                                            ->get();

        }else{
            $subCatdetail = array();
            $courses_detail = array();
            $chapter_detail = array();
            $categories = array();

        }



        $queCat       = QuestionCategorie::get();
        if($testquestion->question_categorie_id!='')
        {
            $queCatTag      = QuestionTag::where('ques_cat_id','=',$testquestion->question_categorie_id)->where('parent_tag_id','=','0')->get();
        }
        else
        {
            $queCatTag      = QuestionTag::where('parent_tag_id','=','0')->get();
        }
        $queTypeTag =[];
        if(isset($testquestion->question_tag_id))
        {
             $queTypeTag   = QuestionTag::where('parent_tag_id','=',$testquestion->question_tag_id)->get();
        }


        return view('testpassages.edit',compact('queTypeTag','queCatTag','queCat','testquestion','getData','categories','subCatdetail','courses_detail','chapter_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentTestQuestion  $studentTestQuestion
     * @return \Illuminate\Http\Response
     */

    public function updatepassage(Request $request, StudentTestQuestion $studentTestQuestion)
    {
       
     /*   $request->validate([
                            'question_type' => 'required',
                            'level_id'      => 'required',
                            'ques_cat_id'   => 'required',
                            'tag_id'        => 'required',
                            'q_tag'         => 'required',
                            ]);
*/


if($request->ques_cat_id=='1' && $request->ques_cat_id!='null')
    {
            $request->validate([
            // 'content_type'=>'required',
                'question_type'=>'int|nullable',
                'level_id'=>'required',
                'ques_cat_id'=>'required',
                'tag_id'=>'required',
                'q_tag' =>'required',
            ]);
    }else if($request->ques_cat_id=='2' && $request->ques_cat_id!='null')
    {
         $request->validate([
            // 'content_type'=>'required',
                'question_type'=>'required',
                'level_id'=>'required',
                'ques_cat_id'=>'required',
                'q_cat_id'=>'required',
                'q_tag' =>'required',
                'sub_cat_id'=>'required',
                'course_id'=>'required',
                'unit_id'=>'required',
            ]);
    }else{
        $request->validate([
           
                'ques_cat_id'=>'required',
                
            ]);

    }
        $q_tag              = explode(',',$request->q_tag);
        $reqC               = array();

        foreach ($q_tag as $item)
        {
            array_push($reqC,$item);
        }

        $q_tagData = json_encode($reqC);
        

        $unit = '';
        $chapter = '';
        if(!empty($request->unit_id)){
  
            $splitData = explode('-',$request->unit_id);
  
            $unit = $splitData[1];
            $chapter = $splitData[0];
  
        }else{
            $unit =  $request->unit_id;
            $chapter = $request->unit_id;
          }
    

        StudentTestQuestion::where('id', $request->id)->update([
                                                                'question_type'         => $request->question_type,
                                                                'question_categorie_id' => $request->ques_cat_id ?  $request->ques_cat_id : 0,
                                                                'question_tag_id'       => $request->tag_id,
                                                                'q_tag_type_id'         =>  $request->q_tag_type_id,
                                                                'q_cat_id'              =>  $request->q_cat_id,
                                                                'sub_cat_id'            =>  $request->sub_cat_id,
                                                                'course_id'             =>  $request->course_id,
                                                                'unit_id'               =>  $unit,
                                                                'chapter_id'            =>  $chapter,
                                                                'q_tag'                 => $q_tagData,
                                                                'level_id'              => $request->level_id,
                                                                'body'                  => $request->title,  
                                                                'user_id' => Auth::id(),
                                                                ]);
                                                                
        if(!empty($request->id))
        {
            //$studentLastUpdate = StudentTestQuestion::find($request->id);
            //$parent_id = $studentLastUpdate->id;
           // StudentTestQuestion::create();


            $lastInsertId   = StudentTestQuestion::create([
                'question_type'         =>  $request->question_type,
                'level_id'              =>  $request->level_id,
                'question_categorie_id' =>  $request->ques_cat_id ? $request->ques_cat_id : 0,
                'question_tag_id'       =>  intval($request->tag_id)??null,
                'q_tag_type_id'         =>  intval($request->q_tag_type_id)??null,
                'q_cat_id'              =>  $request->q_cat_id,
                'sub_cat_id'            =>  $request->sub_cat_id,
                'course_id'             =>  $request->course_id,
                'q_tag'                 =>  $q_tagData, 
                'body'                  =>  $request->question_title,  
                'solution'              =>  $request->question_solution, 
                'parent_id' => $request->id,
                'user_id' =>Auth::id(),
        ]);
        $i = 0;
        foreach($request->option as $opt)
        {
            $data = array('question_id'=>$request->id,'passage_question_id'=>$lastInsertId->id,'option_title'=>$opt,'flag_correct'=>$request->optionstatus[$i]);
            Option::insert($data);
            $i++;
        }


            //$dataSolution               = array('student_test_question_id'=>$request->id,'question_title'=>$request->question_title,'question_solution'=>$request->question_solution,'status'=>$request->status);
          //  $ComprehensionQuestionId    = ComprehensionQuestion::insertGetId($dataSolution);

           // return $ComprehensionQuestionId;
           // if($ComprehensionQuestionId!='')
            //{
              //  $i = 0;
               // foreach($request->option as $opt)
                // {
                //     $data = array('question_id'=>$request->id,'passage_question_id'=>$ComprehensionQuestionId,'option_title'=>$opt,'flag_correct'=>$request->optionstatus[$i]);
                //     Option::insert($data);
                //     $i++;
                // }
          //  }
        }  
        //carrier counsing 
        //cariculam promo
        return redirect()->back();
       // ->with('success', 'Passage updated successfully');

    }


    public function editquestion($id)
    {

      //  $ComprehensionQuestionId = ComprehensionQuestion::where('id','=',$id)->first();  
        $ComprehensionQuestionId = StudentTestQuestion::where('id','=',$id)->first();

        // $option = DB::table('options as op')
        //                 ->join('comprehension_questions as cq','op.passage_question_id','=','cq.id')
        //                 ->where('op.passage_question_id','=',$id)
        //                 ->select('op.id as opId','op.passage_question_id','op.option_title','op.flag_correct')
        //                 ->get();
        $option = DB::table('options as op')
            ->join('student_test_questions as stq','op.question_id','=','stq.id')
            ->where('op.question_id','=',$ComprehensionQuestionId->parent_id)->where('passage_question_id' , '=' , $ComprehensionQuestionId->id)
            ->select('op.id as opId','op.question_id','op.option_title','op.flag_correct')
            ->get();
       // print_r($option); die;
        // $getData = DB::table('comprehension_questions as cq')
        //                     ->join('student_test_questions as stq','cq.student_test_question_id','=','stq.id')
        //                     ->where('cq.student_test_question_id','=',$ComprehensionQuestionId->id)
        //                     ->select('cq.id as cqId','cq.question_title','cq.question_solution')
        //                     ->get();
        $getData = StudentTestQuestion::where('id' ,'=',$ComprehensionQuestionId->id)->get();
           
        $testquestion = StudentTestQuestion::where('id','=',$id)->first();   

        $queCat       = QuestionCategorie::get();
        if($testquestion->question_categorie_id!='')
        {
            $queCatTag      = QuestionTag::where('ques_cat_id','=',$testquestion->question_categorie_id)->where('parent_tag_id','=','0')->get();
        }
        else
        {
            $queCatTag      = QuestionTag::where('parent_tag_id','=','0')->get();
        }

        return view('testpassages.editquestion',compact('queCatTag','queCat','testquestion','getData','ComprehensionQuestionId','option'));

    }


/*quiz update*/
public function updatequestion(Request $request)
{
    
    //return $request->all();                               
    if(!empty($request->qid))
    {
        $studentTestQuestion =  StudentTestQuestion::where('id' ,$request->id)->first();
        // ComprehensionQuestion::where('id', $request->qid)->update([
        //                                                     'student_test_question_id'=>$request->id,
        //                                                     'question_title'=>$request->question_title,
        //                                                     'question_solution'=>$request->question_solution,
        //                                                     'status'=>$request->status
        //                                                     ]);
        StudentTestQuestion::where('id', $request->qid)->update([
                                                                'id'=>$request->id,
                                                                'body'=>$request->question_title,
                                                                'solution'=>$request->question_solution,
                                                                'status'=>$request->status,
                                                                'user_id' => Auth::id(),
                                                                ]);

        Option::where('passage_question_id','=',$request->qid)->delete();

        $i = 0;
        foreach($request->option as $opt)
        {
            $data = array('question_id'=>$studentTestQuestion->parent_id,'passage_question_id'=>$request->qid,'option_title'=>$opt,'flag_correct'=>$request->optionstatus[$i]);
            Option::insert($data);
            $i++;
        }
    }
    return redirect(route('testpassages.editpassage',$studentTestQuestion->parent_id));
}

    public function passagedelete(Request $request)
    {

        Option::where('passage_question_id','=',$request->id)->delete();
        $StudentTestQuestion = StudentTestQuestion::where('id', $request->id)->first();
        $StudentTestQuestion->delete();
        return redirect(route('testpassages.editpassage',$StudentTestQuestion->parent_id));
        
    }




    /**
     * Get the specified resource from storage.
     *
     * @param  \App\courseById  $id
     * @return \Illuminate\Http\Response
     */

    public function courseById($id)
    {
        $chapter_detail = Classes::with(['contents'])->where("course_id",$id)
                ->get();
        return response()->json($chapter_detail); 

    }

    /**
     * Get the specified resource from storage.
     *getQuestionTag
     * @param  \App\courseById  $id
     * @return \Illuminate\Http\Response
     */

    public function chapterId($id)
    {
        //unitChapter
        $c_detail = ClassContent::where("class_id",$id)
                ->pluck('title','id');
        return response()->json($c_detail); 

    }



    public function imageUpload(Request $request){
        $fileName = $request->file('file')->getClientOriginalName();
        //$uniquesavename = time().uniqid(rand());
       // $fileName = $uniquesavename . '.jpg';
        $path = $request->file('file')->storeAs('uploads/editor_img', $fileName, 'public');
       
      
       
        return response()->json(['location' => "https://olexpert.org.in/storage/app/public/$path"]); 
       
       /*
        //return response()->json(['location' => "http://localhost/ole_old/storage/app/public/$path"]); 
    
        //$path = $request->file('file')->storeAs('uploads/editor_img', $fileName, 'public');
       
       $imgpath = request()->file('file')->store('uploads', 'public'); 
       return response()->json(['location' => "/storage/$imgpath"]);*/

   }

   public function createTag()
    {       
        $categories = QuestionCategorie::all()->where('status',1);
        $quescat = QuestionTag::where('parent_tag_id', 0)->where('status',1)->get();       
        return view('testquestions.createTag',compact('categories','quescat'));
    }

    public function forGetsubjectcate()
    {
        $quescat = QuestionTag::where('ques_cat_id', $_GET['id'])->where('parent_tag_id', 0)->where('status', 1)->get(); 
        echo '<option value="">Select Subject Category</option>';
        foreach($quescat as $ques) {
            echo '<option value="'.$ques->id.'">'.$ques->tag_name.'</option> ';
        }
    }
    
    public function storeTag(Request $request)
    {        
        $request->validate([
            'ques_cat_id' => 'required',
            'tag_name' => 'required'            
        ], [
            'ques_cat_id.required' => translate('Question Category is required'),
            'tag_name.required' => translate('Question Subject is required')
        ]);       
        $quescat = new QuestionTag();
        $quescat->ques_cat_id = $request->ques_cat_id;
        $quescat->tag_name = $request->tag_name;
        $quescat->parent_tag_id = $request->parent_tag_id?? 0;   
        $quescat->save();
        notify()->success(translate('Question Subject created successfully'));
        return back();
    }


}
