<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\ClassContent;
use App\Model\Course;
use App\Model\Demo;
use App\Model\Student;
use App\User;
use App\Question;
use App\Quiz;
use Alert;
use App\QuizScore;
use App\QuizEnrollment;
use App\QuizAnswer;
use App\Model\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;


class QuizController extends Controller
{
    //
    public function create()
    {
        $quiz = Quiz::where('user_id', Auth::id())->paginate(10);
        $courses = Course::where('user_id', Auth::id())->get();
        return view('addon.view.quiz.index', compact('quiz', 'courses'));
    }

    /*store */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'pass_mark' => 'required',
        ]);
        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->quiz_time = $request->quiz_time;
        $quiz->pass_mark = $request->pass_mark;
        $quiz->status = $request->status;
        $quiz->user_id = Auth::id();
        $quiz->course_id = $request->course_id;
        $quiz->number_of_attempts = $request->attempts;
        $quiz->save();
        notify()->success(translate('Quiz Create Successful Done'));
        return back();
    }

    /*edit quiz*/
    public function edit($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $course_detail = Course::where('id', $quiz->course_id)->first();
        $category_detail = Category::where('id', $course_detail->category_id)->first();
        $courses = Course::where('user_id', Auth::id())->Published()->get();
        return view('addon.view.quiz.edit', compact('quiz', 'courses','course_detail','category_detail'));
    }

    /*quiz update*/
    public function update(Request $request)
    {
        $quiz = Quiz::where('id', $request->id)->first();
        $quiz->name = $request->name;
        $quiz->quiz_time = $request->quiz_time;
        $quiz->pass_mark = $request->pass_mark;
        $quiz->status = $request->status;
        $quiz->user_id = Auth::id();
        $quiz->course_id = $request->course_id;
        $quiz->number_of_attempts = $request->attempts;
        $quiz->save();
        notify()->success(translate('Quiz Update Successful Done'));
        return back();
    }


    /*quiz delete*/
    public function delete($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $quiz->delete();
        notify()->success(translate('Quiz Delete Successful Done'));
        return back();
    }

    //published
    public function published(Request $request)
    {
        // don't use this type of variable naming, use $category instead of $cat1
        $quiz = Quiz::where('id', $request->id)->first();
        if ($quiz->status == 1) {
            $quiz->status = 0;
            $quiz->save();
        } else {
            $quiz->status = 1;
            $quiz->save();
        }
        return response(['message' => translate('Quiz  status is changed ')], 200);
    }


    /*questions*/
    public function questionsIndex($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $questions = Question::where('quiz_id', $quiz->id)->get();
        return view('addon.view.quiz.questionsIndex', compact('quiz', 'questions'));
    }

    /*questions store*/
    public function questionsStore(Request $request)
    {
        $i = 0;
        $answer_collection = collect();
        foreach ($request->answer as $answer) {
            $data = rand(1000, 1000000);
            $demo = new Demo();
            $demo->image = $request->image[$i] ?? null;
            $demo->index = $data;
            $demo->correct = $request->correct[$i];
            $demo->answer = $answer;
            if ($demo->image != null) {
                //upload the image
                $demo->image = fileUpload($request->image[$i], 'quiz');
            }
            $i++;
            $answer_collection->push($demo);

        }

        $question = new Question();
        $question->question = $request->title;
        $question->quiz_id = $request->quiz_id;
        $question->user_id = Auth::id();
        $question->grade = $request->grade;
        $question->options = json_encode($answer_collection);
        $question->save();
        notify()->success(translate('Questions Create Successful'));
        return back();
    }

    /*questions import csv*/
    public function questionsImportIndex($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $questions = Question::where('quiz_id', $quiz->id)->get();
        return view('addon.view.quiz.questionsImportIndex', compact('quiz', 'questions'));
    }

    /*questions CSV store*/
    public function questionsCsvStore(Request $request)
    {
        $questionsCount = 0;
        $questionsStatusLiveCount = 0;
        $questionsStatusBlockCount = 0;
        if(!empty($request->questionFile)) {
            foreach ($request->questionFile as $getfile) {
                if (($handle = fopen($getfile, 'r')) !== FALSE) { // Check the resource is valid
                    
                    $start = 0;
                    while (($data = fgetcsv($handle)) !== FALSE) { // Check opening the file is OK!

                        $answer_collection = collect();
                        $isTrueSelected = 0;
                        if ($start != 0) {

                            // check for question written or not
                            if (!empty($data[1])) {

                                // for option 1
                                if (!empty($data[3])) {
                                    $randomIndex = rand(1000, 1000000);
                                    $demo = new Demo();
                                    $demo->image = null;
                                    $demo->index = $randomIndex;
                                    $demo->answer = trim($data[3]);
                                    $demo->correct = strtolower(trim($data[4]));
                                    $answer_collection->push($demo);
                                    if (strtolower(trim($data[4])) == 'true') {
                                        $isTrueSelected = 1;
                                    }
                                }

                                // for option 2
                                if (!empty($data[5])) {
                                    $randomIndex = rand(1000, 1000000);
                                    $demo = new Demo();
                                    $demo->image = null;
                                    $demo->index = $randomIndex;
                                    $demo->answer = trim($data[5]);
                                    $demo->correct = strtolower(trim($data[6]));
                                    $answer_collection->push($demo);
                                    if (strtolower(trim($data[6])) == 'true') {
                                        $isTrueSelected = 1;
                                    }
                                }

                                // for option 3
                                if (!empty($data[7])) {
                                    $randomIndex = rand(1000, 1000000);
                                    $demo = new Demo();
                                    $demo->image = null;
                                    $demo->index = $randomIndex;
                                    $demo->answer = trim($data[7]);
                                    $demo->correct = strtolower(trim($data[8]));
                                    $answer_collection->push($demo);
                                    if (strtolower(trim($data[8])) == 'true') {
                                        $isTrueSelected = 1;
                                    }
                                }

                                // for option 4
                                if (!empty($data[9])) {
                                    $randomIndex = rand(1000, 1000000);
                                    $demo = new Demo();
                                    $demo->image = null;
                                    $demo->index = $randomIndex;
                                    $demo->answer = trim($data[9]);
                                    $demo->correct = strtolower(trim($data[10]));
                                    $answer_collection->push($demo);
                                    if (strtolower(trim($data[10])) == 'true') {
                                        $isTrueSelected = 1;
                                    }
                                }

                                // for option 5
                                if (!empty($data[11])) {
                                    $randomIndex = rand(1000, 1000000);
                                    $demo = new Demo();
                                    $demo->image = null;
                                    $demo->index = $randomIndex;
                                    $demo->answer = trim($data[11]);
                                    $demo->correct = strtolower(trim($data[12]));
                                    $answer_collection->push($demo);
                                    if (strtolower(trim($data[12])) == 'true') {
                                        $isTrueSelected = 1;
                                    }
                                }

                                // for option 6
                                if (!empty($data[13])) {
                                    $randomIndex = rand(1000, 1000000);
                                    $demo = new Demo();
                                    $demo->image = null;
                                    $demo->index = $randomIndex;
                                    $demo->answer = trim($data[13]);
                                    $demo->correct = strtolower(trim($data[14]));
                                    $answer_collection->push($demo);
                                    if (strtolower(trim($data[14])) == 'true') {
                                        $isTrueSelected = 1;
                                    }
                                }

                                if ($isTrueSelected != 0) {
                                    $question = new Question();
                                    $question->question = trim($data[1]);
                                    $question->quiz_id = $request->quiz_id;
                                    $question->user_id = Auth::id();
                                    $question->grade = trim($data[2] ? $data[2] : 1);
                                    $question->options = json_encode($answer_collection);
                                    $question->save();
                                    $questionsCount++;
                                    $questionsStatusLiveCount++;
                                } else {
                                    $question = new Question();
                                    $question->question = trim($data[1]);
                                    $question->quiz_id = $request->quiz_id;
                                    $question->user_id = Auth::id();
                                    $question->grade = trim($data[2] ? $data[2] : 1);
                                    $question->options = json_encode($answer_collection);
                                    $question->status = 0;
                                    $question->save();
                                    $questionsCount++;
                                    $questionsStatusBlockCount++;
                                }
                            }
                        } else {
                            $start++;
                        }
                    }
                    fclose($handle);

                } else {
                    notify()->error(translate('File is not correct. Please try another file'));
                    return back();
                }
            }
        } else {
            notify()->error(translate('Please select file to import'));
            return back();
        }
        if ($questionsCount == 0) {
            notify()->error(translate('The file is empty. Please fill questions to import.'));
            return back();
        } else {
            notify()->success(translate('Successfully imported '. $questionsCount .' number of questions. With '. $questionsStatusLiveCount .' active questions and '. $questionsStatusBlockCount .' inactive questions.'));
            return back();
        }
        
    }


    //published
    public function questionsPublished(Request $request)
    {
        // don't use this type of variable naming, use $category instead of $cat1
        $quiz = Question::where('id', $request->id)->first();
        if ($quiz->status == 1) {
            $quiz->status = 0;
            $quiz->save();
        } else {
            $quiz->status = 1;
            $quiz->save();
        }
        return response(['message' => translate('Question  status is changed ')], 200);
    }

    /*questions delete*/
    public function questionsDelete($id)
    {
        $quiz = Question::where('id', $id)->first();
        $quiz->delete();
        notify()->success(translate('Question Delete Successful Done'));
        return back();
    }

    /*questions edit*/

    public function questionsEdit($id)
    {
        $question = Question::where('id', $id)->first();
        return view('addon.view.quiz.questionsEdit', compact('question'));
    }


    public function questionsUpdate(Request $request)
    {

        $i = 0;
        $answer_collection = collect();
        foreach ($request->answer as $answer) {
            $data = $request->index[$i];
            $demo = new Demo();
            $demo->image = $request->image[$i] ?? null;
            $demo->index = $data;
            $demo->correct = $request->correct[$i];
            $demo->answer = $answer;
            if ($demo->image != null) {
                //upload the image
                $demo->image = fileUpload($request->image[$i], 'quiz');
            }
            $i++;
            $answer_collection->push($demo);

        }

        $question = Question::where('id', $request->id)->first();
        $question->question = $request->title;
        $question->grade = $request->grade;
        $question->status = $request->status;
        $question->options = json_encode($answer_collection);
        $question->save();
        notify()->success(translate('Questions Update Successful'));
        return back();

    }
    /*for frontend*/


    public function start($id, $content_id){
        $course = Course::where('id',$id)->first();
        $quiz = Quiz::where('course_id',$id)->where('status','1')->first();
        
        $url = route('start.quiz',[$id,$content_id]);
        /*check number of attempts of course assessment*/
        $attempted = QuizScore::where('course_id', $id)->where('quiz_id',$quiz->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->count();
        $qualifyStatus = QuizScore::where('course_id', $id)->where('quiz_id',$quiz->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->orderByDesc('id')->first();
        return \view('addon.view.quiz.question',compact('url','course','quiz','attempted','qualifyStatus'));
    }

    /*quiz start*/
    public function quizStart(Request $request, $id, $content_id)
    {
         $time = Carbon::now();
        $startDate = $time->toDateString();
        $startTime = $time->toTimeString();
        
        
        $request->session()->put('start_quiz', $startTime);
        $content = ClassContent::findOrFail($content_id);

        if ($content != null) {
            $quiz = Quiz::where('course_id', $id)->where('status','1')->with('questions')->firstOrFail();
        }
        
        $addTime = "+".$quiz->quiz_time." minutes";
        
        $endTime = date('H:i:s', strtotime($addTime, strtotime($startTime)));
        
        $quizEnrolled = QuizEnrollment::where('quiz_id', $quiz->id)->where('user_id', Auth::id())->where('course_id', $id)->orderByDesc('id')->first();
        
        if (!$quizEnrolled) {
            $timeLeft = $quiz->quiz_time;
            
            $quizEnrollment = new QuizEnrollment();
            $quizEnrollment->quiz_id = $quiz->id;
            $quizEnrollment->course_id = $id;
            $quizEnrollment->user_id = Auth::id();
            $quizEnrollment->quiz_taken_status = 'running';
            $quizEnrollment->start_date = $startDate;
            $quizEnrollment->start_time = $startTime;
            $quizEnrollment->end_time = $endTime;
            $quizEnrollment->save();
            $quizEnrolled = QuizEnrollment::where('quiz_id', $quiz->id)->where('user_id', Auth::id())->where('course_id', $id)->orderByDesc('id')->first();
        } else {
            $timeLeft = round(abs(strtotime($time->toTimeString()) - strtotime($quizEnrolled->end_time)) / 60,2);
        }
        
        return view('addon.view.quiz.questionsStart', compact('quiz', 'content', 'quizEnrolled', 'timeLeft'));
    }

    /*quiz done*/
    /*public function quizDone(Request $request)
    {

        //here the most complicated is identify $minutes
        $time = Carbon::now();
        $start_time = $request->session()->get('start_quiz');
        $end_time = $time->diffInMinutes($start_time);
        $request->session()->forget('start_quiz');

        $minutes = $end_time == 0 ? 1 : $end_time;
        $quiz = Quiz::where('id', $request->quiz_id)->first();;
        $content_id = $request->content_id;
        $wrong = 0;
        $point = 0;
        $right = 0;
        $status = '';
        foreach ($request->question as $id) {
            $qu = Question::where('id', $id)->first();

            foreach (json_decode($qu->options, true) as $ns) {
                $radio = 'answer_' . $id;
                if ($ns['index'] == $request->$radio) {
                    if ($ns['correct'] == "true") {
                        $point += $qu->grade;
                        $right = $right + 1;
                    } else {
                        $wrong = $wrong + 1;
                    }
                }
            }
        }
        if ($quiz->pass_mark > $point) {
            //fail
            $status = 'fail';
        } else {
            //pass
            $status = 'pass';
        }
        if ($end_time > $quiz->minutes) {
            //fail
            $status = 'fail';
        }
        //student course score
        $scores = QuizScore::where('quiz_id', $quiz->id)
            ->where('course_id', $quiz->course_id)
            ->where('content_id', $content_id)
            ->where('user_id', Auth::id())->first();
        if ($scores == null) {
            $scores = new QuizScore();
            $scores->quiz_id = $quiz->id;
            $scores->course_id = $quiz->course_id;
            $scores->content_id = $content_id;
            $scores->user_id = Auth::id();
        }
        $scores->minutes = $minutes;
        $scores->score = $point;
        $scores->wrong = $wrong;
        $scores->right = $right;
        $scores->status = $status;
        $scores->save();
        $againQuizStart = route('start.quiz', [$scores->quiz_id, $scores->content_id]);
        return \view('addon.view.quiz.questionsDone', compact('scores', 'againQuizStart'));
    }*/
	 /*quiz done*/
    public function quizDone(Request $request)
    {

        /*here the most complicated is identify $minutes*/
        $time = Carbon::now();
        $start_time = $request->session()->get('start_quiz');
        $end_time = $time->diffInMinutes($start_time);
        $request->session()->forget('start_quiz');

        $minutes = $end_time == 0 ? 1 : $end_time;
        $quiz = Quiz::where('id', $request->quiz_id)->first();;
        $content_id = $request->content_id;
        $wrong = 0;
        $point = 0;
        $right = 0;
        $status = '';
        $answer_array = array();
        foreach ($request->question as $id) {
            $qu = Question::where('id', $id)->first();

            foreach (json_decode($qu->options, true) as $ns) {
                $radio = 'answer_' . $id;
                if ($ns['index'] == $request->$radio) {
                    if ($ns['correct'] == "true") {
                        $point += $qu->grade;
                        $right = $right + 1;
                        $result = (object) ["question_id" => $id, "answer" => $request->$radio, "correct" => true];
                        array_push($answer_array,$result);
                    } else {
                        $wrong = $wrong + 1;
                        $result = (object) ["question_id" => $id, "answer" => $request->$radio, "correct" => false];
                        array_push($answer_array,$result);
                    }
                }
            }
        }
        if ($quiz->pass_mark > $point) {
            //fail
            $status = 'fail';
        } else {
            //pass
            $status = 'pass';
        }
        // if ($end_time > $quiz->minutes) {
            //fail
        //     $status = 'fail';
        // }
        /*student course score*/
        // $scores = QuizScore::where('quiz_id', $quiz->id)
        //     ->where('course_id', $quiz->course_id)
        //     ->where('content_id', $content_id)
        //     ->where('user_id', Auth::id())->first();
        // if ($scores == null) {

        // $quizEnrolled = QuizEnrollment::where('quiz_id', $quiz->id)->where('user_id', Auth::id())->where('course_id', $quiz->course_id)->orderByDesc('id')->first();
        
        // if (!$quizEnrolled) {
            $scores = new QuizScore();
            $scores->quiz_id = $quiz->id;
            $scores->course_id = $quiz->course_id;
            $scores->content_id = $content_id;
            $scores->user_id = Auth::id();
            // }
            $scores->minutes = $minutes;
            $scores->score = $point;
            $scores->wrong = $wrong;
            $scores->right = $right;
            $scores->question_answer_data = json_encode($answer_array);
            $scores->status = $status;
            $scores->save();
        // } else {
        //     $scores = QuizScore::where('quiz_id', $quiz->id)->where('course_id', $quiz->course_id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->orderByDesc('id')->first();
        // }
        $course = Course::where('id',$quiz->course_id)->first();
        $quiz = Quiz::where('course_id',$quiz->course_id)->first();
        $attempted = QuizScore::where('course_id', $quiz->course_id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->count();
        $againQuizStart = route('start.quiz', [$quiz->course_id, $content_id]);
        return \view('addon.view.quiz.questionsDone', compact('course', 'quiz', 'scores', 'againQuizStart', 'attempted'));
    }
    /*show done score */

    public function questionScoreShow($id)
    {
        $scores = QuizScore::where('id', $id)->first();
        $againQuizStart = route('start.quiz', [$scores->quiz_id, $scores->content_id]);
        return \view('addon.view.quiz.questionsDone', compact('scores', 'againQuizStart'));
    }
}
