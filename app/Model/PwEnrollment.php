<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\PwClasses;
use App\Model\PwCategory;

class PwEnrollment extends Model
{
    //
    
    public function getclassname()
    {
        return $this->hasOne('App\Model\PwClasses','id','project_work_class_id');
    }
    public function getcatname()
    {
        return $this->hasOne('App\Model\PwCategory','id','project_work_category_id');
    }
    public function enrollCourse()
    {
        return $this->belongsTo(PwCourse::class, 'project_work_id', 'id')
            ->with('relationBetweenInstructorUser')
            ->with('category')
            ->with('enrollClasses');
    }
}
