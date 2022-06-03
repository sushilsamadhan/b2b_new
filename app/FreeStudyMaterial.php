<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FreeStudyMaterial extends Model
{
    use SoftDeletes;
   // protected $guarded = ['id'];
   public function scopePublished($query){
    return $query->where('is_published', 1);
}

    public function parent(){
        return $this->hasOne(FreeStudyMaterial::class,'id','parent_category_id');
    }

    public function child(){
        return $this->hasMany(FreeStudyMaterial::class,'parent_category_id','id');
    }
}
