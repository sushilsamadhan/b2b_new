<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PwCategory extends Model
{
    protected $fillable = ['parent_category_id','project_work_class_id','category_name','status'];

    public function getclassname()
    {
        return $this->hasOne('App\ProjectWorkClass','id','project_work_class_id');
    }

    public function scopePublished($query){
        return $query->where('is_published', 1);
    }


    public function parent(){
        return $this->hasOne(PwCategory::class,'id','parent_category_id');
    }

    public function child(){
        return $this->hasMany(PwCategory::class,'parent_category_id','id');
    }

   public function courses(){
        return $this->hasMany(PwCourse::class,'category_id','id')->Published();
   }

}
