<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Model\Category;
class PackageSetting extends Model
{
    //protected $fillable
    protected $fillable   =[
                            'pkg_name',
                            'free_subject',
                            'is_all_subject',
                            'short_desc',
                            'pkg_desc',
                            'pkg_image',
                            'package_type',
                            'category_id',
                            'sub_category_id',
                            'course_id',
                            'quarterly_course_coverage',
                            'halfyrly_course_coverage',
                            'annually_course_coverage',
                            'quarterly_coverage_price',
                            'halfyrly_coverage_price',
                            'annually_coverage_price',
                            'default_discount',
                            'member_discount',
                            'no_of_test',
                            'no_of_practice_test',
                            'no_of_sectional_test',
                            'no_of_test_questions',
                            'status'
                        ];
    
                        function subjectName()
                        {
                            return $this->belongsTo(Course::class,'course_id','id');
                        } 
    public function enrollSubCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }                      
}
