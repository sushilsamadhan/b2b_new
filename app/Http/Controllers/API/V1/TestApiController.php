<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Model\Category;
use App\MockTestMaster;
use App\MockTestSection;
use App\MockTestEnrollment;
use App\MockTestEnrollmentAnswer;
use App\MockTestSectionQuestion;
use App\PackageSetting;
use App\StudentTestQuestion;
use App\Model\Classes;
use App\Model\ClassContent;
use Auth;

class TestApiController extends Controller
{
    public function subjectTestDetail($id,$course_id=null)
    {

        $packageDetail = PackageSetting::with('subjectName')->where('id', $id)->first();
        if ($packageDetail && $packageDetail->package_type == 'board') {

            $totalSubjectTests = StudentTestQuestion::where(['q_cat_id' => $packageDetail->category_id, 'sub_cat_id' => $packageDetail->sub_category_id, 'course_id' => $packageDetail->course_id])->count();
            $totalQuestion = getCountQuestion($totalSubjectTests, $packageDetail->no_of_test_questions);
            if($packageDetail->course_id==$course_id){
                $subjectTests = StudentTestQuestion::where(['q_cat_id' => $packageDetail->category_id, 'sub_cat_id' => $packageDetail->sub_category_id,  'course_id' =>$packageDetail->course_id])->inRandomOrder()->limit($totalQuestion)->get();
            } else {
                $subjectTests = StudentTestQuestion::where(['q_cat_id' => $packageDetail->category_id, 'sub_cat_id' => $packageDetail->sub_category_id, 'course_id' => $course_id])->inRandomOrder()->limit($totalQuestion)->get();
            }
            
            
            if ($subjectTests->count() != 0) {

                $mockTestEnrollmentcount = MockTestEnrollment::where(['test_type' => 'subject', 'user_id' => Auth::id(), 'package_id' => $id, 'test_status' => 'running'])->count();

                if ($mockTestEnrollmentcount >= 1) {

                    MockTestEnrollment::where(['test_type' => 'subject', 'user_id' => Auth::id(), 'package_id' => $id])->update(['test_status' => 'finish']);
                }
            }

            return response(['success' => true, 'status' => 200,'subjectTests' =>$subjectTests,'packageDetail' => $packageDetail , 'totalQuestion' => $totalQuestion]);

        } else {
            return response(['error' => 'package id is not valid !'], 404);
        }

       
    }

