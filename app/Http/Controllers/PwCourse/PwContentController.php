<?php

namespace App\Http\Controllers\PwCourse;

use App\Http\Controllers\Controller;
use App\Model\PwClassContent;
use App\Model\PwClasses;
use App\Model\PwCourse;
use App\Model\PwEnrollment;
use App\Quiz;
use App\User;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\NotificationUser;


class PwContentController extends Controller
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

    /*content create*/
  public function create($id)
    {
        // /Check the id is valid/

        $course_id = $id;
        PwCourse::findOrFail($id);
        $classes = PwClasses::where('course_id', $id)->get();
        // $quizes = collect();
        // if (quizActive()){
        //     $q =Quiz::where('status',1)->where('user_id',Auth::id())->where('course_id',$id)->get();
        //     foreach ($q as $i){
        //         if($i->questions->count() > 0){
        //             $quizes->push($i);
        //         }
        //     }
        // }
        // return view('pwcourse.contents.create', compact('classes','course_id','quizes'));  
        return view('pwcourse.contents.create', compact('classes','course_id'));
    }

    //this function is store the content
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'title' => 'required',
            'content_type' => 'required',
        ],
            [
                'title.required' => translate('Title is required'),
                'content_type.required' => translate('Content type is required'),
            ]);

        /*
        |--------------------------------------------------------------------------
        | storing value
        |--------------------------------------------------------------------------
        */

        $content = new PwClassContent();
        $content->title = $request->title;
        $content->content_type = $request->content_type;
        $content->provider = $request->provider;
        $content->user_id = Auth::id(); 

    /*    if(quizActive() && $request->quiz_id != null){
            $content->quiz_id = $request->quiz_id;
            $content->provider = $request->content_type;
        }
*/
        if ($request->hasFile('video_url')) {
            $content->video_url = fileUpload($request->video_url, 'class_contents_files');
        }else{
            $content->video_url = $request->video_url ?? $request->video_raw_url;
        }

        // if (zoomActive() && $request->meeting_id != null) {
        //     $content->meeting_id = $request->meeting_id;
        // }

      //  $content->description = $request->description;
        $content->is_preview =  false;
        $content->class_id = $request->class_id;
        if ($request->hasFile('file')) {
            $content->file = fileUpload($request->file, 'class_contents');
        }

        if ($request->hasFile('source_code')) {
            $content->source_code = fileUpload($request->source_code, 'class_source_codes');
        }else{
            $content->source_code = $request->source_code_url;
        }

        $content->duration = $request->duration;
        /*save priority*/
        $contentSort = PwClassContent::where('class_id',$request->class_id)->count();
        $content->priority = $contentSort+1;

         //Demo
         $content->demo_type = $request->demo_type;
         $content->demo_url = $request->demo_url;
         $content->demo_duration = $request->demo_duration;
         //-----
        $content->save();

        $details = [
            'body' => translate($content->title . ' new content uploaded by ' . Auth::user()->name),
        ];
        //get course id
        $class = PwClasses::where('id', $content->class_id)->firstOrFail();
        //get all enroll student
        //$enroll = PwEnrollment::where('project_work_class_id', $class->course_id)->with('user')->get();



        /* sending instructor notification */
        $notify = $this->userNotify(Auth::user()->id,$details);

        notify()->success(translate('Class content saved successfully '));
        return back();

    }

    /*
    |--------------------------------------------------------------------------
    | this function is destroy or trash the content
    |--------------------------------------------------------------------------
    */

    /*Delete the content*/
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $ClassContent = PwClassContent::find($id);
        $ClassContent->delete();

        notify()->success(translate('Class content deleted successfully '));
        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | this function is showing content
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        /*Check the id is valid*/
        $each_contents = PwClassContent::findOrFail($id);
        return view('pwcourse.contents.show', compact('id', 'each_contents'));
    }

