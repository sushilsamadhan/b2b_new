<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;

use App\Model\MindMap;
use App\Model\ClassContent;
use App\Model\Classes;
use App\Model\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\NotificationUser;

class MindMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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

    public function index($id)
    {
        //
        $mindMap = MindMap::findOrFail($id);

                
        return view('course.mindmaps.index', compact('mindMap'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       // return $id;
        $contentId = $id;

        //Course::findOrFail($id);

        
        return view('course.mindmaps.create', compact('contentId'));
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
       // return $request->all();

        $request->validate([
            'mind_map_title' => 'required',
            'sequence' => 'required',
            
        ],
            [
                'mind_map_title.required' => translate('Title is required'),
                'sequence.required' => translate('Sequence is required'),
            ]);
      
        $classId = ClassContent::where("id",$request->class_content_id)->first(); 
        $CourseId = Classes::where("id",$classId->class_id)->first();  

        if(Auth::id()) {     
            MindMap::create([
                                'mind_map_title'    => $request->mind_map_title,
                                'course_id'         => $CourseId->course_id,
                                'class_id'          => $classId->class_id,
                                'class_content_id'  => $request->class_content_id,
                                'mind_map_file_url' => $request->source_code_url,
                                'sequence'          => $request->sequence,
                                'user_id'           => Auth::id(),
                            ]);

            notify()->success(translate('Mind map saved successfully '));
            return back();
        } else {
            notify()->error(translate('Data not saved. Login has been expired'));
            return back();
        }          

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MindMap  $mindMap
     * @return \Illuminate\Http\Response
     */
    public function show(MindMap $mindMap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MindMap  $mindMap
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contentId = $id;
        $mindMap = MindMap::where('class_content_id',$contentId)->get();
        //Course::findOrFail($id);
        //$classes = Classes::where('course_id', $id)->get();
        //$mainmapList = MindMap::where('id', $mindMapId)->first();
        //$classContent = ClassContent::where("class_id",$mainmapList->class_id)->select('title','id')->get();
        

        return view('course.mindmaps.edit', compact('contentId','mindMap'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MindMap  $mindMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MindMap $mindMap)
    {
        //

        $request->validate([
            'mind_map_title' => 'required',
            'sequence' => 'required',
            
        ],
            [
                'mind_map_title.required' => translate('Title is required'),
                'sequence.required' => translate('Sequence is required'),
            ]);
      
        if(Auth::id()) {     
            MindMap::where('id','=',$request->id)->update([
                                'mind_map_title'    => $request->mind_map_title,
                                'course_id'         => $request->course_id,
                                'class_id'          => $request->class_id,
                                'class_content_id'  => $request->class_content_id,
                                'mind_map_file_url' => $request->source_code_url,
                                'sequence'          => $request->sequence,
                                'user_id'           => Auth::id(),
                            ]);
            notify()->success(translate('Mind map updated successfully'));
            return back();
        } else {
            notify()->error(translate('Data not updated. Login has been expired'));
            return back();
        }       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MindMap  $mindMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(MindMap $mindMap)
    {
        //
    }


/**
     * Get the specified resource from storage.
     *
     * @param  \App\getContentList  $id
     * @return \Illuminate\Http\Response
     */

    public function getContentList($id)
    {
        $mindMapEdit = MindMap::where("id",$id)->first();
       echo $mindMapEdit;die;
      //  return response()->json($mindMapEdit); 

    }


}
