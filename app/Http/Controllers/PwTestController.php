<?php

namespace App\Http\Controllers;

use App\MockTestMaster;
use App\MockTestSection;
use App\MockTestEnrollment;
use App\MockTestEnrollmentAnswer;
use App\MockTestSectionQuestion;
use App\PackageSetting;
use App\StudentTestQuestion;
use App\Model\PwCourse;
use App\Model\PwClasses;
use App\Model\PwClassContent;

use Validator, Redirect, Response, File;
use Illuminate\Support\Facades\Session;
use App\Option;
use Auth;
use Illuminate\Http\Request;

class PwTestController extends Controller
{
    
    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
        $this->middleware('auth');
    }

        
    public function pwMockTestDetail($courseId, $id)
    {
        $packageDetail = PwCourse::where('id', $courseId)->first();


        $mockTest = MockTestMaster::with('mockTestSection')->where('id', $id)->where('status', 1)->first();
        $mockTestEnrollmentcount = MockTestEnrollment::where(['user_id' => Auth::id(), 'mock_test_id' => $id, 'test_status' => 'running'])->count();

        if ($mockTestEnrollmentcount >= 1) {

            MockTestEnrollment::where(['user_id' => Auth::id(), 'mock_test_id' => $id])->update(['test_status' => 'finish']);
        }
        return view('rumbok.pwtest.mock-test-detail', compact('mockTest', 'packageDetail'));
    }

    public function pwMockTestStart ($packageId, $id)
    {
        $sectionType = Session::get('section_type');
        if ($sectionType == '') {
            Session::put('section_type', 'with_section');
        }
        $packageDetail = PwCourse::where('id', $packageId)->first();
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
        return view('rumbok.pwtest.mock-test-start', compact('mockTest', 'packageDetail', 'visited', 'sectionQuestions', 'mockTestSectionId', 'mockTestSectionQuestions', 'mockTestEnrollmentcount'));
    }

    public function pwMockAnalyticalReport ($id, $mocktestId)
    {
        //echo "HERE";exit;

        $packageDetail = PwCourse::where('id', $id)->first();
       
        $mockTestEnrollment =  MockTestEnrollment::where(['id' => $mocktestId, 'user_id' => Auth::id(), 'package_id' => $id, 'test_status' => 'finish'])->first();
        
        if ($mockTestEnrollment->test_type == 'mockTest') {
            $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mocktestId, 'package_id' => $id, 'user_id' => Auth::id()])->get();

            foreach ($studentTestQuestions as  $studentTestQuestion) {

                $studentQuestion = StudentTestQuestion::where('id', $studentTestQuestion->question_id)->first();
                $countArray[] = $studentQuestion;
                $findUnit[] =  $studentTestQuestion->section_id;
                $totalAttend[] = array('id' => $studentQuestion->id, 'section_id' => $studentTestQuestion->section_id, 'answer_id' => $studentTestQuestion->answer_id);
                $arrayValues =  array_unique($findUnit);
                $coluntKeys = count($arrayValues);
            }

            return view('rumbok.pwtest.mock-analytical-report-detail', compact('mockTestEnrollment', 'totalAttend', 'packageDetail', 'studentTestQuestions', 'arrayValues', 'coluntKeys', 'countArray'));
        } else if ($mockTestEnrollment->test_type == 'subject' || $mockTestEnrollment->test_type == 'unit') {
            $studentTestQuestions = array();
            if ($mockTestEnrollment) {
                $findUnit = [];
                $totalAttend = [];
                $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mocktestId, 'package_id' => $id, 'user_id' => Auth::id()])->get();

                foreach ($studentTestQuestions as  $studentTestQuestion) {

                    $studentQuestion = StudentTestQuestion::where('id', $studentTestQuestion->question_id)->first();
                    $countArray[] = $studentQuestion;
                    $findUnit[] =  $studentQuestion->unit_id;
                    $totalAttend[] = array('id' => $studentQuestion->id, 'unit_id' => $studentQuestion->unit_id, 'answer_id' => $studentTestQuestion->answer_id);
                }
                $arrayValues =  array_unique($findUnit);
                $coluntKeys = count($arrayValues);

                return view('rumbok.pwtest.analytical-report-detail', compact('mockTestEnrollment', 'totalAttend', 'packageDetail', 'studentTestQuestions', 'arrayValues', 'coluntKeys', 'countArray'));
            }
        } else {

            $studentTestQuestions = array();
            if ($mockTestEnrollment) {
                $findUnit = [];
                $totalAttend = [];
                $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mocktestId, 'package_id' => $id, 'user_id' => Auth::id()])->get();

                foreach ($studentTestQuestions as  $studentTestQuestion) {
                    $studentQuestion = StudentTestQuestion::where('id', $studentTestQuestion->question_id)->first();
                    $countArray[] = $studentQuestion;
                    $findUnit[] =  $studentQuestion->chapter_id;
                    $totalAttend[] = array('id' => $studentQuestion->id, 'chapter_id' => $studentQuestion->chapter_id, 'answer_id' => $studentTestQuestion->answer_id);
                }
                $arrayValues =  array_unique($findUnit);
                $coluntKeys = count($arrayValues);

                return view('rumbok.pwtest.analytical-report-detail', compact('mockTestEnrollment', 'totalAttend', 'packageDetail', 'studentTestQuestions', 'arrayValues', 'coluntKeys', 'countArray'));
            }
        }
    }

    public function pwMockReportDetail($id, $mocktestId)
    {
        $packageDetail = PwCourse::where('id', $id)->first();
        $mockTestEnrollment =  MockTestEnrollment::where(['id' => $mocktestId, 'user_id' => Auth::id(), 'package_id' => $id, 'test_status' => 'finish'])->first();
        $mockTests = MockTestMaster::with('mockTestSection')->where(['test_type' => 'Mock', 'id' => $mockTestEnrollment->mock_test_id])->where('status', 1)->first();
        $studentTestQuestions = array();
        if ($mockTestEnrollment) {
            $studentTestQuestions = MockTestEnrollmentAnswer::where(['mock_test_enrollment_id' => $mocktestId, 'package_id' => $id, 'user_id' => Auth::id()])->get();
            $totalQuestion = $studentTestQuestions->count();
            $totalTime = $totalQuestion * 2;

            return view('rumbok.pwtest.mock-report-detail', compact('packageDetail', 'mockTests', 'studentTestQuestions', 'totalTime', 'mockTestEnrollment'));
        }
    }

    public function pwGetFinalReport(request $request)
    {

        //print_r($request->all()); die;
        if ($request->testType == 'mock-test-start' || $request->testType == 'pw-mock-test-start') {
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

        return response()->json(["type" => "success", 'totalNoOfQuestion' => $totalNoOfQuestion, 'visited' => $visited, 'notVisited' => $notVisited, 'marked' => $marked, 'answered' => $answered]);
    }
    public function pwMockTestPackageDetail($id, $mockId)
    {

        $packageDetail = PwCourse::where('id', $id)->first();
        $type = 'mockTest';
        $mockTests = MockTestMaster::with('mockTestSection')->where(['test_type' => 'Mock', 'id' => $mockId])->where('status', 1)->first();
        $getTestReports =  MockTestEnrollment::with('MockTestEnrollmentAnswer')->where(['test_type' => 'mockTest', 'test_status' => 'finish', 'user_id' => Auth::id(), 'package_id' => $id, 'mock_test_id' => $mockId])->orderBy('id', 'desc')->get();

        return view('rumbok.pwtest.mock-test-packages', compact('mockTests', 'getTestReports', 'type', 'packageDetail'));
    }
}
