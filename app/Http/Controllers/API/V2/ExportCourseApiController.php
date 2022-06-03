<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Course;
use App\Model\Classes;
use App\Model\ClassContent;
use Illuminate\Http\Request;

class ExportCourseApiController extends Controller
{
    // Import Data using Slug 
    function exportCourses(Request $request) {
        if($request->key!='' && $request->key =='IIDCO-9999') {
            if($request->category_slug!='') {
                 $iid_courses = json_decode(file_get_contents("https://olexpert.org.in/api/import-courses/".$request['category_slug']."/".$request['key']));

                if($iid_courses->status == 200) {
                    $cat = Category::where('slug', $request['category_slug'])->first();
                    if($cat){
                        $total_ins_courses  = 0;
                        $total_ins_classes  = 0;
                        $total_ins_contents = 0;

                        $total_upd_courses  = 0;
                        $total_upd_classes  = 0;
                        $total_upd_contents = 0;
                        $cat_slug           = $request['category_slug'];

                        if($cat_slug == 'professional-courses' || $cat_slug == 'technical-courses' || $cat_slug == 'language-courses') {
                            $content_type   =   'college-courses';
                        } else if($cat_slug == 'industrial-courses') {
                            $content_type   =   'industrial-courses';
                        } else {
                            $content_type   = NULL;
                        }

                        foreach($iid_courses->courses as $data) {
                            $coursesData = Course::where('ole_refference_id', $data->id)->first();

                            if($coursesData) {
                                $courses = $coursesData;
                                $total_upd_courses++;
                            } else {
                                $courses = new Course();
                                $total_ins_courses++;
                            }

                            $courses->ole_refference_id = $data->id;
                            $courses->lms_refference_id = $data->lms_refference_id;
                            $courses->title             = $data->title;
                            $courses->slug              = $data->slug;
                            $courses->level             = $data->level;
                            $courses->rating            = $data->rating;
                            $courses->min_course_time   =  $data->min_course_time;
                            $courses->is_certificate_download = $data->is_certificate_download;
                            $courses->big_description   = $data->big_description;
                            $courses->image             = $data->image;
                            $courses->overview_url      = $data->overview_url;
                            $courses->provider          = $data->provider;
                            $courses->requirement       = $data->requirement;
                            $courses->outcome           = $data->outcome;
                            $courses->tag               = $data->tag;
                            $courses->is_free           = $data->is_free;
                            $courses->price             = $data->price;
                            $courses->is_discount       = $data->is_discount;
                            $courses->discount_price    = $data->discount_price;
                            $courses->language          = $data->language;
                            $courses->meta_title        = $data->meta_title;
                            $courses->meta_description  = $data->meta_description;
                            $courses->is_published      = $data->is_published;
                            $courses->user_id           = 5;
			                $courses->content_type      = $content_type;
                            $courses->category_id       = $cat->id;
                            $courses->iid_sector_id     = $data->iid_sector_id;
                            $courses->iid_industry_id   = $data->iid_industry_id;
                            $courses->contains_industry = $data->contains_industry;

                           $courses->save();

                            // for classes    
                            if($courses->id){
                                foreach($data->classes as $value) {                                
                                    $classData = Classes::where('ole_reff_class_id', $value->id)->first();

                                    if($classData) {
                                        $class = $classData;
                                        $total_upd_classes++;
                                    } else {
                                        $class = new Classes();
                                        $total_ins_classes++;
                                    }

                                    $class->ole_reff_class_id   = $value->id;
                                    $class->lms_reff_class_id   = $value->lms_reff_class_id;
                                    $class->title               = $value->title;
                                    $class->course_id           = $courses->id;
                                    $class->priority            = $value->priority;
                                    $class->is_published        = $value->is_published;
                                    $class->save();

                            // for class contents        
                                    if($class->id && is_array($value->contents)) {
                                        foreach($value->contents as $item) {
                                            $contentData = ClassContent::where('ole_reff_content_id', $item->id)->first();

                                            if($contentData) {
                                                $content = $contentData;
                                                $total_upd_contents++;
                                            } else{
                                                $content = new ClassContent();
                                                $total_ins_contents++;
                                            }

                                            $content->ole_reff_content_id   = $item->id;
                                            $content->lms_reff_content_id   = $item->lms_reff_content_id;
                                            $content->title                 = $item->title;
                                            $content->content_type          = $item->content_type;
                                            $content->provider              = $item->provider;
                                            $content->video_url             = $item->video_url;
                                            $content->description           = $item->description;
                                            $content->is_preview            =  false;
                                            $content->class_id              = $class->id;
                                            $content->file                  = $item->file;
                                            $content->demo_type             = $item->demo_type;
                                            $content->demo_url              = $item->demo_url;
                                            $content->demo_duration         = $item->demo_duration;
                                            $content->source_code           = $item->source_code;
                                            $content->duration              = $item->duration;
                                            $content->priority              = $item->priority;
                                            $content->user_id               = 5;
                                            $content->save();
                                        } 
                                    }
                                }
                            }
                        }
                        echo "=================================================================<br>";
                        echo "Log Summary :<br>";
                        echo "<br>================================================================<br>";
                        echo "Total Courses Inserted : ".$total_ins_courses;
                        echo "<br>Total Classes Inserted : ".$total_ins_classes;
                        echo "<br>Total Class Contents Inserted : ".$total_ins_contents;

                        echo "<br>================================================================<br>";
                        echo "Total Courses Updated : ".$total_upd_courses;
                        echo "<br>Total Classes Updated : ".$total_upd_classes;
                        echo "<br>Total Class Contents Updated : ".$total_upd_contents;
                    } else {
                        echo "Category not found.";
                    }
                }else{
                    echo "No Course Found";
                }
            }
        } else{
            echo 'Authentication Failed! Invalid key.';
        }
    }
}
