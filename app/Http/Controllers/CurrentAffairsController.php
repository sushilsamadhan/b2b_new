<?php

namespace App\Http\Controllers;

use App\Model\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Alert;
use App\NotificationUser;
use App\Model\Classes;
use App\Model\ClassContent;

class CurrentAffairsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function userNotify($user_id,$details)
    {
        $notify = new NotificationUser();
        $notify->user_id = $user_id;
        $notify->data = $details;
        $notify->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            if (Auth::user()->user_type == "Admin") {
                $courses = Course::where('title', 'like', '%' . $request->search . '%')
                ->where('content_type','current_affairs')
                ->orWhere('tag', 'like', '%' . $request->search . '%')                    
                ->latest()->paginate(10)->withQueryString();
            } else {
                $courses = Course::where("user_id", Auth::id())
                ->where('content_type','current_affairs')
                ->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('tag', 'like', '%' . $request->search . '%')
                ->latest()->paginate(10)->withQueryString();
            }
        } else {
            if (Auth::user()->user_type == "Admin") {
                $courses = Course::where('content_type','current_affairs')->latest()->paginate(10)->withQueryString();
            } else {
                $courses = Course::where('content_type','current_affairs')->where("user_id", Auth::id())->latest()->paginate(10)->withQueryString();
            }
        }
        return view('module.current_affairs.index',compact('courses'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('module.current_affairs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:courses',
            'current_affairs_date' => 'required',
            'content_type' => 'required',
            'category_id' => 'required',
            'file_name' => 'required'
        ], [
            'title.required' => translate('Title is required'),
            'slug.unique' => translate('Slug must be unique'),
            'slug.required' => translate('Slug must be Required'),            
            'current_affairs_date.required' => translate('Date must be Required'),
            'content_type' => translate('Content type must be Required'),
            'category_id.required' => translate('You must choose a category'),
            'file_name.required' => translate('Course file is required'),
        ]);
        $courses = new Course();
        $courses->title = $request->title;
        $courses->slug = Str::slug($request->slug);
        $courses->short_description = '';
        $courses->big_description = '';
        $courses->content_type = 'current_affairs';
        $courses->image = '';
        $courses->overview_url = '';
        $courses->provider = 'HTML5';

        $tag = explode(',',$request->tag);
        $tagC = array();
        foreach ($tag as $itemt){
            array_push($tagC,$itemt);
        }
        $courses->tag = json_encode($tagC);
        $courses->is_free = $request->is_free == "on" ? true : false;
        if($request->content_type == 'free-study-material'){
            $courses->is_free = true; 
        }
        if (!$courses->is_free) {
            $courses->price = $request->price;
        }

        $courses->is_discount = $request->is_discount == "on" ? true : false;

        if ($courses->is_discount) {
            $courses->discount_price = $request->discount_price;
        }

        $courses->language = $request->language?$request->language:'English';

        $meta = explode(',',$request->meta_title);
        $metaC = array();
        foreach ($meta as $itemm){
            array_push($metaC,$itemm);
        }
        $courses->meta_title = json_encode($metaC);
        $courses->meta_description = $request->meta_description;
       
        $courses->category_id = $request->category_id;
        
        $courses->is_published = $request->is_published == "on" ? true : true;
        $courses->user_id = Auth::user()->id;
        if ($request->hasFile('file_name')) {
            $courses->file = fileUpload($request->file_name, 'current_affairs');
        }
        $courses->course_date = $request->current_affairs_date;
        $courses->save();

        

        //todo::course create notify
        $details = [
            'body' => translate($request->title . ' new course uploaded by ' . Auth::user()->name),
        ];

        
        return redirect()->route('current_affairs.list');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Request  $request)
    {
        $course = Course::find($request->course_id);
        if($request->method() == 'POST')
        {
            $request->validate([
                'title' => 'required',
                'slug' => 'required|unique:courses,slug,'.$request->course_id,
                'current_affairs_date' => 'required',
                'content_type' => 'required',
                'category_id' => 'required'
            ], [
                'title.required' => translate('Title is required'),
                'slug.unique' => translate('Slug must be unique'),
                'slug.required' => translate('Slug must be Required'),            
                'current_affairs_date.required' => translate('Date must be Required'),
                'content_type' => translate('Content type must be Required'),
                'category_id.required' => translate('You must choose a category')
            ]);
            $courses = $course;
            $courses->title = $request->title;
            $courses->slug = Str::slug($request->slug);
            $courses->short_description = '';
            $courses->big_description = '';
            $courses->content_type = 'current_affairs';
            $courses->image = '';
            $courses->overview_url = '';
            $courses->provider = 'HTML5';
    
            $tag = explode(',',$request->tag);
            $tagC = array();
            foreach ($tag as $itemt){
                array_push($tagC,$itemt);
            }
            $courses->tag = json_encode($tagC);
            $courses->is_free = $request->is_free == "on" ? true : false;
            if($request->content_type == 'free-study-material'){
                $courses->is_free = true; 
            }
            if (!$courses->is_free) {
                $courses->price = $request->price;
            }
    
            $courses->is_discount = $request->is_discount == "on" ? true : false;
    
            if ($courses->is_discount) {
                $courses->discount_price = $request->discount_price;
            }
    
            $courses->language = $request->language?$request->language:'English';
    
            $meta = explode(',',$request->meta_title);
            $metaC = array();
            foreach ($meta as $itemm){
                array_push($metaC,$itemm);
            }
            $courses->meta_title = json_encode($metaC);
            $courses->meta_description = $request->meta_description;
           
            $courses->category_id = $request->category_id;
            
            $courses->is_published = $request->is_published == "on" ? true : true;
            $courses->user_id = Auth::user()->id;
            if ($request->hasFile('file_name')) {
                $courses->file = fileUpload($request->file_name, 'current_affairs');
            }
            $courses->course_date = $request->current_affairs_date;
            $courses->save();
    
            
    
            //todo::course create notify
            $details = [
                'body' => translate($request->title . ' new course uploaded by ' . Auth::user()->name),
            ];
    
            
            return redirect()->route('current_affairs.list');
        }
        return view('module.current_affairs.edit',compact('course'));
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // return 1;  $request->all();
           Course::find($request->course_id)->delete();
            notify()->success(translate('Course deleted successfully'));
            return back();
        
    }
    //published
    public function published(Request $request)
    {

    //     if (env('DEMO') === "YES") {
    //     Alert::warning('warning', 'This is demo purpose only');
    //     return back();
    //   }

        
        $board = Board::where('id', $request->id)->first();
        if ($board->is_published == 1) {
            $board->is_published = 0;
            $board->save();
        } else {
            $board->is_published = 1;
            $board->save();
        }
        return response(['message' => translate('Board active status is changed ')], 200);
    }

    // published
}
