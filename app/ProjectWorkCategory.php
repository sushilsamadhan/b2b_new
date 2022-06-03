<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProjectWorkClass;

class ProjectWorkCategory extends Model
{
    //

    protected $fillable = ['parent_category_id','project_work_class_id','category_name','status'];

    public function getclassname()
    {
        return $this->hasOne('App\ProjectWorkClass','id','project_work_class_id');
    }
}
