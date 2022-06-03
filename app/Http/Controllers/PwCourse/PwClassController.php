<?php

namespace App\Http\Controllers\PwCourse;

use App\Http\Controllers\Controller;
use App\Model\PwClasses;
use App\Model\PwCourse;
use App\Model\PwEnrollment;
use App\NotificationUser;

use App\User;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PwClassController extends Controller
{

    function userNotify($user_id,$details)
    {
        $notify = new NotificationUser();
        $notify->user_id = $user_id;
        $notify->data = $details;
        $notify->save();
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    //this function is insert course
    public function create($id)
    {
        /*Check the id is valid*/
        PwCourse::findOrFail($id);
        return view('pwcourse.classes.create', compact('id'));
    }

    //this function is redirect to edit course
    public function edit($id)
    {
        /*Check the id is valid*/
        $each_class = PwClasses::findOrFail($id);
      //  echo '<pre>';print_r($each_class); 
      //  echo '<br>sadasda'.$each_class->title;
      //  die;
        return view('pwcourse.classes.edit', compact('id', 'each_class'));
    }

    //this function is store the class title or name
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
        $request->validate([
            'title' => 'required',
        ],
        [
            'title.required' => translate('Title is required'),
        ]);

        $pwclass = new PwClasses();
        $pwclass->title = $request->title;
        $pwclass->course_id = $request->projetc_work_id;
        $pwclass->unit = $request->unit;
        $pwclass->priority = $request->sequence??'0';
        $pwclass->save();

        //todo:class create notify
        $details = [
            'body' => translate($pwclass->title . ' new class uploaded by ' . Auth::user()->name),
        ];

        //get all enroll student
        $enroll = PwEnrollment::where('project_work_id', $request->projetc_work_id)->with('user')->get();

        /* sending instructor notification */
        $this->userNotify(Auth::user()->id,$details);

        notify()->success(translate('Class created successfully'));
        return back();
    }

    //this function is update the class title or name
    public function update(Request $request)
    {
        if (env('DEMO') === "YES") {

        Alert::warning('warning', 'This is demo purpose only');

        return back();
      }

        $request->validate([
            'title' => 'required',
        ],
        [
            'title.required' => 'Title is required',
        ]);

        PwClasses::findOrFail($request->project_work_id)->update([
            'title' => $request->title,
            'unit' => $request->unit,
            'priority' => $request->sequence??'0'
        ]);

        notify()->success(translate('Class updated successfully'));

        return back();
    }

    // this function is delete or trash the class
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        PwClasses::findOrFail($id)->delete();

        notify()->success(translate('Class deleted successfully'));
        return back();
    }

    //END
}
