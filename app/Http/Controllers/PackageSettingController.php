<?php

namespace App\Http\Controllers;

use App\PackageSetting;
use App\PackageAddonService;
use App\Service;
use App\Helper\Helper;

use App\Model\Category;
use App\Model\Course;

use Illuminate\Http\Request;
class PackageSettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
         $packagesettings = PackageSetting::leftjoin('categories as cat','cat.id','=','package_settings.category_id')
                                            ->leftjoin('categories as subCat','subCat.id','=','package_settings.sub_category_id')
                                            ->leftjoin('courses as c','c.id','=','package_settings.course_id')
                                            ->select('subCat.name as subCat','cat.name','c.title','package_settings.*')
                                            ->orderBy('id', 'DESC')->paginate(100);


        return view('packagesettings.index', compact('packagesettings'))
                    ->with('i',(request()->input('page', 1) - 1) * 100);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $service    = Service::where('status','=','1')->get();
        return view('packagesettings.create',compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
       // PRINT_R($request->all()); DIE;
        if($request->package_type=='board')
        {
                $rules = [
                            'pkg_name'=>'required',
                            'package_type'=>'required',
                            'category_id'=>'required',
                            'sub_category_id'=>'required',
                            'course_id'=>'required',
                            'status'=>'required',
                            'no_of_test_questions'=>'required'
                            
                            
                        ];
        }else{
            $rules = [
                'pkg_name'=>'required',
                'package_type'=>'required',
                'category_id'=>'required',
                'course_id'=>'required',
                'status'=>'required',
                'no_of_test_questions'=>'required'
            ];

        } 
                $customMessages = [
                    'required' => 'The :attribute field is required.'
                ];
        
        $this->validate($request, $rules, $customMessages);

       
            $is_all_subject = 0;
            if($request->course_id=='0')
            {
                $course_id = Course::where("category_id",$request->sub_category_id)
                                            ->where('is_free','=','0')
                                            ->selectRaw('GROUP_CONCAT(id) as course_ids')
                                            ->groupBy('category_id')
                                            ->get();
                 $free_subject = $course_id[0]->course_ids;
                 $course =  explode(',' , $free_subject);
                 $request->course_id = $course[0];
                 unset($course[0]);
                 $free_subject = implode(',',$course);
                 $is_all_subject = 1;
            }
            else
            {
                if(isset($request->free_subject)){
                    if(count($request->free_subject)>1)
                    {
                        $free_subject = implode(",",$request->free_subject);
                    }else{
                        $free_subject = $request->free_subject[0];
                    }
                }else{
                    $free_subject ='';
                } 
            }
         
           // print_r($free_subject); die;
            //$free_subject;
            // $free_subject = implode(",",$request->free_subject);
            //'pkg_image',
         
            $categoryId         = explode('-',$request->category_id);
            $category_id        = $categoryId[1];
          // $sub_category_id    = $categoryId[1];
           
         
if($request->package_type=='board'){
            $pkgsettingC =  PackageSetting::create([
                                'pkg_name'                  =>  $request->pkg_name,
                                'pkg_desc'                  =>  $request->pkg_desc,
                                'short_desc'                =>  $request->short_desc,
                                'package_type'              =>  $request->package_type,
                                'pkg_image'                 =>  $request->pkg_image,
                                'category_id'               =>  $category_id,
                                'sub_category_id'           =>  $request->sub_category_id,
                                'course_id'                 =>  $request->course_id,
                                'quarterly_course_coverage' =>  $request->quarterly_course_coverage,
                                'halfyrly_course_coverage'  =>  $request->halfyrly_course_coverage,
                                'annually_course_coverage'  =>  '100',//$request->annually_course_coverage,
                                'quarterly_coverage_price'  =>  $request->quarterly_coverage_price,
                                'halfyrly_coverage_price'   =>  $request->halfyrly_coverage_price,
                                'annually_coverage_price'   =>  $request->annually_coverage_price,
                                'default_discount'          =>  $request->default_discount,
                                'member_discount'           =>  $request->member_discount,
                                'status'                    =>  $request->status,
                                'no_of_test'                =>  $request->no_of_test,
                                'no_of_practice_test'       =>  $request->no_of_practice_test,
                                'no_of_sectional_test'      =>  $request->no_of_sectional_test,
                                'no_of_test_questions'      =>  $request->no_of_test_questions,
                                'free_subject'              =>  $free_subject,
                                'is_all_subject' => $is_all_subject,

                            ]);
                        }else{

                            $pkgsettingC =  PackageSetting::create([
                                'pkg_name'                  =>  $request->pkg_name,
                                'pkg_desc'                  =>  $request->pkg_desc,
                                'short_desc'                =>  $request->short_desc,
                                'package_type'              =>  $request->package_type,
                                'pkg_image'                 =>  $request->pkg_image,
                                'category_id'               =>  $category_id,
                                'sub_category_id'           =>  $request->sub_category_id,
                                'course_id'                 =>  $request->course_id,
                                'quarterly_course_coverage' =>  $request->quarterly_course_coverage,
                                'halfyrly_course_coverage'  =>  $request->halfyrly_course_coverage,
                                'annually_course_coverage'  =>  '100',//$request->annually_course_coverage,
                                'quarterly_coverage_price'  =>  $request->quarterly_coverage_price,
                                'halfyrly_coverage_price'   =>  $request->halfyrly_coverage_price,
                                'annually_coverage_price'   =>  $request->annually_coverage_price,
                                'default_discount'          =>  $request->default_discount,
                                'member_discount'           =>  $request->member_discount,
                                'status'                    =>  $request->status,
                                'no_of_test'                =>  $request->no_of_test,
                                'no_of_practice_test'       =>  $request->no_of_practice_test,
                                'no_of_sectional_test'      =>  $request->no_of_sectional_test,
                                'no_of_test_questions'      =>  $request->no_of_test_questions,
                                'free_subject'              =>  $free_subject,
                                'is_all_subject' => $is_all_subject,

                            ]);


                        }
                            if(isset($request->addon_service_id) && $request->addon_service_id[0]!='err')
                            {
                               
                                foreach($request->addon_service_id as $val)
                                {
                                    $splitAddonId   = explode('__',$val);
                                    $getService     = Service::where('id','=',$splitAddonId[0])
                                                            ->where('status','=','1')
                                                            ->first();
                                     
                                        PackageAddonService::create([
                                                                        'package_id'       => $pkgsettingC->id,
                                                                        'addon_service_id' => $splitAddonId[0],
                                                                        'price'            => $getService->price,
                                                                        'description'      => $getService->description,
                                                                        'status'           => $getService->status,   
                                                                    ]);
                                                   
                                }
                
                                    return redirect()->route('packagesettings.index')
                                        ->with('success', 'Package setting created successfully');
                            }else{
                                
                                    PackageAddonService::where('package_id','=',$pkgsettingC->id)->update(['status'=>'0']);
                                    return redirect()->route('packagesettings.index')
                                                    ->with('success', 'Package setting created successfully');
                            }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PackageSetting  $packageSetting
     * @return \Illuminate\Http\Response
     */

    public function show(PackageSetting $packageSetting,$id)
    {
        
        $packagesetting = PackageSetting::find($id);
        return view('packagesettings.edit', compact('packagesetting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PackageSetting  $packageSetting
     * @return \Illuminate\Http\Response
     */

    public function edit(PackageSetting $packageSetting,$id)
    {
        
        $packagesetting = PackageSetting::find($id);
        $getPackage = PackageAddonService::where('package_id','=',$id)
                                            ->where('status','=','1')
                                            ->select('addon_service_id')->get();
        $service    = Service::where('status','=','1')->get();
        if($packagesetting->package_type=='board')
        {
            if($packagesetting->course_id!='0'){
            $free_courses_detail = Course::where("category_id",'=',$packagesetting->sub_category_id)
                        ->where('id','!=',$packagesetting->course_id)
                        ->where('is_free','=','1')
                        ->where('is_demo','=','0')
                        ->select('title','id')->get();
            }else {

                $free_courses_detail = Course::where("category_id",'=',$packagesetting->sub_category_id)
                ->select('title','id')->get();
            }            
        }
        if($packagesetting->package_type=='competitive-courses')
        {
            $getId = Category::where('id','=',$packagesetting->category_id)->first();
            $free_courses_detail = Category::where('parent_category_id','=',$getId->parent_category_id)
                                                ->where('id','!=',$packagesetting->category_id)
                                                //->where('is_free','=','1')
                                                ->select('name','id')->get();
        }
        
        if(!empty($packagesetting->free_subject))
        {    
           
            $chkfree_subject = explode(',',$packagesetting->free_subject); 
            
        }
        else
        {
            $chkfree_subject = array();
        }

        $categories = array();
        switch ($packagesetting->package_type)
        {
            case 'board':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->where('is_current_affairs','0')->where('is_project_works','0')->Published()->get();
                $categories = $courses_detail;
                break;
            case 'competitive-courses':
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','1')->Published()->get();
                $categories = $courses_detail;
                break; 
            default:
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','0')->where('is_free_study','0')->Published()->get();
                $categories = $courses_detail;
                break;       
        }
        

        if($packagesetting->package_type=='board')
        {
            $subCatdetail = Category::where("parent_category_id","=",$packagesetting->category_id)
                                    ->select('name','id')
                                    ->get();
            $courses_detail = Course::where("category_id",'=',$packagesetting->sub_category_id)
                                   // ->where('is_free','=','0')
                                    ->select('title','id')->get();
        }
        else
        {
        
            $subCatdetail   = Category::where("parent_category_id","=",$packagesetting->sub_category_id)
                                    ->select('name','id')->get();
            $courses_detail = Course::where("category_id",'=',$packagesetting->sub_category_id)
                                    //->where('is_free','=','0')
                                    ->select('title','id')->get();
            
        }
        
        $demoCourse = array();
        if($packagesetting->package_type=='board') {
            $demoCourse = Course::select('title','id')->where("category_id",$packagesetting->sub_category_id)
                                ->where('is_demo','=','1')->get();                    
        }

        return view('packagesettings.edit', compact('chkfree_subject','free_courses_detail','getPackage','service',
        'packagesetting','categories','subCatdetail','courses_detail','demoCourse'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PackageSetting  $packageSetting
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, PackageSetting $packageSetting,$id)
    {
     
        if($request->package_type=='board')
        {
                $rules = [
                            'pkg_name'=>'required',
                            'package_type'=>'required',
                            'category_id'=>'required',
                            'sub_category_id'=>'required',
                            'course_id'=>'required',
                            'status'=>'required',
                            'no_of_test_questions'=>'required'
                        ];
        }else{
            $rules = [
                'pkg_name'=>'required',
                'package_type'=>'required',
                'category_id'=>'required',
                'course_id'=>'required',
                'status'=>'required',
                'no_of_test_questions'=>'required'
            ];

        } 
                $customMessages = [
                    'required' => 'The :attribute field is required.'
                ];
        
        $this->validate($request, $rules, $customMessages);

       
        $is_all_subject = 0;
        if($request->course_id=='0')
        {
            $course_id = Course::where("category_id",$request->sub_category_id)
                                        ->where('is_free','=','0')
                                        ->selectRaw('GROUP_CONCAT(id) as course_ids')
                                        ->groupBy('category_id')
                                        ->get();
             $free_subject = $course_id[0]->course_ids;
             $free_subject = $course_id[0]->course_ids;
             $course =  explode(',' , $free_subject);
             $request->course_id = $course[0];
             unset($course[0]);
             $free_subject = implode(',',$course);
             $is_all_subject = 1;
            
        }
        else
        {
            if(isset($request->free_subject)){
                if(count($request->free_subject)>1)
                {
                    $free_subject = implode(",",$request->free_subject);
                }else{
                    $free_subject = $request->free_subject[0];
                }
            }else{
                $free_subject ='';
            } 
        }
        
    if($request->package_type=='board') {


       // $categoryId         = explode('-',$request->category_id);
        //$category_id        = $categoryId[0];
        //$category_id    = $categoryId[1];
        PackageSetting::where('id','=',$id)->update([
            'pkg_name'                  =>  $request->pkg_name,
            'short_desc'                =>  $request->short_desc,
            'pkg_desc'                  =>  $request->pkg_desc,
            'package_type'              =>  $request->package_type,
            'pkg_image'                 =>  $request->pkg_image,
            'category_id'               =>  $request->category_id,
            'sub_category_id'           =>  $request->sub_category_id,
            'course_id'                 =>  $request->course_id,
            'quarterly_course_coverage' =>  $request->quarterly_course_coverage,
            'halfyrly_course_coverage'  =>  $request->halfyrly_course_coverage,
            'annually_course_coverage'  =>  '100',//$request->annually_course_coverage,
            'quarterly_coverage_price'  =>  $request->quarterly_coverage_price,
            'halfyrly_coverage_price'   =>  $request->halfyrly_coverage_price,
            'annually_coverage_price'   =>  $request->annually_coverage_price,
            'default_discount'          =>  $request->default_discount,
            'member_discount'           =>  $request->member_discount,
            'status'                    =>  $request->status, 
            'no_of_test'                =>  $request->no_of_test,
            'no_of_practice_test'       =>  $request->no_of_practice_test,
            'no_of_sectional_test'      =>  $request->no_of_sectional_test,
            'no_of_test_questions'      =>  $request->no_of_test_questions,
            'free_subject'              =>  $free_subject,
            'is_all_subject'            => $is_all_subject,
            'demo_course_id'            =>  $request->demo_course_id,
        ]);

    }else{


        $categoryId         = explode('-',$request->category_id);
        $category_id        = $categoryId[0];
        $sub_category_id    = $categoryId[1];

        PackageSetting::where('id','=',$id)->update([
            'pkg_name'                  =>  $request->pkg_name,
            'short_desc'                =>  $request->short_desc,
            'pkg_desc'                  =>  $request->pkg_desc,
            'package_type'              =>  $request->package_type,
            'pkg_image'                 =>  $request->pkg_image,
            'category_id'               =>  $category_id,
            'sub_category_id'           =>  $sub_category_id,
            'course_id'                 =>  $request->course_id,
            'quarterly_course_coverage' =>  $request->quarterly_course_coverage,
            'halfyrly_course_coverage'  =>  $request->halfyrly_course_coverage,
            'annually_course_coverage'  =>  '100',//$request->annually_course_coverage,
            'quarterly_coverage_price'  =>  $request->quarterly_coverage_price,
            'halfyrly_coverage_price'   =>  $request->halfyrly_coverage_price,
            'annually_coverage_price'   =>  $request->annually_coverage_price,
            'default_discount'          =>  $request->default_discount,
            'member_discount'           =>  $request->member_discount,
            'status'                    =>  $request->status, 
            'no_of_test'                =>  $request->no_of_test,
            'no_of_practice_test'       =>  $request->no_of_practice_test,
            'no_of_sectional_test'      =>  $request->no_of_sectional_test,
            'no_of_test_questions'      =>  $request->no_of_test_questions,
            'free_subject'              =>  $free_subject,
            'is_all_subject'     => $is_all_subject
        ]);

    }
               
            
            if(isset($request->addon_service_id) && $request->addon_service_id[0]!='err')
            {
               
                $i=0;

                PackageAddonService::where('package_id','=',$id)
                ->update([
                           'status'           => '0',  
                        ]);

                foreach($request->addon_service_id as $val)
                {
                    $splitAddonId = explode('__',$val);
                    $getService = Service::where('id','=',$splitAddonId[0])
                                            ->where('status','=','1')
                                            ->first();
                  
                    $getPackage = PackageAddonService::where('package_id','=',$id)
                                                        ->where('addon_service_id','=',$splitAddonId[0])
                                                        ->where('status','=','1')
                                                        ->first();
                    
                    if(isset($getPackage))
                    {
                       
                        PackageAddonService::where('id','=',$getPackage->id)
                                            ->update([
                                                    'package_id'       => $id,
                                                    'addon_service_id' => $splitAddonId[0],
                                                    'price'            => $getService->price,
                                                    'description'      => $getService->description,
                                                    'status'           => $getService->status,  
                                                    ]);
                    }
                    else
                    {
                      
                        PackageAddonService::create([
                                                        'package_id'       => $id,
                                                        'addon_service_id' => $splitAddonId[0],
                                                        'price'            => $getService->price,
                                                        'description'      => $getService->description,
                                                        'status'           => $getService->status,   
                                                    ]);
                    }

                  

                }

                    return redirect()->route('packagesettings.index')
                        ->with('success', 'Package setting updated successfully');
            }else{
                
                    PackageAddonService::where('package_id','=',$id)->update(['status'=>'0']);
                    return redirect()->route('packagesettings.index')
                                    ->with('success', 'Package setting updated successfully');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PackageSetting  $packageSetting
     * @return \Illuminate\Http\Response
     */

    public function destroy(PackageSetting $packageSetting,$id)
    {
       
        $PackageSetting = PackageSetting::where('id','=',$id)->first();
        $PackageSetting->delete();
        
        return redirect()->route('packagesettings.index')
                         ->with('success', 'Package setting deleted successfully !');
    }
    /**
     * Get the specified resource from storage.
     *
     * @param  \App\categoriesById  $id
     * @return \Illuminate\Http\Response
     */

    public function categoriesById($id)
    {
        $courses_detail = Category::where("parent_category_id",$id)
                                    ->where('is_published','1')
                                    ->pluck('name','id');
        return response()->json($courses_detail); 
    }


/**
     * Get the specified resource from storage.
     *
     * @param  \App\categoriesByCourseId  $id
     * @return \Illuminate\Http\Response
     */

    public function categoriesByQuestionCourseId($id)
    {
        $courses_detail = Course::where("category_id",$id)
                ->where('is_demo','=','0')
                ->pluck('title','id');
        return response()->json($courses_detail); 

    }


    /**
     * Get the specified resource from storage.
     *
     * @param  \App\categoriesByCourseId  $id
     * @return \Illuminate\Http\Response
     */

    public function categoriesByCourseId($id)
    {
        $courses_detail = Course::where("category_id",$id)
        ->where('is_free','=','0')
                ->pluck('title','id');
        return response()->json($courses_detail); 

    }
//categoriesByCourseId
   public function categoriesByFreeCourseId($id)
    {
        $splitId = explode('_',$id);

        $courses_detail = Course::where("category_id",'=',$splitId[0])
                                ->where('id','!=',$splitId[1])
                                ->where('is_demo','=','0')
                                ->pluck('title','id');

       // print_r($courses_detail);die;
        return response()->json($courses_detail); 

    }

    public function categoriesByCourseParentType($parentCatId)
    {
       // $getId = Category::where('id','=',$parentCatId)->first(); $getId->parent_category_id

        $courses_detail = Category::where('parent_category_id','=',$parentCatId)
                                        ->pluck('name','id');
        return response()->json($courses_detail);
               
    }

/*

    public function categoriesByCourseType(Request $request)
    {
        
                $courses_detail = Category::where('parent_category_id', 0)->where('is_item','0')->with('child')->where('is_compitative','1')->Published()->get();
                $courses = $courses_detail;
               
    }*/

}
