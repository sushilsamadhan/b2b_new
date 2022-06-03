<?php

namespace App\Http\Controllers;

use App\PackageSetting;
use App\PackageAddonService;
use App\Service;
use App\Helper\Helper;

use App\Model\Category;
use App\Model\Course;

use Illuminate\Http\Request;

class PackageTestController extends Controller
{

    public function createPackages(Request $request)
    {
       //,'competitive-courses'
        $courses = Course::Published()->where(['is_free'=>'0'])->whereIn('content_type',['board'])->get();
        $totalPackage = 0;
        foreach($courses as $course)
        {
            $pkg_name = $course->title;
            $package_type = $course->content_type;
            $category_id = null;
            $sub_category_id = null;
            $free_subject = '';
            if($package_type=='board'){
                $category = Category::where('id',$course->category_id)->first();
                $category_id = $category->parent_category_id;
                $sub_category_id = $category->id;
            }
            $course_id = $course->id;
            $status = 1;


            $pkgsettingC =  PackageSetting::create([
                'pkg_name'                  =>  $pkg_name,
                'pkg_desc'                  =>  null,
                'short_desc'                =>  '',
                'package_type'              =>  $package_type,
                'pkg_image'                 =>  $course->image,
                'category_id'               =>  $category_id,
                'sub_category_id'           =>  $sub_category_id,
                'course_id'                 =>  $course_id,
                'quarterly_course_coverage' =>  '30',
                'halfyrly_course_coverage'  =>  '65',
                'annually_course_coverage'  =>  '100', //$request->annually_course_coverage,
                'quarterly_coverage_price'  =>  '100',
                'halfyrly_coverage_price'   =>  '180',
                'annually_coverage_price'   =>  '250',
                'default_discount'          =>  '0',
                'member_discount'           =>  '0',
                'status'                    =>  1,
                'no_of_test'                =>  10,
                'free_subject'              =>  '',
            ]);
           // echo $pkg_name; exit;
            //echo $pkg_name."-----".$package_type."--------".$category_id.'-----'.$sub_category_id.'-----'.$course_id.'----'.$free_subject;
            //echo "<br>";
            //echo "<pre>";print_r($course);

            $totalPackage++;
            
        }
        echo 'Total Package created are '.$totalPackage;
        exit;
        
    }

 /**
     * Cron for Competitive One Time.
     *
     * @param  \App\PackageSetting  createCompetitivePackage()
     * @return \Illuminate\Http\Response
     */

    public function createCompetitivePackage(Request $request)
    {
       //,'competitive-courses' is_compitative
        //$courses = Course::Published()->where(['is_free'=>'0'])->whereIn('content_type',['board'])->get();
       $courses = Course::Published()->where(['is_free'=>'0'])->whereIn('content_type',['competitive-courses'])->get();

        $totalPackage = 0;
        foreach($courses as $course)
        {
            $pkg_name           = $course->title;
            $package_type       = $course->content_type;
            $category_id        = null;
            $sub_category_id    = null;
            $free_subject       = '';

            if($package_type=='competitive-courses')
            {
                $category           = Category::where('id',$course->category_id)->first();
                $category_id        = $category->parent_category_id;
                $sub_category_id    = $category->id;
            }
            
            $course_id              = $course->id;
            $status                 = 1;


            $pkgsettingC =  PackageSetting::create([
                                                    'pkg_name'                  =>  $pkg_name,
                                                    'pkg_desc'                  =>  null,
                                                    'short_desc'                =>  '',
                                                    'package_type'              =>  $package_type,
                                                    'pkg_image'                 =>  $course->image,
                                                    'category_id'               =>  $category_id,
                                                    'sub_category_id'           =>  $sub_category_id,
                                                    'course_id'                 =>  $course_id,
                                                    'quarterly_course_coverage' =>  '30',
                                                    'halfyrly_course_coverage'  =>  '65',
                                                    'annually_course_coverage'  =>  '100', //$request->annually_course_coverage,
                                                    'quarterly_coverage_price'  =>  '100',
                                                    'halfyrly_coverage_price'   =>  '180',
                                                    'annually_coverage_price'   =>  '250',
                                                    'default_discount'          =>  '0',
                                                    'member_discount'           =>  '0',
                                                    'status'                    =>  1,
                                                    'no_of_test'                =>  10,
                                                    'free_subject'              =>  '',
                                                ]);
           
            $totalPackage++;
            
        }
        echo 'Total Competitive Package created are '.$totalPackage;
        exit;
        
    }

}
