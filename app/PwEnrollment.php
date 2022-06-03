<?php

namespace App;

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
}