    public function subjectTestStart($id,$course_id=null)
    {
        
        $packageDetail = PackageSetting::with('subjectName')->where('id', $id)->first();

        if ($packageDetail->package_type == 'board') {

            $totalSubjectTests = StudentTestQuestion::where(['q_cat_id' => $packageDetail->category_id, 'sub_cat_id' => $packageDetail->sub_category_id, 'course_id' => $packageDetail->course_id])->count();
            $totalQuestion = getCountQuestion($totalSubjectTests, $packageDetail->no_of_test_questions);

            //$subjectTests = StudentTestQuestion::where(['q_cat_id' => $packageDetail->category_id, 'sub_cat_id' => $packageDetail->sub_category_id, 'course_id' => $packageDetail->course_id])->inRandomOrder()->limit($totalQuestion)->get();
            
            if($packageDetail->course_id == $course_id){
                $subjectTests = StudentTestQuestion::where(['q_cat_id' => $packageDetail->category_id, 'sub_cat_id' => $packageDetail->sub_category_id,  'course_id' =>$packageDetail->course_id])->inRandomOrder()->limit($totalQuestion)->get();
            }else{
                $subjectTests = StudentTestQuestion::where(['q_cat_id' => $packageDetail->category_id, 'sub_cat_id' => $packageDetail->sub_category_id, 'course_id' => $course_id])->inRandomOrder()->limit($totalQuestion)->get();
            }
            //echo '<pre>'; print_r($subjectTests); die;
            if ($subjectTests->count() != 0) {
                //print_r($subjectTests); die;
                $mockTestEnrollmentcount = MockTestEnrollment::where(['test_type' => 'subject', 'user_id' => Auth::id(), 'package_id' => $id, 'test_status' => 'running'])->first();
                if ($mockTestEnrollmentcount ==  '') {

                    $mockTestEnrollments = MockTestEnrollment::Create(['test_type' => 'subject', 'user_id' => Auth::id(), 'package_id' => $id, 'mock_test_duration' => '01:35:00', 'test_status' => 'running', 'running_status' => 'running']);
                    foreach ($subjectTests as $key => $mockTestSection) {
                        if ($mockTestSection->question_type == 1 &&  $mockTestSection->parent_id == null) {
                            MockTestEnrollmentAnswer::Create(['mock_test_enrollment_id' => $mockTestEnrollments->id, 'user_id' => Auth::id(), 'package_id' => $id, 'question_id' => $mockTestSection->id, 'attempt_status' => 'N', 'question_marks' => 1, 'question_negative_marks' => 0]);
                        }
                        if ($mockTestSection->question_type == 3 &&  $mockTestSection->parent_id != 0) {
                            MockTestEnrollmentAnswer::Create(['mock_test_enrollment_id' => $mockTestEnrollments->id, 'user_id' => Auth::id(), 'package_id' => $id, 'question_id' => $mockTestSection->id, 'attempt_status' => 'N', 'question_marks' => 1, 'question_negative_marks' => 0]);
                        }
                    }
                    $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollments->id])->get();
                    $totalQuestion = $studentTestQuestions->count();
                    $totalTime = $totalQuestion * 2;
                    $mockTestEnroll  = MockTestEnrollment::find($mockTestEnrollments->id);
                    $mockTestEnroll->mock_test_duration = $this->convertToHoursMins($totalTime, '%02d:%02d:00');
                    $mockTestEnroll->save();
                } else {

                    $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollmentcount->id])->get();
                    $totalQuestion = $studentTestQuestions->count();
                    $totalTime = $totalQuestion * 2;
                    $mockTestEnroll  = MockTestEnrollment::find($mockTestEnrollmentcount->id);
                    $mockTestEnroll->mock_test_duration = $this->convertToHoursMins($totalTime, '%02d:%02d:00');
                    $mockTestEnroll->save();
                }
            } else {

                    return response(['error' => 'Questions not added from admin !'], 404);
            }
            return response(['success' => true, 'status' => 200,'packageDetail' =>$packageDetail,'studentTestQuestions' => $studentTestQuestions , 'totalTime' => $totalTime]);

        } else {
            return response(['error' => 'package id is not valid !'], 404);
        }

    }

    function convertToHoursMins($time, $format = '%02d:%02d')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    
    public function unitTestDetail($id, $unitId = null)
    {
        
        if ($unitId != null) {
            $unitName = Classes::where('id' ,$unitId)->first();
            $packageDetail = PackageSetting::with('subjectName')->where('id', $id)->first();

            if ($packageDetail && $packageDetail->package_type == 'board') {

                $totalSubjectTests = StudentTestQuestion::where('unit_id', $unitId)->count();
                $totalQuestion = getCountQuestion($totalSubjectTests, $packageDetail->no_of_test_questions);
                $subjectTests = StudentTestQuestion::where('unit_id', $unitId)->inRandomOrder()->limit($totalQuestion)->get();
                if ($subjectTests->count() != 0) {
                    $mockTestEnrollmentcount = MockTestEnrollment::where(['test_type' => 'unit', 'user_id' => Auth::id(), 'package_id' => $id, 'test_status' => 'running'])->count();
                    if ($mockTestEnrollmentcount >= 1) {
                        MockTestEnrollment::where(['test_type' => 'unit', 'user_id' => Auth::id(), 'package_id' => $id])->update(['test_status' => 'finish']);
                    }
                }
            }   else {
                return response(['error' => 'package id is not valid !'], 404);
            }
        }

        return response(['success' => true, 'status' => 200,'packageDetail' =>$packageDetail,'subjectTests' => $subjectTests , 'unitName' => $unitName,'totalQuestion' => $totalQuestion]);
    }
      



    public function unitTestStart($id, $unitId = null)
    {
        if ($unitId != null) {
            $unitName = Classes::where('id' ,$unitId)->first();
            $packageDetail = PackageSetting::with('subjectName')->where('id', $id)->first();
            if ($packageDetail && $packageDetail->package_type == 'board') {

                $totalSubjectTests = StudentTestQuestion::where(['unit_id' => $unitId])->count();
                $totalQuestion = getCountQuestion($totalSubjectTests, $packageDetail->no_of_test_questions);

                $subjectTests = StudentTestQuestion::where('unit_id', $unitId)->inRandomOrder()->limit($totalQuestion)->get();
                if ($subjectTests->count() != 0) {

                    $mockTestEnrollmentcount = MockTestEnrollment::where(['test_type' => 'unit', 'user_id' => Auth::id(), 'package_id' => $id, 'test_status' => 'running'])->first();
                    if ($mockTestEnrollmentcount ==  '') {

                        $mockTestEnrollments = MockTestEnrollment::Create(['test_type' => 'unit', 'user_id' => Auth::id(), 'package_id' => $id, 'mock_test_duration' => '01:35:00', 'unit_id' => $unitId, 'test_status' => 'running', 'running_status' => 'running']);
                        foreach ($subjectTests as $key => $mockTestSection) {

                            MockTestEnrollmentAnswer::Create(['mock_test_enrollment_id' => $mockTestEnrollments->id, 'user_id' => Auth::id(), 'package_id' => $id, 'question_id' => $mockTestSection->id, 'attempt_status' => 'N', 'question_marks' => 1, 'question_negative_marks' => 0]);
                        }
                        $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollments->id])->get();
                        $totalQuestion = $studentTestQuestions->count();
                        $totalTime = $totalQuestion * 2;
                        $mockTestEnroll  = MockTestEnrollment::find($mockTestEnrollments->id);
                        $mockTestEnroll->mock_test_duration = '00:' . $totalTime . ':00';
                        $mockTestEnroll->save();

                    } else {
                        $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollmentcount->id])->get();
                        $totalQuestion = $studentTestQuestions->count();
                        $totalTime = $totalQuestion * 2;
                        $mockTestEnroll  = MockTestEnrollment::find($mockTestEnrollmentcount->id);
                        $mockTestEnroll->mock_test_duration = '00:' . $totalTime . ':00';
                        $mockTestEnroll->save();
                    }
                } else {
                    return response(['error' => 'Questions not added from admin !'], 404);
                }
                return response(['success' => true, 'status' => 200,'packageDetail' =>$packageDetail,'studentTestQuestions' => $studentTestQuestions , 'unitName' => $unitName,'totalTime' => $totalTime]);
            } else {
                return response(['error' => 'package id is not valid !'], 404);
            }
        } 
    }


    
    public function chapterTestDetail($id, $chapterId = null)
    {

        if ($chapterId != null) {
            $unitName = ClassContent::where('id' ,$chapterId)->first();
            $packageDetail = PackageSetting::with('subjectName')->where('id', $id)->first();
            if ($packageDetail->package_type == 'board') {

                $totalSubjectTests = StudentTestQuestion::where('chapter_id', $chapterId)->count();
               // print_r($packageDetail->no_of_test_questions); die;
                $totalQuestion = getCountQuestion($totalSubjectTests, $packageDetail->no_of_test_questions);

                $subjectTests = StudentTestQuestion::where('chapter_id', $chapterId)->inRandomOrder()->limit($totalQuestion)->get();

                if ($subjectTests->count() != 0) {

                    $mockTestEnrollmentcount = MockTestEnrollment::where(['test_type' => 'chapter', 'user_id' => Auth::id(), 'package_id' => $id, 'test_status' => 'running'])->count();

                    if ($mockTestEnrollmentcount >= 1) {

                        MockTestEnrollment::where(['test_type' => 'chapter', 'chapter_id' => $chapterId, 'user_id' => Auth::id(), 'package_id' => $id])->update(['test_status' => 'finish']);
                    }
                }
            } else {
                return response(['error' => 'package id is not valid !'], 404);
            }
        } 
        return response(['success' => true, 'status' => 200,'packageDetail' =>$packageDetail,'subjectTests' => $subjectTests , 'unitName' => $unitName,'totalQuestion' => $totalQuestion]);

    
    }

    public function chapterTestStart($id, $chapterId = null)
    {
        if ($chapterId != null) {
            $unitName = ClassContent::where('id' ,$chapterId)->first();

            $packageDetail = PackageSetting::with('subjectName')->where('id', $id)->first();

            if ($packageDetail && $packageDetail->package_type == 'board') {

                $totalSubjectTests = StudentTestQuestion::where(['chapter_id' => $chapterId])->count();
                $totalQuestion = getCountQuestion($totalSubjectTests, $packageDetail->no_of_test_questions);
                //->limit($totalQuestion)
                $subjectTests = StudentTestQuestion::where('chapter_id', $chapterId)->limit($totalQuestion)->inRandomOrder()->get();
                if ($subjectTests->count() != 0) {

                    $mockTestEnrollmentcount = MockTestEnrollment::where(['test_type' => 'chapter', 'user_id' => Auth::id(), 'package_id' => $id, 'test_status' => 'running'])->first();
                    if ($mockTestEnrollmentcount ==  '') {

                        $mockTestEnrollments = MockTestEnrollment::Create(['test_type' => 'chapter', 'user_id' => Auth::id(), 'package_id' => $id, 'chapter_id' => $chapterId, 'mock_test_duration' => '01:35:00', 'test_status' => 'running', 'running_status' => 'running']);
                        foreach ($subjectTests as $key => $mockTestSection) {

                            MockTestEnrollmentAnswer::Create(['mock_test_enrollment_id' => $mockTestEnrollments->id, 'user_id' => Auth::id(), 'package_id' => $id, 'question_id' => $mockTestSection->id, 'attempt_status' => 'N', 'question_marks' => 1, 'question_negative_marks' => 0]);
                        }
                        $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollments->id])->get();
                        $totalQuestion = $studentTestQuestions->count();
                        $totalTime = $totalQuestion * 2;
                        $mockTestEnroll  = MockTestEnrollment::find($mockTestEnrollments->id);
                        $mockTestEnroll->mock_test_duration = '00:' . $totalTime . ':00';
                        $mockTestEnroll->save();
                    } else {
                        $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollmentcount->id])->get();
                        $totalQuestion = $studentTestQuestions->count();
                        $totalTime = $totalQuestion * 2;
                        $mockTestEnroll  = MockTestEnrollment::find($mockTestEnrollmentcount->id);
                        $mockTestEnroll->mock_test_duration = '00:' . $totalTime . ':00';
                        $mockTestEnroll->save();
                    }
                } else {

                    return response(['error' => 'Questions not added from admin !'], 404);
                }

                return response(['success' => true, 'status' => 200,'packageDetail' =>$packageDetail,'studentTestQuestions' => $studentTestQuestions , 'unitName' => $unitName,'totalTime' => $totalTime]);
            }   else {
                return response(['error' => 'package id is not valid !'], 404);
            }
        } 
    }

    
    public function questionSubjectUpdate(Request $request)
    {

        if ($request->testType == 'unit-test-start') {
            $testType = 'unit';
        } elseif ($request->testType == 'chapter-test-start') {
            $testType = 'chapter';
        } else {
            $testType = 'subject';
        }
        $mockTestEnrollment =  mockTestEnrollment::where(['test_type' => $testType, 'user_id' => Auth::id(), 'package_id' => $request->pacakge_id, 'test_status' => 'running'])->first();
        if ($mockTestEnrollment) {
            if ($request->type == 'marked') {

                MockTestEnrollmentAnswer::updateOrCreate(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'question_id' => $request->id], ['attempt_status' => 'M']);
            } elseif ($request->type == 'saveNextValue') {

                MockTestEnrollmentAnswer::updateOrCreate(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'question_id' => $request->id], ['attempt_status' => 'A', 'answer_id' => $request->answer]);
            } else {

                MockTestEnrollmentAnswer::updateOrCreate(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'question_id' => $request->id], ['attempt_status' => 'V']);
            }

            $notVisited = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'attempt_status' => 'N'])->count();

            $visited = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'attempt_status' => 'V'])->count();

            $marked = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'attempt_status' => 'M'])->count();

            $answered = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'attempt_status' => 'A'])->count();
            
            
            return response(['success' => true, 'status' => 200,'visited' =>$visited,'notVisited' => $notVisited , 'marked' => $marked,'answered' => $answered]);
            
        }
    }

     public function getFinalReport(request $request)
    {

        //print_r($request->all()); die;
        if ($request->testType == 'mock-test-start') {
            $testType = 'mockTest';
        } else {
            if ($request->testType == 'unit-test-start') {
                $testType = 'unit';
            } elseif ($request->testType == 'chapter-test-start') {
                $testType = 'chapter';
            } else {
                $testType = 'subject';
            }
        }
        $mockTestEnrollment =  MockTestEnrollment::where(['test_type' => $testType, 'user_id' => Auth::id(), 'package_id' => $request->pacakge_id, 'test_status' => 'running'])->first();
        $mockTestEnrollment->test_status = 'finish';
        $section_hours = (int) filter_var($request->section_hours, FILTER_SANITIZE_NUMBER_INT);
        $section_min  = (int) filter_var($request->section_min, FILTER_SANITIZE_NUMBER_INT);;
        $section_seconds  = (int) filter_var($request->section_seconds, FILTER_SANITIZE_NUMBER_INT);;
        $mockTestEnrollment->test_taken_time = $section_hours . ':' . $section_min . ':' . $section_seconds;
        $mockTestEnrollment->update();

        $totalNoOfQuestion = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id()])->count();

        $notVisited = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'attempt_status' => 'N'])->count();

        $visited = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'attempt_status' => 'V'])->count();

        $marked = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'attempt_status' => 'M'])->count();

        $answered = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollment->id, 'user_id' => Auth::id(), 'attempt_status' => 'A'])->count();

    
        return response(['success' => true, 'status' => 200,'totalNoOfQuestion' => 'totalNoOfQuestion','visited' =>$visited,'notVisited' => $notVisited , 'marked' => $marked,'answered' => $answered]);
            
    }

    
    public function updateErrorReport(request $request)
    {
        $mockTestEnrollment = MockTestEnrollment::where(['test_type' => $request->test_type, 'user_id' => $request->user_id, 'package_id' => $request->package, 'test_status' => 'running'])->first();
        $mockTestEnrollId = $mockTestEnrollment->id;
        $mockTestEnrollAnswer = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestEnrollId, 'question_id' => $request->question])->first();
        $mockTestEnrollAnswer->error_type = $request->type_error;
        $mockTestEnrollAnswer->error_detail = $request->error;
        $mockTestEnrollAnswer->save();
        return response(['success' => true, 'status' => 200,'showMessage' => 'Report updated !']);
            
        
    }

    public function reportDetail($id, $mocktestId)
    {
        $packageDetail = PackageSetting::with('subjectName')->where('id', $id)->first();
        $mockTestEnrollment =  MockTestEnrollment::where(['id' => $mocktestId, 'user_id' => Auth::id(), 'package_id' => $id, 'test_status' => 'finish'])->first();

        $studentTestQuestions = array();
        if ($mockTestEnrollment) {
            $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mocktestId, 'package_id' => $id, 'user_id' => Auth::id()])->get();
            $totalQuestion = $studentTestQuestions->count();
            $totalTime = $totalQuestion * 2;

            return response(['success' => true, 'status' => 200,'mockTestEnrollment' => 'mockTestEnrollment','packageDetail' =>$packageDetail,'studentTestQuestions' => $studentTestQuestions , 'totalTime' => $totalTime]);
            
        }
    }


    public function mockTest()
    {

        $mockTests = MockTestMaster::with('mockTestSection')->where('status', 1)->get();
       
        return response(['success' => true, 'status' => 200,'mockTests' => 'mockTests']);
            
    }

    public function testPacakge($id)
    {

        $packages = PackageSetting::where('id', $id)->first();

        $mockTests = MockTestMaster::with('mockTestSection')->where(['category_id' => $packages->sub_category_id, 'test_type' => 'Mock'])->where('status', 1)->first();
       
        return response(['success' => true, 'status' => 200,'mockTests' => 'mockTests','packages' =>$packages]);
            
    }  


    
    public function mockTestDetail($packageId, $id)
    {
        $packageDetail = PackageSetting::with('subjectName')->where('id', $packageId)->first();


        $mockTest = MockTestMaster::with('mockTestSection')->where('id', $id)->where('status', 1)->first();
        $mockTestEnrollmentcount = MockTestEnrollment::where(['user_id' => Auth::id(), 'mock_test_id' => $id, 'test_status' => 'running'])->count();

        if ($mockTestEnrollmentcount >= 1) {

            MockTestEnrollment::where(['user_id' => Auth::id(), 'mock_test_id' => $id])->update(['test_status' => 'finish']);
        }

        return response(['success' => true, 'status' => 200,'mockTest' => 'mockTest','packageDetail' =>$packageDetail]);
            
    }

    public function mockTestStart($packageId, $id)
    {
       // $sectionType = Session::get('section_type');
        // if ($sectionType == '') {
        //     Session::put('section_type', 'with_section');
        // }
        $packageDetail = PackageSetting::with('subjectName')->where('id', $packageId)->first();
        $mockTest = MockTestMaster::with('mockTestSection')->where('id', $id)->where('status', 1)->first();
        $visited = MockTestEnrollmentAnswer::where(['question_id' => $id, 'attempt_status' => 'N'])->count();
        $mockTestSectionId = MockTestSection::where('mock_test_master_id', $mockTest->id)->first();
        $sectionQuestions = MockTestSectionQuestion::where(['mock_test_master_id'
        => $mockTestSectionId->mock_test_master_id, 'mock_test_section_id' => $mockTestSectionId->id])->first();

        $mockTestSectionQuestions = MockTestSectionQuestion::where([
            'mock_test_master_id' => $mockTestSectionId->mock_test_master_id, 'mock_test_section_id' => $mockTestSectionId->id, 'status' => 1
        ])->inRandomOrder()->limit($packageDetail->no_of_test_questions)->get();
        $mockTestEnrollmentcount = MockTestEnrollment::where(['user_id' => Auth::id(), 'package_id' => $packageId, 'mock_test_id' => $id, 'test_status' => 'running'])->first();
        if ($mockTestEnrollmentcount == '') {
            $mockTestEnrollments = MockTestEnrollment::Create(['test_type' => 'mockTest', 'user_id' => Auth::id(), 'package_id' => $packageId, 'mock_test_id' => $id, 'mock_test_duration' => $mockTest->total_time, 'test_status' => 'running']);
            if ($mockTestEnrollments) {
                foreach ($mockTest->mockTestSection as $key => $mockTestSection) {

                    $mockTestSectionQuestions = MockTestSectionQuestion::where([
                        'mock_test_master_id' => $mockTestSection->mock_test_master_id, 'mock_test_section_id' => $mockTestSection->id, 'status' => 1
                    ])->get();

                    foreach ($mockTestSectionQuestions as $key => $value) {
                        $studentTest = StudentTestQuestion::where(['id' => $value->student_test_question_id])->first();
                        if ($studentTest) {
                            MockTestEnrollmentAnswer::Create(['mock_test_enrollment_id' => $mockTestEnrollments->id, 'package_id' => $packageId, 'user_id' => Auth::id(), 'section_id' => $mockTestSection->id, 'question_id' => $value->student_test_question_id, 'attempt_status' => 'N', 'question_marks' => $mockTestSection->question_value, 'question_negative_marks' => $mockTestSection->negative_marking_value]);
                        }
                    }
                }
            }
        }

        return response(['success' => true, 'status' => 200,'mockTest' => 'mockTest','packageDetail' =>$packageDetail,'visited' => $visited, 'sectionQuestions' => $sectionQuestions,'mockTestSectionId' =>$mockTestSectionId,'mockTestSectionQuestions' =>$mockTestSectionQuestions, 'mockTestEnrollmentcount'=>$mockTestEnrollmentcount]);
            
    }

    public function getMockTest(Request $request)
    {
        $packageDetail = PackageSetting::with('subjectName')->where('id', $request->package_id)->first();

        $mockTestSectionId = MockTestSection::where('id', $request->id)->where('status', 1)->first();

        $mockTest = MockTestMaster::with('mockTestSection')->where('id', $mockTestSectionId->mock_test_master_id)->where('status', 1)->first();
        $sectionQuestions = MockTestSectionQuestion::where(['mock_test_master_id'
        => $mockTestSectionId->mock_test_master_id, 'mock_test_section_id' => $mockTestSectionId->id])->first();

        $mockTestEnrollmentcount = MockTestEnrollment::where(['user_id' => Auth::id(), 'mock_test_id' =>  $mockTest->id, 'package_id' =>  $request->package_id, 'test_status' => 'running'])->first();
        // print_r($mockTestEnrollmentcount); die;
        $mockTestSectionQuestions = MockTestSectionQuestion::where([
            'mock_test_master_id' => $mockTestSectionId->mock_test_master_id, 'mock_test_section_id' => $mockTestSectionId->id, 'status' => 1
        ])->get();

        $notVisited = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestSectionId->mock_test_master_id, 'user_id' => Auth::id(), 'section_id' => $request->id, 'attempt_status' => 'N'])->count();

        $visited = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestSectionId->mock_test_master_id, 'user_id' => Auth::id(), 'section_id' => $request->id, 'attempt_status' => 'V'])->count();

        $marked = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestSectionId->mock_test_master_id, 'user_id' => Auth::id(), 'section_id' => $request->id, 'attempt_status' => 'M'])->count();

        $answered = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mockTestSectionId->mock_test_master_id, 'user_id' => Auth::id(), 'section_id' => $request->id, 'attempt_status' => 'A'])->count();

        
        return response(['success' => true, 'status' => 200, 'packageDetail' => $packageDetail ,'visited' =>$visited , 'mockTestSectionId' => $mockTestSectionId ,'sectionQuestions' => $sectionQuestions,'mockTestSectionQuestions' => $mockTestSectionQuestions, 'mockTest' => $mockTest , 'mockTestEnrollmentcount' =>$mockTestEnrollmentcount, 'visited' => $visited, 'notVisited' => $notVisited,'marked'=> $marked,'answered' => $answered]);

    }

    

     

}
