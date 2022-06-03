<?php

namespace App\Http\Controllers;

use App\MockTestMaster;
use App\MockTestSection;
use App\Model\Category;
use App\QuestionTag;
use App\QuestionCategorie;
use App\MockTestSectionQuestion;
use App\StudentTestQuestion;
use DB;
use Illuminate\Http\Request;

class MockTestMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $mtestmasters = MockTestMaster::join('categories as cat','cat.id','=','mock_test_masters.category_id')
                                        ->select('cat.name as catName','mock_test_masters.*')
                                        ->get();  
        return view('mtestmasters.index', compact('mtestmasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $queCat = QuestionCategorie::get();  
        return view('mtestmasters.create',compact('queCat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
        $rules = [
            'test_type'=>'required',
            'test'=>'required',
            'name'=>'required|unique:mock_test_masters',
            'course_type'=>'required',
            'category_id' =>'required',
            'status'=>'required'
                ];
    
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];
    //no_of_mock_test no_of_practice_test no_of_sectional_test
        $this->validate($request, $rules, $customMessages);
        MockTestMaster::insert([
            'test_type'=>$request->test_type,
            'test'=>$request->test,
                                'name'=>$request->name,
                                'course_type'=>$request->course_type,
                                'category_id'=>$request->category_id,
                                'total_no_of_question'=>$request->total_no_of_question,
                                'total_time'=>$request->total_time,
                                'available_on'=>$request->available_on,
                                //'no_of_mock_test'=>$request->no_of_mock_test,
                               // 'no_of_practice_test'=>$request->no_of_practice_test,
                                //'no_of_sectional_test'=>$request->no_of_sectional_test,
                                'status'=>$request->status,  
                            ]);
        return redirect()->route('mtestmasters.index')
                         ->with('success', 'Mock test master created successfully');
    }

    /**
     * Display the specified resource.
     * @param  \App\MockTestMaster  $mockTestMaster
     * @return \Illuminate\Http\Response
     */
    public function show(MockTestMaster $mockTestMaster,$id)
    {
        //
        $mocktestmaster = MockTestMaster::find($id);
        return view('mtestmasters.edit', compact('mocktestmaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MockTestMaster  $mockTestMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(MockTestMaster $mockTestMaster,$id)
    {
        $mtestmaster    = MockTestMaster::where('id','=',$id)->first();  
        $mtestsection   = MockTestSection::where('mock_test_master_id','=',$id)->get();                                    
        $categories     = Category::all();
        return view('mtestmasters.edit',compact('categories','mtestmaster','mtestsection'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MockTestMaster  $mockTestMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MockTestMaster $mockTestMaster)
    {
        //
        $rules = [
            'test_type'=>'required',
            'test'=>'required',
            'name'=>'required',
            'course_type'=>'required',
            'category_id' =>'required',
            'status'=>'required'
                ];

        $customMessages = [
                            'required' => 'The :attribute field is required.'
                         ];
        $this->validate($request, $rules, $customMessages);

        MockTestMaster::where('id', $request->id)->update([
                                                            'test_type'=>$request->test_type,
                                                            'test'=>$request->test,
                                                            'name'=>$request->name,
                                                            'course_type'=>$request->course_type,
                                                            'category_id'=>$request->category_id,
                                                            'total_no_of_question' =>$request->total_no_of_question,
                                                            'total_time'=>$request->total_time,
                                                            'available_on'=>$request->available_on,
                                                            //'no_of_mock_test'=>$request->no_of_mock_test,
                                                            //'no_of_practice_test'=>$request->no_of_practice_test,
                                                            //'no_of_sectional_test'=>$request->no_of_sectional_test,
                                                            'status'=>$request->status,  
                                                        ]);

        if($request->section_name!='') 
        {                                               
            MockTestSection::insert([
                                'mock_test_master_id'=>$request->id,
                                'section_name'=>$request->section_name,
                                'no_of_question'=>$request->no_of_question,
                                'section_time'=>$request->section_time,
                                'question_value'=>$request->question_value,
                                'negative_marking_value'=>$request->negative_marking_value,
                                'status'=>$request->section_status,  
                            ]);   
        }                                                                 
                    
        return redirect(route('mtestmasters.edit',$request->id))
                        ->with('success', 'Mock section added successfully');

    }



    public function viewAddedQuestion($id){

         $mtQuestionInArrayData = MockTestSectionQuestion::select(DB::raw('group_concat(student_test_question_id) as student_test_question_id'))
                                        ->where('mock_test_section_id', $id)
                                        ->get();
        
        
        $mtQuestionInArrayData = explode(',',$mtQuestionInArrayData[0]->student_test_question_id);

         $studentestquestions = StudentTestQuestion::whereIn('id',$mtQuestionInArrayData)->get();
        return view('mtestmasters.viewAddedQuestion',compact('studentestquestions'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MockTestMaster  $mockTestMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(MockTestMaster $mockTestMaster,$id)
    {
       
        //
        $MockTestMaster = MockTestMaster::where('id', $id)->first();
        $MockTestMaster->delete();
        
        return redirect()->route('mtestmasters.index')
                         ->with('success', 'Mock Test deleted successfully !');

    }


    
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



    public function viewMTSection($id)
    {

        $mtmasters = MockTestMaster::join('categories as cat','cat.id','=','mock_test_masters.category_id')
                             ->select('cat.name as catName','mock_test_masters.*')
                             ->where('mock_test_masters.id','=',$id)
                             ->first();


        $mtSection = MockTestSection::where('mock_test_master_id','=',$id)
                             ->get();

        if(isset($mtmasters) && $mtmasters->available_on=='0')
        {
            $mtmasters->available_on = 'Free';
        }
        else if(isset($mtmasters) && $mtmasters->available_on=='1')
        {
            $mtmasters->available_on = 'Paid';
        }
        else{
               
            $mtmasters->available_on = '';

        }


        if(isset($mtmasters) && $mtmasters->status=='0')
        {
            $mtmasters->status = 'Draft';
        }
        else if(isset($mtmasters) && $mtmasters->status=='1')
        {
            $mtmasters->status = 'Publish';
        }
        else if(isset($mtmasters) && $mtmasters->status=='2')
        {
            $mtmasters->status = 'Un-Publish';
        }
        else{

            $mtmasters->status = '';
        }
//0->Draft,1->Publish,2->Un-Publish

                        //$testSplit[1] = $testSplit[1]+1;total_no_of_question
            $str  = '';
            $str .= '<div class="container">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="" for="questitle"> <b>Test Type</b>: &nbsp;'.$mtmasters->test_type.'</label>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="" for="questitle"> <b>Test</b>: &nbsp;'.$mtmasters->test.'</label>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="" for="questitle"> <b>Test Name</b>: &nbsp;'.$mtmasters->name.'</label>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="" for="questitle"> <b>Course Type</b>: &nbsp;'.$mtmasters->course_type.'</label>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="" for="questitle"> <b>Category</b>: &nbsp;'.$mtmasters->catName.'</label>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="" for="questitle"> <b>Total No. Of Question</b>: &nbsp;'.$mtmasters->total_no_of_question.'</label>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="" for="questitle"> <b>Total Time</b>: &nbsp;'.$mtmasters->total_time.'</label>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="" for="questitle"> <b>Available On</b>: &nbsp;'.$mtmasters->available_on.'</label>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="" for="questitle"> <b>Status</b>: &nbsp;'.$mtmasters->status.'</label>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="" for="questitle"> <b>No. Of Section</b>: &nbsp;'.count($mtSection).'</label>
                            </div>
                        </div>

                    </div>
                    
        <div class="card-body">
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SectionName</th>
                        <th>No Of Question</th>
                        <th>Time(H::M::S)</th>
                        <th>Marks Per Question</th>
                        <th>-Ve Marks</th>
                    </tr>
                </thead>
                <tbody>';
                 if(isset($mtSection))
                 {  
                     $i = 1;
                     $strQ = '';
                            foreach ($mtSection as $key => $mtSectionVal)
                            {
                                $strQ .= '<tr>
                                               <td>'.$i.'</td>
                                               <td>'.$mtSectionVal->section_name.'</td>
                                               <td>'.$mtSectionVal->no_of_question.'</td>
                                               <td>'.$mtSectionVal->section_time.'</td>
                                               <td>'.$mtSectionVal->question_value.'</td>
                                               <td>'.$mtSectionVal->negative_marking_value.'</td>
                                            </tr>';
                                 $i++;
                            }
                        }
                       // $strQ .= $strQ;
                       $str .=$strQ;
                       $str .='</tbody></table></div>';
       return $str; 
    }
}
