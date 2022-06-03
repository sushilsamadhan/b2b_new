<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IidSector extends Model
{
    protected $guarded = [];

    public function sectors(){
        return $this->hasMany(Course::class,'iid_sector_id','id')->Published();
   }


}
