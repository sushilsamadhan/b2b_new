<?php

namespace App\Http\Controllers;

use App\Model\PwCategory;
use App\Model\PwClasses;
//use App\Helper\Helper;
use Illuminate\Http\Request;
use Alert;


class ProjectWorkCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * project_work_classes	
     */
    public function index()
    {     
        $projectworkcat = PwCategory::select('*')->where('parent_category_id','=','0')
                    ->orderBy('category_name', 'ASC')
                    ->paginate(50);
        return view('projectworkcat.index', compact('projectworkcat'))
        ->with('i',(request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategory     = PwCategory::where('parent_category_id','0')->where('status','1')->get();
        return view('projectworkcat.create',compact('parentCategory'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'parent_category_id'=>'required',
            'category_name'=>'required',
            'status'=>'required',
            
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules, $customMessages);

        $slug = strtolower(str_replace(" ", "-", trim($request->category_name)));

    // check slug is unique
        $slugUnique = checkColumnIsUnique('slug', $slug, $id=NULL);

        if($slugUnique) {
            Alert::warning('warning', 'Slug should be unique.');
            return back();
        } else {
            $pwcategory = new PwCategory();
            $pwcategory->parent_category_id = $request->parent_category_id;
            $pwcategory->category_name = $request->category_name;
            $pwcategory->slug = $slug; 
            $pwcategory->status = $request->status;
            $pwcategory->save();               
            
            return redirect()->route('projectworkcat.index')
            ->with('success', 'Project Work Category created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectWorkCategory  $projectWorkCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PwCategory $projectWorkCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectWorkCategory  $projectWorkCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PwCategory $projectWorkCategory,$id)
    {
        $projectworkcat     = PwCategory::where('id',$id)->first();
        $projectworkclass   = PwClasses::get();
        $parentCategory     = PwCategory::where('id', $projectworkcat->parent_category_id)
                                ->where('parent_category_id','0')->first();
        return view('projectworkcat.edit', compact('projectworkcat','projectworkclass','parentCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectWorkCategory  $projectWorkCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PwCategory $projectWorkCategory)
    {
         $rules = [
            'parent_category_id'=>'required',
        //    'project_work_class_id'=>'required',
            'category_name'=>'required',
            'status'=>'required',
            
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules, $customMessages);

        $slug = strtolower(str_replace(" ", "-", trim($request->category_name)));

        $slugUnique = checkColumnIsUnique('slug', $slug, $request->id);

        if($slugUnique) {
            Alert::warning('warning', 'Slug should be unique.');
            return back();
        } else { 
            $pwcategory = PwCategory::where('id', $request->id)->firstOrFail();
            $pwcategory->category_name = $request->category_name;
            $pwcategory->slug = $slug; 
            $pwcategory->status = $request->status;
            $pwcategory->save(); 

            return redirect()->route('projectworkcat.index')
            ->with('success', 'Project Work Category updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectWorkCategory  $projectWorkCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PwCategory $projectWorkCategory,$id)
    {
        $projectWorkCat = PwCategory::where('id','=',$id)->first();
        $projectWorkCat->delete();
        
        return redirect()->route('projectworkcat.index')
                         ->with('success', 'Project Work Category deleted successfully!');
    }


    public function getProjectCat($id)
    {
        $projectWorkCat = PwCategory::where('parent_category_id',0)->where('project_work_class_id','=',$id)
                                        ->pluck('category_name','id');
        return response()->json($projectWorkCat);
    }
}