/*
    |--------------------------------------------------------------------------
    | this function is updating content Title
    |--------------------------------------------------------------------------
    */

    public function updateTitle(Request $request){

        PwClassContent::where('id','=',$request->contentId)
                                ->update([
                                        'title' => $request->title,  
                                    ]);
         return response()->json("Update Successfully.");
        //contentId,title
    }
    /*
    |--------------------------------------------------------------------------
    | this function is updating content
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $i = 1;
        $s = json_encode($request->order);
        foreach (json_decode($s) as $content) {
            $c = PwClassContent::findOrFail((int)$content->id);
            $c->priority = (int)$content->position;
            $c->save();
            $i++;
        }
        return response(translate('Updated successfully'), 200);
    }

    /*
    |--------------------------------------------------------------------------
    | this function that download content source code
    |--------------------------------------------------------------------------
    */

    public function code($id)
    {
        try {
            $source_code = PwClassContent::findOrFail($id)->source_code;
            $path = public_path($source_code);
            return response()->download($path);
        } catch (\Throwable $th) {
            notify()->warning(translate('No Source Code Found'));
            return back();
        }

    }

    //published
    public function published(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        // don't use this type of variable naming, use $category instead of $cat1
        $content = PwClassContent::where('id', $request->id)->first();
        if ($content->is_published == 1) {
            $content->is_published = 0;
            $content->save();
        } else {
            $content->is_published = 1;
            $content->save();
        }

        return response(['message' => translate('Class content active status is changed')], 200);
    }

    //preview
    public function preview(Request $request)
    {
        // don't use this type of variable naming, use $category instead of $cat1
        $content = PwClassContent::where('id', $request->id)->first();
        if ($content->is_preview == 1) {
            $content->is_preview = 0;
            $content->save();
        } else {
            $content->is_preview = 1;
            $content->save();
        }
        return response(['message' => translate('Class content preview status is changed')], 200);
    }


  /*content Edit*/
  public function edit($contentId,$id)
    {

        $course_id = $id;
        PwCourse::findOrFail($id);
        $classes = PwClasses::where('course_id', $id)->get();
        $content = PwClassContent::where('id', $contentId)->first();
        // $quizes = collect();
        // if (quizActive()){
        //     $q =Quiz::where('status',1)->where('user_id',Auth::id())->where('course_id',$id)->get();
        //     foreach ($q as $i){
        //         if($i->questions->count() > 0){
        //             $quizes->push($i);
        //         }
        //     }
        // }
        //  return view('course.contents.edit', compact('content','classes','course_id','quizes'));    
        return view('pwcourse.contents.edit', compact('content','classes','course_id'));
    }

//Edit Update

 //this function is store the content
 public function contentUpdate(Request $request)
 {

   // return $request->all();
     if (env('DEMO') === "YES") {
     Alert::warning('warning', 'This is demo purpose only');
     return back();
   }

     /*
     |--------------------------------------------------------------------------
     | Validation
     |--------------------------------------------------------------------------
     */

     $request->validate([
         'title' => 'required',
         'content_type' => 'required',
     ],
         [
             'title.required' => translate('Title is required'),
             'content_type.required' => translate('Content type is required'),
         ]);

     /*
     |--------------------------------------------------------------------------
     | storing value
     |--------------------------------------------------------------------------
     */

     $content = PwClassContent::findOrFail((int)$request->id);
     $content->title = $request->title;
     $content->content_type = $request->content_type;
     $content->provider = $request->provider;
     $content->user_id = Auth::id(); 
     
  /*   if(quizActive() && $request->quiz_id != null){
         $content->quiz_id = $request->quiz_id;
         $content->provider = $request->content_type;
     }
*/
     if ($request->hasFile('video_url')) {
         $content->video_url = fileUpload($request->video_url, 'class_contents_files');
     }else{
         $content->video_url = $request->video_url ?? $request->video_raw_url;
     }

    //  if (zoomActive() && $request->meeting_id != null) {
    //      $content->meeting_id = $request->meeting_id;
    //  }

  //   $content->description = $request->description;
     $content->is_preview =  false;
     $content->class_id = $request->class_id;
     if ($request->hasFile('file')) {
         $content->file = fileUpload($request->file, 'class_contents');
     }

    //  if ($request->hasFile('source_code')) {
    //      $content->source_code = fileUpload($request->source_code, 'class_source_codes');
    //  }else{
    //      $content->source_code = $request->source_code_url;
    //  }

     $content->duration = $request->duration;
     /*save priority*/
     $contentSort = PwClassContent::where('class_id',$request->class_id)->count();
     $content->priority = $contentSort+1;

     //Demo
         $content->demo_type = $request->demo_type;
         $content->demo_url = $request->demo_url;
         $content->demo_duration = $request->demo_duration;

     //-----
     $content->save();

     $details = [
         'body' => translate($content->title . ' new content uploaded by ' . Auth::user()->name),
     ];
     //get course id
     $class = PwClasses::where('id', $content->class_id)->firstOrFail();
     //get all enroll student
     $enroll = PwEnrollment::where('project_work_id', $class->course_id)->with('user')->get();



     /* sending instructor notification */
     $notify = $this->userNotify(Auth::user()->id,$details);

     notify()->success(translate('Class content updated successfully '));
     return back();

 }





    //END
}
