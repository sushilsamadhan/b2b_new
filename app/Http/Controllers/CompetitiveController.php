<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PackageSetting;
use App\PackageAddonService;
use App\Model\Category;
use App\Model\Course;
use DB;

class CompetitiveController extends Controller
{
    //
    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
    }
    public function index(Request $request)
    {
        $breadcrumb = null;
        //check the category in parent for chide
        $cat = Category::where('slug', $request->slug)->first();
// if(!\App\Category_permission::select('category_id')->where('school_id', \Session::get('school_id'))->where('type', 'category')->where('category_id', $cat->id)->exists()){
//     return redirect('/')->with('msgpermisiondenie', 'The Message');
// }
        $catId = array();
        $catId = array_merge($catId, [$cat->id]);
        $boardClasses = Category::Published()->where('parent_category_id', $cat->id)->get();
        $packageDataBoards = \App\PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
        ->join('categories as subCat','subCat.id','=','package_settings.sub_category_id')
        ->leftjoin('courses as c','c.id','=','package_settings.course_id')
        ->select('package_settings.*','Cat.name as catName','subCat.name as subName','c.title')
        ->where(['package_settings.category_id'=>$cat->id]);
        if(isset($request->classes) && $request->classes!='')
        {
            $packageDataBoards = $packageDataBoards->where('package_settings.sub_category_id',$request->classes);
        }
        $packageDataBoards = $packageDataBoards->orderBy('id', 'DESC')->paginate(24);

        $pageMeta['meta_title'] = $cat->meta_title;
        $pageMeta['meta_description'] = $cat->meta_description;
        $pageMeta['tag'] = $cat->tag;

        return view($this->theme.'.course.competitive.competitive_curriculum',compact('packageDataBoards','cat','boardClasses','pageMeta'));

    }
}
