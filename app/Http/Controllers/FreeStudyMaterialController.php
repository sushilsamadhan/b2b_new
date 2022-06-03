<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Alert;
use App\FreeStudyMaterial;

class FreeStudyMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(Request $request)
    {
        $freeStudyMaterial = null;
        if ($request->get('search')) {
            $search = $request->search;
            $freeStudyMaterial = FreeStudyMaterial::where('name', 'like', '%' . $search . '%')
                ->with('parent')
                ->paginate(10);
        } else {
            $freeStudyMaterial = FreeStudyMaterial::with('parent')->paginate(10);
        }
        return view('free-study-material.index', compact('freeStudyMaterial'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
        public function create()
        {
            $categories = FreeStudyMaterial::published()->where('parent_category_id', 0)->get();
            return view('free-study-material.create', compact('categories'));
        }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => translate('Category name is required')
        ]);
        $category = new FreeStudyMaterial();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_category_id = $request->parent_category_id ?? 0;

        //store the icon
        if ($request->has('icon')) {
            $category->icon = $request->icon;
        }
        $category->save();
        notify()->success(translate('Free study Material created successfully'));
        return back();
    }

    //edit category model
    public function edit($id)
    {
        $category = FreeStudyMaterial::findOrFail($id);
        $categories = FreeStudyMaterial::published()
            ->where('parent_category_id', 0)
            ->get();
        return view('free-study-material.edit', compact('category', 'categories'));
    }

    //update the category
    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => translate('Category name is required')
        ]);


        $update_category = FreeStudyMaterial::where('id', $request->id)->first();
        $update_category->name = $request->name;
        $update_category->slug = Str::slug($update_category->name) . $update_category->id;
        $update_category->parent_category_id = $request->parent_category_id ?? 0;
        $update_category->icon = $request->icon;
        $update_category->save();

        notify()->success(translate('Study Material updated successfully'));
        return back();
    }

    //soft delete the category
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

      //  $course = Course::where('category_id', $id)->count();
       // if ($course <= 0) {
        FreeStudyMaterial::where('id', $id)->delete();
            notify()->success(translate('study Material  deleted successfully'));
            return back();
        // } else {
        //     notify()->info(translate('This category already in used.'));
        //     return back();
        // }

    }

    //published
    public function published(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // don't use this type of variable naming, use $category instead of $cat1
        $cat = FreeStudyMaterial::where('id', $request->id)->first();
        if ($cat->is_published == 1) {
            $cat->is_published = 0;
            $cat->save();
        } else {
            $cat->is_published = 1;
            $cat->save();
        }
        return response(['message' => translate('Category active status is changed ')], 200);
    }

    // published
    public function popular(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // don't use this type of variable naming, use $category instead of $cat1
        $cat = FreeStudyMaterial::where('id', $request->id)->first();
        if ($cat->is_popular == 1) {
            $cat->is_popular = 0;
            $cat->save();
        } else {
            $cat->is_popular = 1;
            $cat->save();
        }
        return response(['message' => translate('Study Material popular status is changed')], 200);
    }

    // published
    public function top(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // don't use this type of variable naming, use $category instead of $cat1
        $cat = FreeStudyMaterial::where('id', $request->id)->first();
        if ($cat->top == 1) {
            $cat->top = 0;
            $cat->save();
        } else {
            $cat->top = 1;
            $cat->save();
        }
        return response(['message' => translate('Category top status is changed')], 200);
    }
    
    public function compitative(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // don't use this type of variable naming, use $category instead of $cat1
        $cat = FreeStudyMaterial::where('id', $request->id)->first();
        if ($cat->is_compitative == 1) {
            $cat->is_compitative = 0;
            $cat->save();
        } else {
            $cat->is_compitative = 1;
            $cat->save();
        }
        return response(['message' => translate('Study Material compitative status is changed')], 200);
    }

}
